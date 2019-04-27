<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('equipments', 'EquipmentController@index')->name('admin.equipment.index');
    $router->get('equipments/create', 'EquipmentController@create')->name('admin.equipment.create');
    $router->post('equipments', 'EquipmentController@store')->name('admin.equipment.store');
    $router->get('equipments/{id}', 'EquipmentController@show')->name('admin.equipment.show');
    $router->get('equipments/{id}/edit', 'EquipmentController@edit')->name('admin.equipment.edit');
    $router->delete('equipments/{id}', 'EquipmentController@destroy')->name('admin.equipment.destroy');

});
