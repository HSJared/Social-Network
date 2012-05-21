<?php 

//Include MySQL config info
include("config.php");

$userid1 = rand(1 ,108);
$userid2 = rand(1 ,108);
$relationtype = rand(0 ,2);

$count = 1;

while ($count < 1000)
{	

$userid1 = rand(1 ,108);
$userid2 = rand(1 ,108);
$relationtype = rand(0 ,2);
$friendsquery="SELECT relation FROM relations WHERE (`userid1` = '$userid1' AND `userid2` = '$userid2') OR (`userid1` = '$userid2' AND `userid2` = '$userid2')";
$friendsresult=mysql_query($friendsquery);
if((mysql_num_rows($friendsresult) == FALSE) && ($relationtype!= 1) )
{
	$sql = "insert into relations(userid1, userid2, relation) values('$userid1','$userid2,'$relationtype');";
	$result=mysql_query($sql,$conc) or mysql_error($conc);
	echo "$userid1		$userid2			$relationtype <br/>";
}
$count = $count+1;
}

/*$day = rand(1 ,28);
$year = rand(1930 ,1998);
$count = 9;

while ($count < 109)
{
	$month = rand(1 ,12);
	$day = rand(1 ,28);
	$year = rand(1930 ,1998);
	
	echo "$count: $month-$day-$year";
	
	$sql = "UPDATE userinfo SET bdate = '$year-$month-$day' where userid = $count;";
	$result=mysql_query($sql,$conc) or die("Unable to insert userinfo into db");
	
	$count = $count+1;
}
*/

?>