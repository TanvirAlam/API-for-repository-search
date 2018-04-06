<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CategoryRepository;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $category;

    /**
     * RepositoryController constructor.
     *
     * @param CategoryRepository $category
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }
}
