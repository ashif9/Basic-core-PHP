<?php 

$mysql_hostname = "localhost";
$mysql_username = "root";
$mysql_password = "";
$mysql_database = "project1";
$db = mysqli_connect($mysql_hostname , $mysql_username) or die("Connection problem With SQL. Hostname , Username Or Password are wrong!");
if($db){
	echo'Connection successfully done';
}
else{
	echo'oooopppppssss';
}
mysqli_select_db($mysql_database,$db) or die("Could Not connect to databse! check credentials");
mysqli_connect($mysql_hostname , $mysql_username) 

?>