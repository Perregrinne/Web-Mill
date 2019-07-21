<head>
    <?php

        include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/header.php');
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/admin/functions.php');
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
</head>
<body>
    <!-- With the session/login stuff out of the way, display the menus needed to change the website: -->
    <div id="admin-menu" toggle="0">
        <div class="admin-option">
            Welcome, <?php echo $_SESSION['USERNAME']; ?>
            <br>
            <a href="/php/logout.php" id="logout">Logout</a>
            <?php
                //Print out all functions here including the "Add New" function
                echo '<ul style="list-style-type:none;">';
                listAllFunctions();
                echo '</ul>';
            ?>

            <!-- "UPDATE WEBSITE" BUTTON HERE! -->
            <!-- "ADD NEW FUNCTION" BUTTON HERE! -->

            
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
                    })

                </script>
            </canvas>
        </div>
    </div>
    <script>
                   
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

document.body.onmousedown = function(event) 
{
    //Figure out what element id in the body the mouse is down on
    event = event || window.event;
    var elemId = event.target ? event.target.id : event.srcElement.id;
    var newElem = null;
    var mouseElem = document.getElementById(elemId);

    //Once the mouse is moved, clone the menu item and retract the menu, then set this to true so only one clone can be made
    var hasMoved = false;
    var isClone = false;

    //Checks if the mouse moved
    document.addEventListener('mousemove', onmousemove);
    //Checks if the mouse button is up
    document.addEventListener('mouseup', onmouseup);

    //Null checking
    if(!mouseElem)
    {
        return;
    }

    if (mouseElem.classList.contains('clones'))
    {
        newElem = document.getElementById(elemId);
        isClone = true;
    }
    else if (mouseElem.classList.contains('nested'))
    {
        newElem = document.getElementById(elemId);
    }

    //Keeps track of the current element of class "nested" beneath the new element
    currentNested = null;

    //Null checking
    if (!newElem)
    {
        return;
    }

    //Location where the new element is on the screen
    let offsetX = event.clientX - newElem.getBoundingClientRect().left;
    let offsetY = event.clientY - newElem.getBoundingClientRect().top;
    //To highlight which element is beneath the dragged element, change its background to this color
    originalBG = '#777777';
    //To make the new element movable, it has to be anything except static
    newElem.style.position = 'absolute';
    //The dragged element should appear above everything else on the screen (until the mouse button is let go)
    newElem.style.zIndex = 1000;
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
            newElem.style.left = pageX - offsetX + 'px';
            newElem.style.top = pageY - offsetY + 'px';
        }
        
    }

    function onmousemove(event)
    {
        //Clone the menu item once and retract the menu
        
        //If the element is something to be cloned and hasn't been cloned yet, 
        //clone it and make the clone unclonable so it can be moved without making extra clones
        if(!hasMoved && isClone)
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

            newElem = clone;

            hasMoved = true;
        }

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

        //Move the element
        moveAt(event.pageX, event.pageY);
        
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
        let droppableBelow = elemBelow.closest('.nested');
        if (currentNested != droppableBelow)
        {
            if (currentNested)
            { 
                //Return the highlighted element back to its original background
                currentNested.style.background = originalBG;
            }
            currentNested = droppableBelow;
            if (currentNested)
            { 
                //If the mouse is over a "nested" element, save its original background and make the new background gray
                let elemStyle = window.getComputedStyle(currentNested, null);
                originalBG = elemStyle.getPropertyValue('background-color');
                currentNested.style.background = '#777777';
            }
        }
    }

    //Create a new id for new elements.
    //It will always be something like 'id7' or whatever number, starting from 0, has not yet been used.
    //This name is completely placeholder because the admin can just change it themselves.
    function getNewID()
    {
        var idNum = 0;
        var uniqueID = false;

        while(!uniqueID)
        {
            if(!document.getElementById('id' + idNum))
            {
                return 'id' + idNum;
            }
            idNum++;
        }
    }

    //When the mouse button is released, nest the dragged element if necessary
    document.onmouseup = function(event) 
    {
        if(currentNested)
        {
            //Change the highlighted background back to what it originally was
            currentNested.style.background = originalBG;

            //Nest the element
            currentNested.appendChild(newElem);

            //Make sure that the div is in the right location when parenting
            cNestLeft = parseInt(currentNested.style.left, 10);
            cNestTop = parseInt(currentNested.style.top, 10);
            nElemLeft = parseInt(newElem.style.left, 10);
            nElemTop = parseInt(newElem.style.top, 10);
            newElem.style.left = nElemLeft - cNestLeft + 'px';
            newElem.style.top = nElemTop - cNestTop + 'px';
        }
        
        //the z-index should now be < 1000
        newElem.style.zIndex = 0;

        //Remove the mouse listener because it's no longer needed
        document.removeEventListener('mousemove', onmousemove);
        newElem.onmouseup = null;
    };

    //To prevent unwanted duplicating of gragged elements
    document.ondragstart = function() 
    {
        return false;
    };

};

    </script>
</body>