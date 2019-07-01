<html>
    <head>
    </head>
    <body>
        <?php @ include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php"); ?>
        <?php echo 'This is your new website!'; ?>
        <script src="/javascript/clock.js"></script>
        <br>
        <span id="clock">&nbsp</span>
        <body  onload="getTime(); setInterval('getTime()', 1000 )">
    </body>
</html>