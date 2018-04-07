<?php

namespace app\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use GuzzleHttp\Client;

abstract class SearchRepository implements RepositoryInterface
{
    protected $baseApiUrl;
    protected $client;
    protected $validConditions;
    protected $defaultPerPage = 25;
    protected $defaultPageNumber = 1;
    protected $defaultSort = 'score';
    protected $defaultOrder = 'desc';

    public function __construct()
    {
        $this->client = new Client();
        $this->setValidConditions();
        $this->setBaseApiUrl();
    }

    public abstract function getSearchResults($search, $sort, $order, $perPage, $pageNumber);
    protected abstract function setBaseApiUrl();
    protected abstract function getFormatedJsonData($responseObject);

    protected function setSearch($search)
    {
        if ($search) {
            $this->setParameter('q', $search . '+in:file');
            return true;
        }
        return false;
    }

    protected function setParameter($key, $value)
    {
        if (substr($this->baseApiUrl, -1) == '?') {
            return $this->baseApiUrl .= $key . '=' . $value;
        }
        return $this->baseApiUrl .= '&' . $key . '=' . $value;
    }

    protected function setConditions($conditions)
    {
        foreach($conditions as $key => $value) {
            if($this->checkConditionIsValid($key, $value)) {
                $this->setParameter($key, $value);
            }
        }
        return true;
    }

    protected function setValidConditions()
    {
        $this->validConditions = [
            'sort' => ['stars', 'forks', 'updates', 'score'],
            'order' => ['asc', 'desc'],
        ];
    }

    protected function checkConditionIsValid($key, $value)
    {
        foreach ($this->validConditions as $validConditionKey => $validConditionValue) {
            if($key == $validConditionKey) {
                if (in_array($value, $validConditionValue)) {
                    return true;
                }
            }
        }
        return false;
    }

    protected function passCredentials($userName, $passWord, $search, $sort, $order, $perPage, $pageNumber)
    {
        $this->setSearch($search);
        if($sort) {
            if (!$this->checkConditionIsValid('sort', $sort)) {
                throw new \Exception('Condition for sort do not match');
            }
        }
        if($order) {
            if (!$this->checkConditionIsValid('order', $order)) {
                throw new \Exception('Condition for order do not match');
            }
        }
        $this->setURL($sort, $order, $perPage, $pageNumber);
        $responseObject = $this->client
            ->request('GET', $this->baseApiUrl, [
                'auth' => [
                    $userName,
                    $passWord
                ]
            ])
            ->getBody();

        return $this->getFormatedJsonData($responseObject);
    }

    private function setURL($sort, $order, $perPage, $pageNumber)
    {
        $this->baseApiUrl .= '&sort=' . $sort ?: $this->defaultSort;
        $this->baseApiUrl .= '&order=' . $order ?: $this->defaultOrder;
        $this->baseApiUrl .= '&per_page=' . $perPage ?: $this->defaultPerPage;
        $this->baseApiUrl .= '&page=' . $pageNumber ?: $this->defaultPageNumber;
    }
}
