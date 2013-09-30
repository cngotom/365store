<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/** 
 * 日志类 
 * 
 * @package    log 
 * @version    $Id$ 
 */  
class GLog  
{  
    const LOG = "Log:";
    const DEBUG = "Debug:";
    const ERROR = "Error:";

    /** 
     * 写日志 
     * 
     * @param string $s_message 日志信息 
     * @param string $s_type    日志类型 
     */  
    public static function write($key,$s_message, $s_type = self::LOG)  
    {  
        //根据key 返回相应的log文件
        $log_root  = ROOT_PATH."/data/log/";
        $logname = $log_root.$key."_".date('Y_m');
        $log_message = sprintf("%s\t%s\t%s\t%s\t%s\n",$s_type,date('Y-m-d H:i:s'),$_SERVER['REMOTE_ADDR'] ,$_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'], $s_message);
        $handle = fopen($logname,"a");
        fwrite($handle, $log_message);
        fclose($handle);
    }  
    
    public static function log($key,$s_message)
    {
        self::write($key,$s_message,  self::LOG) ;
    }
    
    public static function error($key,$s_message)
    {
        self::write($key,$s_message,  self::ERROR) ;
    }
    
     public static function debug($key,$s_message)
    {
        self::write($key,$s_message,  self::DEBUG) ;
    }
}

