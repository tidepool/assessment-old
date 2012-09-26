<?php

$ID = $_COOKIE['ID'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$image = $_POST['image'];
$not = $_POST['not'];

include_once "dbConnect.php";

require_once '../zend.php';

//echo "<p>image: $image</p>";
//echo "<p>name: $name</p>";

if(strpos($image,"linkedin") > 0 && strpos($image,"facebook") > 0)
{
    $newFilePath = $image;
    //echo "<p>Not new</p>";
}
else
{
    //echo "<p>Not new</p>";
    $secret = 'AKIAJQMEFY5JKUTCAOIA';
    $access = 'D8RAHriZAwYIcFplcZSudBMoz4qq4VcEj8UCtvr1';
    $bucket  = "tidepool_profile_pics";
    $file = "profilePics/".$image;
    $num = strrpos($image,"profilePics");
    $file = substr($image,$num);
    //echo "<p>file: $file</p>";

    $num = strrpos($image,".");
    $suffix = substr($image,$num);
    $newFile = "pic".$ID.$suffix;

    //echo "<p>newFile: $newFile</p>";
    $newFilePath = "https://s3.amazonaws.com/tidepool_profile_pics/".$newFile;
    $size = filesize($file);

    $s3 = new Zend_Service_Amazon_S3($secret, $access);

    $s3->putFile($file, $bucket."/".$newFile,
        array(Zend_Service_Amazon_S3::S3_ACL_HEADER =>
        Zend_Service_Amazon_S3::S3_ACL_PUBLIC_READ));
}
establishConnection();
$newFilePath = $image;
setcookie("pic", $newFilePath, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
setcookie("name", $name, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */

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