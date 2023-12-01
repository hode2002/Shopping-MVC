<?php

namespace App\Models;

use PDO;

class UserModel
{
    public function getAllUsers()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM users WHERE role_code <> 'R3'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $user;
    }

    public function getByEmail($email)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function getByUserId($id)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function getInfo($email, $password)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT * FROM users WHERE email=? AND password=?";
        $stmt = $conn->prepare($sql);
        $password = md5($password);
        $stmt->execute([$email, $password]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    public function getAllByShopId($shopId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT *
                FROM users u 
                JOIN orders o ON u.id = o.user_id
                JOIN order_detail o_detail ON o_detail.order_id = o.id
                JOIN products p ON o_detail.product_id = p.id
                WHERE p.shop_id = ?
                GROUP BY u.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$shopId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function create($email, $password)
    {
        include SRC_DIR . '/config.php';

        $sql = "INSERT INTO users(email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $password = md5($password);
        $stmt->execute([$email, $password]);
        return $stmt->rowCount() === 1;
    }

    public function updatePass($email, $password)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $password = md5($password);
        $stmt->execute([$password, $email]);
        return $stmt->rowCount() === 1;
    }

    public function updateAddress($id, $address)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE users SET address = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$address, $id]);
        return $stmt->rowCount() === 1;
    }

    public function updateRole($email, $roleCode)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE users SET role_code = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$roleCode, $email]);
        return $stmt->rowCount() === 1;
    }

    public function updateAvatar($id, $avatar)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE users SET avatar = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([BASE_URL . '/uploads/' . $avatar, $id]);
        return $stmt->rowCount() === 1;
    }

    public function updateProfile($id, $name, $phone, $gender, $dob)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE users SET name=?, phone=?, gender=?, dob=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $phone, $gender, $dob, $id]);
        return $stmt->rowCount() === 1;
    }

    public function delete($userId)
    {
        include SRC_DIR . '/config.php';
        $sql = "DELETE FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->rowCount() === 1;
    }
}
