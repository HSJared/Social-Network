<?php

//Function for login failure
function loginfailed()
{
		include("header.php"); //Begining of page. Constructs page header and starts body table
		echo "<h2 align=\"center\" class=\"err\">Login Failed!<h2><h1>Please login or register.</h1>";
		include ('regform.php'); //The Registration Form
		include ('footer.php');  //Universal site footer
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{

	//Include config info
	include('config.php');
	
	//Get Password
	$email = $_POST['email'];
	$password = $_POST['password'];

	//Validate Login Input
	if($email == '' || $password == '') {
		loginfailed();
		exit();
	}
	
	//Lookup Email and Password
	$query="SELECT * FROM login WHERE email='$email' AND password='".md5($password)."'";
	$result=mysql_query($query);
	
	//Check whether login was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_start(); //Start Session
			$user = mysql_fetch_assoc($result);
			$_SESSION['userid'] = $user['userid'];
			session_write_close();
			header("location: home.php");
			exit();
		}else {
			//Login failed
			loginfailed();
	//		header("location: error.php");
			exit();
		}
	}else {
		die("Query failed");
	}
	}
else
{
include("header.php"); //Universal Start of Page
	
echo "<center><br/><br/><br/><br/><h2>Login Here</h2><form METHOD=\"POST\" action=\"login.php\" id=\"loginbox\" name=\"loginbox\" onsubmit=\"return validatelogin()\">
<table>
  <tbody>
  <tr>
      <td>Email: </td><td><input type=\"text\" name=\"email\" /></td></tr><tr><td>Password: </td><td><input type=\"password\" name=\"password\" /></td><
 </tr>
 </tbody>
 </table><input type=\"submit\" value=\"Login\" /></form></font></center>"; //The Login Form
include ('footer.php');  //Universal site footer
}
?>