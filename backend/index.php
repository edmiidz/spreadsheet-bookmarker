<?php
 require "inc/config.php";
 require "inc/functions.php";

if(isset($_GET['action'])){
	$action = preg_replace("/[^a-zA-Z0-9]/", "", $_GET['action']);

	switch($action){
		case 'login':
		
		if(!checkLogin()){

			if(isset($_POST['user']) && isset($_POST['password'])){
				
				if(setLogin($_POST['user'],$_POST['password'])){
				
				$include_path = 'templates/login.php';
				$include_params = array('action'=>$action,'login_status'=>true);
					if(!isset($_GET['ret'])){
					echo '<meta HTTP-EQUIV="REFRESH" content="3; url='.$siteUrl.'index.php?action=home">';
					}else{
					echo '<meta HTTP-EQUIV="REFRESH" content="3; url='.urldecode($_GET['ret']).'">';			
					} 
				}else{
				$include_path = 'templates/login.php';
				$include_params = array('action'=>$action,'login_status'=>false);			 
				}		
			}else{
				$include_path = 'templates/login.php';
				$include_params = array();	
			}
		}else{
			header("Location: ".$siteUrl.'index.php?action=home');
		}
		break;
		
		case 'home':
			$include_path = 'templates/home.php'; 
			break;
		
		case 'logout':
			deleteLogin();
			header("Location: ".$siteUrl.'index.php?action=login');
			break;
	
	}
}else{
	header("Location: ".$siteUrl.'index.php?action=login');
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link href="lib/basic.css" media="screen" rel="stylesheet" type="text/css">
    <link href="lib/style.css" media="screen" rel="stylesheet" type="text/css">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
   <script src="lib/html5uploaded.js"></script>
   

 
    <title>Administration panel</title>
</head>

<body>
<div id="header">
    <div class="wrapper clearfix">
        <div class="logo-container">
            <h2 id="logo"><a class="ie6fix" href="<?php echo $siteUrl;?>">Administration Panel</a>
            </h2>
        </div>
        
        <div class="navigation">
            <ul class="main_nav dropdown">
                
            <?php if(checkLogin()):?>
				 
				<li>
                    <a href="<?php echo $siteUrl; ?>index.php?action=logout">Logout</a>
                </li>
			
				
            <?php endif;?>

               
               
            </ul>
 

        </div>

    </div>
</div>

 


<?php   
	include $include_path;
?> 

 <!-- end content-->

</body></html>