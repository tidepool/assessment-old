<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query
$variables = "id INT NOT NULL AUTO_INCREMENT,";

$variables .= "Hands1 INT, Hands2 INT, Hands3 INT, Hands4 INT, Hands5 INT, Hands6 INT, Hands7 INT, Hands8 INT, ";
$variables .= "Tug1 INT, Tug2 INT, Tug3 INT, ";
$variables .= "Surfing INT, ";
$variables .= "Surf1 INT, Surf2 INT, Surf3 INT, Surf4 INT, ";
$variables .= "Shells2_1 INT, Rocks2_1 INT, ";
$variables .= "Shells3_1 INT, Shells3_2 INT, Shells3_3 INT, ";
$variables .= "Shells3_4 INT, Shells3_5 INT, Shells3_6 INT, ";
$variables .= "Shells4_1 INT, Shells4_2 INT, Shells4_3 INT, Shells4_4 INT, ";
$variables .= "Shells5_1 INT, Shells5_2 INT, Shells5_3 INT, Shells5_4 INT, Shells5_5 INT, ";
$variables .= "Lifeguard INT, Pier INT, Place1 INT, Place2 INT, ";
$variables .= "Slider1 INT, Slider2 INT, ";
$variables .= "Poem INT, Art INT, ";

$variables .= "PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE BeachItem (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>