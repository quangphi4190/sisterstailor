<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/customers'], function (Router $router) {
    $router->bind('customer', function ($id) {
        return app('Modules\Customers\Repositories\CustomerRepository')->find($id);
    });
    $router->get('customers', [
        'as' => 'admin.customers.customer.index',
        'uses' => 'CustomerController@index',
        'middleware' => 'can:customers.customers.index'
    ]);
    $router->get('customers/create', [
        'as' => 'admin.customers.customer.create',
        'uses' => 'CustomerController@create',
        'middleware' => 'can:customers.customers.create'
    ]);
    $router->post('customers', [
        'as' => 'admin.customers.customer.store',
        'uses' => 'CustomerController@store',
        'middleware' => 'can:customers.customers.create'
    ]);
    $router->get('customers/{customer}/edit', [
        'as' => 'admin.customers.customer.edit',
        'uses' => 'CustomerController@edit',
        'middleware' => 'can:customers.customers.edit'
    ]);
    $router->get('customers/{customer}/view', [
        'as' => 'admin.customers.customer.view',
        'uses' => 'CustomerController@view'
    ]);
    $router->put('customers/{customer}', [
        'as' => 'admin.customers.customer.update',
        'uses' => 'CustomerController@update',
        'middleware' => 'can:customers.customers.edit'
    ]);
    $router->delete('customers/{customer}', [
        'as' => 'admin.customers.customer.destroy',
        'uses' => 'CustomerController@destroy',
        'middleware' => 'can:customers.customers.destroy'
    ]);

    $router->post('customers/get_id', [
        'as' => 'admin.customers.customer.get_id',
        'uses' => 'CustomerController@get_id'
    ]);
    $router->post('customers/state/get_id_state', [
        'as' => 'admin.customers.customer.get_id_state',
        'uses' => 'CustomerController@get_id_state'
    ]);
// append

});

