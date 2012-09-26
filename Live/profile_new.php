<?php
require_once "CheckStatus.php";
require_once "dbConnect.php";
require_once "SocialAPI.php";
if(CheckStatus())
{
    $ID = $_COOKIE['ID'];
    $name = $_COOKIE['name'];
    $pic = $_COOKIE['pic'];
    $title = $_COOKIE['WTname'];
    $user = getUser();
    $stage = $user['stage'];
    $FB_ID = $user['fb_id'];
    $LI_ID = $user['li_id'];
    $shareFB = false;
    $shareLI = false;

    establishConnection();

    if($FB_ID == "NULLIE")
    {
        $FB_ID = "none";
    }
    if($LI_ID == "NULLIE")
    {
        $LI_ID = "none";
    }
    $user = $facebook->getUser();
    if ($user) {
        try {
            $user_profile = getFBUser();
        } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
            redirectToHere();
        }
        $shareFB = true;
        $staged = checkFBLinked($user_profile);
        $FB_ID = $user_profile['id'];
    }
    if(checkForLILogin())
    {
        loginLI('https://stage.tidepool.co/Live/profile_new.php');
        $user = getLIUser();
        $staged = checkLILinked($user);
        $LI_ID = $user['id'];
        $shareLI = true;
    }


    establishConnection();
    if($_REQUEST['complete'] == true)
    {
        $query = sprintf("UPDATE SocialMediaUsers SET Stage=2 WHERE (ID='%s' OR ID2='%s')",mysql_real_escape_string($ID),mysql_real_escape_string($ID));
        $result = mysql_query($query);
        mysql_free_result($result);
    }
    $query = sprintf("SELECT * FROM WorkTypesNew WHERE title = '%s'",mysql_real_escape_string($title));
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    $title = $temp[1];
    $p1 = $temp[2];
    $p2 = $temp[3];
    $p3 = $temp[4];
    $oneLiner = $temp[5];
    $bullet1 = $temp[6];
    $bullet2 = $temp[7];
    $bullet3 = $temp[8];
    mysql_free_result($result);

    $query = sprintf("SELECT Bullet1,Bullet2,Bullet3 FROM WorkTypeAccuracy WHERE ID = '%s'",mysql_real_escape_string($ID));
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    $accuracy1 = $temp[0];
    $accuracy2 = $temp[1];
    $accuracy3 = $temp[2];
    mysql_free_result($result);

    endConnection();

    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>TidePool</title>

<link rel="icon" href="https://tidepool.co/style/images/LogoHalf.png" type="image/png">
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link href='https://fonts.googleapis.com/css?family=Quicksand:300' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

<script src="scripts/leanmodal.min.js" type="text/javascript"></script>

<!-- leanModal - https://leanmodal.finelysliced.com.au/ -->
<script type="text/javascript">
var t1;
$(function() {
    $('a[rel*=leanModal]').leanModal({ top : 150, overlay : 0.4, closeButton: ".modal_close" });
});

function setAccuracy(num,value,id)
{
    var params;
    if(value > 0)
    {
        document.getElementById(id+"Yes").style.backgroundPosition = '0 -19px';
        document.getElementById(id+"No").style.backgroundPosition = '0 0';
        params = "bullet="+num+"&value="+value;
    }
    else
    {
        document.getElementById(id+"No").style.backgroundPosition = '0 -19px';
        document.getElementById(id+"Yes").style.backgroundPosition = '0 0';
    }

    params = "id=<?echo $ID;?>&bullet="+num+"&value="+value;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    //alert(params);
    $.ajax({
        type: "POST",
        url: "../Posts/PostAccuracy.php",
        data: params,
        success: function() {
            //alert("<h2>Contact Form Submitted!</h2>");
        }
    });
}

function postLI()
{
    //alert(id);
    var width  = 500;
    var height = 375;
    var left   = (window.screen.width  - width)/2;
    var top    = (window.screen.height - height)/2;
    var params = 'width='+width+', height='+height;
    params += ', top='+top+', left='+left;
    //alert(id);
    var myWindow = window.open("postToLinkedIn.php", "LinkedIn", params);
}

function postToFB()
{
    ///alert("start");
    var width  = 500;
    var height = 375;
    // alert("mid1");
    var left   = (window.screen.width  - width)/2;
    // alert("mid2");
    var top    = (window.screen.height - height)/2;
    var params = 'width='+width+', height='+height;
    params += ', top='+top+', left='+left;
    //alert(params);
    // alert("mid3");
    var myWindow = window.open("postToFacebook.php", "Facebook", params);
    //alert("End");
}

function closeSettings()
{
    $("#settings-mod").css({"display": "none"});
    $("#lean_overlay").fadeTo(200, 0);
}

function changeEmail()
{
    var email = document.getElementById("emailChange").value;
    var params = "id=<?echo $_COOKIE['ID'];?>&email="+email;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    //alert(params);
    $.ajax({
        type: "POST",
        url: "../Posts/UpdateEmail.php",
        data: params,
        success: function() {
            closeSettings();
        }
    });
}

function shareOnFB()
{
    var type = $('input:radio[name=shareRadFB]:checked').val();

    //alert(type);
    var msg = document.getElementById("shareFB"+type).value;
    var params = "type="+type+"&msg="+msg;
    //alert(params);
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    $.ajax({
        type: "POST",
        url: "../Posts/shareOnFacebook.php",
        data: params,
        success: function() {
            sentAndCont('#fb-mod');
        }
    });
}

function shareOnLI()
{
    var type = $('input:radio[name=shareRadLI]:checked').val();

    //alert(type);
    var msg = document.getElementById("shareLI"+type).value;
    var params = "type="+type+"&msg="+msg;
    //alert(params);
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    //alert("posting");
    $.ajax({
        type: "POST",
        url: "../Posts/shareOnLinkedIn.php",
        data: params,
        success: function() {
            sentAndCont('#in-mod');
        }
    });
}


function sentAndCont(id1)
{
    $(id1).css({"display": "none"});
    var modal_height = $('#thanks-mod').outerHeight();
    var modal_width = $('#thanks-mod').outerWidth();
    $('#thanks-mod').css({
        "display": "block",
        "position": "absolute",
        "z-index": 11000,
        "left": 50 + "%",
        "margin-left": -(modal_width / 2) + "px",
        top: (window.innerHeight - $('#thanks-mod').outerHeight())/2
    });
    t1 = setTimeout("redirectInvite()",2000);
}

function saveSettings()
{
    var password = document.getElementById("settingsPassword").value;
    var confirm = document.getElementById("settingsConfirm").value;
    if(password != confirm)
    {
        alert("Error: Passwords do not match");
    }
    else if(password.length > 15 || password.length < 7)
    {
        alert("Error: Passwords must be between 7-15 characters");
    }
    else
    {
        var not = document.getElementById("notifications").checked;
        var name = document.getElementById("settingsName").value;
        var email = document.getElementById("settingsEmail").value;
        var image = document.getElementById("profileImg").src;
        if(not)
            not = 1;
        else
            not = 0;

        var params = "id=<?echo $_COOKIE['ID'];?>&name="+name+"&email="+email+"&password="+password+"&confirm="+confirm+"&image="+image+"&not"+not;
        //var params = "id=<?echo $_COOKIE['ID'];?>&email="+email+"&not"+not;
        //alert("params: "+params);

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        //alert(params);
        $.ajax({
            type: "POST",
            url: "UpdateSettings.php",
            data: params,
            success: function() {
                closeSettings();
                //location.reload(true);
            }
        });
    }
}

function deleteAccount()
{
    var r=confirm("Are you sure you want to delete your account?");
    if (r==true)
    {
        //alert(params);
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        $.ajax({
            type: "POST",
            url: "../Posts/deleteMyAccount.php",
            success: function() {
                window.location = "splash.php?signout=true";
            }
        });
    }
}

function unlinkFriends(id,type)
{
    var msg = "";
    if(type == "FB")
    {
        msg = "Are you sure you want to unlink your Facebook account?";
    }
    else if(type == "LI")
    {
        msg = "Are you sure you want to unlink your LinkedIn account?";
    }
    else
    {
        msg = "We are experiencing an error please try again later";
    }
    var r=confirm(msg);
    if (r==true)
    {
        var params = "id="+id+"&type="+type;
        //alert(params);
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        //alert("posting");
        $.ajax({
            type: "POST",
            url: "../Posts/unlinkFriends.php",
            data: params,
            success: function() {
                location.reload(true);
            }
        });
    }
}

$(document).ready(function(){
    $('#image_upload_form').submit(function(){
        $('div#profilePic img').attr('src','images/loading.gif');
    });
    $('iframe[name=upload_to]').load(function(){
        var result = $(this).contents().text();
        if(result !=''){
            if (result == 'Err:big'){
                $('div#profilePic img').attr('src','images/avatar_big.jpg');
                return;
            }
            if (result == 'Err:format'){
                $('div#profilePic img').attr('src','images/avatar_invalid.jpg');
                return;
            }
            $('div#profilePic img').attr('src','profilePics/'+$(this).contents().text());
        }
    });
});

function redirectInvite()
{
    document.body.innerHTML += '<form id="form" action="invite.php" method="post">';
    document.getElementById("form").submit();
}

function switchRadio(name)
{
    document.getElementById(name).checked = true;
}

function Tweet()
{
    //alert(id);
    var width  = 500;
    var height = 475;
    var left   = (window.screen.width  - width)/2;
    var top    = (window.screen.height - height)/2;
    var params = 'width='+width+', height='+height;
    params += ', top='+top+', left='+left;
    //alert(id);
    myWindow = window.open("https://twitter.com/share?text=Of 60 WorkTypes I am <?echo $title;?>. Discover your WorkType at https://www.TidePool.co @TidePoolInc&url=tidepool.co", "Twitter", params);
}

</script>
<script src="../masterHeader.js" type="text/javascript"></script>
<script src="../uvHeader.js" type="text/javascript"></script>
<script type="text/javascript">
    _kmq.push(['set', {'WorkType':'<?echo $_COOKIE['WTname'];?>'}]);
    _kmq.push(['identify', '<?echo $_COOKIE['ID'];?>' ]);
</script>
</head>

<body>

<!-- Modal - Settings -->
<div id="settings-mod">
    <div class="mod-hdr">
        Settings
    </div>
<div class="mod-cont">
    <?
    establishConnection();
    $query = "Select Name, Email, Password  From SocialMediaUsers WHERE ID='$ID'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $name = mysql_result($result,0,0);
    $email = mysql_result($result,0,1);
    $password = mysql_result($result,0,2);
    mysql_free_result($result);
    $pic = $_COOKIE['pic'];

    $query = "Select Notifications From UserSettings WHERE ID='$ID'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $notif = mysql_result($result,0,0);
    mysql_free_result($result);
    ?>
    <div class="mod-title">Profile Picture</div>
    <div class="profilePic" id='profilePic'>
        <form id='image_upload_form' method='post' enctype='multipart/form-data' action='profilePics/add_avatar.php' target='upload_to'>
            <div class="pic-form">
                <div class="pic-preview"><img id="profileImg" src='<?echo $pic;?>'/></div>
                <div class="pic-upload">
                    <div class="pic-choose"><input type='file' id='file_browse' name='image'/></div>
                    <div class="pic-req">Maximum size of 125kb. JPG, GIF, PNG</div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="pic-submit"><input type='submit' class="sh-email" value='Upload Photo'></div>
        </form>
        <iframe name='upload_to'>
        </iframe>
    </div>
    <div class="mod-title">Name</div>
    <div class="mod-input"><input id="settingsName" type="text" value="<?echo $name;?>" /></div>
    <div class="mod-title">Email Address</div>
    <div class="mod-input"><input id="settingsEmail" type="text" value="<?echo $email;?>" /></div>
    <div class="mod-title">Password</div>
    <div class="mod-input"><input id="settingsPassword" type="password" value="<?echo $password;?>" /></div>
    <div class="mod-title">Confirm Password</div>
    <div class="mod-input"><input id="settingsConfirm" type="password" value="<?echo $password;?>" /></div>
    <?
    if($FB_ID != "none")
    {
        echo '<div class="mod-title">Facebook Account: <span class="socialID">Connected</span>';
        echo '<a class="remove-social" href="javascript:unlinkFriends(\''.$FB_ID.'\',\'FB\');">remove</a></div>';
    }
    else
    {
        echo '<div class="mod-title">Facebook Account: <span class="socialID">None</span>';
        ?><a class="remove-social" href="<?getFBLoginLink();?>">add</a></div><?
    }

    if($LI_ID != "none")
    {
        echo '<div class="mod-title">LinkedIn Account: <span class="socialID">Connected</span>';
        echo '<a class="remove-social" href="javascript:unlinkFriends(\''.$LI_ID.'\',\'LI\');">remove</a></div>';
    }
    else
    {
        echo '<div class="mod-title">LinkedIn Account: <span class="socialID">None</span>';
        echo '<a class="remove-social" href="?lType=initiate">add</a></div>';
    }
    if($notif)
    {
        ?>
        <div class="mod-check"><input id="notifications" type="checkbox" checked="checked"><span class="check-label">I want to receive email notifications</span></div>
        <?
    }
    else
    {
        ?>
        <div class="mod-check"><input id="notifications" type="checkbox"><span class="check-label">I want to receive email notifications</span></div>
        <?
    }
    ?>
    <div class="tos" style="text-align: left;margin-top:10px;"><a href="javascript:deleteAccount();">Delete My Account</a></div>
    <div class="email-actions">
        <div class="send"><button type="button" name="save" value="save" onclick="javascript:saveSettings()" class="sh-email">Save</button></div>
        <div class="close"><button type="button" name="cancel" value="cancel" onclick="javascript:closeSettings()" class="sh-cancel">Cancel</button></div>
    </div>
    <div style="height:40px;"></div>
</div>
</div>

<!-- Modal - Share Thanks! -->
<div id="thanks-mod" class="share-mod" >
    <div class="share-hdr">
        <strong style="margin-left: 20px;">Share your WorkType</strong>
    </div>

    <div class="thx">Thank you for sharing. Your post has been sent.</div>
</div>

<!-- Modal - LinkedIn Share -->
<div id="in-mod" class="share-mod">
    <div class="share-hdr">
        <strong style="margin-left: 20px;">Share your WorkType:</strong> Select an option below
    </div>
    <div class="share-option">
        <div class="select"><input id="workLinked" type="radio" name="shareRadLI" value="1" checked="checked"/></div>
        <div class="msg"><textarea onclick="javascript:switchRadio('workLinked');" id="shareLI1" type="text">Do you TidePool? My TidePool WorkType is <?echo $title;?>. Let's share and compare!</textarea></div>
        <div class="icon"><img src="https://s3.amazonaws.com/tidepool_images/Badges/<?echo $title;?>.png" width="60" height="60" /></div>
        <div class="clear"></div>
    </div>
    <div class="share-option">
        <div class="select"><input id="genLinked" type="radio" name="shareRadLI" value="2" /></div>
        <div class="msg"><textarea onclick="javascript:switchRadio('genLinked');" id="shareLI2" type="text">Do you TidePool? Help me learn more about my WorkType by getting yours.</textarea></div>
        <div class="icon"><img src="https://s3.amazonaws.com/tidepool_images/Badges/Logo.png" width="60" height="60" /></div>
        <div class="clear"></div>
    </div>

    <div class="share-actions">
        <div class="share-on-in"><a id="postLinked"href="javascript:shareOnLI()">Share on LinkedIn</a></div>
        <div class="skip"><a id="skipLinked" class="modal_close" href="invite.php">Skip</a></div>
    </div>
</div>

<!-- Modal - Facebook Share -->
<div id="fb-mod" class="share-mod" style="display:none;">
    <div class="share-hdr">
        <strong style="margin-left: 20px;">Share your WorkType:</strong> Select an option below
    </div>
    <div class="share-option">
        <div class="select"><input id="workFacebook" type="radio" name="shareRadFB" value="1" checked="checked"/></div>
        <div class="msg"><textarea onclick="javascript:switchRadio('workFacebook');" id="shareFB1" type="text">Do you TidePool? My TidePool WorkType is <?echo $title;?>. Let's share and compare!</textarea></div>
        <div class="icon"><img src="https://s3.amazonaws.com/tidepool_images/Badges/<?echo $title;?>.png" width="60" height="60" /></div>
        <div class="clear"></div>
    </div>
    <div class="share-option">
        <div class="select"><input id="genFacebook" type="radio" name="shareRadFB" value="2" /></div>
        <div class="msg"><textarea onclick="javascript:switchRadio('genFacebook');" id="shareFB2" type="text">Do you TidePool? Help me learn more about my WorkType by getting yours.</textarea></div>
        <div class="icon"><img src="https://s3.amazonaws.com/tidepool_images/Badges/Logo.png" width="60" height="60" /></div>
        <div class="clear"></div>
    </div>

    <div class="share-actions">
        <div class="share-on-fb"><a id="postFacebook" class="autoPopPostToFacebook" href="javascript:shareOnFB()">Share on Facebook</a></div>
        <div class="skip"><a id="skipFacebook" class="modal_close" href="invite.php">Skip</a></div>
    </div>
</div>

<div id="wrap">

    <div id="header">
        <div class="logo"><a id="logoButton" href="splash.php">TidePool</a></div>
    </div>

    <div id="cont" style="overflow-x: hidden;">
        <div class="hdr-spacer"></div>
        <h5>Enjoy your WorkType Feedback</h5>
        <div class="profile">
            <div class="block">
                <div class="headshot"><img src="<?echo $pic;?>" width="100" height="100" /></div>
                <div class="det">
                    <div class="title"><?echo $name;?></div>
                    <ul class="nav">
                        <li><a id="go" rel="leanModal" name="settings" href="#settings-mod">Settings</a></li>
                        <li><a href="splash.php?signout=true">Sign out</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="block">
                <div class="badge"><img src="https://s3.amazonaws.com/tidepool_images/Badges/<?echo $title;?>.png" width="80" height="80" /></div>
                <div class="det">
                    <div class="work-type"><?echo $title;?></div>
                    <div class="short-desc"><?echo $oneLiner;?></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="block nomargin">
                <div class="share">
                    <div class="title">Share my Badge and WorkType</div>
                    <ul class="options">
                        <li class="sh-fb"><a id="shareFacebook" href="javascript:postToFB();">Share on Facebook</a></li>
                        <li class="sh-in"><a id="shareLinked" href="javascript:postLI()">Share on LinkedIn</a></li>
                        <li class="sh-tw"><a id="shareTwitter" href="javascript:Tweet()">Share on Twitter</a></li>
                        <li class="sh-invite buttons"><a id="shareInvite" href="invite.php">Invite Friends</a></li>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="assessment">
            <h3>Assessment Feedback</h3>
            <p><?echo $p1;?></p>
            <p><?echo $p2;?></p>
            <p><?echo $p3;?></p>
            <div class="summary">
                <div class="title">Summary Points</div>
                <div class="point">
                    <div class="desc">1. <?echo $bullet1;?></div>
                    <div class="accuracy">
                        <div class="yes"><a id="bullet1Yes" href="javascript:setAccuracy(1,1,'bullet1');">Yes</a></div>
                        <div class="no"><a id="bullet1No" href="javascript:setAccuracy(1,-1,'bullet1');">No</a></div>
                        <div class="label">Is this accurate?</div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="point">
                    <div class="desc">2. <?echo $bullet2;?></div>
                    <div class="accuracy">
                        <div class="yes"><a id="bullet2Yes" href="javascript:setAccuracy(2,1,'bullet2');">Yes</a></div>
                        <div class="no"><a id="bullet2No" href="javascript:setAccuracy(2,-1,'bullet2');">No</a></div>
                        <div class="label">Is this accurate?</div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="point">
                    <div class="desc">3. <?echo $bullet3;?></div>
                    <div class="accuracy">
                        <div class="yes"><a id="bullet3Yes" href="javascript:setAccuracy(3,1,'bullet3');">Yes</a></div>
                        <div class="no"><a id="bullet3No" href="javascript:setAccuracy(3,-1,'bullet3');">No</a></div>
                        <div class="label">Is this accurate?</div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <div class="separator" style="margin: 0 0 30px 0;"></div>

        <h4>Invite your friends to TidePool to compare WorkTypes</h4>
        <div class="continue">
            <?
            if($shareFB)
            {
                ?>
            <a id="profileInviteFriends" rel="leanModal" name="share" href="#fb-mod" name="compare" value="compare" class="compare-btn buttons">
                <?
            }
            elseif($shareLI)
            {
                ?>
            <a id="profileInviteFriends" rel="leanModal" name="share" href="#in-mod" name="compare" value="compare" class="compare-btn buttons">
                <?
            }
            else
            {
                ?>
                <a id="profileInviteFriends" href="invite.php" name="compare" value="compare" class="compare-btn buttons">
                <?
            }
            ?>
            Invite Friends</a></div>
    </div>
</div>
    <? include_once "footer.php"; ?>

<script type="text/javascript">
        <?
        if($accuracy1 == 1)
        {
            echo 'document.getElementById("bullet1Yes").style.backgroundPosition = "0 -19px";';
        }
        elseif($accuracy1 == -1)
        {
            echo 'document.getElementById("bullet1No").style.backgroundPosition = "0 -19px";';
        }

        if($accuracy2 == 1)
        {
            echo 'document.getElementById("bullet2Yes").style.backgroundPosition = "0 -19px";';
        }
        elseif($accuracy2 == -1)
        {
            echo 'document.getElementById("bullet2No").style.backgroundPosition = "0 -19px";';
        }

        if($accuracy3 == 1)
        {
            echo 'document.getElementById("bullet3Yes").style.backgroundPosition = "0 -19px";';
        }
        elseif($accuracy3 == -1)
        {
            echo 'document.getElementById("bullet3No").style.backgroundPosition = "0 -19px";';
        }
        ?>
</script>
</body>
</html>
<?
}


function redirectToHere()
{
    ?>
<html>
<body>
<script language="JavaScript">
    document.body.innerHTML += '<form id="form" action="<? echo $_SERVER['PATH_INFO'];?>" method="post">';
    document.getElementById("form").submit();
</script>
</body>
</html>
<?
}
?>