<style>
  
  	.ui-datepicker
	{
		width:222px;	
	}
               #datepicker .ui-widget-header
               {
                    background: none repeat-x scroll 50% 50% #CCC;
               }
               #datepicker .ui-widget-content {
                    background: url("images/ui-bg_flat_75_ffffff_40x100.png") repeat-x scroll 50% 50% #FFFFFF;
                  
                    border: none;
                    color: #222222;
                }
	.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
                border: 1px solid #AAA/*{borderColorActive}*/;
                background: red/*{bgColorActive}*/ url(images/ui-bg_glass_65_ffffff_1x400.png)/*{bgImgUrlActive}*/ 50%/*{bgActiveXPos}*/ 50%/*{bgActiveYPos}*/ repeat-x/*{bgActiveRepeat}*/;
                font-weight: normal/*{fwDefault}*/;
                color: #212121/*{fcActive}*/;
            }
            #event{
                  border: 1px solid #DDDDDD;
                  border-top:none;
            }

  </style>

  <script>
  
    function mark_event( day,year,mon)	{
            var as  = $('.ui-datepicker-calendar td a' )

            as.each(function(index,ele) {

                    if(  parseInt( $(ele).html() ) == day )
                    {
                            $(ele).removeClass('ui-state-default');
                            $(ele).addClass('ui-state-highlight ui-state-active');		
                    }


            });

    }
  
  $(document).ready(function() {
     $.datepicker.regional['zh-CN'] = {  
      clearText: '清除',  
      clearStatus: '清除已选日期',  
      closeText: '关闭',  
      closeStatus: '不改变当前选择',  
      prevText: '<上月',  
      prevStatus: '显示上月',  
      prevBigText: '<<',  
      prevBigStatus: '显示上一年',  
      nextText: '下月>',  
      nextStatus: '显示下月',  
      nextBigText: '>>',  
      nextBigStatus: '显示下一年',  
      currentText: '今天',  
      currentStatus: '显示本月',  
      monthNames: ['一月','二月','三月','四月','五月','六月', '七月','八月','九月','十月','十一月','十二月'],  
      monthNamesShort: ['一','二','三','四','五','六', '七','八','九','十','十一','十二'],  
      monthStatus: '选择月份',  
      yearStatus: '选择年份',  
      weekHeader: '周',  
      weekStatus: '年内周次',  
      dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],  
      dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],  
      dayNamesMin: ['日','一','二','三','四','五','六'],  
      dayStatus: '设置 DD 为一周起始',  
      dateStatus: '选择 m月 d日, DD',  
      dateFormat: 'yy-mm-dd',  
      firstDay: 1,  
      initStatus: '请选择日期',  
      isRTL: false  
    };  
	
    $.datepicker.setDefaults($.datepicker.regional['zh-CN']);  
     var now = {
        day:13,
        month:11,
        year:2012
    };
    var event_days = [28];
    //当前选择的日期
    var select_day;
    //绑定提醒和订阅事件
    $('#do_subscribe').click(function(){
        doSubscribe();
        
    });
    
    $('#do_reminder').click(function(){
        doReminder(1,select_day);
    });
    

    function calendar_init() {
       
           $('#event_info').hide();
            
            $("#datepicker").datepicker(         
                                {
                                                showMonthAfterYear: true,
                                                        changeMonth: true, 
                                                changeYear: true,
                                                onSelect: function(dateText, inst) {
                                                       var day = parseInt ( inst.currentDay );
                                                       var month = parseInt (inst.currentMonth );
                                                       var year =parseInt (inst.currentYear );
                                                      if(     month + 1 == now.month   && year == now.year &&    event_days.indexOf(day) != -1)
                                                       {
                                                           
                                                           select_day = dateText;
                                                           $('#event_image').load('event.php', {'day': day}, function(){
                                                               $('#event_info').show();
                                                           } );
                                                       }
                                                       else{
                                                            $('#event_info').hide();
                                                       }
                                                       
                                                       $("#datepicker" ).datepicker( "destroy" );
                                                       calendar_init();
                                                },			
                                                onChangeMonthYear:function(year,month)
                                                {

                                                        if( parseInt(month) == 11)
                                                        {
                                                            $("#datepicker" ).datepicker( "destroy" );
                                                                    setTimeout( calendar_init ,5);
                                                        }
                                                },
                                        }



            );
            $( "#datepicker" ).datepicker( "setDate", new Date(2012, 11 - 1 ,28) );
             
            $(event_days).each(function(index,ele){
                mark_event(ele);
            })
    }
    calendar_init();
  });
  </script>
  

  <div class="mt"><span>活动日历</span> <b style="margin-left:70px;font-size:12px;font-bold:normal;"> <a href="javascript:void(0)"  style="color:#999;" id="do_subscribe"> 活动订阅 </a> </b></div>
<div id="event">
<div type="text" id="datepicker"></div>
<div id='event_info' style="display:none;"> 
    <div id="event_image"> </div>
    <div style="text-align: center;margin-bottom: 5px;font-size:16px;"> <a style='color:red;' href="javascript:void(0)" id="do_reminder">  到那天提醒我这个活动! </a>  </div>
</div>
</div>