<?php
include_once "../Live/dbConnect.php";

if($_POST['PpwdT'] == "H@rris124")
{
    include_once "../Live/dbConnect.php";

    $hi_r = $_POST['hi_r'];
    $hi_s = $_POST['hi_s'];
    $page = $_POST['pageid'];
    $status = $_POST['status'];

    setcookie("hi_r", $hi_r, time()+7200,"/", ".tidepool.co"); /* Expires in 2 hours */
    setcookie("ID", "4Harris".$hi_r, time()+7200,"/", ".tidepool.co"); /* Expires in 2 hours */
    setcookie("hi_s", $hi_s, time()+7200,"/", ".tidepool.co"); /* Expires in 2 hours */
    setcookie("pageid", $page, time()+7200,"/", ".tidepool.co"); /* Expires in 2 hours */
    setcookie("status", $status, time()+7200,"/", ".tidepool.co"); /* Expires in 2 hours */

    establishConnection();

    $query = "SELECT Count(*) FROM Harris WHERE Path = 1 AND Completed=1 AND ID LIKE '4Harris%';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $count1 = mysql_result($result, 0);
    //echo "<p>$count1</p>";

    $query = "SELECT Count(*) FROM Harris WHERE Path = 2 AND Completed=1 AND ID LIKE '4Harris%';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $count2 = mysql_result($result, 0);
    //echo "<p>$count2</p>";
    mysql_free_result($result);

    if($count1 <= $count2)
    {
        $target = "Harris1";
    }
    else
    {
        $target = "Harris2";
    }

    endConnection();
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="images/LogoHalf.png" type="image/png">
<body align="center">
<div class="main" align="center">
    <script language="JavaScript">
        //document.body.innerHTML += '<form id="form" action="../<?echo $target;?>/Loading/Loading.php" method="post">';
        window.location.replace("../<?echo $target;?>/Loading/Loading.php");
    </script>
</body >
</html>
<?
}
else
{
    echo "<p>Invalid Credentials</p>";
}
?>