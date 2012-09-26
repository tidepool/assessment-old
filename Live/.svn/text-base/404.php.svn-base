<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>TidePool</title>

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

    <script src="leanmodal.min.js" type="text/javascript"></script>

    <!-- leanModal - http://leanmodal.finelysliced.com.au/ -->
    <script type="text/javascript">
        $(function() {
            $('a[rel*=leanModal]').leanModal({ top : 150, overlay : 0.4, closeButton: ".modal_close" });
        });
        $(window).resize(function () {
            if(window.innerWidth > 960)
            {
                var num = (window.innerWidth - 560)/2;
                var text = num+"px";
                //alert(text);
                document.getElementById("qPrompt").style.left = text;
            }
        });
		function showTerms(id) {
            var elem = document.getElementById(id);
            elem.height = "200px";// controls size
        }
    </script>
    
</head>

<body>
<div id="wrap">

    <div id="header">
        <div class="logo"><a href="http://tidepool.co/Live/splash.php">TidePool</a></div>
    </div>

    
    <div id="cont">
    	<div class="hdr-spacer"></div>
        
        <div class="post-assess-cont" style="margin-top: 50px;">
        	<div class="icon-404">404</div>
            <div class="txt-404">Oops (404 Error)</div>
            <div class="rl"></div>
            <div class="msg-404">The content you are looking for can't be found.<br /> Please refresh your browser or check your spelling.</div>
        </div>
        
    </div>

</div>
<? include_once "footer.php"; ?>
<script type="text/javascript">
    $('.users .block').bind('mouseenter', function() {
        thisimg = $(this).find('img');
        $(thisimg).attr('oriimg', $(thisimg).attr('src'));
        $(thisimg).attr('src', $(thisimg).attr('datahover'));
    });
    $('.users .block').bind('mouseleave', function() {
        thisimg = $(this).find('img');
        $(thisimg).attr('src', $(thisimg).attr('oriimg'));
    });
</script>

<script type="text/javascript">
    var num = (window.innerWidth - 560)/2;
    var text = num+"px";
    //alert(text);
    document.getElementById("qPrompt").style.left = num+"px";
</script>
</body>
</html>
