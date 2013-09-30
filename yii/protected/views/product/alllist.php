<div id="gorylist">
<div id="brand_list" class="brand_list">
        <ul class="brand_box">
                <li onclick="menuDisplay('man1',8)">
                    <p>
                        梦芭莎女装<b></b></p>
                    <div id="man1" style="display: none;">
                    </div>
                </li>
                <li onclick="menuDisplay('man2',6)">
                    <p>
                        梦芭莎内衣<b></b></p>
                    <div id="man2" style="display: none;">
                    </div>
                </li> <li onclick="menuDisplay('man9',1)">
                    <p>
                        鞋/包/家纺<b></b></p>
                    <div id="man9" style="display: none;">
                    </div>
                </li>
                <li onclick="menuDisplay('man5',9)">
                    <p>
                        ING2ING潮流服饰<b></b></p>
                    <div id="man5" style="display: none;">
                    </div>
                </li> <li onclick="menuDisplay('man3',2)">
                    <p>
                        若缇诗欧美女装<b></b></p>
                    <div id="man3" style="display: none;">
                    </div>
                </li> <li onclick="menuDisplay('man4',3)">
                    <p>
                        蒙蒂埃莫商务男装<b></b></p>
                    <div id="man4" style="display: none;">
                    </div>
                </li> <li onclick="menuDisplay('man7',10)">
                    <p>
                        所然原创女装<b></b></p>
                    <div id="man7" style="display: none;">
                    </div>
                </li>
                <li onclick="menuDisplay('man6',4)" class=" ">
                    <p>
                        宝耶童装<b></b></p>
                    <div id="man6" style="display: none;"><span><a href="/Product/ProductList?website=4&amp;ClassId=0601&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">男中童</a></span><span><a href="/Product/ProductList?website=4&amp;ClassId=0602&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">女中童</a></span><span style="border-right:0;"><a href="/Product/ProductList?website=4&amp;ClassId=0603&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">亲子装</a></span><span><a href="/Product/ProductList?website=4&amp;ClassId=0604&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">妈妈装</a></span><span><a href="/Product/ProductList?website=4&amp;ClassId=0605&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">配饰</a></span><span style="border-right:0;"><a href="/Product/ProductList?website=4&amp;ClassId=0606&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">特价专区</a></span><span><a href="/Product/ProductList?website=4&amp;ClassId=0608&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">泳衣</a></span><span><a href="/Product/ProductList?website=4&amp;ClassId=0609&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">女大童</a></span><span style="border-right:0;"><a href="/Product/ProductList?website=4&amp;ClassId=0610&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">男大童</a></span><span><a href="/Product/ProductList?website=4&amp;ClassId=0611&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">婴童</a></span><span><a href="/Product/ProductList?website=4&amp;ClassId=0613&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">玩具</a></span><span style="border-right:0;"><a href="/Product/ProductList?website=4&amp;ClassId=0616&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">新品抢鲜</a></span><span><a href="/Product/ProductList?website=4&amp;ClassId=06160307&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">10月18日</a></span><span><a style="font-size:12px;" href="/Product/ProductList?website=4&amp;ClassId=0618&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">外套·棉衣·羽绒</a></span><span style="border-right:0;"><a href="/Product/ProductList?website=4&amp;ClassId=0619&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">毛衣</a></span><span><a href="/Product/ProductList?website=4&amp;ClassId=0620&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">打底</a></span><span><a href="/Product/ProductList?website=4&amp;ClassId=0621&amp;guid=e7da913f6d0d49f79d42436b351ed0a7">裤子</a></span></div>
                </li>
                <li onclick="menuDisplay('man8',5)">
                    <p>
                        克莱菲尔男鞋<b></b></p>
                    <div id="man8" style="display: none;">
                    </div>
                </li>
                <li onclick="menuDisplay('man10',11)">
                    <p>
                        千金本草化妆品<b></b></p>
                    <div id="man10" style="display: none;">
                    </div>
                </li>
                <li onclick="menuDisplay('man15',15)">
                    <p>
                        樱桃派青春时尚内衣<b></b></p>
                    <div id="man15" style="display: none;">
                    </div>
                </li>
                <li onclick="menuDisplay('man19',19)">
                    <p>
                        零一佰时尚运动服饰<b></b></p>
                    <div id="man19" style="display: none;">
                    </div>
                </li>
        </ul>
    </div> 
</div>

<div class="clear">
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.overscroll.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function obj(s) { return document.getElementById(s); }
    function menuDisplay(y, website) {
        HidAll(y);
        if ($.trim($("#" + y).html()) == "") {
            GetsubCata(y, website, "");
        }

        if (obj(y).style.display == "none") {
            $("#" + y).parent('li').addClass("now");
            $("#" + y).show("slow", function () { $('html,body').animate({ scrollTop: ($(this).offset().top - 41) }, 800); });

        }
        else if (obj(y).style.display == "block") {
            $("#" + y).hide("slow");
            $("#" + y).parent('li').removeClass("now");
        }
    }
    function showSearch(obj, type) {
        if (type) {
            if (obj.value == "")
                obj.value = "商品名称或编号";
        } else {
            if (obj.value == "商品名称或编号")
                obj.value = "";
        }
    }
    function HidAll(y) {
        var list = document.getElementById("brand_list").getElementsByTagName("div");
        for (var i = 0, leng = list.length; i < leng; i++) {
            var l = list[i];

            if (l.style.display != "none" && l.getAttribute("id") != y) {
                l.style.display = "none";
            }

        }
    }
    function GetsubCata(y, website, classid) {
 
        url = "<?php       echo $this->createUrl('Product/SubList')         ?>"
        $.getJSON(url, { website: website, classid: classid }, function (data) {
            if (data != null) {
                var n = 0;
                var str = "";
                for (var i = 0; i < data.length; i++) {
                    if ((i + 1) % 3 == 0) {
                        var name = data[i].WebChannelName;
                        if (name.length > 6) {
                            str += "<span  style='border-right:0;'><a href='/Product/ProductList?website=" + website + "&amp;ClassId=" + data[i].WebChannelCode + "&amp;guid=" + $("#guid").val() + "' style='font-size:12px;'>" + data[i].WebChannelName + "</a></span>";
                        }
                        else {
                            str += "<span  style='border-right:0;'><a href='/Product/ProductList?website=" + website + "&amp;ClassId=" + data[i].WebChannelCode + "&amp;guid=" + $("#guid").val() + "' >" + data[i].WebChannelName + "</a></span>";
                        }

                    }
                    else {
                        var name = data[i].WebChannelName;
                        if (name.length > 6) {
                            str += "<span ><a href='/Product/ProductList?website=" + website + "&amp;ClassId=" + data[i].WebChannelCode + "&amp;guid=" + $("#guid").val() + "' style='font-size:12px;'>" + data[i].WebChannelName + "</a></span>";
                        }
                        else {
                            str += "<span ><a href='/Product/ProductList?website=" + website + "&amp;ClassId=" + data[i].WebChannelCode + "&amp;guid=" + $("#guid").val() + "' >" + data[i].WebChannelName + "</a></span>";
                        }

                    }
                }

                $("#" + y).html(str);
            }
        });
    }
</script>