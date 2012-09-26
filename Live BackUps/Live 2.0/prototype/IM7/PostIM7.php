<?php
echo "<html>\n";
echo "<title>IM7 Post</title>\n";
$ID = -1;
$data = $_REQUEST ['data'];
$ID = $_REQUEST ['ID'];

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
        $ISOquery .= "7_1=1";
        $IM = "Secure";
    }
    else if($data == "2")
    {
        $ISOquery .= "7_2=1";
        $IM = "Dismissive";
    }
    else if($data == "3")
    {
        $ISOquery .= "7_3=1";
        $IM = "Preoccupied";
    }
    else if($data == "4")
    {
        $ISOquery .= "7_4=1";
        $IM = "Fearful";
    }
    else
    {
        $ISOquery .= "7_1=-1";
        $IM = -1;
    }

}

function uploadScoring()
{
    Global $IM, $ID;

    $link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
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

    mysql_close($link);
}

function uploadISO()
{
    Global $ISOquery, $ID;

    $link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = "UPDATE IMISO SET ".$ISOquery." WHERE id=$ID;";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);
}

//echo "<h1>TEST</h1>";
echo "<h1> </h1>";
echo "<script language=\"JavaScript\">";
echo "document.body.innerHTML += '<form id=\"form\" action=\"http://tidepool.co/assessment/prototype/Resilience/Resilience.php\" method=\"post\"><input type=\"hidden\" name=\"ID\" value=\"$ID\"/><input type=\"hidden\" name=\"password\" value=\"d3mo\"/>';";
echo "document.getElementById(\"form\").submit();";
echo "</script>";
echo "</body>\n";
echo "</html>\n";
?>