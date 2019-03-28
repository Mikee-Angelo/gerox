-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2019 at 02:30 AM
-- Server version: 10.0.27-MariaDB-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `geroxx10_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_auth` text NOT NULL,
  `admin_pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_auth`, `admin_pwd`) VALUES
(1, 'purchaser@gerox.com', 'adminadmin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cart_po_num` varchar(255) NOT NULL,
  `need_date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `cart_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `cart_po_num`, `need_date`, `status`, `cart_date`) VALUES
(51, 7, '313414', '0000-00-00', '0', '2019-03-12 05:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `cart_products`
--

CREATE TABLE IF NOT EXISTS `cart_products` (
  `cart_products_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `cart_order` varchar(255) NOT NULL,
  `cart_quantity` int(11) NOT NULL,
  `cart_amount` int(11) NOT NULL,
  `cp_status` tinyint(4) NOT NULL,
  `cart_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_info`
--

CREATE TABLE IF NOT EXISTS `client_info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `img` text NOT NULL,
  `details` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `client_info`
--

INSERT INTO `client_info` (`info_id`, `company_name`, `address`, `img`, `details`, `status`) VALUES
(1, 'MAD Company', 'Olongapo City', '', '', 1),
(2, 'Tong Lung Metal Industry INC CO.', 'Gateway Park Sbma', '', '', 1),
(3, 'Scorpion Company', 'bataan', '', '', 0),
(4, 'Ems spider web company', 'subic philseco ems wonderland', '', '', 1),
(5, 'Capstone corp', 'Sbma', '', '', 1),
(6, 'Subiccon', 'Olongapo City', '', '', 0),
(7, 'Nescafe', 'Olongapo City', '', '', 0),
(8, 'Jollibee Corp', 'Olongapo City', '', '', 0),
(9, 'Mabuhay Interflour Mill Corp.', 'Subic Bay Gateway Park Subic Bay Freeport Zone', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `del_status`
--

CREATE TABLE IF NOT EXISTS `del_status` (
  `del_status_id` int(11) NOT NULL,
  `del_status_name` varchar(255) NOT NULL,
  PRIMARY KEY (`del_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `del_status`
--

INSERT INTO `del_status` (`del_status_id`, `del_status_name`) VALUES
(1, 'pending'),
(2, 'for shipping'),
(3, 'on transit'),
(4, 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_content` text NOT NULL,
  `log_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `log_content`, `log_date_created`) VALUES
(1, 'PO Number 2019001 was deleted', '2019-03-11 00:27:50'),
(2, 'PO Number 412142 was updated to for Shipping', '2019-03-11 00:29:04'),
(3, 'PO Number 412142 was updated to on Transit', '2019-03-11 00:29:04'),
(4, 'PO Number 412142 was updated to on Delivered', '2019-03-11 00:29:05'),
(5, 'Actual Price of GELO with PO Number 31314 was changed to 1407', '2019-03-11 00:52:23'),
(6, 'Actual Price of GLASS with PO Number 31314 was changed to 90000', '2019-03-11 00:52:35'),
(7, 'Date SI and SI Number was updated with PO Number 31314', '2019-03-11 00:52:44'),
(8, 'PO Number 31314 was updated to for Shipping', '2019-03-11 00:53:34'),
(9, 'PO Number 31314 was updated to on Transit', '2019-03-11 00:53:35'),
(10, 'PO Number 31314 was updated to on Delivered', '2019-03-11 00:53:35'),
(11, 'Actual Price of Donut with PO Number 412142 was changed to 70000', '2019-03-11 00:54:03'),
(12, 'Date SI and SI Number was updated with PO Number 412142', '2019-03-11 00:54:31'),
(13, 'Actual Price of Test 1 with PO Number 31414 was changed to 24013', '2019-03-11 00:56:36'),
(14, 'Date SI and SI Number was updated with PO Number 31414', '2019-03-11 00:56:42'),
(15, 'PO Number 31414 was updated to for Shipping', '2019-03-11 00:57:09'),
(16, 'PO Number 31414 was updated to on Transit', '2019-03-11 00:57:10'),
(17, 'PO Number 31414 was updated to on Delivered', '2019-03-11 00:57:12'),
(18, 'Administrator logged in', '2019-03-11 07:01:56'),
(19, 'PO Number 525653 was updated to for Shipping', '2019-03-11 07:05:10'),
(20, 'PO Number 525653 was updated to on Transit', '2019-03-11 07:05:11'),
(21, 'PO Number 525653 was updated to on Delivered', '2019-03-11 07:05:12'),
(22, 'Actual Price of Spag with PO Number 6741 was changed to 500', '2019-03-11 09:24:44'),
(23, 'Actual Price of Gaming mouse with PO Number 6741 was changed to 2500', '2019-03-11 09:24:52'),
(24, 'Date SI and SI Number was updated with PO Number 6741', '2019-03-11 09:26:04'),
(25, 'Administrator logged in', '2019-03-11 11:16:18'),
(26, 'Administrator logged in', '2019-03-11 11:21:47'),
(27, 'Administrator logged in', '2019-03-11 12:06:39'),
(28, 'Administrator logged in', '2019-03-11 12:26:39'),
(29, 'Administrator logged in', '2019-03-12 00:40:49'),
(30, 'Administrator logged in', '2019-03-12 02:14:58'),
(31, 'Administrator logged in', '2019-03-12 02:15:30'),
(32, 'Actual Price of Concrete Nail with PO Number 55252535 was changed to 2000', '2019-03-12 02:22:18'),
(33, 'Date SI and SI Number was updated with PO Number 55252535', '2019-03-12 03:16:13'),
(34, 'Administrator logged in', '2019-03-12 03:16:33'),
(35, 'Actual Price of Concrete Nail with PO Number 55252535 was changed to 500', '2019-03-12 03:23:18'),
(36, 'PO Number 1314154 was updated to for Shipping', '2019-03-12 03:32:32'),
(37, 'PO Number 1314154 was updated to on Transit', '2019-03-12 03:32:33'),
(38, 'PO Number 1314154 was updated to on Delivered', '2019-03-12 03:32:34'),
(39, 'Actual Price of Angelo Zapanta with PO Number 1314154 was changed to 40000', '2019-03-12 03:34:29'),
(40, 'Actual Price of Mike Deleon with PO Number 1314154 was changed to 3000', '2019-03-12 03:35:00'),
(41, 'Administrator logged in', '2019-03-12 04:09:29'),
(42, 'Administrator logged in', '2019-03-12 04:12:53'),
(43, 'Administrator logged in', '2019-03-12 04:20:08'),
(44, 'Administrator logged in', '2019-03-12 04:57:26'),
(45, 'Actual Price of Soda with PO Number 5511222 was changed to 8901', '2019-03-12 04:59:27'),
(46, 'Actual Price of Hose with PO Number 5511222 was changed to 40000', '2019-03-12 04:59:29'),
(47, 'Date SI and SI Number was updated with PO Number 5511222', '2019-03-12 04:59:35'),
(48, 'PO Number 5511222 was updated to for Shipping', '2019-03-12 04:59:52'),
(49, 'PO Number 5511222 was updated to on Transit', '2019-03-12 04:59:53'),
(50, 'PO Number 5511222 was updated to on Delivered', '2019-03-12 04:59:53'),
(51, 'Date SI and SI Number was updated with PO Number 1314154', '2019-03-12 05:00:44'),
(52, 'ID: 90483525was created for Mabuhay Interflour Mill Corp.', '2019-03-12 05:05:14'),
(53, 'Administrator logged in', '2019-03-12 06:15:46'),
(54, 'Actual Price of safeguard with PO Number 422424 was changed to 361', '2019-03-12 06:29:38'),
(55, 'Actual Price of safeguard with PO Number 422424 was changed to 200', '2019-03-12 06:29:47'),
(56, 'Actual Price of dad with PO Number 422424 was changed to 43000', '2019-03-12 06:30:01'),
(57, 'Administrator logged in', '2019-03-12 09:20:43'),
(58, 'Administrator logged in', '2019-03-12 09:31:40'),
(59, 'Actual Price of Spaghetti Sauce with PO Number 55252535 was changed to 16798', '2019-03-12 09:36:27'),
(60, 'Date SI and SI Number was updated with PO Number 55252535', '2019-03-12 09:36:38'),
(61, 'PO Number 55252535 was updated to for Shipping', '2019-03-12 09:37:24'),
(62, 'PO Number 55252535 was updated to on Transit', '2019-03-12 09:37:25'),
(63, 'PO Number 55252535 was updated to on Delivered', '2019-03-12 09:37:26'),
(64, 'Actual Price of Sprite with PO Number 12142124 was changed to 16753', '2019-03-12 09:38:45'),
(65, 'Actual Price of Headset with PO Number 12142124 was changed to 1500', '2019-03-12 09:38:46'),
(66, 'Date SI and SI Number was updated with PO Number 12142124', '2019-03-12 09:40:55'),
(67, 'PO Number 12142124 was updated to for Shipping', '2019-03-12 09:41:56'),
(68, 'PO Number 12142124 was updated to on Transit', '2019-03-12 09:41:58'),
(69, 'PO Number 12142124 was updated to on Delivered', '2019-03-12 09:41:59'),
(70, 'PO Number 5335321 was updated to for Shipping', '2019-03-12 09:42:16'),
(71, 'PO Number 422424 was updated to for Shipping', '2019-03-12 09:42:22'),
(72, 'PO Number 422424 was updated to on Transit', '2019-03-12 09:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `month_tbl`
--

CREATE TABLE IF NOT EXISTS `month_tbl` (
  `mon_id` int(11) NOT NULL AUTO_INCREMENT,
  `month` text NOT NULL,
  PRIMARY KEY (`mon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `noti_id` int(11) NOT NULL AUTO_INCREMENT,
  `noti_po_num` int(11) NOT NULL,
  `noty_status` tinyint(2) NOT NULL DEFAULT '0',
  `noti_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `noti_user_id` int(11) NOT NULL,
  PRIMARY KEY (`noti_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`noti_id`, `noti_po_num`, `noty_status`, `noti_date_created`, `noti_user_id`) VALUES
(1, 2019001, 0, '2019-03-11 00:26:50', 1),
(2, 412142, 0, '2019-03-11 00:28:52', 1),
(3, 525653, 0, '2019-03-11 00:33:49', 1),
(4, 632623, 0, '2019-03-11 00:34:16', 1),
(5, 31314, 0, '2019-03-11 00:51:37', 8),
(6, 31414, 0, '2019-03-11 00:55:57', 4),
(7, 6741, 0, '2019-03-11 09:24:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_user`
--

CREATE TABLE IF NOT EXISTS `notification_user` (
  `nuid` int(11) NOT NULL AUTO_INCREMENT,
  `noti_user_slug` tinyint(2) NOT NULL DEFAULT '0',
  `noti_user_uid` int(11) NOT NULL,
  `noti_del_status` tinyint(2) NOT NULL DEFAULT '0',
  `nu_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nu_po_num` varchar(255) NOT NULL,
  PRIMARY KEY (`nuid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `notification_user`
--

INSERT INTO `notification_user` (`nuid`, `noti_user_slug`, `noti_user_uid`, `noti_del_status`, `nu_date_created`, `nu_po_num`) VALUES
(1, 0, 1, 2, '2019-03-08 18:57:38', '124141'),
(2, 0, 1, 3, '2019-03-08 18:57:41', '124141'),
(3, 0, 1, 4, '2019-03-08 18:57:43', '124141'),
(4, 0, 2, 2, '2019-03-08 19:12:52', '2019001'),
(5, 0, 2, 3, '2019-03-08 19:12:53', '2019001'),
(6, 0, 2, 4, '2019-03-08 19:12:54', '2019001'),
(7, 0, 4, 2, '2019-03-09 04:34:05', '8456'),
(8, 0, 4, 3, '2019-03-09 04:34:15', '8456'),
(9, 0, 4, 4, '2019-03-09 04:34:20', '8456'),
(10, 0, 1, 2, '2019-03-09 08:14:39', '1412414'),
(11, 0, 1, 3, '2019-03-09 08:14:43', '1412414'),
(12, 0, 1, 4, '2019-03-09 08:14:44', '1412414'),
(13, 0, 5, 2, '2019-03-10 23:25:06', '622626'),
(14, 0, 5, 3, '2019-03-10 23:25:11', '622626'),
(15, 0, 5, 4, '2019-03-10 23:25:12', '622626'),
(16, 0, 1, 2, '2019-03-11 00:21:26', '64336634'),
(17, 0, 1, 3, '2019-03-11 00:21:26', '64336634'),
(18, 0, 1, 4, '2019-03-11 00:21:26', '64336634'),
(19, 0, 1, 2, '2019-03-11 00:29:04', '412142'),
(20, 0, 1, 3, '2019-03-11 00:29:04', '412142'),
(21, 0, 1, 4, '2019-03-11 00:29:05', '412142'),
(22, 0, 8, 2, '2019-03-11 00:53:34', '31314'),
(23, 0, 8, 3, '2019-03-11 00:53:35', '31314'),
(24, 0, 8, 4, '2019-03-11 00:53:35', '31314'),
(25, 0, 4, 2, '2019-03-11 00:57:09', '31414'),
(26, 0, 4, 3, '2019-03-11 00:57:10', '31414'),
(27, 0, 4, 4, '2019-03-11 00:57:12', '31414'),
(28, 0, 1, 2, '2019-03-11 07:05:10', '525653'),
(29, 0, 1, 3, '2019-03-11 07:05:11', '525653'),
(30, 0, 1, 4, '2019-03-11 07:05:12', '525653'),
(31, 0, 1, 2, '2019-03-12 03:32:32', '1314154'),
(32, 0, 1, 3, '2019-03-12 03:32:33', '1314154'),
(33, 0, 1, 4, '2019-03-12 03:32:34', '1314154'),
(34, 0, 8, 2, '2019-03-12 04:59:52', '5511222'),
(35, 0, 8, 3, '2019-03-12 04:59:53', '5511222'),
(36, 0, 8, 4, '2019-03-12 04:59:53', '5511222'),
(37, 0, 8, 2, '2019-03-12 09:37:24', '55252535'),
(38, 0, 8, 3, '2019-03-12 09:37:25', '55252535'),
(39, 0, 8, 4, '2019-03-12 09:37:26', '55252535'),
(40, 0, 8, 2, '2019-03-12 09:41:56', '12142124'),
(41, 0, 8, 3, '2019-03-12 09:41:58', '12142124'),
(42, 0, 8, 4, '2019-03-12 09:41:59', '12142124'),
(43, 0, 9, 2, '2019-03-12 09:42:16', '5335321'),
(44, 0, 1, 2, '2019-03-12 09:42:22', '422424'),
(45, 0, 1, 3, '2019-03-12 09:42:23', '422424');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tracking_no` text NOT NULL,
  `po_num` varchar(255) NOT NULL,
  `del_status` int(1) NOT NULL DEFAULT '1',
  `date_si` date NOT NULL,
  `si_num` int(11) NOT NULL,
  `dby` text NOT NULL,
  `remarks` text NOT NULL,
  `date_needed` date NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `tracking_no`, `po_num`, `del_status`, `date_si`, `si_num`, `dby`, `remarks`, `date_needed`) VALUES
(8, 8, '78620', '55252535', 4, '2019-03-15', 1412521, 'Jeric Quito', 'Ordered early because of early purchased', '2019-03-15'),
(9, 8, '81607', '5533355', 1, '0000-00-00', 0, '', '', '2019-03-15'),
(10, 8, 'edJz78209', '5511222', 4, '2019-03-14', 13, 'Angelo Zapanta', 'Receive by Warehouse Department', '2019-03-15'),
(11, 1, 'QTJF10978', '1314154', 4, '2019-03-14', 3141, 'Jeric Quito', 'deliver Early that the client expected', '2019-03-16'),
(12, 8, 'NqPz90901', '12142124', 4, '2019-02-28', 1213, 'Angelo Zapanta', 'receieved by mam lean', '2019-02-28'),
(13, 9, 'GpdO89901', '664346', 1, '0000-00-00', 0, '', '', '2019-03-15'),
(14, 9, 'SBHC82261', '5335321', 2, '0000-00-00', 0, '', '', '2019-03-21'),
(15, 9, 'wsvQ43577', '32321', 1, '0000-00-00', 0, '', '', '2019-03-16'),
(16, 1, 'Jlvy99053', '422424', 3, '0000-00-00', 0, '', '', '2019-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `u_amount` int(11) NOT NULL,
  `act_pri` double NOT NULL,
  `item_status` tinyint(2) NOT NULL DEFAULT '0',
  `p_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`products_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`products_id`, `order_id`, `order`, `qty`, `u_amount`, `act_pri`, `item_status`, `p_date_created`) VALUES
(3, 3, 'Keyboard', 10, 1000, 3000, 1, '2019-03-08 19:00:49'),
(4, 4, 'Mouse', 12, 500, 5500, 1, '2019-03-08 19:05:20'),
(8, 7, 'Gaming mouse', 100, 20, 2500, 1, '2019-03-09 03:25:30'),
(9, 8, 'Concrete Nail', 10, 100, 500, 1, '2019-03-09 03:35:50'),
(10, 9, 'Wireless Mouse', 12, 500, 0, 0, '2019-03-09 03:36:56'),
(11, 10, 'Hose', 100, 500, 40000, 1, '2019-03-09 03:37:24'),
(13, 12, 'Headset', 10, 200, 1500, 1, '2019-03-09 04:08:06'),
(14, 13, 'Cobweb', 12, 134, 0, 0, '2019-03-09 04:23:39'),
(15, 14, 'Ting ting', 12, 31, 0, 1, '2019-03-09 04:25:08'),
(16, 15, 'posporo', 150, 3, 300, 1, '2019-03-09 04:33:43'),
(17, 16, 'safeguard', 20, 18, 200, 1, '2019-03-09 06:01:46'),
(18, 17, 'Padlock', 10, 200, 0, 1, '2019-03-10 09:14:33'),
(19, 19, 'Coffee', 20, 1000, 0, 0, '2019-03-10 14:11:37'),
(20, 21, 'Tester', 20, 500, 0, 1, '2019-03-10 18:09:33'),
(21, 22, 'Tissue', 20, 200, 0, 0, '2019-03-10 18:11:13'),
(22, 23, 'Scissor', 200, 50, 0, 0, '2019-03-10 18:45:30'),
(23, 24, 'Bond Paper', 20, 200, 0, 0, '2019-03-10 18:51:24'),
(24, 25, 'Pen', 200, 5, 0, 0, '2019-03-10 18:52:41'),
(25, 25, 'adada', 113, 31, 0, 0, '2019-03-10 18:52:41'),
(26, 26, 'Hotdog', 200, 200, 0, 1, '2019-03-10 20:51:40'),
(29, 2, 'Donut', 500, 200, 70000, 1, '2019-03-11 00:28:52'),
(30, 3, 'Spaghetti', 20, 260, 0, 1, '2019-03-11 00:33:49'),
(31, 3, 'Pen', 500, 100, 0, 1, '2019-03-11 00:33:49'),
(32, 4, 'Adaptor', 50, 100, 0, 0, '2019-03-11 00:34:16'),
(33, 5, 'GELO', 12, 131, 1407, 1, '2019-03-11 00:51:37'),
(34, 5, 'GLASS', 213, 431, 90000, 1, '2019-03-11 00:51:37'),
(35, 6, 'Test 1', 210, 121, 24013, 1, '2019-03-11 00:55:57'),
(36, 7, 'Spag', 21, 31, 500, 0, '2019-03-11 09:24:04'),
(37, 8, 'Spaghetti Sauce', 100, 200, 16798, 1, '2019-03-12 01:31:04'),
(38, 9, 'Coke', 200, 200, 0, 0, '2019-03-12 01:36:41'),
(39, 10, 'Soda', 200, 50, 8901, 1, '2019-03-12 01:41:35'),
(40, 11, 'Angelo Zapanta', 213, 314, 40000, 1, '2019-03-12 02:39:14'),
(41, 11, 'Mike Deleon', 313, 12, 3000, 1, '2019-03-12 02:39:14'),
(42, 12, 'Sprite', 200, 100, 16753, 1, '2019-03-12 05:08:54'),
(43, 13, 'Flour', 20, 100, 0, 0, '2019-03-12 05:11:37'),
(44, 14, 'Salt', 20, 200, 0, 1, '2019-03-12 05:14:32'),
(45, 15, 'Mini  Fan', 4, 923, 0, 0, '2019-03-12 05:28:15'),
(46, 15, 'cellphone', 31, 314, 0, 0, '2019-03-12 05:28:15'),
(47, 16, 'dad', 1313, 33, 43000, 1, '2019-03-12 06:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_id` int(11) NOT NULL,
  `authid` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `info_id`, `authid`, `email`, `password`, `level`, `date_created`) VALUES
(1, 1, '68628028', 'michael19972910@gmail.com', '13492', 'user', '2019-03-08 18:41:30'),
(2, 2, '88827589', 'backpayla1730@gmail.com', 'gelo123', 'user', '2019-03-08 18:48:32'),
(3, 3, '21205283', 'lanzerlibo09@gmail.com', '84023', 'user', '2019-03-09 04:26:39'),
(4, 4, '30717222', 'diroj@mail-cart.com', 'spiderweb', 'user', '2019-03-09 04:30:03'),
(5, 5, '52266793', 'Capstoneproject565@gmail.com', '24345', 'user', '2019-03-09 08:26:26'),
(7, 7, '45037224', 'nescafe@gmail.com', '', 'user', '2019-03-10 20:48:35'),
(8, 8, '50097877', 'jb-olongapo@gmail.com', '', 'user', '2019-03-10 20:49:05'),
(9, 9, '90483525', 'MIMC@Gmail.com', '', 'user', '2019-03-12 05:05:14');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
