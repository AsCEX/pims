/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : pims02

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-07-01 12:16:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_access_lists`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_access_lists`;
CREATE TABLE `tbl_access_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_access_lists
-- ----------------------------
INSERT INTO `tbl_access_lists` VALUES ('1', '1', 'procurement_plan', null);
INSERT INTO `tbl_access_lists` VALUES ('2', '1', 'purchased_request', null);
INSERT INTO `tbl_access_lists` VALUES ('3', '1', 'purchased_order', null);
INSERT INTO `tbl_access_lists` VALUES ('4', '1', 'groups', null);
INSERT INTO `tbl_access_lists` VALUES ('5', '1', 'categories', null);
INSERT INTO `tbl_access_lists` VALUES ('6', '1', 'suppliers', null);
INSERT INTO `tbl_access_lists` VALUES ('7', '1', 'offices', null);
INSERT INTO `tbl_access_lists` VALUES ('8', '1', 'units', null);
INSERT INTO `tbl_access_lists` VALUES ('9', '1', 'users', null);

-- ----------------------------
-- Table structure for `tbl_categories`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_categories`;
CREATE TABLE `tbl_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_code` varchar(20) DEFAULT NULL,
  `cat_description` text,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `code` (`cat_code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_categories
-- ----------------------------
INSERT INTO `tbl_categories` VALUES ('1', 'AV-A', 'Audio-Video Equipment - A');
INSERT INTO `tbl_categories` VALUES ('2', 'AV-B', 'Audio-Video Equipment - B');
INSERT INTO `tbl_categories` VALUES ('3', 'AV-C', 'Auido-Video Equipment - C');
INSERT INTO `tbl_categories` VALUES ('4', 'asdfasdfa', 'sdfasd asdfasafdasdfa');
INSERT INTO `tbl_categories` VALUES ('5', 'AVR', 'AVVEERSSFA');
INSERT INTO `tbl_categories` VALUES ('6', 'ASCEX', 'AsssCEX');
INSERT INTO `tbl_categories` VALUES ('7', '23141', 'asdfasd fasdfasfa');
INSERT INTO `tbl_categories` VALUES ('8', '131', 'sdfasdfa');

-- ----------------------------
-- Table structure for `tbl_groups`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_groups`;
CREATE TABLE `tbl_groups` (
  `grp_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `grp_name` varchar(20) NOT NULL,
  `grp_description` varchar(100) NOT NULL,
  PRIMARY KEY (`grp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_groups
-- ----------------------------
INSERT INTO `tbl_groups` VALUES ('1', 'admin', 'Administrator');
INSERT INTO `tbl_groups` VALUES ('2', 'members', 'General User');
INSERT INTO `tbl_groups` VALUES ('3', 'Test', 'teststsets');
INSERT INTO `tbl_groups` VALUES ('4', 'asdfasd', ' fasdf asfa');
INSERT INTO `tbl_groups` VALUES ('5', 'asdfasdf', 'ASSSSSCEXXXXXXXX ');
INSERT INTO `tbl_groups` VALUES ('6', 'rtutiters', 'asdfasd fasdfasdfasd fasda');
INSERT INTO `tbl_groups` VALUES ('7', 'adsfa', 'sdfasdfasdfa');
INSERT INTO `tbl_groups` VALUES ('8', 'asdfasd', 'fasdfasdaf');
INSERT INTO `tbl_groups` VALUES ('9', 'adfas', 'dfasdfa');
INSERT INTO `tbl_groups` VALUES ('10', 'asdfa', 'sdfasdfa');
INSERT INTO `tbl_groups` VALUES ('11', 'asdfa', 'sdfadfasa');
INSERT INTO `tbl_groups` VALUES ('12', 'adsfas', 'fasdf asdfa sdfasa');

-- ----------------------------
-- Table structure for `tbl_login_attempts`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_login_attempts`;
CREATE TABLE `tbl_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_login_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_offices`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_offices`;
CREATE TABLE `tbl_offices` (
  `ofc_id` int(11) NOT NULL AUTO_INCREMENT,
  `ofc_initial` varchar(10) DEFAULT NULL,
  `ofc_code` varchar(10) DEFAULT NULL,
  `ofc_name` varchar(100) DEFAULT NULL,
  `ofc_parent_id` int(11) DEFAULT NULL,
  `ofc_created_by` int(11) DEFAULT NULL,
  `ofc_created_date` date DEFAULT NULL,
  `ofc_modified_by` int(11) DEFAULT NULL,
  `ofc_modified_date` date DEFAULT NULL,
  `ofc_deleted_by` int(11) DEFAULT NULL,
  `ofc_deleted_date` date DEFAULT NULL,
  `ofc_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ofc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_offices
-- ----------------------------
INSERT INTO `tbl_offices` VALUES ('1', 'CMO', '1011', 'City Mayor\'s Office', null, '1', '2016-06-14', null, null, null, null, '0');
INSERT INTO `tbl_offices` VALUES ('2', 'SP', '3392', 'Sangguniang Panlungsod Office - Executive Services', null, '1', '2016-06-14', null, null, null, null, '0');
INSERT INTO `tbl_offices` VALUES ('3', '1asdfa', '21', 'sdfasdfaa1111111111', null, null, null, null, null, null, null, '0');
INSERT INTO `tbl_offices` VALUES ('4', 'asdfasdf', '212', 'sdfasdfasdfa', null, null, null, null, null, null, null, '0');
INSERT INTO `tbl_offices` VALUES ('5', 'adfasd fas', '322', 'dfasdfa dsa', null, null, null, null, null, null, null, '0');
INSERT INTO `tbl_offices` VALUES ('6', 'FSDF', '2322', 'FASDFASDFASDFS', null, null, null, null, null, null, null, '0');
INSERT INTO `tbl_offices` VALUES ('7', 'ASCEXSAXCX', '322', 'GSCG', null, null, null, null, null, null, null, '0');
INSERT INTO `tbl_offices` VALUES ('8', 'AsDSFSDF', '321', 'adfa sdfa sdfaa', null, null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for `tbl_procurement_plans`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_procurement_plans`;
CREATE TABLE `tbl_procurement_plans` (
  `ppmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `ppmp_code` int(11) DEFAULT NULL,
  `ppmp_description` text,
  `ppmp_qty` decimal(11,4) DEFAULT NULL,
  `ppmp_unit` int(11) DEFAULT NULL,
  `ppmp_budget` decimal(11,2) DEFAULT NULL,
  `ppmp_category_id` int(11) DEFAULT NULL,
  `ppmp_office_id` int(11) DEFAULT NULL,
  `ppmp_source_fund` int(11) DEFAULT NULL,
  `ppmp_created_date` datetime DEFAULT NULL,
  `ppmp_created_by` int(11) DEFAULT NULL,
  `ppmp_modified_date` datetime DEFAULT NULL,
  `ppmp_modified_by` int(11) DEFAULT NULL,
  `ppmp_deleted_date` date DEFAULT NULL,
  `ppmp_deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`ppmp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_procurement_plans
-- ----------------------------
INSERT INTO `tbl_procurement_plans` VALUES ('1', '2412', 'testetstess', null, '1', '12000.00', '2', '2', '1', '2016-06-30 00:00:00', '1', null, null, null, null);
INSERT INTO `tbl_procurement_plans` VALUES ('2', '231', 'adsfasd asd faasdf asdfaasdfasdfa', null, '1', '34234222.00', '1', '1', '1', '2016-06-29 00:00:00', '1', null, null, null, null);

-- ----------------------------
-- Table structure for `tbl_procurement_plan_schedules`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_procurement_plan_schedules`;
CREATE TABLE `tbl_procurement_plan_schedules` (
  `pps_id` int(11) NOT NULL AUTO_INCREMENT,
  `pps_ppmp_id` int(11) DEFAULT NULL,
  `pps_month` int(11) DEFAULT NULL,
  `pps_value` double DEFAULT NULL,
  `pps_pr_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pps_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_procurement_plan_schedules
-- ----------------------------
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('25', '2', '1', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('26', '2', '2', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('27', '2', '3', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('28', '2', '4', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('29', '2', '5', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('30', '2', '6', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('31', '2', '7', '10', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('32', '2', '8', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('33', '2', '9', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('34', '2', '10', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('35', '2', '11', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('36', '2', '12', '0', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('49', '1', '1', '1', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('50', '1', '2', '1', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('51', '1', '3', '1', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('52', '1', '4', '1', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('53', '1', '5', '1', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('54', '1', '6', '1', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('55', '1', '7', '1', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('56', '1', '8', '1', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('57', '1', '9', '1', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('58', '1', '10', '1', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('59', '1', '11', '1', null);
INSERT INTO `tbl_procurement_plan_schedules` VALUES ('60', '1', '12', '1', null);

-- ----------------------------
-- Table structure for `tbl_purchased_order`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchased_order`;
CREATE TABLE `tbl_purchased_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
  `address` text,
  `gentlemen` text,
  `mode_of_procurment` int(11) DEFAULT NULL,
  `place_of_delivery` text,
  `date_of_delivery` text,
  `delivery_term` varchar(50) DEFAULT NULL,
  `payment_term` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchased_order
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_purchased_order_items`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchased_order_items`;
CREATE TABLE `tbl_purchased_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty` int(11) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `description` text,
  `unit_cost` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchased_order_items
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_purchase_requests`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase_requests`;
CREATE TABLE `tbl_purchase_requests` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_department_id` int(11) DEFAULT NULL,
  `pr_sai_no` varchar(50) DEFAULT NULL,
  `pr_sai_date` datetime DEFAULT NULL,
  `pr_alobs_no` varchar(50) DEFAULT NULL,
  `pr_alobs_date` datetime DEFAULT NULL,
  `pr_quarter` int(11) DEFAULT NULL,
  `pr_section` varchar(100) DEFAULT NULL,
  `pr_requested_by` int(11) DEFAULT NULL,
  `pr_purpose` text,
  `pr_created_by` int(11) DEFAULT NULL,
  `pr_created_date` date DEFAULT NULL,
  `pr_modified_by` int(11) DEFAULT NULL,
  `pr_modified_date` date DEFAULT NULL,
  PRIMARY KEY (`pr_id`),
  UNIQUE KEY `pr_id` (`pr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase_requests
-- ----------------------------
INSERT INTO `tbl_purchase_requests` VALUES ('1', '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2', 'Testing the Process', '1', '2016-06-29', '1', '2016-06-29');
INSERT INTO `tbl_purchase_requests` VALUES ('2', '2', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2', 'Naedit na PR2', '1', '2016-06-29', '1', '2016-06-29');
INSERT INTO `tbl_purchase_requests` VALUES ('3', '1', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', '2', '', '1', '2016-06-29', null, null);
INSERT INTO `tbl_purchase_requests` VALUES ('4', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', null, 'ladfasf as fasdfa as fa', '1', '2016-06-30', null, null);
INSERT INTO `tbl_purchase_requests` VALUES ('5', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', null, 'ladfasf as fasdfa as fa', '1', '2016-06-30', null, null);
INSERT INTO `tbl_purchase_requests` VALUES ('6', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', null, 'ladfasf as fasdfa as fa', '1', '2016-06-30', null, null);
INSERT INTO `tbl_purchase_requests` VALUES ('7', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', null, 'ladfasf as fasdfa as fa', '1', '2016-06-30', null, null);
INSERT INTO `tbl_purchase_requests` VALUES ('8', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', null, 'ladfasf as fasdfa as fa', '1', '2016-06-30', null, null);
INSERT INTO `tbl_purchase_requests` VALUES ('9', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', null, 'ladfasf as fasdfa as fa', '1', '2016-06-30', null, null);
INSERT INTO `tbl_purchase_requests` VALUES ('10', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', null, 'ladfasf as fasdfa as fa', '1', '2016-06-30', null, null);
INSERT INTO `tbl_purchase_requests` VALUES ('11', '2', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '1', '', null, '', '1', '2016-06-30', null, null);

-- ----------------------------
-- Table structure for `tbl_purchase_request_items`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase_request_items`;
CREATE TABLE `tbl_purchase_request_items` (
  `pri_id` int(11) NOT NULL AUTO_INCREMENT,
  `pri_pr_id` int(11) DEFAULT NULL,
  `pri_ppmp_id` int(11) DEFAULT NULL,
  `pri_qty` decimal(11,4) DEFAULT NULL,
  `pri_description` text,
  `pri_cost` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`pri_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase_request_items
-- ----------------------------
INSERT INTO `tbl_purchase_request_items` VALUES ('1', '1', '1', '3.0000', '', '3000.00');
INSERT INTO `tbl_purchase_request_items` VALUES ('2', '2', '1', '3.0000', 'test', '3000.00');
INSERT INTO `tbl_purchase_request_items` VALUES ('3', '3', '1', '3.0000', '', '3000.00');
INSERT INTO `tbl_purchase_request_items` VALUES ('4', '10', '1', '3.0000', '', '3000.00');
INSERT INTO `tbl_purchase_request_items` VALUES ('5', '11', '1', '3.0000', '', '3000.00');

-- ----------------------------
-- Table structure for `tbl_purchase_request_item_details`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase_request_item_details`;
CREATE TABLE `tbl_purchase_request_item_details` (
  `prid_id` int(11) NOT NULL AUTO_INCREMENT,
  `prid_pri_id` int(11) DEFAULT NULL,
  `prid_title` varchar(50) DEFAULT NULL,
  `prid_description` text,
  `prid_cost` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`prid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase_request_item_details
-- ----------------------------
INSERT INTO `tbl_purchase_request_item_details` VALUES ('16', '2', 'asdf', 'asdfasd', '0.00');

-- ----------------------------
-- Table structure for `tbl_purchase_request_item_detail_specs`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase_request_item_detail_specs`;
CREATE TABLE `tbl_purchase_request_item_detail_specs` (
  `prs_id` int(11) NOT NULL AUTO_INCREMENT,
  `prs_prid_id` int(11) DEFAULT NULL,
  `prs_name` varchar(50) DEFAULT NULL,
  `prs_qty` decimal(11,4) DEFAULT NULL,
  `prs_unit` int(11) DEFAULT NULL,
  `prs_cost` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`prs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_purchase_request_item_detail_specs
-- ----------------------------
INSERT INTO `tbl_purchase_request_item_detail_specs` VALUES ('19', '16', 'adsfasdfa1', '121.0000', '1', '121.00');
INSERT INTO `tbl_purchase_request_item_detail_specs` VALUES ('20', '16', 'asdasdf', '12.0000', '1', '0.00');
INSERT INTO `tbl_purchase_request_item_detail_specs` VALUES ('21', '16', 'asdfasdf', '2.0000', '1', '121.00');

-- ----------------------------
-- Table structure for `tbl_source_funds`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_source_funds`;
CREATE TABLE `tbl_source_funds` (
  `fund_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`fund_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_source_funds
-- ----------------------------
INSERT INTO `tbl_source_funds` VALUES ('1', 'General Funds');
INSERT INTO `tbl_source_funds` VALUES ('2', 'Trust Funds');

-- ----------------------------
-- Table structure for `tbl_sub_categories`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sub_categories`;
CREATE TABLE `tbl_sub_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_sub_categories
-- ----------------------------
INSERT INTO `tbl_sub_categories` VALUES ('1', '1', '1', 'Sample Category');

-- ----------------------------
-- Table structure for `tbl_suppliers`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_suppliers`;
CREATE TABLE `tbl_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `ext_name` varchar(5) DEFAULT NULL,
  `address` text,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_suppliers
-- ----------------------------
INSERT INTO `tbl_suppliers` VALUES ('1', 'Mocks', 'Allan', 'S', 'Cabusora', '', 'SIR Matina, Sandawa Pogi St', null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for `tbl_units`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_units`;
CREATE TABLE `tbl_units` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_units
-- ----------------------------
INSERT INTO `tbl_units` VALUES ('1', 'set');
INSERT INTO `tbl_units` VALUES ('2', 'lot');
INSERT INTO `tbl_units` VALUES ('3', 'pcs');
INSERT INTO `tbl_units` VALUES ('4', 'units');
INSERT INTO `tbl_units` VALUES ('5', 'asdfasdfa');
INSERT INTO `tbl_units` VALUES ('6', 'asdf asdf asdfaa4444');

-- ----------------------------
-- Table structure for `tbl_users`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(100) DEFAULT NULL,
  `u_password` varchar(255) DEFAULT NULL,
  `u_email` varchar(255) DEFAULT NULL,
  `u_firstname` varchar(50) DEFAULT NULL,
  `u_middlename` varchar(50) DEFAULT NULL,
  `u_lastname` varchar(50) DEFAULT NULL,
  `u_extname` varchar(10) DEFAULT NULL,
  `u_department_id` int(11) DEFAULT NULL,
  `u_grp_id` int(11) DEFAULT NULL,
  `u_created_on` datetime DEFAULT NULL,
  `u_created_by` int(11) DEFAULT NULL,
  `u_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'yiu.ascex@gmail.com', 'Allan', 'S', 'Cabusora', null, '1', '1', '2016-06-29 16:21:47', null, '0');

-- ----------------------------
-- Table structure for `tbl_users_groups`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users_groups`;
CREATE TABLE `tbl_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `tbl_groups` (`grp_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users_groups
-- ----------------------------
INSERT INTO `tbl_users_groups` VALUES ('5', '1', '1');
INSERT INTO `tbl_users_groups` VALUES ('6', '1', '2');
INSERT INTO `tbl_users_groups` VALUES ('7', '2', '2');

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
INSERT INTO `users` VALUES ('1', '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', null, null, null, '1268889823', '1467337926', '1', 'Admin', 'istrator', '1', '0');
INSERT INTO `users` VALUES ('2', '::1', 'ascex', '$2y$08$hvLIMzOZX9Wc4xwawfpgkugIfP3w/6ajgCHlTzMc8x4WUnz6QwjIK', null, 'yiu.ascex@gmail.com', null, null, null, null, '1465946298', '1465946765', '1', 'Allan', 'Cabusora', '1', '9285487265');
