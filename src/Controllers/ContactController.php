<?php

namespace App\Controllers;

class ContactController
{
    public function index()
    {
        $UserModel = new \App\Models\UserModel();
        $title = 'Liên hệ';

        if (isset($_SESSION['email'])) {
            $user = $UserModel->getByEmail($_SESSION['email']);
        }

        require_once VIEWS_DIR . '/contact/index.php';
    }

    public function create()
    {
        try {
            $ContactModel = new \App\Models\ContactModel();
            if (!isset($_POST['email'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập email");
            }
            $email = htmlspecialchars($_POST['email']);

            if (!isset($_POST['name'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập họ tên");
            }
            $name = htmlspecialchars($_POST['name']);

            if (!isset($_POST['phone'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập số điện thoại");
            }
            $phone = htmlspecialchars($_POST['phone']);

            if (!isset($_POST['content'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập nội dung");
            }
            $content = htmlspecialchars($_POST['content']);

            $isSuccess = $ContactModel->create($email, $name, $phone, $content);

            if (empty($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! Vui lòng thử lại sau");
            }
            JsonResponse(error: 0, message: "Đã gửi phản hồi");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
