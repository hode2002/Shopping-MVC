<?php

$router->get('/contact', 'App\Controllers\ContactController@index');

$router->post('/contact', 'App\Controllers\ContactController@create');
