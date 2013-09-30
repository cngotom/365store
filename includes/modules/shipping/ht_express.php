<?php

/**
 * ECSHOP 汇通快递 配送方式插件
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

$shipping_lang = ROOT_PATH.'languages/' .$GLOBALS['_CFG']['lang']. '/shipping/ht_express.php';

if (file_exists($shipping_lang))
{
    global $_LANG;
    include_once($shipping_lang);
}

/* 模块的基本信息 */
if (isset($set_modules) && $set_modules == TRUE)
{
    $i = (isset($modules)) ? count($modules) : 0;

    /* 配送方式插件的代码必须和文件名保持一致 */
    $modules[$i]['code']    = basename(__FILE__, '.php');

    $modules[$i]['version'] = '1.0.0';

    /* 配送方式的描述 */
    $modules[$i]['desc']    = 'ht_express_desc';

    /* 配送方式是否支持货到付款 */
    $modules[$i]['cod']     = false;

    /* 插件的作者 */
    $modules[$i]['author']  = '365';

    /* 插件作者的官方网站 */
    $modules[$i]['website'] = 'http://www.365store.cn';

    /* 配送接口需要的参数 */
    $modules[$i]['configure'] = array(
                                    array('name' => 'item_fee',     'value'=>10),   /* 单件商品的配送价格 */
                                    array('name' => 'base_fee',    'value'=>15), /* 1000克以内的价格           */
                                    array('name' => 'step_fee',     'value'=>2),  /* 续重每1000克增加的价格 */
                                );

    return;
}

/**
 * 汇通快递费用计算方式: 起点到终点 * 重量(kg)
 * ====================================================================================
 * -浙江，上海，江苏地区为5元/公斤，续重(2元/公斤)
 * -续重每500克或其零数 (具体请上汇通快递网站查询:http://www.htky365.com)
 *
 * -------------------------------------------------------------------------------------
 */

class ht_express
{
    /*------------------------------------------------------ */
    //-- PUBLIC ATTRIBUTEs
    /*------------------------------------------------------ */

    /**
     * 配置信息参数
     */
    var $configure;

    /*------------------------------------------------------ */
    //-- PUBLIC METHODs
    /*------------------------------------------------------ */

    /**
     * 构造函数
     *
     * @param: $configure[array]    配送方式的参数的数组
     *
     * @return null
     */
    function ht_express($cfg=array())
    {
        foreach ($cfg AS $key=>$val)
        {
            $this->configure[$val['name']] = $val['value'];
        }

    }

    /**
     * 计算订单的配送费用的函数
     *
     * @param   float   $goods_weight   商品重量
     * @param   float   $goods_amount   商品金额
     * @return  decimal
     */
    function calculate($goods_weight, $goods_amount)
    {
        if ($this->configure['free_money'] > 0 && $goods_amount >= $this->configure['free_money'])
        {
            return 0;
        }
        else
        {
            @$fee = $this->configure['base_fee'];
            $this->configure['fee_compute_mode'] = !empty($this->configure['fee_compute_mode']) ? $this->configure['fee_compute_mode'] : 'by_weight';

            if ($this->configure['fee_compute_mode'] == 'by_number')
            {
                $fee = $goods_number * $this->configure['item_fee'];
            }
            else
            {
                if ($goods_weight > 2)
                {
                    $fee += (ceil(($goods_weight - 2))) * $this->configure['step_fee'];
                }
            }
            
            if($goods_weight == 0)
                $fee = 0;   
            return $fee;
        }
    }

    /**
     * 查询快递状态
     *
     * @access  public
     * @return  string  查询窗口的链接地址
     */
    function query($invoice_sn)
    {
        $form_str = '<form style="margin:0px" methods="post" '.
            'action="http://www.htky365.com/track/index.html" name="inputNumber=' .$invoice_sn. '" target="_blank">'.$invoice_sn
            .'<input type="hidden" name="inputNumber" value="' .str_replace("<br>","\n",$invoice_sn). '" />'.
            '<a style="color:red" href="javascript:document.forms[\'inputNumber=' .$invoice_sn. '\'].submit();">  点击查看 </a>'.
            '</form>';

        return $form_str;
    }
}

?>
