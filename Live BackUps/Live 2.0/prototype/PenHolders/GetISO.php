<?php 
$password   = $_POST['password'];

if($password == 'gl0b3korn')
{
    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = 'SELECT * FROM PenHoldersISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    echo "<h1>PenHolders ISO</h1>";
    echo "<table border='1' style='float:left; padding:5px;'>\n";
    echo "<tr> <th>Examinee ID</th>";
    echo "<th>p1</th> <th>p2</th> <th>p3</th> <th>p4</th> <th>p5</th> <th>p6</th> <th>p7</th> <th>p8</th>";
    echo "</tr>";
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";


    echo "<table border='1' style='float:left; padding:5px;'>\n";
    echo "<tr> <th>Item ID</th> <th>type</th> </tr>";
    echo "<tr> <th>p1</th> <th>?</th></tr>";
    echo "<tr> <th>p2</th> <th>?</th></tr>";
    echo "<tr> <th>p3</th> <th>?</th></tr>";
    echo "<tr> <th>p4</th> <th>?</th></tr>";
    echo "<tr> <th>p5</th> <th>?</th></tr>";
    echo "<tr> <th>p6</th> <th>?</th></tr>";
    echo "<tr> <th>p7</th> <th>?</th></tr>";
    echo "<tr> <th>p8</th> <th>?</th></tr>";
    echo "</table>\n";

    mysql_free_result($result);
    mysql_close($link);
}
else
{
    echo "password did not match";
}
?>