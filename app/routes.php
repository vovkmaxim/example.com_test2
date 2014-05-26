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


Route::get('/', array('as' => 'home',
                        'uses' => 'HomeController@showWelcome'));

Route::get('api-login', array('as' => 'login',
                                 'uses' => 'APIAuthComtroller@apiloginForm'));

Route::post('api-login', array('as' => 'login',
                                'uses' => 'APIAuthComtroller@login'));

Route::get('api-all-news', array('as' => 'all-news',
                            'uses' => 'NewsController@showAllNews'));

Route::get('api-one-news/{id}',  array('as' => 'one-news',
                            'uses' => 'NewsController@displayOneNews'));

Route::get('api-change-news/{id}', array('as' => 'change-news',
                            'uses' => 'NewsController@getChangeNewsForm'));

Route::post('api-change-news/{id}', array('as' => 'change-news',
                            'uses' => 'NewsController@savingChangesNews'));

Route::get('api-delete-news/{id}',  array('as' => 'delete-news',
                            'uses' => 'NewsController@removalNews'));

Route::get('api-create-news', array('as' => 'create-news',
                            'uses' => 'NewsController@createNewsForm'));

Route::post('api-create-news',  array('as' => 'create-news',
                            'uses' => 'NewsController@addingCreatedNews'));

Route::get('api-search-news',  array('as' => 'search-news',
                            'uses' => 'NewsController@formSearchNews'));

Route::post('api-search-news', array('as' => 'search-news',
                            'uses' => 'NewsController@showSerchNews'));

Route::get('api-tag-search-news', array('as' => 'tag-search-news',
                                    'uses' => 'NewsController@formTagSearchNews'));

Route::post('api-tag-search-news', array('as' => 'tag-search-news',
                                    'uses' =>  'NewsController@showTagSerchNews'));

Route::get('api-registration',  array('as' => 'registration',
                                    'uses' => 'APIAuthComtroller@apiregistrationForm'));

Route::post('api-registration',  array('as' => 'registration',
                                    'uses' => 'APIAuthComtroller@registration'));

Route::get('api-logout',  array('as' => 'logout',
                                    'uses' =>  'APIAuthComtroller@logout'));


Route::post('delete-image', function(){
    return NewsController::deleteImage();
});


Route::get('upload-image', function(){
    return NewsController::uploadImageForm();
});

Route::post('upload-image', function(){
    return NewsController::uploadImage();  
});

Route::get('send-mail', function(){
    echo MailController::sendMailForm();
});

Route::post('send-mail', function(){
    return MailController::sendMail();
});
