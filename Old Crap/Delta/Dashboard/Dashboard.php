<?php
$password = $_REQUEST ['password'];
if($password == "d3mo")
{
    ?>
<html>
<head>
    <script language="JavaScript">
        image1 = new Image();
        image1.src = "../images/radarLOver.png";

        image2 = new Image();
        image2.src = "../images/graphOver.png";

        function goToNodeGraph() {
            document.body.innerHTML += '<form id="form" action="../NodeGraph/NodeGraph.php" method="post"><input type="hidden" name="password" value="d3mo"/>';
            //alert(value);
            document.getElementById("form").submit();
        }

        function goToRadar() {
            document.body.innerHTML += '<form id="form" action="../Radar/Radar.php" method="post"><input type="hidden" name="password" value="d3mo"/>';
            //alert(value);
            document.getElementById("form").submit();
        }
    </script>
</head>
<body>
<title>Dashboard</title>

<div align="center">
    <table cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="146">
                <a style="text-decoration:none" href="javascript:goToRadar()" onmouseover="image1.src='../images/radarLOver.png';"onmouseout="image1.src='../images/radarL.png';">
                    <img name="image1" width="146" height="35" border="0" src="../images/radarL.png">
                </a>
            </td>
            <td width="146">
                <a style="text-decoration:none" href="javascript:goToNodeGraph()" onmouseover="image2.src='../images/graphOver.png';"onmouseout="image2.src='../images/graph.png';">
                    <img name="image2" width="146" height="35" border="0" src="../images/graph.png">
                </a>
            </td>
        </tr>
    </table>
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
            id="DashBoard" width="100%" height="100%"
            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
        <param name="movie" value="DashBoard.swf" />
        <param name="quality" value="high" />
        <param name="bgcolor" value="#869ca7" />
        <param name="SCALE" value="exactfit">
        <param name="allowScriptAccess" value="sameDomain" />
        <embed src="DashBoard.swf" quality="high"
               width="100%" height="100%" SCALE="exactfit" name="DashBoard" align="middle"
               play="true" loop="false" quality="high" allowScriptAccess="sameDomain"
               type="application/x-shockwave-flash"
               pluginspage="http://www.macromedia.com/go/getflashplayer">
        </embed>
    </object>
</div>
</body>
</html>
<?
}
else
{
    echo "<h3>Invalid Password</h3>";
}
?>