<?php 
    header("Content-type: text/css"); 
    include ($_SERVER['DOCUMENT_ROOT']."/php/admin/config.php");

    //This file contains the css used across the website.

    //TODO: Make default-css.php be for development and make default.css be for production (should be minified).
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
    padding: 0 10%;
    background-color: rgba(0,0,0,0.8);
}

#navbar-logo {
    position: absolute;
    left: 10%;
    top: 5px;
}

#navbar-title {
    position: absolute;
    left: 15%;
    top: 15px;
    font-size: 32px;
}

#navbar-home-link {
    position: absolute;
    left: 65%;
    top: 15px;
    text-decoration: none;
    font-size: 32px;
    color: #fff !important;
}

#navbar-admin-link {
    position: absolute;
    left: 75%;
    top: 15px;
    text-decoration: none;
    font-size: 32px;
    color: #fff !important;
}

#main-text {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    text-align: center;
    margin: auto;
    background-color: rgba(0,0,0,0.2);
}

.welcome {
    position: absolute;
    width: 100%;
    top: 42%;
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
    top: 200%;
    left: 0;
    right: 0;
    width: 100%;
    height: 50px;
    background-color: #444;
    text-align: center;
}

#copyright {
    position: relative;
    display: inline-block;
    bottom: -15px;
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

/* Cookie Banner */
#cookie-banner {
    position: fixed;
    height: 50px;
    width: 100%;
    left: 0;
    bottom: 0;
    z-index: 100;
    text-align: center;
    background-color: rgba(0,0,0,0.97);
    /*line-height: 50px;*/
}
#cookie-text {
    position: relative;
    top: 10px;
    bottom: 10px;
    height: 30px;
}
#cookie-privacy {
    position: static;
}
#cookie-ok {
    margin-left: 5px;
}
.cookie-bttn {
    font-size: small;
}
.cookie-bttn:hover {
    background-color: rgba(255,255,255,0.5);
}

.wm-hero {
    position: absolute;
    top: 0;
    z-index: -1;
    background: url('/images/windmill.webp') center center/cover no-repeat fixed;
    background-position: center center;
    left: 0;
    right: 0;
    bottom: 0;
    /* TODO: Scale it instead of stretching it */
    /* TODO: Multiple res images for desktop, laptop, ipad, phone */
}

.login-container {
    position: absolute;
    left: 10%;
    right: 10%;
    top: 0;
    text-align: center;
    padding: 10% 0 0 0;
}

.login-form {
    text-align: center;
    max-width: 500px;
}