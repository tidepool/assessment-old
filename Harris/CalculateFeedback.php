<?php
function calculateFeedback()
{
    Global $averages, $count, $others1, $others2, $others3, $others4, $totCompletes;

    $averages = array();
    $others1 = array();
    $others2 = array();
    $others3 = array();
    $others4 = array();

    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
        or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');


    $query = "SELECT Count(*) FROM Feedback WHERE ID LIKE '2Harris%';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $totCompletes = mysql_result($result, 0);
    mysql_free_result($result);

    $avgChunk = "AVG(Accuracy), AVG(Hiring), AVG(Share), AVG(Facebook), AVG(Twitter), AVG(LinkedIn), AVG(WorkType), AVG(Description), AVG(Feedback),";
    $avgChunk .= "AVG(6_Family), AVG(6_Friends), AVG(6_Colleagues), AVG(6_Significant), AVG(6_Employer),";
    $avgChunk .= "AVG(7_Family), AVG(7_Friends), AVG(7_Colleagues), AVG(7_Significant), AVG(7_Employer),";
    $avgChunk .= "AVG(8_Groups), AVG(8_Teams), AVG(8_Friends), AVG(8_Providers), AVG(8_Restaurants), AVG(8_Feedback),";
    $avgChunk .= "AVG(Coworkers)";
    $query = "SELECT $avgChunk FROM Feedback WHERE ID LIKE '2Harris%';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        foreach ($line as $col_value)
        {
            $averages[] = $col_value;
        }
    }
    mysql_free_result($result);


    $query = "SELECT OtherShare FROM Feedback;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        foreach ($line as $col_value)
        {
            if($col_value != "0")
                $others1[] = $col_value;
        }
    }
    mysql_free_result($result);

    $query = "SELECT 6_Other FROM Feedback;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        foreach ($line as $col_value)
        {
            if($col_value != "0")
                $others2[] = $col_value;
        }
    }
    mysql_free_result($result);

    $query = "SELECT 7_Other FROM Feedback;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        foreach ($line as $col_value)
        {
            if($col_value != "0")
                $others3[] = $col_value;
        }
    }
    mysql_free_result($result);

    $query = "SELECT 8_Other FROM Feedback;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        foreach ($line as $col_value)
        {
            if($col_value != "0")
                $others4[] = $col_value;
        }
    }
    mysql_free_result($result);

    $query = "SELECT Count(*) FROM Feedback;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $count = mysql_fetch_array($result, 0);
    mysql_free_result($result);


    mysql_close($link);

/*
    print_r($averages);
    echo "<br>";
    print_r($others1);
    echo "<br>";
    print_r($others2);
    echo "<br>";
    print_r($others3);
    echo "<br>";
    print_r($others4);
*/
}

?>