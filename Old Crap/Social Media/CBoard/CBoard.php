<?php

require_once "../LinkedIn/LinkedInAPI.php";

if($_REQUEST['password'] != "d3mo")
{
    echo "You do not have access to this feature";
}
else
{
    $xmlString = "<users>";
    $xmlString .= generateTidepoolData();
    $xmlString .= "</users>";
    ?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tidepool Connections</title>
    <script language="JavaScript">
        function sendToJavaScript(value) {
            document.body.innerHTML += '<form id="form" action="../<? echo $target ?>.php" method="post"><input type="hidden" name="ID" value="<? echo $ID?>"/><input type="hidden" name="password" value="d3mo"/>';
            //alert(value);
            document.getElementById("form").submit();
        }

        function getValues(value) {
            //alert("first call!");
            var flash = getFlashMovieObject("CBoard");
            flash.recieveValues(<? echo "'$xmlString'";?>);
            //alert("test worked again!");
        }

        function getFlashMovieObject(n) {
            if (window.document[n]) return window.document[n];

            if (navigator.appName.indexOf("Microsoft Internet") == -1) {
                if (document.embeds && document.embeds[n])
                    return document.embeds[n];
            }
            else return document.getElementById(n);
        }
    </script>
</head>
<body onload="pageInit();">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        id="CBoard" width="100%" height="100%"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="CBoard.swf" />
    <param name="quality" value="high" />
    <param name="bgcolor" value="#869ca7" />
    <param name="SCALE" value="exactfit">
    <param name="allowScriptAccess" value="sameDomain" />
    <embed src="CBoard.swf?<?echo rand(1000000,9999999); ?>" quality="high"
           width="100%" height="100%" SCALE="exactfit" name="CBoard" align="middle"
           play="true" loop="false" quality="high" allowScriptAccess="sameDomain"
           type="application/x-shockwave-flash"
           pluginspage="http://www.macromedia.com/go/getflashplayer">
    </embed>
</object>
</body>
</html>
<?php
}

function generateTidepoolData()
{
    Global $userName, $userPic;
    $link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');
    $interest = null;
    $ID = $_COOKIE['login'];
    $userName = $_COOKIE['name'];
    $WT = $_COOKIE['WTCode'];

    $query = "SELECT FBID,LIID,picture FROM Delta WHERE Login='$ID';";
    //$query = "SELECT Login FROM Delta;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    $FBID = $temp[0];
    $LIID = $temp[1];
    $picURL = $temp[3];
    //echo "<p>Facebook: $FBID</p>";
    //echo "<p>Linkedin: $LIID</p>";

    if(strlen($FBID) > 3)
    {
        $picURL = "https://graph.facebook.com/".$FBID."/picture?type=large";
    }
    else if(strlen($LIID) > 3)
    {
        $picURL = getPicURL();
    }
    else if(strlen($picURL) > 3)
    {
        $picURL = "../Pics/".$picURL;
        //echo $picURL;
    }
    else
    {
        $picURL = "../images/Anonymous.png";
    }

    //echo "<p>$ID</p>";
    $query = "SELECT * FROM FramesScoring WHERE ID = '$ID'";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    $temp = mysql_fetch_row($result);
    $frame1 = $temp[1];
    $frame2 = $temp[2];
    $frame3 = $temp[3];
    $frame4 = $temp[4];
    $frame5 = $temp[5];
    mysql_free_result($result);

    //taker
    $tidepool = "<taker>";
    $tidepool .= "<name>$userName</name>";
    $tidepool .= "<pic>$picURL</pic>";
    $tidepool .= "<job>null</job>";
    $tidepool .= "<worktype>$WT</worktype>";
    $tidepool .= "<interest>$interest</interest>";
    $tidepool .= "<frames>$frame1,$frame2,$frame3,$frame4,$frame5</frames>";
    $tidepool .= "</taker>";

    //Kabir
    $tidepool .= "<user>";
    $tidepool .= "<name>Kabir Sagoo</name>";
    $tidepool .= "<pic>http://media01.linkedin.com/media/p/2/000/09a/283/0415255.jpg</pic>";
    $tidepool .= "<job>Tidepool</job>";
    $tidepool .= "<worktype>HNE</worktype>";
    $tidepool .= "<interest>Enterprising</interest>";
    $tidepool .= "<desc>If you want to explore new places give Kabir a call</desc>";
    $tidepool .= "<frames>6,-1,1,12,6</frames>";
    $tidepool .= "</user>";


    //Galen
    $tidepool .= "<user>";
    $tidepool .= "<name>Galen Buckwalter</name>";
    $tidepool .= "<pic>http://media03.linkedin.com/media/p/3/000/018/10a/29e27cb.jpg</pic>";
    $tidepool .= "<job>Tidepool</job>";
    $tidepool .= "<worktype>LCA</worktype>";
    $tidepool .= "<interest>Artistic</interest>";
    $tidepool .= "<desc>You might benefit from Galen\'s analytical skills</desc>";
    $tidepool .= "<frames>-1,1,4,7,4</frames>";
    $tidepool .= "</user>";

    //Deborah
    $tidepool .= "<user>";
    $tidepool .= "<name>Deborah Buckwalter</name>";
    $tidepool .= "<pic>http://media02.linkedin.com/media/p/1/000/042/392/1a99ec3.jpg</pic>";
    $tidepool .= "<job>Tidepool</job>";
    $tidepool .= "<worktype>HAS</worktype>";
    $tidepool .= "<interest>Social</interest>";
    $tidepool .= "<desc>We suggest you talk to Deborah about company social events</desc>";
    $tidepool .= "<frames>4,12,3,2,1</frames>";
    $tidepool .= "</user>";

    //Eric
    $tidepool .= "<user>";
    $tidepool .= "<name>Eric Chance</name>";
    $tidepool .= "<pic>../images/Anonymous.png</pic>";
    $tidepool .= "<job>Tidepool</job>";
    $tidepool .= "<worktype>HOA</worktype>";
    $tidepool .= "<interest>Artistic</interest>";
    $tidepool .= "<desc>You can trust Eric to spearhead new products</desc>";
    $tidepool .= "<frames>0,3,1,7,13</frames>";
    $tidepool .= "</user>";

    //Ryan
    $tidepool .= "<user>";
    $tidepool .= "<name>Ryan Howes</name>";
    $tidepool .= "<pic>http://media02.linkedin.com/media/p/2/000/009/2be/3fbb692.jpg</pic>";
    $tidepool .= "<job>Tidepool</job>";
    $tidepool .= "<worktype>HOS</worktype>";
    $tidepool .= "<interest>Social</interest>";
    $tidepool .= "<desc>You can help Ryan with swift decisions</desc>";
    $tidepool .= "<frames>7,2,-2,2,11</frames>";
    $tidepool .= "</user>";

    //Rhett
    $tidepool .= "<user>";
    $tidepool .= "<name>Rhett Fahrney</name>";
    $tidepool .= "<pic>http://media.linkedin.com/mpr/mprx/0_tK6jMq5GyLiYj-UfKA8CMntSy_kxjqUfrl-CMBig_LK7GKu7On9AccBPtmX8Y1siPPXinrAxGYLr</pic>";
    $tidepool .= "<job>Tidepool</job>";
    $tidepool .= "<worktype>HNR</worktype>";
    $tidepool .= "<interest>Realistic</interest>";
    $tidepool .= "<desc>If you want to hear an honest opinion talk to Rhett</desc>";
    $tidepool .= "<frames>12,-3,5,4,8</frames>";
    $tidepool .= "</user>";

    //Wei
    $tidepool .= "<user>";
    $tidepool .= "<name>Wei Wu</name>";
    $tidepool .= "<pic>http://media.linkedin.com/mpr/mprx/0_uQ-VaJdjmjlwzgXEmkiLasdr2yX6BgvEaT65asJ81Vr9eJCoh8G98VSmGlkJqsNQS5rX3jwxohnI</pic>";
    $tidepool .= "<job>Tidepool</job>";
    $tidepool .= "<worktype>HCE</worktype>";
    $tidepool .= "<interest>Enterprising</interest>";
    $tidepool .= "<desc>Wei would be a good person to talk details with</desc>";
    $tidepool .= "<frames>4,2,-5,4,9</frames>";
    $tidepool .= "</user>";

    return $tidepool;
}
?>