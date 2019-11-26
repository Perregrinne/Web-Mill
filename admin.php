<head>
    <?php
        //PHP includes:
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/header.php');
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/functions.php');

        //Set the current page as the last visited one, in case user is redirected to the login page:
        //As long as admin.php is an "include" in any page, the last page will automatically be set here.
        $_SESSION['LASTPAGE'] = $_SERVER['REQUEST_URI'];

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
<div id="admin-l-menu" toggle_l="0">
    <h3 id="menu-l-welcome">Welcome, <?php echo (isset($_SESSION["USERNAME"]) ? $_SESSION["USERNAME"] : " "); ?></h3>
    <br>
    <a id="logout" href="/php/logout.php">Logout</a>
    <div id="admin-pages"><h5>Pages:</h5>
        <?php
            //List every webpage in the website.
            echo '<ul class="pages-ul">';
            //If the index is missing, the website won't work
            if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/index.php')) 
            {
                echo '<li>WARNING: NO INDEX.PHP FOUND. THE WEBSITE WILL BREAK.</li>';
            } 
            else //If it exists, we can simply hardcode the link and it should still work.
            {
                echo '<li><a href="/index.php">index</a></li>';
            }
            echo '</ul>';
            //Now, scan every file and subdirectory in /pages/.
            listDir($_SERVER['DOCUMENT_ROOT'] . '/pages', '/pages');

            //List all other pages in the /pages folder:
            //Scan for all pages in the pages directory:
            function listDir($fullDirectory, $directory)
            {
                //Scan the current directory, but we don't want '.' or '..' in the returned list.
                $files = array_diff(scandir($fullDirectory), array('.', '..'));

                //Don't make a list if the directory is empty:
                if(empty($files)) return; //We don't need to waste any more time here, if it's empty.
                //Otherwise, time for a new list:
                echo '<ul class="pages-ul">';
                //Don't make a nested list until all the directories are out of the way:
                foreach($files as $file)
                {
                    //If it's a folder, list it and scan inside it for more folders:
                    if(is_dir($fullDirectory . '/' . $file)) 
                    {
                        echo '<li>' . $file . '</li>';
                        listDir($fullDirectory . '/' . $file, $directory . '/' . $file);
                    }
                }
                echo '</ul>'; //Done scanning through directories now.

                //Now that there are no more directories in the way, list the directory's files:
                echo '<ul class="pages-ul">';
                foreach($files as $file)
                {
                    //We'll want to check its extension and get its filename without its path or extension.
                    $fileName = pathinfo($file);
                    //If it's a php file, then list it with a link to its path.
                    if(isset($fileName['extension']) && $fileName['extension'] == 'php') //Not sure why, but $fileName['extension'] isn't always set.
                    {
                        echo '<li><a href="' . $directory . '/' . $fileName['basename'] . '">' . $fileName['filename'] . '</a></li>';
                    }
                }
                echo '</ul>'; //Done listing the php webpages now.
            }
        ?>
    </div>
</div>
<div id="admin-l-control">&nbsp;</div>
<div id="admin-r-menu" toggle_r="0">
    <div id="admin-elem"><h5>Elements:</h5></div>
</div>
<div id="admin-r-control">&nbsp;</div>
<script>
    //This runs only after the page has loaded, so javascript doesn't miss any elements not yet loaded in:
    document.addEventListener('DOMContentLoaded', function() {

        //Detect and list all elements on the page. They're listed in the "admin-r-menu" div, within the "admin-elem" div.
        detectAllElems();

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
            if(toggle_l === "0")
            {
                admin_l_control.style.backgroundImage = 'url("/php/cms-img/lt.png")';
                //admin_l_menu.style.left = "0";
                moveElem(admin_l_control, "left", controlPlacement, 500);
                moveElem(admin_l_menu, "left", 0, 500);
                admin_l_menu.setAttribute("toggle_l", "1");
            }
            else //Otherwise, close it:
            {
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
            if(toggle_r === "0")
            {
                //getBoundingClientRect() breaks when working with the right side, so values must be set ahead of time to avoid using it.
                if(admin_r_menu.style.right == "")
                {
                    admin_r_menu.style.right = menuWidth + "px";
                }
                if(admin_r_control.style.right == "")
                {
                    admin_r_control.style.right = "0px";
                }
                //Flip the "<" or ">" and move it:
                admin_r_control.style.backgroundImage = 'url("/php/cms-img/gt.png")';
                //admin_r_menu.style.left = "0";
                moveElem(admin_r_control, "right", controlPlacement, 500);
                moveElem(admin_r_menu, "right", 0, 500);
                admin_r_menu.setAttribute("toggle_r", "1");
            }
            else //Otherwise, close it:
            {
                admin_r_control.style.backgroundImage = 'url("/php/cms-img/lt.png")';
                moveElem(admin_r_control, "right", 0, 500);
                moveElem(admin_r_menu, "right", menuWidth, 500);
                admin_r_menu.setAttribute("toggle_r", "0");
            }
        };

        //Get the current size of the viewport:
        function checkViewportSize()
        {
            var viewPortSize = Math.max(document.documentElement.clientWidth, window.innerWidth || 0); //Get the viewport size.

            //If the viewport is < 500px wide, default to this:
            var menuWidth = -100;
            var controlPlacement = 100;

            if(viewPortSize > 499 && viewPortSize <= 1079) //500px to 1079px
            {
                menuWidth = -200;
                controlPlacement = 200;
            }
            else if(viewPortSize > 1079) //1080px, onwards
            {
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
        function moveElem(element, attribute, endLocation, duration)
        {
            if(attribute === "left")
            {
                //Get the element's starting position from the left
                var currPos = element.getBoundingClientRect().left;
            }
            else //if(attribute === "right")
            {
                //Get the element's starting position from the right
                if(element.style.right == "")
                {
                    element.style.right = 0 + "px";
                }
                var currPos = parseInt(element.style.right);
            }
            var interval = Math.abs(Math.abs(endLocation) - Math.abs(currPos)) / (duration/10); //How far the element will move in one frame.
            var frames = setInterval(nextFrame, 1); //Advance the frame every millisecond.

            //Each frame, move the element:
            function nextFrame()
            {
                if(currPos === endLocation) //Once at the destination:
                {
                    clearInterval(frames); //Stop the interval from running anymore.
                }
                else if(currPos < endLocation)//If it needs to move right:
                {
                    currPos += interval;
                }
                else //if element.style.left > endLocation, it needs to move left:
                {
                    currPos -= interval;
                }
                if(attribute === "left")
                {
                    //alert(currPos);
                    element.style.left = currPos + "px";
                }
                else //if(attribute == "right")
                {
                    element.style.right = currPos + "px";
                }
                
            }
        }

        //Detect all the elements on the html page (excluding the Web Mill stuff):
        function detectAllElems() 
        {
            //All elements added to the page by Web Mill are of "nested" class type so they can be moved around on the page.
            var pageElems = document.getElementsByClassName("nested");
            
            var elemList = document.createElement('ul');
            elemList.id = 'admin-ul';
            document.body.appendChild(elemList);
            for(var singleElem of pageElems)
            {
                //Exclude "body" from the list:
                if(singleElem.id != 'body')
                {
                    var listItem = document.createElement('li');
                    var linkText = document.createTextNode(singleElem.id);
                    listItem.appendChild(linkText);
                    listItem.classList.add('admin-li');
                    document.getElementById('admin-elem').appendChild(listItem);
                }
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
