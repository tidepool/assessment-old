<?php
//echo "<p>here 1</p>";
require_once "lib/swift_required.php";
require_once "lib/SmtpApiHeader.php";
//echo "<p>here 2</p>";

function resetPassword($email, $name, $link)
{

    $text = "$name,";
    $text .= "\n\nPlease visit $link to reset your TidePool password.";
    $text .= "\n\nIf you do not wish to change your TidePool password please ignore this email.";
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
          KM.record('Password Reset email')
    </script>
  </head>
  <body>
    <p>$name,</p>

    <p>Please visit <a href="$link">$link</a> to reset your password.</p>

    <p>If you do not wish to change your TidePool password please ignore this email.</p>

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
    $subject = 'Request to reset your Tidepool Password';

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