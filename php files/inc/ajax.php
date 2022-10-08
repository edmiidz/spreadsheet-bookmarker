<?php
include "config.php";
include "functions.php"; 
 
	switch($_REQUEST['action']){
		case 'save_data':
				$logo = mysqli_real_escape_string($_POST['logo']);
				$sskey = mysqli_real_escape_string($_POST['sskey']);
				mysqli_query("update settings set value='$sskey' where name='ssid'");
				mysqli_query("update settings set value='$logo' where name='logo'");
		break;
		
		case 'add_row'; 
			require_once 'Zend/Loader.php';
			Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');
			Zend_Loader::loadClass('Zend_Gdata_ClientLogin');

			// set credentials for ClientLogin authentication
			$user = "";
			$pass = "";
		try {
     
			$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
			$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
			$service = new Zend_Gdata_Spreadsheets($client);
 
			$ssKey = get_setting('ssid'); 
			$query = new Zend_Gdata_Spreadsheets_DocumentQuery(); 
			$query->setSpreadsheetKey($ssKey);
			$feed = $service->getWorksheetFeed($query);
 
			$wsKey = $feed[0]->id ; 
			$wsKey = basename($wsKey); 
			$dt = ceil((intval($_REQUEST['time'])/1000));
			$ems = $_REQUEST['email'];
			$ems = explode("&",$ems);
			$eml = explode("=",$ems[0]);
			$email = $eml[1];
			$row = array(
				"likedate" => date("D j M o H:i:s a",$dt), 
				"pagename" => $_REQUEST['title']  ,
				"gmail" =>$email ,
				"pageurl" =>$_REQUEST['url'] 
			);

       
			$entryResult = $service->insertRow($row, $ssKey, $wsKey);
      
		     echo 'The ID of the new row entry is: ' . $entryResult->id;
      
    } catch (Exception $e) {
      die('ERROR: ' . $e->getMessage());
    }
		
		
		break;
	}


 

?>