var lastnum = 1
var count = 0;
var time = 100;
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
        elem.style.backgroundImage = "url('images/background3.png')";
        t1 = setTimeout("timeMsg()",time);
        var num = Math.floor(Math.random()*60)+1;
        str = "square"+num;
        elem = document.getElementById(str);
        elem.style.backgroundImage = "url('images/background4.png')";
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
        elem.style.backgroundImage = "url('images/background3.png')";
        var num = getDirection();
        str = "square"+num;
        elem = document.getElementById(str);
        elem.style.backgroundImage = "url('images/background4.png')";
        lastnum = num;
        t2 = setTimeout("slowMsg()",time);
    }
    else
    {
        //alert("Done");
        clearTimeout(t1);
        return;
    }
    //alert("hello");
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