
<html>
<head>
    <?
    $agent = getenv("HTTP_USER_AGENT");
    if (preg_match("/MSIE/i", $agent))
    {
        ?>
        <link rel="stylesheet" href="workTypeIE.css" />
        <?
    }
    else
    {
        ?>
        <link rel="stylesheet" href="workType.css" />
        <?
    }
    ?>
    <script type="text/javascript" src="http://tidepool.co/jQuery/jquery.js"></script>
    <script type="text/javascript">
        var t1;
        var t2;
        var alpha;
        function shareCall(ref)
        {
            var type;
            alpha = 1;
            if(ref==1)
                type="Facebook";
            else if(ref==2)
                type="LinkedIn";
            else if(ref==3)
                type="Twitter";
            else if(ref==4)
                type="Facebook";
            else if(ref==5)
                type="LinkedIn";
            else if(ref==6)
                type="Twitter";

            error_msg.innerHTML="We're not ready to share TidePool on "+type+" just yet, but we're very pleased to know want to!<br>We'll let you know when we add this feature in the near future.";
            alpha = 1;
            clearTimeout(t2);
            error_msg.style.opacity = alpha;t1 = setTimeout("fade()",4500);

        }

        function fade()
        {
            if(alpha < 0)
            {
                clearTimeout(t2);
                return;
            }
            else
            {
                clearTimeout(t1);
                error_msg.style.opacity = alpha;
                alpha -= 0.05;
                t2 = setTimeout("fade()",100);
            }
        }

    </script>
</head>
<body>
<title>Work Type</title>

<div align="center">
    <p class="feedbackheader" style="font-size: 36; text-align: center;">The Window Shopper</p>
    <p class="feedback">You bring an artistic sensibility to your work.  You appreciate beauty, and you enjoy interesting and unusual people and objects.  What makes all of this particularly interesting is that for the most part, you seem to prefer what's familiar over what's novel.  In other words, rather than exploring a new or alternative idea or approach to a situation, you're more likely to rely on what you've already found to be true.
    </p>
    <p class="feedback">There's nothing wrong with this "tried and true" approach to your work.  But it's unusual that you'd so be so steadfast in your commitment to your own ideals and opinions, and still feel so inclined towards art and creativity.

    </p>
    <p class="feedback">Do you see ways that your creative and imaginative approach to your work might be enhanced by a bit more openness when it comes to new ideas and unconventional approaches to a given problem?  We're not saying you need to change your down-to-earth way of doing things; just that you might discover that you can be even more true to who you are if you let yourself color outside the lines from time to time.
    </p>

    <pre class="error_msg"><span id="error_msg"></span></pre>
    <div class="social_container">
        <p class="titleLeft">Share your <B>Results</B></p>
        <p class="titleRight">Share the <B>Test</B></p>
        <div class="button_groupL">
            <a class="button" href="javascript:shareCall(1);" ><img src="images/facebook_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(2);" ><img src="images/linkedin_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(3);" ><img src="images/twitter_icon.png" alt=""></a>
        </div>
        <div class="button_groupR">
            <a class="button" href="javascript:shareCall(4);" ><img src="images/facebook_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(5);" ><img src="images/linkedin_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(6);" ><img src="images/twitter_icon.png" alt=""></a>
        </div>
    </div>
    <div class="link_div">
        <a class="link" href="../Feedback.php">Continue</a>
    </div>
</div>
</body>
</html>