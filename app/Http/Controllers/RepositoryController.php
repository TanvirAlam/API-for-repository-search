<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\GitHub;

class RepositoryController extends Controller
{
    private $repository;

    public function __construct(GitHub $repository)
    {
        $this->repository = $repository;
    }

    public function github($query, $sort = null, $order = null, $perPage = null, $pageNumber = null)
    {
        return $this->repository->getSearchResults($query, $sort, $order, $perPage, $pageNumber);
    }
}
