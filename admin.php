<head>
    <?php 
        @ include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");
        //If an ongoing session has had no activity for 60 minutes, logout.
        if (isset($_SESSION['USERNAME']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600))
        {
            header('Refresh: 0; URL = /php/logout.php');
        }

        //If no session already exists, log in.
        if(!isset($_SESSION['USERNAME']))
        {
            header('Refresh: 0; URL = /php/admin/login.php');
        }
    ?>
</head>
<body>
    <!-- With the session/login stuff out of the way, display the stuff needed to change the website: -->
    <p>Welcome.</p>
    <?php
        if(isset($_SESSION['USERNAME']))
        {
            echo $_SESSION['USERNAME'];
        }
    ?>
    <a href="/php/logout.php"> Logout </a>
</body>