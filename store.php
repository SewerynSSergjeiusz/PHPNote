<?php
require 'connect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
	//extract the data
	$request = json_decode($postdata);
	var_dump($request);
	$title = mysqli_real_escape_string($con, trim($request->title));
	$note  = mysqli_real_escape_string($con, trim($request->note));
	//validate
	if(trim($request->title) === '' || trim($request->note) === '')
	{
		return http_response_code(400);
	}
	
	
	
	//store
	$sql = "INSERT INTO `notes`(`id`,`title`,`note`) VALUES (null,'{$title}','{$note}')";
	
	if(mysqli_query($con, $sql))
	{
		http_response_code(201);
		$note = [
			'title' => $title,
			'note'	=> $note,
			'id'	=> mysqli_insert_id($con)
			];
			echo json_encode(['data'=>$note]);
	}
	else
  {
    http_response_code(422);
  }
}

