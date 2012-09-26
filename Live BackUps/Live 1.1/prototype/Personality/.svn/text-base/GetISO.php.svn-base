<?php 
$password   = $_POST['password'];

if($password == 'Eyes0nly')
{
	$link = mysql_connect('127.0.0.1', 'wei', 'tidepool')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('tidepool') or die('Could not select database');	
	
	$query = 'SELECT * FROM PersonalityISO';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	echo "<h1>Personality ISO</h1>";
	echo "<table border='1' style='float:left; padding:5px;'>\n";
	echo "<tr> <th>Examinee ID</th>";
	echo "<th>1p1</th> <th>1p2</th> <th>1p3</th> <th>1p4</th> <th>1p5</th>";
	echo "<th>2p1</th> <th>2p2</th> <th>2p3</th> <th>2p4</th> <th>2p5</th>";
	echo "<th>3p1</th> <th>3p2</th> <th>3p3</th> <th>3p4</th> <th>3p5</th>";
	echo "<th>4p1</th> <th>4p2</th> <th>4p3</th> <th>4p4</th> <th>4p5</th>";
	echo "<th>5p1</th> <th>5p2</th> <th>5p3</th> <th>5p4</th> <th>5p5</th>";
	echo "<th>6p1</th> <th>6p2</th> <th>6p3</th> <th>6p4</th> <th>6p5</th>";
	echo "<th>1c1</th> <th>1c2</th>";
	echo "<th>2c1</th> <th>2c2</th>";
	echo "<th>3c1</th> <th>3c2</th>";
	echo "<th>4c1</th> <th>4c2</th>";
	echo "<th>5c1</th> <th>5c2</th>";
	echo "<th>6c1</th> <th>6c2</th>";
	echo "<th>7c1</th> <th>7c2</th>";
	echo "<th>8c1</th> <th>8c2</th>";
	echo "<th>9c1</th> <th>9c2</th>";
	echo "<th>10c1</th> <th>10c2</th>";
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
	echo "<tr> <th>Item ID</th> <th>1</th> <th>2</th> <th>3</th> <th>4</th> <th>5</th> </tr>";
	
	echo "<tr> <th>1</th> <th>Agreeableness</th> <th>Conscientiousness</th> <th>Extroversion</th> <th>Neuroticism</th> <th>Openness</th> </tr>";
	echo "<tr> <th>2</th> <th>Agreeableness</th> <th>Conscientiousness</th> <th>Extroversion</th> <th>Neuroticism</th> <th>Openness</th> </tr>";
	echo "<tr> <th>3</th> <th>Openness</th> <th>Neuroticism</th> <th>Extroversion</th> <th>Conscientiousness</th> <th>Agreeableness</th> </tr>";
	echo "<tr> <th>4</th> <th>Agreeableness</th> <th>Extroversion</th> <th>Conscientiousness</th> <th>Neuroticism</th> <th>Openness</th> </tr>";
	echo "<tr> <th>5</th> <th> </th> <th> </th> <th> </th> <th> </th> <th> </th> </tr>";
	echo "<tr> <th>6</th> <th>Agreeableness</th> <th>Extroversion</th> <th>Neuroticism</th> <th>Openness</th> <th>Conscientiousness</th> </tr>";
	echo "<tr> <th>1</th> <th>Agreeableness</th> </tr>";
	echo "<tr> <th>2</th> <th>Conscientiousness</th> </tr>";
	echo "<tr> <th>3</th> <th>Extroversion</th> </tr>";
	echo "<tr> <th>4</th> <th>Neuroticism</th> </tr>";
	echo "<tr> <th>5</th> <th>Openness</th> </tr>";
	echo "<tr> <th>6</th> <th>Extroversion</th> </tr>";
	echo "<tr> <th>7</th> <th>Neuroticism</th> </tr>";
	echo "<tr> <th>8</th> <th>Openness</th> </tr>";
	echo "<tr> <th>10</th> <th>Conscientiousness</th> </tr>";
	echo "<tr> <th>11</th> <th>Conscientiousness</th> </tr>";
	
	
$Conscientiousness = 0;
$Agreeableness = 0;
$Extroversion = 0;
$Neuroticism = 0;
$Openness = 0;

	echo "</table>\n";

	mysql_free_result($result);
	mysql_close($link);
}
else
{
	echo "password did not match";
}
 ?>