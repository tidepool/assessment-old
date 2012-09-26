<?php
$link = mysql_connect('tidepoolmaster.caov91lo3dxj.us-east-1.rds.amazonaws.com', 'tidepool', 't1dep00L')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');

$subDimensions = array();
$subDimensions['artistic'] = 0;
$subDimensions['conventional'] = 0;
$subDimensions['enterprising'] = 0;
$subDimensions['investigative'] = 0;
$subDimensions['realistic'] = 0;
$subDimensions['social'] = 0;


$subDimensionsBalloon = array();
$subDimensionsBalloon['artistic'] = 0;
$subDimensionsBalloon['conventional'] = 0;
$subDimensionsBalloon['enterprising'] = 0;
$subDimensionsBalloon['investigative'] = 0;
$subDimensionsBalloon['realistic'] = 0;
$subDimensionsBalloon['social'] = 0;

readInputs();

function readInputs()
{
    Global $subDimensions,$subDimensionsBalloon;
    $query = "SELECT * FROM CloudsItemNew WHERE ID LIKE '%Harris%' ";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $count = 0;
        $pictureCount = 0;
        resetDimensions();
        foreach ($line as $col_value) {
            if($count == 0)
            {
                $ID = $col_value;
                echo "<p>$col_value</p>";
            }
            else if($count <= 66)
            {
                scoreDimensions($count,$col_value);
                $pictureCount += $col_value;
            }
            else if($count <= 78)
            {
                scoreDimensionsBalloon($count,$col_value);
                echo "<p>$count $col_value</p>";
            }
            $count++;
        }
        echo "<p>Picture Count: $pictureCount</p>";
        $subDimensionsNorm = $subDimensions;
        print_r($subDimensionsNorm);
        clacPercentages();
        echo "<br>";
        $subDimensionsWighted = $subDimensions;
        print_r($subDimensionsWighted);
        echo "<br>";
        print_r($subDimensionsBalloon);
        UploadScores($ID,$pictureCount,$subDimensionsNorm,$subDimensionsWighted,$subDimensionsBalloon);
    }

    mysql_free_result($result);
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

function resetDimensions()
{
    Global $subDimensions,$subDimensionsBalloon;

    $subDimensions['artistic'] *= 0;
    $subDimensions['conventional'] *= 0;
    $subDimensions['enterprising'] *= 0;
    $subDimensions['investigative'] *= 0;
    $subDimensions['realistic'] *= 0;
    $subDimensions['social'] *= 0;

    $subDimensionsBalloon['artistic'] *= 0;
    $subDimensionsBalloon['conventional'] *= 0;
    $subDimensionsBalloon['enterprising'] *= 0;
    $subDimensionsBalloon['investigative'] *= 0;
    $subDimensionsBalloon['realistic'] *= 0;
    $subDimensionsBalloon['social'] *= 0;
}


function scoreDimensionsBalloon($number,$amount)
{
    global $subDimensionsBalloon;

    if ($number == 69 || $number == 75)
    {
        $subDimensionsBalloon['artistic'] += $amount;
    }
    else if ($number == 72 || $number == 78)
    {
        $subDimensionsBalloon['conventional'] += $amount;
    }
    else if ($number == 71 || $number == 77)
    {
        $subDimensionsBalloon['enterprising'] += $amount;
    }
    else if ($number == 68 || $number == 74)
    {
        $subDimensionsBalloon['investigative'] += $amount;
    }
    else if ($number == 67 || $number == 73)
    {
        $subDimensionsBalloon['realistic'] += $amount;
    }
    else if ($number == 70 || $number == 76)
    {
        $subDimensionsBalloon['social'] += $amount;
    }
}

function scoreDimensions($number,$amount)
{
    global $subDimensions;
    if ($number <= 11)
    {
        //echo "artistic";
        $subDimensions['artistic'] += $amount;
        $temp = $subDimensions['artistic'];
        //echo "<p>Artistic score is $temp</p>";
    }
    else if ($number <= 22)
    {
        //echo "conventional";
        $subDimensions['conventional'] += $amount;
        $temp = $subDimensions['conventional'];
        //echo "<p>conventional score is $temp</p>";
    }
    else if ($number<=33)
    {
        //echo "enterprising";
        $subDimensions['enterprising'] += $amount;
        $temp = $subDimensions['enterprising'];
        //echo "<p>enterprising score is $temp</p>";
    }
    else if ($number <= 44)
    {
        //echo "investigative";
        $subDimensions['investigative'] += $amount;
        $temp = $subDimensions['investigative'];
        //echo "<p>investigative score is $temp</p>";
    }
    else if ($number <= 55)
    {
        //echo "realistic";
        $subDimensions['realistic'] += $amount;
        $temp = $subDimensions['realistic'];
        //echo "<p>realistic score is $temp</p>";
    }
    else if ($number <= 66)
    {
        //echo "social";
        $subDimensions['social'] += $amount;
        $temp = $subDimensions['social'];
        //echo "<p>social score is $temp</p>";
    }
}


function UploadScores($ID,$pictureCount,$raw,$avg,$balloon)
{

    $queryChunk = "'$ID',$pictureCount";

    foreach($raw as $score)
    {
        $queryChunk .= ", $score";
    }
    foreach($avg as $score)
    {
        $queryChunk .= ", $score";
    }
    foreach($balloon as $score)
    {
        $queryChunk .= ", $score";
    }
    echo $queryChunk;
    $query = "INSERT INTO CloudScoringBreakdown VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Item Query failed: ' . mysql_error());
    mysql_free_result($result);
}

echo "complete";
?>