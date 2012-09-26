<?php
$password = $_REQUEST['password'];
$ID = $_COOKIE['ID'];

if($ID != null || $password == "tr0janT1de")
{
    //include_once "../../Comparative/Algorithms.php";
    $link = mysql_connect('127.0.0.1', 'rhett', 'tr0janT1de')
        or die('Could not connect: ' . mysql_error());
    mysql_select_db('tidepool') or die('Could not select database');

    $query = "SELECT WorkType FROM SocialMediaUsers WHERE id='$ID';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    mysql_free_result($result);

    $query = "SELECT * FROM WorkTypesNew WHERE id = '".$temp[0]."'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $temp = mysql_fetch_row($result);
    //$personality = $temp[0];
    $title = $temp[1];
    $p1 = "\t\t\t\t\t".$temp[2];
    $p2 = "\t\t\t\t\t".$temp[3];
    $p3 = "\t\t\t\t\t".$temp[4];
    $oneLiner = $temp[5];
    mysql_free_result($result);
    mysql_close($link);
    //drawWorkType();
    if($_REQUEST['PDF'] == "Save")
    {
        savePDF();
    }
    else if($_REQUEST['PDF'] == "Email")
    {
        emailPDF();
    }
    displayPage();
}
else
{
    echo "<h3>Invalid Password</h3>";
}

function drawWorkType()
{
    require('fpdf/fpdf.php');

    global $pdf;

    class PDF extends FPDF
    {
        function Header()
        {
            Global $title;
            // Logo
            $this->Image('images/logo.png',10,6,30);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Calculate width of title and position
            $w = $this->GetStringWidth($title)+6;
            $this->SetX((210-$w)/2);
            // Title
            $this->Cell($w,9,$title,0,1,'C');
            // Line break
            $this->Ln(10);
        }

        function ChapterBody($txt)
        {
            // Times 12
            $this->SetFont('Times','',12);
            // Output justified text
            $this->MultiCell(0,5,$txt);
            // Line break
            $this->Ln();
            // Mention in italics
            $this->SetFont('','I');
        }

        function PrintChapter()
        {
            Global $oneLiner,$p1,$p2,$p3;
            $this->AddPage();
            $this->ChapterBody($oneLiner);
            $this->ChapterBody($p1);
            $this->ChapterBody($p2);
            $this->ChapterBody($p3);
        }
    }

    $pdf = new PDF();
    $pdf->PrintChapter();
}

function emailPDF()
{
    global $ID,$pdf;
    drawWorkType();

    $filename = "MyWorkType$ID.pdf";
    $pdf->Output("PDFS/$filename","F");

    $pdfdoc = $pdf->Output("", "S");
    $attachment = chunk_split(base64_encode($pdfdoc));
    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    $eol = PHP_EOL;
    $to = "rfahrney7@gmail.com";
    //define the subject of the email
    $subject = "Your TidePool Assessment Login";
    //define the message to be sent. Each line should be separated with \n
    $message = "Attached is your WorkType in PDF Format\n";
    //define the headers we want passed. Note that they are separated with \r\n

    // main header (multipart mandatory)
    $headers = "From: support@tidepool.co".$eol;
    $headers .= "MIME-Version: 1.0".$eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol;
    $headers .= "Content-Transfer-Encoding: 7bit".$eol;
    $headers .= "This is a MIME encoded message.".$eol.$eol;

    // message
    $headers .= "--".$separator.$eol;
    $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
    $headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
    $headers .= $message.$eol.$eol;

    // attachment
    $headers .= "--".$separator.$eol;
    $headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
    $headers .= "Content-Transfer-Encoding: base64".$eol;
    $headers .= "Content-Disposition: attachment".$eol.$eol;
    $headers .= $attachment.$eol.$eol;
    $headers .= "--".$separator."--";
    //send the email
    $mail_sent = @mail( $to, $subject, $message, $headers );
    //if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"
    //echo $mail_sent ? "Mail sent" : "Mail failed";
}

function savePDF()
{
    global $ID,$pdf;
    drawWorkType();
    $pdf->Output("MyWorkType.pdf","D");
}

function displayPage()
{
    Global $title, $oneLiner,$p1,$p2,$p3,$ID;
    ?>
<html>
<head>
    <link rel="stylesheet" href="workType.css" />
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

            error_msg.innerHTML="We're not ready to share TidePool on "+type+" just yet, but we're very pleased to know you want to!\nWe'll let you know when we add this feature in the near future.";
            alpha = 1;
            clearTimeout(t2);
            error_msg.style.opacity = alpha;
            t1 = setTimeout("fade()",4500);

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            $.ajax({
                type: "POST",
                url: "http://tidepool.co/assessment/prototype/Posts/PostSocial.php",
                data: "ID=<?echo $ID;?>&choice="+ref,
                success: function() {
                    //alert("<h2>Contact Form Submitted!</h2>");
                }
            });
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

        eg_on = new Image ( );
        eg_off = new Image ( );
        eg_on.src = "../images/continue_hover.png";
        eg_off.src = "../images/continue.png";
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
<title>Work Type</title>

<div align="center">
    <p class="feedbackheader" style="font-size: 36; text-align: center;"><?echo $title?></p>
    <p class="feedback"><?echo $oneLiner;?></p>
    <br>
    <p class="feedback"><?echo $p1;?></p>
    <p class="feedback"><?echo $p2;?></p>
    <p class="feedback"><?echo $p3;?></p>

    <pre class="error_msg"><span id="error_msg"></span></pre>
    <div class="social_container">
        <div class="button_group">
            <p style="float: left; padding-right: 10px;">Is this accurate?</p>
            <a class="button" href="javascript:shareCall(4);" style="float: left;" ><img src="images/thumbsUp_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(4);" style="float: left;" ><img src="images/thumbsDown_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(4);"  ><img src="images/facebook_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(5);" ><img src="images/linkedin_icon.png" alt=""></a>
            <a class="button" href="javascript:shareCall(6);" ><img src="images/twitter_icon.png" alt=""></a>
            <a class="button" href="?PDF=Email" style="padding-right: 20px;"><img src="images/email_icon.png" alt=""></a>
            <a class="button" href="javascript:window.print();" ><img src="images/print_icon.png" alt=""></a>
            <a class="button" href="?PDF=Save"><img src="images/pdf_icon.png" alt=""></a>
        </div>
    </div>
    <a class="link" href="http://tidepool.co/SocialMedia/Home.php">
        <input type="image" class="login" onmouseout="button_off('eg');"
               onmouseover="button_on('eg');"
               src="../images/continue.png" alt="Login" id="eg"">
    </a>
</div>
</body>
</html>
<?
}
?>