/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-03-19 16:01:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for trace_log_list
-- ----------------------------
DROP TABLE IF EXISTS `trace_log_list`;
CREATE TABLE `trace_log_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method` char(10) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `line` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`) USING BTREE,
  KEY `route` (`route`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
