<?php 
$con = new mysqli('localhost','root','',"assessment");

if(!$con){
    die(mysqli_error($con));
}

?>