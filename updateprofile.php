<?php
session_start();

###Connect to database###
include("config.php");

$userid = $_SESSION['userid'];

if(isset($_GET['mname']))
{
	$mname = $_GET['mname'];
	$sql = "UPDATE userinfo SET mname = '$mname' WHERE userid = $userid;";
	$result=mysql_query($sql,$conc) or die("Unable to insert userinfo into db");
	header("location: home.php");
}
if(isset($_GET['nickname']))
{
	$nickname = $_GET['nickname'];
	$sql = "UPDATE userinfo SET nickname =$nicknamewhere userid = $userid;";
	$result=mysql_query($sql,$conc) or die("Unable to insert userinfo into db");
	header("location: home.php");
}
if(isset($_GET['phonenum']))
{
	$phonenum = $_GET['phonenum'];
	$sql = "UPDATE userinfo SET phonenum = $phonenum WHERE userid = $userid;";
	$result=mysql_query($sql,$conc) or die("Unable to insert userinfo into db");
	header("location: home.php");
}
if(isset($_GET['addressline1']))
{	
	$addressline1 = $_GET['addressline1'];
	$city = $_GET['city'];
	$state = $_GET['statepro'];
	$postalcode = $_GET['postalcode'];
	$sql = "UPDATE userinfo SET addressline1 = '$addressline1', city = '$city', state = '$state', postalcode = '$postalcode' where userid = $userid;";
	$result=mysql_query($sql,$conc) or die("Unable to insert userinfo into db");

	if(!empty($_GET['addressline2']))
	{
			$addressline2 = $_GET['addressline2'];
			$sql = "UPDATE userinfo SET addressline2 = '$addressline2' WHERE userid = $userid;;";
			$result=mysql_query($sql,$conc) or die("Unable to insert addressline2 into db");
	}
	header("location: home.php");
}

?>