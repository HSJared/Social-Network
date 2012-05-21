<?php

//Start Session
session_start();

//Include Config
include("config.php");

//Print Page
include("header.php");
echo "<h2 align=\"center\" class=\"err\">Access Denied!<br />";
if(!isset($_SESSION['userid']))
{
	echo "<br/>Please Register</h2>";
	include ('regform.php'); 
}
else
{
	echo "<button onclick=\"goHome()\">Click here to go back to the homepage</button>";
}
include ('footer.php'); 
?>