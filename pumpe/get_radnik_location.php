<?php
    if ($_SESSION['role'] === "radnik")
    {
        $getRadnikLocation = "SELECT pumpa FROM radnici WHERE radnik_email = ?;";
    
        $statement = mysqli_stmt_init($conn);
    
        if (mysqli_stmt_prepare($statement, $getRadnikLocation))
        {
            mysqli_stmt_bind_param($statement, "s", $_SESSION['email']);
            mysqli_stmt_execute($statement);
    
            $queryResultGRL = mysqli_stmt_get_result($statement);
            $currentRowGRL = mysqli_fetch_assoc($queryResultGRL);
    
            $radnikLocation = $currentRowGRL['pumpa'];
        }
    }
    else
    {
        $redirect = "https://" . $_SERVER['HTTP_HOST'] . "/peropetrol/";

        header("Location: $redirect");
    }