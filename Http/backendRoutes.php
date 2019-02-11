<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/departments'], function (Router $router) {
    $router->bind('departments', function ($id) {
        return app('Modules\Departments\Repositories\DepartmentsRepository')->find($id);
    });
    $router->get('departments', [
        'as' => 'admin.departments.departments.index',
        'uses' => 'DepartmentsController@index',
        'middleware' => 'can:departments.departments.index'
    ]);
    $router->get('departments/create', [
        'as' => 'admin.departments.departments.create',
        'uses' => 'DepartmentsController@create',
        'middleware' => 'can:departments.departments.create'
    ]);
    $router->post('departments', [
        'as' => 'admin.departments.departments.store',
        'uses' => 'DepartmentsController@store',
        'middleware' => 'can:departments.departments.create'
    ]);
    $router->get('departments/{departments}/edit', [
        'as' => 'admin.departments.departments.edit',
        'uses' => 'DepartmentsController@edit',
        'middleware' => 'can:departments.departments.edit'
    ]);
    $router->put('departments/{departments}', [
        'as' => 'admin.departments.departments.update',
        'uses' => 'DepartmentsController@update',
        'middleware' => 'can:departments.departments.edit'
    ]);
    $router->delete('departments/{departments}', [
        'as' => 'admin.departments.departments.destroy',
        'uses' => 'DepartmentsController@destroy',
        'middleware' => 'can:departments.departments.destroy'
    ]);
// append

});
