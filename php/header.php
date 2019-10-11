<?php
    require ($_SERVER['DOCUMENT_ROOT'] . "/php/admin/config.php");
    if(!isset($_SESSION))
    {
        session_start();

        //Show the cookie banner
        include_once ($_SERVER['DOCUMENT_ROOT'] . "/php/cookieBanner.php");
    }
?>
<head> 
    <title><?php echo $WEBSITE_TITLE; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="//cdn.rawgit.com/twbs/bootstrap/v4.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!--link href="//cdn.rawgit.com/twbs/bootstrap/v4.1.3/dist/css/bootstrap.min.css" rel="stylesheet"-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js"></script>
    <!--script src="//code.jquery.com/jquery-3.3.1.js"></script-->

    <?php 
        echo '<link rel="stylesheet" href="' . $CSS . '">';
        echo '<link rel="shortcut icon" href="' . $FAVICON_FILE .  '" type="image/x-icon" >';
    ?>
</head>
<body>
    <script>
        //Returns cookie data
        function getCookie(cookie)
        {
            //Look for the cookie's name, followed by "=". The line with the cookie will start with "; " (; and a space)
            var str = new RegExp(cookie + "=([^;\s]+)");
            //Search cookies for the specified regular expression
            var value = str.exec(document.cookie);
            //If it's found, return it. Otherwise, return null
            return (typeof value !== 'undefined' && value !== null) ? decodeURI(value[1]) : "";
        }

        //Writes a new cookie
        function setCookie(cookie, value, exp)
        {
            //Fetch the current date
            var expireDate = new Date();
            //The cookie will expire in "exp" number of days
            expireDate.setDate(expireDate.getDate() + exp);
            //Write the cookie
            document.cookie = cookie + "=" + encodeURI(value) + ";expires=" + expireDate.toUTCString() + ";path=/;";
        }
    </script>
    <?php
        //If logged in, load admin controls
        if (isset($_SESSION['USERNAME']))
        {
            echo '<link rel="stylesheet" href="/css/admin-css.php">';
            include_once ($_SERVER['DOCUMENT_ROOT'] . "/admin.php");
        }
    ?>
</body>