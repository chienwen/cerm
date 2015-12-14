<?php

    require('lib.net.curl.php');

    date_default_timezone_set('Asia/Taipei');
    define('PRODUCT_NAME', 'Card Master');
    define('OAUTH_CLIENT_ID', '26397879922-953471b14m9o74mtud6tnli1r5t0ooo5.apps.googleusercontent.com');
    define('OAUTH_REDIRECT_URL', 'http://people.cs.nctu.edu.tw/~chienwen/cm/oauth.php');
    define('OAUTH_SECRET', '');

    session_start();

    $currencyDict = json_decode(file_get_contents('../../prototype/data/currency.json'),true);

    function requireLogin($done, $error = false){
        global $_SESSION;
        if(!isset($_SESSION['login'])){
            /*
            header('Location: ?v=login&d='.$done.($error ? '&e=1' : ''));
            */
            $init_url = 'https://accounts.google.com/o/oauth2/auth?'. http_build_query( array(
                'scope' => 'email profile',
                'response_type' => 'code',
                'redirect_uri' => OAUTH_REDIRECT_URL,
                'access_type' => 'offline',
                'approval_prompt' => 'force',
                'client_id' => OAUTH_CLIENT_ID,
                ));
            header('Location: '.$init_url);
            exit(0);
        }
    }
    function checkLogin($post){
        return false;
    }
