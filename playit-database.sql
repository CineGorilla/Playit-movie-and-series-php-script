-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2021 at 09:33 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `playit`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `actors_items`
--

CREATE TABLE `actors_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` bigint(20) UNSIGNED NOT NULL,
  `actors_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT 1,
  `site_728x90_banner` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_468x60_banner` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_300x250_banner` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_320x100_banner` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_popunder` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_sticky_banner` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_push_notifications` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_desktop_fullpage_interstitial` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `activate`, `site_728x90_banner`, `site_468x60_banner`, `site_300x250_banner`, `site_320x100_banner`, `site_popunder`, `site_sticky_banner`, `site_push_notifications`, `site_desktop_fullpage_interstitial`, `created_at`, `updated_at`) VALUES
(1, 1, 'PGEgaHJlZj0iIyI+PGltZyBzcmM9Ii9zZXR0aW5nX2ltZy9hZHZlcnRpc2VtZW50LzcyOHg5MC1hZC11bml0LmpwZyIgYWx0PSI3Mjh4OTAtYWQtdW5pdCI+PC9hPg==', 'PGEgaHJlZj0iIyI+PGltZyBzcmM9Ii9zZXR0aW5nX2ltZy9hZHZlcnRpc2VtZW50LzQ2OHg2MC1hZC11bml0LmpwZyIgYWx0PSI0Njh4NjAtYWQtdW5pdCI+PC9hPg==', 'aHR0cHM6Ly93d3cucmFkaWFudG1lZGlhcGxheWVyLmNvbS92YXN0L3RhZ3MvaW5saW5lLWxpbmVhci54bWw=', 'PGEgaHJlZj0iIyI+PGltZyBzcmM9Ii9zZXR0aW5nX2ltZy9hZHZlcnRpc2VtZW50LzMyMHgxMDAtYWQtdW5pdC5qcGciIGFsdD0iMzIweDEwMC1hZC11bml0Ij48L2E+', '', '', '', '', '2021-06-02 01:51:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `season_id` int(11) DEFAULT NULL,
  `episode_id` int(11) DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AD', 'Andorra', '2021-06-02 01:51:41', NULL),
(2, 'AE', 'United Arab Emirates', '2021-06-02 01:51:41', NULL),
(3, 'AF', 'Afghanistan', '2021-06-02 01:51:41', NULL),
(4, 'AG', 'Antigua and Barbuda', '2021-06-02 01:51:41', NULL),
(5, 'AI', 'Anguilla', '2021-06-02 01:51:41', NULL),
(6, 'AL', 'Albania', '2021-06-02 01:51:41', NULL),
(7, 'AM', 'Armenia', '2021-06-02 01:51:41', NULL),
(8, 'AN', 'Netherlands Antilles', '2021-06-02 01:51:41', NULL),
(9, 'AO', 'Angola', '2021-06-02 01:51:41', NULL),
(10, 'AQ', 'Antarctica', '2021-06-02 01:51:41', NULL),
(11, 'AR', 'Argentina', '2021-06-02 01:51:41', NULL),
(12, 'AS', 'American Samoa', '2021-06-02 01:51:41', NULL),
(13, 'AT', 'Austria', '2021-06-02 01:51:41', NULL),
(14, 'AU', 'Australia', '2021-06-02 01:51:41', NULL),
(15, 'AW', 'Aruba', '2021-06-02 01:51:41', NULL),
(16, 'AZ', 'Azerbaijan', '2021-06-02 01:51:41', NULL),
(17, 'BA', 'Bosnia and Herzegovina', '2021-06-02 01:51:41', NULL),
(18, 'BB', 'Barbados', '2021-06-02 01:51:41', NULL),
(19, 'BD', 'Bangladesh', '2021-06-02 01:51:41', NULL),
(20, 'BE', 'Belgium', '2021-06-02 01:51:41', NULL),
(21, 'BF', 'Burkina Faso', '2021-06-02 01:51:41', NULL),
(22, 'BG', 'Bulgaria', '2021-06-02 01:51:41', NULL),
(23, 'BH', 'Bahrain', '2021-06-02 01:51:41', NULL),
(24, 'BI', 'Burundi', '2021-06-02 01:51:41', NULL),
(25, 'BJ', 'Benin', '2021-06-02 01:51:41', NULL),
(26, 'BM', 'Bermuda', '2021-06-02 01:51:41', NULL),
(27, 'BN', 'Brunei Darussalam', '2021-06-02 01:51:41', NULL),
(28, 'BO', 'Bolivia', '2021-06-02 01:51:41', NULL),
(29, 'BR', 'Brazil', '2021-06-02 01:51:41', NULL),
(30, 'BS', 'Bahamas', '2021-06-02 01:51:41', NULL),
(31, 'BT', 'Bhutan', '2021-06-02 01:51:41', NULL),
(32, 'BV', 'Bouvet Island', '2021-06-02 01:51:41', NULL),
(33, 'BW', 'Botswana', '2021-06-02 01:51:41', NULL),
(34, 'BZ', 'Belize', '2021-06-02 01:51:41', NULL),
(35, 'BY', 'Belarus', '2021-06-02 01:51:41', NULL),
(36, 'CA', 'Canada', '2021-06-02 01:51:41', NULL),
(37, 'CC', 'Cocos  Islands', '2021-06-02 01:51:41', NULL),
(38, 'CD', 'Congo', '2021-06-02 01:51:41', NULL),
(39, 'CF', 'Central African Republic', '2021-06-02 01:51:41', NULL),
(40, 'CG', 'Congo', '2021-06-02 01:51:41', NULL),
(41, 'CH', 'Switzerland', '2021-06-02 01:51:41', NULL),
(42, 'CI', 'Cote D\'Ivoire', '2021-06-02 01:51:41', NULL),
(43, 'CK', 'Cook Islands', '2021-06-02 01:51:41', NULL),
(44, 'CL', 'Chile', '2021-06-02 01:51:41', NULL),
(45, 'CM', 'Cameroon', '2021-06-02 01:51:41', NULL),
(46, 'CN', 'China', '2021-06-02 01:51:41', NULL),
(47, 'CO', 'Colombia', '2021-06-02 01:51:41', NULL),
(48, 'CR', 'Costa Rica', '2021-06-02 01:51:41', NULL),
(49, 'CS', 'Serbia and Montenegro', '2021-06-02 01:51:41', NULL),
(50, 'CU', 'Cuba', '2021-06-02 01:51:41', NULL),
(51, 'CV', 'Cape Verde', '2021-06-02 01:51:41', NULL),
(52, 'CX', 'Christmas Island', '2021-06-02 01:51:41', NULL),
(53, 'CY', 'Cyprus', '2021-06-02 01:51:41', NULL),
(54, 'CZ', 'Czech Republic', '2021-06-02 01:51:41', NULL),
(55, 'DE', 'Germany', '2021-06-02 01:51:41', NULL),
(56, 'DJ', 'Djibouti', '2021-06-02 01:51:41', NULL),
(57, 'DK', 'Denmark', '2021-06-02 01:51:41', NULL),
(58, 'DM', 'Dominica', '2021-06-02 01:51:41', NULL),
(59, 'DO', 'Dominican Republic', '2021-06-02 01:51:41', NULL),
(60, 'DZ', 'Algeria', '2021-06-02 01:51:41', NULL),
(61, 'EC', 'Ecuador', '2021-06-02 01:51:41', NULL),
(62, 'EE', 'Estonia', '2021-06-02 01:51:41', NULL),
(63, 'EG', 'Egypt', '2021-06-02 01:51:41', NULL),
(64, 'EH', 'Western Sahara', '2021-06-02 01:51:41', NULL),
(65, 'ER', 'Eritrea', '2021-06-02 01:51:41', NULL),
(66, 'ES', 'Spain', '2021-06-02 01:51:41', NULL),
(67, 'ET', 'Ethiopia', '2021-06-02 01:51:41', NULL),
(68, 'FI', 'Finland', '2021-06-02 01:51:41', NULL),
(69, 'FJ', 'Fiji', '2021-06-02 01:51:41', NULL),
(70, 'FK', 'Falkland Islands', '2021-06-02 01:51:41', NULL),
(71, 'RS', 'Serbia', '2021-06-02 01:51:41', NULL),
(72, 'FM', 'Micronesia', '2021-06-02 01:51:41', NULL),
(73, 'FO', 'Faeroe Islands', '2021-06-02 01:51:41', NULL),
(74, 'FR', 'France', '2021-06-02 01:51:41', NULL),
(75, 'GA', 'Gabon', '2021-06-02 01:51:41', NULL),
(76, 'GB', 'United Kingdom', '2021-06-02 01:51:41', NULL),
(77, 'GD', 'Grenada', '2021-06-02 01:51:41', NULL),
(78, 'GE', 'Georgia', '2021-06-02 01:51:41', NULL),
(79, 'GF', 'French Guiana', '2021-06-02 01:51:41', NULL),
(80, 'GH', 'Ghana', '2021-06-02 01:51:41', NULL),
(81, 'GI', 'Gibraltar', '2021-06-02 01:51:41', NULL),
(82, 'GL', 'Greenland', '2021-06-02 01:51:41', NULL),
(83, 'GM', 'Gambia', '2021-06-02 01:51:41', NULL),
(84, 'GN', 'Guinea', '2021-06-02 01:51:41', NULL),
(85, 'GP', 'Guadaloupe', '2021-06-02 01:51:41', NULL),
(86, 'GQ', 'Equatorial Guinea', '2021-06-02 01:51:41', NULL),
(87, 'GR', 'Greece', '2021-06-02 01:51:41', NULL),
(88, 'GS', 'South Georgia and the South Sandwich Islands', '2021-06-02 01:51:41', NULL),
(89, 'GT', 'Guatemala', '2021-06-02 01:51:41', NULL),
(90, 'GU', 'Guam', '2021-06-02 01:51:41', NULL),
(91, 'GW', 'Guinea-Bissau', '2021-06-02 01:51:41', NULL),
(92, 'GY', 'Guyana', '2021-06-02 01:51:41', NULL),
(93, 'HK', 'Hong Kong', '2021-06-02 01:51:41', NULL),
(94, 'HM', 'Heard and McDonald Islands', '2021-06-02 01:51:41', NULL),
(95, 'HN', 'Honduras', '2021-06-02 01:51:41', NULL),
(96, 'HR', 'Croatia', '2021-06-02 01:51:41', NULL),
(97, 'HT', 'Haiti', '2021-06-02 01:51:41', NULL),
(98, 'HU', 'Hungary', '2021-06-02 01:51:41', NULL),
(99, 'ID', 'Indonesia', '2021-06-02 01:51:41', NULL),
(100, 'IE', 'Ireland', '2021-06-02 01:51:41', NULL),
(101, 'IL', 'Israel', '2021-06-02 01:51:41', NULL),
(102, 'IN', 'India', '2021-06-02 01:51:41', NULL),
(103, 'IO', 'British Indian Ocean Territory', '2021-06-02 01:51:41', NULL),
(104, 'IQ', 'Iraq', '2021-06-02 01:51:41', NULL),
(105, 'IR', 'Iran', '2021-06-02 01:51:41', NULL),
(106, 'IS', 'Iceland', '2021-06-02 01:51:41', NULL),
(107, 'IT', 'Italy', '2021-06-02 01:51:41', NULL),
(108, 'JM', 'Jamaica', '2021-06-02 01:51:41', NULL),
(109, 'JO', 'Jordan', '2021-06-02 01:51:41', NULL),
(110, 'JP', 'Japan', '2021-06-02 01:51:41', NULL),
(111, 'KE', 'Kenya', '2021-06-02 01:51:41', NULL),
(112, 'KG', 'Kyrgyz Republic', '2021-06-02 01:51:41', NULL),
(113, 'KH', 'Cambodia', '2021-06-02 01:51:41', NULL),
(114, 'KI', 'Kiribati', '2021-06-02 01:51:41', NULL),
(115, 'KM', 'Comoros', '2021-06-02 01:51:41', NULL),
(116, 'KN', 'St. Kitts and Nevis', '2021-06-02 01:51:41', NULL),
(117, 'KP', 'North Korea', '2021-06-02 01:51:41', NULL),
(118, 'KW', 'Kuwait', '2021-06-02 01:51:41', NULL),
(119, 'KY', 'Cayman Islands', '2021-06-02 01:51:41', NULL),
(120, 'KZ', 'Kazakhstan', '2021-06-02 01:51:41', NULL),
(121, 'LA', 'Lao People\'s Democratic Republic', '2021-06-02 01:51:41', NULL),
(122, 'LB', 'Lebanon', '2021-06-02 01:51:41', NULL),
(123, 'LC', 'St. Lucia', '2021-06-02 01:51:41', NULL),
(124, 'LI', 'Liechtenstein', '2021-06-02 01:51:41', NULL),
(125, 'LK', 'Sri Lanka', '2021-06-02 01:51:41', NULL),
(126, 'LR', 'Liberia', '2021-06-02 01:51:41', NULL),
(127, 'LS', 'Lesotho', '2021-06-02 01:51:41', NULL),
(128, 'LT', 'Lithuania', '2021-06-02 01:51:41', NULL),
(129, 'LU', 'Luxembourg', '2021-06-02 01:51:41', NULL),
(130, 'LV', 'Latvia', '2021-06-02 01:51:41', NULL),
(131, 'LY', 'Libyan Arab Jamahiriya', '2021-06-02 01:51:41', NULL),
(132, 'MA', 'Morocco', '2021-06-02 01:51:41', NULL),
(133, 'MC', 'Monaco', '2021-06-02 01:51:41', NULL),
(134, 'MD', 'Moldova', '2021-06-02 01:51:41', NULL),
(135, 'MG', 'Madagascar', '2021-06-02 01:51:41', NULL),
(136, 'MH', 'Marshall Islands', '2021-06-02 01:51:41', NULL),
(137, 'MK', 'Macedonia', '2021-06-02 01:51:41', NULL),
(138, 'ML', 'Mali', '2021-06-02 01:51:41', NULL),
(139, 'MM', 'Myanmar', '2021-06-02 01:51:41', NULL),
(140, 'MN', 'Mongolia', '2021-06-02 01:51:41', NULL),
(141, 'MO', 'Macao', '2021-06-02 01:51:41', NULL),
(142, 'MP', 'Northern Mariana Islands', '2021-06-02 01:51:41', NULL),
(143, 'MQ', 'Martinique', '2021-06-02 01:51:41', NULL),
(144, 'MR', 'Mauritania', '2021-06-02 01:51:41', NULL),
(145, 'MS', 'Montserrat', '2021-06-02 01:51:41', NULL),
(146, 'MT', 'Malta', '2021-06-02 01:51:41', NULL),
(147, 'MU', 'Mauritius', '2021-06-02 01:51:41', NULL),
(148, 'MV', 'Maldives', '2021-06-02 01:51:41', NULL),
(149, 'MW', 'Malawi', '2021-06-02 01:51:41', NULL),
(150, 'MX', 'Mexico', '2021-06-02 01:51:41', NULL),
(151, 'MY', 'Malaysia', '2021-06-02 01:51:41', NULL),
(152, 'MZ', 'Mozambique', '2021-06-02 01:51:41', NULL),
(153, 'NA', 'Namibia', '2021-06-02 01:51:41', NULL),
(154, 'NC', 'New Caledonia', '2021-06-02 01:51:41', NULL),
(155, 'NE', 'Niger', '2021-06-02 01:51:41', NULL),
(156, 'NF', 'Norfolk Island', '2021-06-02 01:51:41', NULL),
(157, 'NG', 'Nigeria', '2021-06-02 01:51:41', NULL),
(158, 'ME', 'Montenegro', '2021-06-02 01:51:41', NULL),
(159, 'NI', 'Nicaragua', '2021-06-02 01:51:41', NULL),
(160, 'NL', 'Netherlands', '2021-06-02 01:51:41', NULL),
(161, 'NO', 'Norway', '2021-06-02 01:51:41', NULL),
(162, 'NP', 'Nepal', '2021-06-02 01:51:41', NULL),
(163, 'NR', 'Nauru', '2021-06-02 01:51:41', NULL),
(164, 'NU', 'Niue', '2021-06-02 01:51:41', NULL),
(165, 'NZ', 'New Zealand', '2021-06-02 01:51:41', NULL),
(166, 'OM', 'Oman', '2021-06-02 01:51:41', NULL),
(167, 'PA', 'Panama', '2021-06-02 01:51:41', NULL),
(168, 'PE', 'Peru', '2021-06-02 01:51:41', NULL),
(169, 'PF', 'French Polynesia', '2021-06-02 01:51:41', NULL),
(170, 'PG', 'Papua New Guinea', '2021-06-02 01:51:41', NULL),
(171, 'PH', 'Philippines', '2021-06-02 01:51:41', NULL),
(172, 'YU', 'Yugoslavia', '2021-06-02 01:51:41', NULL),
(173, 'XK', 'Kosovo', '2021-06-02 01:51:41', NULL),
(174, 'XC', 'Czechoslovakia', '2021-06-02 01:51:41', NULL),
(175, 'PK', 'Pakistan', '2021-06-02 01:51:41', NULL),
(176, 'PL', 'Poland', '2021-06-02 01:51:41', NULL),
(177, 'PM', 'St. Pierre and Miquelon', '2021-06-02 01:51:41', NULL),
(178, 'PN', 'Pitcairn Island', '2021-06-02 01:51:41', NULL),
(179, 'PR', 'Puerto Rico', '2021-06-02 01:51:41', NULL),
(180, 'PS', 'Palestinian Territory', '2021-06-02 01:51:41', NULL),
(181, 'PT', 'Portugal', '2021-06-02 01:51:41', NULL),
(182, 'PW', 'Palau', '2021-06-02 01:51:41', NULL),
(183, 'PY', 'Paraguay', '2021-06-02 01:51:41', NULL),
(184, 'QA', 'Qatar', '2021-06-02 01:51:41', NULL),
(185, 'RE', 'Reunion', '2021-06-02 01:51:41', NULL),
(186, 'RO', 'Romania', '2021-06-02 01:51:41', NULL),
(187, 'RU', 'Russia', '2021-06-02 01:51:41', NULL),
(188, 'RW', 'Rwanda', '2021-06-02 01:51:41', NULL),
(189, 'SA', 'Saudi Arabia', '2021-06-02 01:51:41', NULL),
(190, 'SB', 'Solomon Islands', '2021-06-02 01:51:41', NULL),
(191, 'SC', 'Seychelles', '2021-06-02 01:51:41', NULL),
(192, 'SD', 'Sudan', '2021-06-02 01:51:41', NULL),
(193, 'SE', 'Sweden', '2021-06-02 01:51:41', NULL),
(194, 'SG', 'Singapore', '2021-06-02 01:51:41', NULL),
(195, 'SH', 'St. Helena', '2021-06-02 01:51:41', NULL),
(196, 'SI', 'Slovenia', '2021-06-02 01:51:41', NULL),
(197, 'SJ', 'Svalbard & Jan Mayen Islands', '2021-06-02 01:51:41', NULL),
(198, 'SK', 'Slovakia', '2021-06-02 01:51:41', NULL),
(199, 'SL', 'Sierra Leone', '2021-06-02 01:51:41', NULL),
(200, 'SM', 'San Marino', '2021-06-02 01:51:41', NULL),
(201, 'SN', 'Senegal', '2021-06-02 01:51:41', NULL),
(202, 'SO', 'Somalia', '2021-06-02 01:51:41', NULL),
(203, 'SR', 'Suriname', '2021-06-02 01:51:41', NULL),
(204, 'ST', 'Sao Tome and Principe', '2021-06-02 01:51:41', NULL),
(205, 'SV', 'El Salvador', '2021-06-02 01:51:41', NULL),
(206, 'SY', 'Syrian Arab Republic', '2021-06-02 01:51:41', NULL),
(207, 'SZ', 'Swaziland', '2021-06-02 01:51:41', NULL),
(208, 'TC', 'Turks and Caicos Islands', '2021-06-02 01:51:41', NULL),
(209, 'TD', 'Chad', '2021-06-02 01:51:41', NULL),
(210, 'TF', 'French Southern Territories', '2021-06-02 01:51:41', NULL),
(211, 'TG', 'Togo', '2021-06-02 01:51:41', NULL),
(212, 'TH', 'Thailand', '2021-06-02 01:51:41', NULL),
(213, 'TJ', 'Tajikistan', '2021-06-02 01:51:41', NULL),
(214, 'TK', 'Tokelau', '2021-06-02 01:51:41', NULL),
(215, 'TL', 'Timor-Leste', '2021-06-02 01:51:41', NULL),
(216, 'TM', 'Turkmenistan', '2021-06-02 01:51:41', NULL),
(217, 'TN', 'Tunisia', '2021-06-02 01:51:41', NULL),
(218, 'TO', 'Tonga', '2021-06-02 01:51:41', NULL),
(219, 'TR', 'Turkey', '2021-06-02 01:51:41', NULL),
(220, 'TT', 'Trinidad and Tobago', '2021-06-02 01:51:41', NULL),
(221, 'TV', 'Tuvalu', '2021-06-02 01:51:41', NULL),
(222, 'TW', 'Taiwan', '2021-06-02 01:51:41', NULL),
(223, 'TZ', 'Tanzania', '2021-06-02 01:51:41', NULL),
(224, 'UA', 'Ukraine', '2021-06-02 01:51:41', NULL),
(225, 'UG', 'Uganda', '2021-06-02 01:51:41', NULL),
(226, 'UM', 'United States Minor Outlying Islands', '2021-06-02 01:51:41', NULL),
(227, 'US', 'United States of America', '2021-06-02 01:51:41', NULL),
(228, 'UY', 'Uruguay', '2021-06-02 01:51:41', NULL),
(229, 'UZ', 'Uzbekistan', '2021-06-02 01:51:41', NULL),
(230, 'VA', 'Holy See', '2021-06-02 01:51:41', NULL),
(231, 'VC', 'St. Vincent and the Grenadines', '2021-06-02 01:51:41', NULL),
(232, 'VE', 'Venezuela', '2021-06-02 01:51:41', NULL),
(233, 'VG', 'British Virgin Islands', '2021-06-02 01:51:41', NULL),
(234, 'VI', 'US Virgin Islands', '2021-06-02 01:51:41', NULL),
(235, 'VN', 'Vietnam', '2021-06-02 01:51:41', NULL),
(236, 'VU', 'Vanuatu', '2021-06-02 01:51:41', NULL),
(237, 'WF', 'Wallis and Futuna Islands', '2021-06-02 01:51:41', NULL),
(238, 'WS', 'Samoa', '2021-06-02 01:51:41', NULL),
(239, 'YE', 'Yemen', '2021-06-02 01:51:41', NULL),
(240, 'YT', 'Mayotte', '2021-06-02 01:51:41', NULL),
(241, 'ZA', 'South Africa', '2021-06-02 01:51:41', NULL),
(242, 'ZM', 'Zambia', '2021-06-02 01:51:41', NULL),
(243, 'ZW', 'Zimbabwe', '2021-06-02 01:51:41', NULL),
(244, 'KR', 'South Korea', '2021-06-02 01:51:41', NULL),
(245, 'XG', 'East Germany', '2021-06-02 01:51:41', NULL),
(246, 'SU', 'Soviet Union', '2021-06-02 01:51:41', NULL),
(247, 'SS', 'South Sudan', '2021-06-02 01:51:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries_items`
--

CREATE TABLE `countries_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` bigint(20) UNSIGNED NOT NULL,
  `countries_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `creators`
--

CREATE TABLE `creators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `creators_items`
--

CREATE TABLE `creators_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` bigint(20) UNSIGNED NOT NULL,
  `creators_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `directors_items`
--

CREATE TABLE `directors_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` bigint(20) UNSIGNED NOT NULL,
  `directors_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `series_id` bigint(20) UNSIGNED NOT NULL,
  `season_id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `episode_unique_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `backdrop` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `air_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `player` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `visible`, `created_at`, `updated_at`) VALUES
(12, 'Adventure', 1, '2021-06-02 01:51:41', NULL),
(14, 'Fantasy', 1, '2021-06-02 01:51:41', NULL),
(16, 'Animation', 1, '2021-06-02 01:51:41', NULL),
(18, 'Drama', 1, '2021-06-02 01:51:41', NULL),
(27, 'Horror', 1, '2021-06-02 01:51:41', NULL),
(28, 'Action', 1, '2021-06-02 01:51:41', NULL),
(35, 'Comedy', 1, '2021-06-02 01:51:41', NULL),
(36, 'History', 1, '2021-06-02 01:51:41', NULL),
(37, 'Western', 1, '2021-06-02 01:51:41', NULL),
(53, 'Thriller', 1, '2021-06-02 01:51:41', NULL),
(80, 'Crime', 1, '2021-06-02 01:51:41', NULL),
(99, 'Documentary', 1, '2021-06-02 01:51:41', NULL),
(878, 'Science Fiction', 1, '2021-06-02 01:51:41', NULL),
(9648, 'Mystery', 1, '2021-06-02 01:51:41', NULL),
(10402, 'Music', 1, '2021-06-02 01:51:41', NULL),
(10749, 'Romance', 1, '2021-06-02 01:51:41', NULL),
(10751, 'Family', 1, '2021-06-02 01:51:41', NULL),
(10752, 'War', 1, '2021-06-02 01:51:41', NULL),
(10762, 'Kids', 1, '2021-06-02 01:51:41', NULL),
(10763, 'News', 1, '2021-06-02 01:51:41', NULL),
(10764, 'Reality', 1, '2021-06-02 01:51:41', NULL),
(10766, 'Soap', 1, '2021-06-02 01:51:41', NULL),
(10767, 'Talk', 1, '2021-06-02 01:51:41', NULL),
(10768, 'War & Politics', 1, '2021-06-02 01:51:41', NULL),
(10770, 'TV Movie', 1, '2021-06-02 01:51:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genres_items`
--

CREATE TABLE `genres_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` bigint(20) UNSIGNED NOT NULL,
  `genres_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tmdb_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poster` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `backdrop` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `player` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `feature` tinyint(1) NOT NULL,
  `recommended` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keywords_items`
--

CREATE TABLE `keywords_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` bigint(20) UNSIGNED NOT NULL,
  `keywords_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_01_08_170450_create_items_table', 1),
(5, '2021_01_09_065546_create_countries_table', 1),
(6, '2021_01_09_141837_create_years_table', 1),
(7, '2021_01_09_151307_create_genres_table', 1),
(8, '2021_01_09_162812_create_qualities_table', 1),
(9, '2021_01_09_162858_create_keywords_table', 1),
(10, '2021_01_09_162927_create_directors_table', 1),
(11, '2021_01_09_162944_create_creators_table', 1),
(12, '2021_01_09_162959_create_actors_table', 1),
(13, '2021_01_10_171924_create_actors_items', 1),
(14, '2021_01_10_171943_create_countries_items', 1),
(15, '2021_01_10_171958_create_creators_items', 1),
(16, '2021_01_10_172011_create_directors_items', 1),
(17, '2021_01_10_172029_create_genres_items', 1),
(18, '2021_01_10_172100_create_keywords_items', 1),
(19, '2021_01_10_172113_create_qualities_items', 1),
(20, '2021_01_10_172126_create_years_items', 1),
(21, '2021_02_01_050917_create_episodes_table', 1),
(22, '2021_02_02_160014_create_pages_table', 1),
(23, '2021_02_03_163853_create_comments_table', 1),
(24, '2021_02_04_125203_create_newsletters_table', 1),
(25, '2021_02_06_162552_create_settings_table', 1),
(26, '2021_02_08_055544_create_seo_settings_table', 1),
(27, '2021_02_08_062009_create_advertisements_table', 1),
(28, '2021_02_12_160204_create_watchlists_table', 1),
(29, '2021_03_18_171534_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visible` tinyint(1) NOT NULL,
  `views` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'movie_index', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(2, 'movie_add', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(3, 'movie_update', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(4, 'movie_delete', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(5, 'profile_index', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(6, 'profile_update', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(7, 'series_index', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(8, 'series_add', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(9, 'series_update', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(10, 'series_delete', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(11, 'comments_index', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(12, 'comments_delete', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(13, 'episodes_index', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(14, 'episodes_add', 'web', '2021-06-02 01:51:33', '2021-06-02 01:51:33'),
(15, 'episodes_update', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(16, 'episodes_delete', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(17, 'newsletters_index', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(18, 'newsletters_send', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(19, 'pages_index', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(20, 'pages_add', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(21, 'pages_update', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(22, 'pages_delete', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(23, 'stats_index', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(24, 'users_index', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(25, 'users_add', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(26, 'users_update', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(27, 'users_delete', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(28, 'settings_index', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(29, 'settings_update', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(30, 'genres_index', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(31, 'genres_add', 'web', '2021-06-02 01:51:34', '2021-06-02 01:51:34'),
(32, 'genres_update', 'web', '2021-06-02 01:51:35', '2021-06-02 01:51:35'),
(33, 'genres_delete', 'web', '2021-06-02 01:51:35', '2021-06-02 01:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `qualities`
--

CREATE TABLE `qualities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualities_items`
--

CREATE TABLE `qualities_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` bigint(20) UNSIGNED NOT NULL,
  `qualities_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrators', 'web', '2021-06-02 01:51:35', '2021-06-02 01:51:35'),
(2, 'moderators', 'web', '2021-06-02 01:51:37', '2021-06-02 01:51:37'),
(3, 'authors', 'web', '2021-06-02 01:51:38', '2021-06-02 01:51:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(8, 2),
(8, 3),
(9, 1),
(9, 2),
(9, 3),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(13, 3),
(14, 1),
(14, 2),
(14, 3),
(15, 1),
(15, 2),
(15, 3),
(16, 1),
(16, 2),
(17, 1),
(18, 1),
(19, 1),
(19, 2),
(19, 3),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(23, 3),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(30, 1),
(30, 2),
(30, 3),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2);

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_google_verification_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_bing_verification_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_yandex_verification_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_google_analytics` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_robots` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `site_google_verification_code`, `site_bing_verification_code`, `site_yandex_verification_code`, `site_google_analytics`, `site_robots`, `created_at`, `updated_at`) VALUES
(1, '', '', '', '', 'follow, index', '2021-06-02 01:51:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_favicon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_items_per_page` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_licence_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_comments_moderation` tinyint(1) NOT NULL DEFAULT 1,
  `site_style` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_player` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_author` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_copyright` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_pinterest` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance` tinyint(1) NOT NULL DEFAULT 0,
  `site_maintenance_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_title`, `site_description`, `site_keywords`, `site_logo`, `site_favicon`, `site_items_per_page`, `site_licence_key`, `site_comments_moderation`, `site_style`, `site_player`, `site_author`, `site_email`, `site_copyright`, `site_twitter`, `site_youtube`, `site_pinterest`, `site_linkedin`, `site_facebook`, `maintenance`, `site_maintenance_description`, `created_at`, `updated_at`) VALUES
(1, 'PLAYIT', 'Movies & Series Streaming Laravel PHP Script', 'PLAYIT - Movies & Series Streaming Laravel PHP Script is a complete & outstanding movie streaming solution build on a powerful laravel 8 framework. It auto fetches data from TMDB with API.', 'PLAYIT,play it,movies,series,tv shows,episodes,play,stream,netflix,amazon prime,php,laravel,script', 'logo.png', 'favicon.png', '16', '', 0, 'dark', 'trailer', 'Nitin Pujari', 'pujarinitin92@gmail.com', '© 2021 - PLAYIT - All rights reserved', 'twitter', 'youtube', 'pinterest', 'linkedin', 'facebook', 0, 'Sorry for the inconvenience but we’re performing some maintenance at the moment. If you need to you can always contact us, otherwise we’ll be back online shortly!', '2021-06-02 01:51:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'members',
  `blocked` tinyint(1) NOT NULL DEFAULT 0,
  `profile_img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Welcome to my profile!',
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `blocked`, `profile_img`, `country`, `about`, `facebook`, `pinterest`, `linkedin`, `twitter`, `youtube`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@me.com', NULL, '$2y$10$Trj6AqlZ0CD9M3VlMqB8/OK0GmY9sYg9SdcFGni/dr0sxdNvgWtcC', 'administrators', 0, 'default.png', NULL, 'Welcome to my profile!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Moderator', 'moderator@me.com', NULL, '$2y$10$XID1vmA5Wp3axWXPHvuHkO2G14Q/1O6yQfUWpLfEEHBIbkd4q01VS', 'moderators', 0, 'default.png', NULL, 'Welcome to my profile!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Author', 'author@me.com', NULL, '$2y$10$XgBT2s9cDPhKKyjJhSMALeM2mWu631SecoaPyosyvEVO5XetXd4a6', 'authors', 0, 'default.png', NULL, 'Welcome to my profile!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Member', 'member@me.com', NULL, '$2y$10$Tv0tcONSY5NpZbrBcPrDzu5MQztXupcF4Dirg6Hx.TnAjtc1jCkue', 'members', 0, 'default.png', NULL, 'Welcome to my profile!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `watchlists`
--

CREATE TABLE `watchlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `watchlist` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `years_items`
--

CREATE TABLE `years_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` bigint(20) UNSIGNED NOT NULL,
  `years_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `actors_items`
--
ALTER TABLE `actors_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actors_items_items_id_foreign` (`items_id`),
  ADD KEY `actors_items_actors_id_foreign` (`actors_id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries_items`
--
ALTER TABLE `countries_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_items_items_id_foreign` (`items_id`),
  ADD KEY `countries_items_countries_id_foreign` (`countries_id`);

--
-- Indexes for table `creators`
--
ALTER TABLE `creators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creators_items`
--
ALTER TABLE `creators_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creators_items_items_id_foreign` (`items_id`),
  ADD KEY `creators_items_creators_id_foreign` (`creators_id`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `directors_items`
--
ALTER TABLE `directors_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `directors_items_items_id_foreign` (`items_id`),
  ADD KEY `directors_items_directors_id_foreign` (`directors_id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episodes_series_id_foreign` (`series_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres_items`
--
ALTER TABLE `genres_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genres_items_items_id_foreign` (`items_id`),
  ADD KEY `genres_items_genres_id_foreign` (`genres_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords_items`
--
ALTER TABLE `keywords_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keywords_items_items_id_foreign` (`items_id`),
  ADD KEY `keywords_items_keywords_id_foreign` (`keywords_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `qualities`
--
ALTER TABLE `qualities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualities_items`
--
ALTER TABLE `qualities_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qualities_items_items_id_foreign` (`items_id`),
  ADD KEY `qualities_items_qualities_id_foreign` (`qualities_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `watchlists`
--
ALTER TABLE `watchlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `years_items`
--
ALTER TABLE `years_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `years_items_items_id_foreign` (`items_id`),
  ADD KEY `years_items_years_id_foreign` (`years_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `actors_items`
--
ALTER TABLE `actors_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `countries_items`
--
ALTER TABLE `countries_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `creators`
--
ALTER TABLE `creators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `creators_items`
--
ALTER TABLE `creators_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `directors_items`
--
ALTER TABLE `directors_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10771;

--
-- AUTO_INCREMENT for table `genres_items`
--
ALTER TABLE `genres_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keywords_items`
--
ALTER TABLE `keywords_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `qualities`
--
ALTER TABLE `qualities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qualities_items`
--
ALTER TABLE `qualities_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `watchlists`
--
ALTER TABLE `watchlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `years_items`
--
ALTER TABLE `years_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actors_items`
--
ALTER TABLE `actors_items`
  ADD CONSTRAINT `actors_items_actors_id_foreign` FOREIGN KEY (`actors_id`) REFERENCES `actors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actors_items_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `countries_items`
--
ALTER TABLE `countries_items`
  ADD CONSTRAINT `countries_items_countries_id_foreign` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `countries_items_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `creators_items`
--
ALTER TABLE `creators_items`
  ADD CONSTRAINT `creators_items_creators_id_foreign` FOREIGN KEY (`creators_id`) REFERENCES `creators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `creators_items_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `directors_items`
--
ALTER TABLE `directors_items`
  ADD CONSTRAINT `directors_items_directors_id_foreign` FOREIGN KEY (`directors_id`) REFERENCES `directors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `directors_items_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_series_id_foreign` FOREIGN KEY (`series_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `genres_items`
--
ALTER TABLE `genres_items`
  ADD CONSTRAINT `genres_items_genres_id_foreign` FOREIGN KEY (`genres_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genres_items_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keywords_items`
--
ALTER TABLE `keywords_items`
  ADD CONSTRAINT `keywords_items_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keywords_items_keywords_id_foreign` FOREIGN KEY (`keywords_id`) REFERENCES `keywords` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qualities_items`
--
ALTER TABLE `qualities_items`
  ADD CONSTRAINT `qualities_items_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qualities_items_qualities_id_foreign` FOREIGN KEY (`qualities_id`) REFERENCES `qualities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `years_items`
--
ALTER TABLE `years_items`
  ADD CONSTRAINT `years_items_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `years_items_years_id_foreign` FOREIGN KEY (`years_id`) REFERENCES `years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
