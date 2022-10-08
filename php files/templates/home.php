<script type="text/javascript">
	$(document).ready(function(){
		
		new uploader('logo_upload','img_prev');
		$("#save_form").live("click",function(){
			$("#loader_image").fadeIn();
			$.ajax({
				url:"<?php echo $siteUrl?>inc/ajax.php",
				data:{action:"save_data",logo:$("#hidden_image").val(),sskey:$("#sskey").val()},
				type:"post",
				success:function(){
				$("#loader_image").fadeOut();
						$('#alert').removeClass('error').addClass('success').html("Settings save succesfully!");
						setTimeout(function(){
						$('#alert').fadeOut();
				},2000);
				}
			
			});
			
			return false;
		});
	});

</script>

<div id="page-content-outer"><div class="wrapper content admin" id="page-content">
        <div class="info-bar">
            <h1 class="title">Settings</h1>
             
        
        </div>

    
        <div class="inner">
		<div id="alert"></div>
		<div class="setting"><span>SpreadSheet ID: </span>	<input type="text" value="<?php echo get_setting('ssid');?>" id="sskey"><div class="clear"></div></div>
		
		<div class="setting"><span>Logo: </span><div class="clear"></div>
			<div id="logo_upload">Drop here the picture in order to upload it</div>
			<div id="img_preview"><img src="<?php echo get_setting('logo');?>" id="img_prev" width="50px" height="50px"/></div>
			<input type="hidden" value="<?php echo get_setting('logo');?>" id="hidden_image"/>
			<div class="clear"></div>
		</div> 
		 <div class="button large"><input value="Save" id="save_form" type="submit"><img id="loader_image" src="images/loader.gif" height="33px" width="33px"/></div>
        </div>
      
    </div></div>