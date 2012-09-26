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

$id = "LNC";
$paragraph1 = "Some people love taking risks.  They get off on the adrenaline rush that accompanies the extremes of high and low emotion.  You?  You\'re pretty much the opposite.  It just doesn\'t appeal to you to take all kinds of unwise chances that may or may not pay off.  You prefer to follow clear guidelines and take care of important details, so your life and work can remain predictable and stable.
";
$paragraph2 = "The fact that you\'re responsible and well organized makes you an asset at work.  One strength that helps you maintain this kind of control over your work environment is that you remain calm and in control of your own feelings.  You tend to be composed and stable, and when things don\'t go your way, you rarely overreact.  
";
$paragraph3 = "One growth area you might want to explore has to do with stepping outside of your comfort zone from time to time, especially as it relates to your love of routine and order.  If you notice a way you can improve a system or be more efficient by skipping an instructional step or by questioning the status quo, at least consider exploring this new alternative.  Who knows?  You might just come up with a whole new routine that allows you to be even more proficient at your job.
";
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