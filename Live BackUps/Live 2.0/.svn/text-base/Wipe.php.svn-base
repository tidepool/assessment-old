<?php 
$password   = $_POST['password'];
if($password == 'FuckIt')
{
    $link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    //WLB
    $query = 'DELETE FROM WLBScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    $query = 'DELETE FROM WLBISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    //PenHolders
    $query = 'DELETE FROM PenHoldersScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    $query = 'DELETE FROM PenHoldersISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    //Holland
    $query = 'DELETE FROM HollandScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    $query = 'DELETE FROM HollandISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    //Balloon
    $query = 'DELETE FROM BalloonScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    $query = 'DELETE FROM BalloonISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    //Pathway
    $query = 'DELETE FROM PathwayScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    $query = 'DELETE FROM PathwayISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    //Values
    $query = 'DELETE FROM ValuesScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    $query = 'DELETE FROM ValuesISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    //Personality
    $query = 'DELETE FROM PersonalityScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    $query = 'DELETE FROM PersonalityISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    //Motivation
    $query = 'DELETE FROM MotivationScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    $query = 'DELETE FROM MotivationISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    //Projective
    $query = 'DELETE FROM ProjectiveScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    $query = 'DELETE FROM ProjectiveISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    //Resilience
    $query = 'DELETE FROM ResilienceScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    $query = 'DELETE FROM ResilienceISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    //IM
    $query = 'DELETE FROM IMScoring';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    $query = 'DELETE FROM IMISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    mysql_close($link);

    echo "<h1>SUCCESSFUL WIPE</h1>";
}
else
{
    echo "password did not match";
}
?>