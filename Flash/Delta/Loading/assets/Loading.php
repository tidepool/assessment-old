<?php
$filename = $_SERVER['SERVER_NAME'];
//echo "<p>Filename: $filename</p>";
$posWWW = strpos($filename,"www");
$posStage = strpos($filename,"stage");
if($posWWW === false && $posStage === false)
{
    ?>
<html>
<body>
<script language="JavaScript">
    document.body.innerHTML += '<form id="form" action="http://www.tidepool.co/Delta/Loading/Loading.php?stage=0" method="post">';
    document.getElementById("form").submit();
</script>
</body>
</html>
<?
}
else
{
    require_once "../../Live/dbConnect.php";
    establishConnection();

    $query = "SELECT COUNT(ID) FROM DeltaUsers;";
    $result = mysql_query($query) or die('Query1 failed: ' . mysql_error());
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

    $ID = mysql_result($result, 0);
    $ID = $ID + 3000;
    $rand = rand(10000,99999);
    $ID = "TP".$ID."O".$rand;
    $IP = $_SERVER['REMOTE_ADDR'];
    date_default_timezone_set('PDT');
    $date = date("m-j-y");
    $query = "INSERT INTO DeltaUsers VALUES ('$ID', '$date','', '$IP','$browser');";
    $result = mysql_query($query) or die('Query2 failed: ' . mysql_error());
    mysql_free_result($result);

    endConnection();

    setcookie("ID", $ID, time()+3600,"/", ".tidepool.co"); /* Expires in a day */

    //echo "<p>here</p>";
    $filename = $_SERVER['PHP_SELF'];
    $foldername = dirname(dirname($filename));
    $stage = $_REQUEST['stage'];

    setcookie("ID", $ID, time()+3600,"/", ".tidepool.co"); /* Expires in a day */

    $filename = $_SERVER['PHP_SELF'];
    $foldername = dirname(dirname($filename));
    //echo "<P>folder $foldername</P>";
    //echo "<p>here2</p>";
    $loaders = do_post_request($foldername."/StagingMap.php", "stage=$stage");
    //echo "<p>here3</p>";
    //echo "http://tidepool.co<? echo $foldername."/".$loaders."/".$loade
    ?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Loading</title>
    <script language="JavaScript">
        function sendToJavaScript(value) {
            document.body.innerHTML += '<form id="form" action="../<? echo $loaders."/".$loaders?>.php" method="post">';
            //alert(value);
            document.getElementById("form").submit();
        }
        function getList(value) {
            giveList();
        }
        function giveList() {

            var flash = getFlashMovieObject("Loading");
            flash.recieveList('<? echo $loaders;?>');
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
    <script type="text/javascript">
        <!--
        var MM_contentVersion = 6;
        var plugin = (navigator.mimeTypes && navigator.mimeTypes["application/x-shockwave-flash"]) ? navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin : 0;
        if ( plugin ) {
            var words = navigator.plugins["Shockwave Flash"].description.split(" ");
            for (var i = 0; i < words.length; ++i)
            {
                if (isNaN(parseInt(words[i])))
                    continue;
                var MM_PluginVersion = words[i];
            }
            var MM_FlashCanPlay = MM_PluginVersion >= MM_contentVersion;
        }
        else if (navigator.userAgent && navigator.userAgent.indexOf("MSIE")>=0
            && (navigator.appVersion.indexOf("Win") != -1)) {
            document.write('<SCR' + 'IPT LANGUAGE=VBScript\> \n'); //FS hide this from IE4.5 Mac by splitting the tag
            document.write('on error resume next \n');
            document.write('MM_FlashCanPlay = ( IsObject(CreateObject("ShockwaveFlash.ShockwaveFlash." & MM_contentVersion)))\n');
            document.write('</SCR' + 'IPT\> \n');
        }
        if ( MM_FlashCanPlay ) {

        } else{
            window.location.replace("http://www.tidepool.co/Live/doNotSupport.html");
        }
        //-->

    </SCRIPT>
    <script src="../../masterHeader.js" type="text/javascript"></script>
</head>
<body onload="pageInit();" style="background-color: #EFEFEF">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        id="Loading" width="328px" height="28px"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="Loading.swf" />
    <param name="quality" value="high" />
    <param name="scale" value="default">
    <param name="allowScriptAccess" value="sameDomain" />
    <embed src="Loading.swf?<? echo rand(1000000,9999999);?>" quality="high"
           width="328px" height="28px" scale="default" name="Loading" align="middle"
           play="true" loop="false" quality="high" allowScriptAccess="sameDomain"
           type="application/x-shockwave-flash"
           pluginspage="http://www.macromedia.com/go/getflashplayer">
    </embed>
</object>
<div align="center">
    <img src="assets/stages.png" alt="">
</div>
</body>
</html>
<?
}

function do_post_request($path, $data, $optional_headers = null)
{
    /*
        $url = $_SERVER['SERVER_NAME'];
        $list = explode(".",$url);
        $subdomain = $list[0];
    */
    $url = "http://www.tidepool.co".$path;
    //echo "<p>url is $url</p>";
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

    // echo "<p>Problem reading data from $url<p>";
    return $response;
}
?>