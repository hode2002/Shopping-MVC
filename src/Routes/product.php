<?php
$router->get('/search', 'App\Controllers\ProductController@index');

$router->get('/product/(.*)', 'App\Controllers\ProductController@getDetail');

$router->post('/products/comment', 'App\Controllers\ProductController@postCommentCreate');

$router->post('/products/comment/delete', 'App\Controllers\ProductController@postCommentDelete');

$router->post('/products/comment/update', 'App\Controllers\ProductController@postCommentUpdate');
