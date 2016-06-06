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

-- Dumping structure for table cm.employee_data
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

-- Dumping data for table cm.employee_data: ~37 rows (approximately)
/*!40000 ALTER TABLE `employee_data` DISABLE KEYS */;
INSERT INTO `employee_data` (`id`, `emp_prefix`, `emp_fname`, `emp_lname`, `emp_nickname`, `emp_sex`, `emp_position`, `emp_dept`, `emp_nation`, `emp_DOB`, `emp_type`, `emp_startdate`, `emp_enddate`, `emp_status`) VALUES
	('CM-1001', 'นาย', 'ธนิตศักดิ์ ', 'พัชรดิษฐ์ฐากุล', 'มาร์ก', 'Male', 'President', 'Management', 'ไทย', '24/06/49', 'รายเดือน', '01/04/02', '', 'บรรจุแล้ว'),
	('CM-1002', 'นาง', 'ยุวรินทร์  ', 'พัชรดิษฐ์ฐากุล', 'กลาง', 'Female', 'Vice President', 'Management', 'ไทย', '10/06/52', 'รายเดือน', '02/04/02', '', 'บรรจุแล้ว'),
	('CM-1003', 'นาย', 'ภูริวัจน์  ', 'พัชรดิษฐ์ฐากุล', 'ไอซ์', 'Male', 'Corporate Director', 'Management', 'ไทย', '19/05/90', 'รายเดือน', '01/06/13', '', 'บรรจุแล้ว'),
	('CM-1004', 'นาง', 'นางทัศนีย์', 'มัลลิกาพิพัฒน์', 'ตาล', 'Female', 'Account Recieviable/Cashier', 'Office', 'ไทย', '15/11/82', 'รายเดือน', '01/06/13', '', 'บรรจุแล้ว'),
	('CM-1005', 'นาย', 'ประพันธ์ ', 'วงษ์อุบล', 'พันธ์', 'Male', 'General Supervisor', 'Factory', 'ไทย', '01/05/71', 'รายเดือน', '02/04/02', '', 'บรรจุแล้ว'),
	('CM-1007', 'น.ส.', 'กัลฐิกา', 'บุญเปรื่อง', 'ฟาง', 'Female', 'Account Payable/Assistant Manager', 'Office', 'ไทย', '20/11/85', 'รายเดือน', '05/08/14', '', 'บรรจุแล้ว'),
	('CM-1008', 'นาย', 'นนท์ตการ', 'มัลลิกาพิพัฒน์', 'มิกซ์', 'Male', 'Messenger', 'Office', 'ไทย', '30/11/76', 'รายเดือน', '01/01/11', '', 'บรรจุแล้ว'),
	('CM-1009', 'นาย', 'เกษม', 'พิมพ์จันทร์', 'เกษม', 'Male', 'Messenger', 'Office', 'ไทย', '23/07/69', 'รายเดือน', '02/04/02', '', 'บรรจุแล้ว'),
	('CM-1010', 'นาย', 'ธนพล', 'จันมีชัย', 'ทอง', 'Male', 'Scaffold Inspector', 'Factory', 'ไทย', '05/10/60', 'รายเดือน', '08/07/13', '20/02/16', 'ให้ออก'),
	('CM-1011', 'นาย', 'อุทัย', 'ทองเฟื้อง', 'ทัย', 'Male', 'worker', 'Factory', 'ไทย', '28/10/81', 'รายวัน', '21/07/06', '', 'บรรจุแล้ว'),
	('CM-1013', 'นาย', 'Soe Win Than', '', 'แสน', 'Male', 'worker', 'Factory', 'พม่า', '04/02/84', 'รายวัน', '26/02/13', '31/10/15', 'ลาออก'),
	('CM-1014', 'นาง', 'Zar Ni Tun', '', 'ปู', 'Female', 'worker', 'Factory', 'พม่า', '17/08/83', 'รายวัน', '26/02/13', '31/10/15', 'ลาออก'),
	('CM-1015', 'นาย', 'Aw Lan', '', 'ชาติ', 'Male', 'worker', 'Factory', 'พม่า', '30/04/86', 'รายวัน', '02/12/13', '', 'บรรจุแล้ว'),
	('CM-1016', 'น.ส.', 'Mi Yin Thein', '', 'นุ้ย', 'Female', 'worker', 'Factory', 'พม่า', '06/05/87', 'รายวัน', '02/04/02', '', 'บรรจุแล้ว'),
	('CM-1017', 'น.ส.', 'Kyi Kyi Nyan', '', 'สา', 'Female', 'worker', 'Factory', 'พม่า', '19/04/95', 'รายวัน', '14/03/16', '', 'บรรจุแล้ว'),
	('CM-1019', 'นาย', 'Aung Tin', '', 'อ๋อง', 'Male', 'worker', 'Factory', 'พม่า', '00/01/00', 'รายวัน', '25/07/14', '16/01/15', 'ลาออก'),
	('CM-1020', 'นาย', 'Zin Maung Htun', '', 'ซี', 'Male', 'worker', 'Factory', 'พม่า', '00/01/00', 'รายวัน', '13/08/14', '16/01/15', 'ลาออก'),
	('CM-1021', 'นาย', 'Tun Kyaw', '', 'ทุนโจ', 'Male', 'worker', 'Factory', 'พม่า', '29/05/84', 'รายวัน', '25/07/14', '', 'บรรจุแล้ว'),
	('CM-1022', 'นาย', 'Hlawn Moe Naing', '', 'นาย', 'Male', 'worker', 'Factory', 'พม่า', '00/01/00', 'รายวัน', '25/07/14', '16/02/15', 'ลาออก'),
	('CM-1023', 'นาย', 'Zaw Moe', '', 'ซอม', 'Male', 'worker', 'Factory', 'พม่า', '00/01/00', 'รายวัน', '25/07/14', '16/01/15', 'ลาออก'),
	('CM-1024', 'นาง', 'พูมะลี', 'สิริปันยา', 'เจ', 'Female', 'worker', 'Factory', 'ลาว', '06/11/73', 'รายวัน', '01/06/09', '', 'บรรจุแล้ว'),
	('CM-1025', 'นาย', 'นาริน', 'กีม', 'นาริน', 'Male', 'worker', 'Factory', 'เขมร', '13/07/78', 'รายวัน', '07/10/14', '', 'บรรจุแล้ว'),
	('CM-1026', 'นาย', 'Foe Sae', '', 'โพ', 'Male', 'worker', 'Factory', 'พม่า', '00/01/00', 'รายวัน', '25/07/14', '16/01/15', 'ลาออก'),
	('CM-1027', 'นาย', 'Maung Kyaw', '', 'ม่องโจ', 'Male', 'worker', 'Factory', 'พม่า', '12/02/87', 'รายวัน', '25/07/14', '', 'บรรจุแล้ว'),
	('CM-1028', 'น.ส.', 'เพ็ญโสม ', 'ใจวงค์', 'แคท', 'Female', 'General Manager', 'Management', 'ไทย', '31/08/90', 'รายเดือน', '01/07/14', '', 'บรรจุแล้ว'),
	('CM-1029', 'นาย', 'Myat San', '', 'ซ่า', 'Male', 'worker', 'Factory', 'พม่า', '00/01/00', 'รายวัน', '15/01/15', '17/09/15', 'ลาออก'),
	('CM-1030', 'นาย', 'เอ๊าท์', ' เม็ท', 'เอ๊าท์', 'Male', 'worker', 'Factory', 'เขมร', '00/01/00', 'รายวัน', '05/01/15', '04/04/15', 'ลาออก'),
	('CM-1031', 'นาย', 'เล็ท', ' เม็ท', 'เล็ท', 'Male', 'worker', 'Factory', 'เขมร', '00/01/00', 'รายวัน', '22/01/15', '04/04/15', 'ลาออก'),
	('CM-1032', 'นาย', 'มิน', '', 'มิน', 'Male', 'worker', 'Factory', 'เขมร', '11/02/75', 'รายวัน', '05/01/16', '', 'ทดลองงาน'),
	('CM-1033', 'นาย', 'จักรพันธ์', 'นาคนชม', 'โต้', 'Male', 'Accountant', 'Office', 'ไทย', '29/01/91', 'รายเดือน', '07/05/15', '01/07/15', 'ลาออก'),
	('CM-1034', 'นาย', 'สมพงศ์  ', 'นันทไพบูลย์', 'สมพงศ์', 'Male', 'Consultant', 'Management', 'ไทย', '11/12/52', 'รายเดือน', '01/04/14', '', 'บรรจุแล้ว'),
	('CM-1035', 'น.ส.', 'ทอง', 'ทองทา', 'ทอง', 'Female', 'Maid', 'Office', 'ไทย', '25/01/54', 'รายเดือน', '02/04/02', '', 'บรรจุแล้ว'),
	('CM-1036', 'นาย', 'Way Lin Tun', '', '', 'Male', 'worker', 'Factory', 'พม่า', '08/11/89', 'รายวัน', '24/08/15', '17/09/15', 'ลาออก'),
	('CM-1037', 'นาย', 'อัศวเทพ ', 'เริงสำราญ', 'พฤกษ์', 'Male', 'Sales Project Manager', 'Office', 'ไทย', '12/12/90', 'รายเดือน', '01/09/15', '', 'บรรจุแล้ว'),
	('CM-1038', 'นาย', 'ทักษ์ดนัย', 'ชวาลารัตน์', 'ทักษ์', 'Male', 'Store Supervisor', 'Office', 'ไทย', '22/08/92', 'รายเดือน', '16/11/15', '', 'บรรจุแล้ว'),
	('CM-1039', 'น.ส.', 'Kimsean', 'Sem', 'เซียน', 'Female', 'worker', 'Factory', 'เขมร', '16/03/87', 'รายวัน', '05/01/16', '', 'ทดลองงาน'),
	('CM-1041', 'นาย', 'ปอย', '', 'ปอย', 'Male', 'worker', 'Factory', 'เขมร', '04/04/91', 'รายวัน', '13/01/16', '', 'ทดลองงาน');
/*!40000 ALTER TABLE `employee_data` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
