<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/post'], function (Router $router) {
    $router->bind('postcategory', function ($id) {
        return app('Modules\Post\Repositories\PostcategoryRepository')->find($id);
    });
    $router->get('postcategories', [
        'as' => 'admin.post.postcategory.index',
        'uses' => 'PostcategoryController@index',
        'middleware' => 'can:post.postcategories.index'
    ]);
    $router->get('postcategories/create', [
        'as' => 'admin.post.postcategory.create',
        'uses' => 'PostcategoryController@create',
        'middleware' => 'can:post.postcategories.create'
    ]);
    $router->post('postcategories', [
        'as' => 'admin.post.postcategory.store',
        'uses' => 'PostcategoryController@store',
        'middleware' => 'can:post.postcategories.create'
    ]);
    $router->get('postcategories/{postcategory}/edit', [
        'as' => 'admin.post.postcategory.edit',
        'uses' => 'PostcategoryController@edit',
        'middleware' => 'can:post.postcategories.edit'
    ]);
    $router->put('postcategories/{postcategory}', [
        'as' => 'admin.post.postcategory.update',
        'uses' => 'PostcategoryController@update',
        'middleware' => 'can:post.postcategories.edit'
    ]);
    $router->delete('postcategories/{postcategory}', [
        'as' => 'admin.post.postcategory.destroy',
        'uses' => 'PostcategoryController@destroy',
        'middleware' => 'can:post.postcategories.destroy'
    ]);
    $router->bind('managecategorys', function ($id) {
        return app('Modules\Post\Repositories\ManagecategorysRepository')->find($id);
    });
    $router->get('managecategorys', [
        'as' => 'admin.post.managecategorys.index',
        'uses' => 'ManagecategorysController@index',
        'middleware' => 'can:post.managecategorys.index'
    ]);
    $router->get('managecategorys/create', [
        'as' => 'admin.post.managecategorys.create',
        'uses' => 'ManagecategorysController@create',
        'middleware' => 'can:post.managecategorys.create'
    ]);
    $router->post('managecategorys', [
        'as' => 'admin.post.managecategorys.store',
        'uses' => 'ManagecategorysController@store',
        'middleware' => 'can:post.managecategorys.create'
    ]);
    $router->get('managecategorys/{managecategorys}/edit', [
        'as' => 'admin.post.managecategorys.edit',
        'uses' => 'ManagecategorysController@edit',
        'middleware' => 'can:post.managecategorys.edit'
    ]);
    $router->put('managecategorys/{managecategorys}', [
        'as' => 'admin.post.managecategorys.update',
        'uses' => 'ManagecategorysController@update',
        'middleware' => 'can:post.managecategorys.edit'
    ]);
    $router->delete('managecategorys/{managecategorys}', [
        'as' => 'admin.post.managecategorys.destroy',
        'uses' => 'ManagecategorysController@destroy',
        'middleware' => 'can:post.managecategorys.destroy'
    ]);
// append

    $router->post('managecategorys/addCategory', [
        'as' => 'admin.post.managecategorys.addCategory',
        'uses' => 'ManagecategorysController@addCategory'
    ]);

    $router->post('managecategorys/checkSlug', [
        'as' => 'admin.post.managecategorys.checkSlug',
        'uses' => 'ManagecategorysController@checkSlug'
    ]);

    $router->post('postcategories/checkSlug', [
        'as' => 'admin.post.postcategories.checkSlug',
        'uses' => 'PostcategoryController@checkSlug'
    ]);
});
