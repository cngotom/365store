<div class="common-menu">
    管理收货地址&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->createUrl('addAddress');?>">添加+</a></div>
<?php if ( !empty($msg) ) { ?>
    <div class="error-content"><?php echo $msg ?></div>
<?php } ?>
<form id="faddr" method="post" action="/Member/MyAddress/?guid=6a629193ca1d4f9e8da90699caa74882">
    <input type="hidden" name="guid" value="6a629193ca1d4f9e8da90699caa74882">
    
      <?php  foreach ($addressList as $address) {  ?>
        <div class="order-intro">
            <ul>
                <li><em>收货人：</em><span> <?php echo $address->consignee ;  ?></span></li>
                <li><em>手机：</em><span><?php echo $address->mobile ;  ?></span></li>
                <li><em>地区：</em><span><?php echo $address->getProvinceName();?>省&nbsp;<?php echo $address->getCityName();?>市&nbsp;<?php echo $address->getDistrictName();?></span></li>
                <li><em>地址：</em><span><?php echo $address->address_name ;  ?></span></li>
                <li><em>邮政编码：</em><span><?php echo $address->zipcode ;  ?></span></li>
                <li class="operation"><a href="<?php echo $this->createUrl('addAddress',array("address_id"=>$address->address_id));?>">
                    修改</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo $this->createUrl('deleteAddress',array("address_id"=>$address->address_id));?>">
                        删除</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!-- <a href="/Member/SetDefaultAddress/?addressId=90000014847&amp;guid=6a629193ca1d4f9e8da90699caa74882">设为默认</a> -->
</li>
            </ul>
        </div>
    
     <?php } ?>
    
      
    </form>