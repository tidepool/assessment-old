<?
Header("content-type: application/x-javascript");
$title = $_COOKIE['WTname'];
?>
var lastnum = 1
var count = 0;
var time = 100;
var names = ["The Advocate","The Algorithmist","The Big Fish","The Bookworm","The Bullet Train","The Calculator",
"The Candy Store","The Chaperone","The Chess Master","The Choreographer","The Clicker","The Connoisseur",
"The Creature of Habit","The Anchor","The Curious Critic","The Detailer","The Different Drummer",
"The Emotional Glue","The Entrepreneur","The Eye of the Storm","The Feeling Organizer","The Floodlight",
"The Free Spirit","The Free Verse Poet","The Ghostwriter","The Go Getter","The Host","The Impulse Planner",
"The Jack of All Trades","The Kiln","The Laser Beam","The Lone Ranger","The Loyalist","The Maverick",
"The Metronome","The Paradox","The Passionate Pursuit","The People Person","The Web Weaver",
"The Pillar of Strength","The Podium Leader","The Power Tool","The Producer","The Ringleader","The Rock",
"The Rushing River","The Scientist","The Soloist","The Standout","The Stickler","The Study Buddy",
"The Super Sleuth","The Synergist","The Trailblazer","The Trendsetter","The Cool Cat",
"The Well-Oiled Machine","The Window Shopper","The Workhorse","True Blue"];
function timeMsg()
{
count=count+1;
time+=75;
var t1;
var t2;
if(count <10)
{
time = 100;
}
else if(count <20)
{
time = 200;
}
else
{
time = 500;
}

if(time <= 400)
{
var str = "square"+lastnum;
var elem = document.getElementById(str);
elem.src = "images/calc_bg.png";
t1 = setTimeout("timeMsg()",time);
var num = Math.floor(Math.random()*60)+1;
str = "square"+num;
elem = document.getElementById(str);
elem.src = "http://s3.amazonaws.com/tidepool_images/Badges/"+names[num]+".png";
lastnum = num;
}
else
{
//alert("going slow");
time = 400;
count = 0;
clearTimeout(t1);
slowMsg()
return;
}
//alert("hello");
}

function slowMsg()
{
count=count+1;
time+=100;

if(time <= 800)
{
var str = "square"+lastnum;
var elem = document.getElementById(str);
elem.src = "images/calc_bg.png";
var num = getDirection();
str = "square"+num;
elem = document.getElementById(str);
elem.src = "http://s3.amazonaws.com/tidepool_images/Badges/"+names[num]+".png";
lastnum = num;
t2 = setTimeout("slowMsg()",time);
}
else
{
var str = "square"+lastnum;
showFinal(str);
clearTimeout(t2);
t1 = setTimeout("showWT()",500);
return;
}
//alert("hello");
}

function showFinal(str)
{
//alert("showing");
var elem = document.getElementById(str);
elem.src = "images/calc_bg.png";
var num = getDirection();
str = "square"+num;
elem = document.getElementById(str);
elem.src = "http://s3.amazonaws.com/tidepool_images/Badges/<?echo $title;?>.png";
}
function showWT()
{
clearTimeout(t1);
document.body.innerHTML += '<form id="form" action="../../Live/post_assessment.php" method="post">';
    document.getElementById("form").submit();
    }

    function getDirection()
    {
    var num = Math.floor(Math.random()*4);
    if(num == 0)//north
    {
    if(lastnum <= 10)
    {
    return getDirection();
    }
    else
    {
    return lastnum-10;
    }
    }
    else if(num == 1)//south
    {
    if(lastnum >= 50)
    {
    return getDirection();
    }
    else
    {
    return lastnum+10;
    }
    }
    else if(num == 2)//west
    {
    if(lastnum %10 == 1)
    {
    return getDirection();
    }
    else
    {
    return lastnum-1;
    }
    }
    else if(num == 3)//east
    {
    if(lastnum %10 == 0)
    {
    return getDirection();
    }
    else
    {
    return lastnum+1;
    }
    }
    else
    {
    alert("Error num: "+lastnum);
    }
 }