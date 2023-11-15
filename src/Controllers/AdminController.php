<?php

namespace App\Controllers;

class AdminController
{
    public function index()
    {
        if (!isAdmin()) {
            $title = 'Lỗi';
            require_once VIEWS_DIR . '/errors/404.php';
            exit;
        };
        $BookModel = new \App\Models\ProductModel();
        $books = $BookModel->getAllNoLimit();
        $title = 'Admin';
        require_once VIEWS_DIR . '/admin/index.php';
    }

    public function getAdd()
    {
        if (!isAdmin()) {
            $title = 'Lỗi';
            require_once VIEWS_DIR . '/errors/404.php';
            exit;
        };
        $title = 'Admin | Thêm';
        require_once VIEWS_DIR . '/admin/add/index.php';
    }

    public function postAdd()
    {
        try {
            if (!isAdmin()) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            require_once SRC_DIR . '/config.php';
            $BookModel = new \App\Models\ProductModel();

            if (!isset($_POST['book'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập thông tin sản phẩm");
            }
            $book = json_decode($_POST['book'], true);

            if (!isset($book['name'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập tên sản phẩm");
            }

            if (!isset($book['price'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập giá bán");
            }

            if (!isset($book['sale'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập giá sale");
            }

            if (!isset($book['author'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập tên tác giả");
            }

            if (!isset($book['description'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập mô tả sản phẩm");
            }

            $img = handle_img_upload('img');
            if (!isset($img)) {
                JsonResponse(error: 1, message: "Lỗi ảnh bìa");
            }
            $book['img'] = $img;

            $imgs = handle_img_upload('imgs', isMultiple: true);
            if (!isset($imgs)) {
                JsonResponse(error: 1, message: "Lỗi ảnh hình ảnh khác");
            }
            $book['imgs'] = $imgs;

            $isSuccess = $BookModel->create($book);
            if (!isset($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Thêm thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getEdit($id)
    {
        if (!isAdmin()) {
            $title = 'Lỗi';
            require_once VIEWS_DIR . '/errors/404.php';
            exit;
        };
        $BookModel = new \App\Models\ProductModel();
        $book = $BookModel->getById($id);
        $title = 'Admin | Chỉnh Sửa';
        require_once VIEWS_DIR . '/admin/edit/index.php';
    }

    public function postEdit()
    {
        try {
            if (!isAdmin()) {
                $title = 'Lỗi';
                require_once VIEWS_DIR . '/errors/404.php';
                exit;
            };

            require_once SRC_DIR . '/config.php';
            $BookModel = new \App\Models\ProductModel();

            if (!isset($_POST['book'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập thông tin sản phẩm");
            }
            $book = json_decode($_POST['book'], true);

            if (!isset($book['book_id'])) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }

            if (!isset($book['name'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập tên sản phẩm");
            }

            if (!isset($book['price'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập giá bán");
            }

            if (!isset($book['sale'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập giá sale");
            }

            if (!isset($book['author'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập tên tác giả");
            }

            if (!isset($book['description'])) {
                JsonResponse(error: 1, message: "Vui lòng nhập mô tả sản phẩm");
            }

            $oldBook = $BookModel->getById($book['book_id']);

            $img = handle_img_upload('img');
            if (empty($img)) {
                $fileName = extractFileNameFromUrl($oldBook['anh_bia']);
                $book['img'] = $fileName;
            } else {
                $book['img'] = $img;
                $fileName = extractFileNameFromUrl($oldBook['anh_bia']);
                remove_img_file($fileName);
            }

            $imgs = handle_img_upload('imgs', isMultiple: true);
            if (!empty($imgs)) {
                foreach ($oldBook['imgs'] as $item) {
                    $fileName = extractFileNameFromUrl($item['hinh_anh']);
                    remove_img_file($fileName);
                }
                $BookModel->deleteBookImgs($book['book_id']);
                $book['imgs'] = $imgs;
            }

            $isSuccess = $BookModel->update($book);
            if (!isset($isSuccess)) {
                JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau");
            }

            JsonResponse(error: 0, message: "Cập nhật thành công");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function postDelete($id)
    {
        $BookModel = new \App\Models\ProductModel();

        $oldBook = $BookModel->getById($id);
        if (empty($oldBook)) {
            JsonResponse(error: 1, message: "Sản phẩm không tồn tại hoặc đã bị xóa");
        }

        foreach ($oldBook['imgs'] as $item) {
            $fileName = extractFileNameFromUrl($item['hinh_anh']);
            remove_img_file($fileName);
        }

        $isSuccess = $BookModel->delete($id);

        $fileName = extractFileNameFromUrl($oldBook['anh_bia']);
        if ($isSuccess && empty($fileName)) {
            JsonResponse(error: 1, message: "Xóa sản phẩm thành công");
        }
        remove_img_file($fileName);

        if (!$isSuccess) {
            JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau.");
        }

        JsonResponse(error: 0, message: "Xóa sản phẩm thành công");
    }

    public function getOrder()
    {
        if (!isAdmin()) {
            $title = 'Lỗi';
            require_once VIEWS_DIR . '/errors/404.php';
            exit;
        };
        $CheckoutModel = new \App\Models\CheckoutModel();

        $orders = $CheckoutModel->getOrdersInfo();
        $title = 'Admin';
        require_once VIEWS_DIR . '/admin/order/index.php';
    }

    public function getOrderDetail($orderId)
    {
        if (!isAdmin()) {
            $title = 'Lỗi';
            require_once VIEWS_DIR . '/errors/404.php';
            exit;
        };
        $CheckoutModel = new \App\Models\CheckoutModel();

        $results = $CheckoutModel->getOrderDetail($orderId);
        $title = 'Admin | Chi Tiết Đơn Hàng';
        require_once VIEWS_DIR . '/admin/order/detail/index.php';
    }


    public function postOrderUpdate()
    {
        if (!isset($_POST['id']) || !isset($_POST['status'])) {
            JsonResponse(error: 1, message: "Thiếu thông tin");
        }
        $id = htmlspecialchars($_POST['id']);
        $status = htmlspecialchars($_POST['status']);

        $CheckoutModel = new \App\Models\CheckoutModel();

        $order = $CheckoutModel->getById($id);
        if (empty($order)) {
            JsonResponse(error: 1, message: "Đơn hàng không tồn tại, Vui lòng kiểm tra lại");
        }

        $isSuccess = $CheckoutModel->updateStatus($id, $status);

        if (!$isSuccess) {
            JsonResponse(error: 1, message: "Có lỗi xảy ra! vui lòng thử lại sau.");
        }

        JsonResponse(error: 0, message: "Cập nhật thành công");
    }
}
