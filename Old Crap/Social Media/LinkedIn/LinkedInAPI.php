<?php
require_once('linkedin_3.1.1.class.php');

function oauth_session_exists() {
    if((is_array($_SESSION)) && (array_key_exists('oauth', $_SESSION))) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function LoginToLI()
{
    try {
        // include the LinkedIn class

        // start the session
        if(!session_start()) {
            throw new LinkedInException('This script requires session support, which appears to be disabled according to session_start().');
        }

        // display constants
        $API_CONFIG = array(
            'appKey'       => 'bwgphvx02ln2',
            'appSecret'    => 'UAdvY5ASFasYsFnB',
            'callbackUrl'  => 'http://tidepool.co/LinkedIn/demo.php'
        );
        define('CONNECTION_COUNT', 20);
        define('PORT_HTTP', '80');
        define('PORT_HTTP_SSL', '443');
        define('UPDATE_COUNT', 10);

        if($_SERVER['HTTPS'] == 'on') {
            $protocol = 'https';
        } else {
            $protocol = 'http';
        }

        $API_CONFIG['callbackUrl'] = $protocol . '://' . $_SERVER['SERVER_NAME'] . ((($_SERVER['SERVER_PORT'] != PORT_HTTP) || ($_SERVER['SERVER_PORT'] != PORT_HTTP_SSL)) ? ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'] . '?' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';
        $OBJ_linkedin = new LinkedIn($API_CONFIG);

        // check for response from LinkedIn
        $_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? $_GET[LINKEDIN::_GET_RESPONSE] : '';
        if(!$_GET[LINKEDIN::_GET_RESPONSE]) {
            // LinkedIn hasn't sent us a response, the user is initiating the connection

            // send a request for a LinkedIn access token
            $response = $OBJ_linkedin->retrieveTokenRequest();
            if($response['success'] === TRUE) {
                // store the request token
                $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];

                // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
                header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
            } else {
                // bad token request
                echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
            }
        } else {
            // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
            $response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
            if($response['success'] === TRUE) {
                // the request went through without an error, gather user's 'access' tokens
                $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];

                // set the user as authorized for future quick reference
                $_SESSION['oauth']['linkedin']['authorized'] = TRUE;

                // redirect the user back to the demo page
                header('Location: ' . $_SERVER['PHP_SELF']);
            } else {
                // bad token access
                echo "Access token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
            }
        }
    } catch(LinkedInException $e) {
        // exception raised by library call
        echo $e->getMessage();
    }
}

function continueLoggginIn()
{
    echo "in logged in";
    try {
        // include the LinkedIn class
        require_once('linkedin_3.1.1.class.php');

        // start the session
        if(!session_start()) {
            throw new LinkedInException('This script requires session support, which appears to be disabled according to session_start().');
        }

        // display constants
        $API_CONFIG = array(
            'appKey'       => 'bwgphvx02ln2',
            'appSecret'    => 'UAdvY5ASFasYsFnB',
            'callbackUrl'  => 'http://tidepool.co/LinkedIn/demo.php'
        );
        define('CONNECTION_COUNT', 20);
        define('PORT_HTTP', '80');
        define('PORT_HTTP_SSL', '443');
        define('UPDATE_COUNT', 10);

        // set index
        $_REQUEST[LINKEDIN::_GET_TYPE] = (isset($_REQUEST[LINKEDIN::_GET_TYPE])) ? $_REQUEST[LINKEDIN::_GET_TYPE] : '';
        switch($_REQUEST[LINKEDIN::_GET_TYPE]) {
            case 'initiate':


                // check for the correct http protocol (i.e. is this script being served via http or https)
                if($_SERVER['HTTPS'] == 'on') {
                    $protocol = 'https';
                } else {
                    $protocol = 'http';
                }

                // set the callback url
                $API_CONFIG['callbackUrl'] = $protocol . '://' . $_SERVER['SERVER_NAME'] . ((($_SERVER['SERVER_PORT'] != PORT_HTTP) || ($_SERVER['SERVER_PORT'] != PORT_HTTP_SSL)) ? ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'] . '?' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';
                $OBJ_linkedin = new LinkedIn($API_CONFIG);

                // check for response from LinkedIn
                $_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? $_GET[LINKEDIN::_GET_RESPONSE] : '';
                if(!$_GET[LINKEDIN::_GET_RESPONSE]) {
                    // LinkedIn hasn't sent us a response, the user is initiating the connection

                    // send a request for a LinkedIn access token
                    $response = $OBJ_linkedin->retrieveTokenRequest();
                    if($response['success'] === TRUE) {
                        // store the request token
                        $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];

                        // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
                        header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
                    } else {
                        // bad token request
                        echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
                    }
                } else {
                    // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
                    $response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
                    if($response['success'] === TRUE) {
                        // the request went through without an error, gather user's 'access' tokens
                        $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];

                        // set the user as authorized for future quick reference
                        $_SESSION['oauth']['linkedin']['authorized'] = TRUE;

                        // redirect the user back to the demo page
                        header('Location: ' . $_SERVER['PHP_SELF']);
                    } else {
                        // bad token access
                        echo "Access token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
                    }
                }
                break;

            case 'revoke':

                // check the session
                if(!oauth_session_exists()) {
                    throw new LinkedInException('This script requires session support, which doesn\'t appear to be working correctly.');
                }

                $OBJ_linkedin = new LinkedIn($API_CONFIG);
                $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
                $response = $OBJ_linkedin->revoke();
                if($response['success'] === TRUE) {
                    // revocation successful, clear session
                    session_unset();
                    $_SESSION = array();
                    if(session_destroy()) {
                        // session destroyed
                        header('Location: ' . $_SERVER['PHP_SELF']);
                    } else {
                        // session not destroyed
                        echo "Error clearing user's session";
                    }
                } else {
                    // revocation failed
                    echo "Error revoking user's token:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
                }
                break;
            default:
                // nothing being passed back, display demo page

                // check PHP version
                if(version_compare(PHP_VERSION, '5.0.0', '<')) {
                    throw new LinkedInException('You must be running version 5.x or greater of PHP to use this library.');
                }

                // check for cURL
                if(extension_loaded('curl')) {
                    $curl_version = curl_version();
                    $curl_version = $curl_version['version'];
                } else {
                    throw new LinkedInException('You must load the cURL extension to use this library.');
                }
                ?>
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
                <head>
                    <title>Foxtrot-LinkedIn Demo</title>
                    <style>
                        body {font-family: Courier, monospace; font-size: 0.8em;}
                        pre {font-family: Courier, monospace; font-size: 0.8em;}
                    </style>
                </head>
                <body>

                    <?php
                                                                              $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
                if($_SESSION['oauth']['linkedin']['authorized'] === TRUE) {
                    ?>
                <ul>
                    <li><a href="demo/network.php#network_connections">Your Connections</a></li>
                </ul>
                    <?php
                                                                              } else {
                    ?>
                <ul>
                    <li><a href="#manage">Manage LinkedIn Authorization</a></li>
                </ul>
                    <?php
                                                                              }
                ?>

                <hr />

                <h2 id="manage">Manage LinkedIn Authorization:</h2>
                    <?php
                                                                              if($_SESSION['oauth']['linkedin']['authorized'] === TRUE) {
                    // user is already connected
                    $OBJ_linkedin = new LinkedIn($API_CONFIG);
                    $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
                    ?>
                <form id="linkedin_revoke_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
                    <input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="revoke" />
                    <input type="submit" value="Revoke Authorization" />
                </form>

                <hr />

                <h2 id="application">Application Information:</h2>

                <ul>
                    <li>Application Key:
                        <ul>
                            <li><?php echo $OBJ_linkedin->getApplicationKey();?></li>
                        </ul>
                    </li>
                </ul>

                <hr />

                <h2 id="profile">Your Profile:</h2>

                    <?php
                                                                                $response = $OBJ_linkedin->profile('~:(id,first-name,last-name,picture-url)');
                    if($response['success'] === TRUE) {
                        $response['linkedin'] = new SimpleXMLElement($response['linkedin']);
                        echo "<pre>" . print_r($response['linkedin'], TRUE) . "</pre>";
                    } else {
                        // profile retrieval failed
                        echo "Error retrieving profile information:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";
                    }
                } else {
                    // user isn't connected
                    ?>
                <form id="linkedin_connect_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
                    <input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="initiate" />
                    <input type="submit" value="Connect to LinkedIn" />
                </form>
                    <?php
                                                                              }
                ?>
                </body>
                </html>
                    <?php
                                                                          break;
        }
    } catch(LinkedInException $e) {
        // exception raised by library call
        echo $e->getMessage();
    }

}


function getPicURL()
{
    //echo "in logged in";
    try {
        if(!session_start()) {
            throw new LinkedInException('This script requires session support, which appears to be disabled according to session_start().');
        }

        // display constants
        $API_CONFIG = array(
            'appKey'       => 'bwgphvx02ln2',
            'appSecret'    => 'UAdvY5ASFasYsFnB',
            'callbackUrl'  => 'http://tidepool.co/LinkedIn/demo.php'
        );
        define('CONNECTION_COUNT', 20);
        define('PORT_HTTP', '80');
        define('PORT_HTTP_SSL', '443');
        define('UPDATE_COUNT', 10);


        // check PHP version
        if(version_compare(PHP_VERSION, '5.0.0', '<')) {
            throw new LinkedInException('You must be running version 5.x or greater of PHP to use this library.');
        }

        // check for cURL
        if(extension_loaded('curl'))
        {
            $curl_version = curl_version();
            $curl_version = $curl_version['version'];
        }
        else
        {
            throw new LinkedInException('You must load the cURL extension to use this library.');
        }
        $OBJ_linkedin = new LinkedIn($API_CONFIG);
        $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
        $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
        if($_SESSION['oauth']['linkedin']['authorized'] === TRUE)
        {
            //echo "authorized";
            //echo "Responded true1";
            $response = $OBJ_linkedin->profile('~:(id,first-name,last-name,picture-url)');
            if($response['success'] === TRUE)
            {
                //echo "Responded true2";

                //echo "success";
                $response['linkedin'] = new SimpleXMLElement($response['linkedin']);
                $temp = $response['linkedin']->{'picture-url'};
                //echo $temp;
                return $temp;
            }
            else
            {
                // profile retrieval failed
                echo "Error retrieving profile information:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";
            }
        }
        else
        {
            echo "not authorized";
        }
    }
    catch(LinkedInException $e)
    {
        // exception raised by library call
        echo $e->getMessage();
    }
}


function getLIID()
{
    //echo "in logged in";
    try {
        if(!session_start()) {
            throw new LinkedInException('This script requires session support, which appears to be disabled according to session_start().');
        }

        // display constants
        $API_CONFIG = array(
            'appKey'       => 'bwgphvx02ln2',
            'appSecret'    => 'UAdvY5ASFasYsFnB',
            'callbackUrl'  => 'http://tidepool.co/LinkedIn/demo.php'
        );
        define('CONNECTION_COUNT', 20);
        define('PORT_HTTP', '80');
        define('PORT_HTTP_SSL', '443');
        define('UPDATE_COUNT', 10);


        // check PHP version
        if(version_compare(PHP_VERSION, '5.0.0', '<')) {
            throw new LinkedInException('You must be running version 5.x or greater of PHP to use this library.');
        }

        // check for cURL
        if(extension_loaded('curl'))
        {
            $curl_version = curl_version();
            $curl_version = $curl_version['version'];
        }
        else
        {
            throw new LinkedInException('You must load the cURL extension to use this library.');
        }
        $OBJ_linkedin = new LinkedIn($API_CONFIG);
        $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
        $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
        if($_SESSION['oauth']['linkedin']['authorized'] === TRUE)
        {
            //echo "Responded true1";
            $response = $OBJ_linkedin->profile('~:(id,first-name,last-name,picture-url)');
            if($response['success'] === TRUE)
            {
                //echo "Responded true2";
                $response['linkedin'] = new SimpleXMLElement($response['linkedin']);
                $user = array();
                //print_r($response['linkedin']);
                $user['name'] = $response['linkedin']->{'first-name'}." ".$response['linkedin']->{'last-name'};
                $user['id'] = $response['linkedin']->{'id'};
                return $user;
                //echo "<p>". $user['name']."</p>";
            }
            else
            {
                // profile retrieval failed
                echo "Error retrieving profile information:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";
            }
        }
    }
    catch(LinkedInException $e)
    {
        // exception raised by library call
        echo $e->getMessage();
    }
}


function getLIFriends()
{
    //echo "in logged in";
    try {
        if(!session_start()) {
            throw new LinkedInException('This script requires session support, which appears to be disabled according to session_start().');
        }

        // display constants
        $API_CONFIG = array(
            'appKey'       => 'bwgphvx02ln2',
            'appSecret'    => 'UAdvY5ASFasYsFnB',
            'callbackUrl'  => 'http://tidepool.co/LinkedIn/demo.php'
        );
        define('CONNECTION_COUNT', 20);
        define('PORT_HTTP', '80');
        define('PORT_HTTP_SSL', '443');
        define('UPDATE_COUNT', 10);


        // check PHP version
        if(version_compare(PHP_VERSION, '5.0.0', '<')) {
            throw new LinkedInException('You must be running version 5.x or greater of PHP to use this library.');
        }

        // check for cURL
        if(extension_loaded('curl'))
        {
            $curl_version = curl_version();
            $curl_version = $curl_version['version'];
        }
        else
        {
            throw new LinkedInException('You must load the cURL extension to use this library.');
        }
        $OBJ_linkedin = new LinkedIn($API_CONFIG);
        $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
        $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
        if($_SESSION['oauth']['linkedin']['authorized'] === TRUE)
        {
            $OBJ_linkedin = new LinkedIn($API_CONFIG);
            $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
            $response = $OBJ_linkedin->connections('~/connections:(id,first-name,last-name,picture-url,industry)?');
            if($response['success'] === TRUE)
            {
                $connections = new SimpleXMLElement($response['linkedin']);
                $friends = array();
                if((int)$connections['total'] > 0)
                {
                    foreach($connections->person as $connection)
                    {

                        $user = array();
                        $user['name'] = $connection->{'first-name'}." ".$connection->{'last-name'};
                        $user['pic'] = "".$connection->{'picture-url'}."";
                        $friends[] = $user;
                    }
                    //print_r($friends);
                }
                else
                {
                    // no connections
                    echo '<div>You do not have any LinkedIn connections to display.</div>';
                }
                return $friends;
            }
        }
    }
    catch(LinkedInException $e)
    {
        // exception raised by library call
        echo $e->getMessage();
    }
}
?>