<?php

namespace App\Models;

use PDO;

class ProductModel
{
    public function getAll()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM products LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getRandom()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getProSales()
    {
        include SRC_DIR . '/config.php';
        $sql = "SELECT * FROM products WHERE sale <> 0 ORDER BY sale DESC LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getById($id)
    {
        include SRC_DIR . '/config.php';

        $sql = "SELECT p.*, c.name AS cate_name, c.slug AS cate_slug FROM products p JOIN categories c ON p.cate_id = c.id WHERE p.id=?";
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
        $sql = "SELECT * FROM products WHERE cate_id = ? LIMIT 12";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cateId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getAllByAuthor($tac_gia)
    {
        include SRC_DIR . '/config.php';
        $sql = "select * from sach where tac_gia=?";
        $ketqua = $conn->prepare($sql);
        $ketqua->execute([$tac_gia]);
        $ketqua = $ketqua->fetchAll(PDO::FETCH_ASSOC);

        return $ketqua;
    }

    public function create($book)
    {
        include SRC_DIR . '/config.php';
        $sql = "INSERT INTO sach(ten_sach, gia_goc, gia_sale, anh_bia, tac_gia, mo_ta) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$book['name'], $book['price'], $book['sale'], BASE_URL . '/uploads/' . $book['img'], $book['author'], $book['description']]);

        $id = (int) $conn->lastInsertId();
        if ($stmt->rowCount() === 1 && !empty($book['imgs'])) {
            foreach ($book['imgs'] as $img) {
                $sql = "INSERT INTO hinh_anh_sach(id_sach, hinh_anh) VALUES(?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id, BASE_URL . '/uploads/' . $img]);
            }
            return true;
        }
        return false;
    }

    public function update($book)
    {
        include SRC_DIR . '/config.php';
        $sql = "UPDATE sach SET ten_sach=?, gia_goc=?, gia_sale=?, anh_bia=?, tac_gia=?, mo_ta=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$book['name'], $book['price'], $book['sale'], BASE_URL . '/uploads/' . $book['img'], $book['author'], $book['description'], $book['book_id']]);

        if ($stmt->rowCount() === 1 && !empty($book['imgs'])) {
            foreach ($book['imgs'] as $img) {
                $sql = "INSERT INTO hinh_anh_sach(id_sach, hinh_anh) VALUES(?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$book['book_id'], BASE_URL . '/uploads/' . $img]);
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

    public function getBookByCategory($sach)
    {
        include SRC_DIR . '/config.php';
        $sql = "select * from sach where the_loai like ? or ten_sach like ? or tac_gia like ?";
        $ketqua = $conn->prepare($sql);
        $ketqua->execute(['%' . $sach . '%', '%' . $sach . '%', '%' . $sach . '%']);
        $ketqua = $ketqua->fetchAll(PDO::FETCH_ASSOC);

        return $ketqua;
    }
}
