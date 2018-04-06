<?php

namespace App\Providers;

use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Eloquent\GitHub;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = true;

    protected $repositoryMap = [
        CategoryRepository::class => GitHub::class
    ];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositoryMap as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }

    public function provides()
    {
        return array_keys($this->repositoryMap);
    }
}
