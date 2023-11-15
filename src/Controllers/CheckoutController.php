<?php

namespace App\Controllers;

class CheckoutController
{
    public function index()
    {
        try {
            if (!isAuthentication()) {
                redirect('/login');
            }

            $UserModel = new \App\Models\UserModel();
            $CartModel = new \App\Models\CartModel();

            $user = $UserModel->getByEmail($_SESSION['email']);
            $cartList = $CartModel->getList($user['id']);

            $title = 'Thanh Toán';
            require_once VIEWS_DIR . '/checkout/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function create()
    {
        try {
            $UserModel = new \App\Models\UserModel();
            $CartModel =  new \App\Models\CartModel();
            $CheckoutModel = new \App\Models\CheckoutModel();

            $user = $UserModel->getByEmail($_SESSION['email']);
            $userId = $user['id'];

            $cartList = $CartModel->getList($userId);
            if (empty($cartList)) {
                JsonResponse(error: 1, message: "Giỏ hàng trống");
            }

            if (!isset($_POST['userInfo'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập thông tin khách hàng");
            }
            $userCheckoutInfo = json_decode($_POST['userInfo'], true);

            if (!isset($userCheckoutInfo['name'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập họ tên");
            }
            $name = htmlspecialchars($userCheckoutInfo['name']);

            if (!isset($userCheckoutInfo['address'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập địa chỉ");
            }
            $address = htmlspecialchars($userCheckoutInfo['address']);

            if (!isset($userCheckoutInfo['phone'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập số điện thoại");
            }
            $phone = htmlspecialchars($userCheckoutInfo['phone']);

            $UserModel->updateProfile($userId, $name, $phone, $address);

            $isSuccess = $CheckoutModel->createOrder();

            if (empty($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! Vui lòng thử lại sau");
            }
            JsonResponse(error: 0, message: "Đặt hàng thành công");

            require_once VIEWS_DIR . '/checkout/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postOrderCancel()
    {
        try {
            if (!isset($_POST['id']) || !isset($_POST['status'])) {
                JsonResponse(error: 1, message: "Thiếu thông tin");
            }
            $id = htmlspecialchars($_POST['id']);
            $status = htmlspecialchars($_POST['status']);

            if ((int)$status !== 2) {
                JsonResponse(error: 1, message: "Không thể thực hiện");
            }

            $CheckoutModel = new \App\Models\CheckoutModel();

            $order = $CheckoutModel->getById($id);
            if (empty($order)) {
                JsonResponse(error: 1, message: "Đơn hàng không tồn tại, Vui lòng kiểm tra lại");
            }

            $isSuccess = $CheckoutModel->updateStatus($id, $status);

            if (!$isSuccess) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau.");
            }

            JsonResponse(error: 0, message: "Hủy thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postOrderBuyAgain()
    {
        try {
            if (!isset($_SESSION['email'])) {
                JsonResponse(error: 1, message: "Vui lòng đăng nhập để tiếp tục");
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $CheckoutModel = new \App\Models\CheckoutModel();
            $UserModel = new \App\Models\UserModel();

            $user = $UserModel->getByEmail($email);

            if (!isset($_POST['id'])) {
                JsonResponse(error: 1, message: "Thiếu thông tin");
            }
            $id = htmlspecialchars($_POST['id']);

            $orders = $CheckoutModel->getOrderDetail($id);
            if (empty($orders)) {
                JsonResponse(error: 1, message: "Đơn hàng không tồn tại, Vui lòng kiểm tra lại");
            }

            $isSuccess = $CheckoutModel->insertToCart($user['id'], $orders);

            if (!$isSuccess) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau.");
            }

            JsonResponse(error: 0, message: "Thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
