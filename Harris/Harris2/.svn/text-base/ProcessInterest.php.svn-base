<?
include_once "../Live/dbConnect.php";
$ID = $_COOKIE['ID'];
$radios = array();
for($i=1;$i<=35;$i++)
{
    $temp = "C".$i;
    $radios[] = $_POST[$temp];
    //echo "<p>".$radios[$i]."</p>";
}


establishConnection();

$date1 = $_COOKIE['date'];
$date2 = date(DATE_RFC822);
$diff = strtotime($date2) - strtotime($date1);
$date = formatDate($diff);

$query = "Select * FROM Timing WHERE ID='$ID';";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$temp = mysql_fetch_row($result);
$exists = $temp[0];
mysql_free_result($result);
if(strlen($exists) < 1)
{
    $query = "INSERT INTO Timing VALUES ('$ID', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '','','$date','');";
}
else
{
    $query = "UPDATE Timing SET Interest='$date' where ID='$ID';";
}
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);


$queryChunk = "'$ID'";
//print_r($radios);
foreach($radios as $rad)
{
    //echo "<p>".$radios[$i]."</p>";
    if($rad != null)
    {
        $queryChunk .= ",1";
    }
    else
    {
        $queryChunk .= ",0";
    }
}
//echo "<p>$queryChunk</p>";
$query = "INSERT INTO InterestValidation VALUES($queryChunk);";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

$query = "UPDATE Harris SET Completed=1 where ID='$ID';";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
mysql_free_result($result);

endConnection();


function formatDate($diff)
{
    $hour = intval($diff/3600);
    if($hour < 10)
    {
        $hour = "0".$hour;
    }
    $diff = $diff%3600;
    $min = intval($diff/60);
    if($min < 10)
    {
        $min = "0".$min;
    }
    $sec = $diff%60;
    if($sec < 10)
    {
        $sec = "0".$sec;
    }
    //echo "<p>Diff Formatted $hour:$min:$sec</p>";
    return "$hour:$min:$sec";
}

$r = $_COOKIE['hi_r'];
$s = $_COOKIE['hi_s'];
$page = $_COOKIE['pageid'];
$status = $_COOKIE['status'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="images/LogoHalf.png" type="image/png">
<body align="center">
<div class="main" align="center">
    <script language="JavaScript">
        document.body.innerHTML += '<form id="form" action="https://surveys.pollg.com/wix/<?echo $page;?>.aspx?" method="get"><input type="hidden" name="r" value="<?echo $r;?>"><input type="hidden" name="s" value="<?echo $s;?>"><input type="hidden" name="status" value="1">';
        document.getElementById("form").submit();
    </script>
</body >
</html>