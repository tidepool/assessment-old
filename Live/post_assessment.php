<?
require_once "../Admin/UniversalLogin.php";
require_once "dbConnect.php";
require_once "SocialAPI.php";

$type = $_COOKIE['SMType'];

$error_msg = null;
if($_GET['LoginLI'] || isset($_REQUEST['oauth_verifier']))//check login with linkedin and continue hand shake
{
    //echo "<p>try to login</p>";
    loginLI('https://stage.tidepool.co/Live/post_assessment.php');
}
if($_COOKIE['logged'] == "Verify")
{
    alreadyLoggedIn();
}
else if(strlen($_COOKIE['logged']) > 3)
{
    alreadyLoggedIn();
}
else if($_COOKIE['WTname'] == null)
{
    takeAssessment();
}
else if(isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['confirm']))// user trying to sign up
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $gender = $_POST['gender'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))//check email
    {
        $error_msg = "Invalid Email";
        DisplaySignUpPage($error_msg,$name,$email,$password,$confirm,$gender);
    }
    elseif(strlen($password) < 7 || strlen($password) > 15)
    {
        $error_msg = "Password must be between 7 and 15 characters long";
        DisplaySignUpPage($error_msg,$name,$email,$password,$confirm,$gender);
    }
    elseif($password != $confirm)
    {
        $error_msg = "Passwords do not match";
        DisplaySignUpPage($error_msg,$name,$email,$password,$confirm,$gender);
    }
    else
    {
        $success = signUpUser($name,$email,$password,$gender);
        if($success)
        {
            goToVerify();
        }
        else
        {
            $error_msg = "Email already registered with an account";
            DisplaySignUpPage($error_msg,$name,$email,$password,$confirm,$gender);
        }
    }
}
else// get user information from social network
{
    $user = $facebook->getUser();
    //echo "<p>user1 $user</p>";
    if ($user) {
        try {
            $user_profile = getFBUser();
            //echo "<p>user2</p>";
            //print_r($user_profile);
            if($user_profile['gender'] == "male")
            {
                DisplaySignUpPage(null,$user_profile['name'],$user_profile['email'],null,null,'M');
            }
            else if($user_profile['gender'] == "female")
            {
                DisplaySignUpPage(null,$user_profile['name'],$user_profile['email'],null,null,'F');
            }
        } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
            redirectToHere();
        }
    }
    elseif(checkForLILogin())
    {
        loginLI('https://stage.tidepool.co/Live/post_assessment.php');
        $user = getLIUser();
        DisplaySignUpPage(null,$user['name'],null,null,null,null);
    }
    else
    {
        DisplaySignUpPage(null,null,null,null,null,null);
    }
}

function goToVerify()
{
    header('Location: waitingForVerification.php');
}

function redirectToHere()
{
    header('Location: splash.php');
}

function alreadyLoggedIn()
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
        <div class="logo"><a>TidePool</a></div>
    </div>

    <div id="cont">
        <div class="post-assess">
            <div class="post-assess-cont">
                <div class="post-signup">
                    <div class="worktype">
                        <h6>Trying to Sign Up?</h6>
                        <div class="badge"><img src="https://s3.amazonaws.com/tidepool_images/Badges/Logo.png" width="100" height="100" /></div>
                        <div class="title">It looks like you are already logged in</div>
                        <div align=center style="padding-top: 10px;"><a class="button" href="profile.php"><div class="begin-btn button">Visit Profile</div></a></div>
                    </div>
                    <p>Want to <a href="splash.php?signout=true">sign out</a>?</p>
                    <div class="ps-tos"><a id="termsLink" href="javascript:showTerms('modal_c_ifrm');">Terms of Service</a></div>
                    <iframe id="modal_c_ifrm" src="i_terms.php?name=modal_c_ifrm" width="100%" height="0px" frameborder="0" border="0" cellspacing="0" style="border-style: none;"></iframe>
                </div>
            </div>
        </div>

    </div>

</div>

<div id="footer">
    <div class="left">
        <div class="copyright">&copy; Copyright 2012 TidePool, Inc. All Rights Reserved.</div>
    </div>
</div>
</body>
</html>
<?
}

function takeAssessment()
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
        <div class="logo"><a>TidePool</a></div>
    </div>

    <div id="cont">
        <div class="post-assess">
            <div class="post-assess-cont">
                <div class="post-signup">
                    <div class="worktype">
                        <h6>Get Your WorkType</h6>
                        <div class="badge"><img src="https://s3.amazonaws.com/tidepool_images/Badges/Logo.png" width="100" height="100" /></div>
                        <div class="title">Please take our assessment before signing up</div>
                        <div align=center style="padding-top: 10px;"><a class="button" href="../html5/index.php"><div class="begin-btn button">Get Started</div></a></div>
                    </div>
                    <p>Already have a profile <a href="loginUser.php">Login</a></p>
                    <div class="ps-tos"><a id="termsLink" href="javascript:showTerms('modal_c_ifrm');">Terms of Service</a></div>
                    <iframe id="modal_c_ifrm" src="i_terms.php?name=modal_c_ifrm" width="100%" height="0px" frameborder="0" border="0" cellspacing="0" style="border-style: none;"></iframe>
                </div>
            </div>
        </div>

    </div>

</div>

<div id="footer">
    <div class="left">
        <div class="copyright">&copy; Copyright 2012 TidePool, Inc. All Rights Reserved.</div>
    </div>
</div>
</body>
</html>
<?
}

function DisplaySignUpPage($error,$name,$email,$password,$confirm,$gender)
{
    establishConnection();

    $query = "SELECT OneLiner FROM WorkTypesNew WHERE Title='".$_COOKIE['WTname']."';";
    $result = mysql_query($query);
    $liner = mysql_result($result,0,0);
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

    <script type="text/javascript">
        function HideTerms(name)
        {
            var elem = document.getElementById(name);
            elem.height = "0px";
        }
        function showTerms(id) {
            var elem = document.getElementById(id);
            elem.height = "200px";// controls size
        }
        function goToFB()
        {
            window.location = "<? getFBLoginLink(); ?>";
        }
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
        <div class="logo"><a>TidePool</a></div>
    </div>

    <div id="cont">
        <div class="post-assess">
            <div class="post-assess-cont">
                <div class="worktype">
                    <h6>Out of 60 WorkTypes, You Are</h6>
                    <div class="badge"><img src="https://s3.amazonaws.com/tidepool_images/Badges/<?echo  $_COOKIE['WTname'];?>.png" width="100" height="100" /></div>
                    <div class="title"><? echo  $_COOKIE['WTname'];?></div>
                    <div class="rl"></div>
                    <div class="desc" style="text-align: left;"><? echo $liner;?></div>
                </div>

                <div class="post-signup">
                    <p><b>Sign up now to get more in-depth feedback about your WorkType</b></p>
                    <?
                    if($error != null)
                    {
                        ?>
                        <div class="mod-title" style="color: red;"><?echo $error;?></div>
                        <?
                    }
                    ?>
                    <form action="" method="post">
                        <label for="name">Name:</label><input class="form-field post-signup-field" type="text" id="name" name="name" value="<?echo $name;?>"><br>
                        <label for="email">Email:</label><input class="form-field post-signup-field" type="text" id="email" name="email" value="<?echo $email;?>"><br>
                        <label for="password">Password:</label><input class="form-field post-signup-field" type="password" id="password" name="password" value="<?echo $password;?>"><br>
                        <label for="confirm">Confirm Password:</label><input class="form-field post-signup-field" type="password" id="confirm" name="confirm" value="<?echo $confirm;?>"><br>
                        <?
                        if($gender == "F")
                        {
                            ?>
                            <label for="confirm">Gender: </label><input class="form-radio" type="radio" name="gender" value="M"><span class="radioLevel">Male</span><input class="form-radio" type="radio" name="gender" value="F" checked="checked"><span class="radioLevel">Female</span>
                            <?
                        }
                        else
                        {
                            ?>
                            <label for="confirm">Gender: </label><input class="form-radio" type="radio" name="gender" value="M" checked="checked"><span class="radioLevel">Male</span><input class="form-radio" type="radio" name="gender" value="F"><span class="radioLevel">Female</span>
                            <?
                        }
                        ?>
                        <br>
                        <input type="submit" value="Sign Up" class="standard-btn">
                    </form>
                    <div class="feedback-signup">
                        <div class="signup-fb"><a id="signUpFacebookLink" href="javascript:goToFB();">Sign Up with Facebook</a></div>
                        <div class="signup-or"></div>
                        <div class="signup-in"><a id="signUpLinkedLink" href="?LoginLI=7">Sign Up with LinkedIn</a></div>
                        <div class="clear"></div>
                    </div>
                    <div class="ps-tos"><a id="termsLink" href="javascript:showTerms('modal_c_ifrm');">Terms of Service</a></div>
                    <iframe id="modal_c_ifrm" src="i_terms.php?name=modal_c_ifrm" width="100%" height="0px" frameborder="0" border="0" cellspacing="0" style="border-style: none;"></iframe>
                </div>
            </div>
        </div>

    </div>

</div>

<div id="footer">
    <div class="left">
        <div class="copyright">&copy; Copyright 2012 TidePool, Inc. All Rights Reserved.</div>
    </div>
</div>
</body>
</html>
<?
}
?>