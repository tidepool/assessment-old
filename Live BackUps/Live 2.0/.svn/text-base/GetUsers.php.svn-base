<?php 
$password   = $_POST['password'];
if(isset($_REQUEST['Name']))
{
    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');
    $name = $_REQUEST['Name'];
    $password = $_REQUEST['Password'];
    $count = $_REQUEST['Count'];

    $query = "INSERT INTO UserTable VALUES('$name','$password',$count)";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);
    mysql_close($link);
    $password = "p00lT1de";
}
if($password == "p00lT1de")
{
    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
    or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');



    $query = 'SELECT * FROM UserTable';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    echo "<h1>UserTable</h1>";
    echo "<table border='1' style='float:left; padding:5px;'>\n";
    echo "<tr>";
    echo "<th>Name</th> <th>Password</th> <th>Count Left</th> ";
    echo "</tr>";
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";

    mysql_free_result($result);

    echo "<div style='float: left' align='center'>";
    echo "<form  style='padding: 20px' action='' method='post'>";
    echo "<table cellpadding='10px;'>";
    echo "<tr><td>Name: </td><td><input type='text' name='Name'></td></tr>";
    echo "<tr><td>Password: </td><td><input type='text' name='Password'></td></tr>";
    echo "<tr><td>Count: </td><td><input type='text' name='Count'></td></tr>";
    echo "</table>";
    echo "<input type='submit'><br/>";
    echo "</form>";
    echo "</div>";
}
else
{
    echo "password did not match";
}
?>