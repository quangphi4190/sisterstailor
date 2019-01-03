<?php

use Illuminate\Routing\Router;
/** @var Router $router */

Route::get('/products/{slug}',[
   'as' =>  'products.index',
    'uses'  =>  'PublicController@index'
]);

 $router->get('product/{id}/detail', [
    'as' => 'product.detail',
    'uses' => 'PublicController@detail'
]);
Route::post('/products/product/get_slug',[
    'as'    =>  'products.product.get_slug',
    'uses'  =>  'PublicController@get_slug'
]);