-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 01:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ct271_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(126, 3, 'GD001', 2, '2023-12-01 12:29:33', '2023-12-01 12:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `img`, `created_at`, `updated_at`) VALUES
(1, 'Xe máy', '/imgs/products/XeMay.png', '2023-11-15 12:51:40', '2023-11-15 12:51:40'),
(2, 'Ba lô', '/imgs/products/Balo.png', '2023-11-15 12:49:47', '2023-11-15 12:49:47'),
(3, 'Thể thao', '/imgs/products/BongDa.png', '2023-11-15 12:49:47', '2023-11-15 12:49:47'),
(4, 'Điện thoại', '/imgs/products/DienThoai.png', '2023-11-15 12:50:17', '2023-11-15 12:50:17'),
(5, 'Đồng hồ', '/imgs/products/DongHo.png', '2023-11-15 12:50:17', '2023-11-15 12:50:17'),
(6, 'Giày dép', '/imgs/products/GiayDep.png', '2023-11-15 12:50:38', '2023-11-15 12:50:38'),
(7, 'Dụng cụ nhà', '/imgs/products/Home.png', '2023-11-15 12:50:38', '2023-11-15 12:50:38'),
(8, 'Laptop', '/imgs/products/Laptop.png', '2023-11-15 12:50:54', '2023-11-15 12:50:54'),
(9, 'Phụ kiện', '/imgs/products/PhuKien.png', '2023-11-15 12:50:54', '2023-11-15 12:50:54'),
(10, 'Sách', '/imgs/products/Sach.png', '2023-11-15 12:51:16', '2023-11-15 12:51:16'),
(11, 'Thời trang nam', '/imgs/products/ThoitrangNam.png', '2023-11-15 12:51:16', '2023-11-15 12:51:16'),
(12, 'Thời trang nữ', '/imgs/products/ThoitrangNu.png', '2023-11-15 12:51:40', '2023-11-15 12:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `product_id`, `content`, `created_at`, `updated_at`) VALUES
(26, 3, 'SCN001', 'test', '2023-11-26 06:41:49', '2023-11-26 06:41:49'),
(30, 3, 'GD001', 'san pham qua tuyet voi tren ca tuong tuong', '2023-12-01 09:35:25', '2023-12-01 09:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0: Chưa xem, 1: Đã xem',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `charge_amount` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `name`, `charge_amount`, `created_at`, `updated_at`) VALUES
('GHN', 'giao hàng nhanh', 37000, '2023-11-17 13:53:20', '2023-11-17 13:53:20'),
('GHTK', 'giao hàng tiết kiệm', 25000, '2023-11-17 13:53:20', '2023-11-17 13:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `history_search`
--

CREATE TABLE `history_search` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_search`
--

INSERT INTO `history_search` (`id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(7, 1, 'sạc nhanh', '2023-11-26 12:55:54', '2023-11-26 12:55:54'),
(8, 1, 'giày', '2023-11-29 05:14:42', '2023-11-29 05:14:42'),
(9, 3, 'giày', '2023-11-30 13:38:47', '2023-11-30 13:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `total` float DEFAULT 0,
  `note` text NOT NULL,
  `delivery_id` varchar(255) NOT NULL,
  `delivery_date` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0: Chờ xác nhận, 1: Đang giao, 2: Hủy, 3: Đã nhận',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float NOT NULL,
  `total` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `order_detail`
--
DELIMITER $$
CREATE TRIGGER `update_quantity_after_order` AFTER INSERT ON `order_detail` FOR EACH ROW BEGIN
    DECLARE product_quantity INT;
    
    SELECT quantity INTO product_quantity
    FROM products
    WHERE id = NEW.product_id;

    UPDATE products
    SET quantity = product_quantity - NEW.quantity
    WHERE id = NEW.product_id;
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(255) NOT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `shop_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `sale` float DEFAULT 0,
  `description` text DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Chờ kiểm duyệt, 1: Đã duyệt, 2: Vi phạm chính sách',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cate_id`, `shop_id`, `name`, `thumbnail`, `price`, `sale`, `description`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
('DH001', 5, 5, 'DÂY DA ĐỒNG HỒ DA BÒ KHÓA BƯỚM CAO CẤP 316L (HỘP GỖ)', 'http://ct271-project.localhost/uploads/cf98de4f1a14df6708228469c0ef9f06.jpg', 109000, 5, '                    Dây da bò thật 100%, được phủ lớp chống thấm nước bên ngoài. Do đó mới dùng thì thấy cứng, dùng dần thì sẽ sẽ mềm.\nMàu sắc: Nâu/ Đen\nKhóa bướm đôi có nút bấm. giúp không tạo thành vết gập trên dây\n                  ', 10, 1, '2023-11-28 18:01:35', '2023-11-28 18:01:35'),
('GD001', 6, 1, '🔥Giày sneaker nam🔥Giày Thể Thao Cổ Cao Đế Bằng Phong Cách Mới Hợp Thời Trang Cho Nam RKC333', 'http://ct271-project.localhost/uploads/9ba34de358f6247c9c62229eb443392a.jpg', 274000, 41, '                                                            Giày thể thao cổ cao giày thể thao nam giày thể thao nam phổ biến giày cao su nam giày giản dị\n\n\n\n✔️ Mã sản phẩm: RKC333\n\n\n\n✔️Đế cao su cao cấp mịn màng và chống trơn trượt\n\n\n\n✔️ Đệm giày thông gió, thoáng khí rất tốt\n\n\n\n✔️Mặt giày: da thật\n\n\n\n✔️ Đủ kích thước phía nam: 39 - 44\n\n\n\n✔️ Hàng hóa chất lượng cao\n\n\n\n✔️ Hãy yên tâm rằng chúng tôi luôn cung cấp cho bạn những sản phẩm chất lượng tốt nhất với giá cả hợp lý nhất.                                                      ', 10, 1, '2023-11-20 14:52:39', '2023-11-20 14:52:39'),
('SCN001', 9, 1, 'SẠC CỰC NHANH - PIN SẠC DỰ PHÒNG 30000MAH MẶT GƯƠNG ĐEN HUYỀN THOẠI ', 'http://ct271-project.localhost/uploads/7d3185a87bdf88c670c52f7ab1f613b2.jpg', 45000, 2, '                                                            PIN SẠC DỰ PHÒNG 30000MAH MẶT GƯƠNG ĐEN HUYỀN THOẠI\n\nDung lượng lớn, bền bỉ.\n\nChống thấm nước, chống bụi, chống va đập mạnh\n\nGọn nhẹ, tiện dụng, có 2 đèn soi sáng\n\nTương thích nhiều thiết bị\n\nNhiều cách sạc nhanh , thông minh\n\nThiết kế 2 cổng sạc đầu ra (cổng USB)\n\nToàn màn hình đen bóng tuyệt đẹp.\n\nỨng dụng sạc nhanh 2.1A thông minh.\n\nGiải pháp quản lý nguồn thông minh, nút chuyển đổi mềm, hiệu quả ổn định và hiệu quả cao.\n\nThích hợp cho gần như tất cả các loại điện thoại di động và các sản phẩm kỹ thuật số, có 2 đầu nối cáp USB.\n\nHỗ trợ đèn chiếu sáng\n\nTin Đặt Biệt : SẢN PHẨM GIẢM GIÁ VỚI THỜI GIAN CÓ HẠNG, MUA NGAY HÔM NAY ĐỂ TRÁNH LỠ MẤT CƠ HỘI HƯỞNG SALE ƯU ĐÃI NHÉ\n\nLƯU Ý : 20000MAH LÀ THÔNG SỐ DO NHÀ SẢN XUẤT CUNG CẤP, DO QUÁ TRÌNH CHUYỂN HÓA VÀ TIÊU HAO NĂNG LƯỢNG NÊN DUNG LƯỢNG THẬT CỦA SẢN PHẨM LÀ 10000MAH,SẠC ĐƯỢC TỐI ĐA 2 LẦN CHO IPHONE, CÁC BẠN KIỂM TRA DUNG LƯỢNG PIN ĐIỆN THOẠI MÌNH ĐỂ QUY RA SỐ LẦN SẠC HỢP LÝ NHEN\n\n#sacnhanh #sacduphong #pinduphong #20000mah #mặtgương #lcd #samsung #oppo #ip #android                                                      ', 20, 1, '2023-11-20 14:40:12', '2023-11-20 14:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`) VALUES
(27, 'SCN001', 'http://ct271-project.localhost/uploads/d3e0570d09ee035b570957815190746a.jpg'),
(28, 'SCN001', 'http://ct271-project.localhost/uploads/08d6d0cd83c46803aff185f144d55f5f.jpg'),
(29, 'SCN001', 'http://ct271-project.localhost/uploads/445317b0e065760c8d50356b5c7c8b3a.jpg'),
(30, 'SCN001', 'http://ct271-project.localhost/uploads/ac66b3d33505641426e047c79f9f0423.jpg'),
(31, 'SCN001', 'http://ct271-project.localhost/uploads/dd8c5f4804ab80ac05c62f41462d7927.jpg'),
(32, 'SCN001', 'http://ct271-project.localhost/uploads/6192c2cdf97f49f73a795c1d1dcaf17a.jpg'),
(33, 'SCN001', 'http://ct271-project.localhost/uploads/fa34d0d48bef256431bc7c787b233306.jpg'),
(34, 'GD001', 'http://ct271-project.localhost/uploads/a458fb6f1e19740db3ababa73b9d6a02.jpg'),
(35, 'GD001', 'http://ct271-project.localhost/uploads/95f26d8733b847381c71a84b8c87ac91.jpg'),
(36, 'GD001', 'http://ct271-project.localhost/uploads/a86ab98ff641695c420f9956d7f842b8.jpg'),
(37, 'GD001', 'http://ct271-project.localhost/uploads/03884d8c890d987af1da6066217afeb1.jpg'),
(38, 'GD001', 'http://ct271-project.localhost/uploads/415803a51943171d0e27dd8568a29b8c.jpg'),
(39, 'GD001', 'http://ct271-project.localhost/uploads/79220283192285abc9e8c3f26fc494ad.jpg'),
(40, 'GD001', 'http://ct271-project.localhost/uploads/5a06b39a2b634d9565dc5ab9edc25ab2.jpg'),
(41, 'GD001', 'http://ct271-project.localhost/uploads/17b1e59bad80e0cd9b64bc4dee0d4201.jpg'),
(42, 'DH001', 'http://ct271-project.localhost/uploads/65f917548f6d9b902f2f2f2d546cdf5b.jpg'),
(43, 'DH001', 'http://ct271-project.localhost/uploads/404475e127bc3c7263b660e9b7264a6a.jpg'),
(44, 'DH001', 'http://ct271-project.localhost/uploads/f6360af736e14d6e196577704ce37c5b.jpg'),
(45, 'DH001', 'http://ct271-project.localhost/uploads/498149f813baf0f64a01a4eb3f526d14.jpg'),
(46, 'DH001', 'http://ct271-project.localhost/uploads/c27eb8ea92146c3b1146b140140ec844.jpg'),
(47, 'DH001', 'http://ct271-project.localhost/uploads/db4fa663e528f837f2508207d070e8d1.jpg'),
(48, 'DH001', 'http://ct271-project.localhost/uploads/606a543ac7ae89e6174da83fcc543a48.jpg'),
(49, 'DH001', 'http://ct271-project.localhost/uploads/1428ced9344e3610658b8f03f3ea99b8.jpg'),
(50, 'DH001', 'http://ct271-project.localhost/uploads/ba7129fba150f62c61c2856f63eb8282.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`code`, `name`, `created_at`, `updated_at`) VALUES
('R1', 'user', '2023-11-15 07:20:57', '2023-11-15 07:20:57'),
('R2', 'shop', '2023-11-15 07:20:30', '2023-11-15 07:20:30'),
('R3', 'admin', '2023-11-15 07:20:30', '2023-11-15 07:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT 'http://ct271-project.localhost/uploads/shop-default-logo.png',
  `status` tinyint(1) DEFAULT 0 COMMENT '0: Chưa duyệt, 1: Đang hoạt động',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `user_id`, `name`, `description`, `phone`, `address`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', NULL, NULL, NULL, 'http://ct271-project.localhost/uploads/shop-default-logo.png	', 1, '2023-11-18 04:21:39', '2023-11-18 04:21:39'),
(5, 2, 'shop', NULL, NULL, NULL, 'http://ct271-project.localhost/uploads/shop-default-logo.png', 1, '2023-11-28 13:06:00', '2023-11-28 13:06:00'),
(6, 3, 'user', NULL, NULL, NULL, 'http://ct271-project.localhost/uploads/shop-default-logo.png', 0, '2023-11-30 13:32:08', '2023-11-30 13:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'http://shop.localhost/uploads/default.jpg',
  `role_code` varchar(255) DEFAULT 'R1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `address`, `phone`, `gender`, `dob`, `avatar`, `role_code`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'HVD', 'Cần thơ', '0916777730', 1, '07/06/2002', 'http://ct271-project.localhost/uploads/e8554d4fb6136b4d5785d4a70040213d.jpg', 'R3', '2023-11-16 16:29:18', '2023-11-16 16:29:18'),
(2, 'shop@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'SHOP', NULL, NULL, NULL, NULL, 'http://ct271-project.localhost/uploads/default.jpg', 'R2', '2023-11-18 04:28:52', '2023-11-18 04:28:52'),
(3, 'user@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'USER', 'can tho', '0879187418', 1, '07/06/2002', 'http://ct271-project.localhost/uploads/default.jpg', 'R1', '2023-11-18 04:39:53', '2023-11-18 04:39:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_search`
--
ALTER TABLE `history_search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history_search`
--
ALTER TABLE `history_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
