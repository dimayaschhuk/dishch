<?php

Route::get('/search/{id}','ProjectController@getProject')->name('api.project.get');
Route::get('/all','ProjectController@getProjects')->name('api.project.gets');

Route::post('/create','ProjectController@createProject')->name('api.project.create');
Route::post('/update','ProjectController@updateProject')->name('api.project.update');