<?
$date = date(DATE_RFC822);
setcookie("date", $date, time()+3600,"/", ".tidepool.co"); /* Expires in a day */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Feedback</title>
    <link rel="icon" href="http://tidepool.co/images/LogoHalf.png" type="image/png">
    <link rel="stylesheet" href="style/Feedback.css"/>
    <script type="text/javascript" src="http://tidepool.co/jQuery/jquery.js"></script>
    <script type="text/javascript">
        $(document).submit(
                function(){
                    //alert("You did not answer ");
                    for(var i=1; i<=14; i++)
                    {
                        if (!$('input[name=G'+i+']:checked').length && (i<=3 || i>=9)) {
                            // at least one of the radio buttons was checked
                            //document.getElementById("Q12").focus();
                            $('html, body').animate({
                                scrollTop: $("#Q"+i).offset().top
                            }, 1000);

                            alert("You did not answer question "+i);
                            // no radio button was checked
                            return false; // stop whatever action would normally happen
                        }
                    }
                }
        );

        eg_on = new Image ( );
        eg_off = new Image ( );
        eg_on.src = "images/continue_hover.png";
        eg_off.src = "images/continue.png";
        function button_on ( imgId )
        {
            if ( document.images )
            {
                butOn = eval ( imgId + "_on.src" );
                document.getElementById(imgId).src = butOn;
            }
        }

        function button_off ( imgId )
        {
            if ( document.images )
            {
                butOff = eval ( imgId + "_off.src" );
                document.getElementById(imgId).src = butOff;
            }
        }
    </script>
</head>
<body>

<form name="theForm" action="Personality.php" method="post">
    <h1>Your Feedback:</h1>

    <p id='Q1'>1. Was your feedback Accurate</p>
    <!-- <pre class="bottomspace"><span class="green_left">YES</span> <span class="green_right">NO</span></pre> -->
    <table class="indent">
        <tr align="center">
            <td class="green_left">Yes</td>
            <td></td>
            <td></td>
            <td></td>
            <td class="green_right">No</td>
        </tr>
        <tr align="center">
            <td><input type='radio' name='G1' value='1'></td>
            <td><input type='radio' name='G1' value='2'></td>
            <td><input type='radio' name='G1' value='3'></td>
            <td><input type='radio' name='G1' value='4'></td>
            <td><input type='radio' name='G1' value='5'></td>
        </tr>
        <tr align="center">
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
        </tr>
    </table>


    <p id='Q2'>2. If you were in charge of hiring, would you use this as part of your hiring or team selection?</p>
    <table class="indent">
        <tr align="center">
            <td class="green_left">Yes</td>
            <td class="green_right">No</td>
        </tr>
        <tr align="center">
            <td><input type='radio' name='G2' value='1'></td>
            <td><input type='radio' name='G2' value='0'></td>
        </tr>
    </table>


    <p id='Q3'>3. Would you share your feedback on a social network?</p>
    <table class="indent">
        <tr align="center">
            <td class="green_left">Yes</td>
            <td class="green_right">No</td>
        </tr>
        <td><input type='radio' name='G3' value='1'></td>
        <td><input type='radio' name='G3' value='0'></td>
        </tr>
    </table>


    <p id='Q4'>4. Through which social network would you most likely share your results?</p>
    <div class="indent">
        <div class="inputtext">
            <input type='checkbox' name='G4_1'>Facebook</input>
            <input type='checkbox' name='G4_2'>Twitter</input>
            <input type='checkbox' name='G4_3'>Linkedin</input>
            <input type='checkbox' name='G4_4'>Other (please specify)</input>
            <input type='text' name='G4_OT'>
        </div>
    </div>


    <p id='Q5'>5. Which would you be comfortable sharing (Select all that apply)?</p>
    <div class="inputtext">
        <input type='checkbox' name='G5_1'>Work Type</input>
        <input type='checkbox' name='G5_2'>Description</input>
        <input type='checkbox' name='G5_3'>Feedback</input>
    </div>
    </div>


    <p id='Q6'>6. With whom are you most likely to share this assessment?</p>
    <div class="indent">
        <div class="inputtext">
            <input type='checkbox' name='G6_1'>Family</input>
            <input type='checkbox' name='G6_2'>Friends</input>
            <input type='checkbox' name='G6_3'>Colleagues</input>
            <input type='checkbox' name='G6_4'>Significant Other</input>
            <input type='checkbox' name='G6_5'>Prospective Employers</input><br><br>
            <input type='checkbox' name='G6_6'>Other (please specify)</input>
            <input type='text' name='G6_OT'>
        </div>
    </div>

    <p id='Q7'>7. You would most like to see the profile of:</p>
    <div class="indent">
        <div class="inputtext">
            <input type='checkbox' name='G7_1'>Family</input>
            <input type='checkbox' name='G7_2'>Friends</input>
            <input type='checkbox' name='G7_3'>Colleagues</input>
            <input type='checkbox' name='G7_4'>Significant Other</input>
            <input type='checkbox' name='G7_5'>Prospective Employers</input><br><br>
            <input type='checkbox' name='G7_6'>Other (please specify)</input>
            <input type='text' name='G7_OT'>
        </div>
    </div>


    <p id='Q8'>8. In what social situations would having assessment results be useful?</p>
    <div class="indent">
        <div class="inputtext">
            <input type='checkbox' name='G8_1'>Work groups</input>
            <input type='checkbox' name='G8_2'>Recreational teams, e.g., sports teams</input>
            <input type='checkbox' name='G8_3'>Finding new friends</input><br><br>
            <input type='checkbox' name='G8_4'>Finding professional service providers</input>
            <input type='checkbox' name='G8_5'>Selecting restaurants</input>
            <input type='checkbox' name='G8_6'>Selecting social network feedback</input><br><br>
            <input type='checkbox' name='G8_7'>Other (please specify)</input>
            <input type='text' name='G8_OT'>
        </div>
    </div>

    <p id='Q9'>9. On average, how many co-workers do you interact with each day?</p>
    <div class="indent">
        <div class="inputtext">
            <input type='radio' name='G9' value='1'>1-2</input>
            <input type='radio' name='G9' value='2'>3-5</input>
            <input type='radio' name='G9' value='3'>6-10</input>
            <input type='radio' name='G9' value='4'>11-15</input>
            <input type='radio' name='G9' value='5'>16-20</input>
            <input type='radio' name='G9' value='6'>20+</input>
        </div>
    </div>

    <p id='Q10'>10. How many apps do you have on your phone? </p>
    <div class="indent">
        <div class="inputtext">
            <input type='radio' name='G10' value='1'>0</input>
            <input type='radio' name='G10' value='2'>1-5</input>
            <input type='radio' name='G10' value='3'>6-10</input>
            <input type='radio' name='G10' value='4'>11-20</input>
            <input type='radio' name='G10' value='5'>21+</input>
        </div>
    </div>

    <p id='Q11'>11. On average how much do you pay for an app?</p>
    <div class="indent">
        <div class="inputtext">
            <input type='radio' name='G11' value='1'>0</input>
            <input type='radio' name='G11' value='2'>Less than $1</input>
            <input type='radio' name='G11' value='3'>$1 - $2.99</input>
            <input type='radio' name='G11' value='4'>More than $3.00</input>
        </div>
    </div>

    <p >How well do the following describe your approach to buying new products?</p>
    <div class="indent">
        <p id='Q12'style="font-style: italic;">12. I research and buy for long-term value</p>
        <div class="inputtext">
            <input type='radio' name='G12' value='1'>Not at all</input>
            <input type='radio' name='G12' value='2'>Somewhat</input>
            <input type='radio' name='G12' value='3'>Very well</input>
        </div>
        <p id='Q13'style="font-style: italic;">13. I buy impulsively</p>
        <div class="inputtext">
            <input type='radio' name='G13' value='1'>Not at all</input>
            <input type='radio' name='G13' value='2'>Somewhat</input>
            <input type='radio' name='G13' value='3'>Very well</input>
        </div>

        <p id='Q14'style="font-style: italic;">14. I rely on my friends opinions for what I should buy</p>
        <div class="inputtext">
            <input type='radio' name='G14' value='1'>Not at all</input>
            <input type='radio' name='G14' value='2'>Somewhat</input>
            <input type='radio' name='G14' value='3'>Very well</input>
        </div>
    </div>

    <div align="center">
        <input type="image" class="login" onmouseout="button_off('eg');"
               onmouseover="button_on('eg');"
               src="images/continue.png" alt="Login" id="eg"">
    </div>
</form>
</body>
</html>