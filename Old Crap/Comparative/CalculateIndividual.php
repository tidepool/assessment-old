<?php
include_once "GetValues.php";
include_once "../Dashboard/workTypeGenerator.php";

$nameFiles = file_get_contents('male.txt');
$names = explode("|",$nameFiles);
$words = array();

$poolSize = $_REQUEST['pool'];
$person =  array();
$person['name'] = $_REQUEST['name'];
$person['letter'] = $_REQUEST['letter'];
//echo $person['letter'];
$index = $_REQUEST['index'];

createWorkTypeArray();
$file = file_get_contents('./pool.txt', true);
if(!$file)
{
    echo "Error Could Not Read Employee File";
}
else
{
    $names = explode("@", $file);
    $words = array();
    for($i=0;$i<$poolSize;$i++)
    {
        //echo "<p>$name</p>";
        if($index != $i)
        {
            $pieces = explode(",", $names[$i]);
            $temp['name'] = $pieces[0];
            $temp['letter'] = $pieces[1];
            $data = getTypeInfo($temp['letter']);
            $temp['title'] = $data['title'];
            $words[] = $temp;
        }
    }
}

$newArray = calculateGroups($words,'Both');

function calculateGroups($array,$type)
{
    Global $poolSize,$person;
    //print_r($array);
    for($i=0;$i<count($array);$i++)
    {
        $value = getComparativeValue($array[$i],$type);
        //$array[$i]['name'] = $array[$;
        $array[$i]['value'] = $value;
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../Dashboard/styles/employee_chart.css" />
</head>
<body>
<div id="content" align="center">
<?
    OrderArray($array);
}

function getComparativeValue($array,$type)
{
    Global $person;
    $value = 0;

    if($type == 'Interest')
    {
        $temp = getInterestValue(substr($person['letter'],0,1),substr($array['letter'],0,1));
    }
    elseif($type == 'Personality')
    {
        $temp = getPersonalityValue(substr($person['letter'],1,2),substr($array['letter'],1,2));
    }
    elseif($type == 'Both')
    {
        $temp1 = getInterestValue(substr($person['letter'],0,1),substr($array['letter'],0,1));
        $temp2 = getPersonalityValue(substr($person['letter'],1,2),substr($array['letter'],1,2));
        //echo "<p>Temp1 is $temp1 and  Temp2 is $temp2</p>";
        $temp = $temp1+$temp2;
    }
    else
    {
        echo "<h1>ERROR TYPE NOT CHOSEN</h1>";
    }
    $value += $temp;
    return $value;
}

function OrderArray($array)
{
    usort($array, 'compareValues');
    ?>
    <table id="bottomtable" cellpadding='10px'>
        <tr class="head_style_bottom">
            <th>Names</th> <th>WorkType</th> <th>Total</th>
        </tr>
        <?
        $counter = 0;
        foreach($array as $a)
        {
            $names = "";
            $letters = "";
            for($i=1;$i<count($a)-2;$i++)
            {
                $names .= ", ".$a[$i]['name'];
                $letters .= ", ".$a[$i]['letter'];
            }
            if($counter == 0)
            {
                $class = "whiteback";
                $counter++;
            }
            else
            {
                $class = "lightgreyback";
                $counter = 0;
            }
            echo "<tr>\n";
            echo "<td class='$class'>".$a['name']."</td>\n";
            echo "<td class='$class'>".$a['title']."</td>\n";
            echo "<td class='$class'>".$a['value']."</td>\n";
        }
        ?>
    </table>
		</div>
	</body>
</html>
    <?
}

function compareValues($x, $y)
{
    return $x['value'] - $y['value'];
}
?>