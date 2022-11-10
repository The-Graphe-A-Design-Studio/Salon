-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2022 at 02:51 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_pass`) VALUES
(1, 'Divya', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`s_id`, `s_name`) VALUES
(1, 'Body Treatment'),
(2, 'Bridal Spa'),
(3, 'Dance Fitness'),
(4, 'Express Fitness'),
(5, 'Eye'),
(6, 'Face'),
(7, 'Fitness'),
(8, 'Gold well Hair Treatments'),
(9, 'Hair'),
(10, 'Massage'),
(11, 'Nails'),
(12, 'Other Income'),
(13, 'Premium Fitness'),
(14, 'Prom Package'),
(15, 'Thalgo Facial'),
(16, 'Vie Collection Facial'),
(17, 'Waxing');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` int(11) NOT NULL,
  `c_code` varchar(10) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `c_name` varchar(200) NOT NULL,
  `c_ticket` varchar(200) NOT NULL,
  `c_phone` varchar(200) NOT NULL,
  `c_date` date NOT NULL,
  `c_q1` int(11) NOT NULL,
  `c_q2` int(11) NOT NULL,
  `c_q3` int(11) NOT NULL,
  `c_q4` int(11) NOT NULL,
  `c_q5` int(11) NOT NULL,
  `c_q6` int(11) NOT NULL,
  `c_q7` int(11) NOT NULL,
  `c_comment` varchar(500) NOT NULL DEFAULT 'No comment',
  `c_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Link not generated; 1: Reviewed; 2: Pending',
  `c_return` int(11) NOT NULL DEFAULT 0 COMMENT '1 = Definitely; 2 = Maybe; 3 = Definitely Not',
  `reg` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `c_code`, `branch_id`, `c_name`, `c_ticket`, `c_phone`, `c_date`, `c_q1`, `c_q2`, `c_q3`, `c_q4`, `c_q5`, `c_q6`, `c_q7`, `c_comment`, `c_status`, `c_return`, `reg`) VALUES
(1, '7twZUqT', 1, 'Rohit Singh', '345354', '9876787656', '2022-11-10', 0, 0, 0, 0, 0, 0, 0, 'No comment', 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cust_name_phone`
--

CREATE TABLE `cust_name_phone` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `cust_phone` varchar(50) NOT NULL,
  `whatsapp_num` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `anniversary` date DEFAULT NULL,
  `work_phone` varchar(50) DEFAULT NULL,
  `qatar_id` varchar(100) DEFAULT NULL,
  `address_1` varchar(150) DEFAULT NULL,
  `address_2` varchar(150) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `others` text DEFAULT NULL,
  `reg` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cust_name_phone`
--

INSERT INTO `cust_name_phone` (`cust_id`, `cust_name`, `last_name`, `cust_phone`, `whatsapp_num`, `email`, `birthday`, `anniversary`, `work_phone`, `qatar_id`, `address_1`, `address_2`, `city`, `zip`, `state`, `country`, `others`, `reg`) VALUES
(1, 'Rohit', 'Singh', '9876787656', '6765678986', 'rohit@thegrpahge.com', '1994-08-01', '1994-08-01', '4785452369', 'UYEUYGE', 'kjbvkd', 'lkdlk', 'ikher', 'dfhdfkj', 'dfbhikdfb', 'ikhbnvkf', 'dfbdfbdfb', 1);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `l_id` int(11) NOT NULL,
  `l_name` varchar(200) NOT NULL,
  `l_address` text NOT NULL,
  `l_phone` varchar(100) NOT NULL,
  `l_pass` varchar(200) NOT NULL DEFAULT '123456',
  `l_pass_enc` varchar(200) NOT NULL DEFAULT 'e10adc3949ba59abbe56e057f20f883e'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`l_id`, `l_name`, `l_address`, `l_phone`, `l_pass`, `l_pass_enc`) VALUES
(1, 'Royal Plaza Branch', '2nd Floor (Opposite Oishi\r\nSushi Restaurant) Al Sadd', '+97444326927', '123456', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Al Gharafa Branch', 'Villa 134, Street 567 (Opposite Al Meera)', '+97444811488', '123456', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'Gate Mall Branch', 'First Floor, Inside Al Salam Stores', '+97444077117', '123456', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'The Pearl Branch', 'Quanat Quartier at the Pearl - Qatar', '+97444771723, +97466576010', '123456', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Tawar Mall Branch', 'Tawar Mall, Ground Floor, Entrance 2', '+97444802830', '123456', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `review_form`
--

CREATE TABLE `review_form` (
  `re_id` int(11) NOT NULL,
  `c_code` varchar(10) NOT NULL COMMENT 'customer code',
  `l_id` int(11) NOT NULL COMMENT 'branch id',
  `s_id` int(11) NOT NULL COMMENT 'category id',
  `se_id` int(11) NOT NULL COMMENT 'service id',
  `st_id` int(11) NOT NULL COMMENT 'staff id',
  `rating` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review_form`
--

INSERT INTO `review_form` (`re_id`, `c_code`, `l_id`, `s_id`, `se_id`, `st_id`, `rating`) VALUES
(1, 'MucUnPd', 1, 1, 98, 14, 0),
(2, 'NAgyp4M', 1, 1, 98, 14, 0),
(3, 'hzPFT27', 1, 11, 280, 21, 0),
(4, 'hzPFT27', 1, 16, 342, 29, 0),
(5, '7twZUqT', 1, 11, 280, 21, 0),
(6, '7twZUqT', 1, 16, 342, 29, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `se_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `se_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`se_id`, `s_id`, `se_name`) VALUES
(85, 1, 'Sea Salt Exfoliation'),
(86, 1, 'Organic Honey & Sugar Body Polish'),
(87, 1, 'Hammam Demashqi'),
(88, 1, 'Add on: Paraffin'),
(89, 1, 'Add on: Hand or Foot Scrub'),
(90, 1, 'Sublime Body Wrap'),
(91, 1, 'Cleopatra Milk Bath'),
(92, 1, 'Dead Sea Revitalizer'),
(93, 1, 'Pebbles Bath'),
(94, 1, 'Add on: Healing Mask'),
(95, 1, 'Busy Bee Diva'),
(96, 1, 'Back Facial'),
(97, 1, 'Hammam Maghrebi'),
(98, 1, '1001 Hammam Ritual'),
(99, 2, 'Bridal Moroccan Hammam'),
(100, 2, 'Royal Bridal Hammam'),
(101, 2, 'Floral Whitening Milk Bath'),
(102, 2, 'Oxygen Facial'),
(103, 2, 'Glowing Facial'),
(104, 2, 'Dermatologique Facial Treatment'),
(105, 2, 'Caviar Facial'),
(106, 2, 'D\'Or 24K Facial'),
(107, 2, 'Eye Cellular Program'),
(108, 2, 'Decolette Facial Treatment'),
(109, 2, 'Back Facial Treatment'),
(110, 2, 'Facial Massage'),
(111, 2, 'Zen Massage'),
(112, 2, 'Volcanic Stone Massage'),
(113, 2, 'Blanc Spa Mani/pedi'),
(114, 2, 'Bridal Spa Mani/Padicure'),
(115, 2, 'Argan Oil Hair Treatment'),
(116, 2, 'Aloe Vera Hair Treatment'),
(117, 2, 'Bridal Sculpting & Slimming Treatment'),
(118, 2, 'Bridal Make Up'),
(119, 2, 'Bridal Hair Styling'),
(120, 2, 'Other Income'),
(121, 3, 'Zumba'),
(122, 3, 'Belly Dance'),
(123, 4, 'Body Tone'),
(124, 5, 'Eyelash Extension - Full Set'),
(125, 5, 'Strip Lash Application'),
(126, 6, 'Pure Vitamin C Facial'),
(127, 6, 'Eyelash Perm Lifting'),
(128, 6, 'Collagen Crystal Eye Mask'),
(129, 6, 'Gold Collagen Crystal Eye Mask'),
(130, 6, 'Hyaluronic Treatment'),
(131, 6, 'Eyelash Extension Refill - Individual '),
(132, 6, 'Add on: Facial Extraction'),
(133, 6, 'Smokey Make Up'),
(134, 6, 'Source Marine Ritual'),
(135, 6, 'Silicium Facial'),
(136, 6, 'Purity Facial'),
(137, 6, 'Oxy Pollution Rescue'),
(138, 6, 'Light Make Up'),
(139, 6, 'Cold Marine Ritual'),
(140, 6, 'Eye Expert Treatment'),
(141, 6, 'Diva Princess - Mini Facial'),
(142, 6, 'Collagen Infusion'),
(143, 6, 'Balancing Ritual'),
(144, 7, 'Zumba'),
(145, 7, 'Pilates - Group Session'),
(146, 7, 'Flow'),
(147, 7, 'Pilates - Personal Session'),
(148, 7, 'Personal20 EMS'),
(149, 7, 'Personal20 EMS Trail'),
(150, 8, 'DS Color Lock Serum'),
(151, 8, 'DS Blond/Highlight Color Lock Serum'),
(152, 8, 'DS Rich Repair Regeneration Serum'),
(153, 8, 'DS Curly Twist Enriching Serum'),
(154, 8, 'DS Scalp Specialist Anti Hair Loss Serum'),
(155, 8, 'DS Colour Extra Rich Intensive Treatment'),
(156, 8, 'DS Blonde & Highlight Intensive Treatment'),
(157, 8, 'DS Rich Repair 60 sec Treatment'),
(158, 8, 'DS Green 60 sec Treatment'),
(159, 9, 'Trimming - Very Long'),
(160, 9, 'High / Low Lights - Very Long'),
(161, 9, 'Cut - Very Long'),
(162, 9, 'Goldwell 60sec Treatment'),
(163, 9, 'Hairtalk Hair Extension Removal'),
(164, 9, 'Hairtalk Repositioning hair Extensions'),
(165, 9, 'Hairtalk Placing Hair Extensions'),
(166, 9, 'Small Hair Braiding - Very Long'),
(167, 9, 'Small Hair Braiding -  Long'),
(168, 9, 'Small Hair Braiding - Medium'),
(169, 9, 'Small Hair Braiding - Short'),
(170, 9, 'Thick Hair Braiding - Very Long'),
(171, 9, 'Thick Hair Braiding -  Long'),
(172, 9, 'Thick Hair Braiding - Medium'),
(173, 9, 'Thick Hair Braiding - Short'),
(174, 9, 'Phyto Repair Express'),
(175, 9, 'Fashion Colour - Very Long'),
(176, 9, 'Colour - Semi Permanent Very Long '),
(177, 9, 'Root Retouch with Ammonia Free'),
(178, 9, 'Anti-Hairloss Treatment'),
(179, 9, 'Essentia Detoxifying Treatment'),
(180, 9, 'Collagen Hair Straight - Long 3'),
(181, 9, 'Collagen Hair Straight - Long 2'),
(182, 9, 'Collagen Hair Straight - Long 1'),
(183, 9, 'Collagen Hair Straight - Medium 2'),
(184, 9, 'Collagen Hair Straight - Medium 1'),
(185, 9, 'Collagen Hair Straight - Small 2'),
(186, 9, 'Collagen Hair Straight - Small 1'),
(187, 9, 'Cut - Long'),
(188, 9, 'Botox Hair Treatment - Medium Thick'),
(189, 9, 'Hair Treatment - Lissceutic'),
(190, 9, 'Hair Treatment - Renew C'),
(191, 9, 'Pro Fiber Treatment - Reconstruct'),
(192, 9, 'Pro Fiber Treatment - Rectify'),
(193, 9, 'Hair Treatment - Fiberceutic'),
(194, 9, 'Wash/ Blow dry (Combo) Very Long'),
(195, 9, 'Blow Dry Very Long'),
(196, 9, 'Colour Permanent Very Long'),
(197, 9, 'Colour - Ammonia Free Very Long'),
(198, 9, 'Hair Style Formal Short'),
(199, 9, 'Hair Style Formal Very Long'),
(200, 9, 'Hair Style Formal Long'),
(201, 9, 'Wash/ Blow dry (Combo) Medium'),
(202, 9, 'Wash/ Blow dry (Combo) Long'),
(203, 9, 'Loreal Serioxyl Treatment'),
(204, 9, 'Pro Fiber Treatment Restore'),
(205, 9, 'Collagen Phyto Hair Repair'),
(206, 9, 'Hair Treatment - Aminexil'),
(207, 9, 'Deep Conditioning Hair Therapy 30 mins'),
(208, 9, 'Botox Hair Treatment - Short Thick'),
(209, 9, 'Botox Hair Treatment - Long Thick'),
(210, 9, 'Deep Conditioning Hair Therapy 60 mins'),
(211, 9, 'Hair Colour Ransage'),
(212, 9, 'Hair Treatment - Volumceutic'),
(213, 9, 'Hair Treatment - Force Refill'),
(214, 9, 'Hair Treatment - Keratin Refill'),
(215, 9, 'Hair Treatment - Power Repair Lipidium'),
(216, 9, 'Hair Treatment Fiberceutic'),
(217, 9, 'Fashion Colour - Long'),
(218, 9, 'Fashion Colour - Medium'),
(219, 9, 'Fashion Colour - Short'),
(220, 9, 'Wash (with cond) - Long'),
(221, 9, 'Wash (with cond) - Short/ Medium'),
(222, 9, 'High/ Low Lights Long'),
(223, 9, 'High/ Low Lights Medium'),
(224, 9, 'High/ Low Lights Short'),
(225, 9, 'Colour - Ammonia Free Long'),
(226, 9, 'Colour - Ammonia Free Medium'),
(227, 9, 'Colour - Ammonia Free Short'),
(228, 9, 'Root Retouch'),
(229, 9, 'Hair Style Formal Medium'),
(230, 9, 'Iron Styling - Long'),
(231, 9, 'Iron Styling - Short/Medium'),
(232, 9, 'Blow Dry Long'),
(233, 9, 'Blow Dry Medium'),
(234, 9, 'Blow Dry Short'),
(235, 9, 'Fringe/ Bangs'),
(236, 9, 'Trimming - Long'),
(237, 9, 'Trimming - Medium'),
(238, 9, 'Trimming - Short'),
(239, 9, 'Cut - Medium'),
(240, 9, 'Cut - Short'),
(241, 9, 'Wash/Cut/Blow dry (Combo) Long'),
(242, 9, 'Wash/Cut/Blow dry (Combo) Medium'),
(243, 9, 'Wash/Cut/Blow dry (Combo) Short'),
(244, 9, 'Add on: Hair Mask'),
(245, 9, 'Wash/ Blow Dry (Combo) Short'),
(246, 10, 'Hot Stones'),
(247, 10, 'Thai Aromatic 60 mins'),
(248, 10, 'Oriental Reflexology - 30 mins'),
(249, 10, 'Back, Neck & Shoulder Massage'),
(250, 10, 'Diva Teen Massage'),
(251, 10, 'Swedish Massage 90 mins'),
(252, 10, 'Foot Massage'),
(253, 10, 'Pre-Natal Massage'),
(254, 10, 'Add on: Fresh Face'),
(255, 10, 'Add on: Scalp Reviver'),
(256, 10, 'Lymphatic Drainage Massage'),
(257, 10, 'Diva Princess - Shoulder & Scalp Massage'),
(258, 10, 'Eastern Scalp Massage'),
(259, 10, 'Four Elements Massage'),
(260, 10, 'Hand Massage'),
(261, 10, 'Slim and Sculpt'),
(262, 10, 'Swedish Massage 60 mins'),
(263, 10, 'Thai Aromatic 90 mins'),
(264, 10, 'Traditional Thai 90 mins'),
(265, 10, 'Traditional Thai 60 mins'),
(266, 10, 'Kahraman Massage'),
(267, 10, 'Oriental Reflexology 60 mins'),
(268, 10, 'Diva Princess - Foot & Hand Massage'),
(269, 10, 'Four Hands Massage'),
(270, 10, 'Add on: Heavenly Hands'),
(271, 10, 'Add on: Happy Feet'),
(272, 10, 'Thai Herbal Massage'),
(273, 11, 'Dip & Buff Nail Art - set of 6 nails'),
(274, 11, 'Dip & Buff Nail Art - set of 4 nails'),
(275, 11, 'Dip & Buff Nail Refill - per nail'),
(276, 11, 'Dip & Buff Manicure - Removal'),
(277, 11, 'Dip & Buff Manicure - French'),
(278, 11, 'Dip & Buff Manicure - Color'),
(279, 11, 'Polish Change - Gel Couture'),
(280, 11, 'Add on: Gel Couture'),
(281, 11, 'Polish Change - Gel French'),
(282, 11, 'Gel French Pedicure'),
(283, 11, 'Gel French Manicure'),
(284, 11, 'Gel Soak Off'),
(285, 11, 'Gel Couture Pedicure'),
(286, 11, 'Gel Couture Manicure'),
(287, 11, 'Chrome Nail - Full Set'),
(288, 11, 'Chrome Nail - Per Nail'),
(289, 11, 'Medi Pedicure'),
(290, 11, 'Nail Extension - Artificial'),
(291, 11, 'Add on: Foot File'),
(292, 11, 'Diva Princess - File & Paint-Tips & Toes'),
(293, 11, 'Gel Manicure'),
(294, 11, 'French Manicure'),
(295, 11, 'French Pedicure'),
(296, 11, 'Acrylic Soak Off'),
(297, 11, 'Diva Teen Pedicure'),
(298, 11, 'Diva Teen Manicure'),
(299, 11, 'Gel Refill - Per Nail'),
(300, 11, 'Nail Art - Per Nail'),
(301, 11, 'Nail Shaping & Buffing'),
(302, 11, 'Polish Change - French'),
(303, 11, 'Polish Change - Classic'),
(304, 11, 'Callous Treatment'),
(305, 11, 'Gel Pedicure'),
(306, 11, 'Classic Pedicure'),
(307, 11, 'Classic Manicure'),
(308, 12, 'Fitness Room - Rent'),
(309, 13, 'Yoga'),
(310, 13, 'Trampoline Burn'),
(311, 13, 'Pilates'),
(312, 14, 'Dance & Glitter - Make Up Only'),
(313, 14, 'Dance & Glitter - Polish Me'),
(314, 14, 'Dance & Glitter - Hairstyling'),
(315, 14, 'Dance & Glitter - Eye Make Up'),
(316, 15, 'Express Facial'),
(317, 17, 'High Bikini Wax'),
(318, 17, 'Add on: Patch'),
(319, 17, 'Upper Legs Wax'),
(320, 17, 'Upper Lip Wax/Threading'),
(321, 17, 'Eyebrow Wax/Threading'),
(322, 17, 'Side of Face Wax/Threading'),
(323, 17, 'Full Face Wax/Threading'),
(324, 17, 'Underarms Wax'),
(325, 17, 'Half Arms Wax'),
(326, 17, 'Full Arms Wax'),
(327, 17, 'Half Legs Wax'),
(328, 17, 'Full Legs Wax'),
(329, 17, 'Bikini Line'),
(330, 17, 'Brazilian Wax'),
(331, 17, 'Chest Wax'),
(332, 17, 'Lower Back Wax'),
(333, 17, 'Full Back Wax'),
(334, 17, 'Full Body (Brazilian not included)'),
(335, 17, 'Forehead Waxing Threading'),
(336, 17, 'Full Butt Wax'),
(337, 17, 'Eyelash Tint'),
(338, 17, 'Eyebrows Tint'),
(339, 17, 'Abdomen Wax'),
(340, 17, 'Chin Wax/Threading'),
(341, 16, 'L-Therapy Photo Youth'),
(342, 16, 'Acid Peel');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `st_id` int(11) NOT NULL,
  `l_id` int(11) NOT NULL,
  `st_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`st_id`, `l_id`, `st_name`) VALUES
(14, 0, 'Abegayle  Bermas Navales'),
(15, 0, 'Achraf Mrabet'),
(16, 0, 'Ailyn Coronado Zapata'),
(17, 0, 'Altingul Kudaibergenova'),
(18, 0, 'Ana Marie Bedei'),
(19, 0, 'Binda Subedi'),
(20, 0, 'Carol Sanchez Tiamsim'),
(21, 0, 'Charito Catipay Bualan'),
(22, 0, 'Chitra Dhakal'),
(23, 0, 'Clarissa Ansero Flores'),
(24, 0, 'Cynthia Quines'),
(25, 0, 'Elham Ebrahim '),
(26, 0, 'Emily '),
(27, 0, 'Hachmi Belhaj'),
(28, 0, 'Ikram Abou'),
(29, 0, 'Jamie Igharas Tajona'),
(30, 0, 'Janet Balingasa Perez'),
(31, 0, 'Janice Belando Sotea'),
(32, 0, 'Jasmine D\'Souza'),
(33, 0, 'Joan Dela Cruz Anaclito'),
(34, 0, 'Jocelyn Ozon Orsal'),
(35, 0, 'Juna Flor Gantala Samson'),
(36, 0, 'Liezl Libnao Gardoque'),
(37, 0, 'Lowie Ruiz'),
(38, 0, 'Mae Comelote'),
(39, 0, 'Manilyn Lina Angangan'),
(40, 0, 'Maricel Allada Saiguan'),
(41, 0, 'Marilyn Pacheco Cadajas'),
(42, 0, 'Mary Joy Loreto'),
(43, 0, 'Maureen Atieno Obonyo'),
(44, 0, 'Melchie Candido Mogello'),
(45, 0, 'Melina Raya'),
(46, 0, 'Melissa Velasques'),
(47, 0, 'Mufaro Pawakwenyewa'),
(48, 0, 'Myra Allada Seguan'),
(49, 0, 'Reggie Flores'),
(50, 0, 'Rosalie Kipte'),
(51, 0, 'Rosalinda Moreno'),
(52, 0, 'Ruby Orca'),
(53, 0, 'Russel Hacutina'),
(54, 0, 'Saifon  Srasaeng'),
(55, 0, 'Supranee Sreebukkhol'),
(56, 0, 'Taksina Rungroj'),
(57, 0, 'Teresita Bediosas Desoyo'),
(58, 0, 'Tetchie Alejan Juarez'),
(59, 0, 'Thawanrat Suporn'),
(60, 0, 'Tika Devi Timsina'),
(61, 0, 'Wilaiporn Wareebo'),
(62, 0, 'Windy Asuan'),
(63, 0, 'Zara Cantiga Cabardo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `cust_name_phone`
--
ALTER TABLE `cust_name_phone`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `review_form`
--
ALTER TABLE `review_form`
  ADD PRIMARY KEY (`re_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`se_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`st_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cust_name_phone`
--
ALTER TABLE `cust_name_phone`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `review_form`
--
ALTER TABLE `review_form`
  MODIFY `re_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `se_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
