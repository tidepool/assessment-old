<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TidePool: Employer Dashboard</title>
    <link rel="icon" href="images/logoHalf.png" type="image/png">
    <link rel="stylesheet" href="styles/style.css" />
    <script type="text/javascript" src="../jQuery/jquery.js"></script>
    <script type="text/javascript">
        var frm;
        function changeURL(amt)
        {
            document.getElementById("grid").setAttribute('src', 'grid.php?&amt='+amt);
        }
        function test()
        {
            alert("Hello")
        }
        function scrollWin(){
            //alert("Scroll")
            $('html,body').animate({
                scrollTop: $("#profiles_worktype").attr("scrollHeight") - 575
            }, 500);
            //
            // $("#myDiv").animate({ scrollTop: $("#myDiv").attr("scrollHeight") - $('#myDiv').height() }, 3000);
            //$("#myDiv").attr({ scrollTop: $("#myDiv").attr("scrollHeight") });
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
                <a href="javascript:changeURL(97);"><li id="block1" class="filter">Acme Co.</li></a>
                <a href="javascript:changeURL(67);"><li id="block2" class="filter">Branch</li></a>
                <a href="javascript:changeURL(34);"><li id="block3" class="filter">Department</li></a>
                <a href="javascript:changeURL(14);"><li id="block4" class="filter">Teams</li></a>
            </ul>
        </div>
        <div id="right_section" class="sections">
            <iframe src="grid.php?amt=97" id="grid" frameBorder="0" width="800" height="400">
            </iframe>
        </div>
        <div id="profiles_worktype">
            <iframe src="workTypeProfile.php" id="stats" frameBorder="0" width="1020px" height="800px"></iframe>
        </div>
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


