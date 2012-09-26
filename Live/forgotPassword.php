<?
//echo "<p>beginning</p>";
if(isset($_POST['email']))
{
    //echo "<p>trying to reset</p>";
    $email = $_POST['email'];
    require_once "dbConnect.php";

    establishConnection();
    $query = "Select Name, Verification From SocialMediaUsers WHERE Email='$email'";
    $result = mysql_query($query);
    mysql_fetch_row($result);
    if(!$result)
    {
        $err=mysql_error();
        echo "<p>$err</p>";
    }
    else if(mysql_affected_rows()==0)
    {
        $msg = "We do not have this email address in our system";
        DisplayForgotPage($msg,$email);
    }
    else
    {
        require_once "Emails/sendPasswordReset.php";
        $name = mysql_result($result,0,0);
        $ext = mysql_result($result,0,1);
        $link = "https://www.tidepool.co/Live/resetPassword.php?reset=".$ext;
        resetPassword($email,$name,$link);
        verifyEmailSent();
    }
    mysql_free_result($result);

    endConnection();

}
else
{
    //echo "<p>trying to display</p>";
    DisplayForgotPage(null,null);
}


function verifyEmailSent()
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
                        <div class="title">Please check your email for instructions to reset your password</div>
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

function DisplayForgotPage($error,$email)
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
                        <div class="title">Please enter the email registered to your account</div>
                        <?
                        if($error != null)
                        {
                            ?>
                            <div class="mod-title" style="color: red;"><?echo $error;?></div>
                            <?
                        }
                        ?>
                        <form action="" method="post">
                            <label for="email">Email:</label><input class="form-field post-signup-field" type="text" id="email" name="email" value="<?echo $email;?>"><br>
                            <input type="submit" value="Reset Password" class="standard-btn">
                        </form>
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