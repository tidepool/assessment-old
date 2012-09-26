<?php
$pos = strpos($_COOKIE['name']," ");
$name = substr($_COOKIE['name'],0,$pos);
$msg = $_REQUEST['message'];

$unq = formatUnq($_COOKIE['ID']);
$workType = $_COOKIE['WTname'];
require_once "SocialAPI.php";

$user = $facebook->getUser();
if ($user) {
    try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = getFBUser();
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
        redirectToHere();
    }

    $stage = checkFBLinked($user_profile);

    if(isset($_REQUEST['message']))
    {
        getFBUser();
        try
        {
            $publishStream = $facebook->api("/me/feed", 'post', array(
                    'message' => $msg,
                    'link'    => 'http://www.tidepool.co/Live/splash.php?linked='.$unq,
                    'picture' => 'http://www.tidepool.co/Live/images/Badges/'.$workType.'.png',
                    'name'    => 'TidePool thinks my WorkType is '.$workType.'',
                    'description' => 'Do you agree? Get your WorkType so I can learn more about mine. Discover yours at www.TidePool.co'
                )
            );
        }
        catch (FacebookApiException $e)
        {
            echo "<h1>Error</h1>";
            echo $e;

        }
        closePage();
    }
    else
    {
        ?>

    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Post to Facebook</title>
        <link rel="icon" href="http://tidepool.co/style/images/LogoHalf.png" type="image/png">
        <script type="text/javascript" src="../jQuery/jquery.js"></script>
        <style type="text/css">
            body{ overflow-x:hidden;overflow-y:hidden; }
        </style>
        <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
        <script type="text/javascript">
            function closeMe()
            {
                this.close();
            }
        </script>

        <script src="../masterHeader.js" type="text/javascript"></script>
    </head>
    <body>
    <script type="IN/Login"></script>
    <div id="linkedin-mod">
        <div class="mod-hdr">
            <img src="images/facebook_icon.png" width="25" height="25" alt="" style="position: absolute; top: 15px;left: 15px;"><span style="margin-left: 30px;">Post to Facebook</span>
        </div>
        <form>
            <div class="mod-cont">
                <form action=" " method="post">
                    <div class="email-form">
                        <div class="msg"><textarea type="text" placeholder="Personal Message" name="message" id="message"></textarea></div>
                    </div>
                    <div class="block-share">
                        <div class="badge" style="background: none;"><img src="images/Badges/<?echo $workType;?>.png" height="80"/></div>
                        <div class="det">
                            <div class="work-type">TidePool thinks my WorkType is <?echo $workType;?></div>
                            <div class="short-desc">TidePool.co</div>
                            <div class="short-desc"><br>Do you agree? Get your WorkType so I can learn more about mine. Discover yours at www.TidePool.co</div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="email-actions">
                        <div class="send"><button id="postFacebook" type="submit" class="sh-email windowPostToFacebook">Post</button></div>
                        <div class="close"><a id="cancelFacebook" href="javascript:closeMe();"><button type="button" name="sh-cancel" value="sh-cancel" class="sh-cancel">Cancel</button></a></div>
                    </div>
                </form>
                <div style="height:40px;"></div>
            </div>
        </form>
    </div>
    </body>
    </html>
    <?
    }
}
else
{
    ?>
<html>
<head>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <script src="../masterHeader.php" type="text/javascript"></script>
    <script src="../uvHeader.php" type="text/javascript"></script>
</head>
<body>
<div align="center" style="padding-top: 150px;"><a id="loginFacebook" href="<? getFBLoginLink();?>"><img src="images/login_fb.png"></div>
</body>
</html>
<?
}
function closePage()
{
    ?>
<html>
<body>
<script type="text/javascript">
    this.close();
</script>
</body>
</html>
<?
}

function formatUnq($id)
{
    $num = strpos($id,"O");
    $str = substr($id,0,$num);
    $rand = rand(10000,99999);
    $str = $str."OFP".$rand;
    return $str;
}
?>