<?php
$router->get('/search', 'App\Controllers\ProductController@index');

$router->get('/product/(.*)', 'App\Controllers\ProductController@getDetail');
