<?php

$userid = $_GET['id'];

echo "<html>
<head>
<title>Friends Javascript Tester</title>
<script>

function printFriendsList(userid)
{
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() 
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{ 
				var xml_doc = xmlhttp.responseXML;
				var friends_list = xml_doc.getElementsByTagName('friend');
				alert(\"Blah2!\");
				alert(\"Blah!\");
				if (friends_list.length> 0)
				{
					alert (\"Friends!\");
					var friendshtml = \"<table id='requeststable' class='requesttable' border='1' >\";
					for(var i = 0; i < friends_list.length; i += 1)
					{
						var userid = friends_list[i].getElementsByTagName('userid')[0].textContent;
						var fname = friends_list[i].getElementsByTagName('fname')[0].textContent;
						var lname = friends_list[i].getElementsByTagName('lname')[0].textContent;
						var friendsstatus =  friends_list[i].getElementsByTagName('friendsstatus')[0].textContent;
						friendshtml += \"<tr><td><a href='profile.php?id=\" + userid + \"' 'alt='\" + fname + \" \" + lname + \"\'s Profile'>\"  + fname + \" \" + lname + \"</a></td><td>\";
						switch(n)
						{
							case -1:
								friendshtml += \"My Profile <img src='check.png' width='12' height='13' />\";
								break;
							case 0:
								friendshtml += \"<button type=\"button\" style=\"font: 24px ;\" onclick=\"window.location = 'addfriend.php?id=\" + userid + \"';\">+1 Friend</button>\";
								break;
							case 1:
								friendshtml += \"<img src=\"check.png\" width=\"12\" height=\"13\" />Friends\";
								break;
							case 2:
								friendshtml += \"Friend request pending!\";
								break;
							case 3:
								friendshtml += \"This user wants to be friends. <button type=\"button\" onclick=\"window.location = 'addfriend.php?id=\" + userid + \"';\">Approve</button> <button type=\"button\" onclick=\"window.location = 'denyrequest.php?id=\" + userid + \"';\">Deny</button>\";
									break;
						}
						
						 + friendsstatus + \"</td></tr>\";
				
					} 
					friendshtml += \"</table>\";
					document.getElementById('friendslist').innerHTML = friendshtml;
	
				} 
			/*	else
				{
					alert (\"No Friends!\");
					var friendshtml = \"<h1>They has no Friends :(</h1>\";
					document.getElementById('friendslist').innerHTML = friendshtml;
				}  */
		
			}

	}
	xmlhttp.open(\"GET\",\"getfriends.php?id=\" + userid, true)
	xmlhttp.send()
}

</script>
</head>
<body>
<span id=\"friendslist\"></span>
<input type=\"button\" value=\"Get Friends\" onclick=\"printFriendsList($userid)\" />
</body>
</html>";


?>