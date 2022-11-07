-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2022 at 05:16 AM
-- Server version: 5.7.40
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newtests_aygaz`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_service_provider`
--

CREATE TABLE `assign_service_provider` (
  `id` bigint(20) NOT NULL,
  `request_id` bigint(20) DEFAULT NULL,
  `service_provider_id` varchar(255) DEFAULT NULL,
  `status` enum('0','1','3') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_service_provider`
--

INSERT INTO `assign_service_provider` (`id`, `request_id`, `service_provider_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 9, '4', '1', '2022-04-08 16:38:31', '2022-04-11 10:33:33'),
(2, 9, '5', '1', '2022-04-08 16:38:46', '2022-04-11 10:33:33'),
(3, 1, '5', '1', '2022-04-08 19:55:36', '2022-04-08 19:55:36'),
(4, 9, '6', '1', '2022-04-11 10:33:34', '2022-04-11 10:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `parent_id` int(200) DEFAULT NULL,
  `category_id` int(200) DEFAULT NULL,
  `lang_code` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1','3') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `parent_id`, `category_id`, `lang_code`, `title`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1664139936, 3, 'en', 'Test', '<p>Testing</p>', 'nmElgMBR65tU13T59Sa4.png', NULL, '2022-10-07 10:52:15', '2022-10-15 03:26:51'),
(2, 1664139936, 3, 'bn', 'Testbn', '<p>Testingbn</p>', 'nmElgMBR65tU13T59Sa4.png', NULL, '2022-10-07 10:52:15', '2022-10-15 03:26:51'),
(3, 1664144233, 1, 'en', 'TESTING...', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'amS6M4WIzeQZ32rA6Bkd.png', NULL, '2022-10-07 12:03:52', '2022-10-15 03:27:24'),
(4, 1664144233, 1, 'bn', 'TESTING...bn', '<p><strong>Lorem Ipsum</strong> is simply dummy text of bn</p>', 'amS6M4WIzeQZ32rA6Bkd.png', NULL, '2022-10-07 12:03:52', '2022-10-15 03:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `image` varchar(100) DEFAULT NULL,
  `status` enum('0','1','3') DEFAULT NULL COMMENT '''0''=>Inactive,''1''=Active,''3''=>''Delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'uJ686AqsdVY3.jpg', '1', '2022-03-09 08:13:50', NULL),
(2, 0, 'r03lHCZFEJc1.jpg', '1', '2022-03-09 08:38:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories_translation`
--

CREATE TABLE `categories_translation` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `language_code` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `status` enum('0','1','2','3') DEFAULT NULL COMMENT '"0"=>Inactive, "1"=> active, "2"=>suspended, "3"=>deleted',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories_translation`
--

INSERT INTO `categories_translation` (`id`, `category_id`, `language_code`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'test', '1', '2022-03-09 02:43:50', '2022-03-09 03:32:10'),
(2, 1, 'da', 'prøve', '1', '2022-03-09 02:43:50', '2022-03-09 03:32:10'),
(3, 2, 'en', 'main', '1', '2022-03-09 03:08:27', '2022-03-09 03:08:27'),
(4, 2, 'da', 'vigtigste', '1', '2022-03-09 03:08:27', '2022-03-09 03:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) NOT NULL,
  `type` enum('1','2','3') CHARACTER SET utf8 DEFAULT NULL COMMENT '1=>Text, 2=>Image, 3=>Video',
  `slug` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `page_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `content_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `content_body` longtext CHARACTER SET utf8,
  `instruction` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `type`, `slug`, `page_name`, `content_name`, `content_body`, `instruction`, `status`, `created_at`, `updated_at`) VALUES
(2, NULL, 'about_us', 'about us', 'about us page ', 'this is text and dummy data in about us page this is text and dummy data in about us page this is text and dummy data in about us pagethis is text and dummy data in about us page this is text and dummy data in about us page this is text and dummy data in about us page', NULL, 1, '2022-06-25 16:24:17', '2022-06-25 16:24:17'),
(3, NULL, 'contact_us', 'contact us', 'Contact Us Page', 'contact us page this is text and dummy data in about us page this is text and dummy data in about us page this is text and dummy data in about us pagethis is text and dummy data in about us page this is text and dummy data in about us page this is text and dummy data in about us page', NULL, 1, '2022-06-25 16:25:07', '2022-06-25 16:25:07'),
(4, NULL, 'term & condition', 'term & condition ', 'term & condition ', 'term and condition page for dets  and demo de= test this is text and dummy data in about us page this is text and dummy data in about us page this is text and dummy data in about us pagethis is text and dummy data in about us page this is text and dummy data in about us page this is text and dummy data in about us page', NULL, 1, '2022-06-25 16:26:59', '2022-06-25 10:57:18'),
(5, NULL, 'privacy-policy', 'Privacy & policy', 'Privacy & policy', 'privacy and policy  page for testintg and demo  dat ddum  this is text and dummy data in about us page this is text and dummy data in about us page this is text and dummy data in about us pagethis is text and dummy data in about us page this is text and dummy data in about us page this is text and dummy data in about us page', NULL, 1, '2022-06-25 16:29:08', '2022-06-25 10:59:57'),
(6, NULL, 'faq', 'faq', 'what is faq  for that?', 'its  for  its for   its  for', NULL, 1, '2022-07-14 15:13:35', '2022-07-14 15:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `cms_translation`
--

CREATE TABLE `cms_translation` (
  `id` bigint(20) NOT NULL,
  `cms_id` int(11) DEFAULT NULL,
  `language_code` varchar(50) DEFAULT NULL,
  `type` enum('1','2','3') DEFAULT NULL COMMENT '1=>Text, 2=>Image, 3=>Video',
  `slug` varchar(100) DEFAULT NULL,
  `page_slug` varchar(100) DEFAULT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `content_name` varchar(100) DEFAULT NULL,
  `content_body` text,
  `instruction` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_translation`
--

INSERT INTO `cms_translation` (`id`, `cms_id`, `language_code`, `type`, `slug`, `page_slug`, `page_name`, `content_name`, `content_body`, `instruction`, `created_at`, `updated_at`) VALUES
(27, 14, 'en', '1', 'index_page_about_us', 'index_page', 'Index Page', 'About Us', '<p>United Aygaz LPG is on a mission of integrating quality and safety to responsibly provide efficient energy solutions in Bangladesh. Our inception began as a joint venture between the reputed Turkish LPG company Aygaz and the established United group. We are dedicated to empowering you with the energy to live your best every day by providing solutions that make your life easier. Join us as we revolutionize the LPG sector in the nation with the promise of unmatched quality.</p>', NULL, '2022-03-26 22:04:15', '2022-10-15 04:21:51'),
(28, 14, 'bn', '1', 'index_page_about_us', 'index_page', 'Index Page', 'About Us', '<p>Bn United Aygaz LPG is on a mission of integrating quality and safety to responsibly provide efficient energy solutions in Bangladesh. Our inception began as a joint venture between the reputed Turkish LPG company Aygaz and the established United group. We are dedicated to empowering you with the energy to live your best every day by providing solutions that make your life easier. Join us as we revolutionize the LPG sector in the nation with the promise of unmatched quality.</p>', NULL, '2022-03-26 22:04:15', '2022-10-15 04:21:51'),
(29, 15, 'en', '2', 'index_page_about_us', 'index_page', 'Index Page', 'About Us page Image', 'Mzqr1s65ZRT71jiXh5Ow.jpg', NULL, '2022-03-26 22:04:15', '2022-10-12 07:28:40'),
(31, 16, 'en', '1', 'about_us', 'about_page', 'About Page', 'Our Journey', '<p>United Aygaz LPG Ltd. was established in 2021 as a joint venture between the renowned Turkish LPG company Aygaz and the reputed United Group.</p><p>United Group is one of the largest socio-economic infrastructure-based business conglomerates with a diverse investment portfolio spanning across multiple sectors.</p><p>The journey began in 1978 as a shared vision by close friends to establish a lasting legacy. Today, United Group stands as one of the largest socio-economic infrastructure-based business conglomerates. &nbsp;</p><p>Aygaz is also the first and only public LPG company in Turkey and currently provides its services in 81 cities with almost 2,259 cylinder gas dealers and 1,789 autogas stations.<br>As the most preferred LPG brand in Turkey, Aygaz products enter more than 40 thousand homes every day, and approximately 200 thousand vehicles run on Aygaz Otogaz+.</p><p>Aygaz is the first energy company of Koç Holding, a leading investment holding company and largest industrial conglomerate in Turkey. From a global perspective, Koç Holding is the only Turkish company listed among the 500 Largest companies.</p><p>Koç Group of Companies contributing to the growth of the Turkish economy since its foundation and responsible for 7% of the export activities of Turkey, now are listed among the greatest industrial companies of Turkey.</p><p>United Aygaz LPG Ltd. Is a strong alliance between two giant companies of Bangladesh and Turkey. Together, it dreams of becoming a remarkable solution for the LPG industry in Bangladesh. The goal is to import, store, bottle, distribute, and market LPG in Bangladesh under the brand name Aygaz United.</p>', NULL, '2022-03-26 22:04:15', '2022-10-24 13:15:43'),
(159, 16, 'bn', '1', 'about_us', 'about_page', 'About Page', 'Our Journey', '<p>The United Aygaz journey began in January of 2021 as a joint venture established between Turkey’s leading LPG company, Aygaz, and Bangladesh’s reputed conglomerate, United Group. Starting LPG sourcing, filling, and distribution in Bangladesh was the first step for Aygaz to initiate an international expansion strategy. Combined with over 60 long years of industry experience and dedication to quality, we have jointly embarked upon the journey to bring safe and high-quality services to households, HORECA, automobile and other industries throughout the country.</p>', NULL, '2022-03-26 22:04:15', '2022-10-24 13:15:43'),
(160, 17, 'en', '1', 'about_us', 'about_page', 'About Page', 'Mission', 'To become the game-changer in the LPG industry by offering the best innovative energy solutions for Bangladesh, integrating quality and safety standards, and always acting responsibly with regard to society and the environment', NULL, '2022-03-26 22:04:15', '2022-04-06 18:50:42'),
(161, 17, 'bn', '1', 'about_us', 'about_page', 'About Page', 'Mission', 'To become the game-changer in the LPG industry by offering the best innovative energy solutions for Bangladesh, integrating quality and safety standards, and always acting responsibly with regard to society and the environment', NULL, '2022-03-26 22:04:15', '2022-04-06 18:50:42'),
(162, 18, 'en', '2', 'about_us', 'about_page', 'About Page', 'Mission Image', 'CsEg0YMWVv4zU0FiQkd6.jpg', NULL, '2022-03-26 22:04:15', '2022-09-25 07:36:06'),
(163, 19, 'en', '1', 'about_us', 'about_page', 'About Page', 'Vision', 'To become the leader in the LPG sector by enriching lives with the safest, cleanest, and most responsible ways of moving the people and the country forward.', NULL, '2022-03-26 22:04:15', '2022-04-06 18:50:42'),
(164, 19, 'bn', '1', 'about_us', 'about_page', 'About Page', 'Vision', 'To become the leader in the LPG sector by enriching lives with the safest, cleanest, and most responsible ways of moving the people and the country forward.', NULL, '2022-03-26 22:04:15', '2022-04-06 18:50:42'),
(165, 20, 'en', '2', 'about_us', 'about_page', 'About Page', 'Vision Image', 'nsFN6l8Rpfv27dByk1ZH.jpg', NULL, '2022-03-26 22:04:15', '2022-09-25 07:48:32'),
(166, 21, 'en', '1', 'about_cylinder_gas', 'about_cylinder_gas', 'cylindergas', 'Safe & Reliable Energy Everyday', '<p>While living on the cutting-edge and becoming growingly dependent on energy, reliable supply is all-important. As the leading LPG solutions provider, our goal is to delight your satisfaction by providing sterling products and services, and providing safe, sustainable, and ingenious LPG solutions.</p>', NULL, '2022-03-26 22:04:15', '2022-09-29 10:48:58'),
(167, 21, 'bn', '1', 'about_cylinder_gas', 'about_cylinder_gas', 'cylindergas', 'Safe & Reliable Energy Everyday', '<p>Colloquially known as “cylinder gas”, LPG (liquefied petroleum gas) is a mixture of butane and propane gases obtained during the distillation and cracking of crude oil or from natural gas deposits and liquefied under pressure. LPG is a colourless and odourless gas. However, a special odour is intentionally added so that a potential leak can be detected easily. Cylinder Gas is usually used for cooking, heating and lightning.</p>', NULL, '2022-03-26 22:04:15', '2022-09-29 10:48:58'),
(168, 22, 'en', '2', 'about_cylinder_gas', 'about_cylinder_gas', 'cylindergas', 'about cylinder gas Image', 'ge6zCn1y32ipLU8duRF9.jpg', NULL, '2022-03-26 22:04:15', '2022-09-27 07:30:45'),
(169, 23, 'en', '2', 'header_logo', 'header', 'header', 'Header Logo', 'p8eDqWV5g6aYk0Ku7t6h.png', NULL, '2022-03-26 22:04:15', '2022-09-25 06:19:36'),
(170, 24, 'en', '2', 'footer_logo', 'footer', 'footer', 'footer Logo', '1mfvRHPbiWcQZjTG8g4s.svg', NULL, '2022-03-26 22:04:15', '2022-09-26 08:56:54'),
(171, 25, 'en', '1', 'footer', 'footer', 'footer', 'Corporate Office', 'United House, Madani Avenue, United City, Dhaka-1212. Bangladesh', NULL, '2022-03-26 22:04:15', '2022-04-06 18:50:42'),
(172, 25, 'bn', '1', 'footer', 'footer', 'footer', 'Corporate Office', 'United House, Madani Avenue, United City, Dhaka-1212. Bangladesh', NULL, '2022-03-26 22:04:15', '2022-04-06 18:50:42'),
(173, 26, 'en', '1', 'footer', 'footer', 'footer', 'Facility Location', 'Rangadia, Karnaphuli, Anwara, Chittagong, Bangladesh', NULL, '2022-03-26 22:04:15', '2022-04-06 18:50:42'),
(174, 26, 'bn', '1', 'footer', 'footer', 'footer', 'Facility Location', 'Rangadia, Karnaphuli, Anwara, Chittagong, Bangladesh', NULL, '2022-03-26 22:04:15', '2022-04-06 18:50:42'),
(175, 27, 'bn', '1', 'footer', 'footer', 'footer', '09 612 090909', '<p>Our team is available 24/7. Get in touch today to learn more about our company and products.</p>', NULL, '2022-03-26 22:04:15', '2022-09-24 12:05:41'),
(176, 27, 'en', '1', 'footer', 'footer', 'footer', '09 612 090909', '<p>09 612 090909 Our team is available 24/7. Get in touch today to learn more about our company and products.</p>', NULL, '2022-03-26 22:04:15', '2022-09-24 12:05:41'),
(177, 28, 'en', '2', 'loader_logo', 'loader', 'loder', 'Loder Logo', 'up1xKqDZYwaW8lEFOsoR.jpg', NULL, '2022-03-26 22:04:15', '2022-10-16 10:21:50'),
(178, 29, 'en', '1', 'loader_title', 'loader', 'loader', 'loader title', '<p>Welcome to</p>', NULL, '2022-03-26 22:04:15', '2022-09-28 10:05:24'),
(179, 29, 'bn', '1', 'loader_title', 'loader', 'loader', 'loader title', '<p>Welcome to.</p>', NULL, '2022-03-26 22:04:15', '2022-09-28 10:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `cms_translation_bk`
--

CREATE TABLE `cms_translation_bk` (
  `id` bigint(20) NOT NULL,
  `cms_id` int(11) DEFAULT NULL,
  `language_code` varchar(50) DEFAULT NULL,
  `type` enum('1','2','3') DEFAULT NULL COMMENT '1=>Text, 2=>Image, 3=>Video',
  `slug` varchar(100) DEFAULT NULL,
  `page_slug` varchar(100) DEFAULT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `content_name` varchar(100) DEFAULT NULL,
  `content_body` text,
  `instruction` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_translation_bk`
--

INSERT INTO `cms_translation_bk` (`id`, `cms_id`, `language_code`, `type`, `slug`, `page_slug`, `page_name`, `content_name`, `content_body`, `instruction`, `created_at`, `updated_at`) VALUES
(1, 2, 'da', '1', 'index_page_banner_description', 'index_page', 'Index Page', 'Index page banner description', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing&nbsp;<br>elit. Cras viverra eros quam.</p>', NULL, '2022-03-26 22:04:15', '2022-03-28 07:45:01'),
(2, 3, 'en', '1', 'about_us', 'cms_page', 'About Us', 'About us content', '<h2>what is lorem ipsum? fg gt</h2><p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus commodi quidem architecto, optio voluptates similique suscipit sapiente expedita odit iste quis sint vero sequi, iusto veniam repellat iure mollitia quia? Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates laborum debitis totam sequi assumenda officia aliquam consequuntur placeat? Dicta ipsam odio dolore doloribus laborum incidunt at ad consequatur quaerat architecto?</p>', NULL, '2022-03-26 22:04:15', '2022-03-28 08:43:15'),
(5, 3, 'da', '1', 'about_us', 'cms_page', 'About Us', 'About us content', '<h2>what is lorem ipsum?</h2><p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus commodi quidem architecto, optio voluptates similique suscipit sapiente expedita odit iste quis sint vero sequi, iusto veniam repellat iure mollitia quia? Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates laborum debitis totam sequi assumenda officia aliquam consequuntur placeat? Dicta ipsam odio dolore doloribus laborum incidunt at ad consequatur quaerat architecto?</p>', NULL, '2022-03-26 22:04:15', '2022-03-28 08:43:15'),
(6, 4, 'en', '1', 'privacy_policy', 'cms_page', 'Privacy Policy', 'Privacy Policy content', '<h2>what is lorem ipsum?</h2><p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus commodi quidem architecto, optio voluptates similique suscipit sapiente expedita odit iste quis sint vero sequi, iusto veniam repellat iure mollitia quia? Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates laborum debitis totam sequi assumenda officia aliquam consequuntur placeat? Dicta ipsam odio dolore doloribus laborum incidunt at ad consequatur quaerat architecto?</p>', NULL, '2022-03-26 22:04:15', '2022-03-28 09:09:46'),
(7, 4, 'da', '1', 'privacy_policy', 'cms_page', 'Privacy Policy', 'Privacy Policy content', '<h2>what is lorem ipsum?</h2><p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus commodi quidem architecto, optio voluptates similique suscipit sapiente expedita odit iste quis sint vero sequi, iusto veniam repellat iure mollitia quia? Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates laborum debitis totam sequi assumenda officia aliquam consequuntur placeat? Dicta ipsam odio dolore doloribus laborum incidunt at ad consequatur quaerat architecto?</p>', NULL, '2022-03-26 22:04:15', '2022-03-28 09:09:46'),
(8, 5, 'en', '1', 'terms_condition', 'cms_page', 'Terms & condition', 'Terms & condition content', '<h2>what is lorem ipsum?</h2><p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus commodi quidem architecto, optio voluptates similique suscipit sapiente expedita odit iste quis sint vero sequi, iusto veniam repellat iure mollitia quia? Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates laborum debitis totam sequi assumenda officia aliquam consequuntur placeat? Dicta ipsam odio dolore doloribus laborum incidunt at ad consequatur quaerat architecto?</p>', NULL, '2022-03-26 22:04:15', '2022-03-28 09:09:46'),
(9, 5, 'da', '1', 'terms_condition', 'cms_page', 'Terms & condition', 'Terms & condition content', '<h2>what is lorem ipsum?</h2><p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus commodi quidem architecto, optio voluptates similique suscipit sapiente expedita odit iste quis sint vero sequi, iusto veniam repellat iure mollitia quia? Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates laborum debitis totam sequi assumenda officia aliquam consequuntur placeat? Dicta ipsam odio dolore doloribus laborum incidunt at ad consequatur quaerat architecto?</p>', NULL, '2022-03-26 22:04:15', '2022-03-28 09:09:46'),
(10, 6, 'da', '2', 'index_page_second_content_image', 'index_page', 'Index Page', 'Index page second content image', '<p>We connect you with&nbsp;<br>problem solvers and&nbsp;<br>fixers.</p>', NULL, '2022-03-26 22:04:15', '2022-03-28 07:01:01'),
(11, 6, 'en', '2', 'index_page_second_content_image', 'index_page', 'Index Page', 'Index page second content image', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing&nbsp;<br>elit. Cras viverra eros quam.</p>', NULL, '2022-03-26 22:04:15', '2022-03-28 07:45:01'),
(12, 6, 'da', '2', 'index_page_second_content_image', 'index_page', 'Index Page', 'Index page second content image', '<p>We connect you with&nbsp;<br>problem solvers and&nbsp;<br>fixers.</p>', NULL, '2022-03-26 22:04:15', '2022-03-28 07:01:01'),
(13, 6, 'en', '2', 'index_page_second_content_image', 'index_page', 'Index Page', 'Index page second content image', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing&nbsp;<br>elit. Cras viverra eros quam.</p>', NULL, '2022-03-26 22:04:15', '2022-03-28 07:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `cms_translation_multi`
--

CREATE TABLE `cms_translation_multi` (
  `id` bigint(20) NOT NULL,
  `cms_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `language_code` varchar(50) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `page_slug` varchar(100) DEFAULT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `link` varchar(200) DEFAULT NULL,
  `status` enum('0','1','3') NOT NULL DEFAULT '1' COMMENT '0=>deactive, 1=>active, 3=>delted',
  `image` varchar(200) DEFAULT NULL,
  `bg_color` varchar(100) DEFAULT NULL,
  `instruction` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_translation_multi`
--

INSERT INTO `cms_translation_multi` (`id`, `cms_id`, `parent_id`, `language_code`, `slug`, `page_slug`, `page_name`, `title`, `description`, `link`, `status`, `image`, `bg_color`, `instruction`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'banner', 'index', 'index_page', 'Banner Titile', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL),
(24, 1, NULL, '', 'galley', 'index', 'index_page', 'galley Images', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL),
(25, 1, NULL, '', 'Our_Values', 'about_us', 'about Us', 'Our Values', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL),
(27, NULL, 24, 'bn', NULL, 'index', 'index_page', NULL, NULL, NULL, '1', 'G9Ww328UKITEDrMfCq65.png', NULL, NULL, NULL, '2022-09-21 14:04:33'),
(29, NULL, 24, 'bn', NULL, 'index', 'index_page', NULL, NULL, NULL, '1', 'Hw3fZzxc39teyCaung6j.jpg', NULL, NULL, NULL, '2022-09-21 14:05:08'),
(31, NULL, 24, 'bn', NULL, 'index', 'index_page', NULL, NULL, NULL, '1', 's6C6HEd6qx12LXSF7KAy.jpg', NULL, NULL, NULL, '2022-09-21 14:05:29'),
(32, 1, NULL, '', 'slider', 'about_us', 'index', 'index Slider', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL),
(33, 1662831539, 1, 'en', NULL, 'index', NULL, NULL, NULL, 'test', '1', '3g716Dp0cAXFvTq7jO9m.jpg', '#000000', NULL, '2022-09-22 07:25:38', '2022-10-28 17:33:50'),
(34, 1662831539, 1, 'bn', NULL, 'index', NULL, NULL, '<p>Testing</p>', 'test', '1', '3g716Dp0cAXFvTq7jO9m.jpg', '#000000', NULL, '2022-09-22 07:25:38', '2022-10-28 17:33:50'),
(35, 1662831648, 25, 'en', NULL, 'about_us', NULL, 'OUR EXPERIENCE AND EXPERTISE', '<p>With over 60 years of experience and expertise, we aim to be the best energy solutions provider in the country by providing solutions of superior quality and safety.</p>', 'Testing2', '1', 'h6MCN9k564sZTQBYd48c.jpg', '#000000', NULL, '2022-09-22 07:27:27', '2022-09-25 08:35:58'),
(36, 1662831648, 25, 'bn', NULL, 'about_us', NULL, 'Testing', '<p>Testing</p>', 'Testing2', '1', 'h6MCN9k564sZTQBYd48c.jpg', '#000000', NULL, '2022-09-22 07:27:27', '2022-09-25 08:35:58'),
(37, 1662831728, 32, 'en', NULL, 'about_us', NULL, 'We Simplify Your Life', '<p>We plan, design, manufacture, and install everything according to your requirements, making the entire process hassle-free for you. Carry out your day-to-day activities with ease and convenience while we handle the rest!</p>', '#', '1', 'Z1QyBsKOaSf0835AC0Mi.jpg', '#f47920', NULL, '2022-09-22 07:28:47', '2022-09-25 06:49:48'),
(38, 1662831728, 32, 'bn', NULL, 'about_us', NULL, 'This is Slider', '<p>This is Slider</p>', '#', '1', 'Z1QyBsKOaSf0835AC0Mi.jpg', '#f47920', NULL, '2022-09-22 07:28:47', '2022-09-25 06:49:48'),
(39, 1662832504, 24, 'en', NULL, 'index', NULL, 'Gallery', NULL, 'test', '1', 'ZE0QY94hfrd1NDgyqaLc.jpg', '#000000', NULL, '2022-09-22 07:41:43', '2022-10-12 07:37:27'),
(40, 1662832504, 24, 'bn', NULL, 'index', NULL, NULL, NULL, 'test', '1', 'ZE0QY94hfrd1NDgyqaLc.jpg', '#000000', NULL, '2022-09-22 07:41:43', '2022-10-12 07:37:27'),
(41, 1662832534, 24, 'en', NULL, 'index', NULL, 'Gallary', NULL, 'test', '1', 'xe9obWTj5ZIFtgV5AfKS.png', '#000000', NULL, '2022-09-22 07:42:13', '2022-10-12 07:39:18'),
(42, 1662832534, 24, 'bn', NULL, 'index', NULL, NULL, NULL, 'test', '1', 'xe9obWTj5ZIFtgV5AfKS.png', '#000000', NULL, '2022-09-22 07:42:13', '2022-10-12 07:39:18'),
(43, NULL, NULL, NULL, 'FAQ', 'faq_page', 'faq_page', 'Genral FAQ', NULL, NULL, '1', NULL, NULL, NULL, '2022-09-22 09:51:54', '2022-09-22 09:51:54'),
(44, 1662850767, 43, 'en', NULL, 'faq_page', NULL, 'What is LPG?', '<p>LPG – liquefied petroleum gas or liquid petroleum gas – (LP gas), the constituents of which are propane and butane, are flammable hydrocarbon fuel gases used for LPG heating, cooking and vehicles. LPG is a portable, clean and efficient energy source which is readily available to consumers around the world. LPG is primarily obtained from natural gas and oil production but is also produced increasingly from renewable sources. Its unique properties make it a versatile energy source which can be used in more than 1,000 different applications.</p>', NULL, '1', NULL, '#098e90', NULL, '2022-09-22 12:46:06', '2022-09-28 09:49:02'),
(45, 1662850767, 43, 'bn', NULL, 'faq_page', NULL, NULL, NULL, NULL, '1', NULL, '#098e90', NULL, '2022-09-22 12:46:06', '2022-09-28 09:49:02'),
(46, 1662851041, 43, 'en', NULL, 'faq_page', NULL, 'Where Does LPG Come from?', '<p>LPG comes from drilling oil and gas wells. It is a fossil fuel that does not occur in isolation.&nbsp;LPG products are found naturally&nbsp;in combination with other hydrocarbon fuels, typically crude oil and natural gas. LPG is produced during natural gas processing and oil refining.</p>', NULL, '1', NULL, '#000000', NULL, '2022-09-22 12:50:40', '2022-09-28 09:50:09'),
(47, 1662851041, 43, 'bn', NULL, 'faq_page', NULL, NULL, NULL, NULL, '1', NULL, '#000000', NULL, '2022-09-22 12:50:40', '2022-09-28 09:50:09'),
(48, 1662851956, 1, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'PvwL5kyMtziGlbJgc6Ba.jpg', '#000000', NULL, '2022-09-22 13:05:55', '2022-10-11 13:31:22'),
(49, 1662851956, 1, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'PvwL5kyMtziGlbJgc6Ba.jpg', '#000000', NULL, '2022-09-22 13:05:55', '2022-10-11 13:31:22'),
(50, 1662851970, 1, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'icmaPxGFCuThKU0dQ0NZ.jpg', '#000000', NULL, '2022-09-22 13:06:09', '2022-10-12 07:34:51'),
(51, 1662851970, 1, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'icmaPxGFCuThKU0dQ0NZ.jpg', '#000000', NULL, '2022-09-22 13:06:09', '2022-10-12 07:34:51'),
(52, 1662852352, 32, 'en', NULL, 'about_us', NULL, 'We Put Your Safety First', '<p>Combining the expertise of the reputed Aygaz, we follow several stages of inspection to ensure safety that matches global standards. As a result, we are able to guarantee your safety with every installation.</p>', NULL, '1', 'tEQug6NaVcy80fRP36z4.jpg', '#0493f4', NULL, '2022-09-22 13:12:31', '2022-09-25 06:50:06'),
(53, 1662852352, 32, 'bn', NULL, 'about_us', NULL, NULL, NULL, NULL, '1', 'tEQug6NaVcy80fRP36z4.jpg', '#0493f4', NULL, '2022-09-22 13:12:31', '2022-09-25 06:50:06'),
(54, 1662852585, 32, 'en', NULL, 'about_us', NULL, 'We Provide Unmatched Quality!', '<p>Starting from top-notch quality to dedicated after-sales service, we provide the whole package! You can rely on us to provide guaranteed customer satisfaction while ensuring the highest capacity available in the industry.</p>', NULL, '1', 'GMVob5Zdq98unmDLC646.png', '#5e5eff', NULL, '2022-09-22 13:16:24', '2022-09-25 06:49:36'),
(55, 1662852585, 32, 'bn', NULL, 'about_us', NULL, NULL, NULL, NULL, '1', 'GMVob5Zdq98unmDLC646.png', '#5e5eff', NULL, '2022-09-22 13:16:24', '2022-09-25 06:49:36'),
(56, 1662852666, 32, 'en', NULL, 'about_us', NULL, 'We Care About Impact', '<p>Taking the initiative to be socially and environmentally responsible is something we practice at the core of our business. We closely monitor our impact on people and that planet, ensuring a sustainable tomorrow.</p>', NULL, '1', 'sAgt8310a6BLb4jzmV3J.jpg', '#059e42', NULL, '2022-09-22 13:17:45', '2022-09-25 06:43:53'),
(57, 1662852666, 32, 'bn', NULL, 'about_us', NULL, NULL, NULL, NULL, '1', 'sAgt8310a6BLb4jzmV3J.jpg', '#059e42', NULL, '2022-09-22 13:17:45', '2022-09-25 06:43:53'),
(58, 1662853053, 24, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'y0dC3aMIGxvm9Tb5Nf46.png', '#000000', NULL, '2022-09-22 13:24:12', '2022-10-12 07:41:04'),
(59, 1662853053, 24, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'y0dC3aMIGxvm9Tb5Nf46.png', '#000000', NULL, '2022-09-22 13:24:12', '2022-10-12 07:41:04'),
(60, 1662853075, 24, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'jf6ZRLF9TpNy4Vbl2dc8.jpg', '#000000', NULL, '2022-09-22 13:24:34', '2022-10-12 07:42:36'),
(61, 1662853075, 24, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'jf6ZRLF9TpNy4Vbl2dc8.jpg', '#000000', NULL, '2022-09-22 13:24:34', '2022-10-12 07:42:36'),
(62, 1662853104, 24, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', '9ZUmaDMWu1565C1FNG0t.jpg', '#000000', NULL, '2022-09-22 13:25:03', '2022-10-12 07:44:05'),
(63, 1662853104, 24, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', '9ZUmaDMWu1565C1FNG0t.jpg', '#000000', NULL, '2022-09-22 13:25:03', '2022-10-12 07:44:05'),
(64, 1662853114, 24, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'cW78bCI20Y6yigtS64MT.jpg', '#000000', NULL, '2022-09-22 13:25:13', '2022-09-27 09:22:16'),
(65, 1662853114, 24, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'cW78bCI20Y6yigtS64MT.jpg', '#000000', NULL, '2022-09-22 13:25:13', '2022-09-27 09:22:16'),
(66, 1662853127, 24, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'DcC5L1qudg78X4vm2V6M.jpg', '#000000', NULL, '2022-09-22 13:25:26', '2022-09-27 09:44:49'),
(67, 1662853127, 24, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'DcC5L1qudg78X4vm2V6M.jpg', '#000000', NULL, '2022-09-22 13:25:26', '2022-09-27 09:44:49'),
(68, 1662853138, 24, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'efUVzkr016K4Z1u5IJSP.jpg', '#000000', NULL, '2022-09-22 13:25:37', '2022-10-12 07:48:30'),
(69, 1662853138, 24, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'efUVzkr016K4Z1u5IJSP.jpg', '#000000', NULL, '2022-09-22 13:25:37', '2022-10-12 07:48:30'),
(70, 1662853150, 24, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'GxCqK9iNBLD267T84nRP.jpg', '#000000', NULL, '2022-09-22 13:25:49', '2022-09-27 09:04:43'),
(71, 1662853150, 24, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'GxCqK9iNBLD267T84nRP.jpg', '#000000', NULL, '2022-09-22 13:25:49', '2022-09-27 09:04:43'),
(72, 1662853167, 24, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'or68zSCqHmM3hA4FeDEx.jpg', '#000000', NULL, '2022-09-22 13:26:06', '2022-09-27 09:43:28'),
(73, 1662853167, 24, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'or68zSCqHmM3hA4FeDEx.jpg', '#000000', NULL, '2022-09-22 13:26:06', '2022-09-27 09:43:28'),
(74, 1662853178, 24, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'P36v6j8SLhs9NukHaDgf.jpg', NULL, NULL, '2022-09-22 13:26:17', '2022-09-22 13:26:17'),
(75, 1662853178, 24, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'P36v6j8SLhs9NukHaDgf.jpg', NULL, NULL, '2022-09-22 13:26:17', '2022-09-22 13:26:17'),
(76, 1662853189, 24, 'en', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'avnWRJ9GCeoBQg7X5T5N.jpg', '#000000', NULL, '2022-09-22 13:26:28', '2022-10-12 07:49:47'),
(77, 1662853189, 24, 'bn', NULL, 'index', NULL, NULL, NULL, NULL, '1', 'avnWRJ9GCeoBQg7X5T5N.jpg', '#000000', NULL, '2022-09-22 13:26:28', '2022-10-12 07:49:47'),
(78, NULL, NULL, NULL, 'about_cylinder_gas', 'cylindergas', 'cylindergas', 'Key Features and Benefits of\nAygaz United', NULL, NULL, '1', NULL, NULL, NULL, '2022-09-23 06:04:31', '2022-09-23 06:04:31'),
(79, 1662936100, 78, 'en', NULL, 'cylindergas', NULL, 'Ensuring Traceability & Quality with Unique Cylinder Tracking Code', '<p>We attach a unique tracking code with all of our cylinders, so that we can easily identify them and assure our customers that the cylinders have been filled at our facility and have gone through all the rigorous safety checkups.</p>', '0493F4', '1', 'u6K1VJPG1z6cphyZ2Wna.jpg', '#0493f4', NULL, '2022-09-23 12:28:19', '2022-09-27 08:41:02'),
(80, 1662936100, 78, 'bn', NULL, 'cylindergas', NULL, NULL, NULL, '0493F4', '1', 'u6K1VJPG1z6cphyZ2Wna.jpg', '#0493f4', NULL, '2022-09-23 12:28:19', '2022-09-27 08:41:02'),
(81, 1662936179, 78, 'en', NULL, 'cylindergas', NULL, 'Safeguarding Authenticity & Intactness by Thermosleeve with Hologram', '<p>We wrap our cylinders’ valves with thermosleeves that have distinguishable hologram seals. It assures you that the cylinder has been thoroughly inspected, passed the necessary safety tests, and you will be the first to use it.</p>', 'F47920', '1', 'in7435F9hWvGP2MQaAR4.jpg', '#f47320', NULL, '2022-09-23 12:29:38', '2022-09-27 08:11:17'),
(82, 1662936179, 78, 'bn', NULL, 'cylindergas', NULL, NULL, NULL, 'F47920', '1', 'in7435F9hWvGP2MQaAR4.jpg', '#f47320', NULL, '2022-09-23 12:29:38', '2022-09-27 08:11:18'),
(83, 1662936243, 78, 'en', NULL, 'cylindergas', NULL, 'Information Card for Safe Usage & Maintenance of the Cylinder', '<p>An information card is placed on the top of the cylinder under the valve and contains necessary safety instructions and tips so that our customers can easily operate and maintain the cylinders.</p>', '#059E42', '1', 'q6XpEOnKC1PTw8F6a60z.jpg', '#059e42', NULL, '2022-09-23 12:30:42', '2022-09-27 08:34:41'),
(84, 1662936243, 78, 'bn', NULL, 'cylindergas', NULL, NULL, NULL, '#059E42', '1', 'q6XpEOnKC1PTw8F6a60z.jpg', '#059e42', NULL, '2022-09-23 12:30:42', '2022-09-27 08:34:41'),
(85, 1663001947, 25, 'en', NULL, 'about_us', NULL, 'OUR PROMISE TO OUR CUSTOMERS', '<p>Our customers are the focus of everything we do. This is our promise to the people – to ensure energy solutions of the highest quality, efficiency, and safety, instead of time-consuming traditional fuels, so the people can live happy, productive, hassle-free lives.</p>', NULL, '1', '75eFLr04tamwjubcUsBz.jpg', '#e66465', NULL, '2022-09-24 06:45:46', '2022-09-25 08:45:41'),
(86, 1663001947, 25, 'bn', NULL, 'about_us', NULL, NULL, NULL, NULL, '1', '75eFLr04tamwjubcUsBz.jpg', '#e66465', NULL, '2022-09-24 06:45:46', '2022-09-25 08:45:41'),
(87, 1663001978, 25, 'en', NULL, 'about_us', NULL, 'OUR PEOPLE', '<p>Our most important assets are our employees. We are committed to providing our people with good working conditions and flexible employment possibilities that supports a better work-life balance, so they can grow and flourish to their utmost potential.</p>', NULL, '1', '6OmQsbM8pyVgUhDrnKtR.png', '#e66465', NULL, '2022-09-24 06:46:17', '2022-09-24 06:49:02'),
(88, 1663001978, 25, 'bn', NULL, 'about_us', NULL, NULL, NULL, NULL, '1', '6OmQsbM8pyVgUhDrnKtR.png', '#e66465', NULL, '2022-09-24 06:46:17', '2022-09-24 06:49:02'),
(89, 1663002002, 25, 'en', NULL, 'about_us', NULL, 'OUR INTEGRITY AND ETHICS', '<p>Our honesty, integrity, and superior business ethics are at the core of all our endeavors. We inspire our employees and our entire supply chain to take ownership of our product and service quality. Our customers trust in us for safe energy solutions because they know they can rely on us to be honest and ethical.</p>', NULL, '1', '90ZJy63x60IK1D2gi5EM.jpg', '#e66465', NULL, '2022-09-24 06:46:41', '2022-09-25 08:57:21'),
(90, 1663002002, 25, 'bn', NULL, 'about_us', NULL, NULL, NULL, NULL, '1', '90ZJy63x60IK1D2gi5EM.jpg', '#e66465', NULL, '2022-09-24 06:46:41', '2022-09-25 08:57:21'),
(91, 1663002030, 25, 'en', NULL, 'about_us', NULL, 'OUR ADAPTABILITY, AGILITY AND FLEXIBILITY', '<p>As the nation advances, the people will have new demands for new resources and solutions; and we anticipate and adapt to these changes by using our creativity to innovate new, digital solutions and streamline existing processes.</p>', NULL, '1', '08yW2TwglUSu9hLABNMi.jpg', '#e66465', NULL, '2022-09-24 06:47:09', '2022-09-25 09:20:14'),
(92, 1663002030, 25, 'bn', NULL, 'about_us', NULL, NULL, NULL, NULL, '1', '08yW2TwglUSu9hLABNMi.jpg', '#e66465', NULL, '2022-09-24 06:47:09', '2022-09-25 09:20:14'),
(93, 1663002287, 25, 'en', NULL, 'about_us', NULL, 'OUR COMMITMENT TO SAFETY AND THE ENVIRONMENT', '<p>We integrate international quality and safety standards in all our work with regards to our users, society, and the environment. We aim to lead the industry in health, safety, and environmental performance, by producing eco-friendly, clean fuel that causes minimal air pollution compared to alternatives.</p>', NULL, '1', 'D06J51vjrlxpHu6eNGIB.jpg', '#e66465', NULL, '2022-09-24 06:51:26', '2022-09-25 09:01:01'),
(94, 1663002287, 25, 'bn', NULL, 'about_us', NULL, NULL, NULL, NULL, '1', 'D06J51vjrlxpHu6eNGIB.jpg', '#e66465', NULL, '2022-09-24 06:51:26', '2022-09-25 09:01:02'),
(95, 1663007817, 43, 'en', NULL, 'faq_page', NULL, 'How LPG is Made?', '<p>LPG is made&nbsp;during natural gas processing and oil refining. LPG is separated from unprocessed natural gas using refrigeration. LPG is extracted from heated crude oil using a distillation tower. This LPG can be used as is or separated into LPG products three primary parts: propane, butane and isobutane. It is stored pressurized, as a liquid, in cylinders or tanks.</p>', NULL, '1', NULL, '#e66465', NULL, '2022-09-24 08:23:36', '2022-09-28 09:50:54'),
(96, 1663007817, 43, 'bn', NULL, 'faq_page', NULL, NULL, NULL, NULL, '1', NULL, '#e66465', NULL, '2022-09-24 08:23:36', '2022-09-28 09:50:54'),
(97, 1663007843, 43, 'en', NULL, 'faq_page', NULL, 'How is LPG Stored?', '<p>LPG is stored in pressure vessels. As such, it is almost always stored in its liquid form. These can range from small gas bottles to larger gas cylinders and much larger LPG tanks or bullets. LPG fuel storage depots may consist of very large storage spheres.</p>', NULL, '1', NULL, '#e66465', NULL, '2022-09-24 08:24:02', '2022-10-17 07:06:54'),
(98, 1663007843, 43, 'bn', NULL, 'faq_page', NULL, NULL, NULL, NULL, '1', NULL, '#e66465', NULL, '2022-09-24 08:24:02', '2022-10-17 07:06:54'),
(99, 1663007860, 43, 'en', NULL, 'faq_page', NULL, 'Is LPG Eco-Friendly?', '<p>LPG heating gas is an eco-friendly choice, as it is a low carbon, low sulphur fuel. LPG products result in lower CO2&nbsp;emissions than other energy sources, such as coal fired electricity.</p>', NULL, '1', NULL, '#e66465', NULL, '2022-09-24 08:24:19', '2022-09-28 09:51:30'),
(100, 1663007860, 43, 'bn', NULL, 'faq_page', NULL, NULL, NULL, NULL, '1', NULL, '#e66465', NULL, '2022-09-24 08:24:19', '2022-09-28 09:51:30'),
(101, NULL, NULL, NULL, 'home_manu', 'home', 'home', 'Home Manu', NULL, NULL, '1', NULL, NULL, NULL, '2022-09-28 06:27:59', '2022-09-28 06:27:59'),
(102, 1663347017, 101, 'en', NULL, 'home', NULL, 'Corporate', NULL, '/about', '1', '73yNvL418S59Z1xecMJC.png', '#e66465', NULL, '2022-09-28 06:36:56', '2022-10-15 03:51:32'),
(103, 1663347017, 101, 'bn', NULL, 'home', NULL, 'Corporate bn', NULL, '/about', '1', '73yNvL418S59Z1xecMJC.png', '#e66465', NULL, '2022-09-28 06:36:56', '2022-10-15 03:51:32'),
(104, 1663347185, 101, 'en', NULL, 'home', NULL, 'Cylinder Gas', NULL, '/cylindergas', '1', 'F3RxX3Pn1y4w167EecrH.png', '#e66465', NULL, '2022-09-28 06:39:44', '2022-09-30 08:49:31'),
(105, 1663347185, 101, 'bn', NULL, 'home', NULL, 'Cylinder Gas', NULL, '/cylindergas', '1', 'F3RxX3Pn1y4w167EecrH.png', '#e66465', NULL, '2022-09-28 06:39:44', '2022-09-30 08:49:31'),
(106, 1663348170, 101, 'en', NULL, 'home', NULL, 'Bulk Gas', NULL, '/bulkgas', '1', 'CxhF49z802sUfVebmrE9.png', '#e66465', NULL, '2022-09-28 06:56:09', '2022-10-26 05:49:16'),
(107, 1663348170, 101, 'bn', NULL, 'home', NULL, 'Bulk Gas', NULL, '/bulkgas', '1', 'CxhF49z802sUfVebmrE9.png', '#e66465', NULL, '2022-09-28 06:56:09', '2022-10-26 05:49:16'),
(108, 1663348265, 101, 'en', NULL, 'home', NULL, 'Auto Gas', NULL, '/autogas', '1', 'DEqkxKnt52wvRH3bz746.png', '#e66465', NULL, '2022-09-28 06:57:44', '2022-09-30 08:49:51'),
(109, 1663348265, 101, 'bn', NULL, 'home', NULL, 'Bulk Gas', NULL, '/autogas', '1', 'DEqkxKnt52wvRH3bz746.png', '#e66465', NULL, '2022-09-28 06:57:44', '2022-09-30 08:49:51'),
(110, NULL, NULL, NULL, 'cylindergas_sefety_points', 'cylindergas', 'cylindergas', 'Learn the 7-Point Safety Check', NULL, NULL, '1', NULL, NULL, NULL, '2022-09-28 09:15:25', '2022-09-28 09:15:25'),
(111, 1663356781, 110, 'en', NULL, 'cylindergas', NULL, 'Check the Environment', '<p>Our Maintenance team will visit the customers\' residences and check the kitchen environment properly. They will also ensure that the cylinders are ensuring cylinders are placed in a well-ventilated area and well distant from sources of ignition.</p>', NULL, '1', 'Z0Et6Knj3ep8T45whdmW.png', '#e66465', NULL, '2022-09-28 09:19:40', '2022-09-29 06:15:58'),
(112, 1663356781, 110, 'bn', NULL, 'cylindergas', NULL, 'Environment', '<p>We make sure your cylinders are in a well ventilated area, away from sources of ignition.</p>', NULL, '1', 'Z0Et6Knj3ep8T45whdmW.png', '#e66465', NULL, '2022-09-28 09:19:40', '2022-09-29 06:15:58'),
(113, 1663356809, 110, 'en', NULL, 'cylindergas', NULL, 'O-Ring Inspection', '<p>The valves contain an O-ring inside the valve mouth. The purpose of this O-ring is<strong> </strong>to seal the valve against the nozzle of the regulator connected to the valve for controlled gas withdrawal. We inspect the rubber O-ring inside the valve to ensure that it is free from scratches or cracks.</p>', NULL, '1', '760DNLS5l6jCgqH7M4Ao.png', '#e66465', NULL, '2022-09-28 09:20:08', '2022-10-03 05:55:07'),
(114, 1663356809, 110, 'bn', NULL, 'cylindergas', NULL, 'O-Ring', '<p>We make sure your cylinders are in a well ventilated area, away from sources of ignition.</p>', NULL, '1', '760DNLS5l6jCgqH7M4Ao.png', '#e66465', NULL, '2022-09-28 09:20:08', '2022-10-03 05:55:07'),
(115, 1663356852, 110, 'en', NULL, 'cylindergas', NULL, 'Regulator Performance', '<p>Aygaz United\'s cylinders are regularly checked to ensure the gas regulator and connected properly and functioning optimally. We always suggest our customers to replace the regulator within three years.</p>', NULL, '1', 'oMh2XF9Rv0KpkTOc694i.png', '#e66465', NULL, '2022-09-28 09:20:51', '2022-10-03 05:50:31'),
(116, 1663356852, 110, 'bn', NULL, 'cylindergas', NULL, 'Regulator', '<p>We use the correct regulator and check its condition frequently. We always replace the regulator within 3 years.</p>', NULL, '1', 'oMh2XF9Rv0KpkTOc694i.png', '#e66465', NULL, '2022-09-28 09:20:51', '2022-10-03 05:50:31'),
(117, 1663356907, 110, 'en', NULL, 'cylindergas', NULL, 'Regulator and Valve Connection', '<p>We attach the regulator and ensure that it is firmly connected to the cylinder valve</p>', NULL, '1', 'oxcWyvp07AhX1djKB08k.png', '#e66465', NULL, '2022-09-28 09:21:46', '2022-09-29 17:34:30'),
(118, 1663356907, 110, 'bn', NULL, 'cylindergas', NULL, 'Regulator and Valve Connection', '<p>We attach the regulator and ensure that it is securely connected to the cylinder valve.</p>', NULL, '1', 'oxcWyvp07AhX1djKB08k.png', '#e66465', NULL, '2022-09-28 09:21:46', '2022-09-29 17:34:30'),
(119, 1663356944, 110, 'en', NULL, 'cylindergas', NULL, 'Hose Quality', '<p>We always recommend our customers to use best quality hose pipe which has enhanced safety features and longer life. While offering periodic maintenance we always ensure that our customers are using the right hose pipe and replacing it every two years.</p>', NULL, '1', '3vV4Jkidz21Z6CL6usbl.png', '#e66465', NULL, '2022-09-28 09:22:23', '2022-10-03 06:12:14'),
(120, 1663356944, 110, 'bn', NULL, 'cylindergas', NULL, 'Hose Connection', '<p>We use metal clamps to attach the hose to the regulator and appliance.</p>', NULL, '1', '3vV4Jkidz21Z6CL6usbl.png', '#e66465', NULL, '2022-09-28 09:22:23', '2022-10-03 06:12:14'),
(121, 1663357028, 110, 'en', NULL, 'cylindergas', NULL, 'Hose Connection', '<p>We use metal clamps to attach the hose to the regulator and appliance</p>', NULL, '1', '6H31qwXZGY2xK7pUcaif.png', '#e66465', NULL, '2022-09-28 09:23:47', '2022-09-29 17:35:24'),
(122, 1663357028, 110, 'bn', NULL, 'cylindergas', NULL, 'Hose', '<p>We use the correct hose and check its condition regularly. The hose is always replaced every 2 years.</p>', NULL, '1', '6H31qwXZGY2xK7pUcaif.png', '#e66465', NULL, '2022-09-28 09:23:47', '2022-09-29 17:35:24'),
(123, 1663357161, 110, 'en', NULL, 'cylindergas', NULL, 'Flame Quality', '<p>We advise our customers to buy the good quality burners. After Setting up the cylinder and ensuring the safety, we check the flame quality and ensure that the burner produces a blue flame. We also share some tips with our customers to maintain the burner properly.&nbsp;</p>', NULL, '1', 'gCNk3ba6xwL1d5O9mV84.png', '#e66465', NULL, '2022-09-28 09:26:00', '2022-10-26 09:25:11'),
(124, 1663357161, 110, 'bn', NULL, 'cylindergas', NULL, 'Flame Quality', '<p>We ensure that your burner produces a blue flame and always maintain the quality of your gas appliance.</p><p><br>&nbsp;</p>', NULL, '1', 'gCNk3ba6xwL1d5O9mV84.png', '#e66465', NULL, '2022-09-28 09:26:00', '2022-10-26 09:25:11'),
(125, NULL, NULL, NULL, 'choose_cylinder_gas', 'cylindergas', 'cylindergas', 'Why Choose Cylinder Gas?', NULL, NULL, '1', NULL, NULL, NULL, '2022-09-28 09:35:12', '2022-09-28 09:35:12'),
(126, NULL, NULL, NULL, 'about_bulk_gas', 'bulk_gas', 'bulk_gas', 'About Bulk Gas', NULL, NULL, '1', NULL, NULL, NULL, '2022-09-28 09:55:52', '2022-09-28 09:55:52'),
(127, NULL, NULL, NULL, 'banefit_bulk_gas', 'bulk_gas', 'bulk_gas', 'Benefit of Bulk Gas', NULL, NULL, '1', NULL, NULL, NULL, '2022-09-28 09:59:00', '2022-09-28 09:59:00'),
(128, NULL, NULL, NULL, 'banefit_auto_gas', 'auto_gas', 'auto_gas', 'Benefit of auto Gas', NULL, NULL, '1', NULL, NULL, NULL, '2022-09-28 10:07:09', '2022-09-28 10:07:09'),
(129, NULL, NULL, NULL, 'why_choose_us', 'auto_gas', 'auto_gas', 'Why Choose Us ?', NULL, NULL, '1', NULL, NULL, NULL, '2022-09-28 10:14:20', '2022-09-28 10:14:20'),
(130, 1663366006, 125, 'en', NULL, 'cylindergas', NULL, 'Top-grade raw materials and consumables', NULL, NULL, '1', 'BZxD8k37A1yNjUhQlqLi.png', '#e66465', NULL, '2022-09-28 11:53:25', '2022-10-26 09:45:37'),
(131, 1663366006, 125, 'bn', NULL, 'cylindergas', NULL, NULL, NULL, NULL, '1', 'BZxD8k37A1yNjUhQlqLi.png', '#e66465', NULL, '2022-09-28 11:53:25', '2022-10-26 09:45:37'),
(132, 1663366041, 125, 'en', NULL, 'cylindergas', NULL, 'Homogeneous deep drawing', NULL, NULL, '1', 'rAGY6T2KI4aed41uoi1f.png', '#e66465', NULL, '2022-09-28 11:54:00', '2022-09-29 06:43:53'),
(133, 1663366041, 125, 'bn', NULL, 'cylindergas', NULL, NULL, NULL, NULL, '1', 'rAGY6T2KI4aed41uoi1f.png', '#e66465', NULL, '2022-09-28 11:54:00', '2022-09-29 06:43:53'),
(134, 1663366061, 125, 'en', NULL, 'cylindergas', NULL, 'Automated welding', NULL, NULL, '1', '6R6muL4v3iP7zJtjNdBV.png', '#e66465', NULL, '2022-09-28 11:54:20', '2022-09-29 06:44:09'),
(135, 1663366061, 125, 'bn', NULL, 'cylindergas', NULL, NULL, NULL, NULL, '1', '6R6muL4v3iP7zJtjNdBV.png', '#e66465', NULL, '2022-09-28 11:54:20', '2022-09-29 06:44:09'),
(136, 1663366078, 125, 'en', NULL, 'cylindergas', NULL, 'Normalization thermal treatment in an oxygen-controlled furnace', NULL, NULL, '1', 'ZDCuhzNm137GiKfn0oF0.png', '#e66465', NULL, '2022-09-28 11:54:37', '2022-09-29 06:44:25'),
(137, 1663366078, 125, 'bn', NULL, 'cylindergas', NULL, NULL, NULL, NULL, '1', 'ZDCuhzNm137GiKfn0oF0.png', '#e66465', NULL, '2022-09-28 11:54:37', '2022-09-29 06:44:25'),
(138, 1663366107, 125, 'en', NULL, 'cylindergas', NULL, 'Automated torque-controlled valve screwing', NULL, NULL, '1', '36686g60AP4czVvBUuT1.png', '#e66465', NULL, '2022-09-28 11:55:06', '2022-09-29 06:44:50'),
(139, 1663366107, 125, 'bn', NULL, 'cylindergas', NULL, NULL, NULL, NULL, '1', '36686g60AP4czVvBUuT1.png', '#e66465', NULL, '2022-09-28 11:55:06', '2022-09-29 06:44:50'),
(140, 1663443847, 128, 'en', NULL, 'auto_gas', NULL, 'Efficient', '<p>With a higher-octane rating than gasoline, autogas produces more efficient combustion and more engine power.</p>', '#', '1', 'HYAx86dwG4jyS8rkeUp6.png', '#e66465', NULL, '2022-09-29 09:30:46', '2022-09-30 08:25:10'),
(141, 1663443847, 128, 'bn', NULL, 'auto_gas', NULL, 'Efficient', NULL, '#', '1', 'HYAx86dwG4jyS8rkeUp6.png', '#e66465', NULL, '2022-09-29 09:30:46', '2022-09-30 08:25:10'),
(142, 1663443884, 128, 'en', NULL, 'auto_gas', NULL, 'Eco - Friendly', '<p>Being a low-carbon fuel, it reduces your carbon footprint by decreasing the amount of CO2 emissions</p>', NULL, '1', 'j3Tc1w48OWhsSZ7vUilH.png', '#e66465', NULL, '2022-09-29 09:31:23', '2022-09-29 09:31:23'),
(143, 1663443884, 128, 'bn', NULL, 'auto_gas', NULL, NULL, NULL, NULL, '1', 'j3Tc1w48OWhsSZ7vUilH.png', '#e66465', NULL, '2022-09-29 09:31:23', '2022-09-29 09:31:23'),
(144, 1663443906, 128, 'en', NULL, 'auto_gas', NULL, 'Household Uses', '<p>Autogas tanks are resistant to impact being approximately 6 times thicker than those of alternative fuels.</p>', NULL, '1', 'acsd3h2C4eR3O6IX7Y4U.png', '#e66465', NULL, '2022-09-29 09:31:45', '2022-09-29 09:31:45'),
(145, 1663443906, 128, 'bn', NULL, 'auto_gas', NULL, NULL, NULL, NULL, '1', 'acsd3h2C4eR3O6IX7Y4U.png', '#e66465', NULL, '2022-09-29 09:31:45', '2022-09-29 09:31:45'),
(146, 1663443922, 128, 'en', NULL, 'auto_gas', NULL, 'Economical', '<p>Save more on fuel than other alternatives</p>', NULL, '1', 'lrK4f2N6Fnj7Uk1PT0G9.png', '#e66465', NULL, '2022-09-29 09:32:01', '2022-09-29 09:32:01'),
(147, 1663443922, 128, 'bn', NULL, 'auto_gas', NULL, NULL, NULL, NULL, '1', 'lrK4f2N6Fnj7Uk1PT0G9.png', '#e66465', NULL, '2022-09-29 09:32:01', '2022-09-29 09:32:01'),
(148, 1663443987, 129, 'en', NULL, 'auto_gas', NULL, 'We bring global standard expertise carried forth all the way from Turkey', NULL, NULL, '1', '52Uk8Tghcd43epub6HAJ.png', '#e66465', NULL, '2022-09-29 09:33:06', '2022-09-29 09:33:06'),
(149, 1663443987, 129, 'bn', NULL, 'auto_gas', NULL, NULL, NULL, NULL, '1', '52Uk8Tghcd43epub6HAJ.png', '#e66465', NULL, '2022-09-29 09:33:07', '2022-09-29 09:33:07'),
(150, 1663444024, 129, 'en', NULL, 'auto_gas', NULL, 'We ensure the cleanest and highest quality standard-compliant products in Bangladesh', NULL, NULL, '1', 'Bre8vONlChxn9S14VkW4.png', '#e66465', NULL, '2022-09-29 09:33:43', '2022-09-29 09:33:43'),
(151, 1663444024, 129, 'bn', NULL, 'auto_gas', NULL, NULL, NULL, NULL, '1', 'Bre8vONlChxn9S14VkW4.png', '#e66465', NULL, '2022-09-29 09:33:43', '2022-09-29 09:33:43'),
(152, 1663444037, 129, 'en', NULL, 'auto_gas', NULL, 'We regulate superior quality and performance with samples collected at every point  from production ', NULL, NULL, '1', '4LAmRD1Bp4ZQSv6KdWwu.png', '#e66465', NULL, '2022-09-29 09:33:56', '2022-09-29 09:33:56'),
(153, 1663444037, 129, 'bn', NULL, 'auto_gas', NULL, NULL, NULL, NULL, '1', '4LAmRD1Bp4ZQSv6KdWwu.png', '#e66465', NULL, '2022-09-29 09:33:56', '2022-09-29 09:33:56'),
(154, 1663444436, 126, 'en', NULL, 'bulk_gas', NULL, 'Safe & Reliable Energy Everyday', '<p>Bulk Gas is a way of using LPG where it is transported to and stored by the consumer via trucks or tanks. We help provide a cost-effective installation process, trustworthy staff, on-time delivery, customized solutions, and easy-to-maintain storage facilities for Bulk Gas.</p>', NULL, '1', NULL, '#e66465', NULL, '2022-09-29 09:40:35', '2022-09-29 10:00:59'),
(155, 1663444436, 126, 'bn', NULL, 'bulk_gas', NULL, 'Safe & Reliable Energy Everyday', '<p>While living on the cutting-edge and becoming growingly dependent on energy, reliable supply is all-important. As the leading LPG solutions provider, our goal is to delight your satisfaction by providing sterling products and services, and providing safe, sustainable, and ingenious LPG solutions.</p>', NULL, '1', NULL, '#e66465', NULL, '2022-09-29 09:40:35', '2022-09-29 10:00:59'),
(156, 1663444601, 126, 'en', NULL, 'bulk_gas', NULL, 'Industrial Uses', '<p>Generating hot water and steam, heat treatment, drying, soldering, welding, and cutting</p>', NULL, '1', '24BvbXUcs46zmt9a64CK.png', '#e66465', NULL, '2022-09-29 09:43:20', '2022-09-29 09:43:20'),
(157, 1663444601, 126, 'bn', NULL, 'bulk_gas', NULL, NULL, NULL, NULL, '1', '24BvbXUcs46zmt9a64CK.png', '#e66465', NULL, '2022-09-29 09:43:20', '2022-09-29 09:43:20'),
(158, 1663444626, 126, 'en', NULL, 'bulk_gas', NULL, 'Household Uses', '<p>Heating, cooking, and hot water</p>', NULL, '1', '8H5vR6xTY11PL4yXUS4J.png', '#e66465', NULL, '2022-09-29 09:43:45', '2022-09-29 09:43:45'),
(159, 1663444626, 126, 'bn', NULL, 'bulk_gas', NULL, NULL, NULL, NULL, '1', '8H5vR6xTY11PL4yXUS4J.png', '#e66465', NULL, '2022-09-29 09:43:45', '2022-09-29 09:43:45'),
(160, 1663444645, 126, 'en', NULL, 'bulk_gas', NULL, 'Industrial Uses', '<p>Generating hot water and steam, heat treatment, drying, soldering, welding, and cutting</p>', NULL, '1', 'rD4zjSVOZI4bR62lnhiM.png', '#e66465', NULL, '2022-09-29 09:44:04', '2022-09-29 09:44:04'),
(161, 1663444645, 126, 'bn', NULL, 'bulk_gas', NULL, NULL, NULL, NULL, '1', 'rD4zjSVOZI4bR62lnhiM.png', '#e66465', NULL, '2022-09-29 09:44:04', '2022-09-29 09:44:04'),
(162, 1663444666, 126, 'en', NULL, 'bulk_gas', NULL, 'Household Uses', '<p>Heating, cooking, and hot water</p>', NULL, '1', 'u6icMw5V6Y6y46OFtmjL.png', '#e66465', NULL, '2022-09-29 09:44:25', '2022-09-29 09:44:25'),
(163, 1663444666, 126, 'bn', NULL, 'bulk_gas', NULL, NULL, NULL, NULL, '1', 'u6icMw5V6Y6y46OFtmjL.png', '#e66465', NULL, '2022-09-29 09:44:25', '2022-09-29 09:44:25'),
(164, 1663444722, 127, 'en', NULL, 'bulk_gas', NULL, 'Efficient', '<p>With a higher-octane rating than gasoline, autogas produces more efficient combustion and more engine power.</p>', NULL, '1', 'fVwWH4249ApdYo4IJbme.png', '#f28226', NULL, '2022-09-29 09:45:21', '2022-09-30 03:04:55'),
(165, 1663444722, 127, 'bn', NULL, 'bulk_gas', NULL, NULL, NULL, NULL, '1', 'fVwWH4249ApdYo4IJbme.png', '#f28226', NULL, '2022-09-29 09:45:21', '2022-09-30 03:04:55'),
(166, 1663444745, 127, 'en', NULL, 'bulk_gas', NULL, 'Eco - Friendly', '<p>Being a low-carbon fuel, it reduces your carbon footprint by decreasing the amount of CO2 emissions</p>', NULL, '1', 'r6AovcW5bPsBy87VQlHi.png', '#1e92eb', NULL, '2022-09-29 09:45:44', '2022-09-30 03:07:07'),
(167, 1663444745, 127, 'bn', NULL, 'bulk_gas', NULL, NULL, NULL, NULL, '1', 'r6AovcW5bPsBy87VQlHi.png', '#1e92eb', NULL, '2022-09-29 09:45:44', '2022-09-30 03:07:07'),
(168, 1663444769, 127, 'en', NULL, 'bulk_gas', NULL, 'Household Uses', '<p>Autogas tanks are resistant to impact being approximately 6 times thicker than those of alternative fuels.</p>', NULL, '1', '2MDB6yqxwH0ZpArWveLI.png', '#f04ce3', NULL, '2022-09-29 09:46:08', '2022-09-30 03:08:10'),
(169, 1663444769, 127, 'bn', NULL, 'bulk_gas', NULL, NULL, NULL, NULL, '1', '2MDB6yqxwH0ZpArWveLI.png', '#f04ce3', NULL, '2022-09-29 09:46:08', '2022-09-30 03:08:10'),
(170, 1663444785, 127, 'en', NULL, 'bulk_gas', NULL, 'Economical', '<p>Save more on fuel than other alternatives</p>', NULL, '1', 'esRzuM6PldBn4q97Qyw8.png', '#e66465', NULL, '2022-09-29 09:46:24', '2022-09-29 09:46:24'),
(171, 1663444785, 127, 'bn', NULL, 'bulk_gas', NULL, NULL, NULL, NULL, '1', 'esRzuM6PldBn4q97Qyw8.png', '#e66465', NULL, '2022-09-29 09:46:24', '2022-09-29 09:46:24'),
(172, NULL, NULL, NULL, 'safe_reliable_energy_everyday', 'auto_gas', 'auto_gas', 'Safe & Reliable Energy Everyday', NULL, NULL, '1', NULL, NULL, NULL, '2022-09-29 10:17:42', '2022-09-29 10:17:42'),
(173, 1663451122, 126, 'en', NULL, 'bulk_gas', NULL, 'Banner', NULL, '#', '1', '46wFl7qAOo35GMKpgceV.png', '#e66465', NULL, '2022-09-29 11:32:01', '2022-09-29 12:37:46'),
(174, 1663451122, 126, 'bn', NULL, 'bulk_gas', NULL, 'Banner', NULL, '#', '1', '46wFl7qAOo35GMKpgceV.png', '#e66465', NULL, '2022-09-29 11:32:01', '2022-09-29 12:37:46'),
(175, 1663453369, 172, 'en', NULL, 'auto_gas', NULL, 'Safe & Reliable Energy Everyday', '<p>Automotive LPG or Autogas is the most accessible alternative fuel.</p>', NULL, '1', NULL, '#e66465', NULL, '2022-09-29 12:09:28', '2022-09-29 12:09:28'),
(176, 1663453369, 172, 'bn', NULL, 'auto_gas', NULL, NULL, NULL, NULL, '1', NULL, '#e66465', NULL, '2022-09-29 12:09:28', '2022-09-29 12:09:28'),
(177, 1663511635, 101, 'en', NULL, 'home', NULL, 'Health and Safety', NULL, '/security', '1', 'a5zJbn41eTZ31RxXkLFQ.png', '#e66465', NULL, '2022-09-30 04:20:34', '2022-10-26 05:45:35'),
(178, 1663511635, 101, 'bn', NULL, 'home', NULL, NULL, NULL, '/security', '1', 'a5zJbn41eTZ31RxXkLFQ.png', '#e66465', NULL, '2022-09-30 04:20:34', '2022-10-26 05:45:35'),
(179, 1663511675, 101, 'en', NULL, 'home', NULL, 'Media', NULL, '/news', '1', '126aunIPEdXoz754FYib.png', '#e66465', NULL, '2022-09-30 04:21:14', '2022-10-26 10:39:53'),
(180, 1663511675, 101, 'bn', NULL, 'home', NULL, NULL, NULL, '/news', '1', '126aunIPEdXoz754FYib.png', '#e66465', NULL, '2022-09-30 04:21:14', '2022-10-26 10:39:53'),
(181, 1663511691, 101, 'en', NULL, 'home', NULL, 'Contact Us', NULL, '/contact', '1', NULL, '#e66465', NULL, '2022-09-30 04:21:30', '2022-09-30 08:50:33'),
(182, 1663511691, 101, 'bn', NULL, 'home', NULL, NULL, NULL, '/contact', '1', NULL, '#e66465', NULL, '2022-09-30 04:21:30', '2022-09-30 08:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `message` text CHARACTER SET utf8,
  `reply_message` text CHARACTER SET utf8,
  `reply_status` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '0=>No, 1=>Yes',
  `status` enum('0','1','3') CHARACTER SET utf8 NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 3=>Delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `first_name`, `last_name`, `email`, `subject`, `phone_no`, `company_name`, `message`, `reply_message`, `reply_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Harry Jones', NULL, NULL, 'harry@mailinator.com', 'Your Document verification Has Been Decline By Admin', '1234567890', '10 West Advisors, Inc.', 'asdguagsdgau f ysagfi agfuaf  a', 'ok no problem', '1', '1', '2022-03-19 07:58:17', '2022-03-19 12:25:19'),
(2, 'Harry Jones', NULL, NULL, 'harryy@mailinator.com', 'Order Placed Successfully', '1234567890', '10 West Advisors, Inc.', 'hgd ihush fo os ojo gsrg', NULL, '0', '1', '2022-03-19 08:17:37', '2022-03-19 11:09:29'),
(3, 'test', NULL, NULL, 'test@test.com', 'test', '123456789', NULL, 'testing', NULL, '0', '1', '2022-09-23 09:12:53', '2022-09-23 09:12:53'),
(4, 'test test', 'test', 'test', 'test@test.com', NULL, '123456789', NULL, 'testing', NULL, '0', '1', '2022-09-23 01:01:44', '2022-09-23 01:01:44'),
(5, 'test121 test', 'test121', 'test', 'test@test.com', NULL, '1234567890', NULL, 'testing', NULL, '0', '1', '2022-09-23 01:04:54', '2022-09-23 01:04:54'),
(6, 'masud parvaj akanda', 'masud parvaj', 'akanda', 'parvajakanda5@Gmail.com', NULL, '01701062083', NULL, 'testing', NULL, '0', '1', '2022-11-01 06:53:19', '2022-11-01 06:53:19'),
(7, 'Zakir Hossain Ripon', 'Zakir Hossain', 'Ripon', 'planetcomripon@gmail.com', NULL, '01765151609', NULL, 'testing', NULL, '0', '1', '2022-11-02 03:34:12', '2022-11-02 03:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(44) CHARACTER SET utf8 NOT NULL,
  `country_code` varchar(2) CHARACTER SET utf8 NOT NULL,
  `status` bit(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `country_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', b'1', NULL, NULL),
(2, 'Albania', 'AL', b'1', NULL, NULL),
(3, 'Algeria', 'DZ', b'1', NULL, NULL),
(4, 'American Samoa', 'AS', b'1', NULL, NULL),
(5, 'Andorra', 'AD', b'1', NULL, NULL),
(6, 'Angola', 'AO', b'1', NULL, NULL),
(7, 'Anguilla', 'AI', b'1', NULL, NULL),
(8, 'Antarctica', 'AQ', b'1', NULL, NULL),
(9, 'Antigua And Barbuda', 'AG', b'1', NULL, NULL),
(10, 'Argentina', 'AR', b'1', NULL, NULL),
(11, 'Armenia', 'AM', b'1', NULL, NULL),
(12, 'Aruba', 'AW', b'1', NULL, NULL),
(13, 'Australia', 'AU', b'1', NULL, NULL),
(14, 'Austria', 'AT', b'1', NULL, NULL),
(15, 'Azerbaijan', 'AZ', b'1', NULL, NULL),
(16, 'Bahamas', 'BS', b'1', NULL, NULL),
(17, 'Bahrain', 'BH', b'1', NULL, NULL),
(18, 'Bangladesh', 'BD', b'1', NULL, NULL),
(19, 'Barbados', 'BB', b'1', NULL, NULL),
(20, 'Belarus', 'BY', b'1', NULL, NULL),
(21, 'Belgium', 'BE', b'1', NULL, NULL),
(22, 'Belize', 'BZ', b'1', NULL, NULL),
(23, 'Benin', 'BJ', b'1', NULL, NULL),
(24, 'Bermuda', 'BM', b'1', NULL, NULL),
(25, 'Bhutan', 'BT', b'1', NULL, NULL),
(26, 'Bolivia', 'BO', b'1', NULL, NULL),
(27, 'Bosnia And Herzegovina', 'BA', b'1', NULL, NULL),
(28, 'Botswana', 'BW', b'1', NULL, NULL),
(29, 'Bouvet Island', 'BV', b'1', NULL, NULL),
(30, 'Brazil', 'BR', b'1', NULL, NULL),
(31, 'British Indian Ocean Territory', 'IO', b'1', NULL, NULL),
(32, 'Brunei Darussalam', 'BN', b'1', NULL, NULL),
(33, 'Bulgaria', 'BG', b'1', NULL, NULL),
(34, 'Burkina Faso', 'BF', b'1', NULL, NULL),
(35, 'Burundi', 'BI', b'1', NULL, NULL),
(36, 'Cambodia', 'KH', b'1', NULL, NULL),
(37, 'Cameroon', 'CM', b'1', NULL, NULL),
(38, 'Canada', 'CA', b'1', NULL, NULL),
(39, 'Cape Verde', 'CV', b'1', NULL, NULL),
(40, 'Cayman Islands', 'KY', b'1', NULL, NULL),
(41, 'Central African Republic', 'CF', b'1', NULL, NULL),
(42, 'Chad', 'TD', b'1', NULL, NULL),
(43, 'Chile', 'CL', b'1', NULL, NULL),
(44, 'China', 'CN', b'1', NULL, NULL),
(45, 'Christmas Island', 'CX', b'1', NULL, NULL),
(46, 'Cocos (keeling) Islands', 'CC', b'1', NULL, NULL),
(47, 'Colombia', 'CO', b'1', NULL, NULL),
(48, 'Comoros', 'KM', b'1', NULL, NULL),
(49, 'Congo', 'CG', b'1', NULL, NULL),
(50, 'Congo, The Democratic Republic Of The', 'CD', b'1', NULL, NULL),
(51, 'Cook Islands', 'CK', b'1', NULL, NULL),
(52, 'Costa Rica', 'CR', b'1', NULL, NULL),
(53, 'Cote D\'ivoire', 'CI', b'1', NULL, NULL),
(54, 'Croatia', 'HR', b'1', NULL, NULL),
(55, 'Cuba', 'CU', b'1', NULL, NULL),
(56, 'Cyprus', 'CY', b'1', NULL, NULL),
(57, 'Czech Republic', 'CZ', b'1', NULL, NULL),
(58, 'Denmark', 'DK', b'1', NULL, NULL),
(59, 'Djibouti', 'DJ', b'1', NULL, NULL),
(60, 'Dominica', 'DM', b'1', NULL, NULL),
(61, 'Dominican Republic', 'DO', b'1', NULL, NULL),
(62, 'East Timor', 'TP', b'1', NULL, NULL),
(63, 'Ecuador', 'EC', b'1', NULL, NULL),
(64, 'Egypt', 'EG', b'1', NULL, NULL),
(65, 'El Salvador', 'SV', b'1', NULL, NULL),
(66, 'Equatorial Guinea', 'GQ', b'1', NULL, NULL),
(67, 'Eritrea', 'ER', b'1', NULL, NULL),
(68, 'Estonia', 'EE', b'1', NULL, NULL),
(69, 'Ethiopia', 'ET', b'1', NULL, NULL),
(70, 'Falkland Islands (malvinas)', 'FK', b'1', NULL, NULL),
(71, 'Faroe Islands', 'FO', b'1', NULL, NULL),
(72, 'Fiji', 'FJ', b'1', NULL, NULL),
(73, 'Finland', 'FI', b'1', NULL, NULL),
(74, 'France', 'FR', b'1', NULL, NULL),
(75, 'French Guiana', 'GF', b'1', NULL, NULL),
(76, 'French Polynesia', 'PF', b'1', NULL, NULL),
(77, 'French Southern Territories', 'TF', b'1', NULL, NULL),
(78, 'Gabon', 'GA', b'1', NULL, NULL),
(79, 'Gambia', 'GM', b'1', NULL, NULL),
(80, 'Georgia', 'GE', b'1', NULL, NULL),
(81, 'Germany', 'DE', b'1', NULL, NULL),
(82, 'Ghana', 'GH', b'1', NULL, NULL),
(83, 'Gibraltar', 'GI', b'1', NULL, NULL),
(84, 'Greece', 'GR', b'1', NULL, NULL),
(85, 'Greenland', 'GL', b'1', NULL, NULL),
(86, 'Grenada', 'GD', b'1', NULL, NULL),
(87, 'Guadeloupe', 'GP', b'1', NULL, NULL),
(88, 'Guam', 'GU', b'1', NULL, NULL),
(89, 'Guatemala', 'GT', b'1', NULL, NULL),
(90, 'Guinea', 'GN', b'1', NULL, NULL),
(91, 'Guinea-bissau', 'GW', b'1', NULL, NULL),
(92, 'Guyana', 'GY', b'1', NULL, NULL),
(93, 'Haiti', 'HT', b'1', NULL, NULL),
(94, 'Heard Island And Mcdonald Islands', 'HM', b'1', NULL, NULL),
(95, 'Holy See (vatican City State)', 'VA', b'1', NULL, NULL),
(96, 'Honduras', 'HN', b'1', NULL, NULL),
(97, 'Hong Kong', 'HK', b'1', NULL, NULL),
(98, 'Hungary', 'HU', b'1', NULL, NULL),
(99, 'Iceland', 'IS', b'1', NULL, NULL),
(100, 'India', 'IN', b'1', NULL, NULL),
(101, 'Indonesia', 'ID', b'1', NULL, NULL),
(102, 'Iran, Islamic Republic Of', 'IR', b'1', NULL, NULL),
(103, 'Iraq', 'IQ', b'1', NULL, NULL),
(104, 'Ireland', 'IE', b'1', NULL, NULL),
(105, 'Israel', 'IL', b'1', NULL, NULL),
(106, 'Italy', 'IT', b'1', NULL, NULL),
(107, 'Jamaica', 'JM', b'1', NULL, NULL),
(108, 'Japan', 'JP', b'1', NULL, NULL),
(109, 'Jordan', 'JO', b'1', NULL, NULL),
(110, 'Kazakstan', 'KZ', b'1', NULL, NULL),
(111, 'Kenya', 'KE', b'1', NULL, NULL),
(112, 'Kiribati', 'KI', b'1', NULL, NULL),
(113, 'Korea, Democratic People\'s Republic Of', 'KP', b'1', NULL, NULL),
(114, 'Korea, Republic Of', 'KR', b'1', NULL, NULL),
(115, 'Kosovo', 'KV', b'1', NULL, NULL),
(116, 'Kuwait', 'KW', b'1', NULL, NULL),
(117, 'Kyrgyzstan', 'KG', b'1', NULL, NULL),
(118, 'Lao People\'s Democratic Republic', 'LA', b'1', NULL, NULL),
(119, 'Latvia', 'LV', b'1', NULL, NULL),
(120, 'Lebanon', 'LB', b'1', NULL, NULL),
(121, 'Lesotho', 'LS', b'1', NULL, NULL),
(122, 'Liberia', 'LR', b'1', NULL, NULL),
(123, 'Libyan Arab Jamahiriya', 'LY', b'1', NULL, NULL),
(124, 'Liechtenstein', 'LI', b'1', NULL, NULL),
(125, 'Lithuania', 'LT', b'1', NULL, NULL),
(126, 'Luxembourg', 'LU', b'1', NULL, NULL),
(127, 'Macau', 'MO', b'1', NULL, NULL),
(128, 'Macedonia, The Former Yugoslav Republic Of', 'MK', b'1', NULL, NULL),
(129, 'Madagascar', 'MG', b'1', NULL, NULL),
(130, 'Malawi', 'MW', b'1', NULL, NULL),
(131, 'Malaysia', 'MY', b'1', NULL, NULL),
(132, 'Maldives', 'MV', b'1', NULL, NULL),
(133, 'Mali', 'ML', b'1', NULL, NULL),
(134, 'Malta', 'MT', b'1', NULL, NULL),
(135, 'Marshall Islands', 'MH', b'1', NULL, NULL),
(136, 'Martinique', 'MQ', b'1', NULL, NULL),
(137, 'Mauritania', 'MR', b'1', NULL, NULL),
(138, 'Mauritius', 'MU', b'1', NULL, NULL),
(139, 'Mayotte', 'YT', b'1', NULL, NULL),
(140, 'Mexico', 'MX', b'1', NULL, NULL),
(141, 'Micronesia, Federated States Of', 'FM', b'1', NULL, NULL),
(142, 'Moldova, Republic Of', 'MD', b'1', NULL, NULL),
(143, 'Monaco', 'MC', b'1', NULL, NULL),
(144, 'Mongolia', 'MN', b'1', NULL, NULL),
(145, 'Montserrat', 'MS', b'1', NULL, NULL),
(146, 'Montenegro', 'ME', b'1', NULL, NULL),
(147, 'Morocco', 'MA', b'1', NULL, NULL),
(148, 'Mozambique', 'MZ', b'1', NULL, NULL),
(149, 'Myanmar', 'MM', b'1', NULL, NULL),
(150, 'Namibia', 'NA', b'1', NULL, NULL),
(151, 'Nauru', 'NR', b'1', NULL, NULL),
(152, 'Nepal', 'NP', b'1', NULL, NULL),
(153, 'Netherlands', 'NL', b'1', NULL, NULL),
(154, 'Netherlands Antilles', 'AN', b'1', NULL, NULL),
(155, 'New Caledonia', 'NC', b'1', NULL, NULL),
(156, 'New Zealand', 'NZ', b'1', NULL, NULL),
(157, 'Nicaragua', 'NI', b'1', NULL, NULL),
(158, 'Niger', 'NE', b'1', NULL, NULL),
(159, 'Nigeria', 'NG', b'1', NULL, NULL),
(160, 'Niue', 'NU', b'1', NULL, NULL),
(161, 'Norfolk Island', 'NF', b'1', NULL, NULL),
(162, 'Northern Mariana Islands', 'MP', b'1', NULL, NULL),
(163, 'Norway', 'NO', b'1', NULL, NULL),
(164, 'Oman', 'OM', b'1', NULL, NULL),
(165, 'Pakistan', 'PK', b'1', NULL, NULL),
(166, 'Palau', 'PW', b'1', NULL, NULL),
(167, 'Palestinian Territory, Occupied', 'PS', b'1', NULL, NULL),
(168, 'Panama', 'PA', b'1', NULL, NULL),
(169, 'Papua New Guinea', 'PG', b'1', NULL, NULL),
(170, 'Paraguay', 'PY', b'1', NULL, NULL),
(171, 'Peru', 'PE', b'1', NULL, NULL),
(172, 'Philippines', 'PH', b'1', NULL, NULL),
(173, 'Pitcairn', 'PN', b'1', NULL, NULL),
(174, 'Poland', 'PL', b'1', NULL, NULL),
(175, 'Portugal', 'PT', b'1', NULL, NULL),
(176, 'Puerto Rico', 'PR', b'1', NULL, NULL),
(177, 'Qatar', 'QA', b'1', NULL, NULL),
(178, 'Reunion', 'RE', b'1', NULL, NULL),
(179, 'Romania', 'RO', b'1', NULL, NULL),
(180, 'Russian Federation', 'RU', b'1', NULL, NULL),
(181, 'Rwanda', 'RW', b'1', NULL, NULL),
(182, 'Saint Helena', 'SH', b'1', NULL, NULL),
(183, 'Saint Kitts And Nevis', 'KN', b'1', NULL, NULL),
(184, 'Saint Lucia', 'LC', b'1', NULL, NULL),
(185, 'Saint Pierre And Miquelon', 'PM', b'1', NULL, NULL),
(186, 'Saint Vincent And The Grenadines', 'VC', b'1', NULL, NULL),
(187, 'Samoa', 'WS', b'1', NULL, NULL),
(188, 'San Marino', 'SM', b'1', NULL, NULL),
(189, 'Sao Tome And Principe', 'ST', b'1', NULL, NULL),
(190, 'Saudi Arabia', 'SA', b'1', NULL, NULL),
(191, 'Senegal', 'SN', b'1', NULL, NULL),
(192, 'Serbia', 'RS', b'1', NULL, NULL),
(193, 'Seychelles', 'SC', b'1', NULL, NULL),
(194, 'Sierra Leone', 'SL', b'1', NULL, NULL),
(195, 'Singapore', 'SG', b'1', NULL, NULL),
(196, 'Slovakia', 'SK', b'1', NULL, NULL),
(197, 'Slovenia', 'SI', b'1', NULL, NULL),
(198, 'Solomon Islands', 'SB', b'1', NULL, NULL),
(199, 'Somalia', 'SO', b'1', NULL, NULL),
(200, 'South Africa', 'ZA', b'1', NULL, NULL),
(201, 'South Georgia And The South Sandwich Islands', 'GS', b'1', NULL, NULL),
(202, 'Spain', 'ES', b'1', NULL, NULL),
(203, 'Sri Lanka', 'LK', b'1', NULL, NULL),
(204, 'Sudan', 'SD', b'1', NULL, NULL),
(205, 'Suriname', 'SR', b'1', NULL, NULL),
(206, 'Svalbard And Jan Mayen', 'SJ', b'1', NULL, NULL),
(207, 'Swaziland', 'SZ', b'1', NULL, NULL),
(208, 'Sweden', 'SE', b'1', NULL, NULL),
(209, 'Switzerland', 'CH', b'1', NULL, NULL),
(210, 'Syrian Arab Republic', 'SY', b'1', NULL, NULL),
(211, 'Taiwan, Province Of China', 'TW', b'1', NULL, NULL),
(212, 'Tajikistan', 'TJ', b'1', NULL, NULL),
(213, 'Tanzania, United Republic Of', 'TZ', b'1', NULL, NULL),
(214, 'Thailand', 'TH', b'1', NULL, NULL),
(215, 'Togo', 'TG', b'1', NULL, NULL),
(216, 'Tokelau', 'TK', b'1', NULL, NULL),
(217, 'Tonga', 'TO', b'1', NULL, NULL),
(218, 'Trinidad And Tobago', 'TT', b'1', NULL, NULL),
(219, 'Tunisia', 'TN', b'1', NULL, NULL),
(220, 'Turkey', 'TR', b'1', NULL, NULL),
(221, 'Turkmenistan', 'TM', b'1', NULL, NULL),
(222, 'Turks And Caicos Islands', 'TC', b'1', NULL, NULL),
(223, 'Tuvalu', 'TV', b'1', NULL, NULL),
(224, 'Uganda', 'UG', b'1', NULL, NULL),
(225, 'Ukraine', 'UA', b'1', NULL, NULL),
(226, 'United Arab Emirates', 'AE', b'1', NULL, NULL),
(227, 'United Kingdom', 'GB', b'1', NULL, NULL),
(228, 'United States', 'US', b'1', NULL, NULL),
(229, 'Uruguay', 'UY', b'1', NULL, NULL),
(230, 'Uzbekistan', 'UZ', b'1', NULL, NULL),
(231, 'Vanuatu', 'VU', b'1', NULL, NULL),
(232, 'Venezuela', 'VE', b'1', NULL, NULL),
(233, 'Viet Nam', 'VN', b'1', NULL, NULL),
(234, 'Virgin Islands, British', 'VG', b'1', NULL, NULL),
(235, 'Virgin Islands, U.S.', 'VI', b'1', NULL, NULL),
(236, 'Wallis And Futuna', 'WF', b'1', NULL, NULL),
(237, 'Western Sahara', 'EH', b'1', NULL, NULL),
(238, 'Yemen', 'YE', b'1', NULL, NULL),
(239, 'Zambia', 'ZM', b'1', NULL, NULL),
(240, 'Zimbabwe', 'ZW', b'1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cylinder_orders`
--

CREATE TABLE `cylinder_orders` (
  `id` bigint(200) NOT NULL,
  `cylinder_id` int(255) NOT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `name` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `thana` text NOT NULL,
  `district` text NOT NULL,
  `message` text NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cylinder_orders`
--

INSERT INTO `cylinder_orders` (`id`, `cylinder_id`, `service_type`, `name`, `phone`, `address`, `thana`, `district`, `message`, `status`, `create_at`, `updated_at`) VALUES
(1, 5, 'Testing', 'Testing', '1221253', 'testAdress', 'TestingThana', 'test', 'Testing', '1', '2022-08-27 05:40:09', ''),
(2, 2, 'Testing', 'Testing', '1221253', 'testAdress', 'TestingThana', 'test', 'Testing', '1', '2022-08-27 05:40:37', ''),
(3, 3, 'Testing', 'Testing', '1221253', 'testAdress', 'TestingThana', 'test', 'Testing', '1', '2022-08-27 05:41:44', ''),
(4, 1, 'new cylinded', 'Testing', '1234567891', 'Testing 1234', 'test', 'test2', 'test1234', '1', '2022-08-27 08:53:28', ''),
(5, 12, 'new cylinded', 'Testing', '1234567890', 'Testing12', 'Testing123', 'Testing1234', 'Testing123456789', '1', '2022-08-27 08:57:44', ''),
(6, 4, 'new cylinded', 'Testing1', '1234567890', 'Testing12', 'Testing123', 'Testing1234', 'Testing123456789', '1', '2022-08-27 09:01:29', ''),
(7, 3, 'refill cylinder', 'Testing112', '123567892', 'Testing124444', 'Testing124444544', 'Testing1244444545', 'Testing12444445454', '1', '2022-08-27 09:18:59', ''),
(8, 4, 'leak detected', 'Test1', '1234567894', 'Test1123', 'Test1487552', 'Test1587', 'Test146496', '1', '2022-08-27 09:20:20', ''),
(9, 4, 'refill cylinder', 'Test12', '1234567887', 'Test12', 'Test12', 'Test12', 'Test12', '1', '2022-08-27 09:36:59', ''),
(10, 3, 'new cylinded', 'Ben T', '4321432112', 'abc', 'xyz', 'qwerty', 'Loren Ipsum', '1', '2022-08-27 09:57:53', ''),
(11, 3, 'new cylinded', 'test21', '123456787', 'test', 'test', 'test', 'test', '1', '2022-09-22 03:47:45', '');

-- --------------------------------------------------------

--
-- Table structure for table `dealership_opportunity`
--

CREATE TABLE `dealership_opportunity` (
  `id` int(11) NOT NULL,
  `dealer_name` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `thana` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `monthly_sales_volume` varchar(100) DEFAULT NULL,
  `coverage` varchar(100) DEFAULT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dealership_opportunity`
--

INSERT INTO `dealership_opportunity` (`id`, `dealer_name`, `contact_person`, `phone`, `address`, `thana`, `district`, `monthly_sales_volume`, `coverage`, `status`, `create_at`, `update_at`) VALUES
(1, 'banner', 'mr john', '9797', 'This is testing', 'Jaho', 'alkjd', 'adf', 'jk', '1', '2022-09-22 03:19:14', NULL),
(2, 'test1', 'xyz', '1234567890', 'test', 'test', 'test', '1000', 'jk', '1', '2022-09-22 03:28:33', NULL),
(3, 'test2', 'test', '1234567890', 'test', 'test', 'test', '1000', 'ls', '1', '2022-09-22 03:43:40', NULL),
(4, 'test3', 'test', '1234567890', 'test', 'test', 'test', '1000', 'ls', '1', '2022-09-22 03:44:12', NULL),
(5, 'test4', 'test', '1234567890', 'test', 'test', 'test', '1000', 'ls', '1', '2022-09-22 03:45:23', NULL),
(6, 'test4', 'test', '1234567890', 'test', 'test', 'test', '1000', 'ls', '1', '2022-09-22 03:45:33', NULL),
(7, 'test5', 'test', '1234567890', 'test', 'test', 'test', '1200', 'test', '1', '2022-09-22 03:47:03', NULL),
(8, 'test', 'test', '752875287520', 'test', 'test', 'test', '1200', 'test', '1', '2022-09-22 03:48:20', NULL),
(9, 'test6', 'test', '0123456789', 'test', 'test', 'test', '100', 'test', '1', '2022-09-22 03:52:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` bigint(20) NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `about` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `body` longtext CHARACTER SET utf8,
  `variable` text CHARACTER SET utf8,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `slug`, `about`, `subject`, `body`, `variable`, `created_at`, `updated_at`) VALUES
(1, 'contact_us', 'Contact Us', 'Contact To Admin', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span> {{ADMIN}},</span></span></strong></p>\r\n\r\n<p>Someone&nbsp;contacting you. Please see the below details&nbsp;and reply on it.</p>\r\n\r\n<p>Name: {{NAME}}</p>\r\n\r\n<p>Email: {{EMAIL}}</p>\r\n\r\n<p>Phone: {{PHONE}}</p>\r\n\r\n<p>Message: {{MESSAGE}}</p>', 'Admin: {{ADMIN}} <br>\r\nName: {{NAME}} <br>\r\nEmail: {{EMAIL}} <br>\r\nPhone: {{PHONE}} <br>\r\nMessage: {{MESSAGE}} <br>', '2020-04-28 00:00:00', '2022-04-23 07:42:30'),
(2, 'admin_reply', 'Contact Us Reply', 'Contact Us Reply', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span> {{NAME}},</span></span></strong></p>\r\n\r\n<p><strong>{{MESSAGE}}</strong></p>', 'Name: {{NAME}}<br>\r\nMessage: {{MESSAGE}}\r\n<br>', '2020-04-28 00:00:00', '2022-04-23 07:44:18'),
(3, 'requriment_request_form', 'Requriment Request Form', 'Requriment Request Form', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\r\n\r\n<p>Congratulations!! You have successfully request for your <strong>Requriments</strong>.</p>\r\n\r\n<p>Email: <strong>{{EMAIL}}</strong></p>\r\n\r\n<p>Phone: <strong>{{PHONE}}</strong></p>\r\n\r\n<p>Address: <strong>{{ADDRESS}}</strong></p>\r\n\r\n<p>Zip-code: <strong>{{ZIPCODE}}</strong></p>\r\n\r\n\r\n\r\n<p>Description: <strong>{{DESCRIPTION}}</strong></p>\r\n\r\n\r\n<p>Note: Our service providers will contact you soon.</p>', 'Name: {{NAME}}<br>\r\nEmail: {{Email}}<br>\r\nPhone: {{PHONE}}<br>\r\nAddress: {{ADDRESS}}<br>\r\nZip-code: {{ZIPCODE}}<br>\r\nDescription: {{DESCRIPTION}}<br>', '2020-04-28 00:00:00', '2021-11-02 08:29:07'),
(4, 'assign_requriment_request_form', 'Assign Requriment Request Form', 'Assign Requriment Request Form', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\r\n\r\n<p>Congratulations!! You have successfully request for your <strong>Requriments</strong>.</p>\r\n\r\n<p>Email: <strong>{{EMAIL}}</strong></p>\r\n\r\n<p>Phone: <strong>{{PHONE}}</strong></p>\r\n\r\n<p>Address: <strong>{{ADDRESS}}</strong></p>\r\n\r\n<p>Zip-code: <strong>{{ZIPCODE}}</strong></p>\r\n\r\n<p>Description: <strong>{{DESCRIPTION}}</strong></p>\r\n\r\n', '\r\nName: {{NAME}}<br>\r\nEmail: {{Email}}<br>\r\nPhone: {{PHONE}}<br>\r\nAddress: {{ADDRESS}}<br>\r\nZip-code: {{ZIPCODE}}<br>\r\nDescription: {{DESCRIPTION}}<br>', '2020-04-28 00:00:00', '2021-11-02 08:29:07'),
(5, 'hire_fixer_request_form', 'Hire Fixer Request Form', 'Hire Fixer Request Form', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\r\n\r\n<p>Congratulations!! You have successfully request for your <strong>Hire Fixer</strong>.</p>\r\n\r\n<p>Email: <strong>{{EMAIL}}</strong></p>\r\n<p>Title: <strong>{{TITLE}}</strong></p>\r\n<p>Deadline: <strong>{{DEADLINE}}</strong></p>\r\n<p>Budget: <strong>{{BUDGET}}</strong></p>\r\n<p>Currency: <strong>{{CURRENCY}}</strong></p>\r\n<p>Phone: <strong>{{PHONE}}</strong></p>\r\n\r\n<p>Address: <strong>{{ADDRESS}}</strong></p>\r\n\r\n<p>Zip-code: <strong>{{ZIPCODE}}</strong></p>\r\n\r\n<p>Description: <strong>{{DESCRIPTION}}</strong></p>\r\n\r\n\r\n<p>Note: Our service providers will contact you soon.</p>', 'Name: {{NAME}}<br>\r\nEmail: {{Email}}<br>\r\nPhone: {{PHONE}}<br>\r\nAddress: {{ADDRESS}}<br>\r\nZip-code: {{ZIPCODE}}<br>\r\nDescription: {{DESCRIPTION}}<br>\r\nCurrency: {{CURRENCY}}<br>', '2020-04-28 00:00:00', '2021-11-02 08:29:07'),
(6, 'user_registration_by_admin', 'Service provider Registration By Admin', 'Service provider Registration', '<p><strong>Hello&nbsp;{{NAME}},</strong></p><p>Congratulations!! You have successfully registered for <strong>Nocurenopay</strong>.</p><p>Your Email: <strong>{{EMAIL}}</strong></p><p>Password : <strong>{{PASSWORD}}</strong></p><p>Note: After login, you can change your password.</p>', 'Name: {{NAME}}<br>\r\nEmail: {{EMAIL}}<br>\r\nPassword: {{PASSWORD}}<br>', '2020-04-28 00:00:00', '2022-06-15 16:32:25');

-- --------------------------------------------------------

--
-- Table structure for table `email_bk`
--

CREATE TABLE `email_bk` (
  `id` bigint(20) NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `about` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `body` longtext CHARACTER SET utf8,
  `variable` text CHARACTER SET utf8,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_bk`
--

INSERT INTO `email_bk` (`id`, `slug`, `about`, `subject`, `body`, `variable`, `created_at`, `updated_at`) VALUES
(1, 'user_registration', 'User Registration12', 'User Registration12', '<p><strong>Hello&nbsp;{{NAME}},</strong></p><p>Congratulations!! You have successfully registered for Nocurenopay.jhb uvkf utf</p><p>Please click on the link below to activate your account.</p><p><strong>{{LINK}}</strong></p>', 'Name: {{NAME}}<br>\r\nLink: {{LINK}}<br>', '2020-04-28 00:00:00', '2022-04-25 12:12:21'),
(2, 'user_forgot_password', 'User Forgot Password1111', 'Password Recovery Assistance1111', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\r\n\r\n<p>Please click the below link to change reset your password.</p>\r\n\r\n<p><strong>{{LINK}}</strong></p>', 'Name: &nbsp;{{NAME}}<br>\r\nLink: &nbsp;{{LINK}}<br>', '2020-04-28 00:00:00', '2022-04-23 07:39:58'),
(3, 'contact_us', 'Contact Us12', 'Contact To Admin21', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span> {{ADMIN}},</span></span></strong></p>\n\n<p>Someone&nbsp;contacting you. Please see the below details&nbsp;and reply on it.</p>\n\n<p>Name: {{NAME}}</p>\n\n<p>Email: {{EMAIL}}</p>\n\n<p>Phone: {{PHONE}}</p>\n\n<p>Message: {{MESSAGE}}</p>', 'Admin: {{ADMIN}} <br>\r\nName: {{NAME}} <br>\r\nEmail: {{EMAIL}} <br>\r\nPhone: {{PHONE}} <br>\r\nMessage: {{MESSAGE}} <br>', '2020-04-28 00:00:00', '2022-04-23 07:42:30'),
(4, 'admin_reply', 'Contact Us Reply21', 'Contact Us Reply21', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span> {{NAME}},</span></span></strong></p>\r\n\r\n<p><strong>{{MESSAGE}}</strong></p>', 'Name: {{NAME}}<br>\r\nMessage: {{MESSAGE}}\r\n<br>', '2020-04-28 00:00:00', '2022-04-23 07:44:18'),
(5, 'user_registration_by_admin', 'User Registration By Admin', 'New User Registration', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\n\n<p>Congratulations!! You have successfully registered for <strong>Nocurenopay</strong>.</p>\n\n<p>Your Email : <strong>{{EMAIL}}</strong></p>\n\n<p>Password : <strong>{{PASSWORD}}</strong></p>\n\n\n\n<p>Note: After login you can change your password.</p>', 'Name: {{NAME}}<br>\nPin: {{PIN}}<br>\nEmail: {{EMAIL}}<br>\nPassword: {{PASSWORD}}<br>', '2020-04-28 00:00:00', '2021-11-02 08:29:07'),
(6, 'requriment_request_form', 'Requriment Request Form', 'Requriment Request Form', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\n\n<p>Congratulations!! You have successfully request for your <strong>Requriments</strong>.</p>\n\n<p>Email: <strong>{{EMAIL}}</strong></p>\n\n<p>Phone: <strong>{{PHONE}}</strong></p>\n\n<p>Address: <strong>{{ADDRESS}}</strong></p>\n\n<p>Zip-code: <strong>{{ZIPCODE}}</strong></p>\n\n\n\n<p>Description: <strong>{{DESCRIPTION}}</strong></p>\n\n\n<p>Note: Our service providers will contact you soon.</p>', 'Name: {{NAME}}<br>\nEmail: {{Email}}<br>\nPhone: {{PHONE}}<br>\nAddress: {{ADDRESS}}<br>\nZip-code: {{ZIPCODE}}<br>\nDescription: {{DESCRIPTION}}<br>', '2020-04-28 00:00:00', '2021-11-02 08:29:07'),
(7, 'assign_requriment_request_form', 'Assign Requriment Request Form', 'Assign Requriment Request Form', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\r\n\r\n<p>Congratulations!! You have successfully request for your <strong>Requriments</strong>.</p>\r\n\r\n<p>Email: <strong>{{EMAIL}}</strong></p>\r\n\r\n<p>Phone: <strong>{{PHONE}}</strong></p>\r\n\r\n<p>Address: <strong>{{ADDRESS}}</strong></p>\r\n\r\n<p>Zip-code: <strong>{{ZIPCODE}}</strong></p>\r\n\r\n<p>Description: <strong>{{DESCRIPTION}}</strong></p>\r\n\r\n', '\r\nName: {{NAME}}<br>\r\nEmail: {{Email}}<br>\r\nPhone: {{PHONE}}<br>\r\nAddress: {{ADDRESS}}<br>\r\nZip-code: {{ZIPCODE}}<br>\r\nDescription: {{DESCRIPTION}}<br>', '2020-04-28 00:00:00', '2021-11-02 08:29:07'),
(8, 'hire_fixer_request_form', 'Hire Fixer Request Form', 'Hire Fixer Request Form', '<p><strong><span style=\"color:rgb(178, 34, 34)\"><span style=\"font-size:18px\"><span style=\"font-family:arial,helvetica,sans-serif\">Hello</span>&nbsp;{{NAME}},</span></span></strong></p>\r\n\r\n<p>Congratulations!! You have successfully request for your <strong>Hire Fixer</strong>.</p>\r\n\r\n<p>Email: <strong>{{EMAIL}}</strong></p>\r\n<p>Title: <strong>{{TITLE}}</strong></p>\r\n<p>Deadline: <strong>{{DEADLINE}}</strong></p>\r\n<p>Budget: <strong>{{BUDGET}}</strong></p>\r\n<p>Currency: <strong>{{CURRENCY}}</strong></p>\r\n<p>Phone: <strong>{{PHONE}}</strong></p>\r\n\r\n<p>Address: <strong>{{ADDRESS}}</strong></p>\r\n\r\n<p>Zip-code: <strong>{{ZIPCODE}}</strong></p>\r\n\r\n<p>Description: <strong>{{DESCRIPTION}}</strong></p>\r\n\r\n\r\n<p>Note: Our service providers will contact you soon.</p>', 'Name: {{NAME}}<br>\r\nEmail: {{Email}}<br>\r\nPhone: {{PHONE}}<br>\r\nAddress: {{ADDRESS}}<br>\r\nZip-code: {{ZIPCODE}}<br>\r\nDescription: {{DESCRIPTION}}<br>\r\nCurrency: {{CURRENCY}}<br>', '2020-04-28 00:00:00', '2021-11-02 08:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 1, NULL, NULL),
(3, 1, NULL, NULL),
(4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faq_translation`
--

CREATE TABLE `faq_translation` (
  `id` bigint(20) NOT NULL,
  `faq_id` int(11) DEFAULT NULL,
  `language_code` varchar(60) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text,
  `status` enum('0','1','3') NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 3=>Delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faq_translation`
--

INSERT INTO `faq_translation` (`id`, `faq_id`, `language_code`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'What is Lorem Ipsum?', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '1', '2021-07-30 13:17:17', '2022-06-09 07:09:18'),
(2, 1, 'da', 'Why do we use it?', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)</p>', '1', '2021-07-30 13:17:17', '2022-06-09 07:09:18'),
(3, 2, 'en', 'Where does it come from?', '<p style=\"text-align:justify\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>', '1', '2021-07-30 13:18:24', '2021-07-30 14:16:46'),
(4, 2, 'da', 'Where can I get some?', '<p><span style=\"background-color:rgb(255, 255, 255); font-family:open sans,arial,sans-serif; font-size:14px\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</span></p>', '1', '2021-07-30 13:18:24', '2021-07-30 14:16:46'),
(5, 3, 'en', 'df hggh', '<p>hbd hdhfiugduog odhi&nbsp;</p>', '1', '2022-04-04 10:50:48', NULL),
(6, 3, 'da', 'dfg dhghoset', '<p>dfigh 9dhgohd hgiudhgdgnbdt</p>', '1', '2022-04-04 10:50:48', NULL),
(7, 4, 'en', 'dfg gfdhg test', '<p>df gdg d</p>', '1', '2022-04-04 10:54:44', '2022-04-04 12:36:51'),
(8, 4, 'da', 'dfg  dfg', '<p> dg iu hiud ghushghsihrit srty rtu kos hgs hgj hh ti h</p>', '1', '2022-04-04 10:54:44', '2022-04-04 12:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `gas_cylinder`
--

CREATE TABLE `gas_cylinder` (
  `id` int(11) NOT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` enum('0','1','3') DEFAULT NULL COMMENT '''0''=>Inactive,''1''=Active,''3''=>''Delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gas_cylinder`
--

INSERT INTO `gas_cylinder` (`id`, `weight`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, '12', 1200, 'KAEfNcI3yFPi56DtOh1r.png', '1', '2022-08-25 01:02:34', NULL),
(4, '35', 500, '58lWn4XZ026GPd7zvU4x.png', '1', '2022-08-25 02:01:33', NULL),
(5, '12', 500, 'Poh7smRp5eaNi5Ev6KAD.png', '3', '2022-09-30 12:42:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hire_fixers`
--

CREATE TABLE `hire_fixers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `description` longtext,
  `address` varchar(100) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `term_condition` varchar(20) DEFAULT NULL,
  `status` enum('0','1','2','3','4') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hire_fixers`
--

INSERT INTO `hire_fixers` (`id`, `name`, `email`, `phone`, `title`, `deadline`, `budget`, `description`, `address`, `zipcode`, `currency`, `term_condition`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Harry Jones', 'harry@mailinator.com', '1234567890', 'test', '2022-03-19', 121, 'oi g', 'california', '12345', NULL, NULL, '2', '2022-03-14 12:51:42', '2022-03-14 15:39:20'),
(2, 'Harry Jones', 'harryy@mailinator.com', '1234567890', 'ads', '2022-03-26', 15, 'asdf fs aga dger', 'california', '12712', 'USD', '1', '4', '2022-03-14 15:45:10', '2022-04-08 14:42:53'),
(3, 'Harry Jones', 'harryy@mailinator.com', '1234567890', 'hgdftghy', '2022-03-17', 10, 'tdyhgrdfth', 'california', '123456', 'USD', NULL, '2', '2022-03-15 11:09:22', '2022-04-05 08:18:39'),
(4, 'Harry Jones', 'harry@mailinator.com', '1234567890', '1234567890', '2022-04-06', 127, 'xvbfcbdfvvf fd g', 'california', '37996', 'USD', NULL, '3', '2022-04-05 08:08:28', '2022-06-09 16:44:29'),
(5, 'Harry Jones', 'harry@mailinator.com', '1234567890', 'hghg', '2022-04-23', 127, 'g huihuogoho', 'california', '127', 'Dkk', NULL, '3', '2022-04-13 08:21:38', '2022-06-09 16:44:29'),
(6, 'Harry Jones', 'harry@mailinator.com', '1234567890', 'gwueygfuygf', '2022-04-29', 127, 'fh iweuwuefe igwiifuwi efwg fuigfy ejgvds hjgdsfyugh s riuyh tiusfdhbvds hi sigu srihgteg', 'california', '127', 'USD', NULL, '3', '2022-04-13 09:22:19', '2022-06-09 16:42:32'),
(7, 'Harry Jones', 'harryy@mailinator.com', '1234567890', 'ddgh', '2022-05-07', 127, 'dgjh ughohdoghodgdoiuj oyh', 'california', '127', 'Euro', NULL, '1', '2022-04-13 10:47:43', '2022-04-13 10:47:43'),
(8, 'Harry Jones', 'harryy@mailinator.com', '1234567890', 'ddgh', '2022-05-07', 127, 'dgjh ughohdoghodgdoiuj oyh', 'california', '127', 'USD', NULL, '1', '2022-04-13 10:49:04', '2022-04-13 17:11:37'),
(9, 'Harry Jones', 'John123@mailinator.com', '1234567890', 'fkuyk', '2022-04-23', 100, 'kyfkukyfkjfdkd', 'california', '127', 'BTC', NULL, '1', '2022-04-14 07:28:46', '2022-04-14 07:28:46'),
(10, 'Jone', 'jone@mailinator.com', '123567890', 'ghfhhf', '2022-12-10', 100, 'jhfi hu uidfsu gudf gsd ifhg dsh ghsdf osho', 'jsdhf iuh gudshg hdiuge', '1245fd', 'Usd', NULL, '3', '2022-04-14 08:18:23', '2022-06-09 16:41:10'),
(11, 'Jone', 'jone@mailinator.com', '123567890', 'ghfhhf', '2022-12-10', 100, 'jhfi hu uidfsu gudf gsd ifhg dsh ghsdf osho', 'jsdhf iuh gudshg hdiuge', '1245fd', 'Usd', NULL, '3', '2022-04-14 08:19:16', '2022-06-09 16:40:55'),
(12, 'Jone', 'malay.karmakar@infoway.us', '123567890', 'ghfhhf', '2022-12-10', 100, 'jhfi hu uidfsu gudf gsd ifhg dsh ghsdf osho', 'jsdhf iuh gudshg hdiuge', '1245fd', 'Usd', NULL, '1', '2022-04-14 08:20:35', '2022-04-14 08:20:35'),
(13, 'Harry Jones', 'John123@mailinator.com', '1234567890', 'hh', '2022-05-01', 100, 'htrfthdh', 'california', '1235', 'USD', NULL, '3', '2022-04-14 12:14:19', '2022-06-09 16:40:35'),
(14, 'Harry Jones', 'malay.karmakar@infoway.us', '1234567890', 'ty ty', '2022-04-29', 150, 'rth yr jthrtph pjhrjth', 'california', '127', 'Usd', NULL, '1', '2022-04-14 12:23:13', '2022-04-14 12:23:13'),
(15, 'Harry Jones', 'malay.karmakar@infoway.us', '1234567890', 'dfg df', '2022-04-30', 10, 'dfg  iodj gijoi jgh', 'california', '123456', 'Usd', NULL, '1', '2022-04-25 07:23:40', '2022-04-25 07:23:40'),
(16, 'Harry Jones', 'malay.karmakar@infoway.us', '1234567890', 'hfgy', '2022-04-30', 12, 'jh jghuhdguhui ghurd hguhuh rgudh gd', 'california', '12714', 'Euro', NULL, '1', '2022-04-25 07:47:59', '2022-04-25 07:47:59'),
(17, 'Harry Jones', 'harry@mailinator.com', '1234567890', 'test', '2022-07-01', 10, 'kdfhdljf', 'california', '127', 'Euro', '1', '4', '2022-06-02 08:04:36', '2022-06-09 16:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `multilinguals`
--

CREATE TABLE `multilinguals` (
  `id` int(11) NOT NULL,
  `lang` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lang_code` char(5) CHARACTER SET utf8 DEFAULT NULL,
  `currency_code` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `currency_symbol` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `status` enum('0','1','3') CHARACTER SET utf8 NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `multilinguals`
--

INSERT INTO `multilinguals` (`id`, `lang`, `lang_code`, `currency_code`, `currency_symbol`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'USD', '$', '1', '2021-02-16 00:00:00', '2021-02-16 00:00:00'),
(3, 'Bangali', 'bn', 'BDT', '৳', '1', '2021-02-16 00:00:00', '2021-02-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `requestfiles`
--

CREATE TABLE `requestfiles` (
  `id` int(11) NOT NULL,
  `request_type` enum('1','2') NOT NULL DEFAULT '1',
  `request_id` int(11) DEFAULT NULL,
  `file_type` int(11) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `is_default` int(11) DEFAULT NULL,
  `status` enum('0','1','3') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requestfiles`
--

INSERT INTO `requestfiles` (`id`, `request_type`, `request_id`, `file_type`, `file_name`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 1, 1, 'tXm0MFQiRDYpdAsL6C6w1vTqe0k9J9NUz57WBf2EOGKy3a47241647026980.jpg', 0, '3', '2022-03-11 19:29:53', '2022-03-14 15:34:25'),
(2, '1', 1, 1, 'RbuGTWo6AjsdLf8O05JeIYhVKD0cPwx37EtlZ22H97r1Qg1pFv1647026993.png', 0, '3', '2022-03-11 19:29:54', '2022-03-14 15:34:25'),
(3, '1', 1, 1, 'BSDa6Z6gjpePKNJEl14tI4TyLuO92As7Yw3ioMmQVc41Wx86GX1647026994.jpg', 0, '3', '2022-03-11 19:30:01', '2022-03-14 15:34:25'),
(4, '1', 2, NULL, 'CSfE4xOs7j2BT58dA0cJ6yizm56V71ZH4qQgNpYvhetDUwP9KL1647065422.jpg', NULL, '3', '2022-03-12 06:11:10', '2022-06-09 16:33:59'),
(5, '1', 3, 1, 'Y7B6aN97m40li1FLGdkHy0W0JuDzg2SqA0sMKRpvQXUEO4xrwc1647067001.png', 0, '1', '2022-03-12 06:36:41', '2022-03-12 06:36:41'),
(6, '1', 4, 1, 'yF3wNhHA7ERB47cd1MOjPzlJv9brTW8u1U50Xk0qS6aiKLZYDp1647071783.png', 0, '1', '2022-03-12 07:56:26', '2022-03-12 07:56:26'),
(7, '1', 5, 1, '548174ec8V7Cf9vtzUabkJXR1O0YKgBpAdq3LyHZihTM71ru2I1647071818.jpg', 0, '1', '2022-03-12 07:57:05', '2022-03-12 07:57:05'),
(8, '1', 6, 1, 'fxE2cl50P7sTQLyWjA0n51tGkZ9OMqr78hwpS4CF0DBvY6Vgmb1647075040.png', 0, '3', '2022-03-12 08:50:42', '2022-06-09 16:42:32'),
(9, '1', 7, 1, 'xD7drQn71feCh49ZiL3ozG6EW5Us8MBv0u4A9qmytagw06RTXl1647086399.png', 0, '1', '2022-03-12 12:00:01', '2022-03-12 13:49:15'),
(10, '1', 7, 1, 'oK0MLvZJU673Ie04Vj4ScA1HunW66wtrgzQPlk482qR5EDi1Cy1647086401.png', 0, '1', '2022-03-12 12:00:06', '2022-03-12 13:49:15'),
(11, '2', 1, 1, 'dI3H7vJjOtxgBNl7V3ryXpGwkMfWo140aZCsP2RiKTe2ESn6Fb1647262302.png', 0, '1', '2022-03-14 12:51:43', '2022-03-14 15:39:20'),
(12, '2', 2, NULL, '5uY8106EZ6kdW7Vv3q2rQot5nLsy6bg9FMz4UN4pACP7JxIwKB1647272654.jpg', NULL, '3', '2022-03-14 15:45:10', '2022-06-09 16:33:59'),
(13, '1', 2, NULL, 'i4E7L4Zc2yWkDu5m1VYI29AX2QqbtgfndRJG97l6OpoK6rjS8x1647272916.jpg', NULL, '3', '2022-03-14 15:48:41', '2022-06-09 16:33:59'),
(14, '2', 2, NULL, 'Wk6BYNeLxv4P40Vj9i2lgZAs1h5bJcXGpDIOfm3U7wKuSn13Ea1647273749.jpg', NULL, '3', '2022-03-14 16:02:33', '2022-06-09 16:33:59'),
(15, '2', 3, 1, '0yQ5vzhkmDuA64YgonV7Xs6B5i3WCLfdpxH2c173TIOGPlwZF41647342563.png', 0, '1', '2022-03-15 11:09:26', '2022-04-05 08:18:39'),
(16, '1', 8, 1, 'eUWGNXTOjH7xLc14J48ISRV6wtp8z6K48dn0kgYyr2Ab99Qsvm1648998764.png', 0, '3', '2022-04-03 15:12:44', '2022-06-09 16:33:33'),
(17, '1', 9, 1, 'zywa1Ir73FYpA1h4X3dS4xNEtsjZD9cBHmvV09lnK0Ok09WPJe1649000391.jpg', 0, '1', '2022-04-03 15:39:53', '2022-04-03 15:39:53'),
(18, '2', 4, 1, '4HJATBVntZEswvNF1Xcqy79zYaru0K4pLC43DdR5MP0ebGO6i21649146109.png', 0, '1', '2022-04-05 08:08:30', '2022-04-05 08:08:30'),
(19, '2', 6, NULL, 'Pp9jmfMNt1lzx0Jd841AOG93IY5Q7wkLVX1EH47r2RC4nSbqgy1649842471.jpg', NULL, '3', '2022-04-13 09:35:01', '2022-06-09 16:42:32'),
(20, '2', 8, 1, 'ZD1V4oLMW6B84FscX2jl46Y9d98NtG9AT1gy7KI034PxhbUmqw1649846944.xlsx', 0, '3', '2022-04-13 10:49:04', '2022-06-09 16:33:33'),
(21, '2', 8, NULL, 'Wz217CDlBEG46dIRKaLXuSNHeT14pP56tV9whg0q9Z9s1jAor71649919972.pdf', NULL, '3', '2022-04-14 07:06:15', '2022-06-09 16:33:33'),
(22, '2', 9, 1, '6g93SFG62Vrs0WP1h5tMcz9Jm9N1uxTfpv2kA2aQnDOiBdLKZR1649921326.xlsx', 0, '1', '2022-04-14 07:28:46', '2022-04-14 07:28:46'),
(23, '2', 11, 1, 'M9lvGfyg0Aw94K26XcVurDQ7m45npaR6EWJ13ibUe5HLT6osd11649924356.xlsx', 0, '3', '2022-04-14 08:19:16', '2022-06-09 16:40:55'),
(24, '2', 11, 1, 'lQHo2dq14U7rtiE9W6484Dc1aV5Bh3S5FjLMpgyJT09uI3sXPA1649924357.pdf', 0, '3', '2022-04-14 08:19:17', '2022-06-09 16:40:55'),
(25, '2', 12, 1, 'eZt3b6K9NMUrvXFdkY98lfLPo7x4s6V9ygn44uBGw1hpAj2aWT1649924435.xlsx', 0, '1', '2022-04-14 08:20:35', '2022-04-14 08:20:35'),
(26, '2', 12, 1, '59TR9wgKN1QZ3o4xAesSaYtLjDhPXpl4bkVMy06iHW48FmBv251649924435.pdf', 0, '1', '2022-04-14 08:20:35', '2022-04-14 08:20:35'),
(27, '2', 13, 1, '7mjvXn5L8wF4PbtcCYzxW09i5pZoE9RIVOM9aBTJuN4s4QSgA61649938459.xlsx', 0, '3', '2022-04-14 12:14:20', '2022-06-09 16:40:35'),
(28, '2', 13, 1, 'Al41hbu8f0m6NjKCpPqLOw7eo9G5tyYsr4zMR8dB3xZ9DJ0UcS1649938460.xlsx', 0, '3', '2022-04-14 12:14:20', '2022-06-09 16:40:35'),
(29, '2', 13, NULL, 'I5fHU3vWzAP1diTVZpchBbyJ4m3tqs2GL8N4MDlea5wr486So91649938854.doc', NULL, '3', '2022-04-14 12:21:16', '2022-06-09 16:40:35'),
(30, '2', 14, 1, 'nQE0FUcJexsogHTul73thXabIAd9pRizZ1NGkB2w4VM4D568r91649938993.csv', 0, '1', '2022-04-14 12:23:13', '2022-04-14 12:23:13'),
(31, '2', 14, 1, '9o1KnTN3M9vblgkH9I3YXBE0QhrDCtyqwzc3jfU19O4pa526RW1649938993.txt', 0, '1', '2022-04-14 12:23:13', '2022-04-14 12:23:13'),
(32, '2', 16, 1, 'U8bGCA77De21jwaES647sFHqdfBk2iWXv365KPt9RJQ0Oc8I8Z1650872879.jpg', 0, '1', '2022-04-25 07:47:59', '2022-04-25 07:47:59'),
(33, '2', 16, 1, 'CczL68f84v5m1K01g92wMsHRy5JEBd2pGxY6Ukl8NqVZrI9bFT1650872879.jpg', 0, '1', '2022-04-25 07:47:59', '2022-04-25 07:47:59'),
(34, '1', 11, 1, 'JKNsAL7opxi01eDQzFvO6cTHS333GVMPCEZgXa8w9jrYtdWqn51650873503.jpg', 0, '3', '2022-04-25 07:58:23', '2022-06-09 16:40:55'),
(35, '1', 11, 1, '6oXwFO05TIYPVMlGs5d338Jhnt7fRzHgjUr2qey3Qk8Zi1D9C51650873503.png', 0, '3', '2022-04-25 07:58:23', '2022-06-09 16:40:55');

-- --------------------------------------------------------

--
-- Table structure for table `requrirements`
--

CREATE TABLE `requrirements` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `description` longtext,
  `category` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `term_condition` varchar(20) DEFAULT NULL,
  `status` enum('0','1','2','3') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requrirements`
--

INSERT INTO `requrirements` (`id`, `name`, `email`, `phone`, `title`, `deadline`, `budget`, `description`, `category`, `address`, `zipcode`, `term_condition`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Harry Jones', 'harry@mailinator.com', '1234567890', 'test', '2022-03-19', 121, 'oi g', '1,2', 'california', '12345', NULL, '3', '2022-03-11 19:29:40', '2022-06-09 16:42:13'),
(2, 'Harry Jones', 'harry@mailinator.com', '1234567890', 'sfsd', '2022-03-24', 100, 'dsfsd s sdg gsd', NULL, 'california', '127', '1', '3', '2022-03-12 06:11:10', '2022-06-09 16:33:59'),
(3, 'Harry Jones', 'harryy@mailinator.com', '1234567890', NULL, NULL, NULL, 'sdf g dhuh', '1,2', 'california', '127123', NULL, '3', '2022-03-12 06:36:41', '2022-06-09 16:42:13'),
(4, 'Harry Jones', 'harryy@mailinator.com', '1234567890', NULL, NULL, NULL, 'rgds rfyhrt', '1,2', 'california', '127123', NULL, '1', '2022-03-12 07:56:23', '2022-03-12 07:56:23'),
(5, 'Harry Jones', 'harry@mailinator.com', '1234567890', NULL, NULL, NULL, 'dh sh', '1', 'california', '127123', NULL, '1', '2022-03-12 07:56:58', '2022-03-12 07:56:58'),
(6, 'Harry Jones', 'harryy@mailinator.com', '1234567890', NULL, NULL, NULL, 'gf dfjgoijhg df', '1', 'california', '127123', NULL, '1', '2022-03-12 08:50:40', '2022-03-12 08:50:40'),
(7, 'Harry Jones', 'harry@mailinator.com', '1234567890', 'asd', '2022-03-25', 10, 'dfg d fd hh', '1', 'california', '127123', NULL, '2', '2022-03-12 11:59:59', '2022-03-12 13:49:14'),
(8, 'Harry Jones', 'harry@mailinator.com', '1234567890', NULL, NULL, NULL, 'jkfg kkdfg udhhgdfg', '1', 'california', '12748', NULL, '3', '2022-04-03 15:12:44', '2022-06-09 16:33:33'),
(9, 'Harry Jones', 'harry@mailinator.com', '1234567890', NULL, NULL, NULL, 'dfs gs gs g', '2', 'california', '12766', NULL, '1', '2022-04-03 15:39:51', '2022-04-03 15:39:51'),
(10, 'Harry Jones', 'malay.karmakar@infoway.us', '1234567890', NULL, NULL, NULL, 'jh uho ho jfoi odgodj oi', '1', 'california', '127465', NULL, '3', '2022-04-25 07:56:25', '2022-06-09 16:29:18'),
(11, 'Harry Jones', 'malay.karmakar@infoway.us', '1234567890', NULL, NULL, NULL, 'df gdi jgidgd', '2', 'california', '127', NULL, '1', '2022-04-25 07:58:23', '2022-04-25 07:58:23');

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `id` bigint(20) NOT NULL,
  `route` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `keyword` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `type` set('text','textarea','password','select','select-multiple','radio','checkbox','file') CHARACTER SET utf8 DEFAULT NULL,
  `default` text CHARACTER SET utf8,
  `value` text CHARACTER SET utf8,
  `options` text CHARACTER SET utf8,
  `is_required` tinyint(1) DEFAULT NULL,
  `is_gui` tinyint(1) DEFAULT NULL,
  `module` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `row_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `slug`, `title`, `description`, `type`, `default`, `value`, `options`, `is_required`, `is_gui`, `module`, `row_order`) VALUES
(1, 'contact_number', 'Contact Number', 'Store contact number', 'text', '+606 2823585', '+1234567890', '', 1, 1, 'General', 1),
(2, 'facebook_url', 'Facebook', 'Facebook url', 'text', 'https://www.facebook.com/', 'https://www.facebook.com/nocurenopay', '', 1, 1, 'Social Link', 3),
(3, 'twitter_url', 'Twitter', 'Twitter url', 'text', 'https://twitter.com/', 'https://twitter.com/nocurenopay', '', 1, 1, 'Social Link', 4),
(4, 'instra_url', 'Instagram', 'Instagram url', 'text', 'https://www.instagram.com/', 'https://www.instagram.com/nocurenopay', '', 1, 1, 'Social Link', 6),
(5, 'youtube_url', 'Youtube Url', 'Youtube Url', 'text', 'https://www.youtube.com/', 'https://www.youtube.com/nocurenopay', '', 1, 1, 'Social Link', 5),
(6, 'contact_email', 'Contact Email', 'Site Contact Email', 'text', 'admin@nyssefregistration.com', 'admin@nocurenopay.com', NULL, 1, 1, 'General', 2),
(7, 'contact_address', 'Contact Address', 'Site Contact Address', 'text', 'Gartenhof 116\r\n5056 Attelwil', 'Gartenhof 1165056 Attelwil', NULL, 1, 1, 'General', 3);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rating` int(1) DEFAULT NULL,
  `status` enum('0','1','3') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `location`, `image`, `description`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Harry Jones', 'california', 'rYHB3bXv54A99ds8h7WTS8yxKaiIeP6w4p8OUDfNQt6nq3EgkM1649338587.jpg', 'fg isidfgosifksfkgskuyg ukysg gs gsgisug uosguo suohg usg uurdg iuhru gruh ougsg', 3, '1', '2022-04-07 13:36:29', '2022-04-07 13:36:29'),
(2, 'jones Brown', NULL, '8bS5wyv3GYHl7edz87Ls2Jk6aEUA6NOgx0iZmI19o16PMhBRjq1649338726.jpg', 'kjfh igsiuf hsul fisig sg', 1, '1', '2022-04-07 13:38:47', '2022-04-07 13:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` bigint(20) NOT NULL,
  `type_id` enum('1','2') CHARACTER SET utf8 DEFAULT NULL COMMENT '1=>''Admin'',2=''Customer''',
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `cover_image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `gender` enum('M','F','O') CHARACTER SET utf8 DEFAULT NULL COMMENT '''M''=>''Male'',''F''=>''Female'',''O''=>''Other''',
  `dob` date DEFAULT NULL,
  `about_me` text CHARACTER SET utf8,
  `address_line1` text CHARACTER SET utf8,
  `category` bigint(20) DEFAULT NULL,
  `city` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `zipcode` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `timezone` int(11) DEFAULT NULL,
  `location` varchar(55) DEFAULT NULL,
  `active_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `reset_password_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email_verification` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>Not Verified,1=>Verififed,3=>Rejected',
  `remark` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `login_type` enum('1','2','3','') CHARACTER SET utf8 DEFAULT NULL COMMENT '1=>FACEBOOK,2=>Google,3=>Email',
  `ip_address` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `status` enum('0','1','2','3') CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '0=>Inactive, 1=>Active, 2=>Suspend, 3=>Delete',
  `request_status` enum('Open','Assign') NOT NULL DEFAULT 'Open',
  `last_online_at` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `type_id`, `type`, `username`, `name`, `first_name`, `last_name`, `email`, `password`, `phone`, `profile_picture`, `cover_image`, `gender`, `dob`, `about_me`, `address_line1`, `category`, `city`, `state`, `zipcode`, `country`, `language`, `timezone`, `location`, `active_token`, `reset_password_token`, `remember_token`, `email_verification`, `remark`, `last_login`, `login_type`, `ip_address`, `status`, `request_status`, `last_online_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, 'admin', 'Super Admin', 'Super', 'Admin', 'admin@admin.com', '$2y$10$Vr9MaPAKSEjc9wvyDrl0MOmtaG/ceO.D8xm91VyTSKro2qoYmpRWu', NULL, 'W9etNoCqD6bQ.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Z7DzxcpWHBQssJsy8DVo3NkShlfQy7HN64ytRYOwRtjFC8TprfSPpb6tLGFh', 0, NULL, '2022-11-07 05:11:48', NULL, NULL, '1', 'Open', NULL, NULL, NULL, '2019-01-01 00:00:00', '2022-11-07 05:11:48'),
(3, '2', 'Company', NULL, 'infoway tech', NULL, NULL, 'harry@mailinator.com', '$2y$10$IoqrNYhH7T52fqOcKLOd3OO67ZF7zWo9oNT9cLw8KvUT7pRga/tCS', '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, NULL, NULL, 0, NULL, NULL, NULL, '::1', '3', 'Open', NULL, 1, NULL, '2022-03-04 07:45:38', '2022-03-21 12:45:45'),
(4, '2', 'Indiviual', NULL, '10 West Advisors, Inc.', NULL, NULL, 'John@mailinator.com', '$2y$10$nOWZmtB1LuDfulqtYvLO3O1/s/itay18t5fOwXiIQN1po1RDM18NK', '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'test2', NULL, NULL, NULL, 0, NULL, NULL, NULL, '::1', '1', 'Open', NULL, 1, NULL, '2022-03-04 08:06:18', '2022-03-04 08:41:38'),
(5, '2', 'Indiviual', NULL, '10 West Advisors, Inc.', NULL, NULL, 'harryy@mailinator.com', '$2y$10$cgDKtv5fyy1IZu/PhdIp6.UQ/v3v6GHV51uP37JbsC0mZJ8nfTh0K', '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'africa', NULL, NULL, NULL, 0, NULL, NULL, NULL, '::1', '1', 'Assign', NULL, 1, NULL, '2022-03-10 16:52:13', '2022-04-08 14:10:52'),
(6, '2', 'Indiviual', NULL, 'test school', NULL, NULL, 'John123@mailinator.com', '$2y$10$YvZ1FiRiIwqXwlmDd81M8.tGtAn/MQS2PlitVmsxNtPNB8U437YyO', '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'africa', NULL, NULL, NULL, 0, NULL, NULL, NULL, '::1', '1', 'Open', NULL, 1, NULL, '2022-04-11 10:33:18', '2022-04-26 03:35:24'),
(7, '2', 'Indiviual', NULL, 'tesst', NULL, NULL, 'jones@mailinator.com', '$2y$10$4e.55xpSdjXPE2pGFj5ZquA0dDRc/33NWGY9xz4BbKJSzHEsvtVSW', '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'africa', NULL, NULL, NULL, 0, NULL, NULL, NULL, '::1', '1', 'Open', NULL, 1, NULL, '2022-06-15 16:33:41', '2022-06-15 16:33:41'),
(8, '2', 'Company', NULL, 'dsfsdg', NULL, NULL, 'test@mailinator.com', '$2y$10$0W7fvVB0vPEW0jNCraZ3bOeFg2xAvEGXYQTuJncxCAzURn1tv.R4m', '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'test2', NULL, NULL, NULL, 0, NULL, NULL, NULL, '::1', '1', 'Open', NULL, 1, NULL, '2022-06-15 16:42:54', '2022-06-15 16:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'Admin'),
(2, 'Service Provider');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_service_provider`
--
ALTER TABLE `assign_service_provider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories_translation`
--
ALTER TABLE `categories_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_translation`
--
ALTER TABLE `cms_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_translation_bk`
--
ALTER TABLE `cms_translation_bk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_translation_multi`
--
ALTER TABLE `cms_translation_multi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cylinder_orders`
--
ALTER TABLE `cylinder_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealership_opportunity`
--
ALTER TABLE `dealership_opportunity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_bk`
--
ALTER TABLE `email_bk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_translation`
--
ALTER TABLE `faq_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gas_cylinder`
--
ALTER TABLE `gas_cylinder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hire_fixers`
--
ALTER TABLE `hire_fixers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multilinguals`
--
ALTER TABLE `multilinguals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requestfiles`
--
ALTER TABLE `requestfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requrirements`
--
ALTER TABLE `requrirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_service_provider`
--
ALTER TABLE `assign_service_provider`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories_translation`
--
ALTER TABLE `categories_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cms_translation`
--
ALTER TABLE `cms_translation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `cms_translation_bk`
--
ALTER TABLE `cms_translation_bk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cms_translation_multi`
--
ALTER TABLE `cms_translation_multi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `cylinder_orders`
--
ALTER TABLE `cylinder_orders`
  MODIFY `id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dealership_opportunity`
--
ALTER TABLE `dealership_opportunity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `email_bk`
--
ALTER TABLE `email_bk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faq_translation`
--
ALTER TABLE `faq_translation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gas_cylinder`
--
ALTER TABLE `gas_cylinder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hire_fixers`
--
ALTER TABLE `hire_fixers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `multilinguals`
--
ALTER TABLE `multilinguals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requestfiles`
--
ALTER TABLE `requestfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `requrirements`
--
ALTER TABLE `requrirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
