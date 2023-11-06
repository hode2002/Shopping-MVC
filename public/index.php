<?php

define('SRC_DIR', __DIR__ . '/../src');
define('VIEWS_DIR', __DIR__ . '/../src/Views');
define('UPLOAD_DIR', __DIR__ . '/uploads');
define('BASE_URL', 'http://ct271-project.localhost');

require_once SRC_DIR . '/bootstrap.php';

$router = new \Bramus\Router\Router();

$router->get('/', function () {
    require_once VIEWS_DIR . '/home/index.html';
});

$router->get('/login', function () {
    require_once VIEWS_DIR . '/login/index.html';
});

$router->get('/register', function () {
    require_once VIEWS_DIR . '/register/index.html';
});

$router->get('/profile', function () {
    require_once VIEWS_DIR . '/account/profile/index.html';
});

$router->get('/password', function () {
    require_once VIEWS_DIR . '/account/password/index.html';
});

$router->get('/address', function () {
    require_once VIEWS_DIR . '/account/address/index.html';
});

$router->get('/cart', function () {
    require_once VIEWS_DIR . '/cart/index.html';
});

$router->get('/contact', function () {
    require_once VIEWS_DIR . '/contact/index.html';
});

$router->run();
