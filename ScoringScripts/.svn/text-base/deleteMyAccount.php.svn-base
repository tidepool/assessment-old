<?php

$ID = $_COOKIE['ID'];

include_once "../Live/dbConnect.php";
establishConnection();

$query = sprintf("UPDATE users SET stage='9' WHERE user_id='%s'",mysql_real_escape_string($ID));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

$query = sprintf("UPDATE SocialMediaFriends SET ID1Deactivated=1 WHERE ID1='%s'",mysql_real_escape_string($ID));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);


$query = sprintf("UPDATE SocialMediaFriends SET ID2Deactivated=1 WHERE ID2='%s'",mysql_real_escape_string($ID));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

endConnection();
?>