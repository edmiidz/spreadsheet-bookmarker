<?php
session_start(); 
include "inc/config.php";

$ssid="";
$logo="";

if($_POST['ssid']!='' && $_POST['ssid']!=NULL){
    $ssid = $_POST['ssid'];
}

if($_FILES["fileToUpload"]!='' && $_FILES["fileToUpload"]!=NULL){
    $logo = $_FILES["fileToUpload"]['name'];
}

if($_FILES){
 $isUploaded = move_uploaded_file(
        // Temp image location
        $_FILES["fileToUpload"]['tmp_name'],
    
        // New image location, __DIR__ is the location of the current PHP file
        __DIR__ . "/icon/" . "icon.png"
    );
}


$sql = "UPDATE settings SET value ='$ssid' WHERE name='ssid'";

$redirectUrl = $siteUrl.'index.php';

if (mysqli_query($con, $sql)) {
    $_SESSION['message'] = 'Updated Successfully';
    header('Location: '.$redirectUrl);
  } else {
    $_SESSION['message'] = 'Someething Went Wront. Update Failed';
    $redirectUrl = $siteUrl.'index.php';
    // echo "Error updating record: " . mysqli_error($con);
  }
  
  mysqli_close($con);

  
?>