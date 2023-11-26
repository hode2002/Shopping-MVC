<?php

namespace App\Models;

use PDO;

class CommentModel
{
    public function getByProductId($productId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT c.*, u.name, u.avatar, u.email
                FROM comments c
                JOIN users u 
                ON c.user_id = u.id
                WHERE product_id = ?
                ORDER BY c.created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$productId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function create($userId, $productId, $content)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO comments (user_id, product_id, content) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $productId, $content]);

        return $stmt->rowCount() === 1;
    }

    public function update($commentId, $userId, $productId, $content)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE comments SET content = ? WHERE user_id=? AND product_id=? AND id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$content, $userId, $productId, $commentId]);

        return $stmt->rowCount() === 1;
    }

    public function delete($commentId, $userId, $productId)
    {
        include SRC_DIR . '/config.php';
        $sql = "DELETE FROM comments WHERE user_id=? AND product_id=? AND id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $productId, $commentId]);

        return $stmt->rowCount() === 1;
    }
}
