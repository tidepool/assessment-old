<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query

$variables = "ID INT NOT NULL AUTO_INCREMENT,";
$variables .= "whole INT, detail INT, negative INT, movement INT, color INT, achromatic INT, shading INT, texture INT, reflection INT, smiley VARCHAR(10), slider1 INT, slider2 INT, slider3 INT, slider4 INT, slider5 INT, Date VARCHAR(37), ";
$variables .= " PRIMARY KEY (ID)";
echo $variables;
$query = "CREATE TABLE DarkScoring (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>