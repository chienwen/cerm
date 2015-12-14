<?php

    require('system.inc.php');

    $_SESSION['login'] = false;
    unset($_SESSION['login']);

    header('Location: index.php?v=dashboard');
