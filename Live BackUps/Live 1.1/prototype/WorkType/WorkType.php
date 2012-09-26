<?php
$ID = $_REQUEST ['ID'];
//echo "<p>ID is: $id</p>";
$password = $_REQUEST ['password'];
if($password = "d3mo")
{
    $link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = 'SELECT SubDimension FROM HollandScoring WHERE ID = '.$ID;
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    $temp = mysql_fetch_row($result);
    $holland = $temp[0];
    mysql_free_result($result);

    $query = 'SELECT Type FROM PersonalityScoring WHERE ID = '.$ID;
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    $temp = mysql_fetch_row($result);
    $personality = $temp[0];
    mysql_free_result($result);

    //echo "<h1> Work Type Code: ".$personality.$holland."</h1>";

    $code = $personality.$holland;

    $query = "SELECT * FROM WorkTypes WHERE id = '".$code."'";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    $temp = mysql_fetch_row($result);
    //$personality = $temp[0];
    $p1 = $temp[1];
    $p2 = $temp[2];
    $p3 = $temp[3];
    mysql_free_result($result);
    echo "<div style='float: left'>";
    echo "<div align='center'>";
    echo "<h1>".$personality.$holland."</h1>";
    echo "<h5 style=\"width:500px\">".$p1."</h5>";
    echo "<h5 style=\"width:500px\">".$p2."</h5>";
    echo "<h5 style=\"width:500px\">".$p3."</h5>";
    //echo "<form action=\"http://tidepool.co/assessment/prototype/DimensionCharts/DimensionResults.php\" method=\"post\">";
    //echo "<input type=\"hidden\" name=\"ID\" value=\"$ID\"/>";
    //echo "<input name=\"submit\" type=\"submit\" value=\"View Results\" />";
    //echo "</form>";

    echo "</div>";
    echo "</div>";
    echo "<img src=\"RockLeaf.png\" alt=\"Rock Leaf Pic\" style=\"width:500px;height: 500px\"/>";
    echo "</div>";
}
else
{
    echo "<h3>Invalid Password</h3>";
}
?>