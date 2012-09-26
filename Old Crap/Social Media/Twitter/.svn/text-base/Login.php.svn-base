<?php

require 'tmhOAuth.php';
require 'tmhUtilities.php';
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
        $loggedIn = true;
        $resp = json_decode($tmhOAuth->response['response']);
        $counter = 0;
        foreach($resp as $r)
        {
            if($counter == 12)
            {
                $ID = $r;
                break;
            }
            $counter++;
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
    $tmhOAuth->config['user_token']  = $_SESSION['oauth']['oauth_token'];
    $tmhOAuth->config['user_secret'] = $_SESSION['oauth']['oauth_token_secret'];

    $code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/access_token', ''), array('oauth_verifier' => $_REQUEST['oauth_verifier']));

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

    $code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/request_token', ''), $params);

    if ($code == 200)
    {
        $_SESSION['oauth'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
        $method = 'authorize';
        $force  = '&force_login=1';
        $authurl = $tmhOAuth->url("oauth/{$method}", '') .  "?oauth_token={$_SESSION['oauth']['oauth_token']}{$force}";
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
</head>
<body style="background-color: #EEEEEE">
<title>Twitter</title>
<div>
    <? if($loggedIn): ?>
    <script language="JavaScript">
        document.body.innerHTML += '<form id="form" action="http://tidepool.co/Delta/Loading/Loading.php" method="post"><input type="hidden" name="ID" value="<? echo $ID ?>"/><input type="hidden" name="type" value="<? echo $type ?>"/><input type="hidden" name="password" value="d3mo"/>';
        document.getElementById("form").submit();
    </script>
    <? endif ?>
</div>
</body>
</html>