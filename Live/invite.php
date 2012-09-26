<?php
require_once "CheckStatus.php";
if(CheckStatus())
{
    require_once "SocialAPI.php";
    require_once "dbConnect.php";

    $string = "";
    $allFriends = array();
    $TideFriends = array();
    $ID = $_COOKIE['ID'];
    $unq = formatUnq($_COOKIE['ID']);

    establishConnection();

    $query = sprintf("SELECT FacebookID, LinkedID, Stage, WorkType FROM SocialMediaUsers WHERE ID='%s'",mysql_real_escape_string($ID));
    $result = mysql_query($query) or die('SMU Query failed: ' . mysql_error());
    $FB_ID = mysql_result($result, 0,  0);
    $LI_ID = mysql_result($result, 0,  1);
    $stageSQL = mysql_result($result, 0,  2);
    $wt1 = mysql_result($result, 0,  3);
    mysql_free_result($result);
    endConnection();

    $LIconnected = false;
    $FBconnected = false;
    $LIauth = false;
    $FBauth = false;

    if($FB_ID != "NULLIE")
    {
        $FBconnected = true;
    }

    if($LI_ID != "NULLIE")
    {
        $LIconnected = true;
    }

    $user = $facebook->getUser();// check to see if users is authenticated with fb
    if ($user) {
        try {
            // Proceed knowing you have a logged in user who's authenticated.
            $user_profile = getFBUser();
        } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
            redirectToHere();
        }
        $staged = checkFBLinked($user_profile);
        $FBconnected = true;
        $FBauth = true;
    }
    if(checkForLILogin())// check to see if users is authenticated with li
    {
        loginLI('https://stage.tidepool.co/Live/invite.php');
        $user = getLIUser();
        $staged = checkLILinked($user);
        $LIconnected = true;
        $LIauth = true;
    }

    if(isset($_REQUEST['Refresh']))//refresh friends
    {
        if($_REQUEST['Refresh'] == 'FB')
        {
            updateFBFriends($FB_ID,$wt1,$ID);
        }
        if($_REQUEST['Refresh'] == 'LI')
        {
            if(checkForLILogin())
            {
                loginLI('https://stage.tidepool.co/Live/invite.php');
                $user = getLIUser();
                //echo "<p>USer info 1</p>";
                //print_r($user);
                updateLIFriends($LI_ID,$wt1,$ID);
            }
            else// has to authenticate keep track of refresh
            {
                setcookie("RefreshLI", '171', time()+1800,"/", ".tidepool.co"); /* Expires in two hours */
                header('Location: invite.php?lType=initiate');
            }
        }
    }
    if($_COOKIE['RefreshLI'] == 171)// check to see if user had to authenticate with linkedin when trying to refresh
    {
        if(checkForLILogin())
        {
            loginLI('https://stage.tidepool.co/Live/invite.php');
            $user = getLIUser();
            //echo "<p>USer info 1</p>";
            //print_r($user);
            updateLIFriends($LI_ID,$wt1,$ID);
            setcookie("RefreshLI", '1', time()-1800,"/", ".tidepool.co"); /* Expires in two hours */
        }
    }


    $friendList = getTidepoolFriends($ID);
    foreach($friendList[3] as $friend)
    {
        if(strpos($friend['pic'],"linkedin") > 0 || strpos($friend['pic'],"m3.licdn") > 0 || strpos($friend['pic'],"anonymous.png") > 0 )
        {
            $string .= "{ name: \"".addslashes($friend['name'])." (LI)\", ID: \"".addslashes($friend['id'])."\"},";
        }
        else
        {
            $string .= "{ name: \"".addslashes($friend['name'])." (FB)\", ID: \"".addslashes($friend['id'])."\"},";
        }
        $allFriends[] = $friend;
    }
    foreach($friendList[5] as $friend)
    {
        if(strpos($friend['pic'],"linkedin") > 0 || strpos($friend['pic'],"m3.licdn") > 0 || strpos($friend['pic'],"anonymous.png") > 0 )
        {
            $string .= "{ name: \"".addslashes($friend['name'])." (User)\", ID: \"".addslashes($friend['id'])."\"},";
        }
        else
        {
            $string .= "{ name: \"".addslashes($friend['name'])." (User)\", ID: \"".addslashes($friend['id'])."\"},";
        }
        $TideFriends[] = $friend;
    }
    displayPage();
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

function displayPage()
{
    global $allFriends, $TideFriends, $string, $LIconnected, $FBconnected, $FBauth, $LIauth, $ID, $unq, $stageSQL;
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta https-equiv="Content-Language" content="en_US" />
<title>TidePool</title>
<link rel="icon" href="https://tidepool.co/style/images/LogoHalf.png" type="image/png">

<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link href='https://fonts.googleapis.com/css?family=Quicksand:300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="../jQuery/jquery.js"></script>
<script type='text/javascript' src='../jQuery/jquery.autocomplete.min.js'></script>
<link rel="stylesheet" type="text/css" href="../jQuery/jquery.autocomplete.css" />
<script src="https://connect.facebook.net/en_US/all.js"></script>
<script>
    var oldID;
    var last = 0;
    var emails = [ <? echo $string; ?>];
    $().ready(function() {
        function log(event, data, formatted) {
            var begin = formatted.indexOf('@')+1;
            var end = formatted.length;
            var ID = formatted.substring(begin,end);
            var name = formatted.substring(0,begin-2);
            //alert(ID);
            //alert("Namer:"+name);
            if(name.match("User"))
            {
                //alert("Name:"+name);
                scrollWin("Friend"+ID);
            }
            else
            {
                //alert("ELSe:"+name);
                selectID(ID,name);
            }
            //scrollWin(ID);
        }

        function formatResult(row) {
            return row[0].replace(/(<.+?>)/gi, '');
        }

        $("#search").autocomplete(emails, {
            minChars: 0,
            width: 560,
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

    function selectID(ID,name)
    {
        //alert(ID);
        scrollWin("Friend"+ID);
        send(ID,name);
        //alert(ID);
    }

    function scrollWin(id)
    {
        if(oldID != null)
        {
            oldID.style.backgroundColor = "#FFFFFF";
        }
        var elem = document.getElementById(id);
        oldID = elem;
        elem.style.backgroundColor = "#E0E0E0";
        var windOff = document.getElementById('friendList').offsetTop;
        var elemOff = document.getElementById(id).offsetTop;
        //alert("windOff is "+windOff+" elemOff is "+elemOff);
        document.getElementById('friendList').scrollTop = elemOff - windOff - 150;
    }

    function send(id,name)
    {
        var type = name.substr(-3,2);
        //alert(type);
        if(type == "FB")
        {
            sendFB(id);
        }
        else if(type == "LI")
        {
            name = name.substr(0,name.length-5);
            sendLI(id,name);
        }
        else
        {
            alert("Error Finding: "+name+" Type: "+type);
        }
    }

    function updateFriends(num)
    {
        var params = "id1=<?echo $ID;?>&id2="+num;

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        //alert(params);
        $.ajax({
            type: "POST",
            url: "../Posts/UpdateFriends.php",
            data: params,
            success: function() {
                //alert("invited: "+num);
            }
        });

    }
    function launchModal()
    {
        // alert("TESTing");
        $("#lean_overlay").css({
            "display": "block",
            opacity: 0
        });
        $("#lean_overlay").fadeTo(200, 0.5);
        var modal_height = $('#pairs-soon').outerHeight();
        var modal_width = $('#pairs-soon').outerWidth();
        $('#pairs-soon').css({
            "display": "block",
            "position": "absolute",
            "opacity": 0,
            "z-index": 11000,
            "left": 50 + "%",
            "margin-left": -(modal_width / 2) + "px",
            top: 150
        });
        $('#pairs-soon').fadeTo(200, 1);

        ///alert("TESTing2");
    }

    function sendLI(id,name)
    {

        _kmq.push(['set', {'Clicked Invite Friend':'LinkedIn'}]);
        var width  = 500;
        var height = 430;
        var left   = (window.screen.width  - width)/2;
        var top    = (window.screen.height - height)/2;
        var params = 'scrollbars=no, width='+width+', height='+height;
        params += ', top='+top+', left='+left;
        //alert(id);
        myWindow = window.open("sendLIMessage.php?id="+id+"&name="+name, "LinkedIn", params);
    }

    FB.init({appId: '168192369908415', xfbml: true, cookie: true});
    function sendFB(num)
    {
        _kmq.push(['set', {'Clicked Invite Friend':'Facebook'}]);
        FB.ui({
            method: 'send',
            name: 'Help me learn more about my WorkType by getting yours' ,
            description: 'Take TidePool\'s Assessment and let\'s compare WorkTypes',
            to: num,
            link: 'https://www.tidepool.co/Live/splash.php?linked=<?echo $unq;?>',
            picture: 'https://www.tidepool.co/style/images/Logo.png',
            //redirect_uri: 'https://www.tidepool.co/Live/close.php'
        });
        updateFriends(num);
    }
    function closeMe(id)
    {
        $("#lean_overlay").fadeOut(200);
        $(id).css({"display": "none"});
    }
    function goToFB()
    {
        window.location = "<? getFBLoginLink(); ?>";
    }
    function goToFBRefresh()
    {
        window.location = "<?
            $link = getFBLoginLinkVariable();
            echo  str_replace("tidepool.co%2FLive%2Finvite.php","tidepool.co%2FLive%2Finvite.php?Refresh=FB",$link);
            ?>";
    }
</script>

<script src="../masterHeader.js" type="text/javascript"></script>
<script src="../uvHeader.js" type="text/javascript"></script>
<script type="text/javascript">
    _kmq.push(['record', 'Viewed Invite Page']);
</script>
</head>

<body>
<!-- Modal - Pairs Coming Soon -->
<div id="lean_overlay"></div>
<div id="pairs-soon">
    <div class="preview"><img src="images/pairs_soon.png" /></div>
    <div class="desc">Invite your friends to compare WorkTypes and learn even more</div>
    <div ><a href="javascript:closeMe('#pairs-soon');" type="button" name="" value="" class="soon-close buttons">Close</a></div>
</div>
<div id="fb-root"></div>
<div id="wrap">


    <div id="header">
        <div class="logo"><a href="splash.php">TidePool</a></div>
    </div>
    <div id="cont">
        <div class="hdr-spacer"></div>
        <h1>Compare your WorkType with friends and colleagues</h1>
        <h2>The more people you invite, the more you'll <a href="javascript:launchModal();" style="text-decoration: underline;">learn</a></h2>
        <div class="inv-wrap">
            <div class="inv-search">
                <input type="text" name="search" id="search" value="" placeholder="Search friends" />
            </div>
            <div class="inv-connect">
                <div class="inv-connect-msg">Invite friends from your Networks</div>
                <?
                if($FBconnected)
                {
                    echo '<div class="inv-connect-fb inv-selected">Facebook - Connected</div>';
                }
                else
                {
                    ?>
                    <div class="inv-connect-fb"><a id="loginFacebook" href="javascript:goToFB();">Invite Friends from Facebook</a></div>
                    <?
                }
                if($LIconnected)
                {
                    echo '<div class="inv-connect-in inv-selected">LinkedIn - Connected</div>';
                }
                else
                {
                    echo '<div class="inv-connect-in"><a id="loginLinked" href="?lType=initiate">Invite Friends from LinkedIn</a></div>';
                }
                ?>
                <div style="padding-top: 10px;float:right;">
                    <?
                    if($FBauth)
                    {
                        echo '<a href="?Refresh=FB" style="padding-right: 65px;" >Refresh Facebook Friends</a>';
                    }
                    else
                    {
                        echo '<a href="javascript:goToFBRefresh();" style="padding-right: 65px;" >Refresh Facebook Friends</a>';
                    }
                    echo '<a href="?Refresh=LI" style="padding-right: 40px;">Refresh LinkedIn Friends</a>';
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="invite-tbl" id="friendList">
                <?
                //print_r($allFriends);
                foreach($allFriends as $friend)
                {
                    if(strpos($friend['pic'],"linkedin") > 0 || strpos($friend['pic'],"m3.licdn") > 0 || strpos($friend['pic'],"anonymous.png") > 0 )
                    {
                        ?>
                        <div class="friend" id="Friend<?echo $friend['id']?>">
                            <div class="pic"><img src="<?echo $friend['pic']?>" width="40" height="40" border="0" /></div>
                            <div class="name"><?echo $friend['name']?></div>
                            <div class="action"><button  id="inviteLI" onclick="javascript:sendLI('<?echo $friend['id'];?>','<?echo $friend['name'];?>');" type="button" name="" value="" class="in-invite-btn">Invite</button></div>
                            <div class="clear"></div>
                        </div>
                        <?
                    }
                    else
                    {
                        $num = strpos($friend['pic'],"?");
                        $friend['pic'] = substr($friend['pic'],0,$num);
                        ?>
                        <div class="friend" id="Friend<?echo $friend['id']?>">
                            <div class="pic"><img src="<?echo $friend['pic']?>" width="40" height="40" border="0" /></div>
                            <div class="name"><?echo $friend['name']?></div>
                            <div class="action"><button  id="inviteFB" onclick="javascript:sendFB(<?echo $friend['id'];?>);" type="button" name="" value="" class="fb-invite-btn">Invite</button></div>
                            <div class="fb-bug-mini">Facebook</div>
                            <div class="clear"></div>
                        </div>
                        <?
                    }
                }
                foreach($TideFriends as $friend)
                {
                    if(strpos($friend['pic'],"linkedin") > 0 || strpos($friend['pic'],"m3.licdn") > 0 || strpos($friend['pic'],"anonymous.png") > 0 )
                    {
                        ?>
                        <div class="friend" id="Friend<?echo $friend['id']?>">
                            <div class="pic"><img src="<?echo $friend['pic']?>" width="40" height="40" border="0" /></div>
                            <div class="name"><?echo $friend['name']?></div>
                            <div class="action" style="font-size: 16; padding-top: 10px; padding-right: 10px;">TidePool User</div>
                            <div class="clear"></div>
                        </div>
                        <?
                    }
                    else
                    {
                        $num = strpos($friend['pic'],"?");
                        $friend['pic'] = substr($friend['pic'],0,$num);
                        ?>
                        <div class="friend" id="Friend<?echo $friend['id']?>">
                            <div class="pic"><img src="<?echo $friend['pic']?>" width="40" height="40" border="0" /></div>
                            <div class="name"><?echo $friend['name']?></div>
                            <div class="action" style="font-size: 16; padding-top: 10px; padding-right: 10px;">TidePool User</div>
                            <div class="fb-bug-mini">Facebook</div>
                            <div class="clear"></div>
                        </div>
                        <?
                    }
                }
                ?>
            </div>
        </div>
        <div class="invite-act">
            <div class="allow">You will receive additional feedback and be able to compare your WorkType with the friends you invite<br>(your personal feedback will remain private)</div>
            <a href="profile.php?complete=true" id="returnProfile" type="button" name="next" value="next" class="inv-btn buttons">Return to My Profile</a>
        </div>
    </div>
</div>

    <? include_once "footer.php"; ?>
</body>
    <? if($stageSQL < 2)
{
    ?>
<script type="text/javascript">
    //launchModal();
</script>
    <?
}
    ?>
</html>
<?
}


function formatUnq($ID)
{
    $num = strpos($ID,"O");
    $str = substr($ID,0,$num);
    $rand = rand(10000,99999);
    $str = $str."OFM".$rand;
    return $str;
}
?>