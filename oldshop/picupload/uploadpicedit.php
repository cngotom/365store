<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" /> 
		<title>图片编辑</title>
		<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
		<script src="/js/jquery.Jcrop.js" type="text/javascript"></script>
		<link rel="stylesheet" href="jcrop/css/jquery.Jcrop.css" type="text/css" />
		<link rel="stylesheet" href="jcrop/demo/demo_files/demos.css" type="text/css" />
		
		<?php 
			//如果是修改模式，则需要从服务器上拉取图片
			if(isset($_GET['modifyfilename'])){
                                $host = NGINX_IMG_HOST;
				$arr = explode($host,$_GET['modifyfilename']);
				$filePath = str_replace("thumb_P","P",str_replace("thumb_img","source_img",$arr[1]));	
                                $filePath = NGINX_IMG_HOST.$filePath;
			}else{
				$filePath = "/images/temp/" . $_GET["filename"];
			}
		?>			
		<script type="text/javascript">
		 var jcrop_api, boundx, boundy;
		jQuery(function($){
			setTimeout(initJcrop,200);

						
		});
		$(document).bind("contextmenu",function(e){
	        return false;
	    });	
		function initJcrop(){
			var target = $("#target")[0];
			jQuery('#img_w').val(target.width);
			jQuery('#img_h').val(target.height);
			var initSel = {};
			initSel.x = 10;
			initSel.y = 10;
			initSel.w = target.width-10;
			initSel.h = target.height-10;
			
			jQuery('#target').Jcrop({
				//aspectRatio: 1,
				setSelect: [initSel.x,initSel.y,initSel.w,initSel.h],
				onSelect: updateCoords,
				onChange: updatePreview
			},function(){
		        // Use the API to get the real image size
		        var bounds = this.getBounds();
		        boundx = bounds[0];
		        boundy = bounds[1];
		        // Store the API in the jcrop_api variable
		        jcrop_api = this;
		        
		        updatePreview(initSel);
		        updateCoords(initSel);
		        $("#Preview_div").show();
		        $(".optr_box").show();
		    });			
		}
		function updateCoords(c){
			jQuery('#sel_x').val(c.x);
			jQuery('#sel_y').val(c.y);
			jQuery('#sel_w').val(c.w);
			jQuery('#sel_h').val(c.h);

			updatePreview(c);
		};
		function checkCoords(){
			if (parseInt($('#sel_w').val())) return true;
			alert('请选择一个有效区域之后再进行提交.');
			return false;
		};		
	    function updatePreview(c){

	    	 if (parseInt(c.w) > 0){
		    	  //获取原始照片
		    	  var radio = boundy / c.h;
		    	  var img = {};
		    	  img.h = c.h*radio;
		    	  img.w = c.w*radio;
		    	  img.x = c.x*radio;
		    	  img.y = c.y*radio;
		    	  //计算新图片大小
		    	  if(img.w / img.h > 190.0/250){
			    	  div_x = 190;
			    	  div_y = (190/img.w)*img.h;
		    	  }else{
		    		  div_x = (250/img.h)*img.w;
			    	  div_y = 250;
		    	  }
		          var rx = div_x / c.w;
		          var ry = div_y / c.h;

		          $('#Preview_div').css({
			            width: Math.round(div_x) + 'px',
			            height: Math.round(div_y) + 'px'
		          });
		          $('#preview').css({
			            width: Math.round(rx * boundx) + 'px',
			            height: Math.round(ry * boundy) + 'px',
			            marginLeft: '-' + Math.round(rx * c.x) + 'px',
			            marginTop: '-' + Math.round(ry * c.y) + 'px'
		          });
		        }
	      };		
		</script>
		
		<style>
		img,a img{    
			border:0;    
			margin:0;    
			padding:0;    
			max-width:500px;    
			width:expression(this.width>500?"500px":this.width);    
			max-height:500px;    
			height:expression(this.height>500?"500px":this.height);    
		}
		body{
			background-color:#eeeeee;
			font-size:12px;
		}
		.optr_box{
			padding-top:20px;
			padding-right:15px;	
			float:right;
			display:none;
		}
		</style>
	</head>

	<body>
		<div id="outer">
		<div class="jcExample">
		<div class="article">
		<form action="crop.php" method="post" onsubmit="return checkCoords();">
			<input type="hidden" id="sel_x" name="sel_x" />
			<input type="hidden" id="sel_y" name="sel_y" />
			<input type="hidden" id="sel_w" name="sel_w" />
			<input type="hidden" id="sel_h" name="sel_h" />
			<input type="hidden" id="img_w" name="img_w" />
			<input type="hidden" id="img_h" name="img_h" />
			<input type="hidden" id="id" name="id" value="<?php echo $_GET['id']?>"/>
			<input type="hidden" id="filename" name="filename" value="<?php echo $filePath?>"/>
			<div style="float:left;width:520px;">
			<img src="<?php echo $filePath?>" id="target" alt="Flowers"/>
			</div>
			<div style="border:solid 1px #EEE;width:200px;float:right;background-color:#FFF;">
				<div>
					<span>对比标准</span>
					<img src="/picupload/img/goods_std_pic.jpg" />
					<span>缩略图效果</span>
				</div>			
				<div id = "Preview_div" style="width:190px;height:250px;overflow:hidden;float:right;display:none;">					
					<img src="<?php echo $filePath?>" id="preview" alt="Preview"/>
				</div>
				<div class="optr_box">
					<input type="button" value="重新上传" style="float:left;" onclick="window.parent.UploadImg.gotoUploadPage('<?php echo $_GET['id'];?>')"/>	
					<input type="button" value="刷新" style="float:left;" onclick="location.reload()"/>		
					<input type="submit" value="确定" style="float:left;" />
				</div>
				<div style="clear:both;"></div>
			</div>
		</form>
		</div>
		</div>
		</div>
	</body>
</html>

