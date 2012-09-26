<?php
require_once "../Live/dbConnect.php";
$password   = $_REQUEST['password'];

if($password == 'rhetty')
{
    establishConnection();

	$query = 'SELECT Count(*) FROM SocialMediaUsers';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $num = mysql_result($result,0,0);
    echo "<p>Count $num</p>";
	$query = 'SELECT * FROM SocialMediaUsers';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	echo "<table border='1' style='float:left; padding:5px;'>\n";
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "\t<tr>\n";
		foreach ($line as $col_value) {
			echo "\t\t<td>$col_value</td>\n";
		}
		echo "\t</tr>\n";
	}
	echo "</table>\n";

	mysql_free_result($result);
    endConnection();
}
else
{
	echo "password did not match";
}
 ?>