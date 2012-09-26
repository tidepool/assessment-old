<?php 
$password   = $_POST['password'];

if($password == 'Eyes0nly')
{
	$link = mysql_connect('127.0.0.1', 'wei', 'tidepool')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('tidepool') or die('Could not select database');	
	
	$query = 'SELECT * FROM BalloonISO';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	echo "<h1>Balloon ISO</h1>";
	echo "<table border='1' style='float:left; padding:5px;'>\n";
	echo "<tr> <th>Examinee ID</th>";
	echo "<th>P1</th> <th>P2</th> <th>P3</th> <th>P4</th> <th>P5</th> <th>P6</th> <th>P7</th> <th>P8</th>";
	echo "</tr>";
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "\t<tr>\n";
		foreach ($line as $col_value) {
			echo "\t\t<td>$col_value</td>\n";
		}
		echo "\t</tr>\n";
	}
	echo "</table>\n";
	
	
	echo "<table border='1' style='float:left; padding:5px;'>\n";
	echo "<tr> <th>Item ID</th> <th>Content Code</th> <th>Additional Content Code</th>";
	echo "</tr>";
	
	echo "<tr> <td>P1</td> <td>Benefits</td> </tr>";
	echo "<tr> <td>P2</td> <td>Training</td> </tr>";
	echo "<tr> <td>P3</td> <td>Money</td> </tr>";
	echo "<tr> <td>P4</td> <td>Support</td> </tr>";
	echo "<tr> <td>P5</td> <td>Appreciation</td> </tr>";
	echo "<tr> <td>P6</td> <td>Promotion</td> </tr>";
	echo "<tr> <td>P7</td> <td>Recognition</td> </tr>";
	echo "<tr> <td>P8</td> <td>Time</td> </tr>";

	echo "</table>\n";

	mysql_free_result($result);
	mysql_close($link);
}
else
{
	echo "password did not match";
}
 ?>