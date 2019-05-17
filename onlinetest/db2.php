<!doctype HTML>
<html>
<head>	
<script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>

<style>
 td
{
   font-size:20;
 }
</style>
<head>
<body>
<?php
session_start();

if($_SESSION["connect"]==0)
{
	header("location:calcres.php"); 
}
   
include "config.php";
// get connectivity
$con=mysqli_connect($myServer,$myUser,$myPass,$myDB);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$recnum=$_SESSION["recnum"];
$next=0;
$prevans=0;
$prev=0;
$ee=0;

$regcode=$_SESSION["regcode"];

$quesarr=$_SESSION["ind"];

$quesnum=$quesarr[$recnum];

$modname=$_SESSION["modname"];



if($_GET["submit"]=="NEXT")
{
  $next=1;
   if($recnum<39)
    $recnum=$recnum+1;
}

if($_GET["submit"]=="PREVIOUS")
{
   $prev=1;
   if($recnum>0)
 	 $recnum=$recnum-1;
}
if($_GET["submit"]=="END EXAM")
{
  	$ee=1;
	  header("location: calcres.php");
}
// to store or update answer opted  in database
{
  $opt=$_GET["ans"];
  if($opt=="")
      $opt=0;
  $t=$modname."ansdet";
  $ques=$_SESSION["recnum"];
  $quesnum=$quesarr[$ques];
  //$ques=$quesnum+1;	
  $sql1="select * from $t where qnum=$quesnum and regcode=$regcode";
//echo "sql : $sql1";
  $res=mysqli_query($con,$sql1);
  //echo "rows:.$res->num_rows";
  if ($res->num_rows > 0) 
  {
	
	$sql2="update $t set ans=$opt where qnum=$quesnum and regcode=$regcode";
  }
  else
  {
    $sql2="insert into $t values($regcode,$quesnum,$opt)"; 
  }
   //echo "sql: $sql2";
   
  if(!mysqli_query($con,$sql2))
   		echo "<h1> Problem in storing detail</h1>";
}


 if($prev==1)
  {  
  //echo "prev : $recnum";
  $q=$recnum+1;
  }
 if($next ==1)
 {
  $q=$recnum+1;
 }
 
$quesnum=$quesarr[$recnum];
  $sql3="select * from $t  where qnum=$quesnum and regcode=$regcode";
 // echo $sql3;
  $res3=mysqli_query($con,$sql3);
  //echo "rows:.$res->num_rows";
  if ($res3->num_rows > 0) 
  {	
	$row3=$res3->fetch_assoc();	
	$prevans=$row3["ans"];
  }

$quesnum=$quesarr[$recnum];
echo "<table align=center><tr><td>";
$t1=$modname."quesdet";

$sql="SELECT * FROM $t1 where qnum=$quesnum ";
//echo "recnum $recnum";
if ($result=mysqli_query($con,$sql))
  {
  // Seek to row number (recnum-1)
  //mysqli_data_seek($result,$quesnum);
  // Fetch row
  $row=mysqli_fetch_row($result);
  echo "<h3><br/><form>";
  printf ("<table width=800 height=500 align=center bgcolor=cyan><tr><td>Q.%d %s</td></tr>", $recnum+1, $row[1]);
  if ($prevans > 0)
  {
  if($prevans==1)
  echo "<tr><td><input type=radio name=ans value=1 checked>$row[2]	</td></tr>";
  else
echo "<tr><td><input type=radio name=ans value=1>$row[2]</td></tr>	";
  
  if($prevans==2)
  echo "<tr><td><input type=radio name=ans value=2 checked>$row[3]</td></tr>";
  else
echo "<tr><td><input type=radio name=ans value=2 >$row[3]</td></tr>";

if($prevans==3)
  echo "<tr><td><input type=radio name=ans value=3 checked>$row[4]</td></tr>";
else
   echo "<tr><td><input type=radio name=ans value=3>$row[4]</td></tr>";

if($prevans==4)
  echo "<tr><td><input type=radio name=ans value=4 checked>$row[5]</td></tr>";
else
  echo "<tr><td><input type=radio name=ans value=4>$row[5]</td></tr>";
  }
  else
  {
  echo "<tr><td><input type=radio name=ans value=1>$row[2]</td></tr>";
  echo "<tr><td><input type=radio name=ans value=2>$row[3]</td></tr>";
  echo "<tr><td><input type=radio name=ans value=3>$row[4]</td></tr>";
  echo "<tr><td><input type=radio name=ans value=4>$row[5]</td></tr>";
  }
  echo "<tr><td>select any one option</td></tr>
<tr><td align=center>
<input type=submit value=NEXT name=submit>
<input type=submit value=PREVIOUS name=submit>
<input type=submit value='END EXAM' name=submit>
</td></tr>
</form>
</table>
";
  // Free result set
  mysqli_free_result($result);
}
//echo "record number :$recnum";
$_SESSION["recnum"]=$recnum;
//echo $_SESSION["recnum"];

echo "</td><td>";


//  to display attempted questions //
echo "<br/><table align=center><tr>";
		for($r=1;$r<=40;$r++)
 		{ 
                $r1=$r-1;
                $qno=$quesarr[$r1];
			$ans=0;
		  $sql2="select * from $t where qnum=$qno and regcode=$regcode";
		  $res2=mysqli_query($con,$sql2);
                    	if ($res2->num_rows > 0) 
	  	 	{
			$row1=$res2->fetch_assoc();	
			$ans=$row1["ans"];
                        }
           

		   if($ans!=0)
			echo "<td width=50 height=50 align=center bgcolor=green><input type=submit name=sub value=$r></td>";
		   else
			echo "<td width=40 height=40 align=center bgcolor=yellow><input type=submit name=sub value=$r></td>";
                if($r%4==0)
                    echo "</tr><tr>";
	}
        echo "</tr><tr><td colspan=4 align=center>
         <input type=button style='background-color:green;'>Attempted
         <input type=button style='background-color:yellow;'> Not Attempted
		</td></tr>
              </table>";

echo "<td></tr></table>";

mysqli_close($con);
?>
</body>
</html>