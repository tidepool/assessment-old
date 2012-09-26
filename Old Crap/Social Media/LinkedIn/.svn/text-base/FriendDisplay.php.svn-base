<?php
require_once('linkedin_3.1.1.class.php');

function oauth_session_exists() {
    if((is_array($_SESSION)) && (array_key_exists('oauth', $_SESSION))) {
        return TRUE;
    } else {
        return FALSE;
    }
}

try {
    if(!session_start()) {
        throw new LinkedInException('This script requires session support, which appears to be disabled according to session_start().');
    }

    // display constants
    $API_CONFIG = array(
        'appKey'       => 'bwgphvx02ln2',
        'appSecret'    => 'UAdvY5ASFasYsFnB',
        'callbackUrl'  => 'http://tidepool.co/LinkedIn/demo.php'
    );
    define('CONNECTION_COUNT', 20);
    define('PORT_HTTP', '80');
    define('PORT_HTTP_SSL', '443');
    define('UPDATE_COUNT', 10);


    // check PHP version
    if(version_compare(PHP_VERSION, '5.0.0', '<')) {
        throw new LinkedInException('You must be running version 5.x or greater of PHP to use this library.');
    }

    // check for cURL
    if(extension_loaded('curl'))
    {
        $curl_version = curl_version();
        $curl_version = $curl_version['version'];
    }
    else
    {
        throw new LinkedInException('You must load the cURL extension to use this library.');
    }
    $OBJ_linkedin = new LinkedIn($API_CONFIG);
    $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
    $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
    if($_SESSION['oauth']['linkedin']['authorized'] === TRUE)
    {
        $OBJ_linkedin = new LinkedIn($API_CONFIG);
        $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
        $response = $OBJ_linkedin->connections('~/connections:(id,first-name,last-name,picture-url,industry)?');
        if($response['success'] === TRUE)
        {
            $connections = new SimpleXMLElement($response['linkedin']);
            $friends = array();
            if((int)$connections['total'] > 0)
            {
                foreach($connections->person as $connection)
                {
                    if($connection->{'first-name'} != "private")
                    {
                        $name = $connection->{'first-name'}." ".$connection->{'last-name'};
                        $friends[] = $name;
                        $picURL = "".$connection->{'picture-url'}."";

                        //echo "<p>".$name."</p>";
                        //echo "<p>Pic ".$picURL."</p>";
                        if(strlen($picURL) < 3)
                        {
                            $friends[] = "../images/Anonymous.png";
                            //echo "<p>Anonymous</p>";
                        }
                        else
                        {
                            $friends[] = $picURL;
                            // echo "<p>Actual</p>";
                        }
                        $friends[] = "".$connection->{'id'}."";
                    }
                }
                //print_r($friends);
            }
            else
            {
                // no connections
                echo '<div>You do not have any LinkedIn connections to display.</div>';
            }
            //$friends;
        }
    }
    $total = count($friends);
    $testing = 252;
    //echo "<p>Testing ".($testing/3)." our of $total friends</p>";
    for($i=0;$i<$total;$i+=3)
    {
        $string .= "{ name: \"".addslashes($friends[$i])."\", ID: \"".addslashes($friends[$i+2])."\"},";
    }
}
catch(LinkedInException $e)
{
    // exception raised by library call
    echo $e->getMessage();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style type="text/css">
        .name
        {
            padding: 0px;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title></title>
    <script type="text/javascript" src="../auto_src/jquery.js"></script>
    <script type='text/javascript' src='../auto_src/jquery.autocomplete.min.js'></script>
    <link rel="stylesheet" type="text/css" href="../auto_src/jquery.autocomplete.css" />
    <script type="text/javascript">

        function PostInvite(name,ID)
        {
            var xmlhttp;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    alert(xmlhttp.responseText);
                }
            }
            xmlhttp.open("POST","../auto_src/Sample.php?name="+name+"&ID="+ID,true);
            xmlhttp.send();
        }

        function changeColor(ele) {
            var id = ele.id;
            if(ele.checked)
            {
                document.getElementById("name"+id).style.color = '#00CC00';
            }
            else
            {
                document.getElementById("name"+id).style.color = '#000000';
            }
        }

        var emails = [ <? echo $string; ?>];
        $().ready(function() {

            function log(event, data, formatted) {
                var begin = formatted.indexOf('@')+1;
                var end = formatted.length;
                var ID = formatted.substring(begin,end);
                var name = formatted.substring(0,begin-2);
                //alert(ID);
                PostInvite(name,ID);
                //$("<p>").html( !data ? "No match!" : name).appendTo("#result");
            }

            function formatResult(row) {
                return row[0].replace(/(<.+?>)/gi, '');
            }

            $("#search").autocomplete(emails, {
                minChars: 0,
                width: 310,
                matchContains: "word",
                autoFill: false,
                formatItem: function(row, i, max) {
                    return row.name;
                },
                formatMatch: function(row, i, max) {
                    return row.name + " @" + row.ID;
                },
                formatResult: function(row) {
                    return row.name;
                }
            });

            $(":text, textarea").result(log).next().click(function() {
                $(this).prev().search();
            });
        });
    </script>
</head>

<body>
<div align="center">
    <p>
        <label>Search Friends:</label>
        <input type="text" id="search" />
    </p>
</div>
<table align="center">
    <?
    for($i=0;$i<count($friends);$i+=9)
    {
        echo "<tr>";
        echo "<td align='center'>\n";
        echo "<img width='80px' height='80px' id=\"pic".($i+1)."\" src=\"".$friends[$i+1]."\">\n";
        echo "<p id=\"name".$i."\" class='name'><input id=\"".$i."\" type='checkbox' onclick='changeColor(this);'>\t".$friends[$i]."</p>\n";
        //echo "<input type='checkbox'>";
        echo "</td>\n";
        if($friends[$i+3] != null)
        {
            echo "<td align='center'>";
            echo "<img width='80px' height='80px' id=\"pic".($i+4)."\" src=\"".$friends[$i+4]."\">\n";
            echo "<p id=\"name".($i+3)."\" class='name'><input id=\"".($i+3)."\" type='checkbox' onclick='changeColor(this);'>\t".$friends[$i+3]."</p>\n";
            //echo "<input type='checkbox'>";
            echo "</td>\n";
        }
        if($friends[$i+6] != null)
        {
            echo "<td align='center'>";
            echo "<img width='80px' height='80px' id=\"pic".($i+7)."\" src=\"".$friends[$i+7]."\">\n";
            echo "<p id=\"name".($i+6)."\" class='name'><input id=\"".($i+6)."\" type='checkbox' onclick='changeColor(this);'>\t".$friends[$i+6]."</p>\n";
            //echo "<input type='checkbox'>";
            echo "</td>\n";

        }
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>