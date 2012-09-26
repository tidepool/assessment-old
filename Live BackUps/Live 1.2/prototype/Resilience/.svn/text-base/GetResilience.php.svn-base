<?php 
$password   = $_POST['password'];

if($password == 'Eyes0nly')
{
	$link = mysql_connect('127.0.0.1', 'wei', 'tidepool')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('tidepool') or die('Could not select database');	
	
	$query = 'SELECT * FROM ValuesISO';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	echo "<h1>Values ISO</h1>";
	echo "<table border='1' style='float:left; padding:5px;'>\n";
	echo "<tr> <th>Examinee ID</th>";
		
	$variables .= "p1 INT, p2 INT, p3 INT, p4 INT, p5 INT, p6 INT, p7 INT, p8 INT, ";
	$variables .= "d1 INT, d2 INT, d3 INT, d4 INT, d5 INT, d6 INT, d7 INT, d8 INT, ";
	$variables .= "pie1 INT, pie2 INT, pie3 INT, pie4 INT, pie5 INT, pie6 INT, pie7 INT, pie8 INT, ";
	echo "<th>p1</th> <th>p2</th> <th>p3</th> <th>p4</th> <th>p5</th> <th>p6</th> <th>p7</th> <th>p8</th>";
	echo "<th>pie1</th> <th>pie2</th> <th>pie3</th> <th>pie4</th> <th>pie5</th> <th>pie6</th> <th>pie7</th> <th>pie8</th>";
	echo "<th>d1</th> <th>d2</th> <th>d3</th> <th>d4</th> <th>d5</th> <th>d6</th> <th>d7</th> <th>d8</th>";
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

	echo "<tr> <td>p1</td> <td>Achievement</td> </tr>";
	echo "<tr> <td>p2</td> <td>Challenge</td> </tr>";
	echo "<tr> <td>p3</td> <td>Independence</td> </tr>";
	echo "<tr> <td>p4</td> <td>Money</td> </tr>";
	echo "<tr> <td>p5</td> <td>Power</td> </tr>";
	echo "<tr> <td>p6</td> <td>Recognition</td> </tr>";
	echo "<tr> <td>p7</td> <td>Service</td> </tr>";
	echo "<tr> <td>p8</td> <td>Variety</td> </tr>";
	
	echo "<tr> <td>d1</td> <td>Achievement</td> </tr>";
	echo "<tr> <td>d2</td> <td>Challenge</td> </tr>";
	echo "<tr> <td>d3</td> <td>Independence</td> </tr>";
	echo "<tr> <td>d4</td> <td>Money</td> </tr>";
	echo "<tr> <td>d5</td> <td>Power</td> </tr>";
	echo "<tr> <td>d6</td> <td>Recognition</td> </tr>";
	echo "<tr> <td>d7</td> <td>Service</td> </tr>";
	echo "<tr> <td>d8</td> <td>Variety</td> </tr>";
	
	echo "<tr> <td>pie1</td> <td>Achievement</td> </tr>";
	echo "<tr> <td>pie2</td> <td>Challenge</td> </tr>";
	echo "<tr> <td>pie3</td> <td>Independence</td> </tr>";
	echo "<tr> <td>pie4</td> <td>Money</td> </tr>";
	echo "<tr> <td>pie5</td> <td>Power</td> </tr>";
	echo "<tr> <td>pie6</td> <td>Recognition</td> </tr>";
	echo "<tr> <td>pie7</td> <td>Service</td> </tr>";
	echo "<tr> <td>pie8</td> <td>Variety</td> </tr>";
	
	echo "</table>\n";

	mysql_free_result($result);
	mysql_close($link);
}
else
{
	echo "password did not match";
}
 ?>