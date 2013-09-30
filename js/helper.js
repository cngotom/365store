
//相关信息
function updateCart()
{
        $.get('flow.php?act=get_cart_info',"&random=" + Math.random(),function(result) {               
                var data = $.parseJSON(result);
                $('#CartDiv').html(data.content);
                $('#ltlNum').html(data.num)
              
        });
}
function deleteCart(rec_id)
{
        $.get('flow.php?act=drop_goods',{id:rec_id,random:+ Math.random()},function(result) {
            if(result == 0){
               $("#CartLi").unbind('mouseenter');
               updateCart();
            }
            else
                alert('删除失败') ;  
        });
}
function SearchProduct() {
    var kw = $("#key").val();
    if ( kw == "") {
    $("#key").focus();
        alert("请输入搜索关键字！");
    }
    else {
    location.href = "search.php?keywords=" + encodeURIComponent(kw);
    }
} 
//用户相关信息
 var GUserInfo = new Object();
 GUserInfo = {        
    isLogin : false,
    userName : "" ,
    showInfo : function() {
        alert(GUserInfo.userName);
    }
};

function init_userinfo(username)
{
    GUserInfo.isLogin = true;
    GUserInfo.userName = username;
}

function show_login_dialog()
{
        if( $("#dialog-modal").length == 0 ) 
        {
            $("body").append("<div id='dialog-modal'></div>")
            $.get("/themes/365chi/static/login_form.html?rnd=" + Math.random(),function(data){
                            $("#dialog-modal").html(data);
                            $( "#tabs" ).tabs();
                            LoginValid.init();
                            $( "#dialog:ui-dialog" ).dialog( "destroy" );	
                            $( "#dialog-modal" ).dialog({
                                    height: 340,
                                    width:500,
                                    modal: true
                            })			
                            
                    });
        }
        else
        {
                 $( "#dialog-modal" ).dialog({
                                    height: 340,
                                    width:500,
                                    modal: true
                            })	

        }
}


var UI = new Object();
UI = {
//分享s
Share : {
url: function() {
return encodeURIComponent(top.location.href)
},
title: function() {
return encodeURIComponent(top.document.title)
},
baiduCang: function() {
window.open("http://cang.baidu.com/do/add?it=" + this.title() + "&iu=" + this.url())
},
baishehui: function() {
window.open("http://bai.sohu.com/share/blank/addbutton.do?from=fengyin&link=" + this.url() + "&title=" + this.title())
},
qqBookMark: function() {
window.open("http://shuqian.qq.com/post?from=3&title=" + this.title() + "&uri=" + this.url())
},
qqZone: function() {
window.open("http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=" + this.url())
},
qqT: function() {
window.open("http://v.t.qq.com/share/share.php?url=" + this.url() + "&title=" + this.title())
},
sinaT: function() {
window.open("http://v.t.sina.com.cn/share/share.php?url=" + this.url() + "&title=" + this.title())
},
douban: function() {
window.open("http://www.douban.com/recommend/?url=" + this.url() + "&title=" + this.title())
},
renren: function() {
window.open("http://share.renren.com/share/buttonshare.do?link=" + this.url() + "&title=" + this.title())
},
kaixin: function() {
window.open("http://www.kaixin001.com/repaste/share.php?rtitle=" + this.title() + "&rurl=" + this.url() + "&rcontent=" + this.title())
},
sohuT: function() {
window.open("http://t.sohu.com/third/post.jsp?&url=" + this.url() + "&title=" + this.title() + '&content=utf-8&pic=')
},
Email: function() {
window.open("mailto:?subject=康途团&body=" + this.title() + "" + this.url() + "")
}
}

}



var category_lastShowLayerId = 0;
function showLayer(id){
    timeout=window.setTimeout(function(){
    showFunc(id);
    },250);
}
function notShow(){
    window.clearTimeout(timeout);
    document.getElementById("pic_layer").style.display="none";
}
function showFunc(id){
    if(id!=category_lastShowLayerId){
        var el=document.getElementById("goodsimg_"+id);
        var layerWidth=319;
        var top=0,left=0;
        var width=el.offsetWidth;
        while(el){
            top+=el.offsetTop;
            left+=el.offsetLeft;
            el=el.offsetParent;
        }
        if(layerWidth>(document.body.offsetWidth-(left+width))){
            left=left-layerWidth+2+"px";
        }else{
             left=left+width-2+"px";
        }
        $("#layer_content").html("");
        $("#layer_content").load("/Goods/GetPreview/"+id);
        $("#pic_layer").css({top:top,left:left,display:""});
            category_lastShowLayerId=id;
        }
    else{
        document.getElementById("pic_layer").style.display="";
  
    }
} 
//KTJL.UI END
//订阅和提醒
//提醒
function doReminder(eventid,eventtime)
{
     if( $("#reminder").length == 0 ) 
        {
            $("body").append("<div id='reminder'></div>")
            $.get("/themes/365chi/static/reminder_form.html?rnd=" + Math.random(),function(data){
                           $("#reminder").html(data);
                            $('#reminder input[name="type"]').change(function(){ 
                                 var titles = ['手机号码：','邮件地址：']
                                 $('#reminder .address').html( titles[parseInt(this.value)] );
                            })
                            $('#reminder .loginbtn').click(function(){
                                var no = $('#reminder #reminder_no').val();
                                //clear error
                                $('#reminder .pspt_msg').html('');

                                    if($('#reminder input[name="type"]:checked').val()  )
                                    {
                                           //手机订阅
                                            if( $('#reminder input[name="type"]:checked').val() == "0")
                                            {

                                                reg=/^0{0,1}(13[0-9]|145|15[7-9]|153|156|18[0-9])[0-9]{8}$/i;
                                                if(!reg.test(no)){  

                                                    $('#reminder .type_error').html('请输入正确的手机号');
                                                    return;
                                                }

                                            }
                                            else{
                                                reg=/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/;   
                                                if(!reg.test(no)){        

                                                    $('#reminder .type_error').html('请输入正确的邮箱地址');
                                                    return;
                                                }


                                            }


                                    }
                                    else{
                                        $('#reminder .type_error').html('请选择类型');
                                        return;    
                                    }

                                    var data = {
                                    no_type:$('#reminder input[name="type"]:checked').val() ,
                                        no:no,
                                        act:'add_reminder',
                                        event_id:eventid,
                                        event_time:eventtime              
                                    };

                                    var url = "/subscribe.php";
                                    //form ok
                                    $.post(url, data, function(msg){
                                           if(!msg.code){
                                                alert("放心吧，到时候一定通知您");
                                                $('#reminder').dialog('close')
                                            }
                                           else
                                               alert(msg.content);
                                    }, "json");

                                })			
                              $('#reminder').dialog({
                                        height: 190,
                                        width:454,
                                        modal: true
                                })
                    });
        }
        else{
            $('#reminder').dialog({
                    height: 190,
                    width:454,
                    modal: true
            })
        }
}
//订阅
function doSubscribe()
{
     if( $("#subscribe").length == 0 ) 
        {
            $("body").append("<div id='subscribe'></div>")
            $.get("/themes/365chi/static/subscribe_form.html?rnd=" + Math.random(),function(data){
                            $("#subscribe").html(data);
                            $('#subscribe input[name="type"]').change(function(){ 
                                 var titles = ['手机号码：','邮件地址：']
                                 $('#subscribe .address').html( titles[parseInt(this.value)] );
                            })
                            $('#subscribe .loginbtn').click(function(){
                                var no = $('#subscribe_no').val();
                                //clear error
                                $('#subscribe .pspt_msg').html('');

                                    if($('#subscribe input[name="type"]:checked').val()  )
                                    {
                                           //手机订阅
                                            if( $('#subscribe input[name="type"]:checked').val() == "0")
                                            {

                                                reg=/^0{0,1}(13[0-9]|145|15[0-9]|153|156|18[0-9])[0-9]{8}$/i;
                                                if(!reg.test(no)){  

                                                    $('#subscribe .type_error').html('请输入正确的手机号');
                                                    return;
                                                }

                                            }
                                            else{
                                                reg=/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/;   
                                                if(!reg.test(no)){        

                                                    $('#subscribe .type_error').html('请输入正确的邮箱地址');
                                                    return;
                                                }


                                            }


                                    }
                                    else{
                                        $('#subscribe .type_error').html('请选择类型');
                                        return;    
                                    }

                                    var data = {
                                    no_type:$('#subscribe input[name="type"]:checked').val() ,
                                        no:no,
                                        act:'add_subscribe',  
                                    };

                                    var url = "/subscribe.php";
                                    //form ok
                                    $.post(url, data, function(msg){
                                    if(!msg.code){
                                        alert("订阅成功");
                                        $('#subscribe').dialog('close')
                                    }
                                    else
                                        alert(msg.content);

                                })			
                            
                    });
                    
                    $('#subscribe').dialog({
                            height: 190,
                            width:454,
                            modal: true
                    })

            });
        }
        else
        {
                $('#subscribe').dialog({
                        height: 190,
                        width:454,
                        modal: true
                })

        }
}

//兑换积分
function do_exchange(id,title,integral)
{
  if(!GUserInfo.isLogin)
      show_login_dialog();
  else{
    var meesage = '您确定要用 '+integral+"分兑换"+ title+"么？";
    if(confirm(meesage))
    {
        var url = 'exchange.php?act=do_exchange';
        var data = {id :id}
        
          $.get(url,data,function(result) {
            var res = $.parseJSON(result);
            if(res.code == 0){
                alert('兑换成功,您可以到个人中心进行查看');
            }
            else
                alert(res.error) ;  
        });
    }
  }
    
}

//提取提货券
function get_exchange_goods(goods_id)
{
    var meesage = '您确定要提取该商品么';
    if(confirm(meesage))
    {
        var url = 'exchange.php?act=get_exchange_goods';
        var data = {id :goods_id}
        
          $.get(url,data,function(result) {
            var res = $.parseJSON(result);
            if(res.code == 0){
                alert('提取成功');
                location.reload();
            }
            else
                alert(res.error) ;  
        });
    }
}