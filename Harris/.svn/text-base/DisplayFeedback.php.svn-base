<?php
require_once "CalculateFeedback.php";
calculateFeedback();
?>
<html>
<head>
    <style type="text/css">
        pre{
            font-family: arial;
            font-size: 14px;
        }
        body{
            background-color: #EEEEEE
        }
    </style>
</head>
<body>
<h1>FeedBack</h1>
<h2>Out of <?echo $totCompletes;?> People</h2>
<h3>1. Was your feedback Accurate (1-Yes 5-No)</h3>
<? echo "<pre>".$averages[0]."</pre>"; ?>
<h3>2. If you were in charge of hiring, would you use this as part of your hiring or team selection?</h3>
<? echo "<pre>".$averages[1]."</pre>"; ?>
<h3>3. Would you share your feedback on a social network?</h3>
<? echo "<pre>".$averages[2]."</pre>"; ?>
<h3>4. Through which social network would you most likely share your results?</h3>
<? echo "<pre>Facebook: ".$averages[3]."\t\t Twitter: ".$averages[4]."\t\t Linkedin: ".$averages[5]."</pre>"; ?>
<? echo "<pre>Others:";
foreach($others1 as $other)
{
    echo " $other,";
}
echo "</pre>"; ?>
<h3>5. Which would you be comfortable sharing (Select all that apply)?</h3>
<? echo "<pre>Work Type: ".$averages[6]."\t\t Description : ".$averages[7]."\t\t Feedback: ".$averages[8]."</pre>"; ?>
<h3>6. With whom are you most likely to share this assessment?</h3>
<? echo "<pre>Family: ".$averages[9]."\t\t Friends: ".$averages[10]."\t\t Colleagues: ".$averages[11]."\t\t Significant Other: ".$averages[12]."\t\t Prospective Employers: ".$averages[13]."</pre>"; ?>
<? echo "<pre>Others:";
foreach($others2 as $other)
{
    echo " $other,";
}
echo "</pre>"; ?>
<h3>7. You would most like to see the profile of:</h3>
<? echo "<pre>Family: ".$averages[14]."\t\t Friends: ".$averages[15]."\t\t Colleagues: ".$averages[16]."\t\t Significant Other: ".$averages[17]."\t\t Prospective Employers: ".$averages[18]."</pre>"; ?>
<? echo "<pre>Others:";
foreach($others3 as $other)
{
    echo " $other,";
}
echo "</pre>"; ?>
<h3>8. In what social situations would having assessment results be useful?</h3>
<? echo "<pre>Groups: ".$averages[19]."\t\t Teams: ".$averages[20]."\t\t Friends: ".$averages[21]."\t\t Professional: ".$averages[22]."\t\t Restaurants ".$averages[23]."\t\t Social ".$averages[24]."</pre>"; ?>
<? echo "<pre>Others:";
foreach($others4 as $other)
{
    echo " $other,";
}
echo "</pre>"; ?>
<h3>9. On average, how many co-workers do you interact with each day? 1(1-2) 2(3-5) 3(6-10) 4(10-15) 5(16-20) 6(20+)</h3>
<? echo "<pre>".$averages[25]."</pre>"; ?>
</body>
</html>