<?php

define('IN_ECS', true);
require('../includes/init_1.php');
include_once( '../includes/lib_goods.php');
include_once(ROOT_PATH . 'includes/lib_order.php');
/* 检查权限 */


#auto_add('g23','122231231',50);

batch_add_users('../data/card.csv');
function batch_add_users($filename)
{
    
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
           
        
       if ($line_number % 20  == 0)
        {
            echo $line_number."<br>";
            ob_flush();
            flush();
        }
 
        
        $user = $line_list[0];
        $pwd = $line_list[1];
        $money = $line_list[2];
        auto_add($user,$pwd,$money);

    }
}






function auto_add($user,$password,$money)
{    
        $id = addUser($user, $password);
        if($id>0)
        {
            if(!add_acount($id,$money))
                    echo $user.' add acount Error '."\n";
        }
        else
             echo $user.' add user Error because of duplicate ID'."\n";
 }

function addUser($user,$password)
{
    global $ecs;
    global $db;
    //$username = empty($_POST['username']) ? '' : trim($_POST['username']);
  //  $password = empty($_POST['password']) ? '' : trim($_POST['password']);
 //   $email = empty($_POST['email']) ? '' : trim($_POST['email']);
    
    $username = trim($user);
    $password = trim($password);
    $email = $username.'@365store.cn';
    
    $sex = empty($_POST['sex']) ? 0 : intval($_POST['sex']);
    $sex = in_array($sex, array(0, 1, 2)) ? $sex : 0;
    $birthday = $_POST['birthdayYear'] . '-' .  $_POST['birthdayMonth'] . '-' . $_POST['birthdayDay'];
    $rank = empty($_POST['user_rank']) ? 0 : intval($_POST['user_rank']);
    $credit_line = empty($_POST['credit_line']) ? 0 : floatval($_POST['credit_line']);

    $users =& init_users();

    if (!$users->add_user($username, $password, $email))
    {
        /* 插入会员数据失败 */
        if ($users->error == ERR_INVALID_USERNAME)
        {
            $msg = $_LANG['username_invalid'];
        }
        elseif ($users->error == ERR_USERNAME_NOT_ALLOW)
        {
            $msg = $_LANG['username_not_allow'];
        }
        elseif ($users->error == ERR_USERNAME_EXISTS)
        {
            $msg = $_LANG['username_exists'];
        }
        elseif ($users->error == ERR_INVALID_EMAIL)
        {
            $msg = $_LANG['email_invalid'];
        }
        elseif ($users->error == ERR_EMAIL_NOT_ALLOW)
        {
            $msg = $_LANG['email_not_allow'];
        }
        elseif ($users->error == ERR_EMAIL_EXISTS)
        {
            $msg = $_LANG['email_exists'];
        }
        else
        {
            //die('Error:'.$users->error_msg());
        }
        echo $msg;
        return false;
        //sys_msg($msg, 1);
    }
    $user_id =  $db->insert_id();
    /* 注册送积分 */
    if (!empty($GLOBALS['_CFG']['register_points']))
    {
        log_account_change($user_id, 0, 0, $GLOBALS['_CFG']['register_points'], $GLOBALS['_CFG']['register_points'], $_LANG['register_points']);
    }

    /*把新注册用户的扩展信息插入数据库*/
    $sql = 'SELECT id FROM ' . $ecs->table('reg_fields') . ' WHERE type = 0 AND display = 1 ORDER BY dis_order, id';   //读出所有扩展字段的id
    $fields_arr = $db->getAll($sql);

    $extend_field_str = '';    //生成扩展字段的内容字符串
    $user_id_arr = $users->get_profile_by_name($username);
    foreach ($fields_arr AS $val)
    {
        $extend_field_index = 'extend_field' . $val['id'];
        if(!empty($_POST[$extend_field_index]))
        {
            $temp_field_content = strlen($_POST[$extend_field_index]) > 100 ? mb_substr($_POST[$extend_field_index], 0, 99) : $_POST[$extend_field_index];
            $extend_field_str .= " ('" . $user_id_arr['user_id'] . "', '" . $val['id'] . "', '" . $temp_field_content . "'),";
        }
    }
    $extend_field_str = substr($extend_field_str, 0, -1);

    if ($extend_field_str)      //插入注册扩展数据
    {
        $sql = 'INSERT INTO '. $ecs->table('reg_extend_info') . ' (`user_id`, `reg_field_id`, `content`) VALUES' . $extend_field_str;
        $db->query($sql);
    }

    /* 更新会员的其它信息 */
    $other =  array();
    $other['credit_line'] = $credit_line;
    $other['user_rank']  = $rank;
    $other['sex']        = $sex;
    $other['birthday']   = $birthday;
    $other['reg_time'] = local_strtotime(local_date('Y-m-d H:i:s'));

    $other['msn'] = isset($_POST['extend_field1']) ? htmlspecialchars(trim($_POST['extend_field1'])) : '';
    $other['qq'] = isset($_POST['extend_field2']) ? htmlspecialchars(trim($_POST['extend_field2'])) : '';
    $other['office_phone'] = isset($_POST['extend_field3']) ? htmlspecialchars(trim($_POST['extend_field3'])) : '';
    $other['home_phone'] = isset($_POST['extend_field4']) ? htmlspecialchars(trim($_POST['extend_field4'])) : '';
    $other['mobile_phone'] = isset($_POST['extend_field5']) ? htmlspecialchars(trim($_POST['extend_field5'])) : '';

    $db->autoExecute($ecs->table('users'), $other, 'UPDATE', "user_name = '$username'");

   

    /* 提示信息 */
    return $user_id;
}


function add_acount($user_id,$money)
{
       /* 检查参数 */
    if ($user_id <= 0)
    {
        echo('invalid param');
        return false;
    }
    $user = user_info($user_id);
    if (empty($user))
    {
        echo($_LANG['user_not_exist']);
          return false;
    }

    /* 提交值 */
    $change_desc    = '初始卡余额';
//    $user_money     = floatval($_POST['add_sub_user_money']) * abs(floatval($_POST['user_money']));
//    $frozen_money   = floatval($_POST['add_sub_frozen_money']) * abs(floatval($_POST['frozen_money']));
//    $rank_points    = floatval($_POST['add_sub_rank_points']) * abs(floatval($_POST['rank_points']));
//    $pay_points     = floatval($_POST['add_sub_pay_points']) * abs(floatval($_POST['pay_points']));

    
    $user_money     = floatval($money);
    $frozen_money   = 0;
    $rank_points    = 0;
    $pay_points     =0;
    
    if ($user_money == 0 && $frozen_money == 0 && $rank_points == 0 && $pay_points == 0)
    {
        echo($_LANG['no_account_change']);
    }

    /* 保存 */
    log_account_change($user_id, $user_money, $frozen_money, $rank_points, $pay_points, $change_desc, ACT_ADJUSTING);

    /* 提示信息 */
    echo $user_id."ok\n";
      return true;
    
    
}
?>
