<?php

$ID1 = $_POST['id1'];
$ID2 = $_POST['id2'];

include_once "../Live/dbConnect.php";
establishConnection();

$query = sprintf("SELECT ID2 FROM SocialMediaUsers WHERE ID='%s'",mysql_real_escape_string($ID1));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$ID1_2 = mysql_result($result,0,0);
mysql_free_result($result);


$query = sprintf("UPDATE SocialMediaFriends SET ID1Accepted=1 WHERE ID1='%s' AND ID2='%s'",mysql_real_escape_string($ID1_2),mysql_real_escape_string($ID2));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

$query = sprintf("UPDATE SocialMediaFriends SET ID2Accepted=1 WHERE ID1='%s' AND ID2='%s'",mysql_real_escape_string($ID2),mysql_real_escape_string($ID1_2));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

$query = sprintf("UPDATE SocialMediaFriends SET ID1Accepted=1 WHERE ID1='%s' AND ID2='%s'",mysql_real_escape_string($ID1),mysql_real_escape_string($ID2));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

$query = sprintf("UPDATE SocialMediaFriends SET ID2Accepted=1 WHERE ID1='%s' AND ID2='%s'",mysql_real_escape_string($ID2),mysql_real_escape_string($ID1));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

endConnection();
echo "<p>$ID1 invited $ID2</p>";
?>