
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
