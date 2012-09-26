<?php 
$password   = $_POST['password'];

if($password == 'Eyes0nly')
{
    $link = mysql_connect('127.0.0.1', 'wei', 'tidepool')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = 'SELECT * FROM PathwayISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    echo "<h1>Pathway ISO</h1>";
    echo "<table border='1' style='float:left; padding:5px;'>\n";
    echo "<tr> <th>Examinee ID</th>";
    echo "<th>L1</th> <th>L2</th> <th>L3</th> <th>L4</th> <th>L5</th> <th>L6</th> <th>L7</th> <th>L8</th>";
    echo "<th>S1</th> <th>S2</th> <th>S3</th> <th>S4</th> <th>S5</th> <th>S6</th> <th>S7</th> <th>S8</th>";
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
    echo "<tr> <th>L1</th> <th>Money</th></tr>";
    echo "<tr> <th>L2</th> <th>Benefits</th></tr>";
    echo "<tr> <th>L3</th> <th>Time</th></tr>";
    echo "<tr> <th>L4</th> <th>Recognition</th></tr>";
    echo "<tr> <th>L5</th> <th>Promotion</th></tr>";
    echo "<tr> <th>L6</th> <th>Appreciation</th></tr>";
    echo "<tr> <th>L7</th> <th>Support</th></tr>";
    echo "<tr> <th>L8</th> <th>Trainings</th></tr>";
    echo "<tr> <th>S1</th> <th>Money</th></tr>";
    echo "<tr> <th>S2</th> <th>Benefits</th></tr>";
    echo "<tr> <th>S3</th> <th>Time</th></tr>";
    echo "<tr> <th>S4</th> <th>Recognition</th></tr>";
    echo "<tr> <th>S5</th> <th>Promotion</th></tr>";
    echo "<tr> <th>S6</th> <th>Appreciation</th></tr>";
    echo "<tr> <th>S7</th> <th>Support</th></tr>";
    echo "<tr> <th>S8</th> <th>Trainings</th></tr>";
    echo "</table>\n";

    mysql_free_result($result);
    mysql_close($link);
}
else
{
    echo "password did not match";
}
?>