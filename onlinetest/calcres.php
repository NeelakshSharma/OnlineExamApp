<?php
session_start();
$_SESSION["result"]=0;
$regcode=$_SESSION["regcode"];
$modname=$_SESSION["modname"];

include "config.php";
$con=mysqli_connect($myServer,$myUser,$myPass,$myDB);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$t=$modname."ansdet";
$sql1="select * from $t where regcode=$regcode";
$res1=mysqli_query($con,$sql1);
$res=0;
if ($res1->num_rows > 0) 
	{
		while($row=$res1->fetch_assoc())
		{
             $ques=$row["qnum"];
 		  $ans=$row["ans"];
//             echo " ques : $ques ans : $ans ";
			$t1=$modname."corrans";
		  $sql2="select * from $t1 where qnum=$ques";
		  $res2=mysqli_query($con,$sql2);
  		 	if ($res2->num_rows > 0) 
	  	 	{
			$row1=$res2->fetch_assoc();	
			$corrans=$row1["ans"];
			//echo " correct ans : $corrans<br/> ";
                if($ans == $corrans)
       		   $res=$res+1;   
  		 	}//if ends
		}//while ends
 }//if ends


	$sql3 = "update moduledet set result=$res where regcode=$regcode and modname='$modname'";  
      $result3 = $con->query($sql3);

echo "
      <body bgcolor=blue>
	<br/><br/><br/><br/><br/>
	<br/><br/><br/><br/><br/>
      <table width=400 bgcolor=cyan align=center>
       <tr>
       <td align=center>
      <font color=blue><h2>Thanks For Attempting the test</h2>
       </td>
       </tr>
       <tr>
       <td align=center>
      <font color=blue><h2>Registration code : $regcode</h2>
       </td>
       </tr>
       <tr>
       <td align=center>
      <font color=blue><h2>Result: $res</h2>
       </td>
       </tr>
       </table>
</body>
";
$_SESSION["connect"]=0;
header("location: dispres.php");
?>
