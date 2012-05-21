<?php
session_start();

###Connect to database###
include("config.php");

$userid = $_SESSION['userid'];
$content = mysql_real_escape_string($_POST['dispatch']); //fix to make sure query is not messed up

if(isset($_GET['recipient']))
{
	//The user is posting on another's wall
	$recipient = intval($_GET['recipient']);
	$sql = "INSERT into messages(userid,recipientid,content) values('$userid','$recipient','$content')";	
	$result=mysql_query($sql,$conc) or die("Unable to insert your posting to $recipient into db");
	header("location: home.php");
}
else
{
	//This means the user is posting a status
	$recipient = intval($_GET['mname']);
	$sql = "INSERT into messages(userid,content) values('$userid','$content')";	
	$result=mysql_query($sql,$conc) or die("Unable to insert your status into db");
	header("location: home.php");
}

?>