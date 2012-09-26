<?php
require_once "dbConnect.php";
$memcache = getMemcache();

include_once "linkedin.php";
$config['base_url']             =   'https://stage.tidepool.co/Live/loginUser.php';
$config['callback_url']         =   'https://stage.tidepool.co/Live/loginUser.php';
$config['linkedin_access']      =   'bwgphvx02ln2';
$config['linkedin_secret']      =   'UAdvY5ASFasYsFnB';

function getAuth()
{
    Global $memcache, $config, $linkedin;

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
}

function loginLI($url)
{
    Global $memcache, $config, $linkedin;

    $config['base_url']             =   $url;
    $config['callback_url']         =   $url;


    if(!checkForLILogin())
    {
        echo "<p>token null get</p>";
        getAuth();
    }

    # First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
    $linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['callback_url'] );
    //$linkedin->debug = true;

    if (isset($_REQUEST['oauth_verifier'])){
        //**//$_SESSION['oauth_verifier']     = $_REQUEST['oauth_verifier'];
        $memcache->set('oauth_verifier', $_REQUEST['oauth_verifier'], false, 7200) or die ("Failed to save data at the server");

        //**//$linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->request_token = unserialize($memcache->get('requestToken'));
        echo "<p>request token2 ".$linkedin->request_token."</p>";

        //**//$linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->oauth_verifier = $memcache->get('oauth_verifier');

        $linkedin->getAccessToken($_REQUEST['oauth_verifier']);

        //**//$_SESSION['oauth_access_token'] = serialize($linkedin->access_token);
        $memcache->set('oauth_access_token', serialize($linkedin->access_token), false, 7200) or die ("Failed to save data at the server");
        header("Location: " . $config['callback_url']);
        exit;
    }
    else
    {
        //**//$linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->request_token = unserialize($memcache->get('requestToken'));
        //echo "<p>request token3 ".$linkedin->request_token."</p>";
        //**//$linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->oauth_verifier = $memcache->get('oauth_verifier');
        //**//$linkedin->access_token     =   unserialize($_SESSION['oauth_access_token']);
        $linkedin->access_token = unserialize($memcache->get('oauth_access_token'));
    }

    # You now have a $linkedin->access_token and can make calls on behalf of the current member
    $xml_response = $linkedin->getProfile("~:(id,first-name,last-name,picture-url)");

    return $xml_response;
}

function checkForLILogin()
{
    Global $memcache;


    $token = unserialize($memcache->get('requestToken'));
    //echo "<p>request token1 $token</p>";
    if($token == null)
    {
        return false;
    }
    else
    {
        return true;
    }
}

function getLIUser()
{
    Global $memcache, $config, $linkedin, $userInfo;

    $xml_response = $linkedin->getProfile("~:(id,first-name,last-name,headline,picture-url)");
    //print_r($xml_response);
    $userInfo = array();
    $userInfo['li_id'] = $xml_response->{'id'};
    $userInfo['li_pic'] = $xml_response->{'picture-url'};

    establishConnection();
    $sql = sprintf("SELECT Name,ID,Pic,WorkType,WorkTypeTitle,FacebookID,LinkedID FROM SocialMediaUsers WHERE LinkedID='%s'",mysql_real_escape_string($userInfo['li_id']));
    $result = mysql_query($sql) or die('Query failed: ' . mysql_error());
    mysql_fetch_row($result);
    if(mysql_affected_rows()==0)
    {
        $userInfo['name'] = $xml_response->{'first-name'}." ".$xml_response->{'last-name'};
        $userInfo['id'] = null;
        $userInfo['pic'] = $xml_response->{'picture-url'};
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
    if(strlen($userInfo['pic']) < 3)
    {
        $userInfo['pic'] = "images/anonymous.png";
    }

    return $userInfo;
}

function checkLILinked($user)
{
    establishConnection();
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

function getLIFriendsArray()
{
    Global $memcache, $config, $linkedin;
    $xml_response = $linkedin->getConnections("~/connections:(id,first-name,last-name,picture-url)");
    //print_r($xml_response);
    if((int)$xml_response['total'] > 0)
    {
        foreach($xml_response as $connection)
        {
            if($connection->{'first-name'} != "private")
            {
                $user = array();
                $user['name'] = $connection->{'first-name'}." ".$connection->{'last-name'};
                $user['id'] = $connection->{'id'};
                $user['pic'] = $connection->{'picture-url'};
                if(strlen($user['pic']) < 3)
                {
                    $user['pic'] = "images/anonymous.png";
                }
                $friends[] = $user;
            }
        }
    }
    else
    {
        // no connections
    }
    return $friends;
}


function signOutLI()
{
    Global $memcache;

    $memcache->flush();
}
?>
