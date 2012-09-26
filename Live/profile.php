<?php
require_once "CheckStatus.php";
if(CheckStatus())
{

    if(strlen($_POST['reload']) > 4)
    {
        header('Location: profile.php');
    }
    require_once "SocialAPI.php";
    require_once "dbConnect.php";

    //echo "<p>in get profile ".$_COOKIE['WTname']."</p>";
    $user = getUser();
    $ID = $_COOKIE['ID'];
    $name = $user['name'];
    $pic = $user['pic'];
    $title = $user['wt'];
    $stage = $user['stage'];
    $FB_ID = $user['fb_id'];
    $LI_ID = $user['li_id'];
    //echo "<p>stage: $stage</p>";
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
            //echo "<p>Found Facebook user 1</p>";
        } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
            redirectToHere();
        }
        $staged = checkFBLinked($user_profile);
        //print_r($user_profile);
        // echo "<p>id: </p>";
        //$FB_ID = $user_profile['fb_id'];
        //echo "<p>Found Facebook user</p>";
    }
    if(checkForLILogin())
    {
        loginLI('https://stage.tidepool.co/Live/profile.php');
        $user = getLIUser();
        $staged = checkLILinked($user);
        //print_r($user);
        //echo "<p>id: </p>";
        $LI_ID = $user['li_id'];
        //echo "<p>Found Linked user</p>";
    }

    establishConnection();
    //Drapers stuff check if should show grouping
    $query = sprintf("SELECT GroupID FROM Groupings WHERE ID='%s'",mysql_real_escape_string($ID));
    $result = mysql_query($query) or die('SMU Query failed: ' . mysql_error());
    $groupID = mysql_result($result, 0,  0);
    mysql_free_result($result);

    $query = sprintf("UPDATE SocialMediaUsers SET Stage=3 WHERE ID='%s'",mysql_real_escape_string($ID));
    $result = mysql_query($query) or die('SMU Query failed: ' . mysql_error());
    mysql_free_result($result);

    if($_REQUEST['complete'] == true)
    {
        $query = "UPDATE SocialMediaUsers SET Stage=3 WHERE ID='$ID';";
        $result = mysql_query($query);
        mysql_free_result($result);
    }

    $query = "SELECT OneLiner FROM WorkTypesNew WHERE title = '".$title."'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $oneLiner = mysql_result($result, 0,  0);
    mysql_free_result($result);

    $friends = getTidepoolFriends($ID);
    if(count($friends[2])==0)
    {
        $hasFriends = false;
    }
    else
    {
        $hasFriends = true;
    }

    $allFriends = getTidepoolFriends($ID);
    $numFriends = 0;
    $counter = 0;
    foreach($allFriends as $friends)
    {
        if($counter < 5)
        {
            foreach($friends as $friend)
            {
                if(strpos($friend['pic'],"linkedin") > 0)
                {
                    $string .= "{ name: \"".addslashes($friend['name'])." LI\", ID: \"".addslashes($friend['id'])."\"},";
                }
                else
                {
                    $string .= "{ name: \"".addslashes($friend['name'])." FB\", ID: \"".addslashes($friend['id'])."\"},";
                }
            }
        }
        $counter++;
    }
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta property="fb:admins" content="{100000268566025,3431259,3430942,587429391}"/>
<meta property="fb:app_id" content="{168192369908415}"/>
<title>TidePool</title>
<link rel="icon" href="https://tidepool.co/style/images/LogoHalf.png" type="image/png">
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link href='https://fonts.googleapis.com/css?family=Quicksand:300' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="scripts/uploadPhoto.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="../jQuery/jquery.js"></script>
<script type='text/javascript' src='../jQuery/jquery.autocomplete.min.js'></script>
<link rel="stylesheet" type="text/css" href="../jQuery/jquery.autocomplete.css" />
<script src="scripts/leanmodal.min.js" type="text/javascript"></script>
<script src="https://connect.facebook.net/en_US/all.js"></script>

<!-- leanModal - https://leanmodal.finelysliced.com.au/ -->
<script type="text/javascript">
var emails = [ <? echo $string; ?>];
var maximized = 0;
var requested = true;
var shared = true;
var ask = true;
var invite = true;
var pending = true;
$(function() {
    $('a[rel*=leanModal]').leanModal({ top : 50, overlay : 0.4, closeButton: ".modal_close" });
});

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

function redirectInvite()
{
    window.location.replace("invite.php");
}

function switchRadio(name)
{
    document.getElementById(name).checked = true;
}

function Tweet()
{
    var width  = 500;
    var height = 475;
    var left   = (window.screen.width  - width)/2;
    var top    = (window.screen.height - height)/2;
    var params = 'width='+width+', height='+height;
    params += ', top='+top+', left='+left;
    myWindow = window.open("https://twitter.com/share?text=Of 60 WorkTypes I am <?echo $title;?>. Discover your WorkType at https://www.TidePool.co @TidePoolInc&url=tidepool.co", "Twitter", params);
}


$().ready(function() {

    function log(event, data, formatted) {
        var begin = formatted.indexOf('@')+1;
        var end = formatted.length;
        var ID = formatted.substring(begin,end);
        var name = formatted.substring(0,begin-2);
        //alert(ID);
        selectID(ID);
        //scrollWin(ID);
    }

    function formatResult(row) {
        return row[0].replace(/(<.+?>)/gi, '');
    }

    $("#search").autocomplete(emails, {
        minChars: 0,
        width: 280,
        matchContains: "word",
        autoFill: false,
        formatItem: function(row, i, max) {
            return row.name;
        },
        formatMatch: function(row, i, max) {
            return row.name + " @" + row.ID;
        },
        formatResult: function(row) {
            return row.name;
        }
    });

    $(":text, textarea").result(log).next().click(function() {
        $(this).prev().search();
    });
});

function selectID(ID)
{
    hideRadio();
    document.getElementById('FriendGallery').src = "DisplayFriends.php?all=true&id="+ID;
}

function reloadFriends()
{
    var params = "?";
    if(requested)
        params += "&requested=true";
    if(shared)
        params += "&shared=true";
    if(ask)
        params += "&asked=true";
    if(pending)
        params += "&pending=true";
    document.getElementById('FriendGallery').src = "DisplayFriends.php"+params;
}

function scrollIframeUp()
{
    window.frames.FriendGallery.scrollUp();
}

function scrollIframeDown()
{
    window.frames.FriendGallery.scrollDown();
}
function ShowWorkType()
{
    document.getElementById('BottomDisplay').src = "DisplayWorkType.php?noFeedback=true"
    document.getElementById('BottomDisplay').height = "300px";
    document.getElementById('comments').style.display = "none";

    document.getElementById('commentStatement').innerHTML = "Join the Discussion! What do you think about <?echo $title;?>";
    var url = "https://www.tidepool.co/Live/splash.php?comment=<?echo $title;?>";
    var elemDiv = document.getElementById("fbcomments");
    var markup = '<div id="comments" class="fb-comments" href="'+url+'" data-num-posts="2" data-width="600"></div>';
    elemDiv.innerHTML = markup;
    FB.XFBML.parse(elemDiv);
}

function StillPending(id,name,pic)
{
    document.getElementById('BottomDisplay').src = "PendingRequest.php?id2="+id+"&name2="+name+"&pic2="+pic;
    document.getElementById('BottomDisplay').height = "450px";
    document.getElementById('comments').style.display = "none";
    document.getElementById('commentStatement').innerHTML = "";
}

function compareWorkTypes(id,name)
{
    //alert("Compare "+id);
    document.getElementById('BottomDisplay').src = "DisplayComparative.php?ID="+id;
    document.getElementById('BottomDisplay').height = "650px";
    document.getElementById('commentStatement').innerHTML = "Comment on "+name+" and your comparison";
    var id1 = "<?echo $ID?>";
    var id2 = id;
    if(id1 < id2)
    {
        var url = "https://www.tidepool.co/Live/splash.php?comp="+id1+"VS"+id2;
    }
    else
    {
        var url = "https://www.tidepool.co/Live/splash.php?comp="+id2+"VS"+id1;
    }
    var elemDiv = document.getElementById("fbcomments");
    var markup = '<div id="comments" class="fb-comments" href="'+url+'" data-num-posts="2" data-width="600"></div>';
    elemDiv.innerHTML = markup;
    FB.XFBML.parse(elemDiv);
}


function Share(id,name,pic)
{
    document.getElementById('BottomDisplay').src = "SendRequest.php?id2="+id+"&name2="+name+"&pic2="+pic;
    document.getElementById('BottomDisplay').height = "450px";
    document.getElementById('comments').style.display = "none";
    document.getElementById('commentStatement').innerHTML = "";
}

function Respond(id,name,pic)
{
    document.getElementById('BottomDisplay').src = "RespondRequest.php?id2="+id+"&name2="+name+"&pic2="+pic;
    document.getElementById('BottomDisplay').height = "450px";
    document.getElementById('comments').style.display = "none";
    document.getElementById('commentStatement').innerHTML = "";
}

function expand()
{
    if(maximized == 0)
    {
        maximized = 1;
        document.getElementById("FriendGallery").height = "350px";
        document.getElementById("FriendGallery").width = "908px";
        document.getElementById("nav").style.display = "none";
        document.getElementById("FriendGallery").style.overflow = "visible";
        document.getElementById("FriendGallery").style.marginLeft = "35px";
        document.getElementById("expander").style.backgroundPosition = "0 -18px";
        window.frames.FriendGallery.allowScroll();
    }
    else if(maximized == 1)
    {
        maximized = 0;
        document.getElementById("FriendGallery").height = "180px";
        document.getElementById("FriendGallery").width = "860px";
        document.getElementById("nav").style.display = "inline";
        document.getElementById("FriendGallery").style.overflow = "hidden";
        document.getElementById("FriendGallery").style.marginLeft = "0px";
        document.getElementById("expander").style.backgroundPosition = "0 0px";
        window.frames.FriendGallery.setPosition();
        window.frames.FriendGallery.disableScroll();
    }
}



FB.init({appId: '168192369908415', xfbml: true, cookie: true});
function sendFB(num)
{
    FB.ui({
        method: 'send',
        name: 'Help me learn more about my WorkType by getting yours' ,
        description: 'Take TidePool\'s Assessment and let\'s compare WorkTypes',
        to: num,
        link: 'https://www.tidepool.co',
        picture: 'https://www.tidepool.co/Live/images/Badges/Logo.png',
        redirect_uri: 'https://www.tidepool.co/Live/close.php'
    });
}

function hideRadio()
{
    <?
    if($groupID == '68a4hn5')
    {
        ?>
        document.getElementById("Rgroup").style.backgroundPosition = "0 0px";
        <?
    }
    ?>
    document.getElementById("Rall").style.backgroundPosition = "0 0px";
    document.getElementById("Rrequested").style.backgroundPosition = "0 0px";
    document.getElementById("Rshared").style.backgroundPosition = "0 0px";
    document.getElementById("Rasked").style.backgroundPosition = "0 0px";
    document.getElementById("Rinvite").style.backgroundPosition = "0 0px";
    document.getElementById("Rpending").style.backgroundPosition = "0 0px";
}

function changeRadio(id)
{
    hideRadio();
    document.getElementById("R"+id).style.backgroundPosition = "0 -25px";
    if(id == "group")
    {
        document.getElementById('FriendGallery').src = "DisplayFriends.php?"+id+"=68a4hn5";
    }
    else
    {
        document.getElementById('FriendGallery').src = "DisplayFriends.php?"+id+"=true";
    }
}


function sendLI(id,name)
{
    //alert(id);
    var width  = 500;
    var height = 415;
    var left   = (window.screen.width  - width)/2;
    var top    = (window.screen.height - height)/2;
    var params = 'width='+width+', height='+height;
    params += ', top='+top+', left='+left;
    //alert(id);
    myWindow = window.open("sendLIMessage.php?id="+id+"&name="+name, "Invite LinkedIn Friend", params);
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

function launchModal()
{
    // alert("TESTing");
    $("#lean_overlay").css({
        "display": "block",
        opacity: 0
    });
    $("#lean_overlay").fadeTo(200, 0.5);
    var modal_height = $('#new-pairs').outerHeight();
    var modal_width = $('#new-pairs').outerWidth();
    $('#new-pairs').css({
        "display": "block",
        "position": "absolute",
        "opacity": 0,
        "z-index": 11000,
        "left": 50 + "%",
        "margin-left": -(modal_width / 2) + "px",
        top: 150
    });
    $('#new-pairs').fadeTo(200, 1);

    ///alert("TESTing2");
}

function closeMe(id)
{
    $("#lean_overlay").fadeOut(200);
    $(id).css({"display": "none"});
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
                location.reload();
                //window.location = "uoabheoih.php"
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

</script>
<script src="../masterHeader.js" type="text/javascript"></script>
<script src="../uvHeader.js" type="text/javascript"></script>
<style>
</style>
</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Modal - Pairs-->
<div id="lean_overlay"></div>
<div id="new-pairs">
    <div class="desc">This is your new profile page that enables you to compare WorkTypes with your friends and connections. Click on a friend's picture to see WorkType comparison, send requests to compare, or invite them to TidePool.</div>
    <div class="preview" align="center"><img src="images/profileComparePopUp.jpg" /></div>
    <div ><a href="javascript:closeMe('#new-pairs');" type="button" name="" value="" class="soon-close buttons">Close</a></div>
</div>

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

<div id="wrap">
    <div id="header">
        <div class="logo"><a href="splash.php">TidePool</a></div>
    </div>

    <div id="cont" style="overflow-x: hidden;">
        <div class="hdr-spacer" ></div>
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
                <a href="javascript:ShowWorkType();"><div class="badge"><img src="https://s3.amazonaws.com/tidepool_images/Badges/<?echo $title;?>.png" width="80" height="80" /></div></a>
                <div class="det">
                    <div class="work-type"><?echo $title;?></div>
                    <div class="short-desc"><?echo $oneLiner;?></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="block nomargin">
                <div class="share">
                    <div class="title">Share and Compare with Friends</div>
                    <ul class="options">
                        <li class="sh-fb"><a href="javascript:postToFB();">Share on Facebook</a></li>
                        <li class="sh-in"><a href="javascript:postLI()">Share on LinkedIn</a></li>
                        <li class="sh-tw"><a href="javascript:Tweet()">Share on Twitter</a></li>
                        <li class="sh-invite buttons"><a id="shareInvite" href="invite.php">Invite Friends</a></li>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="tidepool">
            <div class="tp-hdr">
                <div class="title">Your TidePool</div>
                <div class="filter">
                    <div class="search"><input type="text" placeholder="Search connections by name"  id="search" name="search"/></div>
                    <ul class="browse">
                        <?
                        if($groupID == '68a4hn5')
                        {
                            ?>

                            <li class="group tooltip"><a id="Rgroup" href="javascript:changeRadio('group');">group</a><span class="toolHint">Compare with your classmates</span></li>
                            <?
                        }
                        ?>
                        <li class="all tooltip"><a id="Rall" href="javascript:changeRadio('all');">All</a></li>
                        <li class="wtyp tooltip"><a id="Rshared" href="javascript:changeRadio('shared');">WorkType</a><span class="toolHint">TidePool users who you can compare WorkTypes with</span></li>
                        <li class="compare tooltip"><a id="Rasked" href="javascript:changeRadio('asked');">Compare</a><span class="toolHint">TidePool users who you can invite to share</span></li>
                        <li class="request tooltip"><a id="Rrequested" href="javascript:changeRadio('requested');">Request</a><span class="toolHint">TidePool users who want to connect and view your shared feedback</span></li>
                        <li class="pending tooltip"><a id="Rpending" href="javascript:changeRadio('pending');">Pending</a><span class="toolHint">Invitations to join or share that are currently pending</span></li>
                        <li class="inv tooltip"><a id="Rinvite" href="javascript:changeRadio('invite');">Invite</a><span class="toolHint">Facebook friends and LinkedIn connections you can invite into your TidePool</span></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="i-gallery-cont">
                <div class="gallery">
                    <div class="gal-actions">
                        <div class="expand"><a id="expander" href="javascript:expand();">Expand</a></div>
                        <div class="clear"></div>
                    </div>
                    <iframe name="FriendGallery" id="FriendGallery" src="DisplayFriends.php?requested=true&shared=true&asked=true&pending=true" width="860" height="180" frameborder="0" border="0" cellspacing="0" style="border-style: none; overflow: hidden;"></iframe>
                    <div class="grid-navi" id="nav">
                        <div class="prev"><a href="javascript:scrollIframeUp();">Prev</a></div>
                        <div class="next"><a href="javascript:scrollIframeDown();">Next</a></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <iframe id="BottomDisplay" src="DisplayWorkType.php?noFeedback=true" width="970" height="300" frameborder="0" border="0" cellspacing="0" style="border-style: none; overflow: hidden;"></iframe>
        <h3><span id="commentStatement">Join the Discussion! What do you think about <?echo $title;?></span></h3>
        <div id="fbcomments">
            <div id="comments" class="fb-comments" href="https://www.tidepool.co/Live/splash.php?comment=<?echo $title;?>" publish_feed="false" data-num-posts="2" data-width="600"></div>';
        </div>
        <br>
    </div>
</div>

    <? include_once "footer.php"; ?>
</body>
    <? if($stage < 3)
{
    ?>
<script type="text/javascript">
    launchModal();
</script>
    <?
}
    ?>
</html>
<?
    endConnection();
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