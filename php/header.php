<?php
    require ($_SERVER['DOCUMENT_ROOT'] . "/php/admin/config.php");
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<head> 
    <title><?php echo $WEBSITE_TITLE; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <?php 
        echo '<link rel="stylesheet" href="' . $CSS . '">';
        echo '<link rel="shortcut icon" href="' . $FAVICON_FILE .  '" type="image/x-icon" >';
    ?>
</head>
<body>
    <?php
        //If logged in, load admin controls
        if (isset($_SESSION['USERNAME']))
        {
            echo '<link rel="stylesheet" href="/css/admin-css.php">';
            include_once ($_SERVER['DOCUMENT_ROOT'] . "/admin.php");
        }
    ?>
</body>