<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/news'], function (Router $router) {

    $router->get('/', [
        'as' => 'news',
        'uses' => 'PublicController@index'
    ]);
    $router->get('{slug}', [
        'as' => 'slugCategory.detail',
        'uses' => 'PublicController@slugCategory'
    ]);

});

$router->get('danh-muc/{slug}', [
    'as' => 'news.category',
    'uses' => 'PublicController@category_detail'
]);