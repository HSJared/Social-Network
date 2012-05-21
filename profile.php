<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");

//Check to see if user exists
$userid = intval($_GET['id']);
$loginquery="SELECT * FROM login WHERE userid='$userid'";
$loginresult=mysql_query($loginquery);
if (!mysql_num_rows($loginresult))
{
		header("location: 404.php"); //If not redirect
}

//If users exists, start printing the page
include("header.php"); //Universal Start of Page
include("friendingfunctions.php");

//Get Varibles for Friending
$userid = $_GET['id'];
$myuserid = $_SESSION['userid'];

//Get Info about this user
$loginquery="SELECT * FROM login WHERE userid='$userid'";
$userinfoquery="SELECT * FROM userinfo WHERE userid='$userid'";
$userinforesult=mysql_query($userinfoquery);
	
//Check whether query was successful or not
$logininfo = mysql_fetch_assoc($loginresult);
$userinfo = mysql_fetch_assoc($userinforesult);

$fname = $userinfo['fname'];
$lname = $userinfo['lname'];

$f = friendStatus($userid,$myuserid);

echo "<div id=\"msgdiv\">Click anywhere else in the document to auto-close me</div>

<a href=\"#\" onclick=\"Popup.show('msgdiv'); return false;\">Click Here To Show Msg Div</a>
<!---Profile Table---->
<table id='profileTable' ><tbody>
	<tr>
		<td id='leftsideProf' ><h1 id='profileTitle'><span id='name'></span></h1></td>
		<td><div id='friendStatusArea'><div></td>
	</tr>
	<tr id=\"profSecondRow\"><td>";
if (isset($userinfo['defaultpicid']))
{
	$picid = $userinfo['defaultpicid'];
	$picinfoquery = "SELECT ext,width,height FROM pictures WHERE id = '$picid';";
	$result=mysql_query($picinfoquery,$conc) or die("Unable to insert pictureinfo into db");
	
	$picinfo = mysql_fetch_assoc($result);
	$ext = $picinfo['ext'];
	$width = $picinfo['width'];
	$height = $picinfo['height'];
	$picturelocation = "pictures/$picid.$ext";
	echo "<img style=\"float: top;\" src=\"$picturelocation\"";
	if ($width > 200)
    {
    $newwidth=200;
	$height=($height/$width)*$newwidth;
	$width = $newwidth;
	echo "$newwidth";
	}
	echo "width=\"$width\" height=\"$height\" alt=\"$fname $lname's Profile Picture\" />";
}
else echo "<img id=\"profpic\" src=\"nopicture.png\"width=\"200\" height=\"289\" alt=\"$fname $lname's Profile Picture\" />";

echo "
</td>
<td id=\"tabArea\" >
<script>showUserinfoTab();</script>
<table id=\"tabSelector\" border=\"1\">
  <tbody>
    <tr>
      <td id=\wallTabButton\" class=\"unPressedTab\"  onClick=\"showDispatchesTab();\">Dispatches</td>
      <td id=\userInfoTabButton\" class=\"unPressedTab\" onClick=\"showUserinfoTab();\">User Info</td>
      <td id=\friendstabButton\"  class=\"unPressedTab\"onClick=\"showFriendsTab();\" >Friends</td>
    </tr>
</tbody>
</table>
<script type = \"text/javascript\">
window.onload = function() 
{
document.getElementById('userinfoTab').style.display='none';
document.getElementById('friendsTab').style.display='none';
pullStatuses($userid);
printFriendsList($userid);
pullUserInfo($userid);
}
</script>
<div id=\"dispatchesTab\">
";
/***********Dispatches************/
switch ($f)
{	
	case 0:
		echo "<h1>You must be friends with $fname $lname send them a dispatch</h1><button type=\"button\" style=\"font: 24px ;\" onclick=\"window.location = 'addfriend.php?id=$userid';\">+1 Friend</button>";
		break;
	case 1:
	case -1:
		echo "<form method=\"post\" id=\"profdispatch\" action=\"postDispatch.php?recipient=$userid\" name=\"dispatches\" onsubmit=\"return validateDispatches()\">
				<textarea name=\"dispatch\" cols=\"80\" rows=\"3\">
				</textarea><br>
				<input type=\"submit\" value=\"Post\" />
			</form>
			<span id='thefeed'>
			</span>"; 
		break;
	case -1:
		echo "<form method=\"post\" id=\"profdispatch\" action=\"postDispatch.php\" name=\"dispatches\" onsubmit=\"return validateDispatches()\">
					<textarea name=\"dispatch\" cols=\"80\" rows=\"3\">
					</textarea><br>
					<input type=\"submit\" value=\"Post\" />
			</form>
			<span id='thefeed'>
			</span>";
		break;
	case 2:
		echo "<h1>You must be friends with $fname $lname send them a dispatch</h1> Friend request pending!";
		break;
	case 3:
		echo "<h1>You must be friends with $fname $lname send them a dispatch</h1>
		This user wants to be friends. <button type=\"button\" onclick=\"window.location = 'addfriend.php?id=$userid';\">Approve</button> <button type=\"button\" onclick=\"window.location = 'denyrequest.php?id=$userid';\">Deny</button>";
		break;
}
echo "</div><!---Friends Table---->
<div id=\"friendsTab\"><span id='friendslist'></span>
</div>
<div id=\"userinfoTab\"><span id='userInfoArea'></span>
</div></td>
</tr></tbody></table><!---End Profile Table---->
</td></tr>
</td></tr></tbody></table>";

//Print off the Universal Footer of the page
include ("footer.php");
?>