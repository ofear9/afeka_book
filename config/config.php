<?php
ob_start(); // Turns on output buffering
session_start(); 

$timezone = date_default_timezone_set("Asia/Jerusalem");

$con = mysqli_connect("localhost","root","","social");  //Connections var
if(mysqli_connect_errno())
{
	echo "Faild to connect: " . mysqli_connect_errno();
}

?>
