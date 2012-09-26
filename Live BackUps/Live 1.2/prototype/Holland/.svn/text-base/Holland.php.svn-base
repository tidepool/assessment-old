<?php
$password   = $_POST['password'];
$ID = $_POST['ID'];
//echo "<id>ID is: $ID</id>";
if($password == 'f0rgetmen0t' || $password == 'd3mo')
{
    ?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Holland</title>
    <script language="JavaScript">
        function sendToJavaScript(value) {
            document.body.innerHTML += '<form id="form" action="PostHolland.php" method="post"><input type="hidden" name="ID" value="<? echo $ID?>"/><input type="hidden" name="data" value="'+value+'"/>';
            //alert(value);
            document.getElementById("form").submit();
        }
    </script>
</head>
<body onload="pageInit();">

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        id="Holland" width="100%" height="100%"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="Holland.swf" />
    <param name="quality" value="high" />
    <param name="bgcolor" value="#869ca7" />
    <param name="SCALE" value="exactfit">
    <param name="allowScriptAccess" value="sameDomain" />
    <embed src="Holland.swf" quality="high"
           width="100%" height="100%" SCALE="exactfit" name="Holland" align="middle"
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
    echo "password did not match";
}
?>