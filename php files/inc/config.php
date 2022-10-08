<?php
$server = 'localhost';
$username = '';
$password = '';
$database = '';

$con = mysql_connect($server,$username,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }else{
  mysql_select_db($database); 
} 
$adminUser = 'admin';
$adminPassword = 'admin';
$siteUrl = 'http://shoppia.ro/admin_spreadsheet/' 

?>