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
        if (empty($products)) {
            require_once VIEWS_DIR . '/product/search/empty.php';
            exit;
        }

        $title = $products[0]['name'];
        require_once VIEWS_DIR . '/product/search/index.php';
    }
    public function category()
    {
        $ProductModel = new \App\Models\ProductModel();
        $UserModel = new \App\Models\UserModel();
        if (isset($_SESSION['email'])) {
            $user = $UserModel->getByEmail($_SESSION['email']);
        }
        $title = 'Tìm kiếm danh mục';
        $id_cate = htmlspecialchars($_GET['id-cate']);
        $products = $ProductModel->getAllProductCategory($id_cate);
        if (empty($products)) {
            require_once VIEWS_DIR . '/category/empty.php';
            exit;
        }
        // $title = $products[0]['name'];
        require_once VIEWS_DIR . '/category/index.php';
    }
    public function getDetail($id)
    {
        try {
            $ProductModel = new \App\Models\ProductModel();
            $UserModel = new \App\Models\UserModel();
            $CommentModel = new \App\Models\CommentModel();

            if (isset($_SESSION['email'])) {
                $user = $UserModel->getByEmail($_SESSION['email']);
            }

            $product = $ProductModel->getById($id);
            if (empty($product)) {
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            }

            $comments = $CommentModel->getByProductId($id);

            $cateId = $product['cate_id'];
            $recommend = $ProductModel->getByCateId($cateId);

            require_once VIEWS_DIR . '/product/detail/index.php';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postCommentCreate()
    {
        try {
            $UserModel = new \App\Models\UserModel();
            $CommentModel = new \App\Models\CommentModel();

            if (!isset($_SESSION['email'])) {
                jsonResponse(error: 1, message: 'Chưa đăng nhập');
            }
            $user = $UserModel->getByEmail($_SESSION['email']);
            $userId = $user['id'];

            if (empty($_POST['productId'])) {
                jsonResponse(error: 1, message: 'Có lỗi xảy ra. Vui lòng thử lại sau');
            }
            $productId = htmlspecialchars($_POST['productId']);

            if (empty($_POST['content'])) {
                jsonResponse(error: 1, message: 'Có lỗi xảy ra. Vui lòng thử lại sau');
            }
            $content = htmlspecialchars($_POST['content']);

            $isSuccess = $CommentModel->create($userId, $productId, $content);

            if (empty($isSuccess)) {
                jsonResponse(error: 1, message: 'Có lỗi xảy ra. Vui lòng thử lại sau');
            }

            jsonResponse(error: 0, message: 'Thành công');
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postCommentDelete()
    {
        try {
            $UserModel = new \App\Models\UserModel();
            $CommentModel = new \App\Models\CommentModel();

            if (!isset($_SESSION['email'])) {
                jsonResponse(error: 1, message: 'Chưa đăng nhập');
            }
            $user = $UserModel->getByEmail($_SESSION['email']);
            $userId = $user['id'];

            if (empty($_POST['productId'])) {
                jsonResponse(error: 1, message: 'Có lỗi xảy ra. Vui lòng thử lại sau');
            }
            $productId = htmlspecialchars($_POST['productId']);

            if (empty($_POST['commentId'])) {
                jsonResponse(error: 1, message: 'Có lỗi xảy ra. Vui lòng thử lại sau');
            }
            $commentId = htmlspecialchars($_POST['commentId']);

            $isSuccess = $CommentModel->delete($commentId, $userId, $productId);

            if (empty($isSuccess)) {
                jsonResponse(error: 1, message: 'Có lỗi xảy ra. Vui lòng thử lại sau');
            }

            jsonResponse(error: 0, message: 'Thành công');
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postCommentUpdate()
    {
        try {
            $UserModel = new \App\Models\UserModel();
            $CommentModel = new \App\Models\CommentModel();

            if (!isset($_SESSION['email'])) {
                jsonResponse(error: 1, message: 'Chưa đăng nhập');
            }
            $user = $UserModel->getByEmail($_SESSION['email']);
            $userId = $user['id'];

            if (empty($_POST['productId'])) {
                jsonResponse(error: 1, message: 'Có lỗi xảy ra. Vui lòng thử lại sau');
            }
            $productId = htmlspecialchars($_POST['productId']);

            if (empty($_POST['commentId'])) {
                jsonResponse(error: 1, message: 'Có lỗi xảy ra. Vui lòng thử lại sau');
            }
            $commentId = htmlspecialchars($_POST['commentId']);

            if (empty($_POST['content'])) {
                jsonResponse(error: 1, message: 'Có lỗi xảy ra. Vui lòng thử lại sau');
            }
            $content = htmlspecialchars($_POST['content']);

            $isSuccess = $CommentModel->update($commentId, $userId, $productId, $content);

            if (empty($isSuccess)) {
                jsonResponse(error: 1, message: 'Có lỗi xảy ra. Vui lòng thử lại sau');
            }

            jsonResponse(error: 0, message: 'Thành công');
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
