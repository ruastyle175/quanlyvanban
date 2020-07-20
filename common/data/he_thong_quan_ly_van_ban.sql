/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100119
 Source Host           : localhost:3306
 Source Schema         : he_thong_quan_ly_van_ban

 Target Server Type    : MySQL
 Target Server Version : 100119
 File Encoding         : 65001

 Date: 21/07/2020 01:08:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_can_bo
-- ----------------------------
DROP TABLE IF EXISTS `m_can_bo`;
CREATE TABLE `m_can_bo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_can_bo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for m_don_vi_gui
-- ----------------------------
DROP TABLE IF EXISTS `m_don_vi_gui`;
CREATE TABLE `m_don_vi_gui`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_don_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for m_lanh_dao
-- ----------------------------
DROP TABLE IF EXISTS `m_lanh_dao`;
CREATE TABLE `m_lanh_dao`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_lanh_dao` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for m_loai_vb
-- ----------------------------
DROP TABLE IF EXISTS `m_loai_vb`;
CREATE TABLE `m_loai_vb`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loai_vb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `del_flg` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for m_nguoi_ky
-- ----------------------------
DROP TABLE IF EXISTS `m_nguoi_ky`;
CREATE TABLE `m_nguoi_ky`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nguoi_ky` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for m_nguoi_nhan
-- ----------------------------
DROP TABLE IF EXISTS `m_nguoi_nhan`;
CREATE TABLE `m_nguoi_nhan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nguoi_nhan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for m_nhom_vb
-- ----------------------------
DROP TABLE IF EXISTS `m_nhom_vb`;
CREATE TABLE `m_nhom_vb`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nhom_vb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `del_flg` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for m_trang_thai
-- ----------------------------
DROP TABLE IF EXISTS `m_trang_thai`;
CREATE TABLE `m_trang_thai`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trang_thai` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `del_flg` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for system_country
-- ----------------------------
DROP TABLE IF EXISTS `system_country`;
CREATE TABLE `system_country`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `country_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 247 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of system_country
-- ----------------------------
INSERT INTO `system_country` VALUES (1, 'AF', 'Afghanistan', 0);
INSERT INTO `system_country` VALUES (2, 'AL', 'Albania', 0);
INSERT INTO `system_country` VALUES (3, 'DZ', 'Algeria', 0);
INSERT INTO `system_country` VALUES (4, 'DS', 'American Samoa', 0);
INSERT INTO `system_country` VALUES (5, 'AD', 'Andorra', 0);
INSERT INTO `system_country` VALUES (6, 'AO', 'Angola', 0);
INSERT INTO `system_country` VALUES (7, 'AI', 'Anguilla', 0);
INSERT INTO `system_country` VALUES (8, 'AQ', 'Antarctica', 0);
INSERT INTO `system_country` VALUES (9, 'AG', 'Antigua and Barbuda', 0);
INSERT INTO `system_country` VALUES (10, 'AR', 'Argentina', 0);
INSERT INTO `system_country` VALUES (11, 'AM', 'Armenia', 0);
INSERT INTO `system_country` VALUES (12, 'AW', 'Aruba', 0);
INSERT INTO `system_country` VALUES (13, 'AU', 'Australia', 0);
INSERT INTO `system_country` VALUES (14, 'AT', 'Austria', 0);
INSERT INTO `system_country` VALUES (15, 'AZ', 'Azerbaijan', 0);
INSERT INTO `system_country` VALUES (16, 'BS', 'Bahamas', 0);
INSERT INTO `system_country` VALUES (17, 'BH', 'Bahrain', 0);
INSERT INTO `system_country` VALUES (18, 'BD', 'Bangladesh', 0);
INSERT INTO `system_country` VALUES (19, 'BB', 'Barbados', 0);
INSERT INTO `system_country` VALUES (20, 'BY', 'Belarus', 0);
INSERT INTO `system_country` VALUES (21, 'BE', 'Belgium', 0);
INSERT INTO `system_country` VALUES (22, 'BZ', 'Belize', 0);
INSERT INTO `system_country` VALUES (23, 'BJ', 'Benin', 0);
INSERT INTO `system_country` VALUES (24, 'BM', 'Bermuda', 0);
INSERT INTO `system_country` VALUES (25, 'BT', 'Bhutan', 0);
INSERT INTO `system_country` VALUES (26, 'BO', 'Bolivia', 0);
INSERT INTO `system_country` VALUES (27, 'BA', 'Bosnia and Herzegovina', 0);
INSERT INTO `system_country` VALUES (28, 'BW', 'Botswana', 0);
INSERT INTO `system_country` VALUES (29, 'BV', 'Bouvet Island', 0);
INSERT INTO `system_country` VALUES (30, 'BR', 'Brazil', 0);
INSERT INTO `system_country` VALUES (31, 'IO', 'British Indian Ocean Territory', 0);
INSERT INTO `system_country` VALUES (32, 'BN', 'Brunei Darussalam', 0);
INSERT INTO `system_country` VALUES (33, 'BG', 'Bulgaria', 0);
INSERT INTO `system_country` VALUES (34, 'BF', 'Burkina Faso', 0);
INSERT INTO `system_country` VALUES (35, 'BI', 'Burundi', 0);
INSERT INTO `system_country` VALUES (36, 'KH', 'Cambodia', 0);
INSERT INTO `system_country` VALUES (37, 'CM', 'Cameroon', 0);
INSERT INTO `system_country` VALUES (38, 'CA', 'Canada', 0);
INSERT INTO `system_country` VALUES (39, 'CV', 'Cape Verde', 0);
INSERT INTO `system_country` VALUES (40, 'KY', 'Cayman Islands', 0);
INSERT INTO `system_country` VALUES (41, 'CF', 'Central African Republic', 0);
INSERT INTO `system_country` VALUES (42, 'TD', 'Chad', 0);
INSERT INTO `system_country` VALUES (43, 'CL', 'Chile', 0);
INSERT INTO `system_country` VALUES (44, 'CN', 'China', 0);
INSERT INTO `system_country` VALUES (45, 'CX', 'Christmas Island', 0);
INSERT INTO `system_country` VALUES (46, 'CC', 'Cocos (Keeling) Islands', 0);
INSERT INTO `system_country` VALUES (47, 'CO', 'Colombia', 0);
INSERT INTO `system_country` VALUES (48, 'KM', 'Comoros', 0);
INSERT INTO `system_country` VALUES (49, 'CG', 'Congo', 0);
INSERT INTO `system_country` VALUES (50, 'CK', 'Cook Islands', 0);
INSERT INTO `system_country` VALUES (51, 'CR', 'Costa Rica', 0);
INSERT INTO `system_country` VALUES (52, 'HR', 'Croatia (Hrvatska)', 0);
INSERT INTO `system_country` VALUES (53, 'CU', 'Cuba', 0);
INSERT INTO `system_country` VALUES (54, 'CY', 'Cyprus', 0);
INSERT INTO `system_country` VALUES (55, 'CZ', 'Czech Republic', 0);
INSERT INTO `system_country` VALUES (56, 'DK', 'Denmark', 0);
INSERT INTO `system_country` VALUES (57, 'DJ', 'Djibouti', 0);
INSERT INTO `system_country` VALUES (58, 'DM', 'Dominica', 0);
INSERT INTO `system_country` VALUES (59, 'DO', 'Dominican Republic', 0);
INSERT INTO `system_country` VALUES (60, 'TP', 'East Timor', 0);
INSERT INTO `system_country` VALUES (61, 'EC', 'Ecuador', 0);
INSERT INTO `system_country` VALUES (62, 'EG', 'Egypt', 0);
INSERT INTO `system_country` VALUES (63, 'SV', 'El Salvador', 0);
INSERT INTO `system_country` VALUES (64, 'GQ', 'Equatorial Guinea', 0);
INSERT INTO `system_country` VALUES (65, 'ER', 'Eritrea', 0);
INSERT INTO `system_country` VALUES (66, 'EE', 'Estonia', 0);
INSERT INTO `system_country` VALUES (67, 'ET', 'Ethiopia', 0);
INSERT INTO `system_country` VALUES (68, 'FK', 'Falkland Islands (Malvinas)', 0);
INSERT INTO `system_country` VALUES (69, 'FO', 'Faroe Islands', 0);
INSERT INTO `system_country` VALUES (70, 'FJ', 'Fiji', 0);
INSERT INTO `system_country` VALUES (71, 'FI', 'Finland', 0);
INSERT INTO `system_country` VALUES (72, 'FR', 'France', 0);
INSERT INTO `system_country` VALUES (73, 'FX', 'France, Metropolitan', 0);
INSERT INTO `system_country` VALUES (74, 'GF', 'French Guiana', 0);
INSERT INTO `system_country` VALUES (75, 'PF', 'French Polynesia', 0);
INSERT INTO `system_country` VALUES (76, 'TF', 'French Southern Territories', 0);
INSERT INTO `system_country` VALUES (77, 'GA', 'Gabon', 0);
INSERT INTO `system_country` VALUES (78, 'GM', 'Gambia', 0);
INSERT INTO `system_country` VALUES (79, 'GE', 'Georgia', 0);
INSERT INTO `system_country` VALUES (80, 'DE', 'Germany', 0);
INSERT INTO `system_country` VALUES (81, 'GH', 'Ghana', 0);
INSERT INTO `system_country` VALUES (82, 'GI', 'Gibraltar', 0);
INSERT INTO `system_country` VALUES (83, 'GK', 'Guernsey', 0);
INSERT INTO `system_country` VALUES (84, 'GR', 'Greece', 0);
INSERT INTO `system_country` VALUES (85, 'GL', 'Greenland', 0);
INSERT INTO `system_country` VALUES (86, 'GD', 'Grenada', 0);
INSERT INTO `system_country` VALUES (87, 'GP', 'Guadeloupe', 0);
INSERT INTO `system_country` VALUES (88, 'GU', 'Guam', 0);
INSERT INTO `system_country` VALUES (89, 'GT', 'Guatemala', 0);
INSERT INTO `system_country` VALUES (90, 'GN', 'Guinea', 0);
INSERT INTO `system_country` VALUES (91, 'GW', 'Guinea-Bissau', 0);
INSERT INTO `system_country` VALUES (92, 'GY', 'Guyana', 0);
INSERT INTO `system_country` VALUES (93, 'HT', 'Haiti', 0);
INSERT INTO `system_country` VALUES (94, 'HM', 'Heard and Mc Donald Islands', 0);
INSERT INTO `system_country` VALUES (95, 'HN', 'Honduras', 0);
INSERT INTO `system_country` VALUES (96, 'HK', 'Hong Kong', 0);
INSERT INTO `system_country` VALUES (97, 'HU', 'Hungary', 0);
INSERT INTO `system_country` VALUES (98, 'IS', 'Iceland', 0);
INSERT INTO `system_country` VALUES (99, 'IN', 'India', 0);
INSERT INTO `system_country` VALUES (100, 'IM', 'Isle of Man', 0);
INSERT INTO `system_country` VALUES (101, 'ID', 'Indonesia', 0);
INSERT INTO `system_country` VALUES (102, 'IR', 'Iran (Islamic Republic of)', 0);
INSERT INTO `system_country` VALUES (103, 'IQ', 'Iraq', 0);
INSERT INTO `system_country` VALUES (104, 'IE', 'Ireland', 0);
INSERT INTO `system_country` VALUES (105, 'IL', 'Israel', 0);
INSERT INTO `system_country` VALUES (106, 'IT', 'Italy', 0);
INSERT INTO `system_country` VALUES (107, 'CI', 'Ivory Coast', 0);
INSERT INTO `system_country` VALUES (108, 'JE', 'Jersey', 0);
INSERT INTO `system_country` VALUES (109, 'JM', 'Jamaica', 0);
INSERT INTO `system_country` VALUES (110, 'JP', 'Japan', 0);
INSERT INTO `system_country` VALUES (111, 'JO', 'Jordan', 0);
INSERT INTO `system_country` VALUES (112, 'KZ', 'Kazakhstan', 0);
INSERT INTO `system_country` VALUES (113, 'KE', 'Kenya', 0);
INSERT INTO `system_country` VALUES (114, 'KI', 'Kiribati', 0);
INSERT INTO `system_country` VALUES (115, 'KP', 'Korea, Democratic People\'s Republic of', 0);
INSERT INTO `system_country` VALUES (116, 'KR', 'Korea, Republic of', 0);
INSERT INTO `system_country` VALUES (117, 'XK', 'Kosovo', 0);
INSERT INTO `system_country` VALUES (118, 'KW', 'Kuwait', 0);
INSERT INTO `system_country` VALUES (119, 'KG', 'Kyrgyzstan', 0);
INSERT INTO `system_country` VALUES (120, 'LA', 'Lao People\'s Democratic Republic', 0);
INSERT INTO `system_country` VALUES (121, 'LV', 'Latvia', 0);
INSERT INTO `system_country` VALUES (122, 'LB', 'Lebanon', 0);
INSERT INTO `system_country` VALUES (123, 'LS', 'Lesotho', 0);
INSERT INTO `system_country` VALUES (124, 'LR', 'Liberia', 0);
INSERT INTO `system_country` VALUES (125, 'LY', 'Libyan Arab Jamahiriya', 0);
INSERT INTO `system_country` VALUES (126, 'LI', 'Liechtenstein', 0);
INSERT INTO `system_country` VALUES (127, 'LT', 'Lithuania', 0);
INSERT INTO `system_country` VALUES (128, 'LU', 'Luxembourg', 0);
INSERT INTO `system_country` VALUES (129, 'MO', 'Macau', 0);
INSERT INTO `system_country` VALUES (130, 'MK', 'Macedonia', 0);
INSERT INTO `system_country` VALUES (131, 'MG', 'Madagascar', 0);
INSERT INTO `system_country` VALUES (132, 'MW', 'Malawi', 0);
INSERT INTO `system_country` VALUES (133, 'MY', 'Malaysia', 0);
INSERT INTO `system_country` VALUES (134, 'MV', 'Maldives', 0);
INSERT INTO `system_country` VALUES (135, 'ML', 'Mali', 0);
INSERT INTO `system_country` VALUES (136, 'MT', 'Malta', 0);
INSERT INTO `system_country` VALUES (137, 'MH', 'Marshall Islands', 0);
INSERT INTO `system_country` VALUES (138, 'MQ', 'Martinique', 0);
INSERT INTO `system_country` VALUES (139, 'MR', 'Mauritania', 0);
INSERT INTO `system_country` VALUES (140, 'MU', 'Mauritius', 0);
INSERT INTO `system_country` VALUES (141, 'TY', 'Mayotte', 0);
INSERT INTO `system_country` VALUES (142, 'MX', 'Mexico', 0);
INSERT INTO `system_country` VALUES (143, 'FM', 'Micronesia, Federated States of', 0);
INSERT INTO `system_country` VALUES (144, 'MD', 'Moldova, Republic of', 0);
INSERT INTO `system_country` VALUES (145, 'MC', 'Monaco', 0);
INSERT INTO `system_country` VALUES (146, 'MN', 'Mongolia', 0);
INSERT INTO `system_country` VALUES (147, 'ME', 'Montenegro', 0);
INSERT INTO `system_country` VALUES (148, 'MS', 'Montserrat', 0);
INSERT INTO `system_country` VALUES (149, 'MA', 'Morocco', 0);
INSERT INTO `system_country` VALUES (150, 'MZ', 'Mozambique', 0);
INSERT INTO `system_country` VALUES (151, 'MM', 'Myanmar', 0);
INSERT INTO `system_country` VALUES (152, 'NA', 'Namibia', 0);
INSERT INTO `system_country` VALUES (153, 'NR', 'Nauru', 0);
INSERT INTO `system_country` VALUES (154, 'NP', 'Nepal', 0);
INSERT INTO `system_country` VALUES (155, 'NL', 'Netherlands', 0);
INSERT INTO `system_country` VALUES (156, 'AN', 'Netherlands Antilles', 0);
INSERT INTO `system_country` VALUES (157, 'NC', 'New Caledonia', 0);
INSERT INTO `system_country` VALUES (158, 'NZ', 'New Zealand', 0);
INSERT INTO `system_country` VALUES (159, 'NI', 'Nicaragua', 0);
INSERT INTO `system_country` VALUES (160, 'NE', 'Niger', 0);
INSERT INTO `system_country` VALUES (161, 'NG', 'Nigeria', 0);
INSERT INTO `system_country` VALUES (162, 'NU', 'Niue', 0);
INSERT INTO `system_country` VALUES (163, 'NF', 'Norfolk Island', 0);
INSERT INTO `system_country` VALUES (164, 'MP', 'Northern Mariana Islands', 0);
INSERT INTO `system_country` VALUES (165, 'NO', 'Norway', 0);
INSERT INTO `system_country` VALUES (166, 'OM', 'Oman', 0);
INSERT INTO `system_country` VALUES (167, 'PK', 'Pakistan', 0);
INSERT INTO `system_country` VALUES (168, 'PW', 'Palau', 0);
INSERT INTO `system_country` VALUES (169, 'PS', 'Palestine', 0);
INSERT INTO `system_country` VALUES (170, 'PA', 'Panama', 0);
INSERT INTO `system_country` VALUES (171, 'PG', 'Papua New Guinea', 0);
INSERT INTO `system_country` VALUES (172, 'PY', 'Paraguay', 0);
INSERT INTO `system_country` VALUES (173, 'PE', 'Peru', 0);
INSERT INTO `system_country` VALUES (174, 'PH', 'Philippines', 0);
INSERT INTO `system_country` VALUES (175, 'PN', 'Pitcairn', 0);
INSERT INTO `system_country` VALUES (176, 'PL', 'Poland', 0);
INSERT INTO `system_country` VALUES (177, 'PT', 'Portugal', 0);
INSERT INTO `system_country` VALUES (178, 'PR', 'Puerto Rico', 0);
INSERT INTO `system_country` VALUES (179, 'QA', 'Qatar', 0);
INSERT INTO `system_country` VALUES (180, 'RE', 'Reunion', 0);
INSERT INTO `system_country` VALUES (181, 'RO', 'Romania', 0);
INSERT INTO `system_country` VALUES (182, 'RU', 'Russian Federation', 0);
INSERT INTO `system_country` VALUES (183, 'RW', 'Rwanda', 0);
INSERT INTO `system_country` VALUES (184, 'KN', 'Saint Kitts and Nevis', 0);
INSERT INTO `system_country` VALUES (185, 'LC', 'Saint Lucia', 0);
INSERT INTO `system_country` VALUES (186, 'VC', 'Saint Vincent and the Grenadines', 0);
INSERT INTO `system_country` VALUES (187, 'WS', 'Samoa', 0);
INSERT INTO `system_country` VALUES (188, 'SM', 'San Marino', 0);
INSERT INTO `system_country` VALUES (189, 'ST', 'Sao Tome and Principe', 0);
INSERT INTO `system_country` VALUES (190, 'SA', 'Saudi Arabia', 0);
INSERT INTO `system_country` VALUES (191, 'SN', 'Senegal', 0);
INSERT INTO `system_country` VALUES (192, 'RS', 'Serbia', 0);
INSERT INTO `system_country` VALUES (193, 'SC', 'Seychelles', 0);
INSERT INTO `system_country` VALUES (194, 'SL', 'Sierra Leone', 0);
INSERT INTO `system_country` VALUES (195, 'SG', 'Singapore', 0);
INSERT INTO `system_country` VALUES (196, 'SK', 'Slovakia', 0);
INSERT INTO `system_country` VALUES (197, 'SI', 'Slovenia', 0);
INSERT INTO `system_country` VALUES (198, 'SB', 'Solomon Islands', 0);
INSERT INTO `system_country` VALUES (199, 'SO', 'Somalia', 0);
INSERT INTO `system_country` VALUES (200, 'ZA', 'South Africa', 0);
INSERT INTO `system_country` VALUES (201, 'GS', 'South Georgia South Sandwich Islands', 0);
INSERT INTO `system_country` VALUES (202, 'ES', 'Spain', 0);
INSERT INTO `system_country` VALUES (203, 'LK', 'Sri Lanka', 0);
INSERT INTO `system_country` VALUES (204, 'SH', 'St. Helena', 0);
INSERT INTO `system_country` VALUES (205, 'PM', 'St. Pierre and Miquelon', 0);
INSERT INTO `system_country` VALUES (206, 'SD', 'Sudan', 0);
INSERT INTO `system_country` VALUES (207, 'SR', 'Suriname', 0);
INSERT INTO `system_country` VALUES (208, 'SJ', 'Svalbard and Jan Mayen Islands', 0);
INSERT INTO `system_country` VALUES (209, 'SZ', 'Swaziland', 0);
INSERT INTO `system_country` VALUES (210, 'SE', 'Sweden', 0);
INSERT INTO `system_country` VALUES (211, 'CH', 'Switzerland', 0);
INSERT INTO `system_country` VALUES (212, 'SY', 'Syrian Arab Republic', 0);
INSERT INTO `system_country` VALUES (213, 'TW', 'Taiwan', 0);
INSERT INTO `system_country` VALUES (214, 'TJ', 'Tajikistan', 0);
INSERT INTO `system_country` VALUES (215, 'TZ', 'Tanzania, United Republic of', 0);
INSERT INTO `system_country` VALUES (216, 'TH', 'Thailand', 0);
INSERT INTO `system_country` VALUES (217, 'TG', 'Togo', 0);
INSERT INTO `system_country` VALUES (218, 'TK', 'Tokelau', 0);
INSERT INTO `system_country` VALUES (219, 'TO', 'Tonga', 0);
INSERT INTO `system_country` VALUES (220, 'TT', 'Trinidad and Tobago', 0);
INSERT INTO `system_country` VALUES (221, 'TN', 'Tunisia', 0);
INSERT INTO `system_country` VALUES (222, 'TR', 'Turkey', 0);
INSERT INTO `system_country` VALUES (223, 'TM', 'Turkmenistan', 0);
INSERT INTO `system_country` VALUES (224, 'TC', 'Turks and Caicos Islands', 0);
INSERT INTO `system_country` VALUES (225, 'TV', 'Tuvalu', 0);
INSERT INTO `system_country` VALUES (226, 'UG', 'Uganda', 0);
INSERT INTO `system_country` VALUES (227, 'UA', 'Ukraine', 0);
INSERT INTO `system_country` VALUES (228, 'AE', 'United Arab Emirates', 0);
INSERT INTO `system_country` VALUES (229, 'GB', 'United Kingdom', 0);
INSERT INTO `system_country` VALUES (230, 'US', 'United States', 0);
INSERT INTO `system_country` VALUES (231, 'UM', 'United States minor outlying islands', 0);
INSERT INTO `system_country` VALUES (232, 'UY', 'Uruguay', 0);
INSERT INTO `system_country` VALUES (233, 'UZ', 'Uzbekistan', 0);
INSERT INTO `system_country` VALUES (234, 'VU', 'Vanuatu', 0);
INSERT INTO `system_country` VALUES (235, 'VA', 'Vatican City State', 0);
INSERT INTO `system_country` VALUES (236, 'VE', 'Venezuela', 0);
INSERT INTO `system_country` VALUES (237, 'VN', 'Vietnam', 0);
INSERT INTO `system_country` VALUES (238, 'VG', 'Virgin Islands (British)', 0);
INSERT INTO `system_country` VALUES (239, 'VI', 'Virgin Islands (U.S.)', 0);
INSERT INTO `system_country` VALUES (240, 'WF', 'Wallis and Futuna Islands', 0);
INSERT INTO `system_country` VALUES (241, 'EH', 'Western Sahara', 0);
INSERT INTO `system_country` VALUES (242, 'YE', 'Yemen', 0);
INSERT INTO `system_country` VALUES (243, 'YU', 'Yugoslavia', 0);
INSERT INTO `system_country` VALUES (244, 'ZR', 'Zaire', 0);
INSERT INTO `system_country` VALUES (245, 'ZM', 'Zambia', 0);
INSERT INTO `system_country` VALUES (246, 'ZW', 'Zimbabwe', 0);

-- ----------------------------
-- Table structure for system_language
-- ----------------------------
DROP TABLE IF EXISTS `system_language`;
CREATE TABLE `system_language`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `language_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of system_language
-- ----------------------------
INSERT INTO `system_language` VALUES (1, 'en', 'English', 1);
INSERT INTO `system_language` VALUES (2, 'fr', 'France', 1);
INSERT INTO `system_language` VALUES (4, 'ar', 'Arabic', 1);
INSERT INTO `system_language` VALUES (5, 'US', 'United States', 1);
INSERT INTO `system_language` VALUES (6, 'ES', 'Spain', 1);
INSERT INTO `system_language` VALUES (7, 'AE', 'United Arab Emirates', 1);
INSERT INTO `system_language` VALUES (8, 'SA', 'Saudi Arabia', 1);

-- ----------------------------
-- Table structure for system_right
-- ----------------------------
DROP TABLE IF EXISTS `system_right`;
CREATE TABLE `system_right`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `obj` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `permission` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of system_right
-- ----------------------------
INSERT INTO `system_right` VALUES (1, 1, 'app', 'AppUser', 'index', 1);
INSERT INTO `system_right` VALUES (2, 2, 'common', 'Sample', 'index', 1);
INSERT INTO `system_right` VALUES (3, 2, 'common', 'Site', 'index', 1);

-- ----------------------------
-- Table structure for system_role
-- ----------------------------
DROP TABLE IF EXISTS `system_role`;
CREATE TABLE `system_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'COLOR:',
  `description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of system_role
-- ----------------------------
INSERT INTO `system_role` VALUES (1, 'Admin', '#ff0000', '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sed nisi et odio vehicula vestibulum nec non turpis. Aliquam a interdum tellus. Suspendisse vitae lorem eget elit commodo congue id lacinia tortor. Vestibulum efficitur tempor dapibus. Fusce ex velit, cursus nec nisi quis, venenatis iaculis dolor. Ut et mauris sit amet libero rutrum ultrices elementum cursus nisi. Phasellus blandit placerat elit a pulvinar. Nam ultrices urna nisl, ac luctus est sodales nec. Maecenas nec efficitur erat, id molestie augue. Suspendisse commodo velit purus, sagittis dapibus diam accumsan accumsan.</span></p>\r\n', 1);
INSERT INTO `system_role` VALUES (2, 'Moderator', '#0000ff', '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sed nisi et odio vehicula vestibulum nec non turpis. Aliquam a interdum tellus. Suspendisse vitae lorem eget elit commodo congue id lacinia tortor. Vestibulum efficitur tempor dapibus. Fusce ex velit, cursus nec nisi quis, venenatis iaculis dolor. Ut et mauris sit amet libero rutrum ultrices elementum cursus nisi. Phasellus blandit placerat elit a pulvinar. Nam ultrices urna nisl, ac luctus est sodales nec. Maecenas nec efficitur erat, id molestie augue. Suspendisse commodo velit purus, sagittis dapibus diam accumsan accumsan.</span></p>\r\n', 1);
INSERT INTO `system_role` VALUES (3, 'User', '#666666', '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sed nisi et odio vehicula vestibulum nec non turpis. Aliquam a interdum tellus. Suspendisse vitae lorem eget elit commodo congue id lacinia tortor. Vestibulum efficitur tempor dapibus. Fusce ex velit, cursus nec nisi quis, venenatis iaculis dolor. Ut et mauris sit amet libero rutrum ultrices elementum cursus nisi. Phasellus blandit placerat elit a pulvinar. Nam ultrices urna nisl, ac luctus est sodales nec. Maecenas nec efficitur erat, id molestie augue. Suspendisse commodo velit purus, sagittis dapibus diam accumsan accumsan.</span></p>\r\n', 1);

-- ----------------------------
-- Table structure for system_setting
-- ----------------------------
DROP TABLE IF EXISTS `system_setting`;
CREATE TABLE `system_setting`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `setting_value` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'DROPDOWN:application|layout',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of system_setting
-- ----------------------------
INSERT INTO `system_setting` VALUES (1, 'GOOGLE_API_KEY', 'AIzaSyBPlQPrMUbhsoKtYW2tqvKri0gna1XB5ic', 'application');
INSERT INTO `system_setting` VALUES (2, 'PEM_FILE', '1510160014.pem', 'application');
INSERT INTO `system_setting` VALUES (3, 'COMPANY_NAME', 'My Company Name', 'application');
INSERT INTO `system_setting` VALUES (4, 'COMPANY_DESCRIPTION', 'App & Template', 'application');
INSERT INTO `system_setting` VALUES (5, 'COMPANY_HOMEPAGE', 'www.example.com', 'application');
INSERT INTO `system_setting` VALUES (6, 'ADMIN_EMAIL', 'example-admin@example.com', 'application');
INSERT INTO `system_setting` VALUES (7, 'SUPPORT_EMAIL', 'example-support@example.com', 'application');
INSERT INTO `system_setting` VALUES (8, 'GOOGLE_MAP_API_KEY', 'AIzaSyDt8PQG_AqjJnmYJLp5XXXHLweFfS8YWc0', 'application');
INSERT INTO `system_setting` VALUES (9, 'LINK_FACEBOOK', 'https://www.facebook.com/vn88banca', 'application');
INSERT INTO `system_setting` VALUES (10, 'HOTLINE', '(+84) 2444581688', 'application');
INSERT INTO `system_setting` VALUES (11, 'HOTLINE_BRAND', '+84 357842600', 'application');
INSERT INTO `system_setting` VALUES (12, 'HOTLINE_APP', '(+84) 705908837', 'application');
INSERT INTO `system_setting` VALUES (13, 'LINK_TRY', 'Link try', 'application');
INSERT INTO `system_setting` VALUES (14, 'LINK_PLAY', 'Link play', 'application');
INSERT INTO `system_setting` VALUES (15, 'LINK_REGISTER', 'Link register', 'application');
INSERT INTO `system_setting` VALUES (16, 'LINK_LIVE_SUPPORT', 'Link live support', 'application');
INSERT INTO `system_setting` VALUES (17, 'ENABLE_FAKE_DATA', '0', 'application');
INSERT INTO `system_setting` VALUES (50, 'LAYOUT_CONFIGURATION', '{\"isAjax\":\"0\",\"mainColor\":\"darkblue\",\"mainIcon\":\"fa fa-list\",\"displayPortlet\":\"1\",\"activeFormType\":\"horizontal\",\"displayPageContentHeader\":\"1\",\"themeStyle\":\"md\",\"headerStyle\":\"default\",\"topMenuDropdownStyle\":\"light\",\"sidebarMode\":\"default\",\"sidebarMenu\":\"accordion\",\"sidebarPosition\":\"left\",\"footerStyle\":\"default\",\"layoutStyle\":\"fluid\",\"sidebarStyle\":\"default\"}', 'layout');
INSERT INTO `system_setting` VALUES (51, 'FRONTEND_LAYOUT_CONFIGURATION', '{\"frontendTheme\":\"aha\"}', 'layout');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'FILE:{\"type\":\"image\",\"extension\":\"jpg, png\"}',
  `overview` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` int(2) NULL DEFAULT NULL COMMENT 'DROPDOWN-NUMERIC:admin=0,user=10,20=moderator',
  `status` smallint(6) NOT NULL DEFAULT 10 COMMENT 'DROPDOWN-NUMERIC:disabled=0,active=10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'Stephen', '1565841665158_user_image.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in sagittis ipsum, dapibus ultrices lectus. Duis luctus, nisi ac interdum luctus, ipsum diam blandit urna, nec auctor ipsum ex id orci plus pro.</p>\r\n', 'GF2ItGsyHb5_hc1gEG737riKbc3Xv2ID', '$2y$13$Zwo0t7dERgyl9ujGn8GoJuDbSAgfMQkYnECVroL8XhCe0jdZkCMIW', '7f95647fba5d7d8bddf50277b376797b', 'immrhy@gmail.com', 0, 1, 1473239211, 1565930142);
INSERT INTO `user` VALUES (2, 'fruity.tester@gmail.com', 'Moderator', '1565945043875_user_image.jpg', '', 'jGnICet7b4BG4ROezE9uZC_1faAdxIVO', '$2y$13$v9zIae4auh/jVtpmHIA1tOrSqR/Xe9/PIaaNZA3wVX6UB6mU3DTmq', NULL, 'fruity.tester@gmail.com', 2, 1, 1512987483, 1565945043);
INSERT INTO `user` VALUES (3, 'fruity.tester@gmail.co', 'User', '1565945069824_user_image.jpg', '<p>1234568899</p>\r\n', '-x3oG1HWLoZiKdeu2YblWXc4rZC7RjIJ', '$2y$13$eacVUT589rFPU0OQ1GGDf.dMRJCrkpQPOHo4BFWF5VDthrv0l3/e6', NULL, 'fruity.tester@gmail.co', 1, 1, 1512987543, 1565945460);
INSERT INTO `user` VALUES (9, 'tester01', 'tester', '1565857327625_user_image.jpg', '<p>123</p>\r\n', 'zpjiyNEiCmSdXRp-TpY59AHkMUocpjDN', '$2y$13$C7QywBRzR5vAo5r5eNrXl.ZtWAxfWMqqdeuxqNo9YK.zzFuVXeQzG', NULL, 'cuongz@mozagroup.com', 1, 1, 1565857328, 1565930169);

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES (22, 1, 1);
INSERT INTO `user_role` VALUES (24, 9, 3);
INSERT INTO `user_role` VALUES (25, 2, 2);
INSERT INTO `user_role` VALUES (29, 3, 1);
INSERT INTO `user_role` VALUES (30, 3, 2);
INSERT INTO `user_role` VALUES (31, 3, 3);

-- ----------------------------
-- Table structure for vb_den
-- ----------------------------
DROP TABLE IF EXISTS `vb_den`;
CREATE TABLE `vb_den`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_donvi_gui` int(11) NOT NULL COMMENT 'LOOKUP:m_don_vi_gui|id|ten_don_vi',
  `so_hieu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_loai_vanban` int(11) NOT NULL COMMENT 'LOOKUP:m_loai_vb|id|loai_vb',
  `noidung_vanban` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `thoigian_banhanh` datetime(0) NULL DEFAULT NULL,
  `thoigian_nhan` datetime(0) NULL DEFAULT NULL,
  `id_lanh_dao` int(11) NULL DEFAULT NULL COMMENT 'LOOKUP:m_lanh_dao|id|ten_lanh_dao',
  `id_can_bo` int(11) NULL DEFAULT NULL COMMENT 'LOOKUP:m_can_bo|id|ten_can_bo',
  `thoigian_hoanthanh` datetime(0) NULL DEFAULT NULL,
  `id_trang_thai` int(11) NOT NULL COMMENT 'LOOKUP:m_trang_thai|id|trang_thai',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `del_flg` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for vb_di
-- ----------------------------
DROP TABLE IF EXISTS `vb_di`;
CREATE TABLE `vb_di`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nhom_vanban` int(11) NOT NULL COMMENT 'LOOKUP:m_nhom_vb|id|nhom_vb',
  `so_hieu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_loai_vanban` int(11) NOT NULL COMMENT 'LOOKUP:m_loai_vb|id|loai_vb',
  `noidung_vanban` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `thoigian_banhanh` datetime(0) NULL DEFAULT NULL,
  `noi_nhan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_nguoiki` int(11) NULL DEFAULT NULL COMMENT 'LOOKUP:m_nguoi_ky|id|nguoi_ky',
  `file_dinhkem` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'FILE:{\"type\":\"attachment\",\"extension\":\"pdf, epub, doc, docx, xls, xlsx, jpg, png, gif, jpeg\"}',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `del_flg` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for vb_trinh
-- ----------------------------
DROP TABLE IF EXISTS `vb_trinh`;
CREATE TABLE `vb_trinh`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `so_hieu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `noidung_vanban` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `thoigian_trinh` datetime(0) NULL DEFAULT NULL,
  `id_nguoi_nhan` int(11) NULL DEFAULT NULL COMMENT 'LOOKUP:m_nguoi_nhan|id|nguoi_nhan',
  `ghichu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `del_flg` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
