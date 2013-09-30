<?php
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
function get_image($key)
{
    $img_search = 'http://m.baidu.com/ssid=0/from=0/bd_page_type=1/uid=A64BA2CA2424C5B78D6BC84F1A997468/pu=sz%40176_220/img?tn=bdwis&pn=0&dw=w320&bs=176_208&pos=1mid=w320&word=' ;
    $url = $img_search . urlencode($key);
    $dom = file_get_contents($url);   
    phpQuery::$defaultCharset = "UTF-8";
    $doc = phpQuery::newDocument($dom); 
    $index = rand(0,4);
    $img = pq(".mt.ct.b a:eq($index)")->attr('href');
    $img = substr($img, strpos($img, 'src=') + strlen('src=') );

    
    header("Location:$img");
}

$refer = $_SERVER['HTTP_REFERER'];
if(!empty($refer))
{
    if(  preg_match("/tieba.baidu.com/",$refer) )
    {
        $url = $refer;
        $key = get_baidu_last_replay($url);
        $key = substr($key,0,30);
        get_image($key);
        exit();
    }
    else if( preg_match("/bbs.tianya.cn/",$refer))
    {
        $url =  $refer;
        $key = get_tianya_last_replay($url);
        $key = substr($key,0,30);
        get_image($key);
        exit();
    }
    else
    {
        $url =  'http://tieba.baidu.com/p/2075695592';
        $key = get_baidu_last_replay($url);
        $key = substr($key,0,30);
        get_image($key);
        exit();
    }
}
else
{
     header("Location:http://365bdh.taobao.com");
}
exit();





//print_r($lastPage);
//print_r($lastPage[count($lastPage)-1]);

exit();

function ls($dir /*.php$|.txt$*/)
{
       static $i = 0;
       $files = Array();
       $d = opendir($dir);
       while ($file = readdir($d))
       {
               if ($file == '.' || $file == '..' ) continue;
               if (is_dir($dir.'/'.$file))
               {
                       $files += ls($dir.'/'.$file, $mask);
                       continue;
               }
               $files[$i++] = $dir.'/'.$file;
       }
       return $files;
}
$src = ls('images/temp/meinv');

class imgdata{
        public $imgsrc;
        public $imgdata;
        public $imgform;
        public function getdir($source){
                $this->imgsrc  = $source;
        }
        public function img2data(){
                $this->_imgfrom($this->imgsrc);
                return $this->imgdata=fread(fopen($this->imgsrc,'rb'),filesize($this->imgsrc));       
        }
        public function data2img(){
                header("content-type:$this->imgform");
                echo $this->imgdata;
                //echo $this->imgform;
                //imagecreatefromstring($this->imgdata);
        }
        public function _imgfrom($imgsrc){
                $info=  getimagesize($imgsrc);
                //var_dump($info);
                return $this->imgform = $info['mime'];
        }
}
$n = new imgdata;
$n -> getdir( $src[rand(0, count($src)-1)]    );
$n -> img2data();
$n -> data2img();

exit();
define('IN_ECS', true);
require(ROOT_PATH. '/includes/init.php');
include_once(ROOT_PATH. '/includes/lib_sms.php');

$res = sendsms('18310019799','已经发货');
if($res <= 0)
    echo "发送失败 ";
//var_dump($_SERVER);
?>
