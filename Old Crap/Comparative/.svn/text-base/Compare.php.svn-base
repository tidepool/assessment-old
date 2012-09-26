<?php
require_once "ComparativeData.php";
$codeWorkTypes = populateWorkTypeNames();

if(isset($_POST['wt1']))
{
    $wt1 = $_POST['wt1'];
    $name1 = $_POST['n1'];
    $sex1 = $_POST['s1'];
    $wt2 = $_POST['wt2'];
    $name2 = $_POST['n2'];
    $sex2 = $_POST['s2'];
    $previous1 = $wt1;
    $previous2 = $wt2;

    getComparativeFeedback($wt1,$wt2);
    setSexNames($name1,$sex1,$name2,$sex2);

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
    <script type="text/javascript">

    </script>
</head>
<body>
<div class="container" align="center">
    <form action="" method="post">
        <table cellpadding="10px;">
            <?
            echo "<tr><td>1st work type</td><td><select name='wt1'>";
            $count = 0;
            echo "<option value='$previous1'>".$codeWorkTypes[$previous1]['name']."</option>";
            foreach($codeWorkTypes as $name)
            {
                echo "<option value='$count'>".$name['name']."</option>";
                $count++;
            }
            echo "</select></td><td width='25px'/>";
            echo "<td>2nd work type</td><td><select name='wt2'>";
            $count = 0;
            echo "<option value='$previous2'>".$codeWorkTypes[$previous2]['name']."</option>";
            foreach($codeWorkTypes as $name)
            {
                echo "<option value='$count'>".$name['name']."</option>";
                $count++;
            }
            echo "</select></td></tr>";
            echo "<tr><td>1st name</td><td><input name='n1' value='$name1'></td><td width='25px'/>";
            echo "<td>2nd name</td><td><input name='n2' value='$name2'></td></tr>";

            if($sex1 == "M")
            {
                echo "<tr></tr><td><input type='radio' name='s1' value='M' checked='checked'>Male</td>";
                echo "<td><input type='radio' name='s1' value='F'> Female</td>";
            }
            elseif($sex1 == "F")
            {
                echo "<tr><td><input type='radio' name='s1' value='M'> Male</td>";
                echo "<td><input type='radio' name='s1' value='F' checked='checked'> Female</td>";
            }
            else
            {
                echo "<tr><td><input type='radio' name='s1' value='M'> Male</td>";
                echo "<td><input type='radio' name='s1' value='F'> Female</td>";
            }

            if($sex2 == "M")
            {
                echo "<td width='25px'/><td><input type='radio' name='s2' value='M' checked='checked'>Male</td>";
                echo "<td><input type='radio' name='s2' value='F'> Female</td></tr>";
            }
            elseif($sex2 == "F")
            {
                echo "<td width='25px'/><td><input type='radio' name='s2' value='M'> Male</td>";
                echo "<td><input type='radio' name='s2' value='F' checked='checked'> Female</td></tr>";
            }
            else
            {
                echo "<td width='25px'/><td><input type='radio' name='s2' value='M'> Male</td>";
                echo "<td><input type='radio' name='s2' value='F'> Female</td></tr>";
            }
            ?>
        </table>
        <input type="submit" value="Compare">
    </form>
</div>
<?
if($showText)
{
    displayComparativeFeedback();
}
?>
</body>
</html>
