<?php

include_once "../Live/dbConnect.php";
establishConnection();
$ID = -1;
$data = $_REQUEST ['data'];
$changes = $_REQUEST ['changes'];
$ID = $_REQUEST ['ID'];
//$ID = 325223443;
$IM;
$ISOquery = "'$ID'";
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
    Global $ISOquery,$ID;

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
        $query = "INSERT INTO Timing VALUES ('$ID', '', '$date', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '','','','');";
    }
    else
    {
        $query = "UPDATE Timing SET IM1='$date' where ID='$ID';";
    }
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    $query = "INSERT INTO IMScoring VALUES (".$ISOquery.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

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
    Global $ISOquery;

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

    uploadChanges();
}


function uploadChanges()
{
    Global $ISOquery, $ID, $changes;

    $ISOquery .= ", 0, 0, 0, 0";//2
    $ISOquery .= ", 0, 0, 0, 0";//3
    $ISOquery .= ", 0, 0, 0, 0";//4
    $ISOquery .= ", 0, 0, 0, 0";//5
    $ISOquery .= ", 0, 0, 0, 0";//6
    $ISOquery .= ", 0, 0, 0, 0";//7

    $query = "INSERT INTO IMChanges VALUES ('$ID','$changes','','','','','','');";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
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