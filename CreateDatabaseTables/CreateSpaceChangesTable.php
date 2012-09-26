<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query

$variables = "id VARCHAR(30) NOT NULL,";
for($i=1;$i<=24;$i++)
{
    $variables .= $i."Cycles INT, ";
}
$variables .= "Changes TEXT, ";
$variables .= "PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE SpaceChanges (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>