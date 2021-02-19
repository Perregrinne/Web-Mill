<?php
/*functions.php:
* Contained in here are all functions necessary for admin tasks.
* Anything else (like page rendering or checking visitor logins)
* must go into one or more api.php files to prevent sluggish and
* bloated php files from creating a needless slowdown for users.
*/
    

//TODO: This file needs to be fixed. All non-admin calls must be made through api.php, not functions.php

    //In case errors need to be logged:
    @include_once $_SERVER['DOCUMENT_ROOT'] . '/php/logger.php';
    //This is needed for the session variables
    if(!isset($_SESSION)) {
        session_start();
    }

    //Variable holds the name of the current page
    $thisPage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

    //Checking for GET data
    if(isset($_GET['action']) && !empty($_GET['action'])) {
        $action = $_GET['action'];
        $_SESSION['LAST_ACTIVITY'] = $_SERVER['REQUEST_TIME'];
        switch($action) {
            case 'fileBrowserphp':
                fileBrowserphp($_GET['currPath']);
                break;
            case 'homeDir':
                homeDir();
                break;
            case 'goUpDir':
                goUpDir();
                break;
            case 'goBackDir':
                goBackDir();
                break;
            case 'delPage':
                delPage();
                break;
            case 'updatecss':
                updateCSS();
                break;
            case 'saveText':
                saveText($file);
                break;
            case 'loadText':
                loadText($file);
                break;
            case 'newElem':
                newElem($_GET['elem'], $_GET['idName']);
        }
    }

    function fileBrowserphp($path) {
        if(!isset($_SESSION['currPath'])) {
            $_SESSION['currPath'] = '../*';
        }
        //Keep track of the current path in a session variable
        if($path === '../*') {
            $_SESSION['currPath'] = $path;
        }
        else {
            //Remember the last directory
            $_SESSION['prevPath'] = $_SESSION['currPath'];
            //The folders are named folder-name, so remove the "folder-", leaving just the "name"
            $path = substr($path, 7);
            //Strip away the *
            $_SESSION['currPath'] = substr($_SESSION['currPath'], 0, -1);
            $path = $path . '/*';
            $_SESSION['currPath'] = $_SESSION['currPath'] . $path;
        }

        $files = [];
        $folders = [];

        $scanFiles = glob($_SESSION['currPath']);
        foreach($scanFiles as $file) {
            if(is_file($file) && $file !== "." && $file !== ".." && $file !== ".gitkeep"  && $file !== ".git" && $file !== ".gitignore") {
                //Get all files
                $fileName = strrpos($file, '/');
                if ($fileName) {
                    $file = substr($file, $fileName + 1);
                    array_push($files, $file);
                }
                
            }
            else if(is_dir($file) && $file !== "." && $file !== ".." && $file !== ".gitkeep"  && $file !== ".git" && $file !== ".gitignore") {
                //Get all directories
                $fileName = strrpos($file, '/');
                if ($fileName) {
                    $file = substr($file, $fileName + 1);
                    array_push($folders, $file);
                }
            }
        }

        //Print 5 elements per row
        $rowIndex = 0;
        foreach($folders as $folder) {
            if($rowIndex == 6) {
                echo '<br>';
                $rowIndex = 0;
            }
            if (strlen($folder) > 11) {
                $folder = substr($folder, 0, 11) . '...';
            }
            echo '<div class="folder-item" id="folder-' . $folder . '"><div class="file-name">' . $folder . '</div></div>';
            $rowIndex += 1;
        }
        foreach($files as $file) {
            if($rowIndex == 6) {
                echo '<br>';
                $rowIndex = 0;
            }
            if (strlen($file) > 11) {
                $file = substr($file, 0, 11) . '...';
            }
            echo '<div class="file-item"><div class="file-name">' . $file . '</div></div>';
            $rowIndex += 1;
        }

    }

    //Back arrow
    function goUpDir() {
        if(isset($_SESSION['prevPath'])) {
            $_SESSSION['nextPath'] = $_SESSION['currPath'];
            $_SESSION['currPath'] = $_SESSION['prevPath'];
        }
        fileBrowserphp(basename($_SESSION['currPath']));
    }

    //Forward arrow
    function goBackDir() {
        if(isset($_SESSION['nextPath'])) {
            $_SESSSION['prevPath'] = $_SESSION['currPath'];
            $_SESSION['currPath'] = $_SESSION['nextPath'];
        }
        fileBrowserphp(basename($_SESSION['currPath']));
    }

    //Home button
    function homeDir() {
        $_SESSSION['prevPath'] = $_SESSION['currPath'];
        $_SESSION['currPath'] = '../*';
        fileBrowserphp(basename($_SESSION['currPath']));
    }

    //Update secrets.php
    function update_secrets($text, $category) {
        //Get the current values out of secrets:
        require_once $_SERVER['DOCUMENT_ROOT'] . '/php/admin/secrets.php';

        //The text that will be read into the secrets file at the end:
        $newText = '<?php ' . "\n";

        //If the usernames/passwords need to be changed:
        if ($category == 'USERS') {
            //Get the current API_KEYS and WEBHOOKS:
            $newText += '$USERS = [' . $text . '];' . "\n\n";
            $newText += '$API_KEYS = [' . $API_KEYS . '];' . "\n\n";
            $newText += '$WEHOOKS = [' . $WEBHOOKS . '];' . "\n";
            
        }
        elseif($category == 'API_KEYS') {
            $newText += '$USERS = [' . $USERS . '];' . "\n\n";
            $newText += '$API_KEYS = [' . $text . '];' . "\n\n";
            $newText += '$WEHOOKS = [' . $WEBHOOKS . '];' . "\n";
        }
        elseif($category == 'WEBHOOKS') {
            $newText += '$USERS = [' . $USERS . '];' . "\n\n";
            $newText += '$API_KEYS = [' . $API_KEYS . '];' . "\n\n";
            $newText += '$WEBHOOKS = [' . $text . '];' . "\n";
        }
        $newText += '?>';
        
        //Open the secrets file:
        $fSecrets = fopen($_SERVER['DOCUMENT_ROOT'] . '/php/admin/secrets.php', 'w');
        //Write in the new text to secrets.php:
        fwrite($fSecrets, $newText);
        //Finish by closing secrets.php
        fclose($fSecrets);
    }

    //Adding a new user to the list, only if logged in.
    function register_user($username, $password) {
        if (isset($_SESSION['USERNAME'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/php/admin/secrets.php';
            $hash = password_hash($password, PASSWORD_BCRYPT);
            //Send $username and $hash to the secrets file if that username isn't already taken:
            if(!array_search($username, $USERS)) {
                $USERS += ["'" . $username . "'" => "'" . $hash . "'"];
                update_secrets($USERS, 'USERS');
            }
            else {
                $login_error = 'Please choose a different username';
            }
        }
        else {
            $login_error = 'Please log in first';
        }
        
    }

    //TODO: MANY OF THESE FUNCTIONS NEED TO BE MOVED TO API.PHP!---------------------
    //TODO: THIS TASK IS HIGH PRIORITY!----------------------------------------------

    function listAllPages() {
        $PAGES_PATH = $_SERVER['DOCUMENT_ROOT'] . '/pages';
        //Ignore '.', '..', and '.gitkeep' in the returned directory array:
        $files = array_diff(scandir($PAGES_PATH), array('.', '..', '.gitkeep'));

        //ignore if there are no pages
        if ($files) {
            foreach($files as $file) {
                $pageName = substr($file, 0, strrpos($file, "."));
                echo '<li class="pages-menu-item"><a href="/pages/' . $pageName . '.php" id="pages-menu-' . $pageName . '" style="text-decoration: none; color: #FFFFFF;">' . $pageName . '</a></li>';
            }
        }
    }

    function newElem($elem, $idName) {
        switch($elem) {
            case 'Simple Div':
                createSimpleDiv($idName);
                break;
            case 'Simple Link':
                createSimpleLink($idName);
                break;
            case 'Image':
                createImage($idName);
                break;
        }
    }

    //TODO: Dragging and dropping an element should create something in the HTML with
    //      Javascript, but it should also be tracked server-side, somehow. It should
    //      not be creating elements using PHP, but should update .php file using PHP

    /*makeElem:
    * This is the first step in the process of creating a new element on the page.
    * The user drags the name of the element from the menu, and wherever the mouse
    * is released, a new element of that selected type will be made at that point.
    */
    function makeElem($selection) { //TODO: This function is supposed to be in Javascript!
        echo 'Function not implemented yet!';
    }

    //This function needs to pull from two places: the /php/functions (this file) that gets updated
    //when the editor does, and the /saved directory which contains user-made things.
    function listAllFunctions() {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/saved/functions.php';

        //Keep track of the names of the functions:
        $FUNCTIONS_ID = [
            0 => 'Simple Div',
            1 => 'Simple Link',
            2 => 'Image',
        ];

        //Store the actual functions here.
        $FUNCTIONS_LIST = [];

        foreach($FUNCTIONS_ID as $function_id) {
            echo '<li>';
            echo '<div class="clones" id="' . $function_id . '">' . $function_id . '</div>';
            echo '</li>';
        }
    }

    //Generate an empty div object:
    function createSimpleDiv($idName) {
        echo '<div id="' . $idName . '"class="nested">Div</div>';
    }

    //Generate an empty "a href" link object:
    function createSimpleLink($idName) {
        echo '<a href="index.php" id="' . $idName . '" class="nested">homepage</a>';
    }

    //Generate an empty image object using file2.png as the default image:
    function createImage($idName) { //TODO: Add parameter for passing image files to use instead 
        echo '<img src="/php/cms-img/file2.png" id="' . $idName . '" class="nested"/>';
    }

    //Writes the HTML page.
    function writePage($text) {
        //TODO: Write the text to the page.
        return 1;
    }

    //Creates a new PHP page with the default content (like header) incorporated.
    function createPage($name) {
        //Keep track of the new page's location.
        $location = $_SERVER['DOCUMENT_ROOT'] . "/pages/" . $name . ".php";
        //Check to make sure the file doesn't already exist.
        if(file_exists($location)) {
            //If it does exist, just load into that page.
            header('Refresh: 0; URL = /pages/' . $name . '.php');
        }
        //Create a new php page in the pages folder.
        $newPage = fopen($location, "w");
        //Ensure that the user can write, and that anyone can read it.
        //If need be, put this in an "if" statement in case it throws an error.
        chmod($location, 0644);
        //Add the default stuff like header.php
        $defaultText = '<?php
    include ($_SERVER[\'DOCUMENT_ROOT\'] . "/php/header.php");
?>
<head>
</head>
<body id="body" class="nested">
</body>';
        //Write the default text into the new page.
        fwrite($newPage, $defaultText);
        //Close editing
        fclose($newPage);
        //Load the new page
        header('Refresh: 0; URL = /pages/' . $name . '.php');
    }

    //Create a new Database in MySQL (MySQLi).
    function newMySQLDatabase($server, $user, $passwd, $dbname, $port = null) {
        //I really feel like default arguments shouldn't work this way, but StackOverflow says it's fine.
        if($port === null) { //If no port was specified: 
            //Set up the connection without the port.
            $dbConnection = new mysqli($server, $user, $passwd);
        }
        else { //If a port was specified 
            //Then use it.
            $dbConnection = new mysqli($server, $user, $passwd, "", $port);
        }
        //Test the connection
        if($dbConnection->connect_error) { //If the connection fails: 
            //Print the error and the rest of the function is not run.
            echo "Connection failed: " . $dbConnection->connect_error;
        }
        else { //If the connection goes smoothly:
            //Create the database
            if ($dbConnection->query("CREATE DATABASE " . $dbname) === TRUE) {
                echo "Database created successfully.";
            } 
            else { //Otherwise, print the error.
                //TODO: Log the error instead!
                echo "Database could not be created: " . $dbConnection->error;
            }
            //Close the connection.
            $dbConnection->close();
        }
    }

    //Create a new SQLite3 database.
    function newSQLiteDatabase($dbname){
        //Try opening or creating the database.
        if ($db = sqlite_open($dbname, 0666, $errorMsg)) { //If that executes smoothly:
            echo "Database created successfully or already exists.";
        }
        else //If that didn't work:
        {
            //Print out the error message and move on.
            echo "Database could not be created: " . $errorMsg;
        }
    }

    //Create a new MySQL datatable
    function newMySQLDatatable($server, $user, $passwd, $dbname, $tableName, $elements) {
        // Create connection
        $dbConnection = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($dbConnection->connect_error) {
            die("Connection failed: " . $dbConnection->connect_error);
        }

        // sql to create table
        $newTable = "CREATE TABLE " . $tableName . " (";
        /*foreach($elements as $row)
        {
            $newTable += $row . $row=>$type;
        }*/
        $newTable += ")";
        //id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        //firstname VARCHAR(30) NOT NULL,
        //lastname VARCHAR(30) NOT NULL,
        //email VARCHAR(50),
        //reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        //)";

        if ($dbConnection->query($newTable) === TRUE) {
            echo "Table MyGuests created successfully";
        } else {
            echo "Error creating table: " . $dbConnection->error;
        }

        $dbConnection->close();
    }

    //Connect to an external web service and look up the latest versions of Web Mill and PHP
    //Returns an array that holds 2 strings that have a PHP version, and a Web Mill version.
    //If the cURL request fails to connect, the function will log the error and return false
    function checkVersions() {
        //TODO: Put the version checker service online instead of localhost
        $curl_request = curl_init("0.0.0.0:3002");

        //By default the request type is "GET"
        curl_setopt_array($curl_request, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10, //Must connect within 10 seconds
            CURLOPT_TIMEOUT => 20, //Must finish the whole request in 20 seconds... or else
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0, //Falls back to 1.1 if 2.0 won't work
        ));

        //Get a response or a returned error (or if failed to connect)
        $response = curl_exec($curl_request);
        $err = curl_error($curl_request);
        //Don't needlessly call logMsg if no error was thrown:
        if(isset($err)) {
            logMsg($err);
            curl_close($curl_request);
            return false;
        }

        //A sample successful response body would look like this: "7.3.1 1.0.3"
        //where "7.3.1" is the PHP version and "1.0.3" is the Web Mill version.

        //Close the connection and free up $curl_request's resources:
        curl_close($curl_request);

        //Put the PHP version and Web Mill version into an array
        //They are currently separated by a space:
        $versions = explode(" ", $response);
        return $versions;
    }

    //Remove a directory
    //Returns a bool indicating whether or not the directory was successfully deleted.
    //In order to remove a directory, it must be empty (WHY, PHP?!)
    //This means Web Mill has to recursively check each subdirectory for
    //files and subdirectories and delete each one.
    function delete_dir($directory) {
        //If it's empty or contains root, don't let it delete the root directory!
        if($directory === '/' || !isset($directory)) {
            //TODO: When you decide to make a logging mechanism, log that someone tried deleting root.
            return false;
        }
        
        //Scan the files in the subdirectory (and remove '.' and '..' <- I forget why these even exist)
        $items = array_diff(scandir($directory), array('.', '..'));
        //Now determine if each one is a file or subdirectory:
        foreach($items as $item) {
            //Recursively delete the subdirectory inside the current directory:
            if(is_dir($directory . '/' . $item)) {
                delete_dir($directory . '/' . $item);
            }
            else { //If it's a file, delete it:
                unlink($directory . '/' . $item);
            }
        }
        //Finally, try deleting this deepest-level directory
        return rmdir($directory);
    }