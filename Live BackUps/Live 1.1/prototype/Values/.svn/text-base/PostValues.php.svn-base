<?php
echo "<html>";
echo "<title>Values Post</title>";

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
	
foreach($xml_array as $values)
{
	if($values->getName() == "independent")
	{
		foreach($values->children() as $value)
		{
			$set = array();
			$set['value'] = intval($value);
			$set['name'] = $value->getName();
			$independent[] = $set;
			//echo $set['name']." ";
			//echo $set['value'].",";
		}
	}
	else if($values->getName() == "order")
	{
		foreach($values->children() as $value)
		{
			$choices[] = $value;
			//echo $value;
		}
	}
	else if($values->getName() == "percentages")
	{
		foreach($values->children() as $value)
		{
			$set = array();
			$set['value'] = intval($value);
			$set['name'] = $value->getName();
			$percentages[] = $set;
			//echo $set['name']." ";
			//echo $set['value'].",";
		}
	}
}

//single selection scoring
$Achievement = IndependentScoring($independent[0]['value']);
$Challenge = IndependentScoring($independent[1]['value']);
$Independence = IndependentScoring($independent[2]['value']);
$Money = IndependentScoring($independent[3]['value']);
$Power = IndependentScoring($independent[4]['value']);
$Recognition = IndependentScoring($independent[5]['value']);
$Service = IndependentScoring($independent[6]['value']);
$Variety = IndependentScoring($independent[7]['value']);


//drag and drop ordering scoring
OrderScoring($choices[0],5);
OrderScoring($choices[1],4.375);
OrderScoring($choices[2],3.75);
OrderScoring($choices[3],3.125);
OrderScoring($choices[4],2.5);
OrderScoring($choices[5],1.875);
OrderScoring($choices[6],1.25);
OrderScoring($choices[7],0.625);


OrderScoringISO($choices[0],3);
OrderScoringISO($choices[1],3);
OrderScoringISO($choices[2],2);
OrderScoringISO($choices[3],2);
OrderScoringISO($choices[4],1);
OrderScoringISO($choices[5],1);
OrderScoringISO($choices[6],0);
OrderScoringISO($choices[7],0);


$scoring = 8;
while($scoring > 0)
{
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

//displayResult();


$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');

$queryChunk = "$ID, $Achievement, $Independence, $Money, $Power, $Recognition, $Service, $Variety";
//echo $queryChunk;
$query = "INSERT INTO ValuesScoring VALUES ($queryChunk);";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
//echo $result;
mysql_free_result($result);

$queryChunk = "$ID";

for($i=0;$i<8;$i++)
{
	$queryChunk .= ", ".IndependentScoringISO($independent[$i]['value']);
}

for($i=0;$i<8;$i++)
{
	$queryChunk .= ", ".$dragISO[$i];
}

$scoring = 8;
while($scoring > 0)
{
	PieChartScoringISO();	
}
for($i=0;$i<8;$i++)
{
	$queryChunk .= ", ".$pie[$i];
}
//echo $queryChunk;
$query = "INSERT INTO ValuesISO VALUES ($queryChunk);";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
//echo $result;
mysql_free_result($result);


//echo "<h1>Your ID is: $id</h1>";

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
	global $percentages, $p, $scoring, $subDimensions;
	$newArray = array();
	$high = 0;
	$count = 0;
	for($i=0;$i<count($percentages);$i++)
	{
		if($percentages[$i]['value'] > $high)
		{
			$high = $percentages[$i]['value'];
		}
	}

	for($i=0;$i<count($percentages);$i++)
	{
		if($percentages[$i]['value'] == $high)
		{
            $tempName = $percentages[$i]['name'];
            //echo "<p>$tempName got a score of $scoring</p>";
			$subDimensions[''.$percentages[$i]['name'].''] += $scoring;
			$percentages[$i]['value'] = 0;
			$p[$i] = $scoring;
			$count++;
		}
	}
	$scoring -= $count;
}

function PieChartScoringISO() 
{
	global $percentages, $pie, $scoring;
	$newArray = array();
	$high = 0;
	$count = 0;
	for($i=0;$i<count($percentages);$i++)
	{
		if($percentages[$i]['value'] > $high)
		{
			$high = $percentages[$i]['value'];
		}
	}
	
	for($i=0;$i<count($percentages);$i++)
	{
		if($percentages[$i]['value'] == $high)
		{
			$subDimensions[''.$percentages[$i]['type'].''] += $scoring;
			$percentages[$i]['value'] = 0;
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

echo "<h1> </h1>";
echo "<script language=\"JavaScript\">";
echo "document.body.innerHTML += '<form id=\"form\" action=\"http://tidepool.co/Live/IM2/IM2.php\" method=\"post\"><input type=\"hidden\" name=\"ID\" value=\"$ID\"/><input type=\"hidden\" name=\"password\" value=\"d3mo\"/>';";
echo "document.getElementById(\"form\").submit();";
echo "</script>";
echo "</body>";
echo "</html>";
?>