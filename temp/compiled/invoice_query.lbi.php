<div class="box">
     <div class="mt"><span>物流查询</span></div>
     <div class="mc clearfix boxCenterList ">
         <input type="text"  class="invoice_search_text" id="invoice_search_text" value="请输入订单号">  
         <button class='invoice_search_btn' id='invoice_search_btn'>查询</button>
    </div>
     <div  id='invoice_info_temp' ></div>
</div>
<div class="blank5"></div>

<script type="text/javascript">

$(function() {
    $('#invoice_search_text').click(function(){if(this.value == "请输入订单号") this.value =""  ;});
    $('#invoice_search_btn').click(function(){
      var url = '/ajax_order_search.php?order_sn=' +   $('#invoice_search_text').val() ;
      $.ajax({
            url: url,
            data: null,
            success: function(msg){
                if(msg.code == 0)
                {
                     $('#invoice_info_temp').html(msg.message);
                     var href =$('#invoice_info_temp a').attr('href');
                     //Post类型查询物流信息
                     if(href.indexOf('java') == 0)
                     {
                             eval(href);
                              $('#invoice_info_temp').html('');
                      }
                       //Get类型查询物流信息
                     else if(href.indexOf('http') == 0){
                          
                          window.location = href;
                      }
                  
                }
                else{
                    alert(msg.message);
                }
            },
            dataType: 'json'
        });
    
    });
    
});



</script>