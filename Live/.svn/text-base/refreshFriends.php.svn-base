<?php
require_once "../Admin/UniversalLogin.php";
require_once "../Live/dbConnect.php";
if(CheckLogin())
{
    establishConnection();

    if(isset($_REQUEST['id']))
    {
        $ID = $_REQUEST['id'];

        $query = "UPDATE SocialMediaFriends SET Completed=2 WHERE ID1='$ID' or ID2='$ID'";
        $result = mysql_query($query) or die('2 Query failed: ' . mysql_error());
        mysql_free_result($result);
        echo "<p>Worked 2</p>";
    }
    endConnection();
    ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="http://tidepool.co/images/LogoHalf.png" type="image/png">
</head>
<body>
<div class="container" align="center" style="padding: 25px;">
    <form action="" method="post">
        <input type="text" name="id">
        <input type="submit" value="update my Bros">
    </form>hhh
</div>
</body>
</html>
<?
}
?>