<?php
require_once "workTypeGenerator.php";
$amt = $_REQUEST['amt'];
$workType = getWorkTypes($amt);
//print_r($workType);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/grid.css" />
    <script>
        function getInfo(type)
        {
            parent.document.getElementById("stats").setAttribute('src', 'workTypeProfile.php?amt=<?echo $amt;?>&type='+type);
            parent.scrollWin();
        }
    </script>
</head>
<body>
<div id="content"  style="width: 830px">
    <ul id="square_table">
        <?
        $counter = 0;
        foreach($workType as $type)
        {
            $counter++;
            echo "<li id='square$counter' name='".$type['name']."'class='grid' onclick='javascript:getInfo(\"".$type['name']."\");'>\n";
            echo "<span align=\"center\" class='gridtext'>".$type['title']."<br/><p class=\"percentage\">".$type['percent']."%</p></span>\n";
            echo "</li>\n";
        }
        ?>
    </ul>
</div>
</body>
</html>


