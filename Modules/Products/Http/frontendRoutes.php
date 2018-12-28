<?php

use Illuminate\Routing\Router;
/** @var Router $router */

Route::get('/products/{slug}',[
   'as' =>  'products.index',
    'uses'  =>  'PublicController@index'
]);