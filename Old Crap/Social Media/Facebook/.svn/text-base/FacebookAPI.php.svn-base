<?php
include_once 'facebook.php';

$facebook = new Facebook(array(
    'appId'  => '168192369908415',
    'secret' => '4e565efa44f61abcf1b7a5c9cb8d8765',
));
function getLoginLink()
{
    Global $facebook;
    $params = array();
    $params['scope'] = "publish_stream,email,user_relationships";
    $loginUrl = $facebook->getLoginUrl($params);
    echo $loginUrl;
}

function printOut()
{
    $test = "hello";
    echo $test;
}

function getFriendsArray()
{
    Global $facebook;
    echo "Trying to get friends";
    $fbfriends = $facebook->api('/me/friends');
    //print_r($friends);

    //$counter = 0;
    $friends = array();
    foreach($fbfriends['data'] as $friend)
    {
        /*
        if($counter == 10)
        {
            break;
        }
        */
        $user = array();
        $user['name'] =  $friend['name'];
        $user['pic'] = "https://graph.facebook.com/".$friend['id']."/picture'>";
        $friends[] = $user;
        //$counter++;
    }
    return $friends;
}

function getFBID()
{
    Global $facebook;

    $user = $facebook->getUser();
    if ($user) {
        //echo "in user";
        try
        {
            $user_profile = $facebook->api('/me');
            //echo $user_profile;
            //print_r($user_profile);
            //echo "<p>".$user_profile['id']."</p>";
            return $user_profile;
        }
        catch (FacebookApiException $e)
        {
            return "error";
            error_log($e);
            $user = null;
        }
    }
    else
    {
        echo "no user";
    }
}
?>