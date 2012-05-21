<?php
include("authen.php");
include("config.php");

//Initialize Values
$userid = $_SESSION['userid'];
$src = NULL;
$ext = "";

//Based upon file, convert for use in database
if (($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg"))
{
	$ext = "jpg";
	$src = imagecreatefromjpeg($_FILES['file']['tmp_name']);
}
else if ($_FILES["file"]["type"] == "image/png")
{
	$ext = "png";
	$src = imagecreatefrompng($_FILES['file']['tmp_name']);
}
else if ($_FILES["file"]["type"] == "image/gif")
{
	$ext = "gif";
	$src = imagecreatefromgif($_FILES['file']['tmp_name']);
}


//Make sure it was a valid file, if not complain. 
if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && ($_FILES["file"]["size"] < 5000000))
  {
  	
  	//Check for errors, make sure upload worked
  	if ($_FILES["file"]["error"] > 0)
    	{
    	echo "Error Code: ";
    	echo $_FILES["file"]["error"];
    	echo "<br />";
    	}
 	 else
    	{
    	//Check image size
    	list($width,$height)=getimagesize($_FILES["file"]["tmp_name"]);
    	if ($width > 600)
    	{
    	
    	//Resize image
    	$newwidth=600;
		$newheight=($height/$width)*$newwidth;
		$tmp = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$width = $newwidth;
		$height = $height;
		$oldsrc = $src;
		$src = $tmp;
		$ext="jpg";
		imagedestroy($oldsrc);
		}
    
    	//Insert Picture into DB
 		$uploadquery = "insert into pictures(userid,ext,width,height) values('$userid','$ext','$width','$height')";
		$result=mysql_query($uploadquery,$conc) or die("Unable to insert pictureinfo into db");
		
		//Get pic info and upload pic to server
		$picinfoquery = "SELECT id FROM pictures WHERE userid = '$userid' ORDER BY timestamp DESC LIMIT 1;";
		$result=mysql_query($picinfoquery,$conc) or die("Unable to insert pictureinfo into db");
		imagejpeg($src,$_FILES["file"]["tmp_name"],100);
		imagedestroy($src);
		$picinfo = mysql_fetch_assoc($result);
		$picid = $picinfo['id'];
		$picturelocation = "pictures/$picid.$ext";
	
		//move pic
		move_uploaded_file($_FILES["file"]["tmp_name"],
      "$picturelocation");
      	
      	//make this new picture the default picture.
      	$sql = "UPDATE userinfo SET defaultpicid ='$picid' WHERE userid = '$userid';";
		$result=mysql_query($sql,$conc) or die("Unable to insert profilepicture into userinfo db");
		
		header("location: home.php");

      } 
}
else
	{
  echo "Invalid file";
	}
?>