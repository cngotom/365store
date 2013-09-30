<?php
if (!function_exists('json_decode'))
{
	throw new Exception('API needs the JSON PHP extension.');
}
define('IN_ECS', true);
require(ROOT_PATH.'includes/init.php');
include_once(ROOT_PATH.'includes/lib_transaction.php');
include_once(ROOT_PATH.'includes/lib_passport.php');
session_start();
require_once('config.php');
require_once('oauth.php');
require_once('opent.php');
require_once('json.class.php');


$o = new MBOpenTOAuth( QQ_AKEY , QQ_SKEY , $_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret']);
$last_key = $o->getAccessToken(  $_REQUEST['oauth_vericode'] ) ;
$me=$o->getUserInfo($last_key['openid']);



if($me['nickname']!==""){
  $username=$me['nickname'];
  $password=$last_key['openid'].time();//随便弄个密码 反正没有用
  $email=$last_key['openid'].'@qq.com';//QQG开放平台没有返回邮箱 所以随便弄个 其他的可以根据返回情况而定
  $back_act ="/user.php";
  
  
  $message = print_r($me,true);
  GLog::log('qqlogin','openid='.$last_key['open_id']);
  GLog::log('qqlogin',$message);
  
  if (check_user($email)!==false){
      
        //检查是否为网站编辑
       GLogin::checkEditor($last_key['openid']);
       GLogin::loginAfterReg($email);

      
   }else{
	   $reg_date = time();
	   $password =md5($password);
	   $ip=real_ip();
           $GLOBALS['db']->query('INSERT INTO ' . $GLOBALS['ecs']->table("users") . "(`email`, `user_name`, `password`, `reg_time`, `last_login`, `last_ip`) VALUES ('$email', '$username', '$password', '$reg_date', '$reg_date', '$ip')");
            
           
           GLogin::checkEditor($last_key['openid']);
           GLogin::loginAfterReg($email);
  
            
    }
  // if( !GLogin::isEditor() )
        header("Location: /flow.php?step=checkout\n");
 //   else
   //   header("Location: /g_edit_category.php\n");
   

}else{
    
  $message = print_r($me,true);
  GLog::Error('qqlogin',$message);  
  echo 'fail';
  exit;
}



function check_user($email){
   $sql = "SELECT user_id, password, salt " .
                   " FROM " . $GLOBALS['ecs']->table("users").
                   " WHERE email='$email'";
   $row = $GLOBALS['db']->getRow($sql);
   if(!empty($row)){
    	return true;
   }else{
   		return false;
   }
}
?> 
