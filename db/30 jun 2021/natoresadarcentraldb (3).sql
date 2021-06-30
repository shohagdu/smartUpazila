-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2021 at 03:22 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `natoresadarcentraldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_menu_info`
--

CREATE TABLE `acl_menu_info` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT NULL,
  `glyphicon_icon` varchar(50) DEFAULT NULL,
  `display_position` int(6) DEFAULT NULL,
  `is_main_menu` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(3) UNSIGNED DEFAULT 1 COMMENT '0= deleted, 1= Active, 2= Inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acl_menu_info`
--

INSERT INTO `acl_menu_info` (`id`, `title`, `link`, `parent_id`, `glyphicon_icon`, `display_position`, `is_main_menu`, `is_active`, `created_by`, `created_ip`, `created_at`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 'Home', '#', NULL, 'fa fa-lg fa-fw fa-cog', 1, 1, 1, 1, '::1', '2021-06-30 04:29:01', NULL, '2021-06-30 04:29:01', NULL),
(2, 'উপজেলা সম্পর্কে', 'people', 1, NULL, 1, 2, 1, 1, '::1', '2021-06-30 04:30:46', NULL, '2021-06-30 04:30:46', NULL),
(3, 'নোটিশ', 'notice', 1, NULL, 2, 2, 1, 1, '::1', '2021-06-30 04:31:37', NULL, '2021-06-30 04:31:37', NULL),
(4, 'সাংগঠনিক কাঠামো', 'sangotonik-katamo', 1, NULL, 3, 2, 1, 1, '::1', '2021-06-30 04:32:32', NULL, '2021-06-30 04:32:32', NULL),
(5, 'Slider', 'slider', 1, NULL, 4, 2, 1, 1, '::1', '2021-06-30 04:33:13', NULL, '2021-06-30 04:33:13', NULL),
(6, 'Social media', 'social-media', 1, NULL, 5, 2, 1, 1, '::1', '2021-06-30 04:34:00', NULL, '2021-06-30 04:34:00', NULL),
(7, 'Footer Area', 'footer-area', 1, NULL, 6, 2, 1, 1, '::1', '2021-06-30 04:34:47', NULL, '2021-06-30 04:34:47', NULL),
(8, 'Dynamic content page', 'dynamic-content-page', 1, NULL, 7, 2, 1, 1, '::1', '2021-06-30 04:35:21', NULL, '2021-06-30 04:35:21', NULL),
(9, 'উপজেলা সম্পর্কিত', '#', NULL, 'fa fa-lg fa-fw fa-cog', 2, 1, 1, 1, '::1', '2021-06-30 04:36:11', NULL, '2021-06-30 04:36:11', NULL),
(10, 'উপজেলা পরিচিতি', 'upazilaIntroduction', 9, NULL, 1, 2, 1, 1, '::1', '2021-06-30 04:36:58', NULL, '2021-06-30 04:36:58', NULL),
(11, 'ইতিহাস ঐতিহ্য', 'upazilaHistory', 9, NULL, 2, 2, 1, 1, '::1', '2021-06-30 04:37:34', 1, '2021-06-30 04:37:54', '::1'),
(12, 'ভৌগলিক ও অর্থনৈতিক', 'upazilaGeographical', 9, NULL, 3, 2, 1, 1, '::1', '2021-06-30 04:39:23', NULL, '2021-06-30 04:39:23', NULL),
(13, 'জনপ্রতিনিধিগণের তালিকা', 'upPublicPeprestative', 9, NULL, 4, 2, 1, 1, '::1', '2021-06-30 04:40:09', NULL, '2021-06-30 04:40:09', NULL),
(14, 'মুক্তিযোদ্ধাদের তালিকা', 'freedom_fighter', 9, NULL, 5, 2, 1, 1, '::1', '2021-06-30 04:40:58', NULL, '2021-06-30 04:40:58', NULL),
(15, 'উপজেলা পরিষদ', '#', NULL, 'fa fa-lg fa-fw fa-cog', 3, 1, 1, 1, '::1', '2021-06-30 04:41:28', NULL, '2021-06-30 04:41:28', NULL),
(16, 'চেয়ারম্যান, উপজেলা পরিষদ', 'upazila_chairman', 15, NULL, 1, 2, 1, 1, '::1', '2021-06-30 04:43:25', NULL, '2021-06-30 04:43:25', NULL),
(17, 'ভাইস চেয়ারম্যান', 'upazila_vice_chairman', 15, NULL, 2, 2, 1, 1, '::1', '2021-06-30 04:46:07', NULL, '2021-06-30 04:46:07', NULL),
(18, 'মহিলা ভাইস চেয়ারম্যান', 'upazila_female_vice_chairman', 15, NULL, 3, 2, 1, 1, '::1', '2021-06-30 04:46:43', NULL, '2021-06-30 04:46:43', NULL),
(19, 'উপজেলা পরিষদের কার্যাবলী', 'parisad-kajjoboli', 15, NULL, 4, 2, 1, 1, '::1', '2021-06-30 04:47:30', NULL, '2021-06-30 04:47:30', NULL),
(20, 'পৌরসভা সম্পর্কিত', '#', NULL, 'fa fa-lg fa-fw fa-cog', 4, 1, 1, 1, '::1', '2021-06-30 04:48:15', NULL, '2021-06-30 04:48:15', NULL),
(21, 'এক নজরে পৌরসভা', 'pourosova-at-glance', 20, NULL, 1, 2, 1, 1, '::1', '2021-06-30 04:50:07', NULL, '2021-06-30 04:50:07', NULL),
(22, 'মেয়র', 'pourosova_mayor', 20, NULL, 2, 2, 1, 1, '::1', '2021-06-30 04:51:14', NULL, '2021-06-30 04:51:14', NULL),
(23, 'কাউন্সিলরগণ', 'pourosova_councilor', 20, NULL, 3, 2, 1, 1, '::1', '2021-06-30 04:51:53', NULL, '2021-06-30 04:51:53', NULL),
(24, 'কর্মকর্তাবৃন্দ', 'pourosova_kormokorta', 20, NULL, 4, 2, 1, 1, '::1', '2021-06-30 04:52:34', NULL, '2021-06-30 04:52:34', NULL),
(25, 'ওয়ার্ডসমূহ', 'pourosovaWard', 20, NULL, 5, 2, 1, 1, '::1', '2021-06-30 04:53:06', NULL, '2021-06-30 04:53:06', NULL),
(26, 'কর্মচারীবৃন্দ', 'pourosova_kormocari', 20, NULL, 6, 2, 1, 1, '::1', '2021-06-30 04:58:55', NULL, '2021-06-30 04:58:55', NULL),
(27, 'সিটিজেন চার্টার', 'citizen-charter', 20, NULL, 7, 2, 1, 1, '::1', '2021-06-30 04:59:30', NULL, '2021-06-30 04:59:30', NULL),
(28, 'সরকারি প্রতিষ্ঠান', '#', NULL, 'fa fa-lg fa-fw fa-cog', 5, 1, 1, 1, '::1', '2021-06-30 05:01:42', NULL, '2021-06-30 05:01:42', NULL),
(29, 'আইন-শৃঙ্খলা বিষয়ক', 'lowAndOrder', 28, NULL, 1, 2, 1, 1, '::1', '2021-06-30 05:02:41', NULL, '2021-06-30 05:02:41', NULL),
(30, 'স্বাস্থ্য বিষয়ক', '\'health-issues', 28, NULL, 2, 2, 1, 1, '::1', '2021-06-30 05:12:32', NULL, '2021-06-30 05:12:32', NULL),
(31, 'কৃষি ও খাদ্য বিষয়ক', 'agriculture-and-food', 28, NULL, 3, 2, 1, 1, '::1', '2021-06-30 05:13:20', NULL, '2021-06-30 05:13:20', NULL),
(32, 'ভূমি বিষয়ক', 'land-matters', 28, NULL, 4, 2, 1, 1, '::1', '2021-06-30 05:14:04', NULL, '2021-06-30 05:14:04', NULL),
(33, 'প্রকৌশল ও যোগাযোগ', 'govt-engineers', 28, NULL, 5, 2, 1, 1, '::1', '2021-06-30 05:14:41', NULL, '2021-06-30 05:14:41', NULL),
(34, 'অন্যান্য প্রতিষ্ঠান', '#', NULL, 'fa fa-lg fa-fw fa-cog', 6, 1, 1, 1, '::1', '2021-06-30 05:15:30', NULL, '2021-06-30 05:15:30', NULL),
(35, 'শিক্ষা প্রতিষ্ঠান', 'ducational-institutions', 34, NULL, 1, 2, 1, 1, '::1', '2021-06-30 05:16:25', NULL, '2021-06-30 05:16:25', NULL),
(36, 'বেসরকারি প্রতিষ্ঠান', 'non_govt-organizations', 34, NULL, 2, 2, 1, 1, '::1', '2021-06-30 05:17:41', NULL, '2021-06-30 05:17:41', NULL),
(37, 'ধর্মীয় প্রতিষ্ঠান', 'religious-institutions', 34, NULL, 3, 2, 1, 1, '::1', '2021-06-30 05:18:14', NULL, '2021-06-30 05:18:14', NULL),
(38, 'মহোদয়ের তথ্য', '#', NULL, 'fa fa-lg fa-fw fa-cog', 7, 1, 1, 1, '::1', '2021-06-30 05:25:02', NULL, '2021-06-30 05:25:02', NULL),
(39, 'ডিসি মহোদয়ের তথ্য', 'dc-info', 38, NULL, 1, 2, 1, 1, '::1', '2021-06-30 05:25:43', NULL, '2021-06-30 05:25:43', NULL),
(40, 'ইউএনও মহোদয়ের তথ্য', 'uno-info', 38, NULL, 2, 2, 1, 1, '::1', '2021-06-30 05:26:30', NULL, '2021-06-30 05:26:30', NULL),
(41, 'চেয়ারম্যান মহোদয়ের তথ্য', 'chairman-info', 38, NULL, 3, 2, 1, 1, '::1', '2021-06-30 05:27:25', NULL, '2021-06-30 05:27:25', NULL),
(42, 'Reports', '#', NULL, 'fa fa-lg fa-fw fa-cog', 8, 1, 1, 1, '::1', '2021-06-30 05:29:54', NULL, '2021-06-30 05:29:54', NULL),
(43, 'ভিজিডি', '#', 42, NULL, 1, 2, 1, 1, '::1', '2021-06-30 05:30:20', NULL, '2021-06-30 05:30:20', NULL),
(44, 'খাদ্য বান্ধব কর্মসূচি', '#', 42, NULL, 2, 2, 1, 1, '::1', '2021-06-30 05:30:46', NULL, '2021-06-30 05:30:46', NULL),
(45, 'Setup', '#', NULL, 'fa fa-lg fa-fw fa-cog', 9, 1, 1, 1, '::1', '2021-06-30 05:31:24', NULL, '2021-06-30 05:31:24', NULL),
(46, 'Union Setup', 'unionSetup', 45, NULL, 1, 2, 1, 1, '::1', '2021-06-30 05:32:30', NULL, '2021-06-30 05:32:30', NULL),
(47, 'Upazila Setup', 'upazilaSetup', 45, NULL, 2, 2, 1, 1, '::1', '2021-06-30 05:33:18', NULL, '2021-06-30 05:33:18', NULL),
(48, 'All Type Title', 'all-type-title', 45, NULL, 3, 2, 1, 1, '::1', '2021-06-30 05:33:53', NULL, '2021-06-30 05:33:53', NULL),
(49, 'User', '#', NULL, 'fa fa-lg fa-fw fa-user', 10, 1, 1, 1, '::1', '2021-06-30 05:35:18', NULL, '2021-06-30 05:35:18', NULL),
(50, 'User list', 'user-list', 49, NULL, 1, 2, 1, 1, '::1', '2021-06-30 05:36:00', NULL, '2021-06-30 05:36:00', NULL),
(51, 'User Create', 'user/create', 49, NULL, 2, 2, 1, 1, '::1', '2021-06-30 05:36:40', NULL, '2021-06-30 05:36:40', NULL),
(52, 'Acl Menu list', 'acl-menu-list', 49, NULL, 3, 2, 1, 1, '::1', '2021-06-30 05:37:28', NULL, '2021-06-30 05:37:28', NULL),
(53, 'Acl Menu Create', 'acl-menu/create', 49, NULL, 5, 2, 1, 1, '::1', '2021-06-30 05:40:14', NULL, '2021-06-30 05:40:14', NULL),
(54, 'Acl Role list', 'acl-role-list', 49, NULL, 5, 2, 1, 1, '::1', '2021-06-30 05:40:57', NULL, '2021-06-30 05:40:57', NULL),
(55, 'Acl Role Create', 'acl-role/create', 49, NULL, 6, 2, 1, 1, '::1', '2021-06-30 05:41:32', NULL, '2021-06-30 05:41:32', NULL),
(56, 'Change Password', '#', NULL, 'fa fa-lg fa-fw fa fa-key', 11, 1, 1, 1, '::1', '2021-06-30 05:42:38', NULL, '2021-06-30 05:42:38', NULL),
(57, 'Sign Out', 'logout', NULL, 'fa fa-lg fa-fw fa fa-sign-out', 12, 1, 1, 1, '::1', '2021-06-30 05:43:35', NULL, '2021-06-30 05:43:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_role_info`
--

CREATE TABLE `acl_role_info` (
  `id` int(11) UNSIGNED NOT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `role_info` text DEFAULT NULL,
  `is_active` tinyint(3) UNSIGNED DEFAULT 1 COMMENT '0= deleted, 1= Active, 2= Inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acl_role_info`
--

INSERT INTO `acl_role_info` (`id`, `role_name`, `role_info`, `is_active`, `created_by`, `created_ip`, `created_at`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 'Admin', '{\"1\":{\"2\":2,\"3\":3,\"4\":4,\"5\":5,\"6\":6,\"7\":7,\"8\":8},\"9\":{\"10\":10,\"11\":11,\"12\":12,\"13\":13,\"14\":14},\"15\":{\"16\":16,\"17\":17,\"18\":18,\"19\":19},\"20\":{\"21\":21,\"22\":22,\"23\":23,\"24\":24,\"25\":25,\"26\":26,\"27\":27},\"28\":{\"29\":29,\"30\":30,\"31\":31,\"32\":32,\"33\":33},\"34\":{\"35\":35,\"36\":36,\"37\":37},\"38\":{\"39\":39,\"40\":40,\"41\":41},\"42\":{\"43\":43,\"44\":44},\"45\":{\"46\":46,\"47\":47,\"48\":48},\"49\":{\"50\":50,\"51\":51,\"52\":52,\"53\":53,\"54\":54,\"55\":55},\"56\":56,\"57\":57}', 1, 1, '::1', '2021-06-30 08:15:00', NULL, NULL, NULL),
(2, 'udc', '{\"1\":{\"3\":3},\"9\":{\"11\":11,\"12\":12},\"56\":56,\"57\":57}', 1, 1, '::1', '2021-06-30 08:15:54', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `all_type_titles`
--

CREATE TABLE `all_type_titles` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1= upazila porichito,',
  `display_position` int(11) UNSIGNED NOT NULL,
  `is_default` tinyint(3) UNSIGNED DEFAULT 1,
  `is_active` tinyint(3) UNSIGNED DEFAULT 1 COMMENT '0= deleted, 1= Active, 2= Inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `all_type_titles`
--

INSERT INTO `all_type_titles` (`id`, `title`, `type`, `display_position`, `is_default`, `is_active`, `created_by`, `created_ip`, `created_at`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(9, 'ইউনিয়নের সংখ্যা', 1, 1, 1, 1, 1, '127.0.0.1', '2021-06-02 13:26:32', NULL, '2021-06-02 13:26:32', NULL),
(10, 'পৌরসভা', 1, 2, 1, 1, 1, '127.0.0.1', '2021-06-02 13:26:54', NULL, '2021-06-02 13:26:54', NULL),
(11, 'মৌজা', 1, 3, 1, 1, 1, '127.0.0.1', '2021-06-02 13:27:11', NULL, '2021-06-02 13:27:11', NULL),
(12, 'গ্রাম', 1, 4, 1, 1, 1, '127.0.0.1', '2021-06-02 13:27:27', NULL, '2021-06-02 13:27:27', NULL),
(13, 'কত জন পৌরসভার সদস্য', 2, 1, 1, 1, 1, '::1', '2021-06-19 07:07:49', NULL, '2021-06-19 07:07:49', NULL),
(14, 'প্রশাসনিক বিভাগ', 3, 1, 1, 1, 1, '::1', '2021-06-19 19:21:31', NULL, '2021-06-19 19:21:31', NULL),
(15, 'প্রশাসন বিভাগের পারিবারিক আদালদের সেবা', 3, 2, 1, 1, 1, '::1', '2021-06-19 19:29:50', 1, '2021-06-19 19:29:58', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `dc_uno_chairman_info`
--

CREATE TABLE `dc_uno_chairman_info` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `bcs_batch` int(6) UNSIGNED DEFAULT NULL,
  `address` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `division_id` int(10) UNSIGNED DEFAULT NULL,
  `district_id` int(10) UNSIGNED DEFAULT NULL,
  `upazila_id` int(10) UNSIGNED DEFAULT NULL,
  `union_name` text DEFAULT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1= DC, 2= UNO, 3= Chairman',
  `is_active` tinyint(3) UNSIGNED DEFAULT 1 COMMENT '0= deleted, 1= Active, 2= Inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(2) UNSIGNED NOT NULL,
  `division_id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `bn_name` varchar(50) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `website` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `website`) VALUES
(1, 3, 'Dhaka', 'ঢাকা', 23.7115253, 90.4111451, 'www.dhaka.gov.bd'),
(2, 3, 'Faridpur', 'ফরিদপুর', 23.6070822, 89.8429406, 'www.faridpur.gov.bd'),
(3, 3, 'Gazipur', 'গাজীপুর', 24.0022858, 90.4264283, 'www.gazipur.gov.bd'),
(4, 3, 'Gopalganj', 'গোপালগঞ্জ', 23.0050857, 89.8266059, 'www.gopalganj.gov.bd'),
(5, 8, 'Jamalpur', 'জামালপুর', 24.937533, 89.937775, 'www.jamalpur.gov.bd'),
(6, 3, 'Kishoreganj', 'কিশোরগঞ্জ', 24.444937, 90.776575, 'www.kishoreganj.gov.bd'),
(7, 3, 'Madaripur', 'মাদারীপুর', 23.164102, 90.1896805, 'www.madaripur.gov.bd'),
(8, 3, 'Manikganj', 'মানিকগঞ্জ', 0, 0, 'www.manikganj.gov.bd'),
(9, 3, 'Munshiganj', 'মুন্সিগঞ্জ', 0, 0, 'www.munshiganj.gov.bd'),
(10, 8, 'Mymensingh', 'ময়মনসিংহ', 0, 0, 'www.mymensingh.gov.bd'),
(11, 3, 'Narayanganj', 'নারায়াণগঞ্জ', 23.63366, 90.496482, 'www.narayanganj.gov.bd'),
(12, 3, 'Narsingdi', 'নরসিংদী', 23.932233, 90.71541, 'www.narsingdi.gov.bd'),
(13, 8, 'Netrokona', 'নেত্রকোণা', 24.870955, 90.727887, 'www.netrokona.gov.bd'),
(14, 3, 'Rajbari', 'রাজবাড়ি', 23.7574305, 89.6444665, 'www.rajbari.gov.bd'),
(15, 3, 'Shariatpur', 'শরীয়তপুর', 0, 0, 'www.shariatpur.gov.bd'),
(16, 8, 'Sherpur', 'শেরপুর', 25.0204933, 90.0152966, 'www.sherpur.gov.bd'),
(17, 3, 'Tangail', 'টাঙ্গাইল', 0, 0, 'www.tangail.gov.bd'),
(18, 5, 'Bogura', 'বগুড়া', 24.8465228, 89.377755, 'www.bogra.gov.bd'),
(19, 5, 'Joypurhat', 'জয়পুরহাট', 0, 0, 'www.joypurhat.gov.bd'),
(20, 5, 'Naogaon', 'নওগাঁ', 0, 0, 'www.naogaon.gov.bd'),
(21, 5, 'Natore', 'নাটোর', 24.420556, 89.000282, 'www.natore.gov.bd'),
(22, 5, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', 24.5965034, 88.2775122, 'www.chapainawabganj.gov.bd'),
(23, 5, 'Pabna', 'পাবনা', 23.998524, 89.233645, 'www.pabna.gov.bd'),
(24, 5, 'Rajshahi', 'রাজশাহী', 0, 0, 'www.rajshahi.gov.bd'),
(25, 5, 'Sirajgonj', 'সিরাজগঞ্জ', 24.4533978, 89.7006815, 'www.sirajganj.gov.bd'),
(26, 6, 'Dinajpur', 'দিনাজপুর', 25.6217061, 88.6354504, 'www.dinajpur.gov.bd'),
(27, 6, 'Gaibandha', 'গাইবান্ধা', 25.328751, 89.528088, 'www.gaibandha.gov.bd'),
(28, 6, 'Kurigram', 'কুড়িগ্রাম', 25.805445, 89.636174, 'www.kurigram.gov.bd'),
(29, 6, 'Lalmonirhat', 'লালমনিরহাট', 0, 0, 'www.lalmonirhat.gov.bd'),
(30, 6, 'Nilphamari', 'নীলফামারী', 25.931794, 88.856006, 'www.nilphamari.gov.bd'),
(31, 6, 'Panchagarh', 'পঞ্চগড়', 26.3411, 88.5541606, 'www.panchagarh.gov.bd'),
(32, 6, 'Rangpur', 'রংপুর', 25.7558096, 89.244462, 'www.rangpur.gov.bd'),
(33, 6, 'Thakurgaon', 'ঠাকুরগাঁও', 26.0336945, 88.4616834, 'www.thakurgaon.gov.bd'),
(34, 1, 'Barguna', 'বরগুনা', 0, 0, 'www.barguna.gov.bd'),
(35, 1, 'Barishal', 'বরিশাল', 0, 0, 'www.barisal.gov.bd'),
(36, 1, 'Bhola', 'ভোলা', 22.685923, 90.648179, 'www.bhola.gov.bd'),
(37, 1, 'Jhalokati', 'ঝালকাঠি', 0, 0, 'www.jhalakathi.gov.bd'),
(38, 1, 'Patuakhali', 'পটুয়াখালী', 22.3596316, 90.3298712, 'www.patuakhali.gov.bd'),
(39, 1, 'Pirojpur', 'পিরোজপুর', 0, 0, 'www.pirojpur.gov.bd'),
(40, 2, 'Bandarban', 'বান্দরবান', 22.1953275, 92.2183773, 'www.bandarban.gov.bd'),
(41, 2, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', 23.9570904, 91.1119286, 'www.brahmanbaria.gov.bd'),
(42, 2, 'Chandpur', 'চাঁদপুর', 23.2332585, 90.6712912, 'www.chandpur.gov.bd'),
(43, 2, 'Chattogram', 'চট্টগ্রাম', 22.335109, 91.834073, 'www.chittagong.gov.bd'),
(44, 2, 'Cumilla', 'কুমিল্লা', 23.4682747, 91.1788135, 'www.comilla.gov.bd'),
(45, 2, 'Cox\'s Bazar', 'কক্স বাজার', 0, 0, 'www.coxsbazar.gov.bd'),
(46, 2, 'Feni', 'ফেনী', 23.023231, 91.3840844, 'www.feni.gov.bd'),
(47, 2, 'Khagrachhari', 'খাগড়াছড়ি', 23.119285, 91.984663, 'www.khagrachhari.gov.bd'),
(48, 2, 'Lakshmipur', 'লক্ষ্মীপুর', 22.942477, 90.841184, 'www.lakshmipur.gov.bd'),
(49, 2, 'Noakhali', 'নোয়াখালী', 22.869563, 91.099398, 'www.noakhali.gov.bd'),
(50, 2, 'Rangamati', 'রাঙ্গামাটি', 0, 0, 'www.rangamati.gov.bd'),
(51, 7, 'Habiganj', 'হবিগঞ্জ', 24.374945, 91.41553, 'www.habiganj.gov.bd'),
(52, 7, 'Moulvibazar', 'মৌলভীবাজার', 24.482934, 91.777417, 'www.moulvibazar.gov.bd'),
(53, 7, 'Sunamganj', 'সুনামগঞ্জ', 25.0658042, 91.3950115, 'www.sunamganj.gov.bd'),
(54, 7, 'Sylhet', 'সিলেট', 24.8897956, 91.8697894, 'www.sylhet.gov.bd'),
(55, 4, 'Bagerhat', 'বাগেরহাট', 22.651568, 89.785938, 'www.bagerhat.gov.bd'),
(56, 4, 'Chuadanga', 'চুয়াডাঙ্গা', 23.6401961, 88.841841, 'www.chuadanga.gov.bd'),
(57, 4, 'Jashore', 'যশোর', 23.16643, 89.2081126, 'www.jessore.gov.bd'),
(58, 4, 'Jhenaidah', 'ঝিনাইদহ', 23.5448176, 89.1539213, 'www.jhenaidah.gov.bd'),
(59, 4, 'Khulna', 'খুলনা', 22.815774, 89.568679, 'www.khulna.gov.bd'),
(60, 4, 'Kushtia', 'কুষ্টিয়া', 23.901258, 89.120482, 'www.kushtia.gov.bd'),
(61, 4, 'Magura', 'মাগুরা', 23.487337, 89.419956, 'www.magura.gov.bd'),
(62, 4, 'Meherpur', 'মেহেরপুর', 23.762213, 88.631821, 'www.meherpur.gov.bd'),
(63, 4, 'Narail', 'নড়াইল', 23.172534, 89.512672, 'www.narail.gov.bd'),
(64, 4, 'Satkhira', 'সাতক্ষীরা', 0, 0, 'www.satkhira.gov.bd');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `bn_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`) VALUES
(1, 'Barishal', 'বরিশাল'),
(2, 'Chattogram', 'চট্টগ্রাম'),
(3, 'Dhaka', 'ঢাকা'),
(4, 'Khulna', 'খুলনা'),
(5, 'Rajshahi', 'রাজশাহী'),
(6, 'Rangpur', 'রংপুর'),
(7, 'Sylhet', 'সিলেট'),
(8, 'Mymensingh', 'ময়মনসিংহ');

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_content_page`
--

CREATE TABLE `dynamic_content_page` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `attachment` varchar(200) DEFAULT NULL,
  `url_path` varchar(150) DEFAULT NULL,
  `is_active` tinyint(3) DEFAULT NULL COMMENT '''0= deleted, 1= Active, 2= Inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dynamic_content_page`
--

INSERT INTO `dynamic_content_page` (`id`, `title`, `details`, `remarks`, `attachment`, `url_path`, `is_active`, `created_by`, `created_ip`, `created_at`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 'Nagorik sonod probelm', '<p>dzvzcZXCzX</p>', 'xzczxxzcxz fddsfdff', NULL, 'abc', 1, 1, '::1', '2021-06-19 12:18:13', 1, '2021-06-19 12:31:40', '::1'),
(2, 'Nulla et iure praese  333', '<p>vdgs hrtg hedfbfd&nbsp;</p>', 'Perferendis tenetur', 'dynamic_content_page_1624105123.png', 'abc2', 0, 1, '::1', '2021-06-19 12:30:45', NULL, NULL, NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `footer_areas`
--

CREATE TABLE `footer_areas` (
  `id` int(11) UNSIGNED NOT NULL,
  `privacy_policy` text DEFAULT NULL,
  `terms_of_use` text DEFAULT NULL,
  `in_overall_cooperation` text DEFAULT NULL,
  `sitemap` text DEFAULT NULL,
  `commonly_asked` text DEFAULT NULL,
  `is_active` tinyint(3) UNSIGNED DEFAULT 1 COMMENT '0= deleted, 1= Active, 2= Inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `footer_areas`
--

INSERT INTO `footer_areas` (`id`, `privacy_policy`, `terms_of_use`, `in_overall_cooperation`, `sitemap`, `commonly_asked`, `is_active`, `created_by`, `created_ip`, `created_at`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(8, '{\"privacy_policy\":\"<h3>ব্যবহারের শর্তাবলি<\\/h3>\\r\\n\\r\\n<p><strong>ব্যবহারের শর্তাবলি<\\/strong><br \\/>\\r\\nআমাদের&nbsp;ওয়েবপোর্টাল দেখার জন্য আপনাকে ধন্যবাদ। বাংলাদেশ সরকারের ওয়েব পোর্টাল&nbsp;সরকারের সেবা সংক্রান্ত হালনাগাদ&nbsp;তথ্য সরবরাহের একটি&nbsp;উদ্যোগ। এই ওয়েবপোর্টালটি প্রধানমন্ত্রীর কার্যালয় কর্তৃক পরিচালিত। এই ওয়েবপোর্টালটি ব্যবহার করার জন্য আপনাকে অবশ্যই কিছু শর্তাবলি মেনে চলতে হবে, যা আপনি এই সাইটে প্রবেশ করা মাত্রই প্রযোজ্য।<br \\/>\\r\\n&nbsp;<br \\/>\\r\\n<strong>শর্তাবলি :<\\/strong><br \\/>\\r\\n১. প্রধানমন্ত্রীর কার্যালয় বাংলাদেশ জাতীয় তথ্য বাতায়নের সাথে লিংককৃত অন্যান্য সাইটের কোন তথ্যের জন্য কোন ধরণের আর্থিক সহায়তা প্রদান&nbsp;করে না।<br \\/>\\r\\n২.&nbsp;এই ওয়েবসাইটের তথ্য এবং লিংককৃত ওয়েবসাইটের তথ্য ব্যবহার করার ফলে&nbsp;প্রত্যক্ষ্য বা অপ্রত্যক্ষভাবে কোন ক্ষতির সম্মুখীন হলে তার জন্য কোন&nbsp;দায়দায়িত্ব এই কার্যালয়&nbsp;গ্রহণ করবে না ।<br \\/>\\r\\n৩. এই ওয়েবসাইটের&nbsp;কর্মকাণ্ডের কোনো ধরনের অবিচ্ছিন্নতার জন্য প্রধানমন্ত্রীর কার্যালয় নিশ্চয়তা প্রদান করবে না ।<\\/p>\\r\\n\\r\\n<p>&nbsp;<br \\/>\\r\\n<strong>তথ্যের কাজ এবং প্রিন্ট<\\/strong><br \\/>\\r\\nএই&nbsp;তথ্য বাতায়নের সকল ব্যবহারকারী ওয়েবসাইটে প্রদর্শিত সকল তথ্যের কোন রকম&nbsp;পরিমার্জন,&nbsp;সংযুক্তিকরণ এবং সংশোধন ব্যতীত প্রিন্ট করতে পারবেন। কিন্তু&nbsp;এই পোটার্লে প্রকাশিত কোন তথ্য যা বাংলাদেশ সরকারের নয়,&nbsp;এবং যাতে অন্য&nbsp;কোনো সংস্থার কপিরাইট রয়েছে সেক্ষেত্রে সে সংস্থার অনুমতি গ্রহণ করতে হবে।<br \\/>\\r\\n&nbsp;<br \\/>\\r\\n<strong>অন্যান্য ওয়েবসাইটের সঙ্গে সংযোগ<\\/strong><br \\/>\\r\\nএই তথ্য বাতায়নের সঙ্গে অন্যান্য যে সকল ওয়েবসাইটের সংযোগ রয়েছে যা প্রধানমন্ত্রীর কার্যালয় কর্তৃক পরিচালিত নয় কিংবা এর নিয়ন্ত্রণাধীন নয়। এই ধরনের সংযোগকৃত ওয়েবসাইটের কনটেন্ট এবং তা সবসময় কার্যকর ও হালনাগাদ রাখার দায়িত্ব সংশ্লিষ্ট কর্তৃপক্ষের। &nbsp;<br \\/>\\r\\n&nbsp;<br \\/>\\r\\n<strong>প্রবেশাধিকার<\\/strong><br \\/>\\r\\nকোন বিশেষ ব্যক্তি অথবা ইন্টারনেট থেকে &nbsp;ব্রাউজকৃত কোনো বিশেষ ঠিকানাকে কোনো প্রকার কারণ দর্শানো ব্যতীত এ তথ্য বাতায়নে প্রবেশাধিকারের ক্ষেত্রে কর্তৃপক্ষের বিবেচনায় নিয়ন্ত্রণ আরোপ করা যেতে পারে।<br \\/>\\r\\n&nbsp;<br \\/>\\r\\n<strong>নীতিমালা সংযোজন এবং পরিবর্তনের নোটিশ<\\/strong><br \\/>\\r\\nকোনো প্রকার নোটিশ ব্যতীত যে কোনো সময় এই নীতিমালা সংশোধন করা হতে পারে। নীতিমালার পরিবর্তনের পর যদি কোন তথ্যাদি সংগ্রহ করা হয় তা অবশ্যই পরিবর্তিত নীতিমালার মাধ্যমে পালনীয় হবে।&nbsp;<br \\/>\\r\\n&nbsp;<br \\/>\\r\\n<strong>পরিচালনা&nbsp;<\\/strong><strong>এবং বিরোধ নিস্পত্তি<\\/strong><br \\/>\\r\\nআরোপিত &nbsp;শর্তাবলী বাংলাদেশের আইন অনুযায়ী পরিচালিত হবে। উল্লিখিত যে কোনো ধরনের আপত্তি বাংলাদেশের প্রচলিত বিচার ব্যবস্থার মাধ্যমে মীমাংসিত হবে।<\\/p>\\r\\n\\r\\n<p><br \\/>\\r\\n<strong>যোগাযোগঃ<\\/strong><br \\/>\\r\\nপ্রধানমন্ত্রীর কার্যালয়,<br \\/>\\r\\nপুরাতন সংসদ ভবন,<br \\/>\\r\\nতেজগাঁও, ঢাকা-১২১৫<br \\/>\\r\\nইমেইল:&nbsp;<a href=\\\"mailto:info@pmo.gov.bd\\\">info@pmo.gov.bd<\\/a><\\/p>\",\"is_active\":1,\"created_by\":1,\"created_ip\":\"::1\",\"created_at\":\"2021-06-17 09:40:49\"}', '{\"terms_of_use\":null,\"is_active\":1,\"created_by\":1,\"created_ip\":\"::1\",\"created_at\":\"2021-06-17 09:54:20\"}', '{\"in_overall_cooperation\":\"<p>&nbsp;wete2q rwqe&nbsp; sfgdwf qedwq<\\/p>\",\"is_active\":1,\"created_by\":1,\"created_ip\":\"::1\",\"created_at\":\"2021-06-17 09:54:55\"}', '{\"sitemap\":\"<p>222222222222222222222222<\\/p>\",\"is_active\":1,\"created_by\":1,\"created_ip\":\"::1\",\"created_at\":\"2021-06-17 10:04:23\"}', '{\"commonly_asked\":\"<p>qqqqqqqqqqqqqqqqq<\\/p>\",\"is_active\":1,\"created_by\":1,\"created_ip\":\"::1\",\"created_at\":\"2021-06-17 10:09:43\"}', 1, 1, '::1', '2021-06-17 09:40:49', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` int(10) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `designation` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1= upazila porichito,',
  `view_order` int(11) UNSIGNED NOT NULL,
  `is_default` tinyint(3) UNSIGNED DEFAULT 1,
  `is_active` tinyint(3) UNSIGNED DEFAULT 1 COMMENT '0= deleted, 1= Active, 2= Inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` tinyint(1) DEFAULT 1 COMMENT '1= Notice, 2= Government Initiatives, 3=Scroll News',
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `attachment` varchar(200) DEFAULT NULL,
  `is_current` int(11) UNSIGNED DEFAULT NULL,
  `view_order` int(11) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(3) UNSIGNED DEFAULT 1 COMMENT '0= deleted, 1= Active, 2= Inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `type`, `title`, `description`, `attachment`, `is_current`, `view_order`, `is_active`, `created_by`, `created_ip`, `created_at`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 1, 'টি আর, কাবিটা প্রকল্পের কার্যক্রম', 'টি আর, কাবিটা প্রকল্পের কার্যক্রমটি আর, কাবিটা প্রকল্পের কার্যক্রমটি আর, কাবিটা প্রকল্পের কার্যক্রমটি আর, কাবিটা প্রকল্পের কার্যক্রমটি আর, কাবিটা প্রকল্পের কার্যক্রম', 'attachment_1623844741.jpg', 1, 1, 1, 1, '::1', '2021-06-16 11:59:01', NULL, NULL, NULL),
(2, 1, 'Deserunt velit dolo', '<p>Quo sit provident c6f</p>', 'attachment_1624130608.jpg', NULL, 2, 1, 1, '::1', '2021-06-16 12:13:20', 1, '2021-06-19 19:23:33', '::1'),
(3, 1, 'Culpa est ut laborum', 'Enim veniam quae es', NULL, NULL, 3, 0, 1, '::1', '2021-06-16 12:15:36', 1, '2021-06-16 12:16:53', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `organizational_structure`
--

CREATE TABLE `organizational_structure` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = উপজেলা সাংগঠনিক , ২= পৌরসভা ',
  `structure_name` varchar(200) DEFAULT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL,
  `is_active` tinyint(3) UNSIGNED DEFAULT 1 COMMENT '0= deleted, 1= Active, 2= Inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organizational_structure`
--

INSERT INTO `organizational_structure` (`id`, `type`, `structure_name`, `parent_id`, `is_active`, `created_by`, `created_ip`, `created_at`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 2, 'মেয়র', 0, 1, NULL, NULL, '2021-06-16 07:35:34', NULL, '2021-06-16 07:35:34', NULL),
(6, 2, 'প্রধান নির্বাহী কর্মকর্তা', 1, 1, 1, '::1', '2021-06-16 09:52:36', NULL, NULL, NULL),
(7, 2, 'প্রকৌশল বিভাগ', 6, 1, 1, '::1', '2021-06-16 09:59:13', NULL, NULL, NULL),
(8, 2, 'প্রশাসন বিভাগ', 6, 1, 1, '::1', '2021-06-16 10:02:03', NULL, NULL, NULL),
(9, 2, 'স্বাস্থ্য পরিবার পরিকল্পনা ও পরিচ্ছন্নতা বিভাগ', 6, 1, 1, '::1', '2021-06-16 10:02:59', NULL, NULL, NULL),
(10, 2, 'নির্বাহী প্রকৌশলী', 7, 1, 1, '::1', '2021-06-16 10:03:53', NULL, NULL, NULL),
(11, 2, 'সচিব', 8, 1, 1, '::1', '2021-06-16 10:04:42', NULL, NULL, NULL),
(12, 2, 'স্বাস্থ্য ও কর্মকর্তা।', 9, 1, 1, '::1', '2021-06-16 10:05:05', NULL, NULL, NULL);

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
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `type` tinyint(1) UNSIGNED DEFAULT NULL COMMENT ' 1=  উপজেলা নির্বাহী অফিসার, 2=  উপজেলা কর্মকর্তাগণ , 3=  ডাক্তার তালিকা ',
  `image` varchar(200) DEFAULT NULL,
  `period_start` datetime DEFAULT NULL,
  `period_end` datetime DEFAULT NULL,
  `address` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `view_order` int(6) DEFAULT NULL,
  `is_active` tinyint(3) UNSIGNED DEFAULT 1 COMMENT '0= deleted, 1= Active, 2= Inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `union_infos`
--

CREATE TABLE `union_infos` (
  `id` int(11) UNSIGNED NOT NULL,
  `upazila_id` int(11) UNSIGNED DEFAULT NULL,
  `union_name` varchar(500) DEFAULT NULL,
  `union_code` varchar(30) DEFAULT NULL,
  `web_url` varchar(500) DEFAULT NULL,
  `view_order` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(3) UNSIGNED DEFAULT 1 COMMENT '0= deleted, 1= Active, 2= Inactive',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `union_infos`
--

INSERT INTO `union_infos` (`id`, `upazila_id`, `union_name`, `union_code`, `web_url`, `view_order`, `is_active`, `created_by`, `created_ip`, `created_at`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 1, '১নং Abc Union', '54354', 'abc.com', NULL, 1, NULL, NULL, '2021-06-01 09:35:59', 1, '2021-06-02 04:49:25', '::1'),
(2, 3, '২নং EFG Union', '54353', 'efg.com', NULL, 1, NULL, NULL, '2021-06-01 10:19:24', NULL, '2021-06-01 10:19:24', NULL),
(3, 5, '৩নং test union', '5432', 'abc.com', NULL, 1, NULL, NULL, '2021-06-01 10:43:28', NULL, '2021-06-01 10:43:28', NULL),
(4, 15, '৪নং fffffffffUnion', '54353', 'ffffffff.com', NULL, 1, NULL, NULL, '2021-06-01 12:14:24', NULL, '2021-06-01 12:14:24', NULL),
(5, 17, '৫নং tttt bb  bbbbbbb', '54354', 'fdd', NULL, 1, 1, '::1', '2021-06-01 12:20:02', 1, '2021-06-01 12:20:26', '::1'),
(6, 46, '৬নং jjhg kkkkkkkk', '34234', 'abc.com', NULL, 1, 1, '::1', '2021-06-01 12:21:53', 1, '2021-06-01 12:22:01', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` int(2) UNSIGNED NOT NULL,
  `district_id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `bn_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upazilas`
--

INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`) VALUES
(1, 34, 'Amtali Upazila', 'আমতলী'),
(2, 34, 'Bamna Upazila', 'বামনা'),
(3, 34, 'Barguna Sadar Upazila', 'বরগুনা সদর'),
(4, 34, 'Betagi Upazila', 'বেতাগি'),
(5, 34, 'Patharghata Upazila', 'পাথরঘাটা'),
(6, 34, 'Taltali Upazila', 'তালতলী'),
(7, 35, 'Muladi Upazila', 'মুলাদি'),
(8, 35, 'Babuganj Upazila', 'বাবুগঞ্জ'),
(9, 35, 'Agailjhara Upazila', 'আগাইলঝরা'),
(10, 35, 'Barisal Sadar Upazila', 'বরিশাল সদর'),
(11, 35, 'Bakerganj Upazila', 'বাকেরগঞ্জ'),
(12, 35, 'Banaripara Upazila', 'বানাড়িপারা'),
(13, 35, 'Gaurnadi Upazila', 'গৌরনদী'),
(14, 35, 'Hizla Upazila', 'হিজলা'),
(15, 35, 'Mehendiganj Upazila', 'মেহেদিগঞ্জ '),
(16, 35, 'Wazirpur Upazila', 'ওয়াজিরপুর'),
(17, 36, 'Bhola Sadar Upazila', 'ভোলা সদর'),
(18, 36, 'Burhanuddin Upazila', 'বুরহানউদ্দিন'),
(19, 36, 'Char Fasson Upazila', 'চর ফ্যাশন'),
(20, 36, 'Daulatkhan Upazila', 'দৌলতখান'),
(21, 36, 'Lalmohan Upazila', 'লালমোহন'),
(22, 36, 'Manpura Upazila', 'মনপুরা'),
(23, 36, 'Tazumuddin Upazila', 'তাজুমুদ্দিন'),
(24, 37, 'Jhalokati Sadar Upazila', 'ঝালকাঠি সদর'),
(25, 37, 'Kathalia Upazila', 'কাঁঠালিয়া'),
(26, 37, 'Nalchity Upazila', 'নালচিতি'),
(27, 37, 'Rajapur Upazila', 'রাজাপুর'),
(28, 38, 'Bauphal Upazila', 'বাউফল'),
(29, 38, 'Dashmina Upazila', 'দশমিনা'),
(30, 38, 'Galachipa Upazila', 'গলাচিপা'),
(31, 38, 'Kalapara Upazila', 'কালাপারা'),
(32, 38, 'Mirzaganj Upazila', 'মির্জাগঞ্জ '),
(33, 38, 'Patuakhali Sadar Upazila', 'পটুয়াখালী সদর'),
(34, 38, 'Dumki Upazila', 'ডুমকি'),
(35, 38, 'Rangabali Upazila', 'রাঙ্গাবালি'),
(36, 39, 'Bhandaria', 'ভ্যান্ডারিয়া'),
(37, 39, 'Kaukhali', 'কাউখালি'),
(38, 39, 'Mathbaria', 'মাঠবাড়িয়া'),
(39, 39, 'Nazirpur', 'নাজিরপুর'),
(40, 39, 'Nesarabad', 'নেসারাবাদ'),
(41, 39, 'Pirojpur Sadar', 'পিরোজপুর সদর'),
(42, 39, 'Zianagar', 'জিয়ানগর'),
(43, 40, 'Bandarban Sadar', 'বান্দরবন সদর'),
(44, 40, 'Thanchi', 'থানচি'),
(45, 40, 'Lama', 'লামা'),
(46, 40, 'Naikhongchhari', 'নাইখংছড়ি '),
(47, 40, 'Ali kadam', 'আলী কদম'),
(48, 40, 'Rowangchhari', 'রউয়াংছড়ি '),
(49, 40, 'Ruma', 'রুমা'),
(50, 41, 'Brahmanbaria Sadar Upazila', 'ব্রাহ্মণবাড়িয়া সদর'),
(51, 41, 'Ashuganj Upazila', 'আশুগঞ্জ'),
(52, 41, 'Nasirnagar Upazila', 'নাসির নগর'),
(53, 41, 'Nabinagar Upazila', 'নবীনগর'),
(54, 41, 'Sarail Upazila', 'সরাইল'),
(55, 41, 'Shahbazpur Town', 'শাহবাজপুর টাউন'),
(56, 41, 'Kasba Upazila', 'কসবা'),
(57, 41, 'Akhaura Upazila', 'আখাউরা'),
(58, 41, 'Bancharampur Upazila', 'বাঞ্ছারামপুর'),
(59, 41, 'Bijoynagar Upazila', 'বিজয় নগর'),
(60, 42, 'Chandpur Sadar', 'চাঁদপুর সদর'),
(61, 42, 'Faridganj', 'ফরিদগঞ্জ'),
(62, 42, 'Haimchar', 'হাইমচর'),
(63, 42, 'Haziganj', 'হাজীগঞ্জ'),
(64, 42, 'Kachua', 'কচুয়া'),
(65, 42, 'Matlab Uttar', 'মতলব উত্তর'),
(66, 42, 'Matlab Dakkhin', 'মতলব দক্ষিণ'),
(67, 42, 'Shahrasti', 'শাহরাস্তি'),
(68, 43, 'Anwara Upazila', 'আনোয়ারা'),
(69, 43, 'Banshkhali Upazila', 'বাশখালি'),
(70, 43, 'Boalkhali Upazila', 'বোয়ালখালি'),
(71, 43, 'Chandanaish Upazila', 'চন্দনাইশ'),
(72, 43, 'Fatikchhari Upazila', 'ফটিকছড়ি'),
(73, 43, 'Hathazari Upazila', 'হাঠহাজারী'),
(74, 43, 'Lohagara Upazila', 'লোহাগারা'),
(75, 43, 'Mirsharai Upazila', 'মিরসরাই'),
(76, 43, 'Patiya Upazila', 'পটিয়া'),
(77, 43, 'Rangunia Upazila', 'রাঙ্গুনিয়া'),
(78, 43, 'Raozan Upazila', 'রাউজান'),
(79, 43, 'Sandwip Upazila', 'সন্দ্বীপ'),
(80, 43, 'Satkania Upazila', 'সাতকানিয়া'),
(81, 43, 'Sitakunda Upazila', 'সীতাকুণ্ড'),
(82, 44, 'Barura Upazila', 'বড়ুরা'),
(83, 44, 'Brahmanpara Upazila', 'ব্রাহ্মণপাড়া'),
(84, 44, 'Burichong Upazila', 'বুড়িচং'),
(85, 44, 'Chandina Upazila', 'চান্দিনা'),
(86, 44, 'Chauddagram Upazila', 'চৌদ্দগ্রাম'),
(87, 44, 'Daudkandi Upazila', 'দাউদকান্দি'),
(88, 44, 'Debidwar Upazila', 'দেবীদ্বার'),
(89, 44, 'Homna Upazila', 'হোমনা'),
(90, 44, 'Comilla Sadar Upazila', 'কুমিল্লা সদর'),
(91, 44, 'Laksam Upazila', 'লাকসাম'),
(92, 44, 'Monohorgonj Upazila', 'মনোহরগঞ্জ'),
(93, 44, 'Meghna Upazila', 'মেঘনা'),
(94, 44, 'Muradnagar Upazila', 'মুরাদনগর'),
(95, 44, 'Nangalkot Upazila', 'নাঙ্গালকোট'),
(96, 44, 'Comilla Sadar South Upazila', 'কুমিল্লা সদর দক্ষিণ'),
(97, 44, 'Titas Upazila', 'তিতাস'),
(98, 45, 'Chakaria Upazila', 'চকরিয়া'),
(100, 45, 'Cox\'s Bazar Sadar Upazila', 'কক্স বাজার সদর'),
(101, 45, 'Kutubdia Upazila', 'কুতুবদিয়া'),
(102, 45, 'Maheshkhali Upazila', 'মহেশখালী'),
(103, 45, 'Ramu Upazila', 'রামু'),
(104, 45, 'Teknaf Upazila', 'টেকনাফ'),
(105, 45, 'Ukhia Upazila', 'উখিয়া'),
(106, 45, 'Pekua Upazila', 'পেকুয়া'),
(107, 46, 'Feni Sadar', 'ফেনী সদর'),
(108, 46, 'Chagalnaiya', 'ছাগল নাইয়া'),
(109, 46, 'Daganbhyan', 'দাগানভিয়া'),
(110, 46, 'Parshuram', 'পরশুরাম'),
(111, 46, 'Fhulgazi', 'ফুলগাজি'),
(112, 46, 'Sonagazi', 'সোনাগাজি'),
(113, 47, 'Dighinala Upazila', 'দিঘিনালা '),
(114, 47, 'Khagrachhari Upazila', 'খাগড়াছড়ি'),
(115, 47, 'Lakshmichhari Upazila', 'লক্ষ্মীছড়ি'),
(116, 47, 'Mahalchhari Upazila', 'মহলছড়ি'),
(117, 47, 'Manikchhari Upazila', 'মানিকছড়ি'),
(118, 47, 'Matiranga Upazila', 'মাটিরাঙ্গা'),
(119, 47, 'Panchhari Upazila', 'পানছড়ি'),
(120, 47, 'Ramgarh Upazila', 'রামগড়'),
(121, 48, 'Lakshmipur Sadar Upazila', 'লক্ষ্মীপুর সদর'),
(122, 48, 'Raipur Upazila', 'রায়পুর'),
(123, 48, 'Ramganj Upazila', 'রামগঞ্জ'),
(124, 48, 'Ramgati Upazila', 'রামগতি'),
(125, 48, 'Komol Nagar Upazila', 'কমল নগর'),
(126, 49, 'Noakhali Sadar Upazila', 'নোয়াখালী সদর'),
(127, 49, 'Begumganj Upazila', 'বেগমগঞ্জ'),
(128, 49, 'Chatkhil Upazila', 'চাটখিল'),
(129, 49, 'Companyganj Upazila', 'কোম্পানীগঞ্জ'),
(130, 49, 'Shenbag Upazila', 'শেনবাগ'),
(131, 49, 'Hatia Upazila', 'হাতিয়া'),
(132, 49, 'Kobirhat Upazila', 'কবিরহাট '),
(133, 49, 'Sonaimuri Upazila', 'সোনাইমুরি'),
(134, 49, 'Suborno Char Upazila', 'সুবর্ণ চর '),
(135, 50, 'Rangamati Sadar Upazila', 'রাঙ্গামাটি সদর'),
(136, 50, 'Belaichhari Upazila', 'বেলাইছড়ি'),
(137, 50, 'Bagaichhari Upazila', 'বাঘাইছড়ি'),
(138, 50, 'Barkal Upazila', 'বরকল'),
(139, 50, 'Juraichhari Upazila', 'জুরাইছড়ি'),
(140, 50, 'Rajasthali Upazila', 'রাজাস্থলি'),
(141, 50, 'Kaptai Upazila', 'কাপ্তাই'),
(142, 50, 'Langadu Upazila', 'লাঙ্গাডু'),
(143, 50, 'Nannerchar Upazila', 'নান্নেরচর '),
(144, 50, 'Kaukhali Upazila', 'কাউখালি'),
(145, 1, 'Dhamrai Upazila', 'ধামরাই'),
(146, 1, 'Dohar Upazila', 'দোহার'),
(147, 1, 'Keraniganj Upazila', 'কেরানীগঞ্জ'),
(148, 1, 'Nawabganj Upazila', 'নবাবগঞ্জ'),
(149, 1, 'Savar Upazila', 'সাভার'),
(150, 2, 'Faridpur Sadar Upazila', 'ফরিদপুর সদর'),
(151, 2, 'Boalmari Upazila', 'বোয়ালমারী'),
(152, 2, 'Alfadanga Upazila', 'আলফাডাঙ্গা'),
(153, 2, 'Madhukhali Upazila', 'মধুখালি'),
(154, 2, 'Bhanga Upazila', 'ভাঙ্গা'),
(155, 2, 'Nagarkanda Upazila', 'নগরকান্ড'),
(156, 2, 'Charbhadrasan Upazila', 'চরভদ্রাসন '),
(157, 2, 'Sadarpur Upazila', 'সদরপুর'),
(158, 2, 'Shaltha Upazila', 'শালথা'),
(159, 3, 'Gazipur Sadar-Joydebpur', 'গাজীপুর সদর'),
(160, 3, 'Kaliakior', 'কালিয়াকৈর'),
(161, 3, 'Kapasia', 'কাপাসিয়া'),
(162, 3, 'Sripur', 'শ্রীপুর'),
(163, 3, 'Kaliganj', 'কালীগঞ্জ'),
(164, 3, 'Tongi', 'টঙ্গি'),
(165, 4, 'Gopalganj Sadar Upazila', 'গোপালগঞ্জ সদর'),
(166, 4, 'Kashiani Upazila', 'কাশিয়ানি'),
(167, 4, 'Kotalipara Upazila', 'কোটালিপাড়া'),
(168, 4, 'Muksudpur Upazila', 'মুকসুদপুর'),
(169, 4, 'Tungipara Upazila', 'টুঙ্গিপাড়া'),
(170, 5, 'Dewanganj Upazila', 'দেওয়ানগঞ্জ'),
(171, 5, 'Baksiganj Upazila', 'বকসিগঞ্জ'),
(172, 5, 'Islampur Upazila', 'ইসলামপুর'),
(173, 5, 'Jamalpur Sadar Upazila', 'জামালপুর সদর'),
(174, 5, 'Madarganj Upazila', 'মাদারগঞ্জ'),
(175, 5, 'Melandaha Upazila', 'মেলানদাহা'),
(176, 5, 'Sarishabari Upazila', 'সরিষাবাড়ি '),
(177, 5, 'Narundi Police I.C', 'নারুন্দি'),
(178, 6, 'Astagram Upazila', 'অষ্টগ্রাম'),
(179, 6, 'Bajitpur Upazila', 'বাজিতপুর'),
(180, 6, 'Bhairab Upazila', 'ভৈরব'),
(181, 6, 'Hossainpur Upazila', 'হোসেনপুর '),
(182, 6, 'Itna Upazila', 'ইটনা'),
(183, 6, 'Karimganj Upazila', 'করিমগঞ্জ'),
(184, 6, 'Katiadi Upazila', 'কতিয়াদি'),
(185, 6, 'Kishoreganj Sadar Upazila', 'কিশোরগঞ্জ সদর'),
(186, 6, 'Kuliarchar Upazila', 'কুলিয়ারচর'),
(187, 6, 'Mithamain Upazila', 'মিঠামাইন'),
(188, 6, 'Nikli Upazila', 'নিকলি'),
(189, 6, 'Pakundia Upazila', 'পাকুন্ডা'),
(190, 6, 'Tarail Upazila', 'তাড়াইল'),
(191, 7, 'Madaripur Sadar', 'মাদারীপুর সদর'),
(192, 7, 'Kalkini', 'কালকিনি'),
(193, 7, 'Rajoir', 'রাজইর'),
(194, 7, 'Shibchar', 'শিবচর'),
(195, 8, 'Manikganj Sadar Upazila', 'মানিকগঞ্জ সদর'),
(196, 8, 'Singair Upazila', 'সিঙ্গাইর'),
(197, 8, 'Shibalaya Upazila', 'শিবালয়'),
(198, 8, 'Saturia Upazila', 'সাঠুরিয়া'),
(199, 8, 'Harirampur Upazila', 'হরিরামপুর'),
(200, 8, 'Ghior Upazila', 'ঘিওর'),
(201, 8, 'Daulatpur Upazila', 'দৌলতপুর'),
(202, 9, 'Lohajang Upazila', 'লোহাজং'),
(203, 9, 'Sreenagar Upazila', 'শ্রীনগর'),
(204, 9, 'Munshiganj Sadar Upazila', 'মুন্সিগঞ্জ সদর'),
(205, 9, 'Sirajdikhan Upazila', 'সিরাজদিখান'),
(206, 9, 'Tongibari Upazila', 'টঙ্গিবাড়ি'),
(207, 9, 'Gazaria Upazila', 'গজারিয়া'),
(208, 10, 'Bhaluka', 'ভালুকা'),
(209, 10, 'Trishal', 'ত্রিশাল'),
(210, 10, 'Haluaghat', 'হালুয়াঘাট'),
(211, 10, 'Muktagachha', 'মুক্তাগাছা'),
(212, 10, 'Dhobaura', 'ধবারুয়া'),
(213, 10, 'Fulbaria', 'ফুলবাড়িয়া'),
(214, 10, 'Gaffargaon', 'গফরগাঁও'),
(215, 10, 'Gauripur', 'গৌরিপুর'),
(216, 10, 'Ishwarganj', 'ঈশ্বরগঞ্জ'),
(217, 10, 'Mymensingh Sadar', 'ময়মনসিং সদর'),
(218, 10, 'Nandail', 'নন্দাইল'),
(219, 10, 'Phulpur', 'ফুলপুর'),
(220, 11, 'Araihazar Upazila', 'আড়াইহাজার'),
(221, 11, 'Sonargaon Upazila', 'সোনারগাঁও'),
(222, 11, 'Bandar', 'বান্দার'),
(223, 11, 'Naryanganj Sadar Upazila', 'নারায়ানগঞ্জ সদর'),
(224, 11, 'Rupganj Upazila', 'রূপগঞ্জ'),
(225, 11, 'Siddirgonj Upazila', 'সিদ্ধিরগঞ্জ'),
(226, 12, 'Belabo Upazila', 'বেলাবো'),
(227, 12, 'Monohardi Upazila', 'মনোহরদি'),
(228, 12, 'Narsingdi Sadar Upazila', 'নরসিংদী সদর'),
(229, 12, 'Palash Upazila', 'পলাশ'),
(230, 12, 'Raipura Upazila, Narsingdi', 'রায়পুর'),
(231, 12, 'Shibpur Upazila', 'শিবপুর'),
(232, 13, 'Kendua Upazilla', 'কেন্দুয়া'),
(233, 13, 'Atpara Upazilla', 'আটপাড়া'),
(234, 13, 'Barhatta Upazilla', 'বরহাট্টা'),
(235, 13, 'Durgapur Upazilla', 'দুর্গাপুর'),
(236, 13, 'Kalmakanda Upazilla', 'কলমাকান্দা'),
(237, 13, 'Madan Upazilla', 'মদন'),
(238, 13, 'Mohanganj Upazilla', 'মোহনগঞ্জ'),
(239, 13, 'Netrakona-S Upazilla', 'নেত্রকোনা সদর'),
(240, 13, 'Purbadhala Upazilla', 'পূর্বধলা'),
(241, 13, 'Khaliajuri Upazilla', 'খালিয়াজুরি'),
(242, 14, 'Baliakandi Upazila', 'বালিয়াকান্দি'),
(243, 14, 'Goalandaghat Upazila', 'গোয়ালন্দ ঘাট'),
(244, 14, 'Pangsha Upazila', 'পাংশা'),
(245, 14, 'Kalukhali Upazila', 'কালুখালি'),
(246, 14, 'Rajbari Sadar Upazila', 'রাজবাড়ি সদর'),
(247, 15, 'Shariatpur Sadar -Palong', 'শরীয়তপুর সদর '),
(248, 15, 'Damudya Upazila', 'দামুদিয়া'),
(249, 15, 'Naria Upazila', 'নড়িয়া'),
(250, 15, 'Jajira Upazila', 'জাজিরা'),
(251, 15, 'Bhedarganj Upazila', 'ভেদারগঞ্জ'),
(252, 15, 'Gosairhat Upazila', 'গোসাইর হাট '),
(253, 16, 'Jhenaigati Upazila', 'ঝিনাইগাতি'),
(254, 16, 'Nakla Upazila', 'নাকলা'),
(255, 16, 'Nalitabari Upazila', 'নালিতাবাড়ি'),
(256, 16, 'Sherpur Sadar Upazila', 'শেরপুর সদর'),
(257, 16, 'Sreebardi Upazila', 'শ্রীবরদি'),
(258, 17, 'Tangail Sadar Upazila', 'টাঙ্গাইল সদর'),
(259, 17, 'Sakhipur Upazila', 'সখিপুর'),
(260, 17, 'Basail Upazila', 'বসাইল'),
(261, 17, 'Madhupur Upazila', 'মধুপুর'),
(262, 17, 'Ghatail Upazila', 'ঘাটাইল'),
(263, 17, 'Kalihati Upazila', 'কালিহাতি'),
(264, 17, 'Nagarpur Upazila', 'নগরপুর'),
(265, 17, 'Mirzapur Upazila', 'মির্জাপুর'),
(266, 17, 'Gopalpur Upazila', 'গোপালপুর'),
(267, 17, 'Delduar Upazila', 'দেলদুয়ার'),
(268, 17, 'Bhuapur Upazila', 'ভুয়াপুর'),
(269, 17, 'Dhanbari Upazila', 'ধানবাড়ি'),
(270, 55, 'Bagerhat Sadar Upazila', 'বাগেরহাট সদর'),
(271, 55, 'Chitalmari Upazila', 'চিতলমাড়ি'),
(272, 55, 'Fakirhat Upazila', 'ফকিরহাট'),
(273, 55, 'Kachua Upazila', 'কচুয়া'),
(274, 55, 'Mollahat Upazila', 'মোল্লাহাট '),
(275, 55, 'Mongla Upazila', 'মংলা'),
(276, 55, 'Morrelganj Upazila', 'মরেলগঞ্জ'),
(277, 55, 'Rampal Upazila', 'রামপাল'),
(278, 55, 'Sarankhola Upazila', 'স্মরণখোলা'),
(279, 56, 'Damurhuda Upazila', 'দামুরহুদা'),
(280, 56, 'Chuadanga-S Upazila', 'চুয়াডাঙ্গা সদর'),
(281, 56, 'Jibannagar Upazila', 'জীবন নগর '),
(282, 56, 'Alamdanga Upazila', 'আলমডাঙ্গা'),
(283, 57, 'Abhaynagar Upazila', 'অভয়নগর'),
(284, 57, 'Keshabpur Upazila', 'কেশবপুর'),
(285, 57, 'Bagherpara Upazila', 'বাঘের পাড়া '),
(286, 57, 'Jessore Sadar Upazila', 'যশোর সদর'),
(287, 57, 'Chaugachha Upazila', 'চৌগাছা'),
(288, 57, 'Manirampur Upazila', 'মনিরামপুর '),
(289, 57, 'Jhikargachha Upazila', 'ঝিকরগাছা'),
(290, 57, 'Sharsha Upazila', 'সারশা'),
(291, 58, 'Jhenaidah Sadar Upazila', 'ঝিনাইদহ সদর'),
(292, 58, 'Maheshpur Upazila', 'মহেশপুর'),
(293, 58, 'Kaliganj Upazila', 'কালীগঞ্জ'),
(294, 58, 'Kotchandpur Upazila', 'কোট চাঁদপুর '),
(295, 58, 'Shailkupa Upazila', 'শৈলকুপা'),
(296, 58, 'Harinakunda Upazila', 'হাড়িনাকুন্দা'),
(297, 59, 'Terokhada Upazila', 'তেরোখাদা'),
(298, 59, 'Batiaghata Upazila', 'বাটিয়াঘাটা '),
(299, 59, 'Dacope Upazila', 'ডাকপে'),
(300, 59, 'Dumuria Upazila', 'ডুমুরিয়া'),
(301, 59, 'Dighalia Upazila', 'দিঘলিয়া'),
(302, 59, 'Koyra Upazila', 'কয়ড়া'),
(303, 59, 'Paikgachha Upazila', 'পাইকগাছা'),
(304, 59, 'Phultala Upazila', 'ফুলতলা'),
(305, 59, 'Rupsa Upazila', 'রূপসা'),
(306, 60, 'Kushtia Sadar', 'কুষ্টিয়া সদর'),
(307, 60, 'Kumarkhali', 'কুমারখালি'),
(308, 60, 'Daulatpur', 'দৌলতপুর'),
(309, 60, 'Mirpur', 'মিরপুর'),
(310, 60, 'Bheramara', 'ভেরামারা'),
(311, 60, 'Khoksa', 'খোকসা'),
(312, 61, 'Magura Sadar Upazila', 'মাগুরা সদর'),
(313, 61, 'Mohammadpur Upazila', 'মোহাম্মাদপুর'),
(314, 61, 'Shalikha Upazila', 'শালিখা'),
(315, 61, 'Sreepur Upazila', 'শ্রীপুর'),
(316, 62, 'angni Upazila', 'আংনি'),
(317, 62, 'Mujib Nagar Upazila', 'মুজিব নগর'),
(318, 62, 'Meherpur-S Upazila', 'মেহেরপুর সদর'),
(319, 63, 'Narail-S Upazilla', 'নড়াইল সদর'),
(320, 63, 'Lohagara Upazilla', 'লোহাগাড়া'),
(321, 63, 'Kalia Upazilla', 'কালিয়া'),
(322, 64, 'Satkhira Sadar Upazila', 'সাতক্ষীরা সদর'),
(323, 64, 'Assasuni Upazila', 'আসসাশুনি '),
(324, 64, 'Debhata Upazila', 'দেভাটা'),
(325, 64, 'Tala Upazila', 'তালা'),
(326, 64, 'Kalaroa Upazila', 'কলরোয়া'),
(327, 64, 'Kaliganj Upazila', 'কালীগঞ্জ'),
(328, 64, 'Shyamnagar Upazila', 'শ্যামনগর'),
(329, 18, 'Adamdighi', 'আদমদিঘী'),
(330, 18, 'Bogra Sadar', 'বগুড়া সদর'),
(331, 18, 'Sherpur', 'শেরপুর'),
(332, 18, 'Dhunat', 'ধুনট'),
(333, 18, 'Dhupchanchia', 'দুপচাচিয়া'),
(334, 18, 'Gabtali', 'গাবতলি'),
(335, 18, 'Kahaloo', 'কাহালু'),
(336, 18, 'Nandigram', 'নন্দিগ্রাম'),
(337, 18, 'Sahajanpur', 'শাহজাহানপুর'),
(338, 18, 'Sariakandi', 'সারিয়াকান্দি'),
(339, 18, 'Shibganj', 'শিবগঞ্জ'),
(340, 18, 'Sonatala', 'সোনাতলা'),
(341, 19, 'Joypurhat S', 'জয়পুরহাট সদর'),
(342, 19, 'Akkelpur', 'আক্কেলপুর'),
(343, 19, 'Kalai', 'কালাই'),
(344, 19, 'Khetlal', 'খেতলাল'),
(345, 19, 'Panchbibi', 'পাঁচবিবি'),
(346, 20, 'Naogaon Sadar Upazila', 'নওগাঁ সদর'),
(347, 20, 'Mohadevpur Upazila', 'মহাদেবপুর'),
(348, 20, 'Manda Upazila', 'মান্দা'),
(349, 20, 'Niamatpur Upazila', 'নিয়ামতপুর'),
(350, 20, 'Atrai Upazila', 'আত্রাই'),
(351, 20, 'Raninagar Upazila', 'রাণীনগর'),
(352, 20, 'Patnitala Upazila', 'পত্নীতলা'),
(353, 20, 'Dhamoirhat Upazila', 'ধামইরহাট '),
(354, 20, 'Sapahar Upazila', 'সাপাহার'),
(355, 20, 'Porsha Upazila', 'পোরশা'),
(356, 20, 'Badalgachhi Upazila', 'বদলগাছি'),
(357, 21, 'Natore Sadar Upazila', 'নাটোর সদর'),
(358, 21, 'Baraigram Upazila', 'বড়াইগ্রাম'),
(359, 21, 'Bagatipara Upazila', 'বাগাতিপাড়া'),
(360, 21, 'Lalpur Upazila', 'লালপুর'),
(361, 21, 'Singra Upazila', 'সিংড়া '),
(362, 21, 'Gurudaspur Upazila', 'গুরুদাসপুর '),
(363, 22, 'Bholahat Upazila', 'ভোলাহাট'),
(364, 22, 'Gomastapur Upazila', 'গোমস্তাপুর'),
(365, 22, 'Nachole Upazila', 'নাচোল'),
(366, 22, 'Nawabganj Sadar Upazila', 'নবাবগঞ্জ সদর'),
(367, 22, 'Shibganj Upazila', 'শিবগঞ্জ'),
(368, 23, 'Atgharia Upazila', 'আটঘরিয়া'),
(369, 23, 'Bera Upazila', 'বেড়া'),
(370, 23, 'Bhangura Upazila', 'ভাঙ্গুরা'),
(371, 23, 'Chatmohar Upazila', 'চাটমোহর'),
(372, 23, 'Faridpur Upazila', 'ফরিদপুর'),
(373, 23, 'Ishwardi Upazila', 'ঈশ্বরদী'),
(374, 23, 'Pabna Sadar Upazila', 'পাবনা সদর'),
(375, 23, 'Santhia Upazila', 'সাথিয়া'),
(376, 23, 'Sujanagar Upazila', 'সুজানগর'),
(377, 24, 'Bagha', 'বাঘা'),
(378, 24, 'Bagmara', 'বাগমারা'),
(379, 24, 'Charghat', 'চারঘাট'),
(380, 24, 'Durgapur', 'দুর্গাপুর'),
(381, 24, 'Godagari', 'গোদাগারি'),
(382, 24, 'Mohanpur', 'মোহনপুর'),
(383, 24, 'Paba', 'পবা'),
(384, 24, 'Puthia', 'পুঠিয়া'),
(385, 24, 'Tanore', 'তানোর'),
(386, 25, 'Sirajganj Sadar Upazila', 'সিরাজগঞ্জ সদর'),
(387, 25, 'Belkuchi Upazila', 'বেলকুচি'),
(388, 25, 'Chauhali Upazila', 'চৌহালি'),
(389, 25, 'Kamarkhanda Upazila', 'কামারখান্দা'),
(390, 25, 'Kazipur Upazila', 'কাজীপুর'),
(391, 25, 'Raiganj Upazila', 'রায়গঞ্জ'),
(392, 25, 'Shahjadpur Upazila', 'শাহজাদপুর'),
(393, 25, 'Tarash Upazila', 'তারাশ'),
(394, 25, 'Ullahpara Upazila', 'উল্লাপাড়া'),
(395, 26, 'Birampur Upazila', 'বিরামপুর'),
(396, 26, 'Birganj', 'বীরগঞ্জ'),
(397, 26, 'Biral Upazila', 'বিড়াল'),
(398, 26, 'Bochaganj Upazila', 'বোচাগঞ্জ'),
(399, 26, 'Chirirbandar Upazila', 'চিরিরবন্দর'),
(400, 26, 'Phulbari Upazila', 'ফুলবাড়ি'),
(401, 26, 'Ghoraghat Upazila', 'ঘোড়াঘাট'),
(402, 26, 'Hakimpur Upazila', 'হাকিমপুর'),
(403, 26, 'Kaharole Upazila', 'কাহারোল'),
(404, 26, 'Khansama Upazila', 'খানসামা'),
(405, 26, 'Dinajpur Sadar Upazila', 'দিনাজপুর সদর'),
(406, 26, 'Nawabganj', 'নবাবগঞ্জ'),
(407, 26, 'Parbatipur Upazila', 'পার্বতীপুর'),
(408, 27, 'Fulchhari', 'ফুলছড়ি'),
(409, 27, 'Gaibandha sadar', 'গাইবান্ধা সদর'),
(410, 27, 'Gobindaganj', 'গোবিন্দগঞ্জ'),
(411, 27, 'Palashbari', 'পলাশবাড়ী'),
(412, 27, 'Sadullapur', 'সাদুল্যাপুর'),
(413, 27, 'Saghata', 'সাঘাটা'),
(414, 27, 'Sundarganj', 'সুন্দরগঞ্জ'),
(415, 28, 'Kurigram Sadar', 'কুড়িগ্রাম সদর'),
(416, 28, 'Nageshwari', 'নাগেশ্বরী'),
(417, 28, 'Bhurungamari', 'ভুরুঙ্গামারি'),
(418, 28, 'Phulbari', 'ফুলবাড়ি'),
(419, 28, 'Rajarhat', 'রাজারহাট'),
(420, 28, 'Ulipur', 'উলিপুর'),
(421, 28, 'Chilmari', 'চিলমারি'),
(422, 28, 'Rowmari', 'রউমারি'),
(423, 28, 'Char Rajibpur', 'চর রাজিবপুর'),
(424, 29, 'Lalmanirhat Sadar', 'লালমনিরহাট সদর'),
(425, 29, 'Aditmari', 'আদিতমারি'),
(426, 29, 'Kaliganj', 'কালীগঞ্জ'),
(427, 29, 'Hatibandha', 'হাতিবান্ধা'),
(428, 29, 'Patgram', 'পাটগ্রাম'),
(429, 30, 'Nilphamari Sadar', 'নীলফামারী সদর'),
(430, 30, 'Saidpur', 'সৈয়দপুর'),
(431, 30, 'Jaldhaka', 'জলঢাকা'),
(432, 30, 'Kishoreganj', 'কিশোরগঞ্জ'),
(433, 30, 'Domar', 'ডোমার'),
(434, 30, 'Dimla', 'ডিমলা'),
(435, 31, 'Panchagarh Sadar', 'পঞ্চগড় সদর'),
(436, 31, 'Debiganj', 'দেবীগঞ্জ'),
(437, 31, 'Boda', 'বোদা'),
(438, 31, 'Atwari', 'আটোয়ারি'),
(439, 31, 'Tetulia', 'তেতুলিয়া'),
(440, 32, 'Badarganj', 'বদরগঞ্জ'),
(441, 32, 'Mithapukur', 'মিঠাপুকুর'),
(442, 32, 'Gangachara', 'গঙ্গাচরা'),
(443, 32, 'Kaunia', 'কাউনিয়া'),
(444, 32, 'Rangpur Sadar', 'রংপুর সদর'),
(445, 32, 'Pirgachha', 'পীরগাছা'),
(446, 32, 'Pirganj', 'পীরগঞ্জ'),
(447, 32, 'Taraganj', 'তারাগঞ্জ'),
(448, 33, 'Thakurgaon Sadar Upazila', 'ঠাকুরগাঁও সদর'),
(449, 33, 'Pirganj Upazila', 'পীরগঞ্জ'),
(450, 33, 'Baliadangi Upazila', 'বালিয়াডাঙ্গি'),
(451, 33, 'Haripur Upazila', 'হরিপুর'),
(452, 33, 'Ranisankail Upazila', 'রাণীসংকইল'),
(453, 51, 'Ajmiriganj', 'আজমিরিগঞ্জ'),
(454, 51, 'Baniachang', 'বানিয়াচং'),
(455, 51, 'Bahubal', 'বাহুবল'),
(456, 51, 'Chunarughat', 'চুনারুঘাট'),
(457, 51, 'Habiganj Sadar', 'হবিগঞ্জ সদর'),
(458, 51, 'Lakhai', 'লাক্ষাই'),
(459, 51, 'Madhabpur', 'মাধবপুর'),
(460, 51, 'Nabiganj', 'নবীগঞ্জ'),
(461, 51, 'Shaistagonj Upazila', 'শায়েস্তাগঞ্জ'),
(462, 52, 'Moulvibazar Sadar', 'মৌলভীবাজার'),
(463, 52, 'Barlekha', 'বড়লেখা'),
(464, 52, 'Juri', 'জুড়ি'),
(465, 52, 'Kamalganj', 'কামালগঞ্জ'),
(466, 52, 'Kulaura', 'কুলাউরা'),
(467, 52, 'Rajnagar', 'রাজনগর'),
(468, 52, 'Sreemangal', 'শ্রীমঙ্গল'),
(469, 53, 'Bishwamvarpur', 'বিসশম্ভারপুর'),
(470, 53, 'Chhatak', 'ছাতক'),
(471, 53, 'Derai', 'দেড়াই'),
(472, 53, 'Dharampasha', 'ধরমপাশা'),
(473, 53, 'Dowarabazar', 'দোয়ারাবাজার'),
(474, 53, 'Jagannathpur', 'জগন্নাথপুর'),
(475, 53, 'Jamalganj', 'জামালগঞ্জ'),
(476, 53, 'Sulla', 'সুল্লা'),
(477, 53, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর'),
(478, 53, 'Shanthiganj', 'শান্তিগঞ্জ'),
(479, 53, 'Tahirpur', 'তাহিরপুর'),
(480, 54, 'Sylhet Sadar', 'সিলেট সদর'),
(481, 54, 'Beanibazar', 'বেয়ানিবাজার'),
(482, 54, 'Bishwanath', 'বিশ্বনাথ'),
(483, 54, 'Dakshin Surma Upazila', 'দক্ষিণ সুরমা'),
(484, 54, 'Balaganj', 'বালাগঞ্জ'),
(485, 54, 'Companiganj', 'কোম্পানিগঞ্জ'),
(486, 54, 'Fenchuganj', 'ফেঞ্চুগঞ্জ'),
(487, 54, 'Golapganj', 'গোলাপগঞ্জ'),
(488, 54, 'Gowainghat', 'গোয়াইনঘাট'),
(489, 54, 'Jaintiapur', 'জয়ন্তপুর'),
(490, 54, 'Kanaighat', 'কানাইঘাট'),
(491, 54, 'Zakiganj', 'জাকিগঞ্জ'),
(492, 54, 'Nobigonj', 'নবীগঞ্জ'),
(493, 1, 'Adabor', NULL),
(494, 1, 'Airport', NULL),
(495, 1, 'Badda', NULL),
(496, 1, 'Banani', NULL),
(497, 1, 'Bangshal', NULL),
(498, 1, 'Bhashantek', NULL),
(499, 1, 'Cantonment', NULL),
(500, 1, 'Chackbazar', NULL),
(501, 1, 'Darussalam', NULL),
(502, 1, 'Daskhinkhan', NULL),
(503, 1, 'Demra', NULL),
(504, 1, 'Dhamrai', NULL),
(505, 1, 'Dhanmondi', NULL),
(506, 1, 'Dohar', NULL),
(507, 1, 'Gandaria', NULL),
(508, 1, 'Gulshan', NULL),
(509, 1, 'Hazaribag', NULL),
(510, 1, 'Jatrabari', NULL),
(511, 1, 'Kafrul', NULL),
(512, 1, 'Kalabagan', NULL),
(513, 1, 'Kamrangirchar', NULL),
(514, 1, 'Keraniganj', NULL),
(515, 1, 'Khilgaon', NULL),
(516, 1, 'Khilkhet', NULL),
(517, 1, 'Kotwali', NULL),
(518, 1, 'Lalbag', NULL),
(519, 1, 'Mirpur Model', NULL),
(520, 1, 'Mohammadpur', NULL),
(521, 1, 'Motijheel', NULL),
(522, 1, 'Mugda', NULL),
(523, 1, 'Nawabganj', NULL),
(524, 1, 'New Market', NULL),
(525, 1, 'Pallabi', NULL),
(526, 1, 'Paltan', NULL),
(527, 1, 'Ramna', NULL),
(528, 1, 'Rampura', NULL),
(529, 1, 'Rupnagar', NULL),
(530, 1, 'Sabujbag', NULL),
(531, 1, 'Savar', NULL),
(532, 1, 'Shah Ali', NULL),
(533, 1, 'Shahbag', NULL),
(534, 1, 'Shahjahanpur', NULL),
(535, 1, 'Sherebanglanagar', NULL),
(536, 1, 'Shyampur', NULL),
(537, 1, 'Sutrapur', NULL),
(538, 1, 'Tejgaon', NULL),
(539, 1, 'Tejgaon I/A', NULL),
(540, 1, 'Turag', NULL),
(541, 1, 'Uttara', NULL),
(542, 1, 'Uttara West', NULL),
(543, 1, 'Uttarkhan', NULL),
(544, 1, 'Vatara', NULL),
(545, 1, 'Wari', NULL),
(546, 1, 'Others', NULL),
(547, 35, 'Airport', NULL),
(548, 35, 'Kawnia', NULL),
(549, 35, 'Bondor', NULL),
(550, 35, 'Others', NULL),
(551, 24, 'Boalia', NULL),
(552, 24, 'Motihar', NULL),
(553, 24, 'Shahmokhdum', NULL),
(554, 24, 'Rajpara', NULL),
(555, 24, 'Others', NULL),
(556, 43, 'Akborsha', NULL),
(557, 43, 'Baijid bostami', NULL),
(558, 43, 'Bakolia', NULL),
(559, 43, 'Bandar', NULL),
(560, 43, 'Chandgaon', NULL),
(561, 43, 'Chokbazar', NULL),
(562, 43, 'Doublemooring', NULL),
(563, 43, 'EPZ', NULL),
(564, 43, 'Hali Shohor', NULL),
(565, 43, 'Kornafuli', NULL),
(566, 43, 'Kotwali', NULL),
(567, 43, 'Kulshi', NULL),
(568, 43, 'Pahartali', NULL),
(569, 43, 'Panchlaish', NULL),
(570, 43, 'Potenga', NULL),
(571, 43, 'Shodhorgat', NULL),
(572, 43, 'Others', NULL),
(573, 44, 'Others', NULL),
(574, 59, 'Aranghata', NULL),
(575, 59, 'Daulatpur', NULL),
(576, 59, 'Harintana', NULL),
(577, 59, 'Horintana', NULL),
(578, 59, 'Khalishpur', NULL),
(579, 59, 'Khanjahan Ali', NULL),
(580, 59, 'Khulna Sadar', NULL),
(581, 59, 'Labanchora', NULL),
(582, 59, 'Sonadanga', NULL),
(583, 59, 'Others', NULL),
(584, 2, 'Others', NULL),
(585, 4, 'Others', NULL),
(586, 5, 'Others', NULL),
(587, 54, 'Airport', NULL),
(588, 54, 'Hazrat Shah Paran', NULL),
(589, 54, 'Jalalabad', NULL),
(590, 54, 'Kowtali', NULL),
(591, 54, 'Moglabazar', NULL),
(592, 54, 'Osmani Nagar', NULL),
(593, 54, 'South Surma', NULL),
(594, 54, 'Others', NULL),
(595, 21, 'Naldanga Upazila', 'নলডাঙ্গা ');

-- --------------------------------------------------------

--
-- Table structure for table `upazila_basic_info`
--

CREATE TABLE `upazila_basic_info` (
  `id` int(11) UNSIGNED NOT NULL,
  `introduction` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`introduction`)),
  `history` text DEFAULT NULL,
  `geographical_view` text DEFAULT NULL,
  `representative_upazila_organogram` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `freedom_fighter` text DEFAULT NULL,
  `upazila_chairman` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `vice_chariman` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `female_vice_chairman` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `previous_chairman` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `parisad_kajjokal` text DEFAULT NULL,
  `pourosova_at_glance` text DEFAULT NULL,
  `mayor` text DEFAULT NULL,
  `councilor` text DEFAULT NULL,
  `kormokorta` text DEFAULT NULL,
  `kormocari` text DEFAULT NULL,
  `pourosova_ward` text DEFAULT NULL,
  `citizen_charter` text DEFAULT NULL,
  `organizational_structure` text DEFAULT NULL,
  `educational_institution` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `non_govt_organization` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `religious_institutions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `slider` text DEFAULT NULL,
  `social_media` text DEFAULT NULL,
  `bcs_batch` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upazila_basic_info`
--

INSERT INTO `upazila_basic_info` (`id`, `introduction`, `history`, `geographical_view`, `representative_upazila_organogram`, `freedom_fighter`, `upazila_chairman`, `vice_chariman`, `female_vice_chairman`, `previous_chairman`, `parisad_kajjokal`, `pourosova_at_glance`, `mayor`, `councilor`, `kormokorta`, `kormocari`, `pourosova_ward`, `citizen_charter`, `organizational_structure`, `educational_institution`, `non_govt_organization`, `religious_institutions`, `slider`, `social_media`, `bcs_batch`, `is_active`, `created_by`, `created_at`, `created_ip`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(13, '[{\"id\":1,\"title\":\"9\",\"description\":\"222\",\"display_position\":\"1\",\"is_active\":\"1\",\"created_by\":1,\"created_ip\":\"::1\",\"created_at\":\"2021-06-28 04:41:05\"},{\"id\":2,\"title\":\"10\",\"description\":\"2\",\"display_position\":\"1\",\"is_active\":\"1\",\"created_by\":1,\"created_ip\":\"::1\",\"created_at\":\"2021-06-28 04:41:37\"}]', '{\"history\":\"<p>tyshfdgsdfds<\\/p>\",\"created_by\":1,\"created_ip\":\"::1\",\"created_at\":\"2021-06-28 04:54:53\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[ { \"id\": 1, \"name\": \"১ম ব্যাচ \" }, { \"id\": 2, \"name\": \"২য়  ব্যাচ\" }, { \"id\": 3, \"name\": \"৩য়  ব্যাচ\" }, { \"id\": 4, \"name\": \"৪র্থ  ব্যাচ\" }, { \"id\": 5, \"name\": \"৫ম  ব্যাচ\" } ]', 1, 1, '2021-06-28 04:41:37', '::1', 1, '2021-06-28 04:54:53', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `is_active`, `created_by`, `created_ip`, `updated_by`, `updated_ip`, `created_at`, `updated_at`) VALUES
(1, 'Omar Shohag', 'omarshohag93@gmail.com', NULL, '$2y$10$Ow3yxeMQtI.pHqkbqIUbB.djZwcA8015KCj8M9R4ruNALVVZmG5xK', NULL, 1, NULL, NULL, NULL, NULL, '2021-04-23 04:07:42', '2021-04-23 04:07:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl_menu_info`
--
ALTER TABLE `acl_menu_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acl_role_info`
--
ALTER TABLE `acl_role_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_type_titles`
--
ALTER TABLE `all_type_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dc_uno_chairman_info`
--
ALTER TABLE `dc_uno_chairman_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `division_id` (`division_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynamic_content_page`
--
ALTER TABLE `dynamic_content_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `footer_areas`
--
ALTER TABLE `footer_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizational_structure`
--
ALTER TABLE `organizational_structure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `union_infos`
--
ALTER TABLE `union_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `upazila_basic_info`
--
ALTER TABLE `upazila_basic_info`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `acl_menu_info`
--
ALTER TABLE `acl_menu_info`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `acl_role_info`
--
ALTER TABLE `acl_role_info`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `all_type_titles`
--
ALTER TABLE `all_type_titles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dc_uno_chairman_info`
--
ALTER TABLE `dc_uno_chairman_info`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dynamic_content_page`
--
ALTER TABLE `dynamic_content_page`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `footer_areas`
--
ALTER TABLE `footer_areas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organizational_structure`
--
ALTER TABLE `organizational_structure`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `union_infos`
--
ALTER TABLE `union_infos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=596;

--
-- AUTO_INCREMENT for table `upazila_basic_info`
--
ALTER TABLE `upazila_basic_info`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD CONSTRAINT `upazilas_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
