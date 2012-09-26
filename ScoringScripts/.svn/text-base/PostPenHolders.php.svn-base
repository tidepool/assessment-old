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

$choices = array();
$changes;
$scoreISO = array(0,0,0,0,0,0,0,0);

readInputs();
//print_r($choices);
scoring();
//print_r($choices);
//print_r($scoreISO);
UploadISO();

function scoring()
{
    Global $choices;

    CalculateType($choices[0],4);
    CalculateType($choices[1],3);
    CalculateType($choices[2],2);
    CalculateType($choices[3],1);
}
function readInputs()
{
    Global $xml_array, $choices, $changes;

    foreach($xml_array as $values)
    {
        if($values->getName() == "penHolders")
        {
            $choices[0] = $values->choice1;
            $choices[1] = $values->choice2;
            $choices[2] = $values->choice3;
            $choices[3] = $values->choice4;
            //echo "<p>$choices[0]</p>";
            //echo "<p>$choices[1]</p>";
            //echo "<p>$choices[2]</p>";
            //echo "<p>$choices[3]</p>";
        }
        else if($values->getName() == "changes")
        {
            $changes = $values;
        }
    }
}

function CalculateType($name, $value)
{
    Global $scoreISO;

    if($name == "acceptance")
    {
        $scoreISO[0] = $value;
    }
    else if($name == "interdepndence")
    {
        $scoreISO[1] = $value;
    }
    else if($name == "leadership")
    {
        $scoreISO[2] = $value;
    }
    else if($name == "energy")
    {
        $scoreISO[3] = $value;
    }
    else if($name == "orderliness")
    {
        $scoreISO[4] = $value;
    }
    else if($name == "peacefulness")
    {
        $scoreISO[5] = $value;
    }
    else if($name == "curiosity")
    {
        $scoreISO[6] = $value;
    }
    else if($name == "altruism")
    {
        $scoreISO[7] = $value;
    }
    else
    {

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
    Global $ID, $scoreISO;

    // $ID = 952215352;

    $queryChunk = "'$ID'";

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
        $query = "INSERT INTO Timing VALUES ('$ID', '$date', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '','','','');";
    }
    else
    {
        $query = "UPDATE Timing SET PenHolders='$date' where ID='$ID';";
    }
    $result = mysql_query($query) or die('Date Query failed: ' . mysql_error());
    mysql_free_result($result);

    foreach($scoreISO as $score)
    {
        $queryChunk .= ", $score";
    }
    //echo $queryChunk;
    $query = "INSERT INTO PenHoldersISO VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Item Query failed: ' . mysql_error());
    mysql_free_result($result);
    UploadScoring();
}


function UploadScoring()
{
    Global $ID, $scoreISO;

    $queryChunk = "'$ID'";

    foreach($scoreISO as $score)
    {
        $queryChunk .= ", $score";
    }
    //echo $queryChunk;
    $query = "INSERT INTO PenHoldersScoring VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Scoring Query failed: ' . mysql_error());
    mysql_free_result($result);
    UploadChanges();
}


function UploadChanges()
{
    Global $ID, $changes;

    $queryChunk = "'$ID','$changes'";
    //echo $queryChunk;
    $query = "INSERT INTO PenHoldersChanges VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Changes Query failed: ' . mysql_error());
    mysql_free_result($result);

    endConnection();
}

echo "complete";
?>