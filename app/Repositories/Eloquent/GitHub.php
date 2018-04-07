<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;

class GitHub extends SearchRepository
{
    public function getSearchResults($search, $sort, $order, $perPage, $pageNumber)
    {
        return $this->passCredentials(
            Config::get('services.github.username'),
            Config::get('services.github.token'),
            $search,
            $sort,
            $order,
            $perPage,
            $pageNumber
        );
    }

    protected function setBaseApiUrl()
    {
        $this->baseApiUrl = 'https://api.github.com/search/code?';
    }

    protected function getFormatedJsonData($responseObject)
    {
        $responseArray = json_decode($responseObject, true);
        $collection = new Collection($responseArray['items']);
        $searchResult = $collection->map(function ($item, $key) {
            return [
                'Owner' => $item['repository']['owner']['login'],
                'Repository' => $item['repository']['name'],
                'File' => $item['html_url'],
            ];
        })->jsonSerialize();
        return $searchResult;
    }
}
