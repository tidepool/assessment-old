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

$id = "HOI";
$paragraph1 = "That old cliche about curiosity killing the cat just doesn\'t ring true to you.  In fact, you thrive on curiosity and coming up with novel ways to address problems.  New ideas excite you, and you welcome a challenge that asks you to research a problem, analyze the data, and come up with an interesting and novel response.  You\'re an independent thinker with strong skills when it comes to organizing and understanding information.";
$paragraph2 = "As such, you can be a very valuable employee and coworker.  Your openness to new ideas, combined with your analytical skills, mean that you\'re often able to find whole new ways to address a problem that arises.";
$paragraph3 = "You\'re less interested in working in groups or with other people.  And while it\'s great to be a strong, independent thinker, this is one area of growth you might want to explore.  Take that openness and curiosity that are such strong aspects of your personality, and let them lead you towards working more effectively with the people around you.  Who knows what novel and interesting results may appear?";
$title = "The Buffet Brain";
//$variables = "'$id', '$paragraph1', '$paragraph2', '$paragraph3'";
//echo $variables;
$query = "INSERT INTO WorkTypes VALUES('$id', '$paragraph1', '$paragraph2', '$paragraph3','$title');";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>