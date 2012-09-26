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
//echo $data;
$ID = $_REQUEST ['ID'];
$xml = simplexml_load_string($data);
$xml_array=object2array($xml);
$link;

$picturePreference = array();
$changes;
$cycles = array();
$pictureGroup = array();
$ordering = array();
$motivationISO = array();
$motivationScoring = array();
$motivationChanges = array();
$subDimensions = array();
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
scorePicturePreference();
scorePictureGroup();
scoreOrdering();
scoreSubDimensions();
uploadISO();
//uploadScoring();

function readInputs()
{
    Global $xml_array, $picturePreference, $pictureGroup, $ordering, $cycles, $changes;
    foreach($xml_array as $values)
    {
        //print_r($values);
        //echo "<p>NEXT</p>";
        if($values->getName() == "picturePreference")
        {
            //print_r($values);
            foreach($values->children() as $value)
            {
                $picturePreference[] = $value->selected;
                $cycles[] = $value->cycles;
                //echo "<p>".$value->selected." Cylce: ".$value->cycles."</p>";
            }
        }
        else if($values->getName() == "pictureGroup")
        {
            //print_r($values);
            foreach($values->children() as $value)
            {
                $pictureGroup[] = $value->selected;
                //echo "<p>$value->selected</p>";
            }
        }
        else if($values->getName() == "changes")
        {
            //echo "<p>In changes</p>";
            $changes = $values;
            //echo "<p>Changes $changes</p>";
        }
        else if($values->getName() == "ordering")
        {
            foreach($values->children() as $value)
            {
                $ordering[] = $value;
                //echo "<p>$value</p>";
            }
        }
    }
}

function scorePicturePreference()
{
    Global $motivationISO, $motivationScoring, $picturePreference, $motivationChanges, $cycles;

    $count = 0;
    foreach($picturePreference as $pic)
    {
        $letter = substr($pic,0,1);
        $number = intval(substr($pic,1)) - 1;
        $index = 7;
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
            //echo "<p>ERROR</p>";
        }
        $motivationISO[$index] += 1;
        $motivationScoring[$index] += 1;
        $motivationChanges[$number] = $cycles[$count];
        //echo "<p>Letter is: $letter and number is: $number</p>";
        $count++;
    }

}

function scorePictureGroup()
{
    Global $motivationISO, $motivationScoring, $pictureGroup;

    foreach($pictureGroup as $pic)
    {
        $letter = substr($pic,0,1);
        $number = intval(substr($pic,1)) - 1;
        $index = 7;
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
            //echo "<p>ERROR</p>";
        }
        $motivationISO[$index] += 1;
        $motivationScoring[$index] += 1;
    }
}

function scoreOrdering()
{
    Global $motivationISO, $motivationScoring, $ordering;

    $amount = 0;
    foreach($ordering as $pic)
    {
        $letter = substr($pic,0,1);
        $number = intval(substr($pic,1)) - 1;
        $index = 7;
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
            //echo "<p>ERROR</p>";
        }
        $motivationISO[$index] += $amount;
        if($amount == 5)
        {
            $motivationScoring[$index] += 1;
        }
        else if($amount == 6)
        {
            $motivationScoring[$index] += 2;
        }
        else if($amount == 7)
        {
            $motivationScoring[$index] += 3;
        }
        $amount++;
    }
}

function scoreSubDimensions()
{
    Global $motivationScoring, $subDimensions;

    for($i = 0;$i<count($motivationScoring);$i++)
    {
        /*
        if($i == 16 || $i == 32 || $i == 48)
        {
            $subDimensions['acceptance'] += $motivationScoring[$i];
        }
        elseif($i == 17 || $i == 33 || $i == 49)
        {
            $subDimensions['acceptance'] -= $motivationScoring[$i];
        }
        */
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
    Global $ID, $motivationISO,$link;
    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
        or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $date1 = $_COOKIE['date'];
    $date2 = date(DATE_RFC822);
    $diff = strtotime($date2) - strtotime($date1);
    $date = formatDate($diff);
    $query = "INSERT INTO FoxtrotTiming VALUES ($ID, '$date', '', '');";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    //$ID ="vjnhs64onhw";
    $queryChunk = "'$ID'";
    foreach($motivationISO as $mot)
    {
        $queryChunk .= ", ".$mot;
    }
    //echo $queryChunk;
    $query = "INSERT INTO SpaceItem VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    uploadChanges();
}

function uploadChanges()
{
    Global $ID, $motivationChanges,$changes;

    $queryChunk = "'$ID'";
    for($i=0;$i<24;$i++)
    {
        $queryChunk .= ", ".$motivationChanges[$i];
    }
    $queryChunk .= ", '".$changes."'";
    //echo $queryChunk;
    $query = "INSERT INTO SpaceChanges VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    uploadScoring();
}

function uploadScoring()
{
    Global $ID, $subDimensions, $link;

    $queryChunk = "'$ID'";
    $queryChunk .= ",".$subDimensions['acceptance'].", ".$subDimensions['peacefulness'].",".$subDimensions['curiosity'].",".$subDimensions['leadership'];
    $queryChunk .= ",".$subDimensions['orderliness'].",".$subDimensions['altruism'].",".$subDimensions['interdependence'].",".$subDimensions['energy'];
    $query = "INSERT INTO SpaceScoring VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    $query = "UPDATE Delta SET Stage=1 WHERE Login='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);
}

echo "complete";
?>