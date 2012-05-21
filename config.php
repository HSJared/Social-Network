<?php
###Connect to database###
$dbhost = "localhost";
$dbname = "social_net_db";
$dbuser = "social_net_user";
$dbpass = "facebook-is-a-horrible-network";

#
# On Server: username/dbname: socialnetdatab
# Password: Social-net-db1 
#

$conc= mysql_connect ($dbhost, $dbuser, $dbpass) or die("Unable to connect to MySQL");
mysql_select_db($dbname) or die("Unable to connect to $dbname");
?>