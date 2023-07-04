<?php
class dht11{
 public $link='';
 function __construct($temperature, $humidity){
  $this->connect();
  $this->storeInDB($temperature, $humidity);
 }
 
 function connect(){
  $this->link = mysqli_connect('localhost:3306','abcd','looneytunes','minor') or die('Cannot connect to the DB');
 }
 
 function storeInDB($temperature, $humidity){
  $query = "insert into dht11 set humidity='".$humidity."', temp='".$temperature."'";
  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
 }
 
}
if($_GET['temp'] != '' and  $_GET['humidity'] != ''){
 $dht11=new dht11($_GET['temp'],$_GET['humidity']);
}


?>