<?php
session_start(); 
include "config.php";


$ssid="";
$logo="";
$sql = "SELECT value FROM `settings` WHERE name='ssid'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result)) {
	$row = mysqli_fetch_assoc($result);
	$ssid=$row['value'];
}

$sql = "SELECT value FROM `settings` WHERE name='logo'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result)) {
	$row = mysqli_fetch_assoc($result);
	$logo=$row['value'];
}
?>
<div id="page-content-outer"><div class="wrapper content admin" id="page-content">
	
        <form action="form.php" method="post" enctype="multipart/form-data">
		<div class="info-bar">
            <h1 class="title">Settings</h1>       
			
        </div>
		<p style="text-align: center;background: black;color: white;">S.N: Please Remeber to share your Google Sheet to "google-sheet@my-chrome-extension-366707.iam.gserviceaccount.com" as an editor access</p> 
        <div class="inner">
		<div id="alert"></div>
		
		<div class="setting">
			<p>SpreadSheet ID: </p>	
			<input type="text" name="ssid" value="<?php echo $ssid;?>" id="sskey">
			<div class="clear"></div>
		</div>
		
		<div class="setting flex-block">
			<p>Logo: </p>
		
		<div id="img_preview">
			<div class="clear"></div>
			<img src="<?php echo $siteUrl.'icon/icon.png';?>"  id="img_prev" height="100px"/></div>
			<!-- <div id="logo_upload">Drop here the picture in order to upload it</div>
			
			<input type="hidden" value="<?php echo $logo;?>" id="hidden_image"/>
			<div class="clear"></div> -->
		</div> 
		<div class="flex-block-input">
			<div>
				<input type="file" name="fileToUpload" accept="image/png, image/gif, image/jpeg" id="fileToUpload"/>
			</div>
			<div>
				<input value="Save" style="background: black;color: white;padding: 8px 16px; cursor: pointer;" class="form-button" id="save_form" type="submit">
			</div>
		</div>
		<?php
		if (!empty($_SESSION['message'])) {
			echo '<p class="messages"> '.$_SESSION['message'].'</p>';
			unset($_SESSION['message']);
		}
		?>
        </div>
	</form>
	
	
</div>
      
    </div>
</div>

<script>
	setTimeout(function() {
    $('.messages').fadeOut('slow');
}, 3000);
</script>
