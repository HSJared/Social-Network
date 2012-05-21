<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");


//Start printing the page
include("header.php"); //Universal Start of Page

echo "<br/><br/><br/>";
$userid = $_SESSION['userid'];
$friendsquery="SELECT * FROM relations RIGHT JOIN userinfo ON
        (userinfo.`userid` = relations.`userid1`
    OR
        userinfo.`userid` = relations.`userid2`)
    AND
        userinfo.`userid` != '$userid'
    AND 
    	relations.`relation` = '2'
    WHERE
        relations.`userid1` = '$userid'
    OR
        relations.`userid2` = '$userid';";
$friendsresult=mysql_query($friendsquery) or die('Unable to check for requests');
$numberoffriends = mysql_num_rows($friendsresult);
if ($numberoffriends)
{
		 echo "<h1>You have $numberoffriends Friends!</h1><table id='requeststable' class='requesttable' border=\"1\"><tr>";
		 while ($row = mysql_fetch_assoc($friendsresult)) 
		{
			//Get Info about this user
		$friendid =  $row["userid"];
		
		//Check whether query was successful or not
		$fname = $row['fname'];
		$lname = $row['lname'];
		
		//Print Table Content
		echo "<tr><td><h3><a href='profile.php?id=$friendid' 'alt='$fname $lname's Profile'>$fname $lname</a></h3>";
		if(isset($row['city']))
		{
			echo $row['city'];
			echo ", ";
			echo $row['state'];
		}
    	echo "</td><td><button type=\"button\" onclick=\"window.location = 'deletefriend.php?id=$friendid';\">Delete Friend</button></td></tr>";
		}
		echo "</table>";
}
else echo "<h1>You have no Friends :(</h1>";



//Print off the Universal Footer of the page
include ("footer.php");
?>