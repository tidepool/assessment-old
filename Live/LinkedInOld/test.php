<?php
/*
$oauth->setToken($request_token['oauth_token'], $request_token['oauth_token_secret']);

$access_token_url = 'https://api.linkedin.com/uas/oauth/accessToken';
$access_token_response = $oauth->getAccessToken($access_token_url, "", $oauth_verifier);

if($access_token_response === FALSE) {
        throw new Exception("Failed fetching request token, response was: " . $oauth->getLastResponse());
} else {
        $access_token = $access_token_response;
}

print "Access Token:\n";
printf("    - oauth_token        = %s\n", $access_token['oauth_token']);
printf("    - oauth_token_secret = %s\n", $access_token['oauth_token_secret']);
print "\n";
print "You may now access protected resources using the access tokens above.\n";
print "\n";

*/
include "oAuth.php";
define("CONSUMER_KEY", "bwgphvx02ln2");
define("CONSUMER_SECRET", "UAdvY5ASFasYsFnB");
 
$oauth = new OAuth(CONSUMER_KEY, CONSUMER_SECRET);


$request_token_response = $oauth->getRequestToken('https://api.linkedin.com/uas/oauth/requestToken');

if($request_token_response === FALSE) {
        throw new Exception("Failed fetching request token, response was: " . $oauth->getLastResponse());
} else {
        $request_token = $request_token_response;
}

print "Request Token:\n";
printf("    - oauth_token        = %s\n", $request_token['oauth_token']);
printf("    - oauth_token_secret = %s\n", $request_token['oauth_token_secret']);
print "\n";