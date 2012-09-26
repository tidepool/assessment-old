<?php

require 'tmhOAuth.php';
require 'tmhUtilities.php';
include 'tweet.php';
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

// reset request?
if ( isset($_REQUEST['wipe']))
{
    session_destroy();
    header("Location: {$here}");
    // already got some credentials stored?
}
?>
<html>
<head />
<body style="background-color: #EEEEEE">
<title>Twitter</title>

<div>

    <?
    if($loggedIn)
    {
        ?>
        <p><a href="?wipe=1">Log Out</a></p>
        <form action="" method="get">
            <input type="hidden" name="tweet" value="nothing">
            <br>
            <input type="submit" value="Logout of Twitter">
            <!--
            <a style="text-decoration:none" href="javascript:Tweet()">
                <img style="padding: 10px;" src="Tweet.png">
            </a>
            -->
        </form>
        <?
    }
    ?>
</div>
</body>
</html>