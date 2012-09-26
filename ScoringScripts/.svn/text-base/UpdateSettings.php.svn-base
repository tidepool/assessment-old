<?php

$ID = $_COOKIE['ID'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$image = $_POST['image'];
$not = $_POST['not'];

include_once "dbConnect.php";
/*
require_once '../zend.php';

if(strpos($image,"linkedin") > 0 && strpos($image,"facebook") > 0)
{
    $newFilePath = $image;
}
else
{
    //echo "<p>Here 2</p>";
    $secret = 'AKIAJQMEFY5JKUTCAOIA';
    $access = 'D8RAHriZAwYIcFplcZSudBMoz4qq4VcEj8UCtvr1';
    $bucket  = "tidepool_profile_pics";
    $file = "../Live/profilePics/".$image;
    $num = strrpos($image,".");
    $suffix = substr($image,$num);

    $newFile = "pic".$ID.$suffix;
    $newFilePath = "https://s3.amazonaws.com/tidepool_profile_pics/".$newFile;
    $size = filesize($file);
    $s3 = new Zend_Service_Amazon_S3($secret, $access);

    $s3->putFile($file, "$bucket/$newFile");
}
*/
$newFilePath = $image;
establishConnection();

$query = sprintf("UPDATE SocialMediaUsers SET Email='$email',Name='$name',Password='$password',Pic='$newFilePath' WHERE ID='%s'",mysql_real_escape_string($ID));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

$query = sprintf("UPDATE SocialMediaFriends SET ID2Pic='$image', ID2Name='$name' WHERE ID2='%s'",mysql_real_escape_string($ID));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

$query = sprintf("UPDATE UserSettings SET Notifications='$not' WHERE ID='%s'",mysql_real_escape_string($ID));
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

endConnection();
?>