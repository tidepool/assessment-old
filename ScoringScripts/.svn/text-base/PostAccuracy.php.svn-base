<?php
$ID = $_POST['id'];
$bullet = "Bullet".$_POST['bullet'];
$value = $_POST['value'];

include_once "../Live/dbConnect.php";
establishConnection();

$query = sprintf("UPDATE WorkTypeAccuracy SET $bullet=$value WHERE ID='%s'",mysql_real_escape_string($ID));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

endConnection();
?>