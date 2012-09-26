<?php
require_once "../Live/dbConnect.php";
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
$data = $_POST ['data'];
$ID = $_POST ['ID'];
$xml = simplexml_load_string($data);
$xml_array=object2array($xml);
$link;
//$ID = "fhj3se332gnmghyddXhahe";
//print_r($data);

$pictures = array();
$balloon1 = array();
$balloon2 = array();
$b1 = array();
$b2 = array();
$balloonScale = "";
$subDimensions = array();
$subDimensions['artistic'] = 0;
$subDimensions['conventional'] = 0;
$subDimensions['enterprising'] = 0;
$subDimensions['investigative'] = 0;
$subDimensions['realistic'] = 0;
$subDimensions['social'] = 0;
$scoring;
$speedChng;
$pictureChng;
$holland = array();
$holland['pictures'] = $pictures;
$holland['Balloon'] = $ordering;
$holland['subDimensions'] = $subDimensions;

readInputs();
scorePictures();

//print_r($balloon1);
scoreBalloonsScale();
scoreBalloonsComp();
CalculateType();
uploadISO();

function readInputs()
{
    Global $xml_array, $pictures, $balloon1, $balloon2, $speedChng, $pictureChng;
    foreach($xml_array as $values)
    {

        if($values->getName() == "pictures")
        {
            foreach($values->children() as $value)
            {
                $pictures[] = $value;
            }
        }
        else if($values->getName() == "balloon1")
        {
            foreach($values->children() as $value)
            {
                $balloon1[] = intval($value);
                //echo $set['type'].": ".$set['value'];
            }
        }
        else if($values->getName() == "balloon2")
        {
            foreach($values->children() as $value)
            {
                $balloon2[] = intval($value);
                //echo $set['type'].": ".$set['value'];
            }
        }
        else if($values->getName() == "changes")
        {
            $pictureChng = $values->clouds;
            $speedChng = $values->speed;
            $balloon1['changes'] = $values->balloon1;
            $balloon2['changes'] = $values->balloon2;
        }
    }
}
function scorePictures()
{
    Global $pictures;
    foreach($pictures as $b)
    {
        scoreDimensions($b);
    }
    clacPercentages();
}


function clacPercentages()
{
    Global $subDimensions;

    $total = 0;
    //printScores();
    foreach($subDimensions as $sub)
    {
        $total += $sub;
    }

    //echo "<p>$total</p>";
    $subDimensions['artistic'] /= $total;
    $subDimensions['conventional'] /= $total;
    $subDimensions['enterprising'] /= $total;
    $subDimensions['investigative'] /= $total;
    $subDimensions['realistic'] /= $total;
    $subDimensions['social'] /= $total;
    giveValue();
}

function giveValue()
{
    Global $subDimensions;

    $max = 12;

    $subDimensions['artistic'] *= $max;
    $subDimensions['conventional'] *= $max;
    $subDimensions['enterprising'] *= $max;
    $subDimensions['investigative'] *= $max;
    $subDimensions['realistic'] *= $max;
    $subDimensions['social'] *= $max;

    $subDimensions['artistic'] = number_format($subDimensions['artistic'],2);
    $subDimensions['conventional'] = number_format($subDimensions['conventional'],2);
    $subDimensions['enterprising'] = number_format($subDimensions['enterprising'],2);
    $subDimensions['investigative'] = number_format($subDimensions['investigative'],2);
    $subDimensions['realistic'] = number_format($subDimensions['realistic'],2);
    $subDimensions['social'] = number_format($subDimensions['social'],2);
}

function scoreBalloonsScale()
{
    Global $balloon1, $balloon2, $balloonScale;

    //echo "<p>Balloon1 ".print_r($balloon1)."</p>";
    //echo "<p>Balloon2 ".print_r($balloon2)."</p>";
    for($i=0;$i<6;$i++)
    {
        $balloonScale .= ", ".getBalloonScale($balloon1[$i]);
    }
    for($i=0;$i<6;$i++)
    {
        $balloonScale .= ", ".getBalloonScale($balloon2[$i]);
    }
}

function getBalloonScale($num)
{
    if($num <= 20)
    {
        return 1;
    }
    else if($num <= 40)
    {
        return 2;
    }
    else if($num <= 60)
    {
        return 3;
    }
    else if($num <= 80)
    {
        return 4;
    }
    else if($num <= 100)
    {
        return 5;
    }
    else
    {
        return -1;
    }
}

function scoreBalloonsComp()
{
    Global $scoring;
    $scoring = 6;

    while($scoring > 0)
    {
        ScoreBalloon1();
    }
    $scoring = 6;
    while($scoring > 0)
    {
        ScoreBalloon2();
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
    Global $ID, $pictures, $b1, $b2, $link, $balloonScale;
    establishConnection();


    $date1 = $_COOKIE['date'];
    $date2 = date(DATE_RFC822);
    $diff = strtotime($date2) - strtotime($date1);
    $date = formatDate($diff);

    $query = sprintf("Select * FROM Timing WHERE ID='%s'",mysql_real_escape_string($ID));
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    $exists = $temp[0];
    mysql_free_result($result);
    if(strlen($exists) < 1)
    {
        $query = sprintf("INSERT INTO Timing VALUES ('%s', '', '', '', '', '', '', '', '', '%s', '', '', '', '', '', '', '', '','','','')",mysql_real_escape_string($ID),mysql_real_escape_string($date));
    }
    else
    {
        $query = sprintf("UPDATE Timing SET Clouds='%s' where ID='%s'",mysql_real_escape_string($date),mysql_real_escape_string($ID));
    }
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

    //echo "<p>B1: ".print_r($b1)."</p>";
    //echo "<p>B2: ".print_r($b2)."</p>";
    for($i=0;$i<count($b1);$i++)
    {
        $queryChunk .= ", ".$b1[$i];
    }

    for($i=0;$i<count($b2);$i++)
    {
        $queryChunk .= ", ".$b2[$i];
    }
    $queryChunk .= $balloonScale;
    //echo $queryChunk;
    $query = "INSERT INTO CloudsItemNew VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Iso Query failed: ' . mysql_error());
    mysql_free_result($result);
    uploadScoring();
}

function uploadScoring()
{
    Global $ID, $subDimensions;
    $queryChunk = "'$ID',".$subDimensions['artistic'].",".$subDimensions['conventional'].",".$subDimensions['enterprising'].",".$subDimensions['investigative'].",".$subDimensions['realistic'].",".$subDimensions['social'].",'".$subDimensions['type']."'";
    //echo $queryChunk;
    $query = "INSERT INTO CloudsScoring VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Scoring Query failed: ' . mysql_error());
    mysql_free_result($result);
    uploadChanges();

}

function uploadChanges()
{
    Global $ID, $balloon1, $balloon2, $speedChng,$pictureChng, $link;

    $queryChunk = "'$ID','$speedChng','$pictureChng','".$balloon1['changes']."','".$balloon2['changes']."'";

    $query = "INSERT INTO CloudsChanges VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Changes Query failed: ' . mysql_error());
    mysql_free_result($result);


    $query = sprintf("UPDATE SocialMediaUsers SET Stage=2 WHERE ID='%s'",mysql_real_escape_string($ID));
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    endConnection();
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

function ScoreBalloon1()
{
    global $subDimensions, $balloon1, $b1, $scoring;
    $high = 0;
    $count = 0;

    for($i=0;$i<6;$i++)
    {
        if($balloon1[$i] > $high)
        {
            $high = $balloon1[$i];
        }
    }

    for($i=0;$i<6;$i++)
    {
        if($balloon1[$i] == $high)
        {
            $sub = getSubDimension($i);
            $subDimensions[$sub] += $scoring;
            $balloon1[$i]= -1;
            $b1[$i] = $scoring;
            $count++;
        }
    }
    $scoring -= $count;
}


function ScoreBalloon2()
{
    global $subDimensions, $balloon2, $b2, $scoring;
    $high = 0;
    $count = 0;

    for($i=0;$i<6;$i++)
    {
        if($balloon2[$i] > $high)
        {
            $high = $balloon2[$i];
        }
    }

    for($i=0;$i<6;$i++)
    {
        if($balloon2[$i] == $high)
        {
            $sub = getSubDimension($i);
            $subDimensions[$sub] += $scoring;
            $balloon2[$i]= -1;
            $b2[$i] = $scoring;
            $count++;
        }
    }
    $scoring -= $count;
}
function getSubDimension($num)
{
    if($num == 0)
    {
        return "realistic";
    }
    else if($num == 1)
    {
        return "investigative";
    }
    else if($num == 2)
    {
        return "artistic";
    }
    else if($num == 3)
    {
        return "social";
    }
    else if($num == 4)
    {
        return "enterprising";
    }
    else if($num == 5)
    {
        return "conventional";
    }
    else
    {
    echo "<p>error with get sub dimension value is $num</p>";
    }
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
//echo "complete";
?>