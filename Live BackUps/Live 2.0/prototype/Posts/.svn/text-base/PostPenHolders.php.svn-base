<?php

function object2array($object) {
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    }
    else{
        $array = $object;
    }
    return $array;
}


$ID = -1;
$data = $_REQUEST ['data'];
$ID = $_REQUEST ['ID'];
$xml = simplexml_load_string($data);
$xml_array=object2array($xml);

$choices = array();
$scoreISO = array(0,0,0,0,0,0,0,0);

readInputs();
scoring();

UploadISO();

function scoring()
{
    Global $choices;
    
    CalculateType($choices[0],4);
    CalculateType($choices[1],3);
    CalculateType($choices[2],2);
    CalculateType($choices[3],1);
}
function readInputs()
{
    Global $xml_array, $choices;

    foreach($xml_array as $values)
    {
        if($values->getName() == "penHolders")
        {
            $choices[0] = $values->choice1;
            $choices[1] = $values->choice2;
            $choices[2] = $values->choice3;
            $choices[3] = $values->choice4;
            //echo "<p>$choices[0]</p>";
            //echo "<p>$choices[1]</p>";
            //echo "<p>$choices[2]</p>";
            //echo "<p>$choices[3]</p>";
        }
    }
}


function CalculateType($name, $value)
{
    Global $scoreISO;

    if($name == "approval")
    {
        $scoreISO[0] = $value;
    }
    else if($name == "relationships")
    {
        $scoreISO[1] = $value;
    }
    else if($name == "power")
    {
        $scoreISO[2] = $value;
    }

    else if($name == "physical")
    {
        $scoreISO[3] = $value;
    }
    else if($name == "order")
    {
        $scoreISO[4] = $value;
    }
    else if($name == "peace")
    {
        $scoreISO[5] = $value;
    }
    else if($name == "learn")
    {
        $scoreISO[6] = $value;
    }
    else if($name == "others")
    {
        $scoreISO[7] = $value;
    }
    else
    {

    }
}

function UploadISO()
{
    Global $ID, $scoreISO, $link;

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');
    $queryChunk = "$ID";

    for($i=0;$i<count($scoreISO);$i++)
    {
        $queryChunk .= ", ".$scoreISO[$i];
    }
    //echo $queryChunk;
    $query = "INSERT INTO PenHoldersISO VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    UploadScoring();
}


function UploadScoring()
{
    Global $ID, $scoreISO, $link;

    $queryChunk = "$ID";

    for($i=0;$i<count($scoreISO);$i++)
    {
        $queryChunk .= ", ".$scoreISO[$i];
    }
    //echo $queryChunk;
    $query = "INSERT INTO PenHoldersScoring VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);
}

echo "complete";
?>