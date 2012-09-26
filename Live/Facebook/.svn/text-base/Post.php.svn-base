<?php
$workType = $_COOKIE['WTname'];
$name = $_REQUEST['name'];
$msg = $_POST['msg'];
require_once 'FacebookAPI.php';
getFBUser();
try
{
    $publishStream = $facebook->api("/me/feed", 'post', array(
            'message' => $msg,
            'link'    => 'http://tidepool.co',
            'picture' => 'http://tidepool.co/Live/images/Badges/'.$workType.'.png',
            'name'    => 'Assess, Share and Compare',
            'description'=> 'I took TidePool\'s assessment and got my WorkType. I am '.$workType.', what\'s yours?'
        )
    );
}
catch (FacebookApiException $e)
{
    echo "<h1>Error</h1>";
    echo $e;
}
echo "<h1>You just shared your TidePool worktype on Facebook</h1>";

?>