<?php
session_start();
include "config.php";

$regcode=$_SESSION["regcode"];
$modname=$_SESSION["modname"];
$mks=0;

// Create connection
$conn = new mysqli($myServer, $myUser, $myPass, $myDB);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

	$sql = "SELECT * FROM logindet where regcode=$regcode";
	//echo $sql; 
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
		$row=$result->fetch_assoc();
		echo "<body bgcolor=blue><br/><br/><br/><br/><table bgcolor=cyan width=800 align=center border=1> <tr><td>";
		echo "<h2>Registration code :".$row["regcode"]."</h2>";
		echo "<h2>Name :".$row["studname"]."</h2>";
		echo "<h2>Course :".$row["course"]."</h2>";
		echo "<h2>Year and Semester :".$row["yearnsem"]."</h2>";


		echo "</td></tr>";
//  $mks=$row["result"];
 echo "<tr><td>";

/*	
 echo "<table width=800 height=50 border=0 bgcolor='blue'>
      <tr><td align=center><b><font color=cyan>Total Marks : 40</font></b></td></tr>
      </table>";

 echo "<table width=$barlen height=50  bgcolor=$color>
      <tr><td align=center></td></tr>
 </table>";
*/

echo "<table width=800 height=50 border=0> ";

	$sql1 = "SELECT * FROM moduledet where regcode=$regcode and modname='$modname'";
//	echo $sql1; 
	$result1 = $conn->query($sql1);
	
if($row1=$result1->fetch_assoc())
{
$mks=$row1["result"];
$modname=$row1["modname"];

   $totmks=40;
   $per=($mks/$totmks)*100;
    	 
    $fp=800;//370+30=400
    $barlen=($per*$fp)/100;

	if($per>=50)
		  $color="green";
	else
		  $color="red";
//echo "bar:$barlen";

echo "<table width=$barlen height=50 bgcolor=$color>
<tr><td><b><font> </font> </b></td></tr></table>
<table><tr><td><h3>Marks Obtained $per% in Module:$modname</h3></td></tr></table>";
}

echo "</td></tr>";
echo " </table></table></body>";
	}
	else 
	{
		echo " Error in DB operation";
	}
$conn->close();
?>

