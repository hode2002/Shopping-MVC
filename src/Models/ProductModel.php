<?php

namespace App\Models;

use PDO;

class ProductModel
{
    public function getByStatus($status)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT p.*, s.name SHOP_NAME, s.id SHOP_ID
                FROM products p 
                JOIN shops s 
                ON s.id = p.shop_id
                WHERE p.status = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$status]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getAll()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM products WHERE status = 1 AND quantity <> 0 LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getAllUnLimit()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT p.*, s.name SHOP_NAME, s.id SHOP_ID, c.name CATE_NAME
                FROM products p 
                JOIN shops s 
                ON s.id = p.shop_id
                JOIN categories c 
                ON p.cate_id = c.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getRandom()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM products WHERE status = 1 AND quantity <> 0 ORDER BY RAND() LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getProSales()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM products WHERE status = 1 AND quantity <> 0 AND sale <> 0 ORDER BY sale DESC LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getById($id)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT p.*, c.name AS cate_name, c.slug AS cate_slug FROM products p JOIN categories c ON p.cate_id = c.id WHERE p.id=? AND status = 1 AND p.quantity <> 0";
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

    public function getAllByShopId($shopId)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM products WHERE shop_id = ? LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$shopId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getByIdAndShopId($id, $shopId)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT p.*
                FROM products p 
                JOIN categories c ON p.cate_id = c.id 
                WHERE p.id=? AND p.shop_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id, $shopId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return false;
        }

        $sql = "SELECT image_url FROM product_images WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $imgs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result['imgs'] = $imgs;

        return $result;
    }

    public function getProductByKeyWord($keyword)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT p.*, c.name cate_name 
                from products p JOIN categories c ON p.cate_id = c.id
                WHERE c.name LIKE ? OR p.name LIKE ? OR p.description LIKE ? AND p.quantity <> 0";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['%' . $keyword . '%', '%' . $keyword . '%', '%' . $keyword . '%']);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function create($shopId, $product)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO products (id, shop_id, name, price, sale, thumbnail, cate_id, quantity, description) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product['id'], $shopId, $product['name'], $product['price'], $product['sale'], BASE_URL . '/uploads/' . $product['img'], $product['category'], $product['quantity'], $product['description']]);

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

    public function update($product, $shopId)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE products SET name=?, price=?, sale=?, thumbnail=?, cate_id=?, quantity=?, description=? WHERE id=? AND shop_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product['name'], $product['price'], $product['sale'], BASE_URL . '/uploads/' . $product['thumbnail'], $product['category'], $product['quantity'], $product['description'], $product['id'], $shopId]);

        if ($stmt->rowCount() === 1 && !empty($product['imgs'])) {
            foreach ($product['imgs'] as $img) {
                $sql = "INSERT INTO product_images(product_id, images_url) VALUES(?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$product['id'], BASE_URL . '/uploads/' . $img]);
            }
            return true;
        }
        return false;
    }

    public function updateStatus($shopId, $productId, $status)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE products SET status=? WHERE id=? AND shop_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$status, $productId, $shopId]);

        return false;
    }

    public function updateQuantity($shopId, $productId, $quantity)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE products SET quantity = quantity + ? WHERE id=? AND shop_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$quantity, $productId, $shopId]);

        return $stmt->rowCount() === 1;
    }

    public function delete($id, $shopId)
    {
        include SRC_DIR . '/config.php';
        $sql = "DELETE FROM products WHERE id=? AND shop_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id, $shopId]);

        if ($stmt->rowCount() !== 1) {
            return false;
        }

        return $this->deleteImgs($id);
    }

    public function deleteImgs($id)
    {
        include SRC_DIR . '/config.php';
        $sql = "DELETE FROM product_images WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount() >= 0;
    }
    public function getAllProductCategory($id_cate)
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT p.* FROM products p JOIN categories c ON p.cate_id = c.id WHERE c.id=?  AND p.quantity <> 0";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_cate]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}
