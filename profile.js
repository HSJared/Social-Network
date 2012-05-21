/***********Pull the Dispatch Feed from the XML********************/
function pullStatuses(uid)
{
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function()
	{
	
		if (xmlhttp.readyState == 4
			&& xmlhttp.status == 200)
			{
				var xml_doc = xmlhttp.responseXML;
				var friendstatus = xml_doc.getElementsByTagName("friendstatus")[0].childNodes[0].nodeValue;

				if (friendstatus < 1)
				{
					document.getElementById('thefeed').innerHTML = "<h1 id='dispatchfeedheader'>Nothing to see here</h1>";
				}
				else
				{
					var post_list = xml_doc.getElementsByTagName("post");
					if (post_list.length == 0)
					{
						var tryit = "<h3>No Posts</h3>";
						document.getElementById('thefeed').innerHTML = tryit;
					}
					else
					{
						/*****Code here for parsing feed******/
						var tryit = "<table id=\"feedtable\"><tbody>";
						for (var i = 0; i < post_list.length; i++)
						{
							var userid = post_list[i].getElementsByTagName('userid')[0].textContent;
							var fname = post_list[i].getElementsByTagName('fname')[0].textContent;
							var lname = post_list[i].getElementsByTagName('lname')[0].textContent;
							var content = post_list[i].getElementsByTagName('content')[0].textContent;
							var timestamp = post_list[i].getElementsByTagName('timestamp')[0].textContent;
							tryit += "<tr><td><h3><a href='profile.php?id=" + userid + "'>" + fname + "&nbsp;" + lname + "</a></h3></td><td>" + timestamp + "</td></tr><tr><td><p>" + content + "<p></td></tr>";
						}
						tryit += "</tbody></table>";
						document.getElementById('thefeed').innerHTML = tryit;
					}
				}
			} 
	}
	
	xmlhttp.open("GET", "getuserfeed.php?id=" + uid, true);
	xmlhttp.send();

}


function pullTheFeed(uid)
{
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4
			&& xmlhttp.status == 200)
			{
				var xml_doc = xmlhttp.responseXML;
				
				var post_list = xml_doc.getElementsByTagName("post");
				if (post_list.length == 0)
				{
						var tryit = "<h3>No Posts</h3>";
						document.getElementById('thefeed').innerHTML = tryit;
				}
				else
				{
					/*****Code here for parsing feed******/
					var tryit = "<p></p><table id=\"feedhometable\"><tbody>";
					for (var i = 0; i < post_list.length; i++)
					{
						var userid = post_list[i].getElementsByTagName('userid')[0].textContent;
						var fname = post_list[i].getElementsByTagName('fname')[0].textContent;
						var lname = post_list[i].getElementsByTagName('lname')[0].textContent;
						var content = post_list[i].getElementsByTagName('content')[0].textContent;
						var timestamp = post_list[i].getElementsByTagName('timestamp')[0].textContent;
						var thetime = mysqlTimeStampToDate(timestamp);
						tryit += "<tr><td><h3><a href='profile.php?id=" + userid + "'>" + fname + "&nbsp;" + lname + "</a>";
						var recipientid = post_list[i].getElementsByTagName('recipientid')[0].textContent;
						if (recipientid != "")
							{
								var rfname = post_list[i].getElementsByTagName('rfname')[0].textContent;
								var rlfname = post_list[i].getElementsByTagName('rlname')[0].textContent;
								tryit += " > <a href='profile.php?id=" + recipientid + "'>" + rfname + "&nbsp;" + rlfname + "</a>";
							}
						tryit += "</h3></td><td>" + timestamp + "</td></tr><tr><td><p>" + content + "<p></td></tr>";
					}
					tryit += "</tbody></table>";
					document.getElementById('thefeed').innerHTML = tryit;
				}
			}
	 
	}
	
	xmlhttp.open("GET", "getmyfeed.php", true);
	xmlhttp.send();

}


function pullUserInfo(uid)
{
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4
			&& xmlhttp.status == 200)
			{
				var xml_doc = xmlhttp.responseXML;
				var userHtml = "<table id='userInfoTable' >"
				
				var user = xml_doc.getElementsByTagName('user')[0].textContent;
				var userid = xml_doc.getElementsByTagName('userid')[0].textContent;
				var fname = xml_doc.getElementsByTagName('fname')[0].textContent;
				var lname = xml_doc.getElementsByTagName('lname')[0].textContent;
				var gender = xml_doc.getElementsByTagName('gender')[0].textContent;
				var email = xml_doc.getElementsByTagName('email')[0].textContent;
				var bdate = xml_doc.getElementsByTagName('bdate')[0].textContent;
				
				userHtml += "<tr><td>Email</td><td>" + email + "</td></tr>";
				userHtml += "<tr><td>Birthday</td><td>" + bdate + "</td></tr>";
				userHtml += "<tr><td>Gender</td><td>" + gender + "</td></tr>";
				
				document.getElementById('userInfoArea').innerHTML = userHtml;
				document.getElementById('name').innerHTML = fname + "&nbsp;" + lname;
				
				var friendButton = "";
				var friendsstatus = parseInt(xml_doc.getElementsByTagName('friendsstatus')[0].textContent);
				
				switch(friendsstatus)
						{
							case -1:
								friendButton += "My Profile <img src='check.png' width='12' height='13' />";
								break;
							case 0:
								friendButton += "<button type=\"button\" style=\"font: 24px;\" onclick=\"window.location = 'addfriend.php?id=" + userid + "';\">+1 Friend</button>";
								break;
							case 1:
								friendButton += "<img src='check.png' width='12' height='13' />Friends";
								break;
							case 2:
								friendButton += "Friend request pending!";
								break;
							case 3:
								friendButton += "This user wants to be friends. <button type='button' onclick=\"window.location = 'addfriend.php?id=" + userid + "';\">Approve</button> <button type='button' onclick=\"window.location = 'denyrequest.php?id=" + userid + "';\">Deny</button>";
								break;
							default:
								friendButton += "we;ve got a problem";
						}
				document.getElementById('friendStatusArea').innerHTML = friendButton;
				
			}
	 
	}
	
	xmlhttp.open("GET", "getuserinfo.php?id=" + uid, true);
	xmlhttp.send();

}