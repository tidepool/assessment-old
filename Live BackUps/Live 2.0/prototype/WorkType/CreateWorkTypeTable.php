<?php
$Frequency = 1;
$ConscientiousnessHigh = 20;
$ConscientiousnessLow = 20;
$AgreeablenessHigh = 20;
$AgreeablenessLow = 20;
$ExtroversionHigh = 20;
$ExtroversionLow = 20;
$NeuroticismHigh = 20;
$NeuroticismLow = 20;
$OpennessHigh = 20;
$OpennessLow = 20;

$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query

$variables = "id VARCHAR(10), paragraph1 TEXT, paragraph2 TEXT, paragraph3 TEXT, PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE WorkTypes (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>