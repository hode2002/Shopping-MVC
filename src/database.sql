-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 04:15 PM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `img`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Ba lô', '/imgs/products/Balo.png', 'ba-lo', '2023-11-15 12:49:47', '2023-11-15 12:49:47'),
(3, 'Thể thao', '/imgs/products/BongDa.png', 'the-thao', '2023-11-15 12:49:47', '2023-11-15 12:49:47'),
(4, 'Điện thoại', '/imgs/products/DienThoai.png', 'dien-thoai', '2023-11-15 12:50:17', '2023-11-15 12:50:17'),
(5, 'Đồng hồ', '/imgs/products/DongHo.png', 'dong-ho', '2023-11-15 12:50:17', '2023-11-15 12:50:17'),
(6, 'Giày dép', '/imgs/products/GiayDep.png', 'giay-dep', '2023-11-15 12:50:38', '2023-11-15 12:50:38'),
(7, 'Dụng cụ nhà', '/imgs/products/Home.png', 'dung-cu-nha', '2023-11-15 12:50:38', '2023-11-15 12:50:38'),
(8, 'Laptop', '/imgs/products/Laptop.png', 'laptop', '2023-11-15 12:50:54', '2023-11-15 12:50:54'),
(9, 'Phụ kiện', '/imgs/products/PhuKien.png', 'phu-kien', '2023-11-15 12:50:54', '2023-11-15 12:50:54'),
(10, 'Sách', '/imgs/products/Sach.png', 'sach', '2023-11-15 12:51:16', '2023-11-15 12:51:16'),
(11, 'Thời trang nam', '/imgs/products/ThoitrangNam.png', 'thoi-trang-nam', '2023-11-15 12:51:16', '2023-11-15 12:51:16'),
(12, 'Thời trang nữ', '/imgs/products/ThoitrangNu.png', 'thoi-trang-nu', '2023-11-15 12:51:40', '2023-11-15 12:51:40'),
(13, 'Xe máy', '/imgs/products/XeMay.png', 'xe-may', '2023-11-15 12:51:40', '2023-11-15 12:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `email`, `name`, `phone`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'HVD', '0879187418', 'Test...', 0, '2023-11-15 14:12:21', '2023-11-15 14:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `charge_amount` float DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_buy`
--

CREATE TABLE `history_buy` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
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
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(255) NOT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `sale` float DEFAULT 0,
  `description` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cate_id`, `name`, `thumbnail`, `price`, `sale`, `description`, `slug`, `created_at`, `updated_at`) VALUES
('PRO001', 9, 'Tai Nghe Bluetooth Pro 2 Không Dây Cao Cấp Định Vị Đổi Tên Tự Động Kết Nối Cảm Ứng Chính Hãng PKT', 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-llysbdiyaktb13_tn', 179000, 0, 'Tai nghe không dây', 'tai-nghe-bluetooth-pro-2-khong-day-cao-cap-djinh-vi-djoi-ten-tu-djong-ket-noi-cam-ung-chinh-hang-pkt', '2023-11-15 13:11:26', '2023-11-15 13:11:26'),
('PRO002', 4, 'Điện thoại Apple iPhone 14 Pro 128GB', 'https://down-vn.img.susercontent.com/file/198720e37eeccfcdc98c6ea87f5decaa', 23990000, 23, 'Điện thoại iPhone 14 Pro sở hữu trọng lượng 206g cùng thiết kế nhỏ gọn cho khả năng cầm nắm thoải mái. Về thông số màn hình, điện thoại được trang bị màn hình có độ phân giải 2556 x 1179 pixel và mật độ điểm ảnh 2556 x 1179 pixel mang lại khả năng hiển thị ấn tượng.', 'dien-thoai-apple-iphone-14-pro-128gb', '2023-11-15 13:33:39', '2023-11-15 13:33:39');

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
(1, 'PRO002', 'https://down-vn.img.susercontent.com/file/3af324bc17f502e8b1898fd5a2b01844'),
(2, 'PRO002', 'https://down-vn.img.susercontent.com/file/b7addff24c257ae552ee31f16a23af7c'),
(3, 'PRO002', 'https://down-vn.img.susercontent.com/file/7bb6d3ae9b86f3d7a7b1ca0e48ec311a'),
(4, 'PRO002', 'https://down-vn.img.susercontent.com/file/bdda15455bac30f5bc2b404752bbe3ba'),
(5, 'PRO002', 'https://down-vn.img.susercontent.com/file/3aaade086d08751f776049fdc99f4c6e'),
(6, 'PRO002', 'https://down-vn.img.susercontent.com/file/c1b2e42986f73de8bedb2282e2687626');

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
(1, 'admin@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'HVD', NULL, '0879187418', 1, '07/06/2002', 'http://ct271-project.localhost/uploads/66bedb874cc5a858e5846c0c97afad9c.jpg', 'R3', '2023-11-15 08:23:16', '2023-11-15 08:23:16'),
(2, 'user@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', NULL, NULL, NULL, NULL, NULL, 'http://shop.localhost/uploads/default.jpg', 'R1', '2023-11-15 08:26:15', '2023-11-15 08:26:15');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `history_buy`
--
ALTER TABLE `history_buy`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_buy`
--
ALTER TABLE `history_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_search`
--
ALTER TABLE `history_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
