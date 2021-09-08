<?php
    session_start();

    if (isset($_SESSION['role']))
    {
        session_unset();
        
        /*
        unset($_SESSION['role']);
        unset($_SESSION['email']);
        */
    
        session_destroy();
    
        header("Location: ../index.php?lo=OK");
    }
    else
    {
        $redirect = "https://" . $_SERVER['HTTP_HOST'] . "/peropetrol/";

        header("Location: $redirect");
    }