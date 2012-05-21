<?php
echo"<html>
<!---Header--->
<head>
<title>
Brotherhood, a Social Network for Everyone
</title>
<!-- Favicon/JavaScript/CSS -->
<link rel=\"shortcut icon\" href=\"favicon.ico\" />
<script type=\"text/JavaScript\" src=\"js.js\"></script>
<script type=\"text/JavaScript\" src=\"profile.js\"></script>
<script type=\"text/JavaScript\" src=\"friends.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" /></head>
<!---Body--->
<Body>
<!---- Body Table Begining --->
<table id =\"body\" width =\"100%\">
	<tbody>
		<tr><td>
<!---Navigation Top--->
<table bgcolor=\"660000\" id=\"navtable\" class='navigationtop' border=\"0\"  width=\"100%\" >
<tbody>
    <tr> <!---Site Logo--->
      <td><a id=\"siteLogo\" href='index.php' alt='Brotherhood Homepage'><img src=\"sitetitle.gif\" alt='Brotherhood Logo' /></a>
      ";
    //Display Login Box is user is not logged in
if(!isset($_SESSION['userid'])) 
{
echo "
    <!---Login Box--->
     <div id=\"loginBox\">
     	<form METHOD=\"POST\" action=\"login.php\" id=\"loginbox\" name=\"loginbox\" onsubmit=\"return validatelogin()\">Email: <input type=\"text\" name=\"email\" /> Password: <input type=\"password\" name=\"password\" /><input type=\"submit\" value=\"Login\" /></form>
     	</div>
     </td></tr><!---End Top Row/NavTop--->
    <tr><td id=\"navbaritems\" align = \"left\"><img src=\"spacer.gif\" />";
}
else //Otherwise, display navigation
{
	$userid = $_SESSION['userid'];
	echo "
	<!---Logout Button--->
	<div id=\"uniLogoutButtonDiv\" ><button type=\"button\" onclick=\"logout();\">Logout</button></div>
		
	</td></tr> <!---End Top Row/NavTop--->
   	<tr><td id=\"navbaritems\" align = \"left\"><div id=\"leftNavigationLinks\">
   	<!---Navigation Menu --->
   	<button type=\"button\" onclick=\"goHome();\">Welcome Page</button>
	<button type=\"button\" onclick=\"parent.location='profile.php?id=$userid'\">My Profile</button>
	<button type=\"button\" onclick=\"goToMyFriends();\">My Friends</button>";
	
	//Friend Requests, if any
	$requestsquery="SELECT relation FROM relations WHERE userid1='$userid' and relation='0';";
	$requestsresult=mysql_query($requestsquery) or die('Unable to check for requests');
	$numberofrequests = mysql_num_rows($requestsresult);
	if ($numberofrequests)
	{
		 echo "<button type=\"button\" onclick=\"goToMyRequests()\">New Friend Requests ($numberofrequests)!</button>";
	}
	echo "
	</div>
	<!---Search Box--->
	<div id=\"uniCenterSearchBox\">
		<form id=\"uniSearchBox\" action=\"search.php\" name=\"navsearch\" onsubmit=\"return searchValidate()\" method=\"get\">
		<input type=\"text\" name=\"query\" id=\"query\" size=\"40\" value=\"\"> 
		<input type=\"submit\" value=\"People Search\">
		</form>
	</div>
	<!-- End Search Bar -->";
	}
echo "</td></tr>
     </tbody>
</table><!---End of Top Navigator Table--->
<!----Start Individual Page Content----->
<table id=\"contentTable\">
<tbody>
    <tr>
      <td>";
?>