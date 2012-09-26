<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query
$variables = "id INT NOT NULL AUTO_INCREMENT, ";

$variables .= "Moon1 INT, Moon2 INT, Moon3 INT, Moon4 INT, Moon5 INT, Moon6 INT, ";
$variables .= "Sun1 INT, Sun2 INT, Sun3 INT, Sun4 INT, Sun5 INT, Sun6 INT, ";
$variables .= "Flower1 INT, Flower2 INT, Flower3 INT, Flower4 INT, Flower5 INT, Flower6 INT, ";
$variables .= "Castle1 INT, Castle2 INT, Castle3 INT, Castle4 INT, Castle5 INT, Castle6 INT, ";
$variables .= "Face1 INT, Face2 INT, Face3 INT, Face4 INT, Face5 INT, Face6 INT, ";

$variables .= "Moon_1 INT, Moon_2 INT, Moon_3 INT, ";
$variables .= "Sun_1 INT, Sun_2 INT, Sun_3 INT, ";
$variables .= "Flower_1 INT, Flower_2 INT, Flower_3 INT, ";
$variables .= "Castle_1 INT, Castle_2 INT, Castle_3 INT, ";
$variables .= "Face_1 INT, Face_2 INT, Face_3 INT, ";


$variables .= "Moon INT, Sun INT, Flower INT, Castle INT, Face INT, ";
$variables .= "Comedy INT, Drama INT, Action INT, Documentary INT, Romance INT, Fantasy INT, Horror INT, ";
$variables .= "Num1 INT, Num2 INT, Num3 INT, Num4 INT, Num5 INT, ";

$variables .= "PRIMARY KEY (id)";

echo $variables;
$query = "CREATE TABLE ProjectiveISO (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>