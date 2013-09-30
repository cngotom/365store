/* $Id : shopping_flow.js 4865 2007-01-31 14:04:10Z paulgao $ */

var selectedShipping = null;
var selectedPayment  = null;
var selectedPack     = null;
var selectedCard     = null;
var selectedSurplus  = '';
var selectedBonus    = 0;
var selectedIntegral = 0;
var selectedOOS      = null;
var alertedSurplus   = false;
var selAddressId = null;
var groupBuyShipping = null;
var groupBuyPayment  = null;



//编辑窗口是否打开
var isConsigneeOpen=false;
var isPayTypeAndShipTypeOpen=false;


//发票
var invoice_title = null;
var invoice_type =　null;
var invoice_content =　null;

function getFormXmlBySign(sign)
{
  var xmlDoc="";
    var eList=document.getElementsByTagName("input");
    for(var i=0;i<eList.length;i++)
    {                  
		if( eList[i].id == "" )
			continue;
		if(isDataControl(eList[i].id,sign))
		{
		    var columnName=getDataColumnName(eList[i].id,sign);
		    if(eList[i].type=="checkbox" || eList[i].type=="radio")
		    {
		       if(eList[i].checked)
			   {
			      xmlDoc+="<"+columnName+">1</"+columnName+">";
			   }else
			   {  xmlDoc+="<"+columnName+">0</"+columnName+">";}
		    }else
		    {
				
				xmlDoc+="<"+columnName+"><![CDATA["+eList[i].value+"]]></"+columnName+">";		    
				columnName=null;
			}
		}			
    }
    eList=document.getElementsByTagName("select");
    for(var i=0;i<eList.length;i++)
    {        
    	if( eList[i].id == "" )
			continue;
          
		if(isDataControl(eList[i].id,sign))
		{
		    var columnName=getDataColumnName(eList[i].id,sign);
			xmlDoc+="<"+columnName+"><![CDATA["+eList[i].value+"]]></"+columnName+">";		    
			columnName=null;
		}			
    }
    eList=document.getElementsByTagName("textarea");
    for(var i=0;i<eList.length;i++)
    {           
    	if( eList[i].id == "" )
			continue;
       
		if(isDataControl(eList[i].id,sign))
		{
		    var columnName=getDataColumnName(eList[i].id,sign);
			xmlDoc+="<"+columnName+"><![CDATA["+eList[i].value+"]]></"+columnName+">";		    
			columnName=null;
		}			
    }
	return xmlDoc;   
}
function getFormXml()
{   
    return getFormXmlBySign('t_');
}
function isDataControl(controlId,sign){if(controlId.substring(0,sign.length)==sign){return true;}else{return false;}}
function getDataColumnName(controlId,sign){return controlId.substr(sign.length);} 


function g(nodeId)
{
    return document.getElementById(nodeId);
} 

function clearWaitInfo()
{
    var newd=g("waitInfo");
    if(newd!=null)
    {
        newd.parentNode.removeChild(newd);
    }
} 
function showWaitInfo(info,obj)
{
    try{
    if(obj==null)return;
    clearWaitInfo();
    var newd=document.createElement("span");
    newd.className='waitInfo';
    newd.id='waitInfo';
    newd.innerHTML=info;
    obj.parentNode.appendChild(newd);
    }catch(e){}
} 

//ajax回调函数
function ajaxConsigneeResponse(domId,result)
{
    if(result.code == 0)
    {
        g(domId).innerHTML   =  result.content;
    }
    else
    {
        alert(result.error);
    }
    
}

//显示地址信息表单
var label_consignee;
function showForm_consignee(obj)
{
   selAddressId=0;
   label_consignee=g("part_consignee").innerHTML;
   showWaitInfo('正在读取收货人信息，请等待！',obj);
   Ajax.call('flow.php', 'act=showForm_consignee' , function(result){  ajaxConsigneeResponse('part_consignee',result);  clearWaitInfo();   showAreaInfo(); isConsigneeOpen = true;     }  , 'GET', 'JSON');
}
function close_consignee(obj)
{
    if(label_consignee!=null)
        g("part_consignee").innerHTML= label_consignee;
    else{
        Ajax.call('flow.php?act=getConsigneeInfo','', function(result){  ajaxConsigneeResponse('part_consignee',result);isConsigneeOpen = false;  }, 'POST', 'JSON');
    }
}
function savePart_consignee(obj)
{
     clearSubmitError(obj);
     if(check_con())
         {
            var x=getFormXmlBySign('consignee_');
            Ajax.call('flow.php?act=savePart','data=<table>'+x+'<addressAll><![CDATA['+g('consigneeShow_addressName').innerHTML+g('consignee_address').value+']]></addressAll></table>', function(result){  ajaxConsigneeResponse('part_consignee',result);  isConsigneeOpen = false; updateTotalFee();showForm_payTypeAndShipType(this);}, 'POST', 'JSON');
      
        }
}
function changeConsignee(obj,id) 
{
    if(g('addrIi'+selAddressId)!=null)
        g('addrIi'+selAddressId).className='';
    selAddressId=id; 
    g('addrIi'+selAddressId).className='xz';
   Ajax.call('flow.php?act=changeConsignee', 'address_id='+id , function(result){  ajaxConsigneeResponse('consignee_addr',result);  showAreaInfo();      }, 'GET', 'JSON');
}

function DelAddress(obj,id) 
{
   Ajax.call('flow.php?act=DelAddress', 'address_id='+id , function(result){  ajaxConsigneeResponse('part_consignee',result);  }, 'GET', 'JSON');
}

function addNewAddress(obj)
{
     //  var consignee = new Object();
    clearSubmitError(obj);
    if(check_con())
    {
        var x=getFormXmlBySign('consignee_');
        Ajax.call('flow.php?act=addNewAddress','data=<table>'+x+'<addressAll><![CDATA['+g('consigneeShow_addressName').innerHTML+g('consignee_address').value+']]></addressAll></table>',  function(result){  ajaxConsigneeResponse('addressListPanel',result);  }, 'POST', 'JSON');
    }
}


function savePart_payAndShipping(obj)
{
    if(isConsigneeOpen)
     {  
        alert("请先选择并保存配送地址");
        return ;
     }
     else
    {
       var x=getFormXmlBySign('payType_');
       Ajax.call('flow.php?act=savePayAndShipping', 'data=<table>'+x+'</table>', function(result){  ajaxConsigneeResponse('part_payTypeAndShipType',result);  updateTotalFee();isPayTypeAndShipTypeOpen=false;    }  , 'POST', 'JSON');
    }
}

function showAreaInfo()
{
    var _info='';
    var areaList=g('consignee_arae').children;
  //  _info+=(areaList[0].value=='0')?"":areaList[0].options[areaList[0].selectedIndex].text.replace('*','');
    _info+=(areaList[1].value=='0')?"":areaList[1].options[areaList[1].selectedIndex].text.replace('*','');
    _info+=(areaList[2].value=='0')?"":areaList[2].options[areaList[2].selectedIndex].text.replace('*','');
    if(areaList.length==4){
    _info+=(areaList[3].value=='0')?"":areaList[3].options[areaList[3].selectedIndex].text.replace('*','');
    }
    g('consigneeShow_addressName').innerHTML=_info;
} 
function updatelocalTotalFee(result)
{
       ajaxConsigneeResponse('part_payDetail',result); 
       if(result.code==0 && result.totalfee)
       { g("total_fee").innerHTML=  "￥"+result.totalfee };     
}
function updateTotalFee()
{
      Ajax.call('flow.php', 'act=updateTotalFee' ,updatelocalTotalFee  , 'GET', 'JSON');

}
//支付和配送方式
var label_payTypeAndShip;
function showForm_payTypeAndShipType(obj)
{
   label_payTypeAndShip=g("part_payTypeAndShipType").innerHTML;
   showWaitInfo('正在读取收货人信息，请等待！',obj);
   Ajax.call('flow.php', 'act=ShowForm_payTypeAndShip' , function(result){  ajaxConsigneeResponse('part_payTypeAndShipType',result);  clearWaitInfo();   isPayTypeAndShipTypeOpen=true;  check_safe_ratio('shipping');  }  , 'GET', 'JSON');
}
function close_payTypeAndShip(obj)
{
    if(label_payTypeAndShip!==null)
         g("part_payTypeAndShipType").innerHTML= label_payTypeAndShip;
    else{
        Ajax.call('flow.php?act=get_payTypeAndShipInfo','', function(result){  ajaxConsigneeResponse('part_payTypeAndShipType',result); clearWaitInfo(); isPayTypeAndShipTypeOpen=false;}, 'GET', 'JSON');
    }
}



/* *
 * 改变配送方式
 */


function selectShipping(obj)
{
   g('payType_IdShipmentType').value = obj.value; 
  if (selectedShipping == obj)
  {
    return;
  }
  else
  {
    selectedShipping = obj;
  }

  //Ajax.call('flow.php?step=select_shipping', 'shipping=' + obj.value, orderShippingSelectedResponse, 'GET', 'JSON');
}

/**
 *
 */
function orderShippingSelectedResponse(result)
{
  if (result.need_insure)
  {
    try
    {
      document.getElementById('ECS_NEEDINSURE').checked = true;
    }
    catch (ex)
    {
      alert(ex.message);
    }
  }

  try
  {
    if (document.getElementById('ECS_CODFEE') != undefined)
    {
      document.getElementById('ECS_CODFEE').innerHTML = result.cod_fee;
    }
  }
  catch (ex)
  {
    alert(ex.message);
  }

  orderSelectedResponse(result);
}

/* *
 * 改变支付方式
 */
var showPayDivID;
function selectPayment(obj,id)
{
    
   //close all
    //id = 'pay_show_' + id;
    g('payType_IdPaymentType').value = obj.value;
    if(showPayDivID)
        g(showPayDivID).style.display='none';
   if(g(id).style.display=='none')
   {
       g(id).style.display='';
       showPayDivID = id;
   }
}
/* *
 * 团购购物流程 --> 改变配送方式
 */
function handleGroupBuyShipping(obj)
{
  if (groupBuyShipping == obj)
  {
    return;
  }
  else
  {
    groupBuyShipping = obj;
  }

  var supportCod = obj.attributes['supportCod'].value + 0;
  var theForm = obj.form;

  for (i = 0; i < theForm.elements.length; i ++ )
  {
    if (theForm.elements[i].name == 'payment' && theForm.elements[i].attributes['isCod'].value == '1')
    {
      if (supportCod == 0)
      {
        theForm.elements[i].checked = false;
        theForm.elements[i].disabled = true;
      }
      else
      {
        theForm.elements[i].disabled = false;
      }
    }
  }

  if (obj.attributes['insure'].value + 0 == 0)
  {
    document.getElementById('ECS_NEEDINSURE').checked = false;
    document.getElementById('ECS_NEEDINSURE').disabled = true;
  }
  else
  {
    document.getElementById('ECS_NEEDINSURE').checked = false;
    document.getElementById('ECS_NEEDINSURE').disabled = false;
  }

  Ajax.call('group_buy.php?act=select_shipping', 'shipping=' + obj.value, orderSelectedResponse, 'GET');
}

/* *
 * 团购购物流程 --> 改变支付方式
 */
function handleGroupBuyPayment(obj)
{
  if (groupBuyPayment == obj)
  {
    return;
  }
  else
  {
    groupBuyPayment = obj;
  }

  Ajax.call('group_buy.php?act=select_payment', 'payment=' + obj.value, orderSelectedResponse, 'GET');
}

/* *
 * 改变商品包装
 */
function selectPack(obj)
{
  if (selectedPack == obj)
  {
    return;
  }
  else
  {
    selectedPack = obj;
  }

  Ajax.call('flow.php?step=select_pack', 'pack=' + obj.value, orderSelectedResponse, 'GET', 'JSON');
}

/* *
 * 改变祝福贺卡
 */
function selectCard(obj)
{
  if (selectedCard == obj)
  {
    return;
  }
  else
  {
    selectedCard = obj;
  }

  Ajax.call('flow.php?step=select_card', 'card=' + obj.value, orderSelectedResponse, 'GET', 'JSON');
}

/* *
 * 选定了配送保价
 */
function selectInsure(needInsure)
{
  needInsure = needInsure ? 1 : 0;

  Ajax.call('flow.php?step=select_insure', 'insure=' + needInsure, orderSelectedResponse, 'GET', 'JSON');
}

/* *
 * 团购购物流程 --> 选定了配送保价
 */
function handleGroupBuyInsure(needInsure)
{
  needInsure = needInsure ? 1 : 0;

  Ajax.call('group_buy.php?act=select_insure', 'insure=' + needInsure, orderSelectedResponse, 'GET', 'JSON');
}

/* *
 * 回调函数
 */
function orderSelectedResponse(result)
{
  if (result.error)
  {
    alert(result.error);
    location.href = './';
  }

  try
  {
    g("total_fee").innerHTML=  "￥"+ result.totalfee;
  }
  catch (ex) { }
}

/* *
 * 改变余额
 */
function changeSurplus(val)
{
  if (selectedSurplus == val)
  {
    return;
  }
  else
  {
    selectedSurplus = val;
  }

  Ajax.call('flow.php?step=change_surplus', 'surplus=' + val, changeSurplusResponse, 'GET', 'JSON');
}

/* *
 * 改变余额回调函数
 */
function changeSurplusResponse(obj)
{
  if (obj.error)
  {
    try
    {
      document.getElementById("ECS_SURPLUS_NOTICE").innerHTML = obj.error;
      document.getElementById('ECS_SURPLUS').value = '0';
      document.getElementById('ECS_SURPLUS').focus();
    }
    catch (ex) { }
  }
  else
  {
    try
    {
      document.getElementById("ECS_SURPLUS_NOTICE").innerHTML = '';
    }
    catch (ex) { }
    orderSelectedResponse(obj.content);
  }
}

/* *
 * 改变积分
 */
function changeIntegral(val)
{
  if (selectedIntegral == val)
  {
    return;
  }
  else
  {
    selectedIntegral = val;
  }

  Ajax.call('flow.php?step=change_integral', 'points=' + val, changeIntegralResponse, 'GET', 'JSON');
}

/* *
 * 改变积分回调函数
 */
function changeIntegralResponse(obj)
{
  if (obj.error)
  {
    try
    {
      document.getElementById('ECS_INTEGRAL_NOTICE').innerHTML = obj.error;
      document.getElementById('ECS_INTEGRAL').value = '0';
      document.getElementById('ECS_INTEGRAL').focus();
    }
    catch (ex) { }
  }
  else
  {
    try
    {
      document.getElementById('ECS_INTEGRAL_NOTICE').innerHTML = '';
    }
    catch (ex) { }
    orderSelectedResponse(obj.content);
  }
}

/* *
 * 改变红包
 */
function changeBonus(val)
{
  if (selectedBonus == val)
  {
    return;
  }
  else
  {
    selectedBonus = val;
  }

  Ajax.call('flow.php?act=changeBonus', 'bonus=' + val, updatelocalTotalFee , 'GET', 'JSON');
}

/**
 * 验证红包序列号
 * @param string bonusSn 红包序列号
 */
function validateBonus()
{
  bonusSn = g('valid_bonus_sn').value;//bonusSn
  Ajax.call('flow.php?act=validateBonus', 'bonus_sn=' + bonusSn,function(result){ updatelocalTotalFee(result);   document.getElementsByName('bonus')[0].selectedIndex = 0;  selectedBonus =0;   }, 'GET', 'JSON');
}

function validateBonusResponse(obj)
{

if (obj.code)
  {
    alert(obj.content);
  }
  else
  {
    updateTotalFee();
  }
}

/* *
 * 改变发票的方式
 */
function changeNeedInv()
{
  var obj        = document.getElementById('ECS_NEEDINV');
  var objType    = document.getElementById('ECS_INVTYPE');
  var objPayee   = document.getElementById('ECS_INVPAYEE');
  var objContent = document.getElementById('ECS_INVCONTENT');
  var needInv    = obj.checked ? 1 : 0;
  var invType    = obj.checked ? (objType != undefined ? objType.value : '') : '';
  var invPayee   = obj.checked ? objPayee.value : '';
  var invContent = obj.checked ? objContent.value : '';
  objType.disabled = objPayee.disabled = objContent.disabled = ! obj.checked;
  if(objType != null)
  {
    objType.disabled = ! obj.checked;
  }

  Ajax.call('flow.php?step=change_needinv', 'need_inv=' + needInv + '&inv_type=' + encodeURIComponent(invType) + '&inv_payee=' + encodeURIComponent(invPayee) + '&inv_content=' + encodeURIComponent(invContent), orderSelectedResponse, 'GET');
}

/* *
 * 改变发票的方式
 */
function groupBuyChangeNeedInv()
{
  var obj        = document.getElementById('ECS_NEEDINV');
  var objPayee   = document.getElementById('ECS_INVPAYEE');
  var objContent = document.getElementById('ECS_INVCONTENT');
  var needInv    = obj.checked ? 1 : 0;
  var invPayee   = obj.checked ? objPayee.value : '';
  var invContent = obj.checked ? objContent.value : '';
  objPayee.disabled = objContent.disabled = ! obj.checked;

  Ajax.call('group_buy.php?act=change_needinv', 'need_idv=' + needInv + '&amp;payee=' + invPayee + '&amp;content=' + invContent, null, 'GET');
}

/* *
 * 改变缺货处理时的处理方式
 */
function changeOOS(obj)
{
  if (selectedOOS == obj)
  {
    return;
  }
  else
  {
    selectedOOS = obj;
  }

  Ajax.call('flow.php?step=change_oos', 'oos=' + obj.value, null, 'GET');
}

/* *
 * 检查提交的订单表单
 */
function checkOrderForm(frm)
{
  var paymentSelected = false;
  var shippingSelected = false;

  // 检查是否选择了支付配送方式
  for (i = 0; i < frm.elements.length; i ++ )
  {
    if (frm.elements[i].name == 'shipping' && frm.elements[i].checked)
    {
      shippingSelected = true;
    }

    if (frm.elements[i].name == 'payment' && frm.elements[i].checked)
    {
      paymentSelected = true;
    }
  }

  if ( ! shippingSelected)
  {
    alert(flow_no_shipping);
    return false;
  }

  if ( ! paymentSelected)
  {
    alert(flow_no_payment);
    return false;
  }

  // 检查用户输入的余额
  if (document.getElementById("ECS_SURPLUS"))
  {
    var surplus = document.getElementById("ECS_SURPLUS").value;
    var error   = Utils.trim(Ajax.call('flow.php?step=check_surplus', 'surplus=' + surplus, null, 'GET', 'TEXT', false));

    if (error)
    {
      try
      {
        document.getElementById("ECS_SURPLUS_NOTICE").innerHTML = error;
      }
      catch (ex)
      {
      }
      return false;
    }
  }

  // 检查用户输入的积分
  if (document.getElementById("ECS_INTEGRAL"))
  {
    var integral = document.getElementById("ECS_INTEGRAL").value;
    var error    = Utils.trim(Ajax.call('flow.php?step=check_integral', 'integral=' + integral, null, 'GET', 'TEXT', false));

    if (error)
    {
      return false;
      try
      {
        document.getElementById("ECS_INTEGRAL_NOTICE").innerHTML = error;
      }
      catch (ex)
      {
      }
    }
  }
  frm.action = frm.action + '?step=done';
  return true;
}

/* *
 * 检查收货地址信息表单中填写的内容
 */
function checkConsignee(frm)
{
  var msg = new Array();
  var err = false;

  if (frm.elements['country'] && frm.elements['country'].value == 0)
  {
    msg.push(country_not_null);
    err = true;
  }

  if (frm.elements['province'] && frm.elements['province'].value == 0 && frm.elements['province'].length > 1)
  {
    err = true;
    msg.push(province_not_null);
  }

  if (frm.elements['city'] && frm.elements['city'].value == 0 && frm.elements['city'].length > 1)
  {
    err = true;
    msg.push(city_not_null);
  }

  if (frm.elements['district'] && frm.elements['district'].length > 1)
  {
    if (frm.elements['district'].value == 0)
    {
      err = true;
      msg.push(district_not_null);
    }
  }

  if (Utils.isEmpty(frm.elements['consignee'].value))
  {
    err = true;
    msg.push(consignee_not_null);
  }

  if ( ! Utils.isEmail(frm.elements['email'].value))
  {
    err = true;
    msg.push(invalid_email);
  }

  if (frm.elements['address'] && Utils.isEmpty(frm.elements['address'].value))
  {
    err = true;
    msg.push(address_not_null);
  }

  if (frm.elements['zipcode'] && frm.elements['zipcode'].value.length > 0 && (!Utils.isNumber(frm.elements['zipcode'].value)))
  {
    err = true;
    msg.push(zip_not_num);
  }

  if (Utils.isEmpty(frm.elements['tel'].value))
  {
    err = true;
    msg.push(tele_not_null);
  }
  else
  {
    if (!Utils.isTel(frm.elements['tel'].value))
    {
      err = true;
      msg.push(tele_invaild);
    }
  }

  if (frm.elements['mobile'] && frm.elements['mobile'].value.length > 0 && (!Utils.isTel(frm.elements['mobile'].value)))
  {
    err = true;
    msg.push(mobile_invaild);
  }

  if (err)
  {
    message = msg.join("\n");
    alert(message);
  }
  return ! err;
}
//发票

function showTicket()
{
   if(g('invoice_panl_ticket').style.display=='none')
   {
       g('invoice_panl_ticket').style.display='';
   }else{
       g('invoice_panl_ticket').style.display='none';
   }
   setCouponStateShow();
}



function showPanel(id)
{   
    
    stateShow = 'couponStateShow_' + id
    id = 'invoice_panl_' + id;
 
   if(g(id).style.display=='none')
   {
       g(id).style.display='';
   }else{
       g(id).style.display='none';
   }
  
   if(g(id).style.display != 'none')
  {
     g(stateShow).innerHTML='-';
  }
  else
  {
      g(stateShow).innerHTML='+';
  }
}
function showForm_remark()
{
    if(g('order_extra_info').style.display=='none')
   {
       g('order_extra_info').style.display='';
         g('order_extra_info_tips').style.display='';
       
   }else{
       g('order_extra_info').style.display='none';
       g('order_extra_info_tips').style.display='none';
   }
}


function save_invoice_extra()
{
    var invoiceExtra = new Object();
    invoiceExtra.extra = g('order_extra_info').value;;
    invoiceExtra.invocie_title  = g('input_invoice_title').value;
    invoiceExtra.invoice_type  =  invoice_type   ;     
    invoiceExtra.invoice_content = invoice_content;
    Ajax.call('flow.php?act=saveInvoiceExtra', invoiceExtra ,function(result){  }  , 'GET', 'JSON');
  //  invoice_head  =                      
   // invoice_content = 
  //  invoice_head = 
    
    
}


//-------------------------提交订单信息-----------------

//显示提示信息
function showAlert(info,obj,infoSign)
{
   if(g(infoSign)!=null){return;}
   var newd=document.createElement("span");
   newd.id=infoSign;
   newd.className='alertInfo';
   newd.innerHTML=info;
   obj.appendChild(newd);
}
//删除提示信息
function removeAlert(infoSign)
{
   if(g(infoSign)==null){return;}
   g(infoSign).parentNode.removeChild(g(infoSign));
}
function check_submit_isClose()
{
   var errInfo="";
   //检查是否都关闭
   if(isConsigneeOpen){errInfo+="“收货人信息”";}
   if(isPayTypeAndShipTypeOpen){if(errInfo!=''){errInfo+=",";}errInfo+="“支付方式及配送方式”";}
   if(errInfo!="")
   {
      showAlert("请先保存"+errInfo,g("submit_error"),"")
      return false;
   }
   return true;
}
function check_submit()
{
   var res=true;
   if(!check_submit_isClose())
   {
      res=false;
   }
   return res;
}
function submit_order()
{
    g("submit_error").innerHTML='';
    if(check_submit())
    {
        save_invoice_extra();
        self.location = "flow.php?step=done";
    }   
}


//非法字符过滤
function is_forbid(temp_str)
{
    temp_str=trimTxt(temp_str);
	temp_str = temp_str.replace('*',"@");
	temp_str = temp_str.replace('--',"@");
	temp_str = temp_str.replace('/',"@");
	temp_str = temp_str.replace('+',"@");
	temp_str = temp_str.replace('\'',"@");
	temp_str = temp_str.replace('\\',"@");
	temp_str = temp_str.replace('$',"@");
	temp_str = temp_str.replace('^',"@");
	temp_str = temp_str.replace('.',"@");
	temp_str = temp_str.replace('#',"@");
	//temp_str = temp_str.replace('(',"@");
	//temp_str = temp_str.replace(')',"@");
	//temp_str = temp_str.replace(',',"@");
	temp_str = temp_str.replace(';',"@");
	temp_str = temp_str.replace('<',"@");
	temp_str = temp_str.replace('>',"@");
	//temp_str = temp_str.replace('?',"@");
	temp_str = temp_str.replace('"',"@");
	temp_str = temp_str.replace('=',"@");
	temp_str = temp_str.replace('{',"@");
	temp_str = temp_str.replace('}',"@");
	//temp_str = temp_str.replace('[',"@");
	//temp_str = temp_str.replace(']',"@");
	var forbid_str=new String('@,%,~,&');
	var forbid_array=new Array();
	forbid_array=forbid_str.split(',');
	for(i=0;i<forbid_array.length;i++)
	{
		if(temp_str.search(new RegExp(forbid_array[i])) != -1)
		return false;
	}
	return true;
}
function checknumber(String) 
{ 
    if(trimTxt(String)=="")
    {
       return false;
    }
    var Letters = "1234567890"; 
    var i; 
    var c; 
    for( i = 0; i < String.length; i ++ ) 
    { 
        c = String.charAt( i ); 
        if (Letters.indexOf( c ) ==-1) 
        { 
           return false; 
        } 
    } 
    return true; 
} 
function trimTxt(txt)
{
   return txt.replace(/(^\s*)|(\s*$)/g, "");
}
//检查是否为空
function isEmpty(inputId)
{
   if(trimTxt(g(inputId).value)==''){return true}
   return false;
}
function clearSubmitError(obj)
{
   if(obj.parentNode.childNodes.length>0){
    if(obj.parentNode.lastChild.name=='errorInfo')
    {
        obj.parentNode.removeChild(obj.parentNode.lastChild);
    }
   }
}
//保存收货人信息时的检查
function check_con()
{
   var res=true;
   if(!check_addressName()){res=false;}
   if(!check_con_address()){res=false;}
   if(!check_address()){res=false;}
   if(!check_zipcode()){res=false;}
   if(!check_phoneAndMob()){res=false;}
   if(!check_phone()){res=false;}
   if(!check_message()){res=false;}
   if(!check_email()){res=false;}
   
   return res;
}
//检查收货人姓名
function check_addressName()
{  
   removeAlert('addressName_empty');
   removeAlert('addressName_ff');
   
   var pNode=g('consignee_consignee').parentNode;
   if(isEmpty('consignee_consignee')){showAlert('收货人姓名不能为空！',pNode,'addressName_empty');return false;}
   if(!is_forbid(g('consignee_consignee').value)){showAlert(ffAlertTxt,pNode,'addressName_ff');return false;}
   return true;
}
//检查省市区
function check_con_area()
{
   removeAlert('area_check');
   if(g('consignee_arae').children[2].value=='0')
   {
      showAlert('地区信息不完整！',g('consignee_arae').parentNode,'area_check')
      return false;
   }
   return true;
}//检查省市区
function check_con_town()
{
   removeAlert('area_check');
   if(g('consignee_arae').children[3].value=='0')
   {
      showAlert('地区信息不完整！',g('consignee_arae').parentNode,'area_check')
      return false;
   }
   return true;
}

//检查收货地址
function check_con_address()
{
   if(g('consignee_arae').childNodes.length==3){
       return check_con_area();
   }
   else{
       return check_con_town();
   }
}
//检查收货人地址
function check_address()
{  
   removeAlert('address_empty');
   removeAlert('address_ff');
   
   var pNode=g('consignee_address').parentNode;
   if(isEmpty('consignee_address')){showAlert('收货地址不能为空！',pNode,'address_empty');return false;}
   if(!is_forbid(g('consignee_address').value)){showAlert(ffAlertTxt,pNode,'address_ff');return false;}
   return true;
}
//检查邮政编码
function check_zipcode()
{  
   removeAlert('zipcode_ff');
   if(g('consignee_zipcode').value!=''){
   var pNode=g('consignee_zipcode').parentNode;
   var myReg=/(^\s*)\d{6}(\s*$)/;
   if(!myReg.test(g('consignee_zipcode').value)){showAlert('邮编格式不正确',pNode,'zipcode_ff');return false;}
   }
   return true;
}
//检查联系电话
function check_phone()
{  
   removeAlert('phone_ff');
   
   var pNode=g('consignee_tel').parentNode;
   //var myReg=/((\d+)|^((\d+)|(\d+)-(\d+)|(\d+)-(\d+)-(\d+)-(\d+))$)/;
   var myReg=/(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$/;
   if(!isEmpty('consignee_tel') && !myReg.test(g('consignee_tel').value)){showAlert('固定电话格式不正确',pNode,'phone_ff');return false;}
   if(!isEmpty('consignee_tel') && g('consignee_tel').value.length > 20 ){showAlert('固定电话格式不正确',pNode,'phone_ff');return false;}
   return true;
}
//检查手机号
function check_message()
{  
   removeAlert('mobile_ff');
   if(g('consignee_mobile').value!=''){
   var pNode=g('consignee_mobile').parentNode;
   var myReg=/(^\s*)(((\(\d{3}\))|(\d{3}\-))?13\d{9}|1\d{10})(\s*$)/;
   if(!myReg.test(g('consignee_mobile').value)){showAlert('手机号格式不正确',pNode,'mobile_ff');return false;}
   }
   return true;
}
//检查电话和手机是否都填写了
function check_phoneAndMob()
{
   removeAlert('phone_empty');
   var pNode=g('consignee_tel').parentNode;
   if(isEmpty('consignee_tel') && isEmpty('consignee_mobile')){showAlert('固定电话和手机号码请至少填写一项！',pNode,'phone_empty');return false;}
   return true;
}
//检查Email
function check_email()
{  
   var iSign='email';
   removeAlert(iSign+'_ff');
   if(g('consignee_'+iSign).value!=''){
   var pNode=g('consignee_'+iSign).parentNode;
   var myReg=/(^\s*)\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*(\s*$)/;
   if(!myReg.test(g('consignee_'+iSign).value)){showAlert('电子邮件格式不正确',pNode,iSign+'_ff');return false;}
   }
   return true;
}

//检查单选框，如果没有选项，则选中第一项
function check_safe_ratio(name)
{
        var safe = false;
        var radios=document.getElementsByName(name);
        for(var i=0;i<radios.length;i++)
        {
            if(radios[i].checked==true)
            {
                safe = true;
            }
        }
        if(!safe)
         {
            radios[0].checked = true;
            selectShipping(radios[0]);
         }
}