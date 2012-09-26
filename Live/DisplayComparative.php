<?php
include "dbConnect.php";

$wtName = $_COOKIE['WTname'];
$ID = $_COOKIE['ID'];
$name = $_COOKIE['name'];
$pic = $_COOKIE['pic'];

$ID2 = $_REQUEST['ID'];
//echo "<p>ID2 $ID2</p>";
establishConnection();

$query = sprintf("SELECT * FROM SocialMediaFriends WHERE ID1 = '%s' AND ID2 = '%s'",mysql_real_escape_string($ID),mysql_real_escape_string($ID2));
$result = mysql_query($query);
$temp = mysql_fetch_row($result);
if(!$result)
{
    $err=mysql_error();
    echo "<p>$err</p>";
}
else if(mysql_affected_rows()!=0)
{
    $query = sprintf("SELECT id,OneLiner FROM WorkTypesNew WHERE title = '%s'",mysql_real_escape_string($wtName));
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $wt1 = mysql_result($result, 0,  0);
    $oneLiner = mysql_result($result, 0,  1);
    mysql_free_result($result);

    $query = sprintf("SELECT WorkType,Name,Gender,Pic,WorkTypeTitle FROM SocialMediaUsers WHERE ID = '%s'",mysql_real_escape_string($ID2));
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $wt2 = mysql_result($result, 0,  0);
    $name2 = mysql_result($result, 0,  1);
    $sex2 = mysql_result($result, 0,  2);
    $pic2 = mysql_result($result, 0,  3);
    $wtName2 = mysql_result($result, 0,  4);
    mysql_free_result($result);

    //echo "<p>Name $name2</p>";
    $query = sprintf("SELECT OneLiner FROM WorkTypesNew WHERE id = '%s'",mysql_real_escape_string($wt2));
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $oneLiner2 = mysql_result($result, 0,  0);
    mysql_free_result($result);

    $wt1 = substr($wt1,0,2);
    $wt2 = substr($wt2,0,2);
    $code = $wt1.$wt2;
    $query = sprintf("SELECT * FROM ComparativeNew WHERE ID = '%s'",mysql_real_escape_string($code));
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $p1 = replaceNames(mysql_result($result, 0,  1));
    $p2 = replaceNames(mysql_result($result, 0,  2));
    $p3 = replaceNames(mysql_result($result, 0,  3));
    $b1 = array();
    $b1[] = replaceNames(mysql_result($result, 0,  4));
    $b1[] = replaceNames(mysql_result($result, 0,  5));
    $b1[] = replaceNames(mysql_result($result, 0,  6));
    $b1[] = replaceNames(mysql_result($result, 0,  7));
    $b1[] = replaceNames(mysql_result($result, 0,  8));
    $b2 = array();
    $b2[] = replaceNames(mysql_result($result, 0,  9));
    $b2[] = replaceNames(mysql_result($result, 0,  10));
    $b2[] = replaceNames(mysql_result($result, 0,  11));
    $b2[] = replaceNames(mysql_result($result, 0,  12));
    $b2[] = replaceNames(mysql_result($result, 0,  13));
    mysql_free_result($result);

    endConnection();
    //echo "<p>Num of Rows: $rows Num of Friends: $numFriends</p>"
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
    <meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Display Comparative</title>

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../jQuery/jquery.js"></script>
    <style type="text/css">
        body { margin: 0; padding: 0; background: none; overflow-x:hidden;}
    </style>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<h3>Pairs Feedback</h3>
<div class="pairs-profile">
    <div class="block">
        <div class="badge"><img src="https://s3.amazonaws.com/tidepool_images/Badges/<?echo $wtName;?>.png" width="100" height="100" /></div>
        <div class="pro-det">
            <div class="tp-user">
                <div class="headshot"><img src="<?echo $pic;?>" width="30" height="30" /></div>
                <div class="name"><?echo $name;?></div>
                <div class="clear"></div>
            </div>
            <div class="work-type"><?echo $wtName;?></div>
            <div class="short-desc"><?echo $oneLiner;?></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="compare"></div>
    <div class="block">
        <div class="pro-det">
            <div class="tp-user">
                <div class="headshot-right"><img src="<?echo $pic2;?>" width="30" height="30" /></div>
                <div class="name-right align-right"><?echo $name2;?></div>
                <div class="clear"></div>
            </div>
            <div class="work-type align-right"><?echo $wtName2;?></div>
            <div class="short-desc align-right"><?echo $oneLiner2;?></div>
        </div>
        <div class="badge-right"><img src="https://s3.amazonaws.com/tidepool_images/Badges/<?echo $wtName2;?>.png" width="100" height="100" /></div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

<div class="assessment">
    <p><?echo $p1;?></p>
    <p><?echo $p2;?></p>
    <p><?echo $p3;?></p>

    <div class="pairs-summary">
        <div class="tips">
            <div class="sum-title">Tips for Success</div>
            <br style="clear: both;">
            <?
            $count = 1;
            foreach($b1 as $b)
            {
                if($b == null)
                    break;
                ?>
                <span class="sum-num"><?echo $count.". ";?></span><div class="sum-point"><?echo $b;?></div>
                <?
                $count++;
            }
            ?>
            <div class="clear"></div>
        </div>

        <div class="avoid">
            <div class="sum-title">Things to Avoid</div>
            <br style="clear: both;">
            <?
            $count = 1;
            foreach($b2 as $b)
            {
                if($b == null)
                    break;
                ?>
                <span class="sum-num"><?echo $count.". ";?></span><div class="sum-point"><?echo $b;?></div>
                <?
                $count++;
            }
            ?>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!--
    <div align="center" style="overflow: auto">
        <div style="overflow: auto" class="fb-comments" data-href="https://tidepool.co/Live/DisplayComparative.php?comp=<?echo $ID."VS".$ID2;?>" data-num-posts="2" data-width="600"></div>
    </div>
    -->
</body>
</html>
<?
}
else
{
    echo "Error Users are not connected";
}

function replaceNames($string)// parses male or female pronouns
{
    Global $name2, $sex2;

    $name1 = $_COOKIE['name'];
    $num = strpos($name1," ");
    $name1 = substr($name1,0,$num);
    $sex1 = $_COOKIE['gender'];

    $num = strpos($name2," ");
    $namer2 = substr($name2,0,$num);

    $string = str_replace("firstname1",$name1,$string);
    $string = str_replace("firstname2",$namer2,$string);
    $string = str_replace("Firstname1",$name1,$string);
    $string = str_replace("Firstname2",$namer2,$string);

    if($sex1 == "M")
    {
        $string = str_replace("He/She1","He",$string);
        $string = str_replace("he/she1","he",$string);
        $string = str_replace("his/her1","his",$string);
        $string = str_replace("His/Her1","His",$string);
        $string = str_replace("him/her1","him",$string);
        $string = str_replace("Him/Her1","Him",$string);
    }
    else if($sex1 == "F")
    {
        $string = str_replace("He/She1","She",$string);
        $string = str_replace("he/she1","she",$string);
        $string = str_replace("his/her1","her",$string);
        $string = str_replace("His/Her1","Her",$string);
        $string = str_replace("him/her1","her",$string);
        $string = str_replace("Him/Her1","Her",$string);
    }

    if($sex2 == "M")
    {
        $string = str_replace("He/She2","He",$string);
        $string = str_replace("he/she2","he",$string);
        $string = str_replace("his/her2","his",$string);
        $string = str_replace("His/Her2","His",$string);
        $string = str_replace("him/her2","him",$string);
        $string = str_replace("Him/Her2","Him",$string);
    }
    else if($sex2 == "F")
    {
        $string = str_replace("He/She2","She",$string);
        $string = str_replace("he/she2","she",$string);
        $string = str_replace("his/her2","her",$string);
        $string = str_replace("His/Her2","Her",$string);
        $string = str_replace("him/her2","her",$string);
        $string = str_replace("Him/Her2","Her",$string);
    }
    return $string;
}
?>