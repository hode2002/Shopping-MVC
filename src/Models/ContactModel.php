<?php

namespace App\Models;

use PDO;

class ContactModel
{
    public function create($email, $name, $phone, $content)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO contacts (email, name, phone, content) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $name, $phone, $content]);
        return $stmt->rowCount() === 1;
    }

    public function findById($contactId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM contacts WHERE id=? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$contactId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
