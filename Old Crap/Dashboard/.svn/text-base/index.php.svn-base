<?php

if($_REQUEST['password'] == "d3moD@sh")
{
    setcookie("login", "dashydashy", time()+3600,"/", ".tidepool.co"); /* Expires in an hour */

    ?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body onload="pageInit();">  <script language="JavaScript">
    document.body.innerHTML += '<form id="form" action="WTO.php" method="post">';
    //alert(value);
    document.getElementById("form").submit();
</script>
</body>
</html>
<?
}
else
{
    if($_REQUEST['option'] == "logout")
    {

        setcookie("login", "", time()-3600,"/", ".tidepool.co"); /* Expires in an hour */
    }
    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="images/logoHalf.png" type="image/png">
    <title>Tidepool</title>
    <style type="text/css">
        input {

            text-align:center;
            color:#000;
            font-size:16px;
            padding: 5px;
            width: 200px;
        }
        body
        {
            background-color: #EEEEEE;
        }
    </style>
</head>

<body align="center">
<div class="main" align="center">
    <div class="form" align="center">
        <img src="images/logo.png" width="250" height="125" style="padding:20px;"/>
        <div style="font-size:16px;" align="center">
            <form action="" method="post">
                <?
                if(isset($_REQUEST['password']))
                {
                    echo "<p>Your Beta Key Was Invalid</p>";
                }
                else
                {

                    echo "<p>Please Enter Beta Key</p>";
                }
                ?>
                <p><input class="input" name="password" type="password" value="Password" /></p>
                <p><input name="submit" type="submit" value="Log In" /></p>
            </form>
        </div>
    </div>
</div>
</body >
</html>
<?
}
?>