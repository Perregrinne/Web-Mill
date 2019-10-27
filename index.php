<?php
    //This is the default index.php (home) page.
?>
<html>
    <head>
        <?php
            include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");
        ?>
    </head>
    <body id="body" class="nested">
        <span id="clock" class="nested"><script src="/javascript/clock.js" onload="getTime(); setInterval('getTime()', 1000);"></script></span>
        <div class="nested" id="navbar">
            <img src="/favicon.png" class="nested" id="navbar-logo">
            <div class="nested" id="navbar-title">
                Web Mill
            </div>
            <a href="/index.php" class="nested" id="navbar-home-link">
                home
            </a>
            <a href="/admin.php" class="nested" id="navbar-admin-link">
                admin
            </a>
        </div>
        <h1 class="nested" id="main-text">
            Welcome to your website!
        </h1>
        <div class="nested" id="footer">
            <div class="nested" id="copyright">
                <div class="nested" id="copyright-text">
                    Copyright&nbsp;©&nbsp;
                </div>
                <div class="nested" id="copyright-year">
                    <?php echo date("Y"); ?>
                </div>
                <div class="nested" id="copyright-name">
                    &nbsp;Your Name Here
                </div>
            </div>
        </div>
    </body>
</html>