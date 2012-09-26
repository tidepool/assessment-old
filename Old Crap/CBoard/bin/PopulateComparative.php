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

$Type = "LN";
$LN = "Comparative Not Available";
$HN = "Comparative Not Available";
$LC = "Comparative Not Available";
$HC = "Comparative Not Available";
$LA = "You two have contrasting approaches to socialization, but that just makes your unity more effective. In the office, you combine your talents for analytical skepticism and emotional objectivity to identify and amend potential weak links in the workplace. Although you might need a little prodding to get out of your living room on a Friday night, you can have a lot of fun if you just relax and go out with a group, even if you try to avoid being the center of attention.";
$HA = "You two are the pair of relaxed social harmonizers that no group of friends can do without. In the office, if you remember to snap out of your default state of contentedness, you can calmly guide a team through even the most stressful challenges. Although your friends may be tempted to treat you two like a free-of-charge therapist duo, you should try your best to set clear boundaries, and avoid getting too deeply involved in the intricacies of their personal lives. ";
$LO = "Comparative Not Available";
$HO = "Comparative Not Available";
$LE = "Comparative Not Available";
$HE = "You cool-headed leaders aren\'t afraid to tackle the high-stakes challenges that scare away your peers. In the office, you can handle stressful projects without getting overwhelmed. However, strict deadlines and high expectations may cause a rift between your opposing ambitious and easygoing natures. Socially, we recommend that you two skip the skydiving and instead kick back with low-key social activities.";

// Comparative Not Available
$query = "INSERT INTO Comparative VALUES('$Type', '$LN', '$HN', '$LC', '$HC', '$LA', '$HA', '$LO', '$HO', '$LE', '$HE');";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>