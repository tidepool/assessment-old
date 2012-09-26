<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TidePool: Employer Dashboard</title>
    <link rel="icon" href="images/logoHalf.png" type="image/png">
    <link rel="stylesheet" href="styles/style.css" />
    <style>
        .calc
        {
        <!-- top: -10px; -->
        color:#63b498;
        position: relative;
        font-family: helvetica;
        text-shadow: 0 1px 0 white;
        font-weight: bolder;
            }
    </style>
    <script type="text/javascript">
        var pool = 24;
        var frm;
        function changeURL(pl)
        {
            if(pl > 0)
            {
                pool = pl;
            }
            frm = document.getElementById("ifrm");
            var team = document.getElementById("team").value;
            document.getElementById("calc").innerHTML = "Calculating...";
            document.getElementById("pText").innerHTML = "";
            document.getElementById("tText").innerHTML = "";
            frm.setAttribute('src', '../Comparative/CalculateGroups.php?team='+team+'&pool='+pool);
        }
    </script>
</head>
<body>
<div id="container">
<div id="header">
    <div id="logo"><img src="images/logo.png" width="150px" border="0" name="logo" alt="logo"> </div>
<ul id="nav_full">
    <li class="nav"><a href="WTO.php">Work Type Overview</a></li>
    <li class="nav"><a href="WGO.php">Work Group Optimization</a></li>
    <li class="nav"><a href="ER.php">Employee Relationships</a></li>
    <li class="nav"><a href="refferal.php">Employer Referrals</a></li>
    <?
    if($_COOKIE['login'] == "dashydashy")
    {
        ?>
        <li id="login" class="nav"><a href="index.php?option=logout">Logout</a></li>
        </ul>
    </div>
    <div id="maincontent" class="rows">
        <div id="left_section" class="sections">
            <ul id="filter_full">
                <a href="javascript:changeURL(24);"><li id="block1" class="filter">Acme Co.</li></a>
                <a href="javascript:changeURL(18);"><li id="block2" class="filter">Branch</li></a>
                <a href="javascript:changeURL(10);"><li id="block3" class="filter">Department</li></a>
                <a href="javascript:changeURL(7);"><li id="block4" class="filter">Team</li></a>
            </ul>
            <div id="sidechart">
                <ul id="chartstats">
                    <li id="groupsize">Group Size:
                        <select id="team" onchange="javascript:changeURL(-1);">
                            <?
                            for($i=2;$i<=5;$i++)
                            {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </li>
                    <li id="pool">Pool: <span id="pText"></span></li>
                    <li id="groupnumber"># of Group: <span id="tText"></span></li>
                </ul>
            </div>
        </div>
        <div id="right_section" class="sections">
            <p align="center"><span id="calc" class="calc">Calculating</span></p>
            <iframe src="../Comparative/CalculateGroups.php?pool=24&team=3" id="ifrm" frameBorder="0" width="830px" height="520px" scrolling=auto></iframe>
            </iframe>
        </div>
        <?
    }
    else
    {
        ?>
        <li id="login" class="nav"><a href="index.php">Login</a></li>
        </ul>
    </div>
        <div align="center">
            <h1>Please Log In</h1>
        </div>
        <?
    }
    ?>
</div>
</body>
</html>

