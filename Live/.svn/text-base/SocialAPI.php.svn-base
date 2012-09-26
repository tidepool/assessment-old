<?
require_once "Facebook/FacebookAPI.php";
require_once "LinkedIn/LinkedInAPI.php";
require_once "dbConnect.php";

function verifyLogin($email, $password)//check login
{
    $sql = sprintf("SELECT Password,Stage,ID,Name,Pic,Gender,WorkTypeTitle,FacebookID,LinkedID FROM SocialMediaUsers WHERE Email='%s'",mysql_real_escape_string($email));
    $result = mysql_query($sql);
    $checker = mysql_result($result, 0,  0);
    if($checker == $password)
    {
        $stage = mysql_result($result, 0,  1);
        $id = mysql_result($result, 0,  2);
        $name = mysql_result($result, 0,  3);
        $pic = mysql_result($result, 0,  4);
        $gender = mysql_result($result, 0, 5);
        $wt = mysql_result($result, 0, 6);
        $FB_ID = mysql_result($result, 0, 7);
        $LI_ID = mysql_result($result, 0, 8);

        setcookie("ID", $id, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        if($stage >= 0)
        {
            setcookie("logged",rand(10000,99999), time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        }
        else
        {
            setcookie("logged",'Verify', time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        }
        setcookie("name", $name, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("pic", $pic, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("gender", $gender, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("WTname", $wt, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("FB_ID", $FB_ID, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("LI_ID", $LI_ID, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        if($stage == 9)
        {
            $query = sprintf("UPDATE SocialMediaUsers SET Stage='3' WHERE ID='%s'",mysql_real_escape_string($id));
            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            mysql_free_result($result);

            $query = sprintf("UPDATE SocialMediaFriends SET ID1Deactivated=0 WHERE ID1='%s'",mysql_real_escape_string($id));
            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            mysql_free_result($result);

            $query = sprintf("UPDATE SocialMediaFriends SET ID2Deactivated=0 WHERE ID2='%s'",mysql_real_escape_string($id));
            $result = mysql_query($query) or die('Query failed: ' . mysql_error());
            mysql_free_result($result);
        }


        return $stage;
    }
    else
    {
        return -7;
    }
}

function checkIfInSystem($email, $password)//check if user is already in system
{
    $sql = sprintf("SELECT Password,Stage,ID,Name,Pic,Gender,WorkTypeTitle,FacebookID,LinkedID FROM SocialMediaUsers WHERE Email='%s'",mysql_real_escape_string($email));
    $result = mysql_query($sql);
    $checker = mysql_result($result, 0,  0);
    if($checker == $password)
    {

    }
    else
    {
        return 0;
    }
}

function getUser()//get user info
{
    establishConnection();
    $userInfo = array();
    $sql = sprintf("SELECT ID,Name,Pic,Gender,WorkTypeTitle,FacebookID,LinkedID,Stage FROM SocialMediaUsers WHERE ID='%s'",mysql_real_escape_string($_COOKIE['ID']));
    $result = mysql_query($sql);
    $userInfo['id'] = mysql_result($result, 0,  0);
    $userInfo['name'] = mysql_result($result, 0,  1);
    $userInfo['pic'] = mysql_result($result, 0,  2);
    $userInfo['gender'] = mysql_result($result, 0, 3);
    $userInfo['wt'] = mysql_result($result, 0, 4);
    $userInfo['fb_id'] = mysql_result($result, 0, 5);
    $userInfo['li_id'] = mysql_result($result, 0, 6);
    $userInfo['stage'] = mysql_result($result, 0, 7);
    /*
        $sql = sprintf("SELECT title FROM WorkTypesNew WHERE id='%s'",mysql_real_escape_string($userInfo['wt']));
        $result = mysql_query($sql);
        $temp = mysql_fetch_row($result);
        $userInfo['wt'] = $temp[0];
    */
    setcookie("ID", $userInfo['id'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("logged",rand(10000,99999), time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("name", $userInfo['name'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("pic", $userInfo['pic'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("gender", $userInfo['gender'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("WTname", $userInfo['wt'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("FB_ID", $userInfo['fb_id'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("LI_ID", $userInfo['li_id'], time()+7200,"/", ".tidepool.co"); /* Expires in two hours */

    return $userInfo;
}

function signUpUser($name,$email,$password,$gender)//sign up user
{
    global $facebook;


    establishConnection();
    $sql = sprintf("SELECT * FROM SocialMediaUsers WHERE Email='%s'",mysql_real_escape_string($email));
    $result = mysql_query($sql);
    mysql_fetch_row($result);
    if(!$result)
    {
        $err=mysql_error();
        echo "<p>$err</p>";
    }
    else if(mysql_affected_rows()==0)
    {
        $FB_ID = "NULLIE";
        $LI_ID = "NULLIE";
        $age = $location = $company = $job = '';

        date_default_timezone_set('PST');
        $date = date("m-j-y");
        $IP = $_SERVER['REMOTE_ADDR'];
        $browser = getBrowser();
        $wt = $_COOKIE['WTname'];
        $unq = $_COOKIE['ID'];

        $sql = sprintf("SELECT ID FROM WorkTypesNew WHERE title='%s'",mysql_real_escape_string($wt));
        $result = mysql_query($sql);
        $wt1 = mysql_result($result, 0,  0);
        mysql_free_result($result);

        $user = $facebook->getUser();
        if ($user)
        {
            $user_profile = getFBUser();
            $age = $user_profile['birthday'];
            $location = $user_profile['location'];
            $company = $user_profile['company'];
            $job = $user_profile['jobTitle'];
            $pic = "https://graph.facebook.com/".$user_profile['fb_id']."/picture?type=large";
            $FB_ID = $user_profile['fb_id'];
            enterFBFriends($FB_ID, $wt1,$unq);
        }
        elseif(checkForLILogin())
        {
            loginLI('https://stage.tidepool.co/Live/post_assessment.php');
            $user = getLIUser();
            $pic = $user['li_pic'];
            $LI_ID = $user['li_id'];
            enterLIFriends($LI_ID, $wt1,$unq);
        }
        else
        {
            $pic = "images/anonymous.png";
        }

        $reset = uniqid('');
        $reset = $unq.$reset;
        $query = sprintf("'$unq','$FB_ID','$LI_ID','%s','%s','%s','$pic','%s','$age','$location','$company','$job','$date','$wt1','$wt',-1,'$IP','$browser','$reset'",mysql_real_escape_string($name),mysql_real_escape_string($email),mysql_real_escape_string($password),mysql_real_escape_string($gender));
        $sql="INSERT INTO SocialMediaUsers VALUES($query)";
        $result = mysql_query($sql) or die('SMU Query failed: '.mysql_error());
        mysql_free_result($result);

        $query = sprintf("INSERT INTO WorkTypeAccuracy VALUES ('%s',0,0,0)",mysql_real_escape_string($unq));
        $result = mysql_query($query);
        mysql_free_result($result);

        $query = sprintf("INSERT INTO SignupLinks VALUES ('%s',0,0,0,0,0)",mysql_real_escape_string($unq));
        $result = mysql_query($query);
        mysql_free_result($result);

        $query = sprintf("INSERT INTO SocialPost VALUES ('%s',0,0)",mysql_real_escape_string($unq));
        $result = mysql_query($query);
        mysql_free_result($result);

        $query = sprintf("INSERT INTO UserSettings VALUES ('%s',1)",mysql_real_escape_string($unq));
        $result = mysql_query($query);
        mysql_free_result($result);

        endConnection();
        setcookie("logged",'Verify', time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("ID", $unq, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("gender", $gender, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("pic", $pic, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("WTname", $wt, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("name", $name, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("FB_ID", $FB_ID, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */
        setcookie("LI_ID", $LI_ID, time()+7200,"/", ".tidepool.co"); /* Expires in two hours */

        $verifyLink = "https://www.TidePool.co/Live/verifyAccount.php?acct=$reset";
        $removeLink = "https://www.TidePool.co/Live/removeAccount.php?acct=$reset";
        require_once "Emails/sendVerifyEmail.php";
        sendVerifyEmail($email,$name,$verifyLink,$removeLink,$_COOKIE['WTname']);

        return true;
    }
    else
    {
        return false;
    }
}


function getUserInfo()//get user info
{
    if($_COOKIE['SMType']=="FB")
    {
        $user =  getFBUser();
    }
    else if($_COOKIE['SMType']=="LI")
    {
        $user =  getLIUser();
    }
    else
    {
        echo "<h1>Uh OH. Error determining social network</h1>";
        $user = null;
    }

    return $user;
}


function signOut()
{
    signOutFB();
    signOutLI();

    setcookie("ID",'', time()-7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("logged",'', time()-7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("gender",'', time()-7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("pic",'', time()-7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("WTname",'', time()-7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("name",'', time()-7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("GroupID",'', time()-7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("FB_ID", '', time()-7200,"/", ".tidepool.co"); /* Expires in two hours */
    setcookie("LI_ID", '', time()-7200,"/", ".tidepool.co"); /* Expires in two hours */
    //echo "<P>SINGEDOUT</P>";
}

function getLogOutURL()
{
    if($_COOKIE['SMType']=="FB")
    {
        //echo "<p>Knows its fb</p>";
        return getFBLogout();
    }
    else if($_COOKIE['SMType']=="LI")
    {
        return "http://tidepool.co/SocialMedia/index.php?lType=revoke";
    }
    else
    {
        echo "<h1>Log Out. Error determining social network</h1>";
    }
}

function getTidepoolFriends($ID)//get tidepool friends
{
    $approvedFriends = array();
    $requestFriends = array();
    $pendingFriends = array();
    $tideFriends = array();
    $otherFriends = array();
    $allTideFriends = array();

    establishConnection();

    //all tidepool friends
    $sql = "SELECT ID2,ID2Name,ID2WorkType,ID2Pic,GroupID FROM SocialMediaFriends WHERE ID1='$ID' AND Completed=2 AND ID1Deactivated=0 AND ID2Deactivated=0";
    $result = mysql_query($sql);
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        $friend = array();
        $friend['id'] = $line['ID2'];
        $friend['name'] = $line['ID2Name'];
        $friend['wt'] = $line['ID2WorkType'];
        $friend['pic'] = $line['ID2Pic'];
        $friend['group'] = $line['GroupID'];
        $allTideFriends[] = $friend;
    }

    //friends that have messaged you
    $sql = "SELECT ID2,ID2Name,ID2WorkType,ID2Pic,GroupID FROM SocialMediaFriends WHERE ID1='$ID' AND Completed=2 AND ID1Accepted=0 AND ID2Accepted=1 AND ID1Deactivated=0 AND ID2Deactivated=0";
    $result = mysql_query($sql);
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        $friend = array();
        $friend['id'] = $line['ID2'];
        $friend['name'] = $line['ID2Name'];
        $friend['wt'] = $line['ID2WorkType'];
        $friend['pic'] = $line['ID2Pic'];
        $friend['group'] = $line['GroupID'];
        $requestFriends[] = $friend;
    }

    //friends who agreed to share
    $sql = "SELECT ID2,ID2Name,ID2WorkType,ID2Pic,GroupID FROM SocialMediaFriends WHERE ID1='$ID' AND Completed=2 AND ID1Accepted=1 AND ID2Accepted=1 AND ID1Deactivated=0 AND ID2Deactivated=0";
    $result = mysql_query($sql);
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        $friend = array();
        $friend['id'] = $line['ID2'];
        $friend['name'] = $line['ID2Name'];
        $friend['wt'] = $line['ID2WorkType'];
        $friend['pic'] = $line['ID2Pic'];
        $friend['group'] = $line['GroupID'];
        $approvedFriends[] = $friend;
    }
    //friends who you can ask to compare
    $sql = "SELECT ID2,ID2Name,ID2WorkType,ID2Pic,GroupID FROM SocialMediaFriends WHERE ID1='$ID' AND Completed=2 AND ID1Accepted=0 AND ID2Accepted=0 AND ID1Deactivated=0 AND ID2Deactivated=0";
    $result = mysql_query($sql);
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        $friend = array();
        $friend['id'] = $line['ID2'];
        $friend['name'] = $line['ID2Name'];
        $friend['wt'] = $line['ID2WorkType'];
        $friend['pic'] = $line['ID2Pic'];
        $friend['group'] = $line['GroupID'];
        $tideFriends[] = $friend;
    }
    //friends who have not taken assessment
    $sql = "SELECT ID2,ID2Name,ID2WorkType,ID2Pic,GroupID FROM SocialMediaFriends WHERE ID1='$ID' AND Completed<2  AND ID1Deactivated=0 AND ID2Deactivated=0";
    $result = mysql_query($sql);
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        $friend = array();
        $friend['id'] = $line['ID2'];
        $friend['name'] = $line['ID2Name'];
        $friend['wt'] = $line['ID2WorkType'];
        $friend['pic'] = $line['ID2Pic'];
        $friend['group'] = $line['GroupID'];
        $otherFriends[] = $friend;
    }

    //friends who you have asked
    $sql = "SELECT ID2,ID2Name,ID2WorkType,ID2Pic,GroupID FROM SocialMediaFriends WHERE ID1='$ID' AND Completed=2 AND ID1Accepted=1 AND ID2Accepted=0  AND ID1Deactivated=0 AND ID2Deactivated=0";
    $result = mysql_query($sql);
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        $friend = array();
        $friend['id'] = $line['ID2'];
        $friend['name'] = $line['ID2Name'];
        $friend['wt'] = $line['ID2WorkType'];
        $friend['pic'] = $line['ID2Pic'];
        $friend['group'] = $line['GroupID'];
        $pendingFriends[] = $friend;
    }

    endConnection();

    $allFriends = array();
    $allFriends[] = $requestFriends;
    $allFriends[] = $approvedFriends;
    $allFriends[] = $tideFriends;
    $allFriends[] = $otherFriends;
    $allFriends[] = $pendingFriends;
    $allFriends[] = $allTideFriends;

    return $allFriends;
}


function insertGroupFriends($user)
{
    establishConnection();
    $ID1 = $user['id'];
    $ID1Name = $user['name'];
    $ID1Pic = $user['pic'];
    $ID1WorkType = $user['wt'];

    $group = $_COOKIE['GroupID'];

    //echo"<p>ID: $ID1</p>";

    //echo "<p>done inserting groups</p>";
    $sql = "SELECT * FROM Groupings WHERE ID='$ID1' AND GroupID='$group'";
    $result = mysql_query($sql);
    $temp = mysql_fetch_row($result);
    if(!$result)
    {
        $err=mysql_error();
        echo "<p>$err</p>";
    }
    else if(mysql_affected_rows()==0)
    {
        //echo "<p>inserting groups</p>";

        $sql = sprintf("SELECT ID FROM Groupings WHERE GroupID='%s'",mysql_real_escape_string($_COOKIE['GroupID']));
        $result = mysql_query($sql);
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
            //print_r($line);
            $ID2 = $line['ID'];
            echo "<p>on id $ID2</p>";

            $sql="Select Name,Pic,WorkType FROM SocialMediaUsers WHERE ID='$ID2'";
            $result1 = mysql_query($sql);
            $ID2Name = mysql_result($result1,0,0);
            $ID2Pic = mysql_result($result1,0,1);
            $ID2WorkType = mysql_result($result1,0,2);
            mysql_free_result($result1);

            $query = "'$ID1','$ID2',2,'$group',0,0,0,0,'$ID2WorkType','$ID2Name','$ID2Pic',''";
            $sql="INSERT INTO SocialMediaFriends VALUES($query)";
            $result1 = mysql_query($sql);
            mysql_free_result($result1);

            $query = "'$ID2','$ID1',2,'$group',0,0,0,0,'$ID1WorkType','$ID1Name','$ID1Pic',''";
            $sql="INSERT INTO SocialMediaFriends VALUES($query)";
            $result1 = mysql_query($sql);
            mysql_free_result($result1);
        }
        mysql_free_result($result);


        //echo "<p>new person</p>";
        $query = sprintf("INSERT INTO Groupings VALUES ('%s','%s')",mysql_real_escape_string($user['id']),mysql_real_escape_string($_COOKIE['GroupID']));
        $result = mysql_query($query);
        mysql_free_result($result);
    }
    else
    {
        //echo "<p>foundin groupings</p>";
    }
}


function checkLogOut()
{
    $relocate = true;
    foreach (getallheaders() as $name => $value) {
        if($name == "Content-Type")
            $relocate = false;
    }
    if($relocate)
    {
        ?>
    <html>
    <body>
    <script language="JavaScript">
        document.body.innerHTML += '<form id="form" action="http://tidepool.co/SocialMedia" method="post">';
        document.getElementById("form").submit();
    </script>
    </body>
    </html>
    <?
    }
}

function getBrowser()
{
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
    {
        return "Firefox";
    }
    else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
    {
        return "Chrome";
    }
    else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari'))
    {
        return "Safari";
    }
    else if(strpos($_SERVER['HTTP_USER_AGENT'], 'IE'))
    {
        return "IE";
    }
    else
    {
        return "Other";
    }
}
?>