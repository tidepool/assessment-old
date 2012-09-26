<?php

include_once "../../Live/dbConnect.php";
if(isset($_COOKIE['hi_r']) && isset($_COOKIE['hi_s']) && isset($_COOKIE['pageid']) && isset($_COOKIE['ID']))
{
establishConnection();

    $query = "SELECT COUNT(*) FROM UserInfo;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo "<p>$result</p>";

    $temp = $_SERVER['HTTP_USER_AGENT'];
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') )
    {
        $browser = "Firefox";
    }
    else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') )
    {
        $browser = "Chrome";
    }
    else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') )
    {
        $browser = "Safari";
    }
    else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'IE') )
    {
        $browser = "IE";
    }
    else
    {
        $browser = "Other";
    }

    $ID = $_COOKIE['ID'];
    $IP = $_SERVER['REMOTE_ADDR'];
    $date = date("F j, Y, g:i a T");
    $query = "INSERT INTO UserInfo VALUES ('$ID', '', '', '$date', '$IP','$browser','$full','$email');";
    $result = mysql_query($query) or die('User Query failed: ' . mysql_error());
    mysql_free_result($result);

    $query = "INSERT INTO Harris VALUES ('$ID', 1, 0);";
    $result = mysql_query($query) or die('Harris Query failed: ' . mysql_error());
    mysql_free_result($result);

    endConnection();

    setcookie("ID", $ID, time()+7200,"/", ".tidepool.co"); /* Expires in a day */
    setcookie("password", "d3moT1de", time()+7200,"/", ".tidepool.co"); /* Expires in a day */
    $target = do_post_request("http://tidepool.co/Harris1/Map.php", "name=Loading");
    //echo $target;
    ?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Loading</title>
    <link rel="icon" href="http://tidepool.co/images/LogoHalf.png" type="image/png">
    <script language="JavaScript">
        function sendToJavaScript(value) {
            document.body.innerHTML += '<form id="form" action="../<? echo $target?>.php" method="post">';
            //alert(value);
            document.getElementById("form").submit();
        }
    </script>
</head>
<body onload="pageInit();" style="background-color: #EEEEEE">
<object id="Loading" width="100%" height="100%"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="Loading.swf" />
    <param name="quality" value="high" />
    <param name="bgcolor" value="#869ca7" />
    <param name="SCALE" value="exactfit">
    <param name="allowScriptAccess" value="sameDomain" />
    <embed src="Loading.swf?<? echo rand(1000000,9999999);?>" quality="high"
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
function do_post_request($url, $data, $optional_headers = null)
{
    $params = array('http' => array(
        'method' => 'POST',
        'content' => $data
    ));
    if ($optional_headers !== null) {
        $params['http']['header'] = $optional_headers;
    }
    $ctx = stream_context_create($params);
    $fp = @fopen($url, 'rb', false, $ctx);
    if (!$fp) {
        throw new Exception("Problem with $url, $php_errormsg");
    }
    $response = @stream_get_contents($fp);
    if ($response === false) {
        throw new Exception("Problem reading data from $url, $php_errormsg");
    }
    return $response;
}
?>