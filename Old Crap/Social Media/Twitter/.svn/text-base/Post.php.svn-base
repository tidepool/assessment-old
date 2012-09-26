<?php

require 'tmhOAuth.php';
require 'tmhUtilities.php';
//include 'tweet.php';
$key = "O6awZZlenHGV7lqycMSQA";
$sec = "Lk7YA1NpY7xPxdECqao3TlXFeclhXylqmHZBn6llPpc";
$tmhOAuth = new tmhOAuth(array('consumer_key'    => $key,'consumer_secret' => $sec,));

$here = tmhUtilities::php_self();
session_start();
$loggedIn = false;
$link;
function outputError($tmhOAuth)
{
    echo 'Error: ' . $tmhOAuth->response['response'] . PHP_EOL;
    tmhUtilities::pr($tmhOAuth);
}

if (isset($_SESSION['access_token']))
{
    $tok  = $_SESSION['access_token']['oauth_token'];
    $sec = $_SESSION['access_token']['oauth_token_secret'];
    $tmhOAuth->config['user_token']  = $tok;
    $tmhOAuth->config['user_secret'] = $sec;

    $code = $tmhOAuth->request('GET', $tmhOAuth->url('1/account/verify_credentials'));
    if ($code == 200)
    {
        $resp = json_decode($tmhOAuth->response['response']);
        $name = $resp->screen_name;
        $loggedIn = true;
        //TweetThis("This is my tweet",$tok,$sec);
        if (isset($_REQUEST['tweet']))
        {
            $msg = $_REQUEST['message'];


            $code = $tmhOAuth->request('POST', $tmhOAuth->url('1/statuses/update'), array('status' => $msg));

            if ($code == 200)
            {
                $message = "You shared your tweet on Twitter";
            }
            else
            {
                $message = "Sorry there was an error please try again later";
            }
            //TweetThis($msg,$tok,$sec);
        }
        else
        {
            $message = "Please enter what you would like to tweet";
        }
    }
    else
    {
        outputError($tmhOAuth);
    }
    // we're being called back by Twitter
}
elseif (isset($_REQUEST['oauth_verifier']))
{
    echo "<h1>Worktype: ".$_REQUEST['worktype']."</h1>";
    echo "<h1>Verifier: ".$_REQUEST['oauth_verifier']."</h1>";
    $tmhOAuth->config['user_token']  = $_SESSION['oauth']['oauth_token'];
    $tmhOAuth->config['user_secret'] = $_SESSION['oauth']['oauth_token_secret'];

    $code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/access_token', ''), array('oauth_verifier' => $_REQUEST['oauth_verifier'],'worktype' => $_REQUEST['worktype']));

    if ($code == 200)
    {
        $_SESSION['access_token'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
        unset($_SESSION['oauth']);
        header("Location: {$here}");
    }
    else
    {
        outputError($tmhOAuth);
    }
    // start the OAuth dance
}
else
{
    $loggedIn = false;
    $params = array('oauth_callback' => $here);

    if (isset($_REQUEST['force_write'])) :
        $params['x_auth_access_type'] = 'write';
    elseif (isset($_REQUEST['force_read'])) :
        $params['x_auth_access_type'] = 'read';
    endif;
    $params['worktype'] = $_REQUEST['worktype'];
    $code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/request_token', ''), $params);

    if ($code == 200)
    {
        $_SESSION['oauth'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
        $method = 'authorize';
        $force  = '&force_login=1';
        $authurl = $tmhOAuth->url("oauth/{$method}", '') .  "?worktype=".$_REQUEST['worktype']."&oauth_token={$_SESSION['oauth']['oauth_token']}{$force}";
        //echo '<p>To complete the OAuth flow follow this URL: <a href="'. $authurl . '">' . $authurl . '</a></p>';
        ?>
    <a style="text-decoration:none" href="<? echo $authurl ?>">
        <img name="image1" width="146" height="35" border="0" src="TwitterLogin.png">
    </a>
    <?
    }
    else
    {
        outputError($tmhOAuth);
    }
}
?>

<html>
<head>
    <script language="JavaScript">
        function Tweet() {
            alert("tweeted");
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
<title>Twitter</title>

<div>

    <?
    if($loggedIn)
    {

        $msg = "I just got my worktype '".$_COOKIE['WTName']."' from TidePool, find out if we can work together at tidepool.co";

        ?>
        <div align="center">
            <form action="" method="get">
                <h1><? echo $name ?></h1>
                <p><? echo $message; ?></p>
                <input type="hidden" name="tweet" value="nothing">
                <input type="text" name="message" maxlength="140" value="<? echo $msg; ?>" style="width: 500px;">
                <br>
                <input type="image" src="Tweet.png" style="padding: 10px;">
            </form>
        </div>
        <?
    }
    ?>
</div>
</body>
</html>