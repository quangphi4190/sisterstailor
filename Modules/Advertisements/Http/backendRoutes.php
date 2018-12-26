<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/advertisements'], function (Router $router) {
    $router->bind('advertisement', function ($id) {
        return app('Modules\Advertisements\Repositories\AdvertisementRepository')->find($id);
    });
    $router->get('advertisements', [
        'as' => 'admin.advertisements.advertisement.index',
        'uses' => 'AdvertisementController@index',
        'middleware' => 'can:advertisements.advertisements.index'
    ]);
    $router->get('advertisements/create', [
        'as' => 'admin.advertisements.advertisement.create',
        'uses' => 'AdvertisementController@create',
        'middleware' => 'can:advertisements.advertisements.create'
    ]);
    $router->post('advertisements', [
        'as' => 'admin.advertisements.advertisement.store',
        'uses' => 'AdvertisementController@store',
        'middleware' => 'can:advertisements.advertisements.create'
    ]);
    $router->get('advertisements/{advertisement}/edit', [
        'as' => 'admin.advertisements.advertisement.edit',
        'uses' => 'AdvertisementController@edit',
        'middleware' => 'can:advertisements.advertisements.edit'
    ]);
    $router->put('advertisements/{advertisement}', [
        'as' => 'admin.advertisements.advertisement.update',
        'uses' => 'AdvertisementController@update',
        'middleware' => 'can:advertisements.advertisements.edit'
    ]);
    $router->delete('advertisements/{advertisement}', [
        'as' => 'admin.advertisements.advertisement.destroy',
        'uses' => 'AdvertisementController@destroy',
        'middleware' => 'can:advertisements.advertisements.destroy'
    ]);
// append

});
