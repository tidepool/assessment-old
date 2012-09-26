<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query
$variables = "ID VARCHAR(30) NOT NULL,";
$variables .= "Space VARCHAR(30), Clouds VARCHAR(30), Frames VARCHAR(30),";
$variables .= " PRIMARY KEY (ID)";
echo $variables;
$query = "CREATE TABLE FoxtrotTiming (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>