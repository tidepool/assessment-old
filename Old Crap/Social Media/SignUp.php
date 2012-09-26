<?php

require_once "Facebook/FacebookAPI.php";
require_once "LinkedIn/LinkedInAPI.php";

$facebook;
if(isset($_FILES['userfile']))
{

    $login = $_REQUEST['login'];
    $email = $_REQUEST['login'];

    $uploaddir = './Pics/';
    $time=time();
    $filename = $time.basename($_FILES['userfile']['name']);
    $uploadfile = $uploaddir.$filename;

    //echo "<p>$uploadfile</p>";
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
    {
        $msg = "File is valid, and was successfully uploaded.";
        $pic = $filename;
        $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
        or die('Could not connect: ' . mysql_error());
        mysql_select_db('tidepool') or die('Could not select database');


        $query = "UPDATE Delta SET picture='$pic' WHERE Login='$login';";
        //echo $query;
        $result = mysql_query($query) or deciferError(mysql_error());
        mysql_close($link);
    }
    else
    {
        $msg = "Error uploading picture";
        $pic = null;

    }
    redirect($msg,$pic);
}
else if(isset($_REQUEST['login']))
{
    $showLink = true;
    $ID = $_REQUEST['ID'];
    $password = $_REQUEST['password'];
    $type = $_REQUEST['type'];
    if($password == "")
    {
        //DisplayLogin(false,$user);
        $error = "No password given";
        $user['id'] = $_REQUEST['ID'];
        $user['type'] = $_REQUEST['type'];
        $user['name'] = $_REQUEST['name'];
        $user['email'] = $_REQUEST['login'];
        $user['password'] = $_REQUEST['password'];
        DisplayLogin($user,$error);
    }
    elseif(strlen($password) < 6)
    {
        $error = "Your password must be at least 6 characters";
        $user['id'] = $_REQUEST['ID'];
        $user['type'] = $_REQUEST['type'];
        $user['name'] = $_REQUEST['name'];
        $user['email'] = $_REQUEST['login'];
        $user['password'] = $_REQUEST['password'];
        DisplayLogin($user,$error);
    }
    elseif(!filter_var($_REQUEST['login'], FILTER_VALIDATE_EMAIL))
    {
        $error = "Your email is invalid";
        $user['id'] = $_REQUEST['ID'];
        $user['type'] = $_REQUEST['type'];
        $user['name'] = $_REQUEST['name'];
        $user['email'] = $_REQUEST['login'];
        $user['password'] = $_REQUEST['password'];
        DisplayLogin($user,$error);
    }
    else
    {
        $ID = $_REQUEST['ID'];

        $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
        or die('Could not connect: ' . mysql_error());
        mysql_select_db('tidepool') or die('Could not select database');

        $ID = $_REQUEST['ID'];
        $name = $_REQUEST['name'];
        $login = $_REQUEST['login'];
        $password = $_REQUEST['password'];
        if($_REQUEST['type'] == "FB")
        {
            $queryString = $ID.",NULL,NULL,'$name','$login','$password',NULL,0,''";
        }
        elseif($_REQUEST['type'] == "LI")
        {
            $pic = getPicURL();
        }
        else
        {
            $queryString = "NULL,NULL,NULL,'$name','$login','$password',NULL,0,''";
        }

        $query = "INSERT INTO Delta (FBID, TID, LIID, Name, Login, Password, WorkType, Stage,picture) VALUES ($queryString);";
        $result = mysql_query($query) or deciferError(mysql_error());
        if($showLink)
        {
            $count = mysql_result($result, 0);
            mysql_free_result($result);
            $email = $_REQUEST['login'];
            setcookie("login", $email, time()+3600,"/", ".tidepool.co"); /* Expires in an hour */
            setcookie("name", $name, time()+3600,"/", ".tidepool.co"); /* Expires in an hour */
            redirect($_REQUEST['type'],null);
        }
        else
        {
            $user['id'] = $_REQUEST['ID'];
            $user['type'] = $_REQUEST['type'];
            $user['name'] = $_REQUEST['name'];
            $user['email'] = $_REQUEST['login'];
            $user['password'] = $_REQUEST['password'];
            DisplayLogin($user,$error);
        }
        mysql_close($link);
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
    $user['type'] = "FB";
    //echo "<p>Gender: ".$user['gender']."</p>";
    DisplayLogin($user,null);
}
elseif(checkCode())
{
    DisplayLogin(false,null);
}
elseif(oauth_session_exists())
{
    $user = getLIID();
    $user['type'] = "LI";
    DisplayLogin($user,null);
}
else
{
    echo "Sorry but your Beta key is invalid. Please contact info@tidepool.co for a new Beta key or questions.";
}

function deciferError($message)
{
    Global $showLink, $error;
    $showLink = false;

    if(strpos($message,"Login"))
    {
        $error = "This email has already been registered"."<br/><a href='javascript:GoToLogin();'>Log In</a>";
    }
    elseif(strpos($message,"FBID"))
    {
        $error = "This Facebook has already been registered"."<br/><a href='javascript:GoToLogin();'>Log In</a>";;
    }
    elseif(strpos($message,"LIID"))
    {
        $error = "This LinkedIn has already been registered"."<br/><a href='javascript:GoToLogin();'>Log In</a>";;
    }
    else
    {
        $error = "Our system is currently down at the moment";
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

function redirect($type,$pic)
{
    Global $ID;
    $login = $_COOKIE['login'];
    $name = $_COOKIE['name'];
    //echo "<p>$name</p>";
    ?>
<html>
<head>
    <title>Take Test</title>
    <script language="JavaScript">
        function Redirect()
        {
            document.body.innerHTML += '<form id="form" action="http://tidepool.co/Delta/Loading/SLoading.php" method="post"><input type="hidden" name="ID" value="<? echo $login;?>"/><input type="hidden" name="type" value="<?echo $type;?>"/><input type="hidden" name="password" value="d3mo"/>';
            document.getElementById("form").submit();
        }
    </script>
</head>
<body>
<div align="center">
    <h1>Welcome <?echo $name;?></h1>
    <?
    if($type == "FB")
    {
        echo "<img src='https://graph.facebook.com/".$ID."/picture?type=large'>";
    }
    else if($type == "LI")
    {
        $url = getPicURL();
        //echo $url;
        echo "<img src='".$url."'>";
    }
    else
    {
        echo "<br/>";
        if($pic !=  null)
        {
            ?>
            <img src="Pics/<? echo $pic; ?>" alt="Your Picture">
            <?
        }
        else
        {
            echo "<p>$type</p>";
            echo "<p>Upload A Picture</p>";
            ?>
            <form enctype="multipart/form-data" action="?" method="POST">
                <input name="userfile" type="file" />
                <input type="submit" value="Send File" />
            </form>
            <?
        }
        echo "<br/>";
    }
    ?>
    <h3><a href="javascript:Redirect()">Take TidePool's Assessment</a></h3>
</div>
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
    <title>Sign Up</title>
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
        function GoToLogin()
        {
            document.body.innerHTML += '<form id="form" action="Login.php" method="post"><input type="hidden" name="password" value="secret"/>';
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
            <h3 style="font-family: 'Helvetica', helvetica, serif; padding-top: 15px">Create Account</h3>
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
                        <p>Name</p>
                    </td>
                    <td style="padding-left: 10px">
                        <input class="fields" type="text" value="<? echo $user['name'] ?>" name="name" style="width: 200px;">
                    </td>
                </tr>
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
                <input class="fields" type="submit" value="Sign Up">
            </div>
        </form>
        <table style="padding:20px;" cellspacing="10px">
            <tr>
                <td align="center">
                    <a style="text-decoration:none" href="<? getLoginLink() ?>">
                        <img src="images/FBSignUp.png" id="button1" onmouseover="ChangeColor1()" onmouseout="ResetColor1()" width="195px" height="36.6px" style="border: 1px solid black">
                    </a>
                </td>
                <td align="center">
                    <a style="text-decoration:none" href="?run_func=yes">
                        <img src="images/LISignUp.png" id="button2" onmouseover="ChangeColor2()" onmouseout="ResetColor2()" width="195px" height="36.6px" style="border: 1px solid black">
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
?>