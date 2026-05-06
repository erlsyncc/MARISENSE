-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: May 06, 2026 at 07:36 AM
-- Server version: 8.0.46
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marisense_vrbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `duration` int DEFAULT NULL COMMENT 'in minutes',
  `max_riders` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `difficulty` enum('Easy','Moderate','Hard') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Moderate',
  `status` enum('active','paused') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `description`, `price`, `duration`, `max_riders`, `difficulty`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Jet Ski', NULL, 2500.00, 15, '1–2 persons', 'Moderate', 'active', 'jetski.jpg', '2026-04-04 13:17:34', '2026-04-04 13:17:34'),
(2, 'Banana Boat', NULL, 500.00, 10, 'Up to 12', 'Easy', 'active', 'bananaboats.jpg', '2026-04-04 13:17:34', '2026-04-04 13:17:34'),
(3, 'Kayaking', NULL, 300.00, 30, '1–2 persons', 'Easy', 'active', 'kayak.jpg', '2026-04-04 13:17:34', '2026-04-04 13:17:34'),
(4, 'Flying Saucer', NULL, 600.00, 10, 'Up to 10', 'Moderate', 'active', 'flying.jpg', '2026-04-04 13:17:34', '2026-04-04 13:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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
(11, 14, 'user', '2026-04-26 09:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secret` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `secret2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text COLLATE utf8mb4_general_ci,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'admin@gmail.com', '$2y$12$SEO0DizadaVLtCdZVyEshOt9XzxoGopusxGFFNnfyc2aowbNBrBy2', NULL, '{\"email_verified\":true}', 0, '2026-04-28 08:08:12', '2026-03-06 03:46:32', '2026-04-28 08:08:12'),
(2, 2, 'email_password', NULL, 'earlsincombenido0@gmail.com', '$2y$12$J.ajDDD.n0Pvfp307PvGN.k2Cr9RQSzwfWysxpoOsl8tPszjPSUYW', NULL, '{\"email_verified\":true}', 0, '2026-04-13 13:02:55', '2026-03-06 09:04:14', '2026-04-13 13:02:55'),
(3, 3, 'email_password', NULL, 'angelcortino@gmail.com', '$2y$12$ffTf0fhZCzo8/9nCP3s82.RHpOrY.97pD.KeViV8EJXNiNOK1.8Uu', NULL, '{\"email_verified\":true}', 0, '2026-03-06 09:34:14', '2026-03-06 09:06:34', '2026-03-06 09:34:14'),
(4, 4, 'email_password', NULL, 'apol@gmail.com', '$2y$12$LjhvgOa7DD3Rkgumv/1ENuNJ9.1frs/8h8MruvE7dbG4kOCStK3QW', NULL, '{\"email_verified\":true}', 0, '2026-03-06 09:17:34', '2026-03-06 09:17:16', '2026-03-06 09:17:34'),
(5, 5, 'email_password', NULL, 'user@gmail.com', '$2y$12$APOCwHqABwS9g7doo69XrOLk3oIjKxgQVl6ne3tKI22UMxcMfrFoW', NULL, '{\"email_verified\":true}', 0, '2026-03-06 10:07:13', '2026-03-06 09:38:42', '2026-03-06 10:07:13'),
(6, 6, 'email_password', NULL, 'useracc@gmail.com', '$2y$12$cs6T0c1wnWYkIyjMPPjUfeZjdwp3r8maE9YqbRCgX9o/gJzeqj7Re', NULL, '{\"email_verified\":true}', 0, '2026-04-10 02:56:55', '2026-03-06 10:09:27', '2026-04-10 02:56:55'),
(7, 7, 'email_password', NULL, 'adminacc@gmail.com', '$2y$12$KBQPWAkiNfzP1qja9eUn2eW6k.k.DHOGjAHgVuuCDrZXGN/LqfBUa', NULL, '{\"email_verified\":true}', 0, '2026-04-10 03:04:42', '2026-03-06 10:10:39', '2026-04-10 03:04:42'),
(9, 8, 'email_password', NULL, 'vian@gmail.com', '$2y$12$xZdi/oYjMNL2Bhg.xQBkpuL.6QCcnTzLzF9R/5iTXGkZSPia8DMjC', NULL, '{\"email_verified\":true}', 0, '2026-03-29 15:56:40', '2026-03-29 15:49:43', '2026-03-29 15:56:40'),
(10, 9, 'email_password', NULL, 'posa@gmail.com', '$2y$12$ny4k/qXJ7ZE8.uNcm1JqeeW2xy4UMBEAO3fTaz/I0OJ8VJK/Wb1MC', NULL, '{\"email_verified\":true}', 0, '2026-04-13 13:01:02', '2026-03-31 16:34:13', '2026-04-13 13:01:02'),
(13, 10, 'email_password', NULL, 'abbbyygarcia@gmail.com', '$2y$12$2CJzm39ZFN/KH.vOmtyFe.1pRsIpAAhnA4J5KdHIaJ5KA1mCAGFVa', NULL, '{\"email_verified\":true}', 0, '2026-04-13 13:03:20', '2026-04-10 03:25:57', '2026-04-13 13:03:20'),
(17, 10, 'magic-link', NULL, 'dbc376a4fdf52bf2e103', NULL, '2026-04-10 04:32:35', '{\"email_verified\":true}', 0, NULL, '2026-04-10 03:32:35', '2026-04-10 03:32:35'),
(19, 2, 'magic-link', NULL, 'e01b63bce9da58246ae4', NULL, '2026-04-10 04:39:35', '{\"email_verified\":true}', 0, NULL, '2026-04-10 03:39:35', '2026-04-10 03:39:35'),
(23, 14, 'email_password', NULL, 'magnaye.rp@gmail.com', '$2y$12$M1tZLx..K6mf.Sz/W2CuEeyfYcUEz41RYYOjrMg/iDg1OUfvRDHLa', NULL, '{\"email_verified\":true}', 0, '2026-05-06 07:35:00', '2026-04-26 09:10:48', '2026-05-06 07:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
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
(131, '156.146.56.171', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@gmail.com', NULL, '2026-04-24 11:58:15', 0),
(132, '156.146.56.171', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@gmail.com', 1, '2026-04-24 11:58:28', 1),
(133, '156.146.56.171', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@example.com', NULL, '2026-04-24 12:25:48', 0),
(134, '156.146.56.171', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@gmail.com', 1, '2026-04-24 12:25:56', 1),
(135, '172.18.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'angelcortino@gmail.com', NULL, '2026-04-26 09:10:23', 0),
(136, '172.18.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 14, '2026-04-26 09:10:59', 1),
(137, '172.18.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 14, '2026-04-26 09:27:25', 1),
(138, '172.18.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 14, '2026-04-26 09:27:39', 1),
(139, '172.18.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 14, '2026-04-26 09:31:42', 1),
(140, '172.18.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 14, '2026-04-26 09:39:40', 1),
(141, '172.18.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 14, '2026-04-26 09:49:19', 1),
(142, '172.18.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 14, '2026-04-26 09:49:40', 1),
(143, '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 14, '2026-04-28 08:07:21', 1),
(144, '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'admin@gmail.com', 1, '2026-04-28 08:08:12', 1),
(145, '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'email_password', 'magnaye.rp@gmail.com', 14, '2026-05-06 07:35:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `booking_code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `activity_id` int UNSIGNED DEFAULT NULL,
  `activity_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `all_activities` text COLLATE utf8mb4_general_ci,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `participants` int NOT NULL DEFAULT '1',
  `special_requests` text COLLATE utf8mb4_general_ci,
  `contact_number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `booking_type` enum('booking','reservation') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'booking',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `down_payment` decimal(10,2) NOT NULL DEFAULT '0.00',
  `down_payment_status` enum('unpaid','paid') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'unpaid',
  `down_payment_paid_at` datetime DEFAULT NULL,
  `status` enum('pending','confirmed','completed','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `payment_status` enum('unpaid','paid') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'unpaid',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `booking_code`, `activity_id`, `activity_name`, `all_activities`, `date`, `time`, `participants`, `special_requests`, `contact_number`, `booking_type`, `total_amount`, `down_payment`, `down_payment_status`, `down_payment_paid_at`, `status`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 6, 'WWS-8D7186B5', NULL, 'Jet Ski', NULL, '2026-04-04', '09:00:00', 2, '', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'cancelled', 'unpaid', '2026-04-04 11:30:53', '2026-04-04 11:30:53'),
(2, 9, 'WWS-0B3D4011', NULL, 'Flying Saucer', NULL, '2026-04-05', '09:00:00', 10, 'may kanin', NULL, 'booking', 6000.00, 0.00, 'unpaid', NULL, 'cancelled', 'unpaid', '2026-04-04 13:31:36', '2026-04-04 13:31:36'),
(3, 2, 'WWS-8061E085', NULL, 'Jet Ski', NULL, '2026-04-17', '09:00:00', 2, 'fdgdhhk', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'cancelled', 'unpaid', '2026-04-10 04:26:25', '2026-04-10 07:18:21'),
(4, 2, 'WWS-1273D145', NULL, 'Jet Ski', NULL, '2026-04-22', '07:00:00', 1, '', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'cancelled', 'unpaid', '2026-04-11 15:44:22', '2026-04-11 15:44:22'),
(5, 2, 'WWS-EE28A6D8', NULL, 'Banana Boat', NULL, '2026-04-13', '08:00:00', 12, 'asfgdhgfjhgjk', NULL, 'booking', 6000.00, 0.00, 'unpaid', NULL, 'completed', 'unpaid', '2026-04-13 04:22:39', '2026-04-13 04:22:39'),
(6, 2, 'WWS-9A438C4E', NULL, 'Flying Saucer', NULL, '2026-04-13', '07:00:00', 10, 'sadfgvb', NULL, 'booking', 6000.00, 0.00, 'unpaid', NULL, 'completed', 'unpaid', '2026-04-13 04:25:37', '2026-04-13 04:25:37'),
(7, 9, 'WWS-61F25FE8', NULL, 'Banana Boat', NULL, '2026-04-14', '08:00:00', 12, 'none', NULL, 'booking', 6000.00, 0.00, 'unpaid', NULL, 'completed', 'unpaid', '2026-04-13 12:57:38', '2026-04-13 12:57:38'),
(8, 9, 'WWS-9A92E760', NULL, 'Kayaking', NULL, '2026-04-14', '09:00:00', 2, 'dsd', NULL, 'booking', 300.00, 0.00, 'unpaid', NULL, 'pending', 'unpaid', '2026-04-13 13:00:35', '2026-04-13 13:00:35'),
(9, 9, 'WWS-27467615', NULL, 'Jet Ski', NULL, '2026-04-14', '08:00:00', 2, '', NULL, 'booking', 2500.00, 0.00, 'unpaid', NULL, 'pending', 'unpaid', '2026-04-13 13:01:20', '2026-04-13 13:01:20'),
(10, 14, 'WWS-3CC603AE', 1, 'Jet Ski', 'Jet Ski', '2026-04-27', '14:00:00', 1, 'slow ride please', '09913084036', 'booking', 2500.00, 0.00, 'unpaid', NULL, 'pending', 'unpaid', '2026-04-26 09:24:34', '2026-04-26 09:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `buoy_data`
--

CREATE TABLE `buoy_data` (
  `id` int UNSIGNED NOT NULL,
  `pitch` float NOT NULL COMMENT 'Buoy pitch angle in degrees',
  `roll` float NOT NULL COMMENT 'Buoy roll angle in degrees',
  `hall` int NOT NULL COMMENT 'Hall state reading',
  `packet_id` int NOT NULL COMMENT 'Packet sequence ID from ESP32',
  `rssi` int NOT NULL COMMENT 'Signal strength in dBm',
  `recorded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
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
  `id` int UNSIGNED NOT NULL,
  `booking_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_type` enum('down_payment','full_payment','balance') COLLATE utf8mb4_general_ci NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'cash',
  `notes` text COLLATE utf8mb4_general_ci,
  `recorded_by` int UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `booking_id` int UNSIGNED DEFAULT NULL,
  `activity` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT '5',
  `review_text` text COLLATE utf8mb4_general_ci,
  `safe_feel` enum('yes','moderate','no') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'yes',
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `booking_id`, `activity`, `rating`, `review_text`, `safe_feel`, `photo`, `created_at`, `updated_at`) VALUES
(8, 2, NULL, 'Banana Boat', 5, 'masaya naman', 'yes', '1776056918_f4b7536790f40f11fa09.png', '2026-04-13 05:08:38', '2026-04-13 05:08:38'),
(9, 9, NULL, 'Banana Boat', 5, 'okay sya', 'yes', '1776085202_c29f2e7e59d376044fee.png', '2026-04-13 13:00:02', '2026-04-13 13:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `sea_conditions`
--

CREATE TABLE `sea_conditions` (
  `id` int UNSIGNED NOT NULL,
  `wind_speed` decimal(5,2) NOT NULL,
  `wind_direction` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wave_height` decimal(5,2) NOT NULL,
  `wave_period` decimal(5,2) NOT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `safety_status` enum('safe','moderate','unsafe') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'safe',
  `notes` text COLLATE utf8mb4_general_ci,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `recorded_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sea_conditions_log`
--

CREATE TABLE `sea_conditions_log` (
  `id` int UNSIGNED NOT NULL,
  `wind_speed` decimal(5,2) NOT NULL,
  `wind_direction` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wave_height` decimal(5,2) NOT NULL,
  `wave_period` decimal(5,2) NOT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `humidity` decimal(5,2) DEFAULT NULL,
  `visibility` decimal(5,2) DEFAULT NULL,
  `uv_index` tinyint DEFAULT NULL,
  `safety_status` enum('safe','moderate','unsafe') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'safe',
  `source` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'marisense_api',
  `notes` text COLLATE utf8mb4_general_ci,
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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` text COLLATE utf8mb4_general_ci,
  `type` varchar(31) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'string',
  `context` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `email_token` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_token_expires` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `contact_number`, `email_verified_at`, `email_token`, `email_token_expires`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-04-28 08:08:15', '2026-03-06 03:46:31', '2026-03-06 03:46:31', NULL),
(2, 'earl', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-04-13 13:03:10', '2026-03-06 09:04:13', '2026-03-06 09:04:13', NULL),
(3, 'angel', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-03-06 09:06:34', '2026-03-06 09:06:34', NULL),
(4, 'apol', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-03-06 09:17:15', '2026-03-06 09:17:15', NULL),
(5, 'user', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-03-06 09:38:42', '2026-03-06 09:38:42', NULL),
(6, 'useracc', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-04-10 02:56:56', '2026-03-06 10:09:27', '2026-03-06 10:09:27', NULL),
(7, 'adminacc', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-04-10 03:04:47', '2026-03-06 10:10:39', '2026-03-06 10:10:39', NULL),
(8, 'vian', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-03-29 15:49:43', '2026-03-29 15:49:43', NULL),
(9, 'posa', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-04-13 13:01:23', '2026-03-31 16:34:13', '2026-03-31 16:34:13', NULL),
(10, 'Abby Garcia', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-04-13 13:04:00', '2026-04-10 03:25:57', '2026-04-10 03:25:57', NULL),
(11, 'earlsin', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-04-12 13:46:25', '2026-04-12 13:46:25', NULL),
(12, 'erlsnc10', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-04-13 03:45:09', '2026-04-13 03:45:09', NULL),
(13, 'erlsnc11', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2026-04-13 03:48:00', '2026-04-13 03:48:00', NULL),
(14, 'magnaye-rp', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2026-05-06 07:35:22', '2026-04-26 09:10:48', '2026-04-26 09:10:48', NULL);

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
-- Indexes for table `buoy_data`
--
ALTER TABLE `buoy_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_recorded_at` (`recorded_at`);

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `buoy_data`
--
ALTER TABLE `buoy_data`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sea_conditions`
--
ALTER TABLE `sea_conditions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sea_conditions_log`
--
ALTER TABLE `sea_conditions_log`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
