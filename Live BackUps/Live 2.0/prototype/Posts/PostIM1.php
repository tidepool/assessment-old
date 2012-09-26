<?php
$ID = -1;
$data = $_REQUEST ['data'];
$ID = $_REQUEST ['ID'];
$link;
//$ID = 325223443;
$IM;
$ISOquery = "$ID";
IMScoring();
uploadScoring();
uploadISO();

function IMScoring()
{
    Global $data, $ISOquery;
    //echo "<h2>DATA is: |$data|</h2>";
    if($data == "1")
    {
        $ISOquery .= ", 1, 0, 0, 0";
        $IM = "Secure";
    }
    else if($data == "2")
    {
        $ISOquery .= ", 0, 1, 0, 0";
        $IM = "Dismissive";
    }
    else if($data == "3")
    {
        $ISOquery .= ", 0, 0, 1, 0";
        $IM = "Preoccupied";
    }
    else if($data == "4")
    {
        $ISOquery .= ", 0, 0, 0, 1";
        $IM = "Fearful";
    }
    else
    {
        $ISOquery .= ", -1, -1, -1, -1";
        $IM = -1;
    }

}

function uploadScoring()
{
    Global $IM, $ISOquery, $link;

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = "INSERT INTO IMScoring VALUES (".$ISOquery.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

}

function uploadISO()
{
    Global $ISOquery,$link;

    $ISOquery .= ", 0, 0, 0, 0";//2
    $ISOquery .= ", 0, 0, 0, 0";//3
    $ISOquery .= ", 0, 0, 0, 0";//4
    $ISOquery .= ", 0, 0, 0, 0";//5
    $ISOquery .= ", 0, 0, 0, 0";//6
    $ISOquery .= ", 0, 0, 0, 0";//7

    $query = "INSERT INTO IMISO VALUES (".$ISOquery.");";
    //echo $query;
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