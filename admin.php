<head>
    <?php
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/header.php');
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/functions.php');
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
        
        //If a user is logged in, they should start on the index and be able to edit using the admin editor.
        if (isset($_SESSION['USERNAME']) && $_SERVER['REQUEST_URI'] == '/admin.php')
        {
            header('Refresh: 0; URL = /index.php');
        }

        //Reset the activity timer:
        $_SESSION['LAST_ACTIVITY'] = $_SERVER['REQUEST_TIME'];
    ?>
</head>
<div id="admin-l-menu" toggle_l="0">Welcome, <?php echo $_SESSION["USERNAME"]; ?><br></div>
<div id="admin-l-control">&nbsp;</div>
<!--div id="admin-r-menu" toggle_r="0"></div-->
<!--div id="admin-r-control">&nbsp;</div-->
<script>
    //Get all supported tag types by name and first tag (but not id), and sort them into a tree (based on end tag)
    function detectAllElems() {};
    //If something is selected, list all of its attributes
    function listAllAttr(mouseElem){};

    //All things that are done in jquery happen here
    $(document).ready(function(){

        //Creation of the menus
        $('#admin-l-menu').append(function(){
            let content = '&nbsp;';

            return content;
        });

        //jquery for controlling the movement of the admin menus:

        //The menu can be 1 of 3 sizes based on viewport size
        var viewPortSize = $(window).width();

        //If the viewport is < 500px wide, default to this:
        var menuWidth = "-100px";
        var controlPlacement = "100px";

        if(viewPortSize > 499 && viewPortSize <= 1079) //500px to 1079px
        {
            menuWidth = "-200px";
            controlPlacement = "200px";
        }
        else if(viewPortSize > 1079) //1080px, onwards
        {
            menuWidth = "-400px";
            controlPlacement = "400px";
        }

        //left menu
        $('#admin-l-control').click(function(){
            if($('#admin-l-menu').attr("toggle_l")==="0")
            {
                $('#admin-l-control').css({'background-img': 'url("/php/cms-img/lt.png")'});
                //$('#admin-l-control').css({'background-color': '#333333'});
                $('#admin-l-control').animate({"left":controlPlacement}, 200);
                $('#admin-l-menu').animate({"left":"0"},200);
                $('#admin-l-menu').attr("toggle_l","1");
            }
            else
            {
                $("#admin-l-control").css({'background-img': 'url("/php/cms-img/gt.png")'});
                //$('#admin-l-control').css({'background-color': '#333333'});
                $('#admin-l-control').animate({"left":"0"}, 200);
                $('#admin-l-menu').animate({"left":menuWidth}, 200);
                $('#admin-l-menu').attr("toggle_l","0");
            }
        });
        //right menu
        $('#admin-r-control').click(function(){
            if($('#admin-r-menu').attr("toggle_r")==="0")
            {
                $('#control-r-text').css({'transform': 'rotate(180deg)'});
                $('#admin-r-menu').animate({"right":"0"},200);
                $('#admin-r-menu').attr("toggle_r","1");
            }
            else
            {
                $("#control-r-text").css({'transform': 'rotate(0deg)'});
                $('#admin-r-menu').animate({"right":menuWidth},200);
                $('#admin-r-menu').attr("toggle_r","0");
            }
        });
        
    })


</script>
<!-- Detect all things on the page by their first tag only, not their end tag -->
<!-- Determine the hierarchy tree based on where the end tag is -->
