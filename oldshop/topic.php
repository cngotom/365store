<?php

/**
 * ECSHOP 专题前台
 * ============================================================================
 * 版权所有 2005-2011 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * @author:     webboy <laupeng@163.com>
 * @version:    v2.1
 * ---------------------------------------------
 */

define('IN_ECS', true);

require(ROOT_PATH . '/includes/init.php');

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = false;
}
$topic_id  = empty($_REQUEST['topic_id']) ? 0 : intval($_REQUEST['topic_id']);

$sql = "SELECT template FROM " . $ecs->table('topic') .
        "WHERE topic_id = '$topic_id' and  " . gmtime() . " >= start_time and " . gmtime() . "<= end_time";

$topic = $db->getRow($sql);

if(empty($topic))
{
    /* 如果没有找到任何记录则跳回到首页 */
    ecs_header("Location: ./\n");
    exit;
}

$templates = empty($topic['template']) ? 'topic.dwt' : $topic['template'];

$cache_id = sprintf('%X', crc32(GLogin::rank() . '-' . $_CFG['lang'] . '-' . $topic_id));

if (!$smarty->is_cached($templates, $cache_id))
{
    $sql = "SELECT * FROM " . $ecs->table('topic') . " WHERE topic_id = '$topic_id'";

    $topic = $db->getRow($sql);
    $topic['data'] = addcslashes($topic['data'], "'");
    $tmp = @unserialize($topic["data"]);
    $arr = (array)$tmp;

    $goods_id = array();

    foreach ($arr AS $key=>$value)
    {
        foreach($value AS $k => $val)
        {
            $opt = explode('|', $val);
            $arr[$key][$k] = $opt[1];
            $goods_id[] = $opt[1];
        }
    }

    $sql = 'SELECT g.goods_id, g.goods_name, g.goods_name_style, g.market_price, g.is_new, g.is_best, g.is_hot, g.shop_price AS org_price, ' .
                "IFNULL(mp.user_price, g.shop_price * '".GLogin::discount()."') AS shop_price, g.promote_price, " .
                'g.promote_start_date, g.promote_end_date, g.goods_brief, g.goods_thumb , g.goods_img ' .
                'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
                'LEFT JOIN ' . $GLOBALS['ecs']->table('member_price') . ' AS mp ' .
                "ON mp.goods_id = g.goods_id AND mp.user_rank = '".GLogin::rank()."' " .
                "WHERE " . db_create_in($goods_id, 'g.goods_id');

    $res = $GLOBALS['db']->query($sql);

    $sort_goods_arr = array();

    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        if ($row['promote_price'] > 0)
        {
            $promote_price = bargain_price($row['promote_price'], $row['promote_start_date'], $row['promote_end_date']);
            $row['promote_price'] = $promote_price > 0 ? price_format($promote_price) : '';
        }
        else
        {
            $row['promote_price'] = '';
        }

        if ($row['shop_price'] > 0)
        {
            $row['shop_price'] =  price_format($row['shop_price']);
        }
        else
        {
            $row['shop_price'] = '';
        }

        $row['url']              = build_uri('goods', array('gid'=>$row['goods_id']), $row['goods_name']);
        $row['goods_style_name'] = add_style($row['goods_name'], $row['goods_name_style']);
        $row['short_name']       = $GLOBALS['_CFG']['goods_name_length'] > 0 ?
                                    sub_str($row['goods_name'], $GLOBALS['_CFG']['goods_name_length']) : $row['goods_name'];
        $row['goods_thumb']      = get_image_path($row['goods_id'], $row['goods_thumb'], true);
        $row['short_style_name'] = add_style($row['short_name'], $row['goods_name_style']);

        foreach ($arr AS $key => $value)
        {
            foreach ($value AS $val)
            {
                if ($val == $row['goods_id'])
                {
                    $key = $key == 'default' ? $_LANG['all_goods'] : $key;
                    $sort_goods_arr[$key][] = $row;
                }
            }
        }
    }

    /* 模板赋值 */
    assign_template();
    $position = assign_ur_here();
    $smarty->assign('page_title',       $position['title']);       // 页面标题
    $smarty->assign('ur_here',          $position['ur_here'] . '> ' . $topic['title']);     // 当前位置
    $smarty->assign('show_marketprice', $_CFG['show_marketprice']);
    $smarty->assign('sort_goods_arr',   $sort_goods_arr);          // 商品列表
    $smarty->assign('topic',            $topic);                   // 专题信息
    $smarty->assign('keywords',         $topic['keywords']);       // 专题信息
    $smarty->assign('description',      $topic['description']);    // 专题信息
    $smarty->assign('title_pic',        $topic['title_pic']);      // 分类标题图片地址
    $smarty->assign('base_style',       '#' . $topic['base_style']);     // 基本风格样式颜色
    $smarty->assign('helps',           get_shop_help());       // 网店帮助
    
    
    //一卡换多卡活动
    if($topic_id == 5)
    {
        $top_ids = array(
            array( '56029', '56163', '56161', '56165', '56153'),
            array( '56158' ,'56164', '56031', '56030' ,'56155'),
            array(  '56157' ,'56217', '56216', '56160', '56156')
            
        );
        $center_ids = array(
            '56200' ,'56207', '56206', '56201', '56215'
            
        );

        $bottom_ids = array(
            '56214', '56210' ,'56208', '56203', '56209'
        );
        
        $all_thumbs = array(
             '56029' =>'gouwuka/ka1.gif', '56163'=>'gouwuka/ka2.gif', '56161'=>'gouwuka/ka3.gif', '56165'=>'gouwuka/ka4.gif', '56153'=>'gouwuka/ka5.jpg',
             '56158'=>'gouwuka/ka1.gif' ,'56164'=>'gouwuka/ka2.gif', '56031'=>'gouwuka/ka3.gif', '56030'=>'gouwuka/ka4.gif' ,'56155'=>'gouwuka/ka5.jpg',
             '56157'=>'gouwuka/ka1.gif' ,'56217'=>'gouwuka/ka2.gif', '56216'=>'gouwuka/ka3.gif', '56160'=>'gouwuka/ka4.gif', '56156'=>'gouwuka/ka5.jpg',

             '56200' =>'gouwuka/365_1.gif' ,'56207' =>'gouwuka/365_2.gif', '56206' =>'gouwuka/365_3.gif', '56201' =>'gouwuka/365_4.gif', '56215' =>'gouwuka/365_5.gif',
             '56214' =>'gouwuka/xian1.gif', '56210' =>'gouwuka/xian2.gif' ,'56208' =>'gouwuka/xian3.gif', '56203' =>'gouwuka/xian4.gif', '56209' =>'gouwuka/xian5.jpg'
        );
        
        
        
        
        $all_ids = array_merge($top_ids[0],$top_ids[1],$top_ids[2],$center_ids,$bottom_ids);
        
        //字典
        $all_goods = get_goods_info_by_array($all_ids,$all_thumbs);
        
        
        //添加Top 商品
        $top_goods = array();
        foreach($top_ids as $top_row_ids)
        {
              $arr = array();
              foreach($top_row_ids as $top_col_id)
              {
                  $arr[] = $all_goods[$top_col_id];
                  
              }
              $top_goods[] = $arr;
        }
       //添加Center 商品
        $center_goods = array();
        foreach($center_ids as $center_id)
        {
            $center_goods[] = $all_goods[$center_id];

        }
        //添加Bottom 商品
        $bottom_goods = array();
        foreach($bottom_ids as $bottom_id)
        {
            $bottom_goods[] = $all_goods[$bottom_id];

        }
        
        $smarty->assign('top_goods',         $top_goods); 
        $smarty->assign('center_goods',         $center_goods); 
        $smarty->assign('bottom_goods',         $bottom_goods); 
        
        
    }
    else if($topic_id == 6) //抽奖
    {
        $top_ids = array(
            '1600', '56058' ,'56228', '56225',
            '1576', '56226' ,'1622' , '1080'
        );

        $bottom_ids = array(
            '56062', '56064', '1672', '1678', '56140',
            '56145', '1696', '1707' ,'56057', '56036'
        );
        $all_ids = array_merge($top_ids,$bottom_ids);
        $all_thumbs = array();
        
        $index = 1;
        foreach( $all_ids as $id)
        {
            $all_thumbs[$id] = 'lottery/s'.$index.'.png';
            $index += 1;
        }
        
        
       
        
        //字典
        $all_goods = get_goods_info_by_array($all_ids,$all_thumbs);
        
        
        //添加Top 商品
        $top_goods = array();
        foreach($top_ids as $top_id)
        {
             $top_goods[] = $all_goods[$top_id];
        }
           //添加Bottom 商品
        $bottom_goods = array();
        foreach($bottom_ids as $bottom_id)
        {
            $bottom_goods[] = $all_goods[$bottom_id];

        }
        
        $smarty->assign('top_goods',         $top_goods); 
        $smarty->assign('bottom_goods',         $bottom_goods); 
        
        
    }

    $template_file = empty($topic['template']) ? 'topic.dwt' : $topic['template'];
}
/* 显示模板 */
$smarty->display($templates, $cache_id);











function get_goods_info_by_array($goods_id,$all_thumbs)
{
     $sql = 'SELECT g.goods_id, g.goods_name, g.goods_name_style, g.market_price, g.is_new, g.is_best, g.is_hot, g.shop_price AS org_price, ' .
                "IFNULL(mp.user_price, g.shop_price * '".GLogin::discount()."') AS shop_price, g.promote_price, " .
                'g.promote_start_date, g.promote_end_date, g.goods_brief, g.goods_thumb , g.goods_img ' .
                'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' .
                'LEFT JOIN ' . $GLOBALS['ecs']->table('member_price') . ' AS mp ' .
                "ON mp.goods_id = g.goods_id AND mp.user_rank = '".GLogin::rank()."' " .
                "WHERE " . db_create_in($goods_id, 'g.goods_id');

    $res = $GLOBALS['db']->query($sql);

    $arr = array();

    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        if ($row['promote_price'] > 0)
        {
            $promote_price = bargain_price($row['promote_price'], $row['promote_start_date'], $row['promote_end_date']);
            $row['promote_price'] = $promote_price > 0 ? price_format($promote_price) : '';
        }
        else
        {
            $row['promote_price'] = '';
        }

        if ($row['shop_price'] > 0)
        {
            $row['shop_price'] =  price_format($row['shop_price']);
        }
        else
        {
            $row['shop_price'] = '';
        }

        $row['url']              = build_uri('goods', array('gid'=>$row['goods_id']), $row['goods_name']);
        $row['goods_style_name'] = add_style($row['goods_name'], $row['goods_name_style']);
        $row['short_name']       = $GLOBALS['_CFG']['goods_name_length'] > 0 ?
                                    sub_str($row['goods_name'], $GLOBALS['_CFG']['goods_name_length']) : $row['goods_name'];
        if(isset($all_thumbs))
            $row['goods_thumb']      =  NGINX_IMG_HOST.'themes/365chi/topic/images/'.$all_thumbs[strval( $row['goods_id'])] ;
        //get_image_path($row['goods_id'], $row['goods_thumb'], true);
        $row['short_style_name'] = add_style($row['short_name'], $row['goods_name_style']);

        $arr[  $row['goods_id']  ] = $row;
    }
    return $arr;
}




?>