<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query
$variables = "id VARCHAR(30) NOT NULL,";
$variables .= "1p1 INT, 1p2 INT, 1p3 INT, 1p4 INT, 1p5 INT, ";
$variables .= "2p1 INT, 2p2 INT, 2p3 INT, 2p4 INT, 2p5 INT, ";
$variables .= "3p1 INT, 3p2 INT, 3p3 INT, 3p4 INT, 3p5 INT, ";
$variables .= "4p1 INT, 4p2 INT, 4p3 INT, 4p4 INT, 4p5 INT, ";
$variables .= "5p1 INT, 5p2 INT, 5p3 INT, 5p4 INT, 5p5 INT, ";
$variables .= "6p1 INT, 6p2 INT, 6p3 INT, 6p4 INT, 6p5 INT, ";
$variables .= "1c1 INT, 1c2 INT, "; 
$variables .= "2c1 INT, 2c2 INT, "; 
$variables .= "3c1 INT, 3c2 INT, "; 
$variables .= "4c1 INT, 4c2 INT, "; 
$variables .= "5c1 INT, 5c2 INT, "; 
$variables .= "6c1 INT, 6c2 INT, "; 
$variables .= "7c1 INT, 7c2 INT, "; 
$variables .= "8c1 INT, 8c2 INT, "; 
$variables .= "9c1 INT, 9c2 INT, "; 
$variables .= "10c1 INT, 10c2 INT, "; 
$variables .= "PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE FramesItem (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>