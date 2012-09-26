<?php
$ID = 997799;
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PreLoader</title>
    <script language="JavaScript">
        function sendToJavaScript(value) {
            document.body.innerHTML += '<form id="form" action="PostPreLoader.php" method="post"><input type="hidden" name="ID" value="<? echo $ID?>"/><input type="hidden" name="data" value="'+value+'"/>';
            //alert(value);
            document.getElementById("form").submit();
        }

        function getID(value) {
            //alert("first call!");
            sendToAS3();
        }

        function sendToAS3() {
            var flash = getFlashMovieObject("PreLoader");
            flash.sendToActionscript(<? echo $ID?>);
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
    <param name="SCALE" value="exactfit">
    <param name="allowScriptAccess" value="sameDomain" />
    <embed src="PreLoader.swf" quality="high"
           width="100%" height="100%" SCALE="exactfit" name="PreLoader" align="middle"
           play="true" loop="false" quality="high" allowScriptAccess="sameDomain"
           type="application/x-shockwave-flash"
           pluginspage="http://www.macromedia.com/go/getflashplayer">
    </embed>
</object>
</body>
</html>
