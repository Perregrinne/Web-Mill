<head>
    <?php 
        @ include_once ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");
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
        
        //If a user is logged in, they should start on the index and be able to edit using the admin editor.
        if (isset($_SESSION['USERNAME']) && $_SERVER['REQUEST_URI'] == '/admin.php')
        {
            header('Refresh: 0; URL = /index.php');
        }
    ?>
</head>
<body>
    <!-- With the session/login stuff out of the way, display the menus needed to change the website: -->
    <div id="admin-menu" toggle="0">
        <div class="admin-option">
            Welcome, <?php echo $_SESSION['USERNAME']; ?>
            <br>
            <a href="/php/logout.php" id="logout">Logout</a>
        </div>
        <div id="admin-control">
            <canvas id="control-text" width="50px" height="50px">
                <script>
                    //Javascript for rendering the image on the admin control
                    var canvas = document.getElementById("control-text");
                    var context = canvas.getContext("2d");
                    context.font = "36px Malgun Gothic";
                    context.fillStyle = "#FFFFFF";
                    context.fillText(">", 12, 35);

                    //jquery for controlling the movement of the admin menu
                    $(document).ready(function(){
                        $('#admin-control').click(function(){
                            if($('#admin-menu').attr("toggle")==="0")
                            {
                                $("#control-text").css({'transform': 'rotate(180deg)'});
                                $('#admin-menu').animate({"left":"0px"},200);
                                $('#admin-menu').attr("toggle","1");
                            }
                            else
                            {
                                $("#control-text").css({'transform': 'rotate(0deg)'});
                                $('#admin-menu').animate({"left":"-250px"},200);
                                $('#admin-menu').attr("toggle","0");
                            }
                        });
                    });
                </script>
            </canvas>
        </div>
    </div>
</body>