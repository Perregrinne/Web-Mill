<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/admin/config.php");
if(!isset($_SESSION)) {
    session_start();

    //Show the cookie banner, but not if the user is on an admin page (in which case, $EXCLUDE_MENU is set)
    if(!isset($EXCLUDE_MENU)) {
        include_once ($_SERVER['DOCUMENT_ROOT'] . "/php/cookieBanner.php");
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?= $WEBSITE_TITLE ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--TODO: Keywords and Site Description, which should be customizable-->
    <?php 
        if(isset($_SESSION['USERNAME'])) { //If logged in as admin, load admin controls
            echo '<link rel="stylesheet" href="/php/admin-css.php">';
            include_once ($_SERVER['DOCUMENT_ROOT'] . "/admin.php");
        }
        echo '<link rel="stylesheet" href="' . $CSS . '">';
        //Possibly revisit this if the new one doesn't show up properly:
        //echo '<link rel="shortcut icon" href="' . $FAVICON_FILE . '" type="image/x-icon" >';
    ?>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body id="body" class="nested">