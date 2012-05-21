<?php
//Get our userid
$userid = $_SESSION['userid'];

//Get Info about this user
$userinfoquery="SELECT * FROM userinfo WHERE userid='$userid'";
$userinforesult = mysql_query($userinfoquery);
$userinfo = mysql_fetch_assoc($userinforesult);

//Check for Requests
$requestsquery="SELECT * FROM relations WHERE userid1='$userid' and relation='0';";
$requestsresult=mysql_query($requestsquery) or die('Unable to check for requests');
$numberofrequests = mysql_num_rows($requestsresult);

//If there are requests, bug user about it
if ($numberofrequests)
{
		echo "<h3>You have $numberofrequests Request(s)!</h3><table id='requeststable' class='requesttable'><tr>";
		$thecount = 0;
		
		//Print off the first three requests
		for ($thecount; ($thecount < 3) && ($thecount < $numberofrequests); $thecount++) 
		{
			//Get the data
			$row = mysql_fetch_assoc($requestsresult);
			
			//Get Info about this user
			$requesterid =  $row["userid2"];
			$requesterquery="SELECT * FROM userinfo WHERE userid='$requesterid'";
			$requesterresult=mysql_query($requesterquery) or die("Unable to query for user!");
			$requesterinfo = mysql_fetch_assoc($requesterresult);	
			$fname = $requesterinfo['fname'];
			$lname = $requesterinfo['lname'];
				
			//Print Table Content
			echo "<tr><td>
				<h3><a href='profile.php?id=$requesterid' 'alt='$fname $lname's Profile'>$fname $lname</a></h3><td>
				<button type=\"button\" onclick=\"window.location = 'addfriend.php?id=$requesterid';\">Approve</button> <button type=\"button\" onclick=\"window.location = 'denyrequest.php?id=$requesterid';\">Deny</button>
				</td></tr>";
		}
		echo "</table>";
		
		//If there are more request, give user option to go to that page
		if (($numberofrequests - $thecount) != 0)
			echo "<hr><button type=\"button\" onclick=\"goToMyRequests()\">See all $numberofrequests requests</button>";
}
if (!isset($userinfo['defaultpicid']))
{
	echo "<hr><h3>Upload a profile picture!</h3>";
	include ("profpicform.php");
	echo "<hr>";
}
else if(!isset($userinfo['mname']))
{
	echo "<h3>Complete your profile</h3><form name=\"input\" onsubmit=\"return validatemissinginfomname()\" action=\"updateprofile.php\" method=\"get\"> Middlename: <input type=\"text\" name=\"mname\" /><input type=\"submit\" value=\"Submit\"/></form>";
}
else if(!isset($userinfo['nickname']))
{
echo "<h3>Complete your profile</h3><form name=\"input\" onsubmit=\"return validatemissinginfonickname()\" action=\"updateprofile.php\" method=\"get\"> Nickname: <input type=\"text\" name=\"nickname\" /><input type=\"submit\" value=\"Submit\"/></form>";
}
else if(!isset($userinfo['phonenum']))
{
	echo "<h3>Complete your profile</h3><form name=\"input\" onsubmit=\"return validatemissinginfophonenum()\" action=\"updateprofile.php\" method=\"get\"> Phone Number: <input type=\"text\" name=\"phonenum\" /><input type=\"submit\" value=\"Submit\"/></form>";
}
else if(!isset($userinfo['addressline1']))
{
	echo "<h3>Complete your profile</h3><form name=\"missinginfo\" action=\"updateprofile.php\" method=\"get\"><table><tr><td>Address Line 1: </td><td><input type=\"text\" name=\"addressline1\" /></td></tr><tr><td>Address Line 2: </td><td><input type=\"text\" name=\"addressline2\" /></td></tr><tr><td>City: </td><td><input type=\"text\" name=\"city\" /></td></tr><tr><td>State/Province: </td><td><input type=\"text\" name=\"statepro\" /></td></tr><tr><td>Postal Code: </td><td><input type=\"text\" name=\"postalcode\" /></td>
</tr><tr><td></td><td>
<input type=\"submit\" value=\"Submit\"/></td></tr></table></form>";
}
?>