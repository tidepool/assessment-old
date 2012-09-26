<?php

$poolSize = $_REQUEST['pool'];
$file = file_get_contents('./pool.txt', true);
$words = array();
if(!$file)
{
    echo "Error Could Not Read Employee File";
}
else
{
    //echo "<p>";
    //print_r($file);
    //echo "</p>";
    $names = explode("@", $file);
    for($i=0;$i<$poolSize;$i++)
    {
        //echo "<p>$name</p>";
        $pieces = explode(",", $names[$i]);
        $temp['name'] = $pieces[0];
        $temp['letter'] = $pieces[1];
        $words[] = $temp;
    }
}

?>
<html>
<head>
    <script type="text/javascript">
        var old;
        function changeURL(name, letter, index, elm)
        {
            var elem = elm;
            alert(elem);
            old.style.color = "white";
            elem.style.color = "#666666";
            old = elem;
            //alert(name+" "+letter);
            var frm = document.getElementById("ifrm");
            frm.setAttribute('src', 'CalculateIndividual.php?name='+name+'&index='+index+'&letter='+letter+'&pool=<?echo $poolSize?>');
        }

        function changeColor(elm)
        {
            elem.style.color = "white";
            elem = elm;
            elem.style.color = "#2b2c3c";
            alert("Changed");
        }
    </script>
    <link rel="stylesheet" href="../Dashboard/styles/employee_rel.css" />
    <style type="text/css">
    </style>
</head>
<body>
<div id="content" style="float:left;">
    <div id="main">
        <ul id="listofnames">
            <?
            for($i=0;$i<$poolSize;$i++)
            {
                echo "<li><a onclick\"this.style.color = #555555\" class=\"name\" href=\"javascript:changeURL('".$words[$i]['name']."','".$words[$i]['letter']."',".$i.",this);\">".$words[$i]['name']."</a></li>\n";
            }
            ?>
        </ul>
    </div>
    <div id="employeechart">
        <iframe id="ifrm" src="CalculateIndividual.php?name=Rhett&letter=RHE&pool=<?echo $poolSize;?>" width="620" height="530" scrolling="auto">
        </iframe>
    </div>
</div>
</body>
</html>