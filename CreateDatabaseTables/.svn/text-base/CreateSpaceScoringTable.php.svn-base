<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query

$variables = "id VARCHAR(30) NOT NULL,";
$variables .= "Energy INT, Interdependence INT, Altruism INT, Orderliness INT, Leadership INT, Curiosity INT, Peacefulness INT, Acceptance INT, ";
$variables .= "PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE SpaceScoring (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>