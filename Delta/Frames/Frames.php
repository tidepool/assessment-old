<?php
$filename = $_SERVER['PHP_SELF'];
$foldername = dirname(dirname($filename));
//echo "<p>Filename: $filename Foldername: $foldername</p>";
$password = $_REQUEST['password'];
$ID = $_COOKIE['ID'];
if($ID != null || $password == "d3moT1de")
{
    $target = do_post_request($foldername."/Map.php", "name=Frames");
    $loaders = do_post_request($foldername."/LoadMap.php", "name=Frames");
    $date = date(DATE_RFC822);
    setcookie("date", $date, time()+3600,"/", ".tidepool.co"); /* Expires in a day */
    ?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Frames</title>
    <link rel="icon" href="http://tidepool.co/style/images/LogoHalf.png" type="image/png">
    <script language="JavaScript">
        function sendToJavaScript(value) {
            //document.body.innerHTML += '<form id="form" action="../<? echo $target ?>.php" method="post">';
            //alert(value);
            //document.getElementById("form").submit();
            window.location.replace("../<? echo $target ?>.php");
        }

        function getID(value) {
            //alert("first call!");
            sendToAS3();
        }

        function sendToAS3() {
            var flash = getFlashMovieObject("Frames");
            flash.recieveID('<? echo $ID;?>');
            //alert("test worked again!");
        }

        function getFlashMovieObject(n) {
            if (window.document[n]) return window.document[n];

            if (navigator.appName.indexOf("Microsoft Internet") == -1) {
                if (document.embeds && document.embeds[n])
                    return document.embeds[n];
            }
            else return document.getElementById(n);
        }
    </script>
    <script src="../../masterHeader.js" type="text/javascript"></script>
</head>
<body onload="pageInit();">

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        id="Frames" width="100%" height="100%"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="Frames.swf" />
    <param name="quality" value="high" />
    <param name="bgcolor" value="#869ca7" />
    <param name="scale" value="default">
    <param name="allowScriptAccess" value="sameDomain" />
    <embed src="Frames.swf?<? echo rand(1000000,9999999);?>" quality="high"
           width="100%" height="100%" scale="default" name="Frames" align="middle"
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
    echo "Please enable cookies on your browser";
}

function do_post_request($path, $data, $optional_headers = null)
{
    /*
        $url = $_SERVER['SERVER_NAME'];
        $list = explode(".",$url);
        $subdomain = $list[0];
    */
    $url = "http://www.tidepool.co".$path;
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

    //echo "<p>Problem reading data from $url<p>";
    return $response;
}
?>