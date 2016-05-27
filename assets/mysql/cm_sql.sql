-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.1.9-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table cm.bank
DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `id` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.contactor
DROP TABLE IF EXISTS `contactor`;
CREATE TABLE IF NOT EXISTS `contactor` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `partner_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_tel` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.dist
DROP TABLE IF EXISTS `dist`;
CREATE TABLE IF NOT EXISTS `dist` (
  `Dist_ID` int(5) NOT NULL AUTO_INCREMENT,
  `Dist_CODE` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `Dist_NAME` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `POSTCODE` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `GEO_ID` int(5) NOT NULL DEFAULT '0',
  `Province_ID` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Dist_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.employee_data
DROP TABLE IF EXISTS `employee_data`;
CREATE TABLE IF NOT EXISTS `employee_data` (
  `id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `emp_prefix` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `emp_fname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emp_lname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emp_nickname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `emp_sex` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `emp_position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emp_dept` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emp_nation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emp_DOB` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `emp_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `emp_startdate` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `emp_enddate` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `emp_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.geography
DROP TABLE IF EXISTS `geography`;
CREATE TABLE IF NOT EXISTS `geography` (
  `GEO_ID` int(5) NOT NULL AUTO_INCREMENT,
  `GEO_NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`GEO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.partner
DROP TABLE IF EXISTS `partner`;
CREATE TABLE IF NOT EXISTS `partner` (
  `id` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `taxID` int(15) NOT NULL,
  `partner_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactor` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add1` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add2` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SubDist` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Dist` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Province` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Postal` int(5) DEFAULT NULL,
  `Invadd1` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Invadd2` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `InvSubDist` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `InvDist` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `InvProvince` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `InvPostal` int(5) DEFAULT NULL,
  `Sector` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ProductDesc` longtext COLLATE utf8_unicode_ci,
  `accNo` int(10) DEFAULT NULL,
  `Bank` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Bank` (`Bank`),
  KEY `Bank_2` (`Bank`),
  KEY `Bank_3` (`Bank`),
  CONSTRAINT `fk_bank` FOREIGN KEY (`Bank`) REFERENCES `bank` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_unit` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_weight` int(3) DEFAULT NULL,
  `product_cost` int(20) DEFAULT NULL,
  `product_1stSalePrice` int(20) NOT NULL,
  `product_2ndSalePrice` int(20) NOT NULL,
  `product_d_RentalPrice` int(20) NOT NULL,
  `product_GuaranteePrice` int(20) NOT NULL,
  `product_Desc` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.product_attr
DROP TABLE IF EXISTS `product_attr`;
CREATE TABLE IF NOT EXISTS `product_attr` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.product_attr_transaction
DROP TABLE IF EXISTS `product_attr_transaction`;
CREATE TABLE IF NOT EXISTS `product_attr_transaction` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `product_AttrName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_AttrDesc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attr_id` (`product_AttrName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.product_unit
DROP TABLE IF EXISTS `product_unit`;
CREATE TABLE IF NOT EXISTS `product_unit` (
  `UnitID` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `UnitName` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.province
DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `Province_ID` int(5) NOT NULL AUTO_INCREMENT,
  `Province_CODE` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `Province_NAME` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `GEO_ID` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Province_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.rental
DROP TABLE IF EXISTS `rental`;
CREATE TABLE IF NOT EXISTS `rental` (
  `id` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `partner_id` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ref_doc` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `start_contract` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `expire_contract` date DEFAULT NULL,
  `paymentType` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guaranteeType` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paymentAmount` int(30) DEFAULT NULL,
  `guaranteeAmount` int(30) DEFAULT NULL,
  `VAT` int(2) NOT NULL,
  `panaltyPerDay` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `partner_id` (`partner_id`),
  CONSTRAINT `fk_partner_id` FOREIGN KEY (`partner_id`) REFERENCES `partner` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.rentaltransaction
DROP TABLE IF EXISTS `rentaltransaction`;
CREATE TABLE IF NOT EXISTS `rentaltransaction` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Rentalid` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productid` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ProductAmount` int(8) DEFAULT NULL,
  `ProductDescription` int(8) DEFAULT NULL,
  `ProductRentalDuration` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Rentalid` (`Rentalid`),
  KEY `productid` (`productid`),
  CONSTRAINT `rentaltransaction_ibfk_1` FOREIGN KEY (`Rentalid`) REFERENCES `rental` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `rentaltransaction_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cm.subdist
DROP TABLE IF EXISTS `subdist`;
CREATE TABLE IF NOT EXISTS `subdist` (
  `SubDist_ID` int(5) NOT NULL AUTO_INCREMENT,
  `SubDist_CODE` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `SubDist_NAME` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Dist_ID` int(5) NOT NULL DEFAULT '0',
  `Province_ID` int(5) NOT NULL DEFAULT '0',
  `GEO_ID` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`SubDist_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
