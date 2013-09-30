<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function make_image_by_text($text)
{
   $im = imagecreate(400,50);
    $white = imagecolorallocate($im, 255, 255, 255);
    $black = imagecolorallocate($im, 0, 0, 0);
    $font_file = "images/1.ttf";
    $str1 = $text;
    imagettftext($im, 20,0,20,40,$black,'images/1.ttf',$str1);
    header("Content-type:image/jpeg");
    imagejpeg($im);
    imagedestroy($im);
}

require('includes/pq/phpQuery.php');
function get_baidu_last_replay($url)
{
    $base = 'http://tieba.baidu.com';
    $dom = file_get_contents($url);   
    phpQuery::$defaultCharset = "GBK";
    $doc = phpQuery::newDocument($dom); 

    $pages = pq('.l_pager.pager_theme_2:first a');
    if(count($pages) != 0)
    {
        $index =  count($pages) -1;
        $link = pq(".l_pager.pager_theme_2:first a:eq($index)");
        $nurl = $link->attr('href');

        $nurl = $base.$nurl;
        $dom = file_get_contents($nurl);   
        phpQuery::$defaultCharset = "GBK";
        $doc = phpQuery::newDocument($dom); 
    }
    else{
        //   echo 'one page';
    }
    $lastPage = $doc->find('.d_post_content:last');
    return $lastPage->text();
    
}

function get_tianya_last_replay($url)
{
    $base = 'http://bbs.tianya.cn';
    //$url = 'http://bbs.tianya.cn/post-934-13486-1.shtml';
    $dom = file_get_contents($url);   
    phpQuery::$defaultCharset = "UTF-8";
    $doc = phpQuery::newDocument($dom); 

    $pages = pq('.atl-pages:first a');
    if(count($pages) != 0)
    {
        $index =  count($pages) -2;
        $link = pq(".atl-pages:first a:eq($index)");
        $nurl = $link->attr('href');
        $nurl = $base.$nurl;
        $dom = file_get_contents($nurl);   
        phpQuery::$defaultCharset = "UTF-8";
        $doc = phpQuery::newDocument($dom); 
    }
    else{
     //   echo 'one page';
    }
    $lastPage = $doc->find('.atl-item:last');
    return $lastPage->find('.bbs-content')->text();
}


$refer = $_SERVER['HTTP_REFERER'];
if(!empty($refer))
{
    if(  preg_match("/tieba.baidu.com/",$refer) )
    {
        $url = $refer;
        $key = get_baidu_last_replay($url);
        $key = substr($key,0,30);
        make_image_by_text($key);
        exit();
    }
    else if( preg_match("/bbs.tianya.cn/",$refer))
    {
        $url =  $refer;
        $key = get_tianya_last_replay($url);
        $key = substr($key,0,30);
        make_image_by_text($key);
        exit();
    }
    else
    {
        $url =  'http://tieba.baidu.com/p/2075695592';
        $key = get_baidu_last_replay($url);
        $key = substr($key,0,30);
        make_image_by_text($key);
        exit();
    }
}
else
{
     header("Location:http://365bdh.taobao.com");
}
?>


