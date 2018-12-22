<?php

use Illuminate\Routing\Router;
/** @var Router $router */

Route::get('/products',[
   'as' =>  'products.index',
    'uses'  =>  'PublicController@index'
]);