<?php
function establishConnection()
{
    global $link;
    //$link = mysql_connect("masterdb","tidepool","t1dep00L")
    /*
        $link = mysql_connect('tidepoolmaster.caov91lo3dxj.us-east-1.rds.amazonaws.com', 'tidepool', 't1dep00L')
            or die('Could not connect: ' . mysql_error());
        mysql_select_db('tidepool') or die('Could not select database');
    */
    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

}

function getMemcache()
{
    global $memcache;

    $memcache = new Memcache;
    $memcache->connect('stage.35gjje.0001.use1.cache.amazonaws.com', 11211) or die ("Could not connect");
    return $memcache;
}


function endConnection()
{
    global $link;
    mysql_close($link);
}
?>