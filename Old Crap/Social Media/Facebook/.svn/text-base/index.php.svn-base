<?php
require 'facebook.php';

$facebook = new Facebook(array(
                              'appId'  => '168192369908415',
                              'secret' => '4e565efa44f61abcf1b7a5c9cb8d8765',
                         ));

$user = $facebook->getUser();
if ($user) {
    try
    {
        $user_profile = $facebook->api('/me');
        print_r($user_profile);
    }
    catch (FacebookApiException $e)
    {
        error_log($e);
        $user = null;
    }
}

if ($user) {

    $friends = $facebook->api('/me/friends');
    //print_r($friends);

    //$temp = $facebook->api('/829022/photo');
    //print_r($temp);
    //echo "<p>Temp is $temp</p>";


    $counter = 0;
    foreach($friends['data'] as $friend)
    {
        if($counter == 0)
        {
            break;
        }
        echo "<p>".$friend['name']."</p>";
        //echo "<img src='https://graph.facebook.com/".$friend['id']."/picture'>";
        $id = $friend['id'];
        $counter++;
    }

    $logoutUrl = $facebook->getLogoutUrl();
}
else
{
    $params = array();
    $params['scope'] = "read_friendlists,publish_stream";
    $loginUrl = $facebook->getLoginUrl($params);
}

?>
<html>
<head>
    <title>Facebook Test</title>
    <style>
        body {
            font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
        }
        h1 a {
            text-decoration: none;
            color: #3b5998;
        }
        h1 a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<br/>


<?php if ($user): ?>
<img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=large">
<form action="" method="get">
    <p><? echo $status ?></p>
    <input type="hidden" name="PostFB" value="nothing">
    <input type="image" src="ShareButton.png">
</form>
<a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
<div>
    <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
</div>
    <?php endif ?>
</body>
</html>
