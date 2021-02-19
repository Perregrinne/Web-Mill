<?php 
    header("Content-type: text/css"); 
    include ($_SERVER['DOCUMENT_ROOT']."/php/admin/config.php");

    //This file contains the css used across the website.
?>

body {
    width: 100%;
    height: 100%;
    background-color: #111;
    color: #EFEFEF;
}

#navbar {
    position: absolute;
    width: 100%;
    height: 75px;
    left: 0;
    right: 0;
    background-color: #333;
}

#navbar-logo {
    position: absolute;
    left: 10px;
    top: 10px;
}

#navbar-title {
    position: absolute;
    left: 100px;
    top: 15px;
    font-size: 32px;
}

#navbar-home-link {
    position: absolute;
    left: 25%;
    top: 15px;
    text-decoration: none;
    font-size: 32px;
}

#navbar-admin-link {
    position: absolute;
    left: 55%;
    top: 15px;
    text-decoration: none;
    font-size: 32px;
}

#main-text {
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}

#clock {
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-86px, 64px);
    transform: translate(-86px, 64px);
    font-size: 32px;
}

#footer {
    position: absolute;
    display: inline-block;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 35px;
    background-color: #444;
    text-align: center;
}

#copyright {
    position: relative;
    display: inline-block;
    bottom: -5px;
}

#copyright-text {
    position: relative;
    display: inline-block;
    bottom: 0px;
}

#copyright-year {
    position: relative;
    display: inline-block;
    bottom: 0px;
}

#copyright-name {
    position: relative;
    display: inline-block;
    bottom: 0px;
}

#cookie-banner {
    position: fixed;
    height: 50px;
    width: 100%;
    left: 0;
    bottom: 0;
    z-index: 100;
    text-align: center;
    background-color: #444;
    /*line-height: 50px;*/
}

#cookie-text {
    position: relative;
    top: 10px;
    bottom: 10px;
    height: 30px;
}