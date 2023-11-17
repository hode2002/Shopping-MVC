<?php

namespace App\Models;

use PDO;

class DeliveryModel
{
    public function getAll()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT id, name, charge_amount FROM delivery";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}
