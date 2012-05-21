<?php
	//Destroy session
	session_start();
	session_destroy();
	
	//Redirect to Homepage
	header("location: index.php");

?>