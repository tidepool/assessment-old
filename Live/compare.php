<?php
    require_once "dbConnect.php";
    echo "at least we can try and connect to db....";

    establishConnection();

    $query = "SELECT * FROM SocialMediaUsers limit 10";
    $result = mysql_query($query);
    $ID = mysql_result($result,1,4);
    mysql_free_result($result);
    echo $ID;

?>

<html>
<head>

</head>
<body>

</body>
</html>