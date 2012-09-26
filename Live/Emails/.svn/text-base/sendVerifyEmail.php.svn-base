<?php
//echo "<p>here 1</p>";
require_once "lib/swift_required.php";
require_once "lib/SmtpApiHeader.php";
//echo "<p>here 2</p>";

function sendVerifyEmail($email, $name,$verifyLink, $removeLink,$worktype)
{

    $text = "Dear $name,";
    $text .= "\n\nYou just discovered that your WorkType is $worktype. By clicking the link below you will be able to compare WorkTypes with your friends and co-workers";
    $text .= "\n\n$verifyLink";
    $text .= "\n\nThank you for learning more about yourself and your professional relationships with TidePool.";
    $text .= "\n\nSincerly,";
    $text .= "\nThe TidePool Team";
    $text .= "\n\n\n<-->";
    $text .= "\nYou're receiving this email because you signed up for TidePool";
    $text .= "\n\nOur mailing address is:";
    $text .= "\nTidePool";
    $text .= "\n340 Brannan Street";
    $text .= "\nSuite 104";
    $text .= "\nSan Francisco, CA 94107";

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

          KM.record('Password Reset email')
    </script>
  </head>
  <body>
    <p>Dear $name,</p>
    <p>You just discovered that your WorkType is $worktype. By clicking the link below you will be able to compare WorkTypes with your friends and co-workers.</p>
    <p><a href="$verifyLink">$verifyLink</a></p>
    <p>Thank you for learning more about yourself and your professional relationships with TidePool.</p>
    <p>Sincerely,</p>
    <p>The TidePool Team</p>
    <p>--</p>
    <p>You're receiving this email because you signed up for TidePool.</p>
    <p>Our mailing address is:</p>
    <p>TidePool<br>
    340 Brannan Street<br>
    Suite 104<br>
    San Francisco, CA 94107</p>
    <p>Copyright (c) 2012 TidePool. All Rights reserved.</p>
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
    $subject = 'Welcome to TidePool';

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