<?php
echo "<p>Stage 2</p>";
//require_once "dbConnect.php";
//require_once "SocialAPI.php";

if($_SERVER['HTTPS'])
{
    $loc = "https://".$_	
    header('Location: '.$loc);
}
else
{
	echo "hello";
	
	
    $fbError = false;
    if(isset($_REQUEST['grouped']))//group for draper university
    {
        handleGroup($_REQUEST['grouped']);
        //echo "<p>uniq $uniqueID</p>";
    }

    if(isset($_REQUEST['linked']))
    {
        handleLink($_REQUEST['linked']);
        //echo "<p>uniq $uniqueID</p>";
    }

    if($_REQUEST['signout'] == true)
    {
        signOut();
        //echo "<p>redirect signout</p>";
        redirectToHere();
    }
    if($_REQUEST['expired'] == true)
        $expired = true;
    else
        $expired = false;

    $user = $facebook->getUser();
    if ($user) {
        //echo "<p>Here 6</p>";
        try {
            // Proceed knowing you have a logged in user who's authenticated.
            $user_profile = getFBUser();
        } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
            //echo "<p>redirect facebook</p>";
            $fbError = true;
        }
        $stage = checkIfInFBSystem($user_profile);
        //echo "<p>STAGE $stage</p>";

        if($fbError)
        {
            $expired = true;
            displaySplashPage();
        }
        elseif($stage == 1)
        {
            redirectToInvite();
        }
        elseif($stage >= 2)
        {
            redirectToProfile();
        }
        else
        {
            displaySplashPage();
        }
    }
    elseif(checkForLILogin())
    {
        //echo "<p>Here 7</p>";
        loginLI('https://stage.tidepool.co/Live/splash.php');
        $user = getLIUser();
        $stage = checkIfInLISystem($user);

        if($stage == 1)
        {
            redirectToInvite();
        }
        else if($stage >= 2)
        {
            redirectToProfile();
        }
        else
        {
            displaySplashPage();
        }
    }
    else
    {
        displaySplashPage();
    }
}
function redirectToStart()
{
    header('Location: ../html5/index.php');
}

function redirectToInvite()
{
    header('Location: invite.php');
}

function redirectToProfile()
{
    header('Location: profile.php');
}


function redirectToHere()
{
    header('Location: splash.php');
}


function redirectToPost()
{
    header('Location: post_assessment.php');
}


function displaySplashPage()
{
    global $expired, $redirectID, $redirectType;
    $temp = getPictures();
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
    <meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>TidePool</title>
    <meta property="og:title" content="TidePool">
    <meta property="og:image" content="https://s3.amazonaws.com/tidepool_images/Badges/Logo.png">
    <meta property="fb:url" content="www.tidepool.co">
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

    <script src="scripts/leanmodal.min.js" type="text/javascript"></script>

    <!-- leanModal - https://leanmodal.finelysliced.com.au/ -->
    <script type="text/javascript">
        var height;
        $(function() {
            $('a[rel*=leanModal]').leanModal({ overlay : 0.4, closeButton: ".modal_close" });
        });
        function showTerms(id)
        {
            var elem = document.getElementById(id);
            elem.height = "200px";
        }

        (function ($) {
            $.fn.extend({
                leanModal: function (options) {

                    var defaults = {
                        overlay: 0.5,
                        closeButton: null
                    };
                    var overlay = $("<div id='lean_overlay'></div>");
                    $("body").append(overlay);
                    options = $.extend(defaults, options);
                    return this.each(function () {

                        var modal_id = $(this).attr("href");
                        //alert("I am "+modal_id);
                        //closeOthers(modal_id);
                        var o = options;
                        $(this).click(function (e) {
                            var modal_id = $(this).attr("href");
                            $("#lean_overlay").click(function () {
                                close_modal(modal_id)
                            });

                            $(o.closeButton).click(function () {
                                close_modal(modal_id)
                            });
                            var modal_height = $(modal_id).outerHeight();
                            var modal_width = $(modal_id).outerWidth();
                            $("#lean_overlay").css({
                                "display": "block",
                                opacity: 0
                            });
                            $("#lean_overlay").fadeTo(200, o.overlay);
                            $(modal_id).css({
                                "display": "block",
                                "position": "absolute",
                                "opacity": 0,
                                "z-index": 11000,
                                "left": 50 + "%",
                                "margin-left": -(modal_width / 2) + "px",
                                top: (window.innerHeight - $(modal_id).outerHeight())/2
                            });
                            $(modal_id).fadeTo(200, 1);
                            e.preventDefault()
                        })
                    });

                    function goToLogin()
                    {
                        $("#lean_overlay").fadeOut(200);
                        $(modal_id).css({
                            "display": "none"
                        })

                    }

                    function close_modal(modal_id) {
                        $("#lean_overlay").fadeOut(200);
                        $(modal_id).css({
                            "display": "none"
                        })
                    }
                }
            })
        })(jQuery);

        function HideTerms(name)
        {
            var elem = document.getElementById(name);
            elem.height = "0px";
        }

        function closeMe(id)
        {
            $(id).css({"display": "none"});
        }
    </script>
    <script src="../masterHeader.js" type="text/javascript"></script>
    <script src="../uvHeader.js" type="text/javascript"></script>
    <script type="text/javascript">
        _kmq.push(['record', 'Viewed Splash']);
        _kmq.push(['record', 'Viewed <?echo "pic".$temp[0];?>']);
        _kmq.push(['record', 'Viewed <?echo "pic".$temp[1];?>']);
    </script>
    <script type="text/javascript">
            <?
            if(strlen($redirectID) > 3)
            {
                echo "_kmq.push(['set', {'Redirect Type':'$redirectType'}]);";
                echo "_kmq.push(['set', {'Came From':'$redirectID'}]);";
            }
            ?>
    </script>
</head>

<body>
    <?
    if($expired)
    {
        ?>
    <div class="mess-alert error" id="expired">
        Your session has expired, please login again
        <span class="mess-close"><a href="javascript:closeMe('#expired')">Close</a></span>
    </div>
        <?
    }
    ?>
<div id="wrap">

    <div id="header-a">
        <div class="logo"><a href="splash.php">TidePool</a></div>
        <div class="getstarted">
            <div class="gs-hdline font-lato" style="padding-left: 240px; padding-right: 25px;">Understand yourself through science</div>
            <?
            if(strlen($_COOKIE['logged']) > 3)
            {
                ?>
                <a id="getStarted_A" class="button" href="post_assessment.php"><div class="gs-btn button">Get Started</div></a>
                <?
            }
            else
            {
                ?>
                <a id="getStarted_A" class="button" href="../html5/index.php"><div class="gs-btn button">Get Started</div></a>
                <?
            }
            ?>
            <div class="gs-members">Have a WorkType? <a id="loginButton" name="login" href="loginUser.php"><b>Log in</b></a></div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="two-up-a">
        <div class="pic-a-a"><a id="pic<?echo $temp[0];?>" rel="leanModal" name="feedback-a" href="#feedback-a"><img src="images/pictures/<?echo $temp[0];?>.jpg" width=530 height=400 /></a></div>
        <div class="pic-b-a"><a id="pic<?echo $temp[1];?>" rel="leanModal" name="feedback-b" href="#feedback-b"><img src="images/pictures/<?echo $temp[1];?>.jpg" width=530 height=400 /></a></div>
        <div class="cta-b"></div>
    </div>

    <!-- Modal - Feedback photo A -->
    <div id="feedback-a">
        <div class="feedback"><img src="images/pictures/<?echo $temp[0];?>_feedback.jpg" /></div>
        <div class="feedback-learn">
            <h1>Take our assessment to learn more</h1>
            <p>Understand your work relationships through science<br /> and see how you match up with your friends</p>
        </div>
        <div class="mod-link" style="color:#b0b0b0;">Already have a profile? <a name="login" id="loginButton" onclick="javascript:closeMe('#feedback-a')" href="loginUser.php">Log in</a></div>
        <div class="feedback-signup">
            <a href="../Delta/Loading/Loading.php?stage=0" id="discoverButton_A" class="sp-continue-btn buttons">Discover my WorkType</a>
        </div>
        <div class="feedback-terms">
            <div class="tos"><a id="termsLink" href="javascript:showTerms('modal_ifrm-a');">Terms of Service</a></div>
        </div>
        <a class="modal_close" href="#"></a>
        <iframe id="modal_ifrm-a" src="i_terms.php?name=modal_ifrm-a" width="100%" height="0px" frameborder="0" border="0" cellspacing="0" style="border-style: none;"></iframe>
    </div>

    <!-- Modal - Feedback photo B -->
    <div id="feedback-b">
        <div class="feedback"><img src="images/pictures/<?echo $temp[1];?>_feedback.jpg" /></div>
        <div class="feedback-learn">
            <h1>Take our assessment to learn more</h1>
            <p>Understand your work relationships through science<br /> and see how you match up with your friends</p>
        </div>
        <div class="mod-link" style="color:#b0b0b0;">Already have a profile? <a id="loginButton" name="login" onclick="javascript:closeMe('#feedback-b')" href="loginUser.php">Log in</a></div>
        <div class="feedback-signup">
            <a href="../Delta/Loading/Loading.php?stage=0" id="discoverButton_A" class="sp-continue-btn buttons">Discover my WorkType</a>
        </div>
        <div class="feedback-terms">
            <div class="tos"><a id="termsLink" href="javascript:showTerms('modal_ifrm-b');">Terms of Service</a></div>
        </div>
        <a class="modal_close" href="#"></a>
        <iframe id="modal_ifrm-b" src="i_terms.php?name=modal_ifrm-b" width="100%" height="0px" frameborder="0" border="0" cellspacing="0" style="border-style: none;"></iframe>
    </div>

    <!-- Modal - Existing member login -->
    <div id="login-mod">
        <div class="feedback-learn">
            <h1>Already Have a Profile?</h1>
            <p>Log in with the service that you signed up with below.</p>
        </div>
        <div class="mod-link" style="color:#b0b0b0;">Don't have a profile? <a id="signUp_A" href="../Delta/Loading/Loading.php?stage=0">Sign up</a></div>
        <div class="feedback-signup">
            <div class="login-fb"><a href="<? getFBLoginLink() ?>">Log in with Facebook</a></div>
            <div class="signup-or"></div>
            <div class="login-in"><a href="?lType=initiate">Log in with LinkedIn</a></div>
            <div class="clear"></div>
        </div>
        <a class="modal_close" href="#"></a>
    </div>
    <form>
        <input type="hidden" name="box" value="2">
    </form>
</div>
<div id="cont"></div>
    <? include_once "footer.php"; ?>
</body>
</html>
<?
}


function handleGroup($id)
{
    include_once "groupFiles.php";

    //echo "<p>Checking group $id</p>";
    if(checkIfGroup($id))
    {
        setcookie("GroupID",$id, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        redirectToStart();
    }
}

function handleLink($link)
{
    global $redirectID, $redirectType;
    $num = strpos($link,"O");
    $id = substr($link,0,$num);
    $type = substr($link,$num+1,2);
    //echo "<p>STR $id and Type $type</p>";

    establishConnection();

    $query = "SELECT ID FROM SocialMediaUsers WHERE UniqueID='$id'";
    $result = mysql_query($query);
    $ID = mysql_result($result,0,0);
    mysql_free_result($result);

    $redirectID = $ID;
    //echo "<p>ID is $ID</p>";
    if($type == "FP")
    {
        $query = sprintf("UPDATE SignupLinks SET Total=Total+1, FacebookPost=FacebookPost+1 WHERE ID='%s'",mysql_real_escape_string($ID));
        $redirectType = "Facebook Post";
    }
    elseif($type == "FM")
    {
        $query = sprintf("UPDATE SignupLinks SET Total=Total+1, FacebookMessage=FacebookMessage+1 WHERE ID='%s'",mysql_real_escape_string($ID));
        $redirectType = "Facebook Message";
    }
    elseif($type == "LP")
    {
        $query = sprintf("UPDATE SignupLinks SET Total=Total+1, LinkedinPost=LinkedinPost+1 WHERE ID='%s'",mysql_real_escape_string($ID));
        $redirectType = "Linkedin Post";
    }
    elseif($type == "LM")
    {
        $query = sprintf("UPDATE SignupLinks SET Total=Total+1, LinkedinMessage=LinkedinMessage+1 WHERE ID='%s'",mysql_real_escape_string($ID));
        $redirectType = "Linkedin Message";
    }
    $result = mysql_query($query);
    mysql_free_result($result);
    endConnection();
}

function getPictures()
{
    Global $pic1, $pic2;
    $pic1 = rand(1,5);
    do
    {
        $pic2 = rand(1,5);
    }
    while($pic2 == $pic1);

    $letter = rand(1,2);
    if($letter == 1)
        $pic1 .= "a";
    else
        $pic1 .= "b";


    $letter = rand(1,2);
    if($letter == 1)
        $pic2 .= "a";
    else
        $pic2 .= "b";


    $temp = array();
    $temp[] = $pic1;
    $temp[] = $pic2;
    return $temp;
}
?>