<?php
function getCalculations()
{
    Global $path1, $path2, $foxtrot, $questions;
    Global $times, $fields;
    Global $path1taken, $path2taken, $path1comp, $path2comp, $totalTaken, $totalComp, $sharing;

    $path1 = 0;
    $path2 = 0;
    $foxtrot = 0;
    $questions = 0;
    $sharing = array();

    $fields = array();
    $fields[] = "PenHolders";
    $fields[] = "IM1";
    $fields[] = "Violin";
    $fields[] = "IM2";
    $fields[] = "Balloon";
    $fields[] = "IM3";
    $fields[] = "IM4";
    $fields[] = "Clouds";
    $fields[] = "Pathway";
    $fields[] = "IM5";
    $fields[] = "Frames";
    $fields[] = "IM6";
    $fields[] = "Space";
    $fields[] = "Dark";
    $fields[] = "IM7";
    $fields[] = "Beach";
    $fields[] = "Feedback";
    $fields[] = "Personality";
    $fields[] = "Interest";

    $times = array();
    foreach($fields as $field)
    {
        $times[$field] = array();
    }

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
        or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');


    $query = "SELECT Count(*) FROM Harris WHERE Path=1 AND ID LIKE '2Harris%';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $path1taken = mysql_result($result, 0);
    mysql_free_result($result);

    $query = "SELECT Count(*) FROM Harris WHERE Path=1 AND Completed=1 AND ID LIKE '2Harris%';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $path1comp = mysql_result($result, 0);
    mysql_free_result($result);

    $query = "SELECT Count(*) FROM Harris WHERE Path=2 AND ID LIKE '2Harris%';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $path2taken = mysql_result($result, 0);
    mysql_free_result($result);

    $query = "SELECT Count(*) FROM Harris WHERE Path=2 AND Completed=1 AND ID LIKE '2Harris%';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $path2comp = mysql_result($result, 0);
    mysql_free_result($result);

    $totalTaken = $path1taken+$path2taken;
    $totalComp = $path1comp+$path2comp;

    foreach($fields as $field)
    {
        $query = "SELECT $field FROM Timing WHERE ID LIKE '2Harris%';";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            foreach ($line as $col_value)
            {
                timeToInt($col_value, $field);
            }
        }
    }
    mysql_free_result($result);

    $avgChunk = "AVG(FacebookResults), AVG(LinkedInResults), AVG(TwitterResults), AVG(FacebookTest), AVG(LinkedInTest), AVG(TwitterTest)";
    $query = "SELECT $avgChunk FROM SocialSharing WHERE ID LIKE '2Harris%';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        foreach ($line as $col_value)
        {
            $sharing[] = $col_value;
        }
    }
    mysql_free_result($result);
    mysql_close($link);
    //print_r($fields);
    //print_r($times);
}

function timeToInt($str, $field)
{
    Global $times;
    $seconds = 0;
    //echo "<p>$str $count</p>";
    $array = explode(":",$str);
    if(count($array) != 3)
        return null;
    else
    {
        $seconds += intval($array[2]);
        $seconds += intval($array[1]) * 60;
        $seconds += intval($array[0]) * 3600;
        $times[$field][] = $seconds;
    }
}

function calculatePathTotal($str, $field)
{
    Global $path1, $path2, $foxtrot, $questions;

    if($field == "PenHolders")
    {
        $path1 += $str;
    }
    else if($field == "Violin")
    {
        $path1 += $str;
    }
    else if($field == "Space")
    {
        $path1 += $str;
        $path2 += $str;
    }
    else if($field == "Clouds")
    {
        $path1 += $str;
        $path2 += $str;
        $foxtrot += $str;
    }
    else if($field == "Frames")
    {
        $path1 += $str;
        $path2 += $str;
        $foxtrot += $str;
    }
    else if($field == "Beach")
    {
        $path1 += $str;
    }
    else if($field == "IM1")
    {
        $path2 += $str;
    }
    else if($field == "Pathway")
    {
        $path2 += $str;
    }
    else if($field == "IM2")
    {
        $path2 += $str;
    }
    else if($field == "Dark")
    {
        $path2 += $str;
    }
    else if($field == "IM3")
    {
        $path2 += $str;
    }
    else if($field == "IM4")
    {
        $path2 += $str;
    }
    else if($field == "IM5")
    {
        $path2 += $str;
    }
    else if($field == "Frames")
    {
        $path2 += $str;
    }
    else if($field == "IM6")
    {
        $path2 += $str;
    }
    else if($field == "IM7")
    {
        $path2 += $str;
    }
    else if($field == "Feedback")
    {
        $questions += $str;
    }
    else if($field == "Personality")
    {
        $questions += $str;
    }
    else if($field == "Interest")
    {
        $questions += $str;
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

?>