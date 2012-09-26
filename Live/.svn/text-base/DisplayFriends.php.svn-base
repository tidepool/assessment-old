<?php
require_once "SocialAPI.php";
include_once "dbConnect.php";

$ID = $_COOKIE['ID'];
$allFriends = getTidepoolFriends($ID);
$numFriends = 0;
foreach($allFriends as $friends)
{
    $numFriends += count($friends);
}
$rows = ceil($numFriends/7);
//print_r($allFriends);
//echo "<p>Num of Rows: $rows Num of Friends: $numFriends</p>"
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
    <meta https-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>TidePool - Invite your friends to learn how you collaborate</title>

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script type="text/javascript" src="../jQuery/jquery.js"></script>
    <script type='text/javascript' src='../jQuery/jquery.autocomplete.min.js'></script>
    <link rel="stylesheet" type="text/css" href="../jQuery/jquery.autocomplete.css" />
    <style type="text/css">
        body { margin: 0; padding: 0; background: none; overflow-x:hidden;overflow-y:hidden;}
    </style>
    <script type="text/javascript">
        var position = 0;
        var last = 0;
        var lastElem;
        var elem;
        var end = <?echo $rows - 1;?> * 175;

        function setPosition()
        {
            var num = Math.ceil(window.pageYOffset / 175);
            scrollTo(0,num * 175);
        }

        function allowScroll()
        {
            document.body.style.overflowY = "visible";
        }

        function disableScroll()
        {
            document.body.style.overflowY = "hidden";
        }

        function scrollUp()
        {
            if(position < 100)
            {
                position = end;
                window.scrollBy(0,end);
            }
            else
            {
                position -= 175;
                window.scrollBy(0,-175);
            }
        }
        function scrollDown()
        {
            if(position > (end - 175))
            {
                position = 0;
                window.scrollBy(0,-end);
            }
            else
            {
                position += 175;
                window.scrollBy(0,175);
            }
        }
        function scrollWin(id)
        {
            position = $("#"+id).offset().top;
            scrollTo(0,position);
            highlight(id);
        }

        function Requested(id,name,pic)
        {
            parent.Respond(id,name,pic);
            highlight(id);
        }

        function askToShare(id,name,pic)
        {
            parent.Share(id,name,pic);
            highlight(id);
        }

        function Pending(id,name,pic)
        {
            parent.StillPending(id,name,pic);
            highlight(id);
        }

        function changeFeedback(id,name)
        {
            parent.compareWorkTypes(id,name);
            highlight(id);
        }

        function highlight(id)
        {
            if(lastElem != null)
            {
                lastElem.style.backgroundPosition = '0 0px';
            }
            elem = document.getElementById(id);
            elem.style.backgroundPosition = '0 -320px';
            lastElem = elem;
        }

        function sendLI(num,name)
        {
            parent.sendLI(num,name);
        }
        function sendFB(num)
        {
            parent.sendFB(num);
        }
    </script>
    <script type="text/javascript">
        var _kmq = _kmq || [];
        function _kms(u){
            setTimeout(function(){
                var s = document.createElement('script'); var f = document.getElementsByTagName('script')[0]; s.type = 'text/javascript'; s.async = true;
                s.src = u; f.parentNode.insertBefore(s, f);
            }, 1);
        }
        _kms('//i.kissmetrics.com/i.js');_kms('//doug1izaerwt3.cloudfront.net/88905aaa6b33b8385a57a090174e5c7774c9e2c5.1.js');
    </script>
    <script type="text/javascript">
        _kmq.push(['identify', '<?echo $_COOKIE['ID'];?>']);
    </script>
</head>
<body>
<?
echo '<div class="grid-scroll" id="grid">';

if($_REQUEST['requested'] == true || $_REQUEST['all'] || $_REQUEST['group'])
{
    foreach($allFriends[0] as $friend)
    {
        $set = intval(isset($_REQUEST['id']));
        if($set)
        {
            if($friend['id'] == $_REQUEST['id'])
            {
                echo '<div class="tp-block">';
                if(strpos($friend['pic'],"?type=large") > 0)
                {
                    echo '<div class="fb-bug">Facebook</div>';
                }
                echo '<a href="javascript:Requested(\''.$friend['id'].'\',\''.$friend['name'].'\',\''.$friend['pic'].'\');" id="'.$friend['id'].'">';
                echo '<div class="headshot">';
                echo '<img src="'.$friend['pic'].'" width="100"/>';
                echo '</div>';
                echo '<div class="name">'.$friend['name'].'</div>';
                echo '<div class="badge"><img src="images/badge_request.png" width="24" height="24" /></div>';
                echo '</a>';
                echo '</div>';
            }
        }
        else if($_REQUEST['group'])
        {
            if($friend['group'] == $_REQUEST['group'])
            {
                echo '<div class="tp-block">';
                if(strpos($friend['pic'],"?type=large") > 0)
                {
                    echo '<div class="fb-bug">Facebook</div>';
                }
                echo '<a href="javascript:Requested(\''.$friend['id'].'\',\''.$friend['name'].'\',\''.$friend['pic'].'\');" id="'.$friend['id'].'">';
                echo '<div class="headshot">';
                echo '<img src="'.$friend['pic'].'" width="100"/>';
                echo '</div>';
                echo '<div class="name">'.$friend['name'].'</div>';
                echo '<div class="badge"><img src="images/badge_request.png" width="24" height="24" /></div>';
                echo '</a>';
                echo '</div>';
            }
        }
        else if($friend['group'] != '68a4hn5')
        {
            echo '<div class="tp-block">';
            if(strpos($friend['pic'],"?type=large") > 0)
            {
                echo '<div class="fb-bug">Facebook</div>';
            }
            echo '<a href="javascript:Requested(\''.$friend['id'].'\',\''.$friend['name'].'\',\''.$friend['pic'].'\');" id="'.$friend['id'].'">';
            echo '<div class="headshot">';
            echo '<img src="'.$friend['pic'].'" width="100"/>';
            echo '</div>';
            echo '<div class="name">'.$friend['name'].'</div>';
            echo '<div class="badge"><img src="images/badge_request.png" width="24" height="24" /></div>';
            echo '</a>';
            echo '</div>';
        }
    }
}

if($_REQUEST['shared'] == true || $_REQUEST['all'] || $_REQUEST['group'])
{
    establishConnection();
    //agreed to share
    foreach($allFriends[1] as $friend)
    {
        $set = intval(isset($_REQUEST['id']));
        if($set)
        {
            if($friend['id'] == $_REQUEST['id'])
            {
                $wt = $friend['wt'];
                //echo "<p>WT is $wt</p>";
                $query = "SELECT title FROM WorkTypesNew WHERE id = '$wt'";
                $result = mysql_query($query) or die('Query failed: ' . mysql_error());
                $title = mysql_result($result, 0,  0);
                mysql_free_result($result);
                echo '<div class="tp-block">';
                echo '<a href="javascript:changeFeedback(\''.$friend['id'].'\',\''.$friend['name'].'\');" id="'.$friend['id'].'">';
                echo '<div class="headshot">';
                if(strpos($friend['pic'],"?type=large") > 0)
                {
                    echo '<div class="fb-bug">Facebook</div>';
                }
                echo '<img src="'.$friend['pic'].'" width="100"/>';
                echo '</div>';
                echo '<div class="name">'.$friend['name'].'</div>';
                echo '<div class="badge"><img src="images/Badges/'.$title.'.png" width="24" height="24" /></div>';
                echo '</a>';
                echo '</div>';
            }
        }
        else if($_REQUEST['group'])
        {
            if($friend['group'] == $_REQUEST['group'])
            {
                $wt = $friend['wt'];
                //echo "<p>WT is $wt</p>";
                $query = "SELECT title FROM WorkTypesNew WHERE id = '$wt'";
                $result = mysql_query($query) or die('Query failed: ' . mysql_error());
                $title = mysql_result($result, 0,  0);
                mysql_free_result($result);
                echo '<div class="tp-block">';
                echo '<a href="javascript:changeFeedback(\''.$friend['id'].'\',\''.$friend['name'].'\');" id="'.$friend['id'].'">';
                echo '<div class="headshot">';
                if(strpos($friend['pic'],"?type=large") > 0)
                {
                    echo '<div class="fb-bug">Facebook</div>';
                }
                echo '<img src="'.$friend['pic'].'" width="100"/>';
                echo '</div>';
                echo '<div class="name">'.$friend['name'].'</div>';
                echo '<div class="badge"><img src="images/Badges/'.$title.'.png" width="24" height="24" /></div>';
                echo '</a>';
                echo '</div>';
            }
        }
        else if($friend['group'] != '68a4hn5')
        {
            $wt = $friend['wt'];
            //echo "<p>WT is $wt</p>";
            $query = "SELECT title FROM WorkTypesNew WHERE id = '$wt'";
            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            $title = mysql_result($result, 0,  0);
            mysql_free_result($result);
            echo '<div class="tp-block">';
            echo '<a href="javascript:changeFeedback(\''.$friend['id'].'\',\''.$friend['name'].'\');" id="'.$friend['id'].'">';
            echo '<div class="headshot">';
            if(strpos($friend['pic'],"?type=large") > 0)
            {
                echo '<div class="fb-bug">Facebook</div>';
            }
            echo '<img src="'.$friend['pic'].'" width="100"/>';
            echo '</div>';
            echo '<div class="name">'.$friend['name'].'</div>';
            echo '<div class="badge"><img src="images/Badges/'.$title.'.png" width="24" height="24" /></div>';
            echo '</a>';
            echo '</div>';
        }
    }
    endConnection();
}

if($_REQUEST['asked'] == true || $_REQUEST['all'] || $_REQUEST['group'])
{
    //ask to share
    foreach($allFriends[2] as $friend)
    {
        $set = intval(isset($_REQUEST['id']));
        if($set)
        {
            if($friend['id'] == $_REQUEST['id'])
            {
                echo '<div class="tp-block">';
                echo '<a href="javascript:askToShare(\''.$friend['id'].'\',\''.$friend['name'].'\',\''.$friend['pic'].'\');" id="'.$friend['id'].'">';
                echo '<div class="headshot">';
                if(strpos($friend['pic'],"?type=large") > 0)
                {
                    echo '<div class="fb-bug">Facebook</div>';
                }
                echo '<img src="'.$friend['pic'].'" width="100"/>';
                echo '</div>';
                echo '<div class="name">'.$friend['name'].'</div>';
                echo '<div class="badge"><img src="images/badge_compare.png" width="24" height="24" /></div>';
                echo '</a>';
                echo '</div>';
            }
        }
        else if($_REQUEST['group'])
        {
            if($friend['group'] == $_REQUEST['group'])
            {
                echo '<div class="tp-block">';
                echo '<a href="javascript:askToShare(\''.$friend['id'].'\',\''.$friend['name'].'\',\''.$friend['pic'].'\');" id="'.$friend['id'].'">';
                echo '<div class="headshot">';
                if(strpos($friend['pic'],"?type=large") > 0)
                {
                    echo '<div class="fb-bug">Facebook</div>';
                }
                echo '<img src="'.$friend['pic'].'" width="100"/>';
                echo '</div>';
                echo '<div class="name">'.$friend['name'].'</div>';
                echo '<div class="badge"><img src="images/badge_compare.png" width="24" height="24" /></div>';
                echo '</a>';
                echo '</div>';
            }
        }
        else if($friend['group'] != '68a4hn5')
        {
            echo '<div class="tp-block">';
            echo '<a href="javascript:askToShare(\''.$friend['id'].'\',\''.$friend['name'].'\',\''.$friend['pic'].'\');" id="'.$friend['id'].'">';
            echo '<div class="headshot">';
            if(strpos($friend['pic'],"?type=large") > 0)
            {
                echo '<div class="fb-bug">Facebook</div>';
            }
            echo '<img src="'.$friend['pic'].'" width="100"/>';
            echo '</div>';
            echo '<div class="name">'.$friend['name'].'</div>';
            echo '<div class="badge"><img src="images/badge_compare.png" width="24" height="24" /></div>';
            echo '</a>';
            echo '</div>';
        }
    }
}

if($_REQUEST['invite'] == true || isset($_REQUEST['id']))
{
    //invite to tidepool
    foreach($allFriends[3] as $friend)
    {
        $set = intval(isset($_REQUEST['id']));
        if($set)
        {
            if($friend['id'] == $_REQUEST['id'])
            {
                echo '<div class="tp-block">';
                if(strpos($friend['pic'],"?type=large") > 0)
                {
                    echo '<a id="'.$friend['id'].'" href="javascript:sendFB(\''.$friend['id'].'\')">';
                    echo '<div class="headshot">';
                    echo '<div class="fb-bug">Facebook</div>';
                }
                else
                {
                    echo '<a id="'.$friend['id'].'" href="javascript:sendLI(\''.$friend['id'].'\',\''.$friend['name'].'\')">';
                    echo '<div class="headshot">';
                }
                echo '<img src="'.$friend['pic'].'" width="100"/>';
                echo '</div>';
                echo '<div class="name">'.$friend['name'].'</div>';
                echo '<div class="badge"><img src="images/badge_invite.png" width="24" height="24" /></div>';
                echo '</a>';
                echo '</div>';
            }
        }
        else
        {
            echo '<div class="tp-block">';
            if(strpos($friend['pic'],"?type=large") > 0)
            {
                echo '<a id="'.$friend['id'].'" href="javascript:sendFB(\''.$friend['id'].'\')">';
                echo '<div class="headshot">';
                echo '<div class="fb-bug">Facebook</div>';
            }
            else
            {
                echo '<a id="'.$friend['id'].'" href="javascript:sendLI(\''.$friend['id'].'\',\''.$friend['name'].'\')">';
                echo '<div class="headshot">';
            }
            echo '<img src="'.$friend['pic'].'" width="100"/>';
            echo '</div>';
            echo '<div class="name">'.$friend['name'].'</div>';
            echo '<div class="badge"><img src="images/badge_invite.png" width="24" height="24" /></div>';
            echo '</a>';
            echo '</div>';
        }
    }
}

if($_REQUEST['pending'] == true || $_REQUEST['all'] || $_REQUEST['group'])
{
    //pending requests
    foreach($allFriends[4] as $friend)
    {
        $set = intval(isset($_REQUEST['id']));
        if($set)
        {
            if($friend['id'] == $_REQUEST['id'])
            {
                echo '<div class="tp-block">';
                echo '<a href="javascript:Pending(\''.$friend['id'].'\',\''.$friend['name'].'\',\''.$friend['pic'].'\');" id="'.$friend['id'].'">';
                echo '<div class="headshot">';
                if(strpos($friend['pic'],"?type=large") > 0)
                {
                    echo '<div class="fb-bug">Facebook</div>';
                }
                echo '<img src="'.$friend['pic'].'" width="100"/>';
                echo '</div>';
                echo '<div class="name">'.$friend['name'].'</div>';
                echo '<div class="badge"><img src="images/badge_pending.png" width="24" height="24" /></div>';
                echo '</a>';
                echo '</div>';
            }
        }
        else if($_REQUEST['group'])
        {
            if($friend['group'] == $_REQUEST['group'])
            {
                echo '<div class="tp-block">';
                echo '<a href="javascript:Pending(\''.$friend['id'].'\',\''.$friend['name'].'\',\''.$friend['pic'].'\');" id="'.$friend['id'].'">';
                echo '<div class="headshot">';
                if(strpos($friend['pic'],"?type=large") > 0)
                {
                    echo '<div class="fb-bug">Facebook</div>';
                }
                echo '<img src="'.$friend['pic'].'" width="100"/>';
                echo '</div>';
                echo '<div class="name">'.$friend['name'].'</div>';
                echo '<div class="badge"><img src="images/badge_pending.png" width="24" height="24" /></div>';
                echo '</a>';
                echo '</div>';
            }
        }
        else if($friend['group'] != '68a4hn5')
        {
            echo '<div class="tp-block">';
            echo '<a href="javascript:Pending(\''.$friend['id'].'\',\''.$friend['name'].'\',\''.$friend['pic'].'\');" id="'.$friend['id'].'">';
            echo '<div class="headshot">';
            if(strpos($friend['pic'],"?type=large") > 0)
            {
                echo '<div class="fb-bug">Facebook</div>';
            }
            echo '<img src="'.$friend['pic'].'" width="100"/>';
            echo '</div>';
            echo '<div class="name">'.$friend['name'].'</div>';
            echo '<div class="badge"><img src="images/badge_pending.png" width="24" height="24" /></div>';
            echo '</a>';
            echo '</div>';
        }
    }
}
echo '</div>';
?>
</body>
</html>
