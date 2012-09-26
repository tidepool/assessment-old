<?php
//3431259
$id1= $_COOKIE['ID'];
$name1= $_COOKIE['name'];
$pic1= $_COOKIE['pic'];
$wt1= $_COOKIE['WTname'];

$id2= $_REQUEST['id2'];
$name2= $_REQUEST['name2'];
$pic2= $_REQUEST['pic2'];
//echo "<p>ID1 = $id1 and ID2 = $id2</p>";

include "dbConnect.php";
establishConnection();

$sql = sprintf("SELECT OneLiner FROM WorkTypesNew WHERE title='%s'",mysql_real_escape_string($wt1));
$result = mysql_query($sql);
$oneLiner1 = mysql_result($result, 0,  0);
mysql_free_result($result);

if (isset($_POST['requestFriend']))
{
    include_once "sendRequestedEmail.php";

    $query = sprintf("SELECT FacebookID,LinkedID,WorkTypeTitle FROM SocialMediaUsers WHERE ID='%s'",mysql_real_escape_string($id1));
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $id1_FB = mysql_result($result, 0,  0);
    $id1_LI = mysql_result($result, 0,  1);
    $friendWT = mysql_result($result, 0,  2);


    $query = sprintf("SELECT Email,Name FROM SocialMediaUsers WHERE ID='%s'",mysql_real_escape_string($id2));
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $email = mysql_result($result, 0,  0);
    $friendName = mysql_result($result, 0,  1);

    $msg = $_POST['requestFriend'];
    $msg = addslashes($msg);
    //echo "<P>ID1 is $id1 and ID2 is $id2 and message is $msg</P>";
    $sql = sprintf("UPDATE SocialMediaFriends SET ID1Accepted=1,Message='$msg' WHERE ID1='%s' AND ID2='%s'",mysql_real_escape_string($id1),mysql_real_escape_string($id2));
    $result = mysql_query($sql);
    mysql_free_result($result);

    $sql = sprintf("UPDATE SocialMediaFriends SET ID2Accepted=1,Message='$msg' WHERE ID1='%s' AND ID2='%s'",mysql_real_escape_string($id2),mysql_real_escape_string($id1));
    $result = mysql_query($sql);
    mysql_free_result($result);
    //echo "<p>here 11</p>";
    sendRequestedEmail($email,$_COOKIE['name'],$friendName,$friendWT,$msg);
    //echo "<p>here 12</p>";
    RequestSend();
}
else
{
    displayRequest();
}
function displayRequest()
{
    global $id1, $name1, $pic1, $wt1, $oneLiner1, $id2, $name2, $pic2;
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
        _kmq.push(['record', 'Viewed Send Request']);
    </script>
</head>
<body>
<div id="wrap">
    <div id="cont">

        <!--
        <div class="pairs-profile">
            <div class="block">
                <div class="badge"><img src="images/Badges/<?echo $wt1;?>.png" width="100" height="100" /></div>
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
                    Send <?echo $first;?> a request to share
                </div>
            </div>
        </div>


            <?echo $first;?> has a private TidePool profile.<br>
-->
        <div class="req-title">Send <?echo $first;?> a request to view your shared feedback
        </div>
        <form action="" method="post">
            <input type="hidden" name="id2" value="<?echo $id2;?>">
            <div class="send-req">
                <div class="msg" ><textarea type="text" onclick="value=''" name="requestFriend">Let's see how we match in TidePool. Please accept this share request.</textarea></div>
                <div class="request-btn"><button id="sendRequest" type="submit" name="" value="" class="requ-btn">Send Request</button></div>
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
    global $id1, $name1, $pic1, $wt1, $oneLiner1, $id2, $name2, $pic2;

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
        _kmq.push(['record', 'Sent Request']);
    </script>
</head>
<body>
<div id="wrap">
    <div id="cont">
        <div class="req-title">Your request has been sent to <?echo $first;?></div>
        <div class="pairs-profile">
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
                    Request Sent
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    parent.reloadFriends();
</script>
</body>
</html>
<?
}
?>