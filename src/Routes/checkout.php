<?php

$router->get('/checkout', 'App\Controllers\OrderController@index');

$router->post('/checkout', 'App\Controllers\OrderController@create');

$router->post('/checkout/cancel', 'App\Controllers\OrderController@postOrderCancel');

$router->post('/checkout/buy_again', 'App\Controllers\OrderController@postOrderBuyAgain');

$router->post('/checkout/confirm', 'App\Controllers\OrderController@postOrderConfirm');
