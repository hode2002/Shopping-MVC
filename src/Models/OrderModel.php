<?php

namespace App\Models;

use PDO;

class OrderModel
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

    public function getAllByUserId($userId)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT o.id, o.status, o.total, s.name shop_name, s.id shop_id
                FROM orders o
                JOIN order_detail o_detail
                JOIN products p ON p.id = o_detail.product_id
                JOIN shops s ON s.id = p.shop_id
                WHERE o.user_id = ?
                GROUP BY o.id
                ORDER BY o.id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            return [];
        }

        $data = [];

        foreach ($results as $item) {
            $sql = "SELECT p.id, p.thumbnail, p.name, p.price origin_price, p.sale, o_detail.price, o_detail.quantity, s.name shop_name, s.id shop_id
                    FROM orders o JOIN order_detail o_detail
                    ON o.id = o_detail.order_id
                    JOIN products p ON p.id = o_detail.product_id
                    JOIN shops s ON s.id = p.shop_id
                    WHERE o.id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->execute([$item['id']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $arrTmp = [
                'id' => $item['id'],
                'status' => $item['status'],
                'total' => $item['total'],
                'products' => $result
            ];

            array_push($data, $arrTmp);
        }

        return $data;
    }

    public function getByUserIdAndStatus($userId, $status)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT o.id, o.status, o.total, s.name shop_name, s.id shop_id
                FROM orders o
                JOIN order_detail o_detail
                JOIN products p ON p.id = o_detail.product_id
                JOIN shops s ON s.id = p.shop_id
                WHERE o.user_id = ? AND o.status = ?
                GROUP BY o.id
                ORDER BY o.id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $status]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            return [];
        }

        $data = [];

        foreach ($results as $item) {
            $sql = "SELECT p.id, p.thumbnail, p.name, p.price origin_price, p.sale, o_detail.price, o_detail.quantity, s.name shop_name, s.id shop_id
                    FROM orders o JOIN order_detail o_detail
                    ON o.id = o_detail.order_id
                    JOIN products p ON p.id = o_detail.product_id
                    JOIN shops s ON s.id = p.shop_id
                    WHERE o.id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->execute([$item['id']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $arrTmp = [
                'id' => $item['id'],
                'status' => $item['status'],
                'total' => $item['total'],
                'products' => $result
            ];

            array_push($data, $arrTmp);
        }

        return $data;
    }

    public function getAllByAdmin()
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT id, status, total FROM orders ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            return [];
        }

        $data = [];

        foreach ($results as $item) {
            $sql = "SELECT p.id, p.thumbnail, p.name, p.price origin_price, p.sale, o_detail.price, o_detail.quantity, s.name shop_name
                    FROM orders o JOIN order_detail o_detail
                    ON o.id = o_detail.order_id
                    JOIN products p ON p.id = o_detail.product_id
                    JOIN shops s ON s.id = p.shop_id
                    WHERE o.id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->execute([$item['id']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $arrTmp = [
                'id' => $item['id'],
                'status' => $item['status'],
                'total' => $item['total'],
                'products' => $result
            ];

            array_push($data, $arrTmp);
        }

        return $data;
    }

    public function getByStatus($status)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT id, status, total FROM orders WHERE status = ? ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$status]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            return [];
        }

        $data = [];

        foreach ($results as $item) {
            $sql = "SELECT p.id, p.thumbnail, p.name, p.price origin_price, p.sale, o_detail.price, o_detail.quantity, s.name shop_name
                    FROM orders o JOIN order_detail o_detail
                    ON o.id = o_detail.order_id
                    JOIN products p ON p.id = o_detail.product_id
                    JOIN shops s ON s.id = p.shop_id
                    WHERE o.id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->execute([$item['id']]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $arrTmp = [
                'id' => $item['id'],
                'status' => $item['status'],
                'total' => $item['total'],
                'products' => $result
            ];

            array_push($data, $arrTmp);
        }

        return $data;
    }

    public function getProductsOrder($orderId)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT p.id, p.thumbnail, p.name, p.price origin_price, p.sale, o_detail.price, o_detail.quantity, s.name shop_name
                FROM orders o 
                JOIN order_detail o_detail
                ON o.id = o_detail.order_id
                JOIN products p ON p.id = o_detail.product_id
                JOIN shops s ON s.id = p.shop_id
                WHERE o.id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$orderId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getOrderDetail($orderId)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT  p.thumbnail, p.name, p.price origin_price, p.sale, o_detail.product_id, 
                        o_detail.price, o_detail.quantity, o.status, o.total, o.id order_id, 
                        d.id delivery_id, d.name delivery_name, d.charge_amount delivery_amount
                FROM orders o 
                JOIN order_detail o_detail
                ON o.id = o_detail.order_id
                JOIN products p ON p.id = o_detail.product_id
                JOIN delivery d ON d.id = o.delivery_id
                WHERE o.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$orderId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getTotalPriceByShopId($shopId)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT SUM(o.total) order_total_price
                FROM orders o 
                JOIN order_detail o_detail
                ON o_detail.order_id = o.id
                JOIN products p ON o_detail.product_id = p.id
                WHERE p.shop_id = ? AND o.status = 3";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$shopId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['order_total_price'];
    }

    public function updateStatus($id, $status)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$status, $id]);

        return $stmt->rowCount() === 1;
    }

    public function insertToCart($userId, $orders)
    {
        include SRC_DIR . '/config.php';

        foreach ($orders as $order) {
            $sql = "INSERT INTO carts (product_id, user_id, quantity) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$order['product_id'], $userId, $order['quantity']]);

            if ($stmt->rowCount() !== 1) {
                return false;
            }
        }

        return true;
    }

    public function getByShopId($shopId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT o.address ORDER_ADDRESS, o.name ORDER_NAME, o.phone ORDER_PHONE,
                d.id DELIVERY_ID, o.id ORDER_ID, o.total TOTAL_PRICE,
                o.created_at ORDER_DATE, o.status ORDER_STATUS
                FROM order_detail o_detail 
                JOIN products p ON o_detail.product_id = p.id
                JOIN orders o ON o_detail.order_id = o.id
                JOIN delivery d ON o.delivery_id = d.id
                JOIN users u ON o.user_id = u.id
                WHERE p.shop_id = ?
                GROUP BY o.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$shopId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function getByShopIdAndStatus($shopId, $status)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT  o.address ORDER_ADDRESS, o.name ORDER_NAME, o.phone ORDER_PHONE,
                o.id ORDER_ID, o.total TOTAL_PRICE, o.created_at ORDER_DATE, o.status ORDER_STATUS,
                o.note ORDER_NOTE, o.delivery_date DELIVERY_DATE, d.id DELIVERY_ID, d.name DELIVERY_NAME
                FROM order_detail o_detail 
                JOIN products p ON o_detail.product_id = p.id
                JOIN orders o ON o_detail.order_id = o.id
                JOIN delivery d ON o.delivery_id = d.id
                JOIN users u ON o.user_id = u.id
                WHERE p.shop_id = ? AND o.status = ?
                GROUP BY o.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$shopId, $status]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}
