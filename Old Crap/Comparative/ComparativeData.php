<?php
include_once "../Live/dbConnect.php";

$interestArray = populateInterestArray();
$personalityArray = populatePersonalityArray();
//$personalityWTCodes = populateWTCodes();
$sex1 = "M";
$wt1 = null;
$wt2 = null;
$workType = $personalityWTCodes[$wt1];
$name2 = "Chris";
$sex2 = "M";

function setSexNames($n1,$s1,$n2,$s2)
{
    Global $name1,$sex1,$name2,$sex2;

    $name1 = $n1;
    $sex1 = $s1;
    $name2 = $n2;
    $sex2 = $s2;
}
function getWorkTypeValueString()
{
    Global $codeWorkTypes, $ID;
    $dataString="";
    foreach($codeWorkTypes as $workType)
    {
        if($ID != $workType['num'])
        {
            $dataString .= "{ name: \"".addslashes($workType['name'])."\", ID: \"".addslashes($workType['num'])."\"},";
        }
    }
    $dataString = substr($dataString,0,count($dataString)-2);
    return $dataString;
}

function displayWorktypes()
{
    Global $codeWorkTypes,$wt1,$ID;

    for($i=0;$i<count($codeWorkTypes);$i++)
    {
        $codeWorkTypes[$i]['value'] = getWorkTypeValue($codeWorkTypes[$i]['wt'],$wt1);
    }
    usort($codeWorkTypes, 'compareValues');
    echo "<table cellspacing='2px'><tr>\n";
    $count = 0;
    foreach($codeWorkTypes as $workType)
    {
        if($ID != $workType['num'])
        {
            if($count%6 == 0)
            {
                echo "</tr><tr>\n";
            }
            if($workType['value'] <= 4)
            {//4BB74C
                $color = "#4BB74C";
            }
            else if($workType['value'] <= 6)
            {//FFD700
                $color = "#FFD700";
            }
            else
            {//FF3333
                $color = "#FF3333";
            }
            //echo "<p>Prev: $previous</p>";
            echo "<td class='none' id='td".$workType['num']."' onclick='javascript:changeURL(".$workType['num'].");' style='background-color: $color;'>".$workType['name']."</td>\n";//." -- ".$workType['value'].

            $count++;
        }
    }
    echo "</tr></table>\n";
}

function compareValues($x, $y)
{
    return $x['value'] - $y['value'];
}

function replaceNames($string)
{
    Global $name1, $name2, $sex1, $sex2;
    $string = str_replace("firstname1",$name1,$string);
    $string = str_replace("firstname2",$name2,$string);
    $string = str_replace("Firstname1",$name1,$string);
    $string = str_replace("Firstname2",$name2,$string);

    if($sex1 == "M")
    {
        $string = str_replace("He/She1","He",$string);
        $string = str_replace("he/she1","he",$string);
        $string = str_replace("his/her1","his",$string);
        $string = str_replace("His/Her1","His",$string);
        $string = str_replace("him/her1","him",$string);
        $string = str_replace("Him/Her1","Him",$string);
    }
    else if($sex1 == "F")
    {
        $string = str_replace("He/She1","She",$string);
        $string = str_replace("he/she1","she",$string);
        $string = str_replace("his/her1","her",$string);
        $string = str_replace("His/Her1","Her",$string);
        $string = str_replace("him/her1","her",$string);
        $string = str_replace("Him/Her1","Her",$string);
    }

    if($sex2 == "M")
    {
        $string = str_replace("He/She2","He",$string);
        $string = str_replace("he/she2","he",$string);
        $string = str_replace("his/her2","his",$string);
        $string = str_replace("His/Her2","His",$string);
        $string = str_replace("him/her2","him",$string);
        $string = str_replace("Him/Her2","Him",$string);
    }
    else if($sex2 == "F")
    {
        $string = str_replace("He/She2","She",$string);
        $string = str_replace("he/she2","she",$string);
        $string = str_replace("his/her2","her",$string);
        $string = str_replace("His/Her2","Her",$string);
        $string = str_replace("him/her2","her",$string);
        $string = str_replace("Him/Her2","Her",$string);
    }
    return $string;
}

function getComparativeFeedback($w1,$w2)
{
    Global $p1,$p2,$p3,$b1,$b2, $personalityWTCodes,$wt1,$wt2,$name1,$name2,$codeWorkTypes;

    establishConnection();

    $ID = substr($wt1,0,2).substr($wt2,0,2);
    //echo "<p>$ID</p>";
    $query = "SELECT * FROM ComparativeNew WHERE ID='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    $p1 = replaceNames(mysql_result($result, 0,  1));
    $p2 = replaceNames(mysql_result($result, 0,  2));
    $p3 = replaceNames(mysql_result($result, 0,  3));
    $b1 = array();
    $b1[] = replaceNames(mysql_result($result, 0,  4));
    $b1[] = replaceNames(mysql_result($result, 0,  5));
    $b1[] = replaceNames(mysql_result($result, 0,  6));
    $b1[] = replaceNames(mysql_result($result, 0,  7));
    $b1[] = replaceNames(mysql_result($result, 0,  8));
    $b2 = array();
    $b2[] = replaceNames(mysql_result($result, 0,  9));
    $b2[] = replaceNames(mysql_result($result, 0,  10));
    $b2[] = replaceNames(mysql_result($result, 0,  11));
    $b2[] = replaceNames(mysql_result($result, 0,  12));
    $b2[] = replaceNames(mysql_result($result, 0,  13));

    mysql_free_result($result);
    endConnection();
}

function getWorkTypes($w1,$w2)
{
    Global $personalityWTCodes,$wt1,$wt2,$name1,$name2,$codeWorkTypes;


    $name1 = $codeWorkTypes[$w1]['name'];
    $name2 = $codeWorkTypes[$w2]['name'];

    $wt1 = $personalityWTCodes[$w1];
    $wt2 = $personalityWTCodes[$w2];
}

function getWorkTypesDB($w1,$w2)
{
    Global $sex1,$sex2,$wt1,$wt2,$name1,$name2,$codeWorkTypes;


    $name1 = $codeWorkTypes[$w1]['name'];
    $name2 = $codeWorkTypes[$w2]['name'];
    $sex1 = $codeWorkTypes[$w1]['sex'];
    $sex2 = $codeWorkTypes[$w2]['sex'];

    $wt1 = $codeWorkTypes[$w1]['wt'];
    $wt2 = $codeWorkTypes[$w2]['wt'];


}

function getComparativeFeedbackDB($w1,$w2)
{
    Global $p1,$p2,$p3,$b1,$b2, $wt1,$wt2,$name1,$name2,$codeWorkTypes;

    establishConnection();

    $ID = substr($wt1,0,2).substr($wt2,0,2);
    //echo "<p>$ID</p>";
    $query = "SELECT * FROM ComparativeNew WHERE ID='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    $p1 = replaceNames(mysql_result($result, 0,  1));
    $p2 = replaceNames(mysql_result($result, 0,  2));
    $p3 = replaceNames(mysql_result($result, 0,  3));
    $b1 = array();
    $b1[] = replaceNames(mysql_result($result, 0,  4));
    $b1[] = replaceNames(mysql_result($result, 0,  5));
    $b1[] = replaceNames(mysql_result($result, 0,  6));
    $b1[] = replaceNames(mysql_result($result, 0,  7));
    $b1[] = replaceNames(mysql_result($result, 0,  8));
    $b2 = array();
    $b2[] = replaceNames(mysql_result($result, 0,  9));
    $b2[] = replaceNames(mysql_result($result, 0,  10));
    $b2[] = replaceNames(mysql_result($result, 0,  11));
    $b2[] = replaceNames(mysql_result($result, 0,  12));
    $b2[] = replaceNames(mysql_result($result, 0,  13));

    mysql_free_result($result);
    endConnection();
}

function displayComparativeFeedback()
{
    Global $p1,$p2,$p3,$b1,$b2;

    echo "<div align='center'>\n";
    echo "<h3>Overview</h3>";
    echo "<p class='feedback'>$p1</p>\n";
    echo "<p class='feedback'>$p2</p>\n";
    echo "<br/>";
    echo "<h3>Tips for Success</h3>";
    echo "<p class='feedback'>$p3</p>\n";
    echo "<ul class='list'>\n";
    foreach($b1 as $b)
    {
        if(strlen($b) > 2)
        {
            echo "<li>$b</li>\n";
        }
    }
    echo "</ul>\n";
    echo "<p class='feedback'>And you should try to avoid:</p>\n";
    echo "<ul class='list'>\n";
    foreach($b2 as $b)
    {
        if(strlen($b) > 2)
        {
            echo "<li>$b</li>\n";
        }
    }
    echo "</ul>\n";
    echo "</div>\n";
}

function populateWTCodes()
{
    $temp = array();

    $temp[0] = "HAC";
    $temp[1] = "HCI";
    $temp[2] = "LOS";
    $temp[3] = "LEI";
    $temp[4] = "LOR";
    $temp[5] = "LNI";
    $temp[6] = "LCI";
    $temp[7] = "HEC";
    $temp[8] = "LEE";
    $temp[9] = "HCS";

    $temp[10] = "HOS";
    $temp[11] = "HOI";
    $temp[12] = "LAC";
    $temp[13] = "LNC";
    $temp[14] = "LOI";
    $temp[15] = "HCC";
    $temp[16] = "HOA";
    $temp[17] = "HNS";
    $temp[18] = "HCE";
    $temp[19] = "LNA";

    $temp[20] = "HNC";
    $temp[21] = "LCR";
    $temp[22] = "HAA";
    $temp[23] = "LCA";
    $temp[24] = "LEA";
    $temp[25] = "HAR";
    $temp[26] = "HAS";
    $temp[27] = "LCC";
    $temp[28] = "HOR";
    $temp[29] = "HNA";

    $temp[30] = "HCR";
    $temp[31] = "LAR";
    $temp[32] = "LES";
    $temp[33] = "HOE";
    $temp[34] = "HOC";
    $temp[35] = "LAS";
    $temp[36] = "HNI";
    $temp[37] = "HES";
    $temp[38] = "LCS";
    $temp[39] = "LNS";

    $temp[40] = "LAE";
    $temp[41] = "HNR";
    $temp[42] = "HNE";
    $temp[43] = "HEE";
    $temp[44] = "LOC";
    $temp[45] = "HER";
    $temp[46] = "LAI";
    $temp[47] = "LAA";
    $temp[48] = "LOE";
    $temp[49] = "HCA";

    $temp[50] = "HEI";
    $temp[51] = "HAI";
    $temp[52] = "HEA";
    $temp[53] = "HAE";
    $temp[54] = "LCE";
    $temp[55] = "LNE";
    $temp[56] = "LNR";
    $temp[57] = "LOA";
    $temp[58] = "LER";
    $temp[59] = "LEC";

    return $temp;
}

function getDatabaseData()
{
    Global $ID;
    $names = array();

    establishConnection();

    $query = 'SELECT * FROM Amplify';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        //print_r($line);
        $temp = array();
        $temp['num'] = $line['ID'];
        $temp['name'] = $line['Name'];
        $temp['wtName'] = $line['WorkTypeName'];
        $temp['wt'] = $line['WorkType'];
        $temp['sex'] = $line['Sex'];
        $names[] = $temp;
    }
    mysql_free_result($result);
    endConnection();
    return $names;
}

function populateWorkTypeNames()
{
    Global $personalityWTCodes;

    $temp = array();
    $temp[] = "The Advocate";  //0
    $temp[] = "The Algorithmist";
    $temp[] = "The Big Fish";
    $temp[] = "The Bookworm";
    $temp[] = "The Brass Tacks";

    $temp[] = "The Calculator";    //5
    $temp[] = "The Candy Store";
    $temp[] = "The Chaperone";
    $temp[] = "The Chess Master";
    $temp[] = "The Choreographer";

    $temp[] = "The Clicker";   //10
    $temp[] = "The Connoisseur";
    $temp[] = "The Creature of Habit";
    $temp[] = "The Cucumber";
    $temp[] = "The Curious Critic";

    $temp[] = "The Detailer";  //15
    $temp[] = "The Different Drummer";
    $temp[] = "The Emotional Glue";
    $temp[] = "The Entrepreneur";
    $temp[] = "The Eye of the Storm";

    $temp[] = "The Feeling Organizer"; //20
    $temp[] = "The Floodlight";
    $temp[] = "The Free Spirit";
    $temp[] = "The Free Verse Poet";
    $temp[] = "The Ghostwriter";

    $temp[] = "The Go Getter"; //25
    $temp[] = "The Host";
    $temp[] = "The Impulse Planner";
    $temp[] = "The Jack of All Trades";
    $temp[] = "The Kiln";

    $temp[] = "The Laser Beam";    //30
    $temp[] = "The Lone Ranger";
    $temp[] = "The Loyalist";
    $temp[] = "The Maverick";
    $temp[] = "The Metronome";

    $temp[] = "The Paradox";   //35
    $temp[] = "The Passionate Pursuit";
    $temp[] = "The People Person";
    $temp[] = "The People Prioritizer";
    $temp[] = "The Pillar of Strength";

    $temp[] = "The Podium Leader"; //40
    $temp[] = "The Power Tool";
    $temp[] = "The Producer";
    $temp[] = "The Ringleader";
    $temp[] = "The Rock";

    $temp[] = "The Rushing River"; //45
    $temp[] = "The Scientist";
    $temp[] = "The Soloist";
    $temp[] = "The Standout";
    $temp[] = "The Stickler";

    $temp[] = "The Study Buddy";   //50
    $temp[] = "The Super Sleuth";
    $temp[] = "The Synergist";
    $temp[] = "The Trailblazer";
    $temp[] = "The Trendsetter";

    $temp[] = "The Unflappable";   //55
    $temp[] = "The Well-Oiled Machine";
    $temp[] = "The Window Shopper";
    $temp[] = "The Workhorse";
    $temp[] = "True Blue";

    $names = array();
    $i=0;

    foreach($temp as $t)
    {
        $names[$i]['name'] = $t;
        $names[$i]['wt'] = $personalityWTCodes[$i];
        $names[$i]['num'] = $i;
        $i++;
    }
    return $names;
}

function getWorkTypeValue($typeA, $typeB)
{
    $persA = substr($typeA,0,2);
    $persB = substr($typeB,0,2);

    $intA = substr($typeA,2);
    $intB = substr($typeB,2);
    return getInterestValue($intA,$intB) + getPersonalityValue($persA,$persB);
}

function getInterestValue($typeA, $typeB)
{
    Global $interestArray;
    return $interestArray[$typeA][$typeB];
}

function getPersonalityValue($typeA, $typeB)
{
    Global $personalityArray;
    return $personalityArray[$typeA][$typeB];
}

function populatePersonalityArray()
{
    $temp = array();
    //HC
    $temp['HC'] = array();
    $temp['HC']['HC'] = 2;
    $temp['HC']['LC'] = 4;
    $temp['HC']['HE'] = 4;
    $temp['HC']['LE'] = 3;
    $temp['HC']['HA'] = 3;
    $temp['HC']['LA'] = 4;
    $temp['HC']['HN'] = 5;
    $temp['HC']['LN'] = 2;
    $temp['HC']['HO'] = 4;
    $temp['HC']['LO'] = 4;
    //LC
    $temp['LC'] = array();
    $temp['LC']['HC'] = 4;
    $temp['LC']['LC'] = 1;
    $temp['LC']['HE'] = 3;
    $temp['LC']['LE'] = 3;
    $temp['LC']['HA'] = 3;
    $temp['LC']['LA'] = 4;
    $temp['LC']['HN'] = 3;
    $temp['LC']['LN'] = 2;
    $temp['LC']['HO'] = 2;
    $temp['LC']['LO'] = 4;
    //HE
    $temp['HE'] = array();
    $temp['HE']['HC'] = 4;
    $temp['HE']['LC'] = 3;
    $temp['HE']['HE'] = 2;
    $temp['HE']['LE'] = 3;
    $temp['HE']['HA'] = 1;
    $temp['HE']['LA'] = 4;
    $temp['HE']['HN'] = 4;
    $temp['HE']['LN'] = 2;
    $temp['HE']['HO'] = 2;
    $temp['HE']['LO'] = 4;
    //LE
    $temp['LE'] = array();
    $temp['LE']['HC'] = 3;
    $temp['LE']['LC'] = 3;
    $temp['LE']['HE'] = 3;
    $temp['LE']['LE'] = 1;
    $temp['LE']['HA'] = 2;
    $temp['LE']['LA'] = 2;
    $temp['LE']['HN'] = 5;
    $temp['LE']['LN'] = 2;
    $temp['LE']['HO'] = 2;
    $temp['LE']['LO'] = 3;
    //HA
    $temp['HA'] = array();
    $temp['HA']['HC'] = 3;
    $temp['HA']['LC'] = 3;
    $temp['HA']['HE'] = 1;
    $temp['HA']['LE'] = 2;
    $temp['HA']['HA'] = 1;
    $temp['HA']['LA'] = 2;
    $temp['HA']['HN'] = 3;
    $temp['HA']['LN'] = 1;
    $temp['HA']['HO'] = 1;
    $temp['HA']['LO'] = 3;
    //LA
    $temp['LA'] = array();
    $temp['LA']['HC'] = 4;
    $temp['LA']['LC'] = 4;
    $temp['LA']['HE'] = 4;
    $temp['LA']['LE'] = 2;
    $temp['LA']['HA'] = 2;
    $temp['LA']['LA'] = 3;
    $temp['LA']['HN'] = 5;
    $temp['LA']['LN'] = 2;
    $temp['LA']['HO'] = 2;
    $temp['LA']['LO'] = 4;
    //HN
    $temp['HN'] = array();
    $temp['HN']['HC'] = 5;
    $temp['HN']['LC'] = 3;
    $temp['HN']['HE'] = 4;
    $temp['HN']['LE'] = 5;
    $temp['HN']['HA'] = 3;
    $temp['HN']['LA'] = 5;
    $temp['HN']['HN'] = 4;
    $temp['HN']['LN'] = 5;
    $temp['HN']['HO'] = 3;
    $temp['HN']['LO'] = 5;
    //LN
    $temp['LN'] = array();
    $temp['LN']['HC'] = 2;
    $temp['LN']['LC'] = 2;
    $temp['LN']['HE'] = 2;
    $temp['LN']['LE'] = 2;
    $temp['LN']['HA'] = 1;
    $temp['LN']['LA'] = 2;
    $temp['LN']['HN'] = 5;
    $temp['LN']['LN'] = 1;
    $temp['LN']['HO'] = 2;
    $temp['LN']['LO'] = 3;
    //HO
    $temp['HO'] = array();
    $temp['HO']['HC'] = 4;
    $temp['HO']['LC'] = 2;
    $temp['HO']['HE'] = 2;
    $temp['HO']['LE'] = 2;
    $temp['HO']['HA'] = 1;
    $temp['HO']['LA'] = 2;
    $temp['HO']['HN'] = 3;
    $temp['HO']['LN'] = 2;
    $temp['HO']['HO'] = 1;
    $temp['HO']['LO'] = 3;
    //LO
    $temp['LO'] = array();
    $temp['LO']['HC'] = 4;
    $temp['LO']['LC'] = 4;
    $temp['LO']['HE'] = 4;
    $temp['LO']['LE'] = 3;
    $temp['LO']['HA'] = 3;
    $temp['LO']['LA'] = 4;
    $temp['LO']['HN'] = 5;
    $temp['LO']['LN'] = 3;
    $temp['LO']['HO'] = 3;
    $temp['LO']['LO'] = 4;

    return $temp;
}

function populateInterestArray()
{
    $temp = array();
    //artistic
    $temp['A'] = array();
    $temp['A']['A'] = 1;
    $temp['A']['C'] = 2;
    $temp['A']['E'] = 3;
    $temp['A']['S'] = 4;
    $temp['A']['R'] = 3;
    $temp['A']['I'] = 2;
    //Conventional
    $temp['C'] = array();
    $temp['C']['A'] = 2;
    $temp['C']['C'] = 1;
    $temp['C']['E'] = 2;
    $temp['C']['S'] = 3;
    $temp['C']['R'] = 4;
    $temp['C']['I'] = 3;
    //Enterprising
    $temp['E'] = array();
    $temp['E']['A'] = 3;
    $temp['E']['C'] = 2;
    $temp['E']['E'] = 1;
    $temp['E']['S'] = 2;
    $temp['E']['R'] = 3;
    $temp['E']['I'] = 4;
    //Social
    $temp['S'] = array();
    $temp['S']['A'] = 4;
    $temp['S']['C'] = 3;
    $temp['S']['E'] = 2;
    $temp['S']['S'] = 1;
    $temp['S']['R'] = 2;
    $temp['S']['I'] = 3;
    //Realistic
    $temp['R'] = array();
    $temp['R']['A'] = 3;
    $temp['R']['C'] = 4;
    $temp['R']['E'] = 3;
    $temp['R']['S'] = 2;
    $temp['R']['R'] = 1;
    $temp['R']['I'] = 2;
    //Investigative
    $temp['I'] = array();
    $temp['I']['A'] = 2;
    $temp['I']['C'] = 3;
    $temp['I']['E'] = 4;
    $temp['I']['S'] = 3;
    $temp['I']['R'] = 2;
    $temp['I']['I'] = 1;

    return $temp;
}

?>