<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');

$user = $_REQUEST['user'];
$other = $_REQUEST['other'];
//$user ="HE";
//$other ="LN";

$query = "SELECT $other FROM Comparative WHERE Type='$user'";
//echo $query;
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$temp = mysql_fetch_row($result);
$compare = $temp[0];
mysql_free_result($result);

echo $compare;
?>