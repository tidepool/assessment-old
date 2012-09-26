<?php
require_once "dbConnect.php";
$wt = $_COOKIE['WTname'];
$ID = $_COOKIE['ID'];

establishConnection();

$query = "SELECT * FROM WorkTypesNew WHERE title = '".$wt."'";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$temp = mysql_fetch_row($result);
$title = $temp[1];
$p1 = $temp[2];
$p2 = $temp[3];
$p3 = $temp[4];
$oneLiner = $temp[5];
$bullet1 = $temp[6];
$bullet2 = $temp[7];
$bullet3 = $temp[8];
mysql_free_result($result);


$query = "SELECT Bullet1,Bullet2,Bullet3 FROM WorkTypeAccuracy WHERE ID = '".$ID."'";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$temp = mysql_fetch_row($result);
$accuracy1 = $temp[0];
$accuracy2 = $temp[1];
$accuracy3 = $temp[2];
mysql_free_result($result);

endConnection();
//echo "<p>Num of Rows: $rows Num of Friends: $numFriends</p>"
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Display WorkType</title>

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../jQuery/jquery.js"></script>
    <style type="text/css">
        body { margin: 0; padding: 0; background: none; overflow-x:hidden;}
    </style>
    <script type="text/javascript">
        function setAccuracy(num,value,id)
        {
            var params;
            if(value > 0)
            {
                document.getElementById(id+"Yes").style.backgroundPosition = '0 -19px';
                document.getElementById(id+"No").style.backgroundPosition = '0 0';
                params = "bullet="+num+"&value="+value;
            }
            else
            {
                document.getElementById(id+"No").style.backgroundPosition = '0 -19px';
                document.getElementById(id+"Yes").style.backgroundPosition = '0 0';
            }

            params = "id=<?echo $ID;?>&bullet="+num+"&value="+value;

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            //alert(params);
            $.ajax({
                type: "POST",
                url: "http://tidepool.co/Posts/PostAccuracy.php",
                data: params,
                success: function() {
                    //alert("<h2>Contact Form Submitted!</h2>");
                }
            });
        }
    </script>
</head>
<body>
    <div class="assessment">
        <h3>Assessment Feedback</h3>
    <p><?echo $p1;?></p>
    <p><?echo $p2;?></p>
    <p><?echo $p3;?></p>
    <?
    if(!isset($_REQUEST['noFeedback']))
    {
        ?>
        <div class="summary">
            <div class="title">Summary Points</div>
            <div class="point">
                <div class="desc">1. <?echo $bullet1;?></div>
                <div class="accuracy">
                    <div class="yes"><a id="bullet1Yes" href="javascript:setAccuracy(1,1,'bullet1');">Yes</a></div>
                    <div class="no"><a id="bullet1No" href="javascript:setAccuracy(1,-1,'bullet1');">No</a></div>
                    <div class="label">Is this accurate?</div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="point">
                <div class="desc">2. <?echo $bullet2;?></div>
                <div class="accuracy">
                    <div class="yes"><a id="bullet2Yes" href="javascript:setAccuracy(2,1,'bullet2');">Yes</a></div>
                    <div class="no"><a id="bullet2No" href="javascript:setAccuracy(2,-1,'bullet2');">No</a></div>
                    <div class="label">Is this accurate?</div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="point">
                <div class="desc">3. <?echo $bullet3;?></div>
                <div class="accuracy">
                    <div class="yes"><a id="bullet3Yes" href="javascript:setAccuracy(3,1,'bullet3');">Yes</a></div>
                    <div class="no"><a id="bullet3No" href="javascript:setAccuracy(3,-1,'bullet3');">No</a></div>
                    <div class="label">Is this accurate?</div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <?
    }
    ?>
</div>
<script type="text/javascript">
    <?
    if($accuracy1 == 1)
    {
        echo 'document.getElementById("bullet1Yes").style.backgroundPosition = "0 -19px";';
    }
    elseif($accuracy1 == -1)
    {
        echo 'document.getElementById("bullet1No").style.backgroundPosition = "0 -19px";';
    }

    if($accuracy2 == 1)
    {
        echo 'document.getElementById("bullet2Yes").style.backgroundPosition = "0 -19px";';
    }
    elseif($accuracy2 == -1)
    {
        echo 'document.getElementById("bullet2No").style.backgroundPosition = "0 -19px";';
    }

    if($accuracy3 == 1)
    {
        echo 'document.getElementById("bullet3Yes").style.backgroundPosition = "0 -19px";';
    }
    elseif($accuracy3 == -1)
    {
        echo 'document.getElementById("bullet3No").style.backgroundPosition = "0 -19px";';
    }
    ?>
</script>
</body>
</html>