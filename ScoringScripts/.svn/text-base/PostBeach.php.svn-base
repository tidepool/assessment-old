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
//$ID = "ag65564531bdel";

$hands = array();
$tug = array();
$surfing;
$surfingChng;
$surfingMulti = array();
$laugh;
$pleasure;
$laughChng;
$pleasureChng;
$multi3 = array();
$multi4;
$multi5;
$multi4Chng;
$multi5Chng;
$places = array();
$slider1;
$slider2;
$poem;
$art;
$slider1Chng;
$slider2Chng;
$poemChng;
$artChng;

$resilience = 0;

$ISOquery = "'$ID'";

//$ID = 77;
readValues();
//echo "<h1>RESULTS</h1>";
scoring();
//printValues();
uploadISO();
//uploadScoring();
//uploadChanges();

function readValues()
{
    Global $hands, $tug, $surfing, $surfingMulti, $laugh, $pleasure, $multi3, $multi4, $multi5, $places, $slider1, $slider2, $poem, $art;
    Global $surfingChng, $laughChng, $pleasureChng, $multi4Chng, $multi5Chng, $slider1Chng, $slider2Chng, $poemChng, $artChng;
    Global $xml_array;

    foreach($xml_array as $values)
    {
        if($values->getName() == "hands")
        {
            foreach($values->children() as $value)
            {
                $hands[] = $value;
            }
        }
        else if($values->getName() == "tug")
        {
            foreach($values->children() as $value)
            {
                $tug[] = intval($value);
            }
        }
        else if($values->getName() == "surfing")
        {
            foreach($values->children() as $value)
            {

                if($value->getName() == "surf")
                {
                    $surfing = $value;
                }
                if($value->getName() == "multi")
                {
                    $surfingMulti = $value;
                }

            }
        }
        else if($values->getName() == "selection")
        {
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
                    foreach($value->children() as $v)
                    {
                        $multi3[] = $v;
                    }
                }
                if($value->getName() == "multi4")
                {
                    $multi4 = intval($value);
                }
                if($value->getName() == "multi5")
                {
                    $multi5 = intval($value);
                }
            }
        }
        else if($values->getName() == "places")
        {
            foreach($values->children() as $value)
            {
                $places[] = $value;
            }
        }
        else if($values->getName() == "slider1")
        {
            $slider1 = intval($values);
        }
        else if($values->getName() == "slider2")
        {
            $slider2 = intval($values);
        }
        else if($values->getName() == "poem")
        {
            $poem = intval($values);
        }
        else if($values->getName() == "art")
        {
            $art = intval($values);
        }
        else if($values->getName() == "changes")
        {
            foreach($values as $value)
            {
                if($value->getName() == "picnic")
                {
                    $hands['changes'] = array();
                    foreach($value->children() as $v)
                    {
                        $hands['changes'][] = $v;
                    }
                }
                else if($value->getName() == "tug")
                {
                    $tug['changes'] = array();
                    foreach($value->children() as $v)
                    {
                        $tug['changes'][] = $v;
                    }
                }
                else if($value->getName() == "surfing")
                {
                    foreach($value->children() as $v)
                    {

                        if($v->getName() == "surf")
                        {
                            $surfingChng = $v;
                        }
                        if($v->getName() == "multi")
                        {
                            $surfingMulti['changes'] = $v;
                        }

                    }
                }
                else if($value->getName() == "selection")
                {
                    $multi3['changes'] = array();
                    foreach($value->children() as $v)
                    {

                        if($v->getName() == "laugh")
                        {
                            $laughChng = $v;
                        }
                        if($v->getName() == "pleasure")
                        {
                            $pleasureChng = $v;
                        }
                        if($v->getName() == "multi3")
                        {
                            $multi3['changes'][] = $v;
                        }
                        if($v->getName() == "multi4")
                        {
                            $multi4Chng = $v;
                        }
                        if($v->getName() == "multi5")
                        {
                            $multi5Chng = $v;
                        }
                    }
                }
                else if($value->getName() == "places")
                {
                    $places['changes'] = array();
                    foreach($value->children() as $v)
                    {
                        $places['changes'][] = $v;
                    }
                }
                else if($value->getName() == "slider1")
                {
                    $slider1Chng = $value;
                }
                else if($value->getName() == "slider2")
                {
                    $slider2Chng = $value;
                }
                else if($value->getName() == "poem")
                {
                    $poemChng = $value;
                }
                else if($value->getName() == "art")
                {
                    $artChng = $value;
                }
            }
        }
    }
}

function scoring()
{
    Global $resilience, $ISOquery;

    //echo "scoreHands";
    scoreHands();
    //echo "<p>Resilience: $resilience</p>";
    //echo "<p>ISOquery: $ISOquery</p>";

    //echo "scoreTug";
    scoreTug();
    //echo "<p>Resilience: $resilience</p>";
    //echo "<p>ISOquery: $ISOquery</p>";

    //echo "scoreSurfing";
    scoreSurfing();
    //echo "<p>Resilience: $resilience</p>";
    //echo "<p>ISOquery: $ISOquery</p>";

    //echo "scoreSelection";
    scoreSelection();
    //echo "<p>Resilience: $resilience</p>";
    //echo "<p>ISOquery: $ISOquery</p>";

    //echo "scorePlaces";
    scorePlaces();
    // echo "<p>Resilience: $resilience</p>";
    //echo "<p>ISOquery: $ISOquery</p>";

    // echo "scoreSlider1";
    scoreSlider1();
    //echo "<p>Resilience: $resilience</p>";
    //echo "<p>ISOquery: $ISOquery</p>";

    //echo "scoreSlider2";
    scoreSlider2();
    //echo "<p>Resilience: $resilience</p>";
    //echo "<p>ISOquery: $ISOquery</p>";

    //echo "scorePoem";
    scorePoem();
    // echo "<p>Resilience: $resilience</p>";
    //echo "<p>ISOquery: $ISOquery</p>";

    //echo "scoreArt";
    scoreArt();
    //echo "<p>Resilience: $resilience</p>";
    //echo "<p>ISOquery: $ISOquery</p>";
}


function scoreHands()
{
    Global $hands, $resilience, $ISOquery;
    foreach($hands as $hand)
    {
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
            //echo "<p>ERROR: $hand</p>";
        }
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
            // echo "<p>ERROR: $t</p>";
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
            // echo "<p>ERROR: $t</p>";
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
    //print_r($surfingMulti);
    foreach($surfingMulti as $surf)
    {
        if($surf == "true")
        {
            $resilience += 3;
            $ISOquery .= ", 1";
        }
        else if($surf == "false")
        {
            $ISOquery .= ", 0";
        }
        else
        {
            //echo "<p>ERROR: $surf</p>";
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
        else if($mult == "false")
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
        $ISOquery .= ", 1";
    }
    else if($places[0] == "pier")
    {
        $resilience += 1;
        $ISOquery .= ", 0";
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
        //echo "<p>ERROR</p>";
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
        //echo "<p>ERROR</p>";
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
        // echo "<p>ERROR</p>";
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
        // echo "<p>ERROR</p>";
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
        //echo "<p>ERROR</p>";
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
        //echo "<p>ERROR</p>";
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
        //echo "<p>ERROR</p>";
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
        //echo "<p>ERROR</p>";
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
    Global $ISOquery, $ID;
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
        $query = "INSERT INTO Timing VALUES ('$ID', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$date','','','');";
    }
    else
    {
        $query = "UPDATE Timing SET Beach='$date' where ID='$ID';";
    }
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    //echo $ISOquery;
    $query = "INSERT INTO ResilienceISO VALUES (".$ISOquery.");";
    $result = mysql_query($query) or die('Item Query failed: ' . mysql_error());
    mysql_free_result($result);
    uploadScoring();
}
function uploadScoring()
{
    Global $resilience, $ID;

    $queryChunk = "'$ID', $resilience";

    $query = "INSERT INTO ResilienceScoring VALUES (".$queryChunk.");";
    $result = mysql_query($query) or die('Scoring Query failed: ' . mysql_error());
    mysql_free_result($result);

    uploadChanges();
}

function uploadChanges()
{
    Global $ID;
    Global $hands, $tug, $surfing, $surfingMulti, $laugh, $pleasure, $multi3, $multi4, $multi5, $places, $slider1, $slider2, $poem, $art;
    Global $surfingChng, $laughChng, $pleasureChng, $multi4Chng, $multi5Chng, $slider1Chng, $slider2Chng, $poemChng, $artChng;

    $queryChunk = "'$ID'";

    foreach($hands['changes'] as $change)
    {
        $queryChunk .= ",$change";
    }
    //echo "<p>$queryChunk<p>";
    foreach($tug['changes'] as $change)
    {
        $queryChunk .= ",'$change'";
    }
    //echo "<p>$queryChunk<p>";
    $queryChunk .= ",$surfingChng,'".$surfingMulti['changes']."',$laughChng,$pleasureChng";
    //echo "<p>$queryChunk<p>";
    foreach($multi3['changes'] as $change)
    {
        $queryChunk .= ",'$change'";
    }
    //echo "<p>$queryChunk<p>";
    $queryChunk .= ",$multi4Chng,$multi5Chng";
    //echo "<p>$queryChunk<p>";
    //echo "<p>".print_r($places)."</p>";
    $queryChunk .= ",".$places['changes'][0].",".$places['changes'][1].",'".$places['changes'][2]."'";

    //echo "<p>$queryChunk<p>";
    $queryChunk .= ",'$slider1Chng','$slider2Chng','$poemChng','$artChng'";

    //echo "<p>$queryChunk<p>";

    $query = "INSERT INTO ResilienceChanges VALUES (".$queryChunk.");";
    //echo "<p>$query<p>";
    $result = mysql_query($query) or die('Changes Query failed: ' . mysql_error());
    mysql_free_result($result);

    endConnection();
}

function printValues()
{
    Global $hands, $tug, $surfing, $surfingMulti, $laugh, $pleasure, $multi3, $multi4, $multi5, $places, $slider1, $slider2, $poem, $art;


    //echo "<h4>HANDS</h4>";
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