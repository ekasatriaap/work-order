


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_03_03_164204_add_some_field_to_users_table', 1),
	(5, '2025_03_03_215528_create_permission_tables', 1),
	(6, '2025_03_03_215640_create_activity_log_table', 1),
	(7, '2025_03_03_215641_add_event_column_to_activity_log_table', 1),
	(8, '2025_03_03_215642_add_batch_uuid_column_to_activity_log_table', 1),
	(9, '2025_03_03_220006_add_id_role_to_users_table', 1),
	(10, '2025_03_04_230126_create_user_roles_table', 1),
	(11, '2025_03_05_150851_add_field_level_to_roles_table', 1),
	(12, '2025_03_05_164957_create_menu_table', 1),
	(13, '2025_03_07_180341_create_produks_table', 1),
	(14, '2025_03_07_180401_create_tasks_hds_table', 1),
	(15, '2025_03_07_181946_create_task_dts_table', 1),
	(16, '2025_03_07_182735_create_task_progress_table', 1),
	(17, '2025_03_07_185728_add_field_status_to_task_progress_table', 1),
	(18, '2025_03_08_165425_add_field_jumlah_to_task_progress_table', 1),
	(19, '2025_03_08_165507_add_field_jumlah_real_to_task_dt_table', 1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table model_has_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2);

/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table role_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(20, 2),
	(21, 2),
	(22, 2),
	(30, 2),
	(31, 2),
	(32, 2);

/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table produks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `produks`;

CREATE TABLE `produks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_produk` char(5) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `produks_kode_produk_unique` (`kode_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `produks` WRITE;
/*!40000 ALTER TABLE `produks` DISABLE KEYS */;

INSERT INTO `produks` (`id`, `kode_produk`, `nama_produk`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'BRG01', 'Bearing', '2025-03-09 18:15:35', '2025-03-09 18:15:35', NULL),
	(2, 'SK01', 'Siku', '2025-03-09 18:15:43', '2025-03-09 18:15:43', NULL),
	(3, 'PPT01', 'Pipa T', '2025-03-09 18:15:59', '2025-03-09 18:15:59', NULL);

/*!40000 ALTER TABLE `produks` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table task_progress
# ------------------------------------------------------------

DROP TABLE IF EXISTS `task_progress`;

CREATE TABLE `task_progress` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_task_dt` bigint(20) unsigned NOT NULL,
  `note` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('in_progress','completed') NOT NULL DEFAULT 'in_progress',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_progress_id_task_dt_foreign` (`id_task_dt`),
  CONSTRAINT `task_progress_id_task_dt_foreign` FOREIGN KEY (`id_task_dt`) REFERENCES `task_dt` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `task_progress` WRITE;
/*!40000 ALTER TABLE `task_progress` DISABLE KEYS */;

INSERT INTO `task_progress` (`id`, `id_task_dt`, `note`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Mulai membuat', 20, 'in_progress', '2025-03-09 18:36:48', '2025-03-09 18:36:48'),
	(2, 1, 'Selesai', 80, 'completed', '2025-03-09 18:37:08', '2025-03-09 18:37:08'),
	(3, 3, 'Mulai membuat', 5, 'in_progress', '2025-03-09 18:37:45', '2025-03-09 18:37:45'),
	(4, 2, 'Mulai membuat', 3, 'in_progress', '2025-03-09 18:37:54', '2025-03-09 18:37:54'),
	(5, 3, 'Selesai', 20, 'completed', '2025-03-09 18:38:02', '2025-03-09 18:38:02');

/*!40000 ALTER TABLE `task_progress` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_role` bigint(20) unsigned DEFAULT NULL,
  `menu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`menu`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id_role_foreign` (`id_role`),
  CONSTRAINT `menu_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;

INSERT INTO `menu` (`id`, `id_role`, `menu`, `created_at`, `updated_at`) VALUES
	(1, 1, '\"[{\\\"name\\\":\\\"Manajemen User\\\",\\\"icon\\\":\\\"fas fa-users\\\",\\\"child\\\":[{\\\"name\\\":\\\"Users\\\",\\\"url\\\":\\\"user.index\\\",\\\"permissions\\\":[\\\"user.lihat\\\",\\\"user.tambah\\\",\\\"user.ubah\\\",\\\"user.hapus\\\",\\\"user.detail\\\"]},{\\\"name\\\":\\\"Roles\\\",\\\"url\\\":\\\"role.index\\\",\\\"permissions\\\":[\\\"role.lihat\\\",\\\"role.tambah\\\",\\\"role.ubah\\\",\\\"role.hapus\\\",\\\"role.detail\\\"]}]},{\\\"name\\\":\\\"Master\\\",\\\"icon\\\":\\\"fas fa-database\\\",\\\"child\\\":[{\\\"name\\\":\\\"Produk\\\",\\\"url\\\":\\\"produk.index\\\",\\\"permissions\\\":[\\\"produk.lihat\\\",\\\"produk.tambah\\\",\\\"produk.ubah\\\",\\\"produk.hapus\\\"]}]},{\\\"name\\\":\\\"Work Order\\\",\\\"icon\\\":\\\"fas fa-list\\\",\\\"child\\\":[{\\\"name\\\":\\\"Penugasan\\\",\\\"url\\\":\\\"penugasan.index\\\",\\\"permissions\\\":[\\\"penugasan.lihat\\\",\\\"penugasan.tambah\\\",\\\"penugasan.ubah\\\",\\\"penugasan.hapus\\\",\\\"penugasan.detail\\\"]}]},{\\\"name\\\":\\\"Laporan\\\",\\\"icon\\\":\\\"fas fa-file\\\",\\\"child\\\":[{\\\"name\\\":\\\"Work Order\\\",\\\"url\\\":\\\"laporan-work-order.index\\\",\\\"permissions\\\":[\\\"laporan-work-order.lihat\\\"]},{\\\"name\\\":\\\"Petugas\\\",\\\"url\\\":\\\"laporan-petugas.index\\\",\\\"permissions\\\":[\\\"laporan-petugas.lihat\\\"]}]}]\"', '2025-03-09 18:14:18', '2025-03-09 18:14:45'),
	(2, 2, '\"[{\\\"name\\\":\\\"Work Order\\\",\\\"icon\\\":\\\"fas fa-list\\\",\\\"child\\\":{\\\"2\\\":{\\\"name\\\":\\\"Tugas\\\",\\\"url\\\":\\\"tugas.index\\\",\\\"permissions\\\":[\\\"tugas.lihat\\\",\\\"tugas.ubah\\\",\\\"tugas.detail\\\"]}}}]\"', '2025-03-09 18:14:58', '2025-03-09 18:22:08');

/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table cache_locks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'user.lihat', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(2, 'user.tambah', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(3, 'user.ubah', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(4, 'user.hapus', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(5, 'user.detail', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(6, 'role.lihat', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(7, 'role.tambah', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(8, 'role.ubah', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(9, 'role.hapus', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(10, 'role.detail', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(11, 'produk.lihat', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(12, 'produk.tambah', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(13, 'produk.ubah', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(14, 'produk.hapus', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(15, 'penugasan.lihat', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(16, 'penugasan.tambah', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(17, 'penugasan.ubah', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(18, 'penugasan.hapus', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(19, 'penugasan.detail', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(20, 'tugas.lihat', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(21, 'tugas.ubah', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(22, 'tugas.detail', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(23, 'laporan-work-order.lihat', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(24, 'laporan-petugas.lihat', 'web', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(25, 'penugasan-detail.lihat', 'web', '2025-03-09 18:17:46', '2025-03-09 18:17:46'),
	(26, 'penugasan-detail.tambah', 'web', '2025-03-09 18:17:46', '2025-03-09 18:17:46'),
	(27, 'penugasan-detail.ubah', 'web', '2025-03-09 18:17:46', '2025-03-09 18:17:46'),
	(28, 'penugasan-detail.hapus', 'web', '2025-03-09 18:17:46', '2025-03-09 18:17:46'),
	(29, 'penugasan-detail.detail', 'web', '2025-03-09 18:17:46', '2025-03-09 18:17:46'),
	(30, 'tugas-detail.lihat', 'web', '2025-03-09 18:21:53', '2025-03-09 18:21:53'),
	(31, 'tugas-detail.ubah', 'web', '2025-03-09 18:21:53', '2025-03-09 18:21:53'),
	(32, 'tugas-detail.detail', 'web', '2025-03-09 18:21:53', '2025-03-09 18:21:53');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table model_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `is_root` tinyint(1) NOT NULL DEFAULT 0,
  `id_role` bigint(20) unsigned DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_role_foreign` (`id_role`),
  CONSTRAINT `users_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `username`, `is_root`, `id_role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Akun Project Manager', 'project_manager', 0, 1, NULL, NULL, '$2y$12$Lfobdk2iP9g3UzwZAB0C3u4w5wCkThf0x14Dzafna6Cbg39v94ugi', 'BwLg1CgNbv', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(2, 'Akun Operator', 'operator', 0, 2, NULL, NULL, '$2y$12$Lfobdk2iP9g3UzwZAB0C3u4w5wCkThf0x14Dzafna6Cbg39v94ugi', 'BwLg1CgNbv', '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(3, 'Root', 'root', 1, NULL, 'ekasatria.ariaputra@gmail.com', NULL, '$2y$12$ZNIPWyqzGmvjHQdMNhE//uBDFmZ1a8OlyAk788HM7V3ugI5fZW71K', NULL, '2025-03-09 18:13:37', '2025-03-09 18:13:37');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `level`, `created_at`, `updated_at`) VALUES
	(1, 'Project Manager', 'web', 1, '2025-03-09 18:13:37', '2025-03-09 18:13:37'),
	(2, 'Operator', 'web', 2, '2025-03-09 18:13:37', '2025-03-09 18:13:37');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table cache
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('menu_1', 'a:4:{i:0;a:3:{s:4:\"name\";s:14:\"Manajemen User\";s:4:\"icon\";s:12:\"fas fa-users\";s:5:\"child\";a:2:{i:0;a:3:{s:4:\"name\";s:5:\"Users\";s:3:\"url\";s:10:\"user.index\";s:11:\"permissions\";a:5:{i:0;s:10:\"user.lihat\";i:1;s:11:\"user.tambah\";i:2;s:9:\"user.ubah\";i:3;s:10:\"user.hapus\";i:4;s:11:\"user.detail\";}}i:1;a:3:{s:4:\"name\";s:5:\"Roles\";s:3:\"url\";s:10:\"role.index\";s:11:\"permissions\";a:5:{i:0;s:10:\"role.lihat\";i:1;s:11:\"role.tambah\";i:2;s:9:\"role.ubah\";i:3;s:10:\"role.hapus\";i:4;s:11:\"role.detail\";}}}}i:1;a:3:{s:4:\"name\";s:6:\"Master\";s:4:\"icon\";s:15:\"fas fa-database\";s:5:\"child\";a:1:{i:0;a:3:{s:4:\"name\";s:6:\"Produk\";s:3:\"url\";s:12:\"produk.index\";s:11:\"permissions\";a:4:{i:0;s:12:\"produk.lihat\";i:1;s:13:\"produk.tambah\";i:2;s:11:\"produk.ubah\";i:3;s:12:\"produk.hapus\";}}}}i:2;a:3:{s:4:\"name\";s:10:\"Work Order\";s:4:\"icon\";s:11:\"fas fa-list\";s:5:\"child\";a:1:{i:0;a:3:{s:4:\"name\";s:9:\"Penugasan\";s:3:\"url\";s:15:\"penugasan.index\";s:11:\"permissions\";a:5:{i:0;s:15:\"penugasan.lihat\";i:1;s:16:\"penugasan.tambah\";i:2;s:14:\"penugasan.ubah\";i:3;s:15:\"penugasan.hapus\";i:4;s:16:\"penugasan.detail\";}}}}i:3;a:3:{s:4:\"name\";s:7:\"Laporan\";s:4:\"icon\";s:11:\"fas fa-file\";s:5:\"child\";a:2:{i:0;a:3:{s:4:\"name\";s:10:\"Work Order\";s:3:\"url\";s:24:\"laporan-work-order.index\";s:11:\"permissions\";a:1:{i:0;s:24:\"laporan-work-order.lihat\";}}i:1;a:3:{s:4:\"name\";s:7:\"Petugas\";s:3:\"url\";s:21:\"laporan-petugas.index\";s:11:\"permissions\";a:1:{i:0;s:21:\"laporan-petugas.lihat\";}}}}}', 1741630931),
	('menu_2', 'a:1:{i:0;a:3:{s:4:\"name\";s:10:\"Work Order\";s:4:\"icon\";s:11:\"fas fa-list\";s:5:\"child\";a:1:{i:2;a:3:{s:4:\"name\";s:5:\"Tugas\";s:3:\"url\";s:11:\"tugas.index\";s:11:\"permissions\";a:3:{i:0;s:11:\"tugas.lihat\";i:1;s:10:\"tugas.ubah\";i:2;s:12:\"tugas.detail\";}}}}}', 1741631146),
	('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:5:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";s:1:\"j\";s:5:\"level\";}s:11:\"permissions\";a:32:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:10:\"user.lihat\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"user.tambah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"user.ubah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:10:\"user.hapus\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"user.detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:10:\"role.lihat\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:11:\"role.tambah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:9:\"role.ubah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:10:\"role.hapus\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:11:\"role.detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:12:\"produk.lihat\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:13:\"produk.tambah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:11:\"produk.ubah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:12:\"produk.hapus\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"penugasan.lihat\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:16:\"penugasan.tambah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:14:\"penugasan.ubah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:15:\"penugasan.hapus\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:16:\"penugasan.detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:11:\"tugas.lihat\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:10:\"tugas.ubah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:12:\"tugas.detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:24:\"laporan-work-order.lihat\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:21:\"laporan-petugas.lihat\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:22:\"penugasan-detail.lihat\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:23:\"penugasan-detail.tambah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:21:\"penugasan-detail.ubah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:22:\"penugasan-detail.hapus\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:23:\"penugasan-detail.detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:18:\"tugas-detail.lihat\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:17:\"tugas-detail.ubah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:19:\"tugas-detail.detail\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}}s:5:\"roles\";a:2:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:15:\"Project Manager\";s:1:\"c\";s:3:\"web\";s:1:\"j\";i:1;}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:8:\"Operator\";s:1:\"c\";s:3:\"web\";s:1:\"j\";i:2;}}}', 1741630931);

/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('QT5RCbfLXKzIxoFdigbcExSsdZOup0Oce5SwPbi0', 2, '172.18.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNHZNRThqNTJDUUt2NFdlZ2JjUjRzYjRFNG5VUVVMbTIweEN5RkhxNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vbG9jYWxob3N0OjgwODAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1741546129),
	('vENYkPsUaSIUHd5v2ayqysDwtMeEVsWo83Vrkx3c', 1, '172.18.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTXhvOWlJZDB5d0lGTmxCeU9OMmNzc2kwOVo1VUFqUmk0VDJZbVdUQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vbG9jYWxob3N0OjgwODAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1741546126),
	('YKOoZNJcSOA8bdbGAUYR9NpM9nsIdYVyhKvtANNT', NULL, '172.18.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVERzUmZsazk1ZGd4WHlZNEVOaWE4QnlGOHBFeXhaVHVRWUlRT1RSUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDgwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9sb2dpbiI7fX0=', 1741547678);

/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table password_reset_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table task_hd
# ------------------------------------------------------------

DROP TABLE IF EXISTS `task_hd`;

CREATE TABLE `task_hd` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `no_wo` varchar(191) NOT NULL COMMENT 'Nomor Work Order',
  `id_pemberi_tugas` bigint(20) unsigned NOT NULL,
  `id_penerima_tugas` bigint(20) unsigned NOT NULL,
  `deadline` datetime NOT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `status` enum('pending','in_progress','completed','canceled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `task_hd_no_wo_unique` (`no_wo`),
  KEY `task_hd_id_pemberi_tugas_foreign` (`id_pemberi_tugas`),
  KEY `task_hd_id_penerima_tugas_foreign` (`id_penerima_tugas`),
  CONSTRAINT `task_hd_id_pemberi_tugas_foreign` FOREIGN KEY (`id_pemberi_tugas`) REFERENCES `users` (`id`),
  CONSTRAINT `task_hd_id_penerima_tugas_foreign` FOREIGN KEY (`id_penerima_tugas`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `task_hd` WRITE;
/*!40000 ALTER TABLE `task_hd` DISABLE KEYS */;

INSERT INTO `task_hd` (`id`, `no_wo`, `id_pemberi_tugas`, `id_penerima_tugas`, `deadline`, `waktu_mulai`, `waktu_selesai`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'WO-20250309-001', 1, 2, '2025-03-12 10:00:00', '2025-03-09 18:36:48', '2025-03-09 18:37:08', 'completed', '2025-03-09 18:16:25', '2025-03-09 18:37:08'),
	(2, 'WO-20250309-002', 1, 2, '2025-03-11 17:00:00', '2025-03-09 18:37:45', NULL, 'in_progress', '2025-03-09 18:22:55', '2025-03-09 18:37:45'),
	(3, 'WO-20250309-003', 1, 2, '2025-03-15 08:30:00', NULL, NULL, 'canceled', '2025-03-09 18:23:28', '2025-03-09 18:25:33'),
	(4, 'WO-20250309-004', 1, 2, '2025-03-17 07:50:00', NULL, NULL, 'pending', '2025-03-09 18:47:55', '2025-03-09 18:47:55'),
	(5, 'WO-20250309-005', 1, 2, '2025-03-31 03:50:00', NULL, NULL, 'pending', '2025-03-09 18:48:27', '2025-03-09 18:48:27');

/*!40000 ALTER TABLE `task_hd` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table job_batches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `job_batches`;

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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





# Dump of table task_dt
# ------------------------------------------------------------

DROP TABLE IF EXISTS `task_dt`;

CREATE TABLE `task_dt` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_task_hd` bigint(20) unsigned NOT NULL,
  `id_produk` bigint(20) unsigned NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jumlah_real` int(11) DEFAULT NULL COMMENT 'Jumlah realisasi',
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `status` enum('pending','in_progress','completed','canceled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_dt_id_task_hd_foreign` (`id_task_hd`),
  KEY `task_dt_id_produk_foreign` (`id_produk`),
  CONSTRAINT `task_dt_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_dt_id_task_hd_foreign` FOREIGN KEY (`id_task_hd`) REFERENCES `task_hd` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `task_dt` WRITE;
/*!40000 ALTER TABLE `task_dt` DISABLE KEYS */;

INSERT INTO `task_dt` (`id`, `id_task_hd`, `id_produk`, `jumlah`, `jumlah_real`, `waktu_mulai`, `waktu_selesai`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 100, 40, '2025-03-09 18:36:48', '2025-03-09 18:37:08', 'completed', '2025-03-09 18:22:19', '2025-03-09 18:37:08'),
	(2, 2, 2, 10, 3, '2025-03-09 18:37:54', NULL, 'in_progress', '2025-03-09 18:23:02', '2025-03-09 18:37:54'),
	(3, 2, 3, 25, 25, '2025-03-09 18:37:45', '2025-03-09 18:38:02', 'completed', '2025-03-09 18:23:10', '2025-03-09 18:38:02'),
	(4, 4, 3, 100, NULL, NULL, NULL, 'pending', '2025-03-09 18:48:01', '2025-03-09 18:48:01'),
	(5, 5, 1, 100, NULL, NULL, NULL, 'pending', '2025-03-09 18:48:34', '2025-03-09 18:48:34'),
	(6, 5, 2, 80, NULL, NULL, NULL, 'pending', '2025-03-09 18:48:40', '2025-03-09 18:48:40'),
	(7, 5, 3, 12, NULL, NULL, NULL, 'pending', '2025-03-09 18:48:45', '2025-03-09 18:48:45');

/*!40000 ALTER TABLE `task_dt` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table user_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_role` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;

INSERT INTO `user_roles` (`id`, `id_role`, `id_user`) VALUES
	(1, 1, 1),
	(2, 2, 2);

/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table activity_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
	(1, 'auth', 'Login App', NULL, 'login', NULL, 'App\\Models\\User', 3, '[]', NULL, '2025-03-09 18:14:06', '2025-03-09 18:14:06'),
	(2, 'role', 'Manambah dan atau merubah hak akses Project Manager', 'App\\Models\\Menu', 'created', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"id_role\":1,\"menu\":\"[{\\\"name\\\":\\\"Manajemen User\\\",\\\"icon\\\":\\\"fas fa-users\\\",\\\"child\\\":[{\\\"name\\\":\\\"Users\\\",\\\"url\\\":\\\"user.index\\\",\\\"permissions\\\":[\\\"user.lihat\\\",\\\"user.tambah\\\",\\\"user.ubah\\\",\\\"user.hapus\\\",\\\"user.detail\\\"]}]}]\",\"id\":1}}', NULL, '2025-03-09 18:14:18', '2025-03-09 18:14:18'),
	(3, 'role', 'Manambah dan atau merubah hak akses Project Manager', 'App\\Models\\Menu', 'created', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":1,\"id_role\":1,\"menu\":\"[{\\\"name\\\":\\\"Manajemen User\\\",\\\"icon\\\":\\\"fas fa-users\\\",\\\"child\\\":[{\\\"name\\\":\\\"Users\\\",\\\"url\\\":\\\"user.index\\\",\\\"permissions\\\":[\\\"user.lihat\\\",\\\"user.tambah\\\",\\\"user.ubah\\\",\\\"user.hapus\\\",\\\"user.detail\\\"]},{\\\"name\\\":\\\"Roles\\\",\\\"url\\\":\\\"role.index\\\",\\\"permissions\\\":[\\\"role.lihat\\\",\\\"role.tambah\\\",\\\"role.ubah\\\",\\\"role.hapus\\\",\\\"role.detail\\\"]}]}]\"}}', NULL, '2025-03-09 18:14:25', '2025-03-09 18:14:25'),
	(4, 'role', 'Manambah dan atau merubah hak akses Project Manager', 'App\\Models\\Menu', 'created', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":1,\"id_role\":1,\"menu\":\"[{\\\"name\\\":\\\"Manajemen User\\\",\\\"icon\\\":\\\"fas fa-users\\\",\\\"child\\\":[{\\\"name\\\":\\\"Users\\\",\\\"url\\\":\\\"user.index\\\",\\\"permissions\\\":[\\\"user.lihat\\\",\\\"user.tambah\\\",\\\"user.ubah\\\",\\\"user.hapus\\\",\\\"user.detail\\\"]},{\\\"name\\\":\\\"Roles\\\",\\\"url\\\":\\\"role.index\\\",\\\"permissions\\\":[\\\"role.lihat\\\",\\\"role.tambah\\\",\\\"role.ubah\\\",\\\"role.hapus\\\",\\\"role.detail\\\"]}]},{\\\"name\\\":\\\"Master\\\",\\\"icon\\\":\\\"fas fa-database\\\",\\\"child\\\":[{\\\"name\\\":\\\"Produk\\\",\\\"url\\\":\\\"produk.index\\\",\\\"permissions\\\":[\\\"produk.lihat\\\",\\\"produk.tambah\\\",\\\"produk.ubah\\\",\\\"produk.hapus\\\"]}]}]\"}}', NULL, '2025-03-09 18:14:32', '2025-03-09 18:14:32'),
	(5, 'role', 'Manambah dan atau merubah hak akses Project Manager', 'App\\Models\\Menu', 'created', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":1,\"id_role\":1,\"menu\":\"[{\\\"name\\\":\\\"Manajemen User\\\",\\\"icon\\\":\\\"fas fa-users\\\",\\\"child\\\":[{\\\"name\\\":\\\"Users\\\",\\\"url\\\":\\\"user.index\\\",\\\"permissions\\\":[\\\"user.lihat\\\",\\\"user.tambah\\\",\\\"user.ubah\\\",\\\"user.hapus\\\",\\\"user.detail\\\"]},{\\\"name\\\":\\\"Roles\\\",\\\"url\\\":\\\"role.index\\\",\\\"permissions\\\":[\\\"role.lihat\\\",\\\"role.tambah\\\",\\\"role.ubah\\\",\\\"role.hapus\\\",\\\"role.detail\\\"]}]},{\\\"name\\\":\\\"Master\\\",\\\"icon\\\":\\\"fas fa-database\\\",\\\"child\\\":[{\\\"name\\\":\\\"Produk\\\",\\\"url\\\":\\\"produk.index\\\",\\\"permissions\\\":[\\\"produk.lihat\\\",\\\"produk.tambah\\\",\\\"produk.ubah\\\",\\\"produk.hapus\\\"]}]},{\\\"name\\\":\\\"Work Order\\\",\\\"icon\\\":\\\"fas fa-list\\\",\\\"child\\\":[{\\\"name\\\":\\\"Penugasan\\\",\\\"url\\\":\\\"penugasan.index\\\",\\\"permissions\\\":[\\\"penugasan.lihat\\\",\\\"penugasan.tambah\\\",\\\"penugasan.ubah\\\",\\\"penugasan.hapus\\\",\\\"penugasan.detail\\\"]}]}]\"}}', NULL, '2025-03-09 18:14:38', '2025-03-09 18:14:38'),
	(6, 'role', 'Manambah dan atau merubah hak akses Project Manager', 'App\\Models\\Menu', 'created', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":1,\"id_role\":1,\"menu\":\"[{\\\"name\\\":\\\"Manajemen User\\\",\\\"icon\\\":\\\"fas fa-users\\\",\\\"child\\\":[{\\\"name\\\":\\\"Users\\\",\\\"url\\\":\\\"user.index\\\",\\\"permissions\\\":[\\\"user.lihat\\\",\\\"user.tambah\\\",\\\"user.ubah\\\",\\\"user.hapus\\\",\\\"user.detail\\\"]},{\\\"name\\\":\\\"Roles\\\",\\\"url\\\":\\\"role.index\\\",\\\"permissions\\\":[\\\"role.lihat\\\",\\\"role.tambah\\\",\\\"role.ubah\\\",\\\"role.hapus\\\",\\\"role.detail\\\"]}]},{\\\"name\\\":\\\"Master\\\",\\\"icon\\\":\\\"fas fa-database\\\",\\\"child\\\":[{\\\"name\\\":\\\"Produk\\\",\\\"url\\\":\\\"produk.index\\\",\\\"permissions\\\":[\\\"produk.lihat\\\",\\\"produk.tambah\\\",\\\"produk.ubah\\\",\\\"produk.hapus\\\"]}]},{\\\"name\\\":\\\"Work Order\\\",\\\"icon\\\":\\\"fas fa-list\\\",\\\"child\\\":[{\\\"name\\\":\\\"Penugasan\\\",\\\"url\\\":\\\"penugasan.index\\\",\\\"permissions\\\":[\\\"penugasan.lihat\\\",\\\"penugasan.tambah\\\",\\\"penugasan.ubah\\\",\\\"penugasan.hapus\\\",\\\"penugasan.detail\\\"]}]},{\\\"name\\\":\\\"Laporan\\\",\\\"icon\\\":\\\"fas fa-file\\\",\\\"child\\\":[{\\\"name\\\":\\\"Work Order\\\",\\\"url\\\":\\\"laporan-work-order.index\\\",\\\"permissions\\\":[\\\"laporan-work-order.lihat\\\"]}]}]\"}}', NULL, '2025-03-09 18:14:42', '2025-03-09 18:14:42'),
	(7, 'role', 'Manambah dan atau merubah hak akses Project Manager', 'App\\Models\\Menu', 'created', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":1,\"id_role\":1,\"menu\":\"[{\\\"name\\\":\\\"Manajemen User\\\",\\\"icon\\\":\\\"fas fa-users\\\",\\\"child\\\":[{\\\"name\\\":\\\"Users\\\",\\\"url\\\":\\\"user.index\\\",\\\"permissions\\\":[\\\"user.lihat\\\",\\\"user.tambah\\\",\\\"user.ubah\\\",\\\"user.hapus\\\",\\\"user.detail\\\"]},{\\\"name\\\":\\\"Roles\\\",\\\"url\\\":\\\"role.index\\\",\\\"permissions\\\":[\\\"role.lihat\\\",\\\"role.tambah\\\",\\\"role.ubah\\\",\\\"role.hapus\\\",\\\"role.detail\\\"]}]},{\\\"name\\\":\\\"Master\\\",\\\"icon\\\":\\\"fas fa-database\\\",\\\"child\\\":[{\\\"name\\\":\\\"Produk\\\",\\\"url\\\":\\\"produk.index\\\",\\\"permissions\\\":[\\\"produk.lihat\\\",\\\"produk.tambah\\\",\\\"produk.ubah\\\",\\\"produk.hapus\\\"]}]},{\\\"name\\\":\\\"Work Order\\\",\\\"icon\\\":\\\"fas fa-list\\\",\\\"child\\\":[{\\\"name\\\":\\\"Penugasan\\\",\\\"url\\\":\\\"penugasan.index\\\",\\\"permissions\\\":[\\\"penugasan.lihat\\\",\\\"penugasan.tambah\\\",\\\"penugasan.ubah\\\",\\\"penugasan.hapus\\\",\\\"penugasan.detail\\\"]}]},{\\\"name\\\":\\\"Laporan\\\",\\\"icon\\\":\\\"fas fa-file\\\",\\\"child\\\":[{\\\"name\\\":\\\"Work Order\\\",\\\"url\\\":\\\"laporan-work-order.index\\\",\\\"permissions\\\":[\\\"laporan-work-order.lihat\\\"]},{\\\"name\\\":\\\"Petugas\\\",\\\"url\\\":\\\"laporan-petugas.index\\\",\\\"permissions\\\":[\\\"laporan-petugas.lihat\\\"]}]}]\"}}', NULL, '2025-03-09 18:14:45', '2025-03-09 18:14:45'),
	(8, 'role', 'Manambah dan atau merubah hak akses Operator', 'App\\Models\\Menu', 'created', 2, 'App\\Models\\User', 3, '{\"attributes\":{\"id_role\":2,\"menu\":\"[{\\\"name\\\":\\\"Work Order\\\",\\\"icon\\\":\\\"fas fa-list\\\",\\\"child\\\":{\\\"1\\\":{\\\"name\\\":\\\"Tugas\\\",\\\"url\\\":\\\"tugas.index\\\",\\\"permissions\\\":[\\\"tugas.lihat\\\",\\\"tugas.ubah\\\",\\\"tugas.detail\\\"]}}}]\",\"id\":2}}', NULL, '2025-03-09 18:14:58', '2025-03-09 18:14:58'),
	(9, 'role', 'Manambah dan atau merubah hak akses Operator', 'App\\Models\\Menu', 'created', 2, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":2,\"id_role\":2,\"menu\":\"[{\\\"name\\\":\\\"Work Order\\\",\\\"icon\\\":\\\"fas fa-list\\\",\\\"child\\\":{\\\"1\\\":{\\\"name\\\":\\\"Tugas\\\",\\\"url\\\":\\\"tugas.index\\\",\\\"permissions\\\":[\\\"tugas.lihat\\\",\\\"tugas.ubah\\\",\\\"tugas.detail\\\"]}}}]\"}}', NULL, '2025-03-09 18:15:00', '2025-03-09 18:15:00'),
	(10, 'auth', 'Login App', NULL, 'login', NULL, 'App\\Models\\User', 1, '[]', NULL, '2025-03-09 18:15:14', '2025-03-09 18:15:14'),
	(11, 'produk', 'Tambah produk', 'App\\Models\\Produk', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"kode_produk\":\"BRG01\",\"nama_produk\":\"Bearing\",\"id\":1}}', NULL, '2025-03-09 18:15:35', '2025-03-09 18:15:35'),
	(12, 'produk', 'Tambah produk', 'App\\Models\\Produk', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"kode_produk\":\"SK01\",\"nama_produk\":\"Siku\",\"id\":2}}', NULL, '2025-03-09 18:15:43', '2025-03-09 18:15:43'),
	(13, 'produk', 'Tambah produk', 'App\\Models\\Produk', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"kode_produk\":\"PPT01\",\"nama_produk\":\"Pipa T\",\"id\":3}}', NULL, '2025-03-09 18:15:59', '2025-03-09 18:15:59'),
	(14, 'penugasan', 'Tambah penugasan', 'App\\Models\\TaskHd', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id_penerima_tugas\":\"2\",\"deadline\":\"2025-03-12T10:00\",\"id_pemberi_tugas\":1,\"status\":\"pending\",\"no_wo\":\"WO-20250309-001\",\"id\":1}}', NULL, '2025-03-09 18:16:25', '2025-03-09 18:16:25'),
	(15, 'auth', 'Login App', NULL, 'login', NULL, 'App\\Models\\User', 3, '[]', NULL, '2025-03-09 18:16:49', '2025-03-09 18:16:49'),
	(16, 'role', 'Manambah dan atau merubah hak akses Project Manager', 'App\\Models\\Menu', 'created', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":1,\"id_role\":1,\"menu\":\"[{\\\"name\\\":\\\"Manajemen User\\\",\\\"icon\\\":\\\"fas fa-users\\\",\\\"child\\\":[{\\\"name\\\":\\\"Users\\\",\\\"url\\\":\\\"user.index\\\",\\\"permissions\\\":[\\\"user.lihat\\\",\\\"user.tambah\\\",\\\"user.ubah\\\",\\\"user.hapus\\\",\\\"user.detail\\\"]},{\\\"name\\\":\\\"Roles\\\",\\\"url\\\":\\\"role.index\\\",\\\"permissions\\\":[\\\"role.lihat\\\",\\\"role.tambah\\\",\\\"role.ubah\\\",\\\"role.hapus\\\",\\\"role.detail\\\"]}]},{\\\"name\\\":\\\"Master\\\",\\\"icon\\\":\\\"fas fa-database\\\",\\\"child\\\":[{\\\"name\\\":\\\"Produk\\\",\\\"url\\\":\\\"produk.index\\\",\\\"permissions\\\":[\\\"produk.lihat\\\",\\\"produk.tambah\\\",\\\"produk.ubah\\\",\\\"produk.hapus\\\"]}]},{\\\"name\\\":\\\"Work Order\\\",\\\"icon\\\":\\\"fas fa-list\\\",\\\"child\\\":[{\\\"name\\\":\\\"Penugasan\\\",\\\"url\\\":\\\"penugasan.index\\\",\\\"permissions\\\":[\\\"penugasan.lihat\\\",\\\"penugasan.tambah\\\",\\\"penugasan.ubah\\\",\\\"penugasan.hapus\\\",\\\"penugasan.detail\\\"]}]},{\\\"name\\\":\\\"Laporan\\\",\\\"icon\\\":\\\"fas fa-file\\\",\\\"child\\\":[{\\\"name\\\":\\\"Work Order\\\",\\\"url\\\":\\\"laporan-work-order.index\\\",\\\"permissions\\\":[\\\"laporan-work-order.lihat\\\"]},{\\\"name\\\":\\\"Petugas\\\",\\\"url\\\":\\\"laporan-petugas.index\\\",\\\"permissions\\\":[\\\"laporan-petugas.lihat\\\"]}]}]\"}}', NULL, '2025-03-09 18:20:57', '2025-03-09 18:20:57'),
	(17, 'role', 'Manambah dan atau merubah hak akses Operator', 'App\\Models\\Menu', 'created', 2, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":2,\"id_role\":2,\"menu\":\"[{\\\"name\\\":\\\"Work Order\\\",\\\"icon\\\":\\\"fas fa-list\\\",\\\"child\\\":{\\\"2\\\":{\\\"name\\\":\\\"Tugas\\\",\\\"url\\\":\\\"tugas.index\\\",\\\"permissions\\\":[\\\"tugas.lihat\\\",\\\"tugas.ubah\\\",\\\"tugas.detail\\\"]}}}]\"}}', NULL, '2025-03-09 18:22:08', '2025-03-09 18:22:08'),
	(18, 'penugasan detail', 'Tambah penugasan detail', 'App\\Models\\TaskHd', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"no_wo\":\"WO-20250309-001\",\"id_pemberi_tugas\":1,\"id_penerima_tugas\":2,\"deadline\":\"2025-03-12 10:00:00\",\"waktu_mulai\":null,\"waktu_selesai\":null,\"status\":\"pending\"}}', NULL, '2025-03-09 18:22:19', '2025-03-09 18:22:19'),
	(19, 'penugasan', 'Tambah penugasan', 'App\\Models\\TaskHd', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id_penerima_tugas\":\"2\",\"deadline\":\"2025-03-11T17:00\",\"id_pemberi_tugas\":1,\"status\":\"pending\",\"no_wo\":\"WO-20250309-002\",\"id\":2}}', NULL, '2025-03-09 18:22:55', '2025-03-09 18:22:55'),
	(20, 'penugasan detail', 'Tambah penugasan detail', 'App\\Models\\TaskHd', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"no_wo\":\"WO-20250309-002\",\"id_pemberi_tugas\":1,\"id_penerima_tugas\":2,\"deadline\":\"2025-03-11 17:00:00\",\"waktu_mulai\":null,\"waktu_selesai\":null,\"status\":\"pending\"}}', NULL, '2025-03-09 18:23:02', '2025-03-09 18:23:02'),
	(21, 'penugasan detail', 'Tambah penugasan detail', 'App\\Models\\TaskHd', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"no_wo\":\"WO-20250309-002\",\"id_pemberi_tugas\":1,\"id_penerima_tugas\":2,\"deadline\":\"2025-03-11 17:00:00\",\"waktu_mulai\":null,\"waktu_selesai\":null,\"status\":\"pending\"}}', NULL, '2025-03-09 18:23:10', '2025-03-09 18:23:10'),
	(22, 'penugasan', 'Tambah penugasan', 'App\\Models\\TaskHd', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"id_penerima_tugas\":\"2\",\"deadline\":\"2025-03-15T08:30\",\"id_pemberi_tugas\":1,\"status\":\"pending\",\"no_wo\":\"WO-20250309-003\",\"id\":3}}', NULL, '2025-03-09 18:23:28', '2025-03-09 18:23:28'),
	(23, 'penugasan', 'Hapus penugasan', 'App\\Models\\TaskHd', 'updated', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":\"canceled\",\"updated_at\":\"2025-03-09 18:25:33\"}}', NULL, '2025-03-09 18:25:33', '2025-03-09 18:25:33'),
	(24, 'auth', 'Login App', NULL, 'login', NULL, 'App\\Models\\User', 2, '[]', NULL, '2025-03-09 18:25:46', '2025-03-09 18:25:46'),
	(25, 'Tugas Detail', 'Ubah Tugas Detail', 'App\\Models\\TaskDt', 'updated', 1, 'App\\Models\\User', 2, '{\"attributes\":\"{\\\"task_note\\\":{\\\"note\\\":\\\"Mulai membuat\\\",\\\"jumlah\\\":\\\"20\\\"},\\\"task_dt\\\":{\\\"status\\\":\\\"in_progress\\\",\\\"waktu_mulai\\\":\\\"2025-03-09T18:36:48.126057Z\\\",\\\"jumlah_real\\\":\\\"20\\\"},\\\"task_hd\\\":{\\\"id\\\":1,\\\"id_task_hd\\\":1,\\\"id_produk\\\":1,\\\"jumlah\\\":100,\\\"jumlah_real\\\":\\\"20\\\",\\\"waktu_mulai\\\":\\\"2025-03-09T18:36:48.126057Z\\\",\\\"waktu_selesai\\\":null,\\\"status\\\":\\\"in_progress\\\",\\\"created_at\\\":\\\"2025-03-09T18:22:19.000000Z\\\",\\\"updated_at\\\":\\\"2025-03-09T18:36:48.000000Z\\\"}}\"}', NULL, '2025-03-09 18:36:48', '2025-03-09 18:36:48'),
	(26, 'Tugas Detail', 'Ubah Tugas Detail', 'App\\Models\\TaskDt', 'updated', 1, 'App\\Models\\User', 2, '{\"attributes\":\"{\\\"task_note\\\":{\\\"note\\\":\\\"Mulai membuat\\\",\\\"jumlah\\\":\\\"20\\\"},\\\"task_dt\\\":{\\\"status\\\":\\\"completed\\\",\\\"waktu_selesai\\\":\\\"2025-03-09T18:37:08.272792Z\\\",\\\"jumlah_real\\\":40},\\\"task_hd\\\":{\\\"id\\\":1,\\\"id_task_hd\\\":1,\\\"id_produk\\\":1,\\\"jumlah\\\":100,\\\"jumlah_real\\\":40,\\\"waktu_mulai\\\":\\\"2025-03-09 18:36:48\\\",\\\"waktu_selesai\\\":\\\"2025-03-09T18:37:08.272792Z\\\",\\\"status\\\":\\\"completed\\\",\\\"created_at\\\":\\\"2025-03-09T18:22:19.000000Z\\\",\\\"updated_at\\\":\\\"2025-03-09T18:37:08.000000Z\\\"}}\"}', NULL, '2025-03-09 18:37:08', '2025-03-09 18:37:08'),
	(27, 'Tugas Detail', 'Ubah Tugas Detail', 'App\\Models\\TaskDt', 'updated', 3, 'App\\Models\\User', 2, '{\"attributes\":\"{\\\"task_note\\\":{\\\"note\\\":\\\"Mulai membuat\\\",\\\"jumlah\\\":\\\"5\\\"},\\\"task_dt\\\":{\\\"status\\\":\\\"in_progress\\\",\\\"waktu_mulai\\\":\\\"2025-03-09T18:37:45.496501Z\\\",\\\"jumlah_real\\\":\\\"5\\\"},\\\"task_hd\\\":{\\\"id\\\":3,\\\"id_task_hd\\\":2,\\\"id_produk\\\":3,\\\"jumlah\\\":25,\\\"jumlah_real\\\":\\\"5\\\",\\\"waktu_mulai\\\":\\\"2025-03-09T18:37:45.496501Z\\\",\\\"waktu_selesai\\\":null,\\\"status\\\":\\\"in_progress\\\",\\\"created_at\\\":\\\"2025-03-09T18:23:10.000000Z\\\",\\\"updated_at\\\":\\\"2025-03-09T18:37:45.000000Z\\\"}}\"}', NULL, '2025-03-09 18:37:45', '2025-03-09 18:37:45'),
	(28, 'Tugas Detail', 'Ubah Tugas Detail', 'App\\Models\\TaskDt', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":\"{\\\"task_note\\\":{\\\"note\\\":\\\"Mulai membuat\\\",\\\"jumlah\\\":\\\"3\\\"},\\\"task_dt\\\":{\\\"status\\\":\\\"in_progress\\\",\\\"waktu_mulai\\\":\\\"2025-03-09T18:37:54.318268Z\\\",\\\"jumlah_real\\\":\\\"3\\\"},\\\"task_hd\\\":{\\\"id\\\":2,\\\"id_task_hd\\\":2,\\\"id_produk\\\":2,\\\"jumlah\\\":10,\\\"jumlah_real\\\":\\\"3\\\",\\\"waktu_mulai\\\":\\\"2025-03-09T18:37:54.318268Z\\\",\\\"waktu_selesai\\\":null,\\\"status\\\":\\\"in_progress\\\",\\\"created_at\\\":\\\"2025-03-09T18:23:02.000000Z\\\",\\\"updated_at\\\":\\\"2025-03-09T18:37:54.000000Z\\\"}}\"}', NULL, '2025-03-09 18:37:54', '2025-03-09 18:37:54'),
	(29, 'Tugas Detail', 'Ubah Tugas Detail', 'App\\Models\\TaskDt', 'updated', 3, 'App\\Models\\User', 2, '{\"attributes\":\"{\\\"task_note\\\":{\\\"note\\\":\\\"Selesai\\\",\\\"jumlah\\\":\\\"20\\\"},\\\"task_dt\\\":{\\\"status\\\":\\\"completed\\\",\\\"waktu_selesai\\\":\\\"2025-03-09T18:38:02.964158Z\\\",\\\"jumlah_real\\\":25},\\\"task_hd\\\":{\\\"id\\\":3,\\\"id_task_hd\\\":2,\\\"id_produk\\\":3,\\\"jumlah\\\":25,\\\"jumlah_real\\\":25,\\\"waktu_mulai\\\":\\\"2025-03-09 18:37:45\\\",\\\"waktu_selesai\\\":\\\"2025-03-09T18:38:02.964158Z\\\",\\\"status\\\":\\\"completed\\\",\\\"created_at\\\":\\\"2025-03-09T18:23:10.000000Z\\\",\\\"updated_at\\\":\\\"2025-03-09T18:38:02.000000Z\\\"}}\"}', NULL, '2025-03-09 18:38:02', '2025-03-09 18:38:02'),
	(30, 'penugasan', 'Tambah penugasan', 'App\\Models\\TaskHd', 'created', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"id_penerima_tugas\":\"2\",\"deadline\":\"2025-03-17T07:50\",\"id_pemberi_tugas\":1,\"status\":\"pending\",\"no_wo\":\"WO-20250309-004\",\"id\":4}}', NULL, '2025-03-09 18:47:55', '2025-03-09 18:47:55'),
	(31, 'penugasan detail', 'Tambah penugasan detail', 'App\\Models\\TaskHd', 'created', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":4,\"no_wo\":\"WO-20250309-004\",\"id_pemberi_tugas\":1,\"id_penerima_tugas\":2,\"deadline\":\"2025-03-17 07:50:00\",\"waktu_mulai\":null,\"waktu_selesai\":null,\"status\":\"pending\"}}', NULL, '2025-03-09 18:48:01', '2025-03-09 18:48:01'),
	(32, 'penugasan', 'Tambah penugasan', 'App\\Models\\TaskHd', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"id_penerima_tugas\":\"2\",\"deadline\":\"2025-03-31T03:50\",\"id_pemberi_tugas\":1,\"status\":\"pending\",\"no_wo\":\"WO-20250309-005\",\"id\":5}}', NULL, '2025-03-09 18:48:27', '2025-03-09 18:48:27'),
	(33, 'penugasan detail', 'Tambah penugasan detail', 'App\\Models\\TaskHd', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":5,\"no_wo\":\"WO-20250309-005\",\"id_pemberi_tugas\":1,\"id_penerima_tugas\":2,\"deadline\":\"2025-03-31 03:50:00\",\"waktu_mulai\":null,\"waktu_selesai\":null,\"status\":\"pending\"}}', NULL, '2025-03-09 18:48:34', '2025-03-09 18:48:34'),
	(34, 'penugasan detail', 'Tambah penugasan detail', 'App\\Models\\TaskHd', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":5,\"no_wo\":\"WO-20250309-005\",\"id_pemberi_tugas\":1,\"id_penerima_tugas\":2,\"deadline\":\"2025-03-31 03:50:00\",\"waktu_mulai\":null,\"waktu_selesai\":null,\"status\":\"pending\"}}', NULL, '2025-03-09 18:48:40', '2025-03-09 18:48:40'),
	(35, 'penugasan detail', 'Tambah penugasan detail', 'App\\Models\\TaskHd', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":5,\"no_wo\":\"WO-20250309-005\",\"id_pemberi_tugas\":1,\"id_penerima_tugas\":2,\"deadline\":\"2025-03-31 03:50:00\",\"waktu_mulai\":null,\"waktu_selesai\":null,\"status\":\"pending\"}}', NULL, '2025-03-09 18:48:45', '2025-03-09 18:48:45'),
	(36, 'auth', 'Login App', NULL, 'login', NULL, 'App\\Models\\User', 3, '[]', NULL, '2025-03-09 19:14:33', '2025-03-09 19:14:33');

/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


