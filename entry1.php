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
<title>Data entry</title>
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
if (isset($_SESSION['logged_in']) and $_SESSION['logged_in']==true)
{
echo"<div class='navbar'>
<a href='userlogout.php' >Log out</a>";
}

echo "<a href='website1.php' >Home</a>
</div>";


if (!isset($_POST['entry']) and isset($_SESSION['logged_in']))
{

$command = escapeshellcmd('py C:\xampp\htdocs\minor\bpmcode.py');
shell_exec($command);

$res1=mysqli_query($conn,"SELECT * FROM patientdata");
$rows=mysqli_num_rows($res1);

$res2=mysqli_query($conn, "SELECT * FROM patientdata WHERE id='$rows'");
$res3=mysqli_fetch_array($res2);
$bpm=$res3['bpm'];

echo "<form name='dataentry' method='post' action='entry1.php'>

<table>

<tr><td><b>Enter patient details and check their health status</b></td></tr>

<tr>
<td>User ID: </td>
<td>" . $_SESSION['uid'] . "</td>
</tr>

<tr>
<td>Gender of person: </td>
<td><input type=text name='gen'></td>
</tr>

<tr>
<td>Age: </td>
<td><input type=text name='age'></td>
</tr>

<tr>
<td>Temperature (in C): </td>
<td><input type=number name='tem'></td>
</tr>

<tr>
<td>SpO2 saturation: </td>
<td><input type=number name='sp'></td>
</tr>

<tr>
<td>Heart rate: </td>
<td>" . $bpm . " beats per minute as read by sensor</td>
</tr>

<tr><td><input type=submit value='Enter' name='entry' style='height:40px'></td></tr>

</table>
</form>";

}

if (isset($_POST['entry']))
{
$res1=mysqli_query($conn,"SELECT * FROM patientdata");
$rows=mysqli_num_rows($res1);

$un=$_SESSION['uid'];

$res=mysqli_query($conn, "UPDATE patientdata SET row_names ='$un' , gender= '$_POST[gen]', age= '$_POST[age]',temperature= '$_POST[tem]',SpO2_saturation='$_POST[sp]' WHERE id='$rows'");

$inp=$_POST['sp'];
$query="cd C:\\Program Files\\R\\R-4.2.1\\bin && Rscript C:\\xampp\\htdocs\\minor\\script.R " . $inp . " " . $rows;
shell_exec($query);

$res2=mysqli_query($conn, "SELECT Health_status FROM patientdata WHERE id='$rows'");
$res3=mysqli_fetch_array($res2);
$inf=$res3['Health_status'];

if ($res)
{
	echo "According to our system's predictions, the patient is <h3>" . $inf;
	echo "</h3><br>Thank you for using our services!";
}
else echo "There was an error";
unset($_POST['entry']);
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