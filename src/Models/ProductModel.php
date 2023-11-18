<?php

namespace App\Models;

use PDO;

class ProductModel
{
    public function getAll()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM products WHERE status = 1 LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getRandom()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM products WHERE status = 1 ORDER BY RAND() LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getProSales()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM products WHERE status = 1 AND sale <> 0 ORDER BY sale DESC LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getById($id)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT p.*, c.name AS cate_name, c.slug AS cate_slug FROM products p JOIN categories c ON p.cate_id = c.id WHERE p.id=? AND status = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return false;
        }

        $sql = "SELECT * FROM product_images WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $imgs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result['imgs'] = $imgs;

        return $result;
    }

    public function getByCateId($cateId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM products WHERE status = 1 AND cate_id = ? LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cateId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function create($shopId, $product)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO products (id, shop_id, name, price, sale, thumbnail, cate_id, description) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product['id'], $shopId, $product['name'], $product['price'], $product['sale'], BASE_URL . '/uploads/' . $product['img'], $product['category'], $product['description']]);

        if ($stmt->rowCount() === 1 && !empty($product['imgs'])) {
            foreach ($product['imgs'] as $img) {
                $sql = "INSERT INTO product_images (product_id, image_url) VALUES(?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$product['id'], BASE_URL . '/uploads/' . $img]);
            }
            return true;
        }
        return false;
    }

    public function update($product)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE sach SET ten_sach=?, gia_goc=?, gia_sale=?, anh_bia=?, tac_gia=?, mo_ta=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product['name'], $product['price'], $product['sale'], BASE_URL . '/uploads/' . $product['img'], $product['author'], $product['description'], $product['book_id']]);

        if ($stmt->rowCount() === 1 && !empty($product['imgs'])) {
            foreach ($product['imgs'] as $img) {
                $sql = "INSERT INTO hinh_anh_sach(id_sach, hinh_anh) VALUES(?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$product['book_id'], BASE_URL . '/uploads/' . $img]);
            }
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        include SRC_DIR . '/config.php';
        $sql = "DELETE FROM sach WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        if ($stmt->rowCount() !== 1) {
            return false;
        }

        return $this->deleteBookImgs($id);
    }

    public function deleteBookImgs($id)
    {
        include SRC_DIR . '/config.php';
        $sql = "DELETE FROM hinh_anh_sach WHERE id_sach = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount() >= 0;
    }

    public function getProductByKeyWord($keyword)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT p.*, c.name cate_name 
                from products p JOIN categories c ON p.cate_id = c.id
                WHERE c.name LIKE ? OR p.name LIKE ? OR p.description LIKE ?";
        $ketqua = $conn->prepare($sql);
        $ketqua->execute(['%' . $keyword . '%', '%' . $keyword . '%', '%' . $keyword . '%']);
        $ketqua = $ketqua->fetchAll(PDO::FETCH_ASSOC);

        return $ketqua;
    }
}
