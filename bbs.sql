/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : bbs

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-08-26 10:19:46
*/



GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, FILE, LOCK TABLES, EXECUTE, SHOW VIEW ON *.* TO 'ltrebbs'@'127.0.0.1' IDENTIFIED BY PASSWORD '*BA8314452C632E88090FB22D106D4C21906EC09A';



SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ltrebbs_posts`
-- ----------------------------
DROP TABLE IF EXISTS `ltrebbs_posts`;
CREATE TABLE `ltrebbs_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `create_time` int(10) unsigned zerofill DEFAULT NULL,
  `update_time` int(10) unsigned zerofill DEFAULT NULL,
  `uid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `ltrebbs_posts` VALUES ('1', '第一帖的标题', '第一帖的内容', null, null, '1');
INSERT INTO `ltrebbs_posts` VALUES ('2', '范德萨发生', '范德萨范德萨', null, null, '1');
INSERT INTO `ltrebbs_posts` VALUES ('3', '光度法噶是的', '41564fgasd654', null, null, '1');
INSERT INTO `ltrebbs_posts` VALUES ('4', '范德萨发生大幅嘎斯的嘎斯', 'g5fdsafsd65a', null, null, '1');
INSERT INTO `ltrebbs_posts` VALUES ('5', '范德萨范德萨发的', '范德萨发斯蒂芬', null, null, '1');
INSERT INTO `ltrebbs_posts` VALUES ('6', 'fdsfdsaf', 'fdsaf', '1408917188', '1408917188', '2');
INSERT INTO `ltrebbs_posts` VALUES ('7', 'ffsdfdsfds', 'fdsfdsf', '1408921086', '1408921086', '2');
INSERT INTO `ltrebbs_posts` VALUES ('8', 'fdsfdsfds', 'fdsfdsf', '1408921105', '1408921105', '2');
INSERT INTO `ltrebbs_posts` VALUES ('9', 'ffdsfdsf', 'fdsff', '1408921111', '1408921111', '2');
INSERT INTO `ltrebbs_posts` VALUES ('10', 'ddd', 'tfhdfh', '1408921120', '1408921120', '2');
INSERT INTO `ltrebbs_posts` VALUES ('11', 'WYSIWYG编辑器', '<h1>432432</h1><div style=\"background-color:black;width:100px;height:100px;\"></div>bootstrap-wysiwyg \n为Bootstrap定制的微型所见即所得（What you see is what you get）富文本编辑器\n\n<h1>bootstrap-wysiwyg <br> <small>为Bootstrap定制的微型所见即所得（What you see is what you get）富文本编辑器</small></h1>', '1408921390', '1408921390', '2');
INSERT INTO `ltrebbs_posts` VALUES ('12', 'fdssfsd', 'fdsfsdafs', '1408937034', '1408937034', '4');
INSERT INTO `ltrebbs_posts` VALUES ('13', '今天拍的片子不错', '今天拍的片子不错今天拍的片子不错', '1408937190', '1408937190', '5');

-- ----------------------------
-- Table structure for `remind`
-- ----------------------------
DROP TABLE IF EXISTS `ltrebbs_remind`;
CREATE TABLE `ltrebbs_remind` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `uid` int(10) unsigned DEFAULT NULL,
  `cretime` int(10) unsigned zerofill DEFAULT NULL COMMENT '系统创建提醒的时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of remind
-- ----------------------------

-- ----------------------------
-- Table structure for `ltrebbs_reply`
-- ----------------------------
DROP TABLE IF EXISTS `ltrebbs_reply`;
CREATE TABLE `ltrebbs_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci,
  `uid` int(10) unsigned DEFAULT NULL,
  `pid` int(10) unsigned DEFAULT NULL COMMENT '帖子id',
  `create_time` int(10) unsigned zerofill DEFAULT NULL,
  `update_time` int(10) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ltrebbs_reply
-- ----------------------------
INSERT INTO `ltrebbs_reply` VALUES ('1', '第一条评论', '1', '1', null, null);
INSERT INTO `ltrebbs_reply` VALUES ('2', '第二条评论', '1', '1', null, null);
INSERT INTO `ltrebbs_reply` VALUES ('3', '第三条评论', '1', '1', null, null);
INSERT INTO `ltrebbs_reply` VALUES ('10', 'dsfdsfsf', '2', '6', '1408920516', '1408920516');
INSERT INTO `ltrebbs_reply` VALUES ('11', 'shabisi', '2', '6', '1408920568', '1408920568');
INSERT INTO `ltrebbs_reply` VALUES ('12', 'dsfiodsfjsofdsfds', '2', '6', '1408920782', '1408920782');
INSERT INTO `ltrebbs_reply` VALUES ('13', 'dsfiodsfjsofdsfds', '2', '6', '1408920788', '1408920788');
INSERT INTO `ltrebbs_reply` VALUES ('14', 'dsfiodsfjsofdsfds', '2', '6', '1408920789', '1408920789');
INSERT INTO `ltrebbs_reply` VALUES ('15', 'fdsfdsfdsf', '2', '3', '1408920976', '1408920976');
INSERT INTO `ltrebbs_reply` VALUES ('16', 'fdsfdsfdsf', '2', '3', '1408920980', '1408920980');
INSERT INTO `ltrebbs_reply` VALUES ('17', 'dsfdsfdsf', '2', '6', '1408921050', '1408921050');
INSERT INTO `ltrebbs_reply` VALUES ('18', 'dsfdsfdsffdsfds', '2', '6', '1408921054', '1408921054');
INSERT INTO `ltrebbs_reply` VALUES ('19', 'dsfdsfdsffdsfds', '2', '6', '1408921055', '1408921055');
INSERT INTO `ltrebbs_reply` VALUES ('20', 'dsfdsfdsffdsfds', '2', '6', '1408921056', '1408921056');
INSERT INTO `ltrebbs_reply` VALUES ('21', 'dsfdsfdsffdsfds', '2', '6', '1408921057', '1408921057');
INSERT INTO `ltrebbs_reply` VALUES ('22', 'fdsfdsfds', '2', '7', '1408921090', '1408921090');
INSERT INTO `ltrebbs_reply` VALUES ('23', 'fdsfdsfds', '2', '7', '1408921092', '1408921092');
INSERT INTO `ltrebbs_reply` VALUES ('24', 'fdsfdsfds', '2', '7', '1408921093', '1408921093');
INSERT INTO `ltrebbs_reply` VALUES ('25', 'fdsfdsfds', '2', '7', '1408921094', '1408921094');
INSERT INTO `ltrebbs_reply` VALUES ('26', 'fdsfdsfds', '2', '7', '1408921096', '1408921096');
INSERT INTO `ltrebbs_reply` VALUES ('27', 'fdsfdsfds', '2', '7', '1408921097', '1408921097');
INSERT INTO `ltrebbs_reply` VALUES ('28', '<script>alert(123);</script>', '2', '10', '1408921209', '1408921209');
INSERT INTO `ltrebbs_reply` VALUES ('29', '<h1>432432</h1>', '2', '10', '1408921232', '1408921232');
INSERT INTO `ltrebbs_reply` VALUES ('30', '<h1>432432</h1>', '2', '10', '1408921239', '1408921239');
INSERT INTO `ltrebbs_reply` VALUES ('31', '<h1>432432</h1>', '2', '10', '1408921243', '1408921243');
INSERT INTO `ltrebbs_reply` VALUES ('32', '<h1>432432</h1><div style=\"background-color:black;width:100px;height:100px;\"></div>', '2', '10', '1408921292', '1408921292');
INSERT INTO `ltrebbs_reply` VALUES ('33', '<h1>432432</h1><div style=\"background-color:black;width:100px;height:100px;\"></div>', '2', '10', '1408921294', '1408921294');
INSERT INTO `ltrebbs_reply` VALUES ('34', '<h1>432432</h1><div style=\"background-color:black;width:100px;height:100px;\"></div>', '2', '10', '1408921311', '1408921311');
INSERT INTO `ltrebbs_reply` VALUES ('35', '<h1>432432</h1><div style=\"background-color:black;width:100px;height:100px;\"></div>bootstrap-wysiwyg \n为Bootstrap定制的微型所见即所得（What you see is what you get）富文本编辑器\n\n<h1>bootstrap-wysiwyg <br> <small>为Bootstrap定制的微型所见即所得（What you see is what you get）富文本编辑器</small></h1>', '2', '10', '1408921360', '1408921360');
INSERT INTO `ltrebbs_reply` VALUES ('36', '<h1>432432</h1><div style=\"background-color:black;width:100px;height:100px;\"></div>bootstrap-wysiwyg 为Bootstrap定制的微型所见即所得（What you see is what you get）富文本编辑器 <h1>bootstrap-wysiwyg <br> <small>为Bootstrap定制的微型所见即所得（What you see is what you get）富文本编辑器</small></h1>', '2', '11', '1408921409', '1408921409');
INSERT INTO `ltrebbs_reply` VALUES ('37', '<h1>432432</h1><div style=\"background-color:black;width:100px;height:100px;\"></div>bootstrap-wysiwyg 为Bootstrap定制的微型所见即所得（What you see is what you get）富文本编辑器 <h1>bootstrap-wysiwyg <br> <small>为Bootstrap定制的微型所见即所得（What you see is what you get）富文本编辑器</small></h1>', '2', '11', '1408921444', '1408921444');
INSERT INTO `ltrebbs_reply` VALUES ('38', 'fdsfsdfsdf', '4', '12', '1408937039', '1408937039');
INSERT INTO `ltrebbs_reply` VALUES ('39', 'fdsfsdfsdffdsfsdfds', '4', '12', '1408937042', '1408937042');
INSERT INTO `ltrebbs_reply` VALUES ('40', 'fdsfsdfsdffdsfsdfdsfdsfdsfsd', '4', '12', '1408937044', '1408937044');
INSERT INTO `ltrebbs_reply` VALUES ('41', 'fdsfsdfsdffdsfsdfdsfdsfdsfsd', '4', '12', '1408937045', '1408937045');
INSERT INTO `ltrebbs_reply` VALUES ('42', 'fdsfsdfsdffdsfsdfdsfdsfdsfsd', '4', '12', '1408937046', '1408937046');
INSERT INTO `ltrebbs_reply` VALUES ('43', 'fdsfsdfsdffdsfsdfdsfdsfdsfsd', '4', '12', '1408937048', '1408937048');
INSERT INTO `ltrebbs_reply` VALUES ('44', 'fdsfsdfsdffdsfsdfdsfdsfdsfsd', '4', '12', '1408937060', '1408937060');
INSERT INTO `ltrebbs_reply` VALUES ('45', 'fdsfsdfsdffdsfsdfdsfdsfdsfsddsfsfsafsd', '4', '12', '1408937069', '1408937069');
INSERT INTO `ltrebbs_reply` VALUES ('46', '给我看看', '4', '13', '1408937237', '1408937237');
INSERT INTO `ltrebbs_reply` VALUES ('47', '饱腹感的还是 嘎斯的 ', '4', '7', '1408937282', '1408937282');
INSERT INTO `ltrebbs_reply` VALUES ('48', '啥地方发生大发嘎斯的aga', null, '4', '1409017662', '1409017662');
INSERT INTO `ltrebbs_reply` VALUES ('49', '啥地方发生大发嘎斯的aga', null, '4', '1409017664', '1409017664');
INSERT INTO `ltrebbs_reply` VALUES ('50', '啥地方发生大发嘎斯的aga', null, '4', '1409017666', '1409017666');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `ltrebbs_user`;
CREATE TABLE `ltrebbs_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nickname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thirdpart_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '第三方账户类型：qq/weibo',
  `thirdpart_account` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '第三方认证的账号（有邮箱的也要包含）',
  `avatar` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '头像地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ltrebbs_user
-- ----------------------------
INSERT INTO `ltrebbs_user` VALUES ('1', '第一个用户', 'Ltre', '88c427ed3b6984e031c9ba156bcfe6a86539f9f3', 'weibo', 'fkb_159357@163.com', 'http://www.kusha.biz/uc_server/avatar.php?uid=20&s');
INSERT INTO `ltrebbs_user` VALUES ('2', 'root', 'Root', '88c427ed3b6984e031c9ba156bcfe6a86539f9f3', null, null, 'http://www.kusha.biz/uc_server/avatar.php?uid=20&s');
INSERT INTO `ltrebbs_user` VALUES ('3', 'hehe', 'hehe', '42525bb6d3b0dc06bb78ae548733e8fbb55446b3', null, null, 'http://www.kusha.biz/uc_server/avatar.php?uid=20&s');
INSERT INTO `ltrebbs_user` VALUES ('4', 'wangnima', '王尼玛', '80cbb47567ddbd4525c9dbfb85787de4e3e2b45c', null, null, 'http://www.kusha.biz/uc_server/avatar.php?uid=20&s');
INSERT INTO `ltrebbs_user` VALUES ('5', '唐马儒', '唐马儒', '5febd7d541462ec32bc73c671ceae2e2e0ab852c', null, null, 'http://www.kusha.biz/uc_server/avatar.php?uid=20&s');

-- ----------------------------
-- Table structure for `ltrebbs_userconnect`
-- ----------------------------
DROP TABLE IF EXISTS `ltrebbs_userconnect`;
CREATE TABLE `ltrebbs_userconnect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `connect_openid` int(11) DEFAULT NULL,
  `connect_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `connect_nickname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ltrebbs_userconnect
-- ----------------------------
