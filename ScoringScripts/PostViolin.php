<?php


include_once "../Live/dbConnect.php";
establishConnection();
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
//$ID = "test--65sg1n6rg1n";
$link;


$ISOQuery = "'$ID'";
$independent = array();
$choices = array();
$dragISO = array();
$percentages = array();
$subDimensions = array();
$pie = array();
$p = array();
$Achievement = 0;
$Challenge = 0;
$Independence = 0;
$Money = 0;
$Power = 0;
$Recognition = 0;
$Service = 0;
$Variety = 0;

readInputs();
scoring();
uploadISO();
//displayResult();
function readInputs()
{
    Global $xml_array, $independent, $choices, $percentages;
    foreach($xml_array as $values)
    {
        if($values->getName() == "independent")
        {
            foreach($values->children() as $value)
            {
                //echo "<p>".intval($value)."</p>";
                if($value->getName() == "changes")
                {
                    $independent['changes'] = array();

                    foreach($value->children() as $v)
                    {
                        $independent['changes'][] = $v;
                    }
                }
                else
                {
                    $independent[] = intval($value);
                }
            }
        }
        else if($values->getName() == "order")
        {
            foreach($values->children() as $value)
            {
                if($value->getName() == "changes")
                {
                    $choices['changes'] = $value;
                }
                else
                {
                    $choices[] = $value;
                }
                //echo $value;
            }
        }
        else if($values->getName() == "percentages")
        {
            foreach($values->children() as $value)
            {
                if($value->getName() == "changes")
                {
                    $percentages['changes'] = $value;
                }
                else
                {
                    $set = array();
                    $set['value'] = intval($value);
                    $set['name'] = $value->getName();
                    $percentages[] = $set;
                }
                //echo $set['name']." ";
                //echo $set['value'].",";
            }
        }
    }
}

function scoring()
{
    scoreIndependent();
    scoreOrder();
    scoringPieChart();
}

function scoreIndependent()
{
    Global $ISOQuery, $independent, $Achievement, $Challenge, $Independence, $Money, $Power, $Recognition, $Service, $Variety;
    //single selection scoring
    $Achievement = IndependentScoring($independent[0]);
    $Challenge = IndependentScoring($independent[1]);
    $Independence = IndependentScoring($independent[2]);
    $Money = IndependentScoring($independent[3]);
    $Power = IndependentScoring($independent[4]);
    $Recognition = IndependentScoring($independent[5]);
    $Service = IndependentScoring($independent[6]);
    $Variety = IndependentScoring($independent[7]);

    for($i=0;$i<8;$i++)
    {
        $ISOQuery .= ", ".IndependentScoringISO($independent[$i]);
    }
}

function scoreOrder()
{
    Global $choices, $ISOQuery, $dragISO;
    //drag and drop ordering scoring

    OrderScoring($choices[0],0.625);
    OrderScoring($choices[1],1.25);
    OrderScoring($choices[2],1.875);
    OrderScoring($choices[3],2.5);
    OrderScoring($choices[4],3.125);
    OrderScoring($choices[5],3.75);
    OrderScoring($choices[6],4.375);
    OrderScoring($choices[7],5);

    OrderScoringISO($choices[0],0);
    OrderScoringISO($choices[1],0);
    OrderScoringISO($choices[2],1);
    OrderScoringISO($choices[3],1);
    OrderScoringISO($choices[4],2);
    OrderScoringISO($choices[5],2);
    OrderScoringISO($choices[6],3);
    OrderScoringISO($choices[7],3);


    for($i=0;$i<8;$i++)
    {
        $ISOQuery .= ", ".$dragISO[$i];
    }
}


function scoringPieChart()
{
    Global $ISOQuery, $scoring, $pie, $subDimensions, $Achievement, $Challenge, $Independence, $Money, $Power, $Recognition, $Service, $Variety,$percentages;
    $scoring = 8;
    while($scoring > 0)
    {
        //print_r($percentages);
        //echo "<p>Scoring: $scoring</p>";
        PieChartScoring();
    }

    $Achievement += $subDimensions['achievement'];
    $Challenge += $subDimensions['challenge'];
    $Independence += $subDimensions['independence'];
    $Money += $subDimensions['money'];
    $Power += $subDimensions['power'];
    $Recognition += $subDimensions['recognition'];
    $Service += $subDimensions['service'];
    $Variety += $subDimensions['variety'];

    for($i=0;$i<8;$i++)
    {
        $ISOQuery .= ", ".$pie[$i];
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
    Global $ISOQuery, $link,$ID;

    establishConnection();

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
        $query = "INSERT INTO Timing VALUES ('$ID', '', '', '$date', '', '', '', '', '', '', '', '', '', '', '', '', '', '','','','');";
    }
    else
    {
        $query = "UPDATE Timing SET Violin='$date' where ID='$ID';";
    }
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    //echo $ISOQuery;
    $query = "INSERT INTO ValuesISO VALUES ($ISOQuery);";
    $result = mysql_query($query) or die('Iso Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    uploadScoring();
}

function uploadScoring()
{
    Global $ID, $Achievement, $Challenge, $Independence, $Money, $Power, $Recognition, $Service, $Variety;

    $queryChunk = "'$ID', $Achievement, $Challenge, $Independence, $Money, $Power, $Recognition, $Service, $Variety";
    //echo $queryChunk;
    $query = "INSERT INTO ValuesScoring VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Scoring Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    uploadChanges();
}


function uploadChanges()
{
    Global $ID, $link,$independent, $percentages, $choices;

    $queryChunk = "'$ID'";
    foreach($independent['changes'] as $change)
    {
        $queryChunk .= ",'$change'";
    }
    $queryChunk .= ",'".$choices['changes']."'";
    $queryChunk .= ",'".$percentages['changes']."'";

    $query = "INSERT INTO ValuesChanges VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Changes Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    mysql_close($link);
}

function IndependentScoring($value)
{
    $temp = $value/20;
    return $temp;
}

function IndependentScoringISO($value)
{
    if($value <= 20)
    {
        return 0;
    }
    else if($value <= 40)
    {
        return 1;
    }
    else if($value <= 60)
    {
        return 2;
    }
    else if($value <= 80)
    {
        return 3;
    }
    else if($value <= 100)
    {
        return 4;
    }
    else
    {
        return -1;
    }
}

function OrderScoring($name, $value)
{
    Global $Achievement, $Challenge, $Independence, $Money, $Power, $Recognition, $Service, $Variety;

    if($name=="Achievement")
    {
        $Achievement = $value;
    }
    else if($name=="Challenge")
    {
        $Challenge=$value;
    }
    else if($name=="Independence")
    {
        $Independence=$value;
    }
    else if($name=="Money")
    {
        $Money=$value;
    }
    else if($name=="Power")
    {
        $Power=$value;
    }
    else if($name=="Recognition")
    {
        $Recognition=$value;
    }
    else if($name=="Service to Others")
    {
        $Service=$value;
    }
    else if($name=="Variety")
    {
        $Variety=$value;
    }
    else
    {
        //echo "<h2>ERROR</h2>";
    }
}

function OrderScoringISO($name, $value)
{
    Global $dragISO;

    if($name=="Achievement")
    {
        $dragISO[0] = $value;
    }
    else if($name=="Challenge")
    {
        $dragISO[1] = $value;
    }
    else if($name=="Independence")
    {
        $dragISO[2] = $value;
    }
    else if($name=="Money")
    {
        $dragISO[3] = $value;
    }
    else if($name=="Power")
    {
        $dragISO[4] = $value;
    }
    else if($name=="Recognition")
    {
        $dragISO[5] = $value;
    }
    else if($name=="Service to Others")
    {
        $dragISO[6] = $value;
    }
    else if($name=="Variety")
    {
        $dragISO[7] = $value;
    }
    else
    {
        //echo "<h2>ERROR</h2>";
    }
}

function PieChartScoring()
{
    global $subDimensions, $percentages, $pie, $scoring;
    $high = 0;
    $count = 0;
    for($i=0;$i<count($percentages)-1;$i++)
    {
        if($percentages[$i]['value'] > $high)
        {
            $high = $percentages[$i]['value'];
        }
    }

    for($i=0;$i<count($percentages)-1;$i++)
    {
        if($percentages[$i]['value'] == $high)
        {
            //echo "<p>Scored: ".$percentages[$i]['name']." a $scoring</p>";
            $subDimensions[''.$percentages[$i]['name'].''] += $scoring;
            $percentages[$i]['value'] = -1;
            $pie[$i] = $scoring;
            $count++;
        }
    }

    $scoring -= $count;
}

function displayResult()
{
    global $Achievement;
    global $Challenge;
    global $Independence;
    global $Money;
    global $Power;
    global $Recognition;
    global $Service;
    global $Variety;

    echo "<p>Achievement $Achievement</p>";
    echo "<p>Challenge $Challenge</p>";
    echo "<p>Independence $Independence</p>";
    echo "<p>Money $Money</p>";
    echo "<p>Power $Power</p>";
    echo "<p>Recognition $Recognition</p>";
    echo "<p>Service $Service</p>";
    echo "<p>Variety $Variety</p>";
}

echo "complete";
?>