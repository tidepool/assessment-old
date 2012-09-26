<?php
require_once "../../Live/dbConnect.php";
$ID = $_COOKIE['ID'];

establishConnection();

$query = "SELECT SubDimension FROM CloudsScoring WHERE id = '".$ID."'";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$temp = mysql_fetch_row($result);
$holland = $temp[0];
mysql_free_result($result);

$query = "SELECT Type FROM FramesScoring WHERE id = '".$ID."'";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$temp = mysql_fetch_row($result);
$personality = $temp[0];
mysql_free_result($result);

$code = $personality.$holland;

$query = "SELECT title FROM WorkTypesNew WHERE id='$code';";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$title = mysql_result($result, 0, 0);
mysql_free_result($result);
setcookie("WTname", $title, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */

$query = "UPDATE DeltaUsers SET WorkType='$code' WHERE id='$ID';";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

endConnection();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>TidePool</title>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="js/calculation.php" type="text/javascript"></script>
    <script src="../../masterHeader.js" type="text/javascript"></script>
</head>
<body>
<div id="wrap">
    <div id="header">
        <div class="logo"><a>TidePool</a></div>
    </div>
    <div id="cont">
        <div class="hdr-spacer"></div>
        <h1>Calculating Your Results</h1>

        <ul id="calc-tbl" >
            <?
            for($i=1;$i<=60;$i++)
            {
                echo "<li class='calc-grid'><img src='images/calc_bg.png' id='square$i' width='80' height='80' alt=''></li>\n";
            }
            ?>
        </ul>
    </div>
</div>
<script type="text/javascript">
    timeMsg();
</script>
</body>
</html>