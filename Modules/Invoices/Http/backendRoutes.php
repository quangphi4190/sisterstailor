<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/invoices'], function (Router $router) {
    $router->bind('invoice', function ($id) {
        return app('Modules\Invoices\Repositories\InvoiceRepository')->find($id);
    });
    $router->get('invoices', [
        'as' => 'admin.invoices.invoice.index',
        'uses' => 'InvoiceController@index',
        'middleware' => 'can:invoices.invoices.index'
    ]);
    $router->get('invoices/create', [
        'as' => 'admin.invoices.invoice.create',
        'uses' => 'InvoiceController@create',
        'middleware' => 'can:invoices.invoices.create'
    ]);
    $router->post('invoices', [
        'as' => 'admin.invoices.invoice.store',
        'uses' => 'InvoiceController@store',
        'middleware' => 'can:invoices.invoices.create'
    ]);
    $router->get('invoices/{invoice}/edit', [
        'as' => 'admin.invoices.invoice.edit',
        'uses' => 'InvoiceController@edit',
        'middleware' => 'can:invoices.invoices.edit'
    ]);
    $router->put('invoices/{invoice}', [
        'as' => 'admin.invoices.invoice.update',
        'uses' => 'InvoiceController@update',
        'middleware' => 'can:invoices.invoices.edit'
    ]);
    $router->delete('invoices/{invoice}', [
        'as' => 'admin.invoices.invoice.destroy',
        'uses' => 'InvoiceController@destroy',
        'middleware' => 'can:invoices.invoices.destroy'
    ]);
// append

});
