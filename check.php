<?php

session_start();

$conn = mysqli_connect('localhost:3306','abcd','looneytunes','minor');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['sub']))
{
$id=$_POST['uid'];
$res = mysqli_query($conn, "SELECT * FROM login_details WHERE uid='$id'");
$flag=0;
while($row = mysqli_fetch_array($res))
{
$flag=1;
}
if (!$flag) {echo "Wrong username or password. Redirecting"; header( "refresh:5;url=login.html"); }
else
{
$res2 = mysqli_query($conn, "SELECT upass FROM login_details WHERE uid='$id'");
$row = mysqli_fetch_array($res2);
if ($row['upass']!=$_POST['upass']) {echo "Wrong username or password. Redirecting"; header( "refresh:5;url=login.html"); }
else
{
$_SESSION['uid']=$_POST['uid'];
$_SESSION['logged_in']=true;
header("Location:website1.php");
}
}
}

if(isset($_POST['reg']))
{
$res=mysqli_query($conn, "INSERT INTO login_details VALUES ('$_POST[uid]', '$_POST[uname]', '$_POST[uphone]', '$_POST[upass]')");
if ($res) {echo "Thanks for registering. Redirecting"; header( "refresh:5;url=login.html");}
else {echo "That username is taken. Redirecting"; header( "refresh:5;url=login.html");}
}

?>