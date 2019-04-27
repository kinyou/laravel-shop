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

    $router->get('faults', 'FaultController@index')->name('admin.fault.index');
    $router->get('faults/create', 'FaultController@create')->name('admin.fault.create');
    $router->post('faults', 'FaultController@store')->name('admin.fault.store');
    $router->get('faults/{id}', 'FaultController@show')->name('admin.fault.show');
    $router->get('faults/{id}/edit', 'FaultController@edit')->name('admin.fault.edit');
    $router->delete('faults/{id}', 'FaultController@destroy')->name('admin.fault.destroy');
    
    $router->get('analyses', 'AnalyseController@index')->name('admin.analyse.index');
    $router->get('logs', 'LogController@index')->name('admin.log.index');
});
