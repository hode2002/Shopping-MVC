<?php

namespace App\Controllers;

class DeliveryController
{
    public function getAll()
    {
        try {
            require_once SRC_DIR . '/config.php';
            $DeliveryModel = new \App\Models\DeliveryModel();

            $delivery = $DeliveryModel->getAll();
            echo json_encode($delivery);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
