<?php

namespace App\Models;

use PDO;

class HistorySearchModel
{
    public function create($userId, $content)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO history_search (user_id, content) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $content]);
        return $stmt->rowCount() === 1;
    }

    public function getAll($userId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT id, user_id, content FROM history_search WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function delete($id)
    {
        include SRC_DIR . '/config.php';
        $sql = "DELETE FROM history_search WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount() === 1;
    }
}
