<?php

use Illuminate\Routing\Router;
/** @var Router $router */

Route::get('/products',[
   'as' =>  'products.index',
    'uses'  =>  'PublicController@index'
]);

 $router->get('product/{id}/detail', [
    'as' => 'product.detail',
    'uses' => 'PublicController@detail'
]);