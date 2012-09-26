<?php
require_once "Facebook/FacebookAPI.php";
require_once "LinkedIn/LinkedInAPI.php";

$facebook;
$savedPassword;

$ID = $_REQUEST['ID'];
//echo $ID;
if($_REQUEST['password'] == "d3mo")
{
    DisplayLogin(false,null);
}
elseif ($_REQUEST['run_func'] == 'yes')
{
    LoginToLI();
}
elseif(isset($_REQUEST['lType']))
{
    continueLoggginIn();
}
elseif(isset($_REQUEST['state']))
{
    getFBID();
    //print_r($friends);
    //echo "<p>Logged In With Facebook</p>";
    DisplayInviteFriends("Facebook");
    //redirect();
}
elseif(oauth_session_exists())
{
    //$friends = getLIFriends();
    //print_r($friends);
    //echo "<p>Logged In With LinkedIn</p>";
    DisplayInviteFriends("LinkedIn");
    //redirect();
}
else
{
    echo "Error you are not authorized to see this page";
}

function redirect()
{
    Global $email;
    ?>
<html>
<head>
    <title>Redirect</title>
</head>
<body>
<script language="JavaScript">
    document.body.innerHTML += '<form id="form" action="http://tidepool.co/Delta/WorkType/PostWorkType.php" method="post"><input type="hidden" name="ID" value="<? echo $email;?>"/><input type="hidden" name="password" value="d3mo"/>';
    document.getElementById("form").submit();
</script>
</body>
</html>
<?
}


function DisplayLogin($user,$msg)
{
    Global $ID;
    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
    <style type="text/css">
        p {
            font-family: "Helvetica", helvetica, serif;
            font-size: 14pt;
        }
        .fields {
            font-family: "Helvetica", helvetica, serif;
            font-size: 14pt;
        }
    </style>
    <script>
        function GoToCBoard() {
            document.body.innerHTML += '<form id="form" action="CBoard/CBoard.php" method="post"><input type="hidden" name="ID" value="<? echo $ID?>"/><input type="hidden" name="password" value="d3mo"/>';
            //alert(value);
            document.getElementById("form").submit();
        }
    </script>

</head>
<body style="background-color: #EEEEEE">
<div name="main" align="center" style="padding: 20px;">
    <div align="center" style="width: 500px; padding: 20px;">
        <div align="left">
            <img src="images/Logo.png" alt="TidePool" width="144px" height="86.5px">
        </div>
    </div>
    <div align="center" style="background-color: #ffffff; width: 500px">
        <h2 style="font-family: 'Helvetica', helvetica, serif; padding-top: 15px">Invite Your Friends to TidePool</h2>
        <table cellpadding="10px">
            <tr>
                <td align="center">
                    <a style="text-decoration:none" href="?run_func=yes&ID=<? echo $ID; ?>">
                        <img src="images/LILogo.png">
                    </a>
                </td>
                <td style="width: 50px"/>
                <td>
                    <a style="text-decoration:none" href="<? getLoginLink() ?>&ID=<? echo $ID; ?>">
                        <img src="images/FBLogo.png">
                    </a>
                </td>
            </tr>
        </table>
        <a style="text-decoration:none;" href="javascript:GoToCBoard();">
            <h3 style="font-family: 'Helvetica', helvetica, serif; padding-bottom: 10px;">See My Connections</h3>
        </a>
    </div>
</div>
</body>
</html>
<?
}


function DisplayInviteFriends($location)
{
    Global $ID;
    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
    <style type="text/css">
        p {
            font-family: "Helvetica", helvetica, serif;
            font-size: 14pt;
        }
        .fields {
            font-family: "Helvetica", helvetica, serif;
            font-size: 14pt;
        }
    </style>
    <script>
        function GoToCBoard() {
            document.body.innerHTML += '<form id="form" action="CBoard/CBoard.php" method="post"><input type="hidden" name="ID" value="<? echo $ID?>"/><input type="hidden" name="password" value="d3mo"/>';
            //alert(value);
            document.getElementById("form").submit();
        }
    </script>

</head>
<body style="background-color: #EEEEEE">
<div name="main" align="center" style="padding: 20px;">
    <div align="center" style="width: 600px; padding: 20px;">
        <div align="left">
            <img src="images/Logo.png" alt="TidePool" width="144px" height="86.5px">
        </div>
    </div>
    <div align="center" style="background-color: #ffffff; width: 600px">
        <h2 style="font-family: 'Helvetica', helvetica, serif; padding-top: 15px">Invite Your Friends to TidePool</h2>
        <table cellpadding="10px">
            <tr>
                <td align="center">
                    <a style="text-decoration:none" href="?run_func=yes&ID=<? echo $ID; ?>">
                        <img src="images/LILogo.png">
                    </a>
                </td>
                <td style="width: 50px"/>
                <td>
                    <a style="text-decoration:none" href="<? getLoginLink() ?>&ID=<? echo $ID; ?>">
                        <img src="images/FBLogo.png">
                    </a>
                </td>
            </tr>
        </table>
        <iframe src="<? echo $location; ?>/FriendDisplay.php" width="500" height="300" scrolling="yes">
            <p>Your browser does not support iframes.</p>
        </iframe>
        <a style="text-decoration:none;" href="javascript:GoToCBoard();">
            <h3 style="font-family: 'Helvetica', helvetica, serif; padding-bottom: 10px;">See My Connections</h3>
        </a>
    </div>
</div>
</body>
</html>
<?
}
?>