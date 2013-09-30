<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" /> 
		<title>图片编辑</title>
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		<script src="../js/jquery.Jcrop.js" type="text/javascript"></script>
		<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />
		<link rel="stylesheet" href="demo_files/demos.css" type="text/css" />
		<script type="text/javascript">

		jQuery(function($){
			jQuery('#target').Jcrop({
				aspectRatio: 1,
				onSelect: updateCoords
			});
		});
		function updateCoords(c)
		{
			jQuery('#x').val(c.x);
			jQuery('#y').val(c.y);
			jQuery('#w').val(c.w);
			jQuery('#h').val(c.h);
		};
		</script>
	</head>

	<body>
		<div id="outer">
		<div class="jcExample">
		<div class="article">
		<form action="crop.php" method="post" onsubmit="return checkCoords();">
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />		
			<img src="demo_files/flowers.jpg" id="target" alt="Flowers" />
			<input type="submit" value="Crop Image" style="float:left; width: 98px;" />
		</form>
		</div>
		</div>
		</div>
	</body>
</html>

