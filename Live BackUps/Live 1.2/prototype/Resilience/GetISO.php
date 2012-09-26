<?php 
$password   = $_POST['password'];

if($password == 'Eyes0nly')
{
    $link = mysql_connect('127.0.0.1', 'wei', 'tidepool')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = 'SELECT * FROM ResilienceISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());


	echo "<h1>Resilience ISO</h1>";
	echo "<table border='1' style='float:left; padding:5px;'>\n";
	echo "<tr> <th>Examinee ID</th>";
    echo "<th>Hands1</th><th>Hands2</th><th>Hands3</th><th>Hands4</th><th>Hands5</th><th>Hands6</th><th>Hands7</th><th>Hands8</th>";
    echo "<th>Tug1</th><th>Tug2</th><th>Tug3</th>";
    echo "<th>Surfing</th>";
    echo "<th>Surf1</th><th>Surf2</th><th>Surf3</th><th>Surf4</th>";
    echo "<th>Shells2_1</th><th>Rocks2_1</th>";
    echo "<th>Shells3_1</th><th>Shells3_2</th><th>Shells3_3</th>";
    echo "<th>Shells3_4</th><th>Shells3_5</th><th>Shells3_6</th>";
    echo "<th>Shells4_1</th><th>Shells4_2</th><th>Shells4_3</th><th>Shells4_4</th>";
    echo "<th>Shells5_1</th><th>Shells5_2</th><th>Shells5_3</th><th>Shells5_4</th><th>Shells5_5</th>";
    echo "<th>Lifeguard</th><th>Pier</th><th>Place1</th><th>Place2</th>";
    echo "<th>Slider1</th><th>Slider2</th>";
    echo "<th>Poem</th><th>Art</th>";
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