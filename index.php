<?php
session_start();
if(isset($_SESSION['userid']))
{
	header("location: home.php");
}
include("header.php"); //Universal Start of Page

echo "<div id=\"homepageRegForm\">";
include ('regform.php'); //The Registration Form
echo "</div>";
include ('footer.php');  //Universal site footer
?>