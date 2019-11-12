/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : xuanke8

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-09-22 14:05:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `think_admin`
-- ----------------------------
DROP TABLE IF EXISTS `think_admin`;
CREATE TABLE `think_admin` (
  `id` mediumint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(255) NOT NULL DEFAULT 'e10adc3949ba59abbe56e057f20f883e' COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_admin
-- ----------------------------
INSERT INTO `think_admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for `think_classs`
-- ----------------------------
DROP TABLE IF EXISTS `think_classs`;
CREATE TABLE `think_classs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_classs
-- ----------------------------
INSERT INTO `think_classs` VALUES ('6', '互联三班');
INSERT INTO `think_classs` VALUES ('2', '互联二班');
INSERT INTO `think_classs` VALUES ('3', '互联一班');

-- ----------------------------
-- Table structure for `think_conf`
-- ----------------------------
DROP TABLE IF EXISTS `think_conf`;
CREATE TABLE `think_conf` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `confname` varchar(30) NOT NULL DEFAULT '',
  `conf` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_conf
-- ----------------------------
INSERT INTO `think_conf` VALUES ('1', 'isstart', '0');

-- ----------------------------
-- Table structure for `think_course`
-- ----------------------------
DROP TABLE IF EXISTS `think_course`;
CREATE TABLE `think_course` (
  `couno` int(11) NOT NULL AUTO_INCREMENT,
  `couname` char(30) NOT NULL,
  `kind` char(8) NOT NULL,
  `credit` decimal(5,0) NOT NULL,
  `teacher` char(20) NOT NULL,
  `instartend` char(50) NOT NULL,
  `limitNum` tinyint(125) NOT NULL,
  `willnum` tinyint(125) NOT NULL,
  PRIMARY KEY (`couno`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_course
-- ----------------------------
INSERT INTO `think_course` VALUES ('1', '心理与健康', '选修', '2', '李晓燕', '01-14(9.10）3-201', '60', '0');
INSERT INTO `think_course` VALUES ('2', '职业沟通与交流', '选修', '2', '李行军', '01-14(9.10）3-401', '75', '0');
INSERT INTO `think_course` VALUES ('3', '岭南文化', '选修', '2', '梁燕(C)', '01-14(9.10）5-401', '100', '0');
INSERT INTO `think_course` VALUES ('4', '中外影视鉴赏', '选修', '2', '王晓娜', '01-14(9.10）3-401', '50', '0');
INSERT INTO `think_course` VALUES ('5', '孙子兵法谋略与应用', '选修', '1', '刘玉富', '01-14(9.10）5-401', '90', '0');
INSERT INTO `think_course` VALUES ('6', '个人理财与规划', '选修', '1', '张德发', '01-14(9.10）5-101', '40', '0');

-- ----------------------------
-- Table structure for `think_stucou`
-- ----------------------------
DROP TABLE IF EXISTS `think_stucou`;
CREATE TABLE `think_stucou` (
  `stuno` char(255) NOT NULL,
  `couno` char(30) NOT NULL,
  `state` int(1) NOT NULL,
  PRIMARY KEY (`couno`,`stuno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_stucou
-- ----------------------------

-- ----------------------------
-- Table structure for `think_student`
-- ----------------------------
DROP TABLE IF EXISTS `think_student`;
CREATE TABLE `think_student` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` bigint(255) NOT NULL COMMENT '学号',
  `stuname` char(30) NOT NULL COMMENT '班级',
  `classid` mediumint(10) NOT NULL,
  `password` char(33) NOT NULL DEFAULT 'e10adc3949ba59abbe56e057f20f883e',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_student
-- ----------------------------
INSERT INTO `think_student` VALUES ('1', '31702160301', '李一', '6', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `think_student` VALUES ('2', '31702160302', '李二', '6', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `think_student` VALUES ('3', '31702160303', '李三', '6', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `think_student` VALUES ('4', '31702160304', '李四', '6', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `think_student` VALUES ('5', '31702160305', '李五', '6', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `think_student` VALUES ('6', '31702160306', '李六', '6', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `think_student` VALUES ('7', '31702160307', '李七', '6', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `think_student` VALUES ('8', '31702160308', '李八', '6', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `think_student` VALUES ('9', '31702160309', '李九', '6', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `think_student` VALUES ('10', '31702160310', '李十', '6', 'e10adc3949ba59abbe56e057f20f883e');
