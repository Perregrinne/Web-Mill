<?php
    //This is the default index.php (home) page.
?>
<html>
    <head>
        <?php include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php"); ?>
    </head>
    <body class="nested">
        <?php 
            echo '<div class="nested" id="mainText">This is your new website!</div>';
            echo '<script src="/javascript/clock.js"></script>';
            echo '<br>';
            echo '<span class="nested" id="clock">&nbsp</span>';
        ?>
            <body  onload="getTime(); setInterval('getTime()', 1000 )">
        <?php
            echo '<br>';
            echo '<a href="/admin.php" class="nested" id="adminLink" style="position: absolute;">Admin</a>';
            echo '<div class="nested" id="nestBoxTest" style="position: absolute; left: 300px; top: 100px; height: 500px; width: 500px; background-color: green;">&nbsp</div>';
        ?>
    </body>
</html>