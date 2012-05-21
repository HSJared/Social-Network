<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");


include("header.php"); //Universal Start of Page

$userid = $_SESSION['userid'];
$requestsquery="SELECT * FROM relations WHERE userid1='$userid' and relation='0';";
$requestsresult=mysql_query($requestsquery) or die('Unable to check for requests');
$numberofrequests = mysql_num_rows($requestsresult);
if ($numberofrequests)
{
		 echo "<h1>You have $numberofrequests Request(s)!</h1><table id='requeststable' class='requesttable' border=\"1\"><tr>";
		 while ($row = mysql_fetch_assoc($requestsresult)) 
		{
			//Get Info about this user
		$requesterid =  $row["userid2"];
		$requesterquery="SELECT * FROM userinfo WHERE userid='$requesterid'";
		$requesterresult=mysql_query($requesterquery) or die("Unable to query for user!");
		$requesterinfo = mysql_fetch_assoc($requesterresult);	
	
		//Check whether query was successful or not
		$fname = $requesterinfo['fname'];
		$lname = $requesterinfo['lname'];
		
		//Print Table Content
		echo "<tr><td><h3><a href='profile.php?id=$requesterid' 'alt='$fname $lname's Profile'>$fname $lname</a></h3><td>";
    	echo "<button type=\"button\" onclick=\"window.location = 'addfriend.php?id=$requesterid';\">Approve</button> <button type=\"button\" onclick=\"window.location = 'denyrequest.php?id=$requesterid';\">Deny</button></td></tr>";
		}
		echo "</table>";
}
else echo "<h1>No Friend Requests</h1>";

while ($row = mysql_fetch_assoc($requestsresult)) {
    echo $row["userid"];
    echo $row["fullname"];
    echo $row["userstatus"];
}


//Print off the Universal Footer of the page
include ("footer.php");
?>