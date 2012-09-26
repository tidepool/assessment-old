<?php

$link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query

$variables = "ID VARCHAR(30)";
for($i=1;$i<=24;$i++)
{
    $variables .= ",Space_Chng_PicSel_A$i INT, Space_Chng_PicSel_B$i INT";
}
for($i=1;$i<=24;$i++)
{
    $variables .= ",Space_Chng_MacBarTime_A$i INT, Space_Chng_MacBarTime_B$i INT";
}
for($i=1;$i<=24;$i++)
{
    $variables .= ",Space_Chng_MacBarChanges_A$i INT, Space_Chng_MacBarChanges_B$i INT";
}
$variables .= ",Space_Chng_TotMoveTime INT, Space_Chng_TotWaitTime_B$i INT";

echo $variables;
$query = "CREATE TABLE SpaceChangesFormatted (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>