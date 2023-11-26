<?php

namespace App\Controllers;

class AdminController
{
    public function index()
    {
        try {
            require_once SRC_DIR . '/config.php';

            $UserModel = new \App\Models\UserModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);

            if (!isAdmin()) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $title = 'Admin';

            $ProductModel = new \App\Models\ProductModel();
            $ContactModel = new \App\Models\ContactModel();
            $OrderModel = new \App\Models\OrderModel();
            $ShopModel = new \App\Models\ShopModel();

            $allUsers = $UserModel->getAllUsers();
            $countUser = count($allUsers);

            $allOrders = $OrderModel->getAllByAdmin();
            $countOrder = count($allOrders);

            $allOrderCancel = $OrderModel->getByStatus(status: 2);
            $countOrderCancel = count($allOrderCancel);

            $allShops = $ShopModel->getByStatus(status: 1);
            $countShop = count($allShops);

            $allRegisterShop = $ShopModel->getByStatus(status: 0);

            $allProducts = $ProductModel->getByStatus(status: 1);
            $countProduct = count($allProducts);

            $allPostProducts = $ProductModel->getByStatus(status: 0);
            $countPostProduct = count($allPostProducts);

            $productsDelivery = $OrderModel->getByStatus(status: 1);
            $countProductsDelivery = count($productsDelivery);

            $allContacts = $ContactModel->getAll();
            $countContact = count($allContacts);

            require_once VIEWS_DIR . '/admin/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUsers()
    {
        try {
            require_once SRC_DIR . '/config.php';

            $UserModel = new \App\Models\UserModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);

            if (!isAdmin()) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $title = 'Admin | Danh sách sản phẩm';

            $allUsers = $UserModel->getAllUsers();

            require_once VIEWS_DIR . '/admin/user/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getProducts()
    {
        try {
            require_once SRC_DIR . '/config.php';

            $UserModel = new \App\Models\UserModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);

            if (!isAdmin()) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $title = 'Admin || Danh sách sản phẩm';

            $ProductModel = new \App\Models\ProductModel();

            $allProducts = $ProductModel->getAllUnLimit();

            require_once VIEWS_DIR . '/admin/product/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getShops()
    {
        try {
            require_once SRC_DIR . '/config.php';

            $UserModel = new \App\Models\UserModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);

            if (!isAdmin()) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $title = 'Admin || Danh sách cửa hàng';

            $ShopModel = new \App\Models\ShopModel();

            $allShops = $ShopModel->getAll();

            require_once VIEWS_DIR . '/admin/shop/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postProductApprove()
    {
        try {
            require_once SRC_DIR . '/config.php';

            $UserModel = new \App\Models\UserModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);

            if (!isAdmin()) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $ProductModel = new \App\Models\ProductModel();

            if (!isset($_POST['productId'])) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }
            $productId = htmlspecialchars($_POST['productId']);

            if (!isset($_POST['shopId'])) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }
            $shopId = htmlspecialchars($_POST['shopId']);

            if (!isset($_POST['status'])) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }
            $status = htmlspecialchars($_POST['status']);

            $isSuccess = $ProductModel->updateStatus($shopId, $productId, $status);
            if (!isset($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Cập nhật thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postShopApprove()
    {
        try {
            require_once SRC_DIR . '/config.php';

            $UserModel = new \App\Models\UserModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);

            if (!isAdmin()) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $ShopModel = new \App\Models\ShopModel();

            if (!isset($_POST['shopId'])) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }
            $shopId = htmlspecialchars($_POST['shopId']);

            if (!isset($_POST['status'])) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }
            $status = htmlspecialchars($_POST['status']);

            $isSuccess = $ShopModel->updateStatus($shopId, $status);
            if (!isset($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
