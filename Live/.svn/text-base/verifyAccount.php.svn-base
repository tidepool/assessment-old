<?
//echo "<p>beginning</p>";
if(isset($_REQUEST['acct']))
{
    //echo "<p>trying to reset</p>";
    $verifyCode = $_REQUEST['acct'];
    require_once "dbConnect.php";

    establishConnection();
    $query = sprintf("Select Email,Name From SocialMediaUsers WHERE Verification='%s'",mysql_real_escape_string($verifyCode));
    $result = mysql_query($query);
    mysql_fetch_row($result);
    if(!$result)
    {
        $err=mysql_error();
        echo "<p>$err</p>";
    }
    else if(mysql_affected_rows()==0)
    {
        $msg = "Sorry this is an invalid account";
        DisplayResetPage($msg,null,null,null,null);
    }
    else
    {
        $email = mysql_result($result,0,0);
        $name = mysql_result($result,0,1);


        $reset = uniqid('',true);
        $query1 = sprintf("UPDATE SocialMediaUsers SET Stage=0,Verification='$reset' WHERE Verification='%s'",mysql_real_escape_string($verifyCode));
        $result1 = mysql_query($query1) or die('Query failed: ' . mysql_error());
        mysql_free_result($result1);

        setcookie("logged",rand(1000000,9999999), time()+7200,"/", ".tidepool.co"); /* Expires in two hours */

        DisplayResetPage(null,$email,$name);

    }
    mysql_free_result($result);

    endConnection();

}
else
{
    $msg = "Sorry this link is an invalid";
    DisplayResetPage($msg,null,null,null,null);
}

function DisplayResetPage($error,$email,$name)
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
                            echo "<div class='title'>Welcome $name, thank you for verifying $email</div>";
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

    <? include_once "footer.php"; ?>
</body>
</html>
<?
}
?>