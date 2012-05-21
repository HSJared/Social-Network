<?php
//Start Session
session_start();

	###Check whether the session userid exists. If not, redirect to homepage
	if(!isset($_SESSION['userid']) || (trim($_SESSION['userid']) == '')) {
		session_destroy();
		header("location: 403.php");
		exit();
	}
?>