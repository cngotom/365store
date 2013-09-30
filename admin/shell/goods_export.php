<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

define('IN_ECS', true);
require('../includes/init.php');
include_once(ROOT_PATH . 'admin/includes/lib_goods.php');



 /* 配置导出列 */
$where = " where is_on_sale = 1 and is_delete = 0 ";
$goods_fields = array( 'goods_id','goods_name','goods_desc','brand_name','cat_name','shop_price','goods_weight',1,2,3,4);
$goods_fields = array( 'goods_id','goods_name','brand_name','goods_weight');
include_once('../includes/cls_phpzip.php');
$zip = new PHPZip;
$charset_custom  = "gb2312";


$sql = "SELECT g.*, b.brand_name as brandname " .
        " FROM " . $ecs->table('goods') . " AS g LEFT JOIN " . $ecs->table('brand') . " AS b " .
        "ON g.brand_id = b.brand_id" . $where;

$res = $db->query($sql);

$goods_field_name = set_goods_field_name($goods_fields, $_LANG['custom']);

/* csv文件数组 */
$goods_field_value = array();
foreach ($goods_fields as $field)
{
    if ($field == 'market_price' || $field == 'shop_price' || $field == 'integral' || $field == 'goods_weight' || $field == 'goods_number' || $field == 'warn_number' || $field == 'is_best' || $field == 'is_new' || $field == 'is_hot')
    {
        $goods_field_value[$field] = 0;
    }
    elseif ($field == 'is_on_sale' || $field == 'is_alone_sale' || $field == 'is_real')
    {
        $goods_field_value[$field] = 1;
    }
    else
    {
        $goods_field_value[$field] = '""';
    }
}

$content = '"' . implode('","', $goods_field_name) . "\"\n";
while ($row = $db->fetchRow($res))
{
    $goods_value = $goods_field_value;
    isset($goods_value['goods_name']) && ($goods_value['goods_name'] = '"' . $row['goods_name'] . '"');
    isset($goods_value['goods_id']) && ($goods_value['goods_id'] = '"' . $row['goods_id'] . '"');
    isset($goods_value['goods_sn']) && ($goods_value['goods_sn'] = '"' . $row['goods_sn'] . '"');
    isset($goods_value['brand_name']) && ($goods_value['brand_name'] = $row['brandname']);
    isset($goods_value['market_price']) && ($goods_value['market_price'] = $row['market_price']);
    isset($goods_value['shop_price']) && ($goods_value['shop_price'] = $row['shop_price']);
    isset($goods_value['integral']) && ($goods_value['integral'] = $row['integral']);
    isset($goods_value['original_img']) && ($goods_value['original_img'] = '"' . $row['original_img'] . '"');
    isset($goods_value['keywords']) && ($goods_value['keywords'] = '"' . $row['keywords'] . '"');
    isset($goods_value['goods_brief']) && ($goods_value['goods_brief'] = '"' . replace_special_char($row['goods_brief']) . '"');
    isset($goods_value['goods_desc']) && ($goods_value['goods_desc'] = '"' . replace_special_char($row['goods_desc']) . '"');
    isset($goods_value['goods_weight']) && ($goods_value['goods_weight'] = $row['goods_weight']);
    isset($goods_value['goods_number']) && ($goods_value['goods_number'] = $row['goods_number']);
    isset($goods_value['warn_number']) && ($goods_value['warn_number'] = $row['warn_number']);
    isset($goods_value['is_best']) && ($goods_value['is_best'] = $row['is_best']);
    isset($goods_value['is_new']) && ($goods_value['is_new'] = $row['is_new']);
    isset($goods_value['is_hot']) && ($goods_value['is_hot'] = $row['is_hot']);
    isset($goods_value['is_on_sale']) && ($goods_value['is_on_sale'] = $row['is_on_sale']);
    isset($goods_value['is_alone_sale']) && ($goods_value['is_alone_sale'] = $row['is_alone_sale']);
    isset($goods_value['is_real']) && ($goods_value['is_real'] = $row['is_real']);

    $sql = "SELECT `attr_id`, `attr_value` FROM " . $ecs->table('goods_attr') . " WHERE `goods_id` = '" . $row['goods_id'] . "'";
    $query = $db->query($sql);
    while ($attr = $db->fetchRow($query))
    {
        if (in_array($attr['attr_id'], $goods_fields))
        {
            $goods_value[$attr['attr_id']] = '"' . $attr['attr_value'] . '"';
        }
    }
    // 分类名称
    if(in_array ("cat_name",$goods_fields))
    {
        $sql = "SELECT `cat_name`  FROM " . $ecs->table('category') . " WHERE `cat_id` = '" . $row['cat_id'] . "'";
        $goods_value['cat_name'] =  '"' .$db->getOne($sql). '"';
        
    }
        
        
        
        
        
    $content .= implode(",", $goods_value) . "\n";

    /* 压缩图片 */
    if (0 && !empty($row['goods_img']) && is_file(ROOT_PATH . $row['goods_img']))
    {
        $zip->add_file(file_get_contents(ROOT_PATH . $row['goods_img']), $row['goods_img']);
    }
}
$charset = empty($charset_custom) ? 'UTF8' : trim($charset_custom);
$zip->add_file(ecs_iconv(EC_CHARSET, $charset, $content), 'goods_list.csv');

header("Content-Disposition: attachment; filename=goods_list.zip");
header("Content-Type: application/unknown");
die($zip->file());

/**
 * 设置导出商品字段名
 *
 * @param array $array 字段数组
 * @param array $lang 字段名
 *
 * @return array
 */
function set_goods_field_name($array, $lang)
{
    $tmp_fields = $array;
    foreach ($array as $key => $value)
    {
        if (isset($lang[$value]))
        {
            $tmp_fields[$key] = $lang[$value];
        }
        else
        {
            $tmp_fields[$key] = $GLOBALS['db']->getOne("SELECT `attr_name` FROM " . $GLOBALS['ecs']->table('attribute') . " WHERE `attr_id` = '" . intval($value) . "'");
        }
    }
    return $tmp_fields;
}


/**
 *
 * 根据一二级名称获取分类id 
 */
function get_type_id($ftype,$ctype)
{
    $c_id = $GLOBALS['db']->getOne('select cat_id from '. $GLOBALS['ecs']->table('category')." where cat_name = '".$ctype."'");
    if($c_id)
    {
        return $c_id;
    }
    else
    {
        $f_id = $GLOBALS['db']->getOne('select cat_id from '.$GLOBALS['ecs']->table('category')." where cat_name = '".$ftype."'");
        if(!isset($f_id))
        {
            $ftype = "其他";
            $f_id = $GLOBALS['db']->getOne('select cat_id from '.$GLOBALS['ecs']->table('category')." where cat_name like '".$ftype."'");
        }
        
        $f_id = isset($f_id)?$f_id:0;
        return $f_id;
    }
    
    
}
function replace_special_char($str, $replace = true)
{
    $str = str_replace("\r\n", "", image_path_format($str));
    $str = str_replace("\t", "    ", $str);
    $str = str_replace("\n", "", $str);
    if ($replace == true)
    {
        $str = '"' . str_replace('"', '""', $str) . '"';
    }
    return $str;
}
function image_path_format($content)
{
    $prefix = 'http://' . $_SERVER['SERVER_NAME'];
    $pattern = '/(background|src)=[\'|\"]((?!http:\/\/).*?)[\'|\"]/i';
    $replace = "$1='" . $prefix . "$2'";
    return preg_replace($pattern, $replace, $content);
}
?>
