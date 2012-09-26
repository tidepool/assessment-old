<?
if (isset($_REQUEST['wipe']))
{
    require_once "WipeCookies.php";
    wipeCookies();
    $name = "";
}
else
{
    $name = $_COOKIE['name'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
    <style type="text/css">
        @font-face {
            font-family: Gothic ;
            src: url( Century Gothic.ttf ) format("truetype");
        }
        p {
            font-family: "Helvetica", helvetica, serif;
            font-size: 12pt;
            margin: 0;
            padding-bottom: 5px;
        }
        .ipsum {
            font-family: "Helvetica", helvetica, serif;
            font-size: 48pt;
            padding: 0px;
            margin: 0;
        }
        .buttons {
            font-family: "Helvetica", helvetica, serif;
            font-size: 16pt;
            width: 100px;
            color: blue;
            margin: 0;
        }
    </style>
    <script language="JavaScript">
        function SignUp()
        {
            var code = document.getElementById("code").value;
            document.body.innerHTML += '<form id="form" action="SignUp.php" method="post"><input type="hidden" name="password" value="'+code+'"/>';
            document.getElementById("form").submit();
        }
        function Login()
        {
            var code = document.getElementById("code").value;
            document.body.innerHTML += '<form id="form" action="Login.php" method="post"><input type="hidden" name="password" value="'+code+'"/>';
            document.getElementById("form").submit();
        }
    </script>
</head>
<body style="background-color: #eeeeee;">
<?
if($name != "")
{
    ?>
<a href="?wipe=true">
    <h5 align="right">Logout <? echo $name; ?></h5>
</a>
    <?
}
?>
<div name="main" align="center" style="padding: 20px;">
    <div align="center" style="padding-top: 100px;padding-bottom: 30px;width: 600px;">
        <img src="images/Logo.png" alt="TidePool">
        <p class="ipsum" style="font-size: 13.5pt;position: relative;top: 0px;padding-bottom: 10px;">Find out more about yourself and your friends</p>
        <div align="center" style="width: 300px; padding-bottom: 10px; padding-top: 75px">
            <table cellpadding="10px">
                <tr>
                    <td align="center">
                        <form action="javascript:SignUp()">
                            <input class="buttons" type="submit" value="Sign Up">
                        </form>
                    </td>
                    <td align="center">
                        <form action="javascript:Login()">
                            <input class="buttons" type="submit" value="Login">
                        </form>
                    </td>
                </tr>
            </table>
            <p>Beta Code</p>
            <input type="password"  id="code" style="width: 100px;border: 2px solid blue;">
        </div>
    </div>
</div>
</body>
</html>