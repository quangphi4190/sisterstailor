<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/thongke'], function (Router $router) {
    $router->bind('thongkeday', function ($id) {
        return app('Modules\Thongke\Repositories\ThongkedayRepository')->find($id);
    });
    $router->get('thongkedays', [
        'as' => 'admin.thongke.thongkeday.index',
        'uses' => 'ThongkedayController@index',
        'middleware' => 'can:thongke.thongkedays.index'
    ]);
    $router->get('thongkedays/create', [
        'as' => 'admin.thongke.thongkeday.create',
        'uses' => 'ThongkedayController@create',
        'middleware' => 'can:thongke.thongkedays.create'
    ]);
    $router->post('thongkedays', [
        'as' => 'admin.thongke.thongkeday.store',
        'uses' => 'ThongkedayController@store',
        'middleware' => 'can:thongke.thongkedays.create'
    ]);
    $router->get('thongkedays/{thongkeday}/edit', [
        'as' => 'admin.thongke.thongkeday.edit',
        'uses' => 'ThongkedayController@edit',
        'middleware' => 'can:thongke.thongkedays.edit'
    ]);
    $router->put('thongkedays/{thongkeday}', [
        'as' => 'admin.thongke.thongkeday.update',
        'uses' => 'ThongkedayController@update',
        'middleware' => 'can:thongke.thongkedays.edit'
    ]);
    $router->delete('thongkedays/{thongkeday}', [
        'as' => 'admin.thongke.thongkeday.destroy',
        'uses' => 'ThongkedayController@destroy',
        'middleware' => 'can:thongke.thongkedays.destroy'
    ]);
    $router->bind('thongketime', function ($id) {
        return app('Modules\Thongke\Repositories\ThongketimeRepository')->find($id);
    });
    $router->get('thongketimes', [
        'as' => 'admin.thongke.thongketime.index',
        'uses' => 'ThongketimeController@index',
        'middleware' => 'can:thongke.thongketimes.index'
    ]);
    $router->get('thongketimes/create', [
        'as' => 'admin.thongke.thongketime.create',
        'uses' => 'ThongketimeController@create',
        'middleware' => 'can:thongke.thongketimes.create'
    ]);
    $router->post('thongketimes', [
        'as' => 'admin.thongke.thongketime.store',
        'uses' => 'ThongketimeController@store',
        'middleware' => 'can:thongke.thongketimes.create'
    ]);
    $router->get('thongketimes/{thongketime}/edit', [
        'as' => 'admin.thongke.thongketime.edit',
        'uses' => 'ThongketimeController@edit',
        'middleware' => 'can:thongke.thongketimes.edit'
    ]);
    $router->put('thongketimes/{thongketime}', [
        'as' => 'admin.thongke.thongketime.update',
        'uses' => 'ThongketimeController@update',
        'middleware' => 'can:thongke.thongketimes.edit'
    ]);
    $router->delete('thongketimes/{thongketime}', [
        'as' => 'admin.thongke.thongketime.destroy',
        'uses' => 'ThongketimeController@destroy',
        'middleware' => 'can:thongke.thongketimes.destroy'
    ]);
    $router->bind('thongkehotel', function ($id) {
        return app('Modules\Thongke\Repositories\ThongkehotelRepository')->find($id);
    });
    $router->get('thongkehotels', [
        'as' => 'admin.thongke.thongkehotel.index',
        'uses' => 'ThongkehotelController@index',
        'middleware' => 'can:thongke.thongkehotels.index'
    ]);
    $router->get('thongkehotels/create', [
        'as' => 'admin.thongke.thongkehotel.create',
        'uses' => 'ThongkehotelController@create',
        'middleware' => 'can:thongke.thongkehotels.create'
    ]);
    $router->post('thongkehotels', [
        'as' => 'admin.thongke.thongkehotel.store',
        'uses' => 'ThongkehotelController@store',
        'middleware' => 'can:thongke.thongkehotels.create'
    ]);
    $router->get('thongkehotels/{thongkehotel}/edit', [
        'as' => 'admin.thongke.thongkehotel.edit',
        'uses' => 'ThongkehotelController@edit',
        'middleware' => 'can:thongke.thongkehotels.edit'
    ]);
    $router->put('thongkehotels/{thongkehotel}', [
        'as' => 'admin.thongke.thongkehotel.update',
        'uses' => 'ThongkehotelController@update',
        'middleware' => 'can:thongke.thongkehotels.edit'
    ]);
    $router->delete('thongkehotels/{thongkehotel}', [
        'as' => 'admin.thongke.thongkehotel.destroy',
        'uses' => 'ThongkehotelController@destroy',
        'middleware' => 'can:thongke.thongkehotels.destroy'
    ]);
    $router->bind('thongketourguide', function ($id) {
        return app('Modules\Thongke\Repositories\ThongketourguideRepository')->find($id);
    });
    $router->get('thongketourguides', [
        'as' => 'admin.thongke.thongketourguide.index',
        'uses' => 'ThongketourguideController@index',
        'middleware' => 'can:thongke.thongketourguides.index'
    ]);
    $router->get('thongketourguides/create', [
        'as' => 'admin.thongke.thongketourguide.create',
        'uses' => 'ThongketourguideController@create',
        'middleware' => 'can:thongke.thongketourguides.create'
    ]);
    $router->post('thongketourguides', [
        'as' => 'admin.thongke.thongketourguide.store',
        'uses' => 'ThongketourguideController@store',
        'middleware' => 'can:thongke.thongketourguides.create'
    ]);
    $router->get('thongketourguides/{thongketourguide}/edit', [
        'as' => 'admin.thongke.thongketourguide.edit',
        'uses' => 'ThongketourguideController@edit',
        'middleware' => 'can:thongke.thongketourguides.edit'
    ]);
    $router->put('thongketourguides/{thongketourguide}', [
        'as' => 'admin.thongke.thongketourguide.update',
        'uses' => 'ThongketourguideController@update',
        'middleware' => 'can:thongke.thongketourguides.edit'
    ]);
    $router->delete('thongketourguides/{thongketourguide}', [
        'as' => 'admin.thongke.thongketourguide.destroy',
        'uses' => 'ThongketourguideController@destroy',
        'middleware' => 'can:thongke.thongketourguides.destroy'
    ]);
// append


    $router->get('thong-ke-doanh-thu', [
        'as' => 'admin.thongke.thong_ke_doanh_thu',
        'uses' => 'ThongketimeController@thong_ke_doanh_thu',
    ]);
    $router->get('khach-doan', [
        'as' => 'admin.thongke.khach_doan',
        'uses' => 'ThongketimeController@khachdoan',
    ]);
    $router->get('get-tour-guide/{group_code}', [
        'as' => 'admin.thongke.get_tour_guide',
        'uses' => 'ThongketimeController@get_tour_guide',
    ]);

});
