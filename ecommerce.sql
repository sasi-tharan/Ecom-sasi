-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 07:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=hidden,0=visible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ddd', 'dddd', 'uploads/banner/1710495689.jpg', 0, '2024-03-15 04:11:29', '2024-03-15 04:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_title` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_title`, `status`, `image`, `created_at`, `updated_at`) VALUES
(4, 'Vapes', '0', 'uploads/departments/1708748062.png', '2024-02-23 22:44:22', '2024-02-23 22:44:22'),
(5, 'fruits', '0', 'uploads/departments/1708835922.jpg', '2024-02-24 23:08:42', '2024-02-24 23:08:42'),
(6, 'main departmnt', '0', 'uploads/departments/1709184946.jpg', '2024-02-29 00:05:46', '2024-02-29 00:05:46'),
(7, 'main department 2', '0', 'uploads/departments/1709189031.png', '2024-02-29 01:13:51', '2024-02-29 01:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `group_title` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `department_id`, `group_title`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 5, 'apple', '0', 'uploads/groups/1710486771.jpg', '2024-03-15 01:42:51', '2024-03-15 01:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_02_14_062130_create_roles_table', 2),
(7, '2024_02_14_062645_add_role_id_to_users_table', 3),
(8, '2024_02_14_063419_remove_role_id_from_users_table', 4),
(9, '2024_02_14_063451_remove_role_id_from_users_table', 4),
(10, '2024_02_14_063924_create_users_table', 5),
(11, '2024_02_14_071458_create_permissions_table', 6),
(12, '2024_02_14_083630_create_roles_table', 7),
(13, '2024_02_23_032055_create_departments_table', 8),
(14, '2024_02_23_032132_create_group_table', 8),
(15, '2024_02_23_032155_create_sub_group', 8),
(16, '2024_02_29_122816_create_products_table', 9),
(17, '2024_02_29_123952_create_product_thumbnails_table', 10),
(18, '2024_02_29_124111_create_product_images_table', 11),
(19, '2024_03_01_083349_add_image_to_group_table', 12),
(20, '2024_03_15_063936_create_products_table', 13),
(21, '2024_03_15_064623_add_additional_columns_to_products_table', 14),
(22, '2024_03_15_070824_create_groups_table', 15),
(23, '2024_03_15_071216_add_image_to_groups_table', 16),
(24, '2024_03_15_094031_create_banners_table', 17),
(25, '2024_03_16_045144_create_sub_groups_table', 18),
(26, '2024_03_16_053452_rename_group_foreign_key_in_products_table', 19),
(27, '2024_03_16_054451_add_sub_group_columns_to_products_table', 20),
(28, '2024_03_16_055035_add_status_to_products_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `si_upc` varchar(255) DEFAULT NULL,
  `barcode_sku` varchar(255) DEFAULT NULL,
  `b_m` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `sub_group_id` bigint(20) UNSIGNED NOT NULL,
  `kg_ml` varchar(255) DEFAULT NULL,
  `units` int(11) DEFAULT NULL,
  `ps` varchar(255) DEFAULT NULL,
  `case` int(11) DEFAULT NULL,
  `dimensions` varchar(255) DEFAULT NULL,
  `cp_vat` varchar(255) DEFAULT NULL,
  `is` varchar(255) DEFAULT NULL,
  `lo` varchar(255) DEFAULT NULL,
  `ar` varchar(255) DEFAULT NULL,
  `vat` varchar(255) DEFAULT NULL,
  `wscp_vat` varchar(255) DEFAULT NULL,
  `samson_percent` varchar(255) DEFAULT NULL,
  `unit_rrp` varchar(255) DEFAULT NULL,
  `rupm` varchar(255) DEFAULT NULL,
  `bcqty_1` int(11) DEFAULT NULL,
  `bcp_1` varchar(255) DEFAULT NULL,
  `b_percent_1` varchar(255) DEFAULT NULL,
  `bcqty_2` int(11) DEFAULT NULL,
  `bcp_2` varchar(255) DEFAULT NULL,
  `b_percent_2` varchar(255) DEFAULT NULL,
  `bcqty_3` int(11) DEFAULT NULL,
  `bcp_3` varchar(255) DEFAULT NULL,
  `b_percent_3` varchar(255) DEFAULT NULL,
  `linked_item_1` varchar(255) DEFAULT NULL,
  `linked_item_2` varchar(255) DEFAULT NULL,
  `linked_item_3` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `sub_group_id_1` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_group_id_2` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_group_id_3` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `si_upc`, `barcode_sku`, `b_m`, `product_name`, `product_description`, `department_id`, `group_id`, `sub_group_id`, `kg_ml`, `units`, `ps`, `case`, `dimensions`, `cp_vat`, `is`, `lo`, `ar`, `vat`, `wscp_vat`, `samson_percent`, `unit_rrp`, `rupm`, `bcqty_1`, `bcp_1`, `b_percent_1`, `bcqty_2`, `bcp_2`, `b_percent_2`, `bcqty_3`, `bcp_3`, `b_percent_3`, `linked_item_1`, `linked_item_2`, `linked_item_3`, `status`, `sub_group_id_1`, `sub_group_id_2`, `sub_group_id_3`) VALUES
(2, '2024-03-16 00:06:08', '2024-03-16 00:06:08', '515F5151FDF', '123456849521', 'GmbH', 'Redbull', 'Water, Sucrose, Glucose', 6, 1, 3, '250ml', 24, '1', 100, '2', '18', '2', '3', '3', '5', '4', '15', '3', '33', 3, '33', '33', 33, '33', '3', 33, '33', '333', 'fff', 'fff', 'ffff', 'inactive', NULL, NULL, NULL),
(3, '2024-03-16 00:11:11', '2024-03-16 00:11:11', '515F5151FDF', '123456849521', 'GmbH', 'Album Block Bind Normal', 'dddddddddddddddddddddddd', 5, 1, 1, '250ml', 24, '1', 100, '2', '18', '2', '3', '3', '3', '4', '15', '3', '33', 3, '33', '33', 33, '33', '3', 33, '33', '333', 'dd', 'sad', 'ee', 'inactive', NULL, NULL, NULL),
(4, '2024-03-16 00:19:35', '2024-03-16 00:19:35', '515F5151FDF', '123456849521', 'GmbH', 'Nokia Battery b4', 'ddeeeeeeeeeeeeeeeeeeeeee', 4, 1, 1, '250ml', 3, '1', 3, '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', 3, '3', '3', 3, '3', '3', 3, '3', '3', 'dd', 'ddd', 'dd', 'inactive', 3, 3, 4),
(5, '2024-03-16 00:24:37', '2024-03-16 00:24:37', '515F5151FDF', '123456849521', 'GmbH', 'Album Block Bind Normal', 'fffggvvvv', 4, 1, 3, '250ml', 24, '1', 3, '33', '33', '33', '33', '33', '33', '33', '33', '33', '33', 33, '33', '33', 33, '33', '33', 33, '33', '33', 'sd', 'sad', 'ee', 'active', 3, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `large_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `large_image`, `created_at`, `updated_at`) VALUES
(12, 8, 'uploads/product_large/17095510961.jpg', '2024-03-04 05:48:16', '2024-03-04 05:48:16'),
(13, 8, 'uploads/product_large/17095510962.jpg', '2024-03-04 05:48:16', '2024-03-04 05:48:16'),
(14, 3, 'uploads/product_large/g9WfgFqOvzfo4aC1XOTZaHHDdC37WUSkJwdU8j34.jpg', '2024-03-16 00:11:11', '2024-03-16 00:11:11'),
(15, 4, 'uploads/product_large/T2FmcWbDryb84PGtlXhdvsWDITDs0qMfGfziAkLe.png', '2024-03-16 00:19:35', '2024-03-16 00:19:35'),
(16, 5, 'uploads/product_large/bsxSmT2dgLIcJRYYUOuWuCxpt1eFlmPdJNDGUSLI.jpg', '2024-03-16 00:24:37', '2024-03-16 00:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_thumbnails`
--

CREATE TABLE `product_thumbnails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_thumbnails`
--

INSERT INTO `product_thumbnails` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(11, 8, 'uploads/product_thumbnail/17095510961.jpg', '2024-03-04 05:48:16', '2024-03-04 05:48:16'),
(12, 8, 'uploads/product_thumbnail/17095510962.jpg', '2024-03-04 05:48:16', '2024-03-04 05:48:16'),
(13, 8, 'uploads/product_thumbnail/17095510963.jpg', '2024-03-04 05:48:16', '2024-03-04 05:48:16'),
(14, 3, 'uploads/product_thumbnail/ZpySznGUX6qWUqLmiFPfD5BIaBmUs6zq21Kbj1Dj.jpg', '2024-03-16 00:11:11', '2024-03-16 00:11:11'),
(15, 4, 'uploads/product_thumbnail/iIXoRZQ6V55cmBYHa9LZKy8yBCCcuJzaMtqMwV0R.jpg', '2024-03-16 00:19:35', '2024-03-16 00:19:35'),
(16, 5, 'uploads/product_thumbnail/JRbUiU6Y2AlstTuepmaZKaXGp2q1QlE1hVrE3bFs.jpg', '2024-03-16 00:24:37', '2024-03-16 00:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Wei-Solutions', 'active', '2024-02-14 03:13:40', '2024-02-21 07:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=hidden,0=visible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_groups`
--

CREATE TABLE `sub_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `sub_group_title` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_groups`
--

INSERT INTO `sub_groups` (`id`, `group_id`, `sub_group_title`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'ssssrrrr', 'Inactive', '2024-03-15 23:25:09', '2024-03-15 23:54:57'),
(3, 1, 'dddd', 'Active', '2024-03-15 23:49:25', '2024-03-15 23:49:25'),
(4, 1, 'wssss', 'Inactive', '2024-03-15 23:50:14', '2024-03-15 23:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `user_type` enum('admin','staff','user') NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$UcPkFsKFin6vU8IbRTDyOepU3U5THwiuogQxkvV5CmAECvMHCGGEe', NULL, 'admin', '2024-02-14 01:10:25', '2024-02-14 01:10:25'),
(2, 'sasi', 'sasi.sasitharan12@gmail.com', NULL, '$2y$12$bJl2kO631rfNm8yfqPx8de0dBEV1DQONL5Eoc/N4DkdhZ6V7G3Kzq', NULL, 'staff', '2024-03-04 01:15:49', '2024-03-04 01:15:49'),
(3, 'aaa', 'sasi.sasitharan132@gmail.com', NULL, '$2y$12$lTPLfUkAAHqdnWNcfccoJ.ahqVeP/2WJokRe0fXkiY/rouPhboKcq', NULL, 'admin', '2024-03-04 01:17:48', '2024-03-04 01:17:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_department_id_foreign` (`department_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_department_id_foreign` (`department_id`),
  ADD KEY `products_sub_group_id_foreign` (`sub_group_id`),
  ADD KEY `products_group_id_foreign` (`group_id`),
  ADD KEY `products_sub_group_id_1_foreign` (`sub_group_id_1`),
  ADD KEY `products_sub_group_id_2_foreign` (`sub_group_id_2`),
  ADD KEY `products_sub_group_id_3_foreign` (`sub_group_id_3`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_thumbnails`
--
ALTER TABLE `product_thumbnails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_thumbnails_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_groups`
--
ALTER TABLE `sub_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_groups_group_id_foreign` (`group_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_thumbnails`
--
ALTER TABLE `product_thumbnails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_groups`
--
ALTER TABLE `sub_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_group_id_1_foreign` FOREIGN KEY (`sub_group_id_1`) REFERENCES `sub_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_group_id_2_foreign` FOREIGN KEY (`sub_group_id_2`) REFERENCES `sub_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_group_id_3_foreign` FOREIGN KEY (`sub_group_id_3`) REFERENCES `sub_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_group_id_foreign` FOREIGN KEY (`sub_group_id`) REFERENCES `sub_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_thumbnails`
--
ALTER TABLE `product_thumbnails`
  ADD CONSTRAINT `product_thumbnails_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_groups`
--
ALTER TABLE `sub_groups`
  ADD CONSTRAINT `sub_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
