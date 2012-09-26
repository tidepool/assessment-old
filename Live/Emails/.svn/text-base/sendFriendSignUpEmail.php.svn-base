<?php
//echo "<p>here 1</p>";
require_once "lib/swift_required.php";
//echo "<p>here 2</p>";

function sendSignUpEmail($email, $name, $friend)
{
    $id = $_COOKIE['ID'];
    $text = "$name";
    $text .= "\n\nGood news. Your friend $friend just got their WorkType on TidePool.";
    $text .= "\n\nLogin in to TidePool.co and connect with $friend to compare your WorkTypes and learn even more about yourselves.";
    $text .= "\n\nThanks,";
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

          KM.identify('$id');
          KM.record('Sign up email')
    </script>
  </head>
  <body>
    <p>$name</p>

    <p>Good news. Your friend $friend just got their WorkType on TidePool.</p>

    <p>Login in to TidePool.co and connect with $friend to compare your WorkTypes and learn even more about yourselves</p>

    <p>Thanks,</p>
    <p>The TidePool Team</p>
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
    $subject = 'Connect with your friend $friend on TidePool';

    //echo "<p>here3</p>";
    // Login credentials
    $username = 'tidepoolAdmin';
    $password = 'T1D3admin';

    // Setup Swift mailer parameters
    $transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
    $transport->setUsername($username);
    $transport->setPassword($password);
    $swift = Swift_Mailer::newInstance($transport);

    // Create a message (subject)
    $message = new Swift_Message($subject);

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