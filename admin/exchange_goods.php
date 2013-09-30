<?php

/**
 * ECSHOP 管理中心积分兑换商品程序文件
 * ============================================================================
 * 版权所有 2005-2011 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author $
 * $Id $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . '/' . ADMIN_PATH . '/includes/lib_goods.php');
/*初始化数据交换对象 */
$exc   = new exchange($ecs->table("exchange_goods"), $db, 'id', 'exchange_integral');
//$image = new cls_image();

/*------------------------------------------------------ */
//-- 商品列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    /* 权限判断 */
    admin_priv('exchange_goods');

    /* 取得过滤条件 */
    $filter = array();
    $smarty->assign('ur_here',      $_LANG['15_exchange_goods_list']);
    $smarty->assign('action_link',  array('text' => $_LANG['exchange_goods_add'], 'href' => 'exchange_goods.php?act=add'));
    $smarty->assign('full_page',    1);
    $smarty->assign('filter',       $filter);

    $goods_list = get_exchange_goodslist();

    $smarty->assign('goods_list',    $goods_list['arr']);
    $smarty->assign('filter',        $goods_list['filter']);
    $smarty->assign('record_count',  $goods_list['record_count']);
    $smarty->assign('page_count',    $goods_list['page_count']);

    $sort_flag  = sort_flag($goods_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
    $smarty->display('exchange_goods_list.htm');
}

/*------------------------------------------------------ */
//-- 翻页，排序
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    check_authz_json('exchange_goods');

    $goods_list = get_exchange_goodslist();

    $smarty->assign('goods_list',    $goods_list['arr']);
    $smarty->assign('filter',        $goods_list['filter']);
    $smarty->assign('record_count',  $goods_list['record_count']);
    $smarty->assign('page_count',    $goods_list['page_count']);

    $sort_flag  = sort_flag($goods_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('exchange_goods_list.htm'), '',
        array('filter' => $goods_list['filter'], 'page_count' => $goods_list['page_count']));
}

/*------------------------------------------------------ */
//-- 添加商品
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'add')
{
    /* 权限判断 */
    admin_priv('exchange_goods');

    /*初始化*/
    $goods = array();
    $goods['is_exchange'] = 1;
    $goods['is_hot']      = 0;
    $goods['option']      = '<option value="0">'.$_LANG['make_option'].'</option>';

    $smarty->assign('goods',       $goods);
    $smarty->assign('ur_here',     $_LANG['exchange_goods_add']);
    $smarty->assign('action_link', array('text' => $_LANG['15_exchange_goods_list'], 'href' => 'exchange_goods.php?act=list'));
    $smarty->assign('form_action', 'insert');

    assign_query_info();
    
    include_once(ROOT_PATH . 'includes/fckeditor/fckeditor.php'); // 包含 html editor 类文件
    create_html_editor('content', '','content');
    
    $smarty->display('exchange_goods_info.htm');
}

/*------------------------------------------------------ */
//-- 添加商品
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'insert')
{
    /* 权限判断 */
    admin_priv('exchange_goods');

    /*检查是否重复*/
    $is_only = $exc->is_only('id', $_POST['goods_id'],0, " id ='$_POST[goods_id]'");

    if (!$is_only)
    {
        sys_msg($_LANG['goods_exist'], 1);
    }

    /*插入数据*/
    $add_time = gmtime();
    if (empty($_POST['goods_id']))
    {
        $_POST['goods_id'] = 0;
    }
    
    
    //获取表单数据
    $items = array('id','exchange_integral','is_exchange','is_hot','type','title','content','is_shipping_free');
    $arr = get_form_data($items);
    //修正部分数据
    $arr['id'] = $_POST['goods_id'] ;
    unset($arr['goods_id']);
    $arr['content'] = ($arr['content'] );
    $arr['title'] = ($arr['title'] );
    $arr['exchange_integral'] = intval($arr['exchange_integral'] );
    
    //获取图片并储存
    $res = handle_upload_img();
    if(!empty($res))
    {
        $arr['img'] = $res['img'];
        $arr['thumb_img'] = $res['thumb_img'];
    }


    //插入
    $db->autoExecute($ecs->table('exchange_goods'),$arr);
    
    


    $link[0]['text'] = $_LANG['continue_add'];
    $link[0]['href'] = 'exchange_goods.php?act=add';

    $link[1]['text'] = $_LANG['back_list'];
    $link[1]['href'] = 'exchange_goods.php?act=list';

    admin_log($_POST['goods_id'],'add','exchange_goods');

    clear_cache_files(); // 清除相关的缓存文件

    sys_msg($_LANG['articleadd_succeed'],0, $link);
}

/*------------------------------------------------------ */
//-- 编辑
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'edit')
{
    /* 权限判断 */
    admin_priv('exchange_goods');

    $id = intval( $_REQUEST[id] );
    /* 取商品数据 */
    $sql = 'select * from '. $ecs->table('exchange_goods')." where id='$id'";
    $goods = $db->GetRow($sql);
    //商品
    if($goods['type'] == 0)
    {
          $name =  $db->getOne(  'select goods_name from '.$ecs->table('goods').' where goods_id='. $id );
    }
    else{
        $name =  $db->getOne(  'select type_name from '.$ecs->table('bonus_type').' where type_id='. $id );
        
    }
    
    $goods['option']  = '<option value="'.$goods['id'].'">'.$name.'</option>';

    $smarty->assign('goods',       $goods);
    $smarty->assign('ur_here',     $_LANG['exchange_goods_add']);
    $smarty->assign('action_link', array('text' => $_LANG['15_exchange_goods_list'], 'href' => 'exchange_goods.php?act=list&' . list_link_postfix()));
    $smarty->assign('form_action', 'update');

    assign_query_info();
    
    
    include_once(ROOT_PATH . 'includes/fckeditor/fckeditor.php'); // 包含 html editor 类文件
    create_html_editor('content', $goods['content'],'content');
    
    $smarty->display('exchange_goods_info.htm');
}

/*------------------------------------------------------ */
//-- 编辑
/*------------------------------------------------------ */
if ($_REQUEST['act'] =='update')
{
    /* 权限判断 */
    admin_priv('exchange_goods');

    if (empty($_POST['goods_id']))
    {
        $_POST['goods_id'] = 0;
    }
  
     //获取表单数据
    $items = array('id','exchange_integral','is_exchange','is_hot','title','content','is_shipping_free');
    $arr = get_form_data($items);
    //修正部分数据
    $arr['id'] = $_POST['goods_id'] ;
    unset($arr['goods_id']);
    $arr['content'] = ($arr['content'] );
    $arr['title'] = ($arr['title'] );
    $arr['exchange_integral'] = intval($arr['exchange_integral'] );
    
    //获取图片并储存
    $res = handle_upload_img();
    if(!empty($res))
    {
        $arr['img'] = $res['img'];
        $arr['thumb_img'] = $res['thumb_img'];
    }
    
    
    //插入
    if ( $db->autoExecute($ecs->table('exchange_goods'),$arr,'UPDATE','id = '.$arr['id']) )
    {
        $link[0]['text'] = $_LANG['back_list'];
        $link[0]['href'] = 'exchange_goods.php?act=list&' . list_link_postfix();

        admin_log($_POST['goods_id'], 'edit', 'exchange_goods');

        clear_cache_files();
        sys_msg($_LANG['articleedit_succeed'], 0, $link);
    }
    else
    {
        die($db->error());
    }
}

/*------------------------------------------------------ */
//-- 编辑使用积分值
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit_exchange_integral')
{
    check_authz_json('exchange_goods');

    $id                = intval($_POST['id']);
    $exchange_integral = floatval($_POST['val']);

    /* 检查文章标题是否重复 */
    if ($exchange_integral < 0 || $exchange_integral == 0 && $_POST['val'] != "$goods_price")
    {
        make_json_error($_LANG['exchange_integral_invalid']);
    }
    else
    {
        if ($exc->edit("exchange_integral = '$exchange_integral'", $id))
        {
            clear_cache_files();
            admin_log($id, 'edit', 'exchange_goods');
            make_json_result(stripslashes($exchange_integral));
        }
        else
        {
            make_json_error($db->error());
        }
    }
}

/*------------------------------------------------------ */
//-- 切换是否兑换
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'toggle_exchange')
{
    check_authz_json('exchange_goods');

    $id     = intval($_POST['id']);
    $val    = intval($_POST['val']);

    $exc->edit("is_exchange = '$val'", $id);
    clear_cache_files();

    make_json_result($val);
}

/*------------------------------------------------------ */
//-- 切换是否兑换
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'toggle_hot')
{
    check_authz_json('exchange_goods');

    $id     = intval($_POST['id']);
    $val    = intval($_POST['val']);

    $exc->edit("is_hot = '$val'", $id);
    clear_cache_files();

    make_json_result($val);
}

/*------------------------------------------------------ */
//-- 批量删除商品
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'batch_remove')
{
    admin_priv('exchange_goods');

    if (!isset($_POST['checkboxes']) || !is_array($_POST['checkboxes']))
    {
        sys_msg($_LANG['no_select_goods'], 1);
    }

    $count = 0;
    foreach ($_POST['checkboxes'] AS $key => $id)
    {
        if ($exc->drop($id))
        {
            admin_log($id,'remove','exchange_goods');
            $count++;
        }
    }

    $lnk[] = array('text' => $_LANG['back_list'], 'href' => 'exchange_goods.php?act=list');
    sys_msg(sprintf($_LANG['batch_remove_succeed'], $count), 0, $lnk);
}

/*------------------------------------------------------ */
//-- 删除商品
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    check_authz_json('exchange_goods');

    $id = intval($_GET['id']);
    if ($exc->drop($id))
    {
        admin_log($id,'remove','article');
        clear_cache_files();
    }

    $url = 'exchange_goods.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}

/*------------------------------------------------------ */
//-- 搜索商品
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'search_goods')
{
    include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON;

    $filters = $json->decode($_GET['JSON']);

    $arr = get_goods_list($filters);

    make_json_result($arr);
}
/*------------------------------------------------------ */
//-- 搜索优惠劵
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'search_bonus')
{
    include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON;

    $filters = $json->decode($_GET['JSON']);
    $name = $filters->keyword;

    $arr = get_bonus_list($name);

    make_json_result($arr);
}

/* 获得商品列表 */
function get_exchange_goodslist()
{
    $result = get_filter();
    if ($result === false)
    {
        $filter = array();
        $filter['keyword']    = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['keyword'] = json_str_iconv($filter['keyword']);
        }
        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'eg.id' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);

        $where = '';
        if (!empty($filter['keyword']))
        {
            $where = " AND title LIKE '%" . mysql_like_quote($filter['keyword']) . "%'";
        }

        /* 文章总数 */
        $sql = 'SELECT COUNT(*) FROM ' .$GLOBALS['ecs']->table('exchange_goods'). ' AS eg '.
               'LEFT JOIN ' .$GLOBALS['ecs']->table('goods'). ' AS g ON g.goods_id = eg.id '.
               'WHERE 1 ' .$where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        $filter = page_and_size($filter);

        /* 获取文章数据 */
        $sql = 'SELECT eg.* , g.goods_name '.
               'FROM ' .$GLOBALS['ecs']->table('exchange_goods'). ' AS eg '.
               'LEFT JOIN ' .$GLOBALS['ecs']->table('goods'). ' AS g ON g.goods_id = eg.id '.
               'WHERE 1 ' .$where. ' ORDER by '.$filter['sort_by'].' '.$filter['sort_order'];
        
         $sql = 'SELECT eg.* '.
               'FROM ' .$GLOBALS['ecs']->table('exchange_goods'). ' AS eg '.
               'WHERE 1 ' .$where. ' ORDER by '.$filter['sort_by'].' '.$filter['sort_order'];

        $filter['keyword'] = stripslashes($filter['keyword']);
        set_filter($filter, $sql);
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
    }
    $arr = array();
    $res = $GLOBALS['db']->selectLimit($sql, $filter['page_size'], $filter['start']);

    while ($rows = $GLOBALS['db']->fetchRow($res))
    {
        $arr[] = $rows;
    }
    return array('arr' => $arr, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}


//获取可以用作积分商城的优惠劵，  类型为指定用户发放的都可以用在积分商城里
function get_bonus_list($name = "")
{
    $where = "where send_type = 0 ";//指定用户发放的购物卷类型
    if(!empty($name))
    {
        $name = addslashes($name);
        $where = " and type_name like  '%$name%'";
    }
    
    $sql  = "select type_id as goods_id,type_name as goods_name from ". $GLOBALS['ecs']->table('bonus_type').$where;
    $arr = array();
    
    $res = $GLOBALS['db']->query($sql);
    while ($rows = $GLOBALS['db']->fetchRow($res))
    {
        $arr[] = $rows;
    }
    return $arr;
}


function handle_upload_img()
{
      //获取图片并储存
    global $_CFG;
    $arr = array();
    include_once(ROOT_PATH . '/includes/cls_image.php');
    $image = new cls_image($_CFG['bgcolor']);
    if( $_FILES['img']['tmp_name'] != '' && $_FILES['img']['tmp_name'] != 'none' )
    {
        $original_img   = $image->upload_image($_FILES['img']);
     
     
 
     // 如果设置大小不为0，缩放图片
        if ($_CFG['thumb_width'] != 0 || $_CFG['thumb_width'] != 0)
        {
            $thumb_img = $image->make_thumb_keep_ratio('../'. $original_img , $GLOBALS['_CFG']['thumb_width'],  $GLOBALS['_CFG']['thumb_width']);
            if ($thumb_img === false)
            {
                sys_msg($image->error_msg(), 1, array(), false);
            }   
        }
        if ($_CFG['image_width'] != 0 || $_CFG['image_width'] != 0)
        {
            $img = $image->make_thumb_keep_ratio('../'. $original_img , $GLOBALS['_CFG']['image_width'],  $GLOBALS['_CFG']['image_width']);
            if ($img === false)
            {
                sys_msg($image->error_msg(), 1, array(), false);
            }   
        }

  
        //将图片从temp目录中移出
        $img = reformat_image_name('goods',  $_POST['goods_id'], $img, 'goods');
        $thumb_img = reformat_image_name('goods_thumb',  $_POST['goods_id'], $thumb_img, 'thumb');
        //重命名thumb_img 保证与img的一致性
        $new_thumb_name =  str_replace('goods_img','thumb_img',$img);
        

        if (!copy('../' . $thumb_img, '../' . $new_thumb_name))
        {
                sys_msg('fail to copy file: ' . realpath('../' . $thumb_img), 1, array(), false);
        }
        
        $arr['img'] = $img;
        $arr['thumb_img'] = $new_thumb_name;
    }
    return $arr;
}
?>