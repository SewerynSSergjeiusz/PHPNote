<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
$postdata = file_get_contents("php://input");
//var_dump($postdata);
if(isset($postdata) && !empty($postdata))
{
	$request= json_decode($postdata);
	if(trim($request->data) === '')
	{
		return http_response_code(400);
	}

$uid= mysqli_real_escape_string($con, trim($request->data));
$notes = [];
$sql = "SELECT notes.id, notes.title, notes.note, notes.user_id FROM `notes` WHERE notes.user_id='{$uid}'";
if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $notes[$cr]['id']    = $row['id'];
    $notes[$cr]['title'] = $row['title'];
    $notes[$cr]['note'] =  $row['note'];
    $notes[$cr]['user_id']=$row['user_id'];
    $cr++;
  }
    
  echo json_encode(['data'=>$notes]);
}
else
{
  http_response_code(404);
}
}