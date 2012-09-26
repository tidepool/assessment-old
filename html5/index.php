<?php
    $filename = $_SERVER['SERVER_NAME'];
//echo "<p>Filename: $filename</p>";
    $posWWW = strpos($filename,"www");
    $posStage = strpos($filename,"stage");
if($posWWW === false && $posStage === false)
{
    ?>
<html>
<body>
<script language="JavaScript">
    document.body.innerHTML += '<form id="form" action="https://www.tidepool.co/html5" method="post">';
    document.getElementById("form").submit();
</script>
</body>
</html>
    <?
}
else
{
    require_once "../Live/dbConnect.php";
    establishConnection();

    $query = "SELECT COUNT(ID) FROM DeltaUsers;";
    $result = mysql_query($query) or die('Query1 failed: ' . mysql_error());
    //echo "<p>$result</p>";

    $temp = $_SERVER['HTTP_USER_AGENT'];
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') )
    {
        $browser = "Firefox";
    }
    else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') )
    {
        $browser = "Chrome";
    }
    else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') )
    {
        $browser = "Safari";
    }
    else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'IE') )
    {
        $browser = "IE";
    }
    else
    {
        $browser = "Other";
    }

    $ID = mysql_result($result, 0);
    $ID = $ID + 15100;
    $ID = "TP".$ID;
    $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    if(strlen($IP) < 3)
    {
        $IP = $_SERVER['REMOTE_ADDR'];
    }
    date_default_timezone_set('PDT');
    $date = date("m-j-y");
    $query = "INSERT INTO DeltaUsers VALUES ('$ID', '$date','', '$IP','$browser');";
    $result = mysql_query($query) or die('Query2 failed: ' . mysql_error());
    mysql_free_result($result);

    endConnection();

    setcookie("ID", $ID, time()+3600,"/", ".tidepool.co"); /* Expires in a day */
    ?>
<!doctype html>
<html lang="en">
<head>
	<title>TidePool</title>

	<meta name="viewport" content="width=device-width, initial-scale=0.84, maximum-scale=0.84, user-scalable=0">

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- <link rel="stylesheet" href="css/h5.css"> -->
	<link rel="stylesheet" href="css/style.css" type="text/css">
    <script type="text/javascript">
        var userID = <?echo $ID;?>;
    </script>
</head>
	
<body>
	<div class="clickToContinue"></div>

	<div class="container">
		
		<div class="progressMain">
		<div class="progressBarCon">
			<div class="quadrants">
				<div class="seperator"></div>
				<div class="seperator"></div>
				<div class="seperator"></div>
			</div>
			<div class="progressBar"></div>
			<div class="progressBarCopy">Progress</div>
		</div>
		</div>
		<div class="section">
		</div>
		<div class="sectionCopyContainer"><div class="sectionCopy"></div></div>
	</div>
	
	<script type="text/javascript" src="lib/plugins.js"></script>
	<script type="text/javascript" src="lib/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="lib/spin.min.js"></script>
	<script type="text/javascript" src="lib/underscore-min.js"></script>
	<script type="text/javascript" src="lib/backbone-min.js"></script>
	<script type="text/javascript" src="lib/jquery-ui-1.8.21.custom.min.js"></script>
	<script type="text/javascript" src="lib/jquery.ui.touch.js"></script>
	<script type="text/javascript" src="lib/jquery.imgpreload.min.js"></script>
	<script type="text/javascript" src="lib/jquery.animate-enhanced.min.js"></script>

	<script type="text/javascript" src="js/tracker.js?<? echo rand(0,100);?>"></script>
	<script type="text/javascript" src="js/backbone-objects.js?<? echo rand(0,100);?>"></script>
	<script type="text/javascript" src="js/app.js?<? echo rand(0,100);?>"></script>
</body>
</html>
<?
}
?>
