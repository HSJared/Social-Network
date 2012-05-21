<?php
session_start();

//var_dump($_POST);
###Connect to database###
include("config.php");

###Get Varibles from Post Array###

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];    
$password = $_POST['pwd'];
$sex = $_POST['sex'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];

###Test for user with this email address###

$sql="select * from login where email='$email'";
$result=mysql_query($sql,$conc) or die("Unable to query db for existing email");
if (mysql_num_rows($result) > 0)
	{
	include("header.php"); //Universal Start of Page
	echo "A user already exists with this email address! Please register with a unique email.";
	include("regform.php");
	//Print off the Universal Footer of the page
	include ("footer.php");
	}
else {
#Insert into Login Table
$sql = "insert into login(email, password) values('$email','".md5($password)."')";
$result=mysql_query($sql,$conc) or die("Unable to insert loginifo into db");

#Get userid inorder to insert into userinfo table
$sql="select userid from login where email='$email'";
$result=mysql_query($sql,$conc) or die("Unable to insert lookup userid based on email");
$userid = mysql_result($result, 0);

//echo "$userid";

#Insert rest of infomation from Registration Form into DB.
$sql = "insert into userinfo(userid, fname, lname, gender, bdate) values('$userid','$fname','$lname','$sex','$year-$month-$day')";
$result=mysql_query($sql,$conc) or die("Unable to insert userinfo into db");

//echo "<h1>You have registered sucessfully!</h1>";
## Start Session
$_SESSION['userid'] = $userid;
header("location: home.php");

}

?>