<?php

$id1= $_COOKIE['ID'];
$name1= $_COOKIE['name'];
$pic1= $_COOKIE['pic'];
$wt1= $_COOKIE['WTname'];

$id2= $_REQUEST['id2'];
$name2= $_REQUEST['name2'];
$pic2= $_REQUEST['pic2'];


$num = strpos($name2," ");
$first = substr($name2,0,$num);


include "dbConnect.php";
establishConnection();

$sql = sprintf("SELECT OneLiner FROM WorkTypesNew WHERE title='%s'",mysql_real_escape_string($wt1));
$result = mysql_query($sql);
$oneLiner1 = mysql_result($result, 0,  0);
mysql_free_result($result);

endConnection();
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
        _kmq.push(['record', 'Viewed Pending Request']);
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
                    Invitation Still Pending
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>