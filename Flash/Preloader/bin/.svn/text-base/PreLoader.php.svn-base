<?php
echo "<p>Here 1</p>";
$target = do_post_request("http://stage.tidepool.co/Test/preload/Map.php", "name=Frames");
echo "<p>Here 2</p>";
$loaders = do_post_request("http://stage.tidepool.co/Test/preload/LoadMap.php", "name=Frames");
echo "<p>Here 3</p>";
$date = date(DATE_RFC822);
setcookie("date", $date, time()+3600,"/", ".tidepool.co"); /* Expires in a day */
//echo "<p>$loaders</p>";
$ID = "156161561561";
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PreLoader</title>
    <script language="JavaScript">
        function sendToJavaScript(value) {
            document.body.innerHTML += '<form id="form" action="../<? echo $target ?>.php" method="post">';
            //alert(value);
            document.getElementById("form").submit();
        }

        function getList(value) {
            giveList();
        }
        function giveList() {

            var flash = getFlashMovieObject("PreLoader");
            flash.recieveList('<? echo $loaders;?>');
            //alert("test worked again!");
        }

        function getID(value) {
            //alert("first call!");
            sendToAS3();
        }

        function sendToAS3() {
            var flash = getFlashMovieObject("PreLoader");
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
</head>
<body onload="pageInit();">

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        id="PreLoader" width="100%" height="100%"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="PreLoader.swf" />
    <param name="quality" value="high" />
    <param name="bgcolor" value="#869ca7" />
    <param name="scale" value="default">
    <param name="allowScriptAccess" value="sameDomain" />
    <embed src="PreLoader.swf?<? echo rand(1000000,9999999);?>" quality="high"
           width="100%" height="100%" scale="default" name="PreLoader" align="middle"
           play="true" loop="false" quality="high" allowScriptAccess="sameDomain"
           type="application/x-shockwave-flash"
           pluginspage="http://www.macromedia.com/go/getflashplayer">
    </embed>
</object>
</body>
</html>
<?

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