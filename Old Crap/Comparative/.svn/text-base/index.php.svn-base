<?php
$pool;
$team;
if(isset($_REQUEST['team']))
{
    $pool = $_REQUEST['pool'];
    $team = $_REQUEST['team'];
}
else
{
    $team = 2;
    $pool = 7;
}
?>
<html>
<head>
    <script type="text/javascript">
        function changeURL()
        {
            var frm = document.getElementById("ifrm");
            var pool = document.getElementById("pool").value;
            var team = document.getElementById("team").value;
            //alert("pool: "+pool+" team: "+team);
            frm.setAttribute('src', 'CalculateGroups.php?team='+team+'&pool='+pool);
        }
    </script>
</head>
<body>
<form>
    <table cellpadding="10px">
        <tr>
            <td>Team Size</td>
            <td>
                <select id="team">
                    <?
                    for($i=2;$i<=6;$i++)
                    {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </td></tr>
        <tr>
            <td>Team Size</td>
            <td>
                <select id="pool">
                    <?
                    for($i=7;$i<=20;$i++)
                    {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </td></tr>
    </table>
    <input type="button" value="Update Group Optimization" name="update" onclick="javascript:changeURL()">
</form>
<iframe id="ifrm" src="CalculateGroups.php?<? Global $team,$pool; echo "team=".$team."&pool=".$pool; ?>" width="740" height="500" scrolling="yes">
    <p>Your browser does not support iframes.</p>
</iframe>
</body>
</html>