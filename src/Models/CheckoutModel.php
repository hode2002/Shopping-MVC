<?php

namespace App\Models;

use PDO;

class CheckoutModel
{
    public function createOrder()
    {
        include SRC_DIR . '/config.php';
        $UserModel = new \App\Models\UserModel();
        $CartModel = new \App\Models\CartModel();

        $user = $UserModel->getByEmail($_SESSION['email']);
        $userId = $user['id'];

        $sql = "INSERT INTO don_hang(id_kh, dia_chi) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $user['dia_chi']]);

        $orderId = (int) $conn->lastInsertId();
        if ($stmt->rowCount() === 1) {
            $cartList = $CartModel->getList($userId);

            foreach ($cartList as $cartItem) {
                $bookId = $cartItem['id_sach'];

                $result = $this->createOrderDetail($orderId, $bookId, quantity: $cartItem['so_luong'], price: $cartItem['gia_sale']);
                if (!empty($result)) {
                    $CartModel->delete($userId, $bookId);
                }
            }

            $this->updateTotalPrice($orderId);

            return true;
        }

        return false;
    }

    private function createOrderDetail($orderId, $bookId, $quantity, $price)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO chi_tiet_don_hang(id_don_hang, id_sach, so_luong, gia) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$orderId, $bookId, $quantity, $price]);
        return $stmt->rowCount() === 1;
    }

    private function updateTotalPrice($orderId)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE don_hang 
        SET tong_tien = (
            SELECT sum(gia * so_luong)
            FROM chi_tiet_don_hang
            GROUP BY id_don_hang
            HAVING id_don_hang = ?
        ) 
        WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$orderId, $orderId]);
        return $stmt->rowCount() === 1;
    }

    public function getAllOrder($userId)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT id, trang_thai, tong_tien FROM don_hang WHERE id_kh = ? ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            return [];
        }

        $data = [];

        foreach ($results as $item) {
            $sql = "SELECT s.anh_bia, s.ten_sach, s.gia_goc, ctdh.gia, ctdh.so_luong
                    FROM don_hang dh JOIN chi_tiet_don_hang ctdh
                    ON dh.id = ctdh.id_don_hang
                    JOIN sach s ON s.id = ctdh.id_sach
                    WHERE dh.id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->execute([$item['id']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $arrTmp = [
                'id' => $item['id'],
                'status' => $item['trang_thai'],
                'total' => $item['tong_tien'],
                'books' => $result
            ];

            array_push($data, $arrTmp);
        }

        return $data;
    }

    public function getOrderByStatus($userId, $status)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT id, trang_thai, tong_tien FROM don_hang WHERE id_kh = ? AND trang_thai = ? ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $status]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            return [];
        }

        $data = [];

        foreach ($results as $item) {
            $sql = "SELECT s.anh_bia, s.ten_sach, s.gia_goc, ctdh.gia, ctdh.so_luong
                    FROM don_hang dh JOIN chi_tiet_don_hang ctdh
                    ON dh.id = ctdh.id_don_hang
                    JOIN sach s ON s.id = ctdh.id_sach
                    WHERE dh.id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->execute([$item['id']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $arrTmp = [
                'id' => $item['id'],
                'status' => $item['trang_thai'],
                'total' => $item['tong_tien'],
                'books' => $result
            ];

            array_push($data, $arrTmp);
        }

        return $data;
    }

    public function getOrdersInfo()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT dh.*, kh.ho_ten, kh.so_dien_thoai FROM don_hang dh JOIN khach_hang kh ON dh.id_kh = kh.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getOrderDetail($orderId)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT s.anh_bia, s.ten_sach, s.gia_goc, ctdh.id_sach, ctdh.gia, ctdh.so_luong, dh.trang_thai, dh.tong_tien
                FROM don_hang dh JOIN chi_tiet_don_hang ctdh
                ON dh.id = ctdh.id_don_hang
                JOIN sach s ON s.id = ctdh.id_sach
                WHERE dh.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$orderId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getById($id)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM don_hang WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function updateStatus($id, $status)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE don_hang SET trang_thai = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$status, $id]);

        return  $stmt->rowCount() === 1;
    }

    public function insertToCart($userId, $orders)
    {
        include SRC_DIR . '/config.php';

        foreach ($orders as $order) {
            $sql = "INSERT INTO gio_hang (id_sach, id_kh, so_luong) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$order['id_sach'], $userId, $order['so_luong']]);

            if ($stmt->rowCount() !== 1) {
                return false;
            }
        }

        return true;
    }
}
