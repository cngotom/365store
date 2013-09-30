<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

//获取指定订单商品的评论序列 

function get_order_comment_goods($user_id,$order_id)
{
   
    $order_info_table = $GLOBALS['ecs']->table('order_info') ;
    $order_goods_table = $GLOBALS['ecs']->table('order_goods') ;
    $comment_table = $GLOBALS['ecs']->table('comment') ;
     
    $sql = "select goods_id,goods_name,goods_sn,add_time from $order_goods_table g ,$order_info_table i  where g.order_id = $order_id  and g.order_id = i.order_id";
    

    $goods_list = $GLOBALS['db']->getAll($sql);
   
    
    //检查是否之前评论过该商品
    foreach($goods_list as &$goods)
    {
        $goods_id  = $goods['goods_id'];
        $sql = "select count(*) from $comment_table where user_id = $user_id and id_value = $goods_id";
        $res = $GLOBALS['db']->getOne($sql);
  
        $goods['is_commented'] = intval($res);
        $goods['goods_url'] = build_uri('goods', array('gid' => $goods['goods_id']), $goods['goods_name']);
        $goods['comment_url'] = "user.php?act=goods_comment&goods_id=".$goods['goods_id'];
        $goods['time'] = date('Y-m-d',$goods['add_time']);

    }
    return $goods_list;
}


function get_questions()
{
    $questions = array(
         '您对网站的访问速度是否感到满意？',
            '您是否可以方便的找到所需商品？',
            '您对商品介绍是否感到满意（如商品图片、参数的详细程度/准确性）？',
            '您对下单的过程是否感到满意（从“加入购物车”到“订单提交成功”）？',
            '您对此次订单的送货速度是否感到满意？',
            '您对本次商品的质量是否感到满意？',
            '您对本次购物的总体满意度如何？'
    );
    
    return $questions;
}


function insert_order_comment($user_id,$order_id,$marks,$text)
{
     global $db,$ecs;
     $order_comment = array(
        'user_id' => $user_id ,
        'order_id' => $order_id,
        'comment_marks'=> $marks,
         'comment_text'=> $text,
        'time' =>  time()
    );
     
    
     $db->autoExecute($ecs->table('order_comment'), $order_comment, 'INSERT');
    
    
}





/**
 * 添加评论内容
 *
 * @access  public
 * @param   object  $cmt
 * @return  void
 */
function add_comment($cmt)
{
    $message = "评论成功";
    /* 评论是否需要审核 */
    $status = 1 - $GLOBALS['_CFG']['comment_check'];
    $user_id = GLogin::id();
    $user_id = empty($user_id) ? 0 :$user_id;
    $email = empty($cmt->email) ? GLogin::email() : trim($cmt->email);
    $user_name = empty($cmt->username) ? GLogin::name() : trim($cmt->username);
    $email = htmlspecialchars($email);
    $user_name = htmlspecialchars($user_name);

    //查看用户是否评论过
    $sql = "select count(*) from " .$GLOBALS['ecs']->table('comment') ." where user_id = $user_id and id_value = ".$cmt['id'];
    if(  intval( $GLOBALS['db']->getOne($sql) ) >0  )
    {
        $message = "您已经评论过该商品";
    }
    else
    {
    
        //查看用户是否购买过该类商品
        /* 保存评论内容 */
        $sql = "INSERT INTO " .$GLOBALS['ecs']->table('comment') .
            "(comment_type, id_value, email, user_name, content, comment_rank, add_time, ip_address, status, parent_id, user_id) VALUES " .
            "('" .$cmt['type']. "', '" .$cmt['id']. "', '$email', '$user_name', '" .$cmt['content']."', '".$cmt['rank']."', ".gmtime().", '".real_ip()."', '$status', '0', '$user_id')";

        $result = $GLOBALS['db']->query($sql);
        clear_cache_files('comments_list.lbi');
        /*if ($status > 0)
        {
            add_feed($GLOBALS['db']->insert_id(), COMMENT_GOODS);
        }*/
    }
    return $message;
}


function get_order_comment_list($user_id)
{
    global $ecs;
    $table =  $ecs->table('order_comment');
    $ext_table= $ecs->table('order_info');
    $sql = "select t.order_id as order_id,order_sn,comment_text,time from $table t,$ext_table e  where t.user_id = $user_id  and  e.order_id = t.order_id";
    $res =  $GLOBALS['db']->getAll($sql);
    
    foreach($res as &$r)
    {
       $r['order_url'] = 'user.php?act=order_detail&order_id='. $r['order_id']  ;
       $r['date'] = date('Y-m-d H:i', $r['time'] );
    }
    
    return $res;
    
}

?>
