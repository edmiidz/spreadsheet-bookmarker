<?php

include "inc/config.php";
include "inc/functions.php";
	header('Content-Type: image/png');
	$im_data = get_setting('logo'); 
	
	$im_data  = str_replace("data:image/png;base64,","",str_replace("data:image/gif;base64,","",str_replace("data:image/jpeg;base64,","",$im_data)));
	$im_data = base64_decode($im_data);
	$im = imagecreatefromstring($im_data);
	
	if ($im !== false) 
	{
		imagejpeg($im );
		imagedestroy($im);
	}
	else 
	{
		echo 'An error occurred.';
	}
?>