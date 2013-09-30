<?php

function sendsms($tel,$message)
{
     $myusernmae="13654580246";
     //您在短信网关的登录密码
     $mypassword="50942757";
     return _sendsms($myusernmae,$mypassword,$tel,$message);
}
function _sendsms($myusernmae,$mypassword,$telephone,$message) {
//调用SMSGATE.CN接口发送短信（您的用户名，密码，接收短信的手机号码集，短信内容）
//返回0或者负数表示发送失败，正数表示已成功发送出去的短信数量
//本函数版本号：v0.0.2

    $URL="utf";
    
    $URL="http://www.smsgate.cn/".$URL;
    $URL=$URL.".asp?usr=".rawurlencode($myusernmae)."&pwd=".rawurlencode($mypassword);
    $URL=$URL."&tel=".rawurlencode($telephone)."&msg=".rawurlencode($message);
    
  
    $content=@file_get_contents($URL);
    if (!is_numeric($content)) {
        $content=0;
    }
    return (int)$content;
}
//以上函数可粘贴到您的程序中直接复用，无须做任何修改

//以下代码为调用上述函数的示例，您可以在自己的程序中酌情模仿
//您的用户名

?>