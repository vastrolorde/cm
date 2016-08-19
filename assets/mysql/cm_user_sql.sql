-- Dumping structure for table cm.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table cm.groups: ~5 rows (approximately)
DELETE FROM `groups`;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(1, 'admin', 'Administrator'),
	(2, 'members', 'General User'),
	(3, 'Store', 'Store'),
	(4, 'HR', 'Human Resource'),
	(6, 'Sales', 'Sales');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


-- Dumping structure for table cm.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table cm.users: ~4 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
	(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1471570510, 1, 'Admin', 'istrator', 'ADMIN', '0'),
	(2, '::1', NULL, '$2y$08$row7el1PgeqGDPSy8UHXG.xlKDPBQr8WhEChtQhrWU7rgt80POHxi', NULL, 'bhurivaj@classmat.info', NULL, NULL, NULL, NULL, 1470625981, 1471418083, 1, 'Bhurivaj', 'Padcharaditthakul', NULL, NULL),
	(3, '::1', NULL, '$2y$08$dmsIMZIhCa5GiZhmZrnYuu/xtDzGqrR0ujhfg42tTKuUyFtHuHlzy', NULL, 'pensom@classmat.info', NULL, NULL, NULL, NULL, 1470710534, NULL, 1, 'Pensom', 'Jaiwong', NULL, NULL),
	(4, '::1', NULL, '$2y$08$krhMqY7rwMIppHEbx5tNyuKFSZ.ppQPzyjY44vxWlLOb9JJd8vf6e', NULL, 'takdanai@classmat.info', NULL, NULL, NULL, NULL, 1470879179, 1471415798, 1, 'Takdanai', 'Chawalarat', NULL, NULL),
	(5, '::1', NULL, '$2y$08$cZ6gY8Ep4wwtgMc9R3r1n.NZBHXL.Xrq7FIgIRyz8pxe5B5JHEGk6', NULL, 'bhuripanair@gmail.com', NULL, NULL, NULL, NULL, 1471576429, NULL, 1, 'Bhuripan', 'Padcharaditthakul', NULL, NULL),
	(6, '::1', NULL, '$2y$08$Lb.fX/ZpdHcPpEcYqMWwyuRiBJ7JCM5zjPA0N9isRO4R6RSxSZCna', NULL, 'prapan@classmat.info', NULL, NULL, NULL, NULL, 1471576481, NULL, 1, 'Prapan', 'Wongubol', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table cm.users_groups
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table cm.users_groups: ~9 rows (approximately)
DELETE FROM `users_groups`;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
  (1, 2, 3),
  (2, 1, 1),
  (3, 2, 4),
  (4, 1, 2),
  (5, 2, 2),
  (6, 3, 2),
  (7, 1, 3),
  (8, 1, 4),
	(9, 1, 6),
	(10, 4, 2),
	(11, 4, 3),
	(12, 5, 2),
	(13, 6, 2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
