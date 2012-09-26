<?php

$link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');

$ID = substr($wt1,0,2).substr($wt2,0,2);
//echo "<p>$ID</p>";
$query = "SELECT ID,title FROM WorkTypes;";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "<p>Print: ".print_r($line)."</p>";
    echo "<p>ID: ".$line['ID']." Title: ".$line['title']."</p>";
    getAvg($line['ID'],$line['title']);
    //foreach ($line as $col_value) {}
}

mysql_free_result($result);
mysql_close($link);

function getAvg($code,$name)
{
    $query = "SELECT AVG(Accuracy), Count(Accuracy) FROM `Feedback` WHERE ID in (SELECT id FROM UserInfo WHERE WorkType='$code')";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    echo "<p>Print: ".print_r($temp)."</p>";
    $avg = $temp[0];
    $count = $temp[1];
    mysql_free_result($result);

    if($count == 0)
    {
        $avg = 0;
    }
    $queryChunk = "'$code','$name',$avg,$count";
    $query = "INSERT INTO WorkTypeAvgs Values ($queryChunk)";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
}
?>