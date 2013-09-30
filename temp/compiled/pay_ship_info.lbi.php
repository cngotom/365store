<h6><span><?php echo $this->_var['lang']['shippay_methods']; ?></span>&nbsp;<a   href="javascript:void(0);" onclick="showForm_payTypeAndShipType(this)"  class="f6">[<?php echo $this->_var['lang']['modify']; ?>]</a></h6>
        <div class="middle">
            <table style="width:100%;">
                  <tbody><tr>
                      <td style="text-align:right;width:80px">支付方式：</td>
                      <td><?php echo $this->_var['paymentName']; ?></td>
                  </tr>
                  <tr style="display:">
                      <td style="text-align:right;">配送方式：</td>
                      <td><?php echo $this->_var['shippingName']; ?></td>
                  </tr>
                  <tr style="display:">
                      <td style="text-align:right;">运&#12288;&#12288;费：</td>
                      <td><?php echo $this->_var['shippingFee']; ?>&nbsp;元<?php if ($this->_var['shippingFee'] == 0): ?><span style="color:red">(免运费)</span><?php endif; ?></td>
                  </tr>
                  <tr style="display:none">
                      <td style="text-align:right;">送货日期：</td>
                      <td style="color:red"></td>
                  </tr>
            </tbody></table>
       </div>
