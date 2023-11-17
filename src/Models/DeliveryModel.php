<?php

namespace App\Models;

use PDO;

class DeliveryModel
{
    public function create($email, $name, $phone, $content)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO contacts (email, name, phone, content) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $name, $phone, $content]);
        return $stmt->rowCount() === 1;
    }

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
