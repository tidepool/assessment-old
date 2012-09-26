<?php
$name = $_POST['name'];

switch ($name)
{
    case 'Init':
        CheckStaging();
        break;
    case 'SLoading':
        echo "Space/Space";
        break;
    case 'CLoading':
        echo "Clouds/Clouds";
        break;
    case 'FLoading':
        echo "Frames/Frames";
        break;
    case 'Space':
        echo "Clouds/Clouds";
        break;
    case 'Clouds':
        echo "Frames/Frames";
        break;
    case 'Frames':
        echo "WorkType/PostWorkType";
        break;
    default:
        echo "Error/Error";
        break;
}

function CheckStaging()
{
     $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $ID = $_REQUEST['ID'];
    //echo "ID is @$ID@ ";
    $query = "SELECT Stage FROM Delta WHERE Login='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $count = mysql_result($result,0);
    mysql_free_result($result);
    //echo "Count is : $count ";
    if($count == 0)
    {
        echo "Loading/SLoading";
    }
    else if($count == 1)
    {
        echo "Loading/CLoading";
    }
    else if($count == 2)
    {
        echo "Loading/FLoading";
    }
    else if($count == 3)
    {
        echo "WorkType/PostWorkType";
    }
    else
    {
        echo "Error/Error";
    }
    mysql_close($link);
}
?>