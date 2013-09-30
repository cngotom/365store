
function getsite(){
                $('#g').attr("disabled","disabled");
                $('#g').val("数据读取中")
                $.ajax({
                    type: "post",
                    url: "/BuyRGoods/GetGoodsInfo/url",
                    data: "item_url="+ escape($('#url').val()) +"",
                    dataType:"json",
                    success: function(msg){
                        $('#g').attr("disabled","");
                        $('#g').val("获取")
                        if (msg.code==0)  {
                            var msg = msg.msg;
                            var imghtml = '<img src="'+ msg.image +'" style="height:120px; height:100px;"/>';
                            $('#pname').html(msg.title);
                            //$('#cf').html(msg.cf);
                            $('#pmoney').html("<span class=\"uni\">￥</span>"+msg.price);
                            $('#pImg').html(imghtml);
                            $('#ptitle').val(msg.title);
                            $('#tmoney').val(msg.price);
                            $('#purl').val($('#url').val());
                            msg.express_fee = 10;
                            var pm =msg.price ;
                            var epm = parseFloat(msg.express_fee);
                            if (epm>0){$('#allmoney').val(parseFloat(pm) + epm);$('#yunfei').val(epm);}else{$('#allmoney').val(parseFloat(pm) + 15);$('#yunfei').val(15);}
                            $('#yf').val(epm);
                            $('.r_bd').css("display","");
                            var mymm = $('#mmmm').val();
                            var amo = $('#allmoney').val();
                            //alert("mymm"+ mymm + "amo" + amo);
                           // if (parseFloat(mymm)>= parseFloat(amo))
                            {$('#s').attr("disabled","");$('#s').val("提交订单")}
                           // else{
                           // $('#s').attr("disabled","disabled");$('#s').val("您的账户余额不够购买此产品")
                            //}
                          }
                          else {
                              if(msg.code == 1)
                                alert("不支持该数据");
                          }
                        }
                   } );}
function jianCount(){
var ms = parseFloat($('#tmoney').val());
var cont = parseFloat($('#snum').val())-1;
var yf = parseFloat($('#yf').val());
if (yf!="" && yf>0 ){
if (cont ==0 ){cont==1;$('#yunfei').val(yf);}else{cont=cont ;$('#yunfei').val(yf + 2*(cont -1));}
if (cont >= 1 ){$('#allmoney').val(((cont)*ms)+yf );$('#snum').val((cont));}
}else
{
if (cont ==0 ){cont==1;$('#yunfei').val(15);}else{cont=cont ;$('#yunfei').val(15 + 2*(cont -1));}
if (cont >= 1 ){$('#allmoney').val(((cont)*ms)+15 );$('#snum').val((cont));}
}
var mymm = $('#mmmm').val();
//if (parseFloat(mymm)>= parseFloat($('#allmoney').val())){$('#s').attr("disabled","");$('#s').val("提交订单")}
//else{$('#s').attr("disabled","disabled");$('#s').val("您的账户余额不够购买此产品")}
}
function addCount(){
var ms = parseFloat($('#tmoney').val());
var cont = parseFloat($('#snum').val())+1;
var yf = parseFloat($('#yf').val());
if (yf!="" && yf>0 ){
if (cont>= 1){$('#allmoney').val(((cont)*ms)+yf + 2*(cont -1) );$('#snum').val((cont));}
if (cont== 1) {$('#yunfei').val(yf);}else{$('#yunfei').val(yf + 2*(cont-1));}
}else
{
if (cont>= 1){$('#allmoney').val(((cont)*ms)+15 + 2*(cont -1) );$('#snum').val((cont));}
if (cont== 1) {$('#yunfei').val(15 );}else{$('#yunfei').val(15 + 2*(cont-1));}
}
var mymm = $('#mmmm').val();
//if (parseFloat(mymm)>= parseFloat($('#allmoney').val())){$('#s').attr("disabled","");}
//else{$('#s').attr("disabled","disabled");$('#s').val("您的账户余额不够购买此产品")}
}
function ckpost()
{
if (confirm('您确定您的订单填写无误了哦？')) {
document.form1.submit();
}
else {
return false;
}
} 
