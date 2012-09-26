<?php
//echo "<p align='center'>Our assessment is currently down for maintance. Please check back tomorrow.</p>";
//return true;
/*
if($_SERVER['SERVER_PORT'] != '443')
{
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    //exit();
}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="style/images/LogoHalf.png" type="image/png">
    <link rel="stylesheet" href="style/landingpage.css"/>
    <title>Tidepool</title>
</head>
<script>
    eg_on = new Image ( );
    eg_off = new Image ( );
    eg_on.src = "images/login.png";
    eg_off.src = "images/login_hover.png";
    function button_on ( imgId )
    {
        if ( document.images )
        {
            butOn = eval ( imgId + "_on.src" );
            document.getElementById(imgId).src = butOn;
        }
    }

    function button_off ( imgId )
    {
        if ( document.images )
        {
            butOff = eval ( imgId + "_off.src" );
            document.getElementById(imgId).src = butOff;
        }
    }
</script>
<body align="center">
<div class="main" align="center">
    <div class="title" id="title" align="center">

    </div>
    <br />
    <div class="form" align="center">
        <img src="style/images/Logo.png" width="250"/>
        <div class="statement" >Welcome to our Assessment</div>
        <div class="statement" style="font-size:16px;" align="center">
            <form action="Loading/Loading.php" method="post">
                <table cellpadding="5px">
                    <tr><td align="right"><td align="center"> <input class="input" name="full_name" value="Full Name"/></td></tr>

                    <tr><td align="right"><td align="center"> <input class="input" name="email" value="Email"/></td></tr>

                    <tr><td align="right"><td align="center"> <input class="input" name="name"  value="Username"/></td></tr>

                    <tr><td align="right"><td align="center"> <input class="input" name="password" type="password" value="Password" /></td></tr>
                </table>
                <div align="center">
                    <br/>
                    <input type="image" class="login" onmouseout="button_off('eg');"
                             onmouseover="button_on('eg');"
                        src="images/login_hover.png" alt="Login" id="eg"">
                </div>
            </form>
        </div>
    </div>
</div>
</body >
</html>
