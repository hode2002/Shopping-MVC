<?php

define('SRC_DIR', __DIR__ . '/../src');
define('VIEWS_DIR', __DIR__ . '/../src/Views');
define('UPLOAD_DIR', __DIR__ . '/uploads');
define('BASE_URL', 'http://ct271-project.localhost');

require_once SRC_DIR . '/bootstrap.php';

$router = new \Bramus\Router\Router();

require_once SRC_DIR . '/routes/auth.php';
require_once SRC_DIR . '/routes/cart.php';
require_once SRC_DIR . '/routes/admin.php';
require_once SRC_DIR . '/routes/profile.php';
require_once SRC_DIR . '/routes/product.php';
require_once SRC_DIR . '/routes/checkout.php';
require_once SRC_DIR . '/routes/contact.php';
require_once SRC_DIR . '/routes/delivery.php';
require_once SRC_DIR . '/routes/historySearch.php';

$router->get('/', function () {
    $title = 'Trang chủ';

    $UserModel = new \App\Models\UserModel();
    $CategoryModel = new \App\Models\CategoryModel();
    $ProductModel = new \App\Models\ProductModel();

    if (isset($_SESSION['email'])) {
        $user = $UserModel->getByEmail(email: $_SESSION['email']);
    }
    $categories = $CategoryModel->getAll();
    $products = $ProductModel->getAll();
    $recommends = $ProductModel->getRandom();
    $proSales = $ProductModel->getProSales();

    require_once VIEWS_DIR . '/home/index.php';
});

$router->run();
