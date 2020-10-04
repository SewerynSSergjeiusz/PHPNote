<?php
 require 'database.php';
 /* $request = json_decode($postdata);
 if(isset($postdata) && !empty($postdata)) {
	 
	 $email     = mysqli_real_escape_string($con, trim($request->data->email));
	 $password  = mysqli_real_escape_string($con, trim($request->data->password));
	 
	 $sth = $con->prepare('SELECT * FROM users WHERE email=:email limit 1');
	 $sth->bindValue(':email', $email, PDO::PARAM_STR);
	 $sth->execute();
	 
	 if($user) {
		 if($password_verify($password,$user['password'])){
			 $logged="loged";
			 echo json_encode(['data'=>$logged]);
		 }
		 else{
			 $loggedfail="couldnt logged in";
			 echo json_encode(['data'=>$loggedfail]);
		 }
		 
	 }
 }
 */
 
 

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
if(isset($postdata) && !empty($postdata))
{
	
$password = mysqli_real_escape_string($con, trim($request->password));
$email = mysqli_real_escape_string($con, trim($request->email));
$rows ="login succes";
$sql = mysqli_prepare($con, "SELECT id, email, password FROM users WHERE email = ?");
$sql->bind_param("s", $email);
$sql->execute();
$sql->store_result();
$sql->bind_result($uid, $uemail, $pw);

if($sql->num_rows == 1){
	$sql->fetch();
	if (password_verify($password, $pw)){
		
		 echo json_encode($uemail);
		}
	}
	else
	{
		http_response_code(404);
	}
}
/*$sql = "SELECT id FROM users where email='$email' and password='$password'";
if($result = mysqli_query($con,$sql))
{
$rows = array();
while($row = mysqli_fetch_assoc($result))
{
$rows[] = $row;
}
echo json_encode($rows);
}
else
{
http_response_code(404);
}
} 
*/
?>