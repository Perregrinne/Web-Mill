<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/admin.php");

    //If an ongoing session has had no activity for 60 minutes, logout.
    if (isset($_SESSION['USERNAME']) && ($_SERVER['REQUEST_TIME'] - $_SESSION['LAST_ACTIVITY'] > 3600))
    {
        header('Refresh: 0; URL = /php/logout.php');
    }

    //If no session already exists, log in.
    if(!isset($_SESSION['USERNAME']))
    {
        header('Refresh: 0; URL = /php/login.php');
    }
?>
<body>
    <canvas id="Flow-Canvas" width="2000px" height="1000px"></canvas>
    <script>
    var canv = document.getElementById("Flow-Canvas");
    //setTimeout(function() {canv.style.height = window.innerHeight + "px"; }, 1);
    //canv.style.width = window.innerWidth + "px";
    canv.style.width = "100vw";
    canv.style.height = "100vh";
    canv.style.backgroundColor = "#111";
    var ctx = canv.getContext("2d");
    ctx.fillStyle = "rgb(200, 200, 200)";
    ctx.beginPath();
    ctx.fillRect(20, 20, 125, 150);
    ctx.stroke();
    </script>
</body>