

 <!DOCTYPE html>

<html>

<head>

    <title>HOME</title>
	<link rel="stylesheet" href="website.css">

</head>

<body>

<header>
        <h1>Personalised Healthcare System</h1>
        <h4>Keep track of your health</h4>
</header>

<div class="navbar">
<?php 

session_start();

if (isset($_SESSION['uid'])) {

 ?>
     <h4>Hello, <?php echo $_SESSION['uid']; ?></h4>

     <a href="logout.php">Logout</a>

<?php
}
?>

<a href="website1.php" >Home</a>

<?php 

if (!isset($_SESSION['uid'])) {

 ?>

     <a href="login.html">Register/Sign In</a>

<?php
}
?>

<a href="symptomform.php">Symptom Checker</a>

<a href="entry1.php">COVID checker</a>

<a href="data.php">All patient data</a>

<a href="userdata.php">User data</a>

<a href="room.php">Room conditions</a>

</div>

    <main>
        <section>
            <h2>Welcome to your personalised healthcare system!</h2>
		  This is a self-monitoring system to keep track of your health at home. <br>Check if you're experiencing unwanted symptoms and feel like you might have a common disease/medical problem. <br>Remember, this does not replace medical diagnosis!
		<br><br>
Click on one of the options from the navigation bar above to get started! Go <a href="about.html">here</a> to find out more. <br><br>
		  <img src="covid.jpg" alt="covid" width=600 style="border-radius:25px">
		  <br>
		</section>
		<section>
		<h2> Group member details</h2>
			<br><br>
			Simarjeet Kaur Bhatia, 20103044
			<br><br>Guneet Kaur Bhatia, 20103045
			<br><br>Priyam Sahrawat, 20103056  
        </section>
    </main>

    <footer>
        <a href="about.html">About</a>
    </footer>
</body>
</html>
