<?php
require_once "../Live/dbConnect.php";
function CheckLogin()
{
    $filename = $_SERVER['PHP_SELF'];
    $foldername = dirname($filename);
    if($_COOKIE['UniLogin'] == 'val1dUniL0g')
    {
        setcookie("UniLogin", 'val1dUniL0g', time()+3600,"/", ".tidepool.co"); /* Expires in an hour */
        if($foldername == "/Admin")
        {
            return true;
            //displayLinks();
        }
        else
        {
            return true;
        }
    }
    else if(isset($_POST['username']))
    {
        $password   = $_POST['password'];
        $name = $_POST['username'];

        establishConnection();

        $sql="SELECT Username,Email FROM Admins WHERE Username='$name' and Password='$password'";
        $result = mysql_query($sql);
        $temp = mysql_fetch_row($result);
        $emailLogin = $temp[1];
        if(!$result)
        {
            $err=mysql_error();
            displayLogin($err);
        }
        else if(mysql_affected_rows()==0)
        {
            displayLogin("Username/Password not in the system");
        }
        else
        {
            setcookie("UniLogin", 'val1dUniL0g', time()+3600,"/", ".tidepool.co"); /* Expires in 2 hours */
            setcookie("AdminEmail", $emailLogin, time()+7200,"/", ".tidepool.co"); /* Expires in an hour */
            if($foldername == "/Admin")
            {
                displayLinks();
            }
            else
            {
                return true;
            }
        }
        endConnection();
    }
    else
    {
        displayLogin("Welcome to our Admin System");
    }
}


function displayLinks()
{
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="http://tidepool.co/style/images/LogoHalf.png" type="image/png">
    <link rel="stylesheet" href="http://tidepool.co/style/adminpage.css"/>
    <title>Tidepool Admin</title>
</head>
<body align="center">
<div class="main" align="center">
    <div class="link"><a href="../assessment/GetResults.php">User Results</a></div>
    <div class="link"><a href="../assessment/GetUsers.php">User Info</a></div>
    <div class="link"><a href="../Tools/MailTo.php">Generate Login Email</a></div>
    <div class="link"><a href="../assessment/GetUsers.php">Create Login</a></div>
    <div class="link"><a href="../assessment/prototype/WorkType/LookUpWorkType.php">Work Type Info</a></div>
    <div class="link"><a href="../Comparative/CompareAmplify.php">Amplify Comparatives</a></div>
    <div class="link"><a href="../SocialMedia">Social Media</a></div>
    <div class="link"><a href="../Live/invite_fb.php">Facebook Invite</a></div>
    <div class="link"><a href="../Live/invite_in.php">LinkedIn Invite</a></div>
    <div class="link"><a href="../Live/splash.php">New Social Media</a></div>
    <div class="link"><a href="../Tools/Change WT.php">Change WT</a></div>
    <br>
    <div class="link"><a href="../Admin/eraseUniversal.php">Log out</a></div>
</div>
</body >
</html>
<?
}

function displayLogin($msg)
{
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="http://tidepool.co/style/images/LogoHalf.png" type="image/png">
    <link rel="stylesheet" href="http://tidepool.co/style/landingpage.css"/>
    <title>Tidepool</title>
</head>
<script>
    eg_on = new Image ( );
    eg_off = new Image ( );
    eg_on.src = "http://tidepool.co/style/images/login.png";
    eg_off.src = "http://tidepool.co/style/images/login_hover.png";
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
<body align="center">
<div class="main" align="center">
    <div class="title" id="title" align="center">

    </div>
    <br />
    <div class="form" align="center">
        <img src="http://tidepool.co/style/images/Logo.png" width="250"/>
        <div class="statement" ><?echo $msg;?></div>
        <div class="statement" style="font-size:16px;" align="center">
            <form action="" method="post">
                <table cellpadding="5px">
                    <tr><td align="right"><td align="center"> <input class="input" name="username"  value="Username"/></td></tr>
                    <tr><td align="right"><td align="center"> <input class="input" name="password" type="password" value="Password" /></td></tr>
                </table>
                <div align="center">
                    <br/>
                    <input type="image" class="login"
                           src="http://tidepool.co/style/images/login_hover.png" alt="Login" id="eg"">
                </div>
            </form>
        </div>
    </div>
</div>
</body >
</html>
<?
    return false;
}
?>