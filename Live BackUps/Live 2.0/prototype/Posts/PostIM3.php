<?php
$ID = -1;
$data = $_REQUEST ['data'];
$ID = $_REQUEST ['ID'];
$link;
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
        $ISOquery .= "3_1=1";
        $IM = "Fearful";
    }
    else if($data == "2")
    {
        $ISOquery .= "3_2=1";
        $IM = "Secure";
    }
    else if($data == "3")
    {
        $ISOquery .= "3_3=1";
        $IM = "Dismissive";
    }
    else if($data == "4")
    {
        $ISOquery .= "3_4=1";
        $IM = "Preoccupied";
    }
    else
    {
        $ISOquery .= "3_1=-1";
        $IM = -1;
    }

}

function uploadScoring()
{
    Global $IM, $ID, $link;

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = "SELECT ".$IM." FROM IMScoring WHERE id=$ID;";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $amt = mysql_result($result, 0);
    mysql_free_result($result);

    $temp = intval($amt);
    $temp++;
    $query = "UPDATE IMScoring SET ".$IM."=".$temp." WHERE id=$ID;";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

}

function uploadISO()
{
    Global $ISOquery, $ID, $link;

    $query = "UPDATE IMISO SET ".$ISOquery." WHERE id=$ID;";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);
}

echo "complete";
?>