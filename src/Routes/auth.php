<?php

$router->get('/login', 'App\Controllers\AuthController@getLogin');

$router->post('/login', 'App\Controllers\AuthController@postLogin');

$router->get('/register', 'App\Controllers\AuthController@getRegister');

$router->post('/register', 'App\Controllers\AuthController@postRegister');

$router->post('/logout', 'App\Controllers\AuthController@postLogout');

$router->get('/forget-pass', 'App\Controllers\AuthController@getForgetPass');

$router->post('/forget-pass', 'App\Controllers\AuthController@postForgetPass');
