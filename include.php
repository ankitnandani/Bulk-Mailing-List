<?php
function connect_to_db(){
	global $mysqli;
	$mysqli=mysqli_connect("localhost","joeuser","somepass","testDB");
	
	if(mysqli_connect_errno()){
		printf("Connection Failed :%s" , mysqli_error($mysqli));
		exit;
	}
}

function check_email_present($email){
	global $mysqli, $safe_email;
	
	$safe_email=mysqli_real_escape_string($mysqli, $email);
	
	$query = "SELECT id from email_list WHERE email = '" . $safe_email . "';";

	$result = mysqli_query($mysqli , $query);
	if(mysqli_num_rows($result) < 1){
		return 0;
	}
	else{
		$id = mysqli_fetch_array($result)['id'];
		return $id;
	}
}
?>
	