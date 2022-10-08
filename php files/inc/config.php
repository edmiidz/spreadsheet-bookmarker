<?php
$server = 'localhost';
$username = '';
$password = '';
$database = '';

$con = mysqli_connect($server,$username,$password);
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }else{
  mysqli_select_db($database); 
} 
$adminUser = 'admin';
$adminPassword = 'admin';
$siteUrl = 'http://shoppia.ro/admin_spreadsheet/' 

?>