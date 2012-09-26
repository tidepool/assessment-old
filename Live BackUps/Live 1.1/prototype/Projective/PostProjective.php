<?php
echo "<html>";
echo "<title>Personality Post</title>";
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
//print_r($xml_array);

$pictureSelection = array();
$response = array();
$ordering = array();
$orderingISO = array();
$movie;
$sliders = array();

foreach($xml_array as $values)
{
    if($values->getName() == "pictureSelection")
    {
        //echo "<p>";
        //print_r($values);
        //echo "</p>";

        $pictureSelection['moon'] = $values->moon;
        $pictureSelection['sun'] = $values->sun;
        $pictureSelection['flower'] = $values->flower;
        $pictureSelection['castle'] = $values->castle;
        $pictureSelection['face'] = $values->face;
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

UploadISO();

function UploadISO()
{

    Global $ID, $pictureSelection, $response, $ordering, $movie;

    $sliders = array();
    $link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $queryChunk = "$ID";
    $queryChunk .= GetQueryForPictureSelection();
    $queryChunk .= GetQueryForResponse();
    $queryChunk .= GetQueryForOrdering();
    $queryChunk .= GetQueryForMovie();
    $queryChunk .= GetQueryForSliders();
    //echo $queryChunk;


    $query = "INSERT INTO ProjectiveISO VALUES ($queryChunk);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    mysql_free_result($result);
    mysql_close($link);
}

function GetQueryForPictureSelection()
{
    Global $pictureSelection;

    $queryChunk = "";
    for($i=0;$i<6;$i++)
    {
        if($pictureSelection['moon'] == $i+1)
        {
            $queryChunk .= ", 1";
        }
        else
        {
            $queryChunk .= ", 0";
        }
    }

    for($i=0;$i<6;$i++)
    {
        if($pictureSelection['sun'] == $i+1)
        {
            $queryChunk .= ", 1";
        }
        else
        {
            $queryChunk .= ", 0";
        }
    }

    for($i=0;$i<6;$i++)
    {
        if($pictureSelection['flower'] == $i+1)
        {
            $queryChunk .= ", 1";
        }
        else
        {
            $queryChunk .= ", 0";
        }
    }

    for($i=0;$i<6;$i++)
    {
        if($pictureSelection['castle'] == $i+1)
        {
            $queryChunk .= ", 1";
        }
        else
        {
            $queryChunk .= ", 0";
        }
    }

    for($i=0;$i<6;$i++)
    {
        if($pictureSelection['face'] == $i+1)
        {
            $queryChunk .= ", 1";
        }
        else
        {
            $queryChunk .= ", 0";
        }
    }

    //echo "<p>Selection: $queryChunk</p>";
    return $queryChunk;
}

function GetQueryForOrdering()
{
    Global $ordering, $orderingISO;


    GetOrderingType($ordering[0], 4);
    GetOrderingType($ordering[1], 3);
    GetOrderingType($ordering[2], 2);
    GetOrderingType($ordering[3], 1);
    GetOrderingType($ordering[4], 0);

    $queryChunk = "".$orderingISO['moon'].", ".$orderingISO['sun'].", ".$orderingISO['flower'].", ".$orderingISO['castle'].", ".$orderingISO['face'];
    //echo "<p>Ordering: $queryChunk</p>";
    return $queryChunk;
}

function GetQueryForSliders()
{
    Global $sliders;

    $queryChunk = "";
    for($i=0;$i<5;$i++)
    {
        $temp = GetSliderScoring($sliders[$i]);
        $queryChunk .= ", ".$temp;
    }

    //echo "<p>Sliders: $queryChunk</p>";
    return $queryChunk;
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

function GetQueryForMovie()
{
    Global $orderingISO,$movie;

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

    $queryChunk = "";

    for($i=0;$i<7;$i++)
    {
        if($value == $i)
        {
            $queryChunk .= ", 1";
        }
        else
        {
            $queryChunk .= ", 0";
        }
    }

    //echo "<p>Response: $queryChunk</p>";
    return $queryChunk;
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

function GetQueryForResponse()
{
    Global $pictureSelection, $response;

    $queryChunk = ", ";

    if($response['moon'] == "Low Creativity")
    {
        $queryChunk .="1, 0, 0, ";
    }
    else if($response['moon'] == "Moderate Creativity")
    {
        $queryChunk .="0, 1, 0, ";
    }
    else if($response['moon'] == "Highly Creative")
    {
        $queryChunk .="0, 0, 1, ";
    }
    else
    {
        //echo "<h2>ERROR MOON</h2>";
    }

    if($response['sun'] == "Low Assertiveness")
    {
        $queryChunk .="1, 0, 0, ";
    }
    else if($response['sun'] == "Moderate Assertiveness")
    {
        $queryChunk .="0, 1, 0, ";
    }
    else if($response['sun'] == "Highly Assertive")
    {
        $queryChunk .="0, 0, 1, ";
    }
    else
    {
        //echo "<h2>ERROR SUN</h2>";
    }

    if($response['flower'] == "Negative Mood")
    {
        $queryChunk .="1, 0, 0, ";
    }
    else if($response['flower'] == "Numb")
    {
        $queryChunk .="0, 1, 0, ";
    }
    else if($response['flower'] == "Positive Mood")
    {
        $queryChunk .="0, 0, 1, ";
    }
    else
    {
        //echo "<h2>ERROR FLOWER</h2>";
    }


    if($response['castle'] == "A Thinker")
    {
        $queryChunk .="1, 0, 0, ";
    }
    else if($response['castle'] == "A Doer")
    {
        $queryChunk .="0, 1, 0, ";
    }
    else if($response['castle'] == "A Feeler")
    {
        $queryChunk .="0, 0, 1, ";
    }
    else
    {
        //echo "<h2>ERROR CASTLE</h2>";
    }

    if($response['face'] == "Emotionally Expressive")
    {
        $queryChunk .="1, 0, 0, ";
    }
    else if($response['face'] == "Unaware of Emotion")
    {
        $queryChunk .="0, 1, 0, ";
    }
    else if($response['face'] == "Emotionally Reserved")
    {
        $queryChunk .="0, 0, 1, ";
    }
    else
    {
        //echo "<h2>ERROR FACE</h2>";
    }

    //echo "<p>Response: $queryChunk</p>";
    return $queryChunk;
}

/*
	$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
	or die('Could not connect: ' . mysql_error());
	mysql_select_db('tidepool') or die('Could not select database');


mysql_close($link);
*/


echo "<h1> </h1>";
echo "<script language=\"JavaScript\">";
echo "document.body.innerHTML += '<form id=\"form\" action=\"http://tidepool.co/Live/IM7/IM7.php\" method=\"post\"><input type=\"hidden\" name=\"ID\" value=\"$ID\"/><input type=\"hidden\" name=\"password\" value=\"d3mo\"/>';";
echo "document.getElementById(\"form\").submit();";
echo "</script>";
echo "</body>";
echo "</html>";
?>