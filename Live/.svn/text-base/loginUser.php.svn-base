<?
require_once "dbConnect.php";
include_once "SocialAPI.php";

establishConnection();
$error_msg = null;


if($_GET['LoginLI'] || isset($_REQUEST['oauth_verifier']))//check login with linkedin and continue hand shake
{
    echo "<p>try to login</p>";
    loginLI('https://stage.tidepool.co/Live/loginUser.php');
}
if(isset($_POST['email']) && isset($_POST['password']))// tried to log in
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    //echo "<p>Here 1</p>";
    $stage = verifyLogin($email,$password);//check to make sure it a match

    //echo "<p>Here 2 Stage $stage</p>";
    if($stage >= 0)
    {
        if($stage == -1)
        {
            goToVerify();
        }
        else if($stage == 0)
        {
            redirectToNew();
        }
        else if($stage == 1)
        {
            redirectToInvite();
        }
        elseif($stage >= 2)
        {
            redirectToProfile();
        }
    }
    else
    {
        $error_msg = "Email and Password do not match";
        DisplayLoginPage($error_msg,$email,$password);
    }
}
else// check for log in through social media
{
    $user = $facebook->getUser();
    if ($user) {
        //echo "<p>Here 6</p>";
        try {
            // Proceed knowing you have a logged in user who's authenticated.
            $user_profile = getFBUser();
        } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
            $fbError = true;
        }
        $stage = checkIfInFBSystem($user_profile);

        if($fbError)
        {
            $expired = true;
            displaySplashPage();
        }
        else if($stage == -1)
        {
            goToVerify();
        }
        else if($stage == 0)
        {
            redirectToNew();
        }
        else if($stage == 1)
        {
            redirectToInvite();
        }
        else if($stage >= 2)
        {
            redirectToProfile();
        }
        else
        {
            DisplayLoginPage("Sorry we do not have that account in our system",null,null);
        }
    }
    elseif(checkForLILogin())
    {
        loginLI('https://stage.tidepool.co/Live/loginUser.php');
        $user = getLIUser();
        $stage = checkIfInLISystem($user);


        if($stage == -1)
        {
            goToVerify();
        }
        else if($stage == 0)
        {
            redirectToNew();
        }
        else if($stage == 1)
        {
            redirectToInvite();
        }
        else if($stage >= 2)
        {
            redirectToProfile();
        }
        else
        {
            DisplayLoginPage("Sorry we do not have that account in our system",null,null);
        }
    }
    else
    {
        DisplayLoginPage(null,null,null);
    }
    endConnection();
}

function goToVerify()
{
    header('Location: waitingForVerification.php');
}

function redirectToNew()
{
    echo "<p>relocating</p>";
    header('Location: profile_new.php');
}

function redirectToProfile()
{
    header('Location: profile.php');
}

function redirectToInvite()
{
    header('Location: invite.php');
}

function redirectToHere()
{
    header('Location: splash.php');
}

function DisplayLoginPage($error,$email,$password)
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

    <script type="text/javascript">
        function HideTerms(name)
        {
            var elem = document.getElementById(name);
            elem.height = "0px";
        }
        function showTerms(id)
        {
            var elem = document.getElementById(id);
            elem.height = "200px";// controls size
        }
        function hidestatus()
        {
            window.status='';
            return true;
        }
        function goToFB()
        {
            window.location = "<? getFBLoginLink(); ?>";
        }

        if (document.layers)
            document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT);
        document.onmouseover=hidestatus;
        document.onmouseout=hidestatus;
    </script>
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
                        <div class="title">Login</div>
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
                            <label for="password">Password:</label><input class="form-field post-signup-field" type="password" id="password" name="password" value="<?echo $password;?>"><br>
                            <input type="submit" value="Login" class="standard-btn">
                        </form>
                        <div class="feedback-signup">
                            <p>Don't have a profile <a href="post_assessment.php">Sign Up</a></p>
                            <p><a href="forgotPassword.php">Forgot Password?</a></p>
                            <div class="login-fb"><a id="loginFacebookLink" onMouseOver="window.status='Login with Facebook'" href="javascript:goToFB();">Login with Facebook</a></div>
                            <div class="signup-or"></div>
                            <div class="login-in"><a id="loginLinkedLink" onMouseOver="window.status='Login with Facebook'" href="?LoginLI=7">Login with LinkedIn</a></div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="ps-tos"><a id="termsLink" href="javascript:showTerms('modal_c_ifrm');">Terms of Service</a></div>
                    <iframe id="modal_c_ifrm" src="i_terms.php?name=modal_c_ifrm" width="100%" height="0px" frameborder="0" border="0" cellspacing="0" style="border-style: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

</div>
    <form>
        <input type="hidden" name="box" value="2">
    </form>
    <? include_once "footer.php"; ?>
</body>
</html>
<?
}

function waitingForVerification()
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
                        <div class="title">Waiting for verification, please check your email</div>
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