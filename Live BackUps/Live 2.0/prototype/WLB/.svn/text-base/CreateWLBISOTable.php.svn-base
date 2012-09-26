<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query
$variables = "id INT NOT NULL AUTO_INCREMENT,";
$variables .= "Pie1 INT, Pie2 INT, ";
$variables .= "TPS1_1 INT, TPS1_2 INT, TPS1_3 INT, ";
$variables .= "OBS1 INT, ";
$variables .= "Pins INT, ";
$variables .= "TS1 INT, TS2 INT, TS3 INT, TS4 INT, ";//12
$variables .= "Select1_1 INT, Select1_2 INT, Select1_3 INT, ";
$variables .= "TPS2_1 INT, TPS2_2 INT, TPS2_3 INT, ";//18
$variables .= "OBS2 INT, ";//19
$variables .= "Net1_1 INT, Net1_2 INT, Net1_3 INT, ";
$variables .= "Net2_1 INT, Net2_2 INT, Net2_3 INT, ";
$variables .= "Net3_1 INT, Net3_2 INT, Net3_3 INT, ";
$variables .= "Net4_1 INT, Net4_2 INT, Net4_3 INT, ";
$variables .= "Net5_1 INT, Net5_2 INT, Net5_3 INT, ";//34
$variables .= "Briefcase1_1 INT, Briefcase1_2 INT, Briefcase1_3 INT, ";
$variables .= "Briefcase2_1 INT, Briefcase2_2 INT, Briefcase2_3 INT, ";
$variables .= "Briefcase3_1 INT, Briefcase3_2 INT, Briefcase3_3 INT, ";
$variables .= "Briefcase4_1 INT, Briefcase4_2 INT, Briefcase4_3 INT, ";
$variables .= "Briefcase5_1 INT, Briefcase5_2 INT, Briefcase5_3 INT, ";
$variables .= "Briefcase6_1 INT, Briefcase6_2 INT, Briefcase6_3 INT, ";
$variables .= "Briefcase7_1 INT, Briefcase7_2 INT, Briefcase7_3 INT, ";
$variables .= "Briefcase8_1 INT, Briefcase8_2 INT, Briefcase8_3 INT, ";
$variables .= "Briefcase9_1 INT, Briefcase9_2 INT, Briefcase9_3 INT, ";
$variables .= "Briefcase10_1 INT, Briefcase10_2 INT, Briefcase10_3 INT, ";
$variables .= "Office1_1 INT, Office1_2 INT, Office1_3 INT, Office1_4 INT, ";
$variables .= "Office2_1 INT, Office2_2 INT, Office2_3 INT, Office2_4 INT, ";
$variables .= "Office3_1 INT, Office3_2 INT, Office3_3 INT, Office3_4 INT, ";
$variables .= "Office4_1 INT, Office4_2 INT, Office4_3 INT, Office4_4 INT, ";
$variables .= "Office5_1 INT, Office5_2 INT, Office5_3 INT, Office5_4 INT, ";
$variables .= "Office6_1 INT, Office6_2 INT, Office6_3 INT, Office6_4 INT, ";
$variables .= "Office7_1 INT, Office7_2 INT, Office7_3 INT, Office7_4 INT, ";
$variables .= "Dream_1 INT, Dream_2 INT, Dream_3 INT, ";
$variables .= "Choice1 INT, Choice2 INT, Choice3 INT, Choice4 INT, Choice5 INT, Choice6 INT, ";
$variables .= "Time INT, ";
$variables .= "Clipboard1 INT, Clipboard2 INT, Clipboard3 INT, ";
$variables .= "PRIMARY KEY (id)";
echo $variables;
$query = "CREATE TABLE WLBISO (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>