<?php
$ID = $_COOKIE['login'];
if($ID != null)
{
    $target = do_post_request("http://tidepool.co/Delta/Map.php", "name=FLoading");
    //echo $target;
    ?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>FLoading</title>
    <script language="JavaScript">
        function sendToJavaScript(value) {
            document.body.innerHTML += '<form id="form" action="http://tidepool.co/Delta/<? echo $target?>.php" method="post">';
            //alert(value);
            document.getElementById("form").submit();
        }

    </script>
</head>
<body onload="pageInit();" style="background-color: #EEEEEE">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        id="FLoading" width="100%" height="100%"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="FLoading.swf" />
    <param name="quality" value="high" />
    <param name="bgcolor" value="#869ca7" />
    <param name="SCALE" value="exactfit">
    <param name="allowScriptAccess" value="sameDomain" />
    <embed src="FLoading.swf?<? echo rand(1000000,9999999);?>" quality="high"
           width="100%" height="100%" SCALE="exactfit" name="FLoading" align="middle"
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