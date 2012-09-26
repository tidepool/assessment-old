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
$link;

$picturePreference = array();
$pictureGroup = array();
$ordering = array();
$motivationISO = array();
$motivationScoring = array();
for($i=0;$i<48;$i++)
{
    $motivationISO[$i] = 0;
    $motivationScoring[$i] = 0;
}

readInputs();
scorePicturePreference();
scorePictureGroup();
scoreOrdering();
uploadISO();
//uploadScoring();

function readInputs()
{
    Global $xml_array, $picturePreference, $pictureGroup, $ordering;
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
                //echo "<p>$value->selected</p>";
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
    Global $motivationISO, $motivationScoring, $picturePreference;

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
        //echo "<p>Letter is: $letter and number is: $number</p>";
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
        //echo "<p>Letter is: $letter and number is: $number</p>";
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

function uploadISO()
{
    Global $ID, $motivationISO,$link;
    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $queryChunk = "'$ID'";
    foreach($motivationISO as $mot)
    {
        $queryChunk .= ", ".$mot;
    }
    //echo $queryChunk;
    $query = "INSERT INTO SpaceItem VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
   uploadScoring();
}

function uploadScoring()
{
    Global $ID, $motivationScoring,$link;

    $queryChunk = "'$ID'";
    foreach($motivationScoring as $mot)
    {
        $queryChunk .= ", ".$mot;
    }
    //echo $queryChunk;
    $query = "INSERT INTO SpaceScoring VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);
}

echo "complete";
?>