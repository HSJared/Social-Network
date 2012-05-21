<?php

include("authen.php");
include("config.php");
include("friendingfunctions.php");
header('content-type: text/xml');
$userid = intval($_GET['id']);
$myuserid = $_SESSION['userid'];

//If not own profile, let's look into friend status
$userquery="SELECT * FROM userinfo NATURAL JOIN login WHERE userid = '$userid';";
$userresult=mysql_query($userquery) or die("Unable to query DB!");

$friendstatus = friendStatus($userid,$myuserid);

$xml = new SimpleXMLElement('<xml/>');
$xml->addChild('friendsstatus', "$friendstatus");
$user = $xml->addChild('user');

$row = mysql_fetch_assoc($userresult);


$userid = $row['userid'];
$user->addChild('userid', "$userid");


$fname = $row['fname'];
$user->addChild('fname', "$fname");


$lname = $row['lname'];
$user->addChild('lname', "$lname");

$email = $row['email'];
$user->addChild('email', "$email");

$gender = $row['gender'];
$user->addChild('gender', "$gender");
$bdate = $row['bdate'];
$user->addChild('bdate', "$bdate"); 

if(isset($row['mname']))
{
	$mname = $row['mname'];
	$user->addChild('mname', "$mname");
}
if(isset($row['nickname']))
{
	$nickname = $row['nickname'];
	$user->addChild('nickname', "$nickname");
}
if(isset($row['phonenum']))
{
	$phonenum = $row['phonenum'];
	$user->addChild('phonenum', "$phonenum");
}

print($xml->asXML());

?>