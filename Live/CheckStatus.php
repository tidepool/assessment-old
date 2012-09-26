<?php
function CheckStatus()
{
    if($_COOKIE['logged'] == 'Verify')// make sure the user is properly logged on
    {
        goToVerify();
    }
    else if(strlen($_COOKIE['logged']) < 3)// session expired force sign in again. Logs out after 2 hours
    {
        redirect();
    }
    else
    {
        if(!$_SERVER['HTTPS'])
        {
            $loc = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            header('Location: '.$loc);
        }
        else
        {
            return true;
        }
    }
}


function goToVerify()
{
    header('Location: waitingForVerification.php');
}

function redirect()
{
    header('Location: splash.php?expired=true');
}
?>