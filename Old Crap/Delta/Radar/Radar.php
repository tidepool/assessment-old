<?php
$password = $_REQUEST ['password'];
if($password == "d3mo")
{
    ?>
<html>
<head>
    <script language="JavaScript">
        image1 = new Image();
        image1.src = "../images/dashboardOver.png";

        image2 = new Image();
        image2.src = "../images/graphOver.png";

        function goToNodeGraph() {
            document.body.innerHTML += '<form id="form" action="../NodeGraph/NodeGraph.php" method="post"><input type="hidden" name="password" value="d3mo"/>';
            //alert(value);
            document.getElementById("form").submit();
        }

        function goToDashboard() {
            document.body.innerHTML += '<form id="form" action="../Dashboard/Dashboard.php" method="post"><input type="hidden" name="password" value="d3mo"/>';
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
                <a style="text-decoration:none" href="javascript:goToDashboard()" onmouseover="image1.src='../images/dashboardOver.png';"onmouseout="image1.src='../images/dashboard.png';">
                    <img name="image1" width="146" height="35" border="0" src="../images/dashboard.png">
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
            id="Radar" width="100%" height="100%"
            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
        <param name="movie" value="Radar.swf" />
        <param name="quality" value="high" />
        <param name="bgcolor" value="#869ca7" />
        <param name="SCALE" value="exactfit">
        <param name="allowScriptAccess" value="sameDomain" />
        <embed src="Radar.swf" quality="high"
               width="100%" height="100%" SCALE="exactfit" name="Radar" align="middle"
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