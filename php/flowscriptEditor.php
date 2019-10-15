<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");
?>
<body>
    <canvas id="Flow-Canvas" width="100%" height="100%" style="border:1px solid #CCCCCC;"></canvas>
    <script>
    var canv = document.getElementById("Flow-Canvas");
    setTimeout(function() {
  canv.style.height = window.innerHeight + "px";
}, 0.01);
    canv.style.width = window.innerWidth + "px";
    canv.width = window.innerWidth + "px";
    canv.height = window.innerHeight + "px";
    canv.style.backgroundColor = "#333333";
    var ctx = canv.getContext("2d");
    //ctx.beginPath();
    //ctx.rect(20, 20, 150, 100);
    //ctx.stroke();
    </script>
</body>