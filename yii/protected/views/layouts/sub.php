<?php $this->beginContent('//layouts/main'); ?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" />
<div class="common-nav">
    <a href="<?php  echo Yii::app()->createUrl('//site/index') ?>">首页</a> &nbsp;&gt;&nbsp;<?php echo $this->title?>
</div>

    <?php echo $content; ?>


<?php $this->endContent(); ?>