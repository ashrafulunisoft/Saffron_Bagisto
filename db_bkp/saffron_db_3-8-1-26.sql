-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Jan 08, 2026 at 01:02 PM
-- Server version: 5.7.44
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saffron_db_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `address_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_address_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'null if guest checkout',
  `cart_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'only for cart_addresses',
  `order_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'only for order_addresses',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_address` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'only for customer_addresses',
  `use_for_shipping` tinyint(1) NOT NULL DEFAULT '0',
  `additional` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `address_type`, `parent_address_id`, `customer_id`, `cart_id`, `order_id`, `first_name`, `last_name`, `gender`, `company_name`, `address`, `city`, `state`, `country`, `postcode`, `email`, `phone`, `vat_id`, `default_address`, `use_for_shipping`, `additional`, `created_at`, `updated_at`) VALUES
(1, 'cart_billing', NULL, NULL, 1, NULL, 'Giselle', 'Raymond', NULL, 'Alvarez and Barry Associates', 'Consequatur labore c', 'Aliquid vel voluptas', 'In voluptatibus aspe', 'SA', '1216', 'ashrafulinstasure@gmail.com', '01859385787', '', 0, 1, NULL, '2026-01-05 17:11:49', '2026-01-05 17:11:49'),
(2, 'cart_shipping', NULL, NULL, 1, NULL, 'Giselle', 'Raymond', NULL, 'Alvarez and Barry Associates', 'Consequatur labore c', 'Aliquid vel voluptas', 'In voluptatibus aspe', 'SA', '1216', 'ashrafulinstasure@gmail.com', '01859385787', NULL, 0, 0, NULL, '2026-01-05 17:11:49', '2026-01-05 17:11:49'),
(3, 'order_shipping', NULL, NULL, NULL, 3, 'Giselle', 'Raymond', NULL, 'Alvarez and Barry Associates', 'Consequatur labore c', 'Aliquid vel voluptas', 'In voluptatibus aspe', 'SA', '1216', 'ashrafulinstasure@gmail.com', '01859385787', NULL, 0, 0, NULL, '2026-01-05 17:11:55', '2026-01-05 17:11:55'),
(4, 'order_billing', NULL, NULL, NULL, 3, 'Giselle', 'Raymond', NULL, 'Alvarez and Barry Associates', 'Consequatur labore c', 'Aliquid vel voluptas', 'In voluptatibus aspe', 'SA', '1216', 'ashrafulinstasure@gmail.com', '01859385787', '', 0, 0, NULL, '2026-01-05 17:11:55', '2026-01-05 17:11:55'),
(5, 'customer', NULL, 6, NULL, NULL, 'Gay', 'Aguirre', NULL, 'Briggs and Kline Plc', 'Est magnam soluta ve', 'Consequatur Perfere', 'Illum ad lorem volu', 'SI', '1216', 'ashrafulinstasure@gmail.com', '01859385787', '', 0, 0, NULL, '2026-01-05 17:22:18', '2026-01-05 17:22:31'),
(6, 'cart_billing', 5, 6, 2, NULL, 'Gay', 'Aguirre', NULL, 'Briggs and Kline Plc', 'Est magnam soluta ve', 'Consequatur Perfere', 'Illum ad lorem volu', 'SI', '1216', 'ashrafulinstasure@gmail.com', '01859385787', '', 0, 1, NULL, '2026-01-05 17:22:34', '2026-01-05 17:22:34'),
(7, 'cart_shipping', 5, 6, 2, NULL, 'Gay', 'Aguirre', NULL, 'Briggs and Kline Plc', 'Est magnam soluta ve', 'Consequatur Perfere', 'Illum ad lorem volu', 'SI', '1216', 'ashrafulinstasure@gmail.com', '01859385787', NULL, 0, 0, NULL, '2026-01-05 17:22:34', '2026-01-05 17:22:34'),
(8, 'order_shipping', NULL, NULL, NULL, 4, 'Gay', 'Aguirre', NULL, 'Briggs and Kline Plc', 'Est magnam soluta ve', 'Consequatur Perfere', 'Illum ad lorem volu', 'SI', '1216', 'ashrafulinstasure@gmail.com', '01859385787', NULL, 0, 0, NULL, '2026-01-05 17:22:47', '2026-01-05 17:22:47'),
(9, 'order_billing', NULL, NULL, NULL, 4, 'Gay', 'Aguirre', NULL, 'Briggs and Kline Plc', 'Est magnam soluta ve', 'Consequatur Perfere', 'Illum ad lorem volu', 'SI', '1216', 'ashrafulinstasure@gmail.com', '01859385787', '', 0, 0, NULL, '2026-01-05 17:22:47', '2026-01-05 17:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `role_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `api_token`, `status`, `role_id`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Example', 'admin@example.com', '$2y$12$PyQZxVLNeti2t8kOuDt7f.v8BiMoiPYPYTRT5ybilltks64FLiPNq', 'u6RgqWSTvzsGdxe0hvCE4VTKbDd79WedmD4PwzeZiMKiMmFd9stnA0uQ4oeMLEG9WSNbc4u0nZobB6GB', 1, 1, NULL, NULL, '2026-01-05 13:14:16', '2026-01-05 13:14:16'),
(2, 'Lane Runolfsdottir', 'orpha.stracke@hotmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 1, 1, NULL, NULL, '2026-01-05 15:36:53', '2026-01-05 15:36:53'),
(3, 'Remington Gerlach', 'jcrist@wilkinson.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 1, 1, NULL, NULL, '2026-01-05 15:36:53', '2026-01-05 15:36:53'),
(4, 'Lelah Gutkowski', 'olaf.bergstrom@hotmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 1, 1, NULL, NULL, '2026-01-05 15:36:53', '2026-01-05 15:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `swatch_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_unique` tinyint(1) NOT NULL DEFAULT '0',
  `is_filterable` tinyint(1) NOT NULL DEFAULT '0',
  `is_comparable` tinyint(1) NOT NULL DEFAULT '0',
  `is_configurable` tinyint(1) NOT NULL DEFAULT '0',
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '1',
  `is_visible_on_front` tinyint(1) NOT NULL DEFAULT '0',
  `value_per_locale` tinyint(1) NOT NULL DEFAULT '0',
  `value_per_channel` tinyint(1) NOT NULL DEFAULT '0',
  `default_value` int(11) DEFAULT NULL,
  `enable_wysiwyg` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `code`, `admin_name`, `type`, `swatch_type`, `validation`, `regex`, `position`, `is_required`, `is_unique`, `is_filterable`, `is_comparable`, `is_configurable`, `is_user_defined`, `is_visible_on_front`, `value_per_locale`, `value_per_channel`, `default_value`, `enable_wysiwyg`, `created_at`, `updated_at`) VALUES
(1, 'sku', 'SKU', 'text', NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(2, 'name', 'Name', 'text', NULL, NULL, NULL, 3, 1, 0, 0, 1, 0, 0, 0, 1, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(3, 'url_key', 'URL Key', 'text', NULL, NULL, NULL, 4, 1, 1, 0, 0, 0, 0, 0, 1, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(4, 'tax_category_id', 'Tax Category', 'select', NULL, NULL, NULL, 5, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(5, 'new', 'New', 'boolean', NULL, NULL, NULL, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(6, 'featured', 'Featured', 'boolean', NULL, NULL, NULL, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(7, 'visible_individually', 'Visible Individually', 'boolean', NULL, NULL, NULL, 9, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(8, 'status', 'Status', 'boolean', NULL, NULL, NULL, 10, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(9, 'short_description', 'Short Description', 'textarea', NULL, NULL, NULL, 11, 1, 0, 0, 0, 0, 0, 0, 1, 0, NULL, 1, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(10, 'description', 'Description', 'textarea', NULL, NULL, NULL, 12, 1, 0, 0, 1, 0, 0, 0, 1, 0, NULL, 1, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(11, 'price', 'Price', 'price', NULL, 'decimal', NULL, 13, 1, 0, 1, 1, 0, 0, 0, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(12, 'cost', 'Cost', 'price', NULL, 'decimal', NULL, 14, 0, 0, 0, 0, 0, 1, 0, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(13, 'special_price', 'Special Price', 'price', NULL, 'decimal', NULL, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(14, 'special_price_from', 'Special Price From', 'date', NULL, NULL, NULL, 16, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(15, 'special_price_to', 'Special Price To', 'date', NULL, NULL, NULL, 17, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(16, 'meta_title', 'Meta Title', 'textarea', NULL, NULL, NULL, 18, 0, 0, 0, 0, 0, 0, 0, 1, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(17, 'meta_keywords', 'Meta Keywords', 'textarea', NULL, NULL, NULL, 20, 0, 0, 0, 0, 0, 0, 0, 1, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(18, 'meta_description', 'Meta Description', 'textarea', NULL, NULL, NULL, 21, 0, 0, 0, 0, 0, 1, 0, 1, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(19, 'length', 'Length', 'text', NULL, 'decimal', NULL, 22, 0, 0, 0, 0, 0, 1, 0, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(20, 'width', 'Width', 'text', NULL, 'decimal', NULL, 23, 0, 0, 0, 0, 0, 1, 0, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(21, 'height', 'Height', 'text', NULL, 'decimal', NULL, 24, 0, 0, 0, 0, 0, 1, 0, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(22, 'weight', 'Weight', 'text', NULL, 'decimal', NULL, 25, 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(23, 'color', 'Color', 'select', NULL, NULL, NULL, 26, 0, 0, 1, 0, 1, 1, 0, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(24, 'size', 'Size', 'select', NULL, NULL, NULL, 27, 0, 0, 1, 0, 1, 1, 0, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(25, 'brand', 'Brand', 'select', NULL, NULL, NULL, 28, 0, 0, 1, 0, 0, 1, 1, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(26, 'guest_checkout', 'Guest Checkout', 'boolean', NULL, NULL, NULL, 8, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(27, 'product_number', 'Product Number', 'text', NULL, NULL, NULL, 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, NULL, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(28, 'manage_stock', 'Manage Stock', 'boolean', NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(29, 'freshness', 'Freshness', 'date', NULL, NULL, '', NULL, 0, 0, 0, 0, 0, 1, 1, 1, 1, NULL, 0, '2026-01-06 14:25:50', '2026-01-06 14:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_families`
--

CREATE TABLE `attribute_families` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_families`
--

INSERT INTO `attribute_families` (`id`, `code`, `name`, `status`, `is_user_defined`) VALUES
(1, 'default', 'Default', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_groups`
--

CREATE TABLE `attribute_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_family_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column` int(11) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL,
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_groups`
--

INSERT INTO `attribute_groups` (`id`, `code`, `attribute_family_id`, `name`, `column`, `position`, `is_user_defined`) VALUES
(1, 'general', 1, 'General', 1, 1, 0),
(2, 'description', 1, 'Description', 1, 2, 0),
(3, 'meta_description', 1, 'Meta Description', 1, 3, 0),
(4, 'price', 1, 'Price', 2, 1, 0),
(5, 'shipping', 1, 'Shipping', 2, 2, 0),
(6, 'settings', 1, 'Settings', 2, 3, 0),
(7, 'inventories', 1, 'Inventories', 2, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_group_mappings`
--

CREATE TABLE `attribute_group_mappings` (
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `attribute_group_id` int(10) UNSIGNED NOT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_group_mappings`
--

INSERT INTO `attribute_group_mappings` (`attribute_id`, `attribute_group_id`, `position`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 6, 1),
(6, 6, 2),
(7, 6, 3),
(8, 6, 4),
(9, 2, 1),
(10, 2, 2),
(11, 4, 1),
(12, 4, 2),
(13, 4, 3),
(14, 4, 4),
(15, 4, 6),
(16, 3, 1),
(17, 3, 2),
(18, 3, 3),
(19, 5, 1),
(20, 5, 2),
(21, 5, 3),
(22, 5, 4),
(23, 1, 5),
(26, 6, 5),
(27, 4, 5),
(28, 7, 1),
(29, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_options`
--

CREATE TABLE `attribute_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `swatch_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_options`
--

INSERT INTO `attribute_options` (`id`, `attribute_id`, `admin_name`, `sort_order`, `swatch_value`) VALUES
(1, 23, 'Red', 1, NULL),
(2, 23, 'Green', 2, NULL),
(3, 23, 'Yellow', 3, NULL),
(4, 23, 'Black', 4, NULL),
(5, 23, 'White', 5, NULL),
(6, 24, 'S', 1, NULL),
(7, 24, 'M', 2, NULL),
(8, 24, 'L', 3, NULL),
(9, 24, 'XL', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_option_translations`
--

CREATE TABLE `attribute_option_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute_option_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_option_translations`
--

INSERT INTO `attribute_option_translations` (`id`, `attribute_option_id`, `locale`, `label`) VALUES
(10, 1, 'en', 'Red'),
(11, 2, 'en', 'Green'),
(12, 3, 'en', 'Yellow'),
(13, 4, 'en', 'Black'),
(14, 5, 'en', 'White'),
(15, 6, 'en', 'S'),
(16, 7, 'en', 'M'),
(17, 8, 'en', 'L'),
(18, 9, 'en', 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_translations`
--

CREATE TABLE `attribute_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_translations`
--

INSERT INTO `attribute_translations` (`id`, `attribute_id`, `locale`, `name`) VALUES
(29, 1, 'en', 'SKU'),
(30, 2, 'en', 'Name'),
(31, 3, 'en', 'URL Key'),
(32, 4, 'en', 'Tax Category'),
(33, 5, 'en', 'New'),
(34, 6, 'en', 'Featured'),
(35, 7, 'en', 'Visible Individually'),
(36, 8, 'en', 'Status'),
(37, 9, 'en', 'Short Description'),
(38, 10, 'en', 'Description'),
(39, 11, 'en', 'Price'),
(40, 12, 'en', 'Cost'),
(41, 13, 'en', 'Special Price'),
(42, 14, 'en', 'Special Price From'),
(43, 15, 'en', 'Special Price To'),
(44, 16, 'en', 'Meta Title'),
(45, 17, 'en', 'Meta Keywords'),
(46, 18, 'en', 'Meta Description'),
(47, 19, 'en', 'Length'),
(48, 20, 'en', 'Width'),
(49, 21, 'en', 'Height'),
(50, 22, 'en', 'Weight'),
(51, 23, 'en', 'Color'),
(52, 24, 'en', 'Size'),
(53, 25, 'en', 'Brand'),
(54, 26, 'en', 'Guest Checkout'),
(55, 27, 'en', 'Product Number'),
(56, 28, 'en', 'Manage Stock'),
(57, 29, 'bn', ''),
(58, 29, 'en', 'Freshness');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `channels` bigint(20) UNSIGNED NOT NULL,
  `default_category` bigint(20) UNSIGNED NOT NULL,
  `categorys` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `allow_comments` tinyint(1) NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `name`, `slug`, `short_description`, `description`, `channels`, `default_category`, `categorys`, `tags`, `author`, `author_id`, `src`, `locale`, `status`, `allow_comments`, `meta_title`, `meta_description`, `meta_keywords`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Farm to Bakery: Why People Trust Us', 'farm-to-bakery-why-people-trust-us', 'At Saffron Sweets & Bakery, we are committed to delivering the freshest and highest quality baked goods by sourcing the finest ingredients directly from trusted farms. Our \"Farm to Bakery\" approach ensures that every treat is made with the purest, most wh', '<p>At <strong>Saffron Sweets &amp; Bakery</strong>, we are committed to delivering the freshest and highest quality baked goods by sourcing the finest ingredients directly from trusted farms. Our \"Farm to Bakery\" approach ensures that every treat is made with the purest, most wholesome ingredients, supporting local farmers and communities.</p>', 1, 1, '1', '', 'Example', 1, 'blog-images/1/dnAVYc8yKrZ7kHTmNjv0BvHmJwSkQAdeSxrO2sZA.webp', 'en', 1, 1, 'Farm to Bakery: Why People Trust Saffron Sweets & Bakery | Fresh, Quality Ingredients', 'Discover why people trust Saffron Sweets & Bakery. Our \"Farm to Bakery\" approach ensures only the freshest, high-quality ingredients sourced directly from trusted local farms. Taste the difference in every dessert and experience our commitment to quality ', 'Farm to bakery, fresh ingredients, quality desserts, bakery trust, local farmers, premium bakery goods, sustainable baking, trusted bakery, Saffron Sweets & Bakery, farm-fresh sweets', '2026-01-07 00:00:00', '2026-01-07 10:47:33', '2026-01-07 10:47:34', NULL),
(2, 'Indulge in Sweet Luxury: Why Our Desserts are a Must-Try', 'indulge-in-sweet-luxury-why-our-desserts-are-a-must-try', 'At Saffron Sweets & Bakery, we are committed to delivering the freshest and highest quality baked goods by sourcing the finest ingredients directly from trusted farms. Our \"Farm to Bakery\" approach ensures that every treat is made with the purest, most wh', '<p>At Saffron Sweets &amp; Bakery, we are committed to delivering the freshest and highest quality baked goods by sourcing the finest ingredients directly from trusted farms. Our \"Farm to Bakery\" approach ensures that every treat is made with the purest, most wholesome ingredients, supporting local farmers and communities.</p>\r\n<p>From farm-fresh fruits to premium grains, we handpick the best to create our signature sweets and bakery delights. This commitment to quality, transparency, and sustainability is why our customers trust us for their special moments and daily indulgences. Taste the difference in every bite and experience why Saffron Sweets &amp; Bakery has earned its reputation as the go-to bakery for quality and trust.</p>', 1, 1, '1', '', 'Example', 1, 'blog-images/2/FlDKOE6HYnkAzO88DexaubP2JO7UoBUu3FxSkz9b.webp', 'en', 1, 1, 'Indulge in Sweet Luxury | Saffron Sweets & Bakery – Premium Desserts for Every Occasion', 'Discover the luxury of handcrafted desserts at Saffron Sweets & Bakery. Made with the finest ingredients, our sweets are perfect for any occasion. Indulge in the finest cakes, pastries, and traditional Indian sweets – taste the difference today!', 'luxury desserts, premium sweets, decadent cakes, bakery treats, gourmet sweets, traditional Indian sweets, special occasion desserts, Saffron Sweets & Bakery, handmade desserts, indulgent cakes', '2026-01-07 00:00:00', '2026-01-07 11:00:34', '2026-01-07 17:21:16', NULL),
(3, 'Why Our Desserts are a Must-Try', 'why-our-desserts-are-a-must-try', 'At Saffron Sweets & Bakery, we don’t just bake desserts; we create edible masterpieces that elevate your dining experience. Using only the finest ingredients, our bakery offers a delicious range of sweets – from decadent cakes and pastries to traditional ', '<p>At<strong> Saffron Sweets &amp; Bakery</strong>, we don&rsquo;t just bake desserts; we create edible masterpieces that elevate your dining experience. Using only the finest ingredients, our bakery offers a delicious range of sweets &ndash; from decadent cakes and pastries to traditional Indian treats. Each bite is crafted with care, offering a luxurious taste and texture that delights your senses. Whether you&rsquo;re celebrating a special occasion or treating yourself to something sweet, our desserts will make any moment unforgettable.</p>', 1, 1, '1', '', 'Example', 1, 'blog-images/3/ZsYlQKCAUwE0Db4l6KF5Y6mSQWzIyeXFkvASiR0z.webp', 'en', 1, 1, 'Indulge in Sweet Luxury | Saffron Sweets & Bakery – Premium Desserts for Every Occasion', 'Discover the luxury of handcrafted desserts at Saffron Sweets & Bakery. Made with the finest ingredients, our sweets are perfect for any occasion. Indulge in the finest cakes, pastries, and traditional Indian sweets – taste the difference today!', 'luxury desserts, premium sweets, decadent cakes, bakery treats, gourmet sweets, traditional Indian sweets, special occasion desserts, Saffron Sweets & Bakery, handmade desserts, indulgent cakes', '2026-01-07 00:00:00', '2026-01-07 11:10:18', '2026-01-07 11:10:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT '0',
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `description`, `image`, `status`, `parent_id`, `locale`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Farm to Bakery: Why People Trust Us', 'farm-to-bakery-why-people-trust-us', '<p>At Saffron Sweets &amp; Bakery, we are committed to delivering the freshest and highest quality baked goods by sourcing the finest ingredients directly from trusted farms. Our \"Farm to Bakery\" approach ensures that every treat is made with the purest, most wholesome ingredients, supporting local farmers and communities.</p>', '', 1, 0, 'en', 'Farm to Bakery: Why People Trust Saffron Sweets & Bakery | Fresh, Quality Ingredients', 'Discover why people trust Saffron Sweets & Bakery. Our \"Farm to Bakery\" approach ensures only the freshest, high-quality ingredients sourced directly from trusted local farms. Taste the difference in every dessert and experience our commitment to quality ', 'Farm to bakery, fresh ingredients, quality desserts, bakery trust, local farmers, premium bakery goods, sustainable baking, trusted bakery, Saffron Sweets & Bakery, farm-fresh sweets', '2026-01-07 09:51:25', '2026-01-07 09:55:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author` bigint(20) UNSIGNED NOT NULL,
  `post` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `order_item_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `qty` int(11) DEFAULT '0',
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `booking_product_event_ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_products`
--

CREATE TABLE `booking_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) DEFAULT '0',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_location` tinyint(1) NOT NULL DEFAULT '0',
  `available_every_week` tinyint(1) DEFAULT NULL,
  `available_from` datetime DEFAULT NULL,
  `available_to` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_product_appointment_slots`
--

CREATE TABLE `booking_product_appointment_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_product_id` int(10) UNSIGNED NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `break_time` int(11) DEFAULT NULL,
  `same_slot_all_days` tinyint(1) DEFAULT NULL,
  `slots` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_product_default_slots`
--

CREATE TABLE `booking_product_default_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_product_id` int(10) UNSIGNED NOT NULL,
  `booking_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `break_time` int(11) DEFAULT NULL,
  `slots` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_product_event_tickets`
--

CREATE TABLE `booking_product_event_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_product_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(12,4) DEFAULT '0.0000',
  `qty` int(11) DEFAULT '0',
  `special_price` decimal(12,4) DEFAULT NULL,
  `special_price_from` datetime DEFAULT NULL,
  `special_price_to` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_product_event_ticket_translations`
--

CREATE TABLE `booking_product_event_ticket_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_product_event_ticket_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_product_rental_slots`
--

CREATE TABLE `booking_product_rental_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_product_id` int(10) UNSIGNED NOT NULL,
  `renting_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_price` decimal(12,4) DEFAULT '0.0000',
  `hourly_price` decimal(12,4) DEFAULT '0.0000',
  `same_slot_all_days` tinyint(1) DEFAULT NULL,
  `slots` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_product_table_slots`
--

CREATE TABLE `booking_product_table_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_product_id` int(10) UNSIGNED NOT NULL,
  `price_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_limit` int(11) NOT NULL DEFAULT '0',
  `duration` int(11) NOT NULL,
  `break_time` int(11) NOT NULL,
  `prevent_scheduling_before` int(11) NOT NULL,
  `same_slot_all_days` tinyint(1) DEFAULT NULL,
  `slots` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_gift` tinyint(1) NOT NULL DEFAULT '0',
  `items_count` int(11) DEFAULT NULL,
  `items_qty` decimal(12,4) DEFAULT NULL,
  `exchange_rate` decimal(12,4) DEFAULT NULL,
  `global_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` decimal(12,4) DEFAULT '0.0000',
  `base_grand_total` decimal(12,4) DEFAULT '0.0000',
  `sub_total` decimal(12,4) DEFAULT '0.0000',
  `base_sub_total` decimal(12,4) DEFAULT '0.0000',
  `tax_total` decimal(12,4) DEFAULT '0.0000',
  `base_tax_total` decimal(12,4) DEFAULT '0.0000',
  `discount_amount` decimal(12,4) DEFAULT '0.0000',
  `base_discount_amount` decimal(12,4) DEFAULT '0.0000',
  `shipping_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_shipping_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `shipping_amount_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_shipping_amount_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `sub_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_sub_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `checkout_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_guest` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `applied_cart_rule_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customer_email`, `customer_first_name`, `customer_last_name`, `shipping_method`, `coupon_code`, `is_gift`, `items_count`, `items_qty`, `exchange_rate`, `global_currency_code`, `base_currency_code`, `channel_currency_code`, `cart_currency_code`, `grand_total`, `base_grand_total`, `sub_total`, `base_sub_total`, `tax_total`, `base_tax_total`, `discount_amount`, `base_discount_amount`, `shipping_amount`, `base_shipping_amount`, `shipping_amount_incl_tax`, `base_shipping_amount_incl_tax`, `sub_total_incl_tax`, `base_sub_total_incl_tax`, `checkout_method`, `is_guest`, `is_active`, `applied_cart_rule_ids`, `customer_id`, `channel_id`, `created_at`, `updated_at`) VALUES
(1, 'ashrafulinstasure@gmail.com', 'Giselle', 'Raymond', 'free_free', NULL, 0, 1, 2.0000, NULL, 'USD', 'USD', 'USD', 'USD', 240.0000, 240.0000, 240.0000, 240.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 240.0000, 240.0000, NULL, 1, 0, NULL, NULL, 1, '2026-01-05 15:48:01', '2026-01-05 17:12:00'),
(2, 'ashrafulinstasure@gmail.com', 'Md.Asharful', 'Momen', 'free_free', NULL, 0, 1, 1.0000, NULL, 'USD', 'USD', 'USD', 'USD', 120.0000, 120.0000, 120.0000, 120.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 120.0000, 120.0000, NULL, 0, 0, NULL, 6, 1, '2026-01-05 15:59:24', '2026-01-05 17:22:52'),
(3, 'ashrafulinstasure@gmail.com', 'Md.Asharful', 'Momen', NULL, NULL, 0, 1, 1.0000, NULL, 'USD', 'USD', 'BDT', 'BDT', 435.0000, 435.0000, 435.0000, 435.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 435.0000, 435.0000, NULL, 0, 1, NULL, 6, 1, '2026-01-08 13:31:17', '2026-01-08 15:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `total_weight` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_total_weight` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `price` decimal(12,4) NOT NULL DEFAULT '1.0000',
  `base_price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `custom_price` decimal(12,4) DEFAULT NULL,
  `total` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_total` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `tax_percent` decimal(12,4) DEFAULT '0.0000',
  `tax_amount` decimal(12,4) DEFAULT '0.0000',
  `base_tax_amount` decimal(12,4) DEFAULT '0.0000',
  `discount_percent` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `discount_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_discount_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `applied_tax_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `cart_id` int(10) UNSIGNED NOT NULL,
  `tax_category_id` int(10) UNSIGNED DEFAULT NULL,
  `applied_cart_rule_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `quantity`, `sku`, `type`, `name`, `coupon_code`, `weight`, `total_weight`, `base_total_weight`, `price`, `base_price`, `custom_price`, `total`, `base_total`, `tax_percent`, `tax_amount`, `base_tax_amount`, `discount_percent`, `discount_amount`, `base_discount_amount`, `price_incl_tax`, `base_price_incl_tax`, `total_incl_tax`, `base_total_incl_tax`, `applied_tax_rate`, `parent_id`, `product_id`, `cart_id`, `tax_category_id`, `applied_cart_rule_ids`, `additional`, `created_at`, `updated_at`) VALUES
(1, 2, '101', 'simple', '', NULL, 1.0000, 2.0000, 2.0000, 120.0000, 120.0000, NULL, 240.0000, 240.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 120.0000, 120.0000, 240.0000, 240.0000, NULL, NULL, 2, 1, NULL, NULL, '{\"cart_id\": 1, \"quantity\": 2, \"is_buy_now\": \"0\", \"product_id\": \"2\"}', '2026-01-05 15:48:01', '2026-01-05 16:59:51'),
(2, 1, '101', 'simple', '', NULL, 1.0000, 1.0000, 1.0000, 120.0000, 120.0000, NULL, 120.0000, 120.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 120.0000, 120.0000, 120.0000, 120.0000, NULL, NULL, 2, 2, NULL, NULL, '{\"cart_id\": 2, \"quantity\": 1, \"is_buy_now\": \"0\", \"product_id\": \"2\"}', '2026-01-05 15:59:24', '2026-01-05 15:59:24'),
(3, 1, '109', 'simple', 'Breads & Buns', NULL, 0.7500, 0.7500, 0.7500, 435.0000, 435.0000, NULL, 435.0000, 435.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 435.0000, 435.0000, 435.0000, 435.0000, NULL, NULL, 20, 3, NULL, NULL, '{\"cart_id\": 3, \"quantity\": 1, \"is_buy_now\": \"0\", \"product_id\": \"20\"}', '2026-01-08 13:31:17', '2026-01-08 13:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item_inventories`
--

CREATE TABLE `cart_item_inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `inventory_source_id` int(10) UNSIGNED DEFAULT NULL,
  `cart_item_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_payment`
--

CREATE TABLE `cart_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_payment`
--

INSERT INTO `cart_payment` (`id`, `method`, `method_title`, `cart_id`, `created_at`, `updated_at`) VALUES
(1, 'cashondelivery', 'Cash On Delivery', 1, '2026-01-05 17:11:54', '2026-01-05 17:11:54'),
(2, 'cashondelivery', 'Cash On Delivery', 2, '2026-01-05 17:22:36', '2026-01-05 17:22:36');

-- --------------------------------------------------------

--
-- Table structure for table `cart_rules`
--

CREATE TABLE `cart_rules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starts_from` datetime DEFAULT NULL,
  `ends_till` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `coupon_type` int(11) NOT NULL DEFAULT '1',
  `use_auto_generation` tinyint(1) NOT NULL DEFAULT '0',
  `usage_per_customer` int(11) NOT NULL DEFAULT '0',
  `uses_per_coupon` int(11) NOT NULL DEFAULT '0',
  `times_used` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `condition_type` tinyint(1) NOT NULL DEFAULT '1',
  `conditions` json DEFAULT NULL,
  `end_other_rules` tinyint(1) NOT NULL DEFAULT '0',
  `uses_attribute_conditions` tinyint(1) NOT NULL DEFAULT '0',
  `action_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `discount_quantity` int(11) NOT NULL DEFAULT '1',
  `discount_step` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `apply_to_shipping` tinyint(1) NOT NULL DEFAULT '0',
  `free_shipping` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_rule_channels`
--

CREATE TABLE `cart_rule_channels` (
  `cart_rule_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_rule_coupons`
--

CREATE TABLE `cart_rule_coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usage_limit` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `usage_per_customer` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `times_used` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `type` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `expired_at` date DEFAULT NULL,
  `cart_rule_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_rule_coupon_usage`
--

CREATE TABLE `cart_rule_coupon_usage` (
  `id` int(10) UNSIGNED NOT NULL,
  `times_used` int(11) NOT NULL DEFAULT '0',
  `cart_rule_coupon_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_rule_customers`
--

CREATE TABLE `cart_rule_customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `times_used` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `customer_id` int(10) UNSIGNED NOT NULL,
  `cart_rule_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_rule_customer_groups`
--

CREATE TABLE `cart_rule_customer_groups` (
  `cart_rule_id` int(10) UNSIGNED NOT NULL,
  `customer_group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_rule_translations`
--

CREATE TABLE `cart_rule_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` text COLLATE utf8mb4_unicode_ci,
  `cart_rule_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_shipping_rates`
--

CREATE TABLE `cart_shipping_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `carrier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrier_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT '0',
  `base_price` double DEFAULT '0',
  `discount_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_discount_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `tax_percent` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `tax_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_tax_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `applied_tax_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_calculate_tax` tinyint(1) NOT NULL DEFAULT '1',
  `cart_address_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cart_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_shipping_rates`
--

INSERT INTO `cart_shipping_rates` (`id`, `carrier`, `carrier_title`, `method`, `method_title`, `method_description`, `price`, `base_price`, `discount_amount`, `base_discount_amount`, `tax_percent`, `tax_amount`, `base_tax_amount`, `price_incl_tax`, `base_price_incl_tax`, `applied_tax_rate`, `is_calculate_tax`, `cart_address_id`, `created_at`, `updated_at`, `cart_id`) VALUES
(3, 'flatrate', 'Flat Rate', 'flatrate_flatrate', 'Flat Rate', 'Flat Rate Shipping', 20, 20, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 20.0000, 20.0000, NULL, 1, 2, '2026-01-05 17:11:51', '2026-01-05 17:11:51', 1),
(4, 'free', 'Free Shipping', 'free_free', 'Free Shipping', 'Free Shipping', 0, 0, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, 1, 2, '2026-01-05 17:11:51', '2026-01-05 17:11:51', 1),
(7, 'flatrate', 'Flat Rate', 'flatrate_flatrate', 'Flat Rate', 'Flat Rate Shipping', 10, 10, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 10.0000, 10.0000, NULL, 1, 7, '2026-01-05 17:22:35', '2026-01-05 17:22:35', 2),
(8, 'free', 'Free Shipping', 'free_free', 'Free Shipping', 'Free Shipping', 0, 0, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, 1, 7, '2026-01-05 17:22:35', '2026-01-05 17:22:35', 2);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_rules`
--

CREATE TABLE `catalog_rules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starts_from` date DEFAULT NULL,
  `ends_till` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `condition_type` tinyint(1) NOT NULL DEFAULT '1',
  `conditions` json DEFAULT NULL,
  `end_other_rules` tinyint(1) NOT NULL DEFAULT '0',
  `action_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_rule_channels`
--

CREATE TABLE `catalog_rule_channels` (
  `catalog_rule_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_rule_customer_groups`
--

CREATE TABLE `catalog_rule_customer_groups` (
  `catalog_rule_id` int(10) UNSIGNED NOT NULL,
  `customer_group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_rule_products`
--

CREATE TABLE `catalog_rule_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `starts_from` datetime DEFAULT NULL,
  `ends_till` datetime DEFAULT NULL,
  `end_other_rules` tinyint(1) NOT NULL DEFAULT '0',
  `action_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_group_id` int(10) UNSIGNED NOT NULL,
  `catalog_rule_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_rule_product_prices`
--

CREATE TABLE `catalog_rule_product_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `rule_date` date NOT NULL,
  `starts_from` datetime DEFAULT NULL,
  `ends_till` datetime DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_group_id` int(10) UNSIGNED NOT NULL,
  `catalog_rule_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `logo_path` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `display_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'products_and_description',
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `additional` json DEFAULT NULL,
  `banner_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `position`, `logo_path`, `status`, `display_mode`, `_lft`, `_rgt`, `parent_id`, `additional`, `banner_path`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, 0, 'products_and_description', 1, 26, NULL, NULL, NULL, '2026-01-05 15:37:26', '2026-01-08 13:09:41'),
(12, 2, 'category/12/kr1UuCqdi9L77vAWqzjC9S5PCDc6FPT0kzZzbTI1.webp', 1, 'products_and_description', 7, 8, 21, NULL, NULL, '2026-01-05 16:37:07', '2026-01-08 13:09:41'),
(13, 3, 'category/13/9ysV4KQPysqwCRytYbTDUesx2nBp0v2IGaFTG2tf.webp', 1, 'products_and_description', 9, 10, 21, NULL, NULL, '2026-01-06 11:28:53', '2026-01-08 13:09:41'),
(14, 4, 'category/14/vng318ZTxSoDSRuU1cOo0vIYsb4gVsnpWKxn3lmR.webp', 1, 'products_and_description', 11, 12, 21, NULL, NULL, '2026-01-06 11:31:33', '2026-01-08 13:09:41'),
(15, 5, 'category/15/jlt3dhtNiQfkSwT1HAbDXTbY3VfF6wF5mGgRHnB0.webp', 1, 'products_and_description', 13, 14, 21, NULL, NULL, '2026-01-06 11:39:37', '2026-01-08 13:10:22'),
(16, 6, 'category/16/Ril6hFtJ1I3tDwFu4OQpPyrHJ0WHP3MjSyHlovgR.webp', 1, 'products_and_description', 15, 16, 21, NULL, NULL, '2026-01-06 11:41:59', '2026-01-08 13:10:33'),
(17, 7, 'category/17/J3tVdsey4XxcGTnLZ0PO17TP0894Etff62CqJG7G.webp', 1, 'products_and_description', 17, 18, 21, NULL, NULL, '2026-01-06 11:44:00', '2026-01-08 13:10:45'),
(18, 8, 'category/18/YBKnZ9tBNabIbIj30WOWOh2bh9WjsZWhGmj4d35H.webp', 1, 'products_and_description', 19, 20, 21, NULL, NULL, '2026-01-06 11:45:54', '2026-01-08 13:11:11'),
(19, 9, 'category/19/GOdbcbxsuzlQDMHr4scqZNHMIqJlCWpV5YXlRvhW.webp', 1, 'products_and_description', 21, 22, 21, NULL, NULL, '2026-01-06 11:49:23', '2026-01-08 13:11:26'),
(20, 10, 'category/20/FrZboHaYLoP9SXS5UsezNi1n4LtIP27P6MTAqEim.webp', 1, 'products_and_description', 23, 24, 21, NULL, NULL, '2026-01-06 11:58:35', '2026-01-08 13:11:40'),
(21, 1, 'category/21/KpeQsGQQjCDMLAsHphmlhGNH6rEnkmtz02Xkzu4x.webp', 1, 'products_and_description', 6, 25, 1, NULL, NULL, '2026-01-08 12:43:42', '2026-01-08 13:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `category_filterable_attributes`
--

CREATE TABLE `category_filterable_attributes` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_filterable_attributes`
--

INSERT INTO `category_filterable_attributes` (`category_id`, `attribute_id`) VALUES
(2, 11),
(2, 23),
(2, 24),
(2, 25),
(1, 11),
(1, 23),
(1, 24),
(3, 11),
(3, 23),
(3, 24),
(3, 25),
(4, 11),
(4, 23),
(4, 24),
(4, 25),
(5, 11),
(5, 23),
(5, 24),
(5, 25),
(6, 11),
(6, 23),
(6, 24),
(6, 25),
(12, 11),
(12, 23),
(12, 24),
(13, 11),
(13, 23),
(13, 24),
(14, 11),
(14, 23),
(14, 24),
(15, 11),
(15, 23),
(15, 24),
(16, 11),
(16, 23),
(16, 24),
(17, 11),
(17, 23),
(17, 24),
(18, 11),
(18, 23),
(18, 24),
(19, 11),
(19, 23),
(19, 24),
(20, 11),
(20, 23),
(20, 24),
(21, 11),
(21, 23),
(21, 24);

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_path` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `locale_id` int(10) UNSIGNED DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `name`, `slug`, `url_path`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `locale_id`, `locale`) VALUES
(12, 1, 'Root', 'root', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A delightful pound cake customizable to your hearts desire! Indulge in the rich, buttery goodness of our moist cake, perfectly paired with your personalized design.</span></p>', 'Delicious Celebration Cakes for Every Occasion | Perfect for Parties & Events', 'Discover a wide range of stunning celebration cakes, perfect for any special occasion. From decadent chocolate drip cakes to vibrant rainbow layers, our cakes are designed to bring joy to your party. Customizable decorations and flavors ensure your event is truly memorable. Perfect for birthdays, weddings, and all celebrations!', 'celebration cakes, party cakes, birthday cakes, wedding cakes, custom cakes, themed cakes, chocolate cakes, fruit cakes, cake decorations, celebration desserts', NULL, 'en'),
(13, 12, 'Sweets', 'sweetsmilk', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A delightful pound cake customizable to your hearts desire! Indulge in the rich, buttery goodness of our moist cake, perfectly paired with your personalized design.</span></p>', 'sweets', 'Discover fresh, delicious sweets made with premium ingredients. Order traditional and modern sweets online for festivals and everyday treats.', 'sweets, traditional sweets, indian sweets, bengali sweets, dessert sweets, milk sweets, dry sweets, sugar sweets, festival sweets, sweet shop online, buy sweets online, homemade sweets, premium sweets, fresh sweets, mithai', 1, 'en'),
(14, 12, 'Sweets', 'sweetsmilk', '', '<p>Sweets description</p>', 'sweets', '', '', 3, 'bn'),
(15, 13, 'Pastry', 'pastry', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A bite-sized delight thats simply irresistible! Our pastries are crafted with the finest ingredients and expertly baked to perfection, resulting in a flaky, buttery pastry ....</span></p>', 'Indulge in Fresh & Delicious Pastries | Perfect for Every Occasion', 'Explore our delightful selection of fresh pastries, perfect for any event or sweet craving. From buttery croissants to colorful fruit tarts and decadent puff pastries, our treats offer a rich, indulgent experience. Perfect for breakfast, afternoon tea, or any special occasion. Try our selection of premium pastries for a taste of luxury!', 'fresh pastries, gourmet pastries, sweet pastries, croissants, tarts, puff pastries, fruit pastries, pastry shop, bakery pastries, pastry desserts', 1, 'en'),
(16, 13, 'Pastry', 'pastry', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A bite-sized delight thats simply irresistible! Our pastries are crafted with the finest ingredients and expertly baked to perfection, resulting in a flaky, buttery pastry ....</span></p>', 'Indulge in Fresh & Delicious Pastries | Perfect for Every Occasion', 'Explore our delightful selection of fresh pastries, perfect for any event or sweet craving. From buttery croissants to colorful fruit tarts and decadent puff pastries, our treats offer a rich, indulgent experience. Perfect for breakfast, afternoon tea, or any special occasion. Try our selection of premium pastries for a taste of luxury!', 'fresh pastries, gourmet pastries, sweet pastries, croissants, tarts, puff pastries, fruit pastries, pastry shop, bakery pastries, pastry desserts', 3, 'bn'),
(17, 14, 'Muffins', 'muffins', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A delicious treat thats perfect for any moment! Our muffins are baked with love and mouth-watering flavor, offering a moist and fluffy texture thats sure to satisfy your cravings.</span></p>', 'Fresh & Flavorful Muffins | Perfect for Breakfast & Snacks', 'Savor the taste of freshly baked muffins, perfect for breakfast, snacks, or dessert. From classic blueberry and chocolate chip muffins to hearty banana nut varieties, our muffins are baked to perfection. Whether you enjoy them warm or on-the-go, our selection offers a delicious treat for every taste!', 'muffins, fresh muffins, blueberry muffins, chocolate muffins, banana nut muffins, muffins for breakfast, homemade muffins, bakery muffins, healthy muffins, muffin recipes', 1, 'en'),
(18, 14, 'Muffins', 'muffins', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A delicious treat thats perfect for any moment! Our muffins are baked with love and mouth-watering flavor, offering a moist and fluffy texture thats sure to satisfy your cravings.</span></p>', 'Fresh & Flavorful Muffins | Perfect for Breakfast & Snacks', 'Savor the taste of freshly baked muffins, perfect for breakfast, snacks, or dessert. From classic blueberry and chocolate chip muffins to hearty banana nut varieties, our muffins are baked to perfection. Whether you enjoy them warm or on-the-go, our selection offers a delicious treat for every taste!', 'muffins, fresh muffins, blueberry muffins, chocolate muffins, banana nut muffins, muffins for breakfast, homemade muffins, bakery muffins, healthy muffins, muffin recipes', 3, 'bn'),
(19, 15, 'Cookies', 'cookies', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A bite-sized delight thats impossible to resist! Offering a crispy exterior and a soft, chewy center bursting with flavor. From classic chocolate chip to indulgent double chocolate, ....</span></p>', 'Delicious Freshly Baked Cookies | A Treat for Every Occasion', 'Indulge in our freshly baked cookies, a perfect treat for any occasion. From classic chocolate chip and peanut butter to soft oatmeal raisin and sugar cookies, our selection offers something for every cookie lover. Whether you\'re craving a sweet snack or preparing for a celebration, our cookies are sure to delight!', 'cookies, freshly baked cookies, chocolate chip cookies, peanut butter cookies, oatmeal raisin cookies, sugar cookies, homemade cookies, cookie recipes, bakery cookies, soft cookies', 1, 'en'),
(20, 15, 'Cookies', 'cookies', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A bite-sized delight thats impossible to resist! Offering a crispy exterior and a soft, chewy center bursting with flavor. From classic chocolate chip to indulgent double chocolate, ....</span></p>', 'Delicious Freshly Baked Cookies | A Treat for Every Occasion', 'Indulge in our freshly baked cookies, a perfect treat for any occasion. From classic chocolate chip and peanut butter to soft oatmeal raisin and sugar cookies, our selection offers something for every cookie lover. Whether you\'re craving a sweet snack or preparing for a celebration, our cookies are sure to delight!', 'cookies, freshly baked cookies, chocolate chip cookies, peanut butter cookies, oatmeal raisin cookies, sugar cookies, homemade cookies, cookie recipes, bakery cookies, soft cookies', 3, 'bn'),
(21, 16, 'Doughnut', 'doughnut', '', '<p>Treat yourself to our mouth-watering fresh doughnuts, available in a variety of flavors and toppings. From classic glazed and chocolate-covered doughnuts to those with colorful sprinkles and delicious fillings, our doughnuts make the perfect snack for any occasion. Sweeten your day with our irresistible doughnut selection!</p>', 'Delicious Fresh Doughnuts | Sweet Treats for Every Occasion', 'Treat yourself to our mouth-watering fresh doughnuts, available in a variety of flavors and toppings. From classic glazed and chocolate-covered doughnuts to those with colorful sprinkles and delicious fillings, our doughnuts make the perfect snack for any occasion. Sweeten your day with our irresistible doughnut selection!', 'doughnuts, fresh doughnuts, glazed doughnuts, chocolate doughnuts, sprinkles doughnuts, filled doughnuts, doughnut recipes, bakery doughnuts, sweet doughnuts, doughnut varieties', 1, 'en'),
(22, 16, 'Doughnut', 'doughnut', '', '<p>Treat yourself to our mouth-watering fresh doughnuts, available in a variety of flavors and toppings. From classic glazed and chocolate-covered doughnuts to those with colorful sprinkles and delicious fillings, our doughnuts make the perfect snack for any occasion. Sweeten your day with our irresistible doughnut selection!</p>', 'Delicious Fresh Doughnuts | Sweet Treats for Every Occasion', 'Treat yourself to our mouth-watering fresh doughnuts, available in a variety of flavors and toppings. From classic glazed and chocolate-covered doughnuts to those with colorful sprinkles and delicious fillings, our doughnuts make the perfect snack for any occasion. Sweeten your day with our irresistible doughnut selection!', 'doughnuts, fresh doughnuts, glazed doughnuts, chocolate doughnuts, sprinkles doughnuts, filled doughnuts, doughnut recipes, bakery doughnuts, sweet doughnuts, doughnut varieties', 3, 'bn'),
(23, 17, 'Breads', 'breads', '', '<p>Discover our wide range of freshly baked breads and buns, perfect for any meal or occasion. From soft hamburger buns and golden challah to artisan breads like baguettes and seeded loaves, each bite offers a delightful experience. Whether you\'re preparing a sandwich or enjoying with butter, our breads and buns are a must-have for every table.</p>', 'Freshly Baked Breads & Buns | Perfect for Every Meal', 'Discover our wide range of freshly baked breads and buns, perfect for any meal or occasion. From soft hamburger buns and golden challah to artisan breads like baguettes and seeded loaves, each bite offers a delightful experience. Whether you\'re preparing a sandwich or enjoying with butter, our breads and buns are a must-have for every table.', 'fresh breads, artisan bread, hamburger buns, challah bread, croissants, baguette, soft rolls, bakery buns, homemade bread, seeded bread', 1, 'en'),
(24, 17, 'Breads & Buns', 'breads-buns', '', '<p>Discover our wide range of freshly baked breads and buns, perfect for any meal or occasion. From soft hamburger buns and golden challah to artisan breads like baguettes and seeded loaves, each bite offers a delightful experience. Whether you\'re preparing a sandwich or enjoying with butter, our breads and buns are a must-have for every table.</p>', 'Freshly Baked Breads & Buns | Perfect for Every Meal', 'Discover our wide range of freshly baked breads and buns, perfect for any meal or occasion. From soft hamburger buns and golden challah to artisan breads like baguettes and seeded loaves, each bite offers a delightful experience. Whether you\'re preparing a sandwich or enjoying with butter, our breads and buns are a must-have for every table.', 'fresh breads, artisan bread, hamburger buns, challah bread, croissants, baguette, soft rolls, bakery buns, homemade bread, seeded bread', 3, 'bn'),
(25, 18, 'Tarts', 'tarts', '', '<p>Indulge in our exquisite selection of freshly baked tarts and pies, perfect for any occasion. From fruity tarts and rich chocolate delights to classic pies like apple and pecan, our tarts and pies are crafted with the finest ingredients. Whether you\'re hosting a party or enjoying a quiet dessert, these pastries are sure to impress!</p>', 'Delicious Tarts & Pies | Freshly Baked Pastries for Every Occasion', 'Indulge in our exquisite selection of freshly baked tarts and pies, perfect for any occasion. From fruity tarts and rich chocolate delights to classic pies like apple and pecan, our tarts and pies are crafted with the finest ingredients. Whether you\'re hosting a party or enjoying a quiet dessert, these pastries are sure to impress!', 'tarts, pies, fruit tarts, lemon meringue pie, chocolate tarts, apple pie, blueberry pie, mixed berry tarts, pecan pie, homemade pies, bakery tarts', 1, 'en'),
(26, 18, 'Tarts & Pie', 'tarts-pie', '', '<p>Indulge in our exquisite selection of freshly baked tarts and pies, perfect for any occasion. From fruity tarts and rich chocolate delights to classic pies like apple and pecan, our tarts and pies are crafted with the finest ingredients. Whether you\'re hosting a party or enjoying a quiet dessert, these pastries are sure to impress!</p>', 'Delicious Tarts & Pies | Freshly Baked Pastries for Every Occasion', 'Indulge in our exquisite selection of freshly baked tarts and pies, perfect for any occasion. From fruity tarts and rich chocolate delights to classic pies like apple and pecan, our tarts and pies are crafted with the finest ingredients. Whether you\'re hosting a party or enjoying a quiet dessert, these pastries are sure to impress!', 'tarts, pies, fruit tarts, lemon meringue pie, chocolate tarts, apple pie, blueberry pie, mixed berry tarts, pecan pie, homemade pies, bakery tarts', 3, 'bn'),
(27, 19, 'Chocolate', 'chocolate', '', '<p>Satisfy your sweet tooth with our premium selection of chocolates and sweets. From rich milk and dark chocolates to decadent pralines and candies, our collection offers a treat for every chocolate lover. Perfect for gifting or indulging yourself, our chocolates are crafted to deliver the ultimate sweet experience!</p>', 'Indulge in Premium Chocolate & Sweets | A Delight for Every Taste', 'Satisfy your sweet tooth with our premium selection of chocolates and sweets. From rich milk and dark chocolates to decadent pralines and candies, our collection offers a treat for every chocolate lover. Perfect for gifting or indulging yourself, our chocolates are crafted to deliver the ultimate sweet experience!', 'chocolates, premium chocolates, milk chocolate, dark chocolate, white chocolate, pralines, candies, chocolate treats, gourmet sweets, chocolate bars', 1, 'en'),
(28, 19, 'Chocolate', 'chocolate', '', '<p>Satisfy your sweet tooth with our premium selection of chocolates and sweets. From rich milk and dark chocolates to decadent pralines and candies, our collection offers a treat for every chocolate lover. Perfect for gifting or indulging yourself, our chocolates are crafted to deliver the ultimate sweet experience!</p>', 'Indulge in Premium Chocolate & Sweets | A Delight for Every Taste', 'Satisfy your sweet tooth with our premium selection of chocolates and sweets. From rich milk and dark chocolates to decadent pralines and candies, our collection offers a treat for every chocolate lover. Perfect for gifting or indulging yourself, our chocolates are crafted to deliver the ultimate sweet experience!', 'chocolates, premium chocolates, milk chocolate, dark chocolate, white chocolate, pralines, candies, chocolate treats, gourmet sweets, chocolate bars', 3, 'bn'),
(29, 20, 'Cake', 'cake', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A delightful pound cake customizable to your hearts desire! Indulge in the rich, buttery goodness of our moist cake, perfectly paired with your personalized design.</span></p>', 'Delicious Celebration Cakes for Every Occasion | Perfect for Parties & Events', 'Discover a wide range of stunning celebration cakes, perfect for any special occasion. From decadent chocolate drip cakes to vibrant rainbow layers, our cakes are designed to bring joy to your party. Customizable decorations and flavors ensure your event is truly memorable. Perfect for birthdays, weddings, and all celebrations!', 'celebration cakes, party cakes, birthday cakes, wedding cakes, custom cakes, themed cakes, chocolate cakes, fruit cakes, cake decorations, celebration desserts', 1, 'en'),
(30, 20, 'Cake', 'cake', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A delightful pound cake customizable to your hearts desire! Indulge in the rich, buttery goodness of our moist cake, perfectly paired with your personalized design.</span></p>', 'Delicious Celebration Cakes for Every Occasion | Perfect for Parties & Events', 'Discover a wide range of stunning celebration cakes, perfect for any special occasion. From decadent chocolate drip cakes to vibrant rainbow layers, our cakes are designed to bring joy to your party. Customizable decorations and flavors ensure your event is truly memorable. Perfect for birthdays, weddings, and all celebrations!', 'celebration cakes, party cakes, birthday cakes, wedding cakes, custom cakes, themed cakes, chocolate cakes, fruit cakes, cake decorations, celebration desserts', 3, 'bn'),
(31, 21, 'Menu', 'menu', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A delightful pound cake customizable to your hearts desire! Indulge in the rich, buttery goodness of our moist cake, perfectly paired with your personalized design.</span></p>', 'Delicious Celebration Cakes for Every Occasion | Perfect for Parties & Events', 'Discover a wide range of stunning celebration cakes, perfect for any special occasion. From decadent chocolate drip cakes to vibrant rainbow layers, our cakes are designed to bring joy to your party. Customizable decorations and flavors ensure your event is truly memorable. Perfect for birthdays, weddings, and all celebrations!', 'celebration cakes, party cakes, birthday cakes, wedding cakes, custom cakes, themed cakes, chocolate cakes, fruit cakes, cake decorations, celebration desserts', 1, 'en'),
(32, 21, 'Menu', 'menu', '', '<p><span style=\"color: rgb(85, 85, 85); font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">A delightful pound cake customizable to your hearts desire! Indulge in the rich, buttery goodness of our moist cake, perfectly paired with your personalized design.</span></p>', 'Delicious Celebration Cakes for Every Occasion | Perfect for Parties & Events', 'Discover a wide range of stunning celebration cakes, perfect for any special occasion. From decadent chocolate drip cakes to vibrant rainbow layers, our cakes are designed to bring joy to your party. Customizable decorations and flavors ensure your event is truly memorable. Perfect for birthdays, weddings, and all celebrations!', 'celebration cakes, party cakes, birthday cakes, wedding cakes, custom cakes, themed cakes, chocolate cakes, fruit cakes, cake decorations, celebration desserts', 3, 'bn');

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_seo` json DEFAULT NULL,
  `is_maintenance_on` tinyint(1) NOT NULL DEFAULT '0',
  `allowed_ips` text COLLATE utf8mb4_unicode_ci,
  `root_category_id` int(10) UNSIGNED DEFAULT NULL,
  `default_locale_id` int(10) UNSIGNED NOT NULL,
  `base_currency_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `code`, `timezone`, `theme`, `hostname`, `logo`, `favicon`, `home_seo`, `is_maintenance_on`, `allowed_ips`, `root_category_id`, `default_locale_id`, `base_currency_id`, `created_at`, `updated_at`) VALUES
(1, 'default', NULL, 'default', 'http://localhost:8000', NULL, NULL, NULL, 0, '', 1, 1, 3, '2026-01-05 15:37:26', '2026-01-07 16:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `channel_currencies`
--

CREATE TABLE `channel_currencies` (
  `channel_id` int(10) UNSIGNED NOT NULL,
  `currency_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channel_currencies`
--

INSERT INTO `channel_currencies` (`channel_id`, `currency_id`) VALUES
(1, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `channel_inventory_sources`
--

CREATE TABLE `channel_inventory_sources` (
  `channel_id` int(10) UNSIGNED NOT NULL,
  `inventory_source_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channel_inventory_sources`
--

INSERT INTO `channel_inventory_sources` (`channel_id`, `inventory_source_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `channel_locales`
--

CREATE TABLE `channel_locales` (
  `channel_id` int(10) UNSIGNED NOT NULL,
  `locale_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channel_locales`
--

INSERT INTO `channel_locales` (`channel_id`, `locale_id`) VALUES
(1, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `channel_translations`
--

CREATE TABLE `channel_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `maintenance_mode_text` text COLLATE utf8mb4_unicode_ci,
  `home_seo` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channel_translations`
--

INSERT INTO `channel_translations` (`id`, `channel_id`, `locale`, `name`, `description`, `maintenance_mode_text`, `home_seo`, `created_at`, `updated_at`) VALUES
(2, 1, 'en', 'Default', '', '', '{\"meta_title\": \"Demo store\", \"meta_keywords\": \"Demo store meta keyword\", \"meta_description\": \"Demo store meta description\"}', NULL, '2026-01-07 16:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `layout` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `layout`, `created_at`, `updated_at`) VALUES
(1, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(2, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(3, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(4, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(5, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(6, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(7, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(8, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(9, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(10, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `cms_page_channels`
--

CREATE TABLE `cms_page_channels` (
  `cms_page_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_page_channels`
--

INSERT INTO `cms_page_channels` (`cms_page_id`, `channel_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_page_translations`
--

CREATE TABLE `cms_page_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `html_content` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cms_page_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_page_translations`
--

INSERT INTO `cms_page_translations` (`id`, `page_title`, `url_key`, `html_content`, `meta_title`, `meta_description`, `meta_keywords`, `locale`, `cms_page_id`) VALUES
(11, 'About Us', 'about-us', '<div class=\"static-container\"><div class=\"mb-5\">About Us Page Content</div></div>', 'about us', '', 'aboutus', 'en', 1),
(12, 'Return Policy', 'return-policy', '<div class=\"static-container\"><div class=\"mb-5\">Return Policy Page Content</div></div>', 'return policy', '', 'return, policy', 'en', 2),
(13, 'Refund Policy', 'refund-policy', '<div class=\"static-container\"><div class=\"mb-5\">Refund Policy Page Content</div></div>', 'Refund policy', '', 'refund, policy', 'en', 3),
(14, 'Terms & Conditions', 'terms-conditions', '<div class=\"static-container\"><div class=\"mb-5\">Terms & Conditions Page Content</div></div>', 'Terms & Conditions', '', 'term, conditions', 'en', 4),
(15, 'Terms of Use', 'terms-of-use', '<div class=\"static-container\"><div class=\"mb-5\">Terms of Use Page Content</div></div>', 'Terms of use', '', 'term, use', 'en', 5),
(16, 'Customer Service', 'customer-service', '<div class=\"static-container\"><div class=\"mb-5\">Customer Service Page Content</div></div>', 'Customer Service', '', 'customer, service', 'en', 6),
(17, 'What\'s New', 'whats-new', '<div class=\"static-container\"><div class=\"mb-5\">What\'s New page content</div></div>', 'What\'s New', '', 'new', 'en', 7),
(18, 'Payment Policy', 'payment-policy', '<div class=\"static-container\"><div class=\"mb-5\">Payment Policy Page Content</div></div>', 'Payment Policy', '', 'payment, policy', 'en', 8),
(19, 'Shipping Policy', 'shipping-policy', '<div class=\"static-container\"><div class=\"mb-5\">Shipping Policy Page Content</div></div>', 'Shipping Policy', '', 'shipping, policy', 'en', 9),
(20, 'Privacy Policy', 'privacy-policy', '<div class=\"static-container\"><div class=\"mb-5\">Privacy Policy Page Content</div></div>', 'Privacy Policy', '', 'privacy, policy', 'en', 10);

-- --------------------------------------------------------

--
-- Table structure for table `compare_items`
--

CREATE TABLE `compare_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `core_config`
--

CREATE TABLE `core_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `core_config`
--

INSERT INTO `core_config` (`id`, `code`, `value`, `channel_code`, `locale_code`, `created_at`, `updated_at`) VALUES
(1, 'sales.checkout.shopping_cart.allow_guest_checkout', '1', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(2, 'emails.general.notifications.emails.general.notifications.registration', '1', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(3, 'emails.general.notifications.emails.general.notifications.customer_registration_confirmation_mail_to_admin', '0', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(4, 'emails.general.notifications.emails.general.notifications.customer_account_credentials', '1', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(5, 'emails.general.notifications.emails.general.notifications.new_order', '1', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(6, 'emails.general.notifications.emails.general.notifications.new_order_mail_to_admin', '1', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(7, 'emails.general.notifications.emails.general.notifications.new_invoice', '1', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(8, 'emails.general.notifications.emails.general.notifications.new_invoice_mail_to_admin', '0', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(9, 'emails.general.notifications.emails.general.notifications.new_refund', '1', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(10, 'emails.general.notifications.emails.general.notifications.new_refund_mail_to_admin', '0', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(11, 'emails.general.notifications.emails.general.notifications.new_shipment', '1', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(12, 'emails.general.notifications.emails.general.notifications.new_shipment_mail_to_admin', '0', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(13, 'emails.general.notifications.emails.general.notifications.new_inventory_source', '1', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(14, 'emails.general.notifications.emails.general.notifications.cancel_order', '1', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(15, 'emails.general.notifications.emails.general.notifications.cancel_order_mail_to_admin', '0', NULL, NULL, '2026-01-05 15:37:26', '2026-01-05 15:37:26'),
(22, 'customer.settings.wishlist.wishlist_option', '1', NULL, NULL, '2026-01-05 15:56:15', '2026-01-05 15:56:15'),
(23, 'customer.settings.login_options.redirected_to_page', 'account', NULL, NULL, '2026-01-05 15:56:15', '2026-01-05 15:56:15'),
(24, 'customer.settings.create_new_account_options.default_group', 'general', NULL, NULL, '2026-01-05 15:56:15', '2026-01-05 15:56:15'),
(25, 'customer.settings.create_new_account_options.news_letter', '1', NULL, NULL, '2026-01-05 15:56:15', '2026-01-05 15:56:15'),
(26, 'customer.settings.newsletter.subscription', '1', NULL, NULL, '2026-01-05 15:56:15', '2026-01-05 15:56:15'),
(27, 'customer.settings.email.verification', '0', NULL, NULL, '2026-01-05 15:56:15', '2026-01-05 15:56:15'),
(28, 'customer.settings.social_login.enable_facebook', '0', 'default', NULL, '2026-01-05 15:56:15', '2026-01-05 15:56:15'),
(29, 'customer.settings.social_login.enable_twitter', '0', 'default', NULL, '2026-01-05 15:56:15', '2026-01-05 15:56:15'),
(30, 'customer.settings.social_login.enable_google', '0', 'default', NULL, '2026-01-05 15:56:15', '2026-01-05 15:56:15'),
(31, 'customer.settings.social_login.enable_linkedin-openid', '0', 'default', NULL, '2026-01-05 15:56:15', '2026-01-05 15:56:15'),
(32, 'customer.settings.social_login.enable_github', '0', 'default', NULL, '2026-01-05 15:56:15', '2026-01-05 15:56:15'),
(33, 'catalog.products.settings.compare_option', '1', NULL, NULL, '2026-01-05 15:57:47', '2026-01-05 15:57:47'),
(34, 'catalog.products.settings.image_search', '0', NULL, NULL, '2026-01-05 15:57:47', '2026-01-05 15:57:47'),
(35, 'catalog.products.search.engine', 'database', NULL, NULL, '2026-01-05 15:57:47', '2026-01-05 15:57:47'),
(36, 'catalog.products.search.admin_mode', 'database', NULL, NULL, '2026-01-05 15:57:47', '2026-01-05 15:57:47'),
(37, 'catalog.products.search.storefront_mode', 'database', NULL, NULL, '2026-01-05 15:57:47', '2026-01-05 15:57:47'),
(38, 'catalog.products.search.min_query_length', '0', NULL, NULL, '2026-01-05 15:57:47', '2026-01-05 15:57:47'),
(39, 'catalog.products.search.max_query_length', '1000', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(40, 'catalog.products.product_view_page.no_of_related_products', '', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(41, 'catalog.products.product_view_page.no_of_up_sells_products', '', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(42, 'catalog.products.cart_view_page.no_of_cross_sells_products', '', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(43, 'catalog.products.storefront.products_per_page', '', 'default', NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(44, 'catalog.products.storefront.buy_now_button_display', '0', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(45, 'catalog.products.cache_small_image.width', '', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(46, 'catalog.products.cache_small_image.height', '', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(47, 'catalog.products.cache_medium_image.width', '', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(48, 'catalog.products.cache_medium_image.height', '', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(49, 'catalog.products.cache_large_image.width', '', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(50, 'catalog.products.cache_large_image.height', '', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(51, 'catalog.products.review.guest_review', '0', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(52, 'catalog.products.review.customer_review', '1', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(53, 'catalog.products.review.censoring_reviewer_name', '1', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(54, 'catalog.products.review.summary', 'review_counts', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(55, 'catalog.products.attribute.image_attribute_upload_size', '', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(56, 'catalog.products.attribute.file_attribute_upload_size', '', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(57, 'catalog.products.social_share.enabled', '0', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(58, 'catalog.products.social_share.facebook', '0', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(59, 'catalog.products.social_share.twitter', '0', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(60, 'catalog.products.social_share.pinterest', '0', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(61, 'catalog.products.social_share.whatsapp', '0', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(62, 'catalog.products.social_share.linkedin', '0', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(63, 'catalog.products.social_share.email', '0', NULL, NULL, '2026-01-05 15:57:48', '2026-01-05 15:57:48'),
(64, 'catalog.products.social_share.share_message', '', NULL, NULL, '2026-01-05 15:57:49', '2026-01-05 15:57:49'),
(65, 'general.design.categories.category_view', 'default', NULL, NULL, '2026-01-06 09:54:47', '2026-01-07 13:46:31'),
(66, '_token', 'GPqzMyGMlSZQuek0WPRGL2vfoOP2XraBDaiVNe4l', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40'),
(67, 'blog_post_per_page', '1000', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40'),
(68, 'blog_post_maximum_related', '20', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40'),
(69, 'blog_post_show_categories_with_count', '1', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40'),
(70, 'blog_post_show_tags_with_count', '1', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40'),
(71, 'blog_post_show_author_page', '1', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40'),
(72, 'blog_post_enable_comment', '1', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40'),
(73, 'blog_post_allow_guest_comment', '1', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40'),
(74, 'blog_post_maximum_nested_comment', '100', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40'),
(75, 'blog_seo_meta_title', 'Farm to Bakery: Why People Trust Us', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40'),
(76, 'blog_seo_meta_keywords', 'AtSaffron Sweets & Bakery, we are committed to delivering the freshest and highest quality baked goods by sourcing the finest ingredients directly from trusted farms. Our \"Farm to Bakery\" approach ensures that every treat is made with the purest, most wholesome ingredients, supporting local farmers and communities.', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40'),
(77, 'blog_seo_meta_description', 'From farm-fresh fruits to premium grains, we handpick the best to create our signature sweets and bakery delights. This commitment to quality, transparency, and sustainability is why our customers trust us for their special moments and daily indulgences. Taste the difference in every bite and experience why Saffron Sweets & Bakery has earned its reputation as the go-to bakery for quality and trust.', NULL, NULL, '2026-01-07 09:50:40', '2026-01-07 09:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Åland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua & Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AC', 'Ascension Island'),
(15, 'AU', 'Australia'),
(16, 'AT', 'Austria'),
(17, 'AZ', 'Azerbaijan'),
(18, 'BS', 'Bahamas'),
(19, 'BH', 'Bahrain'),
(20, 'BD', 'Bangladesh'),
(21, 'BB', 'Barbados'),
(22, 'BY', 'Belarus'),
(23, 'BE', 'Belgium'),
(24, 'BZ', 'Belize'),
(25, 'BJ', 'Benin'),
(26, 'BM', 'Bermuda'),
(27, 'BT', 'Bhutan'),
(28, 'BO', 'Bolivia'),
(29, 'BA', 'Bosnia & Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BR', 'Brazil'),
(32, 'IO', 'British Indian Ocean Territory'),
(33, 'VG', 'British Virgin Islands'),
(34, 'BN', 'Brunei'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'KH', 'Cambodia'),
(39, 'CM', 'Cameroon'),
(40, 'CA', 'Canada'),
(41, 'IC', 'Canary Islands'),
(42, 'CV', 'Cape Verde'),
(43, 'BQ', 'Caribbean Netherlands'),
(44, 'KY', 'Cayman Islands'),
(45, 'CF', 'Central African Republic'),
(46, 'EA', 'Ceuta & Melilla'),
(47, 'TD', 'Chad'),
(48, 'CL', 'Chile'),
(49, 'CN', 'China'),
(50, 'CX', 'Christmas Island'),
(51, 'CC', 'Cocos (Keeling) Islands'),
(52, 'CO', 'Colombia'),
(53, 'KM', 'Comoros'),
(54, 'CG', 'Congo - Brazzaville'),
(55, 'CD', 'Congo - Kinshasa'),
(56, 'CK', 'Cook Islands'),
(57, 'CR', 'Costa Rica'),
(58, 'CI', 'Côte d’Ivoire'),
(59, 'HR', 'Croatia'),
(60, 'CU', 'Cuba'),
(61, 'CW', 'Curaçao'),
(62, 'CY', 'Cyprus'),
(63, 'CZ', 'Czechia'),
(64, 'DK', 'Denmark'),
(65, 'DG', 'Diego Garcia'),
(66, 'DJ', 'Djibouti'),
(67, 'DM', 'Dominica'),
(68, 'DO', 'Dominican Republic'),
(69, 'EC', 'Ecuador'),
(70, 'EG', 'Egypt'),
(71, 'SV', 'El Salvador'),
(72, 'GQ', 'Equatorial Guinea'),
(73, 'ER', 'Eritrea'),
(74, 'EE', 'Estonia'),
(75, 'ET', 'Ethiopia'),
(76, 'EZ', 'Eurozone'),
(77, 'FK', 'Falkland Islands'),
(78, 'FO', 'Faroe Islands'),
(79, 'FJ', 'Fiji'),
(80, 'FI', 'Finland'),
(81, 'FR', 'France'),
(82, 'GF', 'French Guiana'),
(83, 'PF', 'French Polynesia'),
(84, 'TF', 'French Southern Territories'),
(85, 'GA', 'Gabon'),
(86, 'GM', 'Gambia'),
(87, 'GE', 'Georgia'),
(88, 'DE', 'Germany'),
(89, 'GH', 'Ghana'),
(90, 'GI', 'Gibraltar'),
(91, 'GR', 'Greece'),
(92, 'GL', 'Greenland'),
(93, 'GD', 'Grenada'),
(94, 'GP', 'Guadeloupe'),
(95, 'GU', 'Guam'),
(96, 'GT', 'Guatemala'),
(97, 'GG', 'Guernsey'),
(98, 'GN', 'Guinea'),
(99, 'GW', 'Guinea-Bissau'),
(100, 'GY', 'Guyana'),
(101, 'HT', 'Haiti'),
(102, 'HN', 'Honduras'),
(103, 'HK', 'Hong Kong SAR China'),
(104, 'HU', 'Hungary'),
(105, 'IS', 'Iceland'),
(106, 'IN', 'India'),
(107, 'ID', 'Indonesia'),
(108, 'IR', 'Iran'),
(109, 'IQ', 'Iraq'),
(110, 'IE', 'Ireland'),
(111, 'IM', 'Isle of Man'),
(112, 'IL', 'Israel'),
(113, 'IT', 'Italy'),
(114, 'JM', 'Jamaica'),
(115, 'JP', 'Japan'),
(116, 'JE', 'Jersey'),
(117, 'JO', 'Jordan'),
(118, 'KZ', 'Kazakhstan'),
(119, 'KE', 'Kenya'),
(120, 'KI', 'Kiribati'),
(121, 'XK', 'Kosovo'),
(122, 'KW', 'Kuwait'),
(123, 'KG', 'Kyrgyzstan'),
(124, 'LA', 'Laos'),
(125, 'LV', 'Latvia'),
(126, 'LB', 'Lebanon'),
(127, 'LS', 'Lesotho'),
(128, 'LR', 'Liberia'),
(129, 'LY', 'Libya'),
(130, 'LI', 'Liechtenstein'),
(131, 'LT', 'Lithuania'),
(132, 'LU', 'Luxembourg'),
(133, 'MO', 'Macau SAR China'),
(134, 'MK', 'Macedonia'),
(135, 'MG', 'Madagascar'),
(136, 'MW', 'Malawi'),
(137, 'MY', 'Malaysia'),
(138, 'MV', 'Maldives'),
(139, 'ML', 'Mali'),
(140, 'MT', 'Malta'),
(141, 'MH', 'Marshall Islands'),
(142, 'MQ', 'Martinique'),
(143, 'MR', 'Mauritania'),
(144, 'MU', 'Mauritius'),
(145, 'YT', 'Mayotte'),
(146, 'MX', 'Mexico'),
(147, 'FM', 'Micronesia'),
(148, 'MD', 'Moldova'),
(149, 'MC', 'Monaco'),
(150, 'MN', 'Mongolia'),
(151, 'ME', 'Montenegro'),
(152, 'MS', 'Montserrat'),
(153, 'MA', 'Morocco'),
(154, 'MZ', 'Mozambique'),
(155, 'MM', 'Myanmar (Burma)'),
(156, 'NA', 'Namibia'),
(157, 'NR', 'Nauru'),
(158, 'NP', 'Nepal'),
(159, 'NL', 'Netherlands'),
(160, 'NC', 'New Caledonia'),
(161, 'NZ', 'New Zealand'),
(162, 'NI', 'Nicaragua'),
(163, 'NE', 'Niger'),
(164, 'NG', 'Nigeria'),
(165, 'NU', 'Niue'),
(166, 'NF', 'Norfolk Island'),
(167, 'KP', 'North Korea'),
(168, 'MP', 'Northern Mariana Islands'),
(169, 'NO', 'Norway'),
(170, 'OM', 'Oman'),
(171, 'PK', 'Pakistan'),
(172, 'PW', 'Palau'),
(173, 'PS', 'Palestinian Territories'),
(174, 'PA', 'Panama'),
(175, 'PG', 'Papua New Guinea'),
(176, 'PY', 'Paraguay'),
(177, 'PE', 'Peru'),
(178, 'PH', 'Philippines'),
(179, 'PN', 'Pitcairn Islands'),
(180, 'PL', 'Poland'),
(181, 'PT', 'Portugal'),
(182, 'PR', 'Puerto Rico'),
(183, 'QA', 'Qatar'),
(184, 'RE', 'Réunion'),
(185, 'RO', 'Romania'),
(186, 'RU', 'Russia'),
(187, 'RW', 'Rwanda'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'São Tomé & Príncipe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SX', 'Sint Maarten'),
(198, 'SK', 'Slovakia'),
(199, 'SI', 'Slovenia'),
(200, 'SB', 'Solomon Islands'),
(201, 'SO', 'Somalia'),
(202, 'ZA', 'South Africa'),
(203, 'GS', 'South Georgia & South Sandwich Islands'),
(204, 'KR', 'South Korea'),
(205, 'SS', 'South Sudan'),
(206, 'ES', 'Spain'),
(207, 'LK', 'Sri Lanka'),
(208, 'BL', 'St. Barthélemy'),
(209, 'SH', 'St. Helena'),
(210, 'KN', 'St. Kitts & Nevis'),
(211, 'LC', 'St. Lucia'),
(212, 'MF', 'St. Martin'),
(213, 'PM', 'St. Pierre & Miquelon'),
(214, 'VC', 'St. Vincent & Grenadines'),
(215, 'SD', 'Sudan'),
(216, 'SR', 'Suriname'),
(217, 'SJ', 'Svalbard & Jan Mayen'),
(218, 'SZ', 'Swaziland'),
(219, 'SE', 'Sweden'),
(220, 'CH', 'Switzerland'),
(221, 'SY', 'Syria'),
(222, 'TW', 'Taiwan'),
(223, 'TJ', 'Tajikistan'),
(224, 'TZ', 'Tanzania'),
(225, 'TH', 'Thailand'),
(226, 'TL', 'Timor-Leste'),
(227, 'TG', 'Togo'),
(228, 'TK', 'Tokelau'),
(229, 'TO', 'Tonga'),
(230, 'TT', 'Trinidad & Tobago'),
(231, 'TA', 'Tristan da Cunha'),
(232, 'TN', 'Tunisia'),
(233, 'TR', 'Turkey'),
(234, 'TM', 'Turkmenistan'),
(235, 'TC', 'Turks & Caicos Islands'),
(236, 'TV', 'Tuvalu'),
(237, 'UM', 'U.S. Outlying Islands'),
(238, 'VI', 'U.S. Virgin Islands'),
(239, 'UG', 'Uganda'),
(240, 'UA', 'Ukraine'),
(241, 'AE', 'United Arab Emirates'),
(242, 'GB', 'United Kingdom'),
(244, 'US', 'United States'),
(245, 'UY', 'Uruguay'),
(246, 'UZ', 'Uzbekistan'),
(247, 'VU', 'Vanuatu'),
(248, 'VA', 'Vatican City'),
(249, 'VE', 'Venezuela'),
(250, 'VN', 'Vietnam'),
(251, 'WF', 'Wallis & Futuna'),
(252, 'EH', 'Western Sahara'),
(253, 'YE', 'Yemen'),
(254, 'ZM', 'Zambia'),
(255, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `country_states`
--

CREATE TABLE `country_states` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country_states`
--

INSERT INTO `country_states` (`id`, `country_id`, `country_code`, `code`, `default_name`) VALUES
(1, 244, 'US', 'AL', 'Alabama'),
(2, 244, 'US', 'AK', 'Alaska'),
(3, 244, 'US', 'AS', 'American Samoa'),
(4, 244, 'US', 'AZ', 'Arizona'),
(5, 244, 'US', 'AR', 'Arkansas'),
(6, 244, 'US', 'AE', 'Armed Forces Africa'),
(7, 244, 'US', 'AA', 'Armed Forces Americas'),
(8, 244, 'US', 'AE', 'Armed Forces Canada'),
(9, 244, 'US', 'AE', 'Armed Forces Europe'),
(10, 244, 'US', 'AE', 'Armed Forces Middle East'),
(11, 244, 'US', 'AP', 'Armed Forces Pacific'),
(12, 244, 'US', 'CA', 'California'),
(13, 244, 'US', 'CO', 'Colorado'),
(14, 244, 'US', 'CT', 'Connecticut'),
(15, 244, 'US', 'DE', 'Delaware'),
(16, 244, 'US', 'DC', 'District of Columbia'),
(17, 244, 'US', 'FM', 'Federated States Of Micronesia'),
(18, 244, 'US', 'FL', 'Florida'),
(19, 244, 'US', 'GA', 'Georgia'),
(20, 244, 'US', 'GU', 'Guam'),
(21, 244, 'US', 'HI', 'Hawaii'),
(22, 244, 'US', 'ID', 'Idaho'),
(23, 244, 'US', 'IL', 'Illinois'),
(24, 244, 'US', 'IN', 'Indiana'),
(25, 244, 'US', 'IA', 'Iowa'),
(26, 244, 'US', 'KS', 'Kansas'),
(27, 244, 'US', 'KY', 'Kentucky'),
(28, 244, 'US', 'LA', 'Louisiana'),
(29, 244, 'US', 'ME', 'Maine'),
(30, 244, 'US', 'MH', 'Marshall Islands'),
(31, 244, 'US', 'MD', 'Maryland'),
(32, 244, 'US', 'MA', 'Massachusetts'),
(33, 244, 'US', 'MI', 'Michigan'),
(34, 244, 'US', 'MN', 'Minnesota'),
(35, 244, 'US', 'MS', 'Mississippi'),
(36, 244, 'US', 'MO', 'Missouri'),
(37, 244, 'US', 'MT', 'Montana'),
(38, 244, 'US', 'NE', 'Nebraska'),
(39, 244, 'US', 'NV', 'Nevada'),
(40, 244, 'US', 'NH', 'New Hampshire'),
(41, 244, 'US', 'NJ', 'New Jersey'),
(42, 244, 'US', 'NM', 'New Mexico'),
(43, 244, 'US', 'NY', 'New York'),
(44, 244, 'US', 'NC', 'North Carolina'),
(45, 244, 'US', 'ND', 'North Dakota'),
(46, 244, 'US', 'MP', 'Northern Mariana Islands'),
(47, 244, 'US', 'OH', 'Ohio'),
(48, 244, 'US', 'OK', 'Oklahoma'),
(49, 244, 'US', 'OR', 'Oregon'),
(50, 244, 'US', 'PW', 'Palau'),
(51, 244, 'US', 'PA', 'Pennsylvania'),
(52, 244, 'US', 'PR', 'Puerto Rico'),
(53, 244, 'US', 'RI', 'Rhode Island'),
(54, 244, 'US', 'SC', 'South Carolina'),
(55, 244, 'US', 'SD', 'South Dakota'),
(56, 244, 'US', 'TN', 'Tennessee'),
(57, 244, 'US', 'TX', 'Texas'),
(58, 244, 'US', 'UT', 'Utah'),
(59, 244, 'US', 'VT', 'Vermont'),
(60, 244, 'US', 'VI', 'Virgin Islands'),
(61, 244, 'US', 'VA', 'Virginia'),
(62, 244, 'US', 'WA', 'Washington'),
(63, 244, 'US', 'WV', 'West Virginia'),
(64, 244, 'US', 'WI', 'Wisconsin'),
(65, 244, 'US', 'WY', 'Wyoming'),
(66, 40, 'CA', 'AB', 'Alberta'),
(67, 40, 'CA', 'BC', 'British Columbia'),
(68, 40, 'CA', 'MB', 'Manitoba'),
(69, 40, 'CA', 'NL', 'Newfoundland and Labrador'),
(70, 40, 'CA', 'NB', 'New Brunswick'),
(71, 40, 'CA', 'NS', 'Nova Scotia'),
(72, 40, 'CA', 'NT', 'Northwest Territories'),
(73, 40, 'CA', 'NU', 'Nunavut'),
(74, 40, 'CA', 'ON', 'Ontario'),
(75, 40, 'CA', 'PE', 'Prince Edward Island'),
(76, 40, 'CA', 'QC', 'Quebec'),
(77, 40, 'CA', 'SK', 'Saskatchewan'),
(78, 40, 'CA', 'YT', 'Yukon Territory'),
(79, 88, 'DE', 'NDS', 'Niedersachsen'),
(80, 88, 'DE', 'BAW', 'Baden-Württemberg'),
(81, 88, 'DE', 'BAY', 'Bayern'),
(82, 88, 'DE', 'BER', 'Berlin'),
(83, 88, 'DE', 'BRG', 'Brandenburg'),
(84, 88, 'DE', 'BRE', 'Bremen'),
(85, 88, 'DE', 'HAM', 'Hamburg'),
(86, 88, 'DE', 'HES', 'Hessen'),
(87, 88, 'DE', 'MEC', 'Mecklenburg-Vorpommern'),
(88, 88, 'DE', 'NRW', 'Nordrhein-Westfalen'),
(89, 88, 'DE', 'RHE', 'Rheinland-Pfalz'),
(90, 88, 'DE', 'SAR', 'Saarland'),
(91, 88, 'DE', 'SAS', 'Sachsen'),
(92, 88, 'DE', 'SAC', 'Sachsen-Anhalt'),
(93, 88, 'DE', 'SCN', 'Schleswig-Holstein'),
(94, 88, 'DE', 'THE', 'Thüringen'),
(95, 16, 'AT', 'WI', 'Wien'),
(96, 16, 'AT', 'NO', 'Niederösterreich'),
(97, 16, 'AT', 'OO', 'Oberösterreich'),
(98, 16, 'AT', 'SB', 'Salzburg'),
(99, 16, 'AT', 'KN', 'Kärnten'),
(100, 16, 'AT', 'ST', 'Steiermark'),
(101, 16, 'AT', 'TI', 'Tirol'),
(102, 16, 'AT', 'BL', 'Burgenland'),
(103, 16, 'AT', 'VB', 'Vorarlberg'),
(104, 220, 'CH', 'AG', 'Aargau'),
(105, 220, 'CH', 'AI', 'Appenzell Innerrhoden'),
(106, 220, 'CH', 'AR', 'Appenzell Ausserrhoden'),
(107, 220, 'CH', 'BE', 'Bern'),
(108, 220, 'CH', 'BL', 'Basel-Landschaft'),
(109, 220, 'CH', 'BS', 'Basel-Stadt'),
(110, 220, 'CH', 'FR', 'Freiburg'),
(111, 220, 'CH', 'GE', 'Genf'),
(112, 220, 'CH', 'GL', 'Glarus'),
(113, 220, 'CH', 'GR', 'Graubünden'),
(114, 220, 'CH', 'JU', 'Jura'),
(115, 220, 'CH', 'LU', 'Luzern'),
(116, 220, 'CH', 'NE', 'Neuenburg'),
(117, 220, 'CH', 'NW', 'Nidwalden'),
(118, 220, 'CH', 'OW', 'Obwalden'),
(119, 220, 'CH', 'SG', 'St. Gallen'),
(120, 220, 'CH', 'SH', 'Schaffhausen'),
(121, 220, 'CH', 'SO', 'Solothurn'),
(122, 220, 'CH', 'SZ', 'Schwyz'),
(123, 220, 'CH', 'TG', 'Thurgau'),
(124, 220, 'CH', 'TI', 'Tessin'),
(125, 220, 'CH', 'UR', 'Uri'),
(126, 220, 'CH', 'VD', 'Waadt'),
(127, 220, 'CH', 'VS', 'Wallis'),
(128, 220, 'CH', 'ZG', 'Zug'),
(129, 220, 'CH', 'ZH', 'Zürich'),
(130, 206, 'ES', 'A Coruсa', 'A Coruña'),
(131, 206, 'ES', 'Alava', 'Alava'),
(132, 206, 'ES', 'Albacete', 'Albacete'),
(133, 206, 'ES', 'Alicante', 'Alicante'),
(134, 206, 'ES', 'Almeria', 'Almeria'),
(135, 206, 'ES', 'Asturias', 'Asturias'),
(136, 206, 'ES', 'Avila', 'Avila'),
(137, 206, 'ES', 'Badajoz', 'Badajoz'),
(138, 206, 'ES', 'Baleares', 'Baleares'),
(139, 206, 'ES', 'Barcelona', 'Barcelona'),
(140, 206, 'ES', 'Burgos', 'Burgos'),
(141, 206, 'ES', 'Caceres', 'Caceres'),
(142, 206, 'ES', 'Cadiz', 'Cadiz'),
(143, 206, 'ES', 'Cantabria', 'Cantabria'),
(144, 206, 'ES', 'Castellon', 'Castellon'),
(145, 206, 'ES', 'Ceuta', 'Ceuta'),
(146, 206, 'ES', 'Ciudad Real', 'Ciudad Real'),
(147, 206, 'ES', 'Cordoba', 'Cordoba'),
(148, 206, 'ES', 'Cuenca', 'Cuenca'),
(149, 206, 'ES', 'Girona', 'Girona'),
(150, 206, 'ES', 'Granada', 'Granada'),
(151, 206, 'ES', 'Guadalajara', 'Guadalajara'),
(152, 206, 'ES', 'Guipuzcoa', 'Guipuzcoa'),
(153, 206, 'ES', 'Huelva', 'Huelva'),
(154, 206, 'ES', 'Huesca', 'Huesca'),
(155, 206, 'ES', 'Jaen', 'Jaen'),
(156, 206, 'ES', 'La Rioja', 'La Rioja'),
(157, 206, 'ES', 'Las Palmas', 'Las Palmas'),
(158, 206, 'ES', 'Leon', 'Leon'),
(159, 206, 'ES', 'Lleida', 'Lleida'),
(160, 206, 'ES', 'Lugo', 'Lugo'),
(161, 206, 'ES', 'Madrid', 'Madrid'),
(162, 206, 'ES', 'Malaga', 'Malaga'),
(163, 206, 'ES', 'Melilla', 'Melilla'),
(164, 206, 'ES', 'Murcia', 'Murcia'),
(165, 206, 'ES', 'Navarra', 'Navarra'),
(166, 206, 'ES', 'Ourense', 'Ourense'),
(167, 206, 'ES', 'Palencia', 'Palencia'),
(168, 206, 'ES', 'Pontevedra', 'Pontevedra'),
(169, 206, 'ES', 'Salamanca', 'Salamanca'),
(170, 206, 'ES', 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife'),
(171, 206, 'ES', 'Segovia', 'Segovia'),
(172, 206, 'ES', 'Sevilla', 'Sevilla'),
(173, 206, 'ES', 'Soria', 'Soria'),
(174, 206, 'ES', 'Tarragona', 'Tarragona'),
(175, 206, 'ES', 'Teruel', 'Teruel'),
(176, 206, 'ES', 'Toledo', 'Toledo'),
(177, 206, 'ES', 'Valencia', 'Valencia'),
(178, 206, 'ES', 'Valladolid', 'Valladolid'),
(179, 206, 'ES', 'Vizcaya', 'Vizcaya'),
(180, 206, 'ES', 'Zamora', 'Zamora'),
(181, 206, 'ES', 'Zaragoza', 'Zaragoza'),
(182, 81, 'FR', '1', 'Ain'),
(183, 81, 'FR', '2', 'Aisne'),
(184, 81, 'FR', '3', 'Allier'),
(185, 81, 'FR', '4', 'Alpes-de-Haute-Provence'),
(186, 81, 'FR', '5', 'Hautes-Alpes'),
(187, 81, 'FR', '6', 'Alpes-Maritimes'),
(188, 81, 'FR', '7', 'Ardèche'),
(189, 81, 'FR', '8', 'Ardennes'),
(190, 81, 'FR', '9', 'Ariège'),
(191, 81, 'FR', '10', 'Aube'),
(192, 81, 'FR', '11', 'Aude'),
(193, 81, 'FR', '12', 'Aveyron'),
(194, 81, 'FR', '13', 'Bouches-du-Rhône'),
(195, 81, 'FR', '14', 'Calvados'),
(196, 81, 'FR', '15', 'Cantal'),
(197, 81, 'FR', '16', 'Charente'),
(198, 81, 'FR', '17', 'Charente-Maritime'),
(199, 81, 'FR', '18', 'Cher'),
(200, 81, 'FR', '19', 'Corrèze'),
(201, 81, 'FR', '2A', 'Corse-du-Sud'),
(202, 81, 'FR', '2B', 'Haute-Corse'),
(203, 81, 'FR', '21', 'Côte-d\'Or'),
(204, 81, 'FR', '22', 'Côtes-d\'Armor'),
(205, 81, 'FR', '23', 'Creuse'),
(206, 81, 'FR', '24', 'Dordogne'),
(207, 81, 'FR', '25', 'Doubs'),
(208, 81, 'FR', '26', 'Drôme'),
(209, 81, 'FR', '27', 'Eure'),
(210, 81, 'FR', '28', 'Eure-et-Loir'),
(211, 81, 'FR', '29', 'Finistère'),
(212, 81, 'FR', '30', 'Gard'),
(213, 81, 'FR', '31', 'Haute-Garonne'),
(214, 81, 'FR', '32', 'Gers'),
(215, 81, 'FR', '33', 'Gironde'),
(216, 81, 'FR', '34', 'Hérault'),
(217, 81, 'FR', '35', 'Ille-et-Vilaine'),
(218, 81, 'FR', '36', 'Indre'),
(219, 81, 'FR', '37', 'Indre-et-Loire'),
(220, 81, 'FR', '38', 'Isère'),
(221, 81, 'FR', '39', 'Jura'),
(222, 81, 'FR', '40', 'Landes'),
(223, 81, 'FR', '41', 'Loir-et-Cher'),
(224, 81, 'FR', '42', 'Loire'),
(225, 81, 'FR', '43', 'Haute-Loire'),
(226, 81, 'FR', '44', 'Loire-Atlantique'),
(227, 81, 'FR', '45', 'Loiret'),
(228, 81, 'FR', '46', 'Lot'),
(229, 81, 'FR', '47', 'Lot-et-Garonne'),
(230, 81, 'FR', '48', 'Lozère'),
(231, 81, 'FR', '49', 'Maine-et-Loire'),
(232, 81, 'FR', '50', 'Manche'),
(233, 81, 'FR', '51', 'Marne'),
(234, 81, 'FR', '52', 'Haute-Marne'),
(235, 81, 'FR', '53', 'Mayenne'),
(236, 81, 'FR', '54', 'Meurthe-et-Moselle'),
(237, 81, 'FR', '55', 'Meuse'),
(238, 81, 'FR', '56', 'Morbihan'),
(239, 81, 'FR', '57', 'Moselle'),
(240, 81, 'FR', '58', 'Nièvre'),
(241, 81, 'FR', '59', 'Nord'),
(242, 81, 'FR', '60', 'Oise'),
(243, 81, 'FR', '61', 'Orne'),
(244, 81, 'FR', '62', 'Pas-de-Calais'),
(245, 81, 'FR', '63', 'Puy-de-Dôme'),
(246, 81, 'FR', '64', 'Pyrénées-Atlantiques'),
(247, 81, 'FR', '65', 'Hautes-Pyrénées'),
(248, 81, 'FR', '66', 'Pyrénées-Orientales'),
(249, 81, 'FR', '67', 'Bas-Rhin'),
(250, 81, 'FR', '68', 'Haut-Rhin'),
(251, 81, 'FR', '69', 'Rhône'),
(252, 81, 'FR', '70', 'Haute-Saône'),
(253, 81, 'FR', '71', 'Saône-et-Loire'),
(254, 81, 'FR', '72', 'Sarthe'),
(255, 81, 'FR', '73', 'Savoie'),
(256, 81, 'FR', '74', 'Haute-Savoie'),
(257, 81, 'FR', '75', 'Paris'),
(258, 81, 'FR', '76', 'Seine-Maritime'),
(259, 81, 'FR', '77', 'Seine-et-Marne'),
(260, 81, 'FR', '78', 'Yvelines'),
(261, 81, 'FR', '79', 'Deux-Sèvres'),
(262, 81, 'FR', '80', 'Somme'),
(263, 81, 'FR', '81', 'Tarn'),
(264, 81, 'FR', '82', 'Tarn-et-Garonne'),
(265, 81, 'FR', '83', 'Var'),
(266, 81, 'FR', '84', 'Vaucluse'),
(267, 81, 'FR', '85', 'Vendée'),
(268, 81, 'FR', '86', 'Vienne'),
(269, 81, 'FR', '87', 'Haute-Vienne'),
(270, 81, 'FR', '88', 'Vosges'),
(271, 81, 'FR', '89', 'Yonne'),
(272, 81, 'FR', '90', 'Territoire-de-Belfort'),
(273, 81, 'FR', '91', 'Essonne'),
(274, 81, 'FR', '92', 'Hauts-de-Seine'),
(275, 81, 'FR', '93', 'Seine-Saint-Denis'),
(276, 81, 'FR', '94', 'Val-de-Marne'),
(277, 81, 'FR', '95', 'Val-d\'Oise'),
(278, 185, 'RO', 'AB', 'Alba'),
(279, 185, 'RO', 'AR', 'Arad'),
(280, 185, 'RO', 'AG', 'Argeş'),
(281, 185, 'RO', 'BC', 'Bacău'),
(282, 185, 'RO', 'BH', 'Bihor'),
(283, 185, 'RO', 'BN', 'Bistriţa-Năsăud'),
(284, 185, 'RO', 'BT', 'Botoşani'),
(285, 185, 'RO', 'BV', 'Braşov'),
(286, 185, 'RO', 'BR', 'Brăila'),
(287, 185, 'RO', 'B', 'Bucureşti'),
(288, 185, 'RO', 'BZ', 'Buzău'),
(289, 185, 'RO', 'CS', 'Caraş-Severin'),
(290, 185, 'RO', 'CL', 'Călăraşi'),
(291, 185, 'RO', 'CJ', 'Cluj'),
(292, 185, 'RO', 'CT', 'Constanţa'),
(293, 185, 'RO', 'CV', 'Covasna'),
(294, 185, 'RO', 'DB', 'Dâmboviţa'),
(295, 185, 'RO', 'DJ', 'Dolj'),
(296, 185, 'RO', 'GL', 'Galaţi'),
(297, 185, 'RO', 'GR', 'Giurgiu'),
(298, 185, 'RO', 'GJ', 'Gorj'),
(299, 185, 'RO', 'HR', 'Harghita'),
(300, 185, 'RO', 'HD', 'Hunedoara'),
(301, 185, 'RO', 'IL', 'Ialomiţa'),
(302, 185, 'RO', 'IS', 'Iaşi'),
(303, 185, 'RO', 'IF', 'Ilfov'),
(304, 185, 'RO', 'MM', 'Maramureş'),
(305, 185, 'RO', 'MH', 'Mehedinţi'),
(306, 185, 'RO', 'MS', 'Mureş'),
(307, 185, 'RO', 'NT', 'Neamţ'),
(308, 185, 'RO', 'OT', 'Olt'),
(309, 185, 'RO', 'PH', 'Prahova'),
(310, 185, 'RO', 'SM', 'Satu-Mare'),
(311, 185, 'RO', 'SJ', 'Sălaj'),
(312, 185, 'RO', 'SB', 'Sibiu'),
(313, 185, 'RO', 'SV', 'Suceava'),
(314, 185, 'RO', 'TR', 'Teleorman'),
(315, 185, 'RO', 'TM', 'Timiş'),
(316, 185, 'RO', 'TL', 'Tulcea'),
(317, 185, 'RO', 'VS', 'Vaslui'),
(318, 185, 'RO', 'VL', 'Vâlcea'),
(319, 185, 'RO', 'VN', 'Vrancea'),
(320, 80, 'FI', 'Lappi', 'Lappi'),
(321, 80, 'FI', 'Pohjois-Pohjanmaa', 'Pohjois-Pohjanmaa'),
(322, 80, 'FI', 'Kainuu', 'Kainuu'),
(323, 80, 'FI', 'Pohjois-Karjala', 'Pohjois-Karjala'),
(324, 80, 'FI', 'Pohjois-Savo', 'Pohjois-Savo'),
(325, 80, 'FI', 'Etelä-Savo', 'Etelä-Savo'),
(326, 80, 'FI', 'Etelä-Pohjanmaa', 'Etelä-Pohjanmaa'),
(327, 80, 'FI', 'Pohjanmaa', 'Pohjanmaa'),
(328, 80, 'FI', 'Pirkanmaa', 'Pirkanmaa'),
(329, 80, 'FI', 'Satakunta', 'Satakunta'),
(330, 80, 'FI', 'Keski-Pohjanmaa', 'Keski-Pohjanmaa'),
(331, 80, 'FI', 'Keski-Suomi', 'Keski-Suomi'),
(332, 80, 'FI', 'Varsinais-Suomi', 'Varsinais-Suomi'),
(333, 80, 'FI', 'Etelä-Karjala', 'Etelä-Karjala'),
(334, 80, 'FI', 'Päijät-Häme', 'Päijät-Häme'),
(335, 80, 'FI', 'Kanta-Häme', 'Kanta-Häme'),
(336, 80, 'FI', 'Uusimaa', 'Uusimaa'),
(337, 80, 'FI', 'Itä-Uusimaa', 'Itä-Uusimaa'),
(338, 80, 'FI', 'Kymenlaakso', 'Kymenlaakso'),
(339, 80, 'FI', 'Ahvenanmaa', 'Ahvenanmaa'),
(340, 74, 'EE', 'EE-37', 'Harjumaa'),
(341, 74, 'EE', 'EE-39', 'Hiiumaa'),
(342, 74, 'EE', 'EE-44', 'Ida-Virumaa'),
(343, 74, 'EE', 'EE-49', 'Jõgevamaa'),
(344, 74, 'EE', 'EE-51', 'Järvamaa'),
(345, 74, 'EE', 'EE-57', 'Läänemaa'),
(346, 74, 'EE', 'EE-59', 'Lääne-Virumaa'),
(347, 74, 'EE', 'EE-65', 'Põlvamaa'),
(348, 74, 'EE', 'EE-67', 'Pärnumaa'),
(349, 74, 'EE', 'EE-70', 'Raplamaa'),
(350, 74, 'EE', 'EE-74', 'Saaremaa'),
(351, 74, 'EE', 'EE-78', 'Tartumaa'),
(352, 74, 'EE', 'EE-82', 'Valgamaa'),
(353, 74, 'EE', 'EE-84', 'Viljandimaa'),
(354, 74, 'EE', 'EE-86', 'Võrumaa'),
(355, 125, 'LV', 'LV-DGV', 'Daugavpils'),
(356, 125, 'LV', 'LV-JEL', 'Jelgava'),
(357, 125, 'LV', 'Jēkabpils', 'Jēkabpils'),
(358, 125, 'LV', 'LV-JUR', 'Jūrmala'),
(359, 125, 'LV', 'LV-LPX', 'Liepāja'),
(360, 125, 'LV', 'LV-LE', 'Liepājas novads'),
(361, 125, 'LV', 'LV-REZ', 'Rēzekne'),
(362, 125, 'LV', 'LV-RIX', 'Rīga'),
(363, 125, 'LV', 'LV-RI', 'Rīgas novads'),
(364, 125, 'LV', 'Valmiera', 'Valmiera'),
(365, 125, 'LV', 'LV-VEN', 'Ventspils'),
(366, 125, 'LV', 'Aglonas novads', 'Aglonas novads'),
(367, 125, 'LV', 'LV-AI', 'Aizkraukles novads'),
(368, 125, 'LV', 'Aizputes novads', 'Aizputes novads'),
(369, 125, 'LV', 'Aknīstes novads', 'Aknīstes novads'),
(370, 125, 'LV', 'Alojas novads', 'Alojas novads'),
(371, 125, 'LV', 'Alsungas novads', 'Alsungas novads'),
(372, 125, 'LV', 'LV-AL', 'Alūksnes novads'),
(373, 125, 'LV', 'Amatas novads', 'Amatas novads'),
(374, 125, 'LV', 'Apes novads', 'Apes novads'),
(375, 125, 'LV', 'Auces novads', 'Auces novads'),
(376, 125, 'LV', 'Babītes novads', 'Babītes novads'),
(377, 125, 'LV', 'Baldones novads', 'Baldones novads'),
(378, 125, 'LV', 'Baltinavas novads', 'Baltinavas novads'),
(379, 125, 'LV', 'LV-BL', 'Balvu novads'),
(380, 125, 'LV', 'LV-BU', 'Bauskas novads'),
(381, 125, 'LV', 'Beverīnas novads', 'Beverīnas novads'),
(382, 125, 'LV', 'Brocēnu novads', 'Brocēnu novads'),
(383, 125, 'LV', 'Burtnieku novads', 'Burtnieku novads'),
(384, 125, 'LV', 'Carnikavas novads', 'Carnikavas novads'),
(385, 125, 'LV', 'Cesvaines novads', 'Cesvaines novads'),
(386, 125, 'LV', 'Ciblas novads', 'Ciblas novads'),
(387, 125, 'LV', 'LV-CE', 'Cēsu novads'),
(388, 125, 'LV', 'Dagdas novads', 'Dagdas novads'),
(389, 125, 'LV', 'LV-DA', 'Daugavpils novads'),
(390, 125, 'LV', 'LV-DO', 'Dobeles novads'),
(391, 125, 'LV', 'Dundagas novads', 'Dundagas novads'),
(392, 125, 'LV', 'Durbes novads', 'Durbes novads'),
(393, 125, 'LV', 'Engures novads', 'Engures novads'),
(394, 125, 'LV', 'Garkalnes novads', 'Garkalnes novads'),
(395, 125, 'LV', 'Grobiņas novads', 'Grobiņas novads'),
(396, 125, 'LV', 'LV-GU', 'Gulbenes novads'),
(397, 125, 'LV', 'Iecavas novads', 'Iecavas novads'),
(398, 125, 'LV', 'Ikšķiles novads', 'Ikšķiles novads'),
(399, 125, 'LV', 'Ilūkstes novads', 'Ilūkstes novads'),
(400, 125, 'LV', 'Inčukalna novads', 'Inčukalna novads'),
(401, 125, 'LV', 'Jaunjelgavas novads', 'Jaunjelgavas novads'),
(402, 125, 'LV', 'Jaunpiebalgas novads', 'Jaunpiebalgas novads'),
(403, 125, 'LV', 'Jaunpils novads', 'Jaunpils novads'),
(404, 125, 'LV', 'LV-JL', 'Jelgavas novads'),
(405, 125, 'LV', 'LV-JK', 'Jēkabpils novads'),
(406, 125, 'LV', 'Kandavas novads', 'Kandavas novads'),
(407, 125, 'LV', 'Kokneses novads', 'Kokneses novads'),
(408, 125, 'LV', 'Krimuldas novads', 'Krimuldas novads'),
(409, 125, 'LV', 'Krustpils novads', 'Krustpils novads'),
(410, 125, 'LV', 'LV-KR', 'Krāslavas novads'),
(411, 125, 'LV', 'LV-KU', 'Kuldīgas novads'),
(412, 125, 'LV', 'Kārsavas novads', 'Kārsavas novads'),
(413, 125, 'LV', 'Lielvārdes novads', 'Lielvārdes novads'),
(414, 125, 'LV', 'LV-LM', 'Limbažu novads'),
(415, 125, 'LV', 'Lubānas novads', 'Lubānas novads'),
(416, 125, 'LV', 'LV-LU', 'Ludzas novads'),
(417, 125, 'LV', 'Līgatnes novads', 'Līgatnes novads'),
(418, 125, 'LV', 'Līvānu novads', 'Līvānu novads'),
(419, 125, 'LV', 'LV-MA', 'Madonas novads'),
(420, 125, 'LV', 'Mazsalacas novads', 'Mazsalacas novads'),
(421, 125, 'LV', 'Mālpils novads', 'Mālpils novads'),
(422, 125, 'LV', 'Mārupes novads', 'Mārupes novads'),
(423, 125, 'LV', 'Naukšēnu novads', 'Naukšēnu novads'),
(424, 125, 'LV', 'Neretas novads', 'Neretas novads'),
(425, 125, 'LV', 'Nīcas novads', 'Nīcas novads'),
(426, 125, 'LV', 'LV-OG', 'Ogres novads'),
(427, 125, 'LV', 'Olaines novads', 'Olaines novads'),
(428, 125, 'LV', 'Ozolnieku novads', 'Ozolnieku novads'),
(429, 125, 'LV', 'LV-PR', 'Preiļu novads'),
(430, 125, 'LV', 'Priekules novads', 'Priekules novads'),
(431, 125, 'LV', 'Priekuļu novads', 'Priekuļu novads'),
(432, 125, 'LV', 'Pārgaujas novads', 'Pārgaujas novads'),
(433, 125, 'LV', 'Pāvilostas novads', 'Pāvilostas novads'),
(434, 125, 'LV', 'Pļaviņu novads', 'Pļaviņu novads'),
(435, 125, 'LV', 'Raunas novads', 'Raunas novads'),
(436, 125, 'LV', 'Riebiņu novads', 'Riebiņu novads'),
(437, 125, 'LV', 'Rojas novads', 'Rojas novads'),
(438, 125, 'LV', 'Ropažu novads', 'Ropažu novads'),
(439, 125, 'LV', 'Rucavas novads', 'Rucavas novads'),
(440, 125, 'LV', 'Rugāju novads', 'Rugāju novads'),
(441, 125, 'LV', 'Rundāles novads', 'Rundāles novads'),
(442, 125, 'LV', 'LV-RE', 'Rēzeknes novads'),
(443, 125, 'LV', 'Rūjienas novads', 'Rūjienas novads'),
(444, 125, 'LV', 'Salacgrīvas novads', 'Salacgrīvas novads'),
(445, 125, 'LV', 'Salas novads', 'Salas novads'),
(446, 125, 'LV', 'Salaspils novads', 'Salaspils novads'),
(447, 125, 'LV', 'LV-SA', 'Saldus novads'),
(448, 125, 'LV', 'Saulkrastu novads', 'Saulkrastu novads'),
(449, 125, 'LV', 'Siguldas novads', 'Siguldas novads'),
(450, 125, 'LV', 'Skrundas novads', 'Skrundas novads'),
(451, 125, 'LV', 'Skrīveru novads', 'Skrīveru novads'),
(452, 125, 'LV', 'Smiltenes novads', 'Smiltenes novads'),
(453, 125, 'LV', 'Stopiņu novads', 'Stopiņu novads'),
(454, 125, 'LV', 'Strenču novads', 'Strenču novads'),
(455, 125, 'LV', 'Sējas novads', 'Sējas novads'),
(456, 125, 'LV', 'LV-TA', 'Talsu novads'),
(457, 125, 'LV', 'LV-TU', 'Tukuma novads'),
(458, 125, 'LV', 'Tērvetes novads', 'Tērvetes novads'),
(459, 125, 'LV', 'Vaiņodes novads', 'Vaiņodes novads'),
(460, 125, 'LV', 'LV-VK', 'Valkas novads'),
(461, 125, 'LV', 'LV-VM', 'Valmieras novads'),
(462, 125, 'LV', 'Varakļānu novads', 'Varakļānu novads'),
(463, 125, 'LV', 'Vecpiebalgas novads', 'Vecpiebalgas novads'),
(464, 125, 'LV', 'Vecumnieku novads', 'Vecumnieku novads'),
(465, 125, 'LV', 'LV-VE', 'Ventspils novads'),
(466, 125, 'LV', 'Viesītes novads', 'Viesītes novads'),
(467, 125, 'LV', 'Viļakas novads', 'Viļakas novads'),
(468, 125, 'LV', 'Viļānu novads', 'Viļānu novads'),
(469, 125, 'LV', 'Vārkavas novads', 'Vārkavas novads'),
(470, 125, 'LV', 'Zilupes novads', 'Zilupes novads'),
(471, 125, 'LV', 'Ādažu novads', 'Ādažu novads'),
(472, 125, 'LV', 'Ērgļu novads', 'Ērgļu novads'),
(473, 125, 'LV', 'Ķeguma novads', 'Ķeguma novads'),
(474, 125, 'LV', 'Ķekavas novads', 'Ķekavas novads'),
(475, 131, 'LT', 'LT-AL', 'Alytaus Apskritis'),
(476, 131, 'LT', 'LT-KU', 'Kauno Apskritis'),
(477, 131, 'LT', 'LT-KL', 'Klaipėdos Apskritis'),
(478, 131, 'LT', 'LT-MR', 'Marijampolės Apskritis'),
(479, 131, 'LT', 'LT-PN', 'Panevėžio Apskritis'),
(480, 131, 'LT', 'LT-SA', 'Šiaulių Apskritis'),
(481, 131, 'LT', 'LT-TA', 'Tauragės Apskritis'),
(482, 131, 'LT', 'LT-TE', 'Telšių Apskritis'),
(483, 131, 'LT', 'LT-UT', 'Utenos Apskritis'),
(484, 131, 'LT', 'LT-VL', 'Vilniaus Apskritis'),
(485, 31, 'BR', 'AC', 'Acre'),
(486, 31, 'BR', 'AL', 'Alagoas'),
(487, 31, 'BR', 'AP', 'Amapá'),
(488, 31, 'BR', 'AM', 'Amazonas'),
(489, 31, 'BR', 'BA', 'Bahia'),
(490, 31, 'BR', 'CE', 'Ceará'),
(491, 31, 'BR', 'ES', 'Espírito Santo'),
(492, 31, 'BR', 'GO', 'Goiás'),
(493, 31, 'BR', 'MA', 'Maranhão'),
(494, 31, 'BR', 'MT', 'Mato Grosso'),
(495, 31, 'BR', 'MS', 'Mato Grosso do Sul'),
(496, 31, 'BR', 'MG', 'Minas Gerais'),
(497, 31, 'BR', 'PA', 'Pará'),
(498, 31, 'BR', 'PB', 'Paraíba'),
(499, 31, 'BR', 'PR', 'Paraná'),
(500, 31, 'BR', 'PE', 'Pernambuco'),
(501, 31, 'BR', 'PI', 'Piauí'),
(502, 31, 'BR', 'RJ', 'Rio de Janeiro'),
(503, 31, 'BR', 'RN', 'Rio Grande do Norte'),
(504, 31, 'BR', 'RS', 'Rio Grande do Sul'),
(505, 31, 'BR', 'RO', 'Rondônia'),
(506, 31, 'BR', 'RR', 'Roraima'),
(507, 31, 'BR', 'SC', 'Santa Catarina'),
(508, 31, 'BR', 'SP', 'São Paulo'),
(509, 31, 'BR', 'SE', 'Sergipe'),
(510, 31, 'BR', 'TO', 'Tocantins'),
(511, 31, 'BR', 'DF', 'Distrito Federal'),
(512, 59, 'HR', 'HR-01', 'Zagrebačka županija'),
(513, 59, 'HR', 'HR-02', 'Krapinsko-zagorska županija'),
(514, 59, 'HR', 'HR-03', 'Sisačko-moslavačka županija'),
(515, 59, 'HR', 'HR-04', 'Karlovačka županija'),
(516, 59, 'HR', 'HR-05', 'Varaždinska županija'),
(517, 59, 'HR', 'HR-06', 'Koprivničko-križevačka županija'),
(518, 59, 'HR', 'HR-07', 'Bjelovarsko-bilogorska županija'),
(519, 59, 'HR', 'HR-08', 'Primorsko-goranska županija'),
(520, 59, 'HR', 'HR-09', 'Ličko-senjska županija'),
(521, 59, 'HR', 'HR-10', 'Virovitičko-podravska županija'),
(522, 59, 'HR', 'HR-11', 'Požeško-slavonska županija'),
(523, 59, 'HR', 'HR-12', 'Brodsko-posavska županija'),
(524, 59, 'HR', 'HR-13', 'Zadarska županija'),
(525, 59, 'HR', 'HR-14', 'Osječko-baranjska županija'),
(526, 59, 'HR', 'HR-15', 'Šibensko-kninska županija'),
(527, 59, 'HR', 'HR-16', 'Vukovarsko-srijemska županija'),
(528, 59, 'HR', 'HR-17', 'Splitsko-dalmatinska županija'),
(529, 59, 'HR', 'HR-18', 'Istarska županija'),
(530, 59, 'HR', 'HR-19', 'Dubrovačko-neretvanska županija'),
(531, 59, 'HR', 'HR-20', 'Međimurska županija'),
(532, 59, 'HR', 'HR-21', 'Grad Zagreb'),
(533, 106, 'IN', 'AN', 'Andaman and Nicobar Islands'),
(534, 106, 'IN', 'AP', 'Andhra Pradesh'),
(535, 106, 'IN', 'AR', 'Arunachal Pradesh'),
(536, 106, 'IN', 'AS', 'Assam'),
(537, 106, 'IN', 'BR', 'Bihar'),
(538, 106, 'IN', 'CH', 'Chandigarh'),
(539, 106, 'IN', 'CT', 'Chhattisgarh'),
(540, 106, 'IN', 'DN', 'Dadra and Nagar Haveli'),
(541, 106, 'IN', 'DD', 'Daman and Diu'),
(542, 106, 'IN', 'DL', 'Delhi'),
(543, 106, 'IN', 'GA', 'Goa'),
(544, 106, 'IN', 'GJ', 'Gujarat'),
(545, 106, 'IN', 'HR', 'Haryana'),
(546, 106, 'IN', 'HP', 'Himachal Pradesh'),
(547, 106, 'IN', 'JK', 'Jammu and Kashmir'),
(548, 106, 'IN', 'JH', 'Jharkhand'),
(549, 106, 'IN', 'KA', 'Karnataka'),
(550, 106, 'IN', 'KL', 'Kerala'),
(551, 106, 'IN', 'LD', 'Lakshadweep'),
(552, 106, 'IN', 'MP', 'Madhya Pradesh'),
(553, 106, 'IN', 'MH', 'Maharashtra'),
(554, 106, 'IN', 'MN', 'Manipur'),
(555, 106, 'IN', 'ML', 'Meghalaya'),
(556, 106, 'IN', 'MZ', 'Mizoram'),
(557, 106, 'IN', 'NL', 'Nagaland'),
(558, 106, 'IN', 'OR', 'Odisha'),
(559, 106, 'IN', 'PY', 'Puducherry'),
(560, 106, 'IN', 'PB', 'Punjab'),
(561, 106, 'IN', 'RJ', 'Rajasthan'),
(562, 106, 'IN', 'SK', 'Sikkim'),
(563, 106, 'IN', 'TN', 'Tamil Nadu'),
(564, 106, 'IN', 'TG', 'Telangana'),
(565, 106, 'IN', 'TR', 'Tripura'),
(566, 106, 'IN', 'UP', 'Uttar Pradesh'),
(567, 106, 'IN', 'UT', 'Uttarakhand'),
(568, 106, 'IN', 'WB', 'West Bengal'),
(569, 176, 'PY', 'PY-16', 'Alto Paraguay'),
(570, 176, 'PY', 'PY-10', 'Alto Paraná'),
(571, 176, 'PY', 'PY-13', 'Amambay'),
(572, 176, 'PY', 'PY-ASU', 'Asunción'),
(573, 176, 'PY', 'PY-19', 'Boquerón'),
(574, 176, 'PY', 'PY-5', 'Caaguazú'),
(575, 176, 'PY', 'PY-6', 'Caazapá'),
(576, 176, 'PY', 'PY-14', 'Canindeyú'),
(577, 176, 'PY', 'PY-11', 'Central'),
(578, 176, 'PY', 'PY-1', 'Concepción'),
(579, 176, 'PY', 'PY-3', 'Cordillera'),
(580, 176, 'PY', 'PY-4', 'Guairá'),
(581, 176, 'PY', 'PY-7', 'Itapúa'),
(582, 176, 'PY', 'PY-8', 'Misiones'),
(583, 176, 'PY', 'PY-9', 'Paraguarí'),
(584, 176, 'PY', 'PY-15', 'Presidente Hayes'),
(585, 176, 'PY', 'PY-2', 'San Pedro'),
(586, 176, 'PY', 'PY-12', 'Ñeembucú');

-- --------------------------------------------------------

--
-- Table structure for table `country_state_translations`
--

CREATE TABLE `country_state_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_state_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_name` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country_translations`
--

CREATE TABLE `country_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decimal` int(10) UNSIGNED NOT NULL DEFAULT '2',
  `group_separator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ',',
  `decimal_separator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '.',
  `currency_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `symbol`, `decimal`, `group_separator`, `decimal_separator`, `currency_position`, `created_at`, `updated_at`) VALUES
(1, 'USD', 'United States Dollar', '$', 2, ',', '.', NULL, NULL, NULL),
(3, 'BDT', 'Taka', '৳', 2, '', '', 'left', '2026-01-05 16:12:53', '2026-01-05 16:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `currency_exchange_rates`
--

CREATE TABLE `currency_exchange_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `rate` decimal(24,12) NOT NULL,
  `target_currency` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_group_id` int(10) UNSIGNED DEFAULT NULL,
  `channel_id` int(10) UNSIGNED DEFAULT NULL,
  `subscribed_to_news_letter` tinyint(1) NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_suspended` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `gender`, `date_of_birth`, `email`, `phone`, `image`, `status`, `password`, `api_token`, `customer_group_id`, `channel_id`, `subscribed_to_news_letter`, `is_verified`, `is_suspended`, `token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Leonard', 'Altenwerth', 'male', NULL, 'xwalsh@example.net', NULL, NULL, 1, '$2y$12$bZFOBQTmmFsiYHDsuKEgb.hDdTB1FwT5L4e1kCh/abtP9XDkPm86W', NULL, 2, 1, 0, 1, 0, NULL, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52'),
(2, 'Hershel', 'Pouros', 'other', NULL, 'gmitchell@example.net', NULL, NULL, 1, '$2y$12$nlmye68nNzeZMcfv9Xwcq.WYRaMIs9UyhZKsSjqrRV4SeyNXg0LpG', NULL, 2, 1, 0, 1, 0, NULL, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52'),
(3, 'Keira', 'Price', 'female', NULL, 'wshanahan@example.net', NULL, NULL, 1, '$2y$12$D2oYt0sXkP7.xmGGYa7m1ebfB/JmTDumIYn7SPG45F9YlEQSI.gy.', NULL, 2, 1, 0, 1, 0, NULL, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52'),
(4, 'Claudie', 'Rodriguez', 'male', NULL, 'harris.jaylin@example.org', NULL, NULL, 1, '$2y$12$G4FgLd0QzIBM3sBlPFG42OM4VDzEO4LdAFdT3/cVpUcXVwACtytVS', NULL, 2, 1, 0, 1, 0, NULL, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52'),
(5, 'Lazaro', 'Russel', 'male', NULL, 'hhuel@example.org', NULL, NULL, 1, '$2y$12$wePjAJ8ReDxnr3daj0aghOdfE3M5tI.rlIbhxOGTFseoCnFOMW0sS', NULL, 2, 1, 0, 1, 0, NULL, NULL, '2026-01-05 15:36:53', '2026-01-05 15:36:53'),
(6, 'Md.Asharful', 'Momen', NULL, NULL, 'ashrafulinstasure@gmail.com', NULL, NULL, 1, '$2y$12$OkP.VvGW/7vaXuXlOVEqHO9d9DluWLyEwwL0nXUawoxv7bneFHHkm', 'q4gVIF8juPGtSzHVpKu6Cf8VOtuHTS3l7C4myqnhYULNB7pALSa2tH2my2SsETNW5AqpGHYJXRMXARVy', 2, 1, 1, 1, 0, 'bb11cbd17fcd61a5b4164b64d0876591', NULL, '2026-01-05 17:17:00', '2026-01-06 10:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_groups`
--

INSERT INTO `customer_groups` (`id`, `code`, `name`, `is_user_defined`, `created_at`, `updated_at`) VALUES
(1, 'guest', 'Guest', 0, NULL, NULL),
(2, 'general', 'General', 0, NULL, NULL),
(3, 'wholesale', 'Wholesale', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_notes`
--

CREATE TABLE `customer_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_notified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_password_resets`
--

CREATE TABLE `customer_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_social_accounts`
--

CREATE TABLE `customer_social_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `provider_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `datagrid_saved_filters`
--

CREATE TABLE `datagrid_saved_filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applied` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_partners`
--

CREATE TABLE `delivery_partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('available','busy','offline') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `downloadable_link_purchased`
--

CREATE TABLE `downloadable_link_purchased` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `download_bought` int(11) NOT NULL DEFAULT '0',
  `download_used` int(11) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `order_item_id` int(10) UNSIGNED NOT NULL,
  `download_canceled` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gdpr_data_request`
--

CREATE TABLE `gdpr_data_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `id` int(10) UNSIGNED NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `process_in_queue` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validation_strategy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allowed_errors` int(11) NOT NULL DEFAULT '0',
  `processed_rows_count` int(11) NOT NULL DEFAULT '0',
  `invalid_rows_count` int(11) NOT NULL DEFAULT '0',
  `errors_count` int(11) NOT NULL DEFAULT '0',
  `errors` json DEFAULT NULL,
  `field_separator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images_directory_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` json DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `import_batches`
--

CREATE TABLE `import_batches` (
  `id` int(10) UNSIGNED NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `data` json NOT NULL,
  `summary` json DEFAULT NULL,
  `import_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_sources`
--

CREATE TABLE `inventory_sources` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `latitude` decimal(10,5) DEFAULT NULL,
  `longitude` decimal(10,5) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_sources`
--

INSERT INTO `inventory_sources` (`id`, `code`, `name`, `description`, `contact_name`, `contact_email`, `contact_number`, `contact_fax`, `country`, `state`, `city`, `street`, `postcode`, `priority`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(1, 'default', 'Default', NULL, 'Default', 'warehouse@example.com', '1234567899', NULL, 'US', 'MI', 'Detroit', '12th Street', '48127', 0, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `increment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_sent` tinyint(1) NOT NULL DEFAULT '0',
  `total_qty` int(11) DEFAULT NULL,
  `base_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` decimal(12,4) DEFAULT '0.0000',
  `base_sub_total` decimal(12,4) DEFAULT '0.0000',
  `grand_total` decimal(12,4) DEFAULT '0.0000',
  `base_grand_total` decimal(12,4) DEFAULT '0.0000',
  `shipping_amount` decimal(12,4) DEFAULT '0.0000',
  `base_shipping_amount` decimal(12,4) DEFAULT '0.0000',
  `tax_amount` decimal(12,4) DEFAULT '0.0000',
  `base_tax_amount` decimal(12,4) DEFAULT '0.0000',
  `discount_amount` decimal(12,4) DEFAULT '0.0000',
  `base_discount_amount` decimal(12,4) DEFAULT '0.0000',
  `shipping_tax_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_shipping_tax_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `sub_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_sub_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `shipping_amount_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_shipping_amount_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminders` int(11) NOT NULL DEFAULT '0',
  `next_reminder_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `increment_id`, `state`, `email_sent`, `total_qty`, `base_currency_code`, `channel_currency_code`, `order_currency_code`, `sub_total`, `base_sub_total`, `grand_total`, `base_grand_total`, `shipping_amount`, `base_shipping_amount`, `tax_amount`, `base_tax_amount`, `discount_amount`, `base_discount_amount`, `shipping_tax_amount`, `base_shipping_tax_amount`, `sub_total_incl_tax`, `base_sub_total_incl_tax`, `shipping_amount_incl_tax`, `base_shipping_amount_incl_tax`, `order_id`, `transaction_id`, `reminders`, `next_reminder_at`, `created_at`, `updated_at`) VALUES
(1, '1', 'paid', 1, 1, 'USD', 'USD', 'USD', 120.0000, 120.0000, 120.0000, 120.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 120.0000, 120.0000, 0.0000, 0.0000, 4, NULL, 0, NULL, '2026-01-05 17:23:23', '2026-01-05 17:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_total` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `tax_amount` decimal(12,4) DEFAULT '0.0000',
  `base_tax_amount` decimal(12,4) DEFAULT '0.0000',
  `discount_percent` decimal(12,4) DEFAULT '0.0000',
  `discount_amount` decimal(12,4) DEFAULT '0.0000',
  `base_discount_amount` decimal(12,4) DEFAULT '0.0000',
  `price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_item_id` int(10) UNSIGNED DEFAULT NULL,
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `additional` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `parent_id`, `name`, `description`, `sku`, `qty`, `price`, `base_price`, `total`, `base_total`, `tax_amount`, `base_tax_amount`, `discount_percent`, `discount_amount`, `base_discount_amount`, `price_incl_tax`, `base_price_incl_tax`, `total_incl_tax`, `base_total_incl_tax`, `product_id`, `product_type`, `order_item_id`, `invoice_id`, `additional`, `created_at`, `updated_at`) VALUES
(1, NULL, '', NULL, '101', 1, 120.0000, 120.0000, 120.0000, 120.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 120.0000, 120.0000, 120.0000, 120.0000, 2, 'Webkul\\Product\\Models\\Product', 2, 1, '{\"locale\": \"en\", \"cart_id\": 2, \"quantity\": 1, \"is_buy_now\": \"0\", \"product_id\": \"2\"}', '2026-01-05 17:23:23', '2026-01-05 17:23:23');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locales`
--

CREATE TABLE `locales` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` enum('ltr','rtl') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ltr',
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locales`
--

INSERT INTO `locales` (`id`, `code`, `name`, `direction`, `logo_path`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 'ltr', 'locales/8OXgtvzN1oc1Lf1tllCOEgV5G1ER1UESylWMewIw.png', NULL, NULL),
(3, 'bn', 'Bangla', 'ltr', NULL, '2026-01-05 16:10:39', '2026-01-05 16:10:39');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_campaigns`
--

CREATE TABLE `marketing_campaigns` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spooling` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_group_id` int(10) UNSIGNED DEFAULT NULL,
  `marketing_template_id` int(10) UNSIGNED DEFAULT NULL,
  `marketing_event_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_events`
--

CREATE TABLE `marketing_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marketing_events`
--

INSERT INTO `marketing_events` (`id`, `name`, `description`, `date`, `created_at`, `updated_at`) VALUES
(1, 'Birthday', 'Birthday', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `marketing_templates`
--

CREATE TABLE `marketing_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_admin_password_resets_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2018_06_12_111907_create_admins_table', 1),
(5, '2018_06_13_055341_create_roles_table', 1),
(6, '2018_07_05_130148_create_attributes_table', 1),
(7, '2018_07_05_132854_create_attribute_translations_table', 1),
(8, '2018_07_05_135150_create_attribute_families_table', 1),
(9, '2018_07_05_135152_create_attribute_groups_table', 1),
(10, '2018_07_05_140832_create_attribute_options_table', 1),
(11, '2018_07_05_140856_create_attribute_option_translations_table', 1),
(12, '2018_07_05_142820_create_categories_table', 1),
(13, '2018_07_10_055143_create_locales_table', 1),
(14, '2018_07_20_054426_create_countries_table', 1),
(15, '2018_07_20_054502_create_currencies_table', 1),
(16, '2018_07_20_054542_create_currency_exchange_rates_table', 1),
(17, '2018_07_20_064849_create_channels_table', 1),
(18, '2018_07_21_142836_create_category_translations_table', 1),
(19, '2018_07_23_110040_create_inventory_sources_table', 1),
(20, '2018_07_24_082635_create_customer_groups_table', 1),
(21, '2018_07_24_082930_create_customers_table', 1),
(22, '2018_07_27_065727_create_products_table', 1),
(23, '2018_07_27_070011_create_product_attribute_values_table', 1),
(24, '2018_07_27_092623_create_product_reviews_table', 1),
(25, '2018_07_27_113941_create_product_images_table', 1),
(26, '2018_07_27_113956_create_product_inventories_table', 1),
(27, '2018_08_30_064755_create_tax_categories_table', 1),
(28, '2018_08_30_065042_create_tax_rates_table', 1),
(29, '2018_08_30_065840_create_tax_mappings_table', 1),
(30, '2018_09_05_150444_create_cart_table', 1),
(31, '2018_09_05_150915_create_cart_items_table', 1),
(32, '2018_09_11_064045_customer_password_resets', 1),
(33, '2018_09_19_093453_create_cart_payment', 1),
(34, '2018_09_19_093508_create_cart_shipping_rates_table', 1),
(35, '2018_09_20_060658_create_core_config_table', 1),
(36, '2018_09_27_113154_create_orders_table', 1),
(37, '2018_09_27_113207_create_order_items_table', 1),
(38, '2018_09_27_115022_create_shipments_table', 1),
(39, '2018_09_27_115029_create_shipment_items_table', 1),
(40, '2018_09_27_115135_create_invoices_table', 1),
(41, '2018_09_27_115144_create_invoice_items_table', 1),
(42, '2018_10_01_095504_create_order_payment_table', 1),
(43, '2018_10_03_025230_create_wishlist_table', 1),
(44, '2018_10_12_101803_create_country_translations_table', 1),
(45, '2018_10_12_101913_create_country_states_table', 1),
(46, '2018_10_12_101923_create_country_state_translations_table', 1),
(47, '2018_11_16_173504_create_subscribers_list_table', 1),
(48, '2018_11_21_144411_create_cart_item_inventories_table', 1),
(49, '2018_12_06_185202_create_product_flat_table', 1),
(50, '2018_12_24_123812_create_channel_inventory_sources_table', 1),
(51, '2018_12_26_165327_create_product_ordered_inventories_table', 1),
(52, '2019_05_13_024321_create_cart_rules_table', 1),
(53, '2019_05_13_024322_create_cart_rule_channels_table', 1),
(54, '2019_05_13_024323_create_cart_rule_customer_groups_table', 1),
(55, '2019_05_13_024324_create_cart_rule_translations_table', 1),
(56, '2019_05_13_024325_create_cart_rule_customers_table', 1),
(57, '2019_05_13_024326_create_cart_rule_coupons_table', 1),
(58, '2019_05_13_024327_create_cart_rule_coupon_usage_table', 1),
(59, '2019_06_17_180258_create_product_downloadable_samples_table', 1),
(60, '2019_06_17_180314_create_product_downloadable_sample_translations_table', 1),
(61, '2019_06_17_180325_create_product_downloadable_links_table', 1),
(62, '2019_06_17_180346_create_product_downloadable_link_translations_table', 1),
(63, '2019_06_21_202249_create_downloadable_link_purchased_table', 1),
(64, '2019_07_02_180307_create_booking_products_table', 1),
(65, '2019_07_05_154415_create_booking_product_default_slots_table', 1),
(66, '2019_07_05_154429_create_booking_product_appointment_slots_table', 1),
(67, '2019_07_05_154440_create_booking_product_event_tickets_table', 1),
(68, '2019_07_05_154451_create_booking_product_rental_slots_table', 1),
(69, '2019_07_05_154502_create_booking_product_table_slots_table', 1),
(70, '2019_07_30_153530_create_cms_pages_table', 1),
(71, '2019_07_31_143339_create_category_filterable_attributes_table', 1),
(72, '2019_08_02_105320_create_product_grouped_products_table', 1),
(73, '2019_08_20_170510_create_product_bundle_options_table', 1),
(74, '2019_08_20_170520_create_product_bundle_option_translations_table', 1),
(75, '2019_08_20_170528_create_product_bundle_option_products_table', 1),
(76, '2019_09_11_184511_create_refunds_table', 1),
(77, '2019_09_11_184519_create_refund_items_table', 1),
(78, '2019_12_03_184613_create_catalog_rules_table', 1),
(79, '2019_12_03_184651_create_catalog_rule_channels_table', 1),
(80, '2019_12_03_184732_create_catalog_rule_customer_groups_table', 1),
(81, '2019_12_06_101110_create_catalog_rule_products_table', 1),
(82, '2019_12_06_110507_create_catalog_rule_product_prices_table', 1),
(83, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(84, '2020_01_14_191854_create_cms_page_translations_table', 1),
(85, '2020_01_15_130209_create_cms_page_channels_table', 1),
(86, '2020_02_18_165639_create_bookings_table', 1),
(87, '2020_02_21_121201_create_booking_product_event_ticket_translations_table', 1),
(88, '2020_04_16_185147_add_table_addresses', 1),
(89, '2020_05_06_171638_create_order_comments_table', 1),
(90, '2020_05_21_171500_create_product_customer_group_prices_table', 1),
(91, '2020_06_25_162154_create_customer_social_accounts_table', 1),
(92, '2020_08_07_174804_create_gdpr_data_request_table', 1),
(93, '2020_11_19_112228_create_product_videos_table', 1),
(94, '2020_11_26_141455_create_marketing_templates_table', 1),
(95, '2020_11_26_150534_create_marketing_events_table', 1),
(96, '2020_11_26_150644_create_marketing_campaigns_table', 1),
(97, '2020_12_21_000200_create_channel_translations_table', 1),
(98, '2020_12_27_121950_create_jobs_table', 1),
(99, '2021_03_11_212124_create_order_transactions_table', 1),
(100, '2021_04_07_132010_create_product_review_images_table', 1),
(101, '2021_12_15_104544_notifications', 1),
(102, '2022_03_15_160510_create_failed_jobs_table', 1),
(103, '2022_04_01_094622_create_sitemaps_table', 1),
(104, '2022_10_03_144232_create_product_price_indices_table', 1),
(105, '2022_10_04_144444_create_job_batches_table', 1),
(106, '2022_10_08_134150_create_product_inventory_indices_table', 1),
(107, '2023_03_21_172616_create_blogs_table', 1),
(108, '2023_03_21_175157_create_blog_categories_table', 1),
(109, '2023_03_21_175231_create_blog_tags_table', 1),
(110, '2023_03_21_175251_create_blog_comments_table', 1),
(111, '2023_05_26_213105_create_wishlist_items_table', 1),
(112, '2023_05_26_213120_create_compare_items_table', 1),
(113, '2023_06_27_163529_rename_product_review_images_to_product_review_attachments', 1),
(114, '2023_07_06_140013_add_logo_path_column_to_locales', 1),
(115, '2023_07_10_184256_create_theme_customizations_table', 1),
(116, '2023_07_12_181722_remove_home_page_and_footer_content_column_from_channel_translations_table', 1),
(117, '2023_07_20_185324_add_column_column_in_attribute_groups_table', 1),
(118, '2023_07_25_145943_add_regex_column_in_attributes_table', 1),
(119, '2023_07_25_165945_drop_notes_column_from_customers_table', 1),
(120, '2023_07_25_171058_create_customer_notes_table', 1),
(121, '2023_07_31_125232_rename_image_and_category_banner_columns_from_categories_table', 1),
(122, '2023_09_15_170053_create_theme_customization_translations_table', 1),
(123, '2023_09_20_102031_add_default_value_column_in_attributes_table', 1),
(124, '2023_09_20_102635_add_inventories_group_in_attribute_groups_table', 1),
(125, '2023_09_26_155709_add_columns_to_currencies', 1),
(126, '2023_10_05_163612_create_visits_table', 1),
(127, '2023_10_12_090446_add_tax_category_id_column_in_order_items_table', 1),
(128, '2023_11_08_054614_add_code_column_in_attribute_groups_table', 1),
(129, '2023_11_08_140116_create_search_terms_table', 1),
(130, '2023_11_09_162805_create_url_rewrites_table', 1),
(131, '2023_11_17_150401_create_search_synonyms_table', 1),
(132, '2023_12_11_054614_add_channel_id_column_in_product_price_indices_table', 1),
(133, '2024_01_11_154640_create_imports_table', 1),
(134, '2024_01_11_154741_create_import_batches_table', 1),
(135, '2024_01_19_170350_add_unique_id_column_in_product_attribute_values_table', 1),
(136, '2024_01_19_170350_add_unique_id_column_in_product_customer_group_prices_table', 1),
(137, '2024_01_22_170814_add_unique_index_in_mapping_tables', 1),
(138, '2024_02_26_153000_add_columns_to_addresses_table', 1),
(139, '2024_03_07_193421_rename_address1_column_in_addresses_table', 1),
(140, '2024_04_16_144400_add_cart_id_column_in_cart_shipping_rates_table', 1),
(141, '2024_04_19_102939_add_incl_tax_columns_in_orders_table', 1),
(142, '2024_04_19_135405_add_incl_tax_columns_in_cart_items_table', 1),
(143, '2024_04_19_144641_add_incl_tax_columns_in_order_items_table', 1),
(144, '2024_04_23_133154_add_incl_tax_columns_in_cart_table', 1),
(145, '2024_04_23_150945_add_incl_tax_columns_in_cart_shipping_rates_table', 1),
(146, '2024_04_24_102939_add_incl_tax_columns_in_invoices_table', 1),
(147, '2024_04_24_102939_add_incl_tax_columns_in_refunds_table', 1),
(148, '2024_04_24_144641_add_incl_tax_columns_in_invoice_items_table', 1),
(149, '2024_04_24_144641_add_incl_tax_columns_in_refund_items_table', 1),
(150, '2024_04_24_144641_add_incl_tax_columns_in_shipment_items_table', 1),
(151, '2024_05_10_152848_create_saved_filters_table', 1),
(152, '2024_06_03_174128_create_product_channels_table', 1),
(153, '2024_06_04_130527_add_channel_id_column_in_customers_table', 1),
(154, '2024_06_04_134403_add_channel_id_column_in_visits_table', 1),
(155, '2024_06_13_184426_add_theme_column_into_theme_customizations_table', 1),
(156, '2024_07_17_172645_add_additional_column_to_sitemaps_table', 1),
(157, '2024_10_11_135010_create_product_customizable_options_table', 1),
(158, '2024_10_11_135110_create_product_customizable_option_translations_table', 1),
(159, '2024_10_11_135228_create_product_customizable_option_prices_table', 1),
(160, '2024_12_21_115000_add_missing_columns_to_users_table', 1),
(161, '2024_12_21_115001_add_missing_columns_to_products_table', 1),
(162, '2024_12_21_115003_add_missing_columns_to_orders_table', 1),
(163, '2024_12_21_115007_create_payment_methods_table', 1),
(164, '2024_12_21_115008_create_delivery_partners_table', 1),
(165, '2024_12_29_000001_create_pathao_orders_table', 1),
(166, '2024_12_29_000002_create_pathao_tracking_history_table', 1),
(167, '2024_12_29_000003_add_pathao_fields_to_orders_table', 1),
(168, '2025_05_07_121250_update_total_weight_columns_in_shipments_and_weight_shipment_items_tables', 1),
(169, '2025_09_05_000100_add_indexes_to_channels_tables', 1),
(170, '2025_09_05_000200_add_indexes_to_product_relation_tables', 1),
(171, '2025_09_05_000300_add_indexes_to_product_media_and_attributes', 1),
(172, '2025_09_05_000400_add_indexes_to_attributes_and_product_types', 1),
(173, '2025_09_05_000500_add_indexes_to_product_grouped_products_and_product_bundle_option_products', 1),
(174, '2025_09_05_000500_add_indexes_to_url_rewrites_and_visits', 1),
(175, '2026_01_04_095800_remove_description_column_from_products_table', 1),
(176, '2026_01_05_113000_remove_name_column_from_products_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `order_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `read`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'order', 0, 3, '2026-01-05 17:11:59', '2026-01-05 17:11:59'),
(2, 'order', 0, 4, '2026-01-05 17:22:51', '2026-01-05 17:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `increment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_guest` tinyint(1) DEFAULT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_gift` tinyint(1) NOT NULL DEFAULT '0',
  `total_item_count` int(11) DEFAULT NULL,
  `total_qty_ordered` int(11) DEFAULT NULL,
  `base_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` decimal(12,4) DEFAULT '0.0000',
  `base_grand_total` decimal(12,4) DEFAULT '0.0000',
  `grand_total_invoiced` decimal(12,4) DEFAULT '0.0000',
  `base_grand_total_invoiced` decimal(12,4) DEFAULT '0.0000',
  `grand_total_refunded` decimal(12,4) DEFAULT '0.0000',
  `base_grand_total_refunded` decimal(12,4) DEFAULT '0.0000',
  `sub_total` decimal(12,4) DEFAULT '0.0000',
  `base_sub_total` decimal(12,4) DEFAULT '0.0000',
  `sub_total_invoiced` decimal(12,4) DEFAULT '0.0000',
  `base_sub_total_invoiced` decimal(12,4) DEFAULT '0.0000',
  `sub_total_refunded` decimal(12,4) DEFAULT '0.0000',
  `base_sub_total_refunded` decimal(12,4) DEFAULT '0.0000',
  `discount_percent` decimal(12,4) DEFAULT '0.0000',
  `discount_amount` decimal(12,4) DEFAULT '0.0000',
  `base_discount_amount` decimal(12,4) DEFAULT '0.0000',
  `discount_invoiced` decimal(12,4) DEFAULT '0.0000',
  `base_discount_invoiced` decimal(12,4) DEFAULT '0.0000',
  `discount_refunded` decimal(12,4) DEFAULT '0.0000',
  `base_discount_refunded` decimal(12,4) DEFAULT '0.0000',
  `tax_amount` decimal(12,4) DEFAULT '0.0000',
  `base_tax_amount` decimal(12,4) DEFAULT '0.0000',
  `tax_amount_invoiced` decimal(12,4) DEFAULT '0.0000',
  `base_tax_amount_invoiced` decimal(12,4) DEFAULT '0.0000',
  `tax_amount_refunded` decimal(12,4) DEFAULT '0.0000',
  `base_tax_amount_refunded` decimal(12,4) DEFAULT '0.0000',
  `shipping_amount` decimal(12,4) DEFAULT '0.0000',
  `base_shipping_amount` decimal(12,4) DEFAULT '0.0000',
  `shipping_invoiced` decimal(12,4) DEFAULT '0.0000',
  `base_shipping_invoiced` decimal(12,4) DEFAULT '0.0000',
  `shipping_refunded` decimal(12,4) DEFAULT '0.0000',
  `base_shipping_refunded` decimal(12,4) DEFAULT '0.0000',
  `shipping_discount_amount` decimal(12,4) DEFAULT '0.0000',
  `base_shipping_discount_amount` decimal(12,4) DEFAULT '0.0000',
  `shipping_tax_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_shipping_tax_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `shipping_tax_refunded` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_shipping_tax_refunded` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `sub_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_sub_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `shipping_amount_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_shipping_amount_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_id` int(10) UNSIGNED DEFAULT NULL,
  `channel_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `pathao_consignment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pathao_tracking_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `applied_cart_rule_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total_amount`, `increment_id`, `status`, `channel_name`, `is_guest`, `customer_email`, `customer_first_name`, `customer_last_name`, `shipping_method`, `shipping_title`, `shipping_description`, `coupon_code`, `is_gift`, `total_item_count`, `total_qty_ordered`, `base_currency_code`, `channel_currency_code`, `order_currency_code`, `grand_total`, `base_grand_total`, `grand_total_invoiced`, `base_grand_total_invoiced`, `grand_total_refunded`, `base_grand_total_refunded`, `sub_total`, `base_sub_total`, `sub_total_invoiced`, `base_sub_total_invoiced`, `sub_total_refunded`, `base_sub_total_refunded`, `discount_percent`, `discount_amount`, `base_discount_amount`, `discount_invoiced`, `base_discount_invoiced`, `discount_refunded`, `base_discount_refunded`, `tax_amount`, `base_tax_amount`, `tax_amount_invoiced`, `base_tax_amount_invoiced`, `tax_amount_refunded`, `base_tax_amount_refunded`, `shipping_amount`, `base_shipping_amount`, `shipping_invoiced`, `base_shipping_invoiced`, `shipping_refunded`, `base_shipping_refunded`, `shipping_discount_amount`, `base_shipping_discount_amount`, `shipping_tax_amount`, `base_shipping_tax_amount`, `shipping_tax_refunded`, `base_shipping_tax_refunded`, `sub_total_incl_tax`, `base_sub_total_incl_tax`, `shipping_amount_incl_tax`, `base_shipping_amount_incl_tax`, `customer_id`, `customer_type`, `channel_id`, `channel_type`, `cart_id`, `pathao_consignment_id`, `pathao_tracking_enabled`, `applied_cart_rule_ids`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0.00, '1', 'pending', 'Default', 0, NULL, NULL, NULL, 'free_free', 'Free Shipping', NULL, NULL, 0, 1, 1, 'USD', 'USD', 'USD', 2078.0000, 2078.0000, 2078.0000, 2078.0000, 2078.0000, 0.0000, 2078.0000, 2078.0000, 2078.0000, 2078.0000, 2078.0000, 2078.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, 'Webkul\\Customer\\Models\\Customer', 1, 'Webkul\\Core\\Models\\Channel', 0, NULL, 0, NULL, '2026-01-05 15:36:53', '2026-01-05 15:36:53', NULL),
(3, 0.00, '2', 'completed', 'Default', 1, 'ashrafulinstasure@gmail.com', 'Giselle', 'Raymond', 'free_free', 'Free Shipping - Free Shipping', 'Free Shipping', NULL, 0, 1, 2, 'USD', 'USD', 'USD', 240.0000, 240.0000, 0.0000, 0.0000, 0.0000, 0.0000, 240.0000, 240.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 240.0000, 240.0000, 0.0000, 0.0000, NULL, NULL, 1, 'Webkul\\Core\\Models\\Channel', 1, 'DT0501264H8BDC', 1, NULL, '2026-01-05 17:11:55', '2026-01-05 17:21:22', NULL),
(4, 0.00, '4', 'completed', 'Default', 0, 'ashrafulinstasure@gmail.com', 'Md.Asharful', 'Momen', 'free_free', 'Free Shipping - Free Shipping', 'Free Shipping', NULL, 0, 1, 1, 'USD', 'USD', 'USD', 120.0000, 120.0000, 120.0000, 120.0000, 0.0000, 0.0000, 120.0000, 120.0000, 120.0000, 120.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 120.0000, 120.0000, 0.0000, 0.0000, 6, 'Webkul\\Customer\\Models\\Customer', 1, 'Webkul\\Core\\Models\\Channel', 2, 'DT050126VZMZNX', 1, NULL, '2026-01-05 17:22:47', '2026-01-05 17:23:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_comments`
--

CREATE TABLE `order_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_notified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` decimal(12,4) DEFAULT '0.0000',
  `total_weight` decimal(12,4) DEFAULT '0.0000',
  `qty_ordered` int(11) DEFAULT '0',
  `qty_shipped` int(11) DEFAULT '0',
  `qty_invoiced` int(11) DEFAULT '0',
  `qty_canceled` int(11) DEFAULT '0',
  `qty_refunded` int(11) DEFAULT '0',
  `price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_total` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `total_invoiced` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_total_invoiced` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `amount_refunded` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_amount_refunded` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `discount_percent` decimal(12,4) DEFAULT '0.0000',
  `discount_amount` decimal(12,4) DEFAULT '0.0000',
  `base_discount_amount` decimal(12,4) DEFAULT '0.0000',
  `discount_invoiced` decimal(12,4) DEFAULT '0.0000',
  `base_discount_invoiced` decimal(12,4) DEFAULT '0.0000',
  `discount_refunded` decimal(12,4) DEFAULT '0.0000',
  `base_discount_refunded` decimal(12,4) DEFAULT '0.0000',
  `tax_percent` decimal(12,4) DEFAULT '0.0000',
  `tax_amount` decimal(12,4) DEFAULT '0.0000',
  `base_tax_amount` decimal(12,4) DEFAULT '0.0000',
  `tax_amount_invoiced` decimal(12,4) DEFAULT '0.0000',
  `base_tax_amount_invoiced` decimal(12,4) DEFAULT '0.0000',
  `tax_amount_refunded` decimal(12,4) DEFAULT '0.0000',
  `base_tax_amount_refunded` decimal(12,4) DEFAULT '0.0000',
  `price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `tax_category_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `additional` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `sku`, `type`, `name`, `coupon_code`, `weight`, `total_weight`, `qty_ordered`, `qty_shipped`, `qty_invoiced`, `qty_canceled`, `qty_refunded`, `price`, `base_price`, `total`, `base_total`, `total_invoiced`, `base_total_invoiced`, `amount_refunded`, `base_amount_refunded`, `discount_percent`, `discount_amount`, `base_discount_amount`, `discount_invoiced`, `base_discount_invoiced`, `discount_refunded`, `base_discount_refunded`, `tax_percent`, `tax_amount`, `base_tax_amount`, `tax_amount_invoiced`, `base_tax_amount_invoiced`, `tax_amount_refunded`, `base_tax_amount_refunded`, `price_incl_tax`, `base_price_incl_tax`, `total_incl_tax`, `base_total_incl_tax`, `product_id`, `product_type`, `order_id`, `tax_category_id`, `parent_id`, `additional`, `created_at`, `updated_at`) VALUES
(1, '101', 'simple', '', NULL, 1.0000, 2.0000, 2, 2, 0, 0, 0, 120.0000, 120.0000, 240.0000, 240.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 120.0000, 120.0000, 240.0000, 240.0000, 2, 'Webkul\\Product\\Models\\Product', 3, NULL, NULL, '{\"locale\": \"bn\", \"cart_id\": 1, \"quantity\": 2, \"is_buy_now\": \"0\", \"product_id\": \"2\"}', '2026-01-05 17:11:55', '2026-01-05 17:21:04'),
(2, '101', 'simple', '', NULL, 1.0000, 1.0000, 1, 1, 1, 0, 0, 120.0000, 120.0000, 120.0000, 120.0000, 120.0000, 120.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 120.0000, 120.0000, 120.0000, 120.0000, 2, 'Webkul\\Product\\Models\\Product', 4, NULL, NULL, '{\"locale\": \"en\", \"cart_id\": 2, \"quantity\": 1, \"is_buy_now\": \"0\", \"product_id\": \"2\"}', '2026-01-05 17:22:47', '2026-01-05 17:23:23');

-- --------------------------------------------------------

--
-- Table structure for table `order_payment`
--

CREATE TABLE `order_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_payment`
--

INSERT INTO `order_payment` (`id`, `order_id`, `method`, `method_title`, `additional`, `created_at`, `updated_at`) VALUES
(1, 3, 'cashondelivery', 'Cash On Delivery', NULL, '2026-01-05 17:11:55', '2026-01-05 17:11:55'),
(2, 4, 'cashondelivery', 'Cash On Delivery', NULL, '2026-01-05 17:22:47', '2026-01-05 17:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `order_transactions`
--

CREATE TABLE `order_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(12,4) DEFAULT '0.0000',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` json DEFAULT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_transactions`
--

INSERT INTO `order_transactions` (`id`, `transaction_id`, `status`, `type`, `amount`, `payment_method`, `data`, `invoice_id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, '758aa333eec0f0a2b152a5f4ed5b651d', 'paid', 'cashondelivery', 120.0000, 'cashondelivery', NULL, 1, 4, '2026-01-05 17:23:23', '2026-01-05 17:23:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pathao_orders`
--

CREATE TABLE `pathao_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `consignment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `order_status_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `recipient_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_address` text COLLATE utf8mb4_unicode_ci,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `tracking_data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pathao_orders`
--

INSERT INTO `pathao_orders` (`id`, `order_id`, `consignment_id`, `merchant_order_id`, `store_id`, `order_status`, `order_status_slug`, `delivery_fee`, `recipient_name`, `recipient_phone`, `recipient_address`, `latitude`, `longitude`, `tracking_data`, `created_at`, `updated_at`) VALUES
(1, 3, 'DT0501264H8BDC', '3', '149442', 'Pending', 'pending', 60.00, 'Giselle Raymond', '01859385787', 'Consequatur labore c, Aliquid vel voluptas, In voluptatibus aspe, 1216, SA', NULL, NULL, '{\"code\": 200, \"data\": {\"delivery_fee\": 60, \"order_status\": \"Pending\", \"consignment_id\": \"DT0501264H8BDC\", \"merchant_order_id\": \"3\"}, \"type\": \"success\", \"message\": \"Order Created Successfully\"}', '2026-01-05 17:21:09', '2026-01-05 17:21:09'),
(2, 4, 'DT050126VZMZNX', '4', '149442', 'Pending', 'pending', 60.00, 'Gay Aguirre', '01859385787', 'Est magnam soluta ve, Consequatur Perfere, Illum ad lorem volu, 1216, SI', NULL, NULL, '{\"code\": 200, \"data\": {\"delivery_fee\": 60, \"order_status\": \"Pending\", \"consignment_id\": \"DT050126VZMZNX\", \"merchant_order_id\": \"4\"}, \"type\": \"success\", \"message\": \"Order Created Successfully\"}', '2026-01-05 17:23:16', '2026-01-05 17:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `pathao_tracking_history`
--

CREATE TABLE `pathao_tracking_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pathao_order_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `location_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `timestamp` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` text COLLATE utf8mb4_unicode_ci,
  `base_price` decimal(10,2) NOT NULL,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `cost_price` decimal(10,2) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `attribute_family_id` int(10) UNSIGNED DEFAULT NULL,
  `additional` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name_bn`, `description_bn`, `base_price`, `compare_price`, `cost_price`, `stock_quantity`, `is_active`, `type`, `parent_id`, `attribute_family_id`, `additional`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '101', NULL, NULL, 0.00, NULL, NULL, 0, 1, 'simple', NULL, 1, NULL, '2026-01-05 13:29:07', '2026-01-05 13:29:07', NULL),
(3, 'a86feb96-0d72-3ede-8eb7-c5ecbb64f243', NULL, NULL, 0.00, NULL, NULL, 0, 1, '', NULL, 1, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52', NULL),
(4, 'a31cb0f5-5643-3f94-95f4-7f150bb2559c', NULL, NULL, 0.00, NULL, NULL, 0, 1, '', NULL, 1, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52', NULL),
(5, 'a231971d-3577-3386-b45e-b21e3e0489f0', NULL, NULL, 0.00, NULL, NULL, 0, 1, '', NULL, 1, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52', NULL),
(6, 'd968e11f-9f99-3bff-89c8-878f7ae4ce9f', NULL, NULL, 0.00, NULL, NULL, 0, 1, '', NULL, 1, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52', NULL),
(7, '1338e22c-1011-3b71-a645-4a1e772ad023', NULL, NULL, 0.00, NULL, NULL, 0, 1, '', NULL, 1, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52', NULL),
(8, 'e9fe94c5-43d5-3634-a7a4-d2b62febf1e9', NULL, NULL, 0.00, NULL, NULL, 0, 1, '', NULL, 1, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52', NULL),
(9, '39823871-98ff-317d-8d41-fa457fce1dc9', NULL, NULL, 0.00, NULL, NULL, 0, 1, '', NULL, 1, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52', NULL),
(10, '2cbb2119-2640-3204-b8a3-11fa8cf797ad', NULL, NULL, 0.00, NULL, NULL, 0, 1, '', NULL, 1, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52', NULL),
(11, '14a7c406-2759-34c3-adda-ca31666d3ed9', NULL, NULL, 0.00, NULL, NULL, 0, 1, '', NULL, 1, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52', NULL),
(12, 'c0b9deb7-c106-382d-b53a-8d5e6ae4168b', NULL, NULL, 0.00, NULL, NULL, 0, 1, '', NULL, 1, NULL, '2026-01-05 15:36:52', '2026-01-05 15:36:52', NULL),
(13, '102', NULL, NULL, 0.00, NULL, NULL, 0, 1, 'simple', NULL, 1, NULL, '2026-01-06 14:23:49', '2026-01-06 14:39:54', NULL),
(14, '103', NULL, NULL, 0.00, NULL, NULL, 0, 1, 'simple', NULL, 1, NULL, '2026-01-06 15:04:07', '2026-01-06 15:04:07', NULL),
(15, '104', NULL, NULL, 0.00, NULL, NULL, 0, 1, 'simple', NULL, 1, NULL, '2026-01-06 15:08:20', '2026-01-06 15:08:20', NULL),
(16, '105', NULL, NULL, 0.00, NULL, NULL, 0, 1, 'simple', NULL, 1, NULL, '2026-01-06 15:36:06', '2026-01-06 15:36:06', NULL),
(17, '106', NULL, NULL, 0.00, NULL, NULL, 0, 1, 'simple', NULL, 1, NULL, '2026-01-06 15:45:19', '2026-01-06 15:45:19', NULL),
(18, '107', NULL, NULL, 0.00, NULL, NULL, 0, 1, 'simple', NULL, 1, NULL, '2026-01-06 15:52:31', '2026-01-06 15:52:31', NULL),
(19, '108', NULL, NULL, 0.00, NULL, NULL, 0, 1, 'simple', NULL, 1, NULL, '2026-01-06 15:55:26', '2026-01-06 15:55:26', NULL),
(20, '109', NULL, NULL, 0.00, NULL, NULL, 0, 1, 'simple', NULL, 1, NULL, '2026-01-06 16:02:30', '2026-01-06 16:02:30', NULL),
(21, '110', NULL, NULL, 0.00, NULL, NULL, 0, 1, 'simple', NULL, 1, NULL, '2026-01-06 16:06:00', '2026-01-06 16:06:00', NULL),
(22, '111', NULL, NULL, 0.00, NULL, NULL, 0, 1, 'simple', NULL, 1, NULL, '2026-01-06 16:08:58', '2026-01-06 16:08:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_values`
--

CREATE TABLE `product_attribute_values` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_value` text COLLATE utf8mb4_unicode_ci,
  `boolean_value` tinyint(1) DEFAULT NULL,
  `integer_value` int(11) DEFAULT NULL,
  `float_value` decimal(12,4) DEFAULT NULL,
  `datetime_value` datetime DEFAULT NULL,
  `date_value` date DEFAULT NULL,
  `json_value` json DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute_values`
--

INSERT INTO `product_attribute_values` (`id`, `locale`, `channel`, `text_value`, `boolean_value`, `integer_value`, `float_value`, `datetime_value`, `date_value`, `json_value`, `product_id`, `attribute_id`, `unique_id`) VALUES
(1, 'en', NULL, '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 2, 9, 'en|2|9'),
(2, 'en', NULL, '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 2, 10, 'en|2|10'),
(3, NULL, NULL, '101', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2|1'),
(4, 'en', NULL, 'Weet Sweets', NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, 'en|2|2'),
(5, 'en', NULL, 'weet-sweets', NULL, NULL, NULL, NULL, NULL, NULL, 2, 3, 'en|2|3'),
(6, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, 2, 23, '2|23'),
(7, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, 2, 24, '2|24'),
(8, NULL, NULL, 'Sweets', NULL, NULL, NULL, NULL, NULL, NULL, 2, 27, '2|27'),
(9, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 2, 28, 'default|2|28'),
(10, 'en', NULL, 'Delicious Traditional Sweets | Indulge in Authentic Flavors', NULL, NULL, NULL, NULL, NULL, NULL, 2, 16, 'en|2|16'),
(11, 'en', NULL, 'traditional sweets, wet sweets, dry sweets, gulab jamun, rasmalai, turkish delight, indian sweets, middle eastern sweets, sweet treats, gourmet sweets', NULL, NULL, NULL, NULL, NULL, NULL, 2, 17, 'en|2|17'),
(12, 'en', NULL, 'Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!', NULL, NULL, NULL, NULL, NULL, NULL, 2, 18, 'en|2|18'),
(13, NULL, NULL, NULL, NULL, NULL, 120.0000, NULL, NULL, NULL, 2, 11, '2|11'),
(14, NULL, NULL, NULL, NULL, NULL, 100.0000, NULL, NULL, NULL, 2, 12, '2|12'),
(15, NULL, NULL, NULL, NULL, NULL, 110.0000, NULL, NULL, NULL, 2, 13, '2|13'),
(16, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-06', NULL, 2, 14, 'default|2|14'),
(17, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 2, 15, 'default|2|15'),
(18, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 2, 5, '2|5'),
(19, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 2, 6, '2|6'),
(20, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 2, 7, '2|7'),
(21, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 2, 8, 'default|2|8'),
(22, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 2, 26, '2|26'),
(23, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 2, 19, '2|19'),
(24, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 2, 20, '2|20'),
(25, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 2, 21, '2|21'),
(26, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 2, 22, '2|22'),
(27, 'bn', NULL, '<p>মিষ্টি</p>', NULL, NULL, NULL, NULL, NULL, NULL, 2, 9, 'bn|2|9'),
(28, 'bn', NULL, '<p>মিষ্টি</p>', NULL, NULL, NULL, NULL, NULL, NULL, 2, 10, 'bn|2|10'),
(29, 'bn', NULL, 'মিষ্টি', NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, 'bn|2|2'),
(30, 'bn', NULL, 'sweets', NULL, NULL, NULL, NULL, NULL, NULL, 2, 3, 'bn|2|3'),
(31, 'bn', NULL, 'মিষ্টি', NULL, NULL, NULL, NULL, NULL, NULL, 2, 16, 'bn|2|16'),
(32, 'bn', NULL, 'মিষ্টি', NULL, NULL, NULL, NULL, NULL, NULL, 2, 17, 'bn|2|17'),
(33, 'bn', NULL, 'মিষ্টি', NULL, NULL, NULL, NULL, NULL, NULL, 2, 18, 'bn|2|18'),
(34, 'en', NULL, '<p>Indulge in our delicious range of wet sweets, crafted with traditional flavors and fresh ingredients. From soft gulab jamun to rich rasmalai and Turkish delights, each sweet is a perfect blend of sweetness and texture, guaranteed to satisfy your cravings for a truly authentic treat.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 13, 9, 'en|13|9'),
(35, 'en', NULL, '<p>Indulge in our delicious range of wet sweets, crafted with traditional flavors and fresh ingredients. From soft gulab jamun to rich rasmalai and Turkish delights, each sweet is a perfect blend of sweetness and texture, guaranteed to satisfy your cravings for a truly authentic treat.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 13, 10, 'en|13|10'),
(36, NULL, NULL, '102', NULL, NULL, NULL, NULL, NULL, NULL, 13, 1, '13|1'),
(37, 'en', NULL, 'Weet Sweet', NULL, NULL, NULL, NULL, NULL, NULL, 13, 2, 'en|13|2'),
(38, 'en', NULL, 'weet-sweet', NULL, NULL, NULL, NULL, NULL, NULL, 13, 3, 'en|13|3'),
(39, 'en', 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 13, 29, 'default|en|13|29'),
(40, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 13, 28, 'default|13|28'),
(41, 'en', NULL, 'Delicious Traditional Sweets | Indulge in Authentic Flavors', NULL, NULL, NULL, NULL, NULL, NULL, 13, 16, 'en|13|16'),
(42, 'en', NULL, 'traditional sweets, wet sweets, dry sweets, gulab jamun, rasmalai, turkish delight, indian sweets, middle eastern sweets, sweet treats, gourmet sweets', NULL, NULL, NULL, NULL, NULL, NULL, 13, 17, 'en|13|17'),
(43, 'en', NULL, 'Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!', NULL, NULL, NULL, NULL, NULL, NULL, 13, 18, 'en|13|18'),
(44, NULL, NULL, NULL, NULL, NULL, 220.0000, NULL, NULL, NULL, 13, 11, '13|11'),
(45, NULL, NULL, NULL, NULL, NULL, 200.0000, NULL, NULL, NULL, 13, 12, '13|12'),
(46, NULL, NULL, NULL, NULL, NULL, 210.0000, NULL, NULL, NULL, 13, 13, '13|13'),
(47, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-06', NULL, 13, 14, 'default|13|14'),
(48, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 13, 15, 'default|13|15'),
(49, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 13, 27, '13|27'),
(50, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 13, 5, '13|5'),
(51, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 13, 6, '13|6'),
(52, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 13, 7, '13|7'),
(53, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 13, 8, 'default|13|8'),
(54, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 13, 26, '13|26'),
(55, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 13, 19, '13|19'),
(56, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 13, 20, '13|20'),
(57, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 13, 21, '13|21'),
(58, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 13, 22, '13|22'),
(59, 'en', 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 2, 29, 'default|en|2|29'),
(60, 'en', NULL, '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 14, 9, 'en|14|9'),
(61, 'en', NULL, '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 14, 10, 'en|14|10'),
(62, NULL, NULL, '103', NULL, NULL, NULL, NULL, NULL, NULL, 14, 1, '14|1'),
(63, 'en', NULL, 'Dry Sweet', NULL, NULL, NULL, NULL, NULL, NULL, 14, 2, 'en|14|2'),
(64, 'en', NULL, 'dry-sweet', NULL, NULL, NULL, NULL, NULL, NULL, 14, 3, 'en|14|3'),
(65, 'en', 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 14, 29, 'default|en|14|29'),
(66, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 14, 28, 'default|14|28'),
(67, 'en', NULL, 'Delicious Traditional Sweets | Indulge in Authentic Flavors', NULL, NULL, NULL, NULL, NULL, NULL, 14, 16, 'en|14|16'),
(68, 'en', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 14, 17, 'en|14|17'),
(69, 'en', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 14, 18, 'en|14|18'),
(70, NULL, NULL, NULL, NULL, NULL, 330.0000, NULL, NULL, NULL, 14, 11, '14|11'),
(71, NULL, NULL, NULL, NULL, NULL, 300.0000, NULL, NULL, NULL, 14, 12, '14|12'),
(72, NULL, NULL, NULL, NULL, NULL, 320.0000, NULL, NULL, NULL, 14, 13, '14|13'),
(73, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-06', NULL, 14, 14, 'default|14|14'),
(74, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 14, 15, 'default|14|15'),
(75, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 14, 27, '14|27'),
(76, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 14, 5, '14|5'),
(77, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 14, 6, '14|6'),
(78, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 14, 7, '14|7'),
(79, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 14, 8, 'default|14|8'),
(80, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 14, 26, '14|26'),
(81, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 14, 19, '14|19'),
(82, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 14, 20, '14|20'),
(83, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 14, 21, '14|21'),
(84, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 14, 22, '14|22'),
(85, 'en', NULL, '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 15, 9, 'en|15|9'),
(86, 'en', NULL, '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 15, 10, 'en|15|10'),
(87, NULL, NULL, '104', NULL, NULL, NULL, NULL, NULL, NULL, 15, 1, '15|1'),
(88, 'en', NULL, 'Testy Sweets', NULL, NULL, NULL, NULL, NULL, NULL, 15, 2, 'en|15|2'),
(89, 'en', NULL, 'testy-sweets', NULL, NULL, NULL, NULL, NULL, NULL, 15, 3, 'en|15|3'),
(90, 'en', 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 15, 29, 'default|en|15|29'),
(91, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 15, 28, 'default|15|28'),
(92, 'en', NULL, 'Delicious Traditional Sweets | Indulge in Authentic Flavors', NULL, NULL, NULL, NULL, NULL, NULL, 15, 16, 'en|15|16'),
(93, 'en', NULL, 'traditional sweets, wet sweets, dry sweets, gulab jamun, rasmalai, turkish delight, indian sweets, middle eastern sweets, sweet treats, gourmet sweets', NULL, NULL, NULL, NULL, NULL, NULL, 15, 17, 'en|15|17'),
(94, 'en', NULL, 'Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!', NULL, NULL, NULL, NULL, NULL, NULL, 15, 18, 'en|15|18'),
(95, NULL, NULL, NULL, NULL, NULL, 550.0000, NULL, NULL, NULL, 15, 11, '15|11'),
(96, NULL, NULL, NULL, NULL, NULL, 500.0000, NULL, NULL, NULL, 15, 12, '15|12'),
(97, NULL, NULL, NULL, NULL, NULL, 540.0000, NULL, NULL, NULL, 15, 13, '15|13'),
(98, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-06', NULL, 15, 14, 'default|15|14'),
(99, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 15, 15, 'default|15|15'),
(100, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 15, 27, '15|27'),
(101, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 15, 5, '15|5'),
(102, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 15, 6, '15|6'),
(103, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 15, 7, '15|7'),
(104, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 15, 8, 'default|15|8'),
(105, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 15, 26, '15|26'),
(106, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 15, 19, '15|19'),
(107, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 15, 20, '15|20'),
(108, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 15, 21, '15|21'),
(109, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 15, 22, '15|22'),
(110, 'en', NULL, '<p>Explore our delightful selection of fresh pastries, perfect for any event or sweet craving. From buttery croissants to colorful fruit tarts and decadent puff pastries, our treats offer a rich, indulgent experience. Perfect for breakfast, afternoon tea, or any special occasion. Try our selection of premium pastries for a taste of luxury!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 16, 9, 'en|16|9'),
(111, 'en', NULL, '<p>Explore our delightful selection of fresh pastries, perfect for any event or sweet craving. From buttery croissants to colorful fruit tarts and decadent puff pastries, our treats offer a rich, indulgent experience. Perfect for breakfast, afternoon tea, or any special occasion. Try our selection of premium pastries for a taste of luxury!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 16, 10, 'en|16|10'),
(112, NULL, NULL, '105', NULL, NULL, NULL, NULL, NULL, NULL, 16, 1, '16|1'),
(113, 'en', NULL, 'Pastry', NULL, NULL, NULL, NULL, NULL, NULL, 16, 2, 'en|16|2'),
(114, 'en', NULL, 'pastry-food', NULL, NULL, NULL, NULL, NULL, NULL, 16, 3, 'en|16|3'),
(115, 'en', 'default', NULL, NULL, NULL, NULL, NULL, '2026-02-05', NULL, 16, 29, 'default|en|16|29'),
(116, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 16, 28, 'default|16|28'),
(117, 'en', NULL, 'Indulge in Fresh & Delicious Pastries | Perfect for Every Occasion', NULL, NULL, NULL, NULL, NULL, NULL, 16, 16, 'en|16|16'),
(118, 'en', NULL, 'fresh pastries, gourmet pastries, sweet pastries, croissants, tarts, puff pastries, fruit pastries, pastry shop, bakery pastries, pastry desserts', NULL, NULL, NULL, NULL, NULL, NULL, 16, 17, 'en|16|17'),
(119, 'en', NULL, 'Explore our delightful selection of fresh pastries, perfect for any event or sweet craving. From buttery croissants to colorful fruit tarts and decadent puff pastries, our treats offer a rich, indulgent experience. Perfect for breakfast, afternoon tea, or any special occasion. Try our selection of premium pastries for a taste of luxury!', NULL, NULL, NULL, NULL, NULL, NULL, 16, 18, 'en|16|18'),
(120, NULL, NULL, NULL, NULL, NULL, 660.0000, NULL, NULL, NULL, 16, 11, '16|11'),
(121, NULL, NULL, NULL, NULL, NULL, 600.0000, NULL, NULL, NULL, 16, 12, '16|12'),
(122, NULL, NULL, NULL, NULL, NULL, 650.0000, NULL, NULL, NULL, 16, 13, '16|13'),
(123, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-06', NULL, 16, 14, 'default|16|14'),
(124, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 16, 15, 'default|16|15'),
(125, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 16, 27, '16|27'),
(126, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 16, 5, '16|5'),
(127, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 16, 6, '16|6'),
(128, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 16, 7, '16|7'),
(129, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 16, 8, 'default|16|8'),
(130, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 16, 26, '16|26'),
(131, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 16, 19, '16|19'),
(132, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 16, 20, '16|20'),
(133, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 16, 21, '16|21'),
(134, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 16, 22, '16|22'),
(135, 'en', NULL, '<p>Savor the taste of freshly baked muffins, perfect for breakfast, snacks, or dessert. From classic blueberry and chocolate chip muffins to hearty banana nut varieties, our muffins are baked to perfection. Whether you enjoy them warm or on-the-go, our selection offers a delicious treat for every taste!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 17, 9, 'en|17|9'),
(136, 'en', NULL, '<p>Savor the taste of freshly baked muffins, perfect for breakfast, snacks, or dessert. From classic blueberry and chocolate chip muffins to hearty banana nut varieties, our muffins are baked to perfection. Whether you enjoy them warm or on-the-go, our selection offers a delicious treat for every taste!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 17, 10, 'en|17|10'),
(137, NULL, NULL, '106', NULL, NULL, NULL, NULL, NULL, NULL, 17, 1, '17|1'),
(138, 'en', NULL, 'Muffins', NULL, NULL, NULL, NULL, NULL, NULL, 17, 2, 'en|17|2'),
(139, 'en', NULL, 'muffins-food', NULL, NULL, NULL, NULL, NULL, NULL, 17, 3, 'en|17|3'),
(140, 'en', 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 17, 29, 'default|en|17|29'),
(141, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 17, 28, 'default|17|28'),
(142, 'en', NULL, 'Fresh & Flavorful Muffins | Perfect for Breakfast & Snacks', NULL, NULL, NULL, NULL, NULL, NULL, 17, 16, 'en|17|16'),
(143, 'en', NULL, 'muffins, fresh muffins, blueberry muffins, chocolate muffins, banana nut muffins, muffins for breakfast, homemade muffins, bakery muffins, healthy muffins, muffin recipes', NULL, NULL, NULL, NULL, NULL, NULL, 17, 17, 'en|17|17'),
(144, 'en', NULL, 'Savor the taste of freshly baked muffins, perfect for breakfast, snacks, or dessert. From classic blueberry and chocolate chip muffins to hearty banana nut varieties, our muffins are baked to perfection. Whether you enjoy them warm or on-the-go, our selection offers a delicious treat for every taste!', NULL, NULL, NULL, NULL, NULL, NULL, 17, 18, 'en|17|18'),
(145, NULL, NULL, NULL, NULL, NULL, 220.0000, NULL, NULL, NULL, 17, 11, '17|11'),
(146, NULL, NULL, NULL, NULL, NULL, 200.0000, NULL, NULL, NULL, 17, 12, '17|12'),
(147, NULL, NULL, NULL, NULL, NULL, 210.0000, NULL, NULL, NULL, 17, 13, '17|13'),
(148, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-06', NULL, 17, 14, 'default|17|14'),
(149, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 17, 15, 'default|17|15'),
(150, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 17, 27, '17|27'),
(151, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 17, 5, '17|5'),
(152, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 17, 6, '17|6'),
(153, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 17, 7, '17|7'),
(154, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 17, 8, 'default|17|8'),
(155, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 17, 26, '17|26'),
(156, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 17, 19, '17|19'),
(157, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 17, 20, '17|20'),
(158, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 17, 21, '17|21'),
(159, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 17, 22, '17|22'),
(160, 'en', NULL, '<p>Indulge in our freshly baked cookies, a perfect treat for any occasion. From classic chocolate chip and peanut butter to soft oatmeal raisin and sugar cookies, our selection offers something for every cookie lover. Whether you\'re craving a sweet snack or preparing for a celebration, our cookies are sure to delight!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 18, 9, 'en|18|9'),
(161, 'en', NULL, '<p>Indulge in our freshly baked cookies, a perfect treat for any occasion. From classic chocolate chip and peanut butter to soft oatmeal raisin and sugar cookies, our selection offers something for every cookie lover. Whether you\'re craving a sweet snack or preparing for a celebration, our cookies are sure to delight!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 18, 10, 'en|18|10'),
(162, NULL, NULL, '107', NULL, NULL, NULL, NULL, NULL, NULL, 18, 1, '18|1'),
(163, 'en', NULL, 'Cookies', NULL, NULL, NULL, NULL, NULL, NULL, 18, 2, 'en|18|2'),
(164, 'en', NULL, 'cookies-food', NULL, NULL, NULL, NULL, NULL, NULL, 18, 3, 'en|18|3'),
(165, 'en', 'default', NULL, NULL, NULL, NULL, NULL, '2026-02-05', NULL, 18, 29, 'default|en|18|29'),
(166, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 18, 28, 'default|18|28'),
(167, 'en', NULL, 'Delicious Freshly Baked Cookies | A Treat for Every Occasion', NULL, NULL, NULL, NULL, NULL, NULL, 18, 16, 'en|18|16'),
(168, 'en', NULL, 'cookies, freshly baked cookies, chocolate chip cookies, peanut butter cookies, oatmeal raisin cookies, sugar cookies, homemade cookies, cookie recipes, bakery cookies, soft cookies', NULL, NULL, NULL, NULL, NULL, NULL, 18, 17, 'en|18|17'),
(169, 'en', NULL, 'Indulge in our freshly baked cookies, a perfect treat for any occasion. From classic chocolate chip and peanut butter to soft oatmeal raisin and sugar cookies, our selection offers something for every cookie lover. Whether you\'re craving a sweet snack or preparing for a celebration, our cookies are sure to delight!', NULL, NULL, NULL, NULL, NULL, NULL, 18, 18, 'en|18|18'),
(170, NULL, NULL, NULL, NULL, NULL, 350.0000, NULL, NULL, NULL, 18, 11, '18|11'),
(171, NULL, NULL, NULL, NULL, NULL, 300.0000, NULL, NULL, NULL, 18, 12, '18|12'),
(172, NULL, NULL, NULL, NULL, NULL, 340.0000, NULL, NULL, NULL, 18, 13, '18|13'),
(173, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-06', NULL, 18, 14, 'default|18|14'),
(174, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 18, 15, 'default|18|15'),
(175, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 18, 27, '18|27'),
(176, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 18, 5, '18|5'),
(177, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 18, 6, '18|6'),
(178, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 18, 7, '18|7'),
(179, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 18, 8, 'default|18|8'),
(180, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 18, 26, '18|26'),
(181, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 18, 19, '18|19'),
(182, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 18, 20, '18|20'),
(183, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 18, 21, '18|21'),
(184, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 18, 22, '18|22'),
(185, 'en', NULL, '<p>Treat yourself to our mouth-watering fresh doughnuts, available in a variety of flavors and toppings. From classic glazed and chocolate-covered doughnuts to those with colorful sprinkles and delicious fillings, our doughnuts make the perfect snack for any occasion. Sweeten your day with our irresistible doughnut selection!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 19, 9, 'en|19|9'),
(186, 'en', NULL, '<p>Treat yourself to our mouth-watering fresh doughnuts, available in a variety of flavors and toppings. From classic glazed and chocolate-covered doughnuts to those with colorful sprinkles and delicious fillings, our doughnuts make the perfect snack for any occasion. Sweeten your day with our irresistible doughnut selection!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 19, 10, 'en|19|10'),
(187, NULL, NULL, '108', NULL, NULL, NULL, NULL, NULL, NULL, 19, 1, '19|1'),
(188, 'en', NULL, 'Doughnut', NULL, NULL, NULL, NULL, NULL, NULL, 19, 2, 'en|19|2'),
(189, 'en', NULL, 'doughnut-food', NULL, NULL, NULL, NULL, NULL, NULL, 19, 3, 'en|19|3'),
(190, 'en', 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 19, 29, 'default|en|19|29'),
(191, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 19, 28, 'default|19|28'),
(192, 'en', NULL, 'Delicious Fresh Doughnuts | Sweet Treats for Every Occasion', NULL, NULL, NULL, NULL, NULL, NULL, 19, 16, 'en|19|16'),
(193, 'en', NULL, 'doughnuts, fresh doughnuts, glazed doughnuts, chocolate doughnuts, sprinkles doughnuts, filled doughnuts, doughnut recipes, bakery doughnuts, sweet doughnuts, doughnut varieties', NULL, NULL, NULL, NULL, NULL, NULL, 19, 17, 'en|19|17'),
(194, 'en', NULL, 'Treat yourself to our mouth-watering fresh doughnuts, available in a variety of flavors and toppings. From classic glazed and chocolate-covered doughnuts to those with colorful sprinkles and delicious fillings, our doughnuts make the perfect snack for any occasion. Sweeten your day with our irresistible doughnut selection!', NULL, NULL, NULL, NULL, NULL, NULL, 19, 18, 'en|19|18'),
(195, NULL, NULL, NULL, NULL, NULL, 280.0000, NULL, NULL, NULL, 19, 11, '19|11'),
(196, NULL, NULL, NULL, NULL, NULL, 220.0000, NULL, NULL, NULL, 19, 12, '19|12'),
(197, NULL, NULL, NULL, NULL, NULL, 250.0000, NULL, NULL, NULL, 19, 13, '19|13'),
(198, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-06', NULL, 19, 14, 'default|19|14'),
(199, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 19, 15, 'default|19|15'),
(200, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 19, 27, '19|27'),
(201, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 19, 5, '19|5'),
(202, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 19, 6, '19|6'),
(203, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 19, 7, '19|7'),
(204, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 19, 8, 'default|19|8'),
(205, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 19, 26, '19|26'),
(206, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 19, 19, '19|19'),
(207, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 19, 20, '19|20'),
(208, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 19, 21, '19|21'),
(209, NULL, NULL, '.25', NULL, NULL, NULL, NULL, NULL, NULL, 19, 22, '19|22'),
(210, 'en', NULL, '<p>Discover our wide range of freshly baked breads and buns, perfect for any meal or occasion. From soft hamburger buns and golden challah to artisan breads like baguettes and seeded loaves, each bite offers a delightful experience. Whether you\'re preparing a sandwich or enjoying with butter, our breads and buns are a must-have for every table.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 20, 9, 'en|20|9'),
(211, 'en', NULL, '<p>Discover our wide range of freshly baked breads and buns, perfect for any meal or occasion. From soft hamburger buns and golden challah to artisan breads like baguettes and seeded loaves, each bite offers a delightful experience. Whether you\'re preparing a sandwich or enjoying with butter, our breads and buns are a must-have for every table.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 20, 10, 'en|20|10'),
(212, NULL, NULL, '109', NULL, NULL, NULL, NULL, NULL, NULL, 20, 1, '20|1'),
(213, 'en', NULL, 'Breads & Buns', NULL, NULL, NULL, NULL, NULL, NULL, 20, 2, 'en|20|2'),
(214, 'en', NULL, 'breads-bun', NULL, NULL, NULL, NULL, NULL, NULL, 20, 3, 'en|20|3'),
(215, 'en', 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 20, 29, 'default|en|20|29'),
(216, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 20, 28, 'default|20|28'),
(217, 'en', NULL, 'Freshly Baked Breads & Buns | Perfect for Every Meal', NULL, NULL, NULL, NULL, NULL, NULL, 20, 16, 'en|20|16'),
(218, 'en', NULL, 'fresh breads, artisan bread, hamburger buns, challah bread, croissants, baguette, soft rolls, bakery buns, homemade bread, seeded bread', NULL, NULL, NULL, NULL, NULL, NULL, 20, 17, 'en|20|17'),
(219, 'en', NULL, 'Discover our wide range of freshly baked breads and buns, perfect for any meal or occasion. From soft hamburger buns and golden challah to artisan breads like baguettes and seeded loaves, each bite offers a delightful experience. Whether you\'re preparing a sandwich or enjoying with butter, our breads and buns are a must-have for every table.', NULL, NULL, NULL, NULL, NULL, NULL, 20, 18, 'en|20|18'),
(220, NULL, NULL, NULL, NULL, NULL, 440.0000, NULL, NULL, NULL, 20, 11, '20|11'),
(221, NULL, NULL, NULL, NULL, NULL, 400.0000, NULL, NULL, NULL, 20, 12, '20|12'),
(222, NULL, NULL, NULL, NULL, NULL, 435.0000, NULL, NULL, NULL, 20, 13, '20|13'),
(223, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-06', NULL, 20, 14, 'default|20|14'),
(224, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 20, 15, 'default|20|15'),
(225, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 20, 27, '20|27'),
(226, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 20, 5, '20|5'),
(227, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 20, 6, '20|6'),
(228, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 20, 7, '20|7'),
(229, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 20, 8, 'default|20|8'),
(230, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 20, 26, '20|26'),
(231, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 20, 19, '20|19'),
(232, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 20, 20, '20|20'),
(233, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 20, 21, '20|21'),
(234, NULL, NULL, '.75', NULL, NULL, NULL, NULL, NULL, NULL, 20, 22, '20|22'),
(235, 'en', NULL, '<p>Indulge in our exquisite selection of freshly baked tarts and pies, perfect for any occasion. From fruity tarts and rich chocolate delights to classic pies like apple and pecan, our tarts and pies are crafted with the finest ingredients. Whether you\'re hosting a party or enjoying a quiet dessert, these pastries are sure to impress!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 21, 9, 'en|21|9'),
(236, 'en', NULL, '<p>Indulge in our exquisite selection of freshly baked tarts and pies, perfect for any occasion. From fruity tarts and rich chocolate delights to classic pies like apple and pecan, our tarts and pies are crafted with the finest ingredients. Whether you\'re hosting a party or enjoying a quiet dessert, these pastries are sure to impress!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 21, 10, 'en|21|10'),
(237, NULL, NULL, '110', NULL, NULL, NULL, NULL, NULL, NULL, 21, 1, '21|1'),
(238, 'en', NULL, 'Tarts & Pies', NULL, NULL, NULL, NULL, NULL, NULL, 21, 2, 'en|21|2'),
(239, 'en', NULL, 'tarts-pies-food', NULL, NULL, NULL, NULL, NULL, NULL, 21, 3, 'en|21|3'),
(240, 'en', 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 21, 29, 'default|en|21|29'),
(241, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 21, 28, 'default|21|28'),
(242, 'en', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 21, 16, 'en|21|16'),
(243, 'en', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 21, 17, 'en|21|17'),
(244, 'en', NULL, 'Indulge in our exquisite selection of freshly baked tarts and pies, perfect for any occasion. From fruity tarts and rich chocolate delights to classic pies like apple and pecan, our tarts and pies are crafted with the finest ingredients. Whether you\'re hosting a party or enjoying a quiet dessert, these pastries are sure to impress!', NULL, NULL, NULL, NULL, NULL, NULL, 21, 18, 'en|21|18'),
(245, NULL, NULL, NULL, NULL, NULL, 770.0000, NULL, NULL, NULL, 21, 11, '21|11'),
(246, NULL, NULL, NULL, NULL, NULL, 700.0000, NULL, NULL, NULL, 21, 12, '21|12'),
(247, NULL, NULL, NULL, NULL, NULL, 750.0000, NULL, NULL, NULL, 21, 13, '21|13'),
(248, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-06', NULL, 21, 14, 'default|21|14'),
(249, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 21, 15, 'default|21|15'),
(250, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 21, 27, '21|27'),
(251, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 21, 5, '21|5'),
(252, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 21, 6, '21|6'),
(253, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 21, 7, '21|7'),
(254, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 21, 8, 'default|21|8'),
(255, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 21, 26, '21|26'),
(256, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 21, 19, '21|19'),
(257, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 21, 20, '21|20'),
(258, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 21, 21, '21|21'),
(259, NULL, NULL, '.88', NULL, NULL, NULL, NULL, NULL, NULL, 21, 22, '21|22'),
(260, 'en', NULL, '<p>Satisfy your sweet tooth with our premium selection of chocolates and sweets. From rich milk and dark chocolates to decadent pralines and candies, our collection offers a treat for every chocolate lover. Perfect for gifting or indulging yourself, our chocolates are crafted to deliver the ultimate sweet experience!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 22, 9, 'en|22|9'),
(261, 'en', NULL, '<p>Satisfy your sweet tooth with our premium selection of chocolates and sweets. From rich milk and dark chocolates to decadent pralines and candies, our collection offers a treat for every chocolate lover. Perfect for gifting or indulging yourself, our chocolates are crafted to deliver the ultimate sweet experience!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 22, 10, 'en|22|10'),
(262, NULL, NULL, '111', NULL, NULL, NULL, NULL, NULL, NULL, 22, 1, '22|1'),
(263, 'en', NULL, 'Chocolate', NULL, NULL, NULL, NULL, NULL, NULL, 22, 2, 'en|22|2'),
(264, 'en', NULL, 'chocolate-food', NULL, NULL, NULL, NULL, NULL, NULL, 22, 3, 'en|22|3'),
(265, 'en', 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 22, 29, 'default|en|22|29'),
(266, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 22, 28, 'default|22|28'),
(267, 'en', NULL, 'Indulge in Premium Chocolate & Sweets | A Delight for Every Taste', NULL, NULL, NULL, NULL, NULL, NULL, 22, 16, 'en|22|16'),
(268, 'en', NULL, 'chocolates, premium chocolates, milk chocolate, dark chocolate, white chocolate, pralines, candies, chocolate treats, gourmet sweets, chocolate bars', NULL, NULL, NULL, NULL, NULL, NULL, 22, 17, 'en|22|17'),
(269, 'en', NULL, 'Satisfy your sweet tooth with our premium selection of chocolates and sweets. From rich milk and dark chocolates to decadent pralines and candies, our collection offers a treat for every chocolate lover. Perfect for gifting or indulging yourself, our chocolates are crafted to deliver the ultimate sweet experience!', NULL, NULL, NULL, NULL, NULL, NULL, 22, 18, 'en|22|18'),
(270, NULL, NULL, NULL, NULL, NULL, 999.0000, NULL, NULL, NULL, 22, 11, '22|11'),
(271, NULL, NULL, NULL, NULL, NULL, 900.0000, NULL, NULL, NULL, 22, 12, '22|12'),
(272, NULL, NULL, NULL, NULL, NULL, 950.0000, NULL, NULL, NULL, 22, 13, '22|13'),
(273, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-06', NULL, 22, 14, 'default|22|14'),
(274, NULL, 'default', NULL, NULL, NULL, NULL, NULL, '2026-01-31', NULL, 22, 15, 'default|22|15'),
(275, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 22, 27, '22|27'),
(276, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 22, 5, '22|5'),
(277, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 22, 6, '22|6'),
(278, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 22, 7, '22|7'),
(279, NULL, 'default', NULL, 1, NULL, NULL, NULL, NULL, NULL, 22, 8, 'default|22|8'),
(280, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 22, 26, '22|26'),
(281, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 22, 19, '22|19'),
(282, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 22, 20, '22|20'),
(283, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 22, 21, '22|21'),
(284, NULL, NULL, '.97', NULL, NULL, NULL, NULL, NULL, NULL, 22, 22, '22|22');

-- --------------------------------------------------------

--
-- Table structure for table `product_bundle_options`
--

CREATE TABLE `product_bundle_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_bundle_option_products`
--

CREATE TABLE `product_bundle_option_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_bundle_option_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '1',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_bundle_option_translations`
--

CREATE TABLE `product_bundle_option_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_bundle_option_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`product_id`, `category_id`) VALUES
(2, 12),
(13, 12),
(14, 12),
(15, 12),
(16, 13),
(17, 14),
(18, 15),
(19, 16),
(20, 17),
(21, 18),
(22, 19);

-- --------------------------------------------------------

--
-- Table structure for table `product_channels`
--

CREATE TABLE `product_channels` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_channels`
--

INSERT INTO `product_channels` (`product_id`, `channel_id`) VALUES
(2, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_cross_sells`
--

CREATE TABLE `product_cross_sells` (
  `parent_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_customer_group_prices`
--

CREATE TABLE `product_customer_group_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `value_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_group_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_customizable_options`
--

CREATE TABLE `product_customizable_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '1',
  `max_characters` text COLLATE utf8mb4_unicode_ci,
  `supported_file_extensions` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_customizable_option_prices`
--

CREATE TABLE `product_customizable_option_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `product_customizable_option_id` int(10) UNSIGNED NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_customizable_option_translations`
--

CREATE TABLE `product_customizable_option_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` text COLLATE utf8mb4_unicode_ci,
  `product_customizable_option_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_downloadable_links`
--

CREATE TABLE `product_downloadable_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `sample_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sample_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sample_file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sample_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `downloads` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_downloadable_link_translations`
--

CREATE TABLE `product_downloadable_link_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_downloadable_link_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_downloadable_samples`
--

CREATE TABLE `product_downloadable_samples` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_downloadable_sample_translations`
--

CREATE TABLE `product_downloadable_sample_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_downloadable_sample_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_flat`
--

CREATE TABLE `product_flat` (
  `id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new` tinyint(1) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(12,4) DEFAULT NULL,
  `special_price` decimal(12,4) DEFAULT NULL,
  `special_price_from` date DEFAULT NULL,
  `special_price_to` date DEFAULT NULL,
  `weight` decimal(12,4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_family_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `visible_individually` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_flat`
--

INSERT INTO `product_flat` (`id`, `sku`, `type`, `product_number`, `name`, `short_description`, `description`, `url_key`, `new`, `featured`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `price`, `special_price`, `special_price_from`, `special_price_to`, `weight`, `created_at`, `locale`, `channel`, `attribute_family_id`, `product_id`, `updated_at`, `parent_id`, `visible_individually`) VALUES
(1, '101', 'simple', 'Sweets', 'Weet Sweets', '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', 'weet-sweets', 1, 1, 1, 'Delicious Traditional Sweets | Indulge in Authentic Flavors', 'traditional sweets, wet sweets, dry sweets, gulab jamun, rasmalai, turkish delight, indian sweets, middle eastern sweets, sweet treats, gourmet sweets', 'Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!', 120.0000, 110.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-05 13:29:07', 'en', 'default', 1, 2, '2026-01-06 14:59:17', NULL, 1),
(2, '101', 'simple', 'Sweets', 'মিষ্টি', '<p>মিষ্টি</p>', '<p>মিষ্টি</p>', 'sweets', 1, 1, 1, 'মিষ্টি', 'মিষ্টি', 'মিষ্টি', 120.0000, 110.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-05 13:29:07', 'bn', 'default', 1, 2, '2026-01-06 14:59:17', NULL, 1),
(3, '102', 'simple', '', 'Weet Sweet', '<p>Indulge in our delicious range of wet sweets, crafted with traditional flavors and fresh ingredients. From soft gulab jamun to rich rasmalai and Turkish delights, each sweet is a perfect blend of sweetness and texture, guaranteed to satisfy your cravings for a truly authentic treat.</p>', '<p>Indulge in our delicious range of wet sweets, crafted with traditional flavors and fresh ingredients. From soft gulab jamun to rich rasmalai and Turkish delights, each sweet is a perfect blend of sweetness and texture, guaranteed to satisfy your cravings for a truly authentic treat.</p>', 'weet-sweet', 1, 1, 1, 'Delicious Traditional Sweets | Indulge in Authentic Flavors', 'traditional sweets, wet sweets, dry sweets, gulab jamun, rasmalai, turkish delight, indian sweets, middle eastern sweets, sweet treats, gourmet sweets', 'Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!', 220.0000, 210.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 14:23:49', 'en', 'default', 1, 13, '2026-01-06 15:03:42', NULL, 1),
(4, '102', 'simple', '', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 220.0000, 210.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 14:23:49', 'bn', 'default', 1, 13, '2026-01-06 15:03:42', NULL, 1),
(5, '103', 'simple', '', 'Dry Sweet', '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', 'dry-sweet', 1, 1, 1, 'Delicious Traditional Sweets | Indulge in Authentic Flavors', '', '', 330.0000, 320.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 15:04:07', 'en', 'default', 1, 14, '2026-01-06 15:06:25', NULL, 1),
(6, '103', 'simple', '', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 330.0000, 320.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 15:04:07', 'bn', 'default', 1, 14, '2026-01-06 15:06:25', NULL, 1),
(7, '104', 'simple', '', 'Testy Sweets', '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', '<p>Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!</p>', 'testy-sweets', 1, 1, 1, 'Delicious Traditional Sweets | Indulge in Authentic Flavors', 'traditional sweets, wet sweets, dry sweets, gulab jamun, rasmalai, turkish delight, indian sweets, middle eastern sweets, sweet treats, gourmet sweets', 'Savor the taste of our premium sweets, ranging from indulgent wet sweets like gulab jamun and rasmalai to delightful dry sweets such as pistachio barfi and coconut laddoos. Made with the finest ingredients, each sweet is crafted to perfection, offering a true taste of tradition. Perfect for celebrations, gifting, or satisfying your sweet cravings!', 550.0000, 540.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 15:08:20', 'en', 'default', 1, 15, '2026-01-06 15:14:10', NULL, 1),
(8, '104', 'simple', '', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 550.0000, 540.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 15:08:20', 'bn', 'default', 1, 15, '2026-01-06 15:14:10', NULL, 1),
(9, '105', 'simple', '', 'Pastry', '<p>Explore our delightful selection of fresh pastries, perfect for any event or sweet craving. From buttery croissants to colorful fruit tarts and decadent puff pastries, our treats offer a rich, indulgent experience. Perfect for breakfast, afternoon tea, or any special occasion. Try our selection of premium pastries for a taste of luxury!</p>', '<p>Explore our delightful selection of fresh pastries, perfect for any event or sweet craving. From buttery croissants to colorful fruit tarts and decadent puff pastries, our treats offer a rich, indulgent experience. Perfect for breakfast, afternoon tea, or any special occasion. Try our selection of premium pastries for a taste of luxury!</p>', 'pastry-food', 1, 1, 1, 'Indulge in Fresh & Delicious Pastries | Perfect for Every Occasion', 'fresh pastries, gourmet pastries, sweet pastries, croissants, tarts, puff pastries, fruit pastries, pastry shop, bakery pastries, pastry desserts', 'Explore our delightful selection of fresh pastries, perfect for any event or sweet craving. From buttery croissants to colorful fruit tarts and decadent puff pastries, our treats offer a rich, indulgent experience. Perfect for breakfast, afternoon tea, or any special occasion. Try our selection of premium pastries for a taste of luxury!', 660.0000, 650.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 15:36:06', 'en', 'default', 1, 16, '2026-01-06 15:43:13', NULL, 1),
(10, '105', 'simple', '', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 660.0000, 650.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 15:36:06', 'bn', 'default', 1, 16, '2026-01-06 15:43:13', NULL, 1),
(11, '106', 'simple', '', 'Muffins', '<p>Savor the taste of freshly baked muffins, perfect for breakfast, snacks, or dessert. From classic blueberry and chocolate chip muffins to hearty banana nut varieties, our muffins are baked to perfection. Whether you enjoy them warm or on-the-go, our selection offers a delicious treat for every taste!</p>', '<p>Savor the taste of freshly baked muffins, perfect for breakfast, snacks, or dessert. From classic blueberry and chocolate chip muffins to hearty banana nut varieties, our muffins are baked to perfection. Whether you enjoy them warm or on-the-go, our selection offers a delicious treat for every taste!</p>', 'muffins-food', 1, 1, 1, 'Fresh & Flavorful Muffins | Perfect for Breakfast & Snacks', 'muffins, fresh muffins, blueberry muffins, chocolate muffins, banana nut muffins, muffins for breakfast, homemade muffins, bakery muffins, healthy muffins, muffin recipes', 'Savor the taste of freshly baked muffins, perfect for breakfast, snacks, or dessert. From classic blueberry and chocolate chip muffins to hearty banana nut varieties, our muffins are baked to perfection. Whether you enjoy them warm or on-the-go, our selection offers a delicious treat for every taste!', 220.0000, 210.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 15:45:19', 'en', 'default', 1, 17, '2026-01-06 15:48:55', NULL, 1),
(12, '106', 'simple', '', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 220.0000, 210.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 15:45:19', 'bn', 'default', 1, 17, '2026-01-06 15:48:55', NULL, 1),
(13, '107', 'simple', '', 'Cookies', '<p>Indulge in our freshly baked cookies, a perfect treat for any occasion. From classic chocolate chip and peanut butter to soft oatmeal raisin and sugar cookies, our selection offers something for every cookie lover. Whether you\'re craving a sweet snack or preparing for a celebration, our cookies are sure to delight!</p>', '<p>Indulge in our freshly baked cookies, a perfect treat for any occasion. From classic chocolate chip and peanut butter to soft oatmeal raisin and sugar cookies, our selection offers something for every cookie lover. Whether you\'re craving a sweet snack or preparing for a celebration, our cookies are sure to delight!</p>', 'cookies-food', 1, 1, 1, 'Delicious Freshly Baked Cookies | A Treat for Every Occasion', 'cookies, freshly baked cookies, chocolate chip cookies, peanut butter cookies, oatmeal raisin cookies, sugar cookies, homemade cookies, cookie recipes, bakery cookies, soft cookies', 'Indulge in our freshly baked cookies, a perfect treat for any occasion. From classic chocolate chip and peanut butter to soft oatmeal raisin and sugar cookies, our selection offers something for every cookie lover. Whether you\'re craving a sweet snack or preparing for a celebration, our cookies are sure to delight!', 350.0000, 340.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 15:52:31', 'en', 'default', 1, 18, '2026-01-06 15:54:24', NULL, 1),
(14, '107', 'simple', '', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 350.0000, 340.0000, '2026-01-06', '2026-01-31', 1.0000, '2026-01-06 15:52:31', 'bn', 'default', 1, 18, '2026-01-06 15:54:24', NULL, 1),
(15, '108', 'simple', '', 'Doughnut', '<p>Treat yourself to our mouth-watering fresh doughnuts, available in a variety of flavors and toppings. From classic glazed and chocolate-covered doughnuts to those with colorful sprinkles and delicious fillings, our doughnuts make the perfect snack for any occasion. Sweeten your day with our irresistible doughnut selection!</p>', '<p>Treat yourself to our mouth-watering fresh doughnuts, available in a variety of flavors and toppings. From classic glazed and chocolate-covered doughnuts to those with colorful sprinkles and delicious fillings, our doughnuts make the perfect snack for any occasion. Sweeten your day with our irresistible doughnut selection!</p>', 'doughnut-food', 1, 1, 1, 'Delicious Fresh Doughnuts | Sweet Treats for Every Occasion', 'doughnuts, fresh doughnuts, glazed doughnuts, chocolate doughnuts, sprinkles doughnuts, filled doughnuts, doughnut recipes, bakery doughnuts, sweet doughnuts, doughnut varieties', 'Treat yourself to our mouth-watering fresh doughnuts, available in a variety of flavors and toppings. From classic glazed and chocolate-covered doughnuts to those with colorful sprinkles and delicious fillings, our doughnuts make the perfect snack for any occasion. Sweeten your day with our irresistible doughnut selection!', 280.0000, 250.0000, '2026-01-06', '2026-01-31', 0.2500, '2026-01-06 15:55:26', 'en', 'default', 1, 19, '2026-01-06 15:59:08', NULL, 1),
(16, '108', 'simple', '', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 280.0000, 250.0000, '2026-01-06', '2026-01-31', 0.2500, '2026-01-06 15:55:26', 'bn', 'default', 1, 19, '2026-01-06 15:59:08', NULL, 1),
(17, '109', 'simple', '', 'Breads & Buns', '<p>Discover our wide range of freshly baked breads and buns, perfect for any meal or occasion. From soft hamburger buns and golden challah to artisan breads like baguettes and seeded loaves, each bite offers a delightful experience. Whether you\'re preparing a sandwich or enjoying with butter, our breads and buns are a must-have for every table.</p>', '<p>Discover our wide range of freshly baked breads and buns, perfect for any meal or occasion. From soft hamburger buns and golden challah to artisan breads like baguettes and seeded loaves, each bite offers a delightful experience. Whether you\'re preparing a sandwich or enjoying with butter, our breads and buns are a must-have for every table.</p>', 'breads-bun', 1, 1, 1, 'Freshly Baked Breads & Buns | Perfect for Every Meal', 'fresh breads, artisan bread, hamburger buns, challah bread, croissants, baguette, soft rolls, bakery buns, homemade bread, seeded bread', 'Discover our wide range of freshly baked breads and buns, perfect for any meal or occasion. From soft hamburger buns and golden challah to artisan breads like baguettes and seeded loaves, each bite offers a delightful experience. Whether you\'re preparing a sandwich or enjoying with butter, our breads and buns are a must-have for every table.', 440.0000, 435.0000, '2026-01-06', '2026-01-31', 0.7500, '2026-01-06 16:02:30', 'en', 'default', 1, 20, '2026-01-06 16:04:56', NULL, 1),
(18, '109', 'simple', '', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 440.0000, 435.0000, '2026-01-06', '2026-01-31', 0.7500, '2026-01-06 16:02:30', 'bn', 'default', 1, 20, '2026-01-06 16:04:56', NULL, 1),
(19, '110', 'simple', '', 'Tarts & Pies', '<p>Indulge in our exquisite selection of freshly baked tarts and pies, perfect for any occasion. From fruity tarts and rich chocolate delights to classic pies like apple and pecan, our tarts and pies are crafted with the finest ingredients. Whether you\'re hosting a party or enjoying a quiet dessert, these pastries are sure to impress!</p>', '<p>Indulge in our exquisite selection of freshly baked tarts and pies, perfect for any occasion. From fruity tarts and rich chocolate delights to classic pies like apple and pecan, our tarts and pies are crafted with the finest ingredients. Whether you\'re hosting a party or enjoying a quiet dessert, these pastries are sure to impress!</p>', 'tarts-pies-food', 1, 1, 1, '', '', 'Indulge in our exquisite selection of freshly baked tarts and pies, perfect for any occasion. From fruity tarts and rich chocolate delights to classic pies like apple and pecan, our tarts and pies are crafted with the finest ingredients. Whether you\'re hosting a party or enjoying a quiet dessert, these pastries are sure to impress!', 770.0000, 750.0000, '2026-01-06', '2026-01-31', 0.8800, '2026-01-06 16:06:01', 'en', 'default', 1, 21, '2026-01-06 16:08:04', NULL, 1),
(20, '110', 'simple', '', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 770.0000, 750.0000, '2026-01-06', '2026-01-31', 0.8800, '2026-01-06 16:06:01', 'bn', 'default', 1, 21, '2026-01-06 16:08:04', NULL, 1),
(21, '111', 'simple', '', 'Chocolate', '<p>Satisfy your sweet tooth with our premium selection of chocolates and sweets. From rich milk and dark chocolates to decadent pralines and candies, our collection offers a treat for every chocolate lover. Perfect for gifting or indulging yourself, our chocolates are crafted to deliver the ultimate sweet experience!</p>', '<p>Satisfy your sweet tooth with our premium selection of chocolates and sweets. From rich milk and dark chocolates to decadent pralines and candies, our collection offers a treat for every chocolate lover. Perfect for gifting or indulging yourself, our chocolates are crafted to deliver the ultimate sweet experience!</p>', 'chocolate-food', 1, 1, 1, 'Indulge in Premium Chocolate & Sweets | A Delight for Every Taste', 'chocolates, premium chocolates, milk chocolate, dark chocolate, white chocolate, pralines, candies, chocolate treats, gourmet sweets, chocolate bars', 'Satisfy your sweet tooth with our premium selection of chocolates and sweets. From rich milk and dark chocolates to decadent pralines and candies, our collection offers a treat for every chocolate lover. Perfect for gifting or indulging yourself, our chocolates are crafted to deliver the ultimate sweet experience!', 999.0000, 950.0000, '2026-01-06', '2026-01-31', 0.9700, '2026-01-06 16:08:58', 'en', 'default', 1, 22, '2026-01-06 16:10:14', NULL, 1),
(22, '111', 'simple', '', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 999.0000, 950.0000, '2026-01-06', '2026-01-31', 0.9700, '2026-01-06 16:08:58', 'bn', 'default', 1, 22, '2026-01-06 16:10:14', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_grouped_products`
--

CREATE TABLE `product_grouped_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `associated_product_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `type`, `path`, `product_id`, `position`) VALUES
(2, 'images', 'product/2/PrjU2xcRpGqCLX8rFjhZvQUZSoR3bGhUHGor3Tf3.webp', 2, 2),
(3, 'images', 'product/13/Z5v1jN28YYj76zjc5vo9iekwN9ASA6sJYC90JgFh.webp', 13, 1),
(4, 'images', 'product/2/C0Y3h6Gf9WJvFrcx91nwy5T2yW8fCwmYQly88Ll7.webp', 2, 1),
(5, 'images', 'product/14/mJsGGIzKniYOYZ33G7dZ7FLCdiMMDEjj8rP4fo9w.webp', 14, 1),
(6, 'images', 'product/14/RRxBnbkaBkj2tjMCsLPxCIl7g91hvE1AiXso3Fuf.webp', 14, 2),
(7, 'images', 'product/14/piZT5uMEDwb4PxC9aNPmYycaDNGcUM91qm7uUvW2.webp', 14, 3),
(8, 'images', 'product/15/Lus43sIBQ1IEJfLRS1u49JbUIQUga7a95O4mY4PX.webp', 15, 1),
(9, 'images', 'product/15/Ah0Gjw2Px9AMqW6wK8GG3V4woy2pVd64nqjEKOlj.webp', 15, 2),
(10, 'images', 'product/15/xblBz0ycfLm0CyFWSiiR2D1giSJGZpHU35bo0vUf.webp', 15, 3),
(11, 'images', 'product/16/wtHurMe0IimK0wvlNhIX4whMpFCqXSsLoMC3IEsT.webp', 16, 1),
(12, 'images', 'product/17/I0cLbBHwyPsMTHImZfBVJWptlRuVcUMVNjzslzYX.webp', 17, 1),
(13, 'images', 'product/18/BuObzZs6djIwpnd5KlaPZcqEiVgpRwacSfFhIw75.webp', 18, 1),
(14, 'images', 'product/19/Ita8uYHPdn7epgKpBDMl77m4xgi0b61SfYYWtKis.webp', 19, 1),
(15, 'images', 'product/20/aR2YHlUAu0HoMOkV4MyKwsm5jb7oKYZxIcmMVvJG.webp', 20, 1),
(16, 'images', 'product/21/XTy2cwgVY54NSHrycZd79iVQLLdoeP30fol02yBJ.webp', 21, 1),
(17, 'images', 'product/22/E3QbFXgsojCGvnjPXpo8m40EIWYUbVqMJODM0L6T.webp', 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventories`
--

CREATE TABLE `product_inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `product_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT '0',
  `inventory_source_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_inventories`
--

INSERT INTO `product_inventories` (`id`, `qty`, `product_id`, `vendor_id`, `inventory_source_id`) VALUES
(1, 27, 2, 0, 1),
(2, 30, 13, 0, 1),
(3, 40, 14, 0, 1),
(4, 550, 15, 0, 1),
(5, 50, 16, 0, 1),
(6, 50, 17, 0, 1),
(7, 20, 18, 0, 1),
(8, 30, 19, 0, 1),
(9, 50, 20, 0, 1),
(10, 40, 21, 0, 1),
(11, 20, 22, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory_indices`
--

CREATE TABLE `product_inventory_indices` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `product_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_inventory_indices`
--

INSERT INTO `product_inventory_indices` (`id`, `qty`, `product_id`, `channel_id`, `created_at`, `updated_at`) VALUES
(1, 27, 2, 1, NULL, '2026-01-05 17:22:51'),
(2, 30, 13, 1, NULL, '2026-01-06 15:03:42'),
(3, 40, 14, 1, NULL, NULL),
(4, 550, 15, 1, NULL, NULL),
(5, 50, 16, 1, NULL, NULL),
(6, 50, 17, 1, NULL, NULL),
(7, 20, 18, 1, NULL, NULL),
(8, 30, 19, 1, NULL, NULL),
(9, 50, 20, 1, NULL, NULL),
(10, 40, 21, 1, NULL, NULL),
(11, 20, 22, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_ordered_inventories`
--

CREATE TABLE `product_ordered_inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `product_id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ordered_inventories`
--

INSERT INTO `product_ordered_inventories` (`id`, `qty`, `product_id`, `channel_id`) VALUES
(1, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_price_indices`
--

CREATE TABLE `product_price_indices` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_group_id` int(10) UNSIGNED DEFAULT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `min_price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `regular_min_price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `max_price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `regular_max_price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_price_indices`
--

INSERT INTO `product_price_indices` (`id`, `product_id`, `customer_group_id`, `channel_id`, `min_price`, `regular_min_price`, `max_price`, `regular_max_price`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 110.0000, 120.0000, 110.0000, 120.0000, NULL, '2026-01-06 14:17:00'),
(2, 2, 2, 1, 110.0000, 120.0000, 110.0000, 120.0000, NULL, '2026-01-06 14:17:00'),
(3, 2, 3, 1, 110.0000, 120.0000, 110.0000, 120.0000, NULL, '2026-01-06 14:17:00'),
(4, 13, 1, 1, 210.0000, 220.0000, 210.0000, 220.0000, NULL, NULL),
(5, 13, 2, 1, 210.0000, 220.0000, 210.0000, 220.0000, NULL, NULL),
(6, 13, 3, 1, 210.0000, 220.0000, 210.0000, 220.0000, NULL, NULL),
(7, 14, 1, 1, 320.0000, 330.0000, 320.0000, 330.0000, NULL, NULL),
(8, 14, 2, 1, 320.0000, 330.0000, 320.0000, 330.0000, NULL, NULL),
(9, 14, 3, 1, 320.0000, 330.0000, 320.0000, 330.0000, NULL, NULL),
(10, 15, 1, 1, 540.0000, 550.0000, 540.0000, 550.0000, NULL, NULL),
(11, 15, 2, 1, 540.0000, 550.0000, 540.0000, 550.0000, NULL, NULL),
(12, 15, 3, 1, 540.0000, 550.0000, 540.0000, 550.0000, NULL, NULL),
(13, 16, 1, 1, 650.0000, 660.0000, 650.0000, 660.0000, NULL, NULL),
(14, 16, 2, 1, 650.0000, 660.0000, 650.0000, 660.0000, NULL, NULL),
(15, 16, 3, 1, 650.0000, 660.0000, 650.0000, 660.0000, NULL, NULL),
(16, 17, 1, 1, 210.0000, 220.0000, 210.0000, 220.0000, NULL, NULL),
(17, 17, 2, 1, 210.0000, 220.0000, 210.0000, 220.0000, NULL, NULL),
(18, 17, 3, 1, 210.0000, 220.0000, 210.0000, 220.0000, NULL, NULL),
(19, 18, 1, 1, 340.0000, 350.0000, 340.0000, 350.0000, NULL, NULL),
(20, 18, 2, 1, 340.0000, 350.0000, 340.0000, 350.0000, NULL, NULL),
(21, 18, 3, 1, 340.0000, 350.0000, 340.0000, 350.0000, NULL, NULL),
(22, 19, 1, 1, 250.0000, 280.0000, 250.0000, 280.0000, NULL, NULL),
(23, 19, 2, 1, 250.0000, 280.0000, 250.0000, 280.0000, NULL, NULL),
(24, 19, 3, 1, 250.0000, 280.0000, 250.0000, 280.0000, NULL, NULL),
(25, 20, 1, 1, 435.0000, 440.0000, 435.0000, 440.0000, NULL, NULL),
(26, 20, 2, 1, 435.0000, 440.0000, 435.0000, 440.0000, NULL, NULL),
(27, 20, 3, 1, 435.0000, 440.0000, 435.0000, 440.0000, NULL, NULL),
(28, 21, 1, 1, 750.0000, 770.0000, 750.0000, 770.0000, NULL, NULL),
(29, 21, 2, 1, 750.0000, 770.0000, 750.0000, 770.0000, NULL, NULL),
(30, 21, 3, 1, 750.0000, 770.0000, 750.0000, 770.0000, NULL, NULL),
(31, 22, 1, 1, 950.0000, 999.0000, 950.0000, 999.0000, NULL, NULL),
(32, 22, 2, 1, 950.0000, 999.0000, 950.0000, 999.0000, NULL, NULL),
(33, 22, 3, 1, 950.0000, 999.0000, 950.0000, 999.0000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_relations`
--

CREATE TABLE `product_relations` (
  `parent_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_review_attachments`
--

CREATE TABLE `product_review_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `review_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_super_attributes`
--

CREATE TABLE `product_super_attributes` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_up_sells`
--

CREATE TABLE `product_up_sells` (
  `parent_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_videos`
--

CREATE TABLE `product_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` int(10) UNSIGNED NOT NULL,
  `increment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_sent` tinyint(1) NOT NULL DEFAULT '0',
  `total_qty` int(11) DEFAULT NULL,
  `base_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adjustment_refund` decimal(12,4) DEFAULT '0.0000',
  `base_adjustment_refund` decimal(12,4) DEFAULT '0.0000',
  `adjustment_fee` decimal(12,4) DEFAULT '0.0000',
  `base_adjustment_fee` decimal(12,4) DEFAULT '0.0000',
  `sub_total` decimal(12,4) DEFAULT '0.0000',
  `base_sub_total` decimal(12,4) DEFAULT '0.0000',
  `grand_total` decimal(12,4) DEFAULT '0.0000',
  `base_grand_total` decimal(12,4) DEFAULT '0.0000',
  `shipping_amount` decimal(12,4) DEFAULT '0.0000',
  `base_shipping_amount` decimal(12,4) DEFAULT '0.0000',
  `tax_amount` decimal(12,4) DEFAULT '0.0000',
  `base_tax_amount` decimal(12,4) DEFAULT '0.0000',
  `discount_percent` decimal(12,4) DEFAULT '0.0000',
  `discount_amount` decimal(12,4) DEFAULT '0.0000',
  `base_discount_amount` decimal(12,4) DEFAULT '0.0000',
  `shipping_tax_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_shipping_tax_amount` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `sub_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_sub_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `shipping_amount_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_shipping_amount_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_items`
--

CREATE TABLE `refund_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_total` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `tax_amount` decimal(12,4) DEFAULT '0.0000',
  `base_tax_amount` decimal(12,4) DEFAULT '0.0000',
  `discount_percent` decimal(12,4) DEFAULT '0.0000',
  `discount_amount` decimal(12,4) DEFAULT '0.0000',
  `base_discount_amount` decimal(12,4) DEFAULT '0.0000',
  `price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_total_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_item_id` int(10) UNSIGNED DEFAULT NULL,
  `refund_id` int(10) UNSIGNED DEFAULT NULL,
  `additional` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `permission_type`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'This role users will have all the access', 'all', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `search_synonyms`
--

CREATE TABLE `search_synonyms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `search_terms`
--

CREATE TABLE `search_terms` (
  `id` int(10) UNSIGNED NOT NULL,
  `term` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `results` int(11) NOT NULL DEFAULT '0',
  `uses` int(11) NOT NULL DEFAULT '0',
  `redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_in_suggested_terms` tinyint(1) NOT NULL DEFAULT '0',
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `total_weight` decimal(12,4) DEFAULT NULL,
  `carrier_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carrier_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `track_number` text COLLATE utf8mb4_unicode_ci,
  `email_sent` tinyint(1) NOT NULL DEFAULT '0',
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `order_address_id` int(10) UNSIGNED DEFAULT NULL,
  `inventory_source_id` int(10) UNSIGNED DEFAULT NULL,
  `inventory_source_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `status`, `total_qty`, `total_weight`, `carrier_code`, `carrier_title`, `track_number`, `email_sent`, `customer_id`, `customer_type`, `order_id`, `order_address_id`, `inventory_source_id`, `inventory_source_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 2.0000, 'pathao', 'Pathao', 'DT0501264H8BDC', 1, NULL, NULL, 3, 3, 1, 'Default', '2026-01-05 17:21:04', '2026-01-05 17:23:17'),
(2, NULL, 1, 1.0000, 'pathao', 'Pathao', 'DT050126VZMZNX', 1, 6, 'Webkul\\Customer\\Models\\Customer', 4, 8, 1, 'Default', '2026-01-05 17:23:11', '2026-01-05 17:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_items`
--

CREATE TABLE `shipment_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `weight` decimal(12,4) DEFAULT NULL,
  `price` decimal(12,4) DEFAULT '0.0000',
  `base_price` decimal(12,4) DEFAULT '0.0000',
  `total` decimal(12,4) DEFAULT '0.0000',
  `base_total` decimal(12,4) DEFAULT '0.0000',
  `price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `base_price_incl_tax` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_item_id` int(10) UNSIGNED DEFAULT NULL,
  `shipment_id` int(10) UNSIGNED NOT NULL,
  `additional` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipment_items`
--

INSERT INTO `shipment_items` (`id`, `name`, `description`, `sku`, `qty`, `weight`, `price`, `base_price`, `total`, `base_total`, `price_incl_tax`, `base_price_incl_tax`, `product_id`, `product_type`, `order_item_id`, `shipment_id`, `additional`, `created_at`, `updated_at`) VALUES
(1, '', NULL, '101', 2, 2.0000, 120.0000, 120.0000, 240.0000, 240.0000, 120.0000, 120.0000, 2, 'Webkul\\Product\\Models\\Product', 1, 1, '{\"locale\": \"bn\", \"cart_id\": 1, \"quantity\": 2, \"is_buy_now\": \"0\", \"product_id\": \"2\"}', '2026-01-05 17:21:04', '2026-01-05 17:21:04'),
(2, '', NULL, '101', 1, 1.0000, 120.0000, 120.0000, 120.0000, 120.0000, 120.0000, 120.0000, 2, 'Webkul\\Product\\Models\\Product', 2, 2, '{\"locale\": \"en\", \"cart_id\": 2, \"quantity\": 1, \"is_buy_now\": \"0\", \"product_id\": \"2\"}', '2026-01-05 17:23:11', '2026-01-05 17:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `sitemaps`
--

CREATE TABLE `sitemaps` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional` json DEFAULT NULL,
  `generated_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers_list`
--

CREATE TABLE `subscribers_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers_list`
--

INSERT INTO `subscribers_list` (`id`, `email`, `is_subscribed`, `token`, `customer_id`, `channel_id`, `created_at`, `updated_at`) VALUES
(1, 'ashrafulinstasure@gmail.com', 1, '695c900b355f7', 6, 1, '2026-01-06 10:01:07', '2026-01-06 10:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `tax_categories`
--

CREATE TABLE `tax_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax_categories_tax_rates`
--

CREATE TABLE `tax_categories_tax_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `tax_category_id` int(10) UNSIGNED NOT NULL,
  `tax_rate_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE `tax_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_zip` tinyint(1) NOT NULL DEFAULT '0',
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_rate` decimal(12,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theme_customizations`
--

CREATE TABLE `theme_customizations` (
  `id` int(10) UNSIGNED NOT NULL,
  `theme_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `channel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_customizations`
--

INSERT INTO `theme_customizations` (`id`, `theme_code`, `type`, `name`, `sort_order`, `status`, `channel_id`, `created_at`, `updated_at`) VALUES
(1, 'default', 'image_carousel', 'Image Carousel', 1, 1, 1, '2026-01-05 13:14:15', '2026-01-05 13:14:15'),
(2, 'default', 'static_content', 'Offer Information', 2, 1, 1, '2026-01-05 13:14:15', '2026-01-05 13:14:15'),
(3, 'default', 'category_carousel', 'Categories Collections', 3, 1, 1, '2026-01-05 13:14:15', '2026-01-05 13:14:15'),
(4, 'default', 'product_carousel', 'New Products', 4, 1, 1, '2026-01-05 13:14:15', '2026-01-05 13:14:15'),
(5, 'default', 'static_content', 'Top Collections', 5, 1, 1, '2026-01-05 13:14:15', '2026-01-05 13:14:15'),
(6, 'default', 'static_content', 'Bold Collections', 6, 1, 1, '2026-01-05 13:14:15', '2026-01-05 13:14:15'),
(7, 'default', 'product_carousel', 'Featured Collections', 7, 1, 1, '2026-01-05 13:14:15', '2026-01-05 13:14:15'),
(8, 'default', 'static_content', 'Game Container', 8, 1, 1, '2026-01-05 13:14:15', '2026-01-05 13:14:15'),
(9, 'default', 'product_carousel', 'All Products', 9, 1, 1, '2026-01-05 13:14:15', '2026-01-05 13:14:15'),
(10, 'default', 'static_content', 'Bold Collections', 10, 1, 1, '2026-01-05 13:14:15', '2026-01-05 13:14:15'),
(11, 'default', 'footer_links', 'Footer Links', 11, 1, 1, '2026-01-05 13:14:15', '2026-01-05 17:36:31'),
(12, 'default', 'services_content', 'Services Content', 12, 1, 1, '2026-01-05 13:14:15', '2026-01-05 13:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `theme_customization_translations`
--

CREATE TABLE `theme_customization_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `theme_customization_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_customization_translations`
--

INSERT INTO `theme_customization_translations` (`id`, `theme_customization_id`, `locale`, `options`) VALUES
(1, 1, 'en', '{\"images\": [{\"link\": \"\", \"image\": \"storage/theme/1/0e0ax571429tgNqGh8leFyYUriUomL2NjZy4Gh2v.webp\", \"title\": \"Get Ready For New Collection\"}, {\"link\": \"\", \"image\": \"storage/theme/1/DSm9G2V1zpIKVrMGEKD5CyXaZWeJk1zgIdU5UgdV.webp\", \"title\": \"Get Ready For New Collection\"}, {\"link\": \"\", \"image\": \"storage/theme/1/nuEIyHX9Ew3SQWGvSUlDdB08aBrbqqwNtvudXOqy.webp\", \"title\": \"Get Ready For New Collection\"}, {\"link\": \"\", \"image\": \"storage/theme/1/wXQeCTFOOAYDanU49x8LE448XzZmRt4RmL3I6s5I.webp\", \"title\": \"Get Ready For New Collection\"}]}'),
(2, 2, 'en', '{\"css\": \".home-offer h1 {display: block;font-weight: 500;text-align: center;font-size: 22px;font-family: DM Serif Display;background-color: #E8EDFE;padding-top: 20px;padding-bottom: 20px;}@media (max-width:768px){.home-offer h1 {font-size:18px;padding-top: 10px;padding-bottom: 10px;}@media (max-width:525px) {.home-offer h1 {font-size:14px;padding-top: 6px;padding-bottom: 6px;}}\", \"html\": \"<div class=\\\"home-offer\\\"><h1>Get UPTO 40% OFF on your 1st order SHOP NOW</h1></div>\"}'),
(3, 3, 'en', '{\"filters\": {\"sort\": \"asc\", \"limit\": 10, \"parent_id\": 1}}'),
(4, 4, 'en', '{\"title\": \"New Products\", \"filters\": {\"new\": 1, \"sort\": \"name-asc\", \"limit\": 12}}'),
(5, 5, 'en', '{\"css\": \".top-collection-container {overflow: hidden;}.top-collection-header {padding-left: 15px;padding-right: 15px;text-align: center;font-size: 70px;line-height: 90px;color: #060C3B;margin-top: 80px;}.top-collection-header h2 {max-width: 595px;margin-left: auto;margin-right: auto;font-family: DM Serif Display;}.top-collection-grid {display: flex;flex-wrap: wrap;gap: 32px;justify-content: center;margin-top: 60px;width: 100%;margin-right: auto;margin-left: auto;padding-right: 90px;padding-left: 90px;}.top-collection-card {position: relative;background: #f9fafb;overflow:hidden;border-radius:20px;}.top-collection-card img {border-radius: 16px;max-width: 100%;text-indent:-9999px;transition: transform 300ms ease;transform: scale(1);}.top-collection-card:hover img {transform: scale(1.05);transition: all 300ms ease;}.top-collection-card h3 {color: #060C3B;font-size: 30px;font-family: DM Serif Display;transform: translateX(-50%);width: max-content;left: 50%;bottom: 30px;position: absolute;margin: 0;font-weight: inherit;}@media not all and (min-width: 525px) {.top-collection-header {margin-top: 28px;font-size: 20px;line-height: 1.5;}.top-collection-grid {gap: 10px}}@media not all and (min-width: 768px) {.top-collection-header {margin-top: 30px;font-size: 28px;line-height: 3;}.top-collection-header h2 {line-height:2; margin-bottom:20px;} .top-collection-grid {gap: 14px}} @media not all and (min-width: 1024px) {.top-collection-grid {padding-left: 30px;padding-right: 30px;}}@media (max-width: 768px) {.top-collection-grid { row-gap:15px; column-gap:0px;justify-content: space-between;margin-top: 0px;} .top-collection-card{width:48%} .top-collection-card img {width:100%;} .top-collection-card h3 {font-size:24px; bottom: 16px;}}@media (max-width:520px) { .top-collection-grid{padding-left: 15px;padding-right: 15px;} .top-collection-card h3 {font-size:18px; bottom: 10px;}}\", \"html\": \"<div class=\\\"top-collection-container\\\"><div class=\\\"top-collection-header\\\"><h2>The game with our new additions!</h2></div><div class=\\\"top-collection-grid container\\\"><div class=\\\"top-collection-card\\\"><img src=\\\"\\\" data-src=\\\"storage/theme/5/asgB0o1ecknTv1rsMrVPugCXrl4gcJlfR27DuOMO.webp\\\" class=\\\"lazy\\\" width=\\\"396\\\" height=\\\"396\\\" alt=\\\"The game with our new additions!\\\"><h3>Our Collections</h3></div><div class=\\\"top-collection-card\\\"><img src=\\\"\\\" data-src=\\\"storage/theme/5/pOcuyHyTQ4UNqk4coBQygQAsY7snf0JdHip7SnSn.webp\\\" class=\\\"lazy\\\" width=\\\"396\\\" height=\\\"396\\\" alt=\\\"The game with our new additions!\\\"><h3>Our Collections</h3></div><div class=\\\"top-collection-card\\\"><img src=\\\"\\\" data-src=\\\"storage/theme/5/S0QpwpdoijHYn1HIffOn48cUxbhkuL6IN5qxMHRd.webp\\\" class=\\\"lazy\\\" width=\\\"396\\\" height=\\\"396\\\" alt=\\\"The game with our new additions!\\\"><h3>Our Collections</h3></div><div class=\\\"top-collection-card\\\"><img src=\\\"\\\" data-src=\\\"storage/theme/5/EZyuWovaJivegoamCXLLMxpOspktkUMmO29sPOOH.webp\\\" class=\\\"lazy\\\" width=\\\"396\\\" height=\\\"396\\\" alt=\\\"The game with our new additions!\\\"><h3>Our Collections</h3></div><div class=\\\"top-collection-card\\\"><img src=\\\"\\\" data-src=\\\"storage/theme/5/qmfKNdflPKpdLkCp4k9awR89upF6lsNFl6wrE9bV.webp\\\" class=\\\"lazy\\\" width=\\\"396\\\" height=\\\"396\\\" alt=\\\"The game with our new additions!\\\"><h3>Our Collections</h3></div><div class=\\\"top-collection-card\\\"><img src=\\\"\\\" data-src=\\\"storage/theme/5/7OlhBidjmIL8juAhZLJATLXQFnX04pjL3mXRbEIj.webp\\\" class=\\\"lazy\\\" width=\\\"396\\\" height=\\\"396\\\" alt=\\\"The game with our new additions!\\\"><h3>Our Collections</h3></div></div></div>\"}'),
(6, 6, 'en', '{\"css\": \".section-gap{margin-top:80px}.direction-ltr{direction:ltr}.direction-rtl{direction:rtl}.inline-col-wrapper{display:grid;grid-template-columns:auto 1fr;grid-gap:60px;align-items:center}.inline-col-wrapper .inline-col-image-wrapper{overflow:hidden}.inline-col-wrapper .inline-col-image-wrapper img{max-width:100%;height:auto;border-radius:16px;text-indent:-9999px}.inline-col-wrapper .inline-col-content-wrapper{display:flex;flex-wrap:wrap;gap:20px;max-width:464px}.inline-col-wrapper .inline-col-content-wrapper .inline-col-title{max-width:442px;font-size:60px;font-weight:400;color:#060c3b;line-height:70px;font-family:DM Serif Display;margin:0}.inline-col-wrapper .inline-col-content-wrapper .inline-col-description{margin:0;font-size:18px;color:#6e6e6e;font-family:Poppins}@media (max-width:991px){.inline-col-wrapper{grid-template-columns:1fr;grid-gap:16px}.inline-col-wrapper .inline-col-content-wrapper{gap:10px}} @media (max-width:768px){.inline-col-wrapper .inline-col-image-wrapper img {width:100%;} .inline-col-wrapper .inline-col-content-wrapper .inline-col-title{font-size:28px !important;line-height:normal !important}} @media (max-width:525px){.inline-col-wrapper .inline-col-content-wrapper .inline-col-title{font-size:20px !important;} .inline-col-description{font-size:16px} .inline-col-wrapper{grid-gap:10px}}\", \"html\": \"<div class=\\\"section-gap bold-collections container\\\"> <div class=\\\"inline-col-wrapper\\\"> <div class=\\\"inline-col-image-wrapper\\\"> <img src=\\\"\\\" data-src=\\\"storage/theme/6/vjCEWGzEkNIf1dseXOOC2XJsCOcQmZHV8qKruv5t.webp\\\" class=\\\"lazy\\\" width=\\\"632\\\" height=\\\"510\\\" alt=\\\"Get Ready for our new Bold Collections!\\\"> </div> <div class=\\\"inline-col-content-wrapper\\\"> <h2 class=\\\"inline-col-title\\\"> Get Ready for our new Bold Collections! </h2> <p class=\\\"inline-col-description\\\">Introducing Our New Bold Collections! Elevate your style with daring designs and vibrant statements. Explore striking patterns and bold colors that redefine your wardrobe. Get ready to embrace the extraordinary!</p> <button class=\\\"primary-button max-md:rounded-lg max-md:px-4 max-md:py-2.5 max-md:text-sm\\\">View Collections</button> </div> </div> </div>\"}'),
(7, 7, 'en', '{\"title\": \"Featured Products\", \"filters\": {\"sort\": \"name-desc\", \"limit\": 12, \"featured\": 1}}'),
(8, 8, 'en', '{\"css\": \".section-game {overflow: hidden;}.section-title,.section-title h2{font-weight:400;font-family:DM Serif Display}.section-title{margin-top:80px;padding-left:15px;padding-right:15px;text-align:center;line-height:90px}.section-title h2{font-size:70px;color:#060c3b;max-width:595px;margin:auto}.collection-card-wrapper{display:flex;flex-wrap:wrap;justify-content:center;gap:30px}.collection-card-wrapper .single-collection-card{position:relative}.collection-card-wrapper .single-collection-card img{border-radius:16px;background-color:#f5f5f5;max-width:100%;height:auto;text-indent:-9999px}.collection-card-wrapper .single-collection-card .overlay-text{font-size:50px;font-weight:400;max-width:234px;font-style:italic;color:#060c3b;font-family:DM Serif Display;position:absolute;bottom:30px;left:30px;margin:0}@media (max-width:1024px){.section-title{padding:0 30px}}@media (max-width:991px){.collection-card-wrapper{flex-wrap:wrap}}@media (max-width:768px) {.collection-card-wrapper .single-collection-card .overlay-text{font-size:32px; bottom:20px}.section-title{margin-top:32px}.section-title h2{font-size:28px;line-height:normal}} @media (max-width:525px){.collection-card-wrapper .single-collection-card .overlay-text{font-size:18px; bottom:10px} .section-title{margin-top:28px}.section-title h2{font-size:20px;} .collection-card-wrapper{gap:10px; 15px; row-gap:15px; column-gap:0px;justify-content: space-between;margin-top: 15px;} .collection-card-wrapper .single-collection-card {width:48%;}}\", \"html\": \"<div class=\\\"section-game\\\"><div class=\\\"section-title\\\"> <h2>The game with our new additions!</h2> </div> <div class=\\\"section-gap container\\\"> <div class=\\\"collection-card-wrapper\\\"> <div class=\\\"single-collection-card\\\"> <img src=\\\"\\\" data-src=\\\"storage/theme/8/FM8amJZ0hPHt5xPQN8lYuoAkaTwJ5do6Rcg0Hshh.webp\\\" class=\\\"lazy\\\" width=\\\"615\\\" height=\\\"600\\\" alt=\\\"The game with our new additions!\\\"> <h3 class=\\\"overlay-text\\\">Our Collections</h3> </div> <div class=\\\"single-collection-card\\\"> <img src=\\\"\\\" data-src=\\\"storage/theme/8/abqM1NWKQoOTzgjpRp25gGdoRrOfSSpsQXAvJ0Hj.webp\\\" class=\\\"lazy\\\" width=\\\"615\\\" height=\\\"600\\\" alt=\\\"The game with our new additions!\\\"> <h3 class=\\\"overlay-text\\\"> Our Collections </h3> </div> </div> </div> </div>\"}'),
(9, 9, 'en', '{\"title\": \"All Products\", \"filters\": {\"sort\": \"name-desc\", \"limit\": 12}}'),
(10, 10, 'en', '{\"css\": \".section-gap{margin-top:80px}.direction-ltr{direction:ltr}.direction-rtl{direction:rtl}.inline-col-wrapper{display:grid;grid-template-columns:auto 1fr;grid-gap:60px;align-items:center}.inline-col-wrapper .inline-col-image-wrapper{overflow:hidden}.inline-col-wrapper .inline-col-image-wrapper img{max-width:100%;height:auto;border-radius:16px;text-indent:-9999px}.inline-col-wrapper .inline-col-content-wrapper{display:flex;flex-wrap:wrap;gap:20px;max-width:464px}.inline-col-wrapper .inline-col-content-wrapper .inline-col-title{max-width:442px;font-size:60px;font-weight:400;color:#060c3b;line-height:70px;font-family:DM Serif Display;margin:0}.inline-col-wrapper .inline-col-content-wrapper .inline-col-description{margin:0;font-size:18px;color:#6e6e6e;font-family:Poppins}@media (max-width:991px){.inline-col-wrapper{grid-template-columns:1fr;grid-gap:16px}.inline-col-wrapper .inline-col-content-wrapper{gap:10px}}@media (max-width:768px) {.inline-col-wrapper .inline-col-image-wrapper img {max-width:100%;}.inline-col-wrapper .inline-col-content-wrapper{max-width:100%;justify-content:center; text-align:center} .section-gap{padding:0 30px; gap:20px;margin-top:24px} .bold-collections{margin-top:32px;}} @media (max-width:525px){.inline-col-wrapper .inline-col-content-wrapper{gap:10px} .inline-col-wrapper .inline-col-content-wrapper .inline-col-title{font-size:20px;line-height:normal} .section-gap{padding:0 15px; gap:15px;margin-top:10px} .bold-collections{margin-top:28px;}  .inline-col-description{font-size:16px !important} .inline-col-wrapper{grid-gap:15px}\", \"html\": \"<div class=\\\"section-gap bold-collections container\\\"> <div class=\\\"inline-col-wrapper direction-rtl\\\"> <div class=\\\"inline-col-image-wrapper\\\"> <img src=\\\"\\\" data-src=\\\"storage/theme/10/GxxC56lzkRJESC1v0pbzcEMhSYmUTLGZfM2ToB8g.webp\\\" class=\\\"lazy\\\" width=\\\"632\\\" height=\\\"510\\\" alt=\\\"Get Ready for our new Bold Collections!\\\"> </div> <div class=\\\"inline-col-content-wrapper direction-ltr\\\"> <h2 class=\\\"inline-col-title\\\"> Get Ready for our new Bold Collections! </h2> <p class=\\\"inline-col-description\\\">Introducing Our New Bold Collections! Elevate your style with daring designs and vibrant statements. Explore striking patterns and bold colors that redefine your wardrobe. Get ready to embrace the extraordinary!</p> <button class=\\\"primary-button max-md:rounded-lg max-md:px-4 max-md:py-2.5 max-md:text-sm\\\">View Collections</button> </div> </div> </div>\"}'),
(11, 11, 'en', '{\"column_1\": [{\"url\": \"http://localhost:8000/page/about-us\", \"title\": \"About Us\", \"sort_order\": \"1\"}, {\"url\": \"http://localhost:8000/contact-us\", \"title\": \"Contact Us\", \"sort_order\": \"2\"}, {\"url\": \"http://localhost:8000/page/customer-service\", \"title\": \"Customer Service\", \"sort_order\": \"3\"}, {\"url\": \"http://localhost:8000/page/whats-new\", \"title\": \"What\'s New\", \"sort_order\": \"4\"}, {\"url\": \"http://localhost:8000/page/terms-of-use\", \"title\": \"Terms of Use\", \"sort_order\": \"5\"}, {\"url\": \"http://localhost:8000/page/terms-conditions\", \"title\": \"Terms & Conditions\", \"sort_order\": \"6\"}], \"column_2\": [{\"url\": \"http://localhost:8000/page/privacy-policy\", \"title\": \"Privacy Policy\", \"sort_order\": \"1\"}, {\"url\": \"http://localhost:8000/page/payment-policy\", \"title\": \"Payment Policy\", \"sort_order\": \"2\"}, {\"url\": \"http://localhost:8000/page/shipping-policy\", \"title\": \"Shipping Policy\", \"sort_order\": \"3\"}, {\"url\": \"http://localhost:8000/page/refund-policy\", \"title\": \"Refund Policy\", \"sort_order\": \"4\"}, {\"url\": \"http://localhost:8000/page/return-policy\", \"title\": \"Return Policy\", \"sort_order\": \"5\"}]}'),
(12, 12, 'en', '{\"services\": [{\"title\": \"Free Shipping\", \"description\": \"Enjoy free shipping on all orders\", \"service_icon\": \"icon-truck\"}, {\"title\": \"Product Replace\", \"description\": \"Easy Product Replacement Available!\", \"service_icon\": \"icon-product\"}, {\"title\": \"Emi Available\", \"description\": \"No cost EMI available on all major credit cards\", \"service_icon\": \"icon-dollar-sign\"}, {\"title\": \"24/7 Support\", \"description\": \"Dedicated 24/7 support via chat and email\", \"service_icon\": \"icon-support\"}]}');

-- --------------------------------------------------------

--
-- Table structure for table `url_rewrites`
--

CREATE TABLE `url_rewrites` (
  `id` int(10) UNSIGNED NOT NULL,
  `entity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `url_rewrites`
--

INSERT INTO `url_rewrites` (`id`, `entity_type`, `request_path`, `target_path`, `redirect_type`, `locale`, `created_at`, `updated_at`) VALUES
(12, 'category', 'breads-buns', 'breads', '301', 'en', '2026-01-06 11:46:19', '2026-01-06 11:46:19'),
(14, 'product', 'sweets', 'weet-sweets', '301', 'en', '2026-01-06 14:58:12', '2026-01-06 14:58:12'),
(15, 'category', 'tarts-pie', 'tarts', '301', 'en', '2026-01-08 13:11:11', '2026-01-08 13:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `phone_verified` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('active','inactive','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request` mediumtext COLLATE utf8mb4_unicode_ci,
  `url` mediumtext COLLATE utf8mb4_unicode_ci,
  `referer` mediumtext COLLATE utf8mb4_unicode_ci,
  `languages` text COLLATE utf8mb4_unicode_ci,
  `useragent` text COLLATE utf8mb4_unicode_ci,
  `headers` text COLLATE utf8mb4_unicode_ci,
  `device` text COLLATE utf8mb4_unicode_ci,
  `platform` text COLLATE utf8mb4_unicode_ci,
  `browser` text COLLATE utf8mb4_unicode_ci,
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `visitor_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `channel_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `item_options` json DEFAULT NULL,
  `moved_to_cart` date DEFAULT NULL,
  `shared` tinyint(1) DEFAULT NULL,
  `time_of_moving` date DEFAULT NULL,
  `additional` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_items`
--

CREATE TABLE `wishlist_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `channel_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `additional` json DEFAULT NULL,
  `moved_to_cart` date DEFAULT NULL,
  `shared` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_customer_id_foreign` (`customer_id`),
  ADD KEY `addresses_cart_id_foreign` (`cart_id`),
  ADD KEY `addresses_order_id_foreign` (`order_id`),
  ADD KEY `addresses_parent_address_id_foreign` (`parent_address_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_api_token_unique` (`api_token`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attributes_code_unique` (`code`),
  ADD KEY `attributes_code_index` (`code`);

--
-- Indexes for table `attribute_families`
--
ALTER TABLE `attribute_families`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_groups`
--
ALTER TABLE `attribute_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_groups_attribute_family_id_name_unique` (`attribute_family_id`,`name`);

--
-- Indexes for table `attribute_group_mappings`
--
ALTER TABLE `attribute_group_mappings`
  ADD PRIMARY KEY (`attribute_id`,`attribute_group_id`),
  ADD KEY `attribute_group_mappings_attribute_group_id_foreign` (`attribute_group_id`);

--
-- Indexes for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_options_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `attribute_option_translations`
--
ALTER TABLE `attribute_option_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_option_locale_unique` (`attribute_option_id`,`locale`);

--
-- Indexes for table `attribute_translations`
--
ALTER TABLE `attribute_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_translations_attribute_id_locale_unique` (`attribute_id`,`locale`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_order_item_id_foreign` (`order_item_id`),
  ADD KEY `bookings_booking_product_event_ticket_id_foreign` (`booking_product_event_ticket_id`),
  ADD KEY `bookings_order_id_foreign` (`order_id`),
  ADD KEY `bookings_product_id_foreign` (`product_id`);

--
-- Indexes for table `booking_products`
--
ALTER TABLE `booking_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `booking_product_appointment_slots`
--
ALTER TABLE `booking_product_appointment_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_product_appointment_slots_booking_product_id_foreign` (`booking_product_id`);

--
-- Indexes for table `booking_product_default_slots`
--
ALTER TABLE `booking_product_default_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_product_default_slots_booking_product_id_foreign` (`booking_product_id`);

--
-- Indexes for table `booking_product_event_tickets`
--
ALTER TABLE `booking_product_event_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_product_event_tickets_booking_product_id_foreign` (`booking_product_id`);

--
-- Indexes for table `booking_product_event_ticket_translations`
--
ALTER TABLE `booking_product_event_ticket_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bpet_locale_unique` (`booking_product_event_ticket_id`,`locale`);

--
-- Indexes for table `booking_product_rental_slots`
--
ALTER TABLE `booking_product_rental_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_product_rental_slots_booking_product_id_foreign` (`booking_product_id`);

--
-- Indexes for table `booking_product_table_slots`
--
ALTER TABLE `booking_product_table_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_product_table_slots_booking_product_id_foreign` (`booking_product_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_customer_id_foreign` (`customer_id`),
  ADD KEY `cart_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_parent_id_foreign` (`parent_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_tax_category_id_foreign` (`tax_category_id`);

--
-- Indexes for table `cart_item_inventories`
--
ALTER TABLE `cart_item_inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_payment`
--
ALTER TABLE `cart_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_payment_cart_id_foreign` (`cart_id`);

--
-- Indexes for table `cart_rules`
--
ALTER TABLE `cart_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_rule_channels`
--
ALTER TABLE `cart_rule_channels`
  ADD PRIMARY KEY (`cart_rule_id`,`channel_id`),
  ADD KEY `cart_rule_channels_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `cart_rule_coupons`
--
ALTER TABLE `cart_rule_coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_rule_coupons_cart_rule_id_foreign` (`cart_rule_id`);

--
-- Indexes for table `cart_rule_coupon_usage`
--
ALTER TABLE `cart_rule_coupon_usage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_rule_coupon_usage_cart_rule_coupon_id_foreign` (`cart_rule_coupon_id`),
  ADD KEY `cart_rule_coupon_usage_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `cart_rule_customers`
--
ALTER TABLE `cart_rule_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_rule_customers_cart_rule_id_foreign` (`cart_rule_id`),
  ADD KEY `cart_rule_customers_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `cart_rule_customer_groups`
--
ALTER TABLE `cart_rule_customer_groups`
  ADD PRIMARY KEY (`cart_rule_id`,`customer_group_id`),
  ADD KEY `cart_rule_customer_groups_customer_group_id_foreign` (`customer_group_id`);

--
-- Indexes for table `cart_rule_translations`
--
ALTER TABLE `cart_rule_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_rule_translations_cart_rule_id_locale_unique` (`cart_rule_id`,`locale`);

--
-- Indexes for table `cart_shipping_rates`
--
ALTER TABLE `cart_shipping_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_shipping_rates_cart_id_foreign` (`cart_id`);

--
-- Indexes for table `catalog_rules`
--
ALTER TABLE `catalog_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_rule_channels`
--
ALTER TABLE `catalog_rule_channels`
  ADD PRIMARY KEY (`catalog_rule_id`,`channel_id`),
  ADD KEY `catalog_rule_channels_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `catalog_rule_customer_groups`
--
ALTER TABLE `catalog_rule_customer_groups`
  ADD PRIMARY KEY (`catalog_rule_id`,`customer_group_id`),
  ADD KEY `catalog_rule_customer_groups_customer_group_id_foreign` (`customer_group_id`);

--
-- Indexes for table `catalog_rule_products`
--
ALTER TABLE `catalog_rule_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalog_rule_products_product_id_foreign` (`product_id`),
  ADD KEY `catalog_rule_products_customer_group_id_foreign` (`customer_group_id`),
  ADD KEY `catalog_rule_products_catalog_rule_id_foreign` (`catalog_rule_id`),
  ADD KEY `catalog_rule_products_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `catalog_rule_product_prices`
--
ALTER TABLE `catalog_rule_product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalog_rule_product_prices_product_id_foreign` (`product_id`),
  ADD KEY `catalog_rule_product_prices_customer_group_id_foreign` (`customer_group_id`),
  ADD KEY `catalog_rule_product_prices_catalog_rule_id_foreign` (`catalog_rule_id`),
  ADD KEY `catalog_rule_product_prices_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`);

--
-- Indexes for table `category_filterable_attributes`
--
ALTER TABLE `category_filterable_attributes`
  ADD KEY `category_filterable_attributes_category_id_foreign` (`category_id`),
  ADD KEY `category_filterable_attributes_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_translations_category_id_slug_locale_unique` (`category_id`,`slug`,`locale`),
  ADD KEY `category_translations_locale_id_foreign` (`locale_id`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channels_root_category_id_foreign` (`root_category_id`),
  ADD KEY `channels_default_locale_id_foreign` (`default_locale_id`),
  ADD KEY `channels_base_currency_id_foreign` (`base_currency_id`),
  ADD KEY `channels_hostname_idx` (`hostname`);

--
-- Indexes for table `channel_currencies`
--
ALTER TABLE `channel_currencies`
  ADD PRIMARY KEY (`channel_id`,`currency_id`),
  ADD KEY `channel_currencies_currency_id_foreign` (`currency_id`),
  ADD KEY `channel_currencies_cid_cyid_idx` (`channel_id`,`currency_id`);

--
-- Indexes for table `channel_inventory_sources`
--
ALTER TABLE `channel_inventory_sources`
  ADD UNIQUE KEY `channel_inventory_source_unique` (`channel_id`,`inventory_source_id`),
  ADD KEY `channel_inventory_sources_inventory_source_id_foreign` (`inventory_source_id`);

--
-- Indexes for table `channel_locales`
--
ALTER TABLE `channel_locales`
  ADD PRIMARY KEY (`channel_id`,`locale_id`),
  ADD KEY `channel_locales_locale_id_foreign` (`locale_id`),
  ADD KEY `channel_locales_cid_lid_idx` (`channel_id`,`locale_id`);

--
-- Indexes for table `channel_translations`
--
ALTER TABLE `channel_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `channel_translations_channel_id_locale_unique` (`channel_id`,`locale`),
  ADD KEY `channel_translations_locale_index` (`locale`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_page_channels`
--
ALTER TABLE `cms_page_channels`
  ADD UNIQUE KEY `cms_page_channels_cms_page_id_channel_id_unique` (`cms_page_id`,`channel_id`),
  ADD KEY `cms_page_channels_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `cms_page_translations`
--
ALTER TABLE `cms_page_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cms_page_translations_cms_page_id_url_key_locale_unique` (`cms_page_id`,`url_key`,`locale`);

--
-- Indexes for table `compare_items`
--
ALTER TABLE `compare_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compare_items_product_id_foreign` (`product_id`),
  ADD KEY `compare_items_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `core_config`
--
ALTER TABLE `core_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_states`
--
ALTER TABLE `country_states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_states_country_id_foreign` (`country_id`);

--
-- Indexes for table `country_state_translations`
--
ALTER TABLE `country_state_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_state_translations_country_state_id_foreign` (`country_state_id`);

--
-- Indexes for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_translations_country_id_foreign` (`country_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_exchange_rates`
--
ALTER TABLE `currency_exchange_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency_exchange_rates_target_currency_unique` (`target_currency`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`),
  ADD UNIQUE KEY `customers_api_token_unique` (`api_token`),
  ADD KEY `customers_customer_group_id_foreign` (`customer_group_id`),
  ADD KEY `customers_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_groups_code_unique` (`code`);

--
-- Indexes for table `customer_notes`
--
ALTER TABLE `customer_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_notes_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `customer_password_resets`
--
ALTER TABLE `customer_password_resets`
  ADD KEY `customer_password_resets_email_index` (`email`);

--
-- Indexes for table `customer_social_accounts`
--
ALTER TABLE `customer_social_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_social_accounts_provider_id_unique` (`provider_id`),
  ADD KEY `customer_social_accounts_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `datagrid_saved_filters`
--
ALTER TABLE `datagrid_saved_filters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `datagrid_saved_filters_user_id_name_src_unique` (`user_id`,`name`,`src`);

--
-- Indexes for table `delivery_partners`
--
ALTER TABLE `delivery_partners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delivery_partners_email_unique` (`email`),
  ADD KEY `delivery_partners_status_index` (`status`);

--
-- Indexes for table `downloadable_link_purchased`
--
ALTER TABLE `downloadable_link_purchased`
  ADD PRIMARY KEY (`id`),
  ADD KEY `downloadable_link_purchased_customer_id_foreign` (`customer_id`),
  ADD KEY `downloadable_link_purchased_order_id_foreign` (`order_id`),
  ADD KEY `downloadable_link_purchased_order_item_id_foreign` (`order_item_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gdpr_data_request`
--
ALTER TABLE `gdpr_data_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gdpr_data_request_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_batches`
--
ALTER TABLE `import_batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `import_batches_import_id_foreign` (`import_id`);

--
-- Indexes for table `inventory_sources`
--
ALTER TABLE `inventory_sources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_sources_code_unique` (`code`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_order_id_foreign` (`order_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_items_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locales_code_unique` (`code`);

--
-- Indexes for table `marketing_campaigns`
--
ALTER TABLE `marketing_campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marketing_campaigns_channel_id_foreign` (`channel_id`),
  ADD KEY `marketing_campaigns_customer_group_id_foreign` (`customer_group_id`),
  ADD KEY `marketing_campaigns_marketing_template_id_foreign` (`marketing_template_id`),
  ADD KEY `marketing_campaigns_marketing_event_id_foreign` (`marketing_event_id`);

--
-- Indexes for table `marketing_events`
--
ALTER TABLE `marketing_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketing_templates`
--
ALTER TABLE `marketing_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_order_id_foreign` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_increment_id_unique` (`increment_id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `order_comments`
--
ALTER TABLE `order_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_comments_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_parent_id_foreign` (`parent_id`),
  ADD KEY `order_items_tax_category_id_foreign` (`tax_category_id`);

--
-- Indexes for table `order_payment`
--
ALTER TABLE `order_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_payment_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_transactions`
--
ALTER TABLE `order_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_transactions_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pathao_orders`
--
ALTER TABLE `pathao_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pathao_orders_consignment_id_unique` (`consignment_id`),
  ADD KEY `pathao_orders_order_id_index` (`order_id`),
  ADD KEY `pathao_orders_consignment_id_index` (`consignment_id`),
  ADD KEY `pathao_orders_merchant_order_id_index` (`merchant_order_id`),
  ADD KEY `pathao_orders_order_status_index` (`order_status`),
  ADD KEY `pathao_orders_store_id_index` (`store_id`);

--
-- Indexes for table `pathao_tracking_history`
--
ALTER TABLE `pathao_tracking_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pathao_tracking_history_pathao_order_id_index` (`pathao_order_id`),
  ADD KEY `pathao_tracking_history_status_index` (`status`),
  ADD KEY `pathao_tracking_history_timestamp_index` (`timestamp`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_methods_type_is_active_index` (`type`,`is_active`);

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
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_attribute_family_id_foreign` (`attribute_family_id`),
  ADD KEY `products_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chanel_locale_attribute_value_index_unique` (`channel`,`locale`,`attribute_id`,`product_id`),
  ADD UNIQUE KEY `product_attribute_values_unique_id_unique` (`unique_id`),
  ADD KEY `product_attribute_values_attribute_id_foreign` (`attribute_id`),
  ADD KEY `prod_attr_product_id_idx` (`product_id`);

--
-- Indexes for table `product_bundle_options`
--
ALTER TABLE `product_bundle_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_bundle_options_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_bundle_option_products`
--
ALTER TABLE `product_bundle_option_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bundle_option_products_product_id_bundle_option_id_unique` (`product_id`,`product_bundle_option_id`),
  ADD KEY `pbop_option_id_idx` (`product_bundle_option_id`);

--
-- Indexes for table `product_bundle_option_translations`
--
ALTER TABLE `product_bundle_option_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_bundle_option_translations_option_id_locale_unique` (`product_bundle_option_id`,`locale`),
  ADD UNIQUE KEY `bundle_option_translations_locale_label_bundle_option_id_unique` (`locale`,`label`,`product_bundle_option_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD UNIQUE KEY `product_categories_product_id_category_id_unique` (`product_id`,`category_id`),
  ADD KEY `product_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_channels`
--
ALTER TABLE `product_channels`
  ADD UNIQUE KEY `product_channels_product_id_channel_id_unique` (`product_id`,`channel_id`),
  ADD KEY `product_channels_channel_id_foreign` (`channel_id`),
  ADD KEY `pc_product_id_channel_id_idx` (`product_id`,`channel_id`);

--
-- Indexes for table `product_cross_sells`
--
ALTER TABLE `product_cross_sells`
  ADD UNIQUE KEY `product_cross_sells_parent_id_child_id_unique` (`parent_id`,`child_id`),
  ADD KEY `product_cross_sells_child_id_foreign` (`child_id`);

--
-- Indexes for table `product_customer_group_prices`
--
ALTER TABLE `product_customer_group_prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_customer_group_prices_unique_id_unique` (`unique_id`),
  ADD KEY `product_customer_group_prices_product_id_foreign` (`product_id`),
  ADD KEY `product_customer_group_prices_customer_group_id_foreign` (`customer_group_id`);

--
-- Indexes for table `product_customizable_options`
--
ALTER TABLE `product_customizable_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_customizable_options_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_customizable_option_prices`
--
ALTER TABLE `product_customizable_option_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pcop_product_customizable_option_id_foreign` (`product_customizable_option_id`);

--
-- Indexes for table `product_customizable_option_translations`
--
ALTER TABLE `product_customizable_option_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_customizable_option_id_locale_unique` (`product_customizable_option_id`,`locale`);

--
-- Indexes for table `product_downloadable_links`
--
ALTER TABLE `product_downloadable_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_downloadable_links_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_downloadable_link_translations`
--
ALTER TABLE `product_downloadable_link_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_translations_link_id_foreign` (`product_downloadable_link_id`);

--
-- Indexes for table `product_downloadable_samples`
--
ALTER TABLE `product_downloadable_samples`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_downloadable_samples_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_downloadable_sample_translations`
--
ALTER TABLE `product_downloadable_sample_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sample_translations_sample_id_foreign` (`product_downloadable_sample_id`);

--
-- Indexes for table `product_flat`
--
ALTER TABLE `product_flat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_flat_unique_index` (`product_id`,`channel`,`locale`),
  ADD KEY `product_flat_attribute_family_id_foreign` (`attribute_family_id`),
  ADD KEY `product_flat_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `product_grouped_products`
--
ALTER TABLE `product_grouped_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grouped_products_product_id_associated_product_id_unique` (`product_id`,`associated_product_id`),
  ADD KEY `product_grouped_products_associated_product_id_foreign` (`associated_product_id`),
  ADD KEY `pgp_product_id_idx` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_img_product_id_idx` (`product_id`);

--
-- Indexes for table `product_inventories`
--
ALTER TABLE `product_inventories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_source_vendor_index_unique` (`product_id`,`inventory_source_id`,`vendor_id`),
  ADD KEY `product_inventories_inventory_source_id_foreign` (`inventory_source_id`);

--
-- Indexes for table `product_inventory_indices`
--
ALTER TABLE `product_inventory_indices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_inventory_indices_product_id_channel_id_unique` (`product_id`,`channel_id`),
  ADD KEY `product_inventory_indices_channel_id_foreign` (`channel_id`),
  ADD KEY `prod_inv_product_id_idx` (`product_id`);

--
-- Indexes for table `product_ordered_inventories`
--
ALTER TABLE `product_ordered_inventories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_ordered_inventories_product_id_channel_id_unique` (`product_id`,`channel_id`),
  ADD KEY `product_ordered_inventories_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `product_price_indices`
--
ALTER TABLE `product_price_indices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `price_indices_product_id_customer_group_id_channel_id_unique` (`product_id`,`customer_group_id`,`channel_id`),
  ADD KEY `product_price_indices_customer_group_id_foreign` (`customer_group_id`),
  ADD KEY `product_price_indices_channel_id_foreign` (`channel_id`),
  ADD KEY `ppi_product_id_customer_group_id_idx` (`product_id`,`customer_group_id`);

--
-- Indexes for table `product_relations`
--
ALTER TABLE `product_relations`
  ADD UNIQUE KEY `product_relations_parent_id_child_id_unique` (`parent_id`,`child_id`),
  ADD KEY `product_relations_child_id_foreign` (`child_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_rev_product_id_idx` (`product_id`);

--
-- Indexes for table `product_review_attachments`
--
ALTER TABLE `product_review_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_review_images_review_id_foreign` (`review_id`);

--
-- Indexes for table `product_super_attributes`
--
ALTER TABLE `product_super_attributes`
  ADD UNIQUE KEY `product_super_attributes_product_id_attribute_id_unique` (`product_id`,`attribute_id`),
  ADD KEY `product_super_attributes_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `product_up_sells`
--
ALTER TABLE `product_up_sells`
  ADD UNIQUE KEY `product_up_sells_parent_id_child_id_unique` (`parent_id`,`child_id`),
  ADD KEY `product_up_sells_child_id_foreign` (`child_id`);

--
-- Indexes for table `product_videos`
--
ALTER TABLE `product_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_vid_product_id_idx` (`product_id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refunds_order_id_foreign` (`order_id`);

--
-- Indexes for table `refund_items`
--
ALTER TABLE `refund_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refund_items_parent_id_foreign` (`parent_id`),
  ADD KEY `refund_items_order_item_id_foreign` (`order_item_id`),
  ADD KEY `refund_items_refund_id_foreign` (`refund_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_synonyms`
--
ALTER TABLE `search_synonyms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_terms`
--
ALTER TABLE `search_terms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `search_terms_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipments_order_id_foreign` (`order_id`),
  ADD KEY `shipments_inventory_source_id_foreign` (`inventory_source_id`);

--
-- Indexes for table `shipment_items`
--
ALTER TABLE `shipment_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment_items_shipment_id_foreign` (`shipment_id`);

--
-- Indexes for table `sitemaps`
--
ALTER TABLE `sitemaps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers_list`
--
ALTER TABLE `subscribers_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscribers_list_customer_id_foreign` (`customer_id`),
  ADD KEY `subscribers_list_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `tax_categories`
--
ALTER TABLE `tax_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tax_categories_code_unique` (`code`);

--
-- Indexes for table `tax_categories_tax_rates`
--
ALTER TABLE `tax_categories_tax_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tax_map_index_unique` (`tax_category_id`,`tax_rate_id`),
  ADD KEY `tax_categories_tax_rates_tax_rate_id_foreign` (`tax_rate_id`);

--
-- Indexes for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tax_rates_identifier_unique` (`identifier`);

--
-- Indexes for table `theme_customizations`
--
ALTER TABLE `theme_customizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theme_customizations_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `theme_customization_translations`
--
ALTER TABLE `theme_customization_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theme_customization_id_foreign` (`theme_customization_id`);

--
-- Indexes for table `url_rewrites`
--
ALTER TABLE `url_rewrites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url_rewrites_et_rp_lc_idx` (`entity_type`,`request_path`,`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visits_visitable_type_visitable_id_index` (`visitable_type`,`visitable_id`),
  ADD KEY `visits_visitor_type_visitor_id_index` (`visitor_type`,`visitor_id`),
  ADD KEY `visits_cid_ip_m_vid_vt_ca_idx` (`channel_id`,`ip`,`method`,`visitor_id`,`visitor_type`,`created_at`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_channel_id_foreign` (`channel_id`),
  ADD KEY `wishlist_product_id_foreign` (`product_id`),
  ADD KEY `wishlist_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_items_channel_id_foreign` (`channel_id`),
  ADD KEY `wishlist_items_product_id_foreign` (`product_id`),
  ADD KEY `wishlist_items_customer_id_foreign` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `attribute_families`
--
ALTER TABLE `attribute_families`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attribute_groups`
--
ALTER TABLE `attribute_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attribute_options`
--
ALTER TABLE `attribute_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `attribute_option_translations`
--
ALTER TABLE `attribute_option_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `attribute_translations`
--
ALTER TABLE `attribute_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_products`
--
ALTER TABLE `booking_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_product_appointment_slots`
--
ALTER TABLE `booking_product_appointment_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_product_default_slots`
--
ALTER TABLE `booking_product_default_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_product_event_tickets`
--
ALTER TABLE `booking_product_event_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_product_event_ticket_translations`
--
ALTER TABLE `booking_product_event_ticket_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_product_rental_slots`
--
ALTER TABLE `booking_product_rental_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_product_table_slots`
--
ALTER TABLE `booking_product_table_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_item_inventories`
--
ALTER TABLE `cart_item_inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_payment`
--
ALTER TABLE `cart_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_rules`
--
ALTER TABLE `cart_rules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_rule_coupons`
--
ALTER TABLE `cart_rule_coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_rule_coupon_usage`
--
ALTER TABLE `cart_rule_coupon_usage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_rule_customers`
--
ALTER TABLE `cart_rule_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_rule_translations`
--
ALTER TABLE `cart_rule_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_shipping_rates`
--
ALTER TABLE `cart_shipping_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `catalog_rules`
--
ALTER TABLE `catalog_rules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catalog_rule_products`
--
ALTER TABLE `catalog_rule_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catalog_rule_product_prices`
--
ALTER TABLE `catalog_rule_product_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `channel_translations`
--
ALTER TABLE `channel_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cms_page_translations`
--
ALTER TABLE `cms_page_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `compare_items`
--
ALTER TABLE `compare_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `core_config`
--
ALTER TABLE `core_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `country_states`
--
ALTER TABLE `country_states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=587;

--
-- AUTO_INCREMENT for table `country_state_translations`
--
ALTER TABLE `country_state_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country_translations`
--
ALTER TABLE `country_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `currency_exchange_rates`
--
ALTER TABLE `currency_exchange_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_notes`
--
ALTER TABLE `customer_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_social_accounts`
--
ALTER TABLE `customer_social_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `datagrid_saved_filters`
--
ALTER TABLE `datagrid_saved_filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_partners`
--
ALTER TABLE `delivery_partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `downloadable_link_purchased`
--
ALTER TABLE `downloadable_link_purchased`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gdpr_data_request`
--
ALTER TABLE `gdpr_data_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imports`
--
ALTER TABLE `imports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `import_batches`
--
ALTER TABLE `import_batches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_sources`
--
ALTER TABLE `inventory_sources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locales`
--
ALTER TABLE `locales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marketing_campaigns`
--
ALTER TABLE `marketing_campaigns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketing_events`
--
ALTER TABLE `marketing_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marketing_templates`
--
ALTER TABLE `marketing_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_comments`
--
ALTER TABLE `order_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_payment`
--
ALTER TABLE `order_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_transactions`
--
ALTER TABLE `order_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pathao_orders`
--
ALTER TABLE `pathao_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pathao_tracking_history`
--
ALTER TABLE `pathao_tracking_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `product_bundle_options`
--
ALTER TABLE `product_bundle_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_bundle_option_products`
--
ALTER TABLE `product_bundle_option_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_bundle_option_translations`
--
ALTER TABLE `product_bundle_option_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_customer_group_prices`
--
ALTER TABLE `product_customer_group_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_customizable_options`
--
ALTER TABLE `product_customizable_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_customizable_option_prices`
--
ALTER TABLE `product_customizable_option_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_customizable_option_translations`
--
ALTER TABLE `product_customizable_option_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_downloadable_links`
--
ALTER TABLE `product_downloadable_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_downloadable_link_translations`
--
ALTER TABLE `product_downloadable_link_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_downloadable_samples`
--
ALTER TABLE `product_downloadable_samples`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_downloadable_sample_translations`
--
ALTER TABLE `product_downloadable_sample_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_flat`
--
ALTER TABLE `product_flat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_grouped_products`
--
ALTER TABLE `product_grouped_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_inventories`
--
ALTER TABLE `product_inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_inventory_indices`
--
ALTER TABLE `product_inventory_indices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_ordered_inventories`
--
ALTER TABLE `product_ordered_inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_price_indices`
--
ALTER TABLE `product_price_indices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_review_attachments`
--
ALTER TABLE `product_review_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_videos`
--
ALTER TABLE `product_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_items`
--
ALTER TABLE `refund_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `search_synonyms`
--
ALTER TABLE `search_synonyms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `search_terms`
--
ALTER TABLE `search_terms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipment_items`
--
ALTER TABLE `shipment_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sitemaps`
--
ALTER TABLE `sitemaps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers_list`
--
ALTER TABLE `subscribers_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tax_categories`
--
ALTER TABLE `tax_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax_categories_tax_rates`
--
ALTER TABLE `tax_categories_tax_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theme_customizations`
--
ALTER TABLE `theme_customizations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `theme_customization_translations`
--
ALTER TABLE `theme_customization_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `url_rewrites`
--
ALTER TABLE `url_rewrites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `addresses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `addresses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `addresses_parent_address_id_foreign` FOREIGN KEY (`parent_address_id`) REFERENCES `addresses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `attribute_groups`
--
ALTER TABLE `attribute_groups`
  ADD CONSTRAINT `attribute_groups_attribute_family_id_foreign` FOREIGN KEY (`attribute_family_id`) REFERENCES `attribute_families` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_group_mappings`
--
ALTER TABLE `attribute_group_mappings`
  ADD CONSTRAINT `attribute_group_mappings_attribute_group_id_foreign` FOREIGN KEY (`attribute_group_id`) REFERENCES `attribute_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_group_mappings_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD CONSTRAINT `attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_option_translations`
--
ALTER TABLE `attribute_option_translations`
  ADD CONSTRAINT `attribute_option_translations_attribute_option_id_foreign` FOREIGN KEY (`attribute_option_id`) REFERENCES `attribute_options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_translations`
--
ALTER TABLE `attribute_translations`
  ADD CONSTRAINT `attribute_translations_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_booking_product_event_ticket_id_foreign` FOREIGN KEY (`booking_product_event_ticket_id`) REFERENCES `booking_product_event_tickets` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `booking_products`
--
ALTER TABLE `booking_products`
  ADD CONSTRAINT `booking_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_product_appointment_slots`
--
ALTER TABLE `booking_product_appointment_slots`
  ADD CONSTRAINT `booking_product_appointment_slots_booking_product_id_foreign` FOREIGN KEY (`booking_product_id`) REFERENCES `booking_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_product_default_slots`
--
ALTER TABLE `booking_product_default_slots`
  ADD CONSTRAINT `booking_product_default_slots_booking_product_id_foreign` FOREIGN KEY (`booking_product_id`) REFERENCES `booking_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_product_event_tickets`
--
ALTER TABLE `booking_product_event_tickets`
  ADD CONSTRAINT `booking_product_event_tickets_booking_product_id_foreign` FOREIGN KEY (`booking_product_id`) REFERENCES `booking_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_product_event_ticket_translations`
--
ALTER TABLE `booking_product_event_ticket_translations`
  ADD CONSTRAINT `bpet_translations_fk` FOREIGN KEY (`booking_product_event_ticket_id`) REFERENCES `booking_product_event_tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_product_rental_slots`
--
ALTER TABLE `booking_product_rental_slots`
  ADD CONSTRAINT `booking_product_rental_slots_booking_product_id_foreign` FOREIGN KEY (`booking_product_id`) REFERENCES `booking_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_product_table_slots`
--
ALTER TABLE `booking_product_table_slots`
  ADD CONSTRAINT `booking_product_table_slots_booking_product_id_foreign` FOREIGN KEY (`booking_product_id`) REFERENCES `booking_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `cart_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_tax_category_id_foreign` FOREIGN KEY (`tax_category_id`) REFERENCES `tax_categories` (`id`);

--
-- Constraints for table `cart_payment`
--
ALTER TABLE `cart_payment`
  ADD CONSTRAINT `cart_payment_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_rule_channels`
--
ALTER TABLE `cart_rule_channels`
  ADD CONSTRAINT `cart_rule_channels_cart_rule_id_foreign` FOREIGN KEY (`cart_rule_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_channels_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_rule_coupons`
--
ALTER TABLE `cart_rule_coupons`
  ADD CONSTRAINT `cart_rule_coupons_cart_rule_id_foreign` FOREIGN KEY (`cart_rule_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_rule_coupon_usage`
--
ALTER TABLE `cart_rule_coupon_usage`
  ADD CONSTRAINT `cart_rule_coupon_usage_cart_rule_coupon_id_foreign` FOREIGN KEY (`cart_rule_coupon_id`) REFERENCES `cart_rule_coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_coupon_usage_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_rule_customers`
--
ALTER TABLE `cart_rule_customers`
  ADD CONSTRAINT `cart_rule_customers_cart_rule_id_foreign` FOREIGN KEY (`cart_rule_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_customers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_rule_customer_groups`
--
ALTER TABLE `cart_rule_customer_groups`
  ADD CONSTRAINT `cart_rule_customer_groups_cart_rule_id_foreign` FOREIGN KEY (`cart_rule_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_rule_customer_groups_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_rule_translations`
--
ALTER TABLE `cart_rule_translations`
  ADD CONSTRAINT `cart_rule_translations_cart_rule_id_foreign` FOREIGN KEY (`cart_rule_id`) REFERENCES `cart_rules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_shipping_rates`
--
ALTER TABLE `cart_shipping_rates`
  ADD CONSTRAINT `cart_shipping_rates_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `catalog_rule_channels`
--
ALTER TABLE `catalog_rule_channels`
  ADD CONSTRAINT `catalog_rule_channels_catalog_rule_id_foreign` FOREIGN KEY (`catalog_rule_id`) REFERENCES `catalog_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_channels_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `catalog_rule_customer_groups`
--
ALTER TABLE `catalog_rule_customer_groups`
  ADD CONSTRAINT `catalog_rule_customer_groups_catalog_rule_id_foreign` FOREIGN KEY (`catalog_rule_id`) REFERENCES `catalog_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_customer_groups_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `catalog_rule_products`
--
ALTER TABLE `catalog_rule_products`
  ADD CONSTRAINT `catalog_rule_products_catalog_rule_id_foreign` FOREIGN KEY (`catalog_rule_id`) REFERENCES `catalog_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_products_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_products_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `catalog_rule_product_prices`
--
ALTER TABLE `catalog_rule_product_prices`
  ADD CONSTRAINT `catalog_rule_product_prices_catalog_rule_id_foreign` FOREIGN KEY (`catalog_rule_id`) REFERENCES `catalog_rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_product_prices_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_product_prices_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_rule_product_prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_filterable_attributes`
--
ALTER TABLE `category_filterable_attributes`
  ADD CONSTRAINT `category_filterable_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_filterable_attributes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD CONSTRAINT `category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_translations_locale_id_foreign` FOREIGN KEY (`locale_id`) REFERENCES `locales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `channels`
--
ALTER TABLE `channels`
  ADD CONSTRAINT `channels_base_currency_id_foreign` FOREIGN KEY (`base_currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `channels_default_locale_id_foreign` FOREIGN KEY (`default_locale_id`) REFERENCES `locales` (`id`),
  ADD CONSTRAINT `channels_root_category_id_foreign` FOREIGN KEY (`root_category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `channel_currencies`
--
ALTER TABLE `channel_currencies`
  ADD CONSTRAINT `channel_currencies_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `channel_currencies_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `channel_inventory_sources`
--
ALTER TABLE `channel_inventory_sources`
  ADD CONSTRAINT `channel_inventory_sources_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `channel_inventory_sources_inventory_source_id_foreign` FOREIGN KEY (`inventory_source_id`) REFERENCES `inventory_sources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `channel_locales`
--
ALTER TABLE `channel_locales`
  ADD CONSTRAINT `channel_locales_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `channel_locales_locale_id_foreign` FOREIGN KEY (`locale_id`) REFERENCES `locales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `channel_translations`
--
ALTER TABLE `channel_translations`
  ADD CONSTRAINT `channel_translations_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cms_page_channels`
--
ALTER TABLE `cms_page_channels`
  ADD CONSTRAINT `cms_page_channels_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_page_channels_cms_page_id_foreign` FOREIGN KEY (`cms_page_id`) REFERENCES `cms_pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cms_page_translations`
--
ALTER TABLE `cms_page_translations`
  ADD CONSTRAINT `cms_page_translations_cms_page_id_foreign` FOREIGN KEY (`cms_page_id`) REFERENCES `cms_pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compare_items`
--
ALTER TABLE `compare_items`
  ADD CONSTRAINT `compare_items_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compare_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `country_states`
--
ALTER TABLE `country_states`
  ADD CONSTRAINT `country_states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `country_state_translations`
--
ALTER TABLE `country_state_translations`
  ADD CONSTRAINT `country_state_translations_country_state_id_foreign` FOREIGN KEY (`country_state_id`) REFERENCES `country_states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD CONSTRAINT `country_translations_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `currency_exchange_rates`
--
ALTER TABLE `currency_exchange_rates`
  ADD CONSTRAINT `currency_exchange_rates_target_currency_foreign` FOREIGN KEY (`target_currency`) REFERENCES `currencies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `customers_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `customer_notes`
--
ALTER TABLE `customer_notes`
  ADD CONSTRAINT `customer_notes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_social_accounts`
--
ALTER TABLE `customer_social_accounts`
  ADD CONSTRAINT `customer_social_accounts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `downloadable_link_purchased`
--
ALTER TABLE `downloadable_link_purchased`
  ADD CONSTRAINT `downloadable_link_purchased_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `downloadable_link_purchased_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `downloadable_link_purchased_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gdpr_data_request`
--
ALTER TABLE `gdpr_data_request`
  ADD CONSTRAINT `gdpr_data_request_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `import_batches`
--
ALTER TABLE `import_batches`
  ADD CONSTRAINT `import_batches_import_id_foreign` FOREIGN KEY (`import_id`) REFERENCES `imports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `invoice_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marketing_campaigns`
--
ALTER TABLE `marketing_campaigns`
  ADD CONSTRAINT `marketing_campaigns_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `marketing_campaigns_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `marketing_campaigns_marketing_event_id_foreign` FOREIGN KEY (`marketing_event_id`) REFERENCES `marketing_events` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `marketing_campaigns_marketing_template_id_foreign` FOREIGN KEY (`marketing_template_id`) REFERENCES `marketing_templates` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_comments`
--
ALTER TABLE `order_comments`
  ADD CONSTRAINT `order_comments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_tax_category_id_foreign` FOREIGN KEY (`tax_category_id`) REFERENCES `tax_categories` (`id`);

--
-- Constraints for table `order_payment`
--
ALTER TABLE `order_payment`
  ADD CONSTRAINT `order_payment_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_transactions`
--
ALTER TABLE `order_transactions`
  ADD CONSTRAINT `order_transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pathao_orders`
--
ALTER TABLE `pathao_orders`
  ADD CONSTRAINT `pathao_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pathao_tracking_history`
--
ALTER TABLE `pathao_tracking_history`
  ADD CONSTRAINT `pathao_tracking_history_pathao_order_id_foreign` FOREIGN KEY (`pathao_order_id`) REFERENCES `pathao_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_attribute_family_id_foreign` FOREIGN KEY (`attribute_family_id`) REFERENCES `attribute_families` (`id`),
  ADD CONSTRAINT `products_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD CONSTRAINT `product_attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attribute_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_bundle_options`
--
ALTER TABLE `product_bundle_options`
  ADD CONSTRAINT `product_bundle_options_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_bundle_option_products`
--
ALTER TABLE `product_bundle_option_products`
  ADD CONSTRAINT `product_bundle_option_id_foreign` FOREIGN KEY (`product_bundle_option_id`) REFERENCES `product_bundle_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_bundle_option_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_bundle_option_translations`
--
ALTER TABLE `product_bundle_option_translations`
  ADD CONSTRAINT `product_bundle_option_translations_option_id_foreign` FOREIGN KEY (`product_bundle_option_id`) REFERENCES `product_bundle_options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_channels`
--
ALTER TABLE `product_channels`
  ADD CONSTRAINT `product_channels_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_channels_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_cross_sells`
--
ALTER TABLE `product_cross_sells`
  ADD CONSTRAINT `product_cross_sells_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_cross_sells_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_customer_group_prices`
--
ALTER TABLE `product_customer_group_prices`
  ADD CONSTRAINT `product_customer_group_prices_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_customer_group_prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_customizable_options`
--
ALTER TABLE `product_customizable_options`
  ADD CONSTRAINT `product_customizable_options_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_customizable_option_prices`
--
ALTER TABLE `product_customizable_option_prices`
  ADD CONSTRAINT `pcop_product_customizable_option_id_foreign` FOREIGN KEY (`product_customizable_option_id`) REFERENCES `product_customizable_options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_customizable_option_translations`
--
ALTER TABLE `product_customizable_option_translations`
  ADD CONSTRAINT `pcot_product_customizable_option_id_foreign` FOREIGN KEY (`product_customizable_option_id`) REFERENCES `product_customizable_options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_downloadable_links`
--
ALTER TABLE `product_downloadable_links`
  ADD CONSTRAINT `product_downloadable_links_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_downloadable_link_translations`
--
ALTER TABLE `product_downloadable_link_translations`
  ADD CONSTRAINT `link_translations_link_id_foreign` FOREIGN KEY (`product_downloadable_link_id`) REFERENCES `product_downloadable_links` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_downloadable_samples`
--
ALTER TABLE `product_downloadable_samples`
  ADD CONSTRAINT `product_downloadable_samples_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_downloadable_sample_translations`
--
ALTER TABLE `product_downloadable_sample_translations`
  ADD CONSTRAINT `sample_translations_sample_id_foreign` FOREIGN KEY (`product_downloadable_sample_id`) REFERENCES `product_downloadable_samples` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_flat`
--
ALTER TABLE `product_flat`
  ADD CONSTRAINT `product_flat_attribute_family_id_foreign` FOREIGN KEY (`attribute_family_id`) REFERENCES `attribute_families` (`id`),
  ADD CONSTRAINT `product_flat_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `product_flat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_flat_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_grouped_products`
--
ALTER TABLE `product_grouped_products`
  ADD CONSTRAINT `product_grouped_products_associated_product_id_foreign` FOREIGN KEY (`associated_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_grouped_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_inventories`
--
ALTER TABLE `product_inventories`
  ADD CONSTRAINT `product_inventories_inventory_source_id_foreign` FOREIGN KEY (`inventory_source_id`) REFERENCES `inventory_sources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_inventory_indices`
--
ALTER TABLE `product_inventory_indices`
  ADD CONSTRAINT `product_inventory_indices_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_inventory_indices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_ordered_inventories`
--
ALTER TABLE `product_ordered_inventories`
  ADD CONSTRAINT `product_ordered_inventories_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ordered_inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_price_indices`
--
ALTER TABLE `product_price_indices`
  ADD CONSTRAINT `product_price_indices_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_price_indices_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_price_indices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_relations`
--
ALTER TABLE `product_relations`
  ADD CONSTRAINT `product_relations_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_relations_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_review_attachments`
--
ALTER TABLE `product_review_attachments`
  ADD CONSTRAINT `product_review_images_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `product_reviews` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_super_attributes`
--
ALTER TABLE `product_super_attributes`
  ADD CONSTRAINT `product_super_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`),
  ADD CONSTRAINT `product_super_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_up_sells`
--
ALTER TABLE `product_up_sells`
  ADD CONSTRAINT `product_up_sells_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_up_sells_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_videos`
--
ALTER TABLE `product_videos`
  ADD CONSTRAINT `product_videos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `refund_items`
--
ALTER TABLE `refund_items`
  ADD CONSTRAINT `refund_items_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refund_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `refund_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refund_items_refund_id_foreign` FOREIGN KEY (`refund_id`) REFERENCES `refunds` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `search_terms`
--
ALTER TABLE `search_terms`
  ADD CONSTRAINT `search_terms_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_inventory_source_id_foreign` FOREIGN KEY (`inventory_source_id`) REFERENCES `inventory_sources` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shipments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipment_items`
--
ALTER TABLE `shipment_items`
  ADD CONSTRAINT `shipment_items_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscribers_list`
--
ALTER TABLE `subscribers_list`
  ADD CONSTRAINT `subscribers_list_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscribers_list_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tax_categories_tax_rates`
--
ALTER TABLE `tax_categories_tax_rates`
  ADD CONSTRAINT `tax_categories_tax_rates_tax_category_id_foreign` FOREIGN KEY (`tax_category_id`) REFERENCES `tax_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tax_categories_tax_rates_tax_rate_id_foreign` FOREIGN KEY (`tax_rate_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `theme_customizations`
--
ALTER TABLE `theme_customizations`
  ADD CONSTRAINT `theme_customizations_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `theme_customization_translations`
--
ALTER TABLE `theme_customization_translations`
  ADD CONSTRAINT `theme_customization_id_foreign` FOREIGN KEY (`theme_customization_id`) REFERENCES `theme_customizations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD CONSTRAINT `wishlist_items_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_items_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
