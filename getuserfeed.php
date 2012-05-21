<?php

include("authen.php");
include("config.php");
include("friendingfunctions.php");
header('content-type: text/xml');
$userid = intval($_GET['id']);
$myuserid = $_SESSION['userid'];

$xml = new SimpleXMLElement('<xml/>');

$f = friendStatus($userid,$myuserid);
if ($f == 2 || $f == -1)
{
	$friend = $xml->addChild('friendstatus','1');
	$statusquery="SELECT * from (SELECT * FROM messages where (userid = '$userid' AND recipientid IS NULL) OR recipientid = '$userid') as feed NATURAL JOIN userinfo as feedwithinfo ORDER BY timestamp DESC;";
	$statusesresult=mysql_query($statusquery) or die("Unable to query DB!");
	if (mysql_num_rows($statusesresult))
	{
		 $hasp = $xml->addChild('haspostings','1');
		 $postings = $xml->addChild('postings');
		 while ($row = mysql_fetch_assoc($statusesresult))
		 {
		 		$thispost = $postings->addChild('post');
				$userid = $row['userid'];
				$thispost->addChild('userid', "$userid");
				$fname = $row['fname'];
				$thispost->addChild('fname', "$fname");
				$lname = $row['lname'];
				$thispost->addChild('lname', "$lname");
				$time = $row['timestamp'];
				$thispost->addChild('timestamp', "$time");
				$content = $row['content'];
				$thispost->addChild('content', "$content");
				
		 }
	}
	else
	{
		$hasp = $xml->addChild('haspostings','0');
	}
}
else
{
	$friend = $xml->addChild('friendstatus','0');
}
print($xml->asXML());
?>