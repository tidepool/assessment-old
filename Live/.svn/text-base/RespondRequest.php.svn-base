<?php

$id1= $_COOKIE['ID'];
$name1= $_COOKIE['name'];
$pic1= $_COOKIE['pic'];
$wt1= $_COOKIE['WTname'];

$id2= $_REQUEST['id2'];
$name2= $_REQUEST['name2'];
$pic2= $_REQUEST['pic2'];


include "dbConnect.php";
establishConnection();

$sql = sprintf("SELECT OneLiner FROM WorkTypesNew WHERE title='%s'",mysql_real_escape_string($wt1));
$result = mysql_query($sql);
$oneLiner1 = mysql_result($result, 0,  0);
mysql_free_result($result);

if ($_POST['acceptReq'] == "true")
{
    include_once "sendRespondEmail.php";

    $query = sprintf("SELECT Email,Name FROM SocialMediaUsers WHERE ID='%s'",mysql_real_escape_string($id2));
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $email = mysql_result($result, 0,  0);
    $friendName = mysql_result($result, 0,  1);

    //echo "<p>ID1 = $id1 and ID2 = $id2</p>";
    $sql1= sprintf("UPDATE SocialMediaFriends SET ID1Accepted=1 WHERE ID1='%s' AND ID2='%s'",mysql_real_escape_string($id1),mysql_real_escape_string($id2));
    $result1 = mysql_query($sql1);
    //echo "<p>Result1: $result1</p>";
    mysql_free_result($result1);

    $sql2= sprintf("UPDATE SocialMediaFriends SET ID2Accepted=1 WHERE ID1='%s' AND ID2='%s'",mysql_real_escape_string($id2),mysql_real_escape_string($id1));
    $result2 = mysql_query($sql2);
    //echo "<p>Result2: $result2</p>";
    mysql_free_result($result2);
    endConnection();

    //echo "<p>5</p>";
    sendRespondEmail($email,$_COOKIE['name'],$friendName);

    //echo "<p>6</p>";
    RequestSend();
}
else
{
    displayRequest();
}
function displayRequest()
{
    global $id1, $name1, $pic1, $wt1, $id2, $name2, $pic2, $oneLiner1;

    $sql = sprintf("SELECT Message FROM SocialMediaFriends WHERE ID1='%s' AND ID2='%s'",mysql_real_escape_string($id1),mysql_real_escape_string($id2));
    $result = mysql_query($sql);
    $msg = mysql_result($result, 0,  0);
    mysql_free_result($result);
    $num = strpos($name2," ");
    $first = substr($name2,0,$num);

    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
    <meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>TidePool</title>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="leanmodal.min.js" type="text/javascript"></script>
    <!-- leanModal - https://leanmodal.finelysliced.com.au/ -->
    <style type="text/css">
        body { margin: 0; padding: 0; background: none; overflow-x:hidden;overflow-y:hidden;}
    </style>
    <script type="text/javascript">
        $(function() {
            $('a[rel*=leanModal]').leanModal({ top : 150, overlay : 0.4, closeButton: ".modal_close" });
        });
        $(window).resize(function () {
            if(window.innerWidth > 960)
            {
                var num = (window.innerWidth - 560)/2;
                var text = num+"px";
                //alert(text);
                document.getElementById("qPrompt").style.left = text;
            }
        });
    </script>
    <script src="../masterHeader.js" type="text/javascript"></script>
    <script type="text/javascript">
        _kmq.push(['record', 'Viewed Respond Request']);
    </script>
</head>
<body>
<div id="wrap">
    <div id="cont">
        <div class="req-title"><?echo $name2;?> has requested that you allow for shared feedback</div>
        <div class="pairs-profile" style="height: 150px;">
            <div class="block">
                <div class="badge"><img src="https://s3.amazonaws.com/tidepool_images/Badges/<?echo $wt1;?>.png" width="100" height="100" /></div>
                <div class="pro-det">
                    <div class="tp-user">
                        <div class="headshot"><img src="<?echo $pic1;?>" width="30" height="30" /></div>
                        <div class="name"><?echo $name1;?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="work-type"><?echo $wt1;?></div>
                    <div class="short-desc"><?echo $oneLiner1;?></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="compare"></div>
            <div class="block-req">
                <div class="tp-req-user">
                    <div class="headshot"><img src="<?echo $pic2;?>" width="30" height="30" /></div>
                    <div class="name"><?echo $name2;?></div>
                    <div class="clear"></div>
                </div>
                <div class="tp-req-msg">
                    Sent you a request to share feedback
                </div>
            </div>
        </div>
        <div class="send-req">
        <form action="" method="post">
            <input type="hidden" name="id2" value="<?echo $id2;?>">
            <input type="hidden" name="acceptReq" value="true">
            <div class="req-msg"><strong>Message from <?echo $first;?>:</strong><br/><?echo $msg;?></div>
            <div class="request-btn"><button id="acceptRequest" type="submit" name="" value="" class="requ-btn">Accept Request</button></div>
        </div>
        </form>
    </div>
</div>
</body>
</html>
<?
}


function RequestSend()
{
    global $id1, $name1, $pic1, $id2, $name2, $pic2;

    ?>
<html>
<head>
</head>
<body>
<script type="text/javascript">
    parent.reloadFriends();
    parent.compareWorkTypes("<?echo $id2;?>","<?echo $name2;?>");
</script>
</body>
</html>
<?
}
?>