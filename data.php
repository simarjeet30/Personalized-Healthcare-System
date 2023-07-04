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
<title>Patient Data</title>
<style>
table {
  margin-left: auto;
  margin-right: auto;
  width: 100%;
}
tr:hover {background-color: rgb(33, 197, 115)}
td {
  height: 70px;
}
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
<a href='userlogout.php' >Log out</a>
<a href='entry1.php' >COVID checker</a>
</div>";
}

if (isset($_SESSION['logged_in']) and $_SESSION['logged_in']==true)
{

echo "<table>

<tr>
<th>ID</th>
<th>Gender</th>
<th>Age</th>
<th>Heart_rate</th>
<th>Temperature</th>
<th>SpO2 saturation</th>
<th>BPM</th>
<th>Health_status</th>
</tr>";

  $flag=0;
  $query="SELECT * FROM patientdata";
  $res=mysqli_query($conn,$query);
  while ($row=mysqli_fetch_array($res))
  {
    $flag++;
    echo "<tr><td>" . $row['id'] . "</td>";
    echo "<td>" . $row['gender'] . "</td>";
    echo "<td>" . $row['age'] . "</td>";
    echo "<td>" . $row['heart_rate'] . "</td>";
    echo "<td>" . $row['temperature'] . "</td>";
    echo "<td>" . $row['SpO2_saturation'] . "</td>";
    echo "<td>" . $row['bpm'] . "</td>";
    echo "<td>" . $row['Health_status'] . "</td>";
    echo "</tr>";
  }

if ($flag) echo "<h4>" . $flag . " results</h4>";

echo "</table>";

if (!$flag) echo "No results";
}

else {header("Location:login.html");}

?>

    <footer>
        <a href="about.html">About</a>
    </footer>

</body>
</html>