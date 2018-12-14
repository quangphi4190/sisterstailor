<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/tourguide'], function (Router $router) {
    $router->bind('tourguide', function ($id) {
        return app('Modules\Tourguide\Repositories\TourGuideRepository')->find($id);
    });
    $router->get('tourguides', [
        'as' => 'admin.tourguide.tourguide.index',
        'uses' => 'TourGuideController@index',
        'middleware' => 'can:tourguide.tourguides.index'
    ]);
    $router->get('tourguides/create', [
        'as' => 'admin.tourguide.tourguide.create',
        'uses' => 'TourGuideController@create',
        'middleware' => 'can:tourguide.tourguides.create'
    ]);
    $router->post('tourguides', [
        'as' => 'admin.tourguide.tourguide.store',
        'uses' => 'TourGuideController@store',
        'middleware' => 'can:tourguide.tourguides.create'
    ]);
    $router->get('tourguides/{tourguide}/edit', [
        'as' => 'admin.tourguide.tourguide.edit',
        'uses' => 'TourGuideController@edit',
        'middleware' => 'can:tourguide.tourguides.edit'
    ]);
    $router->put('tourguides/{tourguide}', [
        'as' => 'admin.tourguide.tourguide.update',
        'uses' => 'TourGuideController@update',
        'middleware' => 'can:tourguide.tourguides.edit'
    ]);
    $router->delete('tourguides/{tourguide}', [
        'as' => 'admin.tourguide.tourguide.destroy',
        'uses' => 'TourGuideController@destroy',
        'middleware' => 'can:tourguide.tourguides.destroy'
    ]);
    $router->post('tourguides/get_id', [
        'as' => 'admin.tourguide.tourguides.get_id',
        'uses' => 'TourGuideController@get_id'
    ]);
    $router->post('tourguides/state/get_id_state', [
        'as' => 'admin.tourguide.tourguides.get_id_state',
        'uses' => 'TourGuideController@get_id_state'
    ]);
// append

});
