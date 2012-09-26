<?php
$persAvg = array();
$motAvg = array();
$intAvg = array();
$persUser = array();
$motUser = array();
$intUser = array();
$pers = array();
$mot = array();
$int = array();

$scores = array();
$list = array();
$current=0;
//run();
//$temp = getScore(478);
//print_r($temp);
function run()
{
    Global $list,$current;
    getList();
    //echo "<p>list</p>";
    foreach($list as $person)
    {
        getScores();
        $current++;
    }
    printScores();
}

function getScore($id)
{
    //echo "<h1>trying to get scores in file</h1>";
    getAverages();
    //echo "<h1>got avg to get scores in file</h1>";
    $list = getScores($id);
    //echo "<h1>have avg to get scores in file</h1>";

   // print_r($list);
    return $list;
}

function getList()
{
    Global $link, $list;

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
        or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = "SELECT id FROM UserInfo WHERE id>410 AND WorkType<>''";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    while ($row = mysql_fetch_assoc($result))
    {
        $temp = array();
        $temp['ID'] = $row['id'];
        $list[] = $temp;
    }
    //print_r($list);
    getAverages();
    //echo "<p>Averages</p>";
}

function getAverages()
{
    Global $persAvg, $motAvg, $intAvg;

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
        or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = 'SELECT AVG(Conscientiousness), AVG(Agreeableness), AVG(Neuroticism), AVG(Openness),';
    $query .= 'MAX(Conscientiousness), MAX(Agreeableness), MAX(Neuroticism), MAX(Openness),';
    $query .= 'MIN(Conscientiousness), MIN(Agreeableness), MIN(Neuroticism), MIN(Openness)';
    $query .= 'FROM FramesScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $Avgs = mysql_fetch_row($result);
    $persAvg['C'] = $Avgs[0];
    $persAvg['A'] = $Avgs[1];
    $persAvg['N'] = $Avgs[2];
    $persAvg['O'] = $Avgs[3];
    $persAvg['CMax'] = $Avgs[4];
    $persAvg['AMax'] = $Avgs[5];
    $persAvg['NMax'] = $Avgs[6];
    $persAvg['OMax'] = $Avgs[7];
    $persAvg['CMin'] = $Avgs[8];
    $persAvg['AMin'] = $Avgs[9];
    $persAvg['NMin'] = $Avgs[10];
    $persAvg['OMin'] = $Avgs[11];
    mysql_free_result($result);

    $query = 'SELECT AVG(Energy), AVG(Interdependence), AVG(Orderliness), AVG(Acceptance),';
    $query .= 'MAX(Energy), MAX(Interdependence), MAX(Orderliness), MAX(Acceptance),';
    $query .= 'MIN(Energy), MIN(Interdependence), MIN(Orderliness), MIN(Acceptance)';
    $query .= 'FROM SpaceScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $Avgs = mysql_fetch_row($result);
    $motAvg['E'] = $Avgs[0];
    $motAvg['I'] = $Avgs[1];
    $motAvg['O'] = $Avgs[2];
    $motAvg['A'] = $Avgs[3];
    $motAvg['EMax'] = $Avgs[4];
    $motAvg['IMax'] = $Avgs[5];
    $motAvg['OMax'] = $Avgs[6];
    $motAvg['AMax'] = $Avgs[7];
    $motAvg['EMin'] = $Avgs[8];
    $motAvg['IMin'] = $Avgs[9];
    $motAvg['OMin'] = $Avgs[10];
    $motAvg['AMin'] = $Avgs[11];
    mysql_free_result($result);

    $query = 'SELECT AVG(Conventional), AVG(Enterprising), AVG(Social),';
    $query .= 'MAX(Conventional), MAX(Enterprising), MAX(Social),';
    $query .= 'MIN(Conventional), MIN(Enterprising), MIN(Social)';
    $query .= 'FROM CloudsScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $Avgs = mysql_fetch_row($result);
    $intAvg['C'] = $Avgs[0];
    $intAvg['E'] = $Avgs[1];
    $intAvg['S'] = $Avgs[2];
    $intAvg['CMax'] = $Avgs[3];
    $intAvg['EMax'] = $Avgs[4];
    $intAvg['SMax'] = $Avgs[5];
    $intAvg['CMin'] = $Avgs[6];
    $intAvg['EMin'] = $Avgs[7];
    $intAvg['SMin'] = $Avgs[8];
    mysql_free_result($result);
    standarizeAvgScores();
}

function standarizeAvgScores()
{
    Global $persAvg, $motAvg, $intAvg;
    //All scores are standarized for 1-20 based of their ranges
    $persAvg['CMax'] = ($persAvg['CMax'] - $persAvg['C']) * 0.6452;//31
    $persAvg['AMax'] = ($persAvg['AMax'] - $persAvg['A']) * 0.7407;//27
    $persAvg['NMax'] = ($persAvg['NMax'] - $persAvg['N']) * 0.6897;//28
    $persAvg['OMax'] = ($persAvg['OMax'] - $persAvg['O']) * 0.6897;//28
    $persAvg['CMin'] = ($persAvg['CMin'] - $persAvg['C']) * 0.6452;//31
    $persAvg['AMin'] = ($persAvg['AMin'] - $persAvg['A']) * 0.7407;//27
    $persAvg['NMin'] = ($persAvg['NMin'] - $persAvg['N']) * 0.6897;//28
    $persAvg['OMin'] = ($persAvg['OMin'] - $persAvg['O']) * 0.6897;//28

    $motAvg['EMax'] = ($motAvg['EMax'] - $motAvg['E']) * 0.37224;//53
    $motAvg['IMax'] = ($motAvg['IMax'] - $motAvg['I']) * 0.37224;//53
    $motAvg['OMax'] = ($motAvg['OMax'] - $motAvg['O']) * 0.37224;//53
    $motAvg['AMax'] = ($motAvg['AMax'] - $motAvg['A']) * 0.37224;//53
    $motAvg['EMin'] = ($motAvg['EMin'] - $motAvg['E']) * 0.37224;//53
    $motAvg['IMin'] = ($motAvg['IMin'] - $motAvg['I']) * 0.37224;//53
    $motAvg['OMin'] = ($motAvg['OMin'] - $motAvg['O']) * 0.37224;//53
    $motAvg['AMin'] = ($motAvg['AMin'] - $motAvg['A']) * 0.37224;//53

    $intAvg['CMax'] = ($intAvg['CMax'] - $intAvg['C']) * 0.9524;//21
    $intAvg['EMax'] = ($intAvg['EMax'] - $intAvg['E']) * 0.9524;//21
    $intAvg['SMax'] = ($intAvg['SMax'] - $intAvg['S']) * 0.9524;//21
    $intAvg['CMin'] = ($intAvg['CMin'] - $intAvg['C']) * 0.9524;//21
    $intAvg['EMin'] = ($intAvg['EMin'] - $intAvg['E']) * 0.9524;//21
    $intAvg['SMin'] = ($intAvg['SMin'] - $intAvg['S']) * 0.9524;//21
    findMaxMin();
}

function findMaxMin()
{
    Global $persAvg, $motAvg, $intAvg, $scores;
    $scores['cashierMax'] = (2*$intAvg['CMax'])+(2*$persAvg['CMax'])+$intAvg['EMax']+$persAvg['AMax']-$persAvg['N']+$motAvg['OMax'];
    $scores['cashierMin'] = (2*$intAvg['CMin'])+(2*$persAvg['CMin'])+$intAvg['EMin']+$persAvg['AMin']-$persAvg['NMin']+$motAvg['OMin'];

    $scores['highEndMax'] = (2*$intAvg['SMax'])+$intAvg['EMax']+$persAvg['CMax']+$persAvg['OMax']+$motAvg['IMax']+$persAvg['NMax'];
    $scores['highEndMin'] = (2*$intAvg['SMin'])+$intAvg['EMin']+$persAvg['CMin']+$persAvg['OMin']+$motAvg['IMin']+$persAvg['NMin'];

    $scores['highEndChainMax'] = (2*$intAvg['SMax'])+(2*$persAvg['CMax'])+$intAvg['CMax']+$persAvg['AMax']+$motAvg['IMax']+$motAvg['EMax'];
    $scores['highEndChainMin'] = (2*$intAvg['SMin'])+(2*$persAvg['CMin'])+$intAvg['CMin']+$persAvg['AMin']+$motAvg['IMin']+$motAvg['EMin'];

    $scores['lowEndChainMax'] = (2*$intAvg['SMax'])+(2*$intAvg['CMax'])+(2*$persAvg['CMax'])+$persAvg['AMax']+$motAvg['AMax'];
    $scores['lowEndChainMin'] = (2*$intAvg['SMin'])+(2*$intAvg['CMin'])+(2*$persAvg['CMin'])+$persAvg['AMin']+$motAvg['AMin'];

    $scores['maAndPopMax'] = (2*$intAvg['SMax'])+(2*$persAvg['AMax'])+$intAvg['CMax']+$persAvg['CMax']+$motAvg['EMax']+$motAvg['AMax'];
    $scores['maAndPopMin'] = (2*$intAvg['SMin'])+(2*$persAvg['AMin'])+$intAvg['CMin']+$persAvg['CMin']+$motAvg['EMin']+$motAvg['AMin'];

    $scores['fastFoodMax'] = (2*$intAvg['CMax'])+(2*$persAvg['CMax'])+$motAvg['EMax']+$motAvg['IMax'];
    $scores['fastFoodMin'] = (2*$intAvg['CMin'])+(2*$persAvg['CMin'])+$motAvg['EMin']+$motAvg['IMin'];

    $scores['cashierMax'] -= $scores['cashierMin'];
    $scores['highEndMax'] -= $scores['highEndMin'];
    $scores['highEndChainMax'] -= $scores['highEndChainMin'];
    $scores['lowEndChainMax'] -= $scores['lowEndChainMin'];
    $scores['maAndPopMax'] -= $scores['maAndPopMin'];
    $scores['fastFoodMax'] -= $scores['fastFoodMin'];
}

function getScores($id)
{
    Global $persUser, $motUser, $intUser;

    $ID = $id;

    $query = "SELECT Conscientiousness, Agreeableness, Neuroticism, Openness FROM FramesScoring WHERE id='$ID'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $Avgs = mysql_fetch_row($result);
    $persUser['C'] = $Avgs[0];
    $persUser['A'] = $Avgs[1];
    $persUser['N'] = $Avgs[2];
    $persUser['O'] = $Avgs[3];
    mysql_free_result($result);

    $query = "SELECT Energy, Interdependence, Orderliness, Acceptance FROM SpaceScoring WHERE id='$ID'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $Avgs = mysql_fetch_row($result);
    $motUser['E'] = $Avgs[0];
    $motUser['I'] = $Avgs[1];
    $motUser['O'] = $Avgs[2];
    $motUser['A'] = $Avgs[3];
    mysql_free_result($result);

    $query = "SELECT Conventional, Enterprising, Social FROM CloudsScoring WHERE id='$ID'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $Avgs = mysql_fetch_row($result);
    $intUser['C'] = $Avgs[0];
    $intUser['E'] = $Avgs[1];
    $intUser['S'] = $Avgs[2];
    mysql_free_result($result);
    return standarizeUserScores();
}



function standarizeUserScores()
{

    Global $persAvg, $motAvg, $intAvg;
    Global $persUser, $motUser, $intUser;
    Global $pers, $mot, $int;

    //All scores are standarized for 1-20 based of their ranges
    $pers['C'] = ($persUser['C'] - $persAvg['C']) * 0.6452;//31
    $pers['A'] = ($persUser['A'] - $persAvg['A']) * 0.7407;//27
    $pers['N'] = ($persUser['N'] - $persAvg['N']) * 0.6897;//28
    $pers['O'] = ($persUser['O'] - $persAvg['O']) * 0.6897;//28

    $mot['E'] = ($motUser['E'] - $motAvg['E']) * 0.37224;//53
    $mot['I'] = ($motUser['I'] - $motAvg['I']) * 0.37224;//53
    $mot['O'] = ($motUser['O'] - $motAvg['O']) * 0.37224;//53
    $mot['A'] = ($motUser['A'] - $motAvg['A']) * 0.37224;//53

    $int['C'] = ($intUser['C'] - $intAvg['C']) * 0.9524;//21
    $int['E'] = ($intUser['E'] - $intAvg['E']) * 0.9524;//21
    $int['S'] = ($intUser['S'] - $intAvg['S']) * 0.9524;//21
    return calculateScores();
}

function calculateScores()
{
    Global $pers, $mot, $int, $scores, $current, $list;
    $scores['cashier'] = (2*$int['C'])+(2*$pers['C'])+$int['E']+$pers['A']-$pers['N']+$mot['O'];
    $scores['highEnd'] = (2*$int['S'])+$int['E']+$pers['C']+$pers['O']+$mot['I']+$pers['N'];
    $scores['highEndChain'] = (2*$int['S'])+(2*$pers['C'])+$int['C']+$pers['A']+$mot['I']+$mot['E'];
    $scores['lowEndChain'] = (2*$int['S'])+(2*$int['C'])+(2*$pers['C'])+$pers['A']+$mot['A'];
    $scores['maAndPop'] = (2*$int['S'])+(2*$pers['A'])+$int['C']+$pers['C']+$mot['E']+$mot['A'];
    $scores['fastFood'] = (2*$int['C'])+(2*$pers['C'])+$mot['E']+$mot['I'];

    /*
    $list[$current]['cashier'] = number_format(((($scores['cashier'] - $scores['cashierMin'])/$scores['cashierMax'])*100),2);
    $list[$current]['highEnd'] = number_format(((($scores['highEnd'] - $scores['highEndMin'])/$scores['highEndMax'])*100),2);
    $list[$current]['highEndChain'] = number_format(((($scores['highEndChain'] - $scores['highEndChainMin'])/$scores['highEndChainMax'])*100),2);
    $list[$current]['lowEndChain'] = number_format(((($scores['lowEndChain'] - $scores['lowEndChainMin'])/$scores['lowEndChainMax'])*100),2);
    $list[$current]['maAndPop'] = number_format(((($scores['maAndPop'] - $scores['maAndPopMin'])/$scores['maAndPopMax'])*100),2);
    $list[$current]['fastFood'] = number_format(((($scores['fastFood'] - $scores['fastFoodMin'])/$scores['fastFoodMax'])*100),2);
*/
    $temp = array();
    $temp['cashier'] = intval(((($scores['cashier'] - $scores['cashierMin'])/$scores['cashierMax'])*100));
    $temp['highEnd'] = intval(((($scores['highEnd'] - $scores['highEndMin'])/$scores['highEndMax'])*100));
    $temp['highEndChain'] = intval(((($scores['highEndChain'] - $scores['highEndChainMin'])/$scores['highEndChainMax'])*100));
    $temp['lowEndChain'] = intval(((($scores['lowEndChain'] - $scores['lowEndChainMin'])/$scores['lowEndChainMax'])*100));
    $temp['maAndPop'] = intval(((($scores['maAndPop'] - $scores['maAndPopMin'])/$scores['maAndPopMax'])*100));
    $temp['fastFood'] = intval(((($scores['fastFood'] - $scores['fastFoodMin'])/$scores['fastFoodMax'])*100));
    /*
    $temp['cashier'] = number_format(((($scores['cashier'] - $scores['cashierMin'])/$scores['cashierMax'])*100),2);
    $temp['highEnd'] = number_format(((($scores['highEnd'] - $scores['highEndMin'])/$scores['highEndMax'])*100),2);
    $temp['highEndChain'] = number_format(((($scores['highEndChain'] - $scores['highEndChainMin'])/$scores['highEndChainMax'])*100),2);
    $temp['lowEndChain'] = number_format(((($scores['lowEndChain'] - $scores['lowEndChainMin'])/$scores['lowEndChainMax'])*100),2);
    $temp['maAndPop'] = number_format(((($scores['maAndPop'] - $scores['maAndPopMin'])/$scores['maAndPopMax'])*100),2);
    $temp['fastFood'] = number_format(((($scores['fastFood'] - $scores['fastFoodMin'])/$scores['fastFoodMax'])*100),2);
    */
    //print_r($temp);
    return $temp;
    //printScores($list[$current]);
}

function printScores()
{
    Global $list;
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Algorithm</title>
</head>
<body>
<div align="center">
    <table cellspacing="5px" border="2px">
        <tr>
            <th>ID</th> <th>Cashier</th> <th>High End</th> <th>High End Chain</th> <th>Low End Chain</th> <th>Ma and Pop</th> <th>Fast Food</th>
        </tr>
        <?
        foreach($list as $person)
        {
            echo "<tr align='center'>\n";
            foreach($person as $score)
            {
                //echo "<td>".$person['ID']."</td><td>".$person['cashier']."</td><td>".$person['highEnd']."</td><td>".$person['highEndChain']."</td><td>".$person['lowEndChain']."</td><td>".$person['maAndPop']."</td><td>".$person['fastFood']."</td>\n";
                echo tagWithColor($score);
            }
            echo "\n</tr>\n";

        }
        ?>
    </table>
</div>
</body>
</html>
<?
}

function tagWithColor($num)
{
    $v = 100-$num;
    $r=intval((255*$v)/100);
    $g=intval((255*(100-$v))/100);
    $b=50;

    $temp = rgbToHsl($r,$g,$b);
    /*
    if($num <= 40)
    {
        return "<td style='color: #000000;background: #CC0000;font-size: 14;font-weight: bold'>$num</td>";
    }
    else if($num <= 50)
    {
        return "<td style='color: #000000;background: #ff8800;font-size: 14;font-weight: bold'>$num</td>";
        //return "<td><p style='background: #CCCC00;'><p style='color: #000000;'>$num</p></td>";
    }
    else if($num <= 60)
    {
        return "<td style='color: #000000;background: #CCCC00;font-size: 14;font-weight: bold'>$num</td>";
        //return "<td><p style='background: #CCCC00;'><p style='color: #000000;'>$num</p></td>";
    }
    else
    */
    if($num <= 100)
    {
        return "<td style='color: #000000; background: hsl(".$temp['h'].",".$temp['s']."%,".$temp['l']."%); font-size: 14;font-weight: bold;'>$num</td>";
        //return "<td><p style='background: #009900;'><p style='color: #000000;'>$num</p></td>";
    }

    else
    {
        return "<td style='color: #000000;'>$num</td>";
    }
}

function rgbToHsl($r, $g, $b)
{
    $r /= 255;
    $g /= 255;
    $b /= 255;
    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
    $h = ($max + $min) / 2;
    $s = ($max + $min) / 2;
    $l = ($max + $min) / 2;

    echo "<p>MAx is $max and min is $min</p>";
    if($max == $min)
    {
        $h = 0;
        $s = 0; // achromatic
    }
    else
    {
        $d = $max - $min;
        if($l > 0.5)
        {
            $s = $d / (2 - $max - $min);
        }
        else
        {
            $s = $d / ($max + $min);
        }
        switch($max)
        {
            case $r:
                if($g < $b)
                    $temp = 6;
                else
                    $temp = 0;
                $h = ($g - $b) / $d + $temp;
                break;
            case $g:
                $h = ($b - $r) / $d + 2;
                break;
            case $b:
                $h = ($r - $g) / $d + 4;
                break;
        }
        $h /= 6;
    }
    $h = intval(360 * $h);
    $s = intval(100 * $s);
    $l = intval(100 * $l);
    $values = array();
    $values['h'] = $h;
    $values['s'] = $s;
    $values['l'] = $l;
    return $values;
}
?>