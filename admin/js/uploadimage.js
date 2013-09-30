/**
 * 上传图片控件
 * 
 * 用法：
 * html:
 * 	<div id="upload_dialog" title="上传并导出图片" style="display:none"></div>
 * 
 * js:
 *   $(function() {
 *	    UploadImg.init("upload_dialog");
 *   });
 *   
 * 上传后直接更新img显示内容，需要在img上设置css ajax-upload-pic
 *     <img id="pic1-1" alt="pic" width="120px" height="90px" class="ajax-upload-pic" picid="pic1"/>
 *       
 * 需要插件支持：
 *    jquery ui 1.8
 */


 var UploadImg  = {        
		    id : "",
		    newFileName : "" ,
		    dialogid:"",
			newGuid : function() {
		        var guid = "";
		        for (var i = 1; i <= 32; i++) {
		            var n = Math.floor(Math.random() * 16.0).toString(16);
		            guid += n;
		            if ((i == 8) || (i == 12) || (i == 16) || (i == 20))
		                guid += "-";
		        }
		        return guid;
		    },
		 	callback_upload:function(id,fileName){	 	
		 		$("#"+UploadImg.dialogid ).dialog('destroy'); 				 		
		 		$("#"+UploadImg.dialogid+"_iframe")[0].src="/picupload/uploadpicedit.php?filename=" + fileName +".jpg&id=" + id + "&rnd=" + Math.random();
		 		$("#"+UploadImg.dialogid).dialog( {height: 640,width:800,modal: true});
			},
			upload_done:function(id,fileName){
				var filePath = "/images/temp/F_" + fileName;
				$("#"+id)[0].src=filePath;
		 		var picid=$("#"+id).attr("picid");
		 		if(picid != undefined){
		 			$("#"+picid)[0].src=filePath;
		 		}

		 		$("#"+UploadImg.dialogid ).dialog('destroy');
		 		$("#"+UploadImg.dialogid+"_iframe")[0].src="/picupload/jqUploader/imgUploadProxy.php";
		 		
		 		if(UploadImg.callback_success){
		 			UploadImg.callback_success(id,filePath);
		 		}
			},
		    init:function(dialogid){
		    	$("#"+dialogid).html("<Iframe id=\"" + dialogid + "_iframe\" src=\"/picupload/jqUploader/imgUploadProxy.php\";; width=\"100%\" height=\"100%\" scrolling=\"no\" frameborder=\"0\"></iframe>");		    	
		    	UploadImg.dialogid = dialogid;
				$(".ajax-upload-pic").each(function(i){
					/*$("#"+this.id).click(function(){
						UploadImg.bindUploadClick(this.id);
					});*/
					$("#"+this.id).mousedown(function(e){
				          if(3 == e.which){
				        	  UploadImg.bindUploadClick(this.id);				           
				          }
				    })					
				});
				
				$(".ajax-modify-pic").each(function(i){
					//如果src没有图片则上传否则修改
					//$("#"+this.id).click(function(){
						/*if(this.src){
							UploadImg.bindModifyClick(this.id,this.src);
						}else{
							UploadImg.bindUploadClick(this.id);
						}*/
						$("#"+this.id).mousedown(function(e){
					          if(3 == e.which){
					        	  if(this.src){
										UploadImg.bindModifyClick(this.id,this.src);
								  }else{
										UploadImg.bindUploadClick(this.id);
								  }			           
					          }
					    })							
					//});
				});
		    },
		    bindUploadClick:function(imgID){
		    	$("#"+UploadImg.dialogid ).dialog('destroy'); 
		    	UploadImg.newFileName = UploadImg.newGuid();
				document.getElementById(UploadImg.dialogid+"_iframe").src='/picupload/jqUploader/imgUploadProxy.php?id=' + imgID + '&newfileName=' + UploadImg.newFileName;
				$("#"+UploadImg.dialogid).dialog( {height: 170,width:430,modal: true});
		    },
		    bindModifyClick:function(imgID,imgsrc){
		    	$("#"+UploadImg.dialogid ).dialog('destroy'); 				 		
		 		$("#"+UploadImg.dialogid+"_iframe")[0].src="/picupload/uploadpicedit.php?modifyfilename=" + escape(imgsrc) + "&id=" + imgID + "&rnd=" + Math.random();
		 		$("#"+UploadImg.dialogid).dialog( {height: 640,width:800,modal: true});
		    },
		    gotoUploadPage:function(imgID){
		    	UploadImg.bindUploadClick(imgID);
		    },
		    callback_success:undefined
		};
 
 $(function() {	
	 var dlg = $(".upload_dialog");
	 if(dlg.length>0){
		UploadImg.init(dlg[0].id);
		
		$(document).bind("contextmenu",function(e){
	        return false;
	    });		
	 }
 });
 