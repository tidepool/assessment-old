<?php
//////session_start();
include_once "../Live/dbConnect.php";
$memcache = getMemcache();

$config['base_url']             =   'https://stage.tidepool.co/linktest/auth.php';
$config['callback_url']         =   'https://stage.tidepool.co/linktest/demo.php';
$config['linkedin_access']      =   'bwgphvx02ln2';
$config['linkedin_secret']      =   'UAdvY5ASFasYsFnB';

include_once "linkedin.php";

# First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
$linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['callback_url'] );
//$linkedin->debug = true;

# Now we retrieve a request token. It will be set as $linkedin->request_token
$linkedin->getRequestToken();
echo "<p>request token ".$linkedin->request_token."</p>";
//////$_SESSION['requestToken'] = serialize($linkedin->request_token);
$memcache->set('requestToken', serialize($linkedin->request_token), false, 7200) or die ("Failed to save data at the server");

# With a request token in hand, we can generate an authorization URL, which we'll direct the user to
//echo "Authorization URL: " . $linkedin->generateAuthorizeUrl() . "\n\n";
header("Location: " . $linkedin->generateAuthorizeUrl());
?>
