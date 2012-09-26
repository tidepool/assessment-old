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
//$ID = 7599573;
$link;

$sets = array();
$pairs = array();
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
GetAverages();
CalculateType();
UploadISO();
UploadScores();

function readInputs()
{
    Global $xml_array;
    foreach($xml_array as $values)
    {

        if($values->getName() == "sets")
        {
            //echo "\n**Sets**\n";
            foreach($values->children() as $value)
            {
                $set = array();
                $set['number'] = $value->getName();
                $temp = substr($set['number'],3);
                $set['choice1'] = $temp.$value->choice1;
                $set['choice2'] = $temp.$value->choice2;
                $set['choice3'] = $temp.$value->choice3;
                $set['choice4'] = $temp.$value->choice4;
                $set['choice5'] = $temp.$value->choice5;
                AnalyzeFivePictures($set['choice1'],4);
                AnalyzeFivePictures($set['choice2'],3);
                AnalyzeFivePictures($set['choice3'],2);
                AnalyzeFivePictures($set['choice4'],1);
                AnalyzeFivePictures($set['choice5'],0);
            }
        }
        if($values->getName() == "pairs")
        {
            //echo "\n**Pairs**\n";
            foreach($values->children() as $value)
            {

                $temp = $value->getName();
                $temp = substr($temp,4);
                $temp = $temp.$value;
                AnalyzePairs($temp);
            }
        }
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
function GetAverages()
{
    //START get mean score
    Global $ConscientiousnessAVG, $AgreeablenessAVG, $ExtroversionAVG, $NeuroticismAVG, $OpennessAVG, $link;

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = 'SELECT AVG(Conscientiousness), AVG(Agreeableness), AVG(Extroversion), AVG(Neuroticism), AVG(Openness) FROM PersonalityScoring' ;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
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
function UploadISO()
{
    Global $pairs, $sets, $ID, $link;

    $queryChunk = "'$ID'";

    for($i=0;$i<6;$i++)
    {
        for($j=0;$j<5;$j++)
        {
            $temp = $sets[$i][$j];
            $queryChunk .= ", $temp";
        }
    }

    for($i=0;$i<10;$i++)
    {
        for($j=0;$j<2;$j++)
        {
            if($pairs[$i][$j] == 1)
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
    $query = "INSERT INTO PersonalityISO VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
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
    $query = "INSERT INTO PersonalityScoring VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    mysql_close($link);
}
function AnalyzePairs($s)
{
    global $Conscientiousness, $Agreeableness, $Extroversion, $Neuroticism, $Openness;
    global $pairs;

    $increment = 1;

    if($s=="1a")
    {
        $Agreeableness+=$increment;
        $pairs[0][0] = 1;
    }
    elseif($s=="1b")
    {
        $Agreeableness-=$increment;
        $pairs[0][1] = 1;
    }
    elseif($s=="2a")
    {
        $Conscientiousness+=$increment;
        $pairs[1][0] = 1;
    }
    elseif($s=="2b")
    {
        $Conscientiousness-=$increment;
        $pairs[1][1] = 1;
    }
    elseif($s=="3a")
    {
        $Extroversion+=$increment;
        $pairs[2][0] = 1;
    }
    elseif($s=="3b")
    {
        $Extroversion-=$increment;
        $pairs[2][1] = 1;
    }
    elseif($s=="4a")
    {
        $Neuroticism+=$increment;
        $pairs[3][0] = 1;
    }
    elseif($s=="4b")
    {
        $Neuroticism-=$increment;
        $pairs[3][1] = 1;
    }
    elseif($s=="5a")
    {
        $Openness+=$increment;
        $pairs[4][0] = 1;
    }
    elseif($s=="5b")
    {
        $Openness-=$increment;
        $pairs[4][1] = 1;
    }
    elseif($s=="6a")
    {
        $Extroversion+=$increment;
        $pairs[5][0] = 1;
    }
    elseif($s=="6b")
    {
        $Extroversion-=$increment;
        $pairs[5][1] = 1;
    }
    elseif($s=="7a")
    {
        $Neuroticism+=$increment;
        $pairs[6][0] = 1;
    }
    elseif($s=="7b")
    {
        $Neuroticism-=$increment;
        $pairs[6][1] = 1;
    }
    elseif($s=="8a")
    {
        $Openness+=$increment;
        $pairs[7][0] = 1;
    }
    elseif($s=="8b")
    {
        $Openness-=$increment;
        $pairs[7][1] = 1;
    }
    elseif($s=="9a")
    {
        $Conscientiousness+=$increment;
        $pairs[8][0] = 1;
    }
    elseif($s=="9b")
    {
        $Conscientiousness-=$increment;
        $pairs[8][1] = 1;
    }
    elseif($s=="10a")
    {
        $Conscientiousness+=$increment;
        $pairs[9][0] = 1;
    }
    elseif($s=="10b")
    {
        $Conscientiousness-=$increment;
        $pairs[9][1] = 1;
    }
    else
    {
        //echo "--Pair not found";
    }

}
function AnalyzeFivePictures($s, $increment)
{
    global $Conscientiousness, $Agreeableness, $Extroversion, $Neuroticism, $Openness;
    global $sets;

    if($s=="1a")
    {
        $Agreeableness+=$increment;
        $sets[0][0] = $increment;
    }
    elseif($s=="1b")
    {
        $Conscientiousness+=$increment;
        $sets[0][1] = $increment;
    }
    elseif($s=="1c")
    {
        $Extroversion+=$increment;
        $sets[0][2] = $increment;
    }
    elseif($s=="1d")
    {
        $Neuroticism+=$increment;
        $sets[0][3] = $increment;
    }
    elseif($s=="1e")
    {
        $Openness+=$increment;
        $sets[0][4] = $increment;
    }
    elseif($s=="2a")
    {
        $Agreeableness-=$increment;
        $sets[1][0] = $increment;
    }
    elseif($s=="2b")
    {
        $Conscientiousness-=$increment;
        $sets[1][1] = $increment;
    }
    elseif($s=="2c")
    {
        $Extroversion-=$increment;
        $sets[1][2] = $increment;
    }
    elseif($s=="2d")
    {
        $Neuroticism-=$increment;
        $sets[1][3] = $increment;
    }
    elseif($s=="2e")
    {
        $Openness-=$increment;
        $sets[1][4] = $increment;
    }
    elseif($s=="3a")
    {
        $Openness+=$increment;
        $sets[2][0] = $increment;
    }
    elseif($s=="3b")
    {
        $Neuroticism-=$increment;
        $sets[2][1] = $increment;
    }
    elseif($s=="3c")
    {
        $Extroversion+=$increment;
        $sets[2][2] = $increment;
    }
    elseif($s=="3d")
    {
        $Conscientiousness+=$increment;
        $sets[2][3] = $increment;
    }
    elseif($s=="3e")
    {
        $Agreeableness+=$increment;
        $sets[2][4] = $increment;
    }
    elseif($s=="4a")
    {
        $Agreeableness-=$increment;
        $sets[3][0] = $increment;
    }
    elseif($s=="4b")
    {
        $Extroversion-=$increment;
        $sets[3][1] = $increment;
    }
    elseif($s=="4c")
    {
        $Conscientiousness-=$increment;
        $sets[3][2] = $increment;
    }
    elseif($s=="4d")
    {
        $Neuroticism+=$increment;
        $sets[3][3] = $increment;
    }
    elseif($s=="4e")
    {
        $Openness-=$increment;
        $sets[3][4] = $increment;
    }
    elseif($s=="5a")
    {
        $Openness+=$increment;
        $sets[4][0] = $increment;
    }
    elseif($s=="5b")//hat
    {
        $Neuroticism+=$increment;
        $sets[4][1] = $increment;
    }
    elseif($s=="5c")//beach
    {
        $Extroversion+=$increment;
        $sets[4][2] = $increment;
    }
    elseif($s=="5d")
    {
        $Conscientiousness+=$increment;
        $sets[4][3] = $increment;
    }
    elseif($s=="5e")
    {
        $Agreeableness+=$increment;
        $sets[4][4] = $increment;
    }
    elseif($s=="6a")
    {
        $Agreeableness+=$increment;
        $sets[5][0] = $increment;
    }
    elseif($s=="6b")
    {
        $Extroversion+=$increment;
        $sets[5][1] = $increment;
    }
    elseif($s=="6c")
    {
        $Neuroticism+=$increment;
        $sets[5][2] = $increment;
    }
    elseif($s=="6d")
    {
        $Openness+=$increment;
        $sets[5][3] = $increment;
    }
    elseif($s=="6e")
    {
        $Conscientiousness+=$increment;
        $sets[5][4] = $increment;
    }
    else
    {
        //echo "--Pair not found";
    }
}

echo "complete";
?>