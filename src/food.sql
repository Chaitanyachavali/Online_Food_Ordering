-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for of
CREATE DATABASE IF NOT EXISTS `of` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `of`;


-- Dumping structure for table of.of_admins
CREATE TABLE IF NOT EXISTS `of_admins` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `mail` varchar(80) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table of.of_admins: ~0 rows (approximately)
DELETE FROM `of_admins`;
/*!40000 ALTER TABLE `of_admins` DISABLE KEYS */;
/*!40000 ALTER TABLE `of_admins` ENABLE KEYS */;


-- Dumping structure for table of.of_items
CREATE TABLE IF NOT EXISTS `of_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `category` varchar(50) NOT NULL DEFAULT '0',
  `price_per_item` int(11) NOT NULL DEFAULT '0',
  `max_num_maker` int(11) NOT NULL DEFAULT '0',
  `max_num_user` int(11) NOT NULL DEFAULT '0',
  `min_time` varchar(50) NOT NULL DEFAULT '0',
  `desc` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table of.of_items: ~3 rows (approximately)
DELETE FROM `of_items`;
/*!40000 ALTER TABLE `of_items` DISABLE KEYS */;
INSERT INTO `of_items` (`item_id`, `name`, `category`, `price_per_item`, `max_num_maker`, `max_num_user`, `min_time`, `desc`) VALUES
	(1, 'Brocoli', 'continential', 500, 50, 5, '33', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
	(2, 'Chicken Caesar Pasta Salad', 'continential', 1000, 20, 2, '48', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
	(3, 'Devilled Eggs', 'continential', 200, 1000, 20, '20', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.');
/*!40000 ALTER TABLE `of_items` ENABLE KEYS */;


-- Dumping structure for table of.of_purchases
CREATE TABLE IF NOT EXISTS `of_purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_Remarks` varchar(200) DEFAULT NULL,
  `date_of_purchase` varchar(20) NOT NULL,
  `time_of_purchase` varchar(20) NOT NULL,
  `date_of_delivery` varchar(20) DEFAULT NULL,
  `time_of_delivery` varchar(20) DEFAULT NULL,
  `delivery_Remarks` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `FK_of_purchases_of_users` (`mail`),
  KEY `FK_of_purchases_of_items` (`item_id`),
  CONSTRAINT `FK_of_purchases_of_items` FOREIGN KEY (`item_id`) REFERENCES `of_items` (`item_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_of_purchases_of_users` FOREIGN KEY (`mail`) REFERENCES `of_users` (`mail`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table of.of_purchases: ~0 rows (approximately)
DELETE FROM `of_purchases`;
/*!40000 ALTER TABLE `of_purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `of_purchases` ENABLE KEYS */;


-- Dumping structure for table of.of_temp_buylist
CREATE TABLE IF NOT EXISTS `of_temp_buylist` (
  `buy_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `current_contact` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `date_of_add` varchar(20) NOT NULL,
  `time_of_add` varchar(20) NOT NULL,
  PRIMARY KEY (`buy_id`),
  KEY `FK__of_users` (`mail`),
  KEY `FK_of_temp_buylist_of_items` (`item_name`),
  CONSTRAINT `FK__of_users` FOREIGN KEY (`mail`) REFERENCES `of_users` (`mail`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_of_temp_buylist_of_items` FOREIGN KEY (`item_name`) REFERENCES `of_items` (`name`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table of.of_temp_buylist: ~6 rows (approximately)
DELETE FROM `of_temp_buylist`;
/*!40000 ALTER TABLE `of_temp_buylist` DISABLE KEYS */;
INSERT INTO `of_temp_buylist` (`buy_id`, `mail`, `item_name`, `current_contact`, `quantity`, `remark`, `date_of_add`, `time_of_add`) VALUES
	(3, 'test@gmail.com', 'Chicken Caesar Pasta Salad', '996633', 3, 'Check3', '22/11/2016', '22:55:00'),
	(10, 'test@gmail.com', 'Brocoli', '8233298708', 3, 'Checkfromtab', '21/11/2016', '09:23:05'),
	(11, 'test@gmail.com', 'Devilled Eggs', '8233298708', 3, 'Newer', '22/11/2016', '12:22:34'),
	(14, 'test@gmail.com', 'Brocoli', '8233298708', 3, 'Postman', '22/11/2016', '12:29:38'),
	(15, 'test@gmail.com', 'Devilled Eggs', '824996496', 5, 'iuhiubu', '22/11/2016', '12:32:04'),
	(20, 'test@gmail.com', 'Devilled Eggs', '8959599', 3, 'jgufvuywfvbeu', '22/11/2016', '12:43:23'),
	(25, 'test@gmail.com', 'Chicken Caesar Pasta Salad', '123456', 2, '19 20', '22/11/2016', '03:05:53');
/*!40000 ALTER TABLE `of_temp_buylist` ENABLE KEYS */;


-- Dumping structure for table of.of_users
CREATE TABLE IF NOT EXISTS `of_users` (
  `mail` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `base_location` varchar(50) NOT NULL,
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table of.of_users: ~0 rows (approximately)
DELETE FROM `of_users`;
/*!40000 ALTER TABLE `of_users` DISABLE KEYS */;
INSERT INTO `of_users` (`mail`, `name`, `contact`, `base_location`) VALUES
	('test@gmail.com', 'Test', '8888888', 'Delhi');
/*!40000 ALTER TABLE `of_users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
