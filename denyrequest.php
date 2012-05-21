<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");

//Check to see if user deleted exists
$userid = intval($_GET['id']);
$loginquery="SELECT * FROM login WHERE userid='$userid'";
$loginresult=mysql_query($loginquery);
if (!mysql_num_rows($loginresult))
{
		header("location: 404.php"); //If not redirect
}

$myuserid = $_SESSION['userid'];

//Delete Friend
$requestquery="DELETE from relations where userid1 = '$myuserid' AND userid2 = '$userid'"; //Since userid1 and userid2 are a combined primary key, there is no problem with this
$result=mysql_query($requestquery,$conc) or die("Unable to send friend request");
header("location: home.php"); //Redirect back to user's profile
	