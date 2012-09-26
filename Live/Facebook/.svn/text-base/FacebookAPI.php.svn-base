<?php
require_once 'facebook.php';
include_once "../dbConnect.php";
$facebook = new Facebook(array(
    'appId'  => '168192369908415',
    'secret' => '4e565efa44f61abcf1b7a5c9cb8d8765',
));

function getFBLoginLink()
{
    Global $facebook;
    $params = array();
    $params['scope'] = "publish_stream,email,user_relationships,user_birthday,user_location,user_work_history";
    $loginUrl = $facebook->getLoginUrl($params);
    echo $loginUrl;
}

function getFBLoginLinkVariable()
{
    Global $facebook;
    $params = array();
    $params['scope'] = "publish_stream,email,user_relationships,user_birthday,user_location,user_work_history";
    $loginUrl = $facebook->getLoginUrl($params);
    return $loginUrl;
}

function getFBLogout()
{
    Global $facebook;
    $logoutUrl = $facebook->getLogoutUrl();
    return $logoutUrl;
}

function postToFB($msg,$wt)
{
    Global $facebook, $userInfo;
    $ID = $userInfo['id'];
    try
    {
        $loc = "/$ID/feed";
        $facebook->api($loc, 'post', array(
                'message' => $msg,
                'link'    => 'http://tidepool.co',
                'picture' => 'http://tidepool.co/images/Logo.png',
                'name'    => 'Tidepool',
                'description'=> 'My TidePool Worktype is '.$wt
            )
        );
        return true;
    }
    catch (FacebookApiException $e)
    {
        echo $e;
        return false;
    }
}

function inviteFBFriend($msg,$ID)
{
    Global $facebook;
    try
    {
        $loc = "/$ID/feed";
        $facebook->api($loc, 'post', array(
                'message' => $msg,
                'link'    => 'http://tidepool.co',
                'picture' => 'http://tidepool.co/images/Logo.png',
                'name'    => 'Tidepool',
                'description'=> 'Checkout Tidepool'
            )
        );
        return true;
    }
    catch (FacebookApiException $e)
    {
        echo $e;
        return false;
    }
}

function getFBUser()
{
    Global $facebook, $userInfo;

    $person = $facebook->api('/me');

    $userInfo = array();
    $userInfo['fb_id'] = $person['id'];
    $userInfo['location'] = $person['location']['name'];
    $userInfo['company'] = $person['work'][0]['employer']['name'];
    $userInfo['jobTitle'] = $person['work'][0]['position']['name'];
    //echo "<p>Company is ".$userInfo['company']."</p>";
    //echo "<p>jobTitle is ".$userInfo['jobTitle']."</p>";
    $userInfo['birthday'] = $person['birthday'];
    $userInfo['email'] = $person['email'];
    $userInfo['gender'] = $person['gender'];

    establishConnection();
    $sql = sprintf("SELECT Name,ID,Pic,WorkType,WorkTypeTitle,FacebookID,LinkedID FROM SocialMediaUsers WHERE FacebookID='%s'",mysql_real_escape_string($userInfo['fb_id']));
    $result = mysql_query($sql);
    mysql_fetch_row($result);
    if(mysql_affected_rows()==0)
    {
        $userInfo['name'] = $person['name'];
        $userInfo['id'] = null;
        $userInfo['pic'] = "https://graph.facebook.com/".$person['id']."/picture?type=large";
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
}

function signOutFB()
{
    Global $facebook;
    $facebook->destroySession();
    setcookie("FB_ID", '', time()-7200,"/", ".tidepool.co"); /* Expires in two hours */
    //$facebook->clearAllData();
}

function checkIfInFBSystem($user)
{
    Global $ID;
    $FB_ID = $user['fb_id'];
    establishConnection();

    $sql = sprintf("SELECT ID, Stage FROM SocialMediaUsers WHERE FacebookID='%s'",mysql_real_escape_string($FB_ID));
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

function checkFBLinked($user)
{
    establishConnection();

    $ID = $_COOKIE['ID'];
    $sql = sprintf("SELECT FacebookID,WorkType FROM SocialMediaUsers WHERE ID='%s'",mysql_real_escape_string($ID));
    $result = mysql_query($sql);
    $FB_ID = mysql_result($result,0,0);
    if($FB_ID == 'NULLIE')
    {
        $wt = mysql_result($result,0,1);
        mysql_free_result($result);

        $FB_ID = $user['fb_id'];
        $age = $user['birthday'];
        $location = $user['location'];
        $company = $user['company'];
        $job = $user['jobTitle'];

        $query = sprintf("UPDATE SocialMediaUsers SET FacebookID='%s',Age='$age',Location='$location',Company='$company',JobTitle='$job' WHERE ID='%s'",mysql_real_escape_string($FB_ID),mysql_real_escape_string($ID));
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        mysql_free_result($result);

        enterFBFriends($FB_ID,$wt,$ID);
    }
    endConnection();
}

function enterFBFriends($ID,$wt1,$unq)
{
    Global $userInfo;
    $friends = getFBFriendsArray();
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
            $query = sprintf("'%s','%s','%s','%s',1,'FB',0,0,0,0,'','%s','%s',''",mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']),mysql_real_escape_string($friend['name']),mysql_real_escape_string($friend['pic']));
            $sql="INSERT INTO SocialMediaFriends VALUES($query)";
            $result = mysql_query($sql);
            mysql_free_result($result);

            $query = sprintf("'%s','%s','%s','%s',1,'FB',0,0,0,0,'%s','%s','%s',''",mysql_real_escape_string($friend['id']),mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID),mysql_real_escape_string($wt1),mysql_real_escape_string($userInfo['name']),mysql_real_escape_string($userInfo['pic']));
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


function updateFBFriends($ID,$wt1,$unq)
{
    establishConnection();
    Global $userInfo;
    $friends = getFBFriendsArray();
    //print_r($friends);
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
            $sql = sprintf("SELECT ID,WorkType,Pic,Name FROM SocialMediaUsers WHERE FacebookID='%s'",mysql_real_escape_string($friend['id']));
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
                    $query = sprintf("'%s','%s','%s','%s',1,'FB',0,0,0,0,'','%s','%s',''",mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']),mysql_real_escape_string($friend['name']),mysql_real_escape_string($friend['pic']));
                    $sql="INSERT INTO SocialMediaFriends VALUES($query)";
                    $result = mysql_query($sql);
                    mysql_free_result($result);

                    $query = sprintf("'%s','%s','%s','%s',1,'FB',0,0,0,0,'%s','%s','%s',''",mysql_real_escape_string($friend['id']),mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID),mysql_real_escape_string($wt1),mysql_real_escape_string($userInfo['name']),mysql_real_escape_string($userInfo['pic']));
                    $sql="INSERT INTO SocialMediaFriends VALUES($query)";
                    $result = mysql_query($sql);
                    mysql_free_result($result);
                }
                else
                {
                    $query = sprintf("'%s','%s','%s','%s',2,'FB',0,0,0,0,'%s','%s','%s',''",mysql_real_escape_string($unq),mysql_real_escape_string($ID2),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']),mysql_real_escape_string($IDWorkType2),mysql_real_escape_string($IDName2),mysql_real_escape_string($IDPic2));
                    $sql="INSERT INTO SocialMediaFriends VALUES($query)";
                    $result = mysql_query($sql);
                    mysql_free_result($result);

                    $query = sprintf("'%s','%s','%s','%s',2,'FB',0,0,0,0,'%s','%s','%s',''",mysql_real_escape_string($ID2),mysql_real_escape_string($unq),mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID),mysql_real_escape_string($wt1),mysql_real_escape_string($userInfo['name']),mysql_real_escape_string($userInfo['pic']));
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

function getFBFriendsArray()
{
    Global $facebook;
    //echo "<h2>Trying to get friends</h2>";
    $fbfriends = $facebook->api('/me/friends');

    $friends = array();
    foreach($fbfriends['data'] as $friend)
    {
        $user = array();
        $user['id'] =  $friend['id'];
        $user['name'] =  $friend['name'];
        $user['pic'] = "https://graph.facebook.com/".$friend['id']."/picture?type=large";

        $friends[] = $user;
        //$counter++;
    }
    return $friends;
}

function getFBFriendInfo($ID)
{
    Global $facebook;
    $user = $facebook->api('/'.$ID);

    //echo "<p>ID is $ID</p>";
    $friend = array();
    $friend['id'] =  $user['id'];
    $friend['name'] =  $user['first_name'];
    $friend['pic'] = "https://graph.facebook.com/$ID/picture?type=large";

    return $friend;
}

?>