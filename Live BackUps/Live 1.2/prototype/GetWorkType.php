<?php
$id = $_REQUEST ['ID'];
$password = $_REQUEST ['password'];
if($password = "Eyes0nly")
{
	$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
	or die('Could not connect: ' . mysql_error());
	mysql_select_db('tidepool') or die('Could not select database');

	$query = 'SELECT SubDimension FROM HollandScoring WHERE ID = '.$id;
	//echo $query;
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	//echo $result;
	$temp = mysql_fetch_row($result);
	$holland = $temp[0];
	mysql_free_result($result);

	$query = 'SELECT Type FROM PersonalityScoring WHERE ID = '.$id;
	//echo $query;
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	//echo $result;
	$temp = mysql_fetch_row($result);
	$personality = $temp[0];
	mysql_free_result($result);

	echo "<h1> Work Type Code: ".$personality.$holland."</h1>";
}
else
{
	echo "<h3>Invalid Password</h3>";
}
?>