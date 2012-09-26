<?
require_once('linkedin_3.2.0.class.php');
include_once "../dbConnect.php";

$API_CONFIG = array(
    'appKey'       => 'bwgphvx02ln2',
    'appSecret'    => 'UAdvY5ASFasYsFnB',
    'callbackUrl'  => NULL
);
$memcache = getMemcache();
function oauth_session_exists() {
    global $memcache;
    $result = $memcache->get('oauth');
    echo "<p>Linked func oauth_session_exists result: $result </p>";
    return $result;
    //if((is_array($_SESSION)) && (array_key_exists('oauth', $_SESSION))) {
    //    return TRUE;
    //} else {
    //    return FALSE;
    //}
}

function login($initiate)
{
    Global $API_CONFIG, $OBJ_linkedin,$memcache;
    try {

        // start the session
        // if(!session_start()) {
        //     throw new LinkedInException('This script requires session support, which appears to be disabled according to session_start().');
        // }

        // display constants
        $API_CONFIG = array(
            'appKey'       => 'bwgphvx02ln2',
            'appSecret'    => 'UAdvY5ASFasYsFnB',
            'callbackUrl'  => NULL
        );
        define('DEMO_GROUP', '4010474');
        define('DEMO_GROUP_NAME', 'Simple LI Demo');
        define('PORT_HTTP', '80');
        define('PORT_HTTP_SSL', '443');
        // set index
        echo "<p>starting log in progress</p>";
        $_REQUEST[LINKEDIN::_GET_TYPE] = (isset($_REQUEST[LINKEDIN::_GET_TYPE])) ? $_REQUEST[LINKEDIN::_GET_TYPE] : '';
        echo "<p>request type ".$_REQUEST[LINKEDIN::_GET_TYPE]."</p>";
        if($initiate)
        {
            //echo "<p>memcache $memcache</p>";
            print_r($memcache);
            $request = $memcache->get('request');
            echo "<p>Linked func2 login result: $request </p>";
            print_r($request);
            $switch =  'initiadte';
        }
        else
        {
            $switch =  $_REQUEST[LINKEDIN::_GET_TYPE];
        }
        switch($switch) {
            case 'initiate':
                /**
                 * Handle user initiated LinkedIn connection, create the LinkedIn object.
                 */

                echo "<p>trying to initiate linkedin 2</p>";
                //$memcache = getMemcache();
                // check for the correct http protocol (i.e. is this script being served via http or https)
                if($_SERVER['HTTPS'] == 'on') {
                    $protocol = 'https';
                } else {
                    $protocol = 'http';
                }

                // set the callback url
                echo "<p>crreating new linkedin</p>";
                $API_CONFIG['callbackUrl'] = $protocol . '://' . $_SERVER['SERVER_NAME'] . ((($_SERVER['SERVER_PORT'] != PORT_HTTP) || ($_SERVER['SERVER_PORT'] != PORT_HTTP_SSL)) ? ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'] . '?' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';
                $OBJ_linkedin = new LinkedIn($API_CONFIG);

                // check for response from LinkedIn
                $_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? $_GET[LINKEDIN::_GET_RESPONSE] : '';
                if(!$_GET[LINKEDIN::_GET_RESPONSE]) {
                    // LinkedIn hasn't sent us a response, the user is initiating the connection

                    // send a request for a LinkedIn access token
                    $response = $OBJ_linkedin->retrieveTokenRequest();
                    if($response['success'] === TRUE) {
                        echo "<p>response true</p>";
                        // store the request token
                        $memcache->set('request', $response['linkedin'], false, 7200) or die ("Failed to save data at the server");
                        $var = $memcache->get('request');
                        echo "<p>Linked func1 login result: $var </p>";
                        //$_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];

                        // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
                        header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
                    } else {
                        // bad token request
                        echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
                    }
                } else {
                    echo "<p>response false get oauth</p>";
                    $request = $memcache->get('request');
                    echo "<p>Linked func2 login result: $request </p>";
                    print_r($request);
                    $oauth_token = $request['oauth_token'];
                    $oauth_token_secret = $request['oauth_token_secret'];
                    echo "<p>token: func oauth_token_secret $oauth_token_secret</p>";
                    // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
                    $response = $OBJ_linkedin->retrieveTokenAccess($oauth_token, $oauth_token_secret, $_GET['oauth_verifier']);
                    //$response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
                    if($response['success'] === TRUE) {
                        // the request went through without an error, gather user's 'access' tokens

                        echo "<p>oauth response true</p>";
                        $memcache->set('access', $response['linkedin'], false, 7200) or die ("Failed to save data at the server");
                        //$_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];

                        // set the user as authorized for future quick reference
                        $memcache->set('authorized', true, false, 7200) or die ("Failed to save data at the server");
                        //$_SESSION['oauth']['linkedin']['authorized'] = TRUE;

                        // redirect the user back to the demo page
                        header('Location: ' . $_SERVER['PHP_SELF']);
                    } else {
                        // bad token access
                        echo "<p>oauth response fail</p>";
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
                $access = $memcache->get('access');
                echo "<p>token: func revoke $access</p>";
                $OBJ_linkedin->setTokenAccess($access);
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
                echo "<p>couldnt find revoke or initiate for login</p>";
                return true;
        }
    } catch(LinkedInException $e) {
        // exception raised by library call
        echo $e->getMessage();
    }
}

function checkForLILogin()
{
    Global $API_CONFIG, $OBJ_linkedin, $memcache;
    $authorized = $memcache->get('authorized');
    echo "<p>token: func checkForLILogin $authorized</p>";
    print_r($authorized);
    $access = $memcache->get('access');
    echo "<p>token: func checkForLILogin $access</p>";
    print_r($access);
    echo "<p>checkForLILogin try to log in/p>";
    //login();
    $authorized = ($authorized) ? $authorized : FALSE;
    $memcache->set('authorized', $authorized, false, 7200) or die ("Failed to save data at the server");
    if($authorized === TRUE) {
        echo "<p>new li</p>";
        $OBJ_linkedin = new LinkedIn($API_CONFIG);
        $OBJ_linkedin->setTokenAccess($access);
        $OBJ_linkedin->setResponseFormat(LINKEDIN::_RESPONSE_XML);
        login(true);

    }
    if($authorized === TRUE)
    {
        return true;
    }
    else
    {
        return false;
    }
    /*
    $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
    if($_SESSION['oauth']['linkedin']['authorized'] === TRUE) {
        $OBJ_linkedin = new LinkedIn($API_CONFIG);
        $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
        $OBJ_linkedin->setResponseFormat(LINKEDIN::_RESPONSE_XML);

    }

    if($_SESSION['oauth']['linkedin']['authorized'] === TRUE)
    {
        return true;
    }
    else
    {
        return false;
    }
    */

}
function signOutLI()
{
    Global $OBJ_linkedin, $memcache;
    //echo "<p>Logout</p>";
    $memcache->flush();
    $memcache->close();
    //$_SESSION = null;
    //session_destroy();
    setcookie("LI_ID", '', time()-7200,"/", ".tidepool.co"); /* Expires in two hours */
    //echo "<p>revoke</p>";
}

function post($msg,$link)
{
    Global $OBJ_linkedin;

    $pos = strpos($_COOKIE['name']," ");
    $name = substr($_COOKIE['name'],0,$pos);
    $workType = $_COOKIE['WTname'];
    // prepare content for sharing
    $content = array();
    $content['comment'] = $msg;
    $content['title'] = "I'm $workType. Which WorkType are you?";
    $content['submitted-url'] = "http://www.tidepool.co/Live/splash.php?linked=".$link;
    $content['submitted-image-url'] = "http://www.tidepool.co/Live/images/Badges/".$workType.".png";
    $content['description'] = "There are 60 WorkTypes and $name is $workType. Discover yours at www.TidePool.co";
    $private = true;

    // share content
    $response = $OBJ_linkedin->share('new', $content, $private);
    if($response['success'] === TRUE) {
        // status has been updated
        echo "<p>Successful post</p>";
    } else {
        // an error occured
        echo "Error sharing content:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
    }
}

function postSpecial($type,$msg,$link)
{
    Global $OBJ_linkedin;

    $pos = strpos($_COOKIE['name']," ");
    $name = substr($_COOKIE['name'],0,$pos);
    $workType = $_COOKIE['WTname'];
    // prepare content for sharing
    $content = array();
    if($type == 1)
    {
        $content['comment'] = $msg;
        $content['title'] = "I'm $workType. Which WorkType are you?";
        $content['submitted-url'] = "http://www.tidepool.co/Live/splash.php?linked=".$link;
        $content['submitted-image-url'] = "http://www.tidepool.co/Live/images/Badges/".$workType.".png";
        $content['description'] = "There are 60 WorkTypes and $name is $workType. Discover yours at www.TidePool.co";
    }
    else
    {
        $content['comment'] = $msg;
        $content['title'] = "Assess, Share and Compare";
        $content['submitted-url'] = "http://www.tidepool.co/Live/splash.php?linked=".$link;
        $content['submitted-image-url'] = "http://www.tidepool.co/Live/images/Badges/Logo.png";
        $content['description'] = "I took TidePool\"s assessment and got my WorkType. What\"s your WorkType?";
    }
    $private = true;

    // share content
    $response = $OBJ_linkedin->share('new', $content, $private);
    if($response['success'] === TRUE) {
        // status has been updated
        echo "<p>Successful post</p>";
    } else {
        // an error occured
        echo "Error sharing content:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
    }
}

function getLIFriendsArray()
{
    Global $OBJ_linkedin;

    //echo "<p>InFriends</p>";
    $friends = array();
    $response = $OBJ_linkedin->connections('~/connections:(id,first-name,last-name,picture-url)?');
    if($response['success'] === TRUE)
    {
        $connections = new SimpleXMLElement($response['linkedin']);

        if((int)$connections['total'] > 0)
        {
            foreach($connections->person as $connection)
            {
                //echo "<p>Person1 Array</p>";
                //print_r($connection);
                if($connection->{'first-name'} != "private")
                {
                    //echo "<p>Person2 Array</p>";
                    //print_r($connection);
                    $user = array();
                    $user['name'] = $connection->{'first-name'}." ".$connection->{'last-name'};
                    $user['id'] = $connection->{'id'};
                    $user['pic'] = $connection->{'picture-url'};
                    if(strlen($user['pic']) < 3)
                    {
                        $user['pic'] = "images/anonymous.png";
                    }
                    $friends[] = $user;

                    //echo "<p>User Array</p>";
                    //print_r($user);
                }
            }
        }
        else
        {
            // no connections
        }
    }
    //echo "<p>Friends Array</p>";
    //print_r($friends);
    return $friends;
}
function getLIUser()
{
    Global $API_CONFIG, $OBJ_linkedin, $userInfo;

    $OBJ_linkedin = new LinkedIn($API_CONFIG);
    global $memcache;
    $access = $memcache->get('access');
    $OBJ_linkedin->setTokenAccess($access);
    //$OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
    $response = $OBJ_linkedin->profile('~:(id,first-name,last-name,picture-url)');
    if($response['success'] === TRUE) {
        $response['linkedin'] = new SimpleXMLElement($response['linkedin']);
        //print_r($response['linkedin']);
        $userInfo = array();
        $userInfo['li_id'] = $response['linkedin']->{'id'};
        $userInfo['li_pic'] = $response['linkedin']->{'picture-url'};
        if(strlen($userInfo['pic']) < 3)
        {
            $userInfo['pic'] = "images/anonymous.png";
        }
        establishConnection();
        $sql = sprintf("SELECT Name,ID,Pic,WorkType,WorkType,FacebookID,LinkedID FROM SocialMediaUsers WHERE LinkedID='%s'",mysql_real_escape_string($userInfo['li_id']));
        $result = mysql_query($sql) or die('Query failed: ' . mysql_error());
        mysql_fetch_row($result);
        if(mysql_affected_rows()==0)
        {
            $userInfo['name'] = $response['linkedin']->{'first-name'}." ".$response['linkedin']->{'last-name'};
            $userInfo['id'] = null;
            $userInfo['pic'] = $response['linkedin']->{'picture-url'};
        }
        else
        {
            $userInfo['name'] = mysql_result($result,0,0);
            $userInfo['id'] = mysql_result($result,0,1);
            $userInfo['pic'] = mysql_result($result,0,2);
            $userInfo['wt'] = mysql_result($result,0,3);
            $userInfo['wt_title'] = mysql_result($result,0,4);
            $userInfo['fb_id'] = mysql_result($result, 0, 5);
            $userInfo['li_id'] = mysql_result($result, 0, 6);
        }

        return $userInfo;
    } else {
        // request failed
        echo "Error retrieving profile information:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";
    }
}


function getLIFriendInfo($ID)
{
    Global $OBJ_linkedin;

    //echo "<p>Trying ID $ID</p>";
    $response = $OBJ_linkedin->profile('id='.$ID.':(id,first-name,last-name,picture-url)');
    if($response['success'] === TRUE) {
        $response['linkedin'] = new SimpleXMLElement($response['linkedin']);

        $friend = array();
        $friend['id'] =  $response['linkedin']->{'id'};
        $friend['first_name'] =  $response['linkedin']->{'first-name'};
        $friend['name'] =  $response['linkedin']->{'first-name'}." ".$response['linkedin']->{'last-name'};
        $friend['pic'] = $response['linkedin']->{'picture-url'};
        if(strlen($friend['pic']) < 3)
        {
            $friend['pic'] = "images/anonymous.png";
        }
        return $friend;
    } else {
        // request failed
        echo "Error retrieving profile information:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";
    }
}


function checkIfInLISystem($user)
{
    Global $ID;
    $LI_ID = $user['li_id'];
    establishConnection();

    $sql = sprintf("SELECT ID, Stage FROM SocialMediaUsers WHERE LinkedID='%s'",mysql_real_escape_string($LI_ID));
    $result = mysql_query($sql);
    $temp = mysql_fetch_row($result);
    if(!$result)
    {
        $err=mysql_error();
        echo "<p>$err</p>";
    }
    else if(mysql_affected_rows()==0)
    {
        //Code For Drapers School
        /*
        if($_COOKIE['GroupID'] > 2)
        {
            insertGroupFriends($user);
        }
        */
        return -3;
    }
    else
    {
        $ID =  $temp[0];
        $stage = $temp[1];

        if($stage == 9)
        {
            $query = sprintf("UPDATE SocialMediaUsers SET Stage='3' WHERE ID='%s'",mysql_real_escape_string($ID));
            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            mysql_free_result($result);

            $query = sprintf("UPDATE SocialMediaFriends SET ID1Deactivated=0 WHERE ID1='%s'",mysql_real_escape_string($ID));
            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            mysql_free_result($result);

            $query = sprintf("UPDATE SocialMediaFriends SET ID2Deactivated=0 WHERE ID2='%s'",mysql_real_escape_string($ID));
            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            mysql_free_result($result);
        }

        $rand = rand(10000,99999);
        $str = $ID."O".$rand;

        setcookie("ID", $ID, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        if($stage >= 0)
        {
            setcookie("logged",rand(10000,99999), time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        }
        else
        {
            setcookie("logged",'Verify', time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        }
        setcookie("name", $user['name'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("pic", $user['pic'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("gender", $user['gender'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("WTname", $user['wt_title'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("FB_ID", $user['fb_id'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("LI_ID", $user['li_id'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */

        endConnection();
        return $stage;
    }
}


function checkLILinked($user)
{
    establishConnection();
    //echo "<p>Checking</p>";
    //print_r($user);
    $ID = $_COOKIE['ID'];
    $sql = sprintf("SELECT LinkedID,WorkType FROM SocialMediaUsers WHERE ID='%s'",mysql_real_escape_string($ID));
    $result = mysql_query($sql) or die('Query failed: ' . mysql_error());
    $LI_ID = mysql_result($result,0,0);
    if($LI_ID == 'NULLIE')
    {
        $wt = mysql_result($result,0,1);
        $LI_ID = $user['li_id'];
        mysql_free_result($result);

        $query = sprintf("UPDATE SocialMediaUsers SET LinkedID='%s' WHERE ID='%s'",mysql_real_escape_string($LI_ID),mysql_real_escape_string($ID));
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        mysql_free_result($result);

        enterLIFriends($LI_ID,$wt,$ID);
    }
    endConnection();
}

function enterLIFriends($ID, $wt1,$unq)
{
    Global $userInfo;
    $friends = getLIFriendsArray();
    //print_r($friends);
    foreach($friends as $friend)
    {
        $sql = sprintf("SELECT Completed,ID2,ID1Deactivated,ID1 FROM SocialMediaFriends WHERE ID1Reference='%s' AND ID2Reference='%s'",mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']));
        $result = mysql_query($sql) or die('Query failed: ' . mysql_error());
        //$ID1Deactivated = mysql_result($result,0,2);
        $temp = mysql_fetch_row($result);
        //print_r($temp);
        $ID1Deactivated = $temp[2];
        $ID1 = $temp[3];
        //echo "<P>Deactivated1: $ID1Deactivated</P>";
        if(!$result)
        {
            $err=mysql_error();
            echo "<p>$err</p>";
        }
        else if(mysql_affected_rows()==0)
        {
            $query = sprintf("'%s','%s','%s','%s',1,'LI',0,0,0,0,'','%s','%s',''",mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']),mysql_real_escape_string($friend['name']),mysql_real_escape_string($friend['pic']));
            $sql="INSERT INTO SocialMediaFriends VALUES($query)";
            $result = mysql_query($sql);
            mysql_free_result($result);

            $query = sprintf("'%s','%s','%s','%s',1,'LI',0,0,0,0,'%s','%s','%s',''",mysql_real_escape_string($friend['id']),mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID),mysql_real_escape_string($wt1),mysql_real_escape_string($userInfo['name']),mysql_real_escape_string($userInfo['pic']));
            $sql="INSERT INTO SocialMediaFriends VALUES($query)";
            $result = mysql_query($sql);
            mysql_free_result($result);
        }
        else
        {
            //echo "<P>Deactivated2: $ID1Deactivated</P>";
            if($ID1Deactivated >= 1)
            {
                if($ID1 == $_COOKIE['ID'])
                {
                    $query = sprintf("UPDATE SocialMediaFriends SET ID1Deactivated=0 WHERE ID1='%s' AND ID2Reference='%s'",mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']));
                    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
                    mysql_free_result($result);

                    $query = sprintf("UPDATE SocialMediaFriends SET ID2Deactivated=0 WHERE ID1Reference='%s' AND ID2='%s'",mysql_real_escape_string($friend['id']),mysql_real_escape_string($unq));
                    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
                    mysql_free_result($result);
                }
                else
                {
                    $query = sprintf("UPDATE SocialMediaFriends SET ID1Deactivated=0,ID1='%s' WHERE ID1Reference='%s' AND ID2Reference='%s'",mysql_real_escape_string($unq),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']));
                    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
                    mysql_free_result($result);

                    $query = sprintf("UPDATE SocialMediaFriends SET ID2Deactivated=0,ID2='%s' WHERE ID1Reference='%s' AND ID2Reference='%s'",mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID));
                    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
                    mysql_free_result($result);

                }
            }
            else
            {
                $ID2 = $temp[1];

                $sql = sprintf("SELECT Completed,ID2 FROM SocialMediaFriends WHERE ID1='%s' AND ID2='%s' AND ID1Reference!='%s' AND ID2Reference!='%s'",mysql_real_escape_string($unq),mysql_real_escape_string($ID2),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']));
                $result = mysql_query($sql);
                $temp = mysql_fetch_row($result);
                if(!$result)
                {
                    $err=mysql_error();
                    echo "<p>$err</p>";
                }
                else if(mysql_affected_rows()==0)
                {
                    $sql = sprintf("UPDATE SocialMediaFriends SET Completed=2, ID1='%s' WHERE ID1Reference='%s' AND ID2Reference='%s'",mysql_real_escape_string($unq),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']));
                    $result = mysql_query($sql);
                    mysql_free_result($result);

                    $sql = sprintf("UPDATE SocialMediaFriends SET Completed=2, ID2WorkType='%s',ID2='%s' WHERE ID2Reference='%s' AND ID1Reference='%s'",mysql_real_escape_string($wt1),mysql_real_escape_string($unq),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']));
                    $result = mysql_query($sql);
                    mysql_free_result($result);
                }
                else
                {
                    $sql = sprintf("UPDATE SocialMediaFriends SET Completed=2, ID1='%s', ID2='%s' WHERE ID1Reference='%s' AND ID2Reference='%s'",mysql_real_escape_string("2".$unq),mysql_real_escape_string("2".$ID2),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']));
                    $result = mysql_query($sql);
                    mysql_free_result($result);

                    $sql = sprintf("UPDATE SocialMediaFriends SET Completed=2, ID2WorkType='%s', ID1='%s',ID2='%s' WHERE ID2Reference='%s' AND ID1Reference='%s'",mysql_real_escape_string($wt1),mysql_real_escape_string("2".$ID2),mysql_real_escape_string("2".$unq),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']));
                    $result = mysql_query($sql);
                    mysql_free_result($result);
                }
            }
        }
    }
}


function updateLIFriends($ID, $wt1,$unq)
{
    establishConnection();
    Global $userInfo;
    //echo "<p>USer info in</p>";
    //print_r($userInfo);
    $friends = getLIFriendsArray();
    foreach($friends as $friend)
    {
        $sql = sprintf("SELECT Completed,ID2,ID1Deactivated,ID1 FROM SocialMediaFriends WHERE ID1Reference='%s' AND ID2Reference='%s'",mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']));
        $result = mysql_query($sql) or die('Query failed: ' . mysql_error());
        $temp = mysql_fetch_row($result);
        $ID2 = $temp[1];
        $ID1Deactivated = $temp[2];
        $ID1 = $temp[3];
        if(!$result)
        {
            $err=mysql_error();
            echo "<p>$err</p>";
        }
        else if(mysql_affected_rows()==0)
        {
            $sql = sprintf("SELECT ID,WorkType,Pic,Name FROM SocialMediaUsers WHERE LinkedID='%s'",mysql_real_escape_string($friend['id']));
            $result1 = mysql_query($sql) or die('Query failed: ' . mysql_error());
            $temp = mysql_fetch_row($result1);
            $ID2 = $temp[0];
            $IDWorkType2 = $temp[1];
            $IDPic2 = $temp[2];
            $IDName2 = $temp[3];
            $check1 = mysql_affected_rows();

            //echo "<p>ID1 is $unq and ID2 is $ID2</p>";
            $sql = sprintf("SELECT Completed FROM SocialMediaFriends WHERE ID1='%s' AND ID2='%s'",mysql_real_escape_string($unq),mysql_real_escape_string($ID2));
            $result2 = mysql_query($sql) or die('Query failed: ' . mysql_error());
            $temp = mysql_fetch_row($result2);
            if(mysql_affected_rows()==0)
            {
                if($check1==0)
                {
                    $query = sprintf("'%s','%s','%s','%s',1,'LI',0,0,0,0,'','%s','%s',''",mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']),mysql_real_escape_string($friend['name']),mysql_real_escape_string($friend['pic']));
                    $sql="INSERT INTO SocialMediaFriends VALUES($query)";
                    $result = mysql_query($sql);
                    mysql_free_result($result);

                    $query = sprintf("'%s','%s','%s','%s',1,'LI',0,0,0,0,'%s','%s','%s',''",mysql_real_escape_string($friend['id']),mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID),mysql_real_escape_string($wt1),mysql_real_escape_string($userInfo['name']),mysql_real_escape_string($userInfo['pic']));
                    $sql="INSERT INTO SocialMediaFriends VALUES($query)";
                    $result = mysql_query($sql);
                    mysql_free_result($result);
                }
                else
                {
                    $query = sprintf("'%s','%s','%s','%s',2,'LI',0,0,0,0,'%s','%s','%s',''",mysql_real_escape_string($unq),mysql_real_escape_string($ID2),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']),mysql_real_escape_string($IDWorkType2),mysql_real_escape_string($IDName2),mysql_real_escape_string($IDPic2));
                    $sql="INSERT INTO SocialMediaFriends VALUES($query)";
                    $result = mysql_query($sql);
                    mysql_free_result($result);

                    $query = sprintf("'%s','%s','%s','%s',2,'LI',0,0,0,0,'%s','%s','%s',''",mysql_real_escape_string($ID2),mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID),mysql_real_escape_string($wt1),mysql_real_escape_string($userInfo['name']),mysql_real_escape_string($userInfo['pic']));
                    $sql="INSERT INTO SocialMediaFriends VALUES($query)";
                    $result = mysql_query($sql);
                    mysql_free_result($result);
                }
            }
        }
        else
        {
            //echo "<P>Deactivated2: $ID1Deactivated</P>";
            if($ID1Deactivated >= 1)
            {
                $query = sprintf("UPDATE SocialMediaFriends SET ID1Deactivated=0,ID1='%s' WHERE ID1Reference='%s' AND ID2Reference='%s'",mysql_real_escape_string($unq),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']));
                $result = mysql_query($query) or die('Query failed: ' . mysql_error());
                mysql_free_result($result);

                $query = sprintf("UPDATE SocialMediaFriends SET ID2Deactivated=0,ID2='%s' WHERE ID1Reference='%s' AND ID2Reference='%s'",mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID));
                $result = mysql_query($query) or die('Query failed: ' . mysql_error());
                mysql_free_result($result);
            }
        }
    }
}
?>