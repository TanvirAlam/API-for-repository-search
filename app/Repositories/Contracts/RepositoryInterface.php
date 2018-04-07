<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function getSearchResults($search, $sort, $order, $perPage, $pageNumber);
}
