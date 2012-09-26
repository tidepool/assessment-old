<?php
require 'facebookAPI.php';

if (isset($_REQUEST['postFB']))
{
    try
    {
        $publishStream = $facebook->api("/me/feed", 'post', array(
                'message' => $_REQUEST['message'],
                'link'    => 'http://tidepool.co',
                'picture' => 'http://tidepool.co/images/Logo.png',
                'name'    => 'Tidepool',
                'description'=> 'Hello this is a TidePool test'
            )
        );
    }
    catch (FacebookApiException $e)
    {
        echo $e;
    }
    echo "You just shared your TidePool worktype on Facebook";
}
else
{
    echo "Share your worktype on Facebook";
}