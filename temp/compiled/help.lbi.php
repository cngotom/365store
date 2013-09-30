<?php if ($this->_var['helps']): ?>
<div class="foot_h" >
    
                  <?php $_from = $this->_var['helps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['foo']['iteration']++;
?>
                  <div id="foot_help_item">
                    	<div id="foot_help_item_wrap">
                            <span class="foot_help_icon foot_icon_<?php echo ($this->_foreach['foo']['iteration'] - 1); ?>"></span>
                            <span class="foot_help_item_split"></span>
                            <span class="foot_help_item_text">
                                <ul>
                                    <li class="foot_item_first"> <?php echo htmlspecialchars($this->_var['cat']['cat_name']); ?> </li>
                                    <?php $_from = $this->_var['cat']['article']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                    <li> <a href="<?php echo $this->_var['item']['url']; ?>" title="<?php echo $this->_var['item']['title']; ?>"><?php echo $this->_var['item']['title']; ?></a> </li>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </ul>
                            </span>
                       </div>
                    </div>      
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
            
            
            
            
            
            

<?php endif; ?>
