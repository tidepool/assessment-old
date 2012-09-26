<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query

$variables = "id VARCHAR(30), Name VARCHAR(40), WorkType VARCHAR(3), Date VARCHAR(37), IP VARCHAR(25), FullName VARHCHAR(40), Email VARCHAR(50), PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE UserInfo (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>