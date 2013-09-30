-- ecshop v2.x SQL Dump Program
-- http://admin.com
-- 
-- DATE : 2013-01-01 20:34:11
-- MYSQL SERVER VERSION : 5.0.51b-community-nt-log
-- PHP VERSION : 5.3.10
-- ECShop VERSION : v2.7.3
-- Vol : 1
DROP TABLE IF EXISTS `green_ad`;
CREATE TABLE `green_ad` (
  `ad_id` smallint(5) unsigned NOT NULL auto_increment,
  `position_id` smallint(5) unsigned NOT NULL default '0',
  `media_type` tinyint(3) unsigned NOT NULL default '0',
  `ad_name` varchar(60) NOT NULL default '',
  `ad_link` varchar(255) NOT NULL default '',
  `ad_code` text NOT NULL,
  `start_time` int(11) NOT NULL default '0',
  `end_time` int(11) NOT NULL default '0',
  `link_man` varchar(60) NOT NULL default '',
  `link_email` varchar(60) NOT NULL default '',
  `link_phone` varchar(60) NOT NULL default '',
  `click_count` mediumint(8) unsigned NOT NULL default '0',
  `enabled` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`ad_id`),
  KEY `position_id` (`position_id`),
  KEY `enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `green_ad` ( `ad_id`, `position_id`, `media_type`, `ad_name`, `ad_link`, `ad_code`, `start_time`, `end_time`, `link_man`, `link_email`, `link_phone`, `click_count`, `enabled` ) VALUES  ('1', '0', '0', '粮油副食', '', '1333901882075426637.jpg', '1333900800', '1336492800', '', '', '', '4', '1');
INSERT INTO `green_ad` ( `ad_id`, `position_id`, `media_type`, `ad_name`, `ad_link`, `ad_code`, `start_time`, `end_time`, `link_man`, `link_email`, `link_phone`, `click_count`, `enabled` ) VALUES  ('2', '1', '0', 'index-left1', 'http://www.365store.cn/article.php?id=31', '1347387924202873463.jpg', '1347350400', '1381478400', '', '', '', '174', '1');
INSERT INTO `green_ad` ( `ad_id`, `position_id`, `media_type`, `ad_name`, `ad_link`, `ad_code`, `start_time`, `end_time`, `link_man`, `link_email`, `link_phone`, `click_count`, `enabled` ) VALUES  ('3', '1', '0', 'index-left2', 'http://www.365store.cn/article.php?id=32', '1347387948390706039.jpg', '1347350400', '1381478400', '', '', '', '18', '0');
INSERT INTO `green_ad` ( `ad_id`, `position_id`, `media_type`, `ad_name`, `ad_link`, `ad_code`, `start_time`, `end_time`, `link_man`, `link_email`, `link_phone`, `click_count`, `enabled` ) VALUES  ('4', '1', '0', 'index-left3', 'http://www.365store.cn/article.php?id=33', '1347387967962368341.jpg', '1347350400', '1381478400', '', '', '', '44', '0');
INSERT INTO `green_ad` ( `ad_id`, `position_id`, `media_type`, `ad_name`, `ad_link`, `ad_code`, `start_time`, `end_time`, `link_man`, `link_email`, `link_phone`, `click_count`, `enabled` ) VALUES  ('5', '1', '0', 'index-left4', 'http://www.365store.cn/article.php?id=34', '1347387977788078612.jpg', '1347350400', '1381564800', '', '', '', '39', '0');
INSERT INTO `green_ad` ( `ad_id`, `position_id`, `media_type`, `ad_name`, `ad_link`, `ad_code`, `start_time`, `end_time`, `link_man`, `link_email`, `link_phone`, `click_count`, `enabled` ) VALUES  ('6', '0', '0', '十二种杂粮礼盒', 'http://www.365store.cn/goods.php?id=1120', '1356995099020398833.jpg', '1356940800', '1391068800', '', '', '', '1', '1');
INSERT INTO `green_ad` ( `ad_id`, `position_id`, `media_type`, `ad_name`, `ad_link`, `ad_code`, `start_time`, `end_time`, `link_man`, `link_email`, `link_phone`, `click_count`, `enabled` ) VALUES  ('7', '0', '0', '芳临豆乳', 'http://www.365store.cn/goods.php?id=56038', '1356995157892507490.gif', '1356940800', '1391068800', '', '', '', '1', '1');
-- END ecshop v2.x SQL Dump Program 