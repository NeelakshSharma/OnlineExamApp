<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
</script>
	
<style type="text/css">
.style1 {
	font-size: xx-large;
	font-weight: bold;
}
body {
	background-color: #000066;
}
.style2 {
	font-size: x-large;
	font-weight: bold;
}
</style>
<script>
function f(frm)
{
  if(frm.f2.value==0)
   {
		alert("select any module")
    		return false;
    }
return true;
}
</script>
</head>

<body>
<?php
session_start();
$regcode=$_SESSION["regcode"];
?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="646" border="0" align="center" bgcolor="#66FFFF">
  <tr>
    <td><div align="center" class="style1">
      <div align="center">Dewan V.S. Group of Institutions</div>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </table>
<br/><br/>
<form action="modsave.php" method=post OnSubmit="return f(this);">
<table width=500  align=center bgcolor="cyan">

	  <tr>
    		<td colspan=2><h2>Enter The Following Details </h2> </td>
	</tr>
	<tr>
		<td align=right>
		<h3>Registration Number : 
		</td>
		<td>
		<h3><input type=text name=f1 value="<?php echo $regcode; ?>" readonly>
		</td>
	</tr>

	<tr>
		<td align=right>
		<h3>Module Name :
		</td>
		<td>
		<h3>
		<select name=f2 required>
		     <option value=0>Select Any Module</option>
			 <option value=php>PHP</option>
			 <option value=c>C</option>
			 <option value=java>Java</option>
			 <option value=apt>Aptitude</option>
		</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" align=center>
		<h2><input type=submit name=submit value="Submit">
		</td>
	</tr>
</table>
</body>
