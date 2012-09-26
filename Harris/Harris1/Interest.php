<?
include_once "../Live/dbConnect.php";
processPersonality();
populateQuestions();
$date = date(DATE_RFC822);
setcookie("date", $date, time()+3600,"/", ".tidepool.co"); /* Expires in a day */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Interests</title>
    <link rel="icon" href="http://tidepool.co/images/LogoHalf.png" type="image/png">
    <link rel="stylesheet" href="style/Interest.css"/>
    <script type="text/javascript">
        eg_on = new Image ( );
        eg_off = new Image ( );
        eg_on.src = "images/continue_hover.png";
        eg_off.src = "images/continue.png";
        function button_on ( imgId )
        {
            if ( document.images )
            {
                butOn = eval ( imgId + "_on.src" );
                document.getElementById(imgId).src = butOn;
            }
        }

        function button_off ( imgId )
        {
            if ( document.images )
            {
                butOff = eval ( imgId + "_off.src" );
                document.getElementById(imgId).src = butOff;
            }
        }
    </script>
</head>
<body>

<form action="ProcessInterest.php" method="post">
    <h1>Are You:</h1>
    <div class="qbundle">
        <?
        for($i=1;$i<=35;$i++)
        {
            echo "<li class='areyou'><input type='checkbox' name='C$i' value='C$i'><span class='text'>".$questions[$i]."</span></li><br>\n";
            if($i==18)
            {
                echo "</div>\n<div>";
            }
        }
        ?>
    </div>
    <br clear="all">
    <div align="center">
        <input type="image" class="login" onmouseout="button_off('eg');"
               onmouseover="button_on('eg');"
               src="images/continue.png" alt="Login" id="eg"">
    </div>
</form>
</body>
</html>
<?

function processPersonality()
{

    $ID = $_COOKIE['ID'];


    establishConnection();

    $queryChunk = "'$ID'";

    $query = "Select * FROM PersonalityValidation WHERE ID='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    $exists = $temp[0];
    mysql_free_result($result);

    if(strlen($exists) < 1)
    {
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
            $query = "UPDATE Timing SET Personality='$date' where ID='$ID';";
        }
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        mysql_free_result($result);

        $radios = array();
        for($i=1;$i<=100;$i++)
        {
            $temp = "G".$i;
            $radios[] = ($_REQUEST[$temp] ==  null?-1:$_REQUEST[$temp]);
            //echo "<p>".$radios[$i]."</p>";
        }
        //print_r($radios);
        foreach($radios as $rad)
        {
            //echo "<p>".$radios[$i]."</p>";
            $queryChunk .= ",".$rad;
        }
        //echo "<p>$queryChunk</p>";
        $query = "INSERT INTO PersonalityValidation VALUES($queryChunk);";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        mysql_free_result($result);
    }
    endConnection();
}

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

function populateQuestions()
{
    Global $questions;
    $questions = array();
    $questions[0] = 0;
    $questions[] = "Practical";
    $questions[] = "Athletic";
    $questions[] = "Straight forward";
    $questions[] = "Mechanically inclined";
    $questions[] = "A nature lover";
    $questions[] = "Good with tools and machinery";
    $questions[] = "Inquisitive";
    $questions[] = "Analytical";
    $questions[] = "Scientific";
    $questions[] = "Observant";
    $questions[] = "Precise";
    $questions[] = "Good with tools and machinery";
    $questions[] = "Creative";
    $questions[] = "Intuitive";
    $questions[] = "Imaginative";
    $questions[] = "Innovative";
    $questions[] = "An individualist";
    $questions[] = "Friendly";
    $questions[] = "Helpful";
    $questions[] = "Idealistic";
    $questions[] = "Insightful";
    $questions[] = "Outgoing";
    $questions[] = "Understanding";
    $questions[] = "Self-confident";
    $questions[] = "Assertive";
    $questions[] = "Sociable";
    $questions[] = "Persuasive";
    $questions[] = "Enthusiastic";
    $questions[] = "Energetic";
    $questions[] = "Well groomed";
    $questions[] = "Accurate";
    $questions[] = "Numerically inclined";
    $questions[] = "Methodical";
    $questions[] = "Conscientious";
    $questions[] = "Efficient";
}
?>