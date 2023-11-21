<?php
$router->get('/shop', 'App\Controllers\ShopController@index');
$router->post('/shop', 'App\Controllers\ShopController@postOpen');

$router->get('/shop/products', 'App\Controllers\ShopController@getProducts');
$router->get('/shop/products/add', 'App\Controllers\ShopController@getAddProduct');
$router->post('/shop/products', 'App\Controllers\ShopController@postCreate');
$router->get('/shop/products/edit/(.*)', 'App\Controllers\ShopController@getEditProduct');
$router->post('/shop/product/edit', 'App\Controllers\ShopController@postEditProduct');
$router->post('/shop/product/delete', 'App\Controllers\ShopController@postDeleteProduct');

$router->get('/shop/orders', 'App\Controllers\ShopController@getOrders');
$router->get('/shop/orders/(\d+)', 'App\Controllers\ShopController@getOrderDetail');
$router->post('/shop/orders/edit', 'App\Controllers\ShopController@postUpdateOrderStatus');

$router->get('/shop/transports', 'App\Controllers\ShopController@getTransports');
