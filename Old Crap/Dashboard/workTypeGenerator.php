<?php
$workTypes;
$titles;
$desc;
function populateWorkTypes($amt)
{
    Global $workTypes;

    $file = file_get_contents('./poolBoth.txt', true);
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
        //$people = array();
        if($amt > 100)
        {
            $amt = 100;
        }
        for($i=0;$i<$amt;$i++)
        {
            //echo "<p>$name</p>";
            $pieces = explode(",", $names[$i]);
            $name = $pieces[0];
            $str = $pieces[1];
            array_push($workTypes[$str],$name);
        }
        foreach($workTypes as &$type)
        {
            $num =number_format((((count($type)-3)/$amt)*100), 2, '.', ' ');;
            $type['percent'] = $num;
            //print_r($type);
            //echo "<p>$num</p>";
        }
        //print_r($workTypes);
    }
    array_multisort($workTypes,SORT_DESC);
}

function getWorkTypes($num)
{
    Global $workTypes;
    createWorkTypeArray();
    populateWorkTypes($num);
    return $workTypes;
}

function getTypeInfo($type)
{
    Global $workTypes;
    return $workTypes[$type];
}

function createWorkTypeArray()
{
    Global $workTypes, $titles, $desc;
    createTitles();
    $count=0;
    for($i=1;$i<=6;$i++)
    {
        for($j=1;$j<=10;$j++)
        {
            $str = getLetterInterest($i).getLetterPersonality($j);
            //echo "<p>$str</p>";
            $workTypes[$str] = array();
            $workTypes[$str]['name'] = $str;
            $workTypes[$str]['title'] = $titles[$count];
            $workTypes[$str]['desc'] = $desc[$count];
            $count++;
        }
    }
}

function getLetterInterest($let)
{
    if($let == 1)
    {
        return "R";
    }
    else if($let == 2)
    {
        return "I";
    }
    else if($let == 3)
    {
        return "A";
    }
    else if($let == 4)
    {
        return "S";
    }
    else if($let == 5)
    {
        return "E";
    }
    else if($let == 6)
    {
        return "C";
    }
    else
    {
        return "X";
    }
}
function getLetterPersonality($let)
{
    if($let == 1)
    {
        return "HE";
    }
    else if($let == 2)
    {
        return "LE";
    }
    else if($let == 3)
    {
        return "HO";
    }
    else if($let == 4)
    {
        return "LO";
    }
    else if($let == 5)
    {
        return "HA";
    }
    else if($let == 6)
    {
        return "LA";
    }
    else if($let == 7)
    {
        return "HC";
    }
    else if($let == 8)
    {
        return "LC";
    }
    else if($let == 9)
    {
        return "HN";
    }
    else if($let == 10)
    {
        return "LN";
    }
    else
    {
        return "XX";
    }
}


function createTitles()
{
    Global $titles, $desc;

    $titles = array();
    array_push($titles,"The Rushing River","The Workhorse","The Jack of All Trades","The Brass Tacks","The Go Getter");
    array_push($titles,"The Lone Ranger","The Laser Beam","The Floodlight","The Power Tool","The Well-Oiled Machine");
    array_push($titles,"The Study Buddy","The Bookworm","The Buffet Brain","The Curious Critic","The Super Sleuth");
    array_push($titles,"The Scientist","The Algorithmist","The Candy Store","The Passionate Pursuit","The Calculator");
    array_push($titles,"The Synergist","The Ghostwriter","The Different Drummer","The Window Shopper","The Free Spirit");
    array_push($titles,"The Soloist","The Stickler","The Free Verse Poet","The Kiln","The Eye of the Storm");
    array_push($titles,"The People Person","The Loyalist","The Clicker","The Big Fish","The Life of the Party");
    array_push($titles,"The Paradox","The Choreographer","The People Prioritizer","The Emotional Glue","The Pillar of Strength");
    array_push($titles,"The Ringleader","The Chess Master","The Maverick","The Standout","The Trailblazer");
    array_push($titles,"The Podium Leader","The Entrepreneur","The Trendsetter","The Producer","The Unflappable ");
    array_push($titles,"The Chaperone","Old Faithful","The Structured Poet","The Rock","The Right Hand Person");
    array_push($titles,"The Creature of Habit","The Detailer","The Impulse Planner","The Feeling Organizer","The Cucumber");

    $desc = array();
    array_push($desc,"The Rushing River brings charisma, spontaneity, and leadership through energetic action.");
    array_push($desc,"The Workhorse brings independence, action, and autonomy along with an action-oriented approach.");
    array_push($desc,"The Jack of All Trades invents and implements original solutions to complex problems through immediate action.");
    array_push($desc,"The Brass Tacks relies on experience, persistence, and proven methods to tackle problems directly and immediately.");
    array_push($desc,"The Go Getter brings sociability, collaboration, and a pursuit of results together for immediate action.");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");

    array_push($desc,"The Study Buddy combines a mastery of analytical logic and sociability to lead any team to success.");
    array_push($desc,"The Bookworm brings analytical reasoning and deliberate action along with an effective lone-wolf mindset.");
    array_push($desc,"The Buffet Brain analyzes and solves complex problems with a combination of curiosity, organization, and inventiveness.");
    array_push($desc,"The Super Sleuth provides independent and analytical research skills that  establish a foundation for a team's success.");
    array_push($desc,"The Curious Critic examines problems with an analytical curiosity before solving them with proven methods.");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");

    array_push($desc,"The Synergist contributes imagination, originality and spirit along with a passionate and artistic perspective.");
    array_push($desc,"The Ghostwriter brings imagination, creativity, and independence through intensive self-guidance.");
    array_push($desc,"The Different Drummer spearheads alternative paths to success using sheer creativity and imagination.");
    array_push($desc,"The Window Shopper always examines new approaches to problems, but usually sticks with the reliable and proven methods.");
    array_push($desc,"The Free Spirit brings enthusiasm, creativity, and sociability through an artistic perspective.");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");

    array_push($desc,"The People Person always radiates enthusiasm, energy and leadership through sociability.");
    array_push($desc,"The Loyalist transforms haphazard groups into tight-knit teams through low-key sociability.");
    array_push($desc,"The Clicker uses experimental techniques, curiosity, and an inventive sense of sociability to bring teams together.");
    array_push($desc,"The Big Fish tackles and unravels problems with a combination of consistency, routine, and sociability.");
    array_push($desc,"The Life of the Party can easily form friendly relationships and unite teams with an attitude of optimism and trust.");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");

    array_push($desc,"The Ringleader brings organization, management, and leadership together along with a big-picture perspective.");
    array_push($desc,"The Chess Master brings confidence, vision, and effective communication to inspire and lead teams to success.");
    array_push($desc,"The Maverick brings energy, leadership, and imaginative approaches through enthusiastic action.");
    array_push($desc,"The Standout brings confidence, persuasiveness, and leadership through dependibility.");
    array_push($desc,"The Trialblazer brings optimism, leadership, and cooperation together with a big-picture perspective.");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");

    array_push($desc,"The Chaperone contributes routine, order, and deliberate leadership following a by-the-book mindset.");
    array_push($desc,"Old Faithful brings deliberate order, routine, and support through dependable reliability.");
    array_push($desc,"The Structured Poet has the imagination and drive to implement time-tested solutions to unconventional problems.");
    array_push($desc,"The Rock relies on an analytical mindset, persistence and traditional strategies to get any job done. ");
    array_push($desc,"The Right Hand Person brings reliability, cooperation, and teamwork to the table and can help any team reach success.");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
    array_push($desc,"Description_Coming");
}
?>