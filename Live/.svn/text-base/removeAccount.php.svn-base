<?
//echo "<p>beginning</p>";
if(isset($_REQUEST['acct']))
{
    //echo "<p>trying to reset</p>";
    $verifyCode = $_REQUEST['acct'];
    require_once "dbConnect.php";

    establishConnection();
    $query = sprintf("Select Email,FacebookID,LinkedID From SocialMediaUsers WHERE Verification='%s'",mysql_real_escape_string($verifyCode));
    $result = mysql_query($query);
    mysql_fetch_row($result);
    if(!$result)
    {
        $err=mysql_error();
        echo "<p>$err</p>";
    }
    else if(mysql_affected_rows()==0)
    {
        $msg = "This account is not in our system";
        DisplayResetPage($msg,null);
    }
    else
    {
        $email = mysql_result($result,0,0);
        $FB_ID = mysql_result($result,0,1);
        $LI_ID = mysql_result($result,0,2);

        $query1 = sprintf("DELETE * From SocialMediaUsers WHERE Verification='%s'",mysql_real_escape_string($verifyCode));
        $result1 = mysql_query($query1);
        mysql_free_result($result1);

        if($FB_ID != "NULLIE")
        {
            $query = sprintf("UPDATE SocialMediaFriends SET ID1Deactivated=3 WHERE ID1='%s'",mysql_real_escape_string($FB_ID));
            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            mysql_free_result($result);

            $query = sprintf("UPDATE SocialMediaFriends SET ID2Deactivated=3 WHERE ID2='%s'",mysql_real_escape_string($FB_ID));
            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            mysql_free_result($result);
        }
        if($LI_ID != "NULLIE")
        {
            $query = sprintf("UPDATE SocialMediaFriends SET ID1Deactivated=3 WHERE ID1='%s'",mysql_real_escape_string($LI_ID));
            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            mysql_free_result($result);

            $query = sprintf("UPDATE SocialMediaFriends SET ID2Deactivated=3 WHERE ID2='%s'",mysql_real_escape_string($LI_ID));
            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            mysql_free_result($result);
        }

        DisplayResetPage(null,$email);
    }

    mysql_free_result($result);

    endConnection();

}
else
{
    $msg = "Sorry this link is an invalid";
    DisplayResetPage($msg);
}

function DisplayResetPage($error,$email)
{
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
    <script src="../masterHeader.js" type="text/javascript"></script>
    <script src="../uvHeader.js" type="text/javascript"></script>
    <script type="text/javascript">
        _kmq.push(['set', {'WorkType':'<?echo $_COOKIE['WTname'];?>'}]);
    </script>
</head>

<body>
<div id="wrap">
    <div id="header">
        <div class="logo"><a href="splash.php">TidePool</a></div>
    </div>


    <div id="cont">
        <div class="post-assess">
            <div class="post-assess-cont">
                <div class="post-signup">
                    <div class="worktype">
                        <div class="badge"><img src="https://s3.amazonaws.com/tidepool_images/Badges/Logo.png" width="100" height="100" /></div>
                        <?
                        if($error == null)
                        {
                            echo "<div class='title'>We have removed $email from our system</div>";
                            ?>
                            <div align=center style="padding-top: 10px;"><a class="button" href="profile_new.php"><div class="begin-btn button">Visit Profile</div></a></div>
                            <?
                        }
                        else
                        {
                            echo "<div class='mod-title' style='color: red;'>$error</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="footer">
    <div class="left">
        <ul class="links">
            <li><a href="splash.php">Home</a></li>
            <li><a href="team.html">Team</a></li>
            <li><a href="investors.html">Investors</a></li>
            <li><a href="mailto:info@tidepool.co">Contact</a></li>
            <li><a href="terms_conditions.html">Terms and Conditions</a></li>
            <li><a href="privacy_policy.html">Privacy Policy</a></li>
        </ul>
        <br/>
        <div class="copyright">&copy; Copyright 2012 TidePool, Inc. All Rights Reserved.</div>
    </div>

    <div class="right">
        <ul class="connect">
            <li class="fb"><a id="facebookLink" href="https://www.facebook.com/pages/Tidepool-Inc/193445914068454" target="_blank">Facebook</a></li>
            <li class="in"><a id="linkedLink" href="https://www.linkedin.com/company/2427695" target="_blank">Linkedin</a></li>
            <li class="tw"><a id="twitterLink" href="https://twitter.com/#!/TidePoolInc" target="_blank">Twitter</a></li>
        </ul>
    </div>
</div>
</body>
</html>
<?
}
?>