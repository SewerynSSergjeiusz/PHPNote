<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$notes = [];
$sql = "SELECT id, title, note FROM notes";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $notes[$cr]['id']    = $row['id'];
    $notes[$cr]['title'] = $row['title'];
    $notes[$cr]['note'] =  $row['note'];
    $cr++;
  }
    
  echo json_encode(['data'=>$notes]);
}
else
{
  http_response_code(404);
}