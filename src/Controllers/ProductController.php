<?php

namespace App\Controllers;

class ProductController
{
    public function index()
    {
        $ProductModel = new \App\Models\ProductModel();
        require_once VIEWS_DIR . '/product/index.html';
    }

    public function getDetail($id)
    {
        try {
            $ProductModel = new \App\Models\ProductModel();

            $product = $ProductModel->getById($id);

            $cateId = $product['cate_id'];
            $recommend = $ProductModel->getByCateId($cateId);

            require_once VIEWS_DIR . '/product/detail/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getSearch()
    {
        $BookModel = new \App\Models\ProductModel();

        $book = $BookModel->getBookByCategory(htmlspecialchars($_GET['tu_khoa']));

        if (!empty($book)) {
            $tukhoa = $book[0]['the_loai'];
            $title = htmlspecialchars($_GET['tu_khoa']);
            require_once VIEWS_DIR . '/book/search/index.php';
        } else {
            $title = 'Không Tìm Thấy';
            require_once VIEWS_DIR . '/errors/search/notFound.php';
            exit;
        }
    }
}
