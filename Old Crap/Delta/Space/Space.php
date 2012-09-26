<?php
$ID = $_COOKIE['login'];
if($ID != null)
{
    $target = do_post_request("http://tidepool.co/Delta/Map.php", "name=Space");
    ?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Space</title>
    <script language="JavaScript">
        function sendToJavaScript(value) {
            document.body.innerHTML += '<form id="form" action="../<? echo $target ?>.php" method="post">';
            //document.body.innerHTML += '<form id="form" action="http://tidepool.co/assessment/prototype/Posts/PostSpace.php" method="post"><input type="hidden" name="ID" value="<? echo $ID?>"/><input type="hidden" name="password" value="d3mo"/>';
            //alert(value);
            document.getElementById("form").submit();
        }

        function getID(value) {
            //alert("first call!");
            sendToAS3();
        }

        function sendToAS3() {
            var flash = getFlashMovieObject("Space");
            flash.recieveID("<? echo $ID;?>");
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
    <style type="text/css">

        .container
        {
            position: relative;
            padding: 10;
            left: 50%;
        }
        .containerdiv
        {
            position: relative;
            left: -135px;
        }
        .cornerimage
        {
            position: absolute;
            top: 0;
        }
    </style>
</head>
<body onload="pageInit();" style="background-color: #EEEEEE">
<div align="center">
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
            id="Space" width="96%" height="96%"
            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
        <param name="movie" value="Space.swf" />
        <param name="quality" value="high" />
        <param name="bgcolor" value="#869ca7" />
        <param name="SCALE" value="exactfit">
        <param name="allowScriptAccess" value="sameDomain" />
        <embed src="Space.swf?<? echo rand(1000000,9999999);?>" quality="high"
               width="96%" height="96%" SCALE="exactfit" name="Space" align="middle"
               play="true" loop="false" quality="high" allowScriptAccess="sameDomain"
               type="application/x-shockwave-flash"
               pluginspage="http://www.macromedia.com/go/getflashplayer">
        </embed>
    </object>
</div>


<div class="container">
    <div class="containerdiv">
        <img class="cornerimage" border="0" src="../images/ProgressBackground.png" alt="">
        <img class="cornerimage" border="0" src="../images/ProgressLeft.png" alt="">
    </div>
</div>
</body>
</html>
<?
}
else
{
    echo "password did not match";
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