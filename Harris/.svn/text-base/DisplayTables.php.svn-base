<?php
require_once "Calculations.php";
getCalculations();
?>
<h1>Harris Results</h1>
<table border="2px">
    <tr>
        <th>Total Taken</th> <th>Total Completed</th> <th>Path 1 Taken</th> <th>Path 1 Completed</th> <th>Path 2 Taken</th> <th>Path 2 Completed</th>
    </tr>
    <tr>
        <?
        echo  "<td>$totalTaken</td><td>$totalComp</td><td>$path1taken</td><td>$path1comp</td><td>$path2taken</td><td>$path2comp</td>";
        ?>
    </tr>
</table>
<br>
<h1>Average Times</h1>
<table border="2px">
    <tr>
        <th>PenHolders</th> <th>IM1</th> <th>Violin</th> <th>IM2</th> <th>Balloon</th> <th>IM3</th> <th>IM4</th> <th>Clouds</th> <th>Pathway</th> <th>IM5</th> <th>Frames</th> <th>IM6</th> <th>Space</th> <th>Dark</th> <th>IM7</th> <th>Beach</th> <th>Feedback</th> <th>Personality</th> <th>Interest</th>
    </tr>
    <tr>
        <?
        $fieldNumber = 0;
        foreach($times as $time)
        {
            $total = 0;
            $count = 0;
            foreach($time as $t)
            {
                $total+=$t;
                $count++;
            }
            $avg = formatDate($total/$count);
            calculatePathTotal($total/$count,$fields[$fieldNumber]);
            echo "<td>$avg</td>";
            $fieldNumber++;
        }
        //print_r($times);
        ?>
    </tr>
</table>
<br>
<h1>Completion Times</h1>
<table border="2px">
    <tr>
        <th>Path 1 Total</th> <th>Path 2 Total</th> <th>Question Total</th> <th>Foxtrot Total</th>
    </tr>
    <tr>
        <?
        echo "<td>".formatDate($path1)."</td><td>".formatDate($path2)."</td><td>".formatDate($questions)."</td><td>".formatDate($foxtrot)."</td>";
        ?>
    </tr>
</table>

<br>
<h1>Sharing On Social</h1>
<table border="2px">
    <tr>
        <th>Facebook Results</th> <th>LinkedIn Results</th> <th>Twitter Results</th> <th>Facebook Test</th> <th>LinkedIn Test</th> <th>Twitter Test</th>
    </tr>
    <tr>
        <?
        echo "<td>".$sharing[0]."</td><td>".$sharing[1]."</td><td>".$sharing[2]."</td><td>".$sharing[3]."</td><td>".$sharing[4]."</td><td>".$sharing[5]."</td>";
        ?>
    </tr>
</table>
