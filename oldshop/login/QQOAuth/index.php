<?php
@header('Content-Type:text/html;charset=utf-8'); 
session_start();
require_once('config.php');
require_once('oauth.php');
require_once('opent.php');
ob_start();
$o = new MBOpenTOAuth( QQ_AKEY , QQ_SKEY  );
$keys = $o->getRequestToken();//这里填上你的回调URL
print_r($keys);
$aurl = $o->getAuthorizeURL(QQ_AKEY,$keys['oauth_token'] ,false,$_SERVER['HTTP_HOST'].'/login/QQOAuth/callback.php');
$_SESSION['keys'] = $keys;
ob_end_clean();
?>
<script>
setTimeout(function(){window.location.href = '<?php echo $aurl?>';},1000);//1000是1秒钟后跳转
</script>



