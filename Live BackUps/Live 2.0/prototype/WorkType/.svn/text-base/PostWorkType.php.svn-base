<?php
$pass   = $_REQUEST['password'];
$password   = $_COOKIE['password'];
if($password == 'd3moT1de' || $pass == 'd3moT1de')
{
    $ID = $_COOKIE['ID'];
    //$ID = "456";
    $link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = "SELECT SubDimension FROM CloudsScoring WHERE id = '".$ID."'";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    $temp = mysql_fetch_row($result);
    $holland = $temp[0];
    mysql_free_result($result);

    $query = "SELECT Type FROM FramesScoring WHERE id = '".$ID."'";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    $temp = mysql_fetch_row($result);
    $personality = $temp[0];
    mysql_free_result($result);

    //echo "<h1> Work Type Code: ".$personality.$holland."</h1>";

    $code = $personality.$holland;
    $query = "SELECT * FROM WorkTypes WHERE id = '".$code."'";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    //echo $result;
    $temp = mysql_fetch_row($result);
    //$personality = $temp[0];
    $p1 = "&nbsp&nbsp&nbsp&nbsp&nbsp".$temp[1];
    $p2 = "&nbsp&nbsp&nbsp&nbsp&nbsp".$temp[2];
    $p3 = "&nbsp&nbsp&nbsp&nbsp&nbsp".$temp[3];
    $title = $temp[4];
    mysql_free_result($result);
    //echo "<div style=\"float: left\">";
    ?>

<html>
<head>
    <script language="JavaScript">
        image1 = new Image();
        image1.src = "../images/dashboardOver.png";

        image2 = new Image();
        image2.src = "../images/graphOver.png";

        function goToDashboard() {
            document.body.innerHTML += '<form id="form" action="../NodeGraph/NodeGraph.php" method="post"><input type="hidden" name="password" value="d3mo"/>';
            //alert(value);
            document.getElementById("form").submit();
        }
        function InviteLinkedInFriends() {
            window.open ("http://tidepool.co/LinkedIn/LogIntoLinkedIn.php","Invite Your Friends",'width=300,height=400,resizeable,scrollbars');
        }

        function PostFB() {
            window.open ("http://tidepool.co/SocialMedia/Facebook/Post.php?worktype=<?echo $personality; echo $holland?>","Post To Facebook",'width=600,height=500,resizeable,scrollbars');
        }

        function Tweet() {
            window.open ("http://tidepool.co/SocialMedia/Twitter/Post.php?worktype=<?echo $personality; echo $holland?>","Tweet To Twitter",'width=600,height=500,resizeable,scrollbars');
        }

        function goToNodeGraph() {
            document.body.innerHTML += '<form id="form" action="../NodeGraph/NodeGraph.php" method="post"><input type="hidden" name="password" value="d3mo"/>';
            //alert(value);
            document.getElementById("form").submit();
        }

        function relocate(value) {
            document.body.innerHTML += '<form id="form" action="<? echo "http://tidepool.co/LinkedIn/Twitter/Twitter.php" ?>" method="post"><input type="hidden" name="ID" value="<? echo $ID?>"/><input type="hidden" name="clouds" value="<? echo $holland?>"/>';
            //alert(value);
            document.getElementById("form").submit();
        }

        function target_popup(form) {
            window.open('', 'formpopup', 'width=300,height=400,resizeable,scrollbars');
            form.target = 'formpopup';
        }
    </script>
    <style type="text/css">
        .feedback
        {
            width:500px;
            text-align:justify;
            font-family: helvetica;
            color: #00446A;
            font-weight: bold;
            font-size: 14;
        }
    </style>
</head>
<body style="background-color: #EEEEEE">
<title>Work Type</title>

<div align="center">
    <!--
    <table cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="146">
                <a style="text-decoration:none" href="javascript:goToDashboard()" onmouseover="image1.src='../images/dashboardOver.png';"onmouseout="image1.src='../images/dashboard.png';">
                    <img name="image1" width="146" height="35" border="0" src="../images/dashboard.png">
                </a>
            </td>
            <td width="146">
                <a style="text-decoration:none" href="javascript:goToNodeGraph()" onmouseover="image2.src='../images/graphOver.png';"onmouseout="image2.src='../images/graph.png';">
                    <img name="image2" width="146" height="35" border="0" src="../images/graph.png">
                </a>
            </td>
        </tr>
    </table>
    -->
    <p class="feedback" style="font-size: 36; text-align: center;"><?echo $title?></p>
    <p class="feedback"><?echo $p1?></p>
    <p class="feedback"><?echo $p2?></p>
    <p class="feedback"><?echo $p3?></p>

    <!--
    <b style="font-size: 12; font-family: helvetica ">Share TidePool with your connections</b><br>
    <a style="text-decoration:none" href="javascript:InviteLinkedInFriends()";">
    <img border="0" src="LinkedInButton.png">
    </a><br><br>
    <form action="http://tidepool.co/LinkedIn/Twitter/Twitter.php" method="post"">
    <input type="hidden"/>
    <input type="hidden" name="ID" value="<? echo $ID?>"/>
    <input type="hidden" name="Clouds" value="<? echo $holland?>"/>
    <input type="hidden" name="WT" value="<? echo $code?>"/>
    <input name="submit" type="submit" value="See Your Connections"/></td></tr>
    </form>

    <div align="right">
        <img src="RockLeaf.jpg" alt="Rock Leaf Pic" style="width:250px;height: 250px"/>
    </div>
       <a href="javascript:Tweet()" ">Tweet Your WorkType on Twitter</a>
       <a href="javascript:PostFB()" ">Post Your WorkType on Facebook</a>

    -->
</div>
</body>
</html>
<?
    $query = "UPDATE UserInfo SET WorkType='".$code."' WHERE id=$ID;";
    //echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);

    setcookie("password", "", time()-3600,"/", ".tidepool.co"); /* Expires in a day */
    setcookie("ID", "", time()-3600,"/", ".tidepool.co"); /* Expires in a day */

}
else
{
    echo "<h3>Invalid Password</h3>";
}
?>