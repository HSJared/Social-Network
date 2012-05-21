<?php
function friendStatus($userid,$myuserid)
{
		/****relations table: 
	0 = userid1 requested by userid2
	1 = Nothing, held in reserve for follow feature later on
	2 = friends with eachother 
	3 = userid1 blocked by userid2
	*****/

 if ($userid == $myuserid)
    {	
    	return -1;
    }
    //If not own profile, let's look into friend status
    $friendsquery="SELECT userid1,relation FROM relations where (`userid1` = '$myuserid' AND `userid2` = '$userid') OR (`userid1` = '$userid' AND `userid2` = '$myuserid');"; 
	$friendsresult=mysql_query($friendsquery);
	if (!mysql_num_rows($friendsresult))
	{		return 0;//This means they have no relation whatsoever.
			echo "No Relation";
			exit(); }
	else
	{
		$relations= mysql_fetch_assoc($friendsresult);
		$relationNum = $relations['relation'];
		$userid1 = $relations['userid1'];
		
		switch ($relationNum)
			{	
				case 2:
  					return 1; //They are friends
  					break;			
				case 0:
					if ($userid1 == $myuserid)
					{	return 3; }//This means the logged in user was the one who was one requested, since in the relations table it is userid1 that is the requested user.
					else return 2; //If it's not userid1, then the logged in user must have sent the request. 
  					break;
  				case 3:
					return 4; //One user is blocking the other
					break;
			}
	}
	
/* OLD CODE for reference   if ($userid == $myuserid)
    {	return -1; //for looking at your own profile
    }
    //If not own profile, let's look into friend status
    $friendsquery="SELECT userid1,relation FROM relations where (`userid1` = '$myuserid' AND `userid2` = '$userid') OR (`userid1` = '$userid' AND `userid2` = '$myuserid');"; 
	$friendsresult=mysql_query($friendsquery);
	if (!mysql_num_rows($friendsresult))
			return 0;//This means they have no relation whatsoever.
	else
	{
		$relations= mysql_fetch_assoc($friendsresult);
		var_dump($relations);
		$relationNum = $relations['relation'];
		$userid1 = $relations['userid1'];
		
		switch ($relationNum)
			{	
				case 2:
  					return 1; //They are friends
  					break;			
				case 0:
					if ($userid1 == $myuserid)
					{	return 3; }//This means the logged in user was the one who was one requested, since in the relations table it is userid1 that is the requested user.
					else return 2; //If it's not userid1, then the logged in user must have sent the request. 
  					break;
  				case 3:
					return 4; //One user is blocking the other
					break;
			}
	} */

}

//Based off of return of last function, this function prints the appriopiate thing
function displayrelationoptions($f, $userid)
{
switch ($f)
{	
	case -1:
		echo "This is your profile!";
		break;
	case 0:
		echo "<button type=\"button\" style=\"font: 24px ;\" onclick=\"window.location = 'addfriend.php?id=$userid';\">+1 Friend</button>";
		break;
	case 1:
		echo "<button type=\"button\" onclick=\"window.location = 'deletefriend.php?id=$userid';\">Delete Friend</button>";
		break;
	case 2:
		echo "Friend request pending!";
		break;
	case 3:
		echo "This user wants to be friends. <button type=\"button\" onclick=\"window.location = 'addfriend.php?id=$userid';\">Approve</button> <button type=\"button\" onclick=\"window.location = 'denyrequest.php?id=$userid';\">Deny</button>";
		break;
}
}
?>