<?php
/**
 * ECSHOP 商品w批量上传、修改
 * ============================================================================
 * 版权所有 2005-2011 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: goods_batch.php 17217 2011-01-19 06:29:08Z liubo $
 */

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require('includes/lib_goods.php');


define('Batch_Upload_Path',"images/PIC/");

/*------------------------------------------------------ */
//-- 批量上传
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'add')
{
    /* 检查权限 */
    admin_priv('goods_batch');

    /* 取得分类列表 */
    $smarty->assign('cat_list', cat_list());

    /* 取得可选语言 */
    $dir = opendir('../languages');
    $lang_list = array(
        'UTF8'      => $_LANG['charset']['utf8'],
        'GB2312'    => $_LANG['charset']['zh_cn'],
        'BIG5'      => $_LANG['charset']['zh_tw'],
    );
    $download_list = array();
    while (@$file = readdir($dir))
    {
        if ($file != '.' && $file != '..' && $file != ".svn" && $file != "_svn" && is_dir('../languages/' .$file) == true)
        {
            $download_list[$file] = sprintf($_LANG['download_file'], isset($_LANG['charset'][$file]) ? $_LANG['charset'][$file] : $file);
        }
    }
    @closedir($dir);
    $data_format_array = array(
                                'ecshop'    => $_LANG['export_ecshop'],
                                'taobao'    => $_LANG['export_taobao'],
                                'paipai'    => $_LANG['export_paipai'],
                                'paipai3'   => $_LANG['export_paipai3'],
                                'taobao46'  => $_LANG['export_taobao46'],
                                 '365'  => '365商城数据',
                               );
    $smarty->assign('data_format', $data_format_array);
    $smarty->assign('lang_list',     $lang_list);
    $smarty->assign('download_list', $download_list);

    /* 参数赋值 */
    $ur_here = $_LANG['13_batch_add'];
    $smarty->assign('ur_here', $ur_here);

    /* 显示模板 */
    assign_query_info();
    $smarty->display('goods_batch_add.htm');
}

/*------------------------------------------------------ */
//-- 批量上传：处理
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'upload')
{
    /* 检查权限 */
    admin_priv('goods_batch');

    /* 将文件按行读入数组，逐行进行解析 */
    $line_number = 0;
    $arr = array();
    $goods_list = array();
    $field_list = array_keys($_LANG['upload_goods']); // 字段列表
    $data = file($_FILES['file']['tmp_name']);
    if($_POST['data_cat'] == 'ecshop')
    {
        foreach ($data AS $line)
        {
            // 跳过第一行
            if ($line_number == 0)
            {
                $line_number++;
                continue;
            }

            // 转换编码
            if (($_POST['charset'] != 'UTF8') && (strpos(strtolower(EC_CHARSET), 'utf') === 0))
            {
                $line = ecs_iconv($_POST['charset'], 'UTF8', $line);
            }

            // 初始化
            $arr    = array();
            $buff   = '';
            $quote  = 0;
            $len    = strlen($line);
            for ($i = 0; $i < $len; $i++)
            {
                $char = $line[$i];

                if ('\\' == $char)
                {
                    $i++;
                    $char = $line[$i];

                    switch ($char)
                    {
                        case '"':
                            $buff .= '"';
                            break;
                        case '\'':
                            $buff .= '\'';
                            break;
                        case ',';
                            $buff .= ',';
                            break;
                        default:
                            $buff .= '\\' . $char;
                            break;
                    }
                }
                elseif ('"' == $char)
                {
                    if (0 == $quote)
                    {
                        $quote++;
                    }
                    else
                    {
                        $quote = 0;
                    }
                }
                elseif (',' == $char)
                {
                    if (0 == $quote)
                    {
                        if (!isset($field_list[count($arr)]))
                        {
                            continue;
                        }
                        $field_name = $field_list[count($arr)];
                        $arr[$field_name] = trim($buff);
                        $buff = '';
                        $quote = 0;
                    }
                    else
                    {
                        $buff .= $char;
                    }
                }
                else
                {
                    $buff .= $char;
                }

                if ($i == $len - 1)
                {
                    if (!isset($field_list[count($arr)]))
                    {
                        continue;
                    }
                    $field_name = $field_list[count($arr)];
                    $arr[$field_name] = trim($buff);
                }
            }
            $goods_list[] = $arr;
        }
    }
    elseif($_POST['data_cat'] == 'taobao')
    {
        $id_is = 0;
        foreach ($data AS $line)
        {
            // 跳过第一行
            if ($line_number == 0)
            {
                $line_number++;
                continue;
            }

            // 初始化
            $arr    = array();
            $line_list = explode("\t",$line);
            $arr['goods_name'] = trim($line_list[0],'"');

            $max_id     = $db->getOne("SELECT MAX(goods_id) + $id_is FROM ".$ecs->table('goods'));
            $id_is++;
            $goods_sn   = generate_goods_sn($max_id);
            $arr['goods_sn'] = $goods_sn;
            $arr['brand_name'] = '';
            $arr['market_price'] = $line_list[7];
            $arr['shop_price'] = $line_list[7];
            $arr['integral'] = 0;
            $arr['original_img'] = $line_list[25];
            $arr['keywords'] = '';
            $arr['goods_brief'] = '';
            $arr['goods_desc'] = strip_tags($line_list[24]);
            $arr['goods_desc'] = substr($arr['goods_desc'], 1, -1);
            $arr['goods_number'] = $line_list[10];
            $arr['warn_number'] =1;
            $arr['is_best'] = 0;
            $arr['is_new'] = 0;
            $arr['is_hot'] = 0;
            $arr['is_on_sale'] = 1;
            $arr['is_alone_sale'] = 0;
            $arr['is_real'] = 1;

            $goods_list[] = $arr;
        }
    }
    elseif($_POST['data_cat'] == 'paipai')
    {
        $id_is = 0;
        foreach ($data AS $line)
        {
            // 跳过第一行
            if ($line_number == 0)
            {
                $line_number++;
                continue;
            }

            // 初始化
            $arr    = array();
            $line_list = explode(",",$line);
            $arr['goods_name'] = trim($line_list[3],'"');

            $max_id     = $db->getOne("SELECT MAX(goods_id) + $id_is FROM ".$ecs->table('goods'));
            $id_is++;
            $goods_sn   = generate_goods_sn($max_id);
            $arr['goods_sn'] = $goods_sn;
            $arr['brand_name'] = '';
            $arr['market_price'] = $line_list[13];
            $arr['shop_price'] = $line_list[13];
            $arr['integral'] = 0;
            $arr['original_img'] = $line_list[28];
            $arr['keywords'] = '';
            $arr['goods_brief'] = '';
            $arr['goods_desc'] = strip_tags($line_list[30]);
            $arr['goods_number'] = 100;
            $arr['warn_number'] =1;
            $arr['is_best'] = 0;
            $arr['is_new'] = 0;
            $arr['is_hot'] = 0;
            $arr['is_on_sale'] = 1;
            $arr['is_alone_sale'] = 0;
            $arr['is_real'] = 1;

            $goods_list[] = $arr;
        }
    }
    elseif($_POST['data_cat'] == 'paipai3')
    {
        $id_is = 0;
        foreach ($data AS $line)
        {
            // 跳过第一行
            if ($line_number == 0)
            {
                $line_number++;
                continue;
            }

            // 初始化
            $arr    = array();
            $line_list = explode(",",$line);
            $arr['goods_name'] = trim($line_list[1],'"');

            $max_id     = $db->getOne("SELECT MAX(goods_id) + $id_is FROM ".$ecs->table('goods'));
            $id_is++;
            $goods_sn   = generate_goods_sn($max_id);
            $arr['goods_sn'] = $goods_sn;
            $arr['brand_name'] = '';
            $arr['market_price'] = $line_list[9];
            $arr['shop_price'] = $line_list[9];
            $arr['integral'] = 0;
            $arr['original_img'] = $line_list[23];
            $arr['keywords'] = '';
            $arr['goods_brief'] = '';
            $arr['goods_desc'] = strip_tags($line_list[24]);
            $arr['goods_number'] = $line_list[5];
            $arr['warn_number'] =1;
            $arr['is_best'] = 0;
            $arr['is_new'] = 0;
            $arr['is_hot'] = 0;
            $arr['is_on_sale'] = 1;
            $arr['is_alone_sale'] = 0;
            $arr['is_real'] = 1;

            $goods_list[] = $arr;
        }
    }
    elseif($_POST['data_cat'] == 'taobao46')
    {
        $id_is = 0;
        foreach ($data AS $line)
        {
            // 跳过第一行
            if ($line_number == 0)
            {
                $line_number++;
                continue;
            }
            if (($_POST['charset'] == 'UTF8') && (strpos(strtolower(EC_CHARSET), 'utf') == 0))
            {
                $line = ecs_iconv($_POST['charset'], 'GBK', $line);
            }
            // 初始化
            $arr    = array();
            $line_list = explode("\t",$line);
            $arr['goods_name'] = trim($line_list[0],'"');

            $max_id     = $db->getOne("SELECT MAX(goods_id) + $id_is FROM ".$ecs->table('goods'));
            $id_is++;
            $goods_sn   = generate_goods_sn($max_id);
            $arr['goods_sn'] = $goods_sn;
            $arr['brand_name'] = '';
            $arr['market_price'] = $line_list[7];
            $arr['shop_price'] = $line_list[7];
            $arr['integral'] = 0;
            $arr['original_img'] = str_replace('"','',$line_list[35]);
            $arr['keywords'] = '';
            $arr['goods_brief'] = '';
            $arr['goods_desc'] = strip_tags($line_list[24]);
            $arr['goods_desc'] = substr($arr['goods_desc'], 1, -1);
            $arr['goods_number'] = $line_list[10];
            $arr['warn_number'] =1;
            $arr['is_best'] = 0;
            $arr['is_new'] = 0;
            $arr['is_hot'] = 0;
            $arr['is_on_sale'] = 1;
            $arr['is_alone_sale'] = 0;
            $arr['is_real'] = 1;

            $goods_list[] = $arr;
        }
    }
    elseif($_POST['data_cat'] == '365')
    {
        $id_is = 0;
        $filename = $_FILES['file']['tmp_name'];
        $file = fopen($filename,'r');
        
        $_SESSION['goods_desc_data'] = array();
        while ($line = fgetcsv($file))
      //  foreach ($data AS $line)
        {
            // 跳过第一行
            if ($line_number < 1)
            {
                $line_number++;
                continue;
            }
            else{
                $line_number++;
            }
//            if (($_POST['charset'] == 'UTF8') && (strpos(strtolower(EC_CHARSET), 'utf') == 0))
//            {
//                $line = ecs_iconv($_POST['charset'], 'GBK', $line);
//            }
            
          //  $charset = ($_POST['charset']
            $line_list = array();
            if (($_POST['charset'] == 'GB2312') && (strpos(strtolower(EC_CHARSET), 'utf') == 0))
            {
                
                foreach($line as $key =>$value)
                {
                    $line_list[$key] = ecs_iconv($_POST['charset'], 'UTF8', $value);
                    
                }
                
            }
            else{
                $line_list = $line;
            }
            // 初始化
            $arr    = array();
           // $line_list = explode(",",$line);
            
            
          //  $line_list = str_getcsv($line);
            
           // print_r($line_list);
            $arr['goods_name'] = trim($line_list[0],'"');

            $max_id     = $db->getOne("SELECT MAX(goods_id) + $id_is FROM ".$ecs->table('goods'));
            $id_is++;
            $goods_sn   = generate_goods_sn($max_id);
            $arr['goods_sn'] = $goods_sn;
            $arr['brand_name'] = $line_list[9];
            $arr['market_price'] = $line_list[3] * 1.2;
            $arr['shop_price'] = $line_list[3];
            $arr['integral'] = 0;
      //      $arr['original_img'] = str_replace('"','',$line_list[35]);
            $arr['keywords'] = '';
            $arr['goods_brief'] = '';
    //        $arr['goods_desc'] = strip_tags($line_list[24]);
       //     $arr['goods_desc'] = substr($arr['goods_desc'], 1, -1);
            $arr['goods_number'] = 1000;
            $arr['warn_number'] =1;
            $arr['is_best'] = 0;
            $arr['is_new'] = 0;
            $arr['is_hot'] = 0;
            $arr['is_on_sale'] = 0;
            $arr['is_alone_sale'] = 1;
            $arr['is_real'] = 1;
            $arr['goods_index'] = $line_number;
            
            $arr['goods_weight'] = get_format_weight($line_list[2]);
            
            //所有图片
            $arr['all_img'] = trim($line_list[15]);


            $goods_desc = create_goods_desc($line_list);
           // print_r($goods_desc);exit();
            
            $_SESSION['goods_desc_data'][$line_number] = $goods_desc;
            
            
            
            
            $f_type = $line_list[4];
            $c_type = $line_list[5];
            //分类
             $arr['cat_id'] = 39;
           // $arr['cat_id'] = get_type_id($f_type,$c_type);
            //属性
            $arr['attr_cat_id'] = 1;
            $arr['attr']['danwei'] = array( 'id' => 1 ,'value' => $line_list[1]);
            $arr['attr']['guige'] = array( 'id' =>2 ,'value' => $line_list[2]);
            $arr['attr']['baozhiqi'] = array( 'id' => 3 ,'value' => $line_list[7]);;
            $arr['attr']['chandi'] = array( 'id' => 4 ,'value' => $line_list[6]);
            
            if(!empty($arr['all_img'] ))
            {
                 $arr['is_on_sale'] = 1;
            }
            $goods_list[] = $arr;
        }
    }
    
    
    
    
    $smarty->assign('goods_class', $_LANG['g_class']);
    $smarty->assign('goods_list', $goods_list);

    // 字段名称列表
    $smarty->assign('title_list', $_LANG['upload_goods']);

    
    $field_show = array('goods_name' => true, 'goods_sn' => true, 'brand_name' => true, 'market_price' => true, 'shop_price' => true);
    if($_POST['data_cat'] == '365')
    {
        $field_show   = $field_show + array(  'danwei' => true, 'chandi' => true, 'baozhiqi' => true, 'guige' => true );
        
    }
        
    // 显示的字段列表
    $smarty->assign('field_show', $field_show);

    /* 参数赋值 */
    $smarty->assign('ur_here', $_LANG['goods_upload_confirm']);

    /* 显示模板 */
    assign_query_info();
    $smarty->display('goods_batch_confirm.htm');
}

/*------------------------------------------------------ */
//-- 批量上传：入库
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'insert')
{
    /* 检查权限 */
    admin_priv('goods_batch');

    if (isset($_POST['checked']))
    {
        include_once(ROOT_PATH . 'includes/cls_image.php');
        $image = new cls_image($_CFG['bgcolor']);

        /* 字段默认值 */
        $default_value = array(
            'brand_id'      => 0,
            'goods_number'  => 0,
            'goods_weight'  => 0,
            'market_price'  => 0,
            'shop_price'    => 0,
            'warn_number'   => 0,
            'is_real'       => 1,
            'is_on_sale'    => 1,
            'is_alone_sale' => 1,
            'integral'      => 0,
            'is_best'       => 0,
            'is_new'        => 0,
            'is_hot'        => 0,
            'goods_type'    => 0,
        );

        /* 查询品牌列表 */
        $brand_list = array();
        $sql = "SELECT brand_id, brand_name FROM " . $ecs->table('brand');
        $res = $db->query($sql);
        while ($row = $db->fetchRow($res))
        {
            $brand_list[$row['brand_name']] = $row['brand_id'];
        }

        /* 字段列表 */
        $field_list = array_keys($_LANG['upload_goods']);
        $field_list[] = 'goods_class'; //实体或虚拟商品

        /* 获取商品good id */
        $max_id = $db->getOne("SELECT MAX(goods_id) + 1 FROM ".$ecs->table('goods'));
        $max_attr_id = $db->getOne("SELECT MAX(goods_attr_id) + 1 FROM ".$ecs->table('goods_attr'));

        /* 循环插入商品数据 */
        foreach ($_POST['checked'] AS $key => $value)
        {
            // 合并
            $field_arr = array(
                'cat_id'        => $_POST['cat'],
                'add_time'      => gmtime(),
                'last_update'   => gmtime(),
            );

            foreach ($field_list AS $field)
            {
                // 转换编码
                $field_value = isset($_POST[$field][$value]) ? $_POST[$field][$value] : '';

                /* 虚拟商品处理 */
                if ($field == 'goods_class')
                {
                    $field_value = intval($field_value);
                    if ($field_value == G_CARD)
                    {
                        $field_arr['extension_code'] = 'virtual_card';
                    }
                    continue;
                }

                // 如果字段值为空，且有默认值，取默认值
                $field_arr[$field] = !isset($field_value) && isset($default_value[$field]) ? $default_value[$field] : $field_value;

                // 特殊处理
                if (!empty($field_value))
                {
                    // 图片路径
                    if (in_array($field, array('original_img', 'goods_img', 'goods_thumb')))
                    {
                        if(strpos($field_value,'|;')>0)
                        {
                            $field_value=explode(':',$field_value);
                            $field_value=$field_value['0'];
                            @copy(ROOT_PATH.'images/'.$field_value.'.tbi',ROOT_PATH.'images/'.$field_value.'.jpg');
                            if(is_file(ROOT_PATH.'images/'.$field_value.'.jpg'))
                            {
                                $field_arr[$field] =IMAGE_DIR . '/' . $field_value.'.jpg';
                            }
                        }
                        else
                        {
                            $field_arr[$field] = IMAGE_DIR . '/' . $field_value;
                        }
                      }
                    // 品牌
                    elseif ($field == 'brand_name')
                    {
                        if (isset($brand_list[$field_value]))
                        {
                            $field_arr['brand_id'] = $brand_list[$field_value];
                        }
                        else
                        {
                            $sql = "INSERT INTO " . $ecs->table('brand') . " (brand_name) VALUES ('" . addslashes($field_value) . "')";
                            $db->query($sql);
                            $brand_id = $db->insert_id();
                            $brand_list[$field_value] = $brand_id;
                            $field_arr['brand_id'] = $brand_id;
                        }
                    }
                    // 整数型
                    elseif (in_array($field, array('goods_number', 'warn_number', 'integral')))
                    {
                        $field_arr[$field] = intval($field_value);
                    }
                    // 数值型
                    elseif (in_array($field, array('goods_weight', 'market_price', 'shop_price')))
                    {
                        $field_arr[$field] = floatval($field_value);
                    }
                    // bool型
                    elseif (in_array($field, array('is_best', 'is_new', 'is_hot', 'is_on_sale', 'is_alone_sale', 'is_real')))
                    {
                        $field_arr[$field] = intval($field_value) > 0 ? 1 : 0;
                    }
                }

                if ($field == 'is_real')
                {
                    $field_arr[$field] = intval($_POST['goods_class'][$key]);
                }
                
                
                //处理分类
                $field_arr['cat_id'] =  $_POST['cat_id'][$value];
                //处理图片
                $field_arr['all_img'] =  $_POST['all_img'][$value];
                //处理属性
                $goods_attr_array  = array('danwei','guige','baozhiqi','chandi');
                if( in_array($field,$goods_attr_array ))
                {
                    $field_arr['goods_type'] = $_POST['attr_cat_id'][$value];
                    list($attr_id, $attr_value) = explode(':', $field_value); 
                    if($attr_value)
                    {
                        $goods_attr = array();
                        $goods_attr['goods_attr_id'] = $max_attr_id;
                        $goods_attr['goods_id'] = $max_id;
                        $goods_attr['attr_id'] = $attr_id;
                        $goods_attr['attr_value'] = $attr_value;
                        $goods_attr['attr_price'] = 0 ;
                        $db->autoExecute($ecs->table('goods_attr'), $goods_attr, 'INSERT');
                        $max_attr_id  = $db->insert_id() + 1;
                    }
                }
                
            }

           
        
            
            if (empty($field_arr['goods_sn']))
            {
                $field_arr['goods_sn'] = generate_goods_sn($max_id);
            }

            /* 如果是虚拟商品，库存为0 */
            if ($field_arr['is_real'] == 0)
            {
                $field_arr['goods_number'] = 0;
            }
            
            //读取详情信息 
            $field_arr['goods_desc'] = addslashes($_SESSION['goods_desc_data'][$_POST['goods_index'][$value]] );
          //  print_r($field_arr['goods_desc']);
          //  print_r($_POST['goods_index'][$value]);exit();
            //print_r($field_arr);exit();
            $db->autoExecute($ecs->table('goods'), $field_arr, 'INSERT');

            $max_id = $db->insert_id() + 1;

         
            
            
            
            /* 如果图片不为空,修改商品图片，插入商品相册*/
            if (!empty($field_arr['all_img']))
            {
                
                $goods_gallery['goods_id'] = $db->insert_id();
                $all_imgs = explode(';',$field_arr['all_img']);
                
             
                $goods_img = $all_imgs[0];
                $goods_img = Batch_Upload_Path.$goods_img.".jpg";
                $res = make_format_image($goods_gallery['goods_id'],$goods_img); 
                if(!$res['code'])
                {    
                    $res = $res['content'];
                    $goods_thumb =   $res['thumb'];
                    $goods_img =  $res['goods'];
                    $original_img = $res['src'];
                }
                else{
                            echo $res["msg"];
                }
            //修改商品图
                $db->query("UPDATE " . $ecs->table('goods') . " SET goods_img = '$goods_img', goods_thumb = '$goods_thumb', original_img = '$original_img' WHERE goods_id='" . $goods_gallery['goods_id'] . "'");

                //添加商品相册图
                foreach($all_imgs as $img)
                {
                         $img = str_replace("\r\n","",$img);
                         $img = str_replace("\n","",$img);
                         $img = Batch_Upload_Path.$img.".jpg";
                         $res = make_format_image($goods_gallery['goods_id'],$img,true);
                         if(!$res['code'])
                         {    
                            $res = $res['content'];
                            $goods_gallery['thumb_url'] = $res['thumb'];
                            $goods_gallery['img_url'] = $res['goods'];
                            $goods_gallery['img_original'] = $res['src'];
                            $db->autoExecute($ecs->table('goods_gallery'), $goods_gallery, 'INSERT');
                         }
                         else{
                             echo $res["msg"];
                         }
                }
              
            }
        }
    }
    // 记录日志
    admin_log('', 'batch_upload', 'goods');

    /* 显示提示信息，返回商品列表 */
    $link[] = array('href' => 'goods.php?act=list', 'text' => $_LANG['01_goods_list']);
    sys_msg($_LANG['batch_upload_ok'], 0, $link);
}

/*------------------------------------------------------ */
//-- 批量修改：选择商品
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'select')
{
    /* 检查权限 */
    admin_priv('goods_batch');

    /* 取得分类列表 */
    $smarty->assign('cat_list', cat_list());

    /* 取得品牌列表 */
    $smarty->assign('brand_list', get_brand_list());

    /* 参数赋值 */
    $ur_here = $_LANG['15_batch_edit'];
    $smarty->assign('ur_here', $ur_here);

    /* 显示模板 */
    assign_query_info();
    $smarty->display('goods_batch_select.htm');
}

/*------------------------------------------------------ */
//-- 批量修改：修改
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'edit')
{
    /* 检查权限 */
    admin_priv('goods_batch');

    /* 取得商品列表 */
    if ($_POST['select_method'] == 'cat')
    {
        $where = " WHERE goods_id " . db_create_in($_POST['goods_ids']);
    }
    else
    {
        $goods_sns = str_replace("\n", ',', str_replace("\r", '', $_POST['sn_list']));
        $sql = "SELECT DISTINCT goods_id FROM " . $ecs->table('goods') .
                " WHERE goods_sn " . db_create_in($goods_sns);
        $goods_ids = join(',', $db->getCol($sql));
        $where = " WHERE goods_id " . db_create_in($goods_ids);
    }
    $sql = "SELECT DISTINCT goods_id, goods_sn, goods_name, market_price, shop_price, goods_number, integral, give_integral, brand_id, is_real FROM " . $ecs->table('goods') . $where;
    $smarty->assign('goods_list', $db->getAll($sql));

    /* 取编辑商品的货品列表 */
    $product_exists = false;
    $sql = "SELECT * FROM " . $ecs->table('products') . $where;
    $product_list = $db->getAll($sql);

    if (!empty($product_list))
    {
        $product_exists = true;
        $_product_list = array();
        foreach ($product_list as $value)
        {
            $goods_attr = product_goods_attr_list($value['goods_id']);
            $_goods_attr_array = explode('|', $value['goods_attr']);
            if (is_array($_goods_attr_array))
            {
                $_temp = '';
                foreach ($_goods_attr_array as $_goods_attr_value)
                {
                     $_temp[] = $goods_attr[$_goods_attr_value];
                }
                $value['goods_attr'] = implode('，', $_temp);
            }

            $_product_list[$value['goods_id']][] = $value;
        }
        $smarty->assign('product_list', $_product_list);

        //释放资源
        unset($product_list, $sql, $_product_list);
    }

    $smarty->assign('product_exists', $product_exists);

    /* 取得会员价格 */
    $member_price_list = array();
    $sql = "SELECT DISTINCT goods_id, user_rank, user_price FROM " . $ecs->table('member_price') . $where;
    $res = $db->query($sql);
    while ($row = $db->fetchRow($res))
    {
        $member_price_list[$row['goods_id']][$row['user_rank']] = $row['user_price'];
    }
    $smarty->assign('member_price_list', $member_price_list);

    /* 取得会员等级 */
    $sql = "SELECT rank_id, rank_name, discount " .
            "FROM " . $ecs->table('user_rank') .
            " ORDER BY discount DESC";
    $smarty->assign('rank_list', $db->getAll($sql));

    /* 取得品牌列表 */
    $smarty->assign('brand_list', get_brand_list());

    /* 赋值编辑方式 */
    $smarty->assign('edit_method', $_POST['edit_method']);

    /* 参数赋值 */
    $ur_here = $_LANG['15_batch_edit'];
    $smarty->assign('ur_here', $ur_here);

    /* 显示模板 */
    assign_query_info();
    $smarty->display('goods_batch_edit.htm');
}

/*------------------------------------------------------ */
//-- 批量修改：提交
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'update')
{
    /* 检查权限 */
    admin_priv('goods_batch');

    if ($_POST['edit_method'] == 'each')
    {
        // 循环更新每个商品
        if (!empty($_POST['goods_id']))
        {
            foreach ($_POST['goods_id'] AS $goods_id)
            {
                //如果存在货品则处理货品
                if (!empty($_POST['product_number'][$goods_id]))
                {
                    $_POST['goods_number'][$goods_id] = 0;
                    foreach ($_POST['product_number'][$goods_id] as $key => $value)
                    {
                        $db->autoExecute($ecs->table('products'), array('product_number', $value), 'UPDATE', "goods_id = '$goods_id' AND product_id = " . $key);

                        $_POST['goods_number'][$goods_id] += $value;
                    }
                }

                // 更新商品
                $goods = array(
                    'market_price'  => floatval($_POST['market_price'][$goods_id]),
                    'shop_price'    => floatval($_POST['shop_price'][$goods_id]),
                    'integral'      => intval($_POST['integral'][$goods_id]),
                    'give_integral'      => intval($_POST['give_integral'][$goods_id]),
                    'goods_number'  => intval($_POST['goods_number'][$goods_id]),
                    'brand_id'      => intval($_POST['brand_id'][$goods_id]),
                    'last_update'   => gmtime(),
                );
                $db->autoExecute($ecs->table('goods'), $goods, 'UPDATE', "goods_id = '$goods_id'");

                // 更新会员价格
                if (!empty($_POST['rank_id']))
                {
                    foreach ($_POST['rank_id'] AS $rank_id)
                    {
                        if (trim($_POST['member_price'][$goods_id][$rank_id]) == '')
                        {
                            /* 为空时不做处理 */
                            continue;
                        }

                        $rank = array(
                            'goods_id'  => $goods_id,
                            'user_rank' => $rank_id,
                            'user_price'=> floatval($_POST['member_price'][$goods_id][$rank_id]),
                        );
                        $sql = "SELECT COUNT(*) FROM " . $ecs->table('member_price') . " WHERE goods_id = '$goods_id' AND user_rank = '$rank_id'";
                        if ($db->getOne($sql) > 0)
                        {
                            if ($rank['user_price'] < 0)
                            {
                                $db->query("DELETE FROM " . $ecs->table('member_price') . " WHERE goods_id = '$goods_id' AND user_rank = '$rank_id'");
                            }
                            else
                            {
                                $db->autoExecute($ecs->table('member_price'), $rank, 'UPDATE', "goods_id = '$goods_id' AND user_rank = '$rank_id'");
                            }

                        }
                        else
                        {
                            if ($rank['user_price'] >= 0)
                            {
                                $db->autoExecute($ecs->table('member_price'), $rank, 'INSERT');
                            }
                        }
                    }
                }
            }
        }
    }
    else
    {
        // 循环更新每个商品
        if (!empty($_POST['goods_id']))
        {
            foreach ($_POST['goods_id'] AS $goods_id)
            {
                // 更新商品
                $goods = array();
                if (trim($_POST['market_price'] != ''))
                {
                    $goods['market_price'] = floatval($_POST['market_price']);
                }
                if (trim($_POST['shop_price']) != '')
                {
                    $goods['shop_price'] = floatval($_POST['shop_price']);
                }
                if (trim($_POST['integral']) != '')
                {
                    $goods['integral'] = intval($_POST['integral']);
                }
                if (trim($_POST['give_integral']) != '')
                {
                    $goods['give_integral'] = intval($_POST['give_integral']);
                }
                if (trim($_POST['goods_number']) != '')
                {
                    $goods['goods_number'] = intval($_POST['goods_number']);
                }
                if ($_POST['brand_id'] > 0)
                {
                    $goods['brand_id'] = $_POST['brand_id'];
                }
                if (!empty($goods))
                {
                    $db->autoExecute($ecs->table('goods'), $goods, 'UPDATE', "goods_id = '$goods_id'");
                }

                // 更新会员价格
                if (!empty($_POST['rank_id']))
                {
                    foreach ($_POST['rank_id'] AS $rank_id)
                    {
                        if (trim($_POST['member_price'][$rank_id]) != '')
                        {
                            $rank = array(
                                        'goods_id'  => $goods_id,
                                        'user_rank' => $rank_id,
                                        'user_price'=> floatval($_POST['member_price'][$rank_id]),
                                        );

                            $sql = "SELECT COUNT(*) FROM " . $ecs->table('member_price') . " WHERE goods_id = '$goods_id' AND user_rank = '$rank_id'";
                            if ($db->getOne($sql) > 0)
                            {
                                if ($rank['user_price'] < 0)
                                {
                                    $db->query("DELETE FROM " . $ecs->table('member_price') . " WHERE goods_id = '$goods_id' AND user_rank = '$rank_id'");
                                }
                                else
                                {
                                    $db->autoExecute($ecs->table('member_price'), $rank, 'UPDATE', "goods_id = '$goods_id' AND user_rank = '$rank_id'");
                                }

                            }
                            else
                            {
                                if ($rank['user_price'] >= 0)
                                {
                                    $db->autoExecute($ecs->table('member_price'), $rank, 'INSERT');
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    // 记录日志
    admin_log('', 'batch_edit', 'goods');

    // 提示成功
    $link[] = array('href' => 'goods_batch.php?act=select', 'text' => $_LANG['15_batch_edit']);
    sys_msg($_LANG['batch_edit_ok'], 0, $link);
}

/*------------------------------------------------------ */
//-- 下载文件
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'download')
{
    /* 检查权限 */
    admin_priv('goods_batch');

    // 文件标签
    // Header("Content-type: application/octet-stream");
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    Header("Content-Disposition: attachment; filename=goods_list.csv");

    // 下载
    if ($_GET['charset'] != $_CFG['lang'])
    {
        $lang_file = '../languages/' . $_GET['charset'] . '/admin/goods_batch.php';
        if (file_exists($lang_file))
        {
            unset($_LANG['upload_goods']);
            require($lang_file);
        }
    }
    if (isset($_LANG['upload_goods']))
    {
        /* 创建字符集转换对象 */
        if ($_GET['charset'] == 'zh_cn' || $_GET['charset'] == 'zh_tw')
        {
            $to_charset = $_GET['charset'] == 'zh_cn' ? 'GB2312' : 'BIG5';
            echo ecs_iconv(EC_CHARSET, $to_charset, join(',', $_LANG['upload_goods']));
        }
        else
        {
            echo join(',', $_LANG['upload_goods']);
        }
    }
    else
    {
        echo 'error: $_LANG[upload_goods] not exists';
    }
}

/*------------------------------------------------------ */
//-- 取得商品
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'get_goods')
{
    $filter = new stdclass;

    $filter->cat_id = intval($_GET['cat_id']);
    $filter->brand_id = intval($_GET['brand_id']);
    $filter->real_goods = -1;
    $arr = get_goods_list($filter);

    make_json_result($arr);
}

/**
 *
 *  计算商品的重量
 */
 
 function get_goods_weight($spec)
 {
     
     
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
/**
 * 自动编排详情格式 
 *
 * 
 */

function create_goods_desc($arr)
{
    //return $arr[14];
    $str = "<p> <span style=\"line-height:2.5;font-size:14px;\">".$arr[14]."</span></p><br /></p>"; //详情
    $data = trim($arr[12]);
    if(!empty($data))
    {
        $str .= "<p><span style=\"font-size:24px;background-color:#E53333;\"><strong>食用方法</strong></span> </p>";
        $str .= "<p><span style=\"line-height:2.5;font-size:14px;\">".$data."</span></p><p><br /></p>";
    }
    $data = trim($arr[11]);
    if(!empty($data))
    {
        $str .= "<p><span style=\"font-size:24px;background-color:#E53333;\"><strong>营养价值</strong></span> </p>";
        $str .= "<p><span style=\"line-height:2.5;font-size:14px;\">".$data."</span></p><p><br /></p>";
    }
    $data = trim($arr[10]);
    if(!empty($data))
    {
        $str .= "<p><span style=\"font-size:24px;background-color:#E53333;\"><strong>保存注意事项</strong></span> </p>";
        $str .= "<p><span style=\"line-height:2.5;font-size:14px;\">".$data."</span></p><p><br /></p>";
    }
    $data = trim($arr[13]);
    if(!empty($data))
    {
        $str .= "<p><span style=\"font-size:24px;background-color:#E53333;\"><strong>食疗效果</strong></span> </p>";
        $str .= "<p><span style=\"line-height:2.5;font-size:14px;\">".$data."</span></p><p><br /></p>";
    }
    
    return $str;
}


/***
 * 转码函数 
 */

function iconv_if_need($content,$src_encode,$shop_encode = 'UTF8')
{
    if( $src_encode == $shop_encode )
        return $content;
    else
        return iconv("GB2312","UTF-8//IGNORE",$data) ;
}



/*
*  $modified_img  经过调整的图，及大图
*  $original_img  源图
*  $is_gallery 是否为相册图（与普通商品图区别在缩略图上)
*  函数作用: 保存源图 ，大图,并将调整过的图生成 详情页显示图 缩略图 ,备份大图 
*  大图 详情页显示图 缩略图 有水印 ，备份大图 源图无水印
*  返回修改后的缩略图 详情图 源图文件名 保存成功 false 保存失败
*/
function  make_format_image($goods_id,$modified_img,$is_gallery = false)
{
    
        $gmtime = (time() - date('Z'));
        $content = array('thumb'=>'','goods' =>'' ,'src' => '');
        $res = array( "code" =>0,"msg" => "");

        $rand_name = $gmtime . sprintf("%03d", mt_rand(1,999));
        $img_ext = substr($modified_img, strrpos($modified_img, '.'));
        $img_name = $goods_id . '_' . $rand_name.$img_ext;
       
        $sub_dir = date('Ym', $gmtime);
        $content['thumb'] =  "images/$sub_dir/thumb_img/$img_name";
        $content['goods'] =  "images/$sub_dir/goods_img/$img_name";
        $content['src'] =  "images/$sub_dir/source_img/$img_name";
        $content['big'] =  "images/$sub_dir/big_img/$img_name";
        $content['backbig'] =  "images/$sub_dir/big_back_img/$img_name";
   
       //检查修改的文件是否存在
        if(!file_exists(ROOT_PATH.$modified_img))
        {
            $res['code'] = 1;
            $res['msg'] = "找不到上传的原始文件 $modified_img";
            return $res;
        }
        
        //检查目录是否可写
        if(!check_dir_create())
        {
            $res['code'] = 1;
            $res['msg'] = "无法创建目录";
            return $res;
        }
         
 
        $image = new cls_image($_CFG['bgcolor']);
        
        
        $content['thumb'] =  "images/$sub_dir/thumb_img/$img_name";
        $content['goods'] =  "images/$sub_dir/goods_img/$img_name";
        $content['src'] =  "images/$sub_dir/source_img/$img_name";
        $content['big'] =  "images/$sub_dir/big_img/$img_name";
        $content['backbig'] =  "images/$sub_dir/big_back_img/$img_name";
        
        
         //生成缩略图文件
        if($is_gallery)
            $temp_img = $image->make_thumb(ROOT_PATH.$modified_img, 100 , 100  );
        else
        {
            $temp_img = $image->make_thumb_keep_ratio(ROOT_PATH.$modified_img, 190,  250);
        }
        safe_copy_image_file( $temp_img,  $content['thumb']) ;
        @unlink($temp_img);
        
        
         //生成详细图文件
        $temp_img = $image->make_thumb_keep_ratio(ROOT_PATH.$modified_img,  400 ,  400 );
        safe_copy_image_file( $temp_img,  $content['goods']) ;
        @unlink($temp_img);
        
        
        //生成调整图
        $org_info = @getimagesize(ROOT_PATH.$modified_img);
        if( $org_info[0] >1000 || $org_info[1] >1000 )
        {
            $temp_img = $image->make_thumb_keep_ratio(ROOT_PATH.$modified_img, 1000, 1000);

             safe_copy_image_file( $temp_img, $content['big']);
        }
        else{
             safe_copy_image_file( $modified_img, $content['big']);
        }
        //保存调整备份图
        safe_copy_image_file(  $content['big'],  $content['backbig']) ;
        //保存源图
        safe_copy_image_file( $modified_img,  $content['src']) ;
     
        
        //加水印
         //判断是否加水印，兼容ECSHOP,以后修改
        if (0 && intval($GLOBALS['_CFG']['watermark_place']) > 0 && !empty($GLOBALS['_CFG']['watermark'])) //
        {
                if ($image->add_watermark(ROOT_PATH.$content['thumb'],'',$GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false)
                {
                    sys_msg($image->error_msg(), 1, array(), false);
                }

                if ($image->add_watermark(ROOT_PATH. $content['goods'],'',$GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false)
                {
                    sys_msg($image->error_msg(), 1, array(), false);
                }
                if ($image->add_watermark(ROOT_PATH.$content['big'],'',$GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false)
                {
                    sys_msg($image->error_msg(), 1, array(), false);
                }

        }
        
       $res['content'] = $content;
       return $res;
    
}



function check_dir_create()
{

    $gmtime = (time() - date('Z'));
    $dir = 'images';
    $sub_dir = date('Ym',$gmtime);
    if (!make_dir(ROOT_PATH.$dir.'/'.$sub_dir))
    {
        return false;
    }
    if (!make_dir(ROOT_PATH.$dir.'/'.$sub_dir.'/source_img'))
    {
            return false;
    }
    if (!make_dir(ROOT_PATH.$dir.'/'.$sub_dir.'/goods_img'))
    {
            return false;
    }
    if (!make_dir(ROOT_PATH.$dir.'/'.$sub_dir.'/thumb_img'))
    {
            return false;
    }
    if (!make_dir(ROOT_PATH.$dir.'/'.$sub_dir.'/big_img'))
    {
            return false;
    }
    if (!make_dir(ROOT_PATH.$dir.'/'.$sub_dir.'/big_back_img'))
    {
        return false;
    }
    return true;

}


function get_format_weight($weight)
{
    
    $kg = stripos($weight,"kg");
    $res = intval($weight);
    if(!$kg)
    {
        $res = $res / 1000;
    }
    return $res;
    
}
   


function safe_copy_image_file($src,$dst)
{
    // echo "$src $dst <br>";
    if (!copy(ROOT_PATH.$src,   ROOT_PATH.$dst))
    {
        echo "src: $src dst: $dst\n";
        //LOG

    }
    
 }

?>
