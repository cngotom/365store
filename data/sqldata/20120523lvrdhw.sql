-- ecshop v2.x SQL Dump Program
-- http://365admin.365chi.net
-- 
-- DATE : 2012-05-23 01:13:58
-- MYSQL SERVER VERSION : 5.1.61
-- PHP VERSION : 5.3.3
-- ECShop VERSION : v2.7.3
-- Vol : 1
DROP TABLE IF EXISTS `green_brand`;
CREATE TABLE `green_brand` (
  `brand_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(60) NOT NULL DEFAULT '',
  `brand_logo` varchar(80) NOT NULL DEFAULT '',
  `brand_desc` text NOT NULL,
  `site_url` varchar(255) NOT NULL DEFAULT '',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '50',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`brand_id`),
  KEY `is_show` (`is_show`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('1', '北大荒', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('100', '尼柚', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('3', '可米小子', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('4', '椰乡春光', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('5', '南国', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('6', '好妈妈', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('7', '果果家', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('8', '精物堂', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('9', '天山', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('10', '万岁牌', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('11', '山里妹', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('12', '妹幺', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('13', '原味巡礼', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('14', '日正', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('15', 'BLACK', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('16', '绿的宣言', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('17', '宜农', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('18', '田美', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('19', '春光', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('20', '太祖', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('21', '塔拉额吉', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('22', '可可西里', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('23', '老闫家', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('24', '《中祥》自然之顏', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('25', '中祥', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('26', '日香', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('27', '台糖', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('28', '德昌', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('29', '有机厨坊', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('30', '绿色小镇', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('31', '爱天然', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('32', '7—SELECT', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('33', '统一', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('34', '御家族', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('35', '维力', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('36', '金兰', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('37', '月湾湾', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('38', '塘塘厨坊', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('39', '弘阳', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('40', '古早', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('41', '桂博', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('42', '苗姑娘', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('43', '聪明', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('44', '大老姐', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('45', '北大荒绿野', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('46', '祥味源', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('47', '牛头牌', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('48', '广达香', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('49', '帆船牌', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('50', '老骡子', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('51', '工研', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('52', '台湾味荣', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('53', '品利', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('54', '塔原红花', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('55', '老知春', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('56', '羌都', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('57', '塔拉.额吉', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('58', '宏兴', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('59', '伊佰', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('60', 'O尼柚', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('61', '宁安堡', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('62', '香满席', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('63', '华源昌', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('101', '刀郎', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('66', '湘源天', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('67', '七彩云南', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('68', '云南滇情', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('69', '葛仙翁', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('70', '兰茶云品', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('71', '珍品', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('72', '黔茶', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('73', '品味印象', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('74', '萧氏', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('75', '丛林', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('76', '老中医', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('77', '维恩淇', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('78', '金门酒厂', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('79', '京水源', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('80', '乌苏里江', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('81', '蘑菇屯', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('82', '沂蒙人家', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('83', '益群', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('84', '朝慕思', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('85', '怀山药', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('86', '家瑶', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('87', '天山黑蜂', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('88', '呀啦嗦', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('89', '伊犁黑蜂', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('90', '藏原蜜语', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('91', '赛品', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('92', '紫金玫瑰', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('94', '北大荒丰缘', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('95', '宝泉', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('96', '北大荒自然邨', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('97', '珍源', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('98', '龙王', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('99', '北大荒黑蜂', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('104', '光照人', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('105', '中茶', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('106', '果老', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('3406', '北纬45度', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('3407', '北大荒东北黑蜂', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('3409', '九三集团', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('3408', '五星湖', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('3410', '北大荒亲民', '', '', '', '50', '1');
INSERT INTO `green_brand` ( `brand_id`, `brand_name`, `brand_logo`, `brand_desc`, `site_url`, `sort_order`, `is_show` ) VALUES  ('3411', '玉地', '', '', '', '50', '1');
-- END ecshop v2.x SQL Dump Program 