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
}
