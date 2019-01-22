<?php

use Illuminate\Routing\Router;
/** @var Router $router */


Route::get('/contact',[
   'as' =>  'contact.contacts',
   'uses'   =>  'PublicController@index'
]);
Route::post('postcontact',[
   'as' =>  'post.contacts',
   'uses'   =>   'PublicController@postContact'
]);