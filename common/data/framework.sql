/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : framework

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-05-29 13:37:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for app_activity
-- ----------------------------
DROP TABLE IF EXISTS `app_activity`;
CREATE TABLE `app_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'lookup:@app_user',
  `object_id` varchar(100) NOT NULL,
  `object_type` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL COMMENT 'data:like,share,favourite,rate',
  `user_type` varchar(100) DEFAULT NULL COMMENT 'data:app_user,user',
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of app_activity
-- ----------------------------
INSERT INTO `app_activity` VALUES ('1', '15', '1', 'business_company', 'like', 'app_user', '2018-09-20 10:23:56', null);

-- ----------------------------
-- Table structure for app_auth
-- ----------------------------
DROP TABLE IF EXISTS `app_auth`;
CREATE TABLE `app_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'LOOKUP:app_user|id|name',
  `source` varchar(255) NOT NULL,
  `source_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk-auth-user_id-user-id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of app_auth
-- ----------------------------

-- ----------------------------
-- Table structure for app_device
-- ----------------------------
DROP TABLE IF EXISTS `app_device`;
CREATE TABLE `app_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'LOOKUP:app_user|id|name',
  `imei` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL COMMENT 'DROPDOWN:android|ios',
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of app_device
-- ----------------------------
INSERT INTO `app_device` VALUES ('1', '1', '123', '123', 'android', '1');

-- ----------------------------
-- Table structure for app_meta
-- ----------------------------
DROP TABLE IF EXISTS `app_meta`;
CREATE TABLE `app_meta` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `meta_key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `meta_value` text CHARACTER SET utf8,
  `last_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of app_meta
-- ----------------------------
INSERT INTO `app_meta` VALUES ('1', '1', 'latitude', '21.027763', null);
INSERT INTO `app_meta` VALUES ('2', '1', 'longitude', '105.834160', null);
INSERT INTO `app_meta` VALUES ('3', '1', 'weight', '65', null);
INSERT INTO `app_meta` VALUES ('4', '1', 'height', '172', null);
INSERT INTO `app_meta` VALUES ('5', '1', 'balance', '9999999', null);
INSERT INTO `app_meta` VALUES ('6', '1', 'rate', '10', null);
INSERT INTO `app_meta` VALUES ('7', '1', 'rate_count', '1', null);
INSERT INTO `app_meta` VALUES ('9', '1', 'last_login', '1554276068', null);
INSERT INTO `app_meta` VALUES ('10', '1', 'last_activity', '1554276068', null);

-- ----------------------------
-- Table structure for app_rank
-- ----------------------------
DROP TABLE IF EXISTS `app_rank`;
CREATE TABLE `app_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `icon` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of app_rank
-- ----------------------------

-- ----------------------------
-- Table structure for app_token
-- ----------------------------
DROP TABLE IF EXISTS `app_token`;
CREATE TABLE `app_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'LOOKUP:app_user|id|name',
  `token` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `is_expired` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of app_token
-- ----------------------------
INSERT INTO `app_token` VALUES ('1', '1', 'e9aa58a536f8b54e79f3331520dfa4ba', '1539227289', null);

-- ----------------------------
-- Table structure for app_transaction
-- ----------------------------
DROP TABLE IF EXISTS `app_transaction`;
CREATE TABLE `app_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) NOT NULL,
  `external_transaction_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'LOOKUP:app_user|id|name',
  `object_id` int(11) DEFAULT NULL,
  `object_type` varchar(100) DEFAULT NULL COMMENT 'DROPDOWN:order|user',
  `currency` varchar(100) DEFAULT NULL COMMENT 'DROPDOWN:usd|vnd',
  `amount` double(20,2) DEFAULT '0.00',
  `payment_method` varchar(100) DEFAULT NULL COMMENT 'DROPDOWN:point|online',
  `payment_gateway` varchar(200) DEFAULT NULL COMMENT 'DROPDOWN:paypal|system',
  `note` varchar(2000) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL COMMENT 'DROPDOWN:buy|charge|deposit',
  `status` varchar(100) DEFAULT NULL COMMENT 'DROPDOWN:fail|done|pending',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of app_transaction
-- ----------------------------

-- ----------------------------
-- Table structure for app_user
-- ----------------------------
DROP TABLE IF EXISTS `app_user`;
CREATE TABLE `app_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_id` int(11) DEFAULT '0',
  `auth_key` varchar(32) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `content` text,
  `gender` varchar(100) DEFAULT NULL COMMENT 'DROPDOWN:male|female|other',
  `dob` varchar(255) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `role` int(2) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `is_online` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_date` varchar(20) DEFAULT NULL,
  `modified_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of app_user
-- ----------------------------
INSERT INTO `app_user` VALUES ('1', 'coconut.jpg', 'Coconut', 'immrhy@gmail.com', 'immrhy@gmail.com', '$2y$13$MCbCnbEqgEZ8NeSOcNtg3.zAY3KiLEqvNOWFZ6QAE39ecaW7V2nh2', '0', 'HXzh_jwd58-Grh_Q5G8snjluwzUo3RmV', null, '5a984c825385d7ca20a6c9e3ecb5b6a1', null, null, '', null, '', '', null, null, null, null, null, 'normal', '1', '1', '2018-10-11 09:58:47', null);

-- ----------------------------
-- Table structure for game
-- ----------------------------
DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link_url` varchar(1000) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `is_fake` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of game
-- ----------------------------
INSERT INTO `game` VALUES ('1', 'Game 1', '1557133786275_game_icon.jpg', 'https://www.facebook.com/vn88banca', '1', '0', '1', '2019-05-06 11:09:46', null);
INSERT INTO `game` VALUES ('2', 'Game 2', '1557133799352_game_icon.jpg', 'https://www.facebook.com/vn88banca', '2', '1', '1', '2019-05-06 11:09:59', null);

-- ----------------------------
-- Table structure for game_banner
-- ----------------------------
DROP TABLE IF EXISTS `game_banner`;
CREATE TABLE `game_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `platform` varchar(100) DEFAULT NULL COMMENT 'DROPDOWN:android|ios',
  `link_url` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL COMMENT 'DROPDOWN:vertical|horizontal',
  `position` varchar(100) DEFAULT NULL COMMENT 'DROPDOWN:center|top|left|right|bottom',
  `sort_order` int(11) DEFAULT '0',
  `is_active` tinyint(1) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of game_banner
-- ----------------------------
INSERT INTO `game_banner` VALUES ('1', 'Banner 1', '1557133264456_banner_image.png', 'android', 'https://www.facebook.com/vn88banca', '', '', '1', '1', '2019-05-06 11:01:04', '2019-05-08 07:05:43');
INSERT INTO `game_banner` VALUES ('2', 'Banner 2', '1557133295757_banner_image.jpeg', 'ios', 'https://www.facebook.com/vn88banca', '', '', '2', '1', '2019-05-06 11:01:35', '2019-05-08 07:05:51');

-- ----------------------------
-- Table structure for game_menu
-- ----------------------------
DROP TABLE IF EXISTS `game_menu`;
CREATE TABLE `game_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link_url` varchar(1000) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `is_fake` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of game_menu
-- ----------------------------
INSERT INTO `game_menu` VALUES ('1', 'Menu 1', '1557133359703_menu_icon.jpg', 'https://www.facebook.com/vn88banca', '1', '0', '1', '2019-05-06 11:02:39', null);
INSERT INTO `game_menu` VALUES ('2', 'Menu 2', '1557133376984_menu_icon.jpg', 'https://www.facebook.com/vn88banca', '2', '0', '1', '2019-05-06 11:02:56', null);

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1548921270');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1548921273');
INSERT INTO `migration` VALUES ('m190131_070434_drop_user_table', '1548921273');
INSERT INTO `migration` VALUES ('m190131_072908_create_table_app_auth', '1548921274');
INSERT INTO `migration` VALUES ('m190131_072959_create_table_app_device', '1548921274');
INSERT INTO `migration` VALUES ('m190131_073007_create_table_app_membership', '1548921275');
INSERT INTO `migration` VALUES ('m190131_073015_create_table_app_token', '1548921275');
INSERT INTO `migration` VALUES ('m190131_073026_create_table_app_user', '1548921277');
INSERT INTO `migration` VALUES ('m190131_073037_create_table_application', '1548921277');
INSERT INTO `migration` VALUES ('m190131_073046_create_table_blog_comment', '1548921278');
INSERT INTO `migration` VALUES ('m190131_073054_create_table_blog_post', '1548921278');
INSERT INTO `migration` VALUES ('m190131_073102_create_table_cms_employee', '1548921279');
INSERT INTO `migration` VALUES ('m190131_073113_create_table_cms_faq', '1548921279');
INSERT INTO `migration` VALUES ('m190131_073123_create_table_cms_partner', '1548921280');
INSERT INTO `migration` VALUES ('m190131_073131_create_table_cms_service', '1548921280');
INSERT INTO `migration` VALUES ('m190131_073140_create_table_cms_testimonial', '1548921280');
INSERT INTO `migration` VALUES ('m190131_073148_create_table_content', '1548921281');
INSERT INTO `migration` VALUES ('m190131_073156_create_table_content_author', '1548921281');
INSERT INTO `migration` VALUES ('m190131_073207_create_table_content_book', '1548921282');
INSERT INTO `migration` VALUES ('m190131_073216_create_table_content_course', '1548921282');
INSERT INTO `migration` VALUES ('m190131_073227_create_table_content_digital', '1548921282');
INSERT INTO `migration` VALUES ('m190131_073236_create_table_content_genre', '1548921283');
INSERT INTO `migration` VALUES ('m190131_073245_create_table_content_group', '1548921283');
INSERT INTO `migration` VALUES ('m190131_073255_create_table_content_item', '1548921283');
INSERT INTO `migration` VALUES ('m190131_073304_create_table_content_mood', '1548921284');
INSERT INTO `migration` VALUES ('m190131_073313_create_table_content_movie', '1548921284');
INSERT INTO `migration` VALUES ('m190131_073321_create_table_content_music', '1548921285');
INSERT INTO `migration` VALUES ('m190131_073330_create_table_ecommerce_attribute', '1548921285');
INSERT INTO `migration` VALUES ('m190131_073340_create_table_ecommerce_brand', '1548921286');
INSERT INTO `migration` VALUES ('m190131_073349_create_table_ecommerce_category', '1548921286');
INSERT INTO `migration` VALUES ('m190131_073358_create_table_ecommerce_comment', '1548921286');
INSERT INTO `migration` VALUES ('m190131_073406_create_table_ecommerce_option', '1548921287');
INSERT INTO `migration` VALUES ('m190131_073415_create_table_ecommerce_order', '1548921287');
INSERT INTO `migration` VALUES ('m190131_073427_create_table_ecommerce_order_item', '1548921288');
INSERT INTO `migration` VALUES ('m190131_073437_create_table_ecommerce_product', '1548921288');
INSERT INTO `migration` VALUES ('m190131_073449_create_table_ecommerce_provider', '1548921288');
INSERT INTO `migration` VALUES ('m190131_073458_create_table_ecommerce_shipping', '1548921289');
INSERT INTO `migration` VALUES ('m190131_073507_create_table_ecommerce_version', '1548921290');
INSERT INTO `migration` VALUES ('m190131_073518_create_table_ecommerce_version_detail', '1548921290');
INSERT INTO `migration` VALUES ('m190131_073527_create_table_ecommerce_version_option', '1548921291');
INSERT INTO `migration` VALUES ('m190131_073536_create_table_object_activity', '1548921291');
INSERT INTO `migration` VALUES ('m190131_073545_create_table_object_comment', '1548921292');
INSERT INTO `migration` VALUES ('m190131_073553_create_table_object_counter', '1548921293');
INSERT INTO `migration` VALUES ('m190131_073603_create_table_object_counter_history', '1548921294');
INSERT INTO `migration` VALUES ('m190131_073612_create_table_object_file', '1548921294');
INSERT INTO `migration` VALUES ('m190131_073621_create_table_object_relation', '1548921295');
INSERT INTO `migration` VALUES ('m190131_073630_create_table_object_review', '1548921295');
INSERT INTO `migration` VALUES ('m190131_073640_create_table_object_transaction', '1548921296');
INSERT INTO `migration` VALUES ('m190131_073652_create_table_system_category', '1548921296');
INSERT INTO `migration` VALUES ('m190131_073700_create_table_system_country', '1548921296');
INSERT INTO `migration` VALUES ('m190131_073714_create_table_system_language', '1548921297');
INSERT INTO `migration` VALUES ('m190131_073726_create_table_system_setting', '1548921297');
INSERT INTO `migration` VALUES ('m190131_073737_create_table_testtool', '1548921298');
INSERT INTO `migration` VALUES ('m190131_073745_create_table_user', '1548921299');

-- ----------------------------
-- Table structure for sample
-- ----------------------------
DROP TABLE IF EXISTS `sample`;
CREATE TABLE `sample` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'something:)',
  `category_id` int(11) DEFAULT NULL COMMENT 'LOOKUP:sample|id|name',
  `dropdown_float_key` float(11,0) DEFAULT NULL COMMENT 'DROPDOWN:{"12.5":"Xx XX","2.7":"YY i YY"}',
  `dropdown_string_value_only` varchar(255) DEFAULT '' COMMENT 'DROPDOWN:male Shit|female|unknown',
  `dropdown_json_string_key` varchar(255) DEFAULT NULL COMMENT 'DROPDOWN:{"xx":"Xx XX","yy":"YY i YY"}',
  `dropdown_json_string_number_key` int(255) DEFAULT NULL COMMENT 'DROPDOWN:{"10":"Xx XX","20":"YY i YY"}',
  `dropdown_number_value_only` varchar(255) DEFAULT NULL COMMENT 'DROPDOWN:11|222|333',
  `image` varchar(255) DEFAULT NULL COMMENT 'FILE:{"type":"image","extension":"jpg,gif,png"}',
  `attachment` varchar(255) DEFAULT NULL COMMENT 'FILE:{"type":"attachment","extension":"pdf, epub, doc, docx"}',
  `description` varchar(500) DEFAULT NULL,
  `longer_description` varchar(1000) DEFAULT NULL,
  `longest_description` varchar(2000) DEFAULT NULL,
  `content` text,
  `password` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `is_something` tinyint(1) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `release_time` time DEFAULT NULL,
  `release_datetime` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sample
-- ----------------------------
INSERT INTO `sample` VALUES ('1', '1', null, 'unknown', '', null, null, '1506079225234_testtool_image.png', '1506079225976_testtool_attachment.png', 'hehehe', null, null, null, null, '1', null, '2017-08-31', '14:30:00', '2017-08-30 22:50:00', null, null);
INSERT INTO `sample` VALUES ('3', '4', null, 'female', 'Xx XX', null, null, '1506079265907_testtool_image.png', '1506079265746_testtool_attachment.png', '121212', null, null, null, null, '1', null, '2017-09-14', '18:15:00', '2017-09-13 15:10:00', null, null);

-- ----------------------------
-- Table structure for sample_category
-- ----------------------------
DROP TABLE IF EXISTS `sample_category`;
CREATE TABLE `sample_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL COMMENT 'LOOKUP:object_category|id|name',
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sample_category
-- ----------------------------
INSERT INTO `sample_category` VALUES ('1', null, '1506079225234_testtool_image.png', '', null, '1', '2017-08-31 00:00:00', '2019-05-20 14:30:00');
INSERT INTO `sample_category` VALUES ('3', null, '1506079265907_testtool_image.png', '', null, '1', '2017-09-14 00:00:00', '2019-05-20 18:15:00');

-- ----------------------------
-- Table structure for sample_item
-- ----------------------------
DROP TABLE IF EXISTS `sample_item`;
CREATE TABLE `sample_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sample_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `content` text,
  `type` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sample_item
-- ----------------------------

-- ----------------------------
-- Table structure for sample_old
-- ----------------------------
DROP TABLE IF EXISTS `sample_old`;
CREATE TABLE `sample_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'something:)',
  `category_id` int(11) DEFAULT NULL COMMENT 'LOOKUP:object_category|id|name',
  `floet` float(11,0) DEFAULT NULL COMMENT 'DROPDOWN:{"12.5":"Xx XX","2.7":"YY i YY"}',
  `type` varchar(255) DEFAULT '' COMMENT 'DROPDOWN:male Shit|female|unknown',
  `something` varchar(255) DEFAULT NULL COMMENT 'DROPDOWN:{"xx":"Xx XX","yy":"YY i YY"}',
  `int_type` int(255) DEFAULT NULL COMMENT 'DROPDOWN:{"10":"Xx XX","20":"YY i YY"}',
  `simple` varchar(255) DEFAULT NULL COMMENT 'DROPDOWN:11|222|333',
  `image` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `release_time` time DEFAULT NULL,
  `release_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of sample_old
-- ----------------------------
INSERT INTO `sample_old` VALUES ('1', '1', null, 'unknown', '', null, null, '1506079225234_testtool_image.png', '1506079225976_testtool_attachment.png', 'hehehe', '1', '2017-08-31', '14:30:00', '2017-08-30 22:50:00');
INSERT INTO `sample_old` VALUES ('3', '4', null, 'female', 'Xx XX', null, null, '1506079265907_testtool_image.png', '1506079265746_testtool_attachment.png', '121212', '1', '2017-09-14', '18:15:00', '2017-09-13 15:10:00');

-- ----------------------------
-- Table structure for system_country
-- ----------------------------
DROP TABLE IF EXISTS `system_country`;
CREATE TABLE `system_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(255) NOT NULL DEFAULT '',
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of system_country
-- ----------------------------
INSERT INTO `system_country` VALUES ('1', 'AF', 'Afghanistan', '0');
INSERT INTO `system_country` VALUES ('2', 'AL', 'Albania', '0');
INSERT INTO `system_country` VALUES ('3', 'DZ', 'Algeria', '0');
INSERT INTO `system_country` VALUES ('4', 'DS', 'American Samoa', '0');
INSERT INTO `system_country` VALUES ('5', 'AD', 'Andorra', '0');
INSERT INTO `system_country` VALUES ('6', 'AO', 'Angola', '0');
INSERT INTO `system_country` VALUES ('7', 'AI', 'Anguilla', '0');
INSERT INTO `system_country` VALUES ('8', 'AQ', 'Antarctica', '0');
INSERT INTO `system_country` VALUES ('9', 'AG', 'Antigua and Barbuda', '0');
INSERT INTO `system_country` VALUES ('10', 'AR', 'Argentina', '0');
INSERT INTO `system_country` VALUES ('11', 'AM', 'Armenia', '0');
INSERT INTO `system_country` VALUES ('12', 'AW', 'Aruba', '0');
INSERT INTO `system_country` VALUES ('13', 'AU', 'Australia', '0');
INSERT INTO `system_country` VALUES ('14', 'AT', 'Austria', '0');
INSERT INTO `system_country` VALUES ('15', 'AZ', 'Azerbaijan', '0');
INSERT INTO `system_country` VALUES ('16', 'BS', 'Bahamas', '0');
INSERT INTO `system_country` VALUES ('17', 'BH', 'Bahrain', '0');
INSERT INTO `system_country` VALUES ('18', 'BD', 'Bangladesh', '0');
INSERT INTO `system_country` VALUES ('19', 'BB', 'Barbados', '0');
INSERT INTO `system_country` VALUES ('20', 'BY', 'Belarus', '0');
INSERT INTO `system_country` VALUES ('21', 'BE', 'Belgium', '0');
INSERT INTO `system_country` VALUES ('22', 'BZ', 'Belize', '0');
INSERT INTO `system_country` VALUES ('23', 'BJ', 'Benin', '0');
INSERT INTO `system_country` VALUES ('24', 'BM', 'Bermuda', '0');
INSERT INTO `system_country` VALUES ('25', 'BT', 'Bhutan', '0');
INSERT INTO `system_country` VALUES ('26', 'BO', 'Bolivia', '0');
INSERT INTO `system_country` VALUES ('27', 'BA', 'Bosnia and Herzegovina', '0');
INSERT INTO `system_country` VALUES ('28', 'BW', 'Botswana', '0');
INSERT INTO `system_country` VALUES ('29', 'BV', 'Bouvet Island', '0');
INSERT INTO `system_country` VALUES ('30', 'BR', 'Brazil', '0');
INSERT INTO `system_country` VALUES ('31', 'IO', 'British Indian Ocean Territory', '0');
INSERT INTO `system_country` VALUES ('32', 'BN', 'Brunei Darussalam', '0');
INSERT INTO `system_country` VALUES ('33', 'BG', 'Bulgaria', '0');
INSERT INTO `system_country` VALUES ('34', 'BF', 'Burkina Faso', '0');
INSERT INTO `system_country` VALUES ('35', 'BI', 'Burundi', '0');
INSERT INTO `system_country` VALUES ('36', 'KH', 'Cambodia', '0');
INSERT INTO `system_country` VALUES ('37', 'CM', 'Cameroon', '0');
INSERT INTO `system_country` VALUES ('38', 'CA', 'Canada', '0');
INSERT INTO `system_country` VALUES ('39', 'CV', 'Cape Verde', '0');
INSERT INTO `system_country` VALUES ('40', 'KY', 'Cayman Islands', '0');
INSERT INTO `system_country` VALUES ('41', 'CF', 'Central African Republic', '0');
INSERT INTO `system_country` VALUES ('42', 'TD', 'Chad', '0');
INSERT INTO `system_country` VALUES ('43', 'CL', 'Chile', '0');
INSERT INTO `system_country` VALUES ('44', 'CN', 'China', '0');
INSERT INTO `system_country` VALUES ('45', 'CX', 'Christmas Island', '0');
INSERT INTO `system_country` VALUES ('46', 'CC', 'Cocos (Keeling) Islands', '0');
INSERT INTO `system_country` VALUES ('47', 'CO', 'Colombia', '0');
INSERT INTO `system_country` VALUES ('48', 'KM', 'Comoros', '0');
INSERT INTO `system_country` VALUES ('49', 'CG', 'Congo', '0');
INSERT INTO `system_country` VALUES ('50', 'CK', 'Cook Islands', '0');
INSERT INTO `system_country` VALUES ('51', 'CR', 'Costa Rica', '0');
INSERT INTO `system_country` VALUES ('52', 'HR', 'Croatia (Hrvatska)', '0');
INSERT INTO `system_country` VALUES ('53', 'CU', 'Cuba', '0');
INSERT INTO `system_country` VALUES ('54', 'CY', 'Cyprus', '0');
INSERT INTO `system_country` VALUES ('55', 'CZ', 'Czech Republic', '0');
INSERT INTO `system_country` VALUES ('56', 'DK', 'Denmark', '0');
INSERT INTO `system_country` VALUES ('57', 'DJ', 'Djibouti', '0');
INSERT INTO `system_country` VALUES ('58', 'DM', 'Dominica', '0');
INSERT INTO `system_country` VALUES ('59', 'DO', 'Dominican Republic', '0');
INSERT INTO `system_country` VALUES ('60', 'TP', 'East Timor', '0');
INSERT INTO `system_country` VALUES ('61', 'EC', 'Ecuador', '0');
INSERT INTO `system_country` VALUES ('62', 'EG', 'Egypt', '0');
INSERT INTO `system_country` VALUES ('63', 'SV', 'El Salvador', '0');
INSERT INTO `system_country` VALUES ('64', 'GQ', 'Equatorial Guinea', '0');
INSERT INTO `system_country` VALUES ('65', 'ER', 'Eritrea', '0');
INSERT INTO `system_country` VALUES ('66', 'EE', 'Estonia', '0');
INSERT INTO `system_country` VALUES ('67', 'ET', 'Ethiopia', '0');
INSERT INTO `system_country` VALUES ('68', 'FK', 'Falkland Islands (Malvinas)', '0');
INSERT INTO `system_country` VALUES ('69', 'FO', 'Faroe Islands', '0');
INSERT INTO `system_country` VALUES ('70', 'FJ', 'Fiji', '0');
INSERT INTO `system_country` VALUES ('71', 'FI', 'Finland', '0');
INSERT INTO `system_country` VALUES ('72', 'FR', 'France', '0');
INSERT INTO `system_country` VALUES ('73', 'FX', 'France, Metropolitan', '0');
INSERT INTO `system_country` VALUES ('74', 'GF', 'French Guiana', '0');
INSERT INTO `system_country` VALUES ('75', 'PF', 'French Polynesia', '0');
INSERT INTO `system_country` VALUES ('76', 'TF', 'French Southern Territories', '0');
INSERT INTO `system_country` VALUES ('77', 'GA', 'Gabon', '0');
INSERT INTO `system_country` VALUES ('78', 'GM', 'Gambia', '0');
INSERT INTO `system_country` VALUES ('79', 'GE', 'Georgia', '0');
INSERT INTO `system_country` VALUES ('80', 'DE', 'Germany', '0');
INSERT INTO `system_country` VALUES ('81', 'GH', 'Ghana', '0');
INSERT INTO `system_country` VALUES ('82', 'GI', 'Gibraltar', '0');
INSERT INTO `system_country` VALUES ('83', 'GK', 'Guernsey', '0');
INSERT INTO `system_country` VALUES ('84', 'GR', 'Greece', '0');
INSERT INTO `system_country` VALUES ('85', 'GL', 'Greenland', '0');
INSERT INTO `system_country` VALUES ('86', 'GD', 'Grenada', '0');
INSERT INTO `system_country` VALUES ('87', 'GP', 'Guadeloupe', '0');
INSERT INTO `system_country` VALUES ('88', 'GU', 'Guam', '0');
INSERT INTO `system_country` VALUES ('89', 'GT', 'Guatemala', '0');
INSERT INTO `system_country` VALUES ('90', 'GN', 'Guinea', '0');
INSERT INTO `system_country` VALUES ('91', 'GW', 'Guinea-Bissau', '0');
INSERT INTO `system_country` VALUES ('92', 'GY', 'Guyana', '0');
INSERT INTO `system_country` VALUES ('93', 'HT', 'Haiti', '0');
INSERT INTO `system_country` VALUES ('94', 'HM', 'Heard and Mc Donald Islands', '0');
INSERT INTO `system_country` VALUES ('95', 'HN', 'Honduras', '0');
INSERT INTO `system_country` VALUES ('96', 'HK', 'Hong Kong', '0');
INSERT INTO `system_country` VALUES ('97', 'HU', 'Hungary', '0');
INSERT INTO `system_country` VALUES ('98', 'IS', 'Iceland', '0');
INSERT INTO `system_country` VALUES ('99', 'IN', 'India', '0');
INSERT INTO `system_country` VALUES ('100', 'IM', 'Isle of Man', '0');
INSERT INTO `system_country` VALUES ('101', 'ID', 'Indonesia', '0');
INSERT INTO `system_country` VALUES ('102', 'IR', 'Iran (Islamic Republic of)', '0');
INSERT INTO `system_country` VALUES ('103', 'IQ', 'Iraq', '0');
INSERT INTO `system_country` VALUES ('104', 'IE', 'Ireland', '0');
INSERT INTO `system_country` VALUES ('105', 'IL', 'Israel', '0');
INSERT INTO `system_country` VALUES ('106', 'IT', 'Italy', '0');
INSERT INTO `system_country` VALUES ('107', 'CI', 'Ivory Coast', '0');
INSERT INTO `system_country` VALUES ('108', 'JE', 'Jersey', '0');
INSERT INTO `system_country` VALUES ('109', 'JM', 'Jamaica', '0');
INSERT INTO `system_country` VALUES ('110', 'JP', 'Japan', '0');
INSERT INTO `system_country` VALUES ('111', 'JO', 'Jordan', '0');
INSERT INTO `system_country` VALUES ('112', 'KZ', 'Kazakhstan', '0');
INSERT INTO `system_country` VALUES ('113', 'KE', 'Kenya', '0');
INSERT INTO `system_country` VALUES ('114', 'KI', 'Kiribati', '0');
INSERT INTO `system_country` VALUES ('115', 'KP', 'Korea, Democratic People\'s Republic of', '0');
INSERT INTO `system_country` VALUES ('116', 'KR', 'Korea, Republic of', '0');
INSERT INTO `system_country` VALUES ('117', 'XK', 'Kosovo', '0');
INSERT INTO `system_country` VALUES ('118', 'KW', 'Kuwait', '0');
INSERT INTO `system_country` VALUES ('119', 'KG', 'Kyrgyzstan', '0');
INSERT INTO `system_country` VALUES ('120', 'LA', 'Lao People\'s Democratic Republic', '0');
INSERT INTO `system_country` VALUES ('121', 'LV', 'Latvia', '0');
INSERT INTO `system_country` VALUES ('122', 'LB', 'Lebanon', '0');
INSERT INTO `system_country` VALUES ('123', 'LS', 'Lesotho', '0');
INSERT INTO `system_country` VALUES ('124', 'LR', 'Liberia', '0');
INSERT INTO `system_country` VALUES ('125', 'LY', 'Libyan Arab Jamahiriya', '0');
INSERT INTO `system_country` VALUES ('126', 'LI', 'Liechtenstein', '0');
INSERT INTO `system_country` VALUES ('127', 'LT', 'Lithuania', '0');
INSERT INTO `system_country` VALUES ('128', 'LU', 'Luxembourg', '0');
INSERT INTO `system_country` VALUES ('129', 'MO', 'Macau', '0');
INSERT INTO `system_country` VALUES ('130', 'MK', 'Macedonia', '0');
INSERT INTO `system_country` VALUES ('131', 'MG', 'Madagascar', '0');
INSERT INTO `system_country` VALUES ('132', 'MW', 'Malawi', '0');
INSERT INTO `system_country` VALUES ('133', 'MY', 'Malaysia', '0');
INSERT INTO `system_country` VALUES ('134', 'MV', 'Maldives', '0');
INSERT INTO `system_country` VALUES ('135', 'ML', 'Mali', '0');
INSERT INTO `system_country` VALUES ('136', 'MT', 'Malta', '0');
INSERT INTO `system_country` VALUES ('137', 'MH', 'Marshall Islands', '0');
INSERT INTO `system_country` VALUES ('138', 'MQ', 'Martinique', '0');
INSERT INTO `system_country` VALUES ('139', 'MR', 'Mauritania', '0');
INSERT INTO `system_country` VALUES ('140', 'MU', 'Mauritius', '0');
INSERT INTO `system_country` VALUES ('141', 'TY', 'Mayotte', '0');
INSERT INTO `system_country` VALUES ('142', 'MX', 'Mexico', '0');
INSERT INTO `system_country` VALUES ('143', 'FM', 'Micronesia, Federated States of', '0');
INSERT INTO `system_country` VALUES ('144', 'MD', 'Moldova, Republic of', '0');
INSERT INTO `system_country` VALUES ('145', 'MC', 'Monaco', '0');
INSERT INTO `system_country` VALUES ('146', 'MN', 'Mongolia', '0');
INSERT INTO `system_country` VALUES ('147', 'ME', 'Montenegro', '0');
INSERT INTO `system_country` VALUES ('148', 'MS', 'Montserrat', '0');
INSERT INTO `system_country` VALUES ('149', 'MA', 'Morocco', '0');
INSERT INTO `system_country` VALUES ('150', 'MZ', 'Mozambique', '0');
INSERT INTO `system_country` VALUES ('151', 'MM', 'Myanmar', '0');
INSERT INTO `system_country` VALUES ('152', 'NA', 'Namibia', '0');
INSERT INTO `system_country` VALUES ('153', 'NR', 'Nauru', '0');
INSERT INTO `system_country` VALUES ('154', 'NP', 'Nepal', '0');
INSERT INTO `system_country` VALUES ('155', 'NL', 'Netherlands', '0');
INSERT INTO `system_country` VALUES ('156', 'AN', 'Netherlands Antilles', '0');
INSERT INTO `system_country` VALUES ('157', 'NC', 'New Caledonia', '0');
INSERT INTO `system_country` VALUES ('158', 'NZ', 'New Zealand', '0');
INSERT INTO `system_country` VALUES ('159', 'NI', 'Nicaragua', '0');
INSERT INTO `system_country` VALUES ('160', 'NE', 'Niger', '0');
INSERT INTO `system_country` VALUES ('161', 'NG', 'Nigeria', '0');
INSERT INTO `system_country` VALUES ('162', 'NU', 'Niue', '0');
INSERT INTO `system_country` VALUES ('163', 'NF', 'Norfolk Island', '0');
INSERT INTO `system_country` VALUES ('164', 'MP', 'Northern Mariana Islands', '0');
INSERT INTO `system_country` VALUES ('165', 'NO', 'Norway', '0');
INSERT INTO `system_country` VALUES ('166', 'OM', 'Oman', '0');
INSERT INTO `system_country` VALUES ('167', 'PK', 'Pakistan', '0');
INSERT INTO `system_country` VALUES ('168', 'PW', 'Palau', '0');
INSERT INTO `system_country` VALUES ('169', 'PS', 'Palestine', '0');
INSERT INTO `system_country` VALUES ('170', 'PA', 'Panama', '0');
INSERT INTO `system_country` VALUES ('171', 'PG', 'Papua New Guinea', '0');
INSERT INTO `system_country` VALUES ('172', 'PY', 'Paraguay', '0');
INSERT INTO `system_country` VALUES ('173', 'PE', 'Peru', '0');
INSERT INTO `system_country` VALUES ('174', 'PH', 'Philippines', '0');
INSERT INTO `system_country` VALUES ('175', 'PN', 'Pitcairn', '0');
INSERT INTO `system_country` VALUES ('176', 'PL', 'Poland', '0');
INSERT INTO `system_country` VALUES ('177', 'PT', 'Portugal', '0');
INSERT INTO `system_country` VALUES ('178', 'PR', 'Puerto Rico', '0');
INSERT INTO `system_country` VALUES ('179', 'QA', 'Qatar', '0');
INSERT INTO `system_country` VALUES ('180', 'RE', 'Reunion', '0');
INSERT INTO `system_country` VALUES ('181', 'RO', 'Romania', '0');
INSERT INTO `system_country` VALUES ('182', 'RU', 'Russian Federation', '0');
INSERT INTO `system_country` VALUES ('183', 'RW', 'Rwanda', '0');
INSERT INTO `system_country` VALUES ('184', 'KN', 'Saint Kitts and Nevis', '0');
INSERT INTO `system_country` VALUES ('185', 'LC', 'Saint Lucia', '0');
INSERT INTO `system_country` VALUES ('186', 'VC', 'Saint Vincent and the Grenadines', '0');
INSERT INTO `system_country` VALUES ('187', 'WS', 'Samoa', '0');
INSERT INTO `system_country` VALUES ('188', 'SM', 'San Marino', '0');
INSERT INTO `system_country` VALUES ('189', 'ST', 'Sao Tome and Principe', '0');
INSERT INTO `system_country` VALUES ('190', 'SA', 'Saudi Arabia', '0');
INSERT INTO `system_country` VALUES ('191', 'SN', 'Senegal', '0');
INSERT INTO `system_country` VALUES ('192', 'RS', 'Serbia', '0');
INSERT INTO `system_country` VALUES ('193', 'SC', 'Seychelles', '0');
INSERT INTO `system_country` VALUES ('194', 'SL', 'Sierra Leone', '0');
INSERT INTO `system_country` VALUES ('195', 'SG', 'Singapore', '0');
INSERT INTO `system_country` VALUES ('196', 'SK', 'Slovakia', '0');
INSERT INTO `system_country` VALUES ('197', 'SI', 'Slovenia', '0');
INSERT INTO `system_country` VALUES ('198', 'SB', 'Solomon Islands', '0');
INSERT INTO `system_country` VALUES ('199', 'SO', 'Somalia', '0');
INSERT INTO `system_country` VALUES ('200', 'ZA', 'South Africa', '0');
INSERT INTO `system_country` VALUES ('201', 'GS', 'South Georgia South Sandwich Islands', '0');
INSERT INTO `system_country` VALUES ('202', 'ES', 'Spain', '0');
INSERT INTO `system_country` VALUES ('203', 'LK', 'Sri Lanka', '0');
INSERT INTO `system_country` VALUES ('204', 'SH', 'St. Helena', '0');
INSERT INTO `system_country` VALUES ('205', 'PM', 'St. Pierre and Miquelon', '0');
INSERT INTO `system_country` VALUES ('206', 'SD', 'Sudan', '0');
INSERT INTO `system_country` VALUES ('207', 'SR', 'Suriname', '0');
INSERT INTO `system_country` VALUES ('208', 'SJ', 'Svalbard and Jan Mayen Islands', '0');
INSERT INTO `system_country` VALUES ('209', 'SZ', 'Swaziland', '0');
INSERT INTO `system_country` VALUES ('210', 'SE', 'Sweden', '0');
INSERT INTO `system_country` VALUES ('211', 'CH', 'Switzerland', '0');
INSERT INTO `system_country` VALUES ('212', 'SY', 'Syrian Arab Republic', '0');
INSERT INTO `system_country` VALUES ('213', 'TW', 'Taiwan', '0');
INSERT INTO `system_country` VALUES ('214', 'TJ', 'Tajikistan', '0');
INSERT INTO `system_country` VALUES ('215', 'TZ', 'Tanzania, United Republic of', '0');
INSERT INTO `system_country` VALUES ('216', 'TH', 'Thailand', '0');
INSERT INTO `system_country` VALUES ('217', 'TG', 'Togo', '0');
INSERT INTO `system_country` VALUES ('218', 'TK', 'Tokelau', '0');
INSERT INTO `system_country` VALUES ('219', 'TO', 'Tonga', '0');
INSERT INTO `system_country` VALUES ('220', 'TT', 'Trinidad and Tobago', '0');
INSERT INTO `system_country` VALUES ('221', 'TN', 'Tunisia', '0');
INSERT INTO `system_country` VALUES ('222', 'TR', 'Turkey', '0');
INSERT INTO `system_country` VALUES ('223', 'TM', 'Turkmenistan', '0');
INSERT INTO `system_country` VALUES ('224', 'TC', 'Turks and Caicos Islands', '0');
INSERT INTO `system_country` VALUES ('225', 'TV', 'Tuvalu', '0');
INSERT INTO `system_country` VALUES ('226', 'UG', 'Uganda', '0');
INSERT INTO `system_country` VALUES ('227', 'UA', 'Ukraine', '0');
INSERT INTO `system_country` VALUES ('228', 'AE', 'United Arab Emirates', '0');
INSERT INTO `system_country` VALUES ('229', 'GB', 'United Kingdom', '0');
INSERT INTO `system_country` VALUES ('230', 'US', 'United States', '0');
INSERT INTO `system_country` VALUES ('231', 'UM', 'United States minor outlying islands', '0');
INSERT INTO `system_country` VALUES ('232', 'UY', 'Uruguay', '0');
INSERT INTO `system_country` VALUES ('233', 'UZ', 'Uzbekistan', '0');
INSERT INTO `system_country` VALUES ('234', 'VU', 'Vanuatu', '0');
INSERT INTO `system_country` VALUES ('235', 'VA', 'Vatican City State', '0');
INSERT INTO `system_country` VALUES ('236', 'VE', 'Venezuela', '0');
INSERT INTO `system_country` VALUES ('237', 'VN', 'Vietnam', '0');
INSERT INTO `system_country` VALUES ('238', 'VG', 'Virgin Islands (British)', '0');
INSERT INTO `system_country` VALUES ('239', 'VI', 'Virgin Islands (U.S.)', '0');
INSERT INTO `system_country` VALUES ('240', 'WF', 'Wallis and Futuna Islands', '0');
INSERT INTO `system_country` VALUES ('241', 'EH', 'Western Sahara', '0');
INSERT INTO `system_country` VALUES ('242', 'YE', 'Yemen', '0');
INSERT INTO `system_country` VALUES ('243', 'YU', 'Yugoslavia', '0');
INSERT INTO `system_country` VALUES ('244', 'ZR', 'Zaire', '0');
INSERT INTO `system_country` VALUES ('245', 'ZM', 'Zambia', '0');
INSERT INTO `system_country` VALUES ('246', 'ZW', 'Zimbabwe', '0');

-- ----------------------------
-- Table structure for system_language
-- ----------------------------
DROP TABLE IF EXISTS `system_language`;
CREATE TABLE `system_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_code` varchar(2) NOT NULL,
  `language_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of system_language
-- ----------------------------
INSERT INTO `system_language` VALUES ('1', 'en', 'English', '1');
INSERT INTO `system_language` VALUES ('2', 'fr', 'France', '1');
INSERT INTO `system_language` VALUES ('4', 'ar', 'Arabic', '1');
INSERT INTO `system_language` VALUES ('5', 'US', 'United States', '1');
INSERT INTO `system_language` VALUES ('6', 'ES', 'Spain', '1');
INSERT INTO `system_language` VALUES ('7', 'AE', 'United Arab Emirates', '1');
INSERT INTO `system_language` VALUES ('8', 'SA', 'Saudi Arabia', '1');

-- ----------------------------
-- Table structure for system_setting
-- ----------------------------
DROP TABLE IF EXISTS `system_setting`;
CREATE TABLE `system_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) DEFAULT NULL,
  `setting_value` text,
  `type` varchar(100) DEFAULT NULL COMMENT 'DROPDOWN:application|layout',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of system_setting
-- ----------------------------
INSERT INTO `system_setting` VALUES ('1', 'GOOGLE_API_KEY', 'AIzaSyAKb1Qz5tE3P9O0F-mRAPQdXgQi5UfGE1g', 'application');
INSERT INTO `system_setting` VALUES ('2', 'PEM_FILE', '1510160014.pem', 'application');
INSERT INTO `system_setting` VALUES ('3', 'COMPANY_NAME', 'My Company Name', 'application');
INSERT INTO `system_setting` VALUES ('4', 'COMPANY_DESCRIPTION', 'App & Template', 'application');
INSERT INTO `system_setting` VALUES ('5', 'COMPANY_HOMEPAGE', 'www.example.com', 'application');
INSERT INTO `system_setting` VALUES ('6', 'ADMIN_EMAIL', 'example-admin@example.com', 'application');
INSERT INTO `system_setting` VALUES ('7', 'SUPPORT_EMAIL', 'example-support@example.com', 'application');
INSERT INTO `system_setting` VALUES ('8', 'LINK_FACEBOOK', 'https://www.facebook.com/vn88banca', 'application');
INSERT INTO `system_setting` VALUES ('9', 'HOTLINE', '(+84) 2444581688', 'application');
INSERT INTO `system_setting` VALUES ('10', 'HOTLINE_BRAND', '+84 357842600', 'application');
INSERT INTO `system_setting` VALUES ('11', 'HOTLINE_APP', '(+84) 705908837', 'application');
INSERT INTO `system_setting` VALUES ('12', 'LINK_TRY', 'Link try', 'application');
INSERT INTO `system_setting` VALUES ('13', 'LINK_PLAY', 'Link play', 'application');
INSERT INTO `system_setting` VALUES ('14', 'LINK_REGISTER', 'Link register', 'application');
INSERT INTO `system_setting` VALUES ('15', 'LINK_LIVE_SUPPORT', 'Link live support', 'application');
INSERT INTO `system_setting` VALUES ('16', 'ENABLE_FAKE_DATA', '0', 'application');
INSERT INTO `system_setting` VALUES ('50', 'LAYOUT_CONFIGURATION', '{\"isAjax\":\"0\",\"mainColor\":\"darkblue\",\"mainIcon\":\"fa fa-list\",\"displayPortlet\":\"1\",\"activeFormType\":\"horizontal\",\"displayPageContentHeader\":\"1\",\"themeStyle\":\"md\",\"headerStyle\":\"default\",\"topMenuDropdownStyle\":\"light\",\"sidebarMode\":\"default\",\"sidebarMenu\":\"accordion\",\"sidebarPosition\":\"left\",\"footerStyle\":\"default\",\"layoutStyle\":\"fluid\",\"sidebarStyle\":\"default\"}', 'layout');
INSERT INTO `system_setting` VALUES ('51', 'FRONTEND_LAYOUT_CONFIGURATION', '{\"frontendTheme\":\"aha\"}', 'layout');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `overview` varchar(2000) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(2) DEFAULT NULL COMMENT 'DROPDOWN:{"10":"User","20":"Moderator","30":"Admin"}',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT 'data:DISABLED=0,ACTIVE=10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'Stephen', '1550549501781_user_image200x200.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in sagittis ipsum, dapibus ultrices lectus. Duis luctus, nisi ac interdum luctus, ipsum diam blandit urna, nec auctor ipsum ex id orci plus pro.', 'GF2ItGsyHb5_hc1gEG737riKbc3Xv2ID', '$2y$13$Zwo0t7dERgyl9ujGn8GoJuDbSAgfMQkYnECVroL8XhCe0jdZkCMIW', '7f95647fba5d7d8bddf50277b376797b', 'immrhy@gmail.com', '30', '10', '1473239211', '1550549501');
INSERT INTO `user` VALUES ('2', 'fruity.tester@gmail.com', '', null, null, 'jGnICet7b4BG4ROezE9uZC_1faAdxIVO', '$2y$13$v9zIae4auh/jVtpmHIA1tOrSqR/Xe9/PIaaNZA3wVX6UB6mU3DTmq', null, 'fruity.tester@gmail.com', '10', '10', '1512987483', '1512987483');
INSERT INTO `user` VALUES ('3', 'fruity.tester@gmail.co', '', null, null, '-x3oG1HWLoZiKdeu2YblWXc4rZC7RjIJ', '$2y$13$vvEc168TrR65inQqMSkTzO1F5T27vQ9qqCPKMTPe5.0rgwO3.mwAi', null, 'fruity.tester@gmail.co', '10', '10', '1512987543', '1512987543');
