<?php
//echo "<p>here 1</p>";
require_once "lib/swift_required.php";
require_once "lib/SmtpApiHeader.php";
include_once "../dbConnect.php";
//echo "<p>here 2</p>";

function sendWelcomeEmail($email, $name, $verifyLink)
{

    /*
    * Create the body of the message (a plain-text and an HTML version).
    * $text is your plain-text email
    * $html is your html version of the email
    * If the reciever is able to view html emails then only the html
    * email will be displayed
    */
    $title = $_COOKIE['WTname'];
    establishConnection();

    $query = sprintf("SELECT worktype_id FROM worktypes WHERE title='%s'",mysql_real_escape_string($title));
    $result = mysql_query($query);
    $code = mysql_result($result,0,0);
    mysql_free_result($result);

    $short = substr($code,0,2);
    $ID = $_COOKIE['ID'];

    $query = sprintf("SELECT * FROM ten_by_one WHERE worktype_id='$short'");
    $result = mysql_query($query);
    $desc = mysql_result($result,0,1);
    mysql_free_result($result);

    endConnection();
    //echo "<p>Title $title Code $short</p>";
    //echo "<p>$desc</p>";

    $text = "Dear $name";
    $text .= "\n\nImagine a career where your relationships help you thrive and succeed because you understand yourself and others. Where being at work is as enjoyable as your free time. Where co-workers aren't obstacles or annoyances, but valuable resources to be cherished. Where communication is clear; person to person. You can do that with TidePool.";
    $text .= "\n\nWelcome to TidePool, an exciting new way to understand yourself and your relationships.";
    $text .= "\n\nPlease visit $verifyLink verify your account.";
    $text .= "\n\nYour WorkType is just the beginning. Here's what you've discovered about you:";
    $text .= "\n\n$title";
    $text .= "\n\n$desc";
    $text .= "\n\nOnce you get more acquainted with your WorkType, you can share and compare your feedback with friends and co-workers. We'll even tell you what to expect when you work together. ";
    $text .= "\n\nShowing up to work is over. Invite your friends, family, co-workers, even your bosses. TidePool helps you bring your whole self to the workplace.";
    $text .= "\n\nThe TidePool Team";

    $html = <<<EOM
<html>
  <head>
      <script type="text/javascript">
          var _kmq = _kmq || [];
          function _kms(u){
            setTimeout(function(){
            var s = document.createElement('script'); var f = document.getElementsByTagName('script')[0]; s.type = 'text/javascript'; s.async = true;
            s.src = u; f.parentNode.insertBefore(s, f);
            }, 1);
          }
          _kms('//i.kissmetrics.com/i.js');_kms('//doug1izaerwt3.cloudfront.net/88905aaa6b33b8385a57a090174e5c7774c9e2c5.1.js');

          KM.identify('$ID');
          KM.record('Sign up email')
    </script>
  </head>
  <body>
    <p>Dear $name,</p>

    <p>Imagine a career where your relationships help you thrive and succeed because you understand yourself and others. Where being at work is as enjoyable as your free time. Where co-workers aren't obstacles or annoyances, but valuable resources to be cherished. Where communication is clear; person to person. You can do that with TidePool.</p>

    <p>Welcome to TidePool, an exciting new way to understand yourself and your relationships.</p>

    <p>Please visit <a href="$verifyLink">$verifyLink</a> to verify your account.</p>

    <p>Your WorkType is just the beginning. Here's what you've discovered about you:</p>

    <p>$title</p>
    
    <p>$desc</p>

    <p>Once you get more acquainted with your WorkType, you can share and compare your feedback with friends and co-workers. We'll even tell you what to expect when you work together.</p>

    <p>Showing up to work is over. Invite your friends, family, co-workers, even your bosses. TidePool helps you bring your whole self to the workplace.</p>

    <p>The TidePool Team</p>
    <br>
    <br>
    <br>
    <br>
    <br>
    <hr>
    <img src="http://trk.kissmetrics.com/e?_k=88905aaa6b33b8385a57a090174e5c7774c9e2c5&_n=Viewed+E-mail&_p=$email&email_variation=Sign+Up"/>
  </body>
</html>
EOM;



    // This is your From email address
    $from = array('info@tidepool.co' => 'TidePool');
    // Email recipients
    $to = array(
        $email
    );
    // Email subject
    $subject = 'Welcome To TidePool';

    //echo "<p>here3</p>";
    // Login credentials
    $username = 'tidepoolAdmin';
    $password = '526n0m0re';

    // Setup Swift mailer parameters
    $transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
    $transport->setUsername($username);
    $transport->setPassword($password);
    $swift = Swift_Mailer::newInstance($transport);

    // Create a message (subject)
    $message = new Swift_Message($subject);

    $hdr = new SmtpApiHeader();
    $hdr->setCategory("NewUser");
    $headers = $message->getHeaders();
    $headers->addTextHeader('X-SMTPAPI', $hdr->asJSON());

    // attach the body of the email
    $message->setFrom($from);
    $message->setBody($html, 'text/html');
    $message->setTo($to);
    $message->addPart($text, 'text/plain');

    // send message
    if ($recipients = $swift->send($message, $failures))
    {
        // This will let us know how many users received this message
        //echo 'Message sent out to '.$recipients.' users';
    }
    // something went wrong =(
    else
    {
        echo "Something went wrong - ";
        print_r($failures);
    }
}

//echo "<p>here 3</p>";
?>