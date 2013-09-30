<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */





define('IN_ECS', true);

require(ROOT_PATH. '/includes/init.php');




if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}
#$smarty->caching = false;

$affiliate = unserialize($GLOBALS['_CFG']['affiliate']);
$smarty->assign('affiliate', $affiliate);




$cache_id = $goods_id . '-' . GLogin::rank().'-'.$_CFG['lang'];
$cache_id = sprintf('%X', crc32($cache_id));

if (!$smarty->is_cached('goods.dwt', $cache_id))
{
        /* 模板赋值 */
    assign_template();
    $position = assign_ur_here();
    $smarty->assign('page_title',       $position['title']);       // 页面标题
    $smarty->assign('ur_here',          $position['ur_here'] . '> ' . $topic['title']);     // 当前位置
    $smarty->assign('show_marketprice', $_CFG['show_marketprice']);
    $smarty->assign('sort_goods_arr',   $sort_goods_arr);          // 商品列表
    $smarty->assign('helps',           get_shop_help());       // 网店帮助
}
$smarty->display('enterprise.dwt',      $cache_id);
?>
