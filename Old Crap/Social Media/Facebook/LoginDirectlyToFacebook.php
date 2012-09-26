<?php
require 'facebook.php';

$facebook = new Facebook(array(
                              'appId'  => '168192369908415',
                              'secret' => '4e565efa44f61abcf1b7a5c9cb8d8765',
                         ));

$user = $facebook->getUser();
if ($user) {
    try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
        //print_r($user_profile);
        $type = "facebook";
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
}
?>
<html>
<head>
    <title>Facebook Test</title>
</head>
<body>
<br/>
<?php if ($user): ?>
<script language="JavaScript">
    document.body.innerHTML += '<form id="form" action="http://tidepool.co/Delta/Loading/Loading.php" method="post"><input type="hidden" name="ID" value="<? echo $user_profile['id']?>"/><input type="hidden" name="type" value="<? echo $type ?>"/><input type="hidden" name="password" value="d3mo"/>';
    document.getElementById("form").submit();
</script>
    <?php else: ?>
<div>
    <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
</div>
    <?php endif ?>
</body>
</html>
