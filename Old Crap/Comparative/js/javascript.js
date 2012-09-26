
var frm;
var elem;

function scrollWin(){
    //alert("Scroll")
    $('html,body').animate({
        scrollTop: $("#ifrm").offset().top
    }, 1000);
}

function Update(loc,id)
{
    //alert("Id is: "+id);
    var value = document.getElementById("wt1").value;
    //alert("test value "+value);
    document.body.innerHTML += '<form id="update" action="'+loc+'" method="post"><input type="hidden" name="wt1" value="'+value+'"><input type="hidden" name="ID" value="'+id+'">';
    document.getElementById("update").submit();
}
$().ready(function() {

    function log(event, data, formatted) {
        var begin = formatted.indexOf('@')+1;
        var end = formatted.length;
        var ID = formatted.substring(begin,end);
        var name = formatted.substring(0,begin-2);
        var name = "td"+ID;
        //alert("I am "+name);
        if(elem != null)
        {
            elem.className = "none";
        }
        elem =  document.getElementById(name);
        elem.className = "searched";
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