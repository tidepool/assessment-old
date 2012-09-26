<?php

require_once "Facebook/FacebookAPI.php";
require_once "LinkedIn/LinkedInAPI.php";

$facebook;
$savedPassword;
$login = $_COOKIE['login'];
if($login != "")
{
    redirect();
}
elseif(isset($_REQUEST['login']))
{
    if(CheckIfInSystem("Login","'".$_REQUEST['login']."'"))
    {
        if($_REQUEST['password'] == $savedPassword)
        {
            redirect();
        }
        else
        {
            $error = "Incorrect Password";
            $user = array();
            $user['email'] = $_REQUEST['login'];
            $user['password'] = $_REQUEST['password'];
            DisplayLogin($user,$error);
        }
    }
    else
    {
        $error = "That email is not in our system"."<br/><a href='javascript:GoToSignUp();'>Sign Up</a>";
        $user = array();
        $user['email'] = $_REQUEST['login'];
        $user['password'] = $_REQUEST['password'];
        DisplayLogin($user,$error);
    }
}
elseif ($_GET['run_func'] == 'yes')
{
    LoginToLI();
}
elseif(isset($_REQUEST['lType']))
{
    continueLoggginIn();
}
elseif(isset($_REQUEST['state']))
{
    $user = getFBID();
    if(CheckIfInSystem("FBID",$user['id']))
    {
        //echo "Login Successful";
        redirect();
    }
    else
    {
        $error = "Your Facebook is not in our system"."<br/><a href='javascript:GoToSignUp();'>Sign Up</a>";
        $user = array();
        $user['email'] = $_REQUEST['login'];
        $user['password'] = $_REQUEST['password'];
        DisplayLogin($user,$error);
    }
}
elseif(checkCode())
{
    DisplayLogin(false,null);
}
elseif(oauth_session_exists())
{
    $user = getLIID();
    if(CheckIfInSystem("LIID","'".$user['id']."'"))
    {
        //echo "Login Successful";
        redirect();
    }
    else
    {
        $error = "Your LinkedIn is not in our system"."<br/><a href='javascript:GoToSignUp();'>Sign Up</a>";
        $user = array();
        $user['email'] = $_REQUEST['login'];
        $user['password'] = $_REQUEST['password'];
        DisplayLogin($user,$error);
    }
}
else
{
    echo "Sorry but your Beta key is invalid. Please contact info@tidepool.co for a new Beta key or questions.";
}

function CheckIfInSystem($field,$id)
{
    Global $savedPassword, $login;
    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');
    $IP = $_SERVER['REMOTE_ADDR'];
    $date = date("F j, Y, g:i a T");
    $query = "SELECT Stage,Password,Login,Name FROM Delta WHERE $field=$id;";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $count = mysql_result($result, 0,0);
    $savedPassword = mysql_result($result,0,1);
    $login = mysql_result($result,0,2);
    $name = mysql_result($result,0,3);

    //echo "<p>Count: $count</p>";
    //echo "<p>Saved: $savedPassword</p>";
    //echo $count;
    mysql_free_result($result);
    mysql_close($link);

    if($count != "")
    {
        setcookie("login", $login, time()+3600,"/", ".tidepool.co"); /* Expires in a day */
        setcookie("name", $name, time()+3600,"/", ".tidepool.co"); /* Expires in a day */
        return true;
    }
    else
    {
        //echo "not in the system";
        return false;
    }
}

function checkCode()
{
    $codes = array("rfwk411","q","secret");
    $password = $_REQUEST['password'];
    foreach($codes as $code)
    {
        if($code == $password)
        {
            return true;
        }
    }
    return false;
}

function redirect()
{
    Global $login;
    $target = do_post_request("http://tidepool.co/Delta/Map.php", "name=Init&ID=$login");
    ?>
<html>
<head>
    <title>Redirect</title>
</head>
<body>
<script language="JavaScript">
    document.body.innerHTML += '<form id="form" action="http://tidepool.co/Delta/<? echo $target; ?>.php" method="post">"/>';
    document.getElementById("form").submit();
</script>
</body>
</html>
<?
}


function DisplayLogin($user,$msg)
{
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
        function GoToSignUp()
        {
            document.body.innerHTML += '<form id="form" action="SignUp.php" method="post"><input type="hidden" name="password" value="secret"/>';
            document.getElementById("form").submit();
        }
        function ChangeColor1()
        {
            document.getElementById('button1').style.backgroundColor = 'blue'
        }
        function ResetColor1()
        {
            document.getElementById('button1').style.backgroundColor = ''
        }
        function ChangeColor2()
        {
            document.getElementById('button2').style.backgroundColor = 'blue'
        }
        function ResetColor2()
        {
            document.getElementById('button2').style.backgroundColor = ''
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
        <form action="" method="post">
            <h3 style="font-family: 'Helvetica', helvetica, serif; padding-top: 15px">Login</h3>
            <?
            if($msg != null)
            {
                ?>

                <h4 style="font-family: 'Helvetica', helvetica, serif; padding-top: 15px;color: red"><? echo $msg ?></h4>
                <?
            }
            ?>
            <table>
                <tr>
                    <td>
                        <p>Email</p>
                    </td>
                    <td style="padding-left: 10px">
                        <input class="fields" type="text"  name="login" value="<? echo $user['email'] ?>"style="width: 200px;">
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Password</p>
                    </td>
                    <td style="padding-left: 10px">
                        <input class="fields" type="password" value="<? echo $user['password'];?>" name="password" style="width: 200px;">
                    </td>
                </tr>

            </table>
            <? if($user != null)
        {
            ?>
            <input type="hidden" name="ID" value="<? echo $user['id'] ?>" >
            <input type="hidden" name="type" value="<? echo $user['type'] ?>" >
            <?
        }
            ?>
            <div align="center">
                <input class="fields" type="submit" value="Login">
            </div>
        </form>
        <table style="padding:20px;" cellspacing="10px">
            <tr>
                <td align="center">
                    <a style="text-decoration:none" href="<? getLoginLink() ?>">
                        <img src="images/FBLogin.png" id="button1" onmouseover="ChangeColor1()" onmouseout="ResetColor1()" width="195px" height="36.6px" style="border: 1px solid black">
                    </a>
                </td>
                <td align="center">
                    <a style="text-decoration:none" href="?run_func=yes">
                        <img src="images/LILogin.png" id="button2" onmouseover="ChangeColor2()" onmouseout="ResetColor2()" width="195px" height="36.6px" style="border: 1px solid black">
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
<?
}

function do_post_request($url, $data, $optional_headers = null)
{
    $params = array('http' => array(
        'method' => 'POST',
        'content' => $data
    ));
    if ($optional_headers !== null) {
        $params['http']['header'] = $optional_headers;
    }
    $ctx = stream_context_create($params);
    $fp = @fopen($url, 'rb', false, $ctx);
    if (!$fp) {
        throw new Exception("Problem with $url, $php_errormsg");
    }
    $response = @stream_get_contents($fp);
    if ($response === false) {
        throw new Exception("Problem reading data from $url, $php_errormsg");
    }
    return $response;
}
?>