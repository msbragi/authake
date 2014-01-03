SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `authake_groups`
-- ----------------------------
DROP TABLE IF EXISTS `authake_groups`;
CREATE TABLE `authake_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of authake_groups
-- ----------------------------
INSERT INTO `authake_groups` VALUES ('1', 'Administrators');
INSERT INTO `authake_groups` VALUES ('2', 'Users');

-- ----------------------------
-- Table structure for `authake_groups_users`
-- ----------------------------
DROP TABLE IF EXISTS `authake_groups_users`;
CREATE TABLE `authake_groups_users` (
  `user_id` int(10) NOT NULL DEFAULT '0',
  `group_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of authake_groups_users
-- ----------------------------
INSERT INTO `authake_groups_users` VALUES ('1', '1');
INSERT INTO `authake_groups_users` VALUES ('2', '2');
INSERT INTO `authake_groups_users` VALUES ('3', '1');

-- ----------------------------
-- Table structure for `authake_rules`
-- ----------------------------
DROP TABLE IF EXISTS `authake_rules`;
CREATE TABLE `authake_rules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Rule description',
  `group_id` int(10) DEFAULT NULL,
  `order` int(10) DEFAULT NULL,
  `action` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission` tinyint(1) NOT NULL DEFAULT '0',
  `forward` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of authake_rules
-- ----------------------------
INSERT INTO `authake_rules` VALUES ('1', 'Allow everything for Administrators', '1', '999999', '*', '1', '', '');
INSERT INTO `authake_rules` VALUES ('2', 'Allow anybody to see the error page, to register, to log in, see profile and log out', null, '100', '/authake/user or /register or /user/login or /login or /authake/user/logout or /user/logout or /logout or /lost-password or /verify(/)?* or /pass(/)?* or /profile or /denied or /pages(/)?* or //pages/*', '1', '', '');
INSERT INTO `authake_rules` VALUES ('4', 'Deny everything for everybody by default (allow to have allow by default then deny)', null, null, '*', '0', '', 'Access denied!');
INSERT INTO `authake_rules` VALUES ('5', 'Display a message for denied admin page', null, '0', '/authake(/index)? or /authake/users* or /authake/groups* or /authake/rules*', '0', '', 'You are not allowed to access the administration page!');

-- ----------------------------
-- Table structure for `authake_settings`
-- ----------------------------
DROP TABLE IF EXISTS `authake_settings`;
CREATE TABLE `authake_settings` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of authake_settings
-- ----------------------------
INSERT INTO `authake_settings` VALUES ('1', 'Default settings', '{\"baseUrl\":\"http:\\/\\/jstevens-d\\/cakephp\\/\",\"service\":\"Web Application Name\",\"loginAction\":\"\\/authake\\/user\\/login\",\"loggedAction\":\"\\/\",\"sessionTimeout\":\"1800\",\"defaultDeniedAction\":\"\\/authake\\/user\\/denied\",\"rulesCacheTimeout\":\"300\",\"systemEmail\":\"no-reply@example.com\",\"systemReplyTo\":\"no-reply@example.com\",\"passwordVerify\":\"1\",\"registration\":\"0\",\"defaultGroup\":\"\",\"useDefaultLayout\":\"1\",\"useEmailAsUsername\":\"0\"}', '2013-04-11 16:48:43', '2013-12-18 19:08:26');

-- ----------------------------
-- Table structure for `authake_users`
-- ----------------------------
DROP TABLE IF EXISTS `authake_users`;
CREATE TABLE `authake_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `emailcheckcode` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `newemail` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passwordchangecode` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `disable` tinyint(1) NOT NULL COMMENT 'Disable/enable account',
  `expire_account` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of authake_users
-- ----------------------------
INSERT INTO `authake_users` VALUES ('1', 'admin', 'f5d1278e8109edd94e1e4197e04873b9', '', '', '', '', '', 'test@example.com', '', null, '', '0', '2032-08-09', '2013-08-09 13:50:15', '2013-08-09 13:50:15');
INSERT INTO `authake_users` VALUES ('2', 'user', 'f5d1278e8109edd94e1e4197e04873b9', '', '', '', '', '', 'test@example.com', '', null, '', '0', '2032-08-09', '2013-08-09 13:50:15', '2013-08-09 13:50:15');
INSERT INTO `authake_users` VALUES ('3', 'developer', 'f5d1278e8109edd94e1e4197e04873b9', '', '', '', '', '', 'test@example.com', '', null, '', '0', '2032-08-29', '2013-08-09 13:50:15', '2013-08-09 13:50:15');
