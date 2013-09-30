<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */


class GoodsController
{
    //商品图片缩略图略图大小
    const GOODS_THUMB_WIDTH  = 190;
    const GOODS_THUMB_HEIGHT  = 250;
    
    const TEMP_UPLOAD_PATH = ROOT_PATH."images/temp/";
  
    
    public function actionUpdateImage($goodsid,$imgurl)
    {
        global $db;
        //处理图片
        $src_img = TEMP_UPLOAD_PATH.$imgurl;
        $modify_img = TEMP_UPLOAD_PATH.$imgurl;
        make_formate_image($imgurl,$goodsid);
        
        
        
        //更新数据库
        $db->autoExecute($ecs->table('goods'), $all_images, 'update',"goods_id = $goods_id");
    }
    
    
    
    function make_formate_image($img,$id,$is_gallery = false)
    {

        $thumbSize = 100;
        $goodsSize = 400;
        $bigSize = 1000;
        
        
        $res = array('thumb'=>'','goods' => '','big' => '','src' => '');


        //找不到Temp图片文件
        if(!file_exists($img))
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

        
        
        //判断是否加水印，兼容ECSHOP,以后修改
        if (intval($_CFG['watermark_place']) > 0 && !empty($GLOBALS['_CFG']['watermark'])) //
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
    
    
    
    
    
}
?>
