<?php
session_start(); 
include "inc/config.php";

$logo="";
$sql = "SELECT value FROM `settings` WHERE name='logo'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result)) {
	$row = mysqli_fetch_assoc($result);
	$logo=$row['value'];

    echo $logo;
}
?>