<?php 
$password   = $_POST['password'];

if($password == 'gl0b3korn')
{
    $link = mysql_connect('127.0.0.1', 'wei', 'tidepool')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = 'SELECT * FROM WLBISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    echo "<h1>WLB ISO</h1>";
    echo "<table border='1' style='float:left; padding:5px;'>\n";
    echo "<tr> <th>Examinee ID</th>";

    echo "<th>Pie1</th> <th>Pie2</th>";
    echo "<th>TPS1_1</th> <th>TPS1_2</th> <th>TPS1_3</th>";
    echo "<th>OBS1</th>";
    echo "<th>Pins</th>";
    echo "<th>TS1</th> <th>TS2</th> <th>TS3</th> <th>TS4</th>";
    echo "<th>Select1_1</th> <th>Select1_2</th> <th>Select1_3</th>";
    echo "<th>TPS2_1</th> <th>TPS2_2</th> <th>TPS2_3</th>";
    echo "<th>OBS2</th>";
    echo "<th>Net1_1</th> <th>Net1_2</th> <th>Net1_3</th>";
    echo "<th>Net2_1</th> <th>Net2_2</th> <th>Net2_3</th>";
    echo "<th>Net3_1</th> <th>Net3_2</th> <th>Net3_3</th>";
    echo "<th>Net4_1</th> <th>Net4_2</th> <th>Net4_3</th>";
    echo "<th>Net5_1</th> <th>Net5_2</th> <th>Net5_3</th>";
    echo "<th>Briefcase1_1</th> <th>Briefcase1_2</th> <th>Briefcase1_3</th>";
    echo "<th>Briefcase2_1</th> <th>Briefcase2_2</th> <th>Briefcase2_3</th>";
    echo "<th>Briefcase3_1</th> <th>Briefcase3_2</th> <th>Briefcase3_3</th>";
    echo "<th>Briefcase4_1</th> <th>Briefcase4_2</th> <th>Briefcase4_3</th>";
    echo "<th>Briefcase5_1</th> <th>Briefcase5_2</th> <th>Briefcase5_3</th>";
    echo "<th>Briefcase6_1</th> <th>Briefcase6_2</th> <th>Briefcase6_3</th>";
    echo "<th>Briefcase7_1</th> <th>Briefcase7_2</th> <th>Briefcase7_3</th>";
    echo "<th>Briefcase8_1</th> <th>Briefcase8_2</th> <th>Briefcase8_3</th>";
    echo "<th>Briefcase9_1</th> <th>Briefcase9_2</th> <th>Briefcase9_3</th>";
    echo "<th>Briefcase10_1</th> <th>Briefcase10_2</th> <th>Briefcase10_3</th>";
    echo "<th>Office1_1</th> <th>Office1_2</th> <th>Office1_3</th> <th>Office1_4</th>";
    echo "<th>Office2_1</th> <th>Office2_2</th> <th>Office2_3</th> <th>Office2_4</th>";
    echo "<th>Office3_1</th> <th>Office3_2</th> <th>Office3_3</th> <th>Office3_4</th>";
    echo "<th>Office4_1</th> <th>Office4_2</th> <th>Office4_3</th> <th>Office4_4</th>";
    echo "<th>Office5_1</th> <th>Office5_2</th> <th>Office5_3</th> <th>Office5_4</th>";
    echo "<th>Office6_1</th> <th>Office6_2</th> <th>Office6_3</th> <th>Office6_4</th>";
    echo "<th>Office7_1</th> <th>Office7_2</th> <th>Office7_3</th> <th>Office7_4</th>";
    echo "<th>Dream_1</th> <th>Dream_2</th> <th>Dream_3</th>";
    echo "<th>Trash1</th> <th>Trash2</th> <th>Trash3</th> <th>Trash4</th> <th>Trash5</th> <th>Trash6</th>";
    echo "<th>Time</th>";
    echo "<th>Clipboard1</th> <th>Clipboard2</th> <th>Clipboard3</th>";

    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";
    mysql_free_result($result);
    mysql_close($link);
}
else
{
    echo "password did not match";
}
?>