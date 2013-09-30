<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Goods
 *
 * @author Administrator
 */
require(ROOT_PATH . '/includes/pq/phpQuery.php');



function get_url_host($url)
{
        $pos_s = strpos($url, '/');
        $pos_s = $pos_s+2;
        $pos_e = strpos($url,'/',$pos_s);
        $host = substr($url,$pos_s,$pos_e - $pos_s);
        return $host;
}
function save_to_file($str)
{
    fwrite(fopen("a.txt","w"),  $str );
  //  fwrite(fopen("a.txt","w"),   file_get_contents($url) );
}

function substr_between($data,$sstr,$estr)
{
        $pos_s = strpos($data, $sstr);
        $pos_s = $pos_s+  strlen($sstr);
        $pos_e = strpos($data,$estr,$pos_s);
        $value = substr($data,$pos_s,$pos_e - $pos_s);
        return $value;
}
class BuyRGoods {
    //put your code here
    public $title;
    public $price;
    public $image;
    public  static $typeMap = array (                                
        "taobao" => array( 
        "item.taobao.com",
        "detail.tmall.com",
        "ju.taobao.com" 
      ),
        "jingdong" => array(
            ""
        )
    );
    
    
    public function BuyRGoods($t,$p,$i)
    {
        $this->title  = $t;
        $this->price  = $p;
        $this->image  = $i;
    }
    
    public function print_self()
    {
        echo "Title:  ". $this->title  ." <br>";
        echo "price:  ". $this->price  ." <br>";
        echo "image:  ". $this->image  ." <br>";
    }
    public function to_array()
    {
        $a = array( "title" => $this->title,
                      "price" => $this->price,
                      "image" => $this->image
           ) ;
      //  return json_encode($a);
        return $a;
    }
    
    private static function get_type($url)
    {
        $pos_s = strpos($url, '/');
        $pos_s = $pos_s+2;
        $pos_e = strpos($url,'/',$pos_s);
        $host = substr($url,$pos_s,$pos_e - $pos_s);
       
         foreach(self::$typeMap as $key => $types)
         {
             if( in_array($host, $types)  )
                     return $key;
         }
        
        return null;
    }
    
    public static function get_goods($url)
    {
            $type = self::get_type($url);
            $parse = UrlParseFactory::get_parse($type);
            if($parse)
                return $parse->get_goods($url);
            else
                return null;
    }
    
    
    
}



abstract class UrlParse
{
     
    public function valide_url($url)
    {
        
    }  
    public function get_goods($url)
    {
        if($this->valide_url($url))
        {
            $dom = file_get_contents($url);   
            //fwrite(fopen("a.txt","w"),   file_get_contents($url) );
            //$dom = file_get_contents('http://127.0.0.1/GoodsInfo/home.htm');
            phpQuery::$defaultCharset = "GBK";
            phpQuery::newDocument($dom); 
            return $this->parse_url($url);
        }
        else {
            return null;
        }
    }
    
    public function parse_url($url)
    {
        return null;
    } 
    
}

class TaobaoUrlParse extends UrlParse
{
    
    public function valide_url($url)
    {
        $invalide_host = array(
                "item.taobao.com",
                "detail.tmall.com",
                "ju.taobao.com"      
        );
        return in_array(get_url_host($url), $invalide_host);
    }  
    public function parse_url($url)
    {
            $host = get_url_host($url);
            if($host == "ju.taobao.com")
            {
                $div = pq('.item_share');
                echo $div->html();
                $price = $div->attr('data-itemprice');
                $title =  $div->attr('data-itemname');
                $image = $div->attr('data-itempic');      
            }
            else    
            {
                $title = pq("head > title")->text(); 
                //save_to_file(pq('#J_PromoPrice')->html());exit();
                $price = pq('#J_PromoPrice')->text();
                $orginal_price =  pq("#J_StrPrice")->text();
                        
                if( empty($price))
                    $price = $orginal_price;
                else
                {
                    $i_orignal_price =  $orginal_price * 100;
                    $goodsid = substr_between( $url,'id=','&' );
                    $shopid = substr_between( pq('head')->html(),'userid=',';"' );

                    $price = $this->_get_promotion_info($goodsid,$shopid,$i_orignal_price);

                }
                $image = pq('#J_ImgBooth')->attr("src");
            } 
           
         return new BuyRGoods($title,$price,$image);
    } 
    
    
    private function _get_promotion_info($goodsid,$shopid,$price)
    {
        $get_data = "tbviponly=false&price=$price&itemId=$goodsid&sellerId=$shopid&ump=true&maxvip=75&ref=&buyerId=0&nick=";
        $curl = curl_init();
        // 设置你需要抓取的URL
        curl_setopt($curl, CURLOPT_URL, 'http://detailskip.taobao.com/json/promotionList.htm?'.$get_data);
        // 设置header
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt ($curl,CURLOPT_REFERER,'http://item.taobao.com/item.htm');
        // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // 运行cURL，请求网页
        $data = curl_exec($curl);
        curl_close($curl);

        $pos_s = strpos($data, 'price: "' );
        $pos_s += 8;
        $pos_e = strpos($data, '"',$pos_s );
        return substr($data, $pos_s,$pos_e-$pos_s);
    }
}

class UrlParseFactory
{
    static function get_parse($type)
    {
        switch ($type)
        {
            case "taobao" : 
                return new TaobaoUrlParse;
            break;    
        }
        
    }

    
}

class BuyRGoodsController
{
    public function actionGetGoodsInfo($url)
    {
        set_time_limit(0);
        $url = $_POST["item_url"];
        $goods = BuyRGoods::get_goods($url);
        $results = array('code' => '','msg' => array());
        if($goods)
        {
            $results['code'] = 0;
            $results['msg'] = $goods->to_array();
        }
        else
            $results['code'] = 1;
        echo json_encode($results);
        //return BuyRGoods::get_goods($url);
    }
    
    
}

?>
