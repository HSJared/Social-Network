<?php

include("authen.php");
include("config.php");
include("friendingfunctions.php");
header('content-type: text/xml');
$userid = intval($_GET['id']);
$myuserid = $_SESSION['userid'];

    //If not own profile, let's look into friend status
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
$friendsresult=mysql_query($friendsquery) or die("Unable to query DB!");

$xml = new SimpleXMLElement('<xml/>');

while ($row = mysql_fetch_assoc($friendsresult)) 
{
	$friendsstatusquery ="SELECT userid1,userid2 FROM relations where (`userid1` = '$myuserid' AND relation = '2') OR (`userid2` = '$myuserid' AND relation = '2');";
	$friendsstatus=mysql_query($friendsquery) or die("Unable to query DB!"); 

	$friend = $xml->addChild('friend');
	$userid = $row['userid'];
	$friend->addChild('userid', "$userid");
	$fname = $row['fname'];
	$friend->addChild('fname', "$fname");
	$lname = $row['lname'];
	$friend->addChild('lname', "$lname");
	$gender = $row['gender'];
	$friend->addChild('gender', "$gender");
	$bdate = $row['bdate'];
	$friend->addChild('bdate', "$bdate");
	$friendstatus = friendStatus($userid,$myuserid);
	$friend->addChild('friendsstatus', "$friendstatus");
}

print($xml->asXML());

?>