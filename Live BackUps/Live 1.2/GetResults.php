<?php 
 $password   = $_POST['password'];
if(true)
{
	$link = mysql_connect('127.0.0.1', 'wei', 'tidepool')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('tidepool') or die('Could not select database');	
	
	$query = 'SELECT * FROM UserInfo';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	echo "<h1>User Info</h1>";
	echo "<table border='1' style='float:left; padding:5px;'>\n";
	echo "<tr>";
	echo "<th>ID</th> <th>Name</th> <th>Work Type</th> <th>Date</th>";
	echo "</tr>";
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "\t<tr>\n";
		foreach ($line as $col_value) {
			echo "\t\t<td>$col_value</td>\n";
		}
		echo "\t</tr>\n";
	}
	echo "</table>\n";

	mysql_free_result($result);
	mysql_close($link);
}
else
{
	echo "password did not match";
}
 ?>