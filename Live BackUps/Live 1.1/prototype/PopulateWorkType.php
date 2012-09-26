<?php
$Frequency = 1;
$ConscientiousnessHigh = 20;
$ConscientiousnessLow = 20;
$AgreeablenessHigh = 20;
$AgreeablenessLow = 20;
$ExtroversionHigh = 20;
$ExtroversionLow = 20;
$NeuroticismHigh = 20;
$NeuroticismLow = 20;
$OpennessHigh = 20;
$OpennessLow = 20;

$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query

$id = "";
$paragraph1 = "You have legitimate skill when it comes to leading and persuading others.  You\'re a good talker, and as a result you can organize a team and inspire them to get things done.  You love the big idea, and you don't mind taking risks when great rewards are possible.";
$paragraph2 = "";
$paragraph3 = "Keep in mind, too, that someone has to follow through on the details.  Your focus may be on initiating and energizing a particular project, and that�s great.  Just make sure that, if your strength isn�t the follow-through part of the job, you have someone on your team who�s good at taking care of the more mundane, everyday details required for success.";
//$variables = "'$id', '$paragraph1', '$paragraph2', '$paragraph3'";
//echo $variables;
$query = "INSERT INTO WorkTypes VALUES('$id', '$paragraph1', '$paragraph2', '$paragraph3');";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>