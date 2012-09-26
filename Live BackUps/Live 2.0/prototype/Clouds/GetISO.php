<?php 
$password   = $_POST['password'];

if($password == 'gl0b3korn')
{
	$link = mysql_connect('127.0.0.1', 'wei', 'tidepool')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('tidepool') or die('Could not select database');	
	
	//$query = 'SELECT * FROM HollandItem';
	$query = 'SELECT * FROM CloudsItem';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	echo "<h1>Clouds Item</h1>";
	echo "<table border='1' style='float:left; padding:5px;'>\n";
	echo "<tr> <th>Examinee ID</th>";
	for($i=1;$i<=66;$i++)
	{
		echo "<th>$i</th>";	
	}
	echo "<th>1p1</th> <th>1p2</th> <th>1p3</th> <th>1p4</th> <th>1p5</th> <th>1p6</th>";
	echo "<th>2p1</th> <th>2p2</th> <th>2p3</th> <th>2p4</th> <th>2p5</th> <th>2p6</th>";
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
	
	echo "<tr> <td>1-11</td> <td>artistic</td> </tr>";
	echo "<tr> <td>12-22</td> <td>conventional</td> </tr>";
	echo "<tr> <td>23-33</td> <td>enterprising</td> </tr>";
	echo "<tr> <td>34-44</td> <td>investigative</td> </tr>";
	echo "<tr> <td>45-55</td> <td>realistic</td> </tr>";
	echo "<tr> <td>56-66</td> <td>social</td> </tr>";
	
	echo "<tr> <td>(1,2)p1</td> <td>realistic</td> </tr>";
	echo "<tr> <td>(1,2)p2</td> <td>investigative</td> </tr>";
	echo "<tr> <td>(1,2)p3</td> <td>artistic</td> </tr>";
	echo "<tr> <td>(1,2)p4</td> <td>social</td> </tr>";
	echo "<tr> <td>(1,2)p5</td> <td>enterprising</td> </tr>";
	echo "<tr> <td>(1,2)p6</td> <td>conventional</td> </tr>";

	echo "</table>\n";

	mysql_free_result($result);
	mysql_close($link);
}
else
{
	echo "password did not match";
}
 ?>