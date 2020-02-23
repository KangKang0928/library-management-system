/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 80018
Source Host           : localhost:3306
Source Database       : database

Target Server Type    : MYSQL
Target Server Version : 80018
File Encoding         : 65001

Date: 2020-02-23 20:27:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `书号` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `书名` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `作者` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `出版社` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `馆藏点` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `库存` int(11) NOT NULL,
  `单价` double(11,2) NOT NULL,
  PRIMARY KEY (`书号`),
  CONSTRAINT `CK_1` CHECK ((`库存` >= 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for sap
-- ----------------------------
DROP TABLE IF EXISTS `sap`;
CREATE TABLE `sap` (
  `学号` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `密码` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`学号`),
  CONSTRAINT `sap_ibfk_1` FOREIGN KEY (`学号`) REFERENCES `stu` (`学号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for sb
-- ----------------------------
DROP TABLE IF EXISTS `sb`;
CREATE TABLE `sb` (
  `书号` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `学号` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `借阅日期` date NOT NULL,
  PRIMARY KEY (`书号`,`学号`),
  KEY `2` (`学号`),
  CONSTRAINT `1` FOREIGN KEY (`书号`) REFERENCES `book` (`书号`),
  CONSTRAINT `2` FOREIGN KEY (`学号`) REFERENCES `stu` (`学号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for stu
-- ----------------------------
DROP TABLE IF EXISTS `stu`;
CREATE TABLE `stu` (
  `学号` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `姓名` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `性别` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `单位` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `联系方式` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`学号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
