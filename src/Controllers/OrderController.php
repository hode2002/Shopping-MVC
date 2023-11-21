<?php

namespace App\Controllers;

class OrderController
{
    public function index()
    {
        try {
            if (!isAuthentication()) {
                redirect('/login');
            }
            $title = 'Thanh Toán';

            $UserModel = new \App\Models\UserModel();
            $DeliveryModel = new \App\Models\DeliveryModel();

            $user = $UserModel->getByEmail($_SESSION['email']);

            $delivery = $DeliveryModel->getAll();

            require_once VIEWS_DIR . '/checkout/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function create()
    {
        try {
            $UserModel = new \App\Models\UserModel();
            $OrderModel = new \App\Models\OrderModel();

            $user = $UserModel->getByEmail($_SESSION['email']);
            $userId = $user['id'];

            if (!isset($_POST['checkout_products'])) {
                JsonResponse(error: 1, message: "Chưa chọn sản phẩm");
            }
            $checkout_products = json_decode($_POST['checkout_products'], true);

            if (!isset($_POST['userInfo'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập thông tin khách hàng");
            }
            $userCheckoutInfo = json_decode($_POST['userInfo'], true);

            if (!isset($_POST['delivery'])) {
                JsonResponse(error: 1, message: "Chưa chọn đơn vị vận chuyển");
            }
            $delivery = json_decode($_POST['delivery'], true);

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

            $note = htmlspecialchars($userCheckoutInfo['note']) ?? "";

            $isSuccess = $OrderModel->createOrder($userId, $name, $address, $phone, $note, $checkout_products, $delivery);

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

            $OrderModel = new \App\Models\OrderModel();

            $order = $OrderModel->getById($id);
            if (empty($order)) {
                JsonResponse(error: 1, message: "Đơn hàng không tồn tại, Vui lòng kiểm tra lại");
            }

            $isSuccess = $OrderModel->updateStatus($id, $status);

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

            $OrderModel = new \App\Models\OrderModel();
            $UserModel = new \App\Models\UserModel();

            $user = $UserModel->getByEmail($email);

            if (!isset($_POST['id'])) {
                JsonResponse(error: 1, message: "Thiếu thông tin");
            }
            $id = htmlspecialchars($_POST['id']);

            $orders = $OrderModel->getOrderDetail($id);
            if (empty($orders)) {
                JsonResponse(error: 1, message: "Đơn hàng không tồn tại, Vui lòng kiểm tra lại");
            }

            $isSuccess = $OrderModel->insertToCart($user['id'], $orders);

            if (!$isSuccess) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau.");
            }

            JsonResponse(error: 0, message: "Thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postOrderConfirm()
    {
        try {
            if (!isset($_SESSION['email'])) {
                JsonResponse(error: 1, message: "Vui lòng đăng nhập để tiếp tục");
            }
            $OrderModel = new \App\Models\OrderModel();

            if (!isset($_POST['id'])) {
                JsonResponse(error: 1, message: "Thiếu thông tin");
            }
            $orderId = htmlspecialchars($_POST['id']);

            $orders = $OrderModel->getOrderDetail($orderId);
            if (empty($orders)) {
                JsonResponse(error: 1, message: "Đơn hàng không tồn tại, Vui lòng kiểm tra lại");
            }

            $isSuccess = $OrderModel->updateStatus($orderId, 3);

            if (!$isSuccess) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau.");
            }

            JsonResponse(error: 0, message: "Cảm ơn bạn đã mua hàng");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
