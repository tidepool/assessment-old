<?php

$link = mysql_connect('tidepoolmaster.caov91lo3dxj.us-east-1.rds.amazonaws.com', 'tidepool', 't1dep00L')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool_new') or die('Could not select database');
// Performing SQL query

$types = array();
$types[] = "mystery";
$types[] = "vista";
$types[] = "anger";
$types[] = "disgust";
$types[] = "fear";
$types[] = "happiness";
$types[] = "sadness";
$types[] = "suprise";
$types[] = "whole";
$types[] = "detail";
$types[] = "negative";
$types[] = "movement";
$types[] = "color";
$types[] = "achromatic";
$types[] = "shading";
$types[] = "texture";
$types[] = "pairs";
$types[] = "human";
$types[] = "animal";
$types[] = "abstract";
$types[] = "nature";
$types[] = "man";
$types[] = "direct_eyes";
$types[] = "averted_eyes";
$types[] = "human_eyes";
$types[] = "animal_eyes";
$types[] = "bird";
$types[] = "bird_flight";
$types[] = "domestic";
$types[] = "non_domestic";
$types[] = "primary_color";
$types[] = "red";
$types[] = "green";
$types[] = "blue";
$variables = "user_id VARCHAR(30)";
/*
for($i=1;$i<=3;$i++)
{
    for($j=1;$j<=5;$j++)
    {
        foreach($types as $type)
        {
            if($type == "primary_color" )
            {
                $variables .= ", frames_5p_".$i."_".$j."_".$type." VARCHAR(6)";
            }
            else if($type == "red" || $type == "green" || $type == "blue")
            {
                $variables .= ", frames_5p_".$i."_".$j."_".$type." VARCHAR(2)";
            }
            else
            {
                $variables .= ", frames_5p_".$i."_".$j."_".$type." Boolean";
            }
        }
    }
}
*/
for($i=1;$i<=14;$i++)
{
    for($j=1;$j<=2;$j++)
    {
        foreach($types as $type)
        {

            if($type == "primary_color" )
            {
                $variables .= ", frames_2p_".$i."_".$j."_".$type." VARCHAR(6)";
            }
            else if($type == "red" || $type == "green" || $type == "blue")
            {
                $variables .= ", frames_2p_".$i."_".$j."_".$type." VARCHAR(2)";
            }
            else
            {
                $variables .= ", frames_2p_".$i."_".$j."_".$type." Boolean";
            }
        }
    }
}

echo $variables;
$query = "CREATE TABLE frames_picture_breakdown_3 (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>