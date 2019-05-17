<?php
session_start();
include "config.php";

$regcode=$_SESSION["regcode"];




// Create connection
$conn = new mysqli($myServer, $myUser, $myPass, $myDB);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$modname=$_POST["f2"];
$_SESSION["modname"]=$modname;

	$sql = "SELECT * FROM moduledet where regcode=$regcode and modname='$modname'";
	//echo $sql; 
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
	$sql1 = "update moduledet set result=0  where regcode=$regcode and modname='$modname'"; 
	}
	else
	{
	$sql1 = "insert into  moduledet values($regcode,'$modname',0)"; 
        }
          $_SESSION["connect"]=1;
	    $result1 = $conn->query($sql1);
	header("location: instest.html");

?>

