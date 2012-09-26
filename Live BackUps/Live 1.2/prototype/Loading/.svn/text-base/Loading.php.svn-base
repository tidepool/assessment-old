<?php
$password   = $_POST['password'];
$ID = $_POST['ID'];
$name = $_POST['name'];

$link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');

$query = "SELECT Count FROM UserTable WHERE Name='$name' and Password='$password';";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$count = mysql_result($result, 0);
mysql_free_result($result);
//echo "<id>Count is: $count</id>";
if($count == "")
{
    echo "Password did not match Name";
}
else if($count > 0)
{
    $query = "SELECT COUNT(*) FROM UserInfo;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo "<p>$result</p>";

    $ID = mysql_result($result, 0);
    $ID = $ID + 1;
    $IP = $_SERVER['REMOTE_ADDR'];
    $date = date("F j, Y, g:i a T");
    $date .= " NL";
    $query = "INSERT INTO UserInfo VALUES ($ID, '$name', ' ', '$date', '$IP');";
    //echo "<h1>$query</h1>";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    $count--;
    $query = "UPDATE UserTable SET Count=$count WHERE Name='$name';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    mysql_close($link);
    ?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Loading</title>
    <script language="JavaScript">
        function sendToJavaScript(value) {
            document.body.innerHTML += '<form id="form" action="PostLoading.php" method="post"><input type="hidden" name="ID" value="<? echo $ID?>"/><input type="hidden" name="data" value="'+value+'"/>';
            //alert(value);
            document.getElementById("form").submit();
        }
    </script>
</head>
<body onload="pageInit();">

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        id="Loading" width="100%" height="100%"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="Loading.swf" />
    <param name="quality" value="high" />
    <param name="bgcolor" value="#869ca7" />
    <param name="SCALE" value="exactfit">
    <param name="allowScriptAccess" value="sameDomain" />
    <embed src="Loading.swf" quality="high"
           width="100%" height="100%" SCALE="exactfit" name="Loading" align="middle"
           play="true" loop="false" quality="high" allowScriptAccess="sameDomain"
           type="application/x-shockwave-flash"
           pluginspage="http://www.macromedia.com/go/getflashplayer">
    </embed>
</object>
</body>
</html>
<?
}
else
{
    echo "Sorry you are out of trials";
}
?>