<?php

require 'connect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
	//extract the data
	$request = json_decode($postdata);
	
	
	//validate
	if(trim($request->title) === '' || trim($request->note) === '' || trim($request->id) === '')
	{
		return http_response_code(400);
	}
	$title = mysqli_real_escape_string($con, trim($request->title));
	$note  = mysqli_real_escape_string($con, trim($request->note));
	$uid   = mysqli_real_escape_string($con, trim($request->id));
	
	
	//store
	$sql = "INSERT INTO `notes`(`id`,`title`,`note`,`user_id`) VALUES (null,'{$title}','{$note}','{$uid}')";
	
	if(mysqli_query($con, $sql))
	{
		http_response_code(201);
		$note = [
			'title' => $title,
			'note'	=> $note,
			'user_id'=>$uid,
			'id'	=> mysqli_insert_id($con)
			];
			echo json_encode(['data'=>$note]);
	}
	else
  {
    http_response_code(422);
  }
}

