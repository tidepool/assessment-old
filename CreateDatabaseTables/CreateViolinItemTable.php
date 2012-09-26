<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query
$variables = "id INT NOT NULL AUTO_INCREMENT,";
$variables .= "p1 INT, p2 INT, p3 INT, p4 INT, p5 INT, p6 INT, p7 INT, p8 INT, ";
$variables .= "d1 INT, d2 INT, d3 INT, d4 INT, d5 INT, d6 INT, d7 INT, d8 INT, ";
$variables .= "pie1 INT, pie2 INT, pie3 INT, pie4 INT, pie5 INT, pie6 INT, pie7 INT, pie8 INT, ";
$variables .= "PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE ViolinItem (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>