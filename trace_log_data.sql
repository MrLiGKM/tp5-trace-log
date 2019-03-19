/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-03-19 16:01:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for trace_log_data
-- ----------------------------
DROP TABLE IF EXISTS `trace_log_data`;
CREATE TABLE `trace_log_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL,
  `params` varchar(255) DEFAULT NULL,
  `message` text,
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `log_id` (`log_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
