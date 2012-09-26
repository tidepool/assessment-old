<?php 
 $password   = $_POST['password'];
if($password == 'gl0b3korn')
{
	$link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('tidepool') or die('Could not select database');	
	
	$query = 'SELECT * FROM PathwayScoring';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	echo "<h1>Pathway Scoring</h1>";
	echo "<table border='1' style='float:left; padding:5px;'>\n";
	echo "<tr> <th>ID</th>";
    echo "<th>L1</th> <th>L2</th> <th>L3</th> <th>L4</th> <th>L5</th> <th>L6</th> <th>L7</th> <th>L8</th>";
    echo "<th>S1</th> <th>S2</th> <th>S3</th> <th>S4</th> <th>S5</th> <th>S6</th> <th>S7</th> <th>S8</th>";
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