<?
//echo "<p>beginning</p>";
if(isset($_REQUEST['reset']))
{
    //echo "<p>trying to reset</p>";
    $resetCode = $_REQUEST['reset'];
    require_once "dbConnect.php";

    establishConnection();
    $query = sprintf("Select Email,Name,ID From SocialMediaUsers WHERE Verification='%s'",mysql_real_escape_string($resetCode));
    $result = mysql_query($query);
    $temp = mysql_fetch_row($result);
    $unq = $temp[2];
    if(!$result)
    {
        $err=mysql_error();
        echo "<p>$err</p>";
    }
    else if(mysql_affected_rows()==0)
    {
        $msg = "Sorry this link is no longer valid";
        DisplayResetPage($msg,null,null,null,null);
    }
    else
    {
        $email = mysql_result($result,0,0);
        $name = mysql_result($result,0,1);
        //echo "<p>out check</p>";
        if(isset($_POST['password']) && isset($_POST['confirm']))
        {
            //echo "<p>in check</p>";
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];

            if(strlen($password) < 7 || strlen($password) > 15)
            {
                //echo "<p>in check1</p>";
                $msg = "Password must be between 7 and 15 characters long";
                DisplayResetPage($msg,$email,$name,$password,$confirm);
            }
            else if($confirm !== $password)
            {
                //echo "<p>in check2</p>";
                $msg = "Error: passwords do not match";
                DisplayResetPage($msg,$email,$name,$password,$confirm);
            }
            else
            {
                //echo "<p>in check3</p>";
                $reset = uniqid('');
                $reset = $unq.$reset;
                $query1 = sprintf("UPDATE SocialMediaUsers SET Password='%s',Verification='%s' WHERE Verification='%s'",mysql_real_escape_string($password),mysql_real_escape_string($reset),mysql_real_escape_string($resetCode));
                $result1 = mysql_query($query1) or die('Query failed: ' . mysql_error());
                mysql_free_result($result1);
                verifyPasswordReset();
            }
        }
        else
        {
            DisplayResetPage(null,$email,$name,$password,$confirm);
        }
    }
    mysql_free_result($result);

    endConnection();

}
else
{
    //echo "<p>trying to display</p>";
    $msg = "Sorry this link is no longer valid";
    DisplayResetPage($msg,null.null,null,null);
}


function verifyPasswordReset()
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
                        <div class="title">Thank you, your password has been reset</div>
                        <div align=center style="padding-top: 10px;"><a class="button" href="profile.php"><div class="begin-btn button">Visit Profile</div></a></div>
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

function DisplayResetPage($error,$email,$name,$password,$confirm)
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
                            echo "<div class='title'>Welcome $name, please reset your password</div>";
                        }
                        else
                        {
                            echo "<div class='mod-title' style='color: red;'>$error</div>";
                        }
                        if($email != null)
                        {
                            ?>
                            <form action="" method="post">
                                <label for="password">New Password:</label><input class="form-field post-signup-field" type="password" id="password" name="password" value="<?echo $password;?>"><br>
                                <label for="confirm">Confirm Password:</label><input class="form-field post-signup-field" type="password" id="confirm" name="confirm" value="<?echo $confirm;?>"><br>
                                <input type="submit" value="Reset Password" class="standard-btn">
                            </form>
                            <?
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    <? include_once "footer.php"; ?>
</body>
</html>
<?
}
?>