<?php

$router->get('/cart', 'App\Controllers\CartController@index');

$router->post('/cart', 'App\Controllers\CartController@postCreate');

$router->post('/cart/list', 'App\Controllers\CartController@getList');

$router->post('/cart/update/(.*)', 'App\Controllers\CartController@postUpdate');

$router->post('/cart/delete/(.*)', 'App\Controllers\CartController@postDelete');
