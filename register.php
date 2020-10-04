<?php

require 'database.php';


$postdata = file_get_contents("php://input");



if(isset($postdata) && !empty($postdata))
{
	//extract the data
	$request = json_decode($postdata);
	
	//validate
	
	
	//sanitize 
    $firstName = mysqli_real_escape_string($con, trim($request->firstname));
    $lastName  = mysqli_real_escape_string($con, trim($request->lastname));
	$email     = mysqli_real_escape_string($con, trim($request->email));
	$password  = mysqli_real_escape_string($con, trim($request->password));
	$user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
	$result = mysqli_query($con, $user_check_query);
	$user = mysqli_fetch_assoc($result);
  

    if (isset($user['email']) == ($email)) {
		
		http_response_code(404);
	
	}
	else {
	
	$password_hash = password_hash($password, PASSWORD_BCRYPT);
	//store
	$query = mysqli_query($con, "INSERT INTO  `users` (`id`,`first_name`, `last_name`,`email`,`password`) VALUES (null,'{$firstName}','{$lastName}','{$email}','{$password_hash}')");
	
	};
	
	
}
