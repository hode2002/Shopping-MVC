<?php

namespace App\Models;

use PDO;

class ShopModel
{
    function openStore($userId)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO shops (user_id) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
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
}
