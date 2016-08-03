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
	
//===========post=============
case 'POST':
echo "Here is POST";


$username=$_POST['username'];
$password=$_POST['pass'];
$email=$_POST['email'];

$checkid=mysql_query("SELECT * from personal WHERE username='$username'") or die("Could not issue MySQL query");

$records = mysql_num_rows($checkid);

if($records>0){
	
	echo "Duplicate";
	return;
}else{
	
	$sqlstring="insert into personal (username,password,email) values ('$username', '$password', '$email')";
	
	mysql_query($sqlstring);
	
}


 break;
//=============GET============
case 'GET':
$username=$_GET['username'];
$password=$_GET['pass'];
$checkid=mysql_query("SELECT * from personal WHERE username='$username' and password='$password'") or die("Could not issue MySQL query");

$records = mysql_num_rows($checkid);

if($records>0){
	echo "success";

}else{
	
	echo "fail to login";

	return;
}


 break;
//==============PUT============ 
case 'PUT':

 echo "Here is PUT";

    parse_str(file_get_contents("php://input"),$post_vars);

   

    $blogid=$post_vars['blogid1'];

    $emotion=$post_vars['emotion3'];

    $content1=$post_vars['content1'];

 echo $blogid;
 echo  $emotion;
echo $content1;

    //check review id from database

 /*   $checkid=mysql_query("SELECT * from review WHERE review_id='$review_id2'") or die("Could not issue MySQL query");

    $total_records1 = mysql_num_rows($checkid);

 

    if($total_records1 >= 1){

      //if review id exist, UPDATE the review

      $query = "UPDATE review SET rating='$rating4', comments='$comments2' WHERE review_id='$review_id2'";

      $statement = mysql_query($query);

      echo "<font color='red'>Record Updated successful!</font><br/>".htmlspecialchars($query);

    }

    else{

      echo "<font color='red'>No such review ID!</font><br/>".htmlspecialchars($query);

    }*/

 

    break;

//===================delete================
    case 'DELETE':

    parse_str(file_get_contents("php://input"),$post_vars);

 echo "Here is Delete";

      $review_id3=$post_vars['review_id'];

 

    //check the review id from 'review' database

  /*  $checkid=mysql_query("SELECT * from review WHERE review_id='$review_id3'") or die("Could not issue MySQL query");

    $total_records1 = mysql_num_rows($checkid);

 

    if($total_records1 >= 1){

      //if the review id exist, DELETE the review from 'review' database

      $del="DELETE FROM review WHERE review_id='$review_id3'" ;

      $result=mysql_query($del, $conn) or die("error");

 

      echo "<font color='red'>Record deleted successful!</font><br/>".htmlspecialchars($del);

 

      }

      else{

        echo "<font color='red'>No such review ID!</font><br/>".htmlspecialchars($del);

      }*/

 

    break;

 

  default:

    rest_error($request); 

    break;
}
	?>