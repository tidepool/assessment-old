<?php
require_once "../Live/dbConnect.php";
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
//$ID = "test--sn86asd9f18";

$frames5 = array();
$frames2 = array();
$factors = array();
$factors[1] = 0;
$factors[2] = 0;
$factors[3] = 0;
$factors[4] = 0;
$factors[5] = 0;
$setsSorted = array();
$setsOrdered = array();
$pairsOrdered = array();
$frames1Chng = array();
$frames2Chng = array();
$subDimensions = array();
$subDimensions['conscientiousness'] = 0;
$subDimensions['agreeableness'] = 0;
$subDimensions['extraversion'] = 0;
$subDimensions['neuroticism'] = 0;
$subDimensions['openness'] = 0;
$models = array();
$models['conscientiousness'] = 0;
$models['agreeableness'] = 0;
$models['extraversion'] = 0;
$models['neuroticism'] = 0;
$models['openness'] = 0;
$ConscientiousnessAVG  = 0;
$AgreeablenessAVG  = 0;
$ExtroversionAVG = 0;
$NeuroticismAVG = 0;
$OpennessAVG = 0;
$workType = null;
$workTypeABV = null;


//echo "<p>test 1</p>";
readInputs();
//echo "<p>test 2</p>";
scorePictureFactors();
//echo "<p>test 3</p>";
UploadItemSorted();
//echo "<p>test 4</p>";
UploadItemOrdered();
//echo "<p>test 5</p>";

GetAverages();
//echo "<p>test 6</p>";
UploadModels();
//echo "<p>test 7</p>";
GetAveragesOld();
//echo "<p>test 8</p>";
UploadScores();
//echo "<p>test 9</p>";
//printModels($ID);

function readInputs()
{
    Global $xml_array, $frames1Chng, $frames2Chng,$frames5, $frames2;
    foreach($xml_array as $values)
    {

        if($values->getName() == "sets")
        {
            //echo "\n**Sets**\n";
            foreach($values->children() as $value)
            {
                $set = array();
                $numb = $value->getName();
                $temp = substr($numb,3);
                $set[1] = $temp.$value->choice1;
                $set[2] = $temp.$value->choice2;
                $set[3] = $temp.$value->choice3;
                $set[4] = $temp.$value->choice4;
                $set[5] = $temp.$value->choice5;
                AnalyzeFivePictures($set[1],4);
                AnalyzeFivePictures($set[2],3);
                AnalyzeFivePictures($set[3],2);
                AnalyzeFivePictures($set[4],1);
                AnalyzeFivePictures($set[5],0);
                $frames5[] = $set;
            }
        }
        else if($values->getName() == "pairs")
        {
            //echo "\n**Pairs**\n";
            foreach($values->children() as $value)
            {

                $temp = $value->getName();
                $temp = substr($temp,4);
                $temp = $temp.$value;
                //echo "<p>Temp: $temp</p>";
                AnalyzePairs($temp);
                $frames2[] = $temp;
            }
        }
        else if($values->getName() == "changes")
        {
            foreach($values as $value)
            {

                if($value->getName() == "frames1")
                {
                    foreach($value->children() as $v)
                    {
                        $frames1Chng[] = $v;
                    }
                }
                if($value->getName() == "frames2")
                {
                    foreach($value->children() as $v)
                    {
                        $frames2Chng[] = $v;
                    }
                }
            }
        }
    }
}

function scorePictureFactors()
{
    Global $frames5, $frames2;

    for($i=0;$i<6;$i++)
    {
        $frame = $frames5[$i];
        //print_r($frame);
        //echo "<br>";
        for($j=1;$j<=5;$j++)
        {
            $data = getPicData("F".$frame[$j],6-$j);
            //print_r($data);
            //echo "<br>";
            scoreFactors($data);
        }
    }
    //printFactors();
    //print_r($frames2);
    //echo "<br>";
    for($i=0;$i<10;$i++)
    {
        $frame = $frames2[$i];
        $data = getPicData("P".$frame,1);
        //print_r($data);
        //echo "<br>";
        scoreFactors($data);
    }
    //printFactors();
    sendFactorsToDB();
    scoreModels();
}

function scoreModels()
{
    global $ID, $factors, $spaceIncluded;

    //echo "<h1>Trying Models</h1>";
    $query = "SELECT MoveTime, WaitTime FROM SpaceChanges WHERE ID='$ID'";
    $result = mysql_query($query) or die('Space Changes Query failed: ' . mysql_error());
    if(!$result)
    {
        $err=mysql_error();
        echo "<p>$err</p>";
    }
    else if(mysql_affected_rows()==0)
    {
        /*
        echo "<h1>No Space</h1>";
        echo "<p>Nature: ".$factors[1]."</p>";
        echo "<p>Color: ".$factors[2]."</p>";
        echo "<p>Living: ".$factors[3]."</p>";
        echo "<p>Animal: ".$factors[4]."</p>";
        echo "<p>Whole: ".$factors[5]."</p>";
        */
        scoreConscientiousnessWithoutMot($factors[1],$factors[2],$factors[3],$factors[4],$factors[5]);
        scoreAgreeablenessWithoutMot($factors[1],$factors[2],$factors[3],$factors[4],$factors[5]);
        scoreExtraversionWithoutMot($factors[1],$factors[2],$factors[3],$factors[4],$factors[5]);
        scoreNeuroticismWithoutMot($factors[1],$factors[2],$factors[3],$factors[4],$factors[5]);
        scoreOpennessWithoutMot($factors[1],$factors[2],$factors[3],$factors[4],$factors[5]);
        $spaceIncluded = false;
    }
    else
    {
        /*
        echo "<h1>Yes Space</h1>";
        echo "<p>Nature: ".$factors[0]."</p>";
        echo "<p>Color: ".$factors[1]."</p>";
        echo "<p>Living: ".$factors[2]."</p>";
        echo "<p>Animal: ".$factors[3]."</p>";
        echo "<p>Whole: ".$factors[4]."</p>";
        */
        $temp = mysql_fetch_row($result);
        $moveTime = $temp[0];
        $waitTime = $temp[1];
        $avg = $temp[1]/($temp[0]+$temp[1]);
        scoreNeuroticismWithMot($moveTime,$waitTime,$factors[1],$factors[2],$factors[3],$factors[4],$factors[5],$avg);
        scoreAgreeablenessWithMot($moveTime,$waitTime,$factors[1],$factors[2],$factors[3],$factors[4],$factors[5],$avg);
        scoreOpennessWithMot($moveTime,$waitTime,$factors[1],$factors[2],$factors[3],$factors[4],$factors[5],$avg);
        scoreExtraversionWithMot($moveTime,$waitTime,$factors[1],$factors[2],$factors[3],$factors[4],$factors[5],$avg);
        scoreConscientiousnessWithMot($moveTime,$waitTime,$factors[1],$factors[2],$factors[3],$factors[4],$factors[5],$avg);
        $spaceIncluded = true;
    }
    //echo "<h1>End Models</h1>";
}

function scoreNeuroticismWithoutMot($nature,$color,$living,$animal,$whole)
{
    global $models;

    $value = 56.05845;
    $value +=  0.55617 * $nature;
    $value +=  0.89074 * $color;
    $value += -0.65429 * $living;
    $value +=  0.14684 * $animal;
    $value +=  1.89987 * $whole;

    $models['neuroticism'] = $value;
}


function scoreAgreeablenessWithoutMot($nature,$color,$living,$animal,$whole)
{
    global $models;

    $value = 51.01523;
    $value += -0.83965 * $nature;
    $value += -0.44007 * $color;
    $value +=  0.93820 * $living;
    $value += -0.07262 * $animal;
    $value += -0.83129 * $whole;

    $models['agreeableness'] = $value;
}

function scoreOpennessWithoutMot($nature,$color,$living,$animal,$whole)
{
    global $models;

    $value = 55.15467;
    $value += -0.43837 * $nature;
    $value += -0.37269 * $color;
    $value +=  0.15278 * $living;
    $value +=  0.88520 * $animal;
    $value += -1.97384 * $whole;

    $models['openness'] = $value;
}

function scoreExtraversionWithoutMot($nature,$color,$living,$animal,$whole)
{
    global $models;

    $value = 62.64259;
    $value += -0.16908 * $nature;
    $value += -0.49773 * $color;
    $value += -0.72534 * $living;
    $value += -0.84645 * $animal;
    $value += -1.79956 * $whole;

    $models['extraversion'] = $value;
}

function scoreConscientiousnessWithoutMot($nature,$color,$living,$animal,$whole)
{
    global $models;

    $value = 49.57383;
    $value += -0.41315 * $nature;
    $value += -0.92236 * $color;
    $value +=  0.41232 * $living;
    $value +=  0.08301 * $animal;
    $value +=  0.31178 * $whole;

    $models['conscientiousness'] = $value;
}

function scoreNeuroticismWithMot($move,$wait,$nature,$color,$living,$animal,$whole,$avg)
{
    global $models;

    $value = 36.15420;
    $value += -0.00006 * $move;
    $value +=  0.00041 * $wait;
    $value +=  0.58833 * $nature;
    $value +=  1.15016 * $color;
    $value += -0.17249 * $living;
    $value +=  0.14406 * $animal;
    $value +=  2.00510 * $whole;
    $value +=  18.92026 * $avg;

    $models['neuroticism'] = $value;
}


function scoreAgreeablenessWithMot($move,$wait,$nature,$color,$living,$animal,$whole,$avg)
{
    global $models;

    $value = 56.65312;
    $value += -0.00001 * $move;
    $value += -0.00042 * $wait;
    $value += -0.62487 * $nature;
    $value += -0.03626 * $color;
    $value +=  0.84171 * $living;
    $value += -0.04243 * $animal;
    $value += -0.05838 * $whole;
    $value += -5.18300 * $avg;

    $models['agreeableness'] = $value;
}

function scoreOpennessWithMot($move,$wait,$nature,$color,$living,$animal,$whole,$avg)
{
    global $models;

    $value = 51.91378;
    $value +=  0.00001 * $move;
    $value += -0.00029 * $wait;
    $value += -0.37094 * $nature;
    $value += -0.16266 * $color;
    $value += -0.16881 * $living;
    $value +=  0.76320 * $animal;
    $value += -1.57908 * $whole;
    $value +=  7.38025 * $avg;

    $models['openness'] = $value;
}

function scoreExtraversionWithMot($move,$wait,$nature,$color,$living,$animal,$whole,$avg)
{
    global $models;

    $value = 45.85499;
    $value +=  0.00000 * $move;
    $value +=  0.00006 * $wait;
    $value += -0.14508 * $nature;
    $value += -0.55310 * $color;
    $value += -0.63660 * $living;
    $value += -0.74458 * $animal;
    $value += -1.80371 * $whole;
    $value +=  21.10620 * $avg;

    $models['extraversion'] = $value;
}

function scoreConscientiousnessWithMot($move,$wait,$nature,$color,$living,$animal,$whole,$avg)
{
    global $models;

    $value = 41.50868;
    $value +=  0.00000 * $move;
    $value += -0.00001 * $wait;
    $value += -0.37777 * $nature;
    $value += -0.91658 * $color;
    $value +=  0.41104 * $living;
    $value +=  0.24674 * $animal;
    $value +=  0.32268 * $whole;
    $value +=  10.84372 * $avg;

    $models['conscientiousness'] = $value;
}


function sendFactorsToDB()
{
    global $ID, $factors;

    $queryString = "'$ID'";
    for($i=1;$i<=5;$i++)
    {
        $queryString .= ",".$factors[$i];
    }
    $query = "INSERT INTO FramesFactorScore VALUES ($queryString);";
    $result = mysql_query($query) or die('Factors Query failed: ' . mysql_error());
    mysql_free_result($result);
}

function getPicData($id,$num)
{
    //echo "<p>Pic ID is $id</p>";
    $array = array();
    establishConnection();

    $query = "SELECT * From FramesPictures WHERE Pic_ID='$id';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        $count = 0;
        foreach ($line as $col_value)
        {
            if($count > 8)
            {
                $value = $num*$col_value;
                $array[] = $value;
            }
            $count++;
        }
    }
    mysql_free_result($result);
    return $array;
}

function scoreFactors($data)
{
    global $factors;

    //print_r($data);
    for($i=0;$i<14;$i++)
    {
        //echo "<p>Factor $i value ".$data[$i]."</p>";
        if($i == 0)
        {
            $factors[5] += $data[$i];
        }
        else if($i == 1)
        {
            $factors[5] += reverseScore($data[$i]);
        }
        else if($i == 2)
        {
            $factors[4] += $data[$i];
        }
        else if($i == 3)
        {
            $factors[3] += $data[$i];
        }
        else if($i == 4)
        {
            $factors[2] += $data[$i];
        }
        else if($i == 5)
        {
            $factors[2] += reverseScore($data[$i]);
        }
        else if($i == 6)
        {
            //echo "<p>Normal 1: ".$data[$i]."</p>";
            $factors[1] += $data[$i];
        }
        else if($i == 7)
        {
            $factors[3] += reverseScore($data[$i]);
        }
        else if($i == 8)
        {
            //echo "<p>Reverse 1: ".reverseScore($data[$i])."</p>";
            $factors[1] += reverseScore($data[$i]);
        }
        else if($i == 9)
        {
            $factors[4] += $data[$i];
        }
        else if($i == 10)
        {
            $factors[4] += $data[$i];
            $factors[3] += reverseScore($data[$i]);
        }
        else if($i == 11)
        {
            $factors[5] += reverseScore($data[$i]);
        }
        else if($i == 12)
        {
            //echo "<p>Normal 1: ".$data[$i]."</p>";
            $factors[1] += $data[$i];
        }
        else if($i == 13)
        {
            //echo "<p>Reverse 1: ".reverseScore($data[$i])."</p>";
            $factors[1] += reverseScore($data[$i]);
        }
    }
}
function reverseScore($num)
{
    if($num == 5)
    {
        return 1;
    }
    else if($num == 4)
    {
        return 2;
    }
    else if($num == 3)
    {
        return 3;
    }
    else if($num == 2)
    {
        return 4;
    }
    else if($num == 1)
    {
        return 5;
    }
}

function CalculateType($array)
{
    Global $ConscientiousnessAVG, $AgreeablenessAVG, $ExtroversionAVG, $NeuroticismAVG, $OpennessAVG;
    Global $workType, $workTypeABV;

    $high = 0;
    $type = null;
    $temp = $array['conscientiousness'] - $ConscientiousnessAVG;
    if(abs($temp) >= $high)
    {
        $high = abs($temp);
        if($temp > 0)
        {
            $type = "High Conscientiousness";
            $typeABV = "HC";
        }
        else
        {
            $type = "Low Conscientiousness";
            $typeABV = "LC";
        }
    }
    $temp = $array['agreeableness'] - $AgreeablenessAVG;
    if(abs($temp) > $high)
    {
        $high = abs($temp);
        if($temp > 0)
        {
            $type = "High Agreeableness";
            $typeABV = "HA";
        }
        else
        {
            $type = "Low Agreeableness";
            $typeABV = "LA";
        }
    }
    $temp = $array['extraversion'] - $ExtroversionAVG;
    if(abs($temp) > $high)
    {
        $high = abs($temp);
        if($temp > 0)
        {
            $type = "High Extroversion";
            $typeABV = "HE";
        }
        else
        {
            $type = "Low Extroversion";
            $typeABV = "LE";
        }
    }
    $temp = $array['neuroticism'] - $NeuroticismAVG;
    if(abs($temp) > $high)
    {
        $high = abs($temp);
        if($temp > 0)
        {
            $type = "High Neuroticism";
            $typeABV = "HN";
        }
        else
        {
            $type = "Low Neuroticism";
            $typeABV = "LN";
        }
    }
    $temp = $array['openness'] - $OpennessAVG;
    if(abs($temp) > $high)
    {
        $high = abs($temp);
        if($temp > 0)
        {
            $type = "High Openness";
            $typeABV = "HO";
        }
        else
        {
            $type = "Low Openness";
            $typeABV = "LO";
        }
    }

    $workTypeABV = $typeABV;
    $workType = $type;
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


function GetAverages()
{
    //START get mean score
    Global $ConscientiousnessAVG, $AgreeablenessAVG, $ExtroversionAVG, $NeuroticismAVG, $OpennessAVG, $spaceIncluded, $ID;

    $date1 = $_COOKIE['date'];
    $date2 = date(DATE_RFC822);
    $diff = strtotime($date2) - strtotime($date1);
    $date = formatDate($diff);

    $query = "Select * FROM Timing WHERE ID='$ID';";
    $result = mysql_query($query) or die('Timing Search Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    $exists = $temp[0];
    mysql_free_result($result);
    if(strlen($exists) < 1)
    {
        $query = "INSERT INTO Timing VALUES ('$ID', '', '', '', '', '', '', '', '', '', '', '', '$date', '', '', '', '', '','','','');";
    }
    else
    {
        $query = "UPDATE Timing SET Frames='$date' where ID='$ID';";
    }
    $result = mysql_query($query) or die('Timing Query failed: ' . mysql_error());
    mysql_free_result($result);

    if($spaceIncluded)
    {
        $table = "FramesModelScoreWithSpace";
    }
    else
    {
        $table = "FramesModelScoreWithoutSpace";
    }

    $query = 'SELECT AVG(Conscientiousness), AVG(Agreeableness), AVG(Extraversion), AVG(Neuroticism), AVG(Openness) FROM '.$table.';';
    $result = mysql_query($query) or die('Average Model Query failed: ' . mysql_error());
    $AVGS = mysql_fetch_row($result);
    $ConscientiousnessAVG = $AVGS[0];
    $AgreeablenessAVG = $AVGS[1];
    $ExtroversionAVG = $AVGS[2];
    $NeuroticismAVG = $AVGS[3];
    $OpennessAVG = $AVGS[4];
    mysql_free_result($result);
    //END get mean score

    Global $models;
    CalculateType($models);
}

function GetAveragesOld()
{
    //START get mean score
    Global $ConscientiousnessAVG, $AgreeablenessAVG, $ExtroversionAVG, $NeuroticismAVG, $OpennessAVG, $link, $ID;

    $query = 'SELECT AVG(Conscientiousness), AVG(Agreeableness), AVG(Extraversion), AVG(Neuroticism), AVG(Openness) FROM FramesScoring' ;
    $result = mysql_query($query) or die('Average SCore Query failed: ' . mysql_error());
    $AVGS = mysql_fetch_row($result);
    $ConscientiousnessAVG = $AVGS[0];
    $AgreeablenessAVG = $AVGS[1];
    $ExtroversionAVG = $AVGS[2];
    $NeuroticismAVG = $AVGS[3];
    $OpennessAVG = $AVGS[4];
    //echo $ConscientiousnessAVG.",";
    //echo $AgreeablenessAVG.",";
    //echo $ExtroversionAVG.",";
    //echo $NeuroticismAVG.",";
    //echo $OpennessAVG.",";
    mysql_free_result($result);
    //END get mean score

    Global $subDimensions;
    CalculateType($subDimensions);
}

function UploadItemSorted()
{
    Global $pairsOrdered, $setsSorted, $ID, $link;

    $queryChunk = "'$ID'";


    for($i=0;$i<7;$i++)
    {
        $queryChunk .= ",".$setsSorted[$i]['A'];
        $queryChunk .= ",".$setsSorted[$i]['C'];
        $queryChunk .= ",".$setsSorted[$i]['E'];
        $queryChunk .= ",".$setsSorted[$i]['N'];
        $queryChunk .= ",".$setsSorted[$i]['O'];
    }

    for($i=0;$i<16;$i++)
    {
        for($j=0;$j<2;$j++)
        {
            if($pairsOrdered[$i][$j] == 1)
            {
                $queryChunk .= ", 1";
            }
            else
            {
                $queryChunk .= ", 0";
            }
        }

    }
    //echo "<p>ISO: $queryChunk</p>";
    $query = "INSERT INTO FramesItemSortedHarris VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Item Ordered Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    //END upload user score
}

function UploadItemOrdered()
{
    Global $pairsOrdered, $setsOrdered, $ID, $link;

    $queryChunk = "'$ID'";


    for($i=1;$i<=7;$i++)
    {
        $queryChunk .= ",".$setsOrdered[$i][1];
        $queryChunk .= ",".$setsOrdered[$i][2];
        $queryChunk .= ",".$setsOrdered[$i][3];
        $queryChunk .= ",".$setsOrdered[$i][4];
        $queryChunk .= ",".$setsOrdered[$i][5];
    }

    for($i=0;$i<16;$i++)
    {
        for($j=0;$j<2;$j++)
        {
            if($pairsOrdered[$i][$j] == 1)
            {
                $queryChunk .= ", 1";
            }
            else
            {
                $queryChunk .= ", 0";
            }
        }

    }
    //echo "<p>ISO: $queryChunk</p>";
    $query = "INSERT INTO FramesItemOrderedHarris VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Item Sorted Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    //END upload user score
}


function UploadModels()
{
    Global $models, $spaceIncluded, $workTypeABV, $ID;

    if($spaceIncluded)
    {
        $table = "FramesModelScoreWithSpace";
    }
    else
    {
        $table = "FramesModelScoreWithoutSpace";
    }

    $queryChunk = "'$ID', ".$models['neuroticism'].", ".$models['agreeableness'].", ".$models['openness'].", ".$models['extraversion'].", ".$models['conscientiousness'].", '$workTypeABV'";
    //echo "<p>Models: $queryChunk</p>";
    $query = "INSERT INTO ".$table." VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Model Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
}


function UploadScores()
{
    Global $subDimensions;
    Global $workTypeABV, $ID;

    $queryChunk = "'$ID', ".$subDimensions['conscientiousness'].", ".$subDimensions['agreeableness'].", ".$subDimensions['extraversion'].", ".$subDimensions['neuroticism'].", ".$subDimensions['openness'].", '$workTypeABV'";
    //echo "<p>Scores: $queryChunk</p>";
    $query = "INSERT INTO FramesScoring VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Scores Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    UploadChanges();
}


function UploadChanges()
{
    Global $frames1Chng, $frames2Chng, $ID, $link;

    $queryChunk = "'$ID'";
    foreach($frames1Chng as $change)
    {
        $queryChunk .= ",'$change'";
    }
    foreach($frames2Chng as $change)
    {
        $queryChunk .= ",'$change'";
    }
    //echo "<p>Changes: $queryChunk</p>";
    $query = "INSERT INTO FramesChangesHarris VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Changes Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);

    $query = "UPDATE SocialMediaUsers SET Stage=1 WHERE ID='$ID';";
    $result = mysql_query($query) or die('Social Media Users Query failed: ' . mysql_error());
    mysql_free_result($result);
    endConnection();
}

function AnalyzePairs($s)
{
    global $subDimensions;
    global $pairsOrdered;

    $increment = 1;

    if($s=="1a")
    {
        $subDimensions['agreeableness']+=$increment;
        $pairsOrdered[0][0] = 1;
    }
    elseif($s=="1b")
    {
        $subDimensions['agreeableness']-=$increment;
        $pairsOrdered[0][1] = 1;
    }
    elseif($s=="2a")
    {
        $subDimensions['conscientiousness']+=$increment;
        $pairsOrdered[1][0] = 1;
    }
    elseif($s=="2b")
    {
        $subDimensions['conscientiousness']-=$increment;
        $pairsOrdered[1][1] = 1;
    }
    elseif($s=="3a")
    {
        $subDimensions['extraversion']+=$increment;
        $pairsOrdered[2][0] = 1;
    }
    elseif($s=="3b")
    {
        $subDimensions['extraversion']-=$increment;
        $pairsOrdered[2][1] = 1;
    }
    elseif($s=="4a")
    {
        $subDimensions['neuroticism']+=$increment;
        $pairsOrdered[3][0] = 1;
    }
    elseif($s=="4b")
    {
        $subDimensions['neuroticism']-=$increment;
        $pairsOrdered[3][1] = 1;
    }
    elseif($s=="5a")
    {
        $subDimensions['openness']+=$increment;
        $pairsOrdered[4][0] = 1;
    }
    elseif($s=="5b")
    {
        $subDimensions['openness']-=$increment;
        $pairsOrdered[4][1] = 1;
    }
    elseif($s=="6a")
    {
        $subDimensions['extraversion']+=$increment;
        $pairsOrdered[5][0] = 1;
    }
    elseif($s=="6b")
    {
        $subDimensions['extraversion']-=$increment;
        $pairsOrdered[5][1] = 1;
    }
    elseif($s=="7a")
    {
        $subDimensions['neuroticism']+=$increment;
        $pairsOrdered[6][0] = 1;
    }
    elseif($s=="7b")
    {
        $subDimensions['neuroticism']-=$increment;
        $pairsOrdered[6][1] = 1;
    }
    elseif($s=="8a")
    {
        $subDimensions['openness']+=$increment;
        $pairsOrdered[7][0] = 1;
    }
    elseif($s=="8b")
    {
        $subDimensions['openness']-=$increment;
        $pairsOrdered[7][1] = 1;
    }
    elseif($s=="9a")
    {
        $subDimensions['conscientiousness']+=$increment;
        $pairsOrdered[8][0] = 1;
    }
    elseif($s=="9b")
    {
        $subDimensions['conscientiousness']-=$increment;
        $pairsOrdered[8][1] = 1;
    }
    elseif($s=="10a")
    {
        $subDimensions['conscientiousness']+=$increment;
        $pairsOrdered[9][0] = 1;
    }
    elseif($s=="10b")
    {
        $subDimensions['conscientiousness']-=$increment;
        $pairsOrdered[9][1] = 1;
    }
    elseif($s=="11a")
    {
        $pairsOrdered[10][0] = 1;
    }
    elseif($s=="11b")
    {
        $pairsOrdered[10][1] = 1;
    }
    elseif($s=="12a")
    {
        $pairsOrdered[11][0] = 1;
    }
    elseif($s=="12b")
    {
        $pairsOrdered[11][1] = 1;
    }
    elseif($s=="13a")
    {
        $pairsOrdered[12][0] = 1;
    }
    elseif($s=="13b")
    {
        $pairsOrdered[12][1] = 1;
    }
    elseif($s=="14a")
    {
        $pairsOrdered[13][0] = 1;
    }
    elseif($s=="14b")
    {
        $pairsOrdered[13][1] = 1;
    }
    else
    {
        //echo "--Pair not found";
    }

}
function AnalyzeFivePictures($s, $increment)
{
    global $subDimensions;
    global $setsSorted, $setsOrdered;

    if($s=="1a")
    {
        $subDimensions['agreeableness']+=$increment;
        $setsSorted[0]['A'] = $increment;
        $setsOrdered[1][1] = $increment;
    }
    elseif($s=="1b")
    {
        $subDimensions['conscientiousness']+=$increment;
        $setsSorted[0]['C'] = $increment;
        $setsOrdered[1][2] = $increment;
    }
    elseif($s=="1c")
    {
        $subDimensions['extraversion']+=$increment;
        $setsSorted[0]['E'] = $increment;
        $setsOrdered[1][3] = $increment;
    }
    elseif($s=="1d")
    {
        $subDimensions['neuroticism']+=$increment;
        $setsSorted[0]['N'] = $increment;
        $setsOrdered[1][4] = $increment;
    }
    elseif($s=="1e")
    {
        $subDimensions['openness']+=$increment;
        $setsSorted[0]['O'] = $increment;
        $setsOrdered[1][5] = $increment;
    }
    elseif($s=="2a")
    {
        $subDimensions['agreeableness']-=$increment;
        $setsSorted[1]['A'] = -$increment;
        $setsOrdered[2][1] = $increment;
    }
    elseif($s=="2b")
    {
        $subDimensions['conscientiousness']-=$increment;
        $setsSorted[1]['C'] = -$increment;
        $setsOrdered[2][2] = $increment;
    }
    elseif($s=="2c")
    {
        $subDimensions['extraversion']-=$increment;
        $setsSorted[1]['E'] = -$increment;
        $setsOrdered[2][3] = $increment;
    }
    elseif($s=="2d")
    {
        $subDimensions['neuroticism']-=$increment;
        $setsSorted[1]['N'] = -$increment;
        $setsOrdered[2][4] = $increment;
    }
    elseif($s=="2e")
    {
        $subDimensions['openness']-=$increment;
        $setsSorted[1]['O'] = -$increment;
        $setsOrdered[2][5] = $increment;
    }
    elseif($s=="3a")
    {
        $subDimensions['openness']+=$increment;
        $setsSorted[2]['O'] = $increment;
        $setsOrdered[3][1] = $increment;
    }
    elseif($s=="3b")
    {
        $subDimensions['neuroticism']-=$increment;
        $setsSorted[2]['N'] = -$increment;
        $setsOrdered[3][2] = $increment;
    }
    elseif($s=="3c")
    {
        $subDimensions['extraversion']+=$increment;
        $setsSorted[2]['E'] = $increment;
        $setsOrdered[3][3] = $increment;
    }
    elseif($s=="3d")
    {
        $subDimensions['conscientiousness']+=$increment;
        $setsSorted[2]['C'] = $increment;
        $setsOrdered[3][4] = $increment;
    }
    elseif($s=="3e")
    {
        $subDimensions['agreeableness']+=$increment;
        $setsSorted[2]['A'] = $increment;
        $setsOrdered[3][5] = $increment;
    }
    elseif($s=="4a")
    {
        $subDimensions['agreeableness']-=$increment;
        $setsSorted[3]['A'] = -$increment;
        $setsOrdered[4][1] = $increment;
    }
    elseif($s=="4b")
    {
        $subDimensions['extraversion']-=$increment;
        $setsSorted[3]['E'] = -$increment;
        $setsOrdered[4][2] = $increment;
    }
    elseif($s=="4c")
    {
        $subDimensions['conscientiousness']-=$increment;
        $setsSorted[3]['C'] = -$increment;
        $setsOrdered[4][3] = $increment;
    }
    elseif($s=="4d")
    {
        $subDimensions['neuroticism']+=$increment;
        $setsSorted[3]['N'] = $increment;
        $setsOrdered[4][4] = $increment;
    }
    elseif($s=="4e")
    {
        $subDimensions['openness']-=$increment;
        $setsSorted[3]['O'] = -$increment;
        $setsOrdered[4][5] = $increment;
    }
    elseif($s=="5a")
    {
        $subDimensions['openness']+=$increment;
        $setsSorted[4]['O'] = $increment;
        $setsOrdered[5][1] = $increment;
    }
    elseif($s=="5b")//hat
    {
        $subDimensions['neuroticism']+=$increment;
        $setsSorted[4]['N'] = $increment;
        $setsOrdered[5][2] = $increment;
    }
    elseif($s=="5c")//beach
    {
        $subDimensions['extraversion']+=$increment;
        $setsSorted[4]['E'] = $increment;
        $setsOrdered[5][3] = $increment;
    }
    elseif($s=="5d")
    {
        $subDimensions['conscientiousness']+=$increment;
        $setsSorted[4]['C'] = $increment;
        $setsOrdered[5][4] = $increment;
    }
    elseif($s=="5e")
    {
        $subDimensions['agreeableness']+=$increment;
        $setsSorted[4]['A'] = $increment;
        $setsOrdered[5][5] = $increment;
    }
    elseif($s=="6a")
    {
        $subDimensions['agreeableness']+=$increment;
        $setsSorted[5]['A'] = $increment;
        $setsOrdered[6][1] = $increment;
    }
    elseif($s=="6b")
    {
        $subDimensions['extraversion']+=$increment;
        $setsSorted[5]['E'] = $increment;
        $setsOrdered[6][2] = $increment;
    }
    elseif($s=="6c")
    {
        $subDimensions['neuroticism']+=$increment;
        $setsSorted[5]['N'] = $increment;
        $setsOrdered[6][3] = $increment;
    }
    elseif($s=="6d")
    {
        $subDimensions['openness']+=$increment;
        $setsSorted[5]['O'] = $increment;
        $setsOrdered[6][4] = $increment;
    }
    elseif($s=="6e")
    {
        $subDimensions['conscientiousness']+=$increment;
        $setsSorted[5]['C'] = $increment;
        $setsOrdered[6][5] = $increment;
    }
    elseif($s=="7a")
    {
        $setsSorted[6]['A'] = $increment;
        $setsOrdered[7][1] = $increment;
    }
    elseif($s=="7b")
    {
        $setsSorted[6]['E'] = $increment;
        $setsOrdered[7][2] = $increment;
    }
    elseif($s=="7c")
    {
        $setsSorted[6]['N'] = $increment;
        $setsOrdered[7][3] = $increment;
    }
    elseif($s=="7d")
    {
        $setsSorted[6]['O'] = $increment;
        $setsOrdered[7][4] = $increment;
    }
    elseif($s=="7e")
    {
        $setsSorted[6]['C'] = $increment;
        $setsOrdered[7][5] = $increment;
    }
    else
    {
        //echo "--Pair not found";
    }
}

function printFactors()
{
    global $factors;
    echo "<p>Factor 1 ".$factors[1]."</p>";
    echo "<p>Factor 2 ".$factors[2]."</p>";
    echo "<p>Factor 3 ".$factors[3]."</p>";
    echo "<p>Factor 4 ".$factors[4]."</p>";
    echo "<p>Factor 5 ".$factors[5]."</p>";
}
function printModels()
{
    global $models;
    echo "<p>Neuroticism: ".$models['neuroticism']."</p>";
    echo "<p>Agreeableness: ".$models['agreeableness']."</p>";
    echo "<p>Openness: ".$models['openness']."</p>";
    echo "<p>Extraversion: ".$models['extraversion']."</p>";
    echo "<p>Conscientiousness: ".$models['conscientiousness']."</p>";
}
echo "complete";
?>