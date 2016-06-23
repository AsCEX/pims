/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : pims02

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-06-23 09:23:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'AV-A', 'Audio-Video Equipment - A');
INSERT INTO `categories` VALUES ('2', 'AV-B', 'Audio-Video Equipment - B');
INSERT INTO `categories` VALUES ('3', 'AV-C', 'Auido-Video Equipment - C');

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'admin', 'Administrator');
INSERT INTO `groups` VALUES ('2', 'members', 'General User');

-- ----------------------------
-- Table structure for `login_attempts`
-- ----------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of login_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for `offices`
-- ----------------------------
DROP TABLE IF EXISTS `offices`;
CREATE TABLE `offices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initial` varchar(10) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of offices
-- ----------------------------
INSERT INTO `offices` VALUES ('1', 'CMO', '1011', 'City Mayor\'s Office', null, '1', '2016-06-14', null, null, null, null, '0');
INSERT INTO `offices` VALUES ('2', 'SP', '3392', 'Sangguniang Panlungsod Office - Executive Services', null, '1', '2016-06-14', null, null, null, null, '0');

-- ----------------------------
-- Table structure for `procurement_plans`
-- ----------------------------
DROP TABLE IF EXISTS `procurement_plans`;
CREATE TABLE `procurement_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `end_user_id` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ppmp_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of procurement_plans
-- ----------------------------
INSERT INTO `procurement_plans` VALUES ('1', '1', '2016-06-06', '1', null, null);
INSERT INTO `procurement_plans` VALUES ('3', '1', '2016-06-06', '1', null, null);

-- ----------------------------
-- Table structure for `procurement_plan_details`
-- ----------------------------
DROP TABLE IF EXISTS `procurement_plan_details`;
CREATE TABLE `procurement_plan_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) DEFAULT NULL,
  `description` text,
  `qty` decimal(11,4) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `budget` decimal(11,2) DEFAULT NULL,
  `ppmp_id` int(11) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `source_fund` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ppmp_plan_id` (`id`),
  KEY `ppmp_id` (`ppmp_id`),
  CONSTRAINT `ppmp_id` FOREIGN KEY (`ppmp_id`) REFERENCES `procurement_plans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of procurement_plan_details
-- ----------------------------
INSERT INTO `procurement_plan_details` VALUES ('1', '241', 'HONDA XRM 125 (Motorcycle) with Plate No. SH 9378', '1.0000', '2', '1400.00', '1', '2', null, null, null, null, null, null, null);
INSERT INTO `procurement_plan_details` VALUES ('4', '245', 'Tire, 80/80X17', '1.0000', '3', '1600.00', '3', '2', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `procurement_plan_schedules`
-- ----------------------------
DROP TABLE IF EXISTS `procurement_plan_schedules`;
CREATE TABLE `procurement_plan_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ppmp_details_id` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `pr_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of procurement_plan_schedules
-- ----------------------------
INSERT INTO `procurement_plan_schedules` VALUES ('1', '1', '1', '9', null);
INSERT INTO `procurement_plan_schedules` VALUES ('2', '1', '3', '5', null);
INSERT INTO `procurement_plan_schedules` VALUES ('3', '1', '7', '10', null);
INSERT INTO `procurement_plan_schedules` VALUES ('4', '4', '1', '5', null);
INSERT INTO `procurement_plan_schedules` VALUES ('5', '4', '2', '7', null);
INSERT INTO `procurement_plan_schedules` VALUES ('6', '4', '9', '21', null);

-- ----------------------------
-- Table structure for `purchased_items`
-- ----------------------------
DROP TABLE IF EXISTS `purchased_items`;
CREATE TABLE `purchased_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty` double DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `description` text,
  `cost` double DEFAULT NULL,
  `classification_number` varchar(50) DEFAULT NULL,
  `property_number` varchar(50) DEFAULT NULL,
  `article` varchar(50) DEFAULT NULL,
  `lgu` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchased_items
-- ----------------------------

-- ----------------------------
-- Table structure for `purchase_requests`
-- ----------------------------
DROP TABLE IF EXISTS `purchase_requests`;
CREATE TABLE `purchase_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL,
  `sai_no` varchar(50) DEFAULT NULL,
  `sai_date` datetime DEFAULT NULL,
  `alobs_no` varchar(50) DEFAULT NULL,
  `alobs_date` datetime DEFAULT NULL,
  `quarter` int(11) DEFAULT NULL,
  `purpose` text,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pr_id` (`id`),
  KEY `dept_id` (`department_id`),
  CONSTRAINT `dept_id` FOREIGN KEY (`department_id`) REFERENCES `offices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchase_requests
-- ----------------------------
INSERT INTO `purchase_requests` VALUES ('1', '1', null, null, null, null, null, 'Repair and maintenance of Office Vehicle', '1', '2016-06-14', null, null);
INSERT INTO `purchase_requests` VALUES ('7', '1', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '4', '<p>asdf asdf asdfasdfasdfasdfasdf</p>', '1', '2016-06-20', null, null);
INSERT INTO `purchase_requests` VALUES ('8', '1', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '3', '<p>AsCEX Testing</p>', '1', '2016-06-20', null, null);
INSERT INTO `purchase_requests` VALUES ('9', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '3', '<p>testing&nbsp;</p>', '1', '2016-06-22', null, null);
INSERT INTO `purchase_requests` VALUES ('10', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '3', '<p>rdthfhdfhdf</p>', '1', '2016-06-22', null, null);
INSERT INTO `purchase_requests` VALUES ('11', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '3', '', '1', '2016-06-22', null, null);
INSERT INTO `purchase_requests` VALUES ('12', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '3', '', '1', '2016-06-22', null, null);
INSERT INTO `purchase_requests` VALUES ('13', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '3', '', '1', '2016-06-22', null, null);
INSERT INTO `purchase_requests` VALUES ('14', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', '1', '2016-06-22', null, null);
INSERT INTO `purchase_requests` VALUES ('15', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', '1', '2016-06-22', null, null);
INSERT INTO `purchase_requests` VALUES ('16', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', '1', '2016-06-22', null, null);

-- ----------------------------
-- Table structure for `purchase_request_items`
-- ----------------------------
DROP TABLE IF EXISTS `purchase_request_items`;
CREATE TABLE `purchase_request_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_id` int(11) DEFAULT NULL,
  `ppmp_details_id` int(11) DEFAULT NULL,
  `qty` decimal(11,4) DEFAULT NULL,
  `description` text,
  `cost` decimal(11,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchase_request_items
-- ----------------------------
INSERT INTO `purchase_request_items` VALUES ('1', '1', '1', '1.0000', 'Labor/Materials for the Repair/Pull Out and installation of tires and tube, hand grip and brake shoe.', '1400.0000');
INSERT INTO `purchase_request_items` VALUES ('2', '1', '4', '1.0000', null, '1600.0000');
INSERT INTO `purchase_request_items` VALUES ('34', '8', '1', '10.0000', null, '583.3333');
INSERT INTO `purchase_request_items` VALUES ('35', '8', '4', '0.0000', null, '0.0000');
INSERT INTO `purchase_request_items` VALUES ('36', '9', '1', '0.0000', '', '0.0000');
INSERT INTO `purchase_request_items` VALUES ('37', '10', '1', '0.0000', '', '0.0000');
INSERT INTO `purchase_request_items` VALUES ('38', '10', '4', '0.0000', '', '0.0000');
INSERT INTO `purchase_request_items` VALUES ('39', '11', '1', '0.0000', '', '0.0000');
INSERT INTO `purchase_request_items` VALUES ('40', '11', '4', '0.0000', '', '0.0000');
INSERT INTO `purchase_request_items` VALUES ('41', '15', '1', '9.0000', '<p>\r\n\r\nLabor/Materials for the Repair/Pull Out and installation of tires and tube, hand grip and brake shoe.\r\n\r\n<br></p>', '525.0000');
INSERT INTO `purchase_request_items` VALUES ('42', '15', '4', '12.0000', '<p>Tired Lagi</p>', '581.8182');
INSERT INTO `purchase_request_items` VALUES ('43', '16', '4', '12.0000', '', '581.8182');
INSERT INTO `purchase_request_items` VALUES ('44', '16', '1', '9.0000', '', '525.0000');

-- ----------------------------
-- Table structure for `purchase_request_item_details`
-- ----------------------------
DROP TABLE IF EXISTS `purchase_request_item_details`;
CREATE TABLE `purchase_request_item_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_item_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `cost` decimal(11,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchase_request_item_details
-- ----------------------------
INSERT INTO `purchase_request_item_details` VALUES ('1', '1', 'Materials Parts', null, null);
INSERT INTO `purchase_request_item_details` VALUES ('2', '1', 'Labor', 'Pull-out and Installation of tires and tube, hand grip and bulb', '500.0000');
INSERT INTO `purchase_request_item_details` VALUES ('3', null, 'Labor', 'Pull-out and Installation of tires and tube, hand grip and bulb', '500.0000');
INSERT INTO `purchase_request_item_details` VALUES ('4', '41', 'Labor', 'Pull-out and Installation of tires and tube, hand grip and bulb', '500.0000');
INSERT INTO `purchase_request_item_details` VALUES ('5', '41', 'Material Parts', '', '0.0000');

-- ----------------------------
-- Table structure for `purchase_request_item_detail_specs`
-- ----------------------------
DROP TABLE IF EXISTS `purchase_request_item_detail_specs`;
CREATE TABLE `purchase_request_item_detail_specs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prid_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `qty` decimal(11,4) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `cost` decimal(11,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchase_request_item_detail_specs
-- ----------------------------
INSERT INTO `purchase_request_item_detail_specs` VALUES ('1', '1', 'Hand Grip', '1.0000', '1', '400.0000');
INSERT INTO `purchase_request_item_detail_specs` VALUES ('2', '1', 'Brake Shoe', '1.0000', '1', '500.0000');
INSERT INTO `purchase_request_item_detail_specs` VALUES ('7', '5', 'Hand Grip', '1.0000', '1', '400.0000');
INSERT INTO `purchase_request_item_detail_specs` VALUES ('8', '5', 'Brake Shoe', '1.0000', '1', '500.0000');

-- ----------------------------
-- Table structure for `source_funds`
-- ----------------------------
DROP TABLE IF EXISTS `source_funds`;
CREATE TABLE `source_funds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of source_funds
-- ----------------------------
INSERT INTO `source_funds` VALUES ('1', 'General Funds');
INSERT INTO `source_funds` VALUES ('2', 'Trust Funds');

-- ----------------------------
-- Table structure for `sub_categories`
-- ----------------------------
DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sub_categories
-- ----------------------------
INSERT INTO `sub_categories` VALUES ('1', '1', '1', 'Sample Category');

-- ----------------------------
-- Table structure for `units`
-- ----------------------------
DROP TABLE IF EXISTS `units`;
CREATE TABLE `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of units
-- ----------------------------
INSERT INTO `units` VALUES ('1', 'Set');
INSERT INTO `units` VALUES ('2', 'Lot');
INSERT INTO `units` VALUES ('3', 'Pcs');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', null, null, null, '1268889823', '1466641314', '1', 'Admin', 'istrator', 'ADMIN', '0');
INSERT INTO `users` VALUES ('2', '::1', 'ascex', '$2y$08$hvLIMzOZX9Wc4xwawfpgkugIfP3w/6ajgCHlTzMc8x4WUnz6QwjIK', null, 'yiu.ascex@gmail.com', null, null, null, null, '1465946298', '1465946765', '1', 'Allan', 'Cabusora', '1', '9285487265');

-- ----------------------------
-- Table structure for `users_groups`
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_groups
-- ----------------------------
INSERT INTO `users_groups` VALUES ('5', '1', '1');
INSERT INTO `users_groups` VALUES ('6', '1', '2');
INSERT INTO `users_groups` VALUES ('7', '2', '2');
