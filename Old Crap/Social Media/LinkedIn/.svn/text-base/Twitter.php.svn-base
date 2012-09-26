<?php

function oauth_session_exists()
{
    if((is_array($_SESSION)) && (array_key_exists('oauth', $_SESSION)))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

try {
    // include the LinkedIn class
    require_once('linkedin_3.1.1.class.php');

    // start the session
    if(!session_start())
    {
        throw new LinkedInException('This script requires session support, which appears to be disabled according to session_start().');
    }

    // display constants
    $API_CONFIG = array(
        'appKey'       => 'bwgphvx02ln2',
        'appSecret'    => 'UAdvY5ASFasYsFnB',
        'callbackUrl'  => 'http://tidepool.co/LinkedIn/demo.php'
    );
    define('CONNECTION_COUNT', -1);
    define('PORT_HTTP', '80');
    define('PORT_HTTP_SSL', '443');
    define('UPDATE_COUNT', 10);

    // set index
    $_REQUEST[LINKEDIN::_GET_TYPE] = (isset($_REQUEST[LINKEDIN::_GET_TYPE])) ? $_REQUEST[LINKEDIN::_GET_TYPE] : '';
    switch($_REQUEST[LINKEDIN::_GET_TYPE])
    {
        case 'initiate':
            /**
             * Handle user initiated LinkedIn connection, create the LinkedIn object.
             */

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
                if($response['success'] === TRUE)
                {
                    // store the request token
                    $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];

                    // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
                    header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
                }
                else
                {
                    // bad token request
                    echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
                }
            }
            else
            {
                // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
                $response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
                if($response['success'] === TRUE)
                {
                    // the request went through without an error, gather user's 'access' tokens
                    $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];

                    // set the user as authorized for future quick reference
                    $_SESSION['oauth']['linkedin']['authorized'] = TRUE;

                    // redirect the user back to the demo page
                    header('Location: ' . $_SERVER['PHP_SELF']);
                }
                else
                {
                    // bad token access
                    echo "Access token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
                }
            }
            break;
        default:
            // nothing being passed back, display demo page

            // check PHP version
            if(version_compare(PHP_VERSION, '5.0.0', '<'))
            {
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
            ?>


            <?php
                                        if($_SESSION['oauth']['linkedin']['authorized'] === TRUE)
            {
                // user is already connected
                $OBJ_linkedin = new LinkedIn($API_CONFIG);
                $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
                ?>

            <?php
                            //$response = $OBJ_linkedin->connections('~/connections:(id,first-name,last-name,picture-url)?start=0&count=' . CONNECTION_COUNT);
                $response = $OBJ_linkedin->connections('~/connections:(id,first-name,last-name,picture-url,industry)?');
                if($response['success'] === TRUE)
                {
                    $connections = new SimpleXMLElement($response['linkedin']);
                    if((int)$connections['total'] > 0)
                    {
                        $xmlString = "<users>";
                        foreach($connections->person as $connection)
                        {

                            $user = "<user>";
                            $id = $connection->{'id'};
                            //echo "ID: $id";
                            $user .= "<name>".$connection->{'first-name'}." ".$connection->{'last-name'}."</name>";
                            $user .= "<pic>".$connection->{'picture-url'}."</pic>";
                            $user .= "<job>".$connection->{'industry'}."</job>";
                            $user .= "</user>";
                            //echo "job: ".$connection->{'industry'};
                            $xmlString .= $user;
                        }
                        $xmlString .= "</users>";
                        //print_r($xmlString);
                    }
                    else
                    {
                        // no connections
                        echo '<div>You do not have any LinkedIn connections to display.</div>';
                    }

                    ?>
            <html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Clouds</title>
    <script language="JavaScript">
        function sendToJavaScript(value) {
            document.body.innerHTML += '<form id="form" action="../<? echo $target ?>.php" method="post"><input type="hidden" name="ID" value="<? echo $ID?>"/><input type="hidden" name="password" value="d3mo"/>';
            //alert(value);
            document.getElementById("form").submit();
        }

        function getValues(value) {
            //alert("first call!");
            var flash = getFlashMovieObject("Twitter");
            flash.recieveValues(<? echo "'$xmlString'";?>);

            //alert("test worked again!");
        }

        function getFlashMovieObject(n) {
            if (window.document[n]) return window.document[n];

            if (navigator.appName.indexOf("Microsoft Internet") == -1) {
                if (document.embeds && document.embeds[n])
                    return document.embeds[n];
            }
            else return document.getElementById(n);
        }
    </script>
</head>
<body onload="pageInit();">
                <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                        id="Twitter" width="100%" height="100%"
                        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
                    <param name="movie" value="Twitter.swf" />
                    <param name="quality" value="high" />
                    <param name="bgcolor" value="#869ca7" />
                    <param name="SCALE" value="exactfit">
                    <param name="allowScriptAccess" value="sameDomain" />
                    <embed src="Twitter.swf" quality="high"
                           width="100%" height="100%" SCALE="exactfit" name="Twitter" align="middle"
                           play="true" loop="false" quality="high" allowScriptAccess="sameDomain"
                           type="application/x-shockwave-flash"
                           pluginspage="http://www.macromedia.com/go/getflashplayer">
                    </embed>
                </object>
                    <?
                }
                else
                {
                    // connections retrieval failed
                    echo "Error retrieving connections:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";
                }
            }
            else
            {
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
}
catch(LinkedInException $e)
{
    // exception raised by library call
    echo $e->getMessage();
}

?>