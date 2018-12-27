<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/orders'], function (Router $router) {

    $router->get('/', [
        'as' => 'order.index',
        'uses' => 'PublicController@index'
    ]);
    $router->post('/add-orders', [
        'as' => 'order.add-orders',
        'uses' => 'PublicController@add_orders'
    ]);
});
