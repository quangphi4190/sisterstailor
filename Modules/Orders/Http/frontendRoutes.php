<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/orders'], function (Router $router) {

    $router->get('/', [
        'as' => 'order.index',
        'uses' => 'PublicController@index'
    ]);

    $router->get('/add-cart', [
        'as' => 'order.add_cart',
        'uses' => 'PublicController@add_cart'
    ]);
    $router->get('/get-cart', [
        'as' => 'order.get_cart',
        'uses' => 'PublicController@get_cart'
    ]);
    $router->get('/update-cart', [
        'as' => 'order.update_cart',
        'uses' => 'PublicController@update_cart'
    ]);
    $router->get('/get-cart', [
        'as' => 'order.get_cart',
        'uses' => 'PublicController@get_cart'
    ]);
    $router->get('/checkout', [
        'as' => 'order.checkout',
        'uses' => 'PublicController@checkout'
    ]);
    $router->post('/confirm', [
        'as' => 'order.confirm',
        'uses' => 'PublicController@confirm_order'
    ]);
});
