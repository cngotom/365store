<h6><span><?php echo $this->_var['lang']['consignee_info']; ?></span>&nbsp;<a href="javascript:showForm_consignee(this)" class="f6">[<?php echo $this->_var['lang']['modify']; ?>]</a></h6>
      <div class="middle">
      <table >
            <tr>
              <td  align="right" style="width:80px;"><?php echo $this->_var['lang']['consignee_name']; ?>:</td>
              <td ><?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?></td>
            </tr>
            
    
            <tr>
              <td  align="right" style="width:80px;"><?php echo $this->_var['lang']['detailed_address']; ?>:</td>
              <td ><?php echo htmlspecialchars($this->_var['consignee']['address_name']); ?> </td>
            </tr>
            <tr>
              <td  align="right" style="width:80px;"><?php echo $this->_var['lang']['postalcode']; ?>:</td>
              <td ><?php echo htmlspecialchars($this->_var['consignee']['zipcode']); ?></td>
            </tr>
 
            <tr>  
              <td  align="right" style="width:80px;"><?php echo $this->_var['lang']['backup_phone']; ?>:</td>
              <td ><?php echo htmlspecialchars($this->_var['consignee']['mobile']); ?></td>
            </tr>
            <tr>
              <td  align="right" style="width:80px;"><?php echo $this->_var['lang']['phone']; ?>:</td>
              <td ><?php echo $this->_var['consignee']['tel']; ?> </td>
            </tr>
            <tr>
              <td  align="right" style="width:80px;"><?php echo $this->_var['lang']['email_address']; ?>:</td>
              <td ><?php echo htmlspecialchars($this->_var['consignee']['email']); ?></td>
            </tr>
    
             <?php if (0 && $this->_var['total']['real_goods_count'] > 0): ?>
            <tr>
              <td  align="right" style="width:80px;"><?php echo $this->_var['lang']['sign_building']; ?>:</td>
              <td ><?php echo htmlspecialchars($this->_var['consignee']['sign_building']); ?> </td>
            </tr>
            <tr>  
              <td  align="right" style="width:80px;"><?php echo $this->_var['lang']['deliver_goods_time']; ?>:</td>
              <td ><?php echo htmlspecialchars($this->_var['consignee']['best_time']); ?></td>
            </tr>
            <?php endif; ?>
          </table>
      </div>