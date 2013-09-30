<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



define('IN_ECS', true);
require('../includes/init_1.php');
include_once(ROOT_PATH . 'admin/includes/lib_goods.php');

defined(EC_CHARSET) or define(EC_CHARSET,"utf");

$_POST['charset']  = "GB2312";


$goods_list = (get_all_goods("../data/goods_list.csv"));
            

foreach($goods_list as $goods)
{
    $goods_id = $goods['goods_id'];
  
   // $goods['goods_weight'] = get_format_weight($goods['goods_weight'] );
    
    
    
   // echo $goods["goods_id"] . "  ".$goods['goods_weight']."<br>";
    //print_r($goods);
    $db->autoExecute($ecs->table('goods'), $goods, 'update',"goods_id = $goods_id ");
 //   exit();
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
            
function get_all_goods($filename)
{
        global $ecs,$db;
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
            if (($_POST['charset'] == 'GB2312') && (strpos(strtolower(EC_CHARSET), 'utf') == 0))
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
           
             $arr['goods_id'] = trim($line_list[0]);
             $arr['goods_weight'] = trim($line_list[3]);
             $brand_name = trim($line_list[2]);
             
             $brand_id = $db->getOne("select brand_id from green_brand where brand_name like '$brand_name'");
             if(!$brand_id )
             {
                 
                 $db->query('insert into green_brand (brand_name) value( '."'$brand_name')");
                 $brand_id = $db->insert_id();
             }
             
             $arr['brand_id'] = $brand_id; 
            // $arr['cat_id'] = get_type_id("",$line_list[3]);
             #$arr['goods_thumb']  = 'images/201204/thumb_img/'.trim($line_list[1]);
             #$arr['goods_img']  = 'images/201204/goods_img/'.trim($line_list[1]);
             #$arr['original_img']  = 'images/201204/source_img/'.trim($line_list[1]);
             if(!empty($arr['goods_id'] ))
                  $goods_list[] = $arr;
             
//            $arr['goods_id'] = trim($line_list[1]);
//            $arr['goods_weight']  = trim($line_list[4]);
//            
//            if(!empty ($arr['goods_weight']))
//                $goods_list[] = $arr;
       
      }
      return $goods_list;
    
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
       # $f_id = $GLOBALS['db']->getOne('select cat_id from '.$GLOBALS['ecs']->table('category')." where cat_name = '".$ftype."'");
        if(!isset($f_id))
        {
            $ftype = "其他";
            $f_id = 39;
            #$f_id = $GLOBALS['db']->getOne('select cat_id from '.$GLOBALS['ecs']->table('category')." where cat_name like '".$ftype."'");
        }
        
        $f_id = isset($f_id)?$f_id:39;
        return $f_id;
    }
    
}

?>
