<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query

$variables = "Name VARCHAR(40)";
for($i=1;$i<=100;$i++)
{
    $variables .= ",Q$i INT";
}
echo $variables;
$query = "CREATE TABLE PersonalityValidation (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>