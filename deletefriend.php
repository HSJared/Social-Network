<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");

//Check to see if user requesting exists
$userid = intval($_GET['id']);
$myuserid = $_SESSION['userid'];


$requestquery="Delete FROM relations where `relation` = '2' AND ((`userid1` = '$myuserid' AND `userid2` = '$userid') OR (`userid1` = '$userid' AND `userid2` = '$myuserid'));"; 
$result=mysql_query($requestquery,$conc) or die("Unable to delete friend");
header("location: friends.php"); //Redirect back to user's friendpage
	