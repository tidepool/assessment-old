<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query
$variables = "ID INT NOT NULL AUTO_INCREMENT, ";

for($i=1;$i<=48;$i++)
{
    $variables .= "p".$i." INT, ";
}
$variables .= " PRIMARY KEY (ID)";
echo $variables;
$query = "CREATE TABLE MotivationScoring (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>