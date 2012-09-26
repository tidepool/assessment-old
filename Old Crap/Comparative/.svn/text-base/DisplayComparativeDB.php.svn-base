<?php
require_once "ComparativeData.php";
$codeWorkTypes = getDatabaseData();
if(isset($_REQUEST['wt1']))
{
    $wt1 = $_REQUEST['wt1'];
    $wt2 = $_REQUEST['wt2'];
    $previous1 = $wt1;
    $previous2 = $wt2;
    getWorkTypesDB($wt1,$wt2);
    //echo "<p>WT1 $wt1  WT2 $wt2</p>";
    getComparativeFeedback($wt1,$wt2);
    $showText = true;
}
else
{
    $showText = false;
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="http://tidepool.co/images/LogoHalf.png" type="image/png">
    <link rel="stylesheet" href="style/compare.css"/>
</head>
<body>
<div class="container" align="center">
<?
if($showText)
{
    //print_r($codeWorkTypes);
    echo "<h3 align='left'>".$codeWorkTypes[$previous1]['name']."-   ".$codeWorkTypes[$previous1]['wtName']."</h3>";
    echo "<h3 align='left'>".$codeWorkTypes[$previous2]['name']."-   ".$codeWorkTypes[$previous2]['wtName']."</h3>";
    displayComparativeFeedback();
}
?>
</body>
</html>
