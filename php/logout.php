<?php
    session_start();
    if (ini_get("session.use_cookies")) 
    {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 36000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    session_unset();
    session_destroy();

    header('Refresh: 0; URL = /php/login.php');
?>