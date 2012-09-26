<?php

include_once "../Live/dbConnect.php";
establishConnection();
function object2array($object) {
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    }
    else{
        $array = $object;
    }
    return $array;
}


$ID = -1;
$data = $_REQUEST ['data'];
$ID = $_REQUEST ['ID'];

$xml = simplexml_load_string($data);
$xml_array=object2array($xml);
$link;

$changes;
$rocks = array();
$rocksScoring = array();
$rocksISO = array();
for($i=1;$i<=9;$i++)
{
    $rocksScoring[] = 0;
    $rocksISO[] = 0;
}

readInputs();
scoring();
UploadISO();

function scoring()
{
    Global $rocks,$rocksScoring,$rocksISO;

    for($i=0;$i<count($rocks);$i++)
    {
        $rocksScoring[$rocks[$i]-1] += $i+1;
        $rocksISO[$rocks[$i]-1] += $i+1;
    }
}

function readInputs()
{
    Global $xml_array, $rocks, $changes;

    foreach($xml_array as $values)
    {
        if($values->getName() == "changes")
        {
            $changes = $values;
        }
        else
        {
            $rocks[] = intval($values);
        }
    }
}


function formatDate($diff)
{
    $hour = intval($diff/3600);
    if($hour < 10)
    {
        $hour = "0".$hour;
    }
    $diff = $diff%3600;
    $min = intval($diff/60);
    if($min < 10)
    {
        $min = "0".$min;
    }
    $sec = $diff%60;
    if($sec < 10)
    {
        $sec = "0".$sec;
    }
    //echo "<p>Diff Formatted $hour:$min:$sec</p>";
    return "$hour:$min:$sec";
}

function UploadISO()
{
    Global $ID, $rocksISO;

    establishConnection();

    $date1 = $_COOKIE['date'];
    $date2 = date(DATE_RFC822);
    $diff = strtotime($date2) - strtotime($date1);
    $date = formatDate($diff);

    $query = "Select * FROM Timing WHERE ID='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    $exists = $temp[0];
    mysql_free_result($result);
    if(strlen($exists) < 1)
    {
        $query = "INSERT INTO Timing VALUES ('$ID', '', '', '', '', '', '', '', '', '', '$date', '', '', '', '', '', '', '','','','');";
    }
    else
    {
        $query = "UPDATE Timing SET Pathway='$date' where ID='$ID';";
    }
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    $queryChunk = "'$ID'";

    foreach($rocksISO as $score)
    {
        $queryChunk .= ", $score";
    }
    //echo "<p>$queryChunk</p>";

    //echo $queryChunk;
    $query = "INSERT INTO PathwayISO VALUES ($queryChunk);";
    $result = mysql_query($query) or die('ISo Query failed: ' . mysql_error());
    mysql_free_result($result);
    UploadScoring();
}

function UploadScoring()
{
    Global $ID, $rocksScoring;

    $queryChunk = "'$ID'";

    foreach($rocksScoring as $score)
    {
        $queryChunk .= ", $score";
    }
    //echo "<p>$queryChunk</p>";

    //echo $queryChunk;
    $query = "INSERT INTO PathwayScoring VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Scoring Query failed: ' . mysql_error());
    mysql_free_result($result);

    UploadChanges();
}

function UploadChanges()
{
    Global $ID, $changes;

    $queryChunk = "'$ID','$changes'";
    //echo $queryChunk;
    $query = "INSERT INTO PathwayChanges VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Scoring Query failed: ' . mysql_error());
    mysql_free_result($result);

    endConnection();
}

echo "complete";
?>