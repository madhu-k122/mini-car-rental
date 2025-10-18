-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               9.1.0 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for mini-car-rental
CREATE DATABASE IF NOT EXISTS `mini-car-rental` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mini-car-rental`;

-- Dumping structure for table mini-car-rental.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `b_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `b_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b_car_id` bigint unsigned NOT NULL,
  `b_user_id` bigint unsigned NOT NULL,
  `b_from_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_to_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_start_date` date NOT NULL,
  `b_end_date` date NOT NULL,
  `b_status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `bookings_b_code_unique` (`b_code`),
  KEY `bookings_b_car_id_index` (`b_car_id`),
  KEY `bookings_b_user_id_index` (`b_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.bookings: 0 rows
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` (`b_id`, `b_code`, `b_car_id`, `b_user_id`, `b_from_location`, `b_to_location`, `b_start_date`, `b_end_date`, `b_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'FX1KEGNP1F', 1, 5, 'Hyd', 'khm', '2025-10-20', '2025-10-20', 'pending', '2025-10-18 07:28:23', '2025-10-18 07:28:23', NULL),
	(2, 'YCC8T0B4IU', 3, 6, 'KHM', 'Vizag', '2025-11-20', '2025-11-20', 'pending', '2025-10-18 07:38:07', '2025-10-18 07:38:07', NULL);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;

-- Dumping structure for table mini-car-rental.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.cache: 0 rows
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;

-- Dumping structure for table mini-car-rental.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.cache_locks: 0 rows
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;

-- Dumping structure for table mini-car-rental.cars
CREATE TABLE IF NOT EXISTS `cars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `c_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_user_id` bigint unsigned NOT NULL,
  `c_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_price_per_day` decimal(8,2) NOT NULL,
  `c_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `c_status` tinyint NOT NULL DEFAULT '1',
  `c_created_by` bigint unsigned DEFAULT NULL,
  `c_updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cars_c_code_unique` (`c_code`),
  KEY `1` (`c_user_id`),
  KEY `cars_c_name_index` (`c_name`),
  KEY `cars_c_location_index` (`c_location`),
  KEY `cars_c_is_approved_index` (`c_is_approved`),
  KEY `cars_c_status_index` (`c_status`),
  KEY `cars_c_created_by_index` (`c_created_by`),
  KEY `cars_c_updated_by_index` (`c_updated_by`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.cars: 3 rows
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` (`id`, `c_code`, `c_user_id`, `c_name`, `c_type`, `c_location`, `c_price_per_day`, `c_image`, `c_is_approved`, `c_status`, `c_created_by`, `c_updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'gkLCxA1yR4QFgyBiLjkw', 2, 'Toyota Corolla', 'Sedan', 'Hyderabad', 5000.00, 'cars/1760790679_Screenshot__6_.png', 1, 1, 1, 1, '2025-10-18 07:01:19', '2025-10-18 07:50:23', NULL),
	(2, 'hlCajl1E12xaUWcAV7h3', 2, 'Honda City', 'Sedan', 'Sedan', 100.00, NULL, 0, 0, 1, 1, '2025-10-18 07:03:51', '2025-10-18 07:44:36', NULL),
	(3, 'LKLRwavLQTjtq65CRiix', 4, 'Mahindra Thar', 'SUV', 'Mumbai', 35000.00, 'cars/1760791164_Screenshot__6_.png', 0, 1, 1, NULL, '2025-10-18 07:09:24', '2025-10-18 07:09:24', NULL);
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;

-- Dumping structure for table mini-car-rental.car_availabilities
CREATE TABLE IF NOT EXISTS `car_availabilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `a_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_car_id` bigint unsigned NOT NULL,
  `a_from_date` date NOT NULL,
  `a_to_date` date NOT NULL,
  `a_is_available` tinyint(1) NOT NULL DEFAULT '1',
  `a_status` tinyint NOT NULL DEFAULT '1',
  `a_created_by` bigint unsigned DEFAULT NULL,
  `a_updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `car_availabilities_a_code_unique` (`a_code`),
  KEY `1` (`a_car_id`),
  KEY `car_availabilities_a_is_available_index` (`a_is_available`),
  KEY `car_availabilities_a_status_index` (`a_status`),
  KEY `car_availabilities_a_created_by_index` (`a_created_by`),
  KEY `car_availabilities_a_updated_by_index` (`a_updated_by`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.car_availabilities: 0 rows
/*!40000 ALTER TABLE `car_availabilities` DISABLE KEYS */;
INSERT INTO `car_availabilities` (`id`, `a_code`, `a_car_id`, `a_from_date`, `a_to_date`, `a_is_available`, `a_status`, `a_created_by`, `a_updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'AVYOD0CI', 1, '2025-10-18', '2025-10-23', 1, 1, 2, 2, '2025-10-18 07:22:04', '2025-10-18 07:23:13', NULL),
	(2, 'AV7EH8JY', 1, '2025-10-21', '2025-10-29', 0, 1, 2, 2, '2025-10-18 07:26:37', '2025-10-18 07:26:47', NULL);
/*!40000 ALTER TABLE `car_availabilities` ENABLE KEYS */;

-- Dumping structure for table mini-car-rental.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.failed_jobs: 0 rows
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table mini-car-rental.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.jobs: 0 rows
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Dumping structure for table mini-car-rental.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.job_batches: 0 rows
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;

-- Dumping structure for table mini-car-rental.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.migrations: 8 rows
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_10_14_071055_create_cars_table', 1),
	(5, '2025_10_14_071424_create_car_availabilities_table', 1),
	(6, '2025_10_14_073910_create_sessions_table', 1),
	(7, '2025_10_15_130743_create_bookings_table', 1),
	(8, '2025_10_17_193614_create_personal_access_tokens_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table mini-car-rental.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.personal_access_tokens: 0 rows
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 5, 'customer-token', '113ac95cff7071f9910b570d3371ef4727a8b59c1d96a8dfb80b3516819c3e3f', '["*"]', NULL, NULL, '2025-10-18 07:27:34', '2025-10-18 07:27:34'),
	(2, 'App\\Models\\User', 5, 'customer-token', '1de0d66cc00f796f0b76ca1aafff2deb2b9a93a0e2c97d9609f3163618ba7424', '["*"]', '2025-10-18 07:28:27', NULL, '2025-10-18 07:27:47', '2025-10-18 07:28:27'),
	(3, 'App\\Models\\User', 6, 'customer-token', 'f5497a0d4995caf52a9854bf1eb397a272cf7ef8918287e480089db11d0fbdab', '["*"]', NULL, NULL, '2025-10-18 07:29:22', '2025-10-18 07:29:22'),
	(4, 'App\\Models\\User', 6, 'customer-token', '1c08386c82ef5d848d8a107ade1626bd6e2f9c43593d17dccc67826512cae561', '["*"]', '2025-10-18 08:04:37', NULL, '2025-10-18 07:29:49', '2025-10-18 08:04:37');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table mini-car-rental.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.sessions: 0 rows
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('NZlkSXU2wj8Qn6loFi23gIcuStHn3zxSg4AJPtiR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid3lIRHFEblZWR2k2Zmd1S0RsTWZuakVVZFRSRTJOZjdFMEt2aDI3eCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9taW5pLWNhci1yZW50YWwubG9jYWwvYWRtaW4vYm9va2luZ3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1760793639),
	('O5PCIbrp4P3RPGert3kdcu2zAtorAAg4DP844uXS', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZXl2WVJFa0NDQkk1bWdRbGNzNFV3MUtnVG9TalMyRnh5RzBZbkVVayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9taW5pLWNhci1yZW50YWwubG9jYWwvc3VwcGxpZXIvY2Fycy9ib29raW5ncyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1760793613);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table mini-car-rental.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','supplier','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'supplier',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_code_unique` (`code`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_index` (`role`),
  KEY `users_status_index` (`status`),
  KEY `users_created_by_index` (`created_by`),
  KEY `users_updated_by_index` (`updated_by`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mini-car-rental.users: 4 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `code`, `name`, `email`, `email_verified_at`, `password`, `role`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'zyF7QgaJzFYLF8GGh9hK', 'Madhulatha', 'madhu@gmail.com', NULL, '$2y$12$bBBiCyPCRRNWRWSdK2umq.dzT25/U/fscREB9XRLE4eM9K6bwjz0y', 'admin', 1, NULL, NULL, '2025-10-18 06:56:57', '2025-10-18 06:56:57', NULL),
	(2, 'thDstzWg5I9tQcayYE8F', 'Supplier', 'supplier@gmail.com', NULL, '$2y$12$zCRW5zpa5xxm6HEN2fLlpO0wcYj0EQ5G0L/92uQhk3RwWi7ulkM/.', 'supplier', 1, NULL, NULL, '2025-10-18 06:57:31', '2025-10-18 06:57:31', NULL),
	(3, 'I1i2c5KtNNTZiKLBvuVx', 'Car Supplier', 'carsupplier@gmail.com', NULL, '$2y$12$QMdF66860Hy3qbzsyGv0COewmhXlKCj.I9LEzYnv1Gagq6ON9yACq', 'supplier', 0, NULL, NULL, '2025-10-18 06:58:31', '2025-10-18 06:58:57', '2025-10-18 06:58:57'),
	(4, 'mTJA1J4UbLavRYGfHFsP', 'Auto Supplier', 'autosupplier@gmail.com', NULL, '$2y$12$55l5BKSqxolXrl15H9VmP.uk32C.AzOFw7OIfL9GewMm3AGqlIMzW', 'supplier', 0, NULL, NULL, '2025-10-18 06:59:39', '2025-10-18 06:59:39', NULL),
	(5, 'sfWM8WyJzhLWT8Ug3lAB', 'John Doe', 'john@example.com', NULL, '$2y$12$1MLRSXC0ICR3Z1cb9/pwfOpKek7lNrX5f0ZngXPpFlm.Arfjj44GO', 'customer', 1, NULL, NULL, '2025-10-18 07:27:34', '2025-10-18 07:27:34', NULL),
	(6, 'YXaTLN9iqsGNdCqpWU3G', 'Mini Car', 'mincar@example.com', NULL, '$2y$12$n5mnywLjfL43/InZmayLEuxjJvGYRimFQ8QtYDr1IlMnfSG8MOawu', 'customer', 1, NULL, NULL, '2025-10-18 07:29:22', '2025-10-18 07:29:22', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
