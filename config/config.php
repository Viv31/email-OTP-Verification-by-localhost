<?php 
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "Github_type_OTP_Login_System";
$conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
if($conn){
	//echo "Connected";
}else{
	echo "Failed to Connect";
}

?>