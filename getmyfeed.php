<?php

include("authen.php");
include("config.php");
header('content-type: text/xml');
$myuserid = $_SESSION['userid'];

$xml = new SimpleXMLElement('<xml/>');


$statusquery="SELECT largefeed.`userid` as userid,largefeed.`fname` as fname,largefeed.`mname` as mname,largefeed.`lname` as lname,largefeed.`id` as id,largefeed.`recipientid` as recipientid,largefeed.`timestamp` as timestamp,largefeed.`content` as text,largefeed.`private` as private,userinfo.`fname` as rfname,userinfo.`lname` as rlname,userinfo.`mname` as rmname from userinfo RIGHT JOIN (SELECT userid,fname,mname,lname,id,recipientid,timestamp,content,private FROM userinfo Natural JOIN (SELECT  * from messages RIGHT JOIN ((SELECT * FROM relations WHERE
        (relations.`userid1` = '$myuserid'
    OR
        relations.`userid2` = '$myuserid')
    AND
        relations.`relation` = '2') as friends) ON
        
       (messages.`userid` = friends.`userid1`
    OR
        messages.`userid` = friends.`userid2`) GROUP BY `id`) AS theFeed ORDER BY `timestamp` DESC) as largefeed on (largefeed.`recipientid` = userinfo.`userid`);";
        
$feedresult=mysql_query($statusquery) or die("Unable to query DB!");
if (mysql_num_rows($feedresult))
	{
		 $hasp = $xml->addChild('haspostings','1');
		 $postings = $xml->addChild('postings');
		 while ($row = mysql_fetch_assoc($feedresult))
		 {
		 		$thispost = $postings->addChild('post');
		 		$id = $row['id'];
				$thispost->addChild('id', "$id");
				$userid = $row['userid'];
				$thispost->addChild('userid', "$userid");
				$fname = $row['fname'];
				$thispost->addChild('fname', "$fname");
				$mname = $row['mname'];
				$thispost->addChild('mname', "$mname");
				$lname = $row['lname'];
				$thispost->addChild('lname', "$lname");
				$recipientid = $row['recipientid'];
				if ($userid == $recipientid)
				{
					$thispost->addChild('recipientid',"-1");
				}
				else 
				{
					$thispost->addChild('recipientid',"$recipientid");
					$rfname = $row['rfname'];
					$thispost->addChild('rfname',"$rfname");
					$rmname = $row['rmname'];
					$thispost->addChild('rmname',"$rmname");
					$rlname = $row['rlname'];
					$thispost->addChild('rlname',"$rlname");
				}
				$time = $row['timestamp'];
				$thispost->addChild('timestamp', "$time");
				$content = $row['text'];
				$thispost->addChild('content', "$content");
				
		 }
	}
else
	{
		$hasp = $xml->addChild('haspostings','0');
	}


print($xml->asXML());

?>