-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2018 at 05:39 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 5.6.35-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounting_tree_level_ones`
--

CREATE TABLE `accounting_tree_level_ones` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounting_tree_level_ones`
--

INSERT INTO `accounting_tree_level_ones` (`id`, `code`, `title`, `level`, `debit`, `credit`, `created_at`, `updated_at`) VALUES
(1, '1', 'الاصول', 1, 0, 1, '2018-04-04 09:40:38', '2018-04-04 09:40:38'),
(2, '2', 'الخصوم', 1, 1, 0, '2018-04-04 09:41:40', '2018-04-04 09:41:40'),
(3, '3', 'المصروفات', 1, 0, 1, '2018-04-04 09:41:54', '2018-04-04 09:41:54'),
(4, '4', 'الإيرادات', 1, 1, 0, '2018-04-04 09:42:08', '2018-04-04 09:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_tree_level_twos`
--

CREATE TABLE `accounting_tree_level_twos` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accounting_tree_level_one_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounting_tree_level_twos`
--

INSERT INTO `accounting_tree_level_twos` (`id`, `code`, `title`, `accounting_tree_level_one_id`, `level`, `debit`, `credit`, `created_at`, `updated_at`) VALUES
(1, '11', 'اصول ثابتة', 1, 2, 0, 1, '2018-04-04 09:42:52', '2018-04-04 09:42:52'),
(2, '12', 'اصول متداولة', 1, 2, 0, 1, '2018-04-04 09:43:29', '2018-04-04 09:43:29'),
(3, '21', 'خصوم متداولة', 2, 2, 1, 0, '2018-04-04 09:43:57', '2018-04-04 09:43:57'),
(4, '31', 'مصروفات عمومية', 3, 2, 0, 1, '2018-04-04 09:44:25', '2018-04-04 09:44:25'),
(5, '32', 'مصروفات أنشطة', 3, 2, 0, 1, '2018-04-04 09:44:42', '2018-04-04 09:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `account_sheets`
--

CREATE TABLE `account_sheets` (
  `id` int(10) UNSIGNED NOT NULL,
  `sheet_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sheet_date` datetime NOT NULL,
  `type` tinyint(4) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `credit_amount` double(15,8) NOT NULL,
  `debit_amount` double(15,8) NOT NULL,
  `alpha_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `report` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_account` int(11) NOT NULL,
  `to_account` int(11) NOT NULL,
  `donation_section` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accured_expenses`
--

CREATE TABLE `accured_expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accured_revenues`
--

CREATE TABLE `accured_revenues` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accured_revenues_items`
--

CREATE TABLE `accured_revenues_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advanced_expenses`
--

CREATE TABLE `advanced_expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `amounts_under_adjustment`
--

CREATE TABLE `amounts_under_adjustment` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `code`, `title`, `parent`, `level`, `debit`, `credit`, `created_at`, `updated_at`) VALUES
(1, '120201', 'بنك المصرف المتحد ', 2, 4, 1, 0, '2018-04-15 11:59:01', '2018-04-15 11:59:01'),
(2, '120202', 'بنك التجاري الدولي ', 2, 4, 1, 0, '2018-04-15 12:00:02', '2018-04-15 12:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_account_items`
--

CREATE TABLE `bank_account_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cib_machine`
--

CREATE TABLE `cib_machine` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `creditors`
--

CREATE TABLE `creditors` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `currency_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `current_assets`
--

CREATE TABLE `current_assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `current_assets`
--

INSERT INTO `current_assets` (`id`, `code`, `title`, `parent`, `level`, `debit`, `credit`, `created_at`, `updated_at`) VALUES
(1, '1201', 'الخزينة', 2, 3, 0, 1, '2018-04-10 06:21:26', '2018-04-10 06:21:26'),
(2, '1202', 'البنك ', 2, 3, 0, 1, '2018-04-10 06:50:33', '2018-04-10 06:50:33'),
(3, '1203', 'مصروفات مقدمة ', 2, 3, 0, 1, '2018-04-10 07:03:05', '2018-04-10 07:03:05'),
(4, '1204', 'تأمينات لدي الغير ', 2, 3, 0, 1, '2018-04-15 10:55:21', '2018-04-15 10:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `current_liabilities`
--

CREATE TABLE `current_liabilities` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `current_liabilities`
--

INSERT INTO `current_liabilities` (`id`, `code`, `title`, `parent`, `level`, `debit`, `credit`, `created_at`, `updated_at`) VALUES
(1, '2101', 'الموردين ', 3, 3, 1, 0, '2018-04-15 11:12:40', '2018-04-15 11:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `custody_and_advances`
--

CREATE TABLE `custody_and_advances` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custody_sheets`
--

CREATE TABLE `custody_sheets` (
  `id` int(10) UNSIGNED NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `report` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(15,8) NOT NULL,
  `custody_date` datetime NOT NULL,
  `worker_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits_with_others`
--

CREATE TABLE `deposits_with_others` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits_with_other_items`
--

CREATE TABLE `deposits_with_other_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donation_receipts`
--

CREATE TABLE `donation_receipts` (
  `id` int(10) UNSIGNED NOT NULL,
  `cash` tinyint(1) NOT NULL,
  `amount` double(15,8) NOT NULL,
  `alpha_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `receipt_date` datetime NOT NULL,
  `cheque_number` bigint(20) NOT NULL,
  `cheque_bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cheque_date` datetime NOT NULL,
  `donator_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `donator_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `donator_mobile` int(11) NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `project_id` int(11) NOT NULL,
  `receipt_writter_id` int(11) NOT NULL,
  `receipt_delegate_id` int(11) NOT NULL,
  `receipt_notebook` int(11) NOT NULL,
  `receipt_for_month` int(11) NOT NULL,
  `donation_section` int(11) NOT NULL,
  `collecting_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_items`
--

CREATE TABLE `expenses_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fawry`
--

CREATE TABLE `fawry` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fawry_banks`
--

CREATE TABLE `fawry_banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fawry_items`
--

CREATE TABLE `fawry_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fixed_assets`
--

CREATE TABLE `fixed_assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fixed_assets`
--

INSERT INTO `fixed_assets` (`id`, `code`, `title`, `parent`, `level`, `debit`, `credit`, `created_at`, `updated_at`) VALUES
(1, '1101', 'مكاتب واثاث', 1, 3, 0, 1, '2018-04-04 10:05:35', '2018-04-04 10:05:35'),
(2, '1102', 'تركيبات و ديكورات', 1, 3, 0, 1, '2018-04-04 10:08:14', '2018-04-04 10:08:14'),
(3, '1103', 'تكييفات ', 1, 3, 0, 1, '2018-04-10 06:10:11', '2018-04-10 06:10:11'),
(4, '1104', 'ماكينات تصوير ', 1, 3, 0, 1, '2018-04-15 07:50:07', '2018-04-15 07:50:07'),
(5, '1105', 'برنتروفاكس ', 1, 3, 0, 1, '2018-04-15 07:51:46', '2018-04-15 07:51:46'),
(6, '1106', 'سنترال و تليفونات ', 1, 3, 0, 1, '2018-04-15 09:19:13', '2018-04-15 09:19:13'),
(7, '1107', 'أجهزة كهربائية ', 1, 3, 0, 1, '2018-04-15 10:55:51', '2018-04-15 10:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `friendship_fund`
--

CREATE TABLE `friendship_fund` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2018_02_11_121017_create_roles_table', 1),
('2018_02_21_091402_create_receipts_table', 1),
('2018_02_21_094751_create_donation_receipts_table', 1),
('2018_02_21_094820_create_currencies_table', 1),
('2018_02_21_094831_create_projects_table', 1),
('2018_02_21_094849_create_account_sheets_table', 1),
('2018_02_21_094905_create_users_history_logs_table', 1),
('2018_02_21_094943_create_custody_sheets_table', 1),
('2018_03_26_153832_create_accounting_tree_level_ones_table', 1),
('2018_03_26_154715_create_accounting_tree_level_twos_table', 1),
('2018_03_26_154834_create_current_assets_table', 1),
('2018_03_26_155011_create_banks_table', 1),
('2018_03_26_155057_create_bank_account_table', 1),
('2018_03_26_155128_create_bank_account_items_table', 1),
('2018_03_26_155521_create_treasury_table', 1),
('2018_03_26_155703_create_cib_machine_table', 1),
('2018_03_26_155725_create_fawry_table', 1),
('2018_03_26_155739_create_fawry_items_table', 1),
('2018_03_26_155745_create_fawry_banks_table', 1),
('2018_03_26_155822_create_fixed_assets_table', 1),
('2018_03_27_124106_create_store_items_table', 1),
('2018_03_27_124115_create_store_logs_table', 1),
('2018_03_27_125551_create_accured_revenues_table', 1),
('2018_03_27_125558_create_accured_revenues_items_table', 1),
('2018_03_27_125849_create_sms_table', 1),
('2018_03_27_130020_create_receivable_cheques_table', 1),
('2018_03_27_130052_create_various_debitors_table', 1),
('2018_03_27_130430_create_other_debit_balances_table', 1),
('2018_03_27_130517_create_deposits_with_others_table', 1),
('2018_03_27_130526_create_deposits_with_other_items_table', 1),
('2018_03_27_130611_create_advanced_expenses_table', 1),
('2018_03_27_130626_create_expenses_items_table', 1),
('2018_03_27_132551_create_custody_and_advances_table', 1),
('2018_03_27_132601_create_workers_table', 1),
('2018_03_27_133031_create_current_liabilities_table', 1),
('2018_03_27_133102_create_accured_expenses_table', 1),
('2018_03_27_133126_create_payable_cheques_table', 1),
('2018_03_27_133138_create_taxes_table', 1),
('2018_03_27_133200_create_amounts_under_adjustment_table', 1),
('2018_03_27_133212_create_creditors_table', 1),
('2018_03_27_134341_create_social_insurance_table', 1),
('2018_03_27_134348_create_social_insurance_items_table', 1),
('2018_03_27_134410_create_suppliers_table', 1),
('2018_03_27_134725_create_suppliers_creditors_table', 1),
('2018_03_27_141755_create_penalities_fund_table', 1),
('2018_03_27_141813_create_friendship_fund_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `other_debit_balances`
--

CREATE TABLE `other_debit_balances` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payable_cheques`
--

CREATE TABLE `payable_cheques` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penalities_fund`
--

CREATE TABLE `penalities_fund` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `published_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(10) UNSIGNED NOT NULL,
  `cash` tinyint(1) NOT NULL,
  `amount` double(15,8) NOT NULL,
  `alpha_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `receipt_date` datetime NOT NULL,
  `cheque_number` bigint(20) NOT NULL,
  `cheque_bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cheque_date` datetime NOT NULL,
  `for_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivered_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receivable_cheques`
--

CREATE TABLE `receivable_cheques` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_insurance`
--

CREATE TABLE `social_insurance` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_insurance_items`
--

CREATE TABLE `social_insurance_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE `store_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_logs`
--

CREATE TABLE `store_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_creditors`
--

CREATE TABLE `suppliers_creditors` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treasury`
--

CREATE TABLE `treasury` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'shrouk', 'shrouk@gmail.com', '$2y$10$tlTqcwjhyXMHYau9ebS96O/yLjdcNIiqwhfrULQ3z0369fAcisGkC', 1, 0, 'vjFHgdyRlnjAUAEE0tTzXr2ebfcWGkJEGrCG4eF0uXyX1ag2nCfTUXtqBRJg', '2018-04-04 09:39:09', '2018-04-05 12:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `various_debitors`
--

CREATE TABLE `various_debitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `debit` tinyint(1) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_tree_level_ones`
--
ALTER TABLE `accounting_tree_level_ones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_tree_level_twos`
--
ALTER TABLE `accounting_tree_level_twos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_sheets`
--
ALTER TABLE `account_sheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accured_expenses`
--
ALTER TABLE `accured_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accured_revenues`
--
ALTER TABLE `accured_revenues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accured_revenues_items`
--
ALTER TABLE `accured_revenues_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advanced_expenses`
--
ALTER TABLE `advanced_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amounts_under_adjustment`
--
ALTER TABLE `amounts_under_adjustment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_account_items`
--
ALTER TABLE `bank_account_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cib_machine`
--
ALTER TABLE `cib_machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditors`
--
ALTER TABLE `creditors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_assets`
--
ALTER TABLE `current_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_liabilities`
--
ALTER TABLE `current_liabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custody_and_advances`
--
ALTER TABLE `custody_and_advances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custody_sheets`
--
ALTER TABLE `custody_sheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits_with_others`
--
ALTER TABLE `deposits_with_others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits_with_other_items`
--
ALTER TABLE `deposits_with_other_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_receipts`
--
ALTER TABLE `donation_receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses_items`
--
ALTER TABLE `expenses_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fawry`
--
ALTER TABLE `fawry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fawry_banks`
--
ALTER TABLE `fawry_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fawry_items`
--
ALTER TABLE `fawry_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixed_assets`
--
ALTER TABLE `fixed_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendship_fund`
--
ALTER TABLE `friendship_fund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_debit_balances`
--
ALTER TABLE `other_debit_balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payable_cheques`
--
ALTER TABLE `payable_cheques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalities_fund`
--
ALTER TABLE `penalities_fund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_code_unique` (`code`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receivable_cheques`
--
ALTER TABLE `receivable_cheques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_insurance`
--
ALTER TABLE `social_insurance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_insurance_items`
--
ALTER TABLE `social_insurance_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_logs`
--
ALTER TABLE `store_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers_creditors`
--
ALTER TABLE `suppliers_creditors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treasury`
--
ALTER TABLE `treasury`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `various_debitors`
--
ALTER TABLE `various_debitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_tree_level_ones`
--
ALTER TABLE `accounting_tree_level_ones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `accounting_tree_level_twos`
--
ALTER TABLE `accounting_tree_level_twos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `account_sheets`
--
ALTER TABLE `account_sheets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `accured_expenses`
--
ALTER TABLE `accured_expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `accured_revenues`
--
ALTER TABLE `accured_revenues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `accured_revenues_items`
--
ALTER TABLE `accured_revenues_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `advanced_expenses`
--
ALTER TABLE `advanced_expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `amounts_under_adjustment`
--
ALTER TABLE `amounts_under_adjustment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bank_account_items`
--
ALTER TABLE `bank_account_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cib_machine`
--
ALTER TABLE `cib_machine`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `creditors`
--
ALTER TABLE `creditors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `current_assets`
--
ALTER TABLE `current_assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `current_liabilities`
--
ALTER TABLE `current_liabilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `custody_and_advances`
--
ALTER TABLE `custody_and_advances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custody_sheets`
--
ALTER TABLE `custody_sheets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deposits_with_others`
--
ALTER TABLE `deposits_with_others`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deposits_with_other_items`
--
ALTER TABLE `deposits_with_other_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `donation_receipts`
--
ALTER TABLE `donation_receipts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenses_items`
--
ALTER TABLE `expenses_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fawry`
--
ALTER TABLE `fawry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fawry_banks`
--
ALTER TABLE `fawry_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fawry_items`
--
ALTER TABLE `fawry_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fixed_assets`
--
ALTER TABLE `fixed_assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `friendship_fund`
--
ALTER TABLE `friendship_fund`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `other_debit_balances`
--
ALTER TABLE `other_debit_balances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payable_cheques`
--
ALTER TABLE `payable_cheques`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penalities_fund`
--
ALTER TABLE `penalities_fund`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `receivable_cheques`
--
ALTER TABLE `receivable_cheques`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `social_insurance`
--
ALTER TABLE `social_insurance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `social_insurance_items`
--
ALTER TABLE `social_insurance_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_items`
--
ALTER TABLE `store_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_logs`
--
ALTER TABLE `store_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers_creditors`
--
ALTER TABLE `suppliers_creditors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treasury`
--
ALTER TABLE `treasury`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `various_debitors`
--
ALTER TABLE `various_debitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
