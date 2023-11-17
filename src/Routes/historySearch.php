<?php

$router->get('/history-search', 'App\Controllers\HistorySearchController@getAll');

$router->post('/history-search', 'App\Controllers\HistorySearchController@postCreate');

$router->post('/history-search/delete/(\d+)', 'App\Controllers\HistorySearchController@postDelete');
