<?php
require_once "../Live/dbConnect.php";
$ID = -1;
$ID = $_REQUEST ['ID'];
//$ID = 10;
//echo "<h1>ID is: $ID</h1>";
$password = $_REQUEST ['password'];
if($password = "d3mo")
{

    echo "<html>";
    echo "<head>";
    echo "<body>";
    echo "<title>WorkType</title>";
    establishConnection();

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
    //echo "<div style=\"float: left\">";
    echo "<div align=\"center\">";
    echo "<h1>".$personality.$holland."</h1>";
    echo "<h5 style=\"width:500px;text-align:left\">".$p1."</h5>";
    echo "<h5 style=\"width:500px;text-align:left\">".$p2."</h5>";
    echo "<h5 style=\"width:500px;text-align:left\">".$p3."</h5>";
    //echo "<form action=\"http://tidepool.co/assessment/prototype/DimensionCharts/DimensionResults.php\" method=\"post\">";
    //echo "<input type=\"hidden\" name=\"ID\" value=\"$ID\"/>";
    //echo "<input name=\"submit\" type=\"submit\" value=\"View Results\" />";
    //echo "</form>";

    //echo "</div>";
    echo "<div align=\"right\">";
    echo "<img src=\"RockLeaf.jpg\" alt=\"Rock Leaf Pic\" style=\"width:250px;height: 250px\"/>";
    echo "</div>";

    echo "</div>";
    echo "</body>";
    echo "</html>";


     $query = "UPDATE UserInfo SET WorkType='".$code."' WHERE id=$ID;";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    endConnection();
}
else
{
    echo "<h3>Invalid Password</h3>";
}
?>