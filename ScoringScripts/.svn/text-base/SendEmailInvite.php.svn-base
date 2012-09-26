<?php

include_once "../Live/dbConnect.php";
include_once "../Live/Emails/sendInviteEmail.php";
establishConnection();

$ID = $_COOKIE['ID'];
$emailsPost = substr($_POST['emails'],2);

$people = explode("**",$emailsPost);

$humans = array();
foreach($people as $person)
{
    $human = array();
    //echo "<P>person: $person</P>";
    $num1 = strpos($person,"^^");
    $num2 = strpos($person,"##");
    $num3 = strlen($person);
    $len2 = $num2-$num1-2;
    $len3 = $num3-$num2-2;
    //echo "<P>num1: $num1</P>";
    //echo "<P>num2: $num2</P>";
    $human['first'] = substr($person,0,$num1);
    $human['last'] = substr($person,$num1+2,$len2);
    $human['id'] = substr($person,$num2+2,$len3);
    $human['name'] = $human['first']." ".$human['last'];
    $human['pic'] = "images/anonymous.png";
    $humans[] = $human;
}

print_r($humans);


$query = sprintf("SELECT Email,WorkType,Name,Pic FROM SocialMediaUsers WHERE ID='%s'",mysql_real_escape_string($ID));
$result = mysql_query($query);
$email1 = mysql_result($result,0,0);
$wt1 = mysql_result($result,0,1);
$name1 = mysql_result($result,0,2);
$pic1 = mysql_result($result,0,3);
mysql_free_result($result);
enterEmailFriends($ID,$email1,$wt1,$name1,$pic1);
endConnection();
echo "<h1>DONE</h1>";

function enterEmailFriends($ID,$email1,$wt1,$name1,$pic1)
{
    Global $humans;

    foreach($humans as $friend)
    {
        $sql = sprintf("SELECT Completed,ID2,ID1Deactivated,ID1 FROM SocialMediaFriends WHERE ID1Reference='%s' AND ID2Reference='%s'",mysql_real_escape_string($email1),mysql_real_escape_string($friend['id']));
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
            $sql = sprintf("SELECT ID,WorkType,Name,Pic FROM SocialMediaUsers WHERE Email='%s'",mysql_real_escape_string($friend['id']));
            $result = mysql_query($sql);
            $temp = mysql_fetch_row($result);
            $ID2 = $temp[0];
            $wt2 = $temp[1];
            $name2 = $temp[2];
            $pic2 = $temp[3];
            if(!$result)
            {
                $err=mysql_error();
                echo "<p>$err</p>";
            }
            else if(mysql_affected_rows()==0)
            {
                $query = sprintf("'%s','%s','%s','%s',1,'EM',0,0,0,0,'','%s','%s',''",mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']),mysql_real_escape_string($email1),mysql_real_escape_string($friend['id']),mysql_real_escape_string($friend['name']),mysql_real_escape_string($friend['pic']));
                $sql="INSERT INTO SocialMediaFriends VALUES($query)";
                $result = mysql_query($sql);
                mysql_free_result($result);

                $query = sprintf("'%s','%s','%s','%s',1,'EM',0,0,0,0,'%s','%s','%s',''",mysql_real_escape_string($friend['id']),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']),mysql_real_escape_string($email1),mysql_real_escape_string($wt1),mysql_real_escape_string($name1),mysql_real_escape_string($pic1));
                $sql="INSERT INTO SocialMediaFriends VALUES($query)";
                $result = mysql_query($sql);
                mysql_free_result($result);
            }
            else
            {
                $query = sprintf("'%s','%s','%s','%s',2,'EM',0,0,0,0,'%s','%s','%s',''",mysql_real_escape_string($ID),mysql_real_escape_string($ID2),mysql_real_escape_string($email1),mysql_real_escape_string($friend['id']),mysql_real_escape_string($wt2),mysql_real_escape_string($name2),mysql_real_escape_string($pic2));
                $sql="INSERT INTO SocialMediaFriends VALUES($query)";
                $result = mysql_query($sql);
                mysql_free_result($result);

                $query = sprintf("'%s','%s','%s','%s',2,'EM',0,0,0,0,'%s','%s','%s',''",mysql_real_escape_string($ID2),mysql_real_escape_string($ID),mysql_real_escape_string($friend['id']),mysql_real_escape_string($email1),mysql_real_escape_string($wt1),mysql_real_escape_string($name1),mysql_real_escape_string($pic1));
                $sql="INSERT INTO SocialMediaFriends VALUES($query)";
                $result = mysql_query($sql);
                mysql_free_result($result);
            }
        }
        else
        {
            $ID2 = $temp[1];

            $sql = sprintf("SELECT Completed,ID2 FROM SocialMediaFriends WHERE ID1='%s' AND ID2='%s' AND ID1Reference!='%s' AND ID2Reference!='%s'",mysql_real_escape_string($ID),mysql_real_escape_string($ID2),mysql_real_escape_string($email1),mysql_real_escape_string($friend['id']));
            $result = mysql_query($sql);
            $temp = mysql_fetch_row($result);
            if(!$result)
            {
                $err=mysql_error();
                echo "<p>$err</p>";
            }
            else if(mysql_affected_rows()==0)
            {
                $sql = sprintf("UPDATE SocialMediaFriends SET Completed=2, ID1='%s' WHERE ID1Reference='%s' AND ID2Reference='%s'",mysql_real_escape_string($ID),mysql_real_escape_string($email1),mysql_real_escape_string($friend['id']));
                $result = mysql_query($sql);
                mysql_free_result($result);

                $sql = sprintf("UPDATE SocialMediaFriends SET Completed=2, ID2WorkType='%s',ID2='%s' WHERE ID2Reference='%s' AND ID1Reference='%s'",mysql_real_escape_string($wt1),mysql_real_escape_string($ID),mysql_real_escape_string($email1),mysql_real_escape_string($friend['id']));
                $result = mysql_query($sql);
                mysql_free_result($result);
            }
            else
            {
                $sql = sprintf("UPDATE SocialMediaFriends SET Completed=2, ID1='%s', ID2='%s' WHERE ID1Reference='%s' AND ID2Reference='%s'",mysql_real_escape_string("2".$ID),mysql_real_escape_string("2".$ID2),mysql_real_escape_string($email1),mysql_real_escape_string($friend['id']));
                $result = mysql_query($sql);
                mysql_free_result($result);

                $sql = sprintf("UPDATE SocialMediaFriends SET Completed=2, ID2WorkType='%s', ID1='%s',ID2='%s' WHERE ID2Reference='%s' AND ID1Reference='%s'",mysql_real_escape_string($wt1),mysql_real_escape_string("2".$ID2),mysql_real_escape_string("2".$ID),mysql_real_escape_string($email1),mysql_real_escape_string($friend['id']));
                $result = mysql_query($sql);
                mysql_free_result($result);
            }
        }
    }
}
?>