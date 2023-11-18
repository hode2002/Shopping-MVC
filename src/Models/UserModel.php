<?php

namespace App\Models;

use PDO;

class UserModel
{
    public function getByEmail($email)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
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

    public function updateRole($userId, $roleCode)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE users SET role_code = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$roleCode, $userId]);
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
}
