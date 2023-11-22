<?php

namespace App\Controllers;

class ShopController
{
    public function index()
    {
        try {
            require_once SRC_DIR . '/config.php';

            $UserModel = new \App\Models\UserModel();
            $ShopModel = new \App\Models\ShopModel();
            $OrderModel = new \App\Models\OrderModel();
            $ProductModel = new \App\Models\ProductModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            if (!(isAdmin() || isShop())) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $shop = $ShopModel->getByUserId($userId);
            $shopId = $shop['id'];

            $orderTotalPrice = $OrderModel->getTotalPriceByShopId($shopId);

            $products = $ProductModel->getAllByShopId($shopId);
            $productCount = count($products);

            $orderDelivery = $OrderModel->getByShopIdAndStatus($shopId, 1);
            $orderDeliveryCount = count($orderDelivery);

            $shopUsers = $UserModel->getAllByShopId($shopId);
            $userCount = count($shopUsers);

            $orders = $OrderModel->getByShopIdAndStatus($shopId, status: 0);

            require_once VIEWS_DIR . '/shop/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postOpen()
    {
        try {
            require_once SRC_DIR . '/config.php';
            if (!isset($_SESSION['email'])) {
                JsonResponse(error: 1, message: "Vui lòng đăng nhập để tiếp tục");
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $UserModel = new \App\Models\UserModel();
            $ShopModel = new \App\Models\ShopModel();

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $isExistStore = $ShopModel->getByUserId($userId);
            if (!empty($isExistStore)) {
                JsonResponse(error: 1, message: "Bạn đã mở shop rồi!");
            }

            $ShopModel->openStore($userId);
            $UserModel->updateRole($userId, roleCode: "R2");

            $_SESSION['role'] = 'R2';

            JsonResponse(error: 0, message: "Đăng ký mở shop thành công!");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getProducts()
    {
        try {
            require_once SRC_DIR . '/config.php';
            $UserModel = new \App\Models\UserModel();
            $ShopModel = new \App\Models\ShopModel();
            $ProductModel = new \App\Models\ProductModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            if (!(isAdmin() || isShop())) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $shop = $ShopModel->getByUserId($userId);
            $shopId = $shop['id'];

            $products = $ProductModel->getAllByShopId($shopId);

            require_once VIEWS_DIR . '/shop/product/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAddProduct()
    {
        try {
            require_once SRC_DIR . '/config.php';
            $UserModel = new \App\Models\UserModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            if (!(isAdmin() || isShop())) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $user = $UserModel->getByEmail($email);

            require_once VIEWS_DIR . '/shop/product/add/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postCreate()
    {
        try {
            if (!(isAdmin() || isShop())) {
                $title = 'Lỗi';
                JsonResponse(error: 3, message: "Bạn không có quyền thực hiện chức năng này!");
            };

            require_once SRC_DIR . '/config.php';
            $ProductModel = new \App\Models\ProductModel();
            $UserModel = new \App\Models\UserModel();
            $ShopModel = new \App\Models\ShopModel();

            $email = $_SESSION['email'];
            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $shop = $ShopModel->getByUserId($userId);
            $shopId = $shop['id'];

            if (!isset($_POST['product'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập thông tin sản phẩm");
            }
            $product = json_decode($_POST['product'], true);

            if (!isset($product['id'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập mã sản phẩm");
            }

            $isExist = $ProductModel->getByIdAndShopId($product['id'], $shopId);
            if (!empty($isExist)) {
                JsonResponse(error: 1, message: "Sản phẩm đã tồn tại");
            }

            if (!isset($product['name'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập tên sản phẩm");
            }

            if (!isset($product['price'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập giá bán");
            }

            if (!isset($product['sale'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập sale");
            }

            if (!isset($product['category'])) {
                JsonResponse(error: 1, message: "Vui lòng chọn danh mục sản phẩm");
            }

            if (!isset($product['description'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập mô tả sản phẩm");
            }

            $img = handle_img_upload('img');
            if (!isset($img)) {
                JsonResponse(error: 1, message: "Lỗi hình ảnh");
            }
            $product['img'] = $img;

            $imgs = handle_img_upload('imgs', isMultiple: true);
            if (!isset($imgs)) {
                JsonResponse(error: 1, message: "Lỗi ảnh hình ảnh khác");
            }
            $product['imgs'] = $imgs;

            $isSuccess = $ProductModel->create($shopId, $product);
            if (!isset($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Thêm thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getEditProduct($id)
    {
        try {
            require_once SRC_DIR . '/config.php';
            $UserModel = new \App\Models\UserModel();
            $ProductModel = new \App\Models\ProductModel();
            $ShopModel = new \App\Models\ShopModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $shop = $ShopModel->getByUserId($userId);
            $shopId = $shop['id'];

            if (!(isAdmin() || isShop())) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $product = $ProductModel->getByIdAndShopId($id, $shopId);

            require_once VIEWS_DIR . '/shop/product/edit/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postEditProduct()
    {
        try {
            if (!(isAdmin() || isShop())) {
                $title = 'Lỗi';
                JsonResponse(error: 3, message: "Bạn không có quyền thực hiện chức năng này!");
            };

            require_once SRC_DIR . '/config.php';
            $ProductModel = new \App\Models\ProductModel();
            $UserModel = new \App\Models\UserModel();
            $ShopModel = new \App\Models\ShopModel();

            $email = $_SESSION['email'];
            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $shop = $ShopModel->getByUserId($userId);
            $shopId = $shop['id'];

            if (!isset($_POST['product'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập thông tin sản phẩm");
            }
            $product = json_decode($_POST['product'], true);

            if (!isset($product['id'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập mã sản phẩm");
            }

            if (!isset($product['name'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập tên sản phẩm");
            }

            if (!isset($product['price'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập giá bán");
            }

            if (!isset($product['sale'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập sale");
            }

            if (!isset($product['category'])) {
                JsonResponse(error: 1, message: "Vui lòng chọn danh mục sản phẩm");
            }

            if (!isset($product['description'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập mô tả sản phẩm");
            }

            $oldProduct = $ProductModel->getByIdAndShopId($product['id'], $shopId);

            $img = handle_img_upload('img');
            if (empty($img)) {
                $fileName = extractFileNameFromUrl($oldProduct['thumbnail']);
                $product['thumbnail'] = $fileName;
            } else {
                $product['thumbnail'] = $img;
                $fileName = extractFileNameFromUrl($oldProduct['thumbnail']);
                remove_img_file($fileName);
            }

            $imgs = handle_img_upload('imgs', isMultiple: true);
            if (!empty($imgs)) {
                foreach ($oldProduct['imgs'] as $item) {
                    $fileName = extractFileNameFromUrl($item['image_url']);
                    remove_img_file($fileName);
                }
                $ProductModel->deleteImgs($product['id']);
                $product['imgs'] = $imgs;
            }

            $isSuccess = $ProductModel->update($product, $shopId);
            if (!isset($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Cập nhật thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postDeleteProduct()
    {
        try {
            if (!(isAdmin() || isShop())) {
                $title = 'Lỗi';
                JsonResponse(error: 3, message: "Bạn không có quyền thực hiện chức năng này!");
            };
            require_once SRC_DIR . '/config.php';
            $ProductModel = new \App\Models\ProductModel();
            $UserModel = new \App\Models\UserModel();
            $ShopModel = new \App\Models\ShopModel();

            $email = $_SESSION['email'];
            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $shop = $ShopModel->getByUserId($userId);
            $shopId = $shop['id'];

            if (!isset($_POST['id'])) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra, Vui lòng thử lại sau");
            }
            $id = htmlspecialchars($_POST['id']);

            $product = $ProductModel->getByIdAndShopId($id, $shopId);
            if (empty($product)) {
                JsonResponse(error: 1, message: "Sản phẩm không tồn tại hoặc đã bị xóa");
            }

            foreach ($product['imgs'] as $item) {
                $fileName = extractFileNameFromUrl($item['image_url']);
                remove_img_file($fileName);
            }

            $isSuccess = $ProductModel->delete($id, $shopId);

            $fileName = extractFileNameFromUrl($product['thumbnail']);
            if ($isSuccess && empty($fileName)) {
                JsonResponse(error: 1, message: "Xóa sản phẩm thành công");
            }
            remove_img_file($fileName);

            if (!$isSuccess) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau.");
            }

            JsonResponse(error: 0, message: "Xóa sản phẩm thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOrders()
    {
        try {
            require_once SRC_DIR . '/config.php';
            $UserModel = new \App\Models\UserModel();
            $ShopModel = new \App\Models\ShopModel();
            $OrderModel = new \App\Models\OrderModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            if (!(isAdmin() || isShop())) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $shop =  $ShopModel->getByUserId($userId);
            $shopId = $shop['id'];

            $orders = $OrderModel->getByShopId($shopId);

            require_once VIEWS_DIR . '/shop/order/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOrderDetail($id)
    {
        try {
            require_once SRC_DIR . '/config.php';
            $UserModel = new \App\Models\UserModel();
            $OrderModel = new \App\Models\OrderModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);

            if (!(isAdmin() || isShop())) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $orders = $OrderModel->getOrderDetail($id);

            require_once VIEWS_DIR . '/shop/order/detail/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postUpdateOrderStatus()
    {
        try {
            require_once SRC_DIR . '/config.php';
            $UserModel = new \App\Models\UserModel();
            $OrderModel = new \App\Models\OrderModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);

            if (!(isAdmin() || isShop())) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            if (!isset($_POST['id'])) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra, Vui lòng thử lại sau");
            }
            $id = htmlspecialchars($_POST['id']);

            if (!isset($_POST['status'])) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra, Vui lòng thử lại sau");
            }
            $status = htmlspecialchars($_POST['status']);

            $isSuccess = $OrderModel->updateStatus($id, $status);
            if (empty($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra, Vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Cập nhật thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getTransports()
    {
        try {
            require_once SRC_DIR . '/config.php';
            $UserModel = new \App\Models\UserModel();
            $OrderModel = new \App\Models\OrderModel();
            $ShopModel = new \App\Models\ShopModel();

            if (!isset($_SESSION['email'])) {
                redirect('/login');
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            if (!(isAdmin() || isShop())) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            $shop =  $ShopModel->getByUserId($userId);
            $shopId = $shop['id'];

            $orders = $OrderModel->getByShopIdAndStatus($shopId, 1);

            require_once VIEWS_DIR . '/shop/transport/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
