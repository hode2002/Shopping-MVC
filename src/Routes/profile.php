<?php

$router->get('/profile', 'App\Controllers\ProfileController@index');
$router->post('/profile', 'App\Controllers\ProfileController@postEditProfile');

$router->post('/profile/avatar', 'App\Controllers\ProfileController@postUpdateAvatar');

$router->get('/account/password', 'App\Controllers\ProfileController@getChangePassword');
$router->post('/account/password', 'App\Controllers\ProfileController@postChangePassword');

$router->get('/account/address', 'App\Controllers\ProfileController@getAddress');
$router->post('/account/address', 'App\Controllers\ProfileController@postAddress');

$router->get('/purchase', 'App\Controllers\ProfileController@getPurchase');
$router->post('/purchase', 'App\Controllers\ProfileController@postPurchase');
