<div id="gorylist">
<div id="brand_list" class="brand_list">
        <ul class="brand_box">
          
                <?php $index=1; foreach($cat_list as $cat):?>
                    <li onclick="menuDisplay('man<?PHP echo $index?>',<?PHP echo $cat->cat_id?>)">
                        <p>
                            <?php echo $cat->cat_name ?><b></b>
                        </p>
                        <div id="man<?PHP echo $index?>" style="display: none;">
                        </div>
                    </li>

               <?php $index ++;endforeach?>
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
    function GetsubCata(y, category, classid) {
 
        url = "<?php       echo $this->createUrl('category/subList')         ?>"
        $.getJSON(url, { category: category, classid: classid }, function (data) {
            if (data != null) {
                var n = 0;
                var str = "";
                for (var i = 0; i < data.length; i++) {
                    if ((i + 1) % 3 == 0) {
                        var name = data[i].cat_name;
                        if (name.length > 6) {
                            str += "<span  style='border-right:0;'><a href='/index.php?r=category" + "&amp;id=" + data[i].cat_id  + "' style='font-size:12px;'>" + data[i].cat_name + "</a></span>";
                        }
                        else {
                            str += "<span  style='border-right:0;'><a href='/index.php?r=category"  + "&amp;id=" + data[i].cat_id  + "' >" + data[i].cat_name + "</a></span>";
                        }

                    }
                    else {
                        var name = data[i].cat_name;
                        if (name.length > 6) {
                            str += "<span ><a href='/index.php?r=category"  + "&amp;id=" + data[i].cat_id  + "' style='font-size:12px;'>" + data[i].cat_name + "</a></span>";
                        }
                        else {
                            str += "<span ><a href='/index.php?r=category"  + "&amp;id=" + data[i].cat_id  + "' >" + data[i].cat_name + "</a></span>";
                        }

                    }
                }

                $("#" + y).html(str);
            }
        });
    }
</script>