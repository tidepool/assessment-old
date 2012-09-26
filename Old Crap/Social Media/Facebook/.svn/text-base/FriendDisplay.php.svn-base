<?php


$friends = array();
for($i=0;$i<10;$i++)
{
    $temp = array();
    $temp['name'] = "Name".$i;
    $temp['id'] = $i;
    $friends[] = $temp;
}
$string;

foreach($friends as $friend)
{
    $string .= "{ name: \"".addslashes($friend['name'])."\", ID: ".addslashes($friend['id'])."},";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style type="text/css">
        .name
        {
            padding: 0px;
            color: #000000;
        }
        img
        {
            color = #000000;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title></title>
    <script type='text/javascript' src='../auto_src/jquery.autocomplete.min.js'/>
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
    <!--
    <p>
        <label>Search Friends:</label>
        <input type="text" id="search" />
    </p>
    -->
</div>
<table align="center">
    <?
    $total = count($friends);
    //echo "<p>Total : $total</p>\n";
    $counter =1;
    echo "<tr>\n";
    foreach($friends as $friend)
    {
        echo "<td align='center'>\n";
        echo "<img width='80px' height='80px' id='pic".$counter."' src='".$friend['pic']."'>\n";
        echo "<p id='name".$counter."' class='name'><input id='".$counter."' type='checkbox' onclick='changeColor(this);'>\t".$friend['name']."</p>\n";
        //echo "<input type='checkbox'>";
        echo "</td>\n";
        if($counter % 3 == 0)
        {
            echo "</tr>\n<tr>\n";
        }
        $counter++;
    }
    echo "</tr>";
    ?>
</table>
</body>
</html>