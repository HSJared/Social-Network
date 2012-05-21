<?php
echo "<p align=\"right\"><font size=\"10\" face=\"Garamond\" color=\"000000\">Join the Brotherhood!</font></p>
<form name=\"register\" METHOD=\"POST\" onsubmit=\"return validateregform()\" action=\"register.php\">
<table align=\"right\">
  <tbody>
    <tr>
      <td>First name: </td>
      <td><input type=\"text\" name=\"fname\" /></td>
    </tr>
    <tr>
      <td>Last name: </td>
      <td><input type=\"text\" name=\"lname\" /></td>
    </tr>
    <tr>
      <td>Email: </td>
      <td><input type=\"text\" name=\"email\" /></td>
    </tr>
    <tr>
      <td>Password: </td>
      <td><input type=\"password\" name=\"pwd\" /></td>
    </tr>
    <tr>
      <td>Re-Enter Password: </td>
      <td><input type=\"password\" name=\"pwd2\" /></td>
    </tr>
    <tr>
      <td>Sex: </td>
      <td><select name=\"sex\">
		<option value=\"M\">Male</option>
		<option value=\"F\">Female</option>
		<option value=\"O\">Other</option>
	</select></td>
    </tr>
        <tr>
      <td>My Birthday: </td>
      <td><select name=\"month\">
	<option value=\"1\">January
	<option value=\"2\">February
	<option value=\"3\">March
	<option value=\"4\">April
	<option value=\"5\">May
	<option value=\"6\">June
	<option value=\"7\">July
	<option value=\"8\">August
	<option value=\"9\">September
	<option value=\"10\">October
	<option value=\"11\">November
	<option value=\"12\">December
</select>
<select name=\"day\" id=\"dayselect\" >
<script>printDays();</script>
</select>
<select name=\"year\">
<script>printYears();</script>
</select></td>
    </tr>
	<tr>
      <td>  </td>
      <td><input type=\"submit\" value=\"Register\" /></form></td>
    </tr>
    <tr>
      <td>  </td>
      <td>By clicking \"Register\", you <br/>agree to the <a href=\"TOS.html\" />Terms of Service</a>.</td>
    </tr>
  </tbody>
</table>";
?>