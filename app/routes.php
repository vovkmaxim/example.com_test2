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

Route::get('api-all-news', 'APIAuthComtroller@showAllNews');

Route::get('api-one-news/{id}', 'APIAuthComtroller@displayOneNews');

Route::get('api-change-news/{id}', 'APIAuthComtroller@getChangeNewsForm');

Route::post('api-change-news/{id}', 'APIAuthComtroller@savingChangesNews');

Route::get('api-delete-news/{id}', 'APIAuthComtroller@removalNews');

Route::get('api-create-news', 'APIAuthComtroller@createNewsForm');

Route::post('api-create-news', 'APIAuthComtroller@addingCreatedNews');

Route::get('api-search-news', 'APIAuthComtroller@formSearchNews');

Route::post('api-search-news', 'APIAuthComtroller@showSerchNews');

Route::get('api-tag-search-news', 'APIAuthComtroller@formTagSearchNews');

Route::post('api-tag-search-news', 'APIAuthComtroller@showTagSerchNews');

Route::get('api-registration', 'APIAuthComtroller@apiregistrationForm');

Route::post('api-registration', 'APIAuthComtroller@registration');

Route::get('api-logout', 'APIAuthComtroller@logout');










