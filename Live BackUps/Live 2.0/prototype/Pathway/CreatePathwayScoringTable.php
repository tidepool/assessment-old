<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query
$variables = "id INT NOT NULL AUTO_INCREMENT,";
$variables .= "L1 INT, L2 INT, L3 INT, L4 INT, L5 INT, L6 INT, L7 INT, L8 INT, ";
$variables .= "S1 INT, S2 INT, S3 INT, S4 INT, S5 INT, S6 INT, S7 INT, S8 INT, ";
$variables .= "PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE PathwayScoring (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>