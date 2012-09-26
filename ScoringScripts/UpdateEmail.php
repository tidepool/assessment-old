<?php

$ID = $_POST['id'];
$email = $_POST['email'];

include_once "../Live/dbConnect.php";
establishConnection();

$query = sprintf("UPDATE SocialMediaUsers SET Email='$email' WHERE ID='%s'",mysql_real_escape_string($ID));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$ID1_2 = mysql_result($result,0,0);
mysql_free_result($result);

endConnection();
echo "<p>$ID1 invited $ID2</p>";
?>