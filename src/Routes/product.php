<?php
$router->get('/product', 'App\Controllers\ProductController@index');

$router->get('/product/(.*)', 'App\Controllers\ProductController@getDetail');

$router->get('/product/search', 'App\Controllers\ProductController@getSearch');
