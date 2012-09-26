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
//$ID = "rhettf186d16";

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
$Conscientiousness = 0;
$Agreeableness = 0;
$Extroversion = 0;
$Neuroticism = 0;
$Openness = 0;
$ConscientiousnessAVG  = 0;
$AgreeablenessAVG  = 0;
$ExtroversionAVG = 0;
$NeuroticismAVG = 0;
$OpennessAVG = 0;
$workType = null;
$workTypeABV = null;


readInputs();
scorePictureFactors();
/*
echo "<p>Factor 1 ".$factors[1]."</p>";
echo "<p>Factor 2 ".$factors[2]."</p>";
echo "<p>Factor 3 ".$factors[3]."</p>";
echo "<p>Factor 4 ".$factors[4]."</p>";
echo "<p>Factor 5 ".$factors[5]."</p>";
*/
GetAverages();
UploadScores();

CalculateType();
UploadItemSorted();
UploadItemOrdered();
UploadScores();

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
                $picture = intval($temp) + 6;
                $temp = intval($temp);
                $temp = $temp.$value;
                //echo "<p>Temp: $temp</p>";
                AnalyzePairs($temp);
                $frames2[] = $picture.$value;
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

    foreach($frames5 as $frame)
    {
        //print_r($frame);
        //echo "<br>";
        for($i=1;$i<=5;$i++)
        {
            $data = getPicData($frame[$i],6-$i);
            //print_r($data);
            //echo "<br>";
            scoreFactors($data);
        }
    }
    //print_r($frames2);
    //echo "<br>";
    foreach($frames2 as $frame)
    {
        $data = getPicData($frame,1);
        //print_r($data);
        //echo "<br>";
        scoreFactors($data);
    }
    sendFactorsToDB();
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
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
}

function getPicData($id,$num)
{
    $array = array();

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
        or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = "SELECT * From FramesPictures WHERE Pic_ID='$id';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        $count = 0;
        foreach ($line as $col_value)
        {
            if($count != 0)
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

function CalculateType()
{
    Global $Conscientiousness, $Agreeableness, $Extroversion, $Neuroticism, $Openness;
    Global $ConscientiousnessAVG, $AgreeablenessAVG, $ExtroversionAVG, $NeuroticismAVG, $OpennessAVG;
    Global $workType, $workTypeABV;

    $high = 0;
    $type = null;
    $temp = $Conscientiousness - $ConscientiousnessAVG;
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
    $temp = $Agreeableness - $AgreeablenessAVG;
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
    $temp = $Extroversion - $ExtroversionAVG;
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
    $temp = $Neuroticism - $NeuroticismAVG;
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
    $temp = $Openness - $OpennessAVG;
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
    Global $ConscientiousnessAVG, $AgreeablenessAVG, $ExtroversionAVG, $NeuroticismAVG, $OpennessAVG, $link, $ID;

    $date1 = $_COOKIE['date'];
    $date2 = date(DATE_RFC822);
    $diff = strtotime($date2) - strtotime($date1);
    $date = formatDate($diff);

    $query = "Select * FROM Timing WHERE ID='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
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

    $query = 'SELECT AVG(Conscientiousness), AVG(Agreeableness), AVG(Extroversion), AVG(Neuroticism), AVG(Openness) FROM FramesScoring' ;
    $result = mysql_query($query) or die('Average Query failed: ' . mysql_error());
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
}

function UploadItemSorted()
{
    Global $pairsOrdered, $setsSorted, $ID, $link;

    $queryChunk = "'$ID'";


    for($i=0;$i<6;$i++)
    {
        $queryChunk .= ",".$setsSorted[$i]['A'];
        $queryChunk .= ",".$setsSorted[$i]['C'];
        $queryChunk .= ",".$setsSorted[$i]['E'];
        $queryChunk .= ",".$setsSorted[$i]['N'];
        $queryChunk .= ",".$setsSorted[$i]['O'];
    }

    for($i=0;$i<10;$i++)
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
    $query = "INSERT INTO FramesItemSorted VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Item Ordered Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    //END upload user score
}

function UploadItemOrdered()
{
    Global $pairsOrdered, $setsOrdered, $ID, $link;

    $queryChunk = "'$ID'";


    for($i=1;$i<=6;$i++)
    {
        $queryChunk .= ",".$setsOrdered[$i][1];
        $queryChunk .= ",".$setsOrdered[$i][2];
        $queryChunk .= ",".$setsOrdered[$i][3];
        $queryChunk .= ",".$setsOrdered[$i][4];
        $queryChunk .= ",".$setsOrdered[$i][5];
    }

    for($i=0;$i<10;$i++)
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
    $query = "INSERT INTO FramesItemOrdered VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Item Sorted Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    //END upload user score
}

function UploadScores()
{
    Global $Conscientiousness, $Agreeableness, $Extroversion, $Neuroticism, $Openness, $link;
    Global $workType, $workTypeABV, $ID;

    $queryChunk = "'$ID', $Conscientiousness, $Agreeableness, $Extroversion, $Neuroticism, $Openness, '$workTypeABV'";
    //echo "<p>Scores: $queryChunk</p>";
    $query = "INSERT INTO FramesScoring VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
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
    //echo "<p>Scores: $queryChunk</p>";
    $query = "INSERT INTO FramesChanges VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);

    $query = "UPDATE SocialMediaUsers SET Stage=1 WHERE ID='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);
}

function AnalyzePairs($s)
{
    global $Conscientiousness, $Agreeableness, $Extroversion, $Neuroticism, $Openness;
    global $pairsOrdered;

    $increment = 1;

    if($s=="1a")
    {
        $Agreeableness+=$increment;
        $pairsOrdered[0][0] = 1;
    }
    elseif($s=="1b")
    {
        $Agreeableness-=$increment;
        $pairsOrdered[0][1] = 1;
    }
    elseif($s=="2a")
    {
        $Conscientiousness+=$increment;
        $pairsOrdered[1][0] = 1;
    }
    elseif($s=="2b")
    {
        $Conscientiousness-=$increment;
        $pairsOrdered[1][1] = 1;
    }
    elseif($s=="3a")
    {
        $Extroversion+=$increment;
        $pairsOrdered[2][0] = 1;
    }
    elseif($s=="3b")
    {
        $Extroversion-=$increment;
        $pairsOrdered[2][1] = 1;
    }
    elseif($s=="4a")
    {
        $Neuroticism+=$increment;
        $pairsOrdered[3][0] = 1;
    }
    elseif($s=="4b")
    {
        $Neuroticism-=$increment;
        $pairsOrdered[3][1] = 1;
    }
    elseif($s=="5a")
    {
        $Openness+=$increment;
        $pairsOrdered[4][0] = 1;
    }
    elseif($s=="5b")
    {
        $Openness-=$increment;
        $pairsOrdered[4][1] = 1;
    }
    elseif($s=="6a")
    {
        $Extroversion+=$increment;
        $pairsOrdered[5][0] = 1;
    }
    elseif($s=="6b")
    {
        $Extroversion-=$increment;
        $pairsOrdered[5][1] = 1;
    }
    elseif($s=="7a")
    {
        $Neuroticism+=$increment;
        $pairsOrdered[6][0] = 1;
    }
    elseif($s=="7b")
    {
        $Neuroticism-=$increment;
        $pairsOrdered[6][1] = 1;
    }
    elseif($s=="8a")
    {
        $Openness+=$increment;
        $pairsOrdered[7][0] = 1;
    }
    elseif($s=="8b")
    {
        $Openness-=$increment;
        $pairsOrdered[7][1] = 1;
    }
    elseif($s=="9a")
    {
        $Conscientiousness+=$increment;
        $pairsOrdered[8][0] = 1;
    }
    elseif($s=="9b")
    {
        $Conscientiousness-=$increment;
        $pairsOrdered[8][1] = 1;
    }
    elseif($s=="10a")
    {
        $Conscientiousness+=$increment;
        $pairsOrdered[9][0] = 1;
    }
    elseif($s=="10b")
    {
        $Conscientiousness-=$increment;
        $pairsOrdered[9][1] = 1;
    }
    else
    {
        //echo "--Pair not found";
    }

}
function AnalyzeFivePictures($s, $increment)
{
    global $Conscientiousness, $Agreeableness, $Extroversion, $Neuroticism, $Openness;
    global $setsSorted, $setsOrdered;

    if($s=="1a")
    {
        $Agreeableness+=$increment;
        $setsSorted[0]['A'] = $increment;
        $setsOrdered[1][1] = $increment;
    }
    elseif($s=="1b")
    {
        $Conscientiousness+=$increment;
        $setsSorted[0]['C'] = $increment;
        $setsOrdered[1][2] = $increment;
    }
    elseif($s=="1c")
    {
        $Extroversion+=$increment;
        $setsSorted[0]['E'] = $increment;
        $setsOrdered[1][3] = $increment;
    }
    elseif($s=="1d")
    {
        $Neuroticism+=$increment;
        $setsSorted[0]['N'] = $increment;
        $setsOrdered[1][4] = $increment;
    }
    elseif($s=="1e")
    {
        $Openness+=$increment;
        $setsSorted[0]['O'] = $increment;
        $setsOrdered[1][5] = $increment;
    }
    elseif($s=="2a")
    {
        $Agreeableness-=$increment;
        $setsSorted[1]['A'] = -$increment;
        $setsOrdered[2][1] = $increment;
    }
    elseif($s=="2b")
    {
        $Conscientiousness-=$increment;
        $setsSorted[1]['C'] = -$increment;
        $setsOrdered[2][2] = $increment;
    }
    elseif($s=="2c")
    {
        $Extroversion-=$increment;
        $setsSorted[1]['E'] = -$increment;
        $setsOrdered[2][3] = $increment;
    }
    elseif($s=="2d")
    {
        $Neuroticism-=$increment;
        $setsSorted[1]['N'] = -$increment;
        $setsOrdered[2][4] = $increment;
    }
    elseif($s=="2e")
    {
        $Openness-=$increment;
        $setsSorted[1]['O'] = -$increment;
        $setsOrdered[2][5] = $increment;
    }
    elseif($s=="3a")
    {
        $Openness+=$increment;
        $setsSorted[2]['O'] = $increment;
        $setsOrdered[3][1] = $increment;
    }
    elseif($s=="3b")
    {
        $Neuroticism-=$increment;
        $setsSorted[2]['N'] = -$increment;
        $setsOrdered[3][2] = $increment;
    }
    elseif($s=="3c")
    {
        $Extroversion+=$increment;
        $setsSorted[2]['E'] = $increment;
        $setsOrdered[3][3] = $increment;
    }
    elseif($s=="3d")
    {
        $Conscientiousness+=$increment;
        $setsSorted[2]['C'] = $increment;
        $setsOrdered[3][4] = $increment;
    }
    elseif($s=="3e")
    {
        $Agreeableness+=$increment;
        $setsSorted[2]['A'] = $increment;
        $setsOrdered[3][5] = $increment;
    }
    elseif($s=="4a")
    {
        $Agreeableness-=$increment;
        $setsSorted[3]['A'] = -$increment;
        $setsOrdered[4][1] = $increment;
    }
    elseif($s=="4b")
    {
        $Extroversion-=$increment;
        $setsSorted[3]['E'] = -$increment;
        $setsOrdered[4][2] = $increment;
    }
    elseif($s=="4c")
    {
        $Conscientiousness-=$increment;
        $setsSorted[3]['C'] = -$increment;
        $setsOrdered[4][3] = $increment;
    }
    elseif($s=="4d")
    {
        $Neuroticism+=$increment;
        $setsSorted[3]['N'] = $increment;
        $setsOrdered[4][4] = $increment;
    }
    elseif($s=="4e")
    {
        $Openness-=$increment;
        $setsSorted[3]['O'] = -$increment;
        $setsOrdered[4][5] = $increment;
    }
    elseif($s=="5a")
    {
        $Openness+=$increment;
        $setsSorted[4]['O'] = $increment;
        $setsOrdered[5][1] = $increment;
    }
    elseif($s=="5b")//hat
    {
        $Neuroticism+=$increment;
        $setsSorted[4]['N'] = $increment;
        $setsOrdered[5][2] = $increment;
    }
    elseif($s=="5c")//beach
    {
        $Extroversion+=$increment;
        $setsSorted[4]['E'] = $increment;
        $setsOrdered[5][3] = $increment;
    }
    elseif($s=="5d")
    {
        $Conscientiousness+=$increment;
        $setsSorted[4]['C'] = $increment;
        $setsOrdered[5][4] = $increment;
    }
    elseif($s=="5e")
    {
        $Agreeableness+=$increment;
        $setsSorted[4]['A'] = $increment;
        $setsOrdered[5][5] = $increment;
    }
    elseif($s=="6a")
    {
        $Agreeableness+=$increment;
        $setsSorted[5]['A'] = $increment;
        $setsOrdered[6][1] = $increment;
    }
    elseif($s=="6b")
    {
        $Extroversion+=$increment;
        $setsSorted[5]['E'] = $increment;
        $setsOrdered[6][2] = $increment;
    }
    elseif($s=="6c")
    {
        $Neuroticism+=$increment;
        $setsSorted[5]['N'] = $increment;
        $setsOrdered[6][3] = $increment;
    }
    elseif($s=="6d")
    {
        $Openness+=$increment;
        $setsSorted[5]['O'] = $increment;
        $setsOrdered[6][4] = $increment;
    }
    elseif($s=="6e")
    {
        $Conscientiousness+=$increment;
        $setsSorted[5]['C'] = $increment;
        $setsOrdered[6][5] = $increment;
    }
    else
    {
        //echo "--Pair not found";
    }
}

echo "complete";
?>