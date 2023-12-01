<?php

$router->get('/admin', 'App\Controllers\AdminController@index');
$router->get('/admin/products', 'App\Controllers\AdminController@getProducts');
$router->get('/admin/users', 'App\Controllers\AdminController@getUsers');
$router->post('/admin/users', 'App\Controllers\AdminController@postDeleteUser');
$router->get('/admin/shops', 'App\Controllers\AdminController@getShops');

$router->post('/admin/products/approve', 'App\Controllers\AdminController@postProductApprove');
$router->post('/admin/shops/approve', 'App\Controllers\AdminController@postShopApprove');
