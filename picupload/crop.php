<?php
date_default_timezone_set('PRC');
function writelog($logInfo,$filePrefix="365store_pic_croplog_"){
	$handle = fopen(ROOT_PATH . "\\data\\log\\" . $filePrefix . date("Ymd") .".txt", "a");
	fwrite($handle,$logInfo . "\r\n");
	fclose($handle);	
}
/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{	
	$jpeg_quality = 90;
	
	//原始图片信息
	$src = ROOT_PATH . $_POST['filename'];
	$fileName = basename($_POST['filename']);

	$srcimg_info = getimagesize($src);
	$srcimg_info = array('w'=>$srcimg_info[0],'h'=>$srcimg_info[1]);
	
	//按比例还原实际尺寸（前端显示时对原始图片缩小显示，此处对选择的值需要进行尺寸还原）
	
	$radio = $srcimg_info['h']/$_POST['img_h'];
	$selimg_info = array('x'=>$_POST['sel_x']*$radio,'y'=>$_POST['sel_y']*$radio,'w'=>$_POST['sel_w']*$radio,'h'=>$_POST['sel_h']*$radio);
	$targ_w = $selimg_info['w'];
	$targ_h = $selimg_info['h'];
	//生成目标图片
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
	imagecopyresampled($dst_r,$img_r,0,0,$selimg_info['x'],$selimg_info['y'],$targ_w,$targ_h,$selimg_info['w'],$selimg_info['h']);
	
	//图片保存
	imagejpeg($dst_r,ROOT_PATH . "\\images\\temp\\" ."F_".$fileName,$jpeg_quality);
	
	echo ROOT_PATH . "\\images\\temp\\" ."F_".$fileName;
	
	writelog("[" . date("y-m-d h:i:s") . "]");
	writelog(print_r($_POST,true));
	writelog(print_r($srcimg_info,true));
	writelog(print_r($selimg_info,true));
	
	writelog(ROOT_PATH . $_POST['filename']);
	writelog(ROOT_PATH . "\\images\\temp\\" ."F_".$fileName);
	
	writelog(sprintf("info      :radio %s",$radio));
	writelog(sprintf("srcimg    :x %s \ty %s \tw %s \th %s",0,0,$srcimg_info['w'],$srcimg_info['h']));
	writelog(sprintf("userselect:x %s \ty %s \tw %s \th %s",$_POST['sel_x'],$_POST['sel_y'],$_POST['sel_w'],$_POST['sel_h']));
	writelog(sprintf("output_img:x %s \ty %s \tw %s \th %s",0,0,$targ_w,$targ_h));
	
	echo sprintf('<script>window.parent.UploadImg.upload_done("%s","%s")</script>',$_POST['id'],$fileName);
	exit;
}

// If not a POST request, display page below:

?>
<html><head>
<script>
	window.parent.UploadImg.upload_done("<?php echo $_POST['id'];?>","<?php echo $_POST['filename'];?>")
</script>
</head>
</html>