<?php
require_once "ComparativeData.php";
require_once "../Admin/UniversalLogin.php";
if(CheckLogin())
{
    if(isset($_REQUEST['ID']))
    {
        $ID = intval($_REQUEST['ID']);
        //echo "<p>Id is $ID</p>";
    }
    else
    {
        $ID = -1;
    }
    $codeWorkTypes = getDatabaseData();
    //print_r($codeWorkTypes);
    $previous=-1;
    if(isset($_POST['wt1']))
    {
        $wt1 = $_POST['wt1'];
        $previous = $wt1;
        getWorkTypesDB($wt1,null);
        $showText = true;
    }
    else
    {
        $showText = false;
    }
    ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="http://tidepool.co/images/LogoHalf.png" type="image/png">
    <link rel="stylesheet" href="style/compare.css"/>
    <link rel="stylesheet" type="text/css" href="style/jquery.autocomplete.css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
    <script type='text/javascript' src='js/jquery.autocomplete.min.js'></script>
    <script type="text/javascript">
        var emails = [ <? echo getWorkTypeValueString(); ?>];
        function changeURL(num)
        {
            frm = document.getElementById("ifrm");

            var name = "td"+num;
            //alert("I am "+name);
            if(elem != null)
            {
                elem.className = "none";
            }
            elem =  document.getElementById(name);
            elem.className = "selected";
            frm.setAttribute('src', 'DisplayComparativeDB.php?wt1=<? echo $previous; ?>&wt2='+num);
            scrollWin();
            //alert("Alert called "+num);
        }
    </script>
</head>
<body>
<div class="container" align="center">
    <form action="" method="post">
        <label>Choose Person:</label>
        <?
        echo "<select class='dropdown' onchange='javascript:Update(\"CompareAmplify.php\",this.value);' name='wt1' id='wt1' tabindex='10'>";

        $count = 0;
        echo "<option value='$previous'>".$codeWorkTypes[$previous]['name']."</option>";
        foreach($codeWorkTypes as $name)
        {
            echo "<option value='$count'>".$name['name']."</option>";
            $count++;
        }
        echo "</select>";
        ?>
        <p>
            <label>Search for a person:</label>
            <input type="text" id="search" />
        </p>
    </form>
    <p>Click on a persons name to see your comparison</p>
    <?
    displayWorktypes();
    ?>
    <iframe src="DisplayComparativeDB.php" id="ifrm" frameBorder="0" width="1000px" height="1000px" scrolling=no/>
</div>
</body>
</html>

<?
}
?>