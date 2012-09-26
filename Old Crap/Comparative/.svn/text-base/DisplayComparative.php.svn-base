<?php
require_once "ComparativeData.php";
$codeWorkTypes = populateWorkTypeNames();
if(isset($_REQUEST['wt1']))
{
    $personalityWTCodes = populateWTCodes();
    $wt1 = $_REQUEST['wt1'];
    $wt2 = $_REQUEST['wt2'];
    $previous1 = $wt1;
    $previous2 = $wt2;
    getWorkTypes($wt1,$wt2);
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
    displayComparativeFeedback();
}
?>
</body>
</html>
