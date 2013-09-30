<?php if (!empty($error) ){ ?>
    <div class="error-content"> <?php  echo $error;  ?></div>
<?php }?>
<form action="<?php echo $this->createUrl('addAddress',array('from'=> $from)); ?>" method="post" onsubmit="return  checkInput();">    <div class="order-intro address">
        <ul>
                <li><em>省/区/市：</em> <span><select class="common-input input-rounded" style="width: 48%" name="provinceList" id="provinceList" onchange="ChangeProvince()">
                    <option value="-1">请选择...</option>
                        <?php  foreach ($province_list as $province) {  ?>
                            <option value="<?php echo $province->region_id?>"><?php echo $province->region_name?></option>
                        <?php } ?>
                </select> </span>
                
            </li>
             <li>
                <em>市：</em> <span><select class="common-input input-rounded" style="width: 48%" name="cityList" id="cityList" onchange="ChangeCity();">
                    <option value="-1">请选择...</option>
                </select>
                </span>
            </li>
            <li><em>区：</em> <span>
                <select class="common-input input-rounded" name="districtList" id="districtList" onchange="ChangeDistrict();">
                    <option value="-1">请选择...</option>
                </select></span></li>
            <li><em>邮编：</em> <span>
                     <input class="common-input input-rounded" id="zipcode" maxlength="80" name="zipcode" type="text" value="">
                </span></li>
            <li><em>详细地址：</em> <span>
                <input class="common-input input-rounded" id="Address" maxlength="80" name="Address" type="text" value="">
            </span></li>
            <li><em>收货人：</em> <span>
                <input class="common-input input-rounded" id="AccepterName" maxlength="50" name="AccepterName" type="text" value="">
            </span></li>
            <li><em>手机号码：</em> <span>
                <input class="common-input input-rounded" id="Mobile" maxlength="11" name="Mobile" type="text" value="">
            </span></li>
        </ul>
    </div>
    <div class="button">
        <input type="submit" class="buy-btn input-rounded" value="完 成" > 
    </div>
   
    <input type="hidden" id="Province" name="ProvinceCode" value="">
    <input type="hidden" id="City" name="CityCode" value="">
    <input type="hidden" id="District" name="DistrictCode" value="">
    <input type="hidden" name="Id" value="0">
    <input type="hidden" name="nextUrl" value="">
     <input type="hidden" name="act" value="add">
      <input type="hidden" id="address_id" name="address_id" value="0">
    
     
     <input type="hidden" name="AddressName" id="AddressName">
    <input type="hidden" id="pcode" value="">
    <script language="javascript" type="text/javascript">
        //    var selectedProvince = "";
    //    var selectedCity = "";
    //    var selectedDistrict = "";

    //下拉框选中之前选择的值(在修改的时候执行，因为存储的值是文本，绑定的值是code，需要匹配文本来进行选择)
    //选择省市
    function selectProvince(text) {
        $("#provinceList").val(text);
//        var count = $("#provinceList option").length;

//        for (var i = 0; i < count; i++) {
//            if ($("#provinceList").get(0).options[i].val() == text) {
//                $("#provinceList").get(0).options[i].selected = true;

//                break;
//            }
//        }
    }

    //下拉框选中之前选择的值(在修改的时候执行，因为存储的值是文本，绑定的值是code，需要匹配文本来进行选择)
    //选择城市
    function selectCity(text) {
        $("#cityList").val(text);
//        var count = $("#cityList option").length;

//        for (var i = 0; i < count; i++) {
//            if ($("#cityList").get(0).options[i].val() == text) {
//                $("#cityList").get(0).options[i].selected = true;

//                break;
//            }
//        }
    }

    //下拉框选中之前选择的值(在修改的时候执行，因为存储的值是文本，绑定的值是code，需要匹配文本来进行选择)
    //选择区域
    function selectDistrict(text) {
        $("#districtList").val(text);
//        var count = $("#districtList option").length;

//        for (var i = 0; i < count; i++) {
//            if ($("#districtList").get(0).options[i].val() == text) {
//                $("#districtList").get(0).options[i].selected = true;

//                break;
//            }
//        }
    }


    var isNewProvince = false;
    var isNewCity = false;
    var isNewDistrict = false;
    //当省市选项变化时执行
    function ChangeProvince() {
        if ($("#provinceList").val() != "-1") {
            loading();
            $("#provinceList option[value='-1']").remove();
            if ($("#Province").val() != $("#provinceList").find("option:selected").val())
                isNewProvince = true;
            $("#Province").val($("#provinceList").find("option:selected").val());
            $.ajax({
                url: "<?php echo $this->createUrl('region/getChildren'); ?>",
                cache: false,
                data: "parent_id=" + $("#provinceList").val(),
                dataType: "json",
                type:"get",
                success: function (jsondata) {
                    $("#cityList").empty();
                    var json = jsondata;
                 //   eval("json=" + jsondata);
                    $("#cityList").append("<option value=\"-1\">请选择...</option>");
                    $.each(json, function (i) {
                        $("#cityList").append("<option value='" + json[i].region_id + "'>" + json[i].region_name + "</option>");
                    });
                    if (isNewProvince)
                        $("#City").val("");
                    else
                        selectCity($("#City").val());
                    isNewProvince = false;
                    ChangeCity();
                    //                    ChangeCity();

                }
            });
        }
    }

    //当城市选项变化时执行
    function ChangeCity() {
        if ($("#cityList").val() != "-1") {
            loading();
            $("#cityList option[value='-1']").remove();
            if ($("#City").val() != $("#cityList").find("option:selected").val())
                isNewCity = true;
            $("#City").val($("#cityList").find("option:selected").val());
            $.ajax({
                url: "<?php echo $this->createUrl('region/getChildren'); ?>",
                cache: false,
                data: "parent_id=" + $("#cityList").val(),
                dataType: "json",
                type:"get",
                success: function (data) {
                    $("#districtList").empty();
                    var json = data;
                    //eval("json=" + data);
                    $("#districtList").append("<option value=\"-1\">请选择...</option>");
                    $.each(json, function (i) {
                        $("#districtList").append("<option value='" + json[i].region_id + "'>" + json[i].region_name + "</option>");
                    });
                    if (isNewCity)
                        $("#District").val("");
                    else
                        selectDistrict($("#District").val());
                    isNewCity = false;

                    ChangeDistrict();
                }
            });
        }
        else {
            $("#districtList").empty();
            $("#districtList").append("<option value=\"-1\">请选择...</option>");
            ChangeDistrict();
        }
    }


    var isIe = false;
    //当区域选项变化时执行
    function ChangeDistrict() {
        if ($("#districtList").val() != "-1") {
         //   loading();
            $("#districtList option[value='-1']").remove();
            if ($("#District").val() != $("#districtList").find("option:selected").val())
                isNewDistrict = true;
            $("#District").val($("#districtList").find("option:selected").val());
            closeLoading();
        }
        closeLoading();
  
    }
    
  //关闭窗口
    function closeLoading() {
        if (document.getElementById('back') != null) {
            document.getElementById('back').parentNode.removeChild(document.getElementById('back'));
        }
        if (document.getElementById('mesWindow') != null) {
            document.getElementById('mesWindow').parentNode.removeChild(document.getElementById('mesWindow'));
        }
        if (isIe) {
            setSelectState('');
        }
        isShow = false;
    }
    //测试弹出
    function loading() {
        if (isShow == false) {
            var messContent = "<div style='padding:15px 0 15px 0;text-align:center'>加载中...</div>";
            showMessageBox(messContent, 350);
            isShow = true;
        }

    }
//弹出方法
    function showMessageBox(content) {
        closeLoading();
        var bWidth = parseInt(document.documentElement.scrollWidth);
        var bHeight = parseInt(document.documentElement.scrollHeight);
        if (isIe) {
            setSelectState('hidden');
        }
        var back = document.createElement("div");
        back.id = "back";
        var styleStr = "top:0px;left:0px;position:absolute;background:#666;width:" + bWidth + "px;height:" + bHeight + "px;";
        styleStr += (isIe) ? "filter:alpha(opacity=0);" : "opacity:0;";
        back.style.cssText = styleStr;
        document.body.appendChild(back);
        showBackground(back, 50);
        var mesW = document.createElement("div");
        mesW.id = "mesWindow";
        mesW.className = "mesWindow";
        mesW.innerHTML = "<div class='mesWindowContent' id='mesWindowContent'>" + content + "</div><div class='mesWindowBottom'></div>";
        var vTop = (document.body.clientHeight - mesW.clientHeight) / 2;
        vTop += document.documentElement.scrollTop;
        styleStr = "top:" + (vTop - 250) + "px;left:30%;position:absolute;width:50%;z-index:9999;";
        mesW.style.cssText = styleStr;
        document.body.appendChild(mesW);
    }
    //让背景渐渐变暗
    function showBackground(obj, endInt) {
        if (isIe) {
            obj.filters.alpha.opacity += 5;
            if (obj.filters.alpha.opacity < endInt) {
                setTimeout(function () { showBackground(obj, endInt); }, 5);
            }
        } else {
            var al = parseFloat(obj.style.opacity); al += 0.05;
            obj.style.opacity = al;
            if (al < (endInt / 100))
            { setTimeout(function () { showBackground(obj, endInt); }, 5); }
        }
    }

    var isShow = false;


    function checkInput()
    {
        var error = "";
        
        
        //检查表单完整性
        if( $('#zipcode').val() =="" )
            error += "请输入邮编\n";
        if( $('#Address').val() =="" )
            error += "请输入详细地址\n";
        if( $('#Mobile').val() =="" )
            error += "请输入手机\n";
        if( $('#AccepterName').val() =="" )
            error += "请输入收货人\n";
        
        if ($("#districtList").val() == "-1") 
            error += "请选择您所在的地区\n";
        
        
        //数字检测

        var regx=/^(?:13\d|15\d|18[123456789])-?\d{5}(\d{3}|\*{3})$/;
        if(!regx.test( $('#Mobile').val())){
             error += "手机输入格式有误\n";
        }      
             
        if(error != "") {
            alert(error);
            return false;
        }
        else {
            $('#AddressName').val( 
                 $("#provinceList option:selected").html()  +
                 $("#cityList option:selected").html()  +
                 $("#districtList option:selected").html()  +
                 $("#Address").val()
                      
            );
                
            return true;
        }
    }
    
    <?php if ($address) { ?>
            $(function(){
               
                
                $('input[name="act"]').val("edit"); //修改模式为edit
                $('#address_id').val( <?php echo $address->address_id ?>); //修改address_id
                //修改edit控件值
                $('#zipcode').val( "<?php echo $address->zipcode ?>"); //zipcode
                $('#Address').val("<?php echo $address->address ?>"); //Address
                $('#AccepterName').val( "<?php echo $address->consignee ?>"); //修改AccepterName
                $('#Mobile').val( "<?php echo $address->mobile ?>"); //修改Mobile
                $('#AddressName').val( "<?php echo $address->address_name ?>"); //修改Mobile
                //修改select控件值
                
                $('#provinceList').val('<?php echo $address->province ?>');
                //citylist
                $("#cityList").empty();
                <?php  foreach ($city_list as $city) {  ?>
                           $("#cityList").append("<option value='" + <?php echo $city->region_id?> + "'>" + "<?php echo $city->region_name?>" + "</option>");
                <?php } ?>
                $('#cityList').val('<?php echo $address->city ?>');
                
                 
                
                //districtlist
                $("#districtList").empty();
                <?php  foreach ($district_list as $dist) {  ?>
                           $("#districtList").append("<option value='" + <?php echo $dist->region_id?> + "'>" + "<?php echo $dist->region_name?>"+ "</option>");
                <?php } ?>
                $('#districtList').val('<?php echo $address->district ?>');
                
                
                
            });
    <?php } ?>    
    
    </script>
</form>