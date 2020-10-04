<?php

require 'connect.php';

$postdata = file_get_contents ("php://input");

if(isset($postdata) && !empty($postdata))
{
	//extract the data
	$request = json_decode($postdata);
	
	//validate
	if(trim($request->data->title) === '' || trim($request->data->note) === '')
	{
		return http_response_code(400);
	}
	
	  // Sanitize.
  $id    = mysqli_real_escape_string($con, (int)$request->data->id);
  $title = mysqli_real_escape_string($con, trim($request->data->title));
  $note = mysqli_real_escape_string($con, trim($request->data->note));

  // Update.
  $sql = "UPDATE `notes` SET `title`='$title',`note`='$note' WHERE `id` = '{$id}' LIMIT 1";

  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}