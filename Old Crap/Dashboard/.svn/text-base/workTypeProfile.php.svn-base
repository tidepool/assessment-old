<?php
if(isset($_REQUEST['type']))
{
    require_once "workTypeGenerator.php";
    $amt = $_REQUEST['amt'];
    $type = $_REQUEST['type'];
    getWorkTypes($amt);
    $data = getTypeInfo($type);
    //print_r($data);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/stats.css" />
</head>
<body>
<div id="maincontent">
    <div id="left_section" class="sections">
        <ul id="worktype_full">
            <li id="block1" class="filter">"<?echo $data['title']?>"</li>
            <li id="block2" class="description"><?echo $data['desc']?></li>
        </ul>
    </div>
<div id="right_section" class="sections">
<ul id="profile_pics">
    <div id="sep" class="categories">
        <li class="categorytext">Skills | Experience | Psychology</li>
    </div>
    <?
    for($i=0;$i<count($data)-4;$i++)
    {
        echo "<div id='profile01' class='profile'>";
        ?>
        <a class="profiles"><li><img src=""></li></a>
        <ul class="profile_bundle">
            <li class="profiletext"><?echo $data[$i];?></li>
            <li class="dot"><img src="images/<?echo getRandomButton();?>.png"</li>
            <li class="dot"><img src="images/<?echo getRandomButton();?>.png"</li>
            <li class="dot"><img src="images/<?echo getRandomButton();?>.png"</li>
        </ul>
                </div>
                <?
    }
    ?>
</div>
</div>

</body>
</html>
<?
}

function getRandomButton()
{
    $var = rand(1,3);

    if($var == 1)
    {
        return "reddot";
    }
    else if($var == 2)
    {
        return "yellowdot";
    }
    else if($var == 3)
    {
        return "greendot";
    }
}
?>