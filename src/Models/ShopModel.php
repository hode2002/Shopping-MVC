<?php

namespace App\Models;

use PDO;

class ShopModel
{
    function openShop($userId, $email)
    {
        include SRC_DIR . '/config.php';
        $shopName = explode('@', $email)[0];
        $sql = "INSERT INTO shops (user_id, name, phone) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $shopName]);
        return $stmt->rowCount() === 1;
    }

    function getByUserId($userId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM shops WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function getByStatus($status)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT s.*, u.name U_NAME, u.email
                FROM shops s 
                JOIN users u 
                ON s.user_id = u.id
                WHERE status = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$status]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getAll()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT s.*, u.name U_NAME, u.email
                FROM shops s 
                JOIN users u 
                ON s.user_id = u.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function updateStatus($shopId, $status)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE shops SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$status, $shopId]);
        return $stmt->rowCount() === 1;
    }
}
