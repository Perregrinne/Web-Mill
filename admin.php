<head>
    <?php
        session_start();
        //Set the current page as the last visited one, in case user is redirected to the login page:
        //As long as admin.php is an "include" in any page, the last page will automatically be set here.
        $_SESSION['LASTPAGE'] = $_SERVER['REQUEST_URI'];

        //If an ongoing session has had no activity for 60 minutes, logout.
        if (isset($_SESSION['USERNAME']) && ($_SERVER['REQUEST_TIME'] - $_SESSION['LAST_ACTIVITY'] > 3600)) {
            header('Refresh: 0; URL = /php/logout.php');
        }

        //If a user is logged in, they should start on the index and be able to edit using the admin editor.
        if (isset($_SESSION['USERNAME']) && $_SERVER['REQUEST_URI'] === '/admin.php') {
            header('Refresh: 0; URL = /php/dashboard.php');
        }

        //Reset the activity timer:
        $_SESSION['LAST_ACTIVITY'] = $_SERVER['REQUEST_TIME'];

        //PHP includes:
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/header.php');

        //TODO: If $exclude_menu is true, don't render the right menu or the cookie banner.

        //If no session already exists, the admin page content will be hidden:
        if(!isset($_SESSION['USERNAME'])) {
            header('Refresh: 0; URL = /php/login.php');
        }
        //Don't hide the admin if the user is logged in already:
        else { //--- Begin else for admin HTML ---
            include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/functions.php');
    ?>
</head>
<div id="admin-l-menu" toggle_l="0">
    <h3 id="menu-l-welcome">Welcome, <?php echo (isset($_SESSION["USERNAME"]) ? $_SESSION["USERNAME"] : " "); ?></h3>
    <a class="wm-link" href="/php/logout.php">Logout</a>
    <br>
    <a class="wm-link" href="/php/settings.php">Settings</a>
    <div id="admin-pages"><h5>Pages:</h5>
        <?php
            //List every webpage in the website.
            echo '<ul class="pages-ul">';
            //If the index is missing, the website won't work
            if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/index.php')) {
                echo '<li>WARNING: NO INDEX.PHP FOUND. THE WEBSITE WILL BREAK.</li>';
            } 
            else { //If it exists, we can simply hardcode the link and it should still work.
                echo '<li><a href="/index.php">index</a></li>';
            }
            echo '</ul>';
            //Now, scan every file and subdirectory in /pages/.
            listDir($_SERVER['DOCUMENT_ROOT'] . '/pages', '/pages');
        ?>
    </div>
    <a class="wm-link" href="/php/textEditor.php">Text Editor</a>
</div>
<div id="admin-l-control">&nbsp;</div>
<div id="admin-r-menu" toggle_r="0" <?php echo (isset($EXCLUDE_MENU) && $EXCLUDE_MENU) ? 'style="visibility: hidden !important;"' : 'style="visibility: visible !important;"'; ?>>
    <div id="admin-elem"><h5>Elements:</h5></div>
</div>
<div id="admin-r-control" <?php echo (isset($EXCLUDE_MENU) && $EXCLUDE_MENU) ? 'style="visibility: hidden !important;"' : 'style="visibility: visible !important;"'; ?>>&nbsp;</div>
<script>
    //This runs only after the page has loaded, so javascript doesn't miss any elements not yet loaded in:
    document.addEventListener('DOMContentLoaded', function() {

        //If an element is hovered over and its background color changes as a result, remember its original background color.
        var originalBackground = '';
        //Also remember which element on the page is being highlighted.
        var selectedElement = '';

        //If on any non-Web Mill page, list all elements
        //Otherwise, display the relevant set of tools for that page.
        <?php
            //If the current page is the flowscript editor page:
            if($_SERVER['REQUEST_URI'] === "/php/flowscriptEditor.php") {
                //List all of the flowscript nodes in the right-side menu.
                echo 'document.getElementById("admin-elem").innerHTML = "<h5>Nodes:</h5>";';
                echo "listFlowscriptNodes();";
            }
            else { //If on any non-Web Mill page:
                //Detect and list all elements on the page. They're listed in the "admin-r-menu" div, within the "admin-elem" div.
                echo "detectAllElems();";
            }
        ?>

        //Left menu open or close when "<" or ">" controls are clicked:
        document.getElementById('admin-l-control').onclick = function(){

            //Size the menus based off of the viewport size:
            var menuPlacement = checkViewportSize();
            var menuWidth = menuPlacement[0];
            var controlPlacement = menuPlacement[1];

            //Shorten/Simplify these long names:
            var admin_l_menu = document.getElementById('admin-l-menu');
            var admin_l_control = document.getElementById('admin-l-control');
            var toggle_l = admin_l_menu.getAttribute("toggle_l");

            //If the menu is closed, open it:
            if(toggle_l === "0") {
                admin_l_control.style.backgroundImage = 'url("/php/cms-img/lt.png")';
                //admin_l_menu.style.left = "0";
                moveElem(admin_l_control, "left", controlPlacement, 500);
                moveElem(admin_l_menu, "left", 0, 500);
                admin_l_menu.setAttribute("toggle_l", "1");
            }
            else { //Otherwise, close it:
                admin_l_control.style.backgroundImage = 'url("/php/cms-img/gt.png")';
                moveElem(admin_l_control, "left", 0, 500);
                moveElem(admin_l_menu, "left", menuWidth, 500);
                admin_l_menu.setAttribute("toggle_l", "0");
            }
        };

        //Right menu open or close when "<" or ">" controls are clicked:
        document.getElementById('admin-r-control').onclick = function(){

            //Size the menus based off of the viewport size:
            var menuPlacement = checkViewportSize();
            var menuWidth = menuPlacement[0];
            var controlPlacement = menuPlacement[1];

            //Shorten/Simplify these long names:
            var admin_r_menu = document.getElementById('admin-r-menu');
            var admin_r_control = document.getElementById('admin-r-control');
            var toggle_r = admin_r_menu.getAttribute("toggle_r");

            //If the menu is closed, open it:
            if(toggle_r === "0") {
                //getBoundingClientRect() breaks when working with the right side, so values must be set ahead of time to avoid using it.
                if(admin_r_menu.style.right == "") {
                    admin_r_menu.style.right = menuWidth + "px";
                }
                if(admin_r_control.style.right == "") {
                    admin_r_control.style.right = "0px";
                }
                //Flip the "<" or ">" and move it:
                admin_r_control.style.backgroundImage = 'url("/php/cms-img/gt.png")';
                //admin_r_menu.style.left = "0";
                moveElem(admin_r_control, "right", controlPlacement, 500);
                moveElem(admin_r_menu, "right", 0, 500);
                admin_r_menu.setAttribute("toggle_r", "1");
            }
            else { //Otherwise, close it:
           
                admin_r_control.style.backgroundImage = 'url("/php/cms-img/lt.png")';
                moveElem(admin_r_control, "right", 0, 500);
                moveElem(admin_r_menu, "right", menuWidth, 500);
                admin_r_menu.setAttribute("toggle_r", "0");
            }
        };

        //Get the current size of the viewport:
        function checkViewportSize() {
            var viewPortSize = Math.max(document.documentElement.clientWidth, window.innerWidth || 0); //Get the viewport size.

            //If the viewport is < 500px wide, default to this:
            var menuWidth = -100;
            var controlPlacement = 100;

            if(viewPortSize > 499 && viewPortSize <= 1079) { //500px to 1079px
                menuWidth = -200;
                controlPlacement = 200;
            }
            else if(viewPortSize > 1079) { //1080px, onwards
                menuWidth = -400;
                controlPlacement = 400;
            }

            var arr = new Array(menuWidth, controlPlacement);
            return arr;
        }

        //Move animation for selected element:
        /*
            element: DOM element to be moved.
            attribute: "left" or "right". It determines the direction the element moves.
            endLocation: The location the moved element will end at.
            duration: How long (milliseconds) the move animation takes to finish.
        */
        //Note: The function isn't perfectly timed, so this is the closest that can be managed [for now] without jquery.
        function moveElem(element, attribute, endLocation, duration) {
            if(attribute === "left") {
                //Get the element's starting position from the left
                var currPos = element.getBoundingClientRect().left;
            }
            else { //if(attribute === "right")
                //Get the element's starting position from the right
                if(element.style.right === "") {
                    element.style.right = 0 + "px";
                }
                var currPos = parseInt(element.style.right);
            }
            var interval = Math.abs(Math.abs(endLocation) - Math.abs(currPos)) / (duration/10); //How far the element will move in one frame.
            var frames = setInterval(nextFrame, 1); //Advance the frame every millisecond.

            //Each frame, move the element:
            function nextFrame() {
                if(currPos === endLocation) { //Once at the destination:
                    clearInterval(frames); //Stop the interval from running anymore.
                }
                else if(currPos < endLocation) { //If it needs to move right:
                    currPos += interval;
                }
                else { //if element.style.left > endLocation, it needs to move left:
                    currPos -= interval;
                }
                if(attribute === "left") {
                    //alert(currPos);
                    element.style.left = currPos + "px";
                }
                else { //if(attribute == "right")
                    element.style.right = currPos + "px";
                }
                
            }
        }

        //List all of the nodes the user can drag into the editor:
        function listFlowscriptNodes() {
            var nodeList = ['a', 'b', 'c'];

            var elemList = document.createElement('ul');
            elemList.id = 'admin-ul';
            document.body.appendChild(elemList);
            for(var nodeElem of nodeList) {
                var listItem = document.createElement('li');
                var linkText = document.createTextNode(nodeElem);
                listItem.appendChild(linkText);
                listItem.classList.add('admin-li');
                listItem.id = nodeElem + '-li';
                listItem.onmouseover = elemHover;
                listItem.onmouseout = elemOut;
                document.getElementById('admin-elem').appendChild(listItem);
            }
        }

        //Detect all the elements on the html page (excluding the Web Mill stuff):
        function detectAllElems() {
            //All elements added to the page by Web Mill are of "nested" class type so they can be moved around on the page.
            var pageElems = document.getElementsByClassName("nested");
            
            var elemList = document.createElement('ul');
            elemList.id = 'admin-ul';
            document.body.appendChild(elemList);
            for(var singleElem of pageElems) {
                //Exclude "body" from the list:
                if(singleElem.id !== 'body') {
                    var listItem = document.createElement('li');
                    var linkText = document.createTextNode(singleElem.id);
                    listItem.appendChild(linkText);
                    listItem.classList.add('admin-li');
                    listItem.id = singleElem.id + '-li';
                    listItem.onmouseover = elemHover;
                    listItem.onmouseout = elemOut;
                    document.getElementById('admin-elem').appendChild(listItem);
                }
                
            }
        }

        //When the user hovers over the elements in the admin menu, highlight them in the menu and on the page.
        function elemHover() {
            this.style.backgroundColor = '#7777DD';
            var elemName = this.id.substring(0, this.id.length - 3);
            selectedElement = document.getElementById(elemName);
            if(selectedElement != null) {
                originalBackground = selectedElement.style.backgroundColor;
                selectedElement.style.backgroundColor = '#7777DD';
            }
        }

        function elemOut() {
            this.style.backgroundColor = '';
            if(selectedElement !== null) {
                selectedElement.style.backgroundColor = originalBackground;
            }
        }

    }, false);
    
    //TODO: Move menu and controls as viewport is resized.

    //Get all supported tag types by name and first tag (but not id), and sort them into a tree (based on end tag)
    
    //If something is selected, list all of its attributes
    //function listAllAttr(mouseElem){};

</script>
<!-- Detect all things on the page by their first tag only, not their end tag -->
<!-- Determine the hierarchy tree based on where the end tag is -->
<?php } //--- End of else block for admin HTML ---