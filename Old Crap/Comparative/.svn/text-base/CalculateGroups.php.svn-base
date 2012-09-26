<?php
    include_once "GetValues.php";

    $nameFiles = file_get_contents('male.txt');
    $names = explode("|",$nameFiles);
    $words = array();

    $groupSize = $_REQUEST['team'];
    $poolSize = $_REQUEST['pool'];
    $totalSize;

    $file = file_get_contents('./pool.txt', true);
    if(!$file)
    {
        echo "Error Could Not Read Employee File";
    }
    else
    {
        //echo "<p>";
        //print_r($file);
        //echo "</p>";
        $names = explode("@", $file);
        $words = array();
        for($i=0;$i<$poolSize;$i++)
        {
            //echo "<p>$name</p>";
            $pieces = explode(",", $names[$i]);
            $temp['name'] = $pieces[0];
            $temp['letter'] = $pieces[1];
            $pool[] = $temp;
        }
    }
//print_r($words);
//$words = array('I', 'E', 'A','S','R','R','I','C','A','I',);
//$words = array('LC', 'HE', 'HN','LO','HA','LE','LN','HC','HA');
    $newArray = calculateGroups($pool,'Both');

    function calculateGroups($array,$type)
    {
        Global $groupSize, $totalSize;
        require_once 'Math/Combinatorics.php';

        $combinatorics = new Math_Combinatorics;
        $count = 0;
        $groups = $combinatorics->combinations($array, $groupSize);
        $totalSize = count($groups);
        //print_r($groups);
        $newArray = array();
        foreach($groups as $group)
        {
            $temp = array();
            foreach($group as $g)
            {
                $temp[] = $g;
            }
            $newArray[] = $temp;
        }
        //echo "<p></p>";
        //print_r($newArray);
        for($i=0;$i<count($newArray);$i++)
        {
            $value = getGroupValue($newArray[$i],$type);
            $newArray[$i]['value'] = $value;
            $newArray[$i]['avg'] = $value/$groupSize;
            $count++;
        }
        //print_r($groups);
        $temp = "";
        foreach($array as $a)
        {
            $temp .= " ".$a['name'].",";
        }
        $temp = substr($temp, 0, -1);
        ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../Dashboard/styles/chart.css" />
</head>
<body>
<div id="content" align="center">
<?
        OrderArray($newArray);
    }

    function getGroupValue($array,$type)
    {
        $value = 0;
        //small optimization by changing first loop to count -1 and starting second at $j-$i+1
        //echo "<p></p>";
        //print_r($array);
        for($i=0;$i<count($array);$i++)
        {
            for($j=0;$j<count($array);$j++)
            {
                if($i!=$j)
                {
                    if($type == 'Interest')
                    {
                        $temp = getInterestValue(substr($array[$i]['letter'],0,1),substr($array[$j]['letter'],0,1));
                    }
                    elseif($type == 'Personality')
                    {
                        $temp = getPersonalityValue(substr($array[$i]['letter'],1,2),substr($array[$j]['letter'],1,2));
                    }
                    elseif($type == 'Both')
                    {
                        $temp1 = getInterestValue(substr($array[$i]['letter'],0,1),substr($array[$j]['letter'],0,1));
                        $temp2 = getPersonalityValue(substr($array[$i]['letter'],1,2),substr($array[$j]['letter'],1,2));
                        //echo "<p>Temp1 is $temp1 and  Temp2 is $temp2</p>";
                        $temp = $temp1+$temp2;
                    }
                    else
                    {
                        echo "<h1>ERROR TYPE NOT CHOSEN</h1>";
                    }
                    $value += $temp;
                }
                //echo "<p>Getting ".$array[$i]." ".$array[$j]." temp is ".$temp." value is ".$value."</p>";
            }
        }
        return $value;
    }

function OrderArray($array)
{
    Global $groupSize, $totalSize, $poolSize;
    //print_r($array);
    usort($array, 'compareValues');
    ?>
    <table id="bottomtable" cellpadding='10px'>
        <tr class="head_style_bottom">
            <th>Names</th> <th>Interests</th> <th>Avg Diff Group</th>  <th>Avg Diff Person</th>
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
            echo "<td class='$class chart1'>".$a[0]['name'].$names."</td>\n";
            echo "<td class='$class chart2'>".$a[0]['letter'].$letters."</td>\n";
            //echo "<td class='$class'>".$a['value']."</td>\n";
            echo "<td class='$class chart3'>".round($a['avg'],3)."</td>\n";
            echo "<td class='$class chart4'>".round($a['avg']/$groupSize,3)."</td>\n";
            echo "</tr>\n";
        }
        ?>
    </table>
		</div>
    <script>
        parent.document.getElementById("calc").innerHTML = "";
        parent.document.getElementById("pText").innerHTML = "<? echo $poolSize; ?>";
        parent.document.getElementById("tText").innerHTML = "<? echo number_format($totalSize); ?>";
    </script>
	</body>
</html>
        <?
}

function compareValues($x, $y)
{
    return $x['value'] - $y['value'];
}
?>