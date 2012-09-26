<?php
require_once "SocialAPI.php";
if(checkForLILogin())
{
    $user = getLIUser();

    $ID = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $msg = $_REQUEST['message'];

    $unq = formatUnq($_COOKIE['ID']);
    $workType = $_COOKIE['WTname'];
    if(isset($_REQUEST['message']))
    {
        post($msg,$unq);
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

        <script src="../masterHeader.js" type="text/javascript"></script>
    </head>
    <body>
    <script type="IN/Login"></script>
    <div id="linkedin-mod">
        <div class="mod-hdr">
            <img src="images/linkedin_icon.png" width="25" height="25" alt="" style="position: absolute; top: 15px;left: 15px;"><span style="margin-left: 30px;">Post to LinkedIn</span>
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
                            <div class="work-type">I'm <?echo $workType;?>.<br>Which WorkType are you?</div>
                            <div class="short-desc">TidePool.co</div>
                            <div class="short-desc"><br>There are 60 WorkTypes and <?echo $name;?> is <?echo $workType;?>. Discover yours at www.TidePool.co</div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="email-actions">
                        <div class="send"><button id="postLinked" type="submit" class="sh-email">Post</button></div>
                        <div class="close"><a id="cancelLinked" href="javascript:closeMe();"><button type="button" name="sh-cancel" value="sh-cancel" class="sh-cancel">Cancel</button></a></div>
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

    <script src="../masterHeader.js" type="text/javascript"></script>
</head>
<body>
<div align="center" style="padding-top: 150px;"><a id="loginLinked" href="?lType=initiate"><img src="images/login_in.png"></div>
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
    $str = $str."OLP".$rand;
    return $str;
}
?>