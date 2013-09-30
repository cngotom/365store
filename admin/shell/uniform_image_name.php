<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//die("No rights");
define('IN_ECS', true);
require('../includes/init.php');
include_once('../includes/lib_goods.php');


$goods_array = array(1624);
$goods_str =  ' goods_id in ('.implode(',',$goods_array).')';
unifor_goods_img();
unifor_gallery_img();

function unifor_gallery_img()
{
      global $db,$ecs,$goods_str;
      $sql = "select img_id, thumb_url,img_url,img_original from ".$ecs->table('goods_gallery').' where '.$goods_str;
      $goods_list = $db->getAll($sql);
      
      
        foreach($goods_list as $goods)
        {
            $img_id = $goods['img_id'];
            $ori_img = $goods['img_original'];
            $goods_src_img = $goods['img_url'];
            $thumb_src_img = $goods['thumb_url'];


            $goods_dst_img = str_replace("source_img", "goods_img", $ori_img);
            $thumb_dst_img = str_replace("source_img", "thumb_img", $ori_img);
            $big_dst_img = str_replace("source_img", "big_img", $ori_img);
            $bigback_dst_img = str_replace("source_img", "big_back_img", $ori_img);


            
            
            safe_copy_image_file($ori_img,$big_dst_img);
            safe_copy_image_file($ori_img,$bigback_dst_img);
                    
            safe_move_image_file($goods_src_img,$goods_dst_img);

            safe_move_image_file($thumb_src_img,$thumb_dst_img);
            
            

            $all_images = array("img_url" => $goods_dst_img,"thumb_url" =>$thumb_dst_img  );

            $db->autoExecute($ecs->table('goods_gallery'), $all_images, 'update',"img_id = $img_id");

        }
    
}




function unifor_goods_img()
{
    
    global $db,$ecs,$goods_str;
$sql = "select goods_id, goods_thumb,goods_img,original_img from ".$ecs->table(goods)." where is_delete = 0 and ".$goods_str;
$goods_list = $db->getAll($sql);

foreach($goods_list as $goods)
{
    $goods_id = $goods['goods_id'];
    $ori_img = $goods['original_img'];
    $goods_src_img = $goods['goods_img'];
    $thumb_src_img = $goods['goods_thumb'];
    
    $ori_img;
    
    $goods_dst_img = str_replace("source_img", "goods_img", $ori_img);
    $thumb_dst_img = str_replace("source_img", "thumb_img", $ori_img);
    $big_dst_img = str_replace("source_img", "big_img", $ori_img);
    $bigback_dst_img = str_replace("source_img", "big_back_img", $ori_img);


    safe_copy_image_file($ori_img,$big_dst_img);
    safe_copy_image_file($ori_img,$bigback_dst_img);

    
    safe_move_image_file($goods_src_img,$goods_dst_img);
    
    safe_move_image_file($thumb_src_img,$thumb_dst_img);
    
    $all_images = array("goods_img" => $goods_dst_img,"goods_thumb" =>$thumb_dst_img  );
    
    $db->autoExecute($ecs->table('goods'), $all_images, 'update',"goods_id = $goods_id");
    
}
}


function getfilename($filename)
{
  $pt=strrpos($filename, "/");echo $pt;
  if ($pt)
      return substr($filename, $pt+1, strlen($filename) - $pt ); 
  else
      return false;
}


function safe_move_image_file($src,$dst)
{
    if (!move_image_file(ROOT_PATH.$src,    ROOT_PATH.$dst))
    {
        echo "src: $src dst: $dst\n";
    }
}

 function safe_copy_image_file($src,$dst)
{
    if (!copy(ROOT_PATH.$src,    ROOT_PATH.$dst))
    {
        echo "src: $src dst: $dst\n";
    }
}
    
    
    










?>
