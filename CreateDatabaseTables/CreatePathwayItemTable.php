<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query
$variables = "id INT NOT NULL,";
$variables .= "Benefits INT, Training INT, Money INT, Support INT, Appreciation INT, Advancement INT, Credit INT, TimeOff INT, Education INT";
$variables .= "PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE PathwayItem (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>