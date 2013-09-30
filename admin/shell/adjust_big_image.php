5<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//die("No rights");
define('IN_ECS', true);
require('includes/init.php');
include_once('includes/lib_goods.php');
include_once(  'includes/cls_image.php');
$image = new cls_image($_CFG['bgcolor']);

$goods_array = array(56037);
$goods_str =  ' goods_id in ('.implode(',',$goods_array).')';
unifor_goods_img();
unifor_gallery_img();

function unifor_gallery_img()
{
      global $db,$ecs,$goods_str,$image;
      $sql = "select img_id, thumb_url,img_url,img_original from ".$ecs->table('goods_gallery').' where '.$goods_str;
      $goods_list = $db->getAll($sql);
      
      
        foreach($goods_list as $goods)
        {
            $img_id = $goods['img_id'];
            $ori_img = $goods['img_original'];



          //  $goods_dst_img = str_replace("source_img", "goods_img", $ori_img);
            //$thumb_dst_img = str_replace("source_img", "thumb_img", $ori_img);
            $big_dst_img = str_replace("source_img", "big_img", $ori_img);
          //  $bigback_dst_img = str_replace("source_img", "big_back_img", $ori_img);
            
       $org_info = @getimagesize('../'.$ori_img);
            if( $org_info[0] >1000 || $org_info[1] >1000 )
            {
                 //$temp_img = $image->make_thumb('../' . $original_img, $GLOBALS['_CFG']['big_width'],  $GLOBALS['_CFG']['big_height']);
                 $temp_img = $image->make_thumb('../' . $ori_img, 1000, 1000);
                 if (!copy('../' . $temp_img, '../' . $big_dst_img))
                {
                     sys_msg('fail to copy file: ' . realpath('../' . $ori_img), 1, array(), false);
                }
                else
                {
                     @unlink('../' . $temp_img);
                }
                
            }
            else {
                   $maxLength = ($org_info[0] > $org_info[1] )?$org_info[0]: $org_info[1];
                  $temp_img = $image->make_thumb('../' . $ori_img, $maxLength, $maxLength);
                  if (!copy('../' . $temp_img, '../' . $big_dst_img))
                {
                     sys_msg('fail to copy file: ' . realpath('../' . $org_info), 1, array(), false);
                }
                else
                {
                     @unlink('../' . $temp_img);
                }
                
            }
           
        }
    
}




function unifor_goods_img()
{
    
    global $db,$ecs,$goods_str,$image;
$sql = "select goods_id, goods_thumb,goods_img,original_img from ".$ecs->table(goods)." where is_delete = 0 and ".$goods_str;
$goods_list = $db->getAll($sql);


  
foreach($goods_list as $goods)
{
    $goods_id = $goods['goods_id'];
    $ori_img = $goods['original_img'];
    $goods_src_img = $goods['goods_img'];
    $thumb_src_img = $goods['goods_thumb'];
    

    
    $goods_dst_img = str_replace("source_img", "goods_img", $ori_img);
    $thumb_dst_img = str_replace("source_img", "thumb_img", $ori_img);
    $big_dst_img = str_replace("source_img", "big_img", $ori_img);
    $bigback_dst_img = str_replace("source_img", "big_back_img", $ori_img);


         $org_info = @getimagesize('../'.$ori_img);
         
        
            if( $org_info[0] >1000 || $org_info[1] >1000 )
            {
                
                
                 //$temp_img = $image->make_thumb('../' . $original_img, $GLOBALS['_CFG']['big_width'],  $GLOBALS['_CFG']['big_height']);
                 $temp_img = $image->make_thumb('../' . $ori_img, 1000, 1000);
                 if (!copy('../' . $temp_img, '../' . $big_dst_img))
                {
                     sys_msg('fail to copy file: ' . realpath('../' . $ori_img), 1, array(), false);
                }
                else
                {
                     @unlink('../' . $temp_img);
                }
                
            }
            else {
                   $maxLength = ($org_info[0] > $org_info[1] )?$org_info[0]: $org_info[1];
              
                  $temp_img = $image->make_thumb('../' . $ori_img, $maxLength, $maxLength);
                  if (!copy('../' . $temp_img, '../' . $big_dst_img))
                {
                     sys_msg('fail to copy file: ' . realpath('../' . $org_info), 1, array(), false);
                }
                else
                {
                     @unlink('../' . $temp_img);
                }
                
            }
    
}
}


function getfilename($filename)
{
  $pt=strrpos($filename, "/");
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
