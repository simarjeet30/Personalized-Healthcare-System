<?php

session_start();

$conn = mysqli_connect('localhost:3306','abcd','looneytunes','minor');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="website.css">
<title>Room conditions</title>
<style>
table {
  margin-left: auto;
  margin-right: auto;
}
tr:hover {background-color: rgb(33, 197, 115)}
td {
  height: 70px; width:300px;
}
.red {color:red;}
</style>
</head>

<body>

<header>
        <h1>Personalised Healthcare System</h1>
        <h4>Keep track of your health</h4>
</header>

<?php
header( "refresh: 10" );
if (isset($_SESSION['logged_in']) and $_SESSION['logged_in']==true)
{
echo"<div class='navbar'>
<a href='userlogout.php' >Log out</a>";
}

echo "<a href='website1.php' >Home</a>
</div>";


if (isset($_SESSION['logged_in']) and $_SESSION['logged_in']==true)
{

$command = escapeshellcmd('py C:\xampp\htdocs\minor\pycode.py');
$op=null; $retv=null;
shell_exec($command);

$res1=mysqli_query($conn,"SELECT * FROM dht11");
$rows=mysqli_num_rows($res1);

$res=mysqli_query($conn, "SELECT * FROM dht11 WHERE id='$rows'");
$res2=mysqli_fetch_array($res);
$dtime=$res2['datetime'];
$temp=$res2['temp'];
$hum=$res2['humidity'];

if ($res)
{
	echo "<h3> Date and time: " . $dtime . "</h3> <b> Current temperature: </b>" . $temp . " C";
	echo "<br> <b> Current humidity: </b>" . $hum . "% <br>";
	echo "<br><br> <h3> Your current room conditions increase chances of being ";
	echo file_get_contents('out.txt');
	echo "</h3><br>";

	echo "Please take necessary precautions to stop the spread of COVID-19! Go out only when necessary and use face masks if you do have to go out.<br> Thank you for using our services!";

	echo "<br><br><b>More on how we got this prediction (Training process):</b><br><br>";

	echo "<img src='foo.png'><br>";

	 echo nl2br(file_get_contents('pyout.txt'));
}

}

if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in']==false)
{
header("Location:login.html");
}
?>

    <footer>
        <a href="about.html">About</a>
    </footer>

</body>
</html>