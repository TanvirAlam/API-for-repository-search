<?php

Route::group(['prefix' => 'search/repository'], function () {
    Route::get('github/{searchQuery}/{sort?}/{order?}/{perPage?}/{pageNumber?}', ['uses' => 'RepositoryController@gitHub']);
    //Route::get('gitLab/{searchQuery}/{sort?}/{order?}/{perPage?}/{pageNumber?}', ['uses' => 'RepositoryController@gitLab']);
    //Route::get('bitbucket/{searchQuery}/{sort?}/{order?}/{perPage?}/{pageNumber?}', ['uses' => 'RepositoryController@bitbucket']);
});
