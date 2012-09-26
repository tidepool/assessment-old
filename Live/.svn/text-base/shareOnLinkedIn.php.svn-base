<?php
echo "<p>here0</p>";
//require_once '../Live/SocialAPI.php';
echo "<p>here01</p>";
require_once '../Live/dbConnect.php';

echo "<p>here1</p>";
$user = getLIUser();
echo "<p>here2</p>";

$type = $_REQUEST['type'];
$msg = $_REQUEST['message'];
$unq = formatUnq($_COOKIE['UnqID']);

postSpecial($type,$msg,$unq);

echo "<p>here3</p>";
function formatUnq($id)
{
    $num = strpos($id,"O");
    $str = substr($id,0,$num);
    $rand = rand(10000,99999);
    $str = $str."OLP".$rand;
    return $str;
}
?>