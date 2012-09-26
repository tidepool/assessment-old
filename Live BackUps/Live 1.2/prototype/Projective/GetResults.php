<?php 
 $password   = $_POST['password'];
if($password == 'Eyes0nly')
{
	$link = mysql_connect('127.0.0.1', 'wei', 'tidepool')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('tidepool') or die('Could not select database');	
	
	$query = 'SELECT * FROM ProjectiveScoring';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	echo "<h1>Projective Scoring</h1>";
	echo "<table border='1' style='float:left; padding:5px;'>\n";
	echo "<tr> <th>ID</th>";
    echo "<th>whole</th> <th>detail</th> <th>negative</th> <th>movement</th> <th>color</th> <th>achromatic</th> <th>shading</th> <th>texture</th> <th>reflection</th> <th>smiley</th> <th>slider1</th> <th>slider2</th> <th>slider3</th> <th>slider4</th> <th>slider5</th>";

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