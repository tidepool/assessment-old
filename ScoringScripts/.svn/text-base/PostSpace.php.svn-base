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
//echo $data;
$ID = $_REQUEST ['ID'];
//$ID = "test--g6na1sgr41";
$xml = simplexml_load_string($data);
$xml_array=object2array($xml);

$picturePreference = array();
$macbarChanges = array();
$cycles = array();
$pictureGroup = array();
$macbar = array();
$motivationISO = array();
$motivationScoring = array();
$motivationChanges = array();
$subDimensions = array();
$timeWaiting = 0;
$timeMoving = 0;
$subDimensions['acceptance'] = 0;
$subDimensions['peacefulness'] = 0;
$subDimensions['curiosity'] = 0;
$subDimensions['leadership'] = 0;
$subDimensions['orderliness'] = 0;
$subDimensions['altruism'] = 0;
$subDimensions['interdependence'] = 0;
$subDimensions['energy'] = 0;
for($i=0;$i<48;$i++)
{
    $motivationISO[$i] = 0;
    $motivationScoring[$i] = 0;
}

readInputs();
countTiming();
//print_r($macbar);
scoreBars();
scoreSubDimensions();
uploadISO();
//uploadScoring();

function readInputs()
{
    Global $xml_array, $picturePreference, $macbar, $cycles, $macbarChanges;
    foreach($xml_array as $values)
    {
        //print_r($values);
        //echo "<p>NEXT</p>";
        if($values->getName() == "picturePreference")
        {
            //print_r($values);
            foreach($values->children() as $value)
            {
                $picturePreference[] = $value->sel;
                $ind = substr($value->sel,1);
                $cycles[$ind] = $value->ti;
                //echo "<p>".$value->selected." Cylce: ".$value->cycles."</p>";
            }
        }
        else if($values->getName() == "bars")
        {
            foreach($values->children() as $value)
            {
                $temp = array();
                foreach($value->children() as $v)
                {
                    if($v->getName() == "changes")
                    {
                        $macbarChanges[] = $v;
                    }
                    else
                    {
                        $temp[] = $v;
                    }
                    //echo "<p>V $v</p>";
                }
                $macbar[] = $temp;
            }
        }
    }
}
function countTiming()
{
    global $macbarChanges;
    foreach($macbarChanges as $change)
    {
        //print_r($change);
        $instances = explode("*",$change);
        $first=true;
        foreach($instances as $inst)
        {
            if(!$first)
            {
                parseChanges($inst);
            }
            else
            {
                $first = false;
            }
        }
    }
}
function parseChanges($string)
{
    Global $timeMoving, $timeWaiting;


    $pound = strpos($string,"#");

    //echo "<p>String: $string</p>";
    if($pound === false)
    {
        $ind = strpos($string,"@");
        $letter = substr($string,0,$ind);
        $time = substr($string,$ind+1);
        $timeWaiting += $time;
        //echo "<p>1: Letter $letter Time: $time</p>";
    }
    else
    {
        $ind = strpos($string,"@");
        $letter = substr($string,0,$ind);
        $time1 = substr($string,$ind+1,$pound-$ind-1);
        $ind = strrpos($string,"@");
        $time2 = substr($string,$ind+1);
        $time = $time2;
        $timeWaiting += $time1;
        $timeMoving += $time2;
        //echo "<p>2: Letter $letter Time1: $time1 Time2: $time2</p>";
    }
}
function calculateTime($time, $cys)
{
    $time += $cys * 5000;
    return $time;
}
function scoreBars()
{
    Global $motivationISO, $motivationScoring, $macbar;

    //print_r($macbar);
    for($i = 0;$i<3;$i++)
    {
        $value = 0;
        foreach($macbar[$i] as $pic)
        {
            if($value != 0)
            {
                $letter = substr($pic,0,1);
                $number = intval(substr($pic,1)) - 1;
                //echo "<p>letter $letter number $number</p>";
                if($letter == "a")
                {
                    $index = ($number * 2);
                }
                else if($letter == "b")
                {
                    $index = ($number * 2)+1;
                }
                else
                {
                    echo "<p>ERROR</p>";
                }

                //echo "<p>$index gets $value</p>";
                $motivationISO[$index] += $value;
                $motivationScoring[$index] += $value;
            }
            $value++;
        }
    }
}

function scoreSubDimensions()
{
    Global $motivationScoring, $subDimensions;

    for($i = 0;$i<count($motivationScoring);$i++)
    {
        if($i == 14 || $i == 30 || $i == 46)
        {
            $subDimensions['acceptance'] += $motivationScoring[$i];
        }
        elseif($i == 15 || $i == 31 || $i == 47)
        {
            $subDimensions['acceptance'] -= $motivationScoring[$i];
        }
        elseif($i == 12 || $i == 28 || $i == 44)
        {
            $subDimensions['peacefulness'] += $motivationScoring[$i];
        }
        elseif($i == 13 || $i == 29 || $i == 45)
        {
            $subDimensions['peacefulness'] -= $motivationScoring[$i];
        }
        elseif($i == 10 || $i == 26 || $i == 42)
        {
            $subDimensions['curiosity'] += $motivationScoring[$i];
        }
        elseif($i == 11 || $i == 27 || $i == 43)
        {
            $subDimensions['curiosity'] -= $motivationScoring[$i];
        }
        elseif($i == 8 || $i == 24 || $i == 40)
        {
            $subDimensions['leadership'] += $motivationScoring[$i];
        }
        elseif($i == 9 || $i == 25 || $i == 41)
        {
            $subDimensions['leadership'] -= $motivationScoring[$i];
        }
        elseif($i == 6 || $i == 22 || $i == 38)
        {
            $subDimensions['orderliness'] += $motivationScoring[$i];
        }
        elseif($i == 7 || $i == 23 || $i == 39)
        {
            $subDimensions['orderliness'] -= $motivationScoring[$i];
        }
        elseif($i == 4 || $i == 20 || $i == 36)
        {
            $subDimensions['altruism'] += $motivationScoring[$i];
        }
        elseif($i == 5 || $i == 21 || $i == 37)
        {
            $subDimensions['altruism'] -= $motivationScoring[$i];
        }
        elseif($i == 2 || $i == 18 || $i == 34)
        {
            $subDimensions['interdependence'] += $motivationScoring[$i];
        }
        elseif($i == 3 || $i == 19 || $i == 35)
        {
            $subDimensions['interdependence'] -= $motivationScoring[$i];
        }
        elseif($i == 0 || $i == 16 || $i == 32)
        {
            $subDimensions['energy'] += $motivationScoring[$i];
        }
        elseif($i == 1 || $i == 17 || $i == 33)
        {
            $subDimensions['energy'] -= $motivationScoring[$i];
        }
        else
        {
            echo " ERROR Number: $i ";
        }
        //echo "<p>$i</p>";
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
    Global $ID, $motivationISO;

    establishConnection();

    $date1 = $_COOKIE['date'];
    $date2 = date(DATE_RFC822);
    $diff = strtotime($date2) - strtotime($date1);
    $date = formatDate($diff);

    $query = "Select * FROM Timing WHERE ID='$ID';";
    $result = mysql_query($query) or die('Timing0 Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    $exists = $temp[0];
    mysql_free_result($result);
    if(strlen($exists) < 1)
    {
        $query = "INSERT INTO Timing VALUES ('$ID', '', '', '', '', '', '', '', '', '', '', '', '', '', '$date', '', '', '','','','');";
    }
    else
    {
        $query = "UPDATE Timing SET Space='$date' where ID='$ID';";
    }
    $result = mysql_query($query) or die('Timing1 Query failed: ' . mysql_error());
    mysql_free_result($result);

    $query = "UPDATE Timing SET Space='$date' where ID='$ID';";
    $result = mysql_query($query) or die('Timing2 Query failed: ' . mysql_error());
    mysql_free_result($result);

    //$ID ="v61684651w";
    $queryChunk = "'$ID'";
    foreach($motivationISO as $mot)
    {
        $queryChunk .= ", ".$mot;
    }
    //echo "<p>$queryChunk</p>";
    $query = "INSERT INTO SpaceItem VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Item Query failed: ' . mysql_error());
    mysql_free_result($result);
    uploadChanges();
}

function uploadChanges()
{
    Global $ID, $cycles,$macbarChanges;
    Global $timeMoving, $timeWaiting;

    $queryChunk = "'$ID'";
    for($i=1;$i<=count($cycles);$i++)
    {
        $queryChunk .= ", ".$cycles[$i];
    }
    foreach($macbarChanges as $change)
    {
        $queryChunk .= ", '$change'";
    }
    $queryChunk .= ", $timeMoving";
    $queryChunk .= ", $timeWaiting";
    //echo "<p>$queryChunk</p>";
    $query = "INSERT INTO SpaceChanges VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Changes Query failed: ' . mysql_error());
    mysql_free_result($result);
    uploadScoring();
}

function uploadScoring()
{
    Global $ID, $subDimensions;

    $queryChunk = "'$ID'";
    $queryChunk .= ",".$subDimensions['acceptance'].", ".$subDimensions['peacefulness'].",".$subDimensions['curiosity'].",".$subDimensions['leadership'];
    $queryChunk .= ",".$subDimensions['orderliness'].",".$subDimensions['altruism'].",".$subDimensions['interdependence'].",".$subDimensions['energy'];
    //echo "<p>$queryChunk</p>";
    $query = "INSERT INTO SpaceScoring VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Scoring Query failed: ' . mysql_error());
    mysql_free_result($result);

    endConnection();
}

echo "complete";
?>