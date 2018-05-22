<?php

use Conveyor\Route;

Route::register([
    'namespace' => 'App\\Controllers\\',
]);

Route::get('/tag/createTag', 'TagController@createTag');
Route::get('/tag/', 'TagController@index');
Route::get('/tag/getTag', 'TagController@getTag');

Route::get('/tag/article', 'TagController@article');
Route::get('/tag/batch', 'TagController@batchTaging');
Route::get('/tag/all', 'TagController@getAll');
