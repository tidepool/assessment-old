<?php
$link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query

$types = array();
$types[] = "Whole";
$types[] = "Detail";
$types[] = "Negative";
$types[] = "Movement";
$types[] = "Color";
$types[] = "Achromatic";
$types[] = "Shading";
$types[] = "Texture";
$types[] = "Pairs";
$types[] = "Human";
$types[] = "Animal";
$types[] = "Abstract";
$types[] = "Nature";
$types[] = "Man";
$variables = "ID VARCHAR(30)";

for($i=1;$i<=66;$i++)
{
    foreach($types as $type)
    {
        $variables .= ", Clouds_Pics_".$i."_".$type." Boolean";
    }
}

echo $variables;
$query = "CREATE TABLE CloudsPictureData (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);


// Closing connection
mysql_close($link);
?>