-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2026 at 02:11 PM
-- Server version: 11.8.6-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u768452900_marisense`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `duration` int(11) DEFAULT NULL COMMENT 'in minutes',
  `max_riders` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `difficulty` enum('Easy','Moderate','Hard') NOT NULL DEFAULT 'Moderate',
  `gear` varchar(255) DEFAULT NULL,
  `status` enum('active','paused') NOT NULL DEFAULT 'active',
  `image` varchar(255) DEFAULT NULL,
  `images` text DEFAULT NULL COMMENT 'JSON array of extra image filenames',
  `price_type` enum('flat','per_person') NOT NULL DEFAULT 'flat',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `description`, `price`, `duration`, `max_riders`, `difficulty`, `gear`, `status`, `image`, `images`, `price_type`, `created_at`, `updated_at`) VALUES
(1, 'Jet Ski', 'Ride across the open sea on a powerful jet ski. Perfect for thrill-seekers who enjoy speed and ocean adventure.', 2500.00, 15, 2, 'Moderate', 'Life vest', 'active', '1777550866_b96ed6947e78862c777a.jpg', '[\"1777550866_286033f3003690ba3ed6.jpg\",\"1777550866_059e30e1add67e5fad20.jpg\",\"1777550866_180094315aa722d17ce5.jpg\"]', 'flat', '2026-04-04 13:17:34', '2026-04-30 12:07:46'),
(2, 'Banana Boat', 'A fun group ride on an inflatable banana-shaped boat pulled by a speedboat. Expect splashes and laughter.', 300.00, 15, 12, 'Easy', 'Life vest', 'active', '1777550898_e51008abe401cf4404d5.jpg', '[\"1777550898_28aa9ad4807545387582.jpg\",\"1777550898_0465d47e26c3ef1f041b.jpg\",\"1777550898_75c7b2740c4edb83167e.jpg\"]', 'per_person', '2026-04-04 13:17:34', '2026-04-30 12:12:52'),
(3, 'Kayaking', 'Paddle along the calm waters and enjoy the scenic view of Matabungkay Beach.', 500.00, 30, 2, 'Easy', 'Life vest', 'active', '1777550805_024ce2a3ad269f25a5a6.jpg', '[\"1777550805_df6559230ef4aca9071a.jpg\",\"1777550805_8cc886c6f3676293f1a0.jpg\",\"1777550805_b1c145f4b7f22fe8c3a4.jpg\"]', 'flat', '2026-04-04 13:17:34', '2026-05-01 03:15:30'),
(4, 'Flying Saucer', 'An exciting inflatable ride that spins and glides across the waves.', 300.00, 15, 10, 'Moderate', 'Life vest', 'active', '1777550878_8f4d72315073931dd9b2.jpg', '[\"1777550878_57dfb381c0aa2c4f9872.jpg\",\"1777550878_646575a83f0b1f8c9a4e.jpg\",\"1777550878_753149dcd07f5ffdca45.jpg\"]', 'per_person', '2026-04-04 13:17:34', '2026-04-30 12:13:08'),
(14, 'Crystal Kayak', 'See through', 500.00, 15, 1, 'Easy', 'Life Vest', 'active', '1778294810_9c82429c89dbc14f5780.jpg', '[\"1778294810_baf882b8956512c76423.webp\",\"1778294810_64e056e7f51b747578af.jpg\",\"1778294810_2318181798c20a6f42fd.webp\"]', 'per_person', '2026-05-09 02:46:50', '2026-05-09 02:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'admin', '2026-03-06 03:46:32'),
(2, 2, 'user', '2026-03-06 09:04:14'),
(3, 3, 'user', '2026-03-06 09:06:35'),
(4, 4, 'user', '2026-03-06 09:17:16'),
(5, 5, 'user', '2026-03-06 09:38:42'),
(6, 6, 'user', '2026-03-06 10:09:28'),
(7, 7, 'admin', '2026-03-06 10:10:40'),
(8, 8, 'user', '2026-03-29 15:49:44'),
(9, 9, 'user', '2026-03-31 16:34:14'),
(10, 10, 'admin', '2026-04-10 03:25:57'),
(11, 14, 'user', '2026-05-01 03:22:53'),
(12, 15, 'user', '2026-05-07 00:27:18'),
(13, 16, 'admin', '2026-05-07 00:36:13'),
(19, 22, 'user', '2026-05-08 14:00:39'),
(20, 23, 'user', '2026-05-08 14:02:29'),
(21, 24, 'admin', '2026-05-10 08:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'admin@gmail.com', '$2y$12$SEO0DizadaVLtCdZVyEshOt9XzxoGopusxGFFNnfyc2aowbNBrBy2', NULL, '{\"email_verified\":true}', 0, NULL, '2026-03-06 03:46:32', '2026-03-06 03:46:32'),
(2, 2, 'email_password', NULL, 'earlsincombenido0@gmail.com', '$2y$12$J.ajDDD.n0Pvfp307PvGN.k2Cr9RQSzwfWysxpoOsl8tPszjPSUYW', NULL, '{\"email_verified\":true}', 0, '2026-05-11 01:59:49', '2026-03-06 09:04:14', '2026-05-11 01:59:49'),
(3, 3, 'email_password', NULL, 'angelcortino@gmail.com', '$2y$12$ffTf0fhZCzo8/9nCP3s82.RHpOrY.97pD.KeViV8EJXNiNOK1.8Uu', NULL, '{\"email_verified\":true}', 0, '2026-03-06 09:34:14', '2026-03-06 09:06:34', '2026-03-06 09:34:14'),
(4, 4, 'email_password', NULL, 'apol@gmail.com', '$2y$12$LjhvgOa7DD3Rkgumv/1ENuNJ9.1frs/8h8MruvE7dbG4kOCStK3QW', NULL, '{\"email_verified\":true}', 0, '2026-03-06 09:17:34', '2026-03-06 09:17:16', '2026-03-06 09:17:34'),
(5, 5, 'email_password', NULL, 'user@gmail.com', '$2y$12$APOCwHqABwS9g7doo69XrOLk3oIjKxgQVl6ne3tKI22UMxcMfrFoW', NULL, '{\"email_verified\":true}', 0, '2026-03-06 10:07:13', '2026-03-06 09:38:42', '2026-03-06 10:07:13'),
(6, 6, 'email_password', NULL, 'useracc@gmail.com', '$2y$12$cs6T0c1wnWYkIyjMPPjUfeZjdwp3r8maE9YqbRCgX9o/gJzeqj7Re', NULL, '{\"email_verified\":true}', 0, '2026-05-06 13:34:44', '2026-03-06 10:09:27', '2026-05-06 13:34:44'),
(7, 7, 'email_password', NULL, 'adminacc@gmail.com', '$2y$12$KBQPWAkiNfzP1qja9eUn2eW6k.k.DHOGjAHgVuuCDrZXGN/LqfBUa', NULL, '{\"email_verified\":true}', 0, '2026-05-06 13:33:50', '2026-03-06 10:10:39', '2026-05-06 13:33:50'),
(9, 8, 'email_password', NULL, 'vian@gmail.com', '$2y$12$xZdi/oYjMNL2Bhg.xQBkpuL.6QCcnTzLzF9R/5iTXGkZSPia8DMjC', NULL, '{\"email_verified\":true}', 0, '2026-05-04 09:01:34', '2026-03-29 15:49:43', '2026-05-04 09:01:34'),
(10, 9, 'email_password', NULL, 'posa@gmail.com', '$2y$12$ny4k/qXJ7ZE8.uNcm1JqeeW2xy4UMBEAO3fTaz/I0OJ8VJK/Wb1MC', NULL, '{\"email_verified\":true}', 0, '2026-04-13 13:01:02', '2026-03-31 16:34:13', '2026-04-13 13:01:02'),
(13, 10, 'email_password', NULL, 'abbbyygarcia@gmail.com', '$2y$12$2CJzm39ZFN/KH.vOmtyFe.1pRsIpAAhnA4J5KdHIaJ5KA1mCAGFVa', NULL, '{\"email_verified\":true}', 0, '2026-05-01 03:15:06', '2026-04-10 03:25:57', '2026-05-01 03:15:06'),
(17, 10, 'magic-link', NULL, 'dbc376a4fdf52bf2e103', NULL, '2026-04-10 04:32:35', NULL, 0, NULL, '2026-04-10 03:32:35', '2026-04-10 03:32:35'),
(19, 2, 'magic-link', NULL, 'e01b63bce9da58246ae4', NULL, '2026-04-10 04:39:35', NULL, 0, NULL, '2026-04-10 03:39:35', '2026-04-10 03:39:35'),
(23, 14, 'email_password', NULL, 'earlsin@gmail.com', '$2y$12$WhMdBFRZidEv4v67QtXeYuZNgwmas2PUHmaIUktVeXU1lOf25jDLK', NULL, '{\"email_verified\":true}', 0, NULL, '2026-05-01 03:22:53', '2026-05-01 03:22:53'),
(24, 15, 'email_password', NULL, 'magnaye.rp@gmail.com', '$2y$12$I6ifdKhNeS..ncXH/qNwZuxhf/Bmeawl99CAh4hovLTmOOxjXBxNq', NULL, '{\"email_verified\":true}', 0, '2026-05-11 22:07:08', '2026-05-07 00:27:18', '2026-05-11 22:07:08'),
(25, 16, 'email_password', NULL, 'admin@g.com', '$2y$12$PlwFXHZ5Xq0eg1V5FaCjfeRnpA6H0yGrPtFxrBSRuR0HQl326WpXK', NULL, '{\"email_verified\":true}', 0, '2026-05-11 13:11:00', '2026-05-07 00:36:13', '2026-05-11 13:11:00'),
(33, 22, 'email_password', NULL, 'ryanwillalwaysremember@gmail.com', '$2y$12$TxjjEmNkMc9dszfJmMQ/.u5yxk25EUBfrFTlsfWV.exYQ4H75qBoG', NULL, '{\"email_verified\":true}', 0, '2026-05-11 22:07:32', '2026-05-08 14:00:39', '2026-05-11 22:07:32'),
(34, 23, 'email_password', NULL, '23-77063@g.batstate-u.edu.ph', '$2y$12$VJb7s4IDBESjneRolF.jiesPRcBfTRSsWq.fnpOsfJu0z7RjU0/LK', NULL, '{\"email_verified\":true}', 0, '2026-05-09 02:22:42', '2026-05-08 14:02:29', '2026-05-09 02:22:42'),
(35, 24, 'email_password', NULL, 'admin@marisense.networq.online', '$2y$12$yaj4boobWvDtI3NP0VtwgeEX/043HEcN.RShuJ77W0OYT5PR9D8W.', NULL, '{\"email_verified\":true}', 0, '2026-05-11 22:09:22', '2026-05-10 08:55:06', '2026-05-11 22:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-03-06 09:04:54', 1),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-03-06 09:59:50', 1),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'admin@gmail.com', NULL, '2026-03-06 10:04:11', 0),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', NULL, '2026-03-06 13:12:46', 0),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-06 13:13:01', 1),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', NULL, '2026-03-06 13:18:28', 0),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-06 13:18:43', 1),
(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-06 13:30:22', 1),
(9, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-06 14:13:53', 1),
(10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-06 14:44:56', 1),
(11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-08 08:36:00', 1),
(12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-08 10:18:16', 1),
(13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-10 02:57:28', 1),
(14, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-11 05:33:47', 1),
(15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-12 13:11:47', 1),
(16, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-14 12:31:17', 1),
(17, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-14 13:10:40', 1),
(18, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-14 14:51:42', 1),
(19, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-16 13:32:08', 1),
(20, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-16 15:29:39', 1),
(21, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-16 16:21:22', 1),
(22, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-18 05:40:11', 1),
(23, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-18 05:43:39', 1),
(24, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-18 14:08:26', 1),
(25, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-29 05:35:33', 1),
(26, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-29 13:52:59', 1),
(27, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-29 13:54:50', 1),
(28, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-29 13:55:52', 1),
(29, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-29 13:56:58', 1),
(30, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-29 13:58:00', 1),
(31, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-03-29 15:06:01', 1),
(32, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-29 16:02:16', 1),
(33, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-03-29 16:03:19', 1),
(34, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-03-31 15:40:36', 1),
(35, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-03-31 15:59:19', 1),
(36, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'posa@gmail.com', 9, '2026-03-31 16:34:27', 1),
(37, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-03-31 16:34:48', 1),
(38, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-04-04 10:40:16', 1),
(39, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-04-04 10:52:55', 1),
(40, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-04-04 11:23:34', 1),
(41, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-04-04 11:55:04', 1),
(42, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'posa@gmail.com', 9, '2026-04-04 13:30:57', 1),
(43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-04-04 13:32:43', 1),
(44, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-04-06 02:19:23', 1),
(45, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-04-06 02:20:44', 1),
(46, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'posa@gmail.com', 9, '2026-04-06 02:21:47', 1),
(47, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'posa@gmail.com', 9, '2026-04-09 14:59:16', 1),
(48, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-04-09 15:56:02', 1),
(49, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-04-09 15:57:10', 1),
(50, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-04-09 15:57:37', 1),
(51, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-04-09 15:57:57', 1),
(52, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-04-09 15:58:26', 1),
(53, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-04-09 16:04:27', 1),
(54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', NULL, '2026-04-10 02:56:36', 0),
(55, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', NULL, '2026-04-10 02:56:43', 0),
(56, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', NULL, '2026-04-10 02:56:50', 0),
(57, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-04-10 02:56:55', 1),
(58, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-04-10 03:04:42', 1),
(59, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 03:24:03', 1),
(60, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 03:24:14', 1),
(61, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', NULL, '2026-04-10 03:24:20', 0),
(62, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', NULL, '2026-04-10 03:24:24', 0),
(63, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', NULL, '2026-04-10 03:26:22', 0),
(64, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 03:26:28', 1),
(65, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 03:26:58', 1),
(66, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 03:40:08', 1),
(67, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 03:40:15', 1),
(68, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 03:40:41', 1),
(69, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 03:42:31', 1),
(70, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 03:42:55', 1),
(71, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 03:50:37', 1),
(72, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 03:50:57', 1),
(73, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 04:19:28', 1),
(74, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'posa@gmail.com', 9, '2026-04-10 04:20:51', 1),
(75, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 04:24:59', 1),
(76, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 04:29:04', 1),
(77, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 04:49:36', 1),
(78, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 04:52:39', 1),
(79, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 04:54:34', 1),
(80, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 04:55:09', 1),
(81, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 04:55:48', 1),
(82, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 04:55:54', 1),
(83, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 05:30:46', 1),
(84, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 06:50:13', 1),
(85, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 06:50:32', 1),
(86, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 07:33:00', 1),
(87, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 07:33:20', 1),
(88, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-10 07:43:24', 1),
(89, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-10 07:59:48', 1),
(90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-11 13:26:41', 1),
(91, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-11 13:29:02', 1),
(92, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-11 13:30:51', 1),
(93, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-11 13:58:26', 1),
(94, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-11 14:15:37', 1),
(95, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-11 15:03:59', 1),
(96, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-11 16:14:19', 1),
(97, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-11 16:14:53', 1),
(98, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-12 13:11:05', 1),
(99, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-12 13:27:27', 1),
(100, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-12 13:34:44', 1),
(101, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-12 13:45:02', 1),
(102, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-12 13:45:17', 1),
(103, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-12 13:46:50', 1),
(104, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-12 13:47:25', 1),
(105, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-12 13:47:46', 1),
(106, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-12 13:50:51', 1),
(107, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-12 13:54:53', 1),
(108, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-13 03:15:40', 1),
(109, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-13 03:44:14', 1),
(110, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-13 03:50:47', 1),
(111, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-13 03:51:10', 1),
(112, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-13 03:53:09', 1),
(113, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-13 03:53:16', 1),
(114, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-13 03:54:10', 1),
(115, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-13 03:59:00', 1),
(116, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-13 03:59:37', 1),
(117, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-13 04:12:04', 1),
(118, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-13 04:19:43', 1),
(119, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-13 04:19:50', 1),
(120, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-13 04:27:03', 1),
(121, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-13 05:07:52', 1),
(122, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-13 05:56:10', 1),
(123, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'posa@gmail.com', 9, '2026-04-13 12:55:10', 1),
(124, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-13 12:58:35', 1),
(125, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'posa@gmail.com', 9, '2026-04-13 12:59:26', 1),
(126, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-13 13:00:44', 1),
(127, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'posa@gmail.com', 9, '2026-04-13 13:01:02', 1),
(128, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-13 13:01:35', 1),
(129, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-13 13:02:55', 1),
(130, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-13 13:03:20', 1),
(131, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-16 12:35:31', 1),
(132, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-16 12:36:33', 1),
(133, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-16 13:41:07', 1),
(134, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-16 13:57:38', 1),
(135, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-18 14:33:21', 1),
(136, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-18 14:35:44', 1),
(137, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-18 14:36:42', 1),
(138, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-18 14:47:14', 1),
(139, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-18 14:49:11', 1),
(140, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-19 13:35:03', 1),
(141, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-19 13:36:24', 1),
(142, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-19 13:57:07', 1),
(143, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-19 13:57:23', 1),
(144, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-19 13:59:40', 1),
(145, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-19 14:03:46', 1),
(146, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-19 14:14:00', 1),
(147, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-19 14:17:41', 1),
(148, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-19 14:18:13', 1),
(149, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-19 14:19:00', 1),
(150, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-19 14:26:51', 1),
(151, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-19 14:47:49', 1),
(152, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-22 07:29:45', 1),
(153, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-22 07:30:49', 1),
(154, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-28 06:44:05', 1),
(155, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-28 06:46:00', 1),
(156, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-28 06:55:37', 1),
(157, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-28 07:08:11', 1),
(158, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-28 07:08:36', 1),
(159, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-28 07:16:19', 1),
(160, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-28 07:28:09', 1),
(161, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-28 07:30:39', 1),
(162, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-28 07:35:46', 1),
(163, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-28 08:03:16', 1),
(164, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-30 11:05:29', 1),
(165, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-30 11:47:59', 1),
(166, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-30 11:59:18', 1),
(167, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-30 12:01:44', 1),
(168, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-30 12:03:50', 1),
(169, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-30 12:04:15', 1),
(170, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-30 12:05:41', 1),
(171, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-30 12:06:11', 1),
(172, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-30 12:06:53', 1),
(173, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-30 12:06:59', 1),
(174, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-30 12:07:08', 1),
(175, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-30 12:07:24', 1),
(176, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-30 12:08:24', 1),
(177, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-30 12:12:30', 1),
(178, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-04-30 12:13:15', 1),
(179, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-04-30 12:15:49', 1),
(180, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-30 12:42:28', 1),
(181, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-04-30 13:13:53', 1),
(182, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-30 13:20:55', 1),
(183, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-04-30 13:48:48', 1),
(184, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-04-30 14:32:12', 1),
(185, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-04-30 14:36:05', 1),
(186, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-05-01 02:53:05', 1),
(187, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', 10, '2026-05-01 03:15:06', 1),
(188, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-05-01 03:15:36', 1),
(189, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earl@gmail.com', NULL, '2026-05-01 03:23:16', 0),
(190, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earl@gmail.com', NULL, '2026-05-01 03:23:26', 0),
(191, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 03:24:18', 1),
(192, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 03:25:39', 1),
(193, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 03:26:01', 1),
(194, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 04:16:40', 1),
(195, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-05-01 04:23:27', 1),
(196, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 04:24:17', 1),
(197, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 04:29:20', 1),
(198, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 04:35:58', 1),
(199, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 04:38:54', 1),
(200, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 04:39:53', 1),
(201, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 04:44:19', 1),
(202, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 04:51:33', 1),
(203, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 04:56:02', 1),
(204, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 04:57:03', 1),
(205, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 05:01:35', 1),
(206, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 14:00:14', 1),
(207, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 14:01:30', 1),
(208, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 14:05:44', 1),
(209, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 14:10:26', 1),
(210, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 14:11:46', 1),
(211, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 14:12:56', 1),
(212, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 14:13:56', 1),
(213, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 14:14:07', 1),
(214, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 14:16:20', 1),
(215, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 14:19:23', 1),
(216, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 14:23:28', 1),
(217, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-01 14:28:26', 1),
(218, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 14:46:06', 1),
(219, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-01 14:50:45', 1),
(220, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-03 04:25:34', 1),
(221, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-03 05:52:33', 1),
(222, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-03 05:55:59', 1),
(223, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-03 06:30:35', 1),
(224, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-03 06:36:46', 1),
(225, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-03 06:44:17', 1),
(226, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-03 06:52:36', 1),
(227, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-03 07:02:06', 1),
(228, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-03 07:03:07', 1),
(229, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-03 07:03:35', 1),
(230, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-03 07:04:21', 1),
(231, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-04 08:21:21', 1),
(232, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-04 08:43:53', 1),
(233, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-04 08:46:01', 1),
(234, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-04 08:54:08', 1);
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(235, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-04 08:55:18', 1),
(236, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-04 08:56:11', 1),
(237, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-04 08:57:43', 1),
(238, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-04 08:58:11', 1),
(239, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'vian@gmail.com', 8, '2026-05-04 09:01:34', 1),
(240, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-04 09:03:29', 1),
(241, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-05-04 09:04:39', 1),
(242, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-04 09:07:42', 1),
(243, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-05-04 09:11:36', 1),
(244, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-04 09:16:18', 1),
(245, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-05-04 09:24:18', 1),
(246, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-04 09:28:27', 1),
(247, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-05-06 13:20:18', 1),
(248, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-06 13:27:58', 1),
(249, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'adminacc@gmail.com', 7, '2026-05-06 13:33:50', 1),
(250, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'useracc@gmail.com', 6, '2026-05-06 13:34:44', 1),
(251, '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', NULL, '2026-05-07 00:26:05', 0),
(252, '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', NULL, '2026-05-07 00:26:13', 0),
(253, '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-07 00:27:51', 1),
(254, '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-07 00:36:36', 1),
(255, '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-07 00:37:02', 1),
(256, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-08 11:51:59', 1),
(257, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-08 11:52:41', 1),
(258, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-08 12:01:19', 1),
(259, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'magic-link', '6755ae2b9ec5242d5a10', 15, '2026-05-08 12:35:08', 1),
(260, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-08 12:47:46', 1),
(261, '103.252.34.6', 'Mozilla/5.0 (Linux; Android 14; 23053RN02A Build/UP1A.231005.007; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/147.0.7727.137 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/560.0.0.55.69;]', 'email_password', 'earlsincombenido0@gmail.com', NULL, '2026-05-08 12:50:36', 0),
(262, '136.239.183.153', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', '23-77063@g.batstate-u.edu.ph', NULL, '2026-05-08 12:53:50', 0),
(263, '136.239.183.153', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/419.4.905781065 Mobile/15E148 Safari/604.1', 'email_password', '23-77063@g.batstate-u.edu.ph', 23, '2026-05-08 14:03:46', 1),
(264, '124.107.151.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', '23-77063@g.batstate-u.edu.ph', 23, '2026-05-09 02:22:42', 1),
(265, '136.239.220.3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'admin@g.com', NULL, '2026-05-09 02:27:07', 0),
(266, '136.239.220.3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'admin@g.com', 16, '2026-05-09 02:27:34', 1),
(267, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-09 11:06:03', 1),
(268, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-09 11:07:06', 1),
(269, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-09 13:03:38', 1),
(270, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-09 22:38:50', 1),
(271, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-09 22:44:30', 1),
(272, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-09 22:57:00', 1),
(273, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-10 08:07:54', 1),
(274, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-10 08:21:51', 1),
(275, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-10 08:27:25', 1),
(276, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', NULL, '2026-05-10 08:47:38', 0),
(277, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-10 08:47:48', 1),
(278, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-10 08:49:14', 1),
(279, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-10 08:51:34', 1),
(280, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@marisense.networq.online', NULL, '2026-05-10 08:58:04', 0),
(281, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@marisense.networq.onlinne', 24, '2026-05-10 08:58:15', 1),
(282, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-10 09:14:16', 1),
(283, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'ryanwillalwaysremember@gmail.com', 22, '2026-05-10 09:35:33', 1),
(284, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@marisense.networq.online', NULL, '2026-05-10 09:36:55', 0),
(285, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@marisense.networq.online', NULL, '2026-05-10 09:37:12', 0),
(286, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@marisense.networq.online', 24, '2026-05-10 09:37:35', 1),
(287, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'ryanwillalwaysremember@gmail.com', 22, '2026-05-10 09:39:50', 1),
(288, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-11 01:38:15', 1),
(289, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-11 01:40:53', 1),
(290, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-11 01:42:38', 1),
(291, '103.252.34.6', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'earlsincombenido0@gmail.com', 2, '2026-05-11 01:59:49', 1),
(292, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-11 03:54:37', 1),
(293, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@g.com', 16, '2026-05-11 13:11:00', 1),
(294, '2602:fa87:1:34::a', 'Mozilla/5.0 (Linux; U; Android 4.0.3; en-gb; KFTT Build/IML74K) AppleWebKit/537.36 (KHTML, like Gecko) Silk/3.68 like Chrome/39.0.2171.93 Safari/537.36', 'email_password', 'mmspfypp@immenseignite.info', NULL, '2026-05-11 20:43:31', 0),
(295, '103.252.34.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'abbbyygarcia@gmail.com', NULL, '2026-05-11 22:05:58', 0),
(296, '103.252.34.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'magnaye.rp@gmail.com', 15, '2026-05-11 22:07:08', 1),
(297, '136.158.46.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'ryanwillalwaysremember@gmail.com', 22, '2026-05-11 22:07:32', 1),
(298, '103.252.34.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'admin@marisense.networq.online', 24, '2026-05-11 22:09:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `booking_code` varchar(20) NOT NULL,
  `activity_id` int(10) UNSIGNED DEFAULT NULL,
  `activity_name` varchar(100) NOT NULL,
  `all_activities` text DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `participants` int(11) NOT NULL DEFAULT 1,
  `participants_per_activity` text DEFAULT NULL,
  `special_requests` text DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `booking_type` enum('booking','reservation') NOT NULL DEFAULT 'booking',
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `down_payment` decimal(10,2) NOT NULL DEFAULT 0.00,
  `down_payment_status` enum('unpaid','paid') NOT NULL DEFAULT 'unpaid',
  `down_payment_paid_at` datetime DEFAULT NULL,
  `status` enum('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `cancel_reason` varchar(255) DEFAULT NULL,
  `payment_status` enum('unpaid','paid') NOT NULL DEFAULT 'unpaid',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `booking_code`, `activity_id`, `activity_name`, `all_activities`, `date`, `time`, `participants`, `participants_per_activity`, `special_requests`, `contact_number`, `booking_type`, `total_amount`, `down_payment`, `down_payment_status`, `down_payment_paid_at`, `status`, `cancel_reason`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 6, 'WWS-8D7186B5', NULL, 'Jet Ski', NULL, '2026-04-04', '09:00:00', 2, NULL, '', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'cancelled', NULL, 'unpaid', '2026-04-04 11:30:53', '2026-04-04 11:30:53'),
(2, 9, 'WWS-0B3D4011', NULL, 'Flying Saucer', NULL, '2026-04-05', '09:00:00', 10, NULL, 'may kanin', NULL, 'booking', 6000.00, 0.00, 'unpaid', NULL, 'cancelled', NULL, 'unpaid', '2026-04-04 13:31:36', '2026-04-04 13:31:36'),
(3, 2, 'WWS-8061E085', NULL, 'Jet Ski', NULL, '2026-04-17', '09:00:00', 2, NULL, 'fdgdhhk', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'cancelled', NULL, 'unpaid', '2026-04-10 04:26:25', '2026-04-10 07:18:21'),
(4, 2, 'WWS-1273D145', NULL, 'Jet Ski', NULL, '2026-04-22', '07:00:00', 1, NULL, '', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'cancelled', NULL, 'unpaid', '2026-04-11 15:44:22', '2026-04-11 15:44:22'),
(5, 2, 'WWS-EE28A6D8', NULL, 'Banana Boat', NULL, '2026-04-13', '08:00:00', 12, NULL, 'asfgdhgfjhgjk', NULL, 'booking', 6000.00, 0.00, 'unpaid', NULL, 'completed', NULL, 'unpaid', '2026-04-13 04:22:39', '2026-04-13 04:22:39'),
(6, 2, 'WWS-9A438C4E', NULL, 'Flying Saucer', NULL, '2026-04-13', '07:00:00', 10, NULL, 'sadfgvb', NULL, 'booking', 6000.00, 0.00, 'unpaid', NULL, 'completed', NULL, 'unpaid', '2026-04-13 04:25:37', '2026-04-13 04:25:37'),
(7, 9, 'WWS-61F25FE8', NULL, 'Banana Boat', NULL, '2026-04-14', '08:00:00', 12, NULL, 'none', NULL, 'booking', 6000.00, 0.00, 'unpaid', NULL, 'completed', NULL, 'unpaid', '2026-04-13 12:57:38', '2026-04-13 12:57:38'),
(8, 9, 'WWS-9A92E760', NULL, 'Kayaking', NULL, '2026-04-14', '09:00:00', 2, NULL, 'dsd', NULL, 'booking', 300.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-13 13:00:35', '2026-04-13 13:00:35'),
(9, 9, 'WWS-27467615', NULL, 'Jet Ski', NULL, '2026-04-14', '08:00:00', 2, NULL, '', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-13 13:01:20', '2026-04-13 13:01:20'),
(10, 2, 'WWS-79EA4C14', NULL, 'Jet Ski', NULL, '2026-04-30', '10:00:00', 2, NULL, 'none', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-16 12:53:41', '2026-04-16 12:53:41'),
(11, 2, 'WWS-88802208', NULL, 'Flying Saucer', NULL, '2026-04-17', '07:00:00', 2, NULL, 'none', NULL, 'booking', 1200.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-16 13:08:57', '2026-04-16 13:08:57'),
(12, 2, 'WWS-AE920DB9', NULL, 'Jet Ski', NULL, '2026-04-16', '12:00:00', 2, NULL, '', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-16 13:22:46', '2026-04-16 13:22:46'),
(13, 2, 'WWS-EBF37EF5', NULL, 'Jet Ski', NULL, '2026-04-30', '07:00:00', 2, NULL, 'none', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-16 13:34:08', '2026-04-16 13:34:08'),
(14, 2, 'WWS-96A1ACA0', NULL, 'Jet Ski', NULL, '2026-04-17', '13:00:00', 2, NULL, '', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-16 13:39:50', '2026-04-16 13:39:50'),
(15, 2, 'WWS-FC69EF9D', NULL, 'Jet Ski', NULL, '2026-04-18', '16:00:00', 12, NULL, 'none', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-16 13:59:30', '2026-04-16 13:59:30'),
(16, 2, 'WWS-41466D22', NULL, 'Banana Boat', NULL, '2026-04-18', '07:00:00', 4, NULL, '', NULL, 'booking', 2000.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-16 14:02:45', '2026-04-16 14:02:45'),
(17, 2, 'WWS-1D78C191', NULL, 'Jet Ski', NULL, '2026-04-19', '16:00:00', 14, NULL, 'none', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-18 15:15:40', '2026-04-18 15:15:40'),
(18, 2, 'WWS-C4B11C2F', 4, 'Flying Saucer', 'Flying Saucer,Kayaking', '2026-04-20', '09:00:00', 5, NULL, 'none', '09634312395', 'booking', 3000.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-19 14:37:54', '2026-04-19 14:37:54'),
(19, 2, 'WWS-709462C0', 2, 'Banana Boat', 'Banana Boat,Jet Ski', '2026-04-22', '07:00:00', 14, NULL, 'none', '09277471724', 'booking', 7000.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-19 14:41:03', '2026-04-19 14:41:03'),
(20, 6, 'WWS-A8AE37D5', 3, 'Kayaking', 'Kayaking', '2026-05-10', '15:00:00', 2, NULL, 'none', '09634312395', 'booking', 300.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-30 12:19:35', '2026-04-30 12:19:35'),
(21, 6, 'WWS-82E484E2', 4, 'Flying Saucer', 'Flying Saucer,Kayaking', '2026-05-10', '08:00:00', 12, NULL, 'none', '09277471724', 'booking', 3600.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-30 12:24:22', '2026-04-30 12:24:22'),
(22, 6, 'WWS-C205541D', 3, 'Kayaking', 'Kayaking,Flying Saucer', '2026-05-10', '07:00:00', 12, NULL, 'none', '09634312395', 'booking', 300.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-30 12:37:57', '2026-04-30 12:37:57'),
(23, 6, 'WWS-2A3A7632', 3, 'Kayaking', 'Kayaking,Flying Saucer,Banana Boat', '2026-05-03', '16:00:00', 24, NULL, 'none', '09277471724', 'booking', 300.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-30 13:15:07', '2026-04-30 13:15:07'),
(24, 6, 'WWS-1E498228', 1, 'Jet Ski', 'Jet Ski,Flying Saucer', '2026-05-10', '08:00:00', 12, NULL, 'none', '09277471724', 'booking', 2500.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-04-30 13:51:15', '2026-04-30 13:51:15'),
(25, 6, 'WWS-24F2A04F', 2, 'Banana Boat', 'Banana Boat,Jet Ski', '2026-05-07', '09:00:00', 13, NULL, 'none', '09634312395', 'booking', 3900.00, 0.00, 'unpaid', NULL, 'completed', NULL, 'paid', '2026-04-30 14:03:01', '2026-04-30 14:31:46'),
(26, 6, 'WWS-FC17B733', 2, 'Banana Boat', 'Banana Boat,Kayaking', '2026-05-01', '16:00:00', 14, NULL, 'none', '09634312395', 'booking', 4200.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-05-01 02:54:20', '2026-05-01 02:54:20'),
(27, 6, 'WWS-1D3A6BB1', 4, 'Flying Saucer', 'Flying Saucer,Kayaking', '2026-05-02', '10:00:00', 12, NULL, 'none', '09634312395', 'booking', 3600.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'paid', '2026-05-01 02:55:29', '2026-05-01 02:56:31'),
(28, 6, 'WWS-2245051C', 1, 'Jet Ski', 'Jet Ski,Kayaking', '2026-05-10', '16:00:00', 4, NULL, 'none', '09634312395', 'booking', 2500.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-05-01 03:11:02', '2026-05-01 03:11:02'),
(29, 6, 'WWS-F2ED134D', 3, 'Kayaking', 'Kayaking,Jet Ski', '2026-05-10', '14:00:00', 4, NULL, 'none', '09277471724', 'booking', 500.00, 0.00, 'unpaid', NULL, 'confirmed', NULL, 'paid', '2026-05-01 03:16:33', '2026-05-01 03:19:20'),
(30, 6, 'WWS-6987DF9C', 2, 'Banana Boat', 'Banana Boat', '2026-05-10', '14:00:00', 12, NULL, 'none', '09634312395', 'booking', 3600.00, 0.00, 'unpaid', NULL, 'confirmed', NULL, 'paid', '2026-05-01 03:20:36', '2026-05-01 03:21:10'),
(31, 8, 'WWS-B8613F49', 2, 'Banana Boat', 'Banana Boat', '2026-05-10', '16:00:00', 12, NULL, 'none', '09277471724', 'booking', 3600.00, 0.00, 'unpaid', NULL, 'completed', NULL, 'paid', '2026-05-01 03:24:52', '2026-05-01 03:25:12'),
(32, 8, 'WWS-F3ECC4E0', 1, 'Jet Ski', 'Jet Ski,Kayaking', '2026-05-10', '15:00:00', 4, NULL, 'none', '09277471724', 'booking', 2500.00, 0.00, 'unpaid', NULL, 'cancelled', NULL, 'unpaid', '2026-05-01 03:27:00', '2026-05-01 03:27:00'),
(33, 8, 'WWS-1BCA572E', 3, 'Kayaking', 'Kayaking,Jet Ski', '2026-05-10', '16:00:00', 4, NULL, 'none', '09634312395', 'booking', 3000.00, 0.00, 'unpaid', NULL, 'cancelled', NULL, 'paid', '2026-05-01 04:12:15', '2026-05-01 04:12:52'),
(34, 2, 'WWS-C3E10D5D', 4, 'Flying Saucer', 'Flying Saucer', '2026-05-10', '16:00:00', 10, NULL, 'none', '09634312395', 'booking', 3000.00, 0.00, 'unpaid', NULL, 'completed', NULL, 'paid', '2026-05-01 04:23:47', '2026-05-01 04:24:02'),
(35, 8, 'WWS-54595354', 3, 'Kayaking', 'Kayaking', '2026-05-10', '08:00:00', 2, NULL, 'may hika ang isa', '09277471724', 'booking', 500.00, 0.00, 'unpaid', NULL, 'cancelled', NULL, 'paid', '2026-05-01 04:39:24', '2026-05-01 04:39:40'),
(36, 8, 'WWS-02953AB4', 4, 'Flying Saucer', 'Flying Saucer', '2026-05-10', '15:00:00', 10, NULL, 'may hika kasama ko kaya dahan dahan lang po', '09277471724', 'booking', 3000.00, 1500.00, 'paid', '2026-05-01 14:23:55', 'confirmed', NULL, 'paid', '2026-05-01 04:56:33', '2026-05-01 14:24:11'),
(37, 8, 'WWS-D9C35B19', 13, 'gigabit', 'gigabit', '2026-05-10', '16:00:00', 1, NULL, 'may hika', '09634312395', 'booking', 100.00, 0.00, 'unpaid', NULL, 'cancelled', NULL, 'paid', '2026-05-01 14:12:18', '2026-05-01 14:12:37'),
(38, 8, 'WWS-B7868C41', 3, 'Kayaking', 'Kayaking,Jet Ski', '2026-05-10', '16:00:00', 4, NULL, 'may hika kasama', '09634312395', 'booking', 3000.00, 0.00, 'unpaid', NULL, 'completed', NULL, 'paid', '2026-05-03 05:51:17', '2026-05-03 05:52:14'),
(39, 8, 'WWS-3689E074', 3, 'Kayaking', 'Kayaking,Jet Ski', '2026-05-10', '16:30:00', 4, NULL, 'none', '09277471724', 'booking', 3000.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'paid', '2026-05-03 06:30:01', '2026-05-03 06:30:28'),
(40, 8, 'WWS-02E4DB35', 1, 'Jet Ski', 'Jet Ski,Kayaking', '2026-05-10', '16:45:00', 4, NULL, 'none', '09634312395', 'booking', 3000.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'paid', '2026-05-03 06:55:19', '2026-05-03 07:03:28'),
(41, 8, 'WWS-8EEDF499', 1, 'Jet Ski', 'Jet Ski,Flying Saucer,Kayaking,Banana Boat', '2026-05-10', '07:00:00', 5, NULL, 'may hika', '09277471724', 'booking', 6000.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'paid', '2026-05-03 07:06:22', '2026-05-03 07:08:03'),
(42, 8, 'WWS-C21EF9C5', 2, 'Banana Boat', 'Banana Boat', '2026-05-23', '07:00:00', 12, NULL, '', '09634312395', 'booking', 3600.00, 0.00, 'unpaid', NULL, 'pending', NULL, 'unpaid', '2026-05-04 08:48:00', '2026-05-04 08:48:00'),
(43, 8, 'WWS-387237EF', 3, 'Kayaking', 'Kayaking', '2026-05-18', '16:30:00', 2, NULL, '', '09277471724', 'booking', 500.00, 0.00, 'unpaid', NULL, 'completed', NULL, 'paid', '2026-05-04 08:48:24', '2026-05-04 08:48:44'),
(44, 8, 'WWS-80F04924', 2, 'Banana Boat', 'Banana Boat,Jet Ski', '2026-05-12', '11:30:00', 14, NULL, '', '09277471724', 'booking', 6700.00, 3350.00, 'paid', '2026-05-04 08:57:57', 'pending', NULL, 'unpaid', '2026-05-04 08:49:56', '2026-05-04 08:57:57'),
(45, 8, 'WWS-3920D9BF', 3, 'Kayaking', 'Kayaking,Flying Saucer,Banana Boat,Jet Ski', '2026-05-27', '07:00:00', 18, NULL, '', '09634312395', 'booking', 13800.00, 0.00, 'unpaid', NULL, 'confirmed', NULL, 'paid', '2026-05-04 08:52:58', '2026-05-04 08:55:56'),
(46, 8, 'WWS-B420E065', 3, 'Kayaking', 'Kayaking,Jet Ski', '2026-05-10', '13:00:00', 4, NULL, '', '09634312395', 'booking', 3000.00, 0.00, 'unpaid', NULL, 'confirmed', NULL, 'unpaid', '2026-05-04 09:02:02', '2026-05-04 09:02:02'),
(47, 8, 'WWS-8045C506', 1, 'Jet Ski', 'Jet Ski', '2026-05-31', '16:45:00', 2, NULL, '', '09277471724', 'booking', 2500.00, 0.00, 'unpaid', NULL, 'completed', NULL, 'paid', '2026-05-04 09:03:10', '2026-05-04 09:03:20'),
(48, 6, 'WWS-3A5329E6', 4, 'Flying Saucer', 'Flying Saucer', '2026-05-24', '16:15:00', 10, NULL, '', '09277471724', 'booking', 3000.00, 0.00, 'unpaid', NULL, 'cancelled', NULL, 'unpaid', '2026-05-04 09:05:25', '2026-05-04 09:05:25'),
(49, 6, 'WWS-43E1D51E', 3, 'Kayaking', 'Kayaking,Jet Ski', '2026-05-23', '16:30:00', 4, NULL, '', '09277471724', 'booking', 3000.00, 1500.00, 'paid', '2026-05-04 09:24:47', 'completed', NULL, 'unpaid', '2026-05-04 09:12:35', '2026-05-04 09:24:47'),
(50, 6, 'WWS-335F1B51', 3, 'Kayaking', 'Kayaking,Jet Ski', '2026-05-13', '16:30:00', 4, NULL, 'none', '09634312395', 'booking', 3000.00, 0.00, 'unpaid', NULL, 'cancelled', NULL, 'paid', '2026-05-06 13:35:24', '2026-05-06 13:36:10'),
(51, 23, 'WWS-33CA6D6C', 3, 'Kayaking', 'Kayaking,Banana Boat,Flying Saucer,Jet Ski', '2026-05-11', '13:00:00', 18, NULL, 'May hika ako', '09913354660', 'booking', 13800.00, 6900.00, 'paid', '2026-05-09 02:25:34', 'cancelled', NULL, 'unpaid', '2026-05-09 02:25:01', '2026-05-09 02:29:58'),
(52, 23, 'WWS-D61E9104', 14, 'Crystal Kayak', 'Crystal Kayak,Jet Ski', '2026-05-21', '09:15:00', 3, NULL, '', '09913354660', 'booking', 4000.00, 2000.00, 'paid', '2026-05-09 02:49:45', 'completed', NULL, 'paid', '2026-05-09 02:48:34', '2026-05-11 13:11:40'),
(53, 15, 'WWS-397E8481', 2, 'Banana Boat', 'Banana Boat', '2026-05-11', '13:45:00', 1, NULL, '', '09913084036', 'booking', 300.00, 150.00, 'paid', '2026-05-11 13:10:15', 'completed', NULL, 'paid', '2026-05-11 13:06:33', '2026-05-11 13:11:16'),
(54, 15, 'WWS-28E8D74A', 2, 'Banana Boat', 'Banana Boat', '2026-05-11', '13:15:00', 1, NULL, '', '34135151324513', 'booking', 300.00, 150.00, 'paid', '2026-05-11 13:09:26', 'completed', NULL, 'paid', '2026-05-11 13:07:31', '2026-05-11 13:11:24');

--
-- Triggers `bookings`
--
DELIMITER $$
CREATE TRIGGER `trg_after_booking_insert` AFTER INSERT ON `bookings` FOR EACH ROW BEGIN
  -- Always insert into booking_details
  INSERT INTO `booking_details`
    (booking_id, booking_code, user_id, activity_name, all_activities,
     booking_date, booking_time, participants, contact_number,
     special_requests, total_amount, down_payment, down_payment_status,
     payment_status, booking_type, status, created_at, updated_at)
  VALUES
    (NEW.id, NEW.booking_code, NEW.user_id, NEW.activity_name, NEW.all_activities,
     NEW.date, NEW.time, NEW.participants, NEW.contact_number,
     NEW.special_requests, NEW.total_amount, NEW.down_payment, NEW.down_payment_status,
     NEW.payment_status, NEW.booking_type, NEW.status, NOW(), NOW());

  -- Insert into sales only for non-cancelled bookings
  IF NEW.status != 'cancelled' THEN
    INSERT INTO `sales`
      (booking_id, booking_code, user_id, activity_name, all_activities,
       participants, sale_date, sale_recorded_at,
       total_amount, amount_paid, balance,
       payment_status, booking_status, created_at, updated_at)
    VALUES
      (NEW.id, NEW.booking_code, NEW.user_id, NEW.activity_name, NEW.all_activities,
       NEW.participants, NEW.date, NOW(),
       NEW.total_amount, 0, NEW.total_amount,
       'unpaid', NEW.status, NOW(), NOW());
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_after_booking_update` AFTER UPDATE ON `bookings` FOR EACH ROW BEGIN
  DECLARE v_amount_paid  DECIMAL(10,2) DEFAULT 0;
  DECLARE v_balance      DECIMAL(10,2) DEFAULT 0;
  DECLARE v_pay_status   VARCHAR(20) DEFAULT 'unpaid';

  -- Calculate amount paid
  IF NEW.payment_status = 'paid' THEN
    SET v_amount_paid = NEW.total_amount;
    SET v_balance     = 0;
    SET v_pay_status  = 'paid';
  ELSEIF NEW.down_payment_status = 'paid' THEN
    SET v_amount_paid = NEW.down_payment;
    SET v_balance     = NEW.total_amount - NEW.down_payment;
    SET v_pay_status  = 'partial';
  ELSE
    SET v_amount_paid = 0;
    SET v_balance     = NEW.total_amount;
    SET v_pay_status  = 'unpaid';
  END IF;

  -- Sync booking_details
  UPDATE `booking_details`
  SET
    status               = NEW.status,
    payment_status       = NEW.payment_status,
    down_payment_status  = NEW.down_payment_status,
    down_payment_paid_at = NEW.down_payment_paid_at,
    down_payment         = NEW.down_payment,
    total_amount         = NEW.total_amount,
    contact_number       = NEW.contact_number,
    confirmed_at         = CASE WHEN NEW.status = 'confirmed'  AND OLD.status != 'confirmed'  THEN NOW() ELSE confirmed_at END,
    completed_at         = CASE WHEN NEW.status = 'completed'  AND OLD.status != 'completed'  THEN NOW() ELSE completed_at END,
    cancelled_at         = CASE WHEN NEW.status = 'cancelled'  AND OLD.status != 'cancelled'  THEN NOW() ELSE cancelled_at END,
    updated_at           = NOW()
  WHERE booking_id = NEW.id;

  -- Sync or insert sales row
  IF NEW.status = 'cancelled' THEN
    -- Remove from sales if booking is cancelled
    DELETE FROM `sales` WHERE booking_id = NEW.id;
  ELSE
    INSERT INTO `sales`
      (booking_id, booking_code, user_id, activity_name, all_activities,
       participants, sale_date, sale_recorded_at,
       total_amount, amount_paid, balance,
       payment_status, booking_status, created_at, updated_at)
    VALUES
      (NEW.id, NEW.booking_code, NEW.user_id, NEW.activity_name, NEW.all_activities,
       NEW.participants, NEW.date, NOW(),
       NEW.total_amount, v_amount_paid, v_balance,
       v_pay_status, NEW.status, NOW(), NOW())
    ON DUPLICATE KEY UPDATE
      total_amount    = NEW.total_amount,
      amount_paid     = v_amount_paid,
      balance         = v_balance,
      payment_status  = v_pay_status,
      booking_status  = NEW.status,
      updated_at      = NOW();
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `booking_code` varchar(20) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `activity_name` varchar(100) NOT NULL,
  `all_activities` text DEFAULT NULL COMMENT 'Comma-separated if multi-activity',
  `activity_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `duration_minutes` int(11) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `participants` int(11) NOT NULL DEFAULT 1,
  `contact_number` varchar(20) DEFAULT NULL,
  `special_requests` text DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `down_payment` decimal(10,2) NOT NULL DEFAULT 0.00,
  `down_payment_status` enum('unpaid','paid') NOT NULL DEFAULT 'unpaid',
  `down_payment_paid_at` datetime DEFAULT NULL,
  `payment_status` enum('unpaid','paid') NOT NULL DEFAULT 'unpaid',
  `payment_method` varchar(50) DEFAULT NULL,
  `gcash_ref` varchar(100) DEFAULT NULL,
  `gcash_receipt_path` varchar(255) DEFAULT NULL,
  `booking_type` enum('booking','reservation') NOT NULL DEFAULT 'booking',
  `status` enum('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `confirmed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `cancellation_reason` text DEFAULT NULL,
  `sea_wind_speed` varchar(20) DEFAULT NULL,
  `sea_wave_height` varchar(20) DEFAULT NULL,
  `sea_wave_period` varchar(20) DEFAULT NULL,
  `sea_safety_status` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `booking_id`, `booking_code`, `user_id`, `username`, `activity_name`, `all_activities`, `activity_price`, `duration_minutes`, `booking_date`, `booking_time`, `participants`, `contact_number`, `special_requests`, `total_amount`, `down_payment`, `down_payment_status`, `down_payment_paid_at`, `payment_status`, `payment_method`, `gcash_ref`, `gcash_receipt_path`, `booking_type`, `status`, `confirmed_at`, `completed_at`, `cancelled_at`, `cancellation_reason`, `sea_wind_speed`, `sea_wave_height`, `sea_wave_period`, `sea_safety_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'WWS-8D7186B5', 6, NULL, 'Jet Ski', NULL, 0.00, NULL, '2026-04-04', '09:00:00', 2, NULL, '', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'cancelled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 11:30:53', '2026-04-04 11:30:53'),
(2, 2, 'WWS-0B3D4011', 9, NULL, 'Flying Saucer', NULL, 0.00, NULL, '2026-04-05', '09:00:00', 10, NULL, 'may kanin', 6000.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'cancelled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:31:36', '2026-04-04 13:31:36'),
(3, 3, 'WWS-8061E085', 2, NULL, 'Jet Ski', NULL, 0.00, NULL, '2026-04-17', '09:00:00', 2, NULL, 'fdgdhhk', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'cancelled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 04:26:25', '2026-04-10 07:18:21'),
(4, 4, 'WWS-1273D145', 2, NULL, 'Jet Ski', NULL, 0.00, NULL, '2026-04-22', '07:00:00', 1, NULL, '', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'cancelled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 15:44:22', '2026-04-11 15:44:22'),
(5, 5, 'WWS-EE28A6D8', 2, NULL, 'Banana Boat', NULL, 0.00, NULL, '2026-04-13', '08:00:00', 12, NULL, 'asfgdhgfjhgjk', 6000.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 04:22:39', '2026-04-13 04:22:39'),
(6, 6, 'WWS-9A438C4E', 2, NULL, 'Flying Saucer', NULL, 0.00, NULL, '2026-04-13', '07:00:00', 10, NULL, 'sadfgvb', 6000.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 04:25:37', '2026-04-13 04:25:37'),
(7, 7, 'WWS-61F25FE8', 9, NULL, 'Banana Boat', NULL, 0.00, NULL, '2026-04-14', '08:00:00', 12, NULL, 'none', 6000.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 12:57:38', '2026-04-13 12:57:38'),
(8, 8, 'WWS-9A92E760', 9, NULL, 'Kayaking', NULL, 0.00, NULL, '2026-04-14', '09:00:00', 2, NULL, 'dsd', 300.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 13:00:35', '2026-04-13 13:00:35'),
(9, 9, 'WWS-27467615', 9, NULL, 'Jet Ski', NULL, 0.00, NULL, '2026-04-14', '08:00:00', 2, NULL, '', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 13:01:20', '2026-04-13 13:01:20'),
(10, 10, 'WWS-79EA4C14', 2, NULL, 'Jet Ski', NULL, 0.00, NULL, '2026-04-30', '10:00:00', 2, NULL, 'none', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 12:53:41', '2026-04-16 12:53:41'),
(16, 11, 'WWS-88802208', 2, NULL, 'Flying Saucer', NULL, 0.00, NULL, '2026-04-17', '07:00:00', 2, NULL, 'none', 1200.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 21:08:57', '2026-04-16 21:08:57'),
(17, 12, 'WWS-AE920DB9', 2, NULL, 'Jet Ski', NULL, 0.00, NULL, '2026-04-16', '12:00:00', 2, NULL, '', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 21:22:46', '2026-04-16 21:22:46'),
(18, 13, 'WWS-EBF37EF5', 2, NULL, 'Jet Ski', NULL, 0.00, NULL, '2026-04-30', '07:00:00', 2, NULL, 'none', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 21:34:08', '2026-04-16 21:34:08'),
(19, 14, 'WWS-96A1ACA0', 2, NULL, 'Jet Ski', NULL, 0.00, NULL, '2026-04-17', '13:00:00', 2, NULL, '', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 21:39:50', '2026-04-16 21:39:50'),
(20, 15, 'WWS-FC69EF9D', 2, NULL, 'Jet Ski', NULL, 0.00, NULL, '2026-04-18', '16:00:00', 12, NULL, 'none', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 21:59:30', '2026-04-16 21:59:30'),
(21, 16, 'WWS-41466D22', 2, NULL, 'Banana Boat', NULL, 0.00, NULL, '2026-04-18', '07:00:00', 4, NULL, '', 2000.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:02:45', '2026-04-16 22:02:45'),
(22, 17, 'WWS-1D78C191', 2, NULL, 'Jet Ski', NULL, 0.00, NULL, '2026-04-19', '16:00:00', 14, NULL, 'none', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-18 23:15:40', '2026-04-18 23:15:40'),
(23, 18, 'WWS-C4B11C2F', 2, NULL, 'Flying Saucer', 'Flying Saucer,Kayaking', 0.00, NULL, '2026-04-20', '09:00:00', 5, '09634312395', 'none', 3000.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-19 22:37:54', '2026-04-19 22:37:54'),
(24, 19, 'WWS-709462C0', 2, NULL, 'Banana Boat', 'Banana Boat,Jet Ski', 0.00, NULL, '2026-04-22', '07:00:00', 14, '09277471724', 'none', 7000.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-19 22:41:03', '2026-04-19 22:41:03'),
(25, 20, 'WWS-A8AE37D5', 6, NULL, 'Kayaking', 'Kayaking', 0.00, NULL, '2026-05-10', '15:00:00', 2, '09634312395', 'none', 300.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-30 20:19:35', '2026-04-30 20:19:35'),
(26, 21, 'WWS-82E484E2', 6, NULL, 'Flying Saucer', 'Flying Saucer,Kayaking', 0.00, NULL, '2026-05-10', '08:00:00', 12, '09277471724', 'none', 3600.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-30 20:24:22', '2026-04-30 20:24:22'),
(27, 22, 'WWS-C205541D', 6, NULL, 'Kayaking', 'Kayaking,Flying Saucer', 0.00, NULL, '2026-05-10', '07:00:00', 12, '09634312395', 'none', 300.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-30 20:37:57', '2026-04-30 20:37:57'),
(28, 23, 'WWS-2A3A7632', 6, NULL, 'Kayaking', 'Kayaking,Flying Saucer,Banana Boat', 0.00, NULL, '2026-05-03', '16:00:00', 24, '09277471724', 'none', 300.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-30 21:15:07', '2026-04-30 21:15:07'),
(29, 24, 'WWS-1E498228', 6, NULL, 'Jet Ski', 'Jet Ski,Flying Saucer', 0.00, NULL, '2026-05-10', '08:00:00', 12, '09277471724', 'none', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-30 21:51:15', '2026-04-30 21:51:15'),
(30, 25, 'WWS-24F2A04F', 6, NULL, 'Banana Boat', 'Banana Boat,Jet Ski', 0.00, NULL, '2026-05-07', '09:00:00', 13, '09634312395', 'none', 3900.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'completed', '2026-04-30 22:32:21', '2026-04-30 22:32:24', NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-30 22:03:01', '2026-04-30 22:32:24'),
(31, 26, 'WWS-FC17B733', 6, NULL, 'Banana Boat', 'Banana Boat,Kayaking', 0.00, NULL, '2026-05-01', '16:00:00', 14, '09634312395', 'none', 4200.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-01 10:54:20', '2026-05-01 10:54:20'),
(32, 27, 'WWS-1D3A6BB1', 6, NULL, 'Flying Saucer', 'Flying Saucer,Kayaking', 0.00, NULL, '2026-05-02', '10:00:00', 12, '09634312395', 'none', 3600.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-01 10:55:29', '2026-05-01 10:56:31'),
(33, 28, 'WWS-2245051C', 6, NULL, 'Jet Ski', 'Jet Ski,Kayaking', 0.00, NULL, '2026-05-10', '16:00:00', 4, '09634312395', 'none', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-01 11:11:02', '2026-05-01 11:11:02'),
(34, 29, 'WWS-F2ED134D', 6, NULL, 'Kayaking', 'Kayaking,Jet Ski', 0.00, NULL, '2026-05-10', '14:00:00', 4, '09277471724', 'none', 500.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'confirmed', '2026-05-01 22:43:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-01 11:16:33', '2026-05-01 22:43:24'),
(35, 30, 'WWS-6987DF9C', 6, NULL, 'Banana Boat', 'Banana Boat', 0.00, NULL, '2026-05-10', '14:00:00', 12, '09634312395', 'none', 3600.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'confirmed', '2026-05-01 22:43:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-01 11:20:36', '2026-05-01 22:43:20'),
(36, 31, 'WWS-B8613F49', 8, NULL, 'Banana Boat', 'Banana Boat', 0.00, NULL, '2026-05-10', '16:00:00', 12, '09277471724', 'none', 3600.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'completed', '2026-05-01 11:25:48', '2026-05-01 11:25:52', NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-01 11:24:52', '2026-05-01 11:25:52'),
(37, 32, 'WWS-F3ECC4E0', 8, NULL, 'Jet Ski', 'Jet Ski,Kayaking', 0.00, NULL, '2026-05-10', '15:00:00', 4, '09277471724', 'none', 2500.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'cancelled', '2026-05-01 12:37:33', NULL, '2026-05-01 12:55:53', NULL, NULL, NULL, NULL, NULL, '2026-05-01 11:27:00', '2026-05-01 12:55:53'),
(38, 33, 'WWS-1BCA572E', 8, NULL, 'Kayaking', 'Kayaking,Jet Ski', 0.00, NULL, '2026-05-10', '16:00:00', 4, '09634312395', 'none', 3000.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'cancelled', NULL, NULL, '2026-05-01 12:55:51', NULL, NULL, NULL, NULL, NULL, '2026-05-01 12:12:15', '2026-05-01 12:55:51'),
(39, 34, 'WWS-C3E10D5D', 2, NULL, 'Flying Saucer', 'Flying Saucer', 0.00, NULL, '2026-05-10', '16:00:00', 10, '09634312395', 'none', 3000.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'completed', '2026-05-01 12:24:56', '2026-05-01 12:25:01', NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-01 12:23:47', '2026-05-01 12:25:01'),
(40, 35, 'WWS-54595354', 8, NULL, 'Kayaking', 'Kayaking', 0.00, NULL, '2026-05-10', '08:00:00', 2, '09277471724', 'may hika ang isa', 500.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'cancelled', NULL, NULL, '2026-05-01 12:43:59', NULL, NULL, NULL, NULL, NULL, '2026-05-01 12:39:24', '2026-05-01 12:43:59'),
(41, 36, 'WWS-02953AB4', 8, NULL, 'Flying Saucer', 'Flying Saucer', 0.00, NULL, '2026-05-10', '15:00:00', 10, '09277471724', 'may hika kasama ko kaya dahan dahan lang po', 3000.00, 1500.00, 'paid', '2026-05-01 14:23:55', 'paid', NULL, NULL, NULL, 'booking', 'confirmed', '2026-05-01 22:43:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-01 12:56:33', '2026-05-01 22:43:14'),
(42, 37, 'WWS-D9C35B19', 8, NULL, 'gigabit', 'gigabit', 0.00, NULL, '2026-05-10', '16:00:00', 1, '09634312395', 'may hika', 100.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'cancelled', NULL, NULL, '2026-05-01 22:14:13', NULL, NULL, NULL, NULL, NULL, '2026-05-01 22:12:18', '2026-05-01 22:14:13'),
(43, 38, 'WWS-B7868C41', 8, NULL, 'Kayaking', 'Kayaking,Jet Ski', 0.00, NULL, '2026-05-10', '16:00:00', 4, '09634312395', 'may hika kasama', 3000.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'completed', '2026-05-03 13:52:59', '2026-05-03 13:53:14', NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-03 13:51:17', '2026-05-03 13:53:14'),
(44, 39, 'WWS-3689E074', 8, NULL, 'Kayaking', 'Kayaking,Jet Ski', 0.00, NULL, '2026-05-10', '16:30:00', 4, '09277471724', 'none', 3000.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-03 14:30:01', '2026-05-03 14:30:28'),
(45, 40, 'WWS-02E4DB35', 8, NULL, 'Jet Ski', 'Jet Ski,Kayaking', 0.00, NULL, '2026-05-10', '16:45:00', 4, '09634312395', 'none', 3000.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-03 14:55:19', '2026-05-03 15:03:28'),
(46, 41, 'WWS-8EEDF499', 8, NULL, 'Jet Ski', 'Jet Ski,Flying Saucer,Kayaking,Banana Boat', 0.00, NULL, '2026-05-10', '07:00:00', 5, '09277471724', 'may hika', 6000.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-03 15:06:22', '2026-05-03 15:08:03'),
(47, 42, 'WWS-C21EF9C5', 8, NULL, 'Banana Boat', 'Banana Boat', 0.00, NULL, '2026-05-23', '07:00:00', 12, '09634312395', '', 3600.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 16:48:00', '2026-05-04 16:48:00'),
(48, 43, 'WWS-387237EF', 8, NULL, 'Kayaking', 'Kayaking', 0.00, NULL, '2026-05-18', '16:30:00', 2, '09277471724', '', 500.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'completed', '2026-05-04 16:54:53', '2026-05-04 16:54:59', NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 16:48:24', '2026-05-04 16:54:59'),
(49, 44, 'WWS-80F04924', 8, NULL, 'Banana Boat', 'Banana Boat,Jet Ski', 0.00, NULL, '2026-05-12', '11:30:00', 14, '09277471724', '', 6700.00, 3350.00, 'paid', '2026-05-04 08:57:57', 'unpaid', NULL, NULL, NULL, 'booking', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 16:49:56', '2026-05-04 16:57:57'),
(50, 45, 'WWS-3920D9BF', 8, NULL, 'Kayaking', 'Kayaking,Flying Saucer,Banana Boat,Jet Ski', 0.00, NULL, '2026-05-27', '07:00:00', 18, '09634312395', '', 13800.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'confirmed', '2026-05-09 12:41:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 16:52:58', '2026-05-09 12:41:54'),
(51, 46, 'WWS-B420E065', 8, NULL, 'Kayaking', 'Kayaking,Jet Ski', 0.00, NULL, '2026-05-10', '13:00:00', 4, '09634312395', '', 3000.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'confirmed', '2026-05-04 17:34:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 17:02:02', '2026-05-04 17:34:59'),
(52, 47, 'WWS-8045C506', 8, NULL, 'Jet Ski', 'Jet Ski', 0.00, NULL, '2026-05-31', '16:45:00', 2, '09277471724', '', 2500.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'completed', '2026-05-04 17:04:11', '2026-05-04 17:04:15', NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 17:03:10', '2026-05-04 17:04:15'),
(53, 48, 'WWS-3A5329E6', 6, NULL, 'Flying Saucer', 'Flying Saucer', 0.00, NULL, '2026-05-24', '16:15:00', 10, '09277471724', '', 3000.00, 0.00, 'unpaid', NULL, 'unpaid', NULL, NULL, NULL, 'booking', 'cancelled', NULL, NULL, '2026-05-04 17:31:42', NULL, NULL, NULL, NULL, NULL, '2026-05-04 17:05:25', '2026-05-04 17:31:42'),
(54, 49, 'WWS-43E1D51E', 6, NULL, 'Kayaking', 'Kayaking,Jet Ski', 0.00, NULL, '2026-05-23', '16:30:00', 4, '09277471724', '', 3000.00, 1500.00, 'paid', '2026-05-04 09:24:47', 'unpaid', NULL, NULL, NULL, 'booking', 'completed', '2026-05-04 17:21:24', '2026-05-04 17:29:04', NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 17:12:35', '2026-05-04 17:29:04'),
(55, 50, 'WWS-335F1B51', 6, NULL, 'Kayaking', 'Kayaking,Jet Ski', 0.00, NULL, '2026-05-13', '16:30:00', 4, '09634312395', 'none', 3000.00, 0.00, 'unpaid', NULL, 'paid', NULL, NULL, NULL, 'booking', 'cancelled', NULL, NULL, '2026-05-09 12:33:40', NULL, NULL, NULL, NULL, NULL, '2026-05-06 21:35:24', '2026-05-09 12:33:40'),
(56, 51, 'WWS-33CA6D6C', 23, NULL, 'Kayaking', 'Kayaking,Banana Boat,Flying Saucer,Jet Ski', 0.00, NULL, '2026-05-11', '13:00:00', 18, '09913354660', 'May hika ako', 13800.00, 6900.00, 'paid', '2026-05-09 02:25:34', 'unpaid', NULL, NULL, NULL, 'booking', 'cancelled', '2026-05-09 02:28:56', NULL, '2026-05-09 02:29:58', NULL, NULL, NULL, NULL, NULL, '2026-05-09 02:25:01', '2026-05-09 02:29:58'),
(57, 52, 'WWS-D61E9104', 23, NULL, 'Crystal Kayak', 'Crystal Kayak,Jet Ski', 0.00, NULL, '2026-05-21', '09:15:00', 3, '09913354660', '', 4000.00, 2000.00, 'paid', '2026-05-09 02:49:45', 'paid', NULL, NULL, NULL, 'booking', 'completed', '2026-05-09 02:51:57', '2026-05-09 12:15:21', NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-09 02:48:34', '2026-05-11 05:11:40'),
(58, 53, 'WWS-397E8481', 15, NULL, 'Banana Boat', 'Banana Boat', 0.00, NULL, '2026-05-11', '13:45:00', 1, '09913084036', '', 300.00, 150.00, 'paid', '2026-05-11 13:10:15', 'paid', NULL, NULL, NULL, 'booking', 'completed', '2026-05-11 05:11:12', '2026-05-11 05:11:16', NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 05:06:33', '2026-05-11 05:11:16'),
(59, 54, 'WWS-28E8D74A', 15, NULL, 'Banana Boat', 'Banana Boat', 0.00, NULL, '2026-05-11', '13:15:00', 1, '34135151324513', '', 300.00, 150.00, 'paid', '2026-05-11 13:09:26', 'paid', NULL, NULL, NULL, 'booking', 'completed', '2026-05-11 05:11:11', '2026-05-11 05:11:14', NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 05:07:31', '2026-05-11 05:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `buoy_data`
--

CREATE TABLE `buoy_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `pitch_avg` float NOT NULL DEFAULT 0,
  `pitch_min` float NOT NULL DEFAULT 0,
  `pitch_max` float NOT NULL DEFAULT 0,
  `roll_avg` float NOT NULL DEFAULT 0,
  `roll_min` float NOT NULL DEFAULT 0,
  `roll_max` float NOT NULL DEFAULT 0,
  `water_temp_avg` float DEFAULT NULL,
  `water_temp_min` float DEFAULT NULL,
  `water_temp_max` float DEFAULT NULL,
  `water_temp_valid_samples` int(11) NOT NULL DEFAULT 0,
  `avg_wave_height` float NOT NULL DEFAULT 0,
  `avg_wind_speed` float NOT NULL DEFAULT 0,
  `max_wind_speed` float NOT NULL DEFAULT 0,
  `sample_count` int(11) NOT NULL DEFAULT 0,
  `expected_samples` int(11) NOT NULL DEFAULT 0,
  `packet_loss_pct` float NOT NULL DEFAULT 0,
  `hall_detections` int(11) NOT NULL DEFAULT 0,
  `avg_rssi` float NOT NULL DEFAULT 0,
  `window_duration_ms` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `first_packet_id` int(11) NOT NULL DEFAULT 0,
  `last_packet_id` int(11) NOT NULL DEFAULT 0,
  `recorded_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buoy_data`
--

INSERT INTO `buoy_data` (`id`, `pitch_avg`, `pitch_min`, `pitch_max`, `roll_avg`, `roll_min`, `roll_max`, `water_temp_avg`, `water_temp_min`, `water_temp_max`, `water_temp_valid_samples`, `avg_wave_height`, `avg_wind_speed`, `max_wind_speed`, `sample_count`, `expected_samples`, `packet_loss_pct`, `hall_detections`, `avg_rssi`, `window_duration_ms`, `first_packet_id`, `last_packet_id`, `recorded_at`, `created_at`) VALUES
(1, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.1, 27.9, 28.3, 55, 0.8, 3.5, 4, 55, 60, 8.333, 0, -75, 60000, 100001, 100055, '2026-05-06 18:00:00', '2026-05-06 18:00:00'),
(2, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.2, 28, 28.4, 56, 0.82, 3.55, 4.07, 56, 60, 6.667, 1, -75.2, 60000, 100061, 100116, '2026-05-06 18:01:00', '2026-05-06 18:01:00'),
(3, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.3, 28.1, 28.5, 57, 0.84, 3.6, 4.14, 57, 60, 5, 2, -75.4, 60000, 100121, 100177, '2026-05-06 18:02:00', '2026-05-06 18:02:00'),
(4, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.4, 28.2, 28.6, 58, 0.86, 3.65, 4.21, 58, 60, 3.333, 3, -75.6, 60000, 100181, 100238, '2026-05-06 18:03:00', '2026-05-06 18:03:00'),
(5, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.5, 28.3, 28.7, 59, 0.88, 3.7, 4.2, 59, 60, 1.667, 0, -75.8, 60000, 100241, 100299, '2026-05-06 18:04:00', '2026-05-06 18:04:00'),
(6, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.6, 28.4, 28.8, 60, 0.9, 3.75, 4.27, 60, 60, 0, 1, -76, 60000, 100301, 100360, '2026-05-06 18:05:00', '2026-05-06 18:05:00'),
(7, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.7, 28.5, 28.9, 55, 0.92, 3.8, 4.34, 55, 60, 8.333, 2, -76.2, 60000, 100361, 100415, '2026-05-06 18:06:00', '2026-05-06 18:06:00'),
(8, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.1, 27.9, 28.3, 56, 0.94, 3.85, 4.41, 56, 60, 6.667, 3, -76.4, 60000, 100421, 100476, '2026-05-06 18:07:00', '2026-05-06 18:07:00'),
(9, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.2, 28, 28.4, 57, 0.96, 3.9, 4.4, 57, 60, 5, 0, -76.6, 60000, 100481, 100537, '2026-05-06 18:08:00', '2026-05-06 18:08:00'),
(10, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.3, 28.1, 28.5, 58, 0.98, 3.95, 4.47, 58, 60, 3.333, 1, -76.8, 60000, 100541, 100598, '2026-05-06 18:09:00', '2026-05-06 18:09:00'),
(11, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.4, 28.2, 28.6, 59, 1, 4, 4.54, 59, 60, 1.667, 2, -75, 60000, 100601, 100659, '2026-05-06 18:10:00', '2026-05-06 18:10:00'),
(12, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.5, 28.3, 28.7, 60, 1.02, 4.05, 4.61, 60, 60, 0, 3, -75.2, 60000, 100661, 100720, '2026-05-06 18:11:00', '2026-05-06 18:11:00'),
(13, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.6, 28.4, 28.8, 55, 1.04, 4.1, 4.6, 55, 60, 8.333, 0, -75.4, 60000, 100721, 100775, '2026-05-06 18:12:00', '2026-05-06 18:12:00'),
(14, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.7, 28.5, 28.9, 56, 1.06, 4.15, 4.67, 56, 60, 6.667, 1, -75.6, 60000, 100781, 100836, '2026-05-06 18:13:00', '2026-05-06 18:13:00'),
(15, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.1, 27.9, 28.3, 57, 1.08, 4.2, 4.74, 57, 60, 5, 2, -75.8, 60000, 100841, 100897, '2026-05-06 18:14:00', '2026-05-06 18:14:00'),
(16, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.2, 28, 28.4, 58, 1.1, 4.25, 4.81, 58, 60, 3.333, 3, -76, 60000, 100901, 100958, '2026-05-06 18:15:00', '2026-05-06 18:15:00'),
(17, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.3, 28.1, 28.5, 59, 1.12, 4.3, 4.8, 59, 60, 1.667, 0, -76.2, 60000, 100961, 101019, '2026-05-06 18:16:00', '2026-05-06 18:16:00'),
(18, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.4, 28.2, 28.6, 60, 1.14, 4.35, 4.87, 60, 60, 0, 1, -76.4, 60000, 101021, 101080, '2026-05-06 18:17:00', '2026-05-06 18:17:00'),
(19, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.5, 28.3, 28.7, 55, 1.16, 4.4, 4.94, 55, 60, 8.333, 2, -76.6, 60000, 101081, 101135, '2026-05-06 18:18:00', '2026-05-06 18:18:00'),
(20, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.6, 28.4, 28.8, 56, 1.18, 4.45, 5.01, 56, 60, 6.667, 3, -76.8, 60000, 101141, 101196, '2026-05-06 18:19:00', '2026-05-06 18:19:00'),
(21, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.7, 28.5, 28.9, 57, 0.8, 4.5, 5, 57, 60, 5, 0, -75, 60000, 101201, 101257, '2026-05-06 18:20:00', '2026-05-06 18:20:00'),
(22, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.1, 27.9, 28.3, 58, 0.82, 4.55, 5.07, 58, 60, 3.333, 1, -75.2, 60000, 101261, 101318, '2026-05-06 18:21:00', '2026-05-06 18:21:00'),
(23, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.2, 28, 28.4, 59, 0.84, 4.6, 5.14, 59, 60, 1.667, 2, -75.4, 60000, 101321, 101379, '2026-05-06 18:22:00', '2026-05-06 18:22:00'),
(24, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.3, 28.1, 28.5, 60, 0.86, 4.65, 5.21, 60, 60, 0, 3, -75.6, 60000, 101381, 101440, '2026-05-06 18:23:00', '2026-05-06 18:23:00'),
(25, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.4, 28.2, 28.6, 55, 0.88, 4.7, 5.2, 55, 60, 8.333, 0, -75.8, 60000, 101441, 101495, '2026-05-06 18:24:00', '2026-05-06 18:24:00'),
(26, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.5, 28.3, 28.7, 56, 0.9, 3.5, 4.02, 56, 60, 6.667, 1, -76, 60000, 101501, 101556, '2026-05-06 18:25:00', '2026-05-06 18:25:00'),
(27, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.6, 28.4, 28.8, 57, 0.92, 3.55, 4.09, 57, 60, 5, 2, -76.2, 60000, 101561, 101617, '2026-05-06 18:26:00', '2026-05-06 18:26:00'),
(28, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.7, 28.5, 28.9, 58, 0.94, 3.6, 4.16, 58, 60, 3.333, 3, -76.4, 60000, 101621, 101678, '2026-05-06 18:27:00', '2026-05-06 18:27:00'),
(29, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.1, 27.9, 28.3, 59, 0.96, 3.65, 4.15, 59, 60, 1.667, 0, -76.6, 60000, 101681, 101739, '2026-05-06 18:28:00', '2026-05-06 18:28:00'),
(30, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.2, 28, 28.4, 60, 0.98, 3.7, 4.22, 60, 60, 0, 1, -76.8, 60000, 101741, 101800, '2026-05-06 18:29:00', '2026-05-06 18:29:00'),
(31, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.3, 28.1, 28.5, 55, 1, 3.75, 4.29, 55, 60, 8.333, 2, -75, 60000, 101801, 101855, '2026-05-06 18:30:00', '2026-05-06 18:30:00'),
(32, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.4, 28.2, 28.6, 56, 1.02, 3.8, 4.36, 56, 60, 6.667, 3, -75.2, 60000, 101861, 101916, '2026-05-06 18:31:00', '2026-05-06 18:31:00'),
(33, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.5, 28.3, 28.7, 57, 1.04, 3.85, 4.35, 57, 60, 5, 0, -75.4, 60000, 101921, 101977, '2026-05-06 18:32:00', '2026-05-06 18:32:00'),
(34, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.6, 28.4, 28.8, 58, 1.06, 3.9, 4.42, 58, 60, 3.333, 1, -75.6, 60000, 101981, 102038, '2026-05-06 18:33:00', '2026-05-06 18:33:00'),
(35, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.7, 28.5, 28.9, 59, 1.08, 3.95, 4.49, 59, 60, 1.667, 2, -75.8, 60000, 102041, 102099, '2026-05-06 18:34:00', '2026-05-06 18:34:00'),
(36, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.1, 27.9, 28.3, 60, 1.1, 4, 4.56, 60, 60, 0, 3, -76, 60000, 102101, 102160, '2026-05-06 18:35:00', '2026-05-06 18:35:00'),
(37, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.2, 28, 28.4, 55, 1.12, 4.05, 4.55, 55, 60, 8.333, 0, -76.2, 60000, 102161, 102215, '2026-05-06 18:36:00', '2026-05-06 18:36:00'),
(38, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.3, 28.1, 28.5, 56, 1.14, 4.1, 4.62, 56, 60, 6.667, 1, -76.4, 60000, 102221, 102276, '2026-05-06 18:37:00', '2026-05-06 18:37:00'),
(39, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.4, 28.2, 28.6, 57, 1.16, 4.15, 4.69, 57, 60, 5, 2, -76.6, 60000, 102281, 102337, '2026-05-06 18:38:00', '2026-05-06 18:38:00'),
(40, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.5, 28.3, 28.7, 58, 1.18, 4.2, 4.76, 58, 60, 3.333, 3, -76.8, 60000, 102341, 102398, '2026-05-06 18:39:00', '2026-05-06 18:39:00'),
(41, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.6, 28.4, 28.8, 59, 0.8, 4.25, 4.75, 59, 60, 1.667, 0, -75, 60000, 102401, 102459, '2026-05-06 18:40:00', '2026-05-06 18:40:00'),
(42, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.7, 28.5, 28.9, 60, 0.82, 4.3, 4.82, 60, 60, 0, 1, -75.2, 60000, 102461, 102520, '2026-05-06 18:41:00', '2026-05-06 18:41:00'),
(43, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.1, 27.9, 28.3, 55, 0.84, 4.35, 4.89, 55, 60, 8.333, 2, -75.4, 60000, 102521, 102575, '2026-05-06 18:42:00', '2026-05-06 18:42:00'),
(44, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.2, 28, 28.4, 56, 0.86, 4.4, 4.96, 56, 60, 6.667, 3, -75.6, 60000, 102581, 102636, '2026-05-06 18:43:00', '2026-05-06 18:43:00'),
(45, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.3, 28.1, 28.5, 57, 0.88, 4.45, 4.95, 57, 60, 5, 0, -75.8, 60000, 102641, 102697, '2026-05-06 18:44:00', '2026-05-06 18:44:00'),
(46, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.4, 28.2, 28.6, 58, 0.9, 4.5, 5.02, 58, 60, 3.333, 1, -76, 60000, 102701, 102758, '2026-05-06 18:45:00', '2026-05-06 18:45:00'),
(47, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.5, 28.3, 28.7, 59, 0.92, 4.55, 5.09, 59, 60, 1.667, 2, -76.2, 60000, 102761, 102819, '2026-05-06 18:46:00', '2026-05-06 18:46:00'),
(48, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.6, 28.4, 28.8, 60, 0.94, 4.6, 5.16, 60, 60, 0, 3, -76.4, 60000, 102821, 102880, '2026-05-06 18:47:00', '2026-05-06 18:47:00'),
(49, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.7, 28.5, 28.9, 55, 0.96, 4.65, 5.15, 55, 60, 8.333, 0, -76.6, 60000, 102881, 102935, '2026-05-06 18:48:00', '2026-05-06 18:48:00'),
(50, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.1, 27.9, 28.3, 56, 0.98, 4.7, 5.22, 56, 60, 6.667, 1, -76.8, 60000, 102941, 102996, '2026-05-06 18:49:00', '2026-05-06 18:49:00'),
(51, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.2, 28, 28.4, 57, 1, 3.5, 4.04, 57, 60, 5, 2, -75, 60000, 103001, 103057, '2026-05-06 18:50:00', '2026-05-06 18:50:00'),
(52, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.3, 28.1, 28.5, 58, 1.02, 3.55, 4.11, 58, 60, 3.333, 3, -75.2, 60000, 103061, 103118, '2026-05-06 18:51:00', '2026-05-06 18:51:00'),
(53, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.4, 28.2, 28.6, 59, 1.04, 3.6, 4.1, 59, 60, 1.667, 0, -75.4, 60000, 103121, 103179, '2026-05-06 18:52:00', '2026-05-06 18:52:00'),
(54, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.5, 28.3, 28.7, 60, 1.06, 3.65, 4.17, 60, 60, 0, 1, -75.6, 60000, 103181, 103240, '2026-05-06 18:53:00', '2026-05-06 18:53:00'),
(55, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.6, 28.4, 28.8, 55, 1.08, 3.7, 4.24, 55, 60, 8.333, 2, -75.8, 60000, 103241, 103295, '2026-05-06 18:54:00', '2026-05-06 18:54:00'),
(56, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.7, 28.5, 28.9, 56, 1.1, 3.75, 4.31, 56, 60, 6.667, 3, -76, 60000, 103301, 103356, '2026-05-06 18:55:00', '2026-05-06 18:55:00'),
(57, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.1, 27.9, 28.3, 57, 1.12, 3.8, 4.3, 57, 60, 5, 0, -76.2, 60000, 103361, 103417, '2026-05-06 18:56:00', '2026-05-06 18:56:00'),
(58, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.2, 28, 28.4, 58, 1.14, 3.85, 4.37, 58, 60, 3.333, 1, -76.4, 60000, 103421, 103478, '2026-05-06 18:57:00', '2026-05-06 18:57:00'),
(59, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.3, 28.1, 28.5, 59, 1.16, 3.9, 4.44, 59, 60, 1.667, 2, -76.6, 60000, 103481, 103539, '2026-05-06 18:58:00', '2026-05-06 18:58:00'),
(60, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.4, 28.2, 28.6, 60, 1.18, 3.95, 4.51, 60, 60, 0, 3, -76.8, 60000, 103541, 103600, '2026-05-06 18:59:00', '2026-05-06 18:59:00'),
(61, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.5, 28.3, 28.7, 55, 0.8, 4, 4.5, 55, 60, 8.333, 0, -75, 60000, 103601, 103655, '2026-05-06 19:00:00', '2026-05-06 19:00:00'),
(62, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.6, 28.4, 28.8, 56, 0.82, 4.05, 4.57, 56, 60, 6.667, 1, -75.2, 60000, 103661, 103716, '2026-05-06 19:01:00', '2026-05-06 19:01:00'),
(63, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.7, 28.5, 28.9, 57, 0.84, 4.1, 4.64, 57, 60, 5, 2, -75.4, 60000, 103721, 103777, '2026-05-06 19:02:00', '2026-05-06 19:02:00'),
(64, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.1, 27.9, 28.3, 58, 0.86, 4.15, 4.71, 58, 60, 3.333, 3, -75.6, 60000, 103781, 103838, '2026-05-06 19:03:00', '2026-05-06 19:03:00'),
(65, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.2, 28, 28.4, 59, 0.88, 4.2, 4.7, 59, 60, 1.667, 0, -75.8, 60000, 103841, 103899, '2026-05-06 19:04:00', '2026-05-06 19:04:00'),
(66, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.3, 28.1, 28.5, 60, 0.9, 4.25, 4.77, 60, 60, 0, 1, -76, 60000, 103901, 103960, '2026-05-06 19:05:00', '2026-05-06 19:05:00'),
(67, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.4, 28.2, 28.6, 55, 0.92, 4.3, 4.84, 55, 60, 8.333, 2, -76.2, 60000, 103961, 104015, '2026-05-06 19:06:00', '2026-05-06 19:06:00'),
(68, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.5, 28.3, 28.7, 56, 0.94, 4.35, 4.91, 56, 60, 6.667, 3, -76.4, 60000, 104021, 104076, '2026-05-06 19:07:00', '2026-05-06 19:07:00'),
(69, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.6, 28.4, 28.8, 57, 0.96, 4.4, 4.9, 57, 60, 5, 0, -76.6, 60000, 104081, 104137, '2026-05-06 19:08:00', '2026-05-06 19:08:00'),
(70, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.7, 28.5, 28.9, 58, 0.98, 4.45, 4.97, 58, 60, 3.333, 1, -76.8, 60000, 104141, 104198, '2026-05-06 19:09:00', '2026-05-06 19:09:00'),
(71, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.1, 27.9, 28.3, 59, 1, 4.5, 5.04, 59, 60, 1.667, 2, -75, 60000, 104201, 104259, '2026-05-06 19:10:00', '2026-05-06 19:10:00'),
(72, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.2, 28, 28.4, 60, 1.02, 4.55, 5.11, 60, 60, 0, 3, -75.2, 60000, 104261, 104320, '2026-05-06 19:11:00', '2026-05-06 19:11:00'),
(73, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.3, 28.1, 28.5, 55, 1.04, 4.6, 5.1, 55, 60, 8.333, 0, -75.4, 60000, 104321, 104375, '2026-05-06 19:12:00', '2026-05-06 19:12:00'),
(74, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.4, 28.2, 28.6, 56, 1.06, 4.65, 5.17, 56, 60, 6.667, 1, -75.6, 60000, 104381, 104436, '2026-05-06 19:13:00', '2026-05-06 19:13:00'),
(75, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.5, 28.3, 28.7, 57, 1.08, 4.7, 5.24, 57, 60, 5, 2, -75.8, 60000, 104441, 104497, '2026-05-06 19:14:00', '2026-05-06 19:14:00'),
(76, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.6, 28.4, 28.8, 58, 1.1, 3.5, 4.06, 58, 60, 3.333, 3, -76, 60000, 104501, 104558, '2026-05-06 19:15:00', '2026-05-06 19:15:00'),
(77, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.7, 28.5, 28.9, 59, 1.12, 3.55, 4.05, 59, 60, 1.667, 0, -76.2, 60000, 104561, 104619, '2026-05-06 19:16:00', '2026-05-06 19:16:00'),
(78, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.1, 27.9, 28.3, 60, 1.14, 3.6, 4.12, 60, 60, 0, 1, -76.4, 60000, 104621, 104680, '2026-05-06 19:17:00', '2026-05-06 19:17:00'),
(79, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.2, 28, 28.4, 55, 1.16, 3.65, 4.19, 55, 60, 8.333, 2, -76.6, 60000, 104681, 104735, '2026-05-06 19:18:00', '2026-05-06 19:18:00'),
(80, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.3, 28.1, 28.5, 56, 1.18, 3.7, 4.26, 56, 60, 6.667, 3, -76.8, 60000, 104741, 104796, '2026-05-06 19:19:00', '2026-05-06 19:19:00'),
(81, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.4, 28.2, 28.6, 57, 0.8, 3.75, 4.25, 57, 60, 5, 0, -75, 60000, 104801, 104857, '2026-05-06 19:20:00', '2026-05-06 19:20:00'),
(82, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.5, 28.3, 28.7, 58, 0.82, 3.8, 4.32, 58, 60, 3.333, 1, -75.2, 60000, 104861, 104918, '2026-05-06 19:21:00', '2026-05-06 19:21:00'),
(83, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.6, 28.4, 28.8, 59, 0.84, 3.85, 4.39, 59, 60, 1.667, 2, -75.4, 60000, 104921, 104979, '2026-05-06 19:22:00', '2026-05-06 19:22:00'),
(84, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.7, 28.5, 28.9, 60, 0.86, 3.9, 4.46, 60, 60, 0, 3, -75.6, 60000, 104981, 105040, '2026-05-06 19:23:00', '2026-05-06 19:23:00'),
(85, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.1, 27.9, 28.3, 55, 0.88, 3.95, 4.45, 55, 60, 8.333, 0, -75.8, 60000, 105041, 105095, '2026-05-06 19:24:00', '2026-05-06 19:24:00'),
(86, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.2, 28, 28.4, 56, 0.9, 4, 4.52, 56, 60, 6.667, 1, -76, 60000, 105101, 105156, '2026-05-06 19:25:00', '2026-05-06 19:25:00'),
(87, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.3, 28.1, 28.5, 57, 0.92, 4.05, 4.59, 57, 60, 5, 2, -76.2, 60000, 105161, 105217, '2026-05-06 19:26:00', '2026-05-06 19:26:00'),
(88, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.4, 28.2, 28.6, 58, 0.94, 4.1, 4.66, 58, 60, 3.333, 3, -76.4, 60000, 105221, 105278, '2026-05-06 19:27:00', '2026-05-06 19:27:00'),
(89, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.5, 28.3, 28.7, 59, 0.96, 4.15, 4.65, 59, 60, 1.667, 0, -76.6, 60000, 105281, 105339, '2026-05-06 19:28:00', '2026-05-06 19:28:00'),
(90, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.6, 28.4, 28.8, 60, 0.98, 4.2, 4.72, 60, 60, 0, 1, -76.8, 60000, 105341, 105400, '2026-05-06 19:29:00', '2026-05-06 19:29:00'),
(91, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.7, 28.5, 28.9, 55, 1, 4.25, 4.79, 55, 60, 8.333, 2, -75, 60000, 105401, 105455, '2026-05-06 19:30:00', '2026-05-06 19:30:00'),
(92, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.1, 27.9, 28.3, 56, 1.02, 4.3, 4.86, 56, 60, 6.667, 3, -75.2, 60000, 105461, 105516, '2026-05-06 19:31:00', '2026-05-06 19:31:00'),
(93, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.2, 28, 28.4, 57, 1.04, 4.35, 4.85, 57, 60, 5, 0, -75.4, 60000, 105521, 105577, '2026-05-06 19:32:00', '2026-05-06 19:32:00'),
(94, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.3, 28.1, 28.5, 58, 1.06, 4.4, 4.92, 58, 60, 3.333, 1, -75.6, 60000, 105581, 105638, '2026-05-06 19:33:00', '2026-05-06 19:33:00'),
(95, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.4, 28.2, 28.6, 59, 1.08, 4.45, 4.99, 59, 60, 1.667, 2, -75.8, 60000, 105641, 105699, '2026-05-06 19:34:00', '2026-05-06 19:34:00'),
(96, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.5, 28.3, 28.7, 60, 1.1, 4.5, 5.06, 60, 60, 0, 3, -76, 60000, 105701, 105760, '2026-05-06 19:35:00', '2026-05-06 19:35:00'),
(97, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.6, 28.4, 28.8, 55, 1.12, 4.55, 5.05, 55, 60, 8.333, 0, -76.2, 60000, 105761, 105815, '2026-05-06 19:36:00', '2026-05-06 19:36:00'),
(98, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.7, 28.5, 28.9, 56, 1.14, 4.6, 5.12, 56, 60, 6.667, 1, -76.4, 60000, 105821, 105876, '2026-05-06 19:37:00', '2026-05-06 19:37:00'),
(99, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.1, 27.9, 28.3, 57, 1.16, 4.65, 5.19, 57, 60, 5, 2, -76.6, 60000, 105881, 105937, '2026-05-06 19:38:00', '2026-05-06 19:38:00'),
(100, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.2, 28, 28.4, 58, 1.18, 4.7, 5.26, 58, 60, 3.333, 3, -76.8, 60000, 105941, 105998, '2026-05-06 19:39:00', '2026-05-06 19:39:00'),
(101, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.3, 28.1, 28.5, 59, 0.8, 3.5, 4, 59, 60, 1.667, 0, -75, 60000, 106001, 106059, '2026-05-06 19:40:00', '2026-05-06 19:40:00'),
(102, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.4, 28.2, 28.6, 60, 0.82, 3.55, 4.07, 60, 60, 0, 1, -75.2, 60000, 106061, 106120, '2026-05-06 19:41:00', '2026-05-06 19:41:00'),
(103, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.5, 28.3, 28.7, 55, 0.84, 3.6, 4.14, 55, 60, 8.333, 2, -75.4, 60000, 106121, 106175, '2026-05-06 19:42:00', '2026-05-06 19:42:00'),
(104, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.6, 28.4, 28.8, 56, 0.86, 3.65, 4.21, 56, 60, 6.667, 3, -75.6, 60000, 106181, 106236, '2026-05-06 19:43:00', '2026-05-06 19:43:00'),
(105, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.7, 28.5, 28.9, 57, 0.88, 3.7, 4.2, 57, 60, 5, 0, -75.8, 60000, 106241, 106297, '2026-05-06 19:44:00', '2026-05-06 19:44:00'),
(106, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.1, 27.9, 28.3, 58, 0.9, 3.75, 4.27, 58, 60, 3.333, 1, -76, 60000, 106301, 106358, '2026-05-06 19:45:00', '2026-05-06 19:45:00'),
(107, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.2, 28, 28.4, 59, 0.92, 3.8, 4.34, 59, 60, 1.667, 2, -76.2, 60000, 106361, 106419, '2026-05-06 19:46:00', '2026-05-06 19:46:00'),
(108, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.3, 28.1, 28.5, 60, 0.94, 3.85, 4.41, 60, 60, 0, 3, -76.4, 60000, 106421, 106480, '2026-05-06 19:47:00', '2026-05-06 19:47:00'),
(109, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.4, 28.2, 28.6, 55, 0.96, 3.9, 4.4, 55, 60, 8.333, 0, -76.6, 60000, 106481, 106535, '2026-05-06 19:48:00', '2026-05-06 19:48:00'),
(110, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.5, 28.3, 28.7, 56, 0.98, 3.95, 4.47, 56, 60, 6.667, 1, -76.8, 60000, 106541, 106596, '2026-05-06 19:49:00', '2026-05-06 19:49:00'),
(111, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.6, 28.4, 28.8, 57, 1, 4, 4.54, 57, 60, 5, 2, -75, 60000, 106601, 106657, '2026-05-06 19:50:00', '2026-05-06 19:50:00'),
(112, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.7, 28.5, 28.9, 58, 1.02, 4.05, 4.61, 58, 60, 3.333, 3, -75.2, 60000, 106661, 106718, '2026-05-06 19:51:00', '2026-05-06 19:51:00'),
(113, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.1, 27.9, 28.3, 59, 1.04, 4.1, 4.6, 59, 60, 1.667, 0, -75.4, 60000, 106721, 106779, '2026-05-06 19:52:00', '2026-05-06 19:52:00'),
(114, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.2, 28, 28.4, 60, 1.06, 4.15, 4.67, 60, 60, 0, 1, -75.6, 60000, 106781, 106840, '2026-05-06 19:53:00', '2026-05-06 19:53:00'),
(115, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.3, 28.1, 28.5, 55, 1.08, 4.2, 4.74, 55, 60, 8.333, 2, -75.8, 60000, 106841, 106895, '2026-05-06 19:54:00', '2026-05-06 19:54:00'),
(116, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.4, 28.2, 28.6, 56, 1.1, 4.25, 4.81, 56, 60, 6.667, 3, -76, 60000, 106901, 106956, '2026-05-06 19:55:00', '2026-05-06 19:55:00'),
(117, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.5, 28.3, 28.7, 57, 1.12, 4.3, 4.8, 57, 60, 5, 0, -76.2, 60000, 106961, 107017, '2026-05-06 19:56:00', '2026-05-06 19:56:00'),
(118, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.6, 28.4, 28.8, 58, 1.14, 4.35, 4.87, 58, 60, 3.333, 1, -76.4, 60000, 107021, 107078, '2026-05-06 19:57:00', '2026-05-06 19:57:00'),
(119, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.7, 28.5, 28.9, 59, 1.16, 4.4, 4.94, 59, 60, 1.667, 2, -76.6, 60000, 107081, 107139, '2026-05-06 19:58:00', '2026-05-06 19:58:00'),
(120, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.1, 27.9, 28.3, 60, 1.18, 4.45, 5.01, 60, 60, 0, 3, -76.8, 60000, 107141, 107200, '2026-05-06 19:59:00', '2026-05-06 19:59:00'),
(121, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.2, 28, 28.4, 55, 0.8, 4.5, 5, 55, 60, 8.333, 0, -75, 60000, 107201, 107255, '2026-05-06 20:00:00', '2026-05-06 20:00:00'),
(122, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.3, 28.1, 28.5, 56, 0.82, 4.55, 5.07, 56, 60, 6.667, 1, -75.2, 60000, 107261, 107316, '2026-05-06 20:01:00', '2026-05-06 20:01:00'),
(123, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.4, 28.2, 28.6, 57, 0.84, 4.6, 5.14, 57, 60, 5, 2, -75.4, 60000, 107321, 107377, '2026-05-06 20:02:00', '2026-05-06 20:02:00'),
(124, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.5, 28.3, 28.7, 58, 0.86, 4.65, 5.21, 58, 60, 3.333, 3, -75.6, 60000, 107381, 107438, '2026-05-06 20:03:00', '2026-05-06 20:03:00'),
(125, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.6, 28.4, 28.8, 59, 0.88, 4.7, 5.2, 59, 60, 1.667, 0, -75.8, 60000, 107441, 107499, '2026-05-06 20:04:00', '2026-05-06 20:04:00'),
(126, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.7, 28.5, 28.9, 60, 0.9, 3.5, 4.02, 60, 60, 0, 1, -76, 60000, 107501, 107560, '2026-05-06 20:05:00', '2026-05-06 20:05:00'),
(127, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.1, 27.9, 28.3, 55, 0.92, 3.55, 4.09, 55, 60, 8.333, 2, -76.2, 60000, 107561, 107615, '2026-05-06 20:06:00', '2026-05-06 20:06:00'),
(128, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.2, 28, 28.4, 56, 0.94, 3.6, 4.16, 56, 60, 6.667, 3, -76.4, 60000, 107621, 107676, '2026-05-06 20:07:00', '2026-05-06 20:07:00'),
(129, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.3, 28.1, 28.5, 57, 0.96, 3.65, 4.15, 57, 60, 5, 0, -76.6, 60000, 107681, 107737, '2026-05-06 20:08:00', '2026-05-06 20:08:00'),
(130, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.4, 28.2, 28.6, 58, 0.98, 3.7, 4.22, 58, 60, 3.333, 1, -76.8, 60000, 107741, 107798, '2026-05-06 20:09:00', '2026-05-06 20:09:00'),
(131, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.5, 28.3, 28.7, 59, 1, 3.75, 4.29, 59, 60, 1.667, 2, -75, 60000, 107801, 107859, '2026-05-06 20:10:00', '2026-05-06 20:10:00'),
(132, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.6, 28.4, 28.8, 60, 1.02, 3.8, 4.36, 60, 60, 0, 3, -75.2, 60000, 107861, 107920, '2026-05-06 20:11:00', '2026-05-06 20:11:00'),
(133, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.7, 28.5, 28.9, 55, 1.04, 3.85, 4.35, 55, 60, 8.333, 0, -75.4, 60000, 107921, 107975, '2026-05-06 20:12:00', '2026-05-06 20:12:00'),
(134, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.1, 27.9, 28.3, 56, 1.06, 3.9, 4.42, 56, 60, 6.667, 1, -75.6, 60000, 107981, 108036, '2026-05-06 20:13:00', '2026-05-06 20:13:00'),
(135, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.2, 28, 28.4, 57, 1.08, 3.95, 4.49, 57, 60, 5, 2, -75.8, 60000, 108041, 108097, '2026-05-06 20:14:00', '2026-05-06 20:14:00'),
(136, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.3, 28.1, 28.5, 58, 1.1, 4, 4.56, 58, 60, 3.333, 3, -76, 60000, 108101, 108158, '2026-05-06 20:15:00', '2026-05-06 20:15:00'),
(137, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.4, 28.2, 28.6, 59, 1.12, 4.05, 4.55, 59, 60, 1.667, 0, -76.2, 60000, 108161, 108219, '2026-05-06 20:16:00', '2026-05-06 20:16:00'),
(138, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.5, 28.3, 28.7, 60, 1.14, 4.1, 4.62, 60, 60, 0, 1, -76.4, 60000, 108221, 108280, '2026-05-06 20:17:00', '2026-05-06 20:17:00'),
(139, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.6, 28.4, 28.8, 55, 1.16, 4.15, 4.69, 55, 60, 8.333, 2, -76.6, 60000, 108281, 108335, '2026-05-06 20:18:00', '2026-05-06 20:18:00'),
(140, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.7, 28.5, 28.9, 56, 1.18, 4.2, 4.76, 56, 60, 6.667, 3, -76.8, 60000, 108341, 108396, '2026-05-06 20:19:00', '2026-05-06 20:19:00'),
(141, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.1, 27.9, 28.3, 57, 0.8, 4.25, 4.75, 57, 60, 5, 0, -75, 60000, 108401, 108457, '2026-05-06 20:20:00', '2026-05-06 20:20:00'),
(142, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.2, 28, 28.4, 58, 0.82, 4.3, 4.82, 58, 60, 3.333, 1, -75.2, 60000, 108461, 108518, '2026-05-06 20:21:00', '2026-05-06 20:21:00'),
(143, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.3, 28.1, 28.5, 59, 0.84, 4.35, 4.89, 59, 60, 1.667, 2, -75.4, 60000, 108521, 108579, '2026-05-06 20:22:00', '2026-05-06 20:22:00'),
(144, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.4, 28.2, 28.6, 60, 0.86, 4.4, 4.96, 60, 60, 0, 3, -75.6, 60000, 108581, 108640, '2026-05-06 20:23:00', '2026-05-06 20:23:00'),
(145, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.5, 28.3, 28.7, 55, 0.88, 4.45, 4.95, 55, 60, 8.333, 0, -75.8, 60000, 108641, 108695, '2026-05-06 20:24:00', '2026-05-06 20:24:00'),
(146, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.6, 28.4, 28.8, 56, 0.9, 4.5, 5.02, 56, 60, 6.667, 1, -76, 60000, 108701, 108756, '2026-05-06 20:25:00', '2026-05-06 20:25:00'),
(147, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.7, 28.5, 28.9, 57, 0.92, 4.55, 5.09, 57, 60, 5, 2, -76.2, 60000, 108761, 108817, '2026-05-06 20:26:00', '2026-05-06 20:26:00'),
(148, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.1, 27.9, 28.3, 58, 0.94, 4.6, 5.16, 58, 60, 3.333, 3, -76.4, 60000, 108821, 108878, '2026-05-06 20:27:00', '2026-05-06 20:27:00'),
(149, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.2, 28, 28.4, 59, 0.96, 4.65, 5.15, 59, 60, 1.667, 0, -76.6, 60000, 108881, 108939, '2026-05-06 20:28:00', '2026-05-06 20:28:00'),
(150, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.3, 28.1, 28.5, 60, 0.98, 4.7, 5.22, 60, 60, 0, 1, -76.8, 60000, 108941, 109000, '2026-05-06 20:29:00', '2026-05-06 20:29:00'),
(151, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.4, 28.2, 28.6, 55, 1, 3.5, 4.04, 55, 60, 8.333, 2, -75, 60000, 109001, 109055, '2026-05-06 20:30:00', '2026-05-06 20:30:00'),
(152, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.5, 28.3, 28.7, 56, 1.02, 3.55, 4.11, 56, 60, 6.667, 3, -75.2, 60000, 109061, 109116, '2026-05-06 20:31:00', '2026-05-06 20:31:00'),
(153, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.6, 28.4, 28.8, 57, 1.04, 3.6, 4.1, 57, 60, 5, 0, -75.4, 60000, 109121, 109177, '2026-05-06 20:32:00', '2026-05-06 20:32:00'),
(154, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.7, 28.5, 28.9, 58, 1.06, 3.65, 4.17, 58, 60, 3.333, 1, -75.6, 60000, 109181, 109238, '2026-05-06 20:33:00', '2026-05-06 20:33:00'),
(155, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.1, 27.9, 28.3, 59, 1.08, 3.7, 4.24, 59, 60, 1.667, 2, -75.8, 60000, 109241, 109299, '2026-05-06 20:34:00', '2026-05-06 20:34:00'),
(156, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.2, 28, 28.4, 60, 1.1, 3.75, 4.31, 60, 60, 0, 3, -76, 60000, 109301, 109360, '2026-05-06 20:35:00', '2026-05-06 20:35:00'),
(157, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.3, 28.1, 28.5, 55, 1.12, 3.8, 4.3, 55, 60, 8.333, 0, -76.2, 60000, 109361, 109415, '2026-05-06 20:36:00', '2026-05-06 20:36:00'),
(158, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.4, 28.2, 28.6, 56, 1.14, 3.85, 4.37, 56, 60, 6.667, 1, -76.4, 60000, 109421, 109476, '2026-05-06 20:37:00', '2026-05-06 20:37:00'),
(159, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.5, 28.3, 28.7, 57, 1.16, 3.9, 4.44, 57, 60, 5, 2, -76.6, 60000, 109481, 109537, '2026-05-06 20:38:00', '2026-05-06 20:38:00'),
(160, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.6, 28.4, 28.8, 58, 1.18, 3.95, 4.51, 58, 60, 3.333, 3, -76.8, 60000, 109541, 109598, '2026-05-06 20:39:00', '2026-05-06 20:39:00'),
(161, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.7, 28.5, 28.9, 59, 0.8, 4, 4.5, 59, 60, 1.667, 0, -75, 60000, 109601, 109659, '2026-05-06 20:40:00', '2026-05-06 20:40:00'),
(162, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.1, 27.9, 28.3, 60, 0.82, 4.05, 4.57, 60, 60, 0, 1, -75.2, 60000, 109661, 109720, '2026-05-06 20:41:00', '2026-05-06 20:41:00'),
(163, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.2, 28, 28.4, 55, 0.84, 4.1, 4.64, 55, 60, 8.333, 2, -75.4, 60000, 109721, 109775, '2026-05-06 20:42:00', '2026-05-06 20:42:00'),
(164, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.3, 28.1, 28.5, 56, 0.86, 4.15, 4.71, 56, 60, 6.667, 3, -75.6, 60000, 109781, 109836, '2026-05-06 20:43:00', '2026-05-06 20:43:00'),
(165, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.4, 28.2, 28.6, 57, 0.88, 4.2, 4.7, 57, 60, 5, 0, -75.8, 60000, 109841, 109897, '2026-05-06 20:44:00', '2026-05-06 20:44:00'),
(166, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.5, 28.3, 28.7, 58, 0.9, 4.25, 4.77, 58, 60, 3.333, 1, -76, 60000, 109901, 109958, '2026-05-06 20:45:00', '2026-05-06 20:45:00'),
(167, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.6, 28.4, 28.8, 59, 0.92, 4.3, 4.84, 59, 60, 1.667, 2, -76.2, 60000, 109961, 110019, '2026-05-06 20:46:00', '2026-05-06 20:46:00'),
(168, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.7, 28.5, 28.9, 60, 0.94, 4.35, 4.91, 60, 60, 0, 3, -76.4, 60000, 110021, 110080, '2026-05-06 20:47:00', '2026-05-06 20:47:00'),
(169, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.1, 27.9, 28.3, 55, 0.96, 4.4, 4.9, 55, 60, 8.333, 0, -76.6, 60000, 110081, 110135, '2026-05-06 20:48:00', '2026-05-06 20:48:00'),
(170, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.2, 28, 28.4, 56, 0.98, 4.45, 4.97, 56, 60, 6.667, 1, -76.8, 60000, 110141, 110196, '2026-05-06 20:49:00', '2026-05-06 20:49:00'),
(171, 0.5, 0.1, 1.1, 0, -0.3, 0.4, 28.3, 28.1, 28.5, 57, 1, 4.5, 5.04, 57, 60, 5, 2, -75, 60000, 110201, 110257, '2026-05-06 20:50:00', '2026-05-06 20:50:00'),
(172, 0.6, 0.2, 1.2, 0.1, -0.2, 0.5, 28.4, 28.2, 28.6, 58, 1.02, 4.55, 5.11, 58, 60, 3.333, 3, -75.2, 60000, 110261, 110318, '2026-05-06 20:51:00', '2026-05-06 20:51:00'),
(173, 0.7, 0.3, 1.3, 0.2, -0.1, 0.6, 28.5, 28.3, 28.7, 59, 1.04, 4.6, 5.1, 59, 60, 1.667, 0, -75.4, 60000, 110321, 110379, '2026-05-06 20:52:00', '2026-05-06 20:52:00'),
(174, 0.8, 0.4, 1.4, 0.3, 0, 0.7, 28.6, 28.4, 28.8, 60, 1.06, 4.65, 5.17, 60, 60, 0, 1, -75.6, 60000, 110381, 110440, '2026-05-06 20:53:00', '2026-05-06 20:53:00'),
(175, 0.9, 0.5, 1.5, 0.4, 0.1, 0.8, 28.7, 28.5, 28.9, 55, 1.08, 4.7, 5.24, 55, 60, 8.333, 2, -75.8, 60000, 110441, 110495, '2026-05-06 20:54:00', '2026-05-06 20:54:00'),
(176, 1, 0.6, 1.6, 0, -0.3, 0.4, 28.1, 27.9, 28.3, 56, 1.1, 3.5, 4.06, 56, 60, 6.667, 3, -76, 60000, 110501, 110556, '2026-05-06 20:55:00', '2026-05-06 20:55:00'),
(177, 1.1, 0.7, 1.7, 0.1, -0.2, 0.5, 28.2, 28, 28.4, 57, 1.12, 3.55, 4.05, 57, 60, 5, 0, -76.2, 60000, 110561, 110617, '2026-05-06 20:56:00', '2026-05-06 20:56:00'),
(178, 1.2, 0.8, 1.8, 0.2, -0.1, 0.6, 28.3, 28.1, 28.5, 58, 1.14, 3.6, 4.12, 58, 60, 3.333, 1, -76.4, 60000, 110621, 110678, '2026-05-06 20:57:00', '2026-05-06 20:57:00'),
(179, 1.3, 0.9, 1.9, 0.3, 0, 0.7, 28.4, 28.2, 28.6, 59, 1.16, 3.65, 4.19, 59, 60, 1.667, 2, -76.6, 60000, 110681, 110739, '2026-05-06 20:58:00', '2026-05-06 20:58:00'),
(180, 1.4, 1, 2, 0.4, 0.1, 0.8, 28.5, 28.3, 28.7, 60, 1.18, 3.7, 4.26, 60, 60, 0, 3, -76.8, 60000, 110741, 110800, '2026-05-06 20:59:00', '2026-05-06 20:59:00'),
(181, 12.5, 12.5, 12.5, 0, 0, 0, 29.5, 29.5, 29.5, 1, 0.8, 5.5, 7, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-08 23:00:29', '2026-05-08 23:00:29'),
(182, 16.25, 16.25, 16.25, 0, 0, 0, 29.74, 29.74, 29.74, 1, 0.88, 9.8, 12.5, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-08 23:05:19', '2026-05-08 23:05:19'),
(363, 16.2535, 16.2535, 16.2535, 0, 0, 0, 29.746, 29.746, 29.746, 1, 0.8882, 9.898, 9.898, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-08 23:11:03', '2026-05-08 23:11:03'),
(364, 23.6755, 23.6755, 23.6755, 0, 0, 0, 29.747, 29.747, 29.747, 1, 1.00419, 9.925, 9.925, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-08 23:12:03', '2026-05-08 23:12:03'),
(365, 23.0635, 23.0635, 23.0635, 0, 0, 0, 29.2726, 29.2726, 29.2726, 1, 1.17009, 8.814, 8.814, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-08 23:13:03', '2026-05-08 23:13:03'),
(366, 19.753, 19.753, 19.753, 0, 0, 0, 28.4468, 28.4468, 28.4468, 1, 0.83766, 11.0365, 11.0365, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-08 23:14:03', '2026-05-08 23:14:03'),
(367, 15.076, 15.076, 15.076, 0, 0, 0, 28.9734, 28.9734, 28.9734, 1, 0.9911, 10.827, 10.827, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-08 23:15:03', '2026-05-08 23:15:03'),
(368, 11.6995, 11.6995, 11.6995, 0, 0, 0, 29.3418, 29.3418, 29.3418, 1, 1.09169, 8.3275, 8.3275, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-08 23:16:03', '2026-05-08 23:16:03'),
(369, 16.2535, 16.2535, 16.2535, 0, 0, 0, 29.746, 29.746, 29.746, 1, 0.8882, 9.898, 9.898, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-09 02:38:32', '2026-05-09 02:38:32'),
(370, 23.6755, 23.6755, 23.6755, 0, 0, 0, 29.747, 29.747, 29.747, 1, 1.00419, 9.925, 9.925, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-09 02:39:30', '2026-05-09 02:39:30'),
(371, 23.0635, 23.0635, 23.0635, 0, 0, 0, 29.2726, 29.2726, 29.2726, 1, 1.17009, 8.814, 8.814, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-09 02:40:30', '2026-05-09 02:40:30'),
(372, 19.753, 19.753, 19.753, 0, 0, 0, 28.4468, 28.4468, 28.4468, 1, 0.83766, 11.0365, 11.0365, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-09 02:41:30', '2026-05-09 02:41:30'),
(373, 15.076, 15.076, 15.076, 0, 0, 0, 28.9734, 28.9734, 28.9734, 1, 0.9911, 10.827, 10.827, 1, 1, 0, 0, 0, 60000, 0, 0, '2026-05-09 02:42:30', '2026-05-09 02:42:30'),
(374, 34.4174, 34.4174, 34.4174, 36.7, 36.7, 36.7, 30.6676, 30.6676, 30.6676, 1, 4.5286, 32.841, 32.841, 1, 1, 0, 0, -73, 60000, 9345, 9345, '2026-05-11 03:50:34', '2026-05-11 03:50:34'),
(375, 29.1836, 29.1836, 29.1836, 41.146, 41.146, 41.146, 32.4836, 32.4836, 32.4836, 1, 3.7698, 28.8171, 28.8171, 1, 1, 0, 0, -93, 60000, 3580, 3580, '2026-05-11 03:51:34', '2026-05-11 03:51:34'),
(376, 37.1674, 37.1674, 37.1674, 30.31, 30.31, 30.31, 30.3536, 30.3536, 30.3536, 1, 5.1789, 26.2739, 26.2739, 1, 1, 0, 0, -79, 60000, 6733, 6733, '2026-05-11 03:52:42', '2026-05-11 03:52:42'),
(377, 42.6476, 42.6476, 42.6476, 39.89, 39.89, 39.89, 31.0092, 31.0092, 31.0092, 1, 4.0834, 33.9443, 33.9443, 1, 1, 0, 0, -89, 60000, 5640, 5640, '2026-05-11 03:53:34', '2026-05-11 03:53:34'),
(378, 39.4796, 39.4796, 39.4796, 39.514, 39.514, 39.514, 32.2012, 32.2012, 32.2012, 1, 5.9951, 20.4072, 20.4072, 1, 1, 0, 0, -78, 60000, 4236, 4236, '2026-05-11 03:54:34', '2026-05-11 03:54:34'),
(379, 28.6798, 28.6798, 28.6798, 39.822, 39.822, 39.822, 29.0224, 29.0224, 29.0224, 1, 3.4457, 24.1999, 24.1999, 1, 1, 0, 0, -88, 60000, 7099, 7099, '2026-05-11 03:55:34', '2026-05-11 03:55:34'),
(380, 47.3248, 47.3248, 47.3248, 29.65, 29.65, 29.65, 30.2968, 30.2968, 30.2968, 1, 2.8423, 20.1471, 20.1471, 1, 1, 0, 0, -90, 60000, 4127, 4127, '2026-05-11 11:56:34', '2026-05-11 03:56:34'),
(381, 29.2078, 29.2078, 29.2078, 39.606, 39.606, 39.606, 32.378, 32.378, 32.378, 1, 3.2952, 31.3076, 31.3076, 1, 1, 0, 0, -80, 60000, 7885, 7885, '2026-05-11 11:57:34', '2026-05-11 03:57:34'),
(382, 49.5974, 49.5974, 49.5974, 25.47, 25.47, 25.47, 29.9428, 29.9428, 29.9428, 1, 4.49885, 19.4756, 19.4756, 1, 1, 0, 0, -79, 60000, 6090, 6090, '2026-05-11 11:58:34', '2026-05-11 03:58:34'),
(383, 44.0622, 44.0622, 44.0622, 32.55, 32.55, 32.55, 31.8808, 31.8808, 31.8808, 1, 2.65715, 21.5326, 21.5326, 1, 1, 0, 0, -97, 60000, 6467, 6467, '2026-05-11 11:59:34', '2026-05-11 03:59:34'),
(384, 32.9632, 32.9632, 32.9632, 42.276, 42.276, 42.276, 30.9448, 30.9448, 30.9448, 1, 3.438, 28.676, 28.676, 1, 1, 0, 0, -73, 60000, 6433, 6433, '2026-05-11 12:00:34', '2026-05-11 04:00:34'),
(385, 31.9248, 31.9248, 31.9248, 34.998, 34.998, 34.998, 32.4932, 32.4932, 32.4932, 1, 2.6442, 27.4044, 27.4044, 1, 1, 0, 0, -98, 60000, 9695, 9695, '2026-05-11 12:01:34', '2026-05-11 04:01:34'),
(386, 46.1962, 46.1962, 46.1962, 38.502, 38.502, 38.502, 29.244, 29.244, 29.244, 1, 5.4414, 22.896, 22.896, 1, 1, 0, 0, -76, 60000, 6724, 6724, '2026-05-11 12:02:34', '2026-05-11 04:02:34'),
(387, 37.0706, 37.0706, 37.0706, 29.36, 29.36, 29.36, 30.6704, 30.6704, 30.6704, 1, 3.48525, 29.5855, 29.5855, 1, 1, 0, 0, -83, 60000, 5831, 5831, '2026-05-11 12:03:34', '2026-05-11 04:03:34'),
(388, 49.1794, 49.1794, 49.1794, 33.558, 33.558, 33.558, 32.9056, 32.9056, 32.9056, 1, 3.36415, 28.6709, 28.6709, 1, 1, 0, 0, -79, 60000, 189, 189, '2026-05-11 12:04:34', '2026-05-11 04:04:34'),
(389, 47.4018, 47.4018, 47.4018, 25.814, 25.814, 25.814, 30.8888, 30.8888, 30.8888, 1, 4.0295, 22.4914, 22.4914, 1, 1, 0, 0, -93, 60000, 1675, 1675, '2026-05-11 12:05:34', '2026-05-11 04:05:34'),
(390, 30.6994, 30.6994, 30.6994, 41.4, 41.4, 41.4, 29.1612, 29.1612, 29.1612, 1, 5.5821, 21.8199, 21.8199, 1, 1, 0, 0, -83, 60000, 7752, 7752, '2026-05-11 12:06:34', '2026-05-11 04:06:34'),
(391, 49.8042, 49.8042, 49.8042, 25.248, 25.248, 25.248, 29.9836, 29.9836, 29.9836, 1, 2.7982, 33.0195, 33.0195, 1, 1, 0, 0, -97, 60000, 3053, 3053, '2026-05-11 12:07:34', '2026-05-11 04:07:34'),
(392, 43.9126, 43.9126, 43.9126, 43.858, 43.858, 43.858, 30.6936, 30.6936, 30.6936, 1, 3.17725, 27.4367, 27.4367, 1, 1, 0, 0, -79, 60000, 6906, 6906, '2026-05-11 12:08:34', '2026-05-11 04:08:34'),
(393, 20.4235, 20.4235, 20.4235, 17.9096, 17.9096, 17.9096, 29.0186, 29.0186, 29.0186, 1, 1.05242, 7.103, 7.103, 1, 1, 0, 0, -78, 60000, 9768, 9768, '2026-05-11 12:09:34', '2026-05-11 04:09:35'),
(394, 10.783, 10.783, 10.783, 18.5024, 18.5024, 18.5024, 28.488, 28.488, 28.488, 1, 0.98452, 8.195, 8.195, 1, 1, 0, 0, -76, 60000, 4825, 4825, '2026-05-11 12:10:34', '2026-05-11 04:10:34'),
(395, 13.9555, 13.9555, 13.9555, 12.1736, 12.1736, 12.1736, 29.3418, 29.3418, 29.3418, 1, 1.19697, 7.9845, 7.9845, 1, 1, 0, 0, -75, 60000, 6305, 6305, '2026-05-11 12:11:34', '2026-05-11 04:11:34'),
(396, 23.4415, 23.4415, 23.4415, 19.8812, 19.8812, 19.8812, 28.5528, 28.5528, 28.5528, 1, 0.82037, 7.074, 7.074, 1, 1, 0, 0, -73, 60000, 286, 286, '2026-05-11 12:12:34', '2026-05-11 04:12:34'),
(397, 19.879, 19.879, 19.879, 18.6596, 18.6596, 18.6596, 29.5804, 29.5804, 29.5804, 1, 1.40515, 8.9195, 8.9195, 1, 1, 0, 0, -66, 60000, 8592, 8592, '2026-05-11 12:13:34', '2026-05-11 04:13:34'),
(398, 10.8235, 10.8235, 10.8235, 10.3268, 10.3268, 10.3268, 28.4424, 28.4424, 28.4424, 1, 1.02876, 10.6175, 10.6175, 1, 1, 0, 0, -64, 60000, 6776, 6776, '2026-05-11 12:14:34', '2026-05-11 04:14:34'),
(399, 12.0085, 12.0085, 12.0085, 10.0568, 10.0568, 10.0568, 29.6942, 29.6942, 29.6942, 1, 1.05851, 9.3965, 9.3965, 1, 1, 0, 0, -61, 60000, 579, 579, '2026-05-11 12:15:34', '2026-05-11 04:15:34'),
(400, 16.099, 16.099, 16.099, 19.7588, 19.7588, 19.7588, 29.8112, 29.8112, 29.8112, 1, 1.30274, 8.0695, 8.0695, 1, 1, 0, 0, -62, 60000, 2959, 2959, '2026-05-11 12:16:34', '2026-05-11 04:16:34'),
(401, 21.8635, 21.8635, 21.8635, 16.8968, 16.8968, 16.8968, 29.2006, 29.2006, 29.2006, 1, 1.0044, 8.7275, 8.7275, 1, 1, 0, 0, -73, 60000, 5607, 5607, '2026-05-11 12:17:34', '2026-05-11 04:17:34'),
(402, 15.4555, 15.4555, 15.4555, 19.1864, 19.1864, 19.1864, 29.6694, 29.6694, 29.6694, 1, 1.02281, 10.482, 10.482, 1, 1, 0, 0, -67, 60000, 2136, 2136, '2026-05-11 12:18:34', '2026-05-11 04:18:34'),
(403, 16.978, 16.978, 16.978, 8.1356, 8.1356, 8.1356, 29.5614, 29.5614, 29.5614, 1, 0.96485, 9.1335, 9.1335, 1, 1, 0, 0, -75, 60000, 4990, 4990, '2026-05-11 12:19:34', '2026-05-11 04:19:34'),
(404, 23.908, 23.908, 23.908, 16.382, 16.382, 16.382, 28.6026, 28.6026, 28.6026, 1, 0.83927, 10.3435, 10.3435, 1, 1, 0, 0, -67, 60000, 9392, 9392, '2026-05-11 12:20:34', '2026-05-11 04:20:34'),
(405, 14.302, 14.302, 14.302, 16.0532, 16.0532, 16.0532, 28.1708, 28.1708, 28.1708, 1, 0.99054, 9.694, 9.694, 1, 1, 0, 0, -70, 60000, 4099, 4099, '2026-05-11 12:21:34', '2026-05-11 04:21:34'),
(406, 24.013, 24.013, 24.013, 13.2608, 13.2608, 13.2608, 29.1172, 29.1172, 29.1172, 1, 0.97101, 10.872, 10.872, 1, 1, 0, 0, -66, 60000, 5799, 5799, '2026-05-11 12:22:34', '2026-05-11 04:22:34'),
(407, 14.302, 14.302, 14.302, 11.8388, 11.8388, 11.8388, 28.3488, 28.3488, 28.3488, 1, 0.99712, 10.422, 10.422, 1, 1, 0, 0, -61, 60000, 8555, 8555, '2026-05-11 12:23:34', '2026-05-11 04:23:34'),
(408, 20.8165, 20.8165, 20.8165, 13.0196, 13.0196, 13.0196, 28.3744, 28.3744, 28.3744, 1, 1.17828, 9.4955, 9.4955, 1, 1, 0, 0, -65, 60000, 8601, 8601, '2026-05-11 12:24:34', '2026-05-11 04:24:35'),
(409, 24.403, 24.403, 24.403, 11.7392, 11.7392, 11.7392, 28.596, 28.596, 28.596, 1, 1.01812, 8.039, 8.039, 1, 1, 0, 0, -73, 60000, 184, 184, '2026-05-11 12:25:34', '2026-05-11 04:25:34'),
(410, 24.979, 24.979, 24.979, 8.876, 8.876, 8.876, 28.4536, 28.4536, 28.4536, 1, 1.21384, 7.885, 7.885, 1, 1, 0, 0, -74, 60000, 5506, 5506, '2026-05-11 12:26:34', '2026-05-11 04:26:34'),
(411, 17.3905, 17.3905, 17.3905, 11.2136, 11.2136, 11.2136, 29.388, 29.388, 29.388, 1, 1.38793, 11.263, 11.263, 1, 1, 0, 0, -68, 60000, 5688, 5688, '2026-05-11 12:27:34', '2026-05-11 04:27:34'),
(412, 18.1975, 18.1975, 18.1975, 18.848, 18.848, 18.848, 29.8874, 29.8874, 29.8874, 1, 0.81204, 7.6295, 7.6295, 1, 1, 0, 0, -71, 60000, 6321, 6321, '2026-05-11 12:28:34', '2026-05-11 04:28:34'),
(413, 13.9675, 13.9675, 13.9675, 12.926, 12.926, 12.926, 28.144, 28.144, 28.144, 1, 1.27957, 10.716, 10.716, 1, 1, 0, 0, -78, 60000, 6881, 6881, '2026-05-11 12:29:34', '2026-05-11 04:29:34'),
(414, 15.6685, 15.6685, 15.6685, 18.8384, 18.8384, 18.8384, 29.1532, 29.1532, 29.1532, 1, 1.00055, 9.25, 9.25, 1, 1, 0, 0, -67, 60000, 4760, 4760, '2026-05-11 12:30:34', '2026-05-11 04:30:34'),
(415, 20.7235, 20.7235, 20.7235, 9.3728, 9.3728, 9.3728, 28.9034, 28.9034, 28.9034, 1, 1.16064, 8.433, 8.433, 1, 1, 0, 0, -57, 60000, 8032, 8032, '2026-05-11 12:31:34', '2026-05-11 04:31:34'),
(416, 12.91, 12.91, 12.91, 10.9112, 10.9112, 10.9112, 28.0848, 28.0848, 28.0848, 1, 1.13887, 7.193, 7.193, 1, 1, 0, 0, -68, 60000, 8459, 8459, '2026-05-11 12:32:34', '2026-05-11 04:32:34'),
(417, 12.298, 12.298, 12.298, 9.218, 9.218, 9.218, 29.8416, 29.8416, 29.8416, 1, 1.0135, 10.4025, 10.4025, 1, 1, 0, 0, -72, 60000, 5331, 5331, '2026-05-11 12:33:34', '2026-05-11 04:33:34'),
(418, 16.6285, 16.6285, 16.6285, 13.4336, 13.4336, 13.4336, 28.8208, 28.8208, 28.8208, 1, 0.90374, 7.8125, 7.8125, 1, 1, 0, 0, -59, 60000, 2097, 2097, '2026-05-11 12:34:34', '2026-05-11 04:34:34'),
(419, 23.425, 23.425, 23.425, 14.5856, 14.5856, 14.5856, 29.4166, 29.4166, 29.4166, 1, 1.08819, 9.25, 9.25, 1, 1, 0, 0, -56, 60000, 4139, 4139, '2026-05-11 12:35:34', '2026-05-11 04:35:34'),
(420, 22.8595, 22.8595, 22.8595, 9.428, 9.428, 9.428, 29.5838, 29.5838, 29.5838, 1, 0.863, 8.912, 8.912, 1, 1, 0, 0, -71, 60000, 7125, 7125, '2026-05-11 12:36:34', '2026-05-11 04:36:34'),
(421, 22.039, 22.039, 22.039, 18.3596, 18.3596, 18.3596, 29.8514, 29.8514, 29.8514, 1, 1.15504, 9.693, 9.693, 1, 1, 0, 0, -64, 60000, 3155, 3155, '2026-05-11 12:37:34', '2026-05-11 04:37:34'),
(422, 19.381, 19.381, 19.381, 16.718, 16.718, 16.718, 28.1732, 28.1732, 28.1732, 1, 0.96359, 10.238, 10.238, 1, 1, 0, 0, -72, 60000, 2703, 2703, '2026-05-11 12:38:34', '2026-05-11 04:38:34'),
(423, 12.6595, 12.6595, 12.6595, 18.9416, 18.9416, 18.9416, 29.2496, 29.2496, 29.2496, 1, 1.15273, 7.5175, 7.5175, 1, 1, 0, 0, -58, 60000, 7295, 7295, '2026-05-11 12:39:34', '2026-05-11 04:39:34'),
(424, 23.065, 23.065, 23.065, 9.776, 9.776, 9.776, 28.3164, 28.3164, 28.3164, 1, 1.0121, 9.4945, 9.4945, 1, 1, 0, 0, -62, 60000, 5622, 5622, '2026-05-11 12:40:34', '2026-05-11 04:40:34'),
(425, 11.647, 11.647, 11.647, 12.2084, 12.2084, 12.2084, 28.7594, 28.7594, 28.7594, 1, 1.27649, 9.9575, 9.9575, 1, 1, 0, 0, -55, 60000, 6854, 6854, '2026-05-11 12:41:34', '2026-05-11 04:41:34'),
(426, 17.77, 17.77, 17.77, 16.598, 16.598, 16.598, 28.8338, 28.8338, 28.8338, 1, 1.17254, 8.274, 8.274, 1, 1, 0, 0, -69, 60000, 3359, 3359, '2026-05-11 12:42:34', '2026-05-11 04:42:34'),
(427, 15.151, 15.151, 15.151, 10.0808, 10.0808, 10.0808, 29.3376, 29.3376, 29.3376, 1, 1.30708, 11.282, 11.282, 1, 1, 0, 0, -78, 60000, 5701, 5701, '2026-05-11 12:43:34', '2026-05-11 04:43:34'),
(428, 11.941, 11.941, 11.941, 13.478, 13.478, 13.478, 29.4848, 29.4848, 29.4848, 1, 0.8189, 10.6845, 10.6845, 1, 1, 0, 0, -56, 60000, 3556, 3556, '2026-05-11 12:44:34', '2026-05-11 04:44:34'),
(429, 13.348, 13.348, 13.348, 11.4752, 11.4752, 11.4752, 29.2156, 29.2156, 29.2156, 1, 0.96667, 11.7865, 11.7865, 1, 1, 0, 0, -70, 60000, 9094, 9094, '2026-05-11 12:45:34', '2026-05-11 04:45:34'),
(430, 23.77, 23.77, 23.77, 12.0212, 12.0212, 12.0212, 28.1516, 28.1516, 28.1516, 1, 1.30946, 11.5295, 11.5295, 1, 1, 0, 0, -67, 60000, 9723, 9723, '2026-05-11 12:46:34', '2026-05-11 04:46:34'),
(431, 17.944, 17.944, 17.944, 9.4532, 9.4532, 9.4532, 29.059, 29.059, 29.059, 1, 1.05256, 7.8415, 7.8415, 1, 1, 0, 0, -76, 60000, 1823, 1823, '2026-05-11 12:47:34', '2026-05-11 04:47:34'),
(432, 14.506, 14.506, 14.506, 19.2596, 19.2596, 19.2596, 28.6672, 28.6672, 28.6672, 1, 1.15714, 9.8465, 9.8465, 1, 1, 0, 0, -61, 60000, 9326, 9326, '2026-05-11 12:48:34', '2026-05-11 04:48:34'),
(433, 10.912, 10.912, 10.912, 17.9552, 17.9552, 17.9552, 29.2424, 29.2424, 29.2424, 1, 0.91592, 11.6395, 11.6395, 1, 1, 0, 0, -76, 60000, 7154, 7154, '2026-05-11 12:49:34', '2026-05-11 04:49:34'),
(434, 12.9055, 12.9055, 12.9055, 9.56, 9.56, 9.56, 28.6246, 28.6246, 28.6246, 1, 1.25409, 10.634, 10.634, 1, 1, 0, 0, -75, 60000, 18, 18, '2026-05-11 12:50:34', '2026-05-11 04:50:34'),
(435, 23.677, 23.677, 23.677, 11.96, 11.96, 11.96, 29.031, 29.031, 29.031, 1, 1.08399, 9.6465, 9.6465, 1, 1, 0, 0, -60, 60000, 2222, 2222, '2026-05-11 12:51:34', '2026-05-11 04:51:34'),
(436, 15.601, 15.601, 15.601, 16.532, 16.532, 16.532, 29.4852, 29.4852, 29.4852, 1, 1.23631, 9.738, 9.738, 1, 1, 0, 0, -66, 60000, 6515, 6515, '2026-05-11 12:52:38', '2026-05-11 04:52:38'),
(437, 18.1555, 18.1555, 18.1555, 18.2552, 18.2552, 18.2552, 29.0182, 29.0182, 29.0182, 1, 0.989, 11.2985, 11.2985, 1, 1, 0, 0, -71, 60000, 2860, 2860, '2026-05-11 12:53:34', '2026-05-11 04:53:34'),
(438, 34.4174, 34.4174, 34.4174, 36.7, 36.7, 36.7, 30.6676, 30.6676, 30.6676, 1, 4.5286, 32.841, 32.841, 1, 1, 0, 0, -73, 60000, 9345, 9345, '2026-05-11 13:09:37', '2026-05-11 05:09:37'),
(439, 29.1836, 29.1836, 29.1836, 41.146, 41.146, 41.146, 32.4836, 32.4836, 32.4836, 1, 3.7698, 28.8171, 28.8171, 1, 1, 0, 0, -93, 60000, 3580, 3580, '2026-05-11 13:10:37', '2026-05-11 05:10:37'),
(440, 37.1674, 37.1674, 37.1674, 30.31, 30.31, 30.31, 30.3536, 30.3536, 30.3536, 1, 5.1789, 26.2739, 26.2739, 1, 1, 0, 0, -79, 60000, 6733, 6733, '2026-05-11 13:11:37', '2026-05-11 05:11:37'),
(441, 19.987, 19.987, 19.987, 16.934, 16.934, 16.934, 29.0046, 29.0046, 29.0046, 1, 1.11668, 11.6895, 11.6895, 1, 1, 0, 0, -71, 60000, 5640, 5640, '2026-05-11 13:12:37', '2026-05-11 05:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('ci_session:0d1ef9dafb895d50912e02d298ce9294', '163.227.179.31', 20260511124345, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383530333432353b5f5f63695f766172737c613a303a7b7d5f63695f70726576696f75735f75726c7c733a33383a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f6c6f67696e223b),
('ci_session:13aa0dce5d82abca2c4bfcac70c581f9', '136.158.46.146', 20260511042920, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383437333736303b5f63695f70726576696f75735f75726c7c733a34353a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f757365722f626f6f6b696e67223b637372665f746573745f6e616d657c733a33323a226130646461353465363431336236613337646534356365633565313938346166223b757365727c613a313a7b733a323a226964223b693a31353b7d5f5f63695f766172737c613a303a7b7d),
('ci_session:20186465e7a485ce83bb88f8ec9588e7', '103.252.34.6', 20260511020118, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383436343837383b6d6573736167657c733a32343a224c6f67676564206f7574207375636365737366756c6c792e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d5f63695f70726576696f75735f75726c7c733a33383a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f6c6f67696e223b),
('ci_session:56179cd9619babe38ea674ea5357c464', '103.252.34.6', 20260511141107, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383530383536323b5f63695f70726576696f75735f75726c7c733a34343a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f61646d696e2f73616c6573223b637372665f746573745f6e616d657c733a33323a226437336439336234643531343133613638323636343862313833616434303163223b757365727c613a313a7b733a323a226964223b693a32343b7d),
('ci_session:6df86080136e31fe5c647a20fe3baf91', '136.158.46.146', 20260511014242, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383436333735383b5f63695f70726576696f75735f75726c7c733a34343a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f61646d696e2f7573657273223b637372665f746573745f6e616d657c733a33323a223333393562623061386631656463393332373531356236613362626462363939223b757365727c613a313a7b733a323a226964223b693a31363b7d),
('ci_session:6fc93d0f6a3d99f0d402f58bb0e9fab3', '136.158.46.146', 20260510094915, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383430363535353b5f63695f70726576696f75735f75726c7c733a34343a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f757365722f736166657479223b637372665f746573745f6e616d657c733a33323a223232663065303639326362326366333830396238303962653338656461346166223b757365727c613a313a7b733a323a226964223b693a32323b7d),
('ci_session:72cbd9a59060bf6b6854817d76334204', '2a02:4780:75:289c::1', 20260510103024, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383430393032343b637372665f746573745f6e616d657c733a33323a223064636462613737373562356264353436626561663564353463356531623537223b5f63695f70726576696f75735f75726c7c733a34393a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f6c6f67696e2f6d616769632d6c696e6b223b),
('ci_session:82c488271420680ab57995be0f5aea48', '136.158.46.146', 20260510085804, 0x6265666f72654c6f67696e55726c7c733a35373a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f696e6465782e7068702f61646d696e2f626f6f6b696e6773223b5f5f63695f766172737c613a313a7b733a31343a226265666f72654c6f67696e55726c223b693a313737383430333338353b7d5f5f63695f6c6173745f726567656e65726174657c693a313737383430333438343b5f63695f70726576696f75735f75726c7c733a33383a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f6c6f67696e223b637372665f746573745f6e616d657c733a33323a226234383964643862343035613731396164313662663431333233643433346662223b),
('ci_session:8a118a03c5d8087ef009109b8e793c8e', '136.158.46.146', 20260511040224, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383437323134343b5f63695f70726576696f75735f75726c7c733a34343a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f757365722f736166657479223b637372665f746573745f6e616d657c733a33323a226130646461353465363431336236613337646534356365633565313938346166223b757365727c613a313a7b733a323a226964223b693a31353b7d),
('ci_session:8e7de6484d00b751094ba9910d798a34', '136.158.46.146', 20260511140805, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383530383435323b5f63695f70726576696f75735f75726c7c733a34353a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f757365722f626f6f6b696e67223b637372665f746573745f6e616d657c733a33323a223566326532386662316263623035343863306337333166336333616534663533223b757365727c613a313a7b733a323a226964223b693a32323b7d),
('ci_session:9397050c6771715e775d07b66c89c8a9', '2a02:4780:75:289c::1', 20260510103024, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383430393032343b637372665f746573745f6e616d657c733a33323a226137386538306332666435313134643162663432626262333737636530316237223b5f63695f70726576696f75735f75726c7c733a34313a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f7265676973746572223b),
('ci_session:97f550f43e0e20d525b91025687ca9e3', '2a02:4780:75:289c::1', 20260510103023, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383430393032333b5f5f63695f766172737c613a303a7b7d5f63695f70726576696f75735f75726c7c733a33383a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f6c6f67696e223b),
('ci_session:c0626f778f5ab95607f3cbd670cca300', '2602:fa87:1:34::a', 20260511124331, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383530333337383b5f63695f70726576696f75735f75726c7c733a33383a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f6c6f67696e223b6572726f727c733a32353a22496e76616c696420456d61696c206f722050617373776f7264223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('ci_session:caaeee1c4fd001a6edb4dd293122abd8', '104.164.126.248', 20260511112418, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383439383635383b5f63695f70726576696f75735f75726c7c733a34393a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f6c6f67696e2f6d616769632d6c696e6b223b637372665f746573745f6e616d657c733a33323a226437626431383164616465363632653661393732636566326161396533656665223b),
('ci_session:cee9992f4b80bba124d31b88748fdf90', '136.158.46.146', 20260511040946, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383437323538363b5f63695f70726576696f75735f75726c7c733a34353a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f757365722f626f6f6b696e67223b637372665f746573745f6e616d657c733a33323a226130646461353465363431336236613337646534356365633565313938346166223b757365727c613a313a7b733a323a226964223b693a31353b7d5f5f63695f766172737c613a303a7b7d),
('ci_session:d7b16bfa456e3d3b37cfe9a61befa842', '136.158.46.146', 20260510095009, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383430363535353b5f63695f70726576696f75735f75726c7c733a34353a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f757365722f72657669657773223b637372665f746573745f6e616d657c733a33323a223232663065303639326362326366333830396238303962653338656461346166223b757365727c613a313a7b733a323a226964223b693a32323b7d5f5f63695f766172737c613a303a7b7d),
('ci_session:deb948b45043ae23673f3b7f41b34ad6', '136.158.46.146', 20260511050613, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383437353937333b5f63695f70726576696f75735f75726c7c733a34353a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f757365722f626f6f6b696e67223b637372665f746573745f6e616d657c733a33323a226130646461353465363431336236613337646534356365633565313938346166223b757365727c613a313a7b733a323a226964223b693a31353b7d5f5f63695f766172737c613a303a7b7d),
('ci_session:dfdd7f7e0078e1e280fecf070e8d5aa4', '136.158.46.146', 20260510091405, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383430343434353b6d6573736167657c733a32343a224c6f67676564206f7574207375636365737366756c6c792e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d5f63695f70726576696f75735f75726c7c733a33383a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f6c6f67696e223b),
('ci_session:e3a4ab6d7f680ef40b398974e51910fa', '2602:fa5d:1::16', 20260511124231, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383530333335303b5f63695f70726576696f75735f75726c7c733a34313a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f7265676973746572223b637372665f746573745f6e616d657c733a33323a226333313865373261646366313732333338623966653130313666396637303264223b),
('ci_session:e59ff591ac490259ddbe5eda4b949d0b', '136.158.46.146', 20260511051141, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383437363236303b5f63695f70726576696f75735f75726c7c733a34373a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f61646d696e2f626f6f6b696e6773223b637372665f746573745f6e616d657c733a33323a223134343861613039376332636639636336386438396632363435353837373062223b757365727c613a313a7b733a323a226964223b693a31363b7d737563636573737c733a32393a22426f6f6b696e67206d61726b65642061732066756c6c7920706169642e223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('ci_session:e9bfca1521e2dd14f41d9d25b015f1c4', '136.158.46.146', 20260510092935, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383430353337353b5f63695f70726576696f75735f75726c7c733a34343a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f757365722f736166657479223b637372665f746573745f6e616d657c733a33323a223361306537373339313861346664626463316435343630313536343433336264223b757365727c613a313a7b733a323a226964223b693a31353b7d),
('ci_session:f1163710e97f5ef0b6ff751da27cf60b', '136.158.46.146', 20260510091917, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383430343735373b5f63695f70726576696f75735f75726c7c733a34383a2268747470733a2f2f6d61726973656e73652e6e6574776f72712e6f6e6c696e652f757365722f61637469766974696573223b637372665f746573745f6e616d657c733a33323a223361306537373339313861346664626463316435343630313536343433336264223b757365727c613a313a7b733a323a226964223b693a31353b7d);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1772768729, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1772768729, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1772768729, 1),
(4, '2026-04-04-000001', 'App\\Database\\Migrations\\CreateSeaConditionsTable', 'default', 'App', 1775308654, 2),
(5, '2026-04-04-000002', 'App\\Database\\Migrations\\CreateActivitiesTable', 'default', 'App', 1775308654, 2),
(6, '2026-04-04-000003', 'App\\Database\\Migrations\\CreateReviewsTable', 'default', 'App', 1775308654, 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_type` enum('down_payment','full_payment','balance') NOT NULL,
  `payment_method` varchar(50) DEFAULT 'cash',
  `notes` text DEFAULT NULL,
  `gcash_receipt` varchar(255) DEFAULT NULL,
  `gcash_ref` varchar(100) DEFAULT NULL,
  `verified_by` int(10) UNSIGNED DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `recorded_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`id`, `booking_id`, `user_id`, `amount`, `payment_type`, `payment_method`, `notes`, `gcash_receipt`, `gcash_ref`, `verified_by`, `verified_at`, `is_verified`, `recorded_by`, `created_at`) VALUES
(1, 25, 6, 3900.00, 'full_payment', 'gcash', 'Pending admin verification', '1777559506_c90c56e5a34f1ff3e039.png', '123456789', NULL, NULL, 0, NULL, '2026-04-30 14:31:46'),
(2, 27, 6, 3600.00, 'full_payment', 'gcash', 'Pending admin verification', '1777604191_0e49cf543f577fb3ebd3.png', '1234r56789', NULL, NULL, 0, NULL, '2026-05-01 02:56:31'),
(3, 29, 6, 500.00, 'full_payment', 'gcash', 'Pending admin verification', '1777605560_36546da4f1b5cccbbace.png', '123456789', NULL, NULL, 0, NULL, '2026-05-01 03:19:20'),
(4, 30, 6, 3600.00, 'full_payment', 'gcash', 'Pending admin verification', '1777605670_08dacaefcd51f548ea02.png', '123456789', NULL, NULL, 0, NULL, '2026-05-01 03:21:10'),
(5, 31, 8, 3600.00, 'full_payment', 'gcash', 'Pending admin verification', '1777605912_ce0a784bb1cb6d474090.png', '1234r56789', NULL, NULL, 0, NULL, '2026-05-01 03:25:12'),
(6, 33, 8, 3000.00, 'full_payment', 'gcash', 'Pending admin verification', '1777608772_5be04e393665f86ebd44.png', '23456789', NULL, NULL, 0, NULL, '2026-05-01 04:12:52'),
(7, 34, 2, 3000.00, 'full_payment', 'gcash', 'Pending admin verification', '1777609442_4c17bef69ec2eb26603a.png', '123456789', NULL, NULL, 0, NULL, '2026-05-01 04:24:02'),
(8, 35, 8, 500.00, 'full_payment', 'gcash', 'Pending admin verification', '1777610380_2c55e98cf10a3a3fae09.png', '123456789', NULL, NULL, 0, NULL, '2026-05-01 04:39:40'),
(9, 36, 8, 1500.00, 'down_payment', 'gcash', 'Pending admin verification', '1777611405_92e74bc5286e212ad3b5.png', '123456789', NULL, NULL, 0, NULL, '2026-05-01 04:56:45'),
(10, 37, 8, 100.00, 'full_payment', 'gcash', 'Pending admin verification', '1777644757_7aa6e04b7f2d4490e5c4.png', '32456u78', NULL, NULL, 0, NULL, '2026-05-01 14:12:37'),
(11, 36, 8, 1500.00, 'down_payment', 'gcash', 'Pending admin verification', '1777645435_4cca1250ade75f7dffdd.png', '324678', NULL, NULL, 0, NULL, '2026-05-01 14:23:55'),
(12, 36, 8, 3000.00, 'full_payment', 'gcash', 'Pending admin verification', '1777645451_6bf41888f976fde88e91.png', '3245678', NULL, NULL, 0, NULL, '2026-05-01 14:24:11'),
(13, 38, 8, 3000.00, 'full_payment', 'gcash', 'Pending admin verification', '1777787534_3d7a11ef0d2c34f69d10.png', '23456789', NULL, NULL, 0, NULL, '2026-05-03 05:52:14'),
(14, 39, 8, 3000.00, 'full_payment', 'gcash', 'Pending admin verification', '1777789828_3e2a04954d2a0a8169a7.png', '3245678', NULL, NULL, 0, NULL, '2026-05-03 06:30:28'),
(15, 40, 8, 3000.00, 'full_payment', 'gcash', 'Pending admin verification', '1777791808_bd8493f898699fa1a2ab.png', '9876543', NULL, NULL, 0, NULL, '2026-05-03 07:03:28'),
(16, 41, 8, 6000.00, 'full_payment', 'gcash', 'Pending admin verification', '1777792083_623ae314a314b3d2e316.webp', '23456789', NULL, NULL, 0, NULL, '2026-05-03 07:08:03'),
(17, 43, 8, 500.00, 'full_payment', 'gcash', 'Pending admin verification', '1777884524_9d27858d27ec4823774f.webp', '1234r56789', NULL, NULL, 0, NULL, '2026-05-04 08:48:44'),
(18, 45, 8, 13800.00, 'full_payment', 'gcash', 'Pending admin verification', '1777884956_bbc807461ff12672a1a5.png', '3243567', NULL, NULL, 0, NULL, '2026-05-04 08:55:56'),
(19, 44, 8, 3350.00, 'down_payment', 'gcash', 'Pending admin verification', '1777885077_421595e4ac395320fa87.png', '32456u78', NULL, NULL, 0, NULL, '2026-05-04 08:57:57'),
(20, 47, 8, 2500.00, 'full_payment', 'gcash', 'Pending admin verification', '1777885400_5f8fb21648a0335ef93f.png', '3245678', NULL, NULL, 0, NULL, '2026-05-04 09:03:20'),
(21, 49, 6, 1500.00, 'down_payment', 'gcash', 'Pending admin verification', '1777886687_84faab8295a7ea237493.png', '32456u78', NULL, NULL, 0, NULL, '2026-05-04 09:24:47'),
(22, 50, 6, 3000.00, 'full_payment', 'gcash', 'Pending admin verification', '1778074570_fd0973e5bf1b488f9eef.png', '23456789', NULL, NULL, 0, NULL, '2026-05-06 13:36:10'),
(23, 51, 23, 6900.00, 'down_payment', 'gcash', 'Pending admin verification', '1778293534_9ecfb22014556dfbef19.png', '16233192937361287', NULL, NULL, 0, NULL, '2026-05-09 02:25:34'),
(24, 52, 23, 2000.00, 'down_payment', 'gcash', 'Pending admin verification', '1778294985_eafe8d418810552e6bdc.jpg', '2012202833553', 16, '2026-05-11 13:11:40', 1, NULL, '2026-05-09 02:49:45'),
(25, 54, 15, 150.00, 'down_payment', 'gcash', 'Pending admin verification', '1778476166_1f22c097559e30298062.png', NULL, 16, '2026-05-11 13:11:24', 1, NULL, '2026-05-11 13:09:26'),
(26, 53, 15, 150.00, 'down_payment', 'gcash', 'Pending admin verification', '1778476215_fcd3b7c92f4840eaa9f0.png', NULL, NULL, NULL, 0, NULL, '2026-05-11 13:10:15'),
(27, 53, 15, 300.00, 'full_payment', 'gcash', 'Pending admin verification', '1778476227_e7a32ecc06d832da9bd5.png', NULL, NULL, NULL, 0, NULL, '2026-05-11 13:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `booking_id` int(10) UNSIGNED DEFAULT NULL,
  `activity` varchar(100) DEFAULT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT 5,
  `review_text` text DEFAULT NULL,
  `safe_feel` enum('yes','moderate','no') NOT NULL DEFAULT 'yes',
  `photo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `booking_id`, `activity`, `rating`, `review_text`, `safe_feel`, `photo`, `created_at`, `updated_at`) VALUES
(8, 2, NULL, 'Banana Boat', 5, 'masaya naman', 'yes', '1776056918_f4b7536790f40f11fa09.png', '2026-04-13 05:08:38', '2026-04-13 05:08:38'),
(9, 9, NULL, 'Banana Boat', 5, 'okay sya', 'yes', '1776085202_c29f2e7e59d376044fee.png', '2026-04-13 13:00:02', '2026-04-13 13:00:02'),
(10, 6, NULL, 'Banana Boat', 5, 'happy kami, ang galing lang na meron silang detector ba yon ang galing galing', 'yes', '1777560212_2740bb22bf9a873668c1.jpg', '2026-04-30 14:43:32', '2026-04-30 14:43:32'),
(11, 8, NULL, 'Kayaking', 3, 'maganda naenjoy ko ang pagkakayak, yey', 'yes', '1777792148_e6107cf8107884c9b91d.webp', '2026-05-03 07:09:08', '2026-05-03 07:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `booking_code` varchar(20) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `activity_name` varchar(100) NOT NULL,
  `all_activities` text DEFAULT NULL,
  `participants` int(11) NOT NULL DEFAULT 1,
  `sale_date` date NOT NULL COMMENT 'Date of the activity',
  `sale_recorded_at` datetime NOT NULL COMMENT 'When this row was inserted',
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Actual cash received so far',
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'total_amount - amount_paid',
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` enum('unpaid','partial','paid') NOT NULL DEFAULT 'unpaid',
  `booking_status` enum('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `booking_id`, `booking_code`, `user_id`, `activity_name`, `all_activities`, `participants`, `sale_date`, `sale_recorded_at`, `total_amount`, `amount_paid`, `balance`, `payment_method`, `payment_status`, `booking_status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 5, 'WWS-EE28A6D8', 2, 'Banana Boat', NULL, 12, '2026-04-13', '2026-04-13 04:22:39', 6000.00, 0.00, 6000.00, NULL, 'unpaid', 'completed', NULL, '2026-04-13 04:22:39', '2026-04-13 04:22:39'),
(2, 6, 'WWS-9A438C4E', 2, 'Flying Saucer', NULL, 10, '2026-04-13', '2026-04-13 04:25:37', 6000.00, 0.00, 6000.00, NULL, 'unpaid', 'completed', NULL, '2026-04-13 04:25:37', '2026-04-13 04:25:37'),
(3, 7, 'WWS-61F25FE8', 9, 'Banana Boat', NULL, 12, '2026-04-14', '2026-04-13 12:57:38', 6000.00, 0.00, 6000.00, NULL, 'unpaid', 'completed', NULL, '2026-04-13 12:57:38', '2026-04-13 12:57:38'),
(4, 8, 'WWS-9A92E760', 9, 'Kayaking', NULL, 2, '2026-04-14', '2026-04-13 13:00:35', 300.00, 0.00, 300.00, NULL, 'unpaid', 'pending', NULL, '2026-04-13 13:00:35', '2026-04-13 13:00:35'),
(5, 9, 'WWS-27467615', 9, 'Jet Ski', NULL, 2, '2026-04-14', '2026-04-13 13:01:20', 2500.00, 0.00, 2500.00, NULL, 'unpaid', 'pending', NULL, '2026-04-13 13:01:20', '2026-04-13 13:01:20'),
(6, 10, 'WWS-79EA4C14', 2, 'Jet Ski', NULL, 2, '2026-04-30', '2026-04-16 12:53:41', 2500.00, 0.00, 2500.00, NULL, 'unpaid', 'pending', NULL, '2026-04-16 12:53:41', '2026-04-16 12:53:41'),
(8, 11, 'WWS-88802208', 2, 'Flying Saucer', NULL, 2, '2026-04-17', '2026-04-16 21:08:57', 1200.00, 0.00, 1200.00, NULL, 'unpaid', 'pending', NULL, '2026-04-16 21:08:57', '2026-04-16 21:08:57'),
(9, 12, 'WWS-AE920DB9', 2, 'Jet Ski', NULL, 2, '2026-04-16', '2026-04-16 21:22:46', 2500.00, 0.00, 2500.00, NULL, 'unpaid', 'pending', NULL, '2026-04-16 21:22:46', '2026-04-16 21:22:46'),
(10, 13, 'WWS-EBF37EF5', 2, 'Jet Ski', NULL, 2, '2026-04-30', '2026-04-16 21:34:08', 2500.00, 0.00, 2500.00, NULL, 'unpaid', 'pending', NULL, '2026-04-16 21:34:08', '2026-04-16 21:34:08'),
(11, 14, 'WWS-96A1ACA0', 2, 'Jet Ski', NULL, 2, '2026-04-17', '2026-04-16 21:39:50', 2500.00, 0.00, 2500.00, NULL, 'unpaid', 'pending', NULL, '2026-04-16 21:39:50', '2026-04-16 21:39:50'),
(12, 15, 'WWS-FC69EF9D', 2, 'Jet Ski', NULL, 12, '2026-04-18', '2026-04-16 21:59:30', 2500.00, 0.00, 2500.00, NULL, 'unpaid', 'pending', NULL, '2026-04-16 21:59:30', '2026-04-16 21:59:30'),
(13, 16, 'WWS-41466D22', 2, 'Banana Boat', NULL, 4, '2026-04-18', '2026-04-16 22:02:45', 2000.00, 0.00, 2000.00, NULL, 'unpaid', 'pending', NULL, '2026-04-16 22:02:45', '2026-04-16 22:02:45'),
(14, 17, 'WWS-1D78C191', 2, 'Jet Ski', NULL, 14, '2026-04-19', '2026-04-18 23:15:40', 2500.00, 0.00, 2500.00, NULL, 'unpaid', 'pending', NULL, '2026-04-18 23:15:40', '2026-04-18 23:15:40'),
(15, 18, 'WWS-C4B11C2F', 2, 'Flying Saucer', 'Flying Saucer,Kayaking', 5, '2026-04-20', '2026-04-19 22:37:54', 3000.00, 0.00, 3000.00, NULL, 'unpaid', 'pending', NULL, '2026-04-19 22:37:54', '2026-04-19 22:37:54'),
(16, 19, 'WWS-709462C0', 2, 'Banana Boat', 'Banana Boat,Jet Ski', 14, '2026-04-22', '2026-04-19 22:41:03', 7000.00, 0.00, 7000.00, NULL, 'unpaid', 'pending', NULL, '2026-04-19 22:41:03', '2026-04-19 22:41:03'),
(17, 20, 'WWS-A8AE37D5', 6, 'Kayaking', 'Kayaking', 2, '2026-05-10', '2026-04-30 20:19:35', 300.00, 0.00, 300.00, NULL, 'unpaid', 'pending', NULL, '2026-04-30 20:19:35', '2026-04-30 20:19:35'),
(18, 21, 'WWS-82E484E2', 6, 'Flying Saucer', 'Flying Saucer,Kayaking', 12, '2026-05-10', '2026-04-30 20:24:22', 3600.00, 0.00, 3600.00, NULL, 'unpaid', 'pending', NULL, '2026-04-30 20:24:22', '2026-04-30 20:24:22'),
(19, 22, 'WWS-C205541D', 6, 'Kayaking', 'Kayaking,Flying Saucer', 12, '2026-05-10', '2026-04-30 20:37:57', 300.00, 0.00, 300.00, NULL, 'unpaid', 'pending', NULL, '2026-04-30 20:37:57', '2026-04-30 20:37:57'),
(20, 23, 'WWS-2A3A7632', 6, 'Kayaking', 'Kayaking,Flying Saucer,Banana Boat', 24, '2026-05-03', '2026-04-30 21:15:07', 300.00, 0.00, 300.00, NULL, 'unpaid', 'pending', NULL, '2026-04-30 21:15:07', '2026-04-30 21:15:07'),
(21, 24, 'WWS-1E498228', 6, 'Jet Ski', 'Jet Ski,Flying Saucer', 12, '2026-05-10', '2026-04-30 21:51:15', 2500.00, 0.00, 2500.00, NULL, 'unpaid', 'pending', NULL, '2026-04-30 21:51:15', '2026-04-30 21:51:15'),
(22, 25, 'WWS-24F2A04F', 6, 'Banana Boat', 'Banana Boat,Jet Ski', 13, '2026-05-07', '2026-04-30 22:03:01', 3900.00, 3900.00, 0.00, NULL, 'paid', 'completed', NULL, '2026-04-30 22:03:01', '2026-04-30 22:32:24'),
(26, 26, 'WWS-FC17B733', 6, 'Banana Boat', 'Banana Boat,Kayaking', 14, '2026-05-01', '2026-05-01 10:54:20', 4200.00, 0.00, 4200.00, NULL, 'unpaid', 'pending', NULL, '2026-05-01 10:54:20', '2026-05-01 10:54:20'),
(27, 27, 'WWS-1D3A6BB1', 6, 'Flying Saucer', 'Flying Saucer,Kayaking', 12, '2026-05-02', '2026-05-01 10:55:29', 3600.00, 3600.00, 0.00, NULL, 'paid', 'pending', NULL, '2026-05-01 10:55:29', '2026-05-01 10:56:31'),
(29, 28, 'WWS-2245051C', 6, 'Jet Ski', 'Jet Ski,Kayaking', 4, '2026-05-10', '2026-05-01 11:11:02', 2500.00, 0.00, 2500.00, NULL, 'unpaid', 'pending', NULL, '2026-05-01 11:11:02', '2026-05-01 11:11:02'),
(30, 29, 'WWS-F2ED134D', 6, 'Kayaking', 'Kayaking,Jet Ski', 4, '2026-05-10', '2026-05-01 11:16:33', 500.00, 500.00, 0.00, NULL, 'paid', 'confirmed', NULL, '2026-05-01 11:16:33', '2026-05-01 22:43:24'),
(32, 30, 'WWS-6987DF9C', 6, 'Banana Boat', 'Banana Boat', 12, '2026-05-10', '2026-05-01 11:20:36', 3600.00, 3600.00, 0.00, NULL, 'paid', 'confirmed', NULL, '2026-05-01 11:20:36', '2026-05-01 22:43:20'),
(34, 31, 'WWS-B8613F49', 8, 'Banana Boat', 'Banana Boat', 12, '2026-05-10', '2026-05-01 11:24:52', 3600.00, 3600.00, 0.00, NULL, 'paid', 'completed', NULL, '2026-05-01 11:24:52', '2026-05-01 11:25:52'),
(41, 34, 'WWS-C3E10D5D', 2, 'Flying Saucer', 'Flying Saucer', 10, '2026-05-10', '2026-05-01 12:23:47', 3000.00, 3000.00, 0.00, NULL, 'paid', 'completed', NULL, '2026-05-01 12:23:47', '2026-05-01 12:25:01'),
(48, 36, 'WWS-02953AB4', 8, 'Flying Saucer', 'Flying Saucer', 10, '2026-05-10', '2026-05-01 12:56:33', 3000.00, 3000.00, 0.00, NULL, 'paid', 'confirmed', NULL, '2026-05-01 12:56:33', '2026-05-01 22:43:14'),
(57, 38, 'WWS-B7868C41', 8, 'Kayaking', 'Kayaking,Jet Ski', 4, '2026-05-10', '2026-05-03 13:51:17', 3000.00, 3000.00, 0.00, NULL, 'paid', 'completed', NULL, '2026-05-03 13:51:17', '2026-05-03 13:53:14'),
(61, 39, 'WWS-3689E074', 8, 'Kayaking', 'Kayaking,Jet Ski', 4, '2026-05-10', '2026-05-03 14:30:01', 3000.00, 3000.00, 0.00, NULL, 'paid', 'pending', NULL, '2026-05-03 14:30:01', '2026-05-03 14:30:28'),
(63, 40, 'WWS-02E4DB35', 8, 'Jet Ski', 'Jet Ski,Kayaking', 4, '2026-05-10', '2026-05-03 14:55:19', 3000.00, 3000.00, 0.00, NULL, 'paid', 'pending', NULL, '2026-05-03 14:55:19', '2026-05-03 15:03:28'),
(65, 41, 'WWS-8EEDF499', 8, 'Jet Ski', 'Jet Ski,Flying Saucer,Kayaking,Banana Boat', 5, '2026-05-10', '2026-05-03 15:06:22', 6000.00, 6000.00, 0.00, NULL, 'paid', 'pending', NULL, '2026-05-03 15:06:22', '2026-05-03 15:08:03'),
(67, 42, 'WWS-C21EF9C5', 8, 'Banana Boat', 'Banana Boat', 12, '2026-05-23', '2026-05-04 16:48:00', 3600.00, 0.00, 3600.00, NULL, 'unpaid', 'pending', NULL, '2026-05-04 16:48:00', '2026-05-04 16:48:00'),
(68, 43, 'WWS-387237EF', 8, 'Kayaking', 'Kayaking', 2, '2026-05-18', '2026-05-04 16:48:24', 500.00, 500.00, 0.00, NULL, 'paid', 'completed', NULL, '2026-05-04 16:48:24', '2026-05-04 16:54:59'),
(70, 44, 'WWS-80F04924', 8, 'Banana Boat', 'Banana Boat,Jet Ski', 14, '2026-05-12', '2026-05-04 16:49:56', 6700.00, 3350.00, 3350.00, NULL, 'partial', 'pending', NULL, '2026-05-04 16:49:56', '2026-05-04 16:57:57'),
(71, 45, 'WWS-3920D9BF', 8, 'Kayaking', 'Kayaking,Flying Saucer,Banana Boat,Jet Ski', 18, '2026-05-27', '2026-05-04 16:52:58', 13800.00, 13800.00, 0.00, NULL, 'paid', 'confirmed', NULL, '2026-05-04 16:52:58', '2026-05-09 12:41:54'),
(76, 46, 'WWS-B420E065', 8, 'Kayaking', 'Kayaking,Jet Ski', 4, '2026-05-10', '2026-05-04 17:02:02', 3000.00, 0.00, 3000.00, NULL, 'unpaid', 'confirmed', NULL, '2026-05-04 17:02:02', '2026-05-04 17:34:59'),
(77, 47, 'WWS-8045C506', 8, 'Jet Ski', 'Jet Ski', 2, '2026-05-31', '2026-05-04 17:03:10', 2500.00, 2500.00, 0.00, NULL, 'paid', 'completed', NULL, '2026-05-04 17:03:10', '2026-05-04 17:04:15'),
(82, 49, 'WWS-43E1D51E', 6, 'Kayaking', 'Kayaking,Jet Ski', 4, '2026-05-23', '2026-05-04 17:12:35', 3000.00, 1500.00, 1500.00, NULL, 'partial', 'completed', NULL, '2026-05-04 17:12:35', '2026-05-04 17:29:04'),
(92, 52, 'WWS-D61E9104', 23, 'Crystal Kayak', 'Crystal Kayak,Jet Ski', 3, '2026-05-21', '2026-05-09 02:48:34', 4000.00, 4000.00, 0.00, NULL, 'paid', 'completed', NULL, '2026-05-09 02:48:34', '2026-05-11 05:11:40'),
(97, 53, 'WWS-397E8481', 15, 'Banana Boat', 'Banana Boat', 1, '2026-05-11', '2026-05-11 05:06:33', 300.00, 300.00, 0.00, NULL, 'paid', 'completed', NULL, '2026-05-11 05:06:33', '2026-05-11 05:11:16'),
(98, 54, 'WWS-28E8D74A', 15, 'Banana Boat', 'Banana Boat', 1, '2026-05-11', '2026-05-11 05:07:31', 300.00, 300.00, 0.00, NULL, 'paid', 'completed', NULL, '2026-05-11 05:07:31', '2026-05-11 05:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `sea_conditions`
--

CREATE TABLE `sea_conditions` (
  `id` int(10) UNSIGNED NOT NULL,
  `wind_speed` decimal(5,2) NOT NULL,
  `wind_direction` varchar(20) DEFAULT NULL,
  `wave_height` decimal(5,2) NOT NULL,
  `wave_period` decimal(5,2) NOT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `safety_status` enum('safe','moderate','unsafe') NOT NULL DEFAULT 'safe',
  `notes` text DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `recorded_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sea_conditions_log`
--

CREATE TABLE `sea_conditions_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `wind_speed` decimal(5,2) NOT NULL,
  `wind_direction` varchar(20) DEFAULT NULL,
  `wave_height` decimal(5,2) NOT NULL,
  `wave_period` decimal(5,2) NOT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `humidity` decimal(5,2) DEFAULT NULL,
  `visibility` decimal(5,2) DEFAULT NULL,
  `uv_index` tinyint(4) DEFAULT NULL,
  `safety_status` enum('safe','moderate','unsafe') NOT NULL DEFAULT 'safe',
  `source` varchar(50) DEFAULT 'marisense_api',
  `notes` text DEFAULT NULL,
  `recorded_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sea_conditions_log`
--

INSERT INTO `sea_conditions_log` (`id`, `wind_speed`, `wind_direction`, `wave_height`, `wave_period`, `temperature`, `humidity`, `visibility`, `uv_index`, `safety_status`, `source`, `notes`, `recorded_at`) VALUES
(1, 12.50, 'NE', 0.80, 6.20, 29.50, 75.00, 8.50, 7, 'safe', 'marisense_api', NULL, '2026-04-12 21:43:00'),
(2, 18.00, 'N', 1.20, 7.00, 28.00, 80.00, 7.00, 6, 'moderate', 'marisense_api', NULL, '2026-04-12 20:43:00'),
(3, 10.00, 'E', 0.50, 5.50, 30.20, 70.00, 10.00, 8, 'safe', 'marisense_api', NULL, '2026-04-12 19:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `sea_safety_events`
--

CREATE TABLE `sea_safety_events` (
  `id` int(11) UNSIGNED NOT NULL,
  `event_type` varchar(64) NOT NULL,
  `message` text DEFAULT NULL,
  `wave_height` decimal(6,2) DEFAULT NULL,
  `wind_speed` decimal(6,2) DEFAULT NULL,
  `threshold_wave_height` decimal(6,2) NOT NULL DEFAULT 1.20,
  `threshold_wind_speed` decimal(6,2) NOT NULL DEFAULT 20.00,
  `consecutive_packets` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `duration_seconds` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `affected_bookings` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `details` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sea_safety_events`
--

INSERT INTO `sea_safety_events` (`id`, `event_type`, `message`, `wave_height`, `wind_speed`, `threshold_wave_height`, `threshold_wind_speed`, `consecutive_packets`, `duration_seconds`, `affected_bookings`, `details`, `created_at`) VALUES
(1, 'unsafe_confirmed', 'Unsafe sea conditions confirmed from sustained buoy readings.', 6.00, 20.41, 1.20, 20.00, 5, 240, 0, NULL, '2026-05-11 03:54:34'),
(2, 'safe_recovered', 'Sea conditions recovered consistently. Booking acceptance resumed.', 0.99, 9.69, 1.20, 20.00, 5, 240, 0, NULL, '2026-05-11 12:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `sea_safety_state`
--

CREATE TABLE `sea_safety_state` (
  `id` tinyint(1) UNSIGNED NOT NULL,
  `status` enum('safe','unsafe') NOT NULL DEFAULT 'safe',
  `booking_blocked` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `last_unsafe_confirmed_at` datetime DEFAULT NULL,
  `last_safe_confirmed_at` datetime DEFAULT NULL,
  `last_wave_height` decimal(6,2) DEFAULT NULL,
  `last_wind_speed` decimal(6,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sea_safety_state`
--

INSERT INTO `sea_safety_state` (`id`, `status`, `booking_blocked`, `last_unsafe_confirmed_at`, `last_safe_confirmed_at`, `last_wave_height`, `last_wind_speed`, `created_at`, `updated_at`) VALUES
(1, 'safe', 0, '2026-05-11 03:54:34', '2026-05-11 12:21:34', 0.99, 9.69, '2026-05-09 23:38:08', '2026-05-11 12:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `email_token` varchar(64) DEFAULT NULL,
  `email_token_expires` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `contact_number`, `email_verified_at`, `email_token`, `email_token_expires`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-03-06 03:46:31', '2026-03-06 03:46:31', NULL),
(2, 'earl', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-05-11 02:01:01', '2026-03-06 09:04:13', '2026-03-06 09:04:13', NULL),
(3, 'angel', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-03-06 09:06:34', '2026-03-06 09:06:34', NULL),
(4, 'apol', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-03-06 09:17:15', '2026-03-06 09:17:15', NULL),
(5, 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-03-06 09:38:42', '2026-03-06 09:38:42', NULL),
(6, 'useracc', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-05-06 13:36:10', '2026-03-06 10:09:27', '2026-03-06 10:09:27', NULL),
(7, 'adminacc', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-05-06 13:33:51', '2026-03-06 10:10:39', '2026-03-06 10:10:39', NULL),
(8, 'vian', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-05-04 09:03:20', '2026-03-29 15:49:43', '2026-03-29 15:49:43', NULL),
(9, 'posa', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-04-13 13:01:23', '2026-03-31 16:34:13', '2026-03-31 16:34:13', NULL),
(10, 'Abby Garcia', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-05-01 03:15:30', '2026-04-10 03:25:57', '2026-04-10 03:25:57', NULL),
(11, 'earlsin', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-04-12 13:46:25', '2026-04-12 13:46:25', NULL),
(12, 'erlsnc10', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-04-13 03:45:09', '2026-04-13 03:45:09', NULL),
(13, 'erlsnc11', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-04-13 03:48:00', '2026-04-13 03:48:00', NULL),
(14, 'earl_123', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-05-01 03:22:52', '2026-05-01 03:22:52', NULL),
(15, 'power-on', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-05-11 22:08:43', '2026-05-07 00:27:17', '2026-05-07 00:27:17', NULL),
(16, 'admin___', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-05-11 13:11:41', '2026-05-07 00:36:13', '2026-05-07 00:36:13', NULL),
(22, 'ninja_cool_power_on_aray_mo', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-05-11 22:08:05', '2026-05-08 14:00:39', '2026-05-08 14:00:39', NULL),
(23, 'injelme', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-05-09 02:57:49', '2026-05-08 14:02:28', '2026-05-08 14:02:28', NULL),
(24, 'administrator', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-05-11 22:11:07', '2026-05-10 08:55:06', '2026-05-10 08:55:06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_code` (`booking_code`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_activity_date` (`activity_name`,`date`),
  ADD KEY `idx_date_status` (`date`,`status`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bd_booking` (`booking_id`),
  ADD KEY `idx_bd_user` (`user_id`),
  ADD KEY `idx_bd_date` (`booking_date`),
  ADD KEY `idx_bd_status` (`status`);

--
-- Indexes for table `buoy_data`
--
ALTER TABLE `buoy_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_sales_booking` (`booking_id`),
  ADD KEY `idx_sales_date` (`sale_date`),
  ADD KEY `idx_sales_activity` (`activity_name`),
  ADD KEY `idx_sales_payment` (`payment_status`);

--
-- Indexes for table `sea_conditions`
--
ALTER TABLE `sea_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sea_conditions_log`
--
ALTER TABLE `sea_conditions_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recorded_at` (`recorded_at`);

--
-- Indexes for table `sea_safety_events`
--
ALTER TABLE `sea_safety_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_event_type_created_at` (`event_type`,`created_at`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `sea_safety_state`
--
ALTER TABLE `sea_safety_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `buoy_data`
--
ALTER TABLE `buoy_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=442;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `sea_conditions`
--
ALTER TABLE `sea_conditions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sea_conditions_log`
--
ALTER TABLE `sea_conditions_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sea_safety_events`
--
ALTER TABLE `sea_safety_events`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `fk_bd_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_sales_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
