<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

define('IN_ECS',true);
require ('../../init.php');
GLogin::loginAfterReg('guotao715@163.com');
exit();

GLogin::Login("guotao715@163.com","50942757");

var_dump( GLogin::isLogin());
echo GLogin::id();
echo GLogin::name();
echo GLogin::email();


?>
