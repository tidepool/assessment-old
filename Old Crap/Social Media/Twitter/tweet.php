<?php

/**
 * Retrieve a list of friends for the authenticating user and then lookup
 * their details using users/lookup.
 *
 * Although this example uses your user token/secret, you can use
 * the user token/secret of any user who has authorised your application.
 *
 * Instructions:
 * 1) If you don't have one already, create a Twitter application on
 *      https://dev.twitter.com/apps
 * 2) From the application details page copy the consumer key and consumer
 *      secret into the place in this code marked with (YOUR_CONSUMER_KEY
 *      and YOUR_CONSUMER_SECRET)
 * 3) From the application details page copy the access token and access token
 *      secret into the place in this code marked with (A_USER_TOKEN
 *      and A_USER_SECRET)
 * 4) Visit this page using your web browser.
 *
 * @author themattharris
 */

define('PAGESIZE', 100);

$tmhOAuth = new tmhOAuth(array('consumer_key'    => 'O6awZZlenHGV7lqycMSQA',
                              'consumer_secret' => 'Lk7YA1NpY7xPxdECqao3TlXFeclhXylqmHZBn6llPpc',
                              'user_token'      => '409480543-bNarFLOAfWovvAFtjlljiqiw7SrnbUnA388zZ7Y',
                              'user_secret'     => 'eiSxvdMSqH4iMt7OoRNlYx550Y7dPvXAiJbDa2qv48',
                              ));

function check_rate_limit($response) {
    $headers = $response['headers'];
    if ($headers['x_ratelimit_remaining'] == 0) :
        $reset = $headers['x_ratelimit_reset'];
        $sleep = time() - $reset;
        echo 'rate limited. reset time is ' . $reset . PHP_EOL;
        echo 'sleeping for ' . $sleep . ' seconds';
        sleep($sleep);
    endif;
}

$cursor = '-1';
$ids = array();

while (true) :
    if ($cursor == '0')
        break;

    $tmhOAuth->request('GET', $tmhOAuth->url('1/friends/ids'), array('cursor' => $cursor));

    // check the rate limit
    check_rate_limit($tmhOAuth->response);

    if ($tmhOAuth->response['code'] == 200)
    {
        $data = json_decode($tmhOAuth->response['response'], true);
        $ids += $data['ids'];
        $cursor = $data['next_cursor_str'];
    }
    else
    {
        echo $tmhOAuth->response['response'];
        break;
    }
endwhile;

// lookup users
$paging = ceil(count($ids) / PAGESIZE);
$users = array();
for ($i=0; $i < $paging ; $i++) {
    $set = array_slice($ids, $i*PAGESIZE, PAGESIZE);

    $tmhOAuth->request('GET', $tmhOAuth->url('1/users/lookup'), array('user_id' => implode(',', $set)));

    // check the rate limit
    check_rate_limit($tmhOAuth->response);

    if ($tmhOAuth->response['code'] == 200) {
        $data = json_decode($tmhOAuth->response['response'], true);
        $users += $data;
    }
    else
    {
        echo $tmhOAuth->response['response'];
        break;
    }

}
//var_dump($users);
//print_r($users[0]);
foreach($users as $user)
{
    echo "<p>".$user['name']."</p>";
}
?>