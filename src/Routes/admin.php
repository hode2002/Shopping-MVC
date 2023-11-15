<?php

$router->get('/admin', 'App\Controllers\AdminController@index');

$router->get('/admin/add', 'App\Controllers\AdminController@getAdd');
$router->post('/admin/add', 'App\Controllers\AdminController@postAdd');

$router->get('/admin/edit/(\d+)', 'App\Controllers\AdminController@getEdit');
$router->post('/admin/edit', 'App\Controllers\AdminController@postEdit');

$router->post('/admin/delete/(\d+)', 'App\Controllers\AdminController@postDelete');

$router->get('/admin/order', 'App\Controllers\AdminController@getOrder');
$router->get('/admin/order/(\d+)', 'App\Controllers\AdminController@getOrderDetail');
$router->post('/admin/order/update', 'App\Controllers\AdminController@postOrderUpdate');
