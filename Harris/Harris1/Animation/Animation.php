<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/anim.css" />
    <script language="javascript" src="js/anim.js">
    </script>
</head>
<body>
<div id="content"  style="width: 830px">
    <ul id="square_table" >
        <?
        for($i=1;$i<=60;$i++)
        {
            echo "<li id='square$i' class='grid'></li>\n";
        }
        ?>
    </ul>
    <p id="description">Sorting through 60 <span style="color:#e63948">TidePool</span> Work Types ...</p>
</div>
<script>
    timeMsg();
</script>
</body>
</html>


