<?php

$link = mysql_connect('tidepoolmaster.caov91lo3dxj.us-east-1.rds.amazonaws.com', 'tidepool', 't1dep00L')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('tidepool') or die('Could not select database');
// Performing SQL query

$types = array();
$types[] = "Mystery";
$types[] = "Vista";
$types[] = "Anger";
$types[] = "Disgust";
$types[] = "Fear";
$types[] = "Happiness";
$types[] = "Sadness";
$types[] = "Suprise";
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
$types[] = "DirectEyes";
$types[] = "AvertedEyes";
$types[] = "HumanEyes";
$types[] = "AnimalEyes";
$types[] = "Bird";
$types[] = "birdFlight";
$types[] = "Domestic";
$types[] = "NonDomestic";
$types[] = "PrimaryColor";
$types[] = "Red";
$types[] = "Green";
$types[] = "Blue";
$variables = "ID VARCHAR(30)";
/*
for($i=4;$i<=7;$i++)
{
    for($j=1;$j<=5;$j++)
    {
        foreach($types as $type)
        {
            if($type == "PrimaryColor" )
            {
                $variables .= ", Frames5_Element_".$i."_".$j."_".$type." VARCHAR(6)";
            }
            else if($type == "Red" || $type == "Green" || $type == "Blue")
            {
                $variables .= ", Frames5_Element_".$i."_".$j."_".$type." VARCHAR(2)";
            }
            else
            {
                $variables .= ", Frames5_Element_".$i."_".$j."_".$type." Boolean";
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

            if($type == "PrimaryColor" )
            {
                $variables .= ", Frames2_Element_".$i."_".$j."_".$type." VARCHAR(6)";
            }
            else if($type == "Red" || $type == "Green" || $type == "Blue")
            {
                $variables .= ", Frames2_Element_".$i."_".$j."_".$type." VARCHAR(2)";
            }
            else
            {
                $variables .= ", Frames2_Element_".$i."_".$j."_".$type." Boolean";
            }
        }
    }
}

echo $variables;
$query = "CREATE TABLE FramesPictureElements3 (".$variables.");";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo $result;
// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>