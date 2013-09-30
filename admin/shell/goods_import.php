<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



//.die("No rights");
define('IN_ECS', true);
require('../includes/init.php');
include_once( '../includes/lib_goods.php');


defined(EC_CHARSET) or define(EC_CHARSET,"utf");

$_POST['charset']  = "UTF-8";

insert_goods("../data/out.csv");
#$goods_list = (get_all_goods("../data/goods_list.csv"));
            

function insert_goods($filename)
{
    global $db,$ecs;
        /* 查询品牌列表 */
        $brand_list = array();
        $sql = "SELECT brand_id, brand_name FROM " . $ecs->table('brand');
        $res = $db->query($sql);
        while ($row = $db->fetchRow($res))
        {
            $brand_list[$row['brand_name']] = $row['brand_id'];
        }
      /* 字段默认值 */
        $default_value = array(
            'brand_id'      => 0,
            'goods_number'  => 1000,
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
     /* 获取商品good id */
    $max_id = $db->getOne("SELECT MAX(goods_id) + 1 FROM ".$ecs->table('goods'));
    $max_attr_id = $db->getOne("SELECT MAX(goods_attr_id) + 1 FROM ".$ecs->table('goods_attr'));
    $line_number = 0;
    $file = fopen($filename,'r');
    while ($line = fgetcsv($file))
    {
        // 跳过第一行
        if ($line_number <1)
        {
            $line_number++;
            continue;
        }
        else{
            $line_number++;
        }

        $line_list = array();
        if (($_POST['charset'] == 'GB2312') )
        {

            foreach($line as $key =>$value)
            {
                $line_list[$key] = ecs_iconv($_POST['charset'], 'UTF8', $value);

            }
        }
        else
        {
            $line_list = $line;
        }
           
        // 合并
        $field_arr = array(
            'cat_id'        => get_type_id($line_list[0]), //其他
            'add_time'      => gmtime(),
            'last_update'   => gmtime(),
        );
        $field_arr = array_merge($field_arr,$default_value);
        

        $goods_sn   = generate_goods_sn($max_id);
        $field_arr['goods_sn'] = addslashes($goods_sn);
        $field_arr['market_price'] = $line_list[2] * 1.2;
        $field_arr['shop_price'] = $line_list[2];
        $field_arr['goods_name'] = addslashes(trim($line_list[1],'"'));
        $field_arr['seller_note']   =  implode(';',array( $line_list[4],$line_list[5],$line_list[7]));
        $field_arr['goods_desc'] = addslashes($line_list[8]);
        
       //echo $field_arr['goods_name']."<br>";
        
       if ($line_number % 500  == 0)
        {
            echo $line_number."<br>";
            ob_flush();
            flush();
        }
        
        
       // continue;
        //品牌
        $brand_name = substr($field_arr['goods_name'], 0 ,  strpos($field_arr['goods_name'], ' '));
        if (isset($brand_list[$brand_name]))
        {
            $field_arr['brand_id'] = $brand_list[$brand_name];
        }
        else
        {
            $sql = "INSERT INTO " . $ecs->table('brand') . " (brand_name) VALUES ('" . addslashes($brand_name) . "')";
            $db->query($sql);
            $brand_id = $db->insert_id();
            $brand_list[$brand_name] = $brand_id;
            $field_arr['brand_id'] = $brand_id;
        }

        
        //缩略图
        $img = trim($line_list[3]);
        $base =    substr($img,0,strrpos($img,'_'));
        $ext = substr($img,strrpos($img,'.')+1);
        $field_arr['goods_thumb'] = $base.'_160x160.'.$ext;
        $field_arr['goods_img'] = $base.'_380x380.'.$ext;
        $field_arr['original_img'] = $base.'_600x600.'.$ext;

  
        
        
        $gallery =  split(';',trim($line_list[6]) );
                
        #print_r($field_arr);
        try 
        {
            $db->autoExecute($ecs->table('goods'), $field_arr, 'INSERT');
        }
        catch(Exception  $e){
            echo $e->getMessage();
            continue;
        }
        $max_id = $db->insert_id() + 1;
         
         
        //添加商品相册图
        $goods_gallery = array();
        $goods_gallery['goods_id'] = $db->insert_id(); 
        foreach($gallery as $img)
        {
                    $base =    substr($img,0,strrpos($img,'_'));
                    $ext = substr($img,strrpos($img,'.')+1);
      
    
                    $goods_gallery['thumb_url'] = $base.'_60x60.'.$ext;
                    $goods_gallery['img_url'] = $base.'_380x380.'.$ext;
                    $goods_gallery['img_original'] = $base.'_600x600.'.$ext;
          
                    $db->autoExecute($ecs->table('goods_gallery'), $goods_gallery, 'INSERT');

        }
   

   
        //处理商品


        //处理属性 
       
        //$db->autoExecute($ecs->table('goods'), $field_arr, 'INSERT');
        
       
        
      



      
    }
}

function insert_goods_attr($goods_list)
{
    foreach($goods_list as $goods)
    {

        $gs = $goods['goods'];
        $attr = $goods['attr'];
        $goods_id = $gs['goods_id'];

        unset($gs['goods_id']);

        $db->autoExecute($ecs->table('goods'), $gs, 'UPDATE',"goods_id = $goods_id ");
        foreach($attr as $att)
        {
            $db->autoExecute($ecs->table('goods_attr'), $att, 'INSERT');
        }

    }
}
            
function get_all_goods($filename)
{
        global $ecs;
        $line_number = 0;
        $file = fopen($filename,'r');
        while ($line = fgetcsv($file))
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

            $line_list = array();
            if (($_POST['charset'] == 'GB2312') )
            {
                
                foreach($line as $key =>$value)
                {
                    $line_list[$key] = ecs_iconv($_POST['charset'], 'UTF8', $value);
                    
                }
            }
            else
            {
                $line_list = $line;
            }
           
    
            $arr = array( 'goods' => array(),'attr' =>array()  );
            
            $arr['goods']['goods_id'] = trim($line_list[0]);
           // $arr['brand_id'] =  add_brand( trim($line_list[2]) );
           // $arr['cat_id'] =  get_type_id(trim($line_list[4]) );
           // $arr['ext_id'] =  get_type_id(trim($line_list[5]) ,false);
            $arr['goods']['is_on_sale'] = 1;
            $arr['goods']['shop_price'] = floatval(trim($line_list[4]));
            if( $arr['goods']['shop_price']   == 0 )
            {
                $arr['goods']['is_on_sale'] = 0;
            }
            $arr['goods']['market_price'] = $arr['goods']['shop_price'] * 1.2;
            $arr['goods']['goods_weight'] = floatval(trim($line_list[5]));
            
            //arr
             $arr['attr'][] = array(  'goods_id' => $arr['goods']['goods_id'] ,'attr_id' => 1 ,'attr_value' =>   trim($line_list[6]) );
             $arr['attr'][] = array(  'goods_id' => $arr['goods']['goods_id'] ,'attr_id' => 2 ,'attr_value' =>   trim($line_list[7]) );
             $arr['attr'][] = array(  'goods_id' => $arr['goods']['goods_id'] ,'attr_id' => 3 ,'attr_value' =>   trim($line_list[8]) );
             $arr['attr'][] = array(  'goods_id' => $arr['goods']['goods_id'] ,'attr_id' => 4 ,'attr_value' =>   trim($line_list[9]) );
            
            
             //if(!empty($arr['cat_id']) )
             $goods_list[] = $arr;
      
             
       
         
      }
      return $goods_list;
    
}


function add_brand($name)
{
    global $db;
    $sql = "select brand_id from green_brand where brand_name = '$name'";
    $id = $db->getOne($sql);
    if(empty($id))
    {
        $db->query("insert into green_brand (brand_name) values ('$name')");
        $id = $db->insert_id();
    }
    return $id;
}

/**
 *
 * 根据一二级名称获取分类id 
 */
function get_type_id($ftype,$default = true)
{

    $f_id = $GLOBALS['db']->getOne('select cat_id from '.$GLOBALS['ecs']->table('category')." where cat_name = '".$ftype."'");
    if(empty($f_id) && $default)
    {
        $ftype = "其他";
        $f_id = $GLOBALS['db']->getOne('select cat_id from '.$GLOBALS['ecs']->table('category')." where cat_name like '".$ftype."%'");
    }

    $f_id = isset($f_id)?$f_id:39;
    return $f_id;
    
    
}
  
function handle_img($goods_id,$img_str)
{
     global $ecs;
      /* 如果图片不为空,修改商品图片，插入商品相册*/
    if (!empty($img_str))
    {
        $goods_gallery = array();
        $goods_gallery['goods_id'] = $goods_id;
        $all_imgs = explode(':',$img_str);


        $goods_img = $all_imgs[0];
        $res = make_formate_image($goods_img,$goods_id); 
        if($res)
        {
            $goods_thumb =   $res['thumb'];
            $goods_img =  $res['goods'];
            $original_img = $res['src'];
            //修改商品图
            $GLOBALS['db']->query("UPDATE " . $ecs->table('goods') . " SET goods_img = '$goods_img', goods_thumb = '$goods_thumb', original_img = '$original_img' WHERE goods_id='" .$goods_id. "'");
        }
        else{
           // echo "$good_id does not contain image\n";
        }
        //添加商品相册图
        foreach($all_imgs as $img)
        {
                    $img = str_replace("\r\n","",$img);
                    $img = str_replace("\n","",$img);
                    $res = make_formate_image($img,$goods_id,true);
                    if($res)
                    {
                        $goods_gallery['thumb_url'] = $res['thumb'];
                        $goods_gallery['img_url'] = $res['goods'];
                        $goods_gallery['img_original'] = $res['src'];
                        $GLOBALS['db']->autoExecute($ecs->table('goods_gallery'), $goods_gallery, 'INSERT');
                    }
        }

    }
}

function make_formate_image($img,$id,$is_gallery = false)
{
    $args_img = $img.".jpg";
    define("IMGAGE_ROOT","../../");
    $img = "images/PIC/".$img.".jpg";
    
    
    $thumbSize = 100;
    $goodsSize = 400;
    $bigSize = 1000;
    $res = array('thumb'=>'','goods' => '','big' => '','src' => '');
    
    
    if(!file_exists(IMGAGE_ROOT.$img))
    {
      //  echo $img;
        $img = str_replace("jpg", "JPG", $img);
        if(!file_exists(IMGAGE_ROOT.$img) && !$is_gallery)
            echo "$args_img <br>";
    }
    return;
   
    include_once(ROOT_PATH . '/includes/cls_image.php');
    $image = new cls_image($_CFG['bgcolor']);
    
    //thumb
    if($is_gallery)
        $temp_img = $image->make_thumb(IMGAGE_ROOT . $img, $thumbSize, $thumbSize);
    else
        $temp_img = $image->make_thumb_keep_ratio(IMGAGE_ROOT . $img, $GLOBALS['_CFG']['thumb_width'],  $GLOBALS['_CFG']['thumb_height']);
    
 
    $res['thumb'] = reformat_image_name('gallery_thumb', $id, $temp_img, 'thumb');
    
    
    //goods
    $temp_img = $image->make_thumb(IMGAGE_ROOT . $img, $goodsSize, $goodsSize);
    $res['goods'] = reformat_image_name('gallery', $id, $temp_img, 'goods');
    

    
    //source //源图压缩
    $org_info = @getimagesize(IMGAGE_ROOT.$img);
    $temp_img = $image->make_thumb(IMGAGE_ROOT . $img, $org_info[0], $org_info[1]);
    $res['src'] = reformat_image_name('gallery',$id, $temp_img, 'source');
  
    
    $res['big']  = str_replace('source','big',$res['src']);
    
    //big
    $org_info = @getimagesize(IMGAGE_ROOT.$res['src']);
    if( $org_info[0] >1000 || $org_info[1] >1000 )
    {
        $temp_img = $image->make_thumb(IMGAGE_ROOT . $res['src'], $bigSize, $bigSize);
        
        if (!copy(IMGAGE_ROOT . $temp_img, IMGAGE_ROOT .  $res['big'] ))
        {
                sys_msg('fail to copy file: ' . realpath(IMGAGE_ROOT . $img), 1, array(), false);
        }
        else
        {
                @unlink(IMGAGE_ROOT . $temp_img);
        }
    }
    else
    {
         if (!copy(IMGAGE_ROOT . $res['src'], IMGAGE_ROOT .  $res['big'] ))
        {
                sys_msg('fail to copy file: ' . realpath(IMGAGE_ROOT . $img), 1, array(), false);
        }
        else
        {
                @unlink(IMGAGE_ROOT . $temp_img);
        }
        
    }
 
    if (intval($_CFG['watermark_place']) > 0 && !empty($GLOBALS['_CFG']['watermark'])) //加水印
    {
            if ($image->add_watermark(IMGAGE_ROOT.$res['thumb'],'',$GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false)
            {
                sys_msg($image->error_msg(), 1, array(), false);
            }

             if ($image->add_watermark(IMGAGE_ROOT. $res['goods'],'',$GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false)
            {
                sys_msg($image->error_msg(), 1, array(), false);
            }
             if ($image->add_watermark(IMGAGE_ROOT.$res['big'],'',$GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false)
            {
                sys_msg($image->error_msg(), 1, array(), false);
            }
            
    }
    return $res;
    
}
?>
