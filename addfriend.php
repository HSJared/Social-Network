<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");

//Library of Friend Functions
include("friendingfunctions.php");

//Check to see if user requested exists
$userid = intval($_GET['id']);
$loginquery="SELECT * FROM login WHERE userid='$userid'";
$loginresult=mysql_query($loginquery);
if (!mysql_num_rows($loginresult))
{
		header("location: 404.php"); //If not redirect
}

$myuserid = $_SESSION['userid'];

//Get the current relation status
$f = friendStatus($userid,$myuserid);

//Based on this relation status, do what is appriopate. 
switch ($f)
{	
	/****relations table: 
	0 = userid1 requested by userid2
	1 = Nothing, held in reserve for follow feature later on
	2 = friends with eachother 
	3 = userid1 blocked by userid2
	*****/
	case 0:
		{	//This completes a friend request
		$requestquery="insert into relations(userid1, userid2, relation) values('$userid','$myuserid','0')";
		$result=mysql_query($requestquery,$conc) or die("Unable to send friend request");
		header("location: profile.php?id=$userid"); //Redirect back to user's profile
		}
		break;
	case 3:
		{	//Since the other user has requested the logged in user, we can just convert this request into a friend request. 
		$addquery="Update relations SET relation=2 WHERE userid1='$myuserid' and userid2='$userid';";
		$result=mysql_query($addquery,$conc) or die("Unable to send friend request");
		header("location: profile.php?id=$userid"); //Redirect back to user's profile
		}
	case 2:
		{
		include("head.php");
		include("navtop.php");
		echo "<h2 align=\"center\" class=\"err\">You have already requested this user! You may only send one request!<br />";
		echo "<button onclick=\"goHome()\">Click here to go back to the homepage</button>";
		include ('footer.php'); 
	}
		break;
	case 1:
		{
		include("head.php");
		include("navtop.php");
		echo "<h2 align=\"center\" class=\"err\">You are already friends with this user!<br />";
		echo "<button onclick=\"goHome()\">Click here to go back to the homepage</button>";
		include ('footer.php'); 
		}
		break;
	case -1:
		{
		include("head.php");
		include("navtop.php");
		echo "<h2 align=\"center\" class=\"err\">You can not add yourself as a friend!<br />";
		echo "<button onclick=\"goHome()\">Click here to go back to the homepage</button>";
		include ('footer.php'); 
		}
		break;
}