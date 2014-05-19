<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */


Route::get('/', 'HomeController@showWelcome');

Route::get('api-login', 'APIAuthComtroller@apiloginForm');

Route::post('api-login', 'APIAuthComtroller@login');

Route::get('api-all-news', 'NewsController@showAllNews');

Route::get('api-one-news/{id}', 'NewsController@displayOneNews');

Route::get('api-change-news/{id}', 'NewsController@getChangeNewsForm');

Route::post('api-change-news/{id}', 'NewsController@savingChangesNews');

Route::get('api-delete-news/{id}', 'NewsController@removalNews');

Route::get('api-create-news', 'NewsController@createNewsForm');

Route::post('api-create-news', 'NewsController@addingCreatedNews');

Route::get('api-search-news', 'NewsController@formSearchNews');

Route::post('api-search-news', 'NewsController@showSerchNews');

Route::get('api-tag-search-news', 'NewsController@formTagSearchNews');

Route::post('api-tag-search-news', 'NewsController@showTagSerchNews');

Route::get('api-registration', 'APIAuthComtroller@apiregistrationForm');

Route::post('api-registration', 'APIAuthComtroller@registration');

Route::get('api-logout', 'APIAuthComtroller@logout');










