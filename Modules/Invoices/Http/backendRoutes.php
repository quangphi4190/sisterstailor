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
   
    $router->post('invoices/get_id_customer', [
        'as' => 'admin.invoices.invoices.get_id_customer',
        'uses' => 'InvoiceController@get_id_customer'
    ]);
    $router->post('invoices/modal/get_id_customer', [
        'as' => 'admin.invoices.invoices.get_id_modal',
        'uses' => 'InvoiceController@get_id_modal'
    ]);
    $router->post('invoices/get_info/info', [
        'as' => 'admin.invoices.invoice.modal-info-customer',
        'uses' => 'InvoiceController@get_info'
    ]);

    $router->post('invoices/get_info/edit_info', [
        'as' => 'admin.invoices.invoice.modal-edit-customer',
        'uses' => 'InvoiceController@edit_info'
    ]);

    
    $router->post('invoices/add/inser_form', [
        'as' => 'admin.invoices.invoices.inser_form',
        'uses' => 'InvoiceController@inser_form'
    ]);
    $router->post('invoices/edit/edit_form', [
        'as' => 'admin.invoices.invoices.edit_form',
        'uses' => 'InvoiceController@edit_form'
    ]);
    $router->get('invoices/updateGroupCode', [
        'as' => 'admin.invoices.invoice.updateGroupCode',
        'uses' => 'InvoiceController@updateGroupCode'
    ]);
    $router->post('invoices/get_tour_guide_id', [
        'as' => 'admin.invoices.invoices.get_tour_guide_id',
        'uses' => 'InvoiceController@get_tour_guide_id'
    ]);

    $router->get('invoices/get_group_info/{id}/{group_code}/', [
        'as' => 'admin.invoices.invoice.get_group_info',
        'uses' => 'InvoiceController@get_group_info'
    ]);
    $router->get('paid/{id}', [
        'as' => 'admin.invoices.paid',
        'uses' => 'InvoiceController@paid'
    ]);
    $router->post('update_hotel',[
        'as'    =>  'admin.invoices.update_hotel',
        'uses'  =>  'InvoiceController@updateHotel'
    ]);
// append

});
