<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>jqUploader demo</title>
        <link rel="stylesheet" type="text/css" media="screen" href="style.css"/>
        <script type="text/javascript" src="jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="jquery.flash.js"></script>
        <script type="text/javascript" src="jquery.jqUploader.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#example3').jqUploader({
                    debug:0
                    ,background:'FFFFFF'
                    ,barColor:'FFFFFF'
                    ,allowedExt:'*.jpg; *.jpeg; *.png'
                    ,allowedExtDescr: 'what you want'
                    ,validFileMessage: '请点击upload按钮上传图片!'
                    ,endMessage: 'and don\'t you come back ;)'
                    ,hideSubmit: true
                    ,picid:"<?php echo $_GET['id']?>"
                	,newfilename:"<?php echo $_GET['newfileName']?>"
                    ,endHtml:'上传成功，请稍后...'
                });
                
            });
            $(document).bind("contextmenu",function(e){
    	        return false;
    	    });	
			function imgSel() 
			{ 
			    var img = new Image(); 
			    img.src = document.imageForm.file.value; 
			    alert(img.width + " " + img.height);
			    //document.imageForm.width.value = img.width; 
			    //document.imageForm.height.value = img.height; 
			    //document.imageForm.size.value = img.fileSize; 
			    //document.images['image'].src = img.src;*/  
			} 
        </script>
    <style>
    page,ul,li,input,div,form{
    	padding:0px;margin:0px;	background-color: #FFFFFF;
	}
	#page .a_form{
		 background-color: #ffffff;	
	}
    </style>        
    </head>
    
    <body>

        <div id="page" style="width:240px;padding:0px;margin:0px;margin:0px;">
            <form enctype="multipart/form-data" action="flash_upload.php?<?php echo $_SERVER['QUERY_STRING']?>" method="POST" class="a_form" style="width:200px;padding:0px;margin:0px;margin:0px;float:left;">                  
                    <ul style="padding:0px;margin:0px;margin:0px;float:left;">
                        <li id="example3">
                            <input name="myFile3" id="example3_field"  type="file" onChange="imgSel()"/>
                        </li>
                    </ul>                
                <div style="clear:both;"></div>
            </form>
        </div>
    </body>
</html>