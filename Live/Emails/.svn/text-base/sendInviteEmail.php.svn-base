<?php
//echo "<p>here 1</p>";
require_once "lib/swift_required.php";
require_once "lib/SmtpApiHeader.php";
//echo "<p>here 2</p>";

function sendInviteEmail($email, $name, $friend)
{
    $text = "$friend,";

    $text .= "\n\n$name would like to invite you to discover your WorkType.";
    $text .= "\n\nThanks,";
    $text .= "\n\nThe TidePool Team";

    $html = <<<EOM
<html>
  <head></head>
  <body>
    <p>$friend,</p>

    <p>$name would like to invite you to discover your WorkType.</p>

    <p>Thanks,</p>
    <p>The TidePool Team</p>
    <br>
    <br>
    <br>
    <br>
    <br>
    <hr>
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
    $subject = "$name wants you to join TidePool";

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
    $hdr->setCategory("ConnectAccept");
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