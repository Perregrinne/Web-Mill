<head>
    <?php
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/header.php');
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/functions.php');
        //If an ongoing session has had no activity for 60 minutes, logout.
        if (isset($_SESSION['USERNAME']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600))
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
    ?>
  <link href="//cdn.rawgit.com/twbs/bootstrap/v4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" rel="stylesheet">
  <script src="//code.jquery.com/jquery-3.3.1.js"></script>
  <script src="//cdn.rawgit.com/twbs/bootstrap/v4.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js"></script>
</head>
    <!-- The file browser window -->
    <div class="cms-window" id="file-browser-window" style="left: -600px;">
        <span class="cms-window-controls" id="cms-file-controls">
            <div class="cms-window-title" id="cms-file-title">File Browser</div>
            <div class="cms-window-close" id="cms-file-x">x</div>
        </span>
        <span class="file-browser-menu" id="file-menu">
            <div class="file-browser-items" id="file-home">home</div>
            <div class="file-browser-items" id="file-back"><</div>
            <div class="file-browser-items" id="file-forward">></div>
            <div class="file-browser-items" id="file-new-file">+File</div>
            <div class="file-browser-items" id="file-new-folder">+Folder</div>
            <form action="" method="POST" enctype="multipart/form-data" >
                <input type="file" name="file" />
                <input type="submit"/>
            </form>
            <!--div class="file-browser-items" id="file-upload">Upload</div-->
        </span>
        <div class="file-browser" id="file-browser"></div>
    </div>
    <!-- With the session/login stuff out of the way, display the menus needed to change the website: -->
    <!-- Left Menu -->
    <div id="admin-menu" toggle="0">
        <div class="admin-option">
            Welcome, <?php echo $_SESSION['USERNAME']; ?>
            <br>
            <a href="/php/logout.php" id="logout">Logout</a>
            <br>
            <!-- Menu for adding or loading pages -->
            <div class="list-menu" id="apps-menu">
                Apps:
                <!-- Functionality for both onclick functions below are with the main script for the page that controls mouse and dragging behaviors and more -->
                <!-- File browser link -->
                <div class="left-menu-item" id="file-browser-link" onclick="fileBrowser('../*')">File Browser</div>
                <!-- Link for getting to the text-editor -->
                <a href="/php/textEditor.php" style="text-decoration: none; color: #FFFFFF;">Open Text Editor</a>
                <hr style="border-color: #DDDDDD; margin-left: 10px; margin-right: 10px;">
                <ul class="list-menu" id="pages-menu" style="list-style-type: none;">
                    <h5>Pages:</h5>
                    <?php
                        echo '<li class="pages-menu-item"><a href="/index.php" id="pages-menu-index" style="text-decoration: none; color: #FFFFFF;">home</a></li>';
                        listAllPages();
                    ?>
                </ul>
            </div>
            <!-- Menu for the drag and drop functions -->
            <ul class="list-menu" id="functions-menu" style="list-style-type: none;">
                <h5>Functions:</h5>
                <?php
                    //Print out all functions here including the "Add New" function
                    //echo 'New Function';
                    listAllFunctions();
                ?>
            </ul>
        </div>

        <!-- "UPDATE WEBSITE" BUTTON HERE! (Not to be confused with ajax) -->
        <!-- "ADD NEW FUNCTION" BUTTON HERE! -->
        
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
                    })

                </script>
            </canvas>
        </div>
    </div>

    <!-- Right Menu -->
    <div id="admin-r-menu" toggle_r="0">
        <div class="admin-r-option">
            <!-- This list is refreshed every time the page is loaded or an element is cloned. -->
            <ul class="list-menu"  id="list-all-elems">
            </ul>
            <!-- This list is refreshed every time an element is selected -->
            <ul class="list-menu"  id="list-elem-attr">
                Attributes:<br><form>
                <li class="element-attr-item" id="element-attr-id">Name: <br><input type="text" class="admin-attr-item" id="admin-attr-id" value=""/></li>
                <li class="element-attr-item" id="element-attr-height">Height: <br><input type="text" class="admin-attr-item" id="admin-attr-height" value=""/></li>
                <li class="element-attr-item" id="element-attr-width">Width: <br><input type="text" class="admin-attr-item" id="admin-attr-width" value=""/></li>
                <li class="element-attr-item" id="element-attr-top">Top: <br><input type="text" class="admin-attr-item" id="admin-attr-top" value=""/></li>
                <li class="element-attr-item" id="element-attr-bottom">Bottom: <br><input type="text" class="admin-attr-item" id="admin-attr-bottom" value=""/></li>
                <li class="element-attr-item" id="element-attr-left">Left: <br><input type="text" class="admin-attr-item" id="admin-attr-left" value=""/></li>
                <li class="element-attr-item" id="element-attr-right">Right: <br><input type="text" class="admin-attr-item" id="admin-attr-right" value=""/></li>
                <li class="element-attr-item" id="element-attr-mtop">Margin Top: <br><input type="text" class="admin-attr-item" id="admin-attr-mtop" value=""/></li>
                <li class="element-attr-item" id="element-attr-mbottom">Margin Bottom: <br><input type="text" class="admin-attr-item" id="admin-attr-mbottom" value=""/></li>
                <li class="element-attr-item" id="element-attr-mleft">Margin Left: <br><input type="text" class="admin-attr-item" id="admin-attr-mleft" value=""/></li>
                <li class="element-attr-item" id="element-attr-mright">Margin Right: <br><input type="text" class="admin-attr-item" id="admin-attr-mright" value=""/></li>
                <li class="element-attr-item" id="element-attr-ptop">Padding Top: <br><input type="text" class="admin-attr-item" id="admin-attr-ptop" value=""/></li>
                <li class="element-attr-item" id="element-attr-pbottom">Padding Bottom: <br><input type="text" class="admin-attr-item" id="admin-attr-pbottom" value=""/></li>
                <li class="element-attr-item" id="element-attr-pleft">Padding Left: <br><input type="text" class="admin-attr-item" id="admin-attr-pleft" value=""/></li>
                <li class="element-attr-item" id="element-attr-pright">Padding Right: <br><input type="text" class="admin-attr-item" id="admin-attr-pright" value=""/></li>
                <li class="element-attr-item" id="element-attr-color">Font Color: <br><input type="text" class="form-control admin-attr-item" id="admin-attr-color" value=""/></li>
                <li class="element-attr-item" id="element-attr-fsize">Font Size: <br><input type="text" class="admin-attr-item" id="admin-attr-fsize" value=""/></li>
                <li class="element-attr-item" id="element-attr-font">Font: <br><input type="text" class="admin-attr-item" id="admin-attr-font" value=""/></li>
                <li class="element-attr-item" id="element-attr-bg">Background Color: <br><input id="admin-attr-bg" type="text" class="form-control admin-attr-item" value=""/></li>
                <li class="element-attr-item" id="element-attr-text">Text: <br><input type="text" class="admin-attr-item" id="admin-attr-text"/></li>
                <li class="element-attr-item" id="element-attr-link">Link URL: <br><input type="link" class="admin-attr-item" id="admin-attr-link" value=""/></li>
                <li class="element-attr-item" id="element-attr-z">Z-Index: <br><input type="text" class="admin-attr-item" id="admin-attr-z" value=""/></li>
                </form>
            </ul>
        </div>


        <div id="admin-r-control">
            <canvas id="control-r-text" width="50px" height="50px">
                <script>
                    //Javascript for rendering the image on the admin control
                    var canvas2 = document.getElementById("control-r-text");
                    var context2 = canvas2.getContext("2d");
                    context2.font = "36px Malgun Gothic";
                    context2.fillStyle = "#FFFFFF";
                    context2.fillText("<", 12, 35);

                    //jquery for controlling the movement of the admin menu
                    $(document).ready(function(){
                        $('#admin-r-control').click(function(){
                            if($('#admin-r-menu').attr("toggle_r")==="0")
                            {
                                $("#control-r-text").css({'transform': 'rotate(180deg)'});
                                $('#admin-r-menu').animate({"right":"0"},200);
                                $('#admin-r-menu').attr("toggle_r","1");
                            }
                            else
                            {
                                $("#control-r-text").css({'transform': 'rotate(0deg)'});
                                $('#admin-r-menu').animate({"right":"-250px"},200);
                                $('#admin-r-menu').attr("toggle_r","0");
                            }
                        });
                    })

                </script>
            </canvas>
        </div>
    </div>


    <script>
                  
        //List all elements (of the "nested" class)
        $(document).ready(function() {
            listAllElems();
        });

        function listAllElems()
        {
            var listContent = 'Elements:<br>'; 
            $('.nested').each(function(i, nestElem){
                listContent += '<li class="element-list-item" id="element-list-' + nestElem.id + '">' + nestElem.id + '</li>';
            });
            document.getElementById('list-all-elems').innerHTML = listContent;
        }

        function listAllAttr(selElem)
        {
            var listContent = 'Attributes:<br><form>';

            //Name (Id)
            listContent += '<li class="element-attr-item" id="element-attr-id">Name: <br><input type="text" class="admin-attr-item" id="admin-attr-id" value="' + selElem.id + '"/></li>';

            //Height
            var elemHeight = (selElem.style.height) ? selElem.style.height : (Math.round(selElem.getBoundingClientRect().bottom - selElem.getBoundingClientRect().top) + "px");
            listContent += '<li class="element-attr-item" id="element-attr-height">Height: <br><input type="text" class="admin-attr-item" id="admin-attr-height" value="' + elemHeight + '"/></li>';

            //Width
            var elemWidth = (selElem.style.width) ? selElem.style.width : (Math.round(selElem.getBoundingClientRect().right - selElem.getBoundingClientRect().left) + "px");
            listContent += '<li class="element-attr-item" id="element-attr-width">Width: <br><input type="text" class="admin-attr-item" id="admin-attr-width" value="' + elemWidth + '"/></li>';

            //Top
            var elemTop = (selElem.style.top) ? selElem.style.top : (Math.round(selElem.getBoundingClientRect().top) + "px");
            listContent += '<li class="element-attr-item" id="element-attr-top">Top: <br><input type="text" class="admin-attr-item" id="admin-attr-top" value="' + elemTop + '"/></li>';
            
            //Bottom
            var elemBottom = (selElem.style.bottom) ? selElem.style.bottom : (Math.round(selElem.getBoundingClientRect().bottom) + "px");
            listContent += '<li class="element-attr-item" id="element-attr-bottom">Bottom: <br><input type="text" class="admin-attr-item" id="admin-attr-bottom" value="' + elemBottom + '"/></li>';

            //Left
            var elemLeft = (selElem.style.left) ? selElem.style.left : (Math.round(selElem.getBoundingClientRect().left) + "px");
            listContent += '<li class="element-attr-item" id="element-attr-left">Left: <br><input type="text" class="admin-attr-item" id="admin-attr-left" value="' + elemLeft + '"/></li>';

            //Right
            var elemRight = (selElem.style.right) ? selElem.style.right : (Math.round(selElem.getBoundingClientRect().right) + "px");
            listContent += '<li class="element-attr-item" id="element-attr-right">Right: <br><input type="text" class="admin-attr-item" id="admin-attr-right" value="' + elemRight + '"/></li>';

            //Margin Top
            var elemMTop = (selElem.style.marginTop) ? selElem.style.marginTop : "0px";
            listContent += '<li class="element-attr-item" id="element-attr-mtop">Margin Top: <br><input type="text" class="admin-attr-item" id="admin-attr-mtop" value="' + elemMTop + '"/></li>';

            //Margin Bottom
            var elemMBottom = (selElem.style.marginBottom) ? selElem.style.marginBottom : "0px";
            listContent += '<li class="element-attr-item" id="element-attr-mbottom">Margin Bottom: <br><input type="text" class="admin-attr-item" id="admin-attr-mbottom" value="' + elemMBottom + '"/></li>';

            //Margin Left
            var elemMLeft = (selElem.style.marginLeft) ? selElem.style.marginLeft : "0px";
            listContent += '<li class="element-attr-item" id="element-attr-mleft">Margin Left: <br><input type="text" class="admin-attr-item" id="admin-attr-mleft" value="' + elemMLeft + '"/></li>';
            
            //Margin Right
            var elemMRight = (selElem.style.marginRight) ? selElem.style.marginRight : "0px";
            listContent += '<li class="element-attr-item" id="element-attr-mright">Margin Right: <br><input type="text" class="admin-attr-item" id="admin-attr-mright" value="' + elemMRight + '"/></li>';
            
            //Padding Top
            var elemPTop = (selElem.style.paddingTop) ? selElem.style.paddingTop : "0px";
            listContent += '<li class="element-attr-item" id="element-attr-ptop">Padding Top: <br><input type="text" class="admin-attr-item" id="admin-attr-ptop" value="' + elemPTop + '"/></li>';

            //Padding Bottom
            var elemPBottom = (selElem.style.paddingBottom) ? selElem.style.paddingBottom : "0px";
            listContent += '<li class="element-attr-item" id="element-attr-pbottom">Padding Bottom: <br><input type="text" class="admin-attr-item" id="admin-attr-pbottom" value="' + elemPBottom + '"/></li>';
            
            //Padding Left
            var elemPLeft = (selElem.style.paddingLeft) ? selElem.style.paddingLeft : "0px";
            listContent += '<li class="element-attr-item" id="element-attr-pleft">Padding Left: <br><input type="text" class="admin-attr-item" id="admin-attr-pleft" value="' + elemPLeft + '"/></li>';
            
            //Padding Right
            var elemPRight = (selElem.style.paddingRight) ? selElem.style.paddingRight : "0px";
            listContent += '<li class="element-attr-item" id="element-attr-pright">Padding Right: <br><input type="text" class="admin-attr-item" id="admin-attr-pright" value="' + elemPRight + '"/></li>';
            
            //Font Color
            var elemColor = (selElem.style.color) ? selElem.style.color : "rgba(0, 0, 0, 0)";
            listContent += '<li class="element-attr-item" id="element-attr-color">Font Color: <br><input type="text" class="form-control admin-attr-item" id="admin-attr-color" value="' + elemColor + '"/></li>';

            //Font size
            listContent += '<li class="element-attr-item" id="element-attr-fsize">Font Size: <br><input type="text" class="admin-attr-item" id="admin-attr-fsize" value="' + selElem.style.fontSize + '"/></li>';

            //Font
            listContent += '<li class="element-attr-item" id="element-attr-font">Font: <br><input type="text" class="admin-attr-item" id="admin-attr-font" value="' + selElem.style.font + '"/></li>';

            //Background
            var elemBG = (selElem.style.background) ? selElem.style.background : "rgba(0, 0, 0, 0)";
            listContent += '<li class="element-attr-item" id="element-attr-bg">Background Color: <br><input id="admin-attr-bg" type="text" class="form-control admin-attr-item" value="' + elemBG + '"/></li>';

            //Content
            listContent += '<li class="element-attr-item" id="element-attr-text">Text: <br><input type="text" class="admin-attr-item" id="admin-attr-text"/></li>';

            //Hyperlink
            var elemLink = (selElem.href) ? selElem.href : "";
            listContent += '<li class="element-attr-item" id="element-attr-link">Link URL: <br><input type="link" class="admin-attr-item" id="admin-attr-link" value="' + elemLink + '"/></li>';

            //Z-Index
            var elemZ = (selElem.style.zIndex) ? selElem.style.zIndex : "0";
            listContent += '<li class="element-attr-item" id="element-attr-z">Z-Index: <br><input type="text" class="admin-attr-item" id="admin-attr-z" value="' + elemZ + '"/></li>';

            listContent += '</form>';
            
            //Display them in #list-elem-attr
            document.getElementById('list-elem-attr').innerHTML = listContent;

            //Modify "admin-attr-text" to show the innerHTML
            document.getElementById("admin-attr-text").value = selElem.innerHTML;
        }


        //If a folder is clicked, refresh the file browser window with the contents of the inner directory
        //document.getElementsByClassName('folder-item').addEventListener("onmousedown", function(){fileBrowser()}, false);

        //If a file is clicked, open it in the text-editor (or maybe go to that page)
        //Code that here

        //Hide the file browser window when it's not needed
        document.getElementById('cms-file-x').addEventListener("mousedown", function(){
            document.getElementById('file-browser-window').style.top = "25%";
            document.getElementById('file-browser-window').style.left = "-600px";
        }, false);


        //Functionality for showing the file browser
        function fileBrowser(path)
        {
            //Move the window into the viewport (if it's outside of it)
            if(document.getElementById('file-browser-window').style.left == "-600px")
            {
                document.getElementById('file-browser-window').style.top = "25%";
                document.getElementById('file-browser-window').style.left = "25%";
            }
            //Refresh the file-browser section of the window
            $.ajax({ url: '/php/functions.php',
                data: {action: 'fileBrowserphp', currPath: path},
                type: 'GET',
                success: function(output) {
                    //Post the folders and files inside the window
                    document.getElementById('file-browser').innerHTML = output;
                    }
            });
        }

        //Home button
        document.getElementById('file-home').addEventListener("mousedown", function(){
            homeDir();
        }, false);

        function homeDir()
        {
            //Refresh the file-browser section of the window
            $.ajax({ url: '/php/functions.php',
                data: {action: 'homeDir'},
                type: 'GET',
                success: function(output) {
                    //Post the folders and files inside the window
                    document.getElementById('file-browser').innerHTML = output;
                    }
            });
        }

        //Back arrow
        document.getElementById('file-back').addEventListener("mousedown", function(){
            goUpDir();
        }, false);

        function goUpDir()
        {
            //Refresh the file-browser section of the window
            $.ajax({ url: '/php/functions.php',
                data: {action: 'goUpDir'},
                type: 'GET',
                success: function(output) {
                    //Post the folders and files inside the window
                    document.getElementById('file-browser').innerHTML = output;
                    }
            });
        }

        //Forward arrow
        document.getElementById('file-forward').addEventListener("mousedown", function(){
            goBackDir();
        }, false);

        function goBackDir()
        {
            //Refresh the file-browser section of the window
            $.ajax({ url: '/php/functions.php',
                data: {action: 'goBackDir'},
                type: 'GET',
                success: function(output) {
                    //Post the folders and files inside the window
                    document.getElementById('file-browser').innerHTML = output;
                    }
            });
        }

        

        function deletePage()
        {
            /*$.ajax({ url: '/php/functions.php',
                data: {action: 'delPage'},
                type: 'GET',
                success: function(output) {
                    $().html(output);
                    }
            });*/
            alert("This function is not yet finished.");
        }
                   
        //Functionality for being able to move around and place new elements from the menu, onto the page

            //TODO:
            /*
                The admin section should be "experimental" and those changes to it should not affect the "production" side of the website.
                Changes from the "experimental" side can be deployed to the "production" side.
                ALL ELEMENTS MUST HAVE THE "NESTED" AND "CLONED" CLASSES REMOVED FROM THE PRODUCTION ELEMENTS!

                For right now, elements can only have colors for backgrounds. I have not yet tested if images will pose a problem. I'll have to add support or check for that later.
                Also, I need to check to make sure that no dashes or weird characters (or numbers first) are used in the id names if they are just going to be called verbatim.
                I need to make the below script generalized and reusable (document.getElement.onmousedown instead of newElem.onmousedown; That kind of thing, however that's done).

                Bug fix: Sometimes, nesting a div inside another div causes it to slingshot to another location to the right of the div. Look into this at another time.
                        More info: the slingshotting divs behave that way when their "left" attribute is not set. The browser must be thinking that "left" is "0px" by default.
                        Instead of setting the position of the nested element using "left", just get the overall location of both and set the location based off that.
                
                For today, just finish commenting and refactoring, then get this code into the repository!
            */

        //Holds the name of the element that the dragged element will be nested inside
    var nestedElem = null;

    var globalElem = '';

document.body.onmousedown = function(event) 
{
    //Figure out what element id in the body the mouse is down on
    event = event || window.event;
    
    var elemId = event.target ? event.target.id : event.srcElement.id;
    var newElem = null;
    var mouseElem = document.getElementById(elemId);

    //Keep track of initial mouse location
    var x0 = event.clientX;
    var y0 = event.clientY;
    
    //Null checking
    if(!mouseElem)
    {
        return;
    }

    //Check to see if the clicked item was a folder-item or a file-item
    if (mouseElem.classList.contains('folder-item'))
    {
        fileBrowser(mouseElem.id);
    }

    //If an element from the admin list was clicked, select it
    if(mouseElem.classList.contains('element-list-item'))
    {
        //Deselect any element already selected
        $('.nested').each(function(i, elem) {
            $(elem).css({'outline': 'none'});
        });
        //including elements in the admin menu
        $('.element-list-item').each(function(i, elem) {
            $(elem).css({'outline': 'none'});
        });

        $(mouseElem).css({'outline': '3px solid #5555FF'});
        var listElem = document.getElementById(mouseElem.innerHTML);
        $(listElem).css({'outline': '3px solid #5555FF'});

        //List its attributes
        listAllAttr(listElem);

        //And nothing further needs to get done, so just return
        return;
    }

    //If it was the menu controls, do nothing
    //if (!mouseElem.classList.contains('clones') && !mouseElem.classList.contains('nested') && !mouseElem.classList.contains('cms-window'))
    if (!mouseElem.classList.contains('clones') && !mouseElem.classList.contains('nested') && !mouseElem.classList.contains('cms-window') && !mouseElem.classList.contains('cms-window-controls') && !mouseElem.classList.contains('cms-window-title'))
    {
        return;
    }

    //Once the mouse is moved, clone the menu item and retract the menu, then set this to true so only one clone can be made
    var hasMoved = false;
    var isClone = false;

    //Deselect any element already selected
    $('.nested').each(function(i, elem) {
        $(elem).css({'outline': 'none'});
        //Clear the attributes list too
        document.getElementById('list-elem-attr').innerHTML = 'Attributes:<br>';
    });

    //if the body was clicked, everything was just deselected, so do nothing further
    if(mouseElem == document.getElementById("body"))
    {
        return;
    }

    //Checks if the mouse moved
    document.addEventListener('mousemove', onmousemove);
    //Checks if the mouse button is up
    document.addEventListener('mouseup', onmouseup);

    if (mouseElem.classList.contains('clones'))
    {
        newElem = document.getElementById(elemId);
        isClone = true;
    }
    else if (mouseElem.classList.contains('nested'))
    {
        newElem = document.getElementById(elemId);
    }
    else if (mouseElem.classList.contains('cms-window') || mouseElem.classList.contains('cms-window') || mouseElem.classList.contains('cms-window') || mouseElem.classList.contains('cms-window-controls') || mouseElem.classList.contains('cms-window-title') || mouseElem.classList.contains('cms-window-close'))
    {
        newElem = document.getElementById('file-browser-window');
    }
    if(newElem)
    {
        globalElem = newElem.value;
    }
    

    preventHighlight(event);

    //Keeps track of the current element of class "nested" beneath the new element
    currentNested = null;

    //Null checking
    if (!newElem)
    {
        return;
    }

    //Move the element
    moveAt(event.pageX, event.pageY);

    //Outline newElem to show that it is selected, but don't outline it if it's a cms window
    if (newElem !== document.getElementById('file-browser-window'))
    {
        $(newElem).css({'outline': '3px solid #5555FF'});
        //Update the list of elements
        listAllElems();

        //Highlight the element in the admin list
        var syncList = "#element-list-" + newElem.id;
        $(syncList).css({'outline': '3px solid #5555FF'});

        //List its attributes
        listAllAttr(newElem);
    }

    //If the menus need to be retracted while an element is dragged, these will be set to true so the script knows to pull the menus back out afterwards
    var hadToToggle_l = false;
    var hadToToggle_r = false;

    //Location where the new element is on the screen
    let offsetX = event.clientX - newElem.getBoundingClientRect().left;
    let offsetY = event.clientY - newElem.getBoundingClientRect().top;
    //To highlight which element is beneath the dragged element, change its background to this color
    originalBG = '#777777';
    //The dragged element should appear above everything else on the screen (until the mouse button is let go)
    //newElem.style.zIndex = 100000;
    //And append it into the viewport
    //document.body.append(newElem);

    //If element is being moved after already being nested, keep track of its original background color.
    //Look to see if something is under the dragged element
    newElem.hidden = true;
    let elemBelow = document.elementFromPoint(event.clientX, event.clientY);
    newElem.hidden = false;

    //If something is beneath that element
    if(elemBelow)
    {
        //Highlight that element and keep track of its original background color
        setBackground(elemBelow);
    }

    //If the element is already placed and nested, move it back so that its position doesn't reset
    setPos(event);

    //Moves the element to the cursor's location
    function moveAt(pageX, pageY) 
    {
        if (newElem && !newElem.classList.contains('clones'))
        {
            newElem.style.left = pageX + 'px';
            newElem.style.top = pageY + 'px';
        }
        
    }

    function onmousemove(event)
    {
        //Clone the menu item once and retract the menu
        
        //If the element is something to be cloned and hasn't been cloned yet, 
        //clone it and make the clone unclonable so it can be moved without making extra clones
        if(!hasMoved && isClone && newElem)
        {
            
            var clone = newElem.cloneNode(true);

            // Change the id attribute of the newly created element
            clone.setAttribute('id', getNewID());

            //Add the new element to the webpage body 
            document.querySelector('body').appendChild(clone);

            //Don't let it be clonable again in case that new element needs to be moved again
            clone.classList.remove('clones');
            //But it can still be movable and nestable
            clone.classList.add('nested');

            //Outline newElem to show that it is selected
            $(newElem).css({'outline': 'none'});

            newElem = clone;

            //Outline newElem to show that it is selected
            $(newElem).css({'outline': '3px solid #5555FF'});

            hasMoved = true;

            //Update the list of elements
            listAllElems();

            //List its attributes
            listAllAttr(newElem);

            let idName = newElem.id;
            let elemHTML = newElem.innerHTML;

            //Ajax the server to give it newElem's info
            $.ajax({ url: '/php/functions.php',
                data: {action: 'newElem', elem: elemHTML, idName: idName},
                type: 'GET',
                success: function(output) {
                    //Post the folders and files inside the window
                    document.body.insertAdjacentHTML( 'beforeend', output );
                    newElem.parentNode.removeChild(newElem); //Destroy the old newElem, and replace it with the server's ajax one
                    newElem = document.getElementById(idName);
                    }
            });
            
        }

        //If the mouse has moved
        if(event.clientX != x0 && event.clientY != y0)
        {
            //Disable link propagation if the element is being dragged
            newElem.style.pointerEvents = "none";

            //Retract the left-side menu
            if($('#admin-menu').attr("toggle")==="1")
            {
                hadToToggle_l = true;
                $("#control-text").css({'transform': 'rotate(0deg)'});
                $('#admin-menu').animate({"left":"-250px"},200);
                $('#admin-menu').attr("toggle","0");
            }

            //retract the right-side menu
            if($('#admin-r-menu').attr("toggle_r")==="1")
            {
                hadToToggle_r = true;
                $("#control-r-text").css({'transform': 'rotate(0deg)'});
                $('#admin-r-menu').animate({"right":"-250px"},200);
                $('#admin-r-menu').attr("toggle_r","0");
            }
        }

        //List its attributes
        listAllAttr(newElem);

        //Move the element
        moveAt(event.pageX, event.pageY);

        //Set the object's position
        setPos(event);
    }

    function setPos(event)
    {
        //More null checking
        if (!newElem)
        {
            return;
        }
        
        //Look under the dragged object to see what element is directly beneath it
        newElem.hidden = true;
        let elemBelow = document.elementFromPoint(event.clientX, event.clientY);
        newElem.hidden = false;

        //Null checking
        if (!elemBelow) 
        {
            return;
        }

        setBackground(elemBelow);
    }

    //When over something, change its background to gray
    //Otherwise, return its background to what it was before
    function setBackground(elemBelow)
    {
        if(newElem !== document.getElementById('file-browser-window'))
        {
            let nestedBelow = elemBelow.closest('.nested');
            if (currentNested != nestedBelow)
            {
                if (currentNested)
                { 
                    //Return the highlighted element back to its original background
                    currentNested.style.background = originalBG;
                }
                currentNested = nestedBelow;
                if (currentNested)
                { 
                    //If the mouse is over a "nested" element, save its original background and make the new background gray
                    let elemStyle = window.getComputedStyle(currentNested, null);
                    originalBG = elemStyle.getPropertyValue('background-color');
                    currentNested.style.background = '#777777';
                }
            }
        }
        
    }


    $( document ).ready(function() {
            $(function () {
                $('.form-control').colorpicker();

                // Example using an event, to change the color of the .jumbotron background:
                $('.form-control').on('colorpickerChange', function(event) {
                    if(globalElem)
                    {
                        $(globalElem).css('background-color', event.color.toString());
                    }
                    
                });
                
            });
        });


    //Create a new id for new elements.
    //It will always be something like 'id7' or whatever number, starting from 0, has not yet been used.
    //This name is completely placeholder because the admin can just change it themselves.
    function getNewID()
    {
        var idNum = 0;
        var uniqueID = false;

        while(!uniqueID)
        {
            if(!document.getElementById('name' + idNum))
            {
                return 'name' + idNum;
            }
            idNum++;
        }
    }

    //When the mouse button is released, nest the dragged element if necessary
    document.onmouseup = function(event) 
    {
        if(currentNested && newElem)
        {
            //Change the highlighted background back to what it originally was
            currentNested.style.background = originalBG;

            //Nest the element
            currentNested.appendChild(newElem);

            //cNestLeft = parseInt(currentNested.style.left, 10);
            cNestLeft = 0;
            //cNestTop = parseInt(currentNested.style.top, 10);
            cNestTop = 0;
            nElemLeft = parseInt(newElem.style.left, 10);
            //nElemLeft = 0;
            nElemTop = parseInt(newElem.style.top, 10);
            //nElemTop = 0;
            //if(newElem.id !== 'file-browser-window')
            //{
                //newElem.style.left = event.pageX + newElem.getBoundingClientRect().left - event.clientX + 'px';
                //newElem.style.top = event.pageY + newElem.getBoundingClientRect().top - event.clientY + 'px';
            //}
            
        }

        //Return the menu
        if (hadToToggle_l)
        {
            $("#control-text").css({'transform': 'rotate(180deg)'});
            $('#admin-menu').animate({"left":"0px"},200);
            $('#admin-menu').attr("toggle","1");
            hadToToggle_l = false;
        }
        //Return the right-side menu
        if (hadToToggle_r)
        {
            $("#control-r-text").css({'transform': 'rotate(180deg)'});
            $('#admin-r-menu').animate({"right":"0"},200);
            $('#admin-r-menu').attr("toggle_r","1");
            hadToToggle_r = false;
        }

        //Make links clickable again
        newElem.style.pointerEvents = "auto";

        //Remove the mouse listener because it's no longer needed
        document.removeEventListener('mousemove', onmousemove);
        newElem.onmousemove = null;
        newElem.onmouseup = null;
    };

    //To prevent unwanted duplicating of dragged elements
    document.ondragstart = function() 
    {
        return false;
    };

    function preventHighlight(event)
    {
        //Skip this if the text editor is loaded in, or text can't be highlighted
        var currPage = window.location.pathname.substring(window.location.pathname.lastIndexOf('/') + 1);
        if(currPage == "textEditor.php")
        {
            return;
        }
        
        //Prevent this from running if a text field needs to be modified
        if(newElem)
        {
            if(!newElem.classList.contains('admin-attr-item') || !newElem.classList.contains('element-attr-item'))
            {
                if(event.stopPropagation)
                {
                    event.stopPropagation();
                }
                if(event.preventDefault)
                {
                    event.preventDefault();
                }
                event.cancelBubble=true;
                event.returnValue=false;
            }
        }
        
        return false;
    }

};

//Highlight the current page in the pages menu
var menuPage = "#pages-menu-" + "<?= $thisPage?>";
$(menuPage).css({'outline': '3px solid #5555FF'});

//When the users types in a new value for an element's CSS, update it through ajax
window.onkeyup = keyup;

function keyup(e)
{
    //Runs when the "Enter" key is pressed and focused input is a text field
    if (e.keyCode == 13 && document.activeElement.classList.contains('admin-attr-item'))
    {
        var fieldAttr = '';
        var textField = document.activeElement.id;
        var newValue = document.getElementById(textField).value;

        //Check if one of the text fields in the attributes menu were changed
        switch (textField)
        {
            case "admin-attr-id":
                fieldAttr = 'id';
                break;
            case "admin-attr-height":
                fieldAttr = 'height';
                break;
            case "admin-attr-width":
                fieldAttr = 'width';
                break;
            case "admin-attr-top":
                fieldAttr = 'top';
                break;
            case "admin-attr-bottom":
                fieldAttr = 'bottom';
                break;
            case "admin-attr-left":
                fieldAttr = 'left';
                break;
            case "admin-attr-right":
                fieldAttr = 'right';
                break;
            case "admin-attr-mtop":
                fieldAttr = 'marginTop';
                break;
            case "admin-attr-mbottom":
                fieldAttr = 'marginBottom';
                break;
            case "admin-attr-mleft":
                fieldAttr = 'marginLeft';
                break;
            case "admin-attr-mright":
                fieldAttr = 'marginRight';
                break;
            case "admin-attr-ptop":
                fieldAttr = 'paddingTop';
                break;
            case "admin-attr-pbottom":
                fieldAttr = 'paddingBottom';
                break;
            case "admin-attr-pleft":
                fieldAttr = 'paddingLeft';
                break;
            case "admin-attr-pright":
                fieldAttr = 'paddingRight';
                break;
            case "admin-attr-color":
                fieldAttr = 'color';
                break;
            case "admin-attr-fsize":
                fieldAttr = 'fontSize';
                break;
            case "admin-attr-font":
                fieldAttr = 'font';
                break;
            case "admin-attr-bg":
                fieldAttr = 'background';
                break;
            case "admin-attr-text":
                fieldAttr = 'innerHTML';
                break;
            case "admin-attr-z":
                fieldAttr = 'zIndex';
                break;
        }

        //Figure out what element is currently selected
        let modifyElem = '';
        
        var allAdminAtrr = document.getElementsByClassName("element-list-item");
        for(var i = 0; i < allAdminAtrr.length; i++)
        {
            if(allAdminAtrr.item(i).style.outline == "rgb(85, 85, 255) solid 3px")
            {
                modifyElem = allAdminAtrr.item(i).innerHTML;
                alert(modifyElem);
            }
        }

        //Update things client-side
        if(textField == 'id')
        {
            document.activeElement.setAttribute(textField, newValue);
        }

        //When a value in one of the attribute text fields is changed, then update things on the backend using ajax
        if(globalElem && textField)
        {
            $.ajax({ url: '/php/functions.php',
                data: {action: 'updatecss', globalElem, textField, newValue},
                type: 'GET',
                success: function() {
                    alert('It worked!');
                    },
                error: function() {
                    alert('Failed to connect to the server!');
                }
            });
        }
    }
}

$( document ).ready(function() {
            $(function () {
                $('.form-control').colorpicker();
                
            });
        });


    </script>

<?php
    //FTP file uploader script
    //function uploadFiles()
    //{
    if(isset($_FILES['file']))
    {
        $status = 'Upload completed successfully.';
        $file_name = $_FILES['file']['name'];
        $file_size =$_FILES['file']['size'];
        $file_tmp =$_FILES['file']['tmp_name'];
        
        $max_post = getSize(ini_get('post_max_size'));
        $max_upload = getSize(ini_get('upload_max_filesize'));

        $max_size = ($max_post < $max_upload) ? $max_post : $max_upload;

        if($file_size > $max_size)
        {
            $status = 'File is too large. Maximum size: ' . $max_size;
        }
        else
        {
            move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT'] . '/saved/' . $file_name);
        }

        echo $status;
    }
    //}

    function getSize($size)
    {
        $exponent = strtoupper(substr($size, -1));
        $number = substr($size, 0, -1);

        switch($exponent)
        {
            case 'K':
                $number *= 1024;
                break;
            case 'M':
                $number *= pow(1024, 2);
                break;
            case 'G':
                $number *= pow(1024, 3);
                break;
            case 'T':
                $number *= pow(1024, 4);
                break;
            case 'P':
                $number *= pow(1024, 5);
                break;
            case 'Y':
                $number *= pow(1024, 6);
                break;
        }
        return $number;
    }
?>