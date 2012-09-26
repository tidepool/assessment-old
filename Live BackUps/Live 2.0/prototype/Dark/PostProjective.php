<?php
echo "<html>";
echo "<title>Projective Post</title>";
//echo "<h1>TEST</h1>";
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
$link;

$ISOQuery = "$ID";
$pictureSelection = array();
$response = array();
$ordering = array();
$orderingISO = array();
$movie;
$sliders = array();

$whole = 0;
$detail = 0;
$negative = 0;
$movement = 0;
$color = 0;
$achromatic = 0;
$shading = 0;
$texture = 0;
$reflection = 0;
$smiley;
$sliderScoring = array();
foreach($xml_array as $values)
{
    if($values->getName() == "pictureSelection")
    {
        //echo "<p>";
        //print_r($values);
        //echo "</p>";

        $pictureSelection['moon'] = intval($values->moon);
        $pictureSelection['sun'] = intval($values->sun);
        $pictureSelection['flower'] = intval($values->flower);
        $pictureSelection['castle'] = intval($values->castle);
        $pictureSelection['face'] = intval($values->face);
    }
    if($values->getName() == "response")
    {
        //echo "<p>";
        //print_r($values);
        //echo "</p>";

        $response['moon'] = $values->moon;
        $response['sun'] = $values->sun;
        $response['flower'] = $values->flower;
        $response['castle'] = $values->castle;
        $response['face'] = $values->face;
    }
    if($values->getName() == "ordering")
    {
       // echo "<p>";
        //print_r($values);
        //echo "</p>";

        $ordering[0] = $values->choice1;
        $ordering[1] = $values->choice2;
        $ordering[2] = $values->choice3;
        $ordering[3] = $values->choice4;
        $ordering[4] = $values->choice5;
    }
    if($values->getName() == "movie")
    {
        //echo "<p>";
        //print_r($values);
        //echo "</p>";

        $movie = $values[0];
    }
    if($values->getName() == "sliders")
    {
        //echo "<p>";
        //print_r($values);
        //echo "</p>";

        $sliders[0] = $values->num0;
        $sliders[1] = $values->num1;
        $sliders[2] = $values->num2;
        $sliders[3] = $values->num3;
        $sliders[4] = $values->num4;
    }
}
scoring();
UploadISO();
function scoring()
{
scorePictureSelection();
scoreResponse();
scoreOrdering();
scoreMovie();
scoreSliders();
}

function UploadISO()
{

    Global $link, $ISOQuery;

    $sliders = array();
    $link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    //echo $ISOQuery;
    $query = "INSERT INTO ProjectiveISO VALUES ($ISOQuery);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    UploadScoring();
}

function UploadScoring()
{

    Global $ID, $link,$whole, $detail, $negative, $movement, $color, $achromatic, $shading, $texture, $reflection, $smiley, $sliderScoring;

    $query = "$ID, $whole, $detail, $negative, $movement, $color, $achromatic, $shading, $texture, $reflection, '$smiley'";
    foreach($sliderScoring as $s)
    {
        $query .= ",$s";
    }

    //echo $query;
    $query = "INSERT INTO ProjectiveScoring VALUES ($query);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    mysql_close($link);
}

function scorePictureSelection()
{
    Global $pictureSelection, $ISOQuery, $whole, $detail, $negative, $movement, $color, $achromatic, $shading, $texture, $reflection, $smiley;

    for($i=0;$i<6;$i++)
    {
        $temp = $i+1;
        if($pictureSelection['moon'] == $temp)
        {
            $ISOQuery .= ", 1";
            if($temp == 1)
            {
                $detail++;
                $achromatic++;
                $shading++;
                $negative++;
            }
            else if($temp == 2)
            {
                $whole++;
                $achromatic++;
                $texture++;
            }
            else if($temp == 3)
            {
                $whole++;
                $color++;
            }
            else if($temp == 4)
            {
                $movement++;
                $shading++;
                $achromatic++;
                $negative++;
            }
            else if($temp == 5)
            {
                $detail++;
                $color++;
                $texture++;
            }
            else if($temp == 6)
            {
                $reflection++;
                $color++;
                $movement++;
                $whole++;
            }
        }
        else
        {
            $ISOQuery .= ", 0";
        }
    }

    for($i=0;$i<6;$i++)
    {
        $temp = $i+1;
        if($pictureSelection['sun'] == $temp)
        {
            $ISOQuery .= ", 1";
            if($temp == 1)
            {
                $whole++;
                $negative++;
                $achromatic++;
            }
            else if($temp == 2)
            {
                $whole++;
                $movement++;
                $color++;
                $shading++;
            }
            else if($temp == 3)
            {
                $reflection++;
                $whole++;
                $color++;
            }
            else if($temp == 4)
            {
                $whole++;
                $shading++;
                $color++;
            }
            else if($temp == 5)
            {
                $detail++;
                $color++;
                $texture++;
            }
            else if($temp == 6)
            {
                $shading++;
                $color++;
                $detail++;
                $negative++;
            }
        }
        else
        {
            $ISOQuery .= ", 0";
        }
    }

    for($i=0;$i<6;$i++)
    {
        $temp = $i+1;
        if($pictureSelection['flower'] == $temp)
        {
            $ISOQuery .= ", 1";
            if($temp == 1)
            {
                $whole++;
                $reflection++;
                $color++;
                $texture++;
            }
            else if($temp == 2)
            {
                $detail++;
                $movement++;
                $color++;
                $shading++;
            }
            else if($temp == 3)
            {
                $detail++;
                $color++;
            }
            else if($temp == 4)
            {
                $whole++;
                $achromatic++;
                $negative++;
            }
            else if($temp == 5)
            {
                $achromatic++;
                $whole++;
                $texture++;
            }
            else if($temp == 6)
            {
                $color++;
                $detail++;
                $texture++;
            }
        }
        else
        {
            $ISOQuery .= ", 0";
        }
    }

    for($i=0;$i<6;$i++)
    {
      $temp = $i+1;
        if($pictureSelection['castle'] == $temp)
        {
            $ISOQuery .= ", 1";
            if($temp == 1)
            {
                $detail++;
                $color++;
                $texture++;
            }
            else if($temp == 2)
            {
                $whole++;
                $negative++;
                $achromatic++;
            }
            else if($temp == 3)
            {
                $whole++;
                $color++;
                $shading++;
                $movement++;
            }
            else if($temp == 4)
            {
                $whole++;
                $reflection++;
                $color++;
            }
            else if($temp == 5)
            {
                $achromatic++;
                $shading++;
                $texture++;
                $detail++;
            }
            else if($temp == 6)
            {
                $color++;
                $whole++;
                $texture++;
            }
        }
        else
        {
            $ISOQuery .= ", 0";
        }
    }

    for($i=0;$i<6;$i++)
    {
        $temp = $i+1;
        if($pictureSelection['face'] == $temp)
        {
            $ISOQuery .= ", 1";
            if($temp == 1)
            {
                $smiley = "sad";
            }
            else if($temp == 2)
            {
                $smiley = "happy";
            }
            else if($temp == 3)
            {
                $smiley = "shame";
            }
            else if($temp == 4)
            {
                $smiley = "numb";
            }
            else if($temp == 5)
            {
                $smiley = "angry";
            }
            else if($temp == 6)
            {
                $smiley = "afraid";
            }
        }
        else
        {
            $ISOQuery .= ", 0";
        }
    }
}

function scoreResponse()
{
    Global $ISOQuery, $response;

    if($response['moon'] == "Low Creativity")
    {
        $ISOQuery .=",1, 0, 0, ";
    }
    else if($response['moon'] == "Moderate Creativity")
    {
        $ISOQuery .=",0, 1, 0, ";
    }
    else if($response['moon'] == "Highly Creative")
    {
        $ISOQuery .=",0, 0, 1, ";
    }
    else
    {
        //echo "<h2>ERROR MOON</h2>";
    }

    if($response['sun'] == "Low Assertiveness")
    {
        $ISOQuery .="1, 0, 0, ";
    }
    else if($response['sun'] == "Moderate Assertiveness")
    {
        $ISOQuery .="0, 1, 0, ";
    }
    else if($response['sun'] == "Highly Assertive")
    {
        $ISOQuery .="0, 0, 1, ";
    }
    else
    {
        //echo "<h2>ERROR SUN</h2>";
    }

    if($response['flower'] == "Negative Mood")
    {
        $ISOQuery .="1, 0, 0, ";
    }
    else if($response['flower'] == "Numb")
    {
        $ISOQuery .="0, 1, 0, ";
    }
    else if($response['flower'] == "Positive Mood")
    {
        $ISOQuery .="0, 0, 1, ";
    }
    else
    {
        //echo "<h2>ERROR FLOWER</h2>";
    }


    if($response['castle'] == "A Thinker")
    {
        $ISOQuery .="1, 0, 0, ";
    }
    else if($response['castle'] == "A Doer")
    {
        $ISOQuery .="0, 1, 0, ";
    }
    else if($response['castle'] == "A Feeler")
    {
        $ISOQuery .="0, 0, 1, ";
    }
    else
    {
        //echo "<h2>ERROR CASTLE</h2>";
    }

    if($response['face'] == "Emotionally Expressive")
    {
        $ISOQuery .="1, 0, 0, ";
    }
    else if($response['face'] == "Unaware of Emotion")
    {
        $ISOQuery .="0, 1, 0, ";
    }
    else if($response['face'] == "Emotionally Reserved")
    {
        $ISOQuery .="0, 0, 1, ";
    }
    else
    {
        //echo "<h2>ERROR FACE</h2>";
    }
}

function scoreOrdering()
{
    Global $ordering, $orderingISO, $ISOQuery;


    GetOrderingType($ordering[0], 4);
    GetOrderingType($ordering[1], 3);
    GetOrderingType($ordering[2], 2);
    GetOrderingType($ordering[3], 1);
    GetOrderingType($ordering[4], 0);

    $ISOQuery .= "".$orderingISO['moon'].", ".$orderingISO['sun'].", ".$orderingISO['flower'].", ".$orderingISO['castle'].", ".$orderingISO['face'];
}

function scoreMovie()
{
    Global $ISOQuery, $movie;

    $value = -1;
    if($movie=="Comedy")
    {
        $value = 0;
    }
    else if($movie=="Drama")
    {
        $value = 1;
    }
    else if($movie=="Action")
    {
        $value = 2;
    }
    else if($movie=="Documentary")
    {
        $value = 3;
    }
    else if($movie=="Romance")
    {
        $value = 4;
    }
    else if($movie=="Sci Fi/Fantasy")
    {
        $value = 5;
    }
    else if($movie=="Horror")
    {
        $value = 6;
    }
    else
    {
        //echo "<h2>ERROR MOVIE</h2>";
    }

    for($i=0;$i<7;$i++)
    {
        if($value == $i)
        {
            $ISOQuery .= ", 1";
        }
        else
        {
            $ISOQuery .= ", 0";
        }
    }
}

function scoreSliders()
{
    Global $sliders, $ISOQuery, $sliderScoring;

    for($i=0;$i<5;$i++)
    {
        $temp = GetSliderScoring($sliders[$i]);
        $ISOQuery .= ", ".$temp;
        $sliderScoring[] = $sliders[$i];
    }
}

function GetSliderScoring($value)
{
    if($value <= 13)
    {
        $value = 0;
    }
    else if($value <= 25)
    {
        $value = 1;
    }
    else if($value <= 38)
    {
        $value = 2;
    }
    else if($value <= 50)
    {
        $value = 3;
    }
    else if($value <= 63)
    {
        $value = 4;
    }
    else if($value <= 75)
    {
        $value = 5;
    }
    else if($value <= 88)
    {
        $value = 6;
    }
    else if($value <= 100)
    {
        $value = 7;
    }
    else
    {
        //echo "<h2>ERROR</h2>";
    }
    return $value;
}

function GetOrderingType($name, $value)
{
    Global $orderingISO;

    if($name=="moon")
    {
        $orderingISO['moon'] = $value;
    }
    else if($name=="sun")
    {
        $orderingISO['sun'] = $value;
    }
    else if($name=="flower")
    {
        $orderingISO['flower'] = $value;
    }
    else if($name=="castle")
    {
        $orderingISO['castle'] = $value;
    }
    else if($name=="face")
    {
        $orderingISO['face'] = $value;
    }
    else
    {
        //echo "<h2>ERROR</h2>";
    }
}

echo "<h1> </h1>";
echo "<script language=\"JavaScript\">";
echo "document.body.innerHTML += '<form id=\"form\" action=\"http://tidepool.co/assessment/prototype/IM7/IM7.php\" method=\"post\"><input type=\"hidden\" name=\"ID\" value=\"$ID\"/><input type=\"hidden\" name=\"password\" value=\"d3mo\"/>';";
echo "document.getElementById(\"form\").submit();";
echo "</script>";
echo "</body>";
echo "</html>";
?>