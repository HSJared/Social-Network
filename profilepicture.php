<?php
include("authen.php");
include("config.php");

include("header.php"); //Universal Start of Page

echo "<h2>Change your profile picture here!</h2>
<form action=\"changeprofilepicture.php\" method=\"post\"
enctype=\"multipart/form-data\">
<label for=\"file\">Choose Picture Here:</label>
<input type=\"file\" name=\"file\" id=\"file\" /> 
<br />
<input type=\"submit\" name=\"submit\" value=\"Upload Profile Picture\" />
</form>
<table><tbody><tr><td>Filetypes allowed:</td><td><b>gif, jpg, png</b></td></tr><tr><td>
Filesize limit:</td><td><b>5,000KB</b></td></tr></tbody></table>";


include ("footer.php");
?>