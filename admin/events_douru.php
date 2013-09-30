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


/*------------------------------------------------------ */
//-- 商品列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    /* 权限判断 */
    admin_priv('group_by');
    $evens_table = $ecs->table('temp_douru');
    $user_table = $ecs->table('users');
    $pay_table = $ecs->table('pay_log');
    
    $sql  = "select e.*,u.user_name,u.email,p.is_paid from $evens_table e"
            ." left join $user_table u on u.user_id = e.user_id   "
            ." left join  $pay_table p on p.log_id = e.log_id  order by e.id desc  ";
    
  
    $res = $db->query($sql);
    $events = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        
        $row['status'] = ( $row['is_paid'] == 0)?"未支付":"已支付" ;
        $row['time']  = date("Y-m-d H:i:s",$row['time']);
        $events[] = $row;
    }
   

    $smarty->assign('events',    $events);
    $smarty->display('events_douru.htm');
}
