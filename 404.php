<?php

//Start Session
session_start();

//Include Config
include("config.php");

//Print Page
include("header.php");
	//If not a logged in user, pester them to register
    if(!isset($_SESSION['userid']))
    {
    	echo "<h2 align=\"center\" class=\"err\">Not Found!<br /><br/>Please Login or Register</h2>";
		include ('regform.php'); 	
	}//If a user, just tell them access denied, redirect to homepage
	else 
	{
	echo "<h2 align=\"center\" class=\"err\">Not Found!<h2><h1><a href='home.php' alt='The Brotherhood Homepage'>Click here to go back to the homepage</a></h1>";
	}
include ('footer.php'); 
?>