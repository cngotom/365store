-- ecshop v2.x SQL Dump Program
-- http://admin.com
-- 
-- DATE : 2013-01-01 18:43:16
-- MYSQL SERVER VERSION : 5.0.51b-community-nt-log
-- PHP VERSION : 5.3.10
-- ECShop VERSION : v2.7.3
-- Vol : 1
DROP TABLE IF EXISTS `green_brand`;
CREATE TABLE `green_brand` (
  `brand_id` smallint(5) unsigned NOT NULL auto_increment,
  `brand_name` varchar(60) NOT NULL default '',
  `brand_logo` varchar(80) NOT NULL default '',
  `brand_desc` text NOT NULL,
  `site_url` varchar(255) NOT NULL default '',
  `sort_order` tinyint(3) unsigned NOT NULL default '50',
  `is_show` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`brand_id`),
  KEY `is_show` (`is_show`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('1', '北大荒', '1356989182854233565.gif', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('101', '刀郎', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('9095', '凯基', '1356992747951688183.jpg', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('9094', '西瑞斯', '1356992500289984243.jpg', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('9093', '可米小子', '1356992216110929813.jpg', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('9092', '添康生态', '1356991089286216564.jpg', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('9091', '台湾食尚森活 ', '1356990161698280085.JPG', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('9090', '北大荒绿野', '1356989967128139135.gif', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('94', '北大荒丰缘', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('95', '宝泉', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('96', '北大荒自然邨', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('97', '珍源', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('98', '龙王', '1357007907888242033.gif', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('99', '北大荒黑蜂', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('104', '光照人', '1356989209304632040.gif', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('105', '中茶', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('106', '果老', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('3406', '北纬45度', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('9089', '私享时光', '1356989541953861270.gif', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('9088', '欧博特', '1356992362518815728.gif', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('9087', '汉珍蜜坊', '1356989389933026609.gif', '', 'http://', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('9086', '中粮', '1356989340405481542.gif', '', 'http://', '50', '1');
-- END ecshop v2.x SQL Dump Program 