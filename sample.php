<?php

session_start();

$conn = mysqli_connect('localhost:3306','abcd','looneytunes','minor');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$quer='start cmd.exe @cmd /k "cd C:\\Program Files\\R\\R-4.2.1\\bin && Rscript C:\\xampp\\htdocs\\minor\\script.R 99 1091"';
$quer2="cd C:\\Program Files\\R\\R-4.2.1\\bin && Rscript C:\\xampp\\htdocs\\minor\\script.R 99 1091";
echo $quer;
shell_exec($quer2);

?>