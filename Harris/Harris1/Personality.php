<?
include_once "../Live/dbConnect.php";
proccessFeedback();
populateQuestions();
$date = date(DATE_RFC822);
setcookie("date", $date, time()+3600,"/", ".tidepool.co"); /* Expires in a day */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Personality</title>
    <link rel="icon" href="http://tidepool.co/images/LogoHalf.png" type="image/png">
    <link rel="stylesheet" href="style/Personality.css"/>
    <script type="text/javascript" src="http://tidepool.co/jQuery/jquery.js"></script>
    <script type="text/javascript">
        $(document).submit(
                function(){

                    //alert("Problem with radio: ");
                    // triggering this check and the radio buttons
                    for(var i=1; i<=100; i++)
                    {
                        if (!$('input[name=G'+i+']:checked').length) {

                            $('html, body').animate({
                                scrollTop: $("#Q"+i).offset().top
                            }, 1000);

                            alert("You did not answer question "+i);
                            return false;
                        }
                    }
                }
        );

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
<form name="theForm" action="Interest.php" method="post">
    <p class="headparagraph">Here are a number of characteristics that may or may not describe you.  For example, do you agree that you seldom feel blue?  Please choose the number that best indicates the extent to which you agree or disagree with each statement listed below.  Be as honest as possible, but rely on your initial feeling and do not think too much about each item.</p>
    <div class="left_bundle">
        <?
        for($i=1;$i<=100;$i++)
        {
            echo "<p id='Q$i' class='question'><span class='number'>$i.</span> ".$questions[$i]."</p>\n";
            echo "<pre class='bottomspace'><span class='blue_left'>Agree</span> <span class='blue_right'>Disagree</span></pre>\n";
            echo "<table>\n";
            echo "<tr align='center'>\n";
            echo "<td><input type='radio' name='G$i' value='1'></td>\n";
            echo "<td><input type='radio' name='G$i' value='2'></td>\n";
            echo "<td><input type='radio' name='G$i' value='3'></td>\n";
            echo "<td><input type='radio' name='G$i' value='4'></td>\n";
            echo "<td><input type='radio' name='G$i' value='5'></td>\n";
            echo "</tr>\n";
            echo "<tr align='center'>\n";
            echo "<td>1</td>\n";
            echo "<td>2</td>\n";
            echo "<td>3</td>\n";
            echo "<td>4</td>\n";
            echo "<td>5</td>\n";
            echo "</tr>\n";
            echo "</table>\n";
            if($i==50)
            {
                echo "</div>\n";
                echo "<div class='right_bundle'>\n";
            }
        }
        ?>
    </div>
    <br style="clear: both;">
    <div align="center">
        <input type="image" class="login" onmouseout="button_off('eg');"
               onmouseover="button_on('eg');"
               src="images/continue.png" alt="Login" id="eg"">
    </div>
</form>
</body>
</html>

<?
function proccessFeedback()
{
    $ID = $_COOKIE['ID'];

    establishConnection();

    //echo "<p>Query: $queryChunk</p>";
    $query = "Select * FROM Feedback WHERE ID='$ID';";
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
            $query = "INSERT INTO Timing VALUES ('$ID', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '','$date','','');";
        }
        else
        {
            $query = "UPDATE Timing SET Feedback='$date' where ID='$ID';";
        }
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        mysql_free_result($result);
        //echo "<p>Does not exist uploading</p>";
        $radios = array();
        $radios[] = ($_REQUEST['G1'] ==  null?-1:$_REQUEST['G1']);
        $radios[] = ($_REQUEST['G2'] ==  null?-1:$_REQUEST['G2']);
        $radios[] = ($_REQUEST['G3'] ==  null?-1:$_REQUEST['G3']);

        $radios[] = ($_REQUEST['G4_1'] == "on"?1:0);
        $radios[] = ($_REQUEST['G4_2'] == "on"?1:0);
        $radios[] = ($_REQUEST['G4_3'] == "on"?1:0);
        $radios[] = ($_REQUEST['G4_4'] == "on"?$_REQUEST['G4_OT']:0);//7

        $radios[] = ($_REQUEST['G5_1'] == "on"?1:0);
        $radios[] = ($_REQUEST['G5_2'] == "on"?1:0);
        $radios[] = ($_REQUEST['G5_3'] == "on"?1:0);

        $radios[] = ($_REQUEST['G6_1'] == "on"?1:0);
        $radios[] = ($_REQUEST['G6_2'] == "on"?1:0);
        $radios[] = ($_REQUEST['G6_3'] == "on"?1:0);
        $radios[] = ($_REQUEST['G6_4'] == "on"?1:0);
        $radios[] = ($_REQUEST['G6_5'] == "on"?1:0);
        $radios[] = ($_REQUEST['G6_6'] == "on"?$_REQUEST['G6_OT']:0);//16

        $radios[] = ($_REQUEST['G7_1'] == "on"?1:0);
        $radios[] = ($_REQUEST['G7_2'] == "on"?1:0);
        $radios[] = ($_REQUEST['G7_3'] == "on"?1:0);
        $radios[] = ($_REQUEST['G7_4'] == "on"?1:0);
        $radios[] = ($_REQUEST['G7_5'] == "on"?1:0);
        $radios[] = ($_REQUEST['G7_6'] == "on"?$_REQUEST['G7_OT']:0);//22

        $radios[] = ($_REQUEST['G8_1'] == "on"?1:0);
        $radios[] = ($_REQUEST['G8_2'] == "on"?1:0);
        $radios[] = ($_REQUEST['G8_3'] == "on"?1:0);
        $radios[] = ($_REQUEST['G8_4'] == "on"?1:0);
        $radios[] = ($_REQUEST['G8_5'] == "on"?1:0);
        $radios[] = ($_REQUEST['G8_6'] == "on"?1:0);
        $radios[] = ($_REQUEST['G8_7'] == "on"?$_REQUEST['G8_OT']:0);//29

        $radios[] = ($_REQUEST['G9'] ==  null?-1:$_REQUEST['G9']);
        $radios[] = ($_REQUEST['G9'] ==  null?-1:$_REQUEST['G10']);
        $radios[] = ($_REQUEST['G9'] ==  null?-1:$_REQUEST['G11']);
        $radios[] = ($_REQUEST['G9'] ==  null?-1:$_REQUEST['G12']);
        $radios[] = ($_REQUEST['G9'] ==  null?-1:$_REQUEST['G13']);
        $radios[] = ($_REQUEST['G9'] ==  null?-1:$_REQUEST['G14']);


        $queryChunk = "'$ID'";
        //print_r($radios);
        $counter=1;
        foreach($radios as $rad)
        {
            if($counter == 7 || $counter == 16 || $counter == 22 || $counter == 29)
            {
                $queryChunk .= ",'$rad'";
            }
            else
            {
                $queryChunk .= ",$rad";
            }
            $counter++;
        }
        //echo "<p>Feedback  Query: $queryChunk</p>";
        $query = "INSERT INTO Feedback VALUES($queryChunk);";
        $result = mysql_query($query) or die('Feedback Query failed: ' . mysql_error());
        mysql_free_result($result);
    }
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
    $questions[] = "Seldom feel blue";
    $questions[] = "Am not interested in other people's problems";
    $questions[] = "Carry out my plans";
    $questions[] = "Make friends easily";
    $questions[] = "Am quick to understand things";
    $questions[] = "Get angry easily";
    $questions[] = "Respect authority";
    $questions[] = "Leave my belongings around";
    $questions[] = "Take charge";
    $questions[] = "Enjoy the beauty of nature";
    $questions[] = "Am filled with doubts about things";
    $questions[] = "Feel others' emotions";
    $questions[] = "Waste my time";
    $questions[] = "Am hard to get to know";
    $questions[] = "Have difficulty understanding abstract ideas";
    $questions[] = "Rarely get irritated";
    $questions[] = "Believe that I am better than others";
    $questions[] = "Like order";
    $questions[] = "Have a strong personality";
    $questions[] = "Believe in the importance of art";
    $questions[] = "Feel comfortable with myself";
    $questions[] = "Inquire about others' well-being";
    $questions[] = "Find it difficult to get down to work";
    $questions[] = "Keep others at a distance";
    $questions[] = "Can handle a lot of information";
    $questions[] = "Get upset easily";
    $questions[] = "Hate to seem pushy";
    $questions[] = "Keep things tidy";
    $questions[] = "Lack the talent for influencing people";
    $questions[] = "Love to reflect on things";
    $questions[] = "Feel threatened easily";
    $questions[] = "Can't be bothered with other's needs";
    $questions[] = "Mess things up";
    $questions[] = "Reveal little about myself";
    $questions[] = "Like to solve complex problems";
    $questions[] = "Keep my emotions under control";
    $questions[] = "Take advantage of others";
    $questions[] = "Follow a schedule";
    $questions[] = "Know how to captivate people";
    $questions[] = "Get deeply immersed in music";
    $questions[] = "Rarely feel depressed";
    $questions[] = "Sympathize with others' feelings";
    $questions[] = "Finish what I start";
    $questions[] = "Warm up quickly to others";
    $questions[] = "Avoid philosophical discussions";
    $questions[] = "Change my mood a lot";
    $questions[] = "Avoid imposing my will on others";
    $questions[] = "Am not bothered by messy people";
    $questions[] = "Wait for others to lead the way";
    $questions[] = "Do not like poetry";
    $questions[] = "Worry about things";
    $questions[] = "Am indifferent to the feelings of others";
    $questions[] = "Don't put my mind on the task at hand";
    $questions[] = "Rarely get caught up in the excitement";
    $questions[] = "Avoid difficult reading material";
    $questions[] = "Rarely lose my composure";
    $questions[] = "Rarely put people under pressure";
    $questions[] = "Want everything to be \"just right\"";
    $questions[] = "See myself as a good leader";
    $questions[] = "Seldom notice the emotional aspects of paintings and pictures";
    $questions[] = "Am easily discouraged";
    $questions[] = "Take no time for others";
    $questions[] = "Get things done quickly";
    $questions[] = "Am not a very enthusiastic person";
    $questions[] = "Have a rich vocabulary";
    $questions[] = "Am a person whose moods go up and down easily";
    $questions[] = "Insult people";
    $questions[] = "Am not bothered by disorder";
    $questions[] = "Can talk others into doing things";
    $questions[] = "Need a creative outlet";
    $questions[] = "Am not embarrassed easily";
    $questions[] = "Take an interest in other people's lives";
    $questions[] = "Always know what I am doing";
    $questions[] = "Show my feelings when I'm happy";
    $questions[] = "Think quickly";
    $questions[] = "Am not easily annoyed";
    $questions[] = "Seek conflict";
    $questions[] = "Dislike routine";
    $questions[] = "Hold back my opinions";
    $questions[] = "Seldom get lost in thought";
    $questions[] = "Become overwhelmed by events";
    $questions[] = "Don't have a soft side";
    $questions[] = "Postpone decisions";
    $questions[] = "Have a lot of fun";
    $questions[] = "Learn things slowly";
    $questions[] = "Get easily agitated";
    $questions[] = "Love a good fight";
    $questions[] = "See that rules are observed";
    $questions[] = "Am the first to act";
    $questions[] = "Seldom daydream";
    $questions[] = "Am afraid of many things";
    $questions[] = "Like to do things for others";
    $questions[] = "Am easily distracted";
    $questions[] = "Laugh a lot";
    $questions[] = "Formulate ideas clearly";
    $questions[] = "Can be stirred up easily";
    $questions[] = "Am out for my own personal gain";
    $questions[] = "Want every detail taken care of";
    $questions[] = "Do not have an assertive personality";
    $questions[] = "See beauty in things that others might not notice";
}
?>