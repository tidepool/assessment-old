<?php

?>
<!-- saved from url=(0014)about:internet -->
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DimensionCharts</title>
    <script language="JavaScript">

        var jsReady = false;
        function isReady() {
            return jsReady;
        }
        function pageInit() {
            jsReady = true;
            document.forms["form1"].output.value += "\n" + "JavaScript is ready.\n";
        }
        function thisMovie(movieName) {
            if (navigator.appName.indexOf("Microsoft") != -1) {
                return window[movieName];
            } else {
                return document[movieName];
            }
        }
        function sendToActionScript(value) {
            //alert(value);
            alert("Process Results");
            thisMovie("DimensionCharts").sendToActionScript(value);
        }
        function sendToJavaScript(value) {
            document.forms["form1"].output.value += "ActionScript says: " + value + "\n";
        }
    </script>
</head>
<body onload="pageInit();">

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        id="DimensionCharts" width="100%" height="100%"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="DimensionCharts.swf" />
    <param name="quality" value="high" />
    <param name="bgcolor" value="#869ca7" />
    <param name="SCALE" value="exactfit">
    <param name="allowScriptAccess" value="sameDomain" />
    <embed src="DimensionCharts.swf" quality="high"
           width="100%" height="100%" SCALE="exactfit" name="DimensionCharts" align="middle"
           play="true" loop="false" quality="high" allowScriptAccess="sameDomain"
           type="application/x-shockwave-flash"
           pluginspage="http://www.macromedia.com/go/getflashplayer">
    </embed>
</object>
  <script type="text/javascript" language="JavaScript">
         sendToActionScript(<?
    $password = $_REQUEST ['password'];
    if(false)
    {
        echo "<p>error</p>";
    }
    else
    {
        $id = $_REQUEST ['ID'];
        //echo "<h1>ID is: $id</h1>";
        $link = mysql_connect('127.0.0.1', 'rhett', 'f0rgetmen0t')
        or die('Could not connect: ' . mysql_error());
        mysql_select_db('tidepool') or die('Could not select database');

        $xmlString = "'<results>";

        $query = 'SELECT * FROM HollandScoring WHERE id = '.$id ;
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        $values = mysql_fetch_row($result);
        mysql_free_result($result);
        $artistic = $values[0];
        $conventional = $values[1];
        $enterprising = $values[2];
        $investigative = $values[3];
        $realistic = $values[4];
        $social = $values[5];
        $xmlString .= "<holland><artistic>".$artistic."</artistic><conventional>".$conventional."</conventional><enterprising>".$enterprising."</enterprising><investigative>".$investigative."</investigative><realistic>".$realistic."</realistic><social>".$social."</social></holland>";

        $query = 'SELECT * FROM PersonalityScoring WHERE id = '.$id ;
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        $values = mysql_fetch_row($result);
        mysql_free_result($result);
        $conscientiousness = $values[0];
        $agreeableness = $values[1];
        $extroversion = $values[2];
        $neuroticism = $values[3];
        $openness = $values[4];
        $xmlString .= "<personality><conscientiousness>".$conscientiousness."</conscientiousness><agreeableness>".$agreeableness."</agreeableness><extroversion>".$extroversion."</extroversion><neuroticism>".$neuroticism."</neuroticism><openness>".$openness."</openness></personality>";

        $query = 'SELECT * FROM ValuesScoring WHERE id = '.$id ;
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        $values = mysql_fetch_row($result);
        mysql_free_result($result);
        $achievement = $values[0];
        $challenge = $values[1];
        $independence = $values[2];
        $money = $values[3];
        $power = $values[4];
        $recognition = $values[5];
        $service = $values[6];
        $variety = $values[7];
        $xmlString .= "<values><achievement>".$achievement."</achievement><challenge>".$challenge."</challenge><independence>".$independence."</independence><money>".$money."</money><power>".$power."</power><recognition>".$recognition."</recognition><service>".$service."</service><variety>".$variety."</variety></values>";
        $xmlString .= "<attachment><Secure>87</Secure><Anxious>5</Anxious><Dismissive>9</Dismissive><Fearful>25</Fearful></attachment></results>'";
        //$xmlString ="'this is a test'";
        //$xmlString .= "</results>'";
        echo $xmlString;
    }
    ?>);
      </script>
</body>
</html>
<?
?>