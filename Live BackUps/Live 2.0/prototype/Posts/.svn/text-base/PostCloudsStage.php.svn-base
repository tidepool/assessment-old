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
//print_r($data);

$pictures = array();
$pie1 = array();
$pie2 = array();
$p1 = array();
$p2 = array();
$subDimensions = array();
$subDimensions['artistic'] = 0;
$subDimensions['conventional'] = 0;
$subDimensions['enterprising'] = 0;
$subDimensions['investigative'] = 0;
$subDimensions['realistic'] = 0;
$subDimensions['social'] = 0;
$scoring;
$holland = array();
$holland['pictures'] = $pictures;
$holland['pie'] = $ordering;
$holland['subDimensions'] = $subDimensions;

readInputs();
scorePictures();
scorePieCharts();
CalculateType();
uploadISO();

function readInputs()
{
    Global $xml_array, $pictures, $pie1, $pie2;
    foreach($xml_array as $values)
    {

        if($values->getName() == "pictures")
        {
            foreach($values->children() as $value)
            {
                $pictures[] = $value;
            }
        }
        else if($values->getName() == "pie1")
        {
            foreach($values->children() as $value)
            {
                $set = array();
                $temp = $value->getName();
                $temp = getSubDimension($temp);
                $set['type'] = $temp;
                $set['value'] = intval($value);
                $pie1[] = $set;
                //echo $set['type'].": ".$set['value'];
            }
        }
        else if($values->getName() == "pie2")
        {
            foreach($values->children() as $value)
            {
                $set = array();
                $temp = $value->getName();
                $temp = getSubDimension($temp);
                $set['type'] = $temp;
                $set['value'] = intval($value);
                $pie2[] = $set;
                //echo $set['type'].": ".$set['value'];
            }
        }
    }
}
function scorePictures()
{
    Global $pictures;
    foreach($pictures as $p)
    {
        scoreDimensions($p);
    }
}

function scorePieCharts()
{
    Global $scoring;
    $scoring = 6;
    while($scoring > 0)
    {
        ScorePIE1();
    }

    $scoring = 6;
    while($scoring > 0)
    {
        ScorePIE2();
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
    Global $ID, $pictures, $p1, $p2, $link;
    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $date1 = $_COOKIE['date'];
    $date2 = date(DATE_RFC822);
    $diff = strtotime($date2) - strtotime($date1);
    $date = formatDate($diff);
    $query = "UPDATE FoxtrotTiming SET Clouds='$date' where ID='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    $queryChunk = "'$ID'";
    for($i=1;$i<=66;$i++)//get cloud values
    {
        $found = false;
        for($j=0;$j<=count($pictures);$j++)
        {
            if($i == $pictures[$j])
            {
                $found = true;
                break;
            }
        }
        if($found)
        {
            $queryChunk .= ", 1";
        }
        else
        {
            $queryChunk .= ", 0";
        }
    }

    for($i=0;$i<count($p1);$i++)
    {
        global $pie1;
        $queryChunk .= ", ".$p1[$i];
    }
    for($i=0;$i<count($p2);$i++)
    {
        $queryChunk .= ", ".$p2[$i];
    }

    //echo $queryChunk;
    $query = "INSERT INTO CloudsItem VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    uploadScoring();
}

function uploadScoring()
{
    Global $ID, $subDimensions, $link;
    $queryChunk = "'$ID',".$subDimensions['artistic'].",".$subDimensions['conventional'].",".$subDimensions['enterprising'].",".$subDimensions['investigative'].",".$subDimensions['realistic'].",".$subDimensions['social'].",'".$subDimensions['type']."'";
    //echo $queryChunk;
    $query = "INSERT INTO CloudsScoring VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    $query = "UPDATE Delta SET Stage=2 WHERE Login='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);

}
function CalculateType()
{
    Global $subDimensions, $highest;

    $highest = 0;
    $type = null;

    if($subDimensions['artistic'] > $highest)
    {
        $highest = $subDimensions['artistic'];
        $type = "A";
    }
    if($subDimensions['conventional'] > $highest)
    {
        $highest = $subDimensions['conventional'];
        $type = "C";
    }
    if($subDimensions['enterprising'] > $highest)
    {
        $highest = $subDimensions['enterprising'];
        $type = "E";
    }
    if($subDimensions['investigative'] > $highest)
    {
        $highest = $subDimensions['investigative'];
        $type = "I";
    }
    if($subDimensions['realistic'] > $highest)
    {
        $highest = $subDimensions['realistic'];
        $type = "R";
    }
    if($subDimensions['social'] > $highest)
    {
        $highest = $subDimensions['social'];
        $type = "S";
    }

    //echo "<p>High: $highest Type: $type</p>";
    $subDimensions['type'] = $type;
}


function getSubDimension($s)
{
    if($s == "manual")
        return "realistic";
    if($s == "math")
        return "investigative";
    if($s == "musical")
        return "artistic";
    if($s == "understanding")
        return "social";
    if($s == "managerial")
        return "enterprising";
    if($s == "office")
        return "conventional";

    if($s == "mechanical")
        return "realistic";
    if($s == "scientific")
        return "investigative";
    if($s == "artistic")
        return "artistic";
    if($s == "teaching")
        return "social";
    if($s == "sales")
        return "enterprising";
    if($s == "clerical")
        return "conventional";

    return "ERROR";
}


function ScorePIE1()
{
    global $subDimensions, $pie1, $p1, $scoring;
    $newArray = array();
    $high = 0;
    $count = 0;
    for($i=0;$i<count($pie1);$i++)
    {
        if($pie1[$i]['value'] > $high)
        {
            $high = $pie1[$i]['value'];
        }
    }

    for($i=0;$i<count($pie1);$i++)
    {
        if($pie1[$i]['value'] == $high)
        {
            $tempName = $pie1[$i]['type'];
            //echo "<p>$tempName got a score of $scoring</p>";
            $subDimensions[''.$pie1[$i]['type'].''] += $scoring;
            $pie1[$i]['value'] = 0;
            $p1[$i] = $scoring;
            $count++;
        }
    }
    $scoring -= $count;
}

function ScorePIE2()
{
    global $subDimensions, $pie2, $p2, $scoring;
    $newArray = array();
    $high = 0;
    $count = 0;
    for($i=0;$i<count($pie2);$i++)
    {
        if($pie2[$i]['value'] > $high)
        {
            $high = $pie2[$i]['value'];
        }
    }

    for($i=0;$i<count($pie2);$i++)
    {
        if($pie2[$i]['value'] == $high)
        {
            $tempName = $pie2[$i]['type'];
            //echo "<p>$tempName got a score of $scoring</p>";
            $subDimensions[''.$pie2[$i]['type'].''] += $scoring;
            $pie2[$i]['value'] = 0;
            $p2[$i] = $scoring;
            $count++;
        }
    }
    $scoring -= $count;
}

function scoreDimensions($number)
{
    global $subDimensions;
    if ($number <= 11)
    {
        //echo "artistic";
        $subDimensions['artistic'] += 1;
        $temp = $subDimensions['artistic'];
        //echo "<p>Artistic score is $temp</p>";
    }
    else if ($number <= 22)
    {
        //echo "conventional";
        $subDimensions['conventional'] += 1;
        $temp = $subDimensions['conventional'];
        //echo "<p>conventional score is $temp</p>";
    }
    else if ($number<=33)
    {
        //echo "enterprising";
        $subDimensions['enterprising'] += 1;
        $temp = $subDimensions['enterprising'];
        //echo "<p>enterprising score is $temp</p>";
    }
    else if ($number <= 44)
    {
        //echo "investigative";
        $subDimensions['investigative'] += 1;
        $temp = $subDimensions['investigative'];
        //echo "<p>investigative score is $temp</p>";
    }
    else if ($number <= 55)
    {
        //echo "realistic";
        $subDimensions['realistic'] += 1;
        $temp = $subDimensions['realistic'];
        //echo "<p>realistic score is $temp</p>";
    }
    else if ($number <= 66)
    {
        //echo "social";
        $subDimensions['social'] += 1;
        $temp = $subDimensions['social'];
        //echo "<p>social score is $temp</p>";
    }
}

echo "complete";
?>