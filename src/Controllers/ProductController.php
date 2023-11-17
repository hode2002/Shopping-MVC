<?php

namespace App\Controllers;

class ProductController
{
    public function index()
    {
        $ProductModel = new \App\Models\ProductModel();
        $UserModel = new \App\Models\UserModel();

        if (isset($_SESSION['email'])) {
            $user = $UserModel->getByEmail($_SESSION['email']);
        }

        $title = 'Tìm kiếm';

        $keyword = htmlspecialchars($_GET['keyword']);
        $products = $ProductModel->getProductByKeyWord($keyword);
        if (!empty($products)) {
            $title = $products[0]['name'];
        }

        require_once VIEWS_DIR . '/product/search/index.php';
    }

    public function getDetail($id)
    {
        try {
            $ProductModel = new \App\Models\ProductModel();
            $UserModel = new \App\Models\UserModel();

            if (isset($_SESSION['email'])) {
                $user = $UserModel->getByEmail($_SESSION['email']);
            }

            $product = $ProductModel->getById($id);
            if (empty($product)) {
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            }

            $cateId = $product['cate_id'];
            $recommend = $ProductModel->getByCateId($cateId);

            require_once VIEWS_DIR . '/product/detail/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
