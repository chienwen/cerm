<?php

    require('system.inc.php');

    if(empty($_GET['code'])) {
        header('Location: index.php?v=error');
        die();
    }

    $data = curlFetch('https://www.googleapis.com/oauth2/v3/token', array(
        'client_id' => OAUTH_CLIENT_ID,
        'client_secret' => OAUTH_SECRET,
        'code' => $_GET['code'],
        'grant_type' => 'authorization_code',
        'redirect_uri' => OAUTH_REDIRECT_URL,
    ));

    $ret = @json_decode($data, true);

    if(empty($ret['access_token'])){
        header('Location: index.php?v=error');
        die();
    }

    $access_token = $ret['access_token'];

    $data = curlFetch('https://www.googleapis.com/plus/v1/people/me?access_token='.urlencode($access_token));
    
    $ret = @json_decode($data, true);

    $_SESSION['login'] = $ret;

    header('Location: index.php?v=mycards');
