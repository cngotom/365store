<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

define('IN_ECS',true);
define('INIT_NO_USERS',true);
require(ROOT_PATH . '/includes/init.php');
require(ROOT_PATH . '/includes/cls_image.php');

class GoodsController
{
    //商品图片缩略图略图大小
    const GOODS_THUMB_WIDTH  = 190;
    const GOODS_THUMB_HEIGHT  = 250;
    //相册缩略图大小
    const GALLERY_THUMB_HEIGHT  = 100;
    const GALLERY_THUMB_WIDTH  = 100;
    //详情页图大小 商品和缩略图一致
    const GOODS_IMAGE_WIDTH = 400;
    const GOODS_IMAGE_HEIGHT = 400;
    //放大图最大尺寸
    const MAX_ZOOM_OUT_SIZE = 1100;
    
    
    const TEMP_UPLOAD_PATH =  "images/temp/";
    var $db; //数据库操作

    function GoodsController() {
        
        require(ROOT_PATH . 'data/config.php');
        $this->db = new cls_mysql($db_host, $db_user, $db_pass, $db_name);
        
    }
    
    public function actionUpdateImage($goods_id,$imgurl)
    {
        //处理图片
        $src_img = self::TEMP_UPLOAD_PATH.$imgurl;
        $modify_img = self::TEMP_UPLOAD_PATH."F_".$imgurl;
        $res = $this->make_format_image($goods_id,$modify_img,$src_img);
        if(!$res['code'])
        {
            $goods = array();
            $arr  = $res['content'];
            $goods['original_img'] = $arr['src'];
            $goods['goods_img']= $arr['goods'];
            $goods['goods_thumb']= $arr['thumb'];
            
            //更新数据库
            $this->db->autoExecute("green_goods", $goods, 'update',"goods_id = $goods_id");
        }
        //更新首张相册图
        $res = $this->make_format_image($goods_id,$modify_img,$src_img,true);
        if(!$res['code'])
        {
            $img_id = $this->db->getOne("select img_id from green_goods_gallery where goods_id=$goods_id order by img_id asc");
            $goods = array();
            $arr  = $res['content'];
            $goods['img_original'] = $arr['src'];
            $goods['img_url']= $arr['goods'];
            $goods['thumb_url']= $arr['thumb'];
            
            if(!empty($img_id))
                //更新数据库
                $this->db->autoExecute("green_goods_gallery", $goods, 'UPDATE',"img_id = $img_id");
            else
            {
                $goods['goods_id'] = $goods_id;
                $this->db->autoExecute("green_goods_gallery", $goods, 'INSERT');
            }
        }
        

        echo json_encode($res);
    }
    
    public function actionGetPreview($goods_id)
    {
        
         //处理图片
         $sql = "select goods_name,goods_img,goods_desc,goods_brief from green_goods where goods_id = $goods_id";
         $goods = $this->db->getRow($sql);
         $goods_img = NGINX_IMG_HOST.$goods["goods_img"];
         $goods_url =  "goods.php?id=$goods_id";
         $goods_title = $goods["goods_name"];
         $goods_info = empty($goods["goods_brief"])?sub_str(strip_tags($goods["goods_desc"]),60):$goods["goods_brief"];
         require(VIEW_PATH."GoodsPreview.php");
         //更新数据库
      
      
    }
    
    
   /*
    *  $modified_img  经过调整的图，及大图
    *  $original_img  源图
    *  $is_gallery 是否为相册图（与普通商品图区别在缩略图上)
    *  函数作用: 保存源图 ，大图,并将调整过的图生成 详情页显示图 缩略图 ,备份大图 
    *  大图 详情页显示图 缩略图 有水印 ，备份大图 源图无水印
    *  返回修改后的缩略图 详情图 源图文件名 保存成功 false 保存失败
    */
   private  function  make_format_image($goods_id,$modified_img,$original_img,$is_gallery = false)
   {
     
        global $_CFG;
        $gmtime = (time() - date('Z'));
        $content = array('thumb'=>'','goods' =>'' ,'src' => '');
        $res = array( "code" =>0,"msg" => "");

        $rand_name = $gmtime . sprintf("%03d", mt_rand(1,999));
        $img_ext = substr($modified_img, strrpos($modified_img, '.'));
        $img_name = $goods_id . '_' . $rand_name.$img_ext;
       
        $sub_dir = date('Ym', $gmtime);
    
       //检查修改的文件是否存在
        if(!file_exists(ROOT_PATH.$modified_img))
        {
            $res['code'] = 1;
            $res['msg'] = "找不到调整后的文件 $modified_img";
            return $res;
        }
        if(!file_exists(ROOT_PATH.$original_img))
        {
            $original_img = "";
         //   $res['code'] = 1;
         //   $res['msg'] = "找不到上传的原始文件 $original_img";
         //   return $res;
        }
        
        //检查目录是否可写
        if(!$this->check_dir_create())
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
            $temp_img = $image->make_thumb(ROOT_PATH.$modified_img, self::GALLERY_THUMB_WIDTH  ,  self::GALLERY_THUMB_HEIGHT  );
        else
            $temp_img = $image->make_thumb_keep_ratio(ROOT_PATH.$modified_img,  self::GOODS_THUMB_WIDTH,  self::GOODS_THUMB_HEIGHT);
        
        $this->safe_copy_image_file( $temp_img,  $content['thumb']) ;
        @unlink($temp_img);
        
        
         //生成详细图文件
        $temp_img = $image->make_thumb_keep_ratio(ROOT_PATH.$modified_img,  self::GOODS_IMAGE_WIDTH ,  self::GOODS_IMAGE_HEIGHT );
        $this->safe_copy_image_file( $temp_img,  $content['goods']) ;
        @unlink($temp_img);
        
         //保存源图
       if(!empty($original_img))
           $this->safe_copy_image_file( $original_img,  $content['src']) ;
       else
       {
            $original_img = $this->get_original_img($goods_id);
            $this->safe_copy_image_file( $original_img,  $content['src']) ;
          // $content['src'] = "";
       }
        //保存调整图
        $this->safe_copy_image_file( $modified_img,  $content['big']) ;
        //保存调整备份图
        $this->safe_copy_image_file( $modified_img,  $content['backbig']) ;
        
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
       $res['msg'] = '保存成功';
       return $res;
        
   }
   
    function get_original_img($goods_id)
   {
       
       return $this->db->getOne('select original_img from green_goods where goods_id = '.$goods_id);
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
   
   
   
   

    
    function safe_copy_image_file($src,$dst)
    {
       // echo "$src $dst <br>";
        if (!copy(ROOT_PATH.$src,   ROOT_PATH.$dst))
        {
            //echo "src: $src dst: $dst\n";
            //LOG
            
        }
    }
    
}
?>
