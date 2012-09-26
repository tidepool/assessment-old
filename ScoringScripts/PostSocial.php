<?php
$ID = $_POST['ID'];
$choice = getName(intval($_POST['choice']));

$link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');

$query = "UPDATE SocialSharing SET $choice=1 WHERE ID='$ID';";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);
mysql_close($link);

function getName($num)
{
    if($num == 1)
    {
        return "FacebookResults";
    }
    else if($num == 2)
    {
        return "LinkedInResults";
    }
    else if($num == 3)
    {
        return "TwitterResults";
    }
    else if($num == 4)
    {
        return "FacebookTest";
    }
    else if($num == 5)
    {
        return "LinkedInTest";
    }
    else if($num == 6)
    {
        return "TwitterTest";
    }
}
?>