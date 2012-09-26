<?php
$peeps = array(1,2,3,4,5);
$recs = array(6,7,8,9,10,11,12,13,14,15,26,17,18,19,20);
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
    <link rel="stylesheet" href="styles/referral.css" />
</head>
<body>
<div id="maincontent">
<div id="right_section" class="sections">
<ul id="profile_pics">
    <?
    for($i=0;$i<count($data)-4;$i++)
    {
        echo "<div id='profile01' class='profile'>";
        ?>
        <a class="profiles"><li><img src="images/facebook/<?echo getPeeps()?>.jpg"></li></a>
        <ul class="profile_bundle">
            <li class="profiletext"><?echo $data[$i];?></li>
            <li class="dot"><img src="images/facebook/<?echo getRecs();?>.jpg"</li>
            <li class="dot"><img src="images/facebook/<?echo getRecs();?>.jpg"</li>
            <li class="dot"><img src="images/facebook/<?echo getRecs();?>.jpg"</li>
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


function getPeeps()
{
    Global $peeps;
    $limit = count($peeps)-1;
    $var = rand(0,$limit);

    $img = $peeps[$var];
    array_splice($peeps, $var,1);
    return $img;
}

function getRecs()
{
    Global $recs;
    $limit = count($recs)-1;
    $var = rand(0,$limit);

    $img = $recs[$var];
    array_splice($recs, $var,1);
    return $img;
}

?>