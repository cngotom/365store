-- ecshop v2.x SQL Dump Program
-- http://365admin.365chi.net
-- 
-- DATE : 2012-11-29 01:32:40
-- MYSQL SERVER VERSION : 5.1.61
-- PHP VERSION : 5.3.3
-- ECShop VERSION : v2.7.3
-- Vol : 1
DROP TABLE IF EXISTS `green_topic`;
CREATE TABLE `green_topic` (
  `topic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '''''',
  `intro` text NOT NULL,
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(10) NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `template` varchar(255) NOT NULL DEFAULT '''''',
  `css` text NOT NULL,
  `topic_img` varchar(255) DEFAULT NULL,
  `title_pic` varchar(255) DEFAULT NULL,
  `base_style` char(6) DEFAULT NULL,
  `htmls` mediumtext,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  KEY `topic_id` (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `green_topic` ( `topic_id`, `title`, `intro`, `start_time`, `end_time`, `data`, `template`, `css`, `topic_img`, `title_pic`, `base_style`, `htmls`, `keywords`, `description` ) VALUES  ('1', '绿色三六五 薪福送健康', '', '1337673600', '1340352000', 'O:8:\"stdClass\":1:{s:12:\"精品推荐\";a:12:{i:0;s:45:\"北大荒绿野稻花香精制大米(PE)|1597\";i:1;s:26:\"特级压缩黑木耳|1580\";i:2;s:26:\"十二种杂粮礼盒|1120\";i:3;s:41:\"北大荒自然邨五谷杂粮礼盒|1121\";i:4;s:35:\"五星湖东北黑蜂椴树蜜|1589\";i:5;s:17:\"笨炒松籽|1576\";i:6;s:32:\"北大荒亲民有机面粉|1622\";i:7;s:35:\"北大荒亲民有机饺子粉|1623\";i:8;s:42:\"添康生态有机去骨肘子350g装|1663\";i:9;s:36:\"添康生态有机肉丁350g装|1665\";i:10;s:36:\"添康生态有机肉丝350g装|1669\";i:11;s:39:\"添康生态有机小里脊350g装|1679\";}}', '', '', 'images/afficheimg/20120523kdcdfq.jpg', '', '', '', '', '');
INSERT INTO `green_topic` ( `topic_id`, `title`, `intro`, `start_time`, `end_time`, `data`, `template`, `css`, `topic_img`, `title_pic`, `base_style`, `htmls`, `keywords`, `description` ) VALUES  ('2', '粽香情浓', '', '1337932800', '1340956800', 'O:8:\"stdClass\":0:{}', 'topic_zongzi.dwt', '', '', '', '', '', '', '');
INSERT INTO `green_topic` ( `topic_id`, `title`, `intro`, `start_time`, `end_time`, `data`, `template`, `css`, `topic_img`, `title_pic`, `base_style`, `htmls`, `keywords`, `description` ) VALUES  ('3', '安心蔬菜 便利到家', '', '1339488000', '1371024000', 'O:8:\"stdClass\":0:{}', 'topic_shucai.dwt', '', '', '', '', '', '', '');
-- END ecshop v2.x SQL Dump Program 