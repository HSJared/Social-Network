<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");

//Check to see if user exists
$query = $_GET['query'];

include("header.php"); //Universal Start of Page

include("friendingfunctions.php");
// echo "<br/><br/><br/>";

//echo $query;
$queryterms = explode(" ",$query);
$myuserid = $_SESSION['userid'];

switch (count($queryterms))
{
	case 0:
	{
		echo "<hl>Please enter some search terms!<h1>";
	}
		break;
	case 1:
	{
		$searchterm = $queryterms[0];
		$searchquery="SELECT * FROM userinfo WHERE (fname='$searchterm') OR (lname='$searchterm');";
		$searchresult=mysql_query($searchquery) or die("Unable to search DB!");
		$numberofresults = mysql_num_rows($searchresult);
		if ($numberofresults)
		{
		 echo "<h1>Search Results</h1><table id='searchresults' class='searchresults' border=\"1\"><tr>";
		 while ($row = mysql_fetch_assoc($searchresult)) 
				{
					//Get Info about this user
					$friendid =  $row["userid"];
		
					//Info about user
					$fname = $row['fname'];
					$lname = $row['lname'];
		
					//Print Table Content
					echo "<tr><td><h3><a href='profile.php?id=$friendid' 'alt='$fname $lname's Profile'>$fname $lname</a></h3></td>";
					if(isset($row['city']))
					{
						echo $row['city'];
						echo ", ";
						echo $row['state'];
					}
					echo "<td>";
					$f = friendStatus($friendid,$myuserid);
					displayrelationoptions($f, $friendid);
					echo "</td></tr>";
					}
		echo "</table>";
		}
		else echo "<h1>No Results</h1>";
	}
		break;
	case 2:
	{
		$searchterm1 = $queryterms[0];
		$searchterm2 = $queryterms[1];
		$searchquery="SELECT * FROM userinfo WHERE (fname='$searchterm1') AND (lname='$searchterm2');";
		$searchresult=mysql_query($searchquery) or die("Unable to search DB!");
		$numberofresults = mysql_num_rows($searchresult);
		if ($numberofresults)
		{
		 echo "<h1>Search Results</h1><table id='searchresults' class='searchresults' border=\"1\"><tr>";
		 while ($row = mysql_fetch_assoc($searchresult)) 
				{
					//Get Info about this user
					$friendid =  $row["userid"];
		
					//Info about user
					$fname = $row['fname'];
					$lname = $row['lname'];
		
					//Print Table Content
					echo "<tr><td><h3><a href='profile.php?id=$friendid' 'alt='$fname $lname's Profile'>$fname $lname</a></h3></td>";
					if(isset($row['city']))
					{
						echo $row['city'];
						echo ", ";
						echo $row['state'];
					}
					echo "<td>";
					$f = friendStatus($friendid,$myuserid);
					displayrelationoptions($f, $friendid);
					echo "</td></tr>";
					}
		echo "</table>";
		}
		else echo "<h1>No Results</h1>";
	}
		break;		
}

//Print off the Universal Footer of the page
include ("footer.php");
?>