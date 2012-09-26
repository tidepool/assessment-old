<?php 
$password   = $_POST['password'];

if($password == 'Eyes0nly')
{
    $link = mysql_connect('127.0.0.1', 'wei', 'tidepool')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = 'SELECT * FROM IMISO';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    echo "<h1>IM ISO</h1>";
    echo "<table border='1' style='float:left; padding:5px;'>\n";
    echo "<tr> <th>Examinee ID</th>";
    echo "<th>1_1</th> <th>1_2</th> <th>1_3</th> <th>1_4</th>";
    echo "<th>2_1</th> <th>2_2</th> <th>2_3</th> <th>2_4</th>";
    echo "<th>3_1</th> <th>3_2</th> <th>3_3</th> <th>3_4</th>";
    echo "<th>4_1</th> <th>4_2</th> <th>4_3</th> <th>4_4</th>";
    echo "<th>5_1</th> <th>5_2</th> <th>5_3</th> <th>5_4</th>";
    echo "<th>6_1</th> <th>6_2</th> <th>6_3</th> <th>6_4</th>";
    echo "<th>7_1</th> <th>7_2</th> <th>7_3</th> <th>7_4</th>";
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
    echo "<tr> <th>Item ID</th> <th>Content Code</th> <th>Additional Content Code</th>";
    echo "</tr>";

  
    echo "</table>\n";

    mysql_free_result($result);
    mysql_close($link);
}
else
{
    echo "password did not match";
}
?>