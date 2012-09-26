<?php

include_once "../Live/dbConnect.php";
establishConnection();
function object2array($object) {
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    }
    else {
        $array = $object;
    }
    return $array;
}



$ID = -1;
$data = $_REQUEST ['data'];
$ID = $_REQUEST ['ID'];
$xml = simplexml_load_string($data);
$xml_array=object2array($xml);

//$ID = 325443;
$balloons = array();
readInputs();
uploadISO();
//uploadScoring();
//displayInputs();
function readInputs()
{
    Global $balloons ,$xml_array;

    foreach($xml_array as $values)
    {
        // print_r($values);
        $set = array();
        $set['name'] = $values->getName();
        if($set['name'] == "changes")
        {
            $set['value'] = $values;
        }
        else
        {
            $temp = balloonScoring(intval($values));
            $set['value'] = $temp;
        }
        $balloons[] = $set;
        //echo "<p>$values</p>";
        //echo "<p>$temp</p>";
    }
}


function balloonScoring($balloon)
{
    if($balloon <=20)
    {
        return 0;
    }
    else if($balloon <= 40)
    {
        return 1;
    }
    else if($balloon <= 60)
    {
        return 2;
    }
    else if($balloon <= 80)
    {
        return 3;
    }
    else if($balloon <= 100)
    {
        return 4;
    }
    else
    {
        return -1;
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

function uploadISO()
{
    Global $balloons, $ID;

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
        $query = "INSERT INTO Timing VALUES ('$ID', '', '', '', '', '$date', '', '', '', '', '', '', '', '', '', '', '', '','','','');";
    }
    else
    {
        $query = "UPDATE Timing SET Balloon='$date' where ID='$ID';";
    }
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    $queryChunk = "'$ID'";

    for($i=0; $i<9;$i++)
    {
        $value = $balloons[$i]['value'];
        $queryChunk .= ", $value";
    }
    $query = "INSERT INTO BalloonISO VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Item Query failed: ' . mysql_error());
    mysql_free_result($result);
    uploadScoring();
}

function uploadScoring()
{
    Global $balloons, $ID;

    $queryChunk = "'$ID'";

    for($i=0; $i<9;$i++)
    {
        $value = $balloons[$i]['value'];
        $queryChunk .= ", $value";
    }
    $query = "INSERT INTO BalloonScoring VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Scoring Query failed: ' . mysql_error());
    mysql_free_result($result);

    uploadChanges();
}


function uploadChanges()
{
    Global $balloons, $ID;

    $queryChunk = "'$ID','".$balloons[9]['value']."'";

    $query = "INSERT INTO BalloonChanges VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Changes Query failed: ' . mysql_error());
    mysql_free_result($result);

    endConnection();
}

function displayInputs()
{
    Global $balloons;

    foreach($balloons as $b)
    {
        $value = $b['value'];
        echo "<p>$value</p>";
    }

}
echo "complete";
?>