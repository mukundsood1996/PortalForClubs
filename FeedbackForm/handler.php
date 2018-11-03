<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
Tested working with PHP5.4 and above (including PHP 7 )

 */
require_once './vendor/autoload.php';

use FormGuide\Handlx\FormHandler;


$pp = new FormHandler(); 

$validator = $pp->getValidator();
$validator->fields(['name','email'])->areRequired()->maxLength(50);
$validator->field('email')->isEmail();
$validator->field('comments')->maxLength(6000);

// $pp->sendEmailTo('srinivasshekar01@gmail.com'); // ← Your email here


// require_once 'connection.php'
$servername = "localhost";  
$username = "root";  
$password = "";  
$conn = mysqli_connect ($servername , $username , $password,'feedback') or die("unable to connect to host");  
$sql = mysqli_select_db ($conn,'feedback') or die("unable to connect to database"); 

// mysql_query("INSERT INTO `feedback` VALUES ('Good', 'Hey', 'S','s', 'CSR3') ") or die(mysql_error());


extract($_POST);
$rating = $_POST['rating']; 
$comments = $_POST['comments'];
$name = $_POST['name'];
$email = $_POST['email'];
$club = $_POST['club'];

// echo "<script> '$comments' </script>";


// mysql_query("INSERT INTO 'feedback' VALUES('".$_POST['rating']."','".$_POST['comments']."','".$_POST['name']."','".$_POST['email']."','".$_POST['club']."'))" ;


mysqli_query($conn,"INSERT INTO `feedback`(rating,comments,name,email,club) VALUES ('$rating', '$comments', '$name','$email', '$club') ") or die(mysql_error());


echo $pp->process($_POST);

?>