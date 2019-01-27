<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/orders'], function (Router $router) {
    $router->bind('order', function ($id) {
        return app('Modules\Orders\Repositories\OrderRepository')->find($id);
    });
    $router->get('orders', [
        'as' => 'admin.orders.order.index',
        'uses' => 'OrderController@index',
        'middleware' => 'can:orders.orders.index'
    ]);
    $router->get('orders/create', [
        'as' => 'admin.orders.order.create',
        'uses' => 'OrderController@create',
        'middleware' => 'can:orders.orders.create'
    ]);
    $router->post('orders', [
        'as' => 'admin.orders.order.store',
        'uses' => 'OrderController@store',
        'middleware' => 'can:orders.orders.create'
    ]);
    $router->get('orders/{order}/edit', [
        'as' => 'admin.orders.order.edit',
        'uses' => 'OrderController@edit',
        'middleware' => 'can:orders.orders.edit'
    ]);
    $router->get('orders/{order}/view', [
        'as' => 'admin.orders.order.view',
        'uses' => 'OrderController@view'
    ]);
    $router->put('orders/{order}', [
        'as' => 'admin.orders.order.update',
        'uses' => 'OrderController@update',
        'middleware' => 'can:orders.orders.edit'
    ]);
    $router->delete('orders/{order}', [
        'as' => 'admin.orders.order.destroy',
        'uses' => 'OrderController@destroy',
        'middleware' => 'can:orders.orders.destroy'
    ]);
    $router->bind('order_details', function ($id) {
        return app('Modules\Orders\Repositories\Order_detailsRepository')->find($id);
    });
    $router->get('order_details', [
        'as' => 'admin.orders.order_details.index',
        'uses' => 'Order_detailsController@index',
        'middleware' => 'can:orders.order_details.index'
    ]);
    $router->get('order_details/create', [
        'as' => 'admin.orders.order_details.create',
        'uses' => 'Order_detailsController@create',
        'middleware' => 'can:orders.order_details.create'
    ]);
    $router->post('order_details', [
        'as' => 'admin.orders.order_details.store',
        'uses' => 'Order_detailsController@store',
        'middleware' => 'can:orders.order_details.create'
    ]);
    $router->get('order_details/{order_details}/edit', [
        'as' => 'admin.orders.order_details.edit',
        'uses' => 'Order_detailsController@edit',
        'middleware' => 'can:orders.order_details.edit'
    ]);
    $router->put('order_details/{order_details}', [
        'as' => 'admin.orders.order_details.update',
        'uses' => 'Order_detailsController@update',
        'middleware' => 'can:orders.order_details.edit'
    ]);
    $router->delete('order_details/{order_details}', [
        'as' => 'admin.orders.order_details.destroy',
        'uses' => 'Order_detailsController@destroy',
        'middleware' => 'can:orders.order_details.destroy'
    ]);

    $router->post('orders/view_detail',[
        'as'    =>  'order.view_detail',
        'uses'  =>  'OrderController@view_detail'
    ]);
// append


});
