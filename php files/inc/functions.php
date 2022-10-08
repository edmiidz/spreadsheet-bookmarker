<?php
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
$user = mysqli_real_escape_string($user);
$password = mysqli_real_escape_string($password);
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
	$query = mysqli_query("select value from settings where name = '$name'");
	$value = mysqli_fetch_row($query);
	return $value[0];

}
?>