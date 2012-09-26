<?php
echo "<html>";
echo "<title>WLB Post</title>";

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



$data = $_REQUEST ['data'];
$ID = $_REQUEST ['ID'];
$xml = simplexml_load_string($data);
$xml_array=object2array($xml);
$link;
//$ID = 772231377;

$ISOQuery = $ID;
$pie;
$slider1;
$shiva;
$map = array();
$travel = array();
$family;
$slider2;
$couch;
$nets = array();
$briefcase = array();
$office = array();
$dream;
$trash;
$clock;
$check = array();

$workLife=0;
$workRelations=0;
$workConditions=0;
$workRelations=0;
$travelAir=0;
$travelAuto=0;
$travelUS=0;
$travelInt=0;

readInputs();
//displayInputs();
scoring();
uploadISO();

function scoring()
{
    //echo "scorePie";
    scorePie();
    //displayResults();

    scoreSlider1();
    //echo "scoreSlider1";
    //displayResults();

    scoreShiva();
    //echo "scoreShiva";
    //displayResults();

    scoreMap();
    // echo "scoreMap";
    //displayResults();

    scoreTravel();
    //echo "scoreTravel";
    //displayResults();

    scoreFamily();
    //echo "scoreFamily";
    //displayResults();

    scoreSlider2();
    //echo "scoreSlider2";
    //displayResults();

    scoreCouch();
    //echo "scoreCouch";
    //displayResults();

    scoreNets();
    //echo "scoreNets";
    //displayResults();

    scoreBriefcase();
    //echo "scoreBriefcase";
    //displayResults();

    scoreOffice();
    // echo "scoreOffice";
    //displayResults();

    scoreDream();
    //echo "scoreDream";
    //displayResults();

    scoreTrash();
    // echo "scoreTrash";
    // displayResults();

    scoreClock();
    //echo "scoreClock";
    //displayResults();

    scoreCheck();
    //echo "scoreCheck";
    //displayResults();

}

function scorePie()
{
    Global $pie, $workLife, $ISOQuery;

    if($pie <= 20)
    {
        $workLife +=1;
        $ISOQuery .= ", 4, 0";
    }
    else if($pie <= 40)
    {
        $workLife +=2;
        $ISOQuery .= ", 3, 1";
    }
    else if($pie <= 60)
    {
        $workLife +=3;
        $ISOQuery .= ", 2, 2";
    }
    else if($pie <= 80)
    {
        $workLife +=4;
        $ISOQuery .= ", 1, 3";
    }
    else if($pie <= 100)
    {
        $workLife +=5;
        $ISOQuery .= ", 0, 4";
    }
    else
    {
        $ISOQuery .= ", -1, -1";
    }
}

function scoreSlider1()
{
    Global $slider1, $workLife,$ISOQuery;

    //echo "<p>$slider1</p>";

    if($slider1 <= 33)
    {
        $workLife +=5;
    }
    else if($slider1 <= 66)
    {
        $workLife +=3;
    }
    else if($slider1 <= 100)
    {
        $workLife +=1;
    }
    else
    {
        //echo "<p>ERROR</p>";
    }

    if($slider1 <= 10)
    {
        $ISOQuery .= ", 5, 0, 0";
    }
    else if($slider1 <= 20)
    {
        $ISOQuery .= ", 4, 1, 0";
    }
    else if($slider1 <= 30)
    {
        $ISOQuery .= ", 3, 2, 0";
    }
    else if($slider1 <= 40)
    {
        $ISOQuery .= ", 2, 3, 0";
    }
    else if($slider1 < 48)
    {
        $ISOQuery .= ", 1, 4, 0";
    }
    else if($slider1 <= 52)
    {
        $ISOQuery .= ", 0, 5, 0";
    }
    else if($slider1 <= 60)
    {
        $ISOQuery .= ", 0, 4, 1";
    }
    else if($slider1 <= 70)
    {
        $ISOQuery .= ", 0, 3, 2";
    }
    else if($slider1 <= 80)
    {
        $ISOQuery .= ", 0, 2, 3";
    }
    else if($slider1 <= 90)
    {
        $ISOQuery .= ", 0, 1, 4";
    }
    else if($slider1 <= 100)
    {
        $ISOQuery .= ", 0, 0, 5";
    }
    else
    {
        $ISOQuery .= ", -1, -1, -1";
    }
}

function scoreShiva()
{
    Global $shiva, $workLife, $ISOQuery;

    if($shiva <= 20)
    {
        $workLife +=1;
        $ISOQuery .= ", 0";
    }
    else if($shiva <= 40)
    {
        $workLife +=2;
        $ISOQuery .= ", 1";
    }
    else if($shiva <= 60)
    {
        $workLife +=3;
        $ISOQuery .= ", 2";
    }
    else if($shiva <= 80)
    {
        $workLife +=4;
        $ISOQuery .= ", 3";
    }
    else if($shiva <= 100)
    {
        $workLife +=5;
        $ISOQuery .= ", 4";
    }
    else
    {
        $ISOQuery .= ", -1";
    }
}
function scoreMap()
{
    Global $map, $ISOQuery, $travelUS, $travelInt;
    $count = 0;
    foreach($map as $m)
    {
        //echo "<p>Region: ".$m['name']." Value: ".$m['value']."</p>";
        $count += $m['value'];
        $pos1 = strpos($m['name'], 'US');
        $pos2 = strpos($m['name'], 'Alaska');
        //echo "<p>$pos</p>";
        if($pos1 === 0 || $pos2 === 0)
        {
            $travelUS += $m['value'];
            //echo "<h1>HIT</h1>";
        }
        else
        {
            if($m['value'] != 0)
            {
                $travelInt += 3;
                if($m['value'] >= 3)
                {
                    $travelInt += 1;
                }
            }

        }
    }

    //echo "<p>US: $travelUS</p>";
    //echo "<p>Int: $travelInt</p>";
    $ISOQuery .= ", ".$count;
}

function scoreTravel()
{
    Global $travel, $ISOQuery, $travelAir, $travelAuto;

    $travelAir = round($travel[0]['value']/29);
    $travelAuto = round($travel[1]['value']/29);
    //echo "<p>AIR: $travelAir</p>";
    //echo "<p>Auto: $travelAuto</p>";
    foreach($travel as $trav)
    {
        if($trav['value'] <= 20)
        {
            $ISOQuery .= ", 0";
        }
        else if($trav['value'] <= 40)
        {
            $ISOQuery .= ", 1";
        }
        else if($trav['value'] <= 60)
        {
            $ISOQuery .= ", 2";
        }
        else if($trav['value'] <= 80)
        {
            $ISOQuery .= ", 3";
        }
        else if($trav['value'] <= 100)
        {
            $ISOQuery .= ", 4";
        }
        else
        {
            $ISOQuery .= ", -1";
        }
    }

}
function scoreFamily()
{
    Global $family, $workLife, $ISOQuery;

    if($family == "no")
    {
        $workLife +=1;
        $ISOQuery .= ", 1, 0, 0";
    }
    else if($family == "sometimes")
    {
        $workLife +=2;
        $ISOQuery .= ", 0, 1, 0";
    }
    else if($family == "yes")
    {
        $workLife +=3;
        $ISOQuery .= ", 0, 0, 1";
    }
    else
    {
        //echo "<p>ERROR</p>";
    }
}
function scoreSlider2()
{
    Global $slider2, $workLife, $ISOQuery;

    if($slider2 <= 33)
    {
        $workLife +=3;
    }
    else if($slider2 <= 66)
    {
        $workLife +=2;
    }
    else if($slider2 <= 100)
    {
        $workLife +=1;
    }
    else
    {
        //echo "<p>ERROR</p>";
    }

    if($slider2 <= 10)
    {
        $ISOQuery .= ", 5, 0, 0";
    }
    else if($slider2 <= 20)
    {
        $ISOQuery .= ", 4, 1, 0";
    }
    else if($slider2 <= 30)
    {
        $ISOQuery .= ", 3, 2, 0";
    }
    else if($slider2 <= 40)
    {
        $ISOQuery .= ", 2, 3, 0";
    }
    else if($slider2 < 49)
    {
        $ISOQuery .= ", 1, 4, 0";
    }
    else if($slider2 <= 51)
    {
        $ISOQuery .= ", 0, 5, 0";
    }
    else if($slider2 <= 60)
    {
        $ISOQuery .= ", 0, 4, 1";
    }
    else if($slider2 <= 70)
    {
        $ISOQuery .= ", 0, 3, 2";
    }
    else if($slider2 <= 80)
    {
        $ISOQuery .= ", 0, 2, 3";
    }
    else if($slider2 <= 90)
    {
        $ISOQuery .= ", 0, 1, 4";
    }
    else if($slider2 <= 100)
    {
        $ISOQuery .= ", 0, 0, 5";
    }
    else
    {
        $ISOQuery .= ", -1, -1, -1";
    }
}
function scoreCouch()
{
    Global $couch, $workLife, $ISOQuery;

    if($couch <= 5)
    {
        $workLife +=5;
        $ISOQuery .= ", 5";
    }
    else if($couch <= 35)
    {
        $workLife +=4;
        $ISOQuery .= ", 4";
    }
    else if($couch <= 65)
    {
        $workLife +=3;
        $ISOQuery .= ", 3";
    }
    else if($couch <= 95)
    {
        $workLife +=2;
        $ISOQuery .= ", 2";
    }
    else if($couch <= 100)
    {
        $workLife +=1;
        $ISOQuery .= ", 1";
    }
    else
    {
        $ISOQuery .= ", -1";
    }
}
function scoreNets()
{
    Global $nets, $workLife, $ISOQuery;

    foreach($nets as $net)
    {
        if($net == 1)
        {
            $workLife +=5;
            $ISOQuery .= ", 1, 0, 0";
        }
        else if($net == 2)
        {
            $workLife +=3;
            $ISOQuery .= ", 0, 1, 0";
        }
        else if($net == 3)
        {
            $workLife +=1;
            $ISOQuery .= ", 0, 0, 1";
        }
        else
        {
            $ISOQuery .= ", -1, -1, -1";
        }
    }

    if($nets[0] == 1)
    {
        $workLife -= 10;
        //echo "<p>10</p>";

    }
    else if($nets[0] == 2)
    {
        $workLife -= 6;
        //echo "<p>6</p>";
    }
    else if($nets[0] == 3)
    {
        $workLife -= 2;
        //echo "<p>2</p>";
    }
    else
    {
        //echo "<p>ERROR NETS</p>";
    }
}

function scoreBriefcase()
{
    Global $briefcase, $workRelations, $ISOQuery;
    $temp = "TEMP";
    $counter = 1;
    foreach($briefcase as $case)
    {
        if($case == 1)
        {
            if($counter == 6)
            {
                $workRelations += -3;
            }
            else if($counter == 7)
            {
                $workRelations += 0;
            }
            else
            {
                $workRelations += 1;
            }
            $ISOQuery .= ", 1, 0, 0";
        }
        else if($case == 2)
        {
            $workRelations += 3;
            $ISOQuery .= ", 0, 1, 0";
        }
        else if($case == 3)
        {
            $workRelations += 5;
            $ISOQuery .= ", 0, 0, 1";
        }
        else
        {
            $ISOQuery .= ", -1, -1, -1";
        }
        $counter++;
    }
    //echo "<p>$temp</p>";
}

function scoreOffice()
{
    Global $office, $workConditions, $ISOQuery;

    $temp = "TEMP";
    $counter = 1;
    foreach($office as $case)
    {
        if($case == 1)
        {
            if($counter == 1)
            {
                $workConditions += -3;
            }
            else if($counter == 2 || $counter == 5)
            {
                $workConditions += 1;
            }
            else if($counter == 6 || $counter == 7)
            {
                $workConditions += 3;
            }
            else if($counter == 3 || $counter == 4)
            {
                $workConditions += 5;
            }

            $ISOQuery .= ", 1, 0, 0, 0";
        }
        else if($case == 2)
        {

            if($counter == 4 || $counter == 6 || $counter == 7)
            {
                $workConditions += 1;
            }
            else if($counter == 2 || $counter == 3)
            {
                $workConditions += 3;
            }
            else if($counter == 1 || $counter == 5)
            {
                $workConditions += 5;
            }

            $ISOQuery .= ", 0, 1, 0, 0";
        }
        else if($case == 3)
        {
            if($counter == 3)
            {
                $workConditions += 1;
            }
            else if($counter == 1 || $counter == 4 || $counter == 5)
            {
                $workConditions += 3;
            }
            else if($counter == 2 || $counter == 6 || $counter == 7)
            {
                $workConditions += 5;
            }
            $ISOQuery .= ", 0, 0, 1, 0";
        }
        else if($case == 4)
        {
            if($counter == 6)
            {
                $workConditions += -3;
            }
            else
            {
                $tempRand = rand(1, 5);
                //echo "<p>Rand: $tempRand</p>";
                $workConditions += $tempRand;
            }
            $ISOQuery .= ", 0, 0, 0, 1";
        }
        else
        {
            $ISOQuery .= ", -1, -1, -1";
        }
        $counter++;
    }

    //echo "<p>Cond: $workConditions</p>";
    //echo "<p>$temp</p>";
}

function scoreDream()
{
    Global $dream, $ISOQuery;

    if($dream == 1)
    {
        $ISOQuery .= ", 1, 0, 0";
    }
    else if($dream == 2)
    {
        $ISOQuery .= ", 0, 1, 0";
    }
    else if($dream == 3)
    {
        $ISOQuery .= ", 0, 0, 1";
    }
    else
    {
        $ISOQuery .= ", -1, -1, -1";
    }
}

function scoreTrash()
{
    Global $trash, $ISOQuery;

    if($trash == 1)
    {
        $ISOQuery .= ", 1, 0, 0, 0, 0, 0";
    }
    else if($trash == 2)
    {
        $ISOQuery .= ", 0, 1, 0, 0, 0, 0";
    }
    else if($trash == 3)
    {
        $ISOQuery .= ", 0, 0, 1, 0, 0, 0";
    }
    else if($trash == 4)
    {
        $ISOQuery .= ", 0, 0, 0, 1, 0, 0";
    }
    else if($trash == 5)
    {
        $ISOQuery .= ", 0, 0, 0, 0, 1, 0";
    }
    else if($trash == 6)
    {
        $ISOQuery .= ", 0, 0, 0, 0, 0, 1";
    }
    else
    {
        $ISOQuery .= ", -1, -1, -1";
    }
}

function scoreClock()
{
    Global $clock, $ISOQuery;

    if($clock <= 1)
    {
        $ISOQuery .= ", 1";
    }
    else if($clock <= 2)
    {
        $ISOQuery .= ", 2";
    }
    else if($clock <= 3)
    {
        $ISOQuery .= ", 3";
    }
    else if($clock <= 4)
    {
        $ISOQuery .= ", 4";
    }
    else if($clock <= 5)
    {
        $ISOQuery .= ", 5";
    }
    else if($clock <= 6)
    {
        $ISOQuery .= ", 6";
    }
    else if($clock <= 7)
    {
        $ISOQuery .= ", 7";
    }
    else if($clock <= 8)
    {
        $ISOQuery .= ", 8";
    }
    else if($clock <= 9)
    {
        $ISOQuery .= ", 9";
    }
    else if($clock <= 10)
    {
        $ISOQuery .= ", 10";
    }
    else if($clock <= 11)
    {
        $ISOQuery .= ", 11";
    }
    else if($clock <= 12)
    {
        $ISOQuery .= ", 12";
    }
    else
    {
        $ISOQuery .= ", -1";
    }
}


function scoreCheck()
{
    Global $check, $ISOQuery;

    foreach($check as $c)
    {
        if($c == "true")
        {
            $ISOQuery .= ", 1";
        }
        else
        {
            $ISOQuery .= ", 0";
        }
    }
}

function readInputs()
{
    Global $pie, $slider1, $shiva, $map, $travel,$family, $slider2, $couch, $nets, $briefcase, $office, $dream, $trash, $clock, $check;
    Global $xml_array;
    foreach($xml_array as $values)
    {
        if($values->getName() == "pie")
        {
            //echo"<p>";
            //print_r($values->work);
            //echo "</p>";
            $pie = intval($values);
        }
        else if($values->getName() == "slider1")
        {
            $slider1 = intval($values);
        }
        else if($values->getName() == "shiva")
        {
            $shiva = intval($values);
        }
        else if($values->getName() == "map")
        {
            foreach($values->children() as $value)
            {
                $set = array();
                $set['value'] = intval($value);
                $set['name'] = $value->getName();
                $map[] = $set;
                //echo $value->getName();
                //echo $value;
            }
        }
        else if($values->getName() == "travel")
        {
            foreach($values->children() as $value)
            {
                $set = array();
                $set['value'] = intval($value);
                $set['name'] = $value->getName();
                $travel[] = $set;
            }
        }
        else if($values->getName() == "family")
        {
            $family = $values;
        }
        else if($values->getName() == "slider2")
        {
            $slider2 = intval($values);
        }
        else if($values->getName() == "couch")
        {
            $couch = intval($values);
        }
        else if($values->getName() == "nets")
        {
            foreach($values->children() as $value)
            {
                $nets[] = intval($value);
            }
        }
        else if($values->getName() == "briefcase")
        {
            foreach($values->children() as $value)
            {
                $briefcase[] = intval($value);
            }
        }
        else if($values->getName() == "office")
        {
            foreach($values->children() as $value)
            {
                $office[] = intval($value);
            }
        }
        else if($values->getName() == "dream")
        {
            $dream = intval($values);
        }
        else if($values->getName() == "trash")
        {
            $trash = intval($values);
        }
        else if($values->getName() == "clock")
        {
            $clock = floatval($values);
        }
        else if($values->getName() == "check")
        {
            foreach($values->children() as $value)
            {
                $check[] = $value;
            }
        }
    }
}


function uploadISO()
{
    Global $ISOQuery, $link;


    $link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $queryChunk = $ISOQuery;
    //echo $queryChunk;
    $query = "INSERT INTO WLBISO VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    uploadScoring();
}

function uploadScoring()
{
    Global $ID, $link, $workLife, $workRelations, $workConditions, $travelUS, $travelInt, $travelAir, $travelAuto;

    $queryChunk = "$ID, $workLife, $workRelations, $workConditions, $travelUS, $travelInt, $travelAir, $travelAuto";
    //echo $queryChunk;
    $query = "INSERT INTO WLBScoring VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    mysql_close($link);
}
function displayResults()
{
    Global $workLife, $ISOQuery;
    //echo "<p>Work Life: $workLife</p>";
    echo "<p>ISO Query: $ISOQuery</p>";
}
function displayInputs()
{

    Global $pie, $slider1, $shiva, $map, $travel, $family, $slider2, $couch, $nets, $briefcase, $office, $dream, $trash, $clock, $check;
    Global $ISOQuery;
    echo "<p>$pie</p>";
    echo "<p>$slider1</p>";
    echo "<p>$shiva</p>";

    foreach($map as $m)
    {
        $name = $m['name'];
        $num = $m['value'];
        echo "<p>".$name.": ".$num."</p>";
    }
    foreach($travel as $m)
    {
        $name = $m['name'];
        $num = $m['value'];
        echo "<p>".$name.": ".$num."</p>";
    }
    echo "<p>Family: $family</p>";
    echo "<p>$slider2</p>";
    echo "<p>$couch</p>";
    foreach($nets as $m)
    {
        echo "<p>Nets: ".$m."</p>";
    }
    foreach($briefcase as $m)
    {
        echo "<p>Briefcase: ".$m."</p>";
    }
    foreach($office as $m)
    {
        echo "<p>Office: ".$m."</p>";
    }
    echo "<p>$dream</p>";
    echo "<p>$trash</p>";
    echo "<p>$clock</p>";

    foreach($check as $m)
    {
        echo "<p>".$m."</p>";
    }
}

echo "<h1> </h1>";
echo "<script language=\"JavaScript\">";
echo "document.body.innerHTML += '<form id=\"form\" action=\"http://tidepool.co/assessment/prototype/IM4/IM4.php\" method=\"post\"><input type=\"hidden\" name=\"ID\" value=\"$ID\"/><input type=\"hidden\" name=\"password\" value=\"d3mo\"/>';";
echo "document.getElementById(\"form\").submit();";
echo "</script>";
echo "</body>";
echo "</html>";
?>