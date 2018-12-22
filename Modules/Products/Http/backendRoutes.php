<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/products'], function (Router $router) {
    $router->bind('products', function ($id) {
        return app('Modules\Products\Repositories\ProductsRepository')->find($id);
    });
    $router->get('products', [
        'as' => 'admin.products.products.index',
        'uses' => 'ProductsController@index',
        'middleware' => 'can:products.products.index'
    ]);
    $router->get('products/create', [
        'as' => 'admin.products.products.create',
        'uses' => 'ProductsController@create',
        'middleware' => 'can:products.products.create'
    ]);
    $router->post('products', [
        'as' => 'admin.products.products.store',
        'uses' => 'ProductsController@store',
        'middleware' => 'can:products.products.create'
    ]);
    $router->get('products/{products}/edit', [
        'as' => 'admin.products.products.edit',
        'uses' => 'ProductsController@edit',
        'middleware' => 'can:products.products.edit'
    ]);
    $router->put('products/{products}', [
        'as' => 'admin.products.products.update',
        'uses' => 'ProductsController@update',
        'middleware' => 'can:products.products.edit'
    ]);
    $router->delete('products/{products}', [
        'as' => 'admin.products.products.destroy',
        'uses' => 'ProductsController@destroy',
        'middleware' => 'can:products.products.destroy'
    ]);
    $router->bind('categories', function ($id) {
        return app('Modules\Products\Repositories\CategoriesRepository')->find($id);
    });
    $router->get('categories', [
        'as' => 'admin.products.categories.index',
        'uses' => 'CategoriesController@index',
        'middleware' => 'can:products.categories.index'
    ]);
    $router->get('categories/create', [
        'as' => 'admin.products.categories.create',
        'uses' => 'CategoriesController@create',
        'middleware' => 'can:products.categories.create'
    ]);
    $router->post('categories', [
        'as' => 'admin.products.categories.store',
        'uses' => 'CategoriesController@store',
        'middleware' => 'can:products.categories.create'
    ]);
    $router->get('categories/{categories}/edit', [
        'as' => 'admin.products.categories.edit',
        'uses' => 'CategoriesController@edit',
        'middleware' => 'can:products.categories.edit'
    ]);
    $router->put('categories/{categories}', [
        'as' => 'admin.products.categories.update',
        'uses' => 'CategoriesController@update',
        'middleware' => 'can:products.categories.edit'
    ]);
    $router->delete('categories/{categories}', [
        'as' => 'admin.products.categories.destroy',
        'uses' => 'CategoriesController@destroy',
        'middleware' => 'can:products.categories.destroy'
    ]);
// append


});
