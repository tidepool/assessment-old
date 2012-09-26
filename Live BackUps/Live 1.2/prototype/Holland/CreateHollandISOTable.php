<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query
$variables = "id INT NOT NULL AUTO_INCREMENT,";
$variables .= "1c1 INT, 1c2 INT, 1c3 INT, 1c4 INT, 1c5 INT, 1c6 INT, 2c1 INT, 2c2 INT, 2c3 INT, 2c4 INT, 2c5 INT, 2c6 INT,";
$variables .= "3c1 INT, 3c2 INT, 3c3 INT, 3c4 INT, 3c5 INT, 3c6 INT, 4c1 INT, 4c2 INT, 4c3 INT, 4c4 INT, 4c5 INT, 4c6 INT,";
$variables .= "5c1 INT, 5c2 INT, 5c3 INT, 5c4 INT, 5c5 INT, 5c6 INT, 6c1 INT, 6c2 INT, 6c3 INT, 6c4 INT, 6c5 INT, 6c6 INT,";
$variables .= "7c1 INT, 7c2 INT, 7c3 INT, 7c4 INT, 7c5 INT, 7c6 INT, 8c1 INT, 8c2 INT, 8c3 INT, 8c4 INT, 8c5 INT, 8c6 INT,";
$variables .= "9c1 INT, 9c2 INT, 9c3 INT, 9c4 INT, 9c5 INT, 9c6 INT, 10c1 INT, 10c2 INT, 10c3 INT, 10c4 INT, 10c5 INT, 10c6 INT,";
$variables .= "11c1 INT, 11c2 INT, 11c3 INT, 11c4 INT, 11c5 INT, 11c6 INT,";
$variables .= "1p1 INT, 1p2 INT, 1p3 INT, 1p4 INT, 1p5 INT, 1p6 INT, 2p1 INT, 2p2 INT, 2p3 INT, 2p4 INT, 2p5 INT, 2p6 INT,";
$variables .= "PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE HollandISO (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>