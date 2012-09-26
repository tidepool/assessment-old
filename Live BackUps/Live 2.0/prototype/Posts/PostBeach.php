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
//$ID = 3224377124;

$hands = array();
$tug = array();
$surfing;
$surfingMulti = array();
$laugh;
$pleasure;
$multi3 = array();
$multi4;
$multi5;
$places = array();
$slider1;
$slider2;
$poem;
$art;

$resilience = 0;

$ISOquery = $ID;

//$ID = 77;
readValues();
//echo "<h1>RESULTS</h1>";
scoring();
uploadISO();
uploadScoring();
//printValues();

function readValues()
{
    Global $hands, $tug, $surfing, $surfingMulti, $laugh, $pleasure, $multi3, $multi4, $multi5, $places, $slider1, $slider2, $poem, $art;
    Global $xml_array;

    foreach($xml_array as $values)
    {
        if($values->getName() == "hands")
        {
            // echo"<p>";
            // print_r($values);
            // echo "</p>";
            foreach($values->children() as $value)
            {
                $hands[] = $value;
            }
        }
        else if($values->getName() == "tug")
        {
            //echo"<p>";
            ///print_r($values);
            //echo "</p>";
            foreach($values->children() as $value)
            {
                $tug[] = intval($value);
            }
        }
        else if($values->getName() == "surfing")
        {
            // echo"<p>";
            // print_r($values);
            // echo "</p>";
            foreach($values->children() as $value)
            {

                if($value->getName() == "surf")
                {
                    $surfing = $value;
                }
                if($value->getName() == "multi")
                {
                    // echo"<p>";
                    // print_r($value);
                    // echo "</p>";
                    foreach($value->children() as $v)
                    {
                        $surfingMulti[] = $v;
                    }
                }

            }
        }
        else if($values->getName() == "selection")
        {
            // echo"<p>";
            // print_r($values);
            // echo "</p>";
            foreach($values->children() as $value)
            {

                if($value->getName() == "laugh")
                {
                    $laugh = $value;
                }
                if($value->getName() == "pleasure")
                {
                    $pleasure = $value;
                }
                if($value->getName() == "multi3")
                {
                    // echo"<p>";
                    // print_r($value);
                    //echo "</p>";
                    foreach($value->children() as $v)
                    {
                        $multi3[] = $v;
                    }
                }
                if($value->getName() == "multi4")
                {
                    $multi4 = intval($value);
                    //echo"<p>";
                    //print_r($value);
                    //echo "</p>";
                }
                if($value->getName() == "multi5")
                {
                    $multi5 = intval($value);
                    //echo"<p>";
                    //print_r($value);
                    //echo "</p>";
                }
            }
        }
        else if($values->getName() == "places")
        {
            // echo"<p>";
            // print_r($values);
            // echo "</p>";
            foreach($values->children() as $value)
            {
                $places[] = $value;
            }
        }
        else if($values->getName() == "slider1")
        {
            //echo"<p>";
            // print_r($values);
            // echo "</p>";

            $slider1 = intval($values);
        }
        else if($values->getName() == "slider2")
        {
            // echo"<p>";
            // print_r($values);
            // echo "</p>";
            $slider2 = intval($values);
        }
        else if($values->getName() == "poem")
        {
            // echo"<p>";
            // print_r($values);
            // echo "</p>";

            $poem = intval($values);
        }
        else if($values->getName() == "art")
        {
            //echo"<p>";
            //print_r($values);
            //echo "</p>";

            $art = intval($values);
        }
    }
}

function scoring()
{
    Global $resilience;

    //echo "scoreHands";
    scoreHands();
    //echo "<p>Resilience: $resilience</p>";

    //echo "scoreTug";
    scoreTug();
    //echo "<p>Resilience: $resilience</p>";

    //echo "scoreSurfing";
    scoreSurfing();
    //echo "<p>Resilience: $resilience</p>";

    //echo "scoreSelection";
    scoreSelection();
    //echo "<p>Resilience: $resilience</p>";

    //echo "scorePlaces";
    scorePlaces();
    // echo "<p>Resilience: $resilience</p>";

    // echo "scoreSlider1";
    scoreSlider1();
    //echo "<p>Resilience: $resilience</p>";

    //echo "scoreSlider2";
    scoreSlider2();
    //echo "<p>Resilience: $resilience</p>";

    //echo "scorePoem";
    scorePoem();
    // echo "<p>Resilience: $resilience</p>";

    //echo "scoreArt";
    scoreArt();
    //echo "<p>Resilience: $resilience</p>";
}


function scoreHands()
{
    Global $hands, $resilience, $ISOquery;
    foreach($hands as $hand)
        if($hand == "n")
        {
            $resilience +=1;
            $ISOquery .= ", 0";
        }
        else if($hand == "s")
        {
            $resilience +=3;
            $ISOquery .= ", 1";
        }
        else if($hand == "y")
        {
            $resilience +=5;
            $ISOquery .= ", 2";
        }
        else
        {
            echo "<p>ERROR</p>";
        }
}

function scoreTug()
{
    Global $tug, $resilience, $ISOquery;
    foreach($tug as $t)
    {
        if($t <= 33)
        {
            $resilience +=1;
        }
        else if($t <= 66)
        {
            $resilience +=3;
        }
        else if($t <= 100)
        {
            $resilience +=5;
        }
        else
        {
            echo "<p>ERROR</p>";
        }

        if($t <= 20)
        {
            $ISOquery .= ", 0";
        }
        else if($t <= 40)
        {
            $ISOquery .= ", 1";
        }
        else if($t <= 60)
        {
            $ISOquery .= ", 2";
        }
        else if($t <= 80)
        {
            $ISOquery .= ", 3";
        }
        else if($t <= 100)
        {
            $ISOquery .= ", 4";
        }
        else
        {
            echo "<p>ERROR</p>";
        }
    }
}


function scoreSurfing()
{
    Global $surfing, $surfingMulti, $resilience, $ISOquery;

    if($surfing == "true")
    {
        $resilience += 3;
        $ISOquery .= ", 1";
    }
    else
    {
        $ISOquery .= ", 0";
    }
    foreach($surfingMulti as $surf)
    {
        if($surf == "true")
        {
            $resilience += 3;
            $ISOquery .= ", 1";
        }
        else
        {
            $ISOquery .= ", 0";
        }
    }
}

function scoreSelection()
{
    Global $laugh, $pleasure, $multi3, $multi4, $multi5, $resilience, $ISOquery;

    if($laugh == "true")
    {
        $resilience += 3;
        $ISOquery .= ", 1";
    }
    else
    {
        $ISOquery .= ", 0";
    }
    if($pleasure == "false")
    {
        $resilience += 3;
        $ISOquery .= ", 1";
    }
    else
    {
        $ISOquery .= ", 0";
    }
    foreach($multi3 as $mult)
    {
        if($mult == "true")
        {
            $resilience -= 3;
            $ISOquery .= ", 1";
        }
        else
        {
            $ISOquery .= ", 0";
        }
    }
    if($multi4 == 1)
    {
        $resilience += 5;
        $ISOquery .= ", 1, 0, 0, 0";
    }
    else if($multi4 == 2)
    {
        $resilience += 3;
        $ISOquery .= ", 0, 1, 0, 0";
    }
    else if($multi4 == 3)
    {
        $resilience += 1;
        $ISOquery .= ", 0, 0, 1, 0";
    }
    else if($multi4 == 4)
    {
        $resilience += 0;
        $ISOquery .= ", 0, 0, 0, 1";
    }

    if($multi5 == 1)
    {
        $resilience += 0;
        $ISOquery .= ", 1, 0, 0, 0, 0";
    }
    else if($multi5 == 2)
    {
        $resilience += 1;
        $ISOquery .= ", 0, 1, 0, 0, 0";
    }
    else if($multi5 == 3)
    {
        $resilience += 2;
        $ISOquery .= ", 0, 0, 1, 0, 0";
    }
    else if($multi5 == 4)
    {
        $resilience += 3;
        $ISOquery .= ", 0, 0, 0, 1, 0";
    }
    else if($multi5 == 5)
    {
        $resilience += 4;
        $ISOquery .= ", 0, 0, 0, 0, 1";
    }
}

function scorePlaces()
{
    Global $places, $resilience, $ISOquery;
    if($places[0] == "lifeguard")
    {
        $resilience += 3;
        $ISOquery .= ", 1, 0";
    }
    else if($places[0] == "pier")
    {
        $resilience += 1;
        $ISOquery .= ", 0, 1";
    }

    if($places[1] == "true")
    {
        $resilience += 0;
        $ISOquery .= ", 1";
    }
    else if($places[1] == "false")
    {
        $resilience += 3;
        $ISOquery .= ", 0";
    }

    if($places[2] == "true")
    {
        $resilience += 0;
        $ISOquery .= ", 1";
    }
    else if($places[2] == "false")
    {
        $resilience += 3;
        $ISOquery .= ", 0";
    }
}

function scoreSlider1()
{
    Global $slider1, $resilience, $ISOquery;

    if($slider1 <= 33)
    {
        $resilience +=0;
    }
    else if($slider1 <= 66)
    {
        $resilience +=1;
    }
    else if($slider1 <= 100)
    {
        $resilience +=2;
    }
    else
    {
        echo "<p>ERROR</p>";
    }

    if($slider1 <= 20)
    {
        $ISOquery .= ", 0";
    }
    else if($slider1 <= 40)
    {
        $ISOquery .= ", 1";
    }
    else if($slider1 <= 60)
    {
        $ISOquery .= ", 2";
    }
    else if($slider1 <= 80)
    {
        $ISOquery .= ", 3";
    }
    else if($slider1 <= 100)
    {
        $ISOquery .= ", 4";
    }
    else
    {
        echo "<p>ERROR</p>";
    }
}

function scoreSlider2()
{
    Global $slider2, $resilience, $ISOquery;

    if($slider2 <= 33)
    {
        $resilience +=0;
    }
    else if($slider2 <= 66)
    {
        $resilience +=1;
    }
    else if($slider2 <= 100)
    {
        $resilience +=2;
    }
    else
    {
        echo "<p>ERROR</p>";
    }

    if($slider2 <= 20)
    {
        $ISOquery .= ", 0";
    }
    else if($slider2 <= 40)
    {
        $ISOquery .= ", 1";
    }
    else if($slider2 <= 60)
    {
        $ISOquery .= ", 2";
    }
    else if($slider2 <= 80)
    {
        $ISOquery .= ", 3";
    }
    else if($slider2 <= 100)
    {
        $ISOquery .= ", 4";
    }
    else
    {
        echo "<p>ERROR</p>";
    }
}

function scorePoem()
{
    Global $poem, $resilience, $ISOquery;

    if($poem <= 33)
    {
        $resilience +=1;
    }
    else if($poem <= 66)
    {
        $resilience +=3;
    }
    else if($poem <= 100)
    {
        $resilience +=5;
    }
    else
    {
        echo "<p>ERROR</p>";
    }

    if($poem <= 20)
    {
        $ISOquery .= ", 0";
    }
    else if($poem <= 40)
    {
        $ISOquery .= ", 1";
    }
    else if($poem <= 60)
    {
        $ISOquery .= ", 2";
    }
    else if($poem <= 80)
    {
        $ISOquery .= ", 3";
    }
    else if($poem <= 100)
    {
        $ISOquery .= ", 4";
    }
    else
    {
        echo "<p>ERROR</p>";
    }
}

function scoreArt()
{
    Global $art, $resilience, $ISOquery;

    if($art <= 33)
    {
        $resilience +=5;
    }
    else if($art <= 66)
    {
        $resilience +=3;
    }
    else if($art <= 100)
    {
        $resilience +=1;
    }
    else
    {
        echo "<p>ERROR</p>";
    }

    if($art <= 20)
    {
        $ISOquery .= ", 0";
    }
    else if($art <= 40)
    {
        $ISOquery .= ", 1";
    }
    else if($art <= 60)
    {
        $ISOquery .= ", 2";
    }
    else if($art <= 80)
    {
        $ISOquery .= ", 3";
    }
    else if($art <= 100)
    {
        $ISOquery .= ", 4";
    }
    else
    {
        echo "<p>ERROR</p>";
    }
}

function uploadScoring()
{
    Global $resilience, $ID, $link;

    $queryChunk = "$ID, $resilience";

    $query = "INSERT INTO ResilienceScoring VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);
}

function uploadISO()
{
    Global $ISOquery, $link;

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    //echo $ISOquery;
    $query = "INSERT INTO ResilienceISO VALUES (".$ISOquery.");";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
}

function printValues()
{
    Global $hands, $tug, $surfing, $surfingMulti, $laugh, $pleasure, $multi3, $multi4, $multi5, $places, $slider1, $slider2, $poem, $art;


    echo "<h4>HANDS</h4>";
    foreach($hands as $x)
    {
        echo"<p>$x</p>";
    }

    echo "<h4>TUG</h4>";
    foreach($tug as $x)
    {
        echo"<p>$x</p>";
    }

    echo "<h4>SURFING</h4>";
    echo"<p>$surfing</p>";

    foreach($surfingMulti as $x)
    {
        echo"<p>$x</p>";
    }

    echo "<h4>SELECTION</h4>";
    echo"<p>$laugh</p>";

    echo"<p>$pleasure</p>";
    echo "<h4>MULTI3</h4>";

    foreach($multi3 as $x)
    {
        echo"<p>$x</p>";
    }
    echo "<h4>MULTI4</h4>";
    echo"<p>$multi4</p>";

    echo "<h4>MULTI5</h4>";
    echo"<p>$multi5</p>";

    echo "<h4>PLACES</h4>";
    foreach($places as $x)
    {
        echo"<p>$x</p>";
    }


    echo"<p>$slider1</p>";
    echo"<p>$slider2</p>";
    echo"<p>$poem</p>";
    echo"<p>$art</p>";
}

echo "complete";
?>