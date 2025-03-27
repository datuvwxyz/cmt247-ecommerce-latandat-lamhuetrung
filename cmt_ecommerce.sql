-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 26, 2025 lúc 08:51 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cmt_ecommerce`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LTD', 'thương hiệu mới thành lập', '2025-03-25 11:06:45', '2025-03-25 11:11:30', NULL),
(2, 'Khác', 'Một số thương hiệu khác', '2025-03-25 21:57:30', '2025-03-25 21:57:30', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Camera', 'đủ loại camera', '2025-03-25 09:51:58', '2025-03-25 09:51:58'),
(5, 'Linh kiện máy tính', NULL, '2025-03-25 21:54:45', '2025-03-25 21:54:45'),
(15, 'Laptop', NULL, '2025-03-25 23:27:33', '2025-03-25 23:27:33'),
(16, 'Card đồ hoạ', NULL, '2025-03-25 23:27:45', '2025-03-25 23:27:45'),
(17, 'Màn hình', NULL, '2025-03-25 23:27:58', '2025-03-25 23:27:58'),
(18, 'Máy in', NULL, '2025-03-25 23:28:05', '2025-03-25 23:28:05'),
(19, 'Loa', NULL, '2025-03-25 23:28:11', '2025-03-25 23:28:11'),
(20, 'PC', NULL, '2025-03-25 23:28:25', '2025-03-25 23:28:25'),
(21, 'Mạng', NULL, '2025-03-25 23:28:31', '2025-03-25 23:28:31'),
(22, 'Phụ kiện', NULL, '2025-03-25 23:28:40', '2025-03-25 23:28:40'),
(23, 'Máy lạnh', NULL, '2025-03-25 23:28:49', '2025-03-25 23:28:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_21_042130_create_categories_table', 2),
(5, '2025_03_21_042204_create_brands_table', 2),
(6, '2025_03_21_094024_create_products_table', 2),
(7, '2025_03_21_094208_create_carts_table', 2),
(8, '2025_03_21_094358_create_orders_table', 2),
(9, '2025_03_21_094442_create_reviews_table', 2),
(10, '2025_03_25_135927_create_cart_items_table', 2),
(11, '2025_03_25_140025_create_order_items_table', 2),
(12, '2025_03_25_142947_add_role_to_users_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `unit` varchar(255) NOT NULL DEFAULT 'cái',
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `detailed_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `barcode`, `unit`, `brand_id`, `category_id`, `price`, `quantity`, `image`, `short_description`, `detailed_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 'CAM HILOOK P220-D/W', 'SP000025', NULL, 'cái', 2, 3, 800000.00, 50, 'products/gfOQYbgVy0.jpg', 'Camera CAM HILOOK P220-D/W', 'Detailed description for Product 1', '2025-03-25 23:36:58', '2025-03-25 23:36:58', NULL),
(18, 'CAM DAHUA HFW1200SP', 'SP000027', NULL, 'cái', 2, 3, 1200000.00, 30, 'products/VLQ3GRxdKg.jpg', 'Camera quan sát DAHUA HAC-HFW1200SP-S5 ( 2.0MP, hồng ngoại 20m, đèn hồng ngoại Micro Led)', 'Detailed description for Product 2', '2025-03-25 23:36:59', '2025-03-21 23:36:59', NULL),
(19, 'CAM DAHUA HFW1230M', 'SP000028', NULL, 'cái', 2, 3, 1250000.00, 25, 'products/w8VoKYEOrQ.jpg', 'Camera IP Dahua DH-IPC-HFW1230M-A-I1-B-S5 2.0MP', 'Detailed description for Product 3', '2025-03-25 23:36:59', '2025-03-25 23:36:59', NULL),
(20, 'CAM DAHUA HFW2433DM', 'SP000029', NULL, 'cái', 2, 3, 2000000.00, 10, 'products/S2SGTmItRS.jpg', 'Camera Dahua DH-IPC-HFW2433DM-LED', 'Detailed description for Product 4', '2025-03-25 23:36:59', '2025-03-25 23:36:59', NULL),
(21, 'CAM DAHUA 3A1200', 'SP000030', NULL, 'cái', 2, 3, 2500000.00, 15, 'products/z22FXOMcUv.jpg', 'Camera giám sát IPC PTZ Dahua DH-SD-3A1200-W', 'Detailed description for Product 5', '2025-03-25 23:36:59', '2025-03-25 23:36:59', NULL),
(22, 'CAM DAHUA HFW2633M1', 'SP000031', NULL, 'cái', 2, 3, 3000000.00, 20, 'products/JsIh9sneNd.jpg', 'Camera giám sát IPC Dahua 6.0 Megapixel DH-IPC-HFW2633M1-A-I2', 'Detailed description for Product 6', '2025-03-25 23:36:59', '2025-03-25 23:36:59', NULL),
(26, 'CAM HILOOK P220-D/W', 'SP000032', NULL, 'cái', 2, 3, 800000.00, 50, 'products/Q9eBLibgIH.jpg', 'Camera CAM HILOOK P220-D/W', 'Detailed description for Product 1', '2025-03-26 00:18:22', '2025-03-26 00:18:22', NULL),
(27, 'CAM DAHUA HFW1200SP', 'SP000033', NULL, 'cái', 2, 3, 1200000.00, 30, 'products/Zq4vnVYYwO.jpg', 'Camera quan sát DAHUA HAC-HFW1200SP-S5 ( 2.0MP, hồng ngoại 20m, đèn hồng ngoại Micro Led)', 'Detailed description for Product 2', '2025-03-26 00:18:22', '2025-03-26 00:18:22', NULL),
(28, 'CAM DAHUA HFW1230M', 'SP000034', NULL, 'cái', 2, 3, 1250000.00, 25, 'products/ppNVN7ukFf.jpg', 'Camera IP Dahua DH-IPC-HFW1230M-A-I1-B-S5 2.0MP', 'Detailed description for Product 3', '2025-03-26 00:18:22', '2025-03-26 00:18:22', NULL),
(29, 'CAM DAHUA HFW2433DM', 'SP000035', NULL, 'cái', 2, 3, 2000000.00, 10, 'products/2OiGiku2Le.jpg', 'Camera Dahua DH-IPC-HFW2433DM-LED', 'Detailed description for Product 4', '2025-03-26 00:18:22', '2025-03-26 00:18:22', NULL),
(30, 'CAM DAHUA 3A1200', 'SP000036', NULL, 'cái', 2, 3, 2500000.00, 15, 'products/fcQCO9pF8Y.jpg', 'Camera giám sát IPC PTZ Dahua DH-SD-3A1200-W', 'Detailed description for Product 5', '2025-03-26 00:18:22', '2025-03-26 00:18:22', NULL),
(31, 'CAM DAHUA HFW2633M1', 'SP000037', NULL, 'cái', 2, 3, 3000000.00, 20, 'products/wzfUNCk2Ge.jpg', 'Camera giám sát IPC Dahua 6.0 Megapixel DH-IPC-HFW2633M1-A-I2', 'Detailed description for Product 6', '2025-03-26 00:18:22', '2025-03-26 00:18:22', NULL),
(32, 'CAM HILOOK P220-D/W', 'SP000038', NULL, 'cái', 2, 3, 800000.00, 50, 'products/dK2PGfMyZL.jpg', 'Camera CAM HILOOK P220-D/W', 'Detailed description for Product 1', '2025-03-26 00:18:44', '2025-03-26 00:18:44', NULL),
(33, 'CAM DAHUA HFW1200SP', 'SP000039', NULL, 'cái', 2, 3, 1200000.00, 30, 'products/7WGhQNkdYH.jpg', 'Camera quan sát DAHUA HAC-HFW1200SP-S5 ( 2.0MP, hồng ngoại 20m, đèn hồng ngoại Micro Led)', 'Detailed description for Product 2', '2025-03-26 00:18:44', '2025-03-26 00:18:44', NULL),
(34, 'CAM DAHUA HFW1230M', 'SP000040', NULL, 'cái', 2, 3, 1250000.00, 25, 'products/X9BE9Xd7ax.jpg', 'Camera IP Dahua DH-IPC-HFW1230M-A-I1-B-S5 2.0MP', 'Detailed description for Product 3', '2025-03-26 00:18:44', '2025-03-26 00:18:44', NULL),
(35, 'CAM DAHUA HFW2433DM', 'SP000041', NULL, 'cái', 2, 3, 2000000.00, 10, 'products/MnDvRgcUJ9.jpg', 'Camera Dahua DH-IPC-HFW2433DM-LED', 'Detailed description for Product 4', '2025-03-26 00:18:44', '2025-03-26 00:18:44', NULL),
(36, 'CAM DAHUA 3A1200', 'SP000042', NULL, 'cái', 2, 3, 2500000.00, 15, 'products/81Myft7rKH.jpg', 'Camera giám sát IPC PTZ Dahua DH-SD-3A1200-W', 'Detailed description for Product 5', '2025-03-26 00:18:44', '2025-03-26 00:18:44', NULL),
(37, 'CAM DAHUA HFW2633M1', 'SP000043', NULL, 'cái', 2, 3, 3000000.00, 20, 'products/jYjBkQCROL.jpg', 'Camera giám sát IPC Dahua 6.0 Megapixel DH-IPC-HFW2633M1-A-I2', 'Detailed description for Product 6', '2025-03-26 00:18:44', '2025-03-26 00:18:44', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('98eqX242vO183TzpPYgBVo9eWGthj0EZ4WzLu3nU', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic1gzMjdtTThzMHF6clBTdjNkSDNPYVBheHNsdzNySGkydkVnNFpKdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdG9yZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1742975450);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Lâm Huệ Trung', 'lamhuetrung@gmail.com', NULL, '$2y$12$Hs7H0HTAoTQf/GUpZe0Yze8XqCgKzwTUPvwUyR.7Qs2upuIf1u0WO', NULL, '2025-03-19 19:55:48', '2025-03-19 19:55:48', 'user'),
(2, 'Admin', 'admin@hotmail.com', NULL, '$2y$12$KXD937BgflK3B3QO2IVI5em7iqQ8vxQ9CkewPk2OF4NiSAziVje6y', NULL, '2025-03-25 08:18:30', '2025-03-25 08:18:30', 'admin');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
