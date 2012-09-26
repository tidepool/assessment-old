<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query

$variables = "FBID BIGINT, TID BIGINT, LIID VARCHAR(20), Name VARCHAR(30), Login VARCHAR(30), Password VARCHAR(30), WorkType VARCHAR(3), Stage INT, UNIQUE (FBID), UNIQUE (TID), UNIQUE (LIID), UNIQUE (Login),IncID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (IncID) ";
echo $variables;
$query = "CREATE TABLE Delta (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>