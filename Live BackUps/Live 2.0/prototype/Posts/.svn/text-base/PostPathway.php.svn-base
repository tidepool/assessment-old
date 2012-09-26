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
$link;

$incentivesLarge = array();
$incentivesSmall = array();
$scoreISOLarge = array();
$scoreISOSmall = array();
$scoreLarge = array();
$scoreSmall = array();
for($i=1;$i<=8;$i++)
{
    $scoreISOLarge[] = 0;
    $scoreISOSmall[] = 0;
    $scoreLarge[] = 0;
    $scoreSmall[] = 0;
}

readInputs();
scoring();
UploadISO();

function scoring()
{
    scoreLarge();
    scoreSmall();
}

function scoreLarge()
{
    Global $incentivesLarge, $scoreISOLarge, $scoreLarge;

    for($i=0;$i<count($incentivesLarge);$i++)
    {
        $scoreISOLarge[$incentivesLarge[$i]-1] += $i+1;
        $scoreLarge[$incentivesLarge[$i]-1] += 1;
    }
}

function scoreSmall()
{
    Global $incentivesSmall,$scoreISOSmall,$scoreSmall;

    for($i=0;$i<count($incentivesSmall);$i++)
    {
        $scoreISOSmall[$incentivesSmall[$i]-1] += $i+1;
        $scoreSmall[$incentivesSmall[$i]-1] += 1;
    }
}

function readInputs()
{
    Global $xml_array, $incentivesLarge, $incentivesSmall;

    foreach($xml_array as $values)
    {
        if($values->getName() == "large")
        {
            //echo "<p>LARGE</p>";
            foreach($values as $value)
            {
                $incentivesLarge[] = intval($value);
            }
        }
        if($values->getName() == "small")
        {
            //echo "<p>SMALL</p>";
            foreach($values as $value)
            {
                $incentivesSmall[] = intval($value);
            }
        }
    }
}

function UploadISO()
{
    Global $ID, $scoreISOLarge, $scoreISOSmall, $link;
    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    //$ID = 45;
    $queryChunk = "$ID";

    foreach($scoreISOLarge as $score)
    {
        $queryChunk .= ", $score";
    }
    //echo "<p>$queryChunk</p>";
    foreach($scoreISOSmall as $score)
    {
        $queryChunk .= ", $score";
    }
    //echo "<p>$queryChunk</p>";

    //echo $queryChunk;
    $query = "INSERT INTO PathwayISO VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    UploadScoring();
}


function UploadScoring()
{
    Global $ID, $scoreSmall, $scoreLarge, $link;

    $queryChunk = "$ID";
    foreach($scoreLarge as $score)
    {
        $queryChunk .= ", $score";
    }
    //echo "<p>$queryChunk</p>";
    foreach($scoreSmall as $score)
    {
        $queryChunk .= ", $score";
    }
    //echo "<p>$queryChunk</p>";

    //echo $queryChunk;
    $query = "INSERT INTO PathwayScoring VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);
}

echo "complete";
?>