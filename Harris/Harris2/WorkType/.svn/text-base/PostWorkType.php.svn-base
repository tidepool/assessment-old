<?php
include_once "../../Live/dbConnect.php";

$password = $_REQUEST['password'];
$ID = $_COOKIE['ID'];
if($ID != null || $password == "tr0janT1de")
{
    //include_once "../../Comparative/Algorithms.php";
    establishConnection();

    $query = "SELECT SubDimension FROM CloudsScoring WHERE id = '".$ID."'";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    $temp = mysql_fetch_row($result);
    $holland = $temp[0];
    mysql_free_result($result);

    $query = "SELECT Dimension FROM FramesModelScoreWithSpace WHERE id = '".$ID."'";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    $temp = mysql_fetch_row($result);
    $personality = $temp[0];
    mysql_free_result($result);

    //echo "<h1> Work Type Code: ".$personality.$holland."</h1>";

    $code = $personality.$holland;
    $query = "SELECT * FROM WorkTypesNew WHERE id = '".$code."'";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    $temp = mysql_fetch_row($result);
    //$personality = $temp[0];
    $p1 = "".$temp[2];
    $p2 = "".$temp[3];
    $p3 = "".$temp[4];
    $title = $temp[1];
    mysql_free_result($result);

    $query = "Select * FROM SocialSharing WHERE ID='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    $exists = $temp[0];
    mysql_free_result($result);
    if(strlen($exists) < 1)
    {

    $query = "INSERT INTO SocialSharing VALUES ('$ID',0,0,0,0,0,0);";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    }
    ?>
<html>
<head>
    <link rel="stylesheet" href="workType.css" />
    <script type="text/javascript" src="http://tidepool.co/jQuery/jquery.js"></script>
    <script type="text/javascript">
        var t1;
        var t2;
        var alpha;
        function shareCall(ref)
        {
            var type;
            alpha = 1;
            if(ref==1)
                type="Facebook";
            else if(ref==2)
                type="LinkedIn";
            else if(ref==3)
                type="Twitter";
            else if(ref==4)
                type="Facebook";
            else if(ref==5)
                type="LinkedIn";
            else if(ref==6)
                type="Twitter";

            error_msg.innerHTML="We're not ready to share TidePool on "+type+" just yet, but we're very pleased to know you want to!\nWe'll let you know when we add this feature in the near future.";
            alpha = 1;
            clearTimeout(t2);
            error_msg.style.opacity = alpha;
            t1 = setTimeout("fade()",4500);

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            $.ajax({
                type: "POST",
                url: "http://tidepool.co/assessment/prototype/Posts/PostSocial.php",
                data: "ID=<?echo $ID;?>&choice="+ref,
                success: function() {
                    //alert("<h2>Contact Form Submitted!</h2>");
                }
            });
        }

        function fade()
        {
            if(alpha < 0)
            {
                clearTimeout(t2);
                return;
            }
            else
            {
                clearTimeout(t1);
                error_msg.style.opacity = alpha;
                alpha -= 0.05;
                t2 = setTimeout("fade()",100);
            }
        }

        eg_on = new Image ( );
        eg_off = new Image ( );
        eg_on.src = "../images/continue_hover.png";
        eg_off.src = "../images/continue.png";
        function button_on ( imgId )
        {
            if ( document.images )
            {
                butOn = eval ( imgId + "_on.src" );
                document.getElementById(imgId).src = butOn;
            }
        }

        function button_off ( imgId )
        {
            if ( document.images )
            {
                butOff = eval ( imgId + "_off.src" );
                document.getElementById(imgId).src = butOff;
            }
        }
    </script>
</head>
<body>
<title>Work Type</title>

<div align="center">
    <p class="feedbackheader" style="font-size: 36; text-align: center;"><?echo $title?></p>
    <p class="feedback"><?echo $p1;?></p>
    <p class="feedback"><?echo $p2;?></p>
    <p class="feedback"><?echo $p3;?></p>

    <pre class="error_msg"><span id="error_msg"></span></pre>
    <div class="social_container">
        <p class="titles">Share your <B>Results</B></p>
        <p class="titles" style="padding-left: 90px">Share the <B>Test</B></p>
        <div class="button_group">
            <a class="button" href="javascript:shareCall(1);" ><img src="../images/facebook_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(2);" ><img src="../images/linkedin_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(3);" ><img src="../images/twitter_icon.png" alt=""></a>
        </div>
        <div class="button_group" style="padding-left: 55px">
            <a class="button" href="javascript:shareCall(4);" ><img src="../images/facebook_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(5);" ><img src="../images/linkedin_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(6);" ><img src="../images/twitter_icon.png" alt=""></a>
        </div>
    </div>
    <br/>
    <input class="print" type="button" onClick="window.print()" value="Print Your WorkType"/>
    <br/>
    <a href="../Feedback.php">
        <?
        $agent = getenv("HTTP_USER_AGENT");
        if (preg_match("/MSIE/i", $agent))
        {
            $result = "You are using Microsoft Internet Explorer.";
            echo "<h1>Click to Continue</h1>";
        }
        else
        {
            $result = "You are using $agent";
            ?>
        <input type="image" class="login" onmouseout="button_off('eg');"
               onmouseover="button_on('eg');"
               src="../images/continue.png" alt="Login" id="eg"">
        <?
        }
        ?>
    </a>
</div>
</body>
</html>
<?
    $query = "UPDATE UserInfo SET WorkType='".$code."' WHERE id='$ID';";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    endConnection();
}
else
{
    echo "<h3>Invalid Password</h3>";
}

?>