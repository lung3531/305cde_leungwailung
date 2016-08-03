<?php
    $hostname = "127.0.0.1";
	$username = "root";
	$password = "123456";
	$connection = mysql_connect($hostname, $username, $password)
	or die("Could not open connection to database");

	mysql_select_db("leungwl", $connection)
	or die("Could not select database");
	//$result = mysql_query("select * from personal where login='test'");
	
	
$method = $_SERVER['REQUEST_METHOD'];
echo $method;
switch ($method){
	

//==============PUT============ 
case 'PUT':

echo "Here is PUT";

    parse_str(file_get_contents("php://input"),$post_vars);
    $username=	$post_vars['username'];
    $oldpass=	$post_vars['oldpass'];
    $newpass=	$post_vars['newpass'];

   $checkid=mysql_query("SELECT * from personal WHERE username='$username' and password='$oldpass'") or die 
   ("Could not issue MySQL query");

$records = mysql_num_rows($checkid);

if($records>0){
	
		$sqlstring="update personal set password='$newpass' where username='$username'";
	
	mysql_query($sqlstring);
	
	
	echo "Update seccessed";
	
		}else{
			 echo "No user found";
			 return;
		}		 
    break;

 

 

  default:

    rest_error($request); 

    break;
}
	?>