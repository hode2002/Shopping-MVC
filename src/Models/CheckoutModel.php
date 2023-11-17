<?php

namespace App\Models;

use PDO;

class CheckoutModel
{
    public function createOrder($userId, $name, $address, $phone, $note, $checkout_products, $delivery)
    {
        include SRC_DIR . '/config.php';
        $CartModel = new \App\Models\CartModel();

        $sql = "INSERT INTO orders(user_id, name, phone, address, note, delivery_id, delivery_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $name, $phone, $address, $note, $delivery['id'], $delivery['estimateDate']]);

        $orderId = (int) $conn->lastInsertId();
        if ($stmt->rowCount() === 1) {

            foreach ($checkout_products as $product) {
                $productId = $product['id'];

                $result = $this->createOrderDetail($orderId, $productId, $product['quantity'], $product['price']);
                if (!empty($result)) {
                    $CartModel->delete($userId, $productId);
                }
            }

            $this->updateTotalPrice($orderId);

            return true;
        }

        return false;
    }

    private function createOrderDetail($orderId, $productId, $quantity, $price)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO order_detail (order_id, product_id, quantity, price, total) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$orderId, $productId, $quantity, $price, (int)$quantity * (int)$price]);
        return $stmt->rowCount() === 1;
    }

    private function updateTotalPrice($orderId)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE orders
                SET total = (
                    SELECT SUM(d.total)
                    FROM order_detail d
                    WHERE d.order_id = ?
                    GROUP BY d.order_id
                ) + (
                    SELECT charge_amount
                    FROM delivery
                    WHERE id = (SELECT delivery_id FROM orders WHERE id = ?)
                )
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$orderId, $orderId, $orderId]);
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
