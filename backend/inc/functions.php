<?php
session_start(); 
include "config.php";

function checkLogin(){
global $adminUser;
global $adminPassword;
	if(isset($_COOKIE['adminUser']) && isset($_COOKIE['adminPassword'])){
		if($_COOKIE['adminUser']==$adminUser && $_COOKIE['adminPassword']==$adminPassword){
		return true;
		}else{
		return false;
		}
	}else{
	return false;
	}

}
function setLogin($user,$password){
global $adminUser;
global $adminPassword;
// $user = mysqli_real_escape_string($user);
// $password = mysqli_real_escape_string($password);

	if($user==$adminUser && $password==$adminPassword){
	
		setcookie("adminUser",$user, time()+3600*24);
		setcookie('adminPassword',$password,time()+3600*24);
		return true;
	
	}else{
	
	return false;
	
	}

}
function deleteLogin(){
	setcookie("adminUser",'', time()-3600*24);
	setcookie('adminPassword','',time()-3600*24);
	


}
function get_setting($name){
	$sql = "SELECT value FROM `settings` WHERE name='$name'";
	$result = mysqli_query($con, $sql);
	echo "<pre>";
	print_r(mysqli_num_rows($result));
	print_r("asdad");
	

	if (mysqli_num_rows($result)) {
		$row = mysqli_fetch_assoc($result);
		return $row['value'];
	}else{
		print_r("nai");
	}
}
?>