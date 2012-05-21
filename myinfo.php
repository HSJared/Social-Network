<?php
include("authen.php");
include("config.php");
include("header.php");

$userid = $_SESSION['userid'];

//Get Info
$loginquery="SELECT * FROM login WHERE userid='$userid'";
$userinfoquery="SELECT * FROM userinfo WHERE userid='$userid'";
$loginresult=mysql_query($loginquery);
$userinforesult=mysql_query($userinfoquery);
	
//Check whether login was successful or not
if($loginresult)
{	$logininfo = mysql_fetch_assoc($loginresult);
	$userinfo = mysql_fetch_assoc($userinforesult);
	
//    var_dump($logininfo);
var_dump($userinfo);
}
echo "<form METHOD=\"POST\" action=\"test.php\" id=\"userinfo\" name=\"userinfo\"><table border=1>
  <tbody>
    <tr>
      <td>Nickname</td><td>";
      if (empty($userinfo['nickname']))
      {
      echo "<input type=\"text\" name=\"nickname\" />";
      }
      else echo $userinfo['nickname'];
      echo"</td></tr><tr>
      <td>First Name:</td><td>";
      echo $userinfo['fname'];
      echo "</td> </tr><tr><td>Middle Name:</td><td>";
      if (empty($userinfo['mname']))
      {
      echo "<input type=\"text\" name=\"mname\" />";
      }
      else echo $userinfo['mname'];
      echo "</td></tr><tr>
      <td>lname</td><td>";
      echo $userinfo['lname'];
      echo "</td>
    </tr>
    <tr>
      <td>Gender:</td><td>";
      echo $userinfo['gender'];
      echo "</td>
    </tr>
    <tr>
      <td>Birthday</td><td>";
      echo $userinfo['bdate'];
      echo "</td>
    </tr>
    <tr>
      <td>Phone Number</td><td>";
     if (empty($userinfo['phonenum']))
      {
      echo "<input type=\"text\" name=\"phonenum\" />";
      }
      else echo $userinfo['phonenum'];
      echo "</td>
    </tr>
    <tr>
      <td>School</td><td>";
      if (empty($userinfo['schoolid']))
    	{
      	echo "<input type=\"text\" name=\"schoolid\" />";
      	}
      else echo $userinfo['schoolid'];
      echo "</td>
    </tr>
    <tr>
      <td>employerid</td><td>";
      if (empty($userinfo['employerid']))
    	{
    	echo "<input type=\"text\" name=\"schoolid\" />";
    	}
    	else echo $userinfo['employerid'];
    	echo "</td>
    </tr>";
/*    <tr>
      <td>addressline1</td><td>$addressline1</td>
    </tr>
    <tr>
      <td>addressline2</td><td>$addressline2</td>
    </tr>
    <tr>
      <td>city</td><td>$city</td>
    </tr>
    <tr>
      <td>state</td><td>$state</td>
    </tr>
 */
 echo "</tbody>
</table></form>";
include ("footer.php");
?>