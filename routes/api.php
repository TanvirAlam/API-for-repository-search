<?php

Route::group(['prefix' => 'search/repository'], function () {
    Route::get('github/{searchQuery}', ['uses' => 'RepositoryController@gitHub']);
    Route::get('gitLab/{searchQuery}', ['uses' => 'RepositoryController@gitLab']);
    Route::get('bitbucket/{searchQuery}', ['uses' => 'RepositoryController@bitbucket']);
});
