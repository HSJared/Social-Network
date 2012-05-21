<?php
session_start();

//Include MySQL config info
include("config.php");
include("header.php"); //Universal Start of Page

//Body of Page
echo "<h1>Brotherhood, a new kind of social networking</h1>
<p>Brotherhood is an online service that allows YOU to form online relationships among people. On Brotherhood, you can share interests, activities, hoobies, and updates with people who have similar interests, backgrounds, and activities. Brotherhood empowers you to make your own communities.</p>
<h3>Great! What can I do on Brotherhood?</h3>
<p>The Brotherhood will allow you to keep in touch with your friends! You can share updates, share infomation, send messages, upload photos, and friend and follow other users.</p>
<h3>Awesome. How can I register?</h3>
<p>All you have to do is go to <a href=\"index.php\">the homepage</a> and fill out the registration form.You will need the following infomation to register for The Brotherhood</p><ol>
<li>Name</li>
<li>Email</li>
<li>Birthday</li>
<li>Sex</li>
</ol><p>Unfortunately, Brotherhood does not accept registrations from children under age 13.</p>";

//End of page
include ("footer.php");
?>
