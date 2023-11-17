<?php

namespace App\Models;

use PDO;

class CartModel
{
    public function getList($userId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT name, thumbnail, price, sale, c.product_id AS product_id, quantity 
                FROM carts c 
                JOIN products p ON p.id = c.product_id 
                WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create($userId, $productId, $quantity = 1)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO carts (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $productId, $quantity]);
        return $stmt->rowCount() === 1;
    }

    public function find($userId, $productId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM carts WHERE user_id=? AND product_id=? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $productId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function update($userId, $productId, $quantity)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE carts SET quantity=? WHERE user_id=? AND product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$quantity, $userId, $productId]);
        return $stmt->rowCount() === 1;
    }

    public function delete($userId, $productId)
    {
        include SRC_DIR . '/config.php';
        $sql = "DELETE FROM carts WHERE user_id=? AND product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $productId]);
        return $stmt->rowCount() === 1;
    }
}
