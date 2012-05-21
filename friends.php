<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");

$userid = $_SESSION['userid'];

//Start printing the page
include("header.php"); //Universal Start of Page

echo "<br/><br/><br/><script type = \"text/javascript\">
window.onload = function() 
{
printFriendsPageList($userid);
}
</script>
<div id=\"friendsTab\"><span id='friendslist'></span>
</div>";

//Print off the Universal Footer of the page
include ("footer.php");
?>