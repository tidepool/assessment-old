<?php
if($_POST['password'] == "R3sults")
{
    $path1 = 0;
    $path2 = 0;
    $foxtrot = 0;
    $questions = 0;

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


    $query = "SELECT Count(*) FROM Harris WHERE Path=1;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $path1taken = mysql_result($result, 0);
    mysql_free_result($result);

    $query = "SELECT Count(*) FROM Harris WHERE Path=1 AND Completed=1;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $path1comp = mysql_result($result, 0);
    mysql_free_result($result);

    $query = "SELECT Count(*) FROM Harris WHERE Path=2;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $path2taken = mysql_result($result, 0);
    mysql_free_result($result);

    $query = "SELECT Count(*) FROM Harris WHERE Path=2 AND Completed=1;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $path2comp = mysql_result($result, 0);
    mysql_free_result($result);

    $totalTaken = $path1taken+$path2taken;
    $totalComp = $path1comp+$path2comp;

    foreach($fields as $field)
    {
        $query = "SELECT $field FROM Timing WHERE ID LIKE 'Harris%';";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        $answer = mysql_result($result, 0);
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
        {
            foreach ($line as $col_value)
            {
                timeToInt($col_value, $field);
            }
        }
    }
    mysql_free_result($result);
    mysql_close($link);
    ?>

<h1>Harris Results</h1>
<table border="2px">
    <tr>
        <th>Total Taken</th> <th>Total Completed</th> <th>Path 1 Taken</th> <th>Path 1 Completed</th> <th>Path 2 Taken</th> <th>Path 2 Completed</th>
    </tr>
    <tr>
        <?
        echo  "<td>$totalTaken</td><td>$totalComp</td><td>$path1taken</td><td>$path1comp</td><td>$path2taken</td><td>$path2comp</td>";
        ?>
    </tr>
</table>
<br>
<h1>Average Times</h1>
<table border="2px">
    <tr>
        <th>PenHolders</th> <th>IM1</th> <th>Violin</th> <th>IM2</th> <th>Balloon</th> <th>IM3</th> <th>IM4</th> <th>Clouds</th> <th>Pathway</th> <th>IM5</th> <th>Frames</th> <th>IM6</th> <th>Space</th> <th>Dark</th> <th>IM7</th> <th>Beach</th> <th>Feedback</th> <th>Personality</th> <th>Interest</th>
    </tr>
    <tr>
        <?
            $fieldNumber = 0;
        foreach($times as $time)
        {
            $total = 0;
            $count = 0;
            foreach($time as $t)
            {
                $total+=$t;
                $count++;
            }
            $avg = formatDate($total/$count);
            calculatePathTotal($total/$count,$fields[$fieldNumber]);
            echo "<td>$avg</td>";
            $fieldNumber++;
        }
        //print_r($times);
        ?>
    </tr>
</table>
<br>
<h1>Completion Times</h1>
<table border="2px">
    <tr>
        <th>Path 1 Total</th> <th>Path 2 Total</th> <th>Question Total</th> <th>Foxtrot Total</th>
    </tr>
    <tr>
        <?
        echo "<td>".formatDate($path1)."</td><td>".formatDate($path2)."</td><td>".formatDate($questions)."</td><td>".formatDate($foxtrot)."</td>";
        ?>
    </tr>
</table>

<?
}
else
{
    echo "<p>Password is invalid</p>";
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
        $foxtrot += $str;
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