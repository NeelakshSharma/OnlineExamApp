<!doctype html>
<html>
<head>
    <title>Login</title>
    <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
</head>
<body>
    <h3>Login</h3>
    <hr />
    <a href = "tr5.php">Redirect to Home</a>
</body>
</html>

<?php
session_start();
$_SESSION["recnum"]=0;
$_SESSION["connect"]=0;
$_SESSION["regcode"]=0;


    $numbers = range(1, 40);
    shuffle($numbers);
	/*for($i=0;$i<20;$i++)
	{
		echo "<br/>$i:".$numbers[$i];
	}
	*/
	sort($numbers);
	/*
	for($i=0;$i<20;$i++)
	{
		echo "<br/>$i:".$numbers[$i];
	}
     */
    shuffle($numbers);
    $_SESSION["ind"]=$numbers;

header("location:signin.html");
?>

