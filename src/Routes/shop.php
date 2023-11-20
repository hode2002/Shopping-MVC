<?php
$router->get('/shop', 'App\Controllers\ShopController@index');
$router->post('/shop', 'App\Controllers\ShopController@postOpen');

$router->get('/shop/products', 'App\Controllers\ShopController@getProducts');

$router->get('/shop/products/add', 'App\Controllers\ShopController@getAddProduct');
$router->post('/shop/products', 'App\Controllers\ShopController@postCreate');

$router->get('/shop/products/edit/(.*)', 'App\Controllers\ShopController@getEditProduct');

$router->get('/shop/orders', 'App\Controllers\ShopController@getOrders');
$router->get('/shop/orders/(\d+)', 'App\Controllers\ShopController@getOrders');

$router->get('/shop/transports', 'App\Controllers\ShopController@getTransports');
