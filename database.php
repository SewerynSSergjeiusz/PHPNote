<?php
// database credentials
define('db_host', 'localhost');
define('db_user', 'root');
define('db_pass', '');
define('db_name', 'note');

//connect to database
function connect(){

	$connect = mysqli_connect(db_host, db_user, db_pass, db_name);
	
	if(mysqli_connect_errno($connect)){
		
		die(" Connection failed" . mysqli_connect_errno());
	}
	
	mysqli_set_charset($connect, "utf8");
	return $connect;
}
$con = connect();