<form method="post" action="/Member/Address/?guid=e7da913f6d0d49f79d42436b351ed0a7&amp;nextUrl=/Order/OrderPayment/?guid=e7da913f6d0d49f79d42436b351ed0a7">    <div class="order-intro address">
        <ul>
            <li><em>省/区/市：</em> <span><select onchange="ChangeProvince()" id="provinceList" name="provinceList" style="width: 48%" class="common-input input-rounded">
                    <option value="-1">请选择...</option>
                        <option value="099001">北京市</option>
                        <option value="099002">天津市</option>
                        <option value="099003">河北省</option>
                        <option value="099004">山西省</option>
                        <option value="099005">内蒙古</option>
                        <option value="099006">辽宁省</option>
                        <option value="099007">吉林省</option>
                        <option value="099008">黑龙江</option>
                        <option value="099009">上海市</option>
                        <option value="099010">江苏省</option>
                        <option value="099011">浙江省</option>
                        <option value="099012">安徽</option>
                        <option value="099013">福建省</option>
                        <option value="099014">江西省</option>
                        <option value="099015">山东省</option>
                        <option value="099016">河南省</option>
                        <option value="099017">湖北省</option>
                        <option value="099018">湖南省</option>
                        <option value="099019">广东省</option>
                        <option value="099020">广西省</option>
                        <option value="099021">海南省</option>
                        <option value="099022">重庆市</option>
                        <option value="099023">四川省</option>
                        <option value="099024">贵州省</option>
                        <option value="099025">云南省</option>
                        <option value="099026">西藏</option>
                        <option value="099027">陕西省</option>
                        <option value="099028">甘肃</option>
                        <option value="099029">青海</option>
                        <option value="099030">宁夏</option>
                        <option value="099031">新疆</option>
                </select> </span>
                
            </li>
             <li>
                <em>市：</em> <span><select onchange="ChangeCity();" id="cityList" name="cityList" style="width: 48%" class="common-input input-rounded">
                    <option value="-1">请选择...</option>
                </select>
                </span>
            </li>
            <li><em>区：</em> <span>
                <select onchange="ChangeDistrict();" id="districtList" name="districtList" class="common-input input-rounded">
                    <option value="-1">请选择...</option>
                </select></span></li>
            <li><em>邮编：</em> <span>
                <select onchange="ChangePostcode();" id="Postcode" name="Postcode" class="common-input input-rounded">
                    <option value="-1">请选择...</option>
                </select></span></li>
            <li><em>详细地址：</em> <span>
                <input type="text" value="" name="Address" maxlength="80" id="Address" class="common-input input-rounded">
            </span></li>
            <li><em>收货人：</em> <span>
                <input type="text" value="" name="AccepterName" maxlength="50" id="AccepterName" class="common-input input-rounded">
            </span></li>
            <li><em>手机号码：</em> <span>
                <input type="text" value="" name="Mobile" maxlength="11" id="Mobile" class="common-input input-rounded">
            </span></li>
        </ul>
    </div>
    <div class="button">
        <input type="submit" value="完 成" class="buy-btn input-rounded"> 
    </div>
    <input type="hidden" value="e7da913f6d0d49f79d42436b351ed0a7" name="guid">
    <input type="hidden" value="" name="ProvinceCode" id="Province">
    <input type="hidden" value="" name="CityCode" id="City">
    <input type="hidden" value="" name="DistrictCode" id="District">
    <input type="hidden" value="0" name="Id">
    <input type="hidden" value="/Order/OrderPayment/?guid=e7da913f6d0d49f79d42436b351ed0a7" name="nextUrl">
    <input type="hidden" value="" id="pcode">
    <script type="text/javascript" language="javascript">
        if ($("#provinceList").val() != "-1")
            ChangeProvince();

    </script>
</form>