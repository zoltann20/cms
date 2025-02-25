<?php
    session_start();
    // ha létezik sütink
    if (isset($_COOKIE['uid']))
    {
        // meszüntetjük a sütiket
        unset($_COOKIE['uid']); 
        unset($_COOKIE['uname']);
        unset($_COOKIE['umail']);
        unset($_COOKIE['ureg']);
        unset($_COOKIE['ulast']);
        unset($_COOKIE['urights']);

        setcookie('uid', '', time() - 3600, '/'); 
        setcookie('uname', '', time() - 3600, '/'); 
        setcookie('umail', '', time() - 3600, '/');
        setcookie('ureg', '', time() - 3600, '/');
        setcookie('ulast', '', time() - 3600, '/');
        setcookie('urights', '', time() - 3600, '/');
    }
    unset($_SESSION['uID']);
    unset($_SESSION['uname']);
    unset($_SESSION['umail']);
    unset($_SESSION['ureg']);
    unset($_SESSION['ulast']);
    unset($_SESSION['urights']);

    header('location: ../index.php');
?>