<?php

namespace App\Models;

use PDO;

class CategoryModel
{
    public function getAll()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function find($userId, $bookId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM gio_hang WHERE id_kh=? AND id_sach=? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $bookId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
