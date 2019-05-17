<?php
session_start();
include "config.php";

// Create connection
$conn = new mysqli($myServer, $myUser, $myPass, $myDB);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$regcode=$_POST["f1"];
$studname=$_POST["f2"];
$course=$_POST["f3"];
$yearnsem=$_POST["f4"];

$_SESSION["regcode"]=$regcode;

	$sql = "SELECT * FROM logindet where regcode=$regcode";
	//echo $sql; 
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
	$sql1 = "update logindet set studname='$studname',course='$course',yearnsem='$yearnsem' where regcode=$regcode"; 
	}
	else
	{
	$sql1 = "insert into  logindet values($regcode,'$studname','$course','$yearnsem')"; 
        }
          $_SESSION["connect"]=1;
	    $result1 = $conn->query($sql1);
	    header("location:moddet.php");
 	 
	/*
	else 
	{
		
		header("location:signin.html");
		echo " Invalid User/Password Detail";
	}
	*/
$conn->close();
?>
