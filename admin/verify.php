<?php 
include "../connect.php";
//$conn = mysqli_connect("localhost","root","","login_register");

//if(isset($_POST['login'])){
	
	$id = $_GET['user_id'];
	$token = $_GET['token'];
//echo $con;
	$check_email_query = "UPDATE users SET status = 'Active' WHERE user_id = '$id' AND token = '$token'";
    $result = mysqli_query($con,$check_email_query);
	if ($result) {
        header('location: login.php');
		echo "verify successful. you can log in now";
	}else{
		echo "verify faild";
	}

//}

?>