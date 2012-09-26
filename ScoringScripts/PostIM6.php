<?php

include_once "../Live/dbConnect.php";
establishConnection();
$ID = -1;
$data = $_REQUEST ['data'];
$changes = $_REQUEST ['changes'];
$ID = $_REQUEST ['ID'];
//echo "data: $data";
//echo "changes: $changes";
//echo "ID: $ID";
//$ID = 325223443;
$IM;
$ISOquery = "";
IMScoring();
uploadScoring();
uploadISO();

function IMScoring()
{
    Global $data, $ISOquery, $IM;
    //echo "<h2>DATA is: |$data|</h2>";
    if($data == "1")
    {
        $ISOquery .= "6_1=1";
        $IM = "Secure";
    }
    else if($data == "2")
    {
        $ISOquery .= "6_2=1";
        $IM = "Dismissive";
    }
    else if($data == "3")
    {
        $ISOquery .= "6_3=1";
        $IM = "Preoccupied";
    }
    else if($data == "4")
    {
        $ISOquery .= "6_4=1";
        $IM = "Fearful";
    }
    else
    {
        $ISOquery .= "3_1=-1";
        $IM = -1;
    }

}

function uploadScoring()
{
    Global $IM, $ID;

    establishConnection();

    $date1 = $_COOKIE['date'];
    $date2 = date(DATE_RFC822);
    $diff = strtotime($date2) - strtotime($date1);
    $date = formatDate($diff);
    $query = "UPDATE Timing SET IM6='$date' where ID='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    $query = "SELECT ".$IM." FROM IMScoring WHERE ID='$ID';";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $amt = mysql_result($result, 0);
    mysql_free_result($result);

    $temp = intval($amt);
    $temp++;
    $query = "UPDATE IMScoring SET ".$IM."=".$temp." WHERE ID='$ID';";
    //echo $query;
    $result = mysql_query($query) or die('Scoring Query failed: ' . mysql_error());
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
    Global $ISOquery, $ID;

    $query = "UPDATE IMISO SET ".$ISOquery." WHERE ID='$ID';";
    //echo $query;
    $result = mysql_query($query) or die('ISO Query failed: ' . mysql_error());
    mysql_free_result($result);

    uploadChanges();
}


function uploadChanges()
{
    Global $changes, $ID;

    $query = "UPDATE IMChanges SET IM6='$changes' WHERE id='$ID';";
    //echo $query;
    $result = mysql_query($query) or die('Changes Query failed: ' . mysql_error());
    mysql_free_result($result);

    endConnection();
}
echo "complete";
?>