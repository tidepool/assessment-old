<?php

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
uploadScoring();
//displayInputs();
function readInputs()
{
    Global $balloons ,$xml_array;

    foreach($xml_array as $values)
    {
       // print_r($values);

        $set = array();
        $set['name'] = $values->getName();
        $temp = balloonScoring(intval($values));
        $set['value'] = $temp;
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

function uploadISO()
{
    Global $balloons, $ID;

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $queryChunk = "$ID";

    for($i=0; $i<8;$i++)
    {
        $value = $balloons[$i]['value'];
        $queryChunk .= ", $value";
    }
    $query = "INSERT INTO BalloonISO VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);
}

function uploadScoring()
{
    Global $balloons, $ID;

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $queryChunk = "$ID";

    for($i=0; $i<8;$i++)
    {
        $value = $balloons[$i]['value'];
        $queryChunk .= ", $value";
    }
    $query = "INSERT INTO BalloonScoring VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);
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