<?php

Route::get('/search/{id}','UserController@getUser')->name('api.user.get');
Route::get('/all','UserController@getUsers')->name('api.user.gets');

Route::post('/create','UserController@createUser')->name('api.user.create');
Route::post('/update','UserController@updateUser')->name('api.user.update');
