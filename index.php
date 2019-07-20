<html>
    <head>
    <?php include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php"); ?>
    </head>
    <body>
        <?php echo 'This is your new website!'; ?>
        <script src="/javascript/clock.js"></script>
        <br>
        <span id="clock">&nbsp</span>
        <body  onload="getTime(); setInterval('getTime()', 1000 )">
        <br>
        <a href="/admin.php">Admin</a>
        <div class="nested" style="position: absolute; left: 300px; top: 100px; height: 500px; width: 500px; background-color: green;">&nbsp</div>
    </body>
</html>