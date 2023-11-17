<?php

namespace App\Controllers;

class ProfileController
{
    public function index()
    {
        try {
            if (!isAuthentication()) {
                redirect('/login');
            }
            $UserModel = new \App\Models\UserModel();
            $user = $UserModel->getByEmail($_SESSION['email']);
            $title = 'Thông Tin Tài Khoản';
            require_once VIEWS_DIR . '/account/profile/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postEditProfile()
    {
        $UserModel = new \App\Models\UserModel();
        // $profile = json_decode($_POST['profile'], true);

        $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
        if (empty($id)) {
            JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
        }

        $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
        $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
        $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
        $gender = $gender === 'male' ? 1 : 0;
        $dob = isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : '';

        $UserModel->updateProfile($id, $name, $phone, $gender, $dob);

        JsonResponse(error: 0, message: "Cập nhật thông tin thành công");
    }

    public function postUpdateAvatar()
    {
        try {
            $UserModel = new \App\Models\UserModel();
            $user = $UserModel->getByEmail($_SESSION['email']);

            $avatar = handle_img_upload('avatar');
            if (empty($avatar)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }

            $fileName = extractFileNameFromUrl($user['avatar']);
            if (!str_contains($fileName, 'default.jpg')) {
                remove_img_file($fileName);
            }

            $isSuccess = $UserModel->updateAvatar($user['id'], $avatar);
            if (empty($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Cập nhật ảnh dại diện thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getChangePassword()
    {
        try {
            if (!isAuthentication()) {
                redirect('/login');
            }
            $UserModel = new \App\Models\UserModel();
            $user = $UserModel->getByEmail($_SESSION['email']);

            $title = 'Đổi Mật Khẩu';
            require_once VIEWS_DIR . '/account/password/change-pass.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postChangePassword()
    {
        try {
            require_once SRC_DIR . '/config.php';
            $UserModel = new \App\Models\UserModel();

            if (!isset($_POST['old_password'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập mật khẩu cũ");
            }
            $old_password = htmlspecialchars($_POST['old_password']);

            if (!isset($_POST['new_password'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập mật khẩu mới");
            }
            $new_password = htmlspecialchars($_POST['new_password']);

            $email = $_SESSION['email'];
            $user = $UserModel->getInfo($email, $old_password);
            if (empty($user)) {
                JsonResponse(error: 1, message: "Mật khẩu cũ không chính xác");
            }

            $user = $UserModel->updatePass($email, $new_password);

            JsonResponse(error: 0, message: "Đổi mật khẩu thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAddress()
    {
        try {
            if (!isAuthentication()) {
                redirect('/login');
            }

            $UserModel = new \App\Models\UserModel();
            $user = $UserModel->getByEmail($_SESSION['email']);

            $title = 'Địa chỉ';
            require_once VIEWS_DIR . '/account/address/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postAddress()
    {
        try {
            require_once SRC_DIR . '/config.php';
            $UserModel = new \App\Models\UserModel();
            if (!isset($_SESSION['email'])) {
                JsonResponse(error: 1, message: "Đăng nhập để tiếp tục");
            }
            $email = $_SESSION['email'];

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            if (!isset($_POST['address'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập địa chỉ");
            }
            $address = htmlspecialchars($_POST['address']);

            $isSuccess = $UserModel->updateAddress($userId, $address);
            if (empty($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra, vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Cập nhật địa chỉ thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getPurchase()
    {
        try {
            if (!isAuthentication()) {
                redirect('/login');
            }
            $UserModel = new \App\Models\UserModel();
            $user = $UserModel->getByEmail($_SESSION['email']);

            $title = 'Đơn mua';
            require_once VIEWS_DIR . '/user/purchase/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postPurchase()
    {
        try {
            if (!isAuthentication()) {
                JsonResponse(error: 1, message: "Vui lòng đăng nhập để tiếp tục");
            }

            $CheckoutModel = new \App\Models\CheckoutModel();
            $UserModel = new \App\Models\UserModel();

            $user = $UserModel->getByEmail($_SESSION["email"]);
            $userId = $user['id'];

            if (!isset($_POST['status'])) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! Vui lòng thử lại");
            }

            $status = htmlspecialchars($_POST['status']);
            if ((int)$status === 3) {
                $orders = $CheckoutModel->getAllOrder($userId);
                echo json_encode($orders);
                exit;
            }

            $orders = $CheckoutModel->getOrderByStatus($userId, $status);
            echo json_encode($orders);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
