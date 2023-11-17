<?php

namespace App\Controllers;

class HistorySearchController
{
    public function postCreate()
    {
        try {
            require_once SRC_DIR . '/config.php';
            if (!isset($_SESSION['email'])) {
                exit;
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $UserModel = new \App\Models\UserModel();
            $HistorySearchModel = new \App\Models\HistorySearchModel();

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $content = htmlspecialchars($_POST['content']) ?? '';
            if (empty($content)) {
                exit;
            }

            $HistorySearchModel->create($userId, $content);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAll()
    {
        try {
            require_once SRC_DIR . '/config.php';

            if (!isset($_SESSION['email'])) {
                exit;
            }
            $email = htmlspecialchars($_SESSION["email"]);

            $UserModel = new \App\Models\UserModel();
            $HistorySearchModel = new \App\Models\HistorySearchModel();

            $user = $UserModel->getByEmail($email);
            $userId = $user['id'];

            $history = $HistorySearchModel->getAll($userId);
            echo json_encode($history);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postDelete($id)
    {
        try {
            require_once SRC_DIR . '/config.php';
            $HistorySearchModel = new \App\Models\HistorySearchModel();
            $HistorySearchModel->delete($id);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
