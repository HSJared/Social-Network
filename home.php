<?php
include("authen.php");
include("config.php");

include("header.php"); //Universal Start of Page
$userid = $_SESSION['userid'];

echo "
<!---Alert Area--->
<table id=\alertarea\" align=\"right\"><tbody>
<tr><td><br/>";
include("missinginfo.php");
echo "</td></tr><tr><td>
</script>
<span id='friendslist'></span>
</td></tr>
</tbody></table>
<!--- End of Alert Area--->
<h1>Post a Dispatch</h1><form method=\"post\" action=\"postDispatch.php\" name=\"dispatches\" onsubmit=\"return validateDispatches()\">
<textarea name=\"dispatch\" cols=\"80\" rows=\"3\">
</textarea><br>
<input type=\"submit\" value=\"Post\" />
</form><h1>My Stream</h1>
<span id='thefeed'>
</span>
<script type = \"text/javascript\">
window.onload = function() 
{
pullTheFeed($userid);
printFriendsPageList($userid);
pullUserInfo($userid);
}
</script>
<h2 align=\"Left\" class=\"err\">My Info</h2>
<span id='userInfoArea'></span>
<h3>Update your profile picture</h3>";

include ("profpicform.php");

include ("footer.php");
?>