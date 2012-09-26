<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query
$variables = "id INT NOT NULL AUTO_INCREMENT,";
$variables .= "1_1 INT, 1_2 INT, 1_3 INT, 1_4 INT, ";
$variables .= "2_1 INT, 2_2 INT, 2_3 INT, 2_4 INT, ";
$variables .= "3_1 INT, 3_2 INT, 3_3 INT, 3_4 INT, ";
$variables .= "4_1 INT, 4_2 INT, 4_3 INT, 4_4 INT, ";
$variables .= "5_1 INT, 5_2 INT, 5_3 INT, 5_4 INT, ";
$variables .= "6_1 INT, 6_2 INT, 6_3 INT, 6_4 INT, ";
$variables .= "7_1 INT, 7_2 INT, 7_3 INT, 7_4 INT, ";
$variables .= "PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE IMItem (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>