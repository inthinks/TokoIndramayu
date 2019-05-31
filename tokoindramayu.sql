-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2019 at 02:41 PM
-- Server version: 5.6.30-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokoindramayu`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1433172536),
('customer', '19', 1434908454),
('customer', '20', 1434908513),
('customer', '21', 1434908933),
('customer', '26', 1436302919),
('customer', '3', 1433172536),
('member', '16', 1433182981),
('member', '17', 1434907232),
('member', '18', 1434907841),
('member', '2', 1433172536),
('member', '22', 1434908955),
('member', '23', 1436300724),
('member', '24', 1436300867),
('member', '25', 1436301040),
('member', '4', 1433178675),
('member', '6', 1433178816);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1433172536, 1433172536),
('create', 2, 'Create', NULL, NULL, 1433172535, 1433172535),
('customer', 1, NULL, NULL, NULL, 1433172536, 1433172536),
('delete', 2, 'Delete', NULL, NULL, 1433172536, 1433172536),
('member', 1, NULL, NULL, NULL, 1433172536, 1433172536),
('update', 2, 'Update', NULL, NULL, 1433172535, 1433172535),
('view', 2, 'View', NULL, NULL, 1433172535, 1433172535);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('customer', 'create'),
('member', 'customer'),
('admin', 'delete'),
('admin', 'member'),
('customer', 'update'),
('customer', 'view');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 'O:30:"mdm\\admin\\components\\RouteRule":3:{s:4:"name";s:5:"admin";s:9:"createdAt";i:1433570844;s:9:"updatedAt";i:1433570844;}', 1433570844, 1433570844);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `cart_code` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `title`, `slug`) VALUES
(6, NULL, 'makana', 'makana'),
(7, NULL, 'Pakaian', 'pakaian'),
(8, NULL, 'minuman', 'minuman'),
(9, 6, 'tahu', 'tahu'),
(10, 7, 'Batik', NULL),
(11, 8, 'dingin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `confirm_payment`
--

CREATE TABLE IF NOT EXISTS `confirm_payment` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_code` varchar(17) NOT NULL,
  `text_detail` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `no_telp` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_upload`
--

CREATE TABLE IF NOT EXISTS `log_upload` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `fileori` varchar(255) DEFAULT NULL,
  `params` longblob,
  `values` longblob,
  `warning` longblob,
  `keys` text,
  `type` tinyint(1) DEFAULT NULL,
  `userCreate` int(11) DEFAULT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `updateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nim`) VALUES
(1, 'sdjlasjdlaj', '213123791'),
(2, 'nama', 'nim'),
(3, 'nama', 'nim');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1431915594),
('m130524_201442_init', 1431915597),
('m140506_102106_rbac_init', 1432198881);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL,
  `order_code` varchar(17) NOT NULL,
  `order_date` datetime NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `bank_transfer` varchar(50) NOT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_code`, `order_date`, `address`, `phone`, `email`, `user_id`, `bank_transfer`, `payment_status`, `note`) VALUES
(1, '1', '2015-07-09 00:36:57', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '123456', 'New', NULL),
(4, '4', '2015-07-09 00:44:43', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '124567', 'New', NULL),
(5, '4', '2015-07-09 00:46:07', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '124567', 'New', NULL),
(6, '4', '2015-07-09 00:46:32', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '124567', 'New', NULL),
(7, '4', '2015-07-09 00:50:39', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '124567', 'New', NULL),
(8, '4', '2015-07-09 00:55:55', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '124567', 'New', NULL),
(9, '4', '2015-07-09 00:56:31', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '124567', 'New', NULL),
(10, '4', '2015-07-09 00:58:47', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '234567', 'New', NULL),
(11, '4', '2015-07-09 01:01:22', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '234567', 'New', NULL),
(13, '4', '2015-07-09 01:04:21', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '34321', 'New', NULL),
(14, '4', '2015-07-09 01:05:24', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '34321', 'New', NULL),
(15, '4', '2015-07-09 01:05:47', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '0798079', 'New', NULL),
(16, '4', '2015-07-09 01:08:07', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '2398194798', 'New', NULL),
(17, '4', '2015-07-09 01:18:23', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, 'dfskdjhfj', 'New', 'sdhfiehofdkjs'),
(18, '4', '2015-07-09 01:22:20', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '12', 'New', 'fagua;osbdj,fwa;lfhsdafglisdagksadlgk'),
(19, '4', '2015-07-09 01:23:19', 'Jl. Pabean Kencana', '08934234443', 'customer@gmail.com', 3, '2364982348273', 'New', 'dahasdjakj');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` int(11) NOT NULL,
  `order_code` varchar(13) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(19,4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_code`, `order_id`, `product_id`, `toko_id`, `email`, `quantity`, `price`) VALUES
(1, '2', 2, 1, 1, '', 1, '67.0000'),
(2, '3', 3, 2, 1, '', 1, '890.0000'),
(3, '3', 4, 2, 1, '', 1, '890.0000'),
(4, '3', 10, 2, 1, '', 1, '890.0000'),
(5, '3', 13, 2, 1, '', 1, '890.0000'),
(6, '3', 15, 3, 1, '', 1, '50.0000'),
(7, '3', 16, 3, 1, '', 1, '50.0000'),
(8, '3', 17, 2, 1, '', 1, '890.0000'),
(9, '3', 18, 1, 1, '', 2, '67.0000'),
(10, '3', 19, 1, 1, '', 2, '67.0000');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` bigint(18) NOT NULL,
  `category_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `image` varchar(555) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `price`, `category_id`, `stock`, `user_id`, `toko_id`, `image`) VALUES
(1, 'ddf', 'fsdgsdgsdgfdsf67', 67, 7, 23, 16, 1, '1280x960-bumblebee-shooting (FILEminimizer).jpg'),
(2, 'ajfalskj', 'adhkashdj', 890, 10, 20, 16, 1, 'muka.jpg'),
(3, 'asdhkajs', 'asfsa', 50, 6, 24, 16, 1, '11017683_10204301581839946_3184403578969725193_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE IF NOT EXISTS `production` (
  `id` int(11) NOT NULL,
  `JenisProduksi` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`id`, `JenisProduksi`) VALUES
(1, 'Pakaian'),
(2, 'Makanan');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Pengelola` varchar(45) NOT NULL,
  `alamat` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(555) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `Pengelola`, `alamat`, `description`, `image`) VALUES
(12, 3, 'indra', 'indra', 'indra', NULL),
(13, 16, 'indra Ari', 'Jl. Tenggiri Raya No. 49 BPPK Pabean Kencana Kecamatan I 12ndramayu Kabupaten Indramayu.', 'Menjual berbagai makanan Khas Indramayu dengan menggunakan beberapa produk unggulan yang berbeda dengan yang lainnya.', NULL),
(14, 18, 'indra', 'indra', 'indra', NULL),
(15, 23, 'Indra', 'INdramayu', 'menjual berbagai makanan khas indramayu', NULL),
(16, 24, 'inin', 'inininni', 'ininininin', NULL),
(17, 25, 'ini', 'ini', 'ini', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` smallint(6) NOT NULL,
  `role_name` varchar(45) NOT NULL,
  `role_value` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `role_value`) VALUES
(1, 'Member', 10),
(2, 'Admin', 20),
(3, 'Customer', 15);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` smallint(6) NOT NULL,
  `status_name` varchar(45) NOT NULL,
  `status_value` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_name`, `status_value`) VALUES
(1, 'Active', 10),
(3, 'Pending', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dynagrid`
--

CREATE TABLE IF NOT EXISTS `tbl_dynagrid` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid setting identifier',
  `filter_id` varchar(100) DEFAULT NULL COMMENT 'Filter setting identifier',
  `sort_id` varchar(100) DEFAULT NULL COMMENT 'Sort setting identifier',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid configuration'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dynagrid_dtl`
--

CREATE TABLE IF NOT EXISTS `tbl_dynagrid_dtl` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid detail setting identifier',
  `category` varchar(10) NOT NULL COMMENT 'Dynagrid detail setting category "filter" or "sort"',
  `name` varchar(150) NOT NULL COMMENT 'Name to identify the dynagrid detail setting',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid detail configuration',
  `dynagrid_id` varchar(100) NOT NULL COMMENT 'Related dynagrid identifier'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE IF NOT EXISTS `toko` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(45) NOT NULL,
  `production_id` int(11) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `nama_toko`, `production_id`, `profile_id`, `user_id`) VALUES
(1, 'try', 1, NULL, 16),
(2, 'Baru', 1, NULL, 22),
(3, 'barulagi', 2, NULL, 18),
(4, 'Indra Toko', 2, NULL, 23),
(5, 'inin', 1, NULL, 24),
(6, 'ini', 2, NULL, 25);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `role_id` smallint(6) NOT NULL DEFAULT '10',
  `status_id` smallint(6) NOT NULL DEFAULT '10',
  `user_type_id` smallint(6) NOT NULL DEFAULT '10',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `name`, `phone`, `avatar`, `province`, `city`, `address`, `role_id`, `status_id`, `user_type_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'uaoqU-hwGVIpadhs7wL7vOLUHuZVTzPw', '$2y$13$WeSuXpCcLsROujc10vzZ..P96YrdKS5Lh3fL0RIMo99r8KhpryG4S', '9K12swJ0fdzSCMU4GDm64LnbgxqV0fVP_1432924932', 'ind_ari08@yahoo.com', 'Indra Ari', '089614572923', '@web/images/avatar/1/polindra.jpg', NULL, 'Indramayu', NULL, 20, 10, 10, '2015-05-18 23:43:39', '2015-07-08 01:56:59'),
(2, 'indra', '1-xARuZQgoQWoqY4NQbUjDhyNqIzB7vs', '$2y$13$1sqwg.ibJ.v1q2jKd1PeaOuDjt7/gO7pWGTggLXGJYMLINmBPn.gm', NULL, 'indra@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, 10, 10, 10, '2015-06-01 22:17:30', '2015-06-01 22:17:30'),
(3, 'customer', 'TRUCydxkm2IHnuK84xMTjdUmFGid--xr', '$2y$13$Gu1jArNLjjGYE1MSErY9eemFK1sE07nOSY5Qb./AQ9RIDvdiGOFwO', NULL, 'customer@gmail.com', 'Indra', '08934234443', NULL, 'Jawa Barat', 'Indramayu', 'Jl. Pabean Kencana', 15, 10, 10, '2015-05-22 19:34:54', '2015-05-22 19:34:54'),
(4, 'test', 'myFYoT74lJSRmp4ODwd7yuyiurdk9BPr', '$2y$13$Q4Kp9c5cSm1V78EZFwRaX.7reGjIQ03nwo4VXEoCQjs5sttzWsMm6', NULL, 'test@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, 10, 10, 10, '2015-05-24 02:26:05', '2015-05-24 02:26:05'),
(16, 'indra222', 'vmLAj0fs9w8mh002juSIedqECt-4ooSC', '$2y$13$LSPzqpjuGoUW3K48FOMdcuUF/0AO4P2flDPf0orGvioxUzWIP8lWC', NULL, 'indra222@yahoo.com', 'Indra ari ardian', '08977336', '@web/images/avatar/16/php.jpg', 'Jawa Barat', 'Indramayu', 'Pabean Indramayu', 10, 10, 10, '2015-06-02 01:23:01', '2015-07-08 01:17:05'),
(17, 'indra22', 'RZMK1WPpZQMuqTE9UcpJ3iIwCKOSBarA', '$2y$13$oaMdpLgR/O.UToh2T6iTwOmbm5bQGwpCFBILoShl/nuHegndowIGa', NULL, 'i@a.com', NULL, NULL, NULL, NULL, NULL, NULL, 10, 10, 10, '2015-06-22 00:20:31', '2015-06-22 00:20:31'),
(18, 'indra2', 'X35rUyi4Kolr28gU3PL8lk7H3KRxeweg', '$2y$13$9E1xSXV29rc0cPtLKXmGMe4DP5Ixk9dvQqT4b1zhzFdaIzAGdTtwK', NULL, '2@a.com', NULL, NULL, NULL, NULL, NULL, NULL, 10, 10, 10, '2015-06-22 00:30:41', '2015-06-22 00:30:41'),
(19, 'indra1', 'eT6CNO5-QDB23V510celSiFukm6EzL-L', '$2y$13$WYmE9qO3tRVxaiGGM/oLDeXM0Cp2hRlaB180vwGSm3y5GBerff6Oe', NULL, '1@a.com', NULL, NULL, NULL, NULL, NULL, NULL, 15, 10, 10, '2015-06-22 00:40:54', '2015-06-22 00:40:54'),
(20, 'indra11', 'V-G0DmtNILoIUrifXuaRFSofjqLpX9au', '$2y$13$Cg3.j95s.ob0pxEVALL1/OlHoglkFEJko7UJGZ8ag3kV.LYj39qYW', NULL, '11@a.com', NULL, NULL, NULL, NULL, NULL, NULL, 15, 10, 10, '2015-06-22 00:41:53', '2015-06-22 00:41:53'),
(21, 'indra111', '9mg10gtZofUTHHT_0like6Ql_aydqtho', '$2y$13$ZqPU5Pu2Omie1dvSoglbdOfp1ihqWPiWr3isTAO/btspWQOeNdPiy', NULL, '111@a.com', NULL, NULL, NULL, NULL, NULL, NULL, 15, 10, 10, '2015-06-22 00:48:53', '2015-06-22 00:48:53'),
(22, 'indra3', '7e_RqCmFnnjDE-6biJAtHCJ0s4_y7WcE', '$2y$13$cjXYw/5lXB/Cy41m30o9B.6ZW1UuT2pPheueMklhLtnioQbMLopPC', NULL, '3@a.com', NULL, NULL, NULL, NULL, NULL, NULL, 10, 10, 10, '2015-06-22 00:49:15', '2015-06-22 00:49:15'),
(23, 'indraindra', '_RgGFBXZdF6eXrGmo_Fa9thLLyJCbIoA', '$2y$13$iTVMBbqim17k8UWueBWSKODqMxNOU33O9iHoWsxabXVykDB40J.Uu', NULL, 'i@i.com', NULL, NULL, NULL, NULL, NULL, NULL, 10, 10, 10, '2015-07-08 03:25:24', '2015-07-08 03:25:24'),
(24, 'inin', 'cy3IkwnIpF_RD7h1qIofqaHk8eoyWqGV', '$2y$13$3GqA5fHFdjQeAyYDCiDih.wdE/2hS7iHOAEMpZyGEuE7ZUGfD5n3q', NULL, 'in@in.com', NULL, NULL, NULL, NULL, NULL, NULL, 10, 10, 10, '2015-07-08 03:27:47', '2015-07-08 03:27:47'),
(25, 'ini', 'MgwBGAjAVV9HQyYVVou--Gle8XHyA-Ex', '$2y$13$3rCOIyZcLId.Fz0tl2t0OeGTmu3olDVo6zWdVLJKUWlx593.VosQi', NULL, 'ini@a.com', NULL, NULL, NULL, NULL, NULL, NULL, 10, 10, 10, '2015-07-08 03:30:40', '2015-07-08 03:30:40'),
(26, 'ani', '2R5xIA-kwsR-LBvz3a5P3NHcA-Xf5Nra', '$2y$13$lMKMu0zvmLTOh4xLkBF1B.Y/aB9zK.gm2dgd9Q99lGnow4iTz/Dp2', NULL, 'ani@a.com', NULL, NULL, NULL, NULL, NULL, NULL, 15, 10, 10, '2015-07-08 04:01:58', '2015-07-08 04:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` smallint(6) NOT NULL,
  `user_type_name` varchar(45) NOT NULL,
  `user_type_value` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `user_type_name`, `user_type_value`) VALUES
(1, 'Free', 10),
(2, 'Paid', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-category-parent_id-category-id` (`parent_id`);

--
-- Indexes for table `confirm_payment`
--
ALTER TABLE `confirm_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_upload`
--
ALTER TABLE `log_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `toko_id` (`toko_id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_value` (`role_value`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_value` (`status_value`);

--
-- Indexes for table `tbl_dynagrid`
--
ALTER TABLE `tbl_dynagrid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_dynagrid_FK1` (`filter_id`),
  ADD KEY `tbl_dynagrid_FK2` (`sort_id`);

--
-- Indexes for table `tbl_dynagrid_dtl`
--
ALTER TABLE `tbl_dynagrid_dtl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_dynagrid_dtl_UK1` (`name`,`category`,`dynagrid_id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `production_id` (`production_id`),
  ADD KEY `profile_id` (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`,`status_id`,`user_type_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type_value` (`user_type_value`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `confirm_payment`
--
ALTER TABLE `confirm_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_upload`
--
ALTER TABLE `log_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk-category-parent_id-category-id` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `tk_id` FOREIGN KEY (`toko_id`) REFERENCES `toko` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usr_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_dynagrid`
--
ALTER TABLE `tbl_dynagrid`
  ADD CONSTRAINT `tbl_dynagrid_FK1` FOREIGN KEY (`filter_id`) REFERENCES `tbl_dynagrid_dtl` (`id`),
  ADD CONSTRAINT `tbl_dynagrid_FK2` FOREIGN KEY (`sort_id`) REFERENCES `tbl_dynagrid_dtl` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
