<?php 
$password   = $_POST['password'];

if($password == 'Eyes0nly')
{
	$link = mysql_connect('127.0.0.1', 'wei', 'tidepool')
    or die('Could not connect: ' . mysql_error());
	mysql_select_db('tidepool') or die('Could not select database');	
	
	$query = 'SELECT * FROM ProjectiveISO';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	echo "<h1>Projective ISO</h1>";
	echo "<table border='1' style='float:left; padding:5px;'>\n";
	echo "<tr> <th>Examinee ID</th>";
	echo "<th>Moon1</th> <th>Moon2</th> <th>Moon3</th> <th>Moon4</th> <th>Moon5</th> <th>Moon6</th>";
	echo "<th>Sun1</th> <th>Sun2</th> <th>Sun3</th> <th>Sun4</th> <th>Sun5</th> <th>Sun6</th>";
	echo "<th>Flower1</th> <th>Flower2</th> <th>Flower3</th> <th>Flower4</th> <th>Flower5</th> <th>Flower6</th>";
	echo "<th>Castle1</th> <th>Castle2</th> <th>Castle3</th> <th>Castle4</th> <th>Castle5</th> <th>Castle6</th>";
	echo "<th>Face1</th> <th>Face2</th> <th>Face3</th> <th>Face4</th> <th>Face5</th> <th>Face6</th>";

	echo "<th>Moon_1</th> <th>Moon_2</th> <th>Moon_3</th>";
	echo "<th>Sun_1</th> <th>Sun_2</th> <th>Sun_3</th>";
	echo "<th>Flower_1</th> <th>Flower_2</th> <th>Flower_3</th>";
	echo "<th>Castle_1</th> <th>Castle_2</th> <th>Castle_3</th>";
	echo "<th>Face_1</th> <th>Face_2</th> <th>Face_3</th>";

	echo "<th>Moon</th> <th>Sun</th> <th>Flower</th> <th>Castle</th> <th>Face</th>";
	echo "<th>Comedy</th> <th>Drama</th> <th>Action</th> <th>Documentary</th> <th>Romance</th> <th>Fantasy</th> <th>Horror</th>";
	echo "<th>Num1</th> <th>Num2</th> <th>Num3</th> <th>Num4</th> <th>Num5</th>";
	echo "</tr>";
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "\t<tr>\n";
		foreach ($line as $col_value) {
			echo "\t\t<td>$col_value</td>\n";
		}
		echo "\t</tr>\n";
	}
	echo "</table>\n";
	
	/*
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
	echo "</table>\n";

	*/

	mysql_free_result($result);
	mysql_close($link);
}
else
{
	echo "password did not match";
}
 ?>