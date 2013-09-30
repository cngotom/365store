<div class="kuai">
    <div style=" height: 23px;margin-left:10px;  background: url(themes/365chi/images/green/index/kuaixun.jpg) no-repeat;"></div>
    <ul style="margin-left: 10px;">
        <?php $_from = $this->_var['new_articles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
      <li class="news_event">
           &nbsp;活动<span><a href="<?php echo $this->_var['article']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['article']['title']); ?>"><?php echo sub_str($this->_var['article']['short_title'],10); ?></a></span>
      </li>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
    </ul>
</div>






