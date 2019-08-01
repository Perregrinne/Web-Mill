<?php
    //This is needed for the session variables
    session_start();

    //Checking for GET data
    if(isset($_GET['action']) && !empty($_GET['action'])) {
        $action = $_GET['action'];
        $currentPath = $_GET['currPath'];
        switch($action) {
            case 'fileBrowserphp':
                fileBrowserphp($currentPath);
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
        }
    }

    function fileBrowserphp($path)
    {
        if(!isset($_SESSION['currPath']))
        {
            $_SESSION['currPath'] = '../*';
        }
        //Keep track of the current path in a session variable
        if($path === '../*')
        {
            $_SESSION['currPath'] = $path;
        }
        else
        {
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
        foreach($scanFiles as $file)
        {
            if(is_file($file) && $file !== "." && $file !== ".." && $file !== ".gitkeep"  && $file !== ".git" && $file !== ".gitignore")
            {
                //Get all files
                $fileName = strrpos($file, '/');
                if ($fileName)
                {
                    $file = substr($file, $fileName + 1);
                    array_push($files, $file);
                }
                
            }
            else if(is_dir($file) && $file !== "." && $file !== ".." && $file !== ".gitkeep"  && $file !== ".git" && $file !== ".gitignore")
            {
                //Get all directories
                $fileName = strrpos($file, '/');
                if ($fileName)
                {
                    $file = substr($file, $fileName + 1);
                    array_push($folders, $file);
                }
            }
        }

        //Print 5 elements per row
        $rowIndex = 0;
        foreach($folders as $folder)
        {
            if($rowIndex == 6)
            {
                echo '<br>';
                $rowIndex = 0;
            }
            if (strlen($folder) > 11)
            {
                $folder = substr($folder, 0, 11) . '...';
            }
            echo '<div class="folder-item" id="folder-' . $folder . '"><div class="file-name">' . $folder . '</div></div>';
            $rowIndex += 1;
        }
        foreach($files as $file)
        {
            if($rowIndex == 6)
            {
                echo '<br>';
                $rowIndex = 0;
            }
            if (strlen($file) > 11)
            {
                $file = substr($file, 0, 11) . '...';
            }
            echo '<div class="file-item"><div class="file-name">' . $file . '</div></div>';
            $rowIndex += 1;
        }

    }

    //Back arrow
    function goUpDir()
    {
        if(isset($_SESSION['prevPath']))
        {
            $_SESSSION['nextPath'] = $_SESSION['currPath'];
            $_SESSION['currPath'] = $_SESSION['prevPath'];
        }
        fileBrowserphp(basename($_SESSION['currPath']));
    }

    //Forward arrow
    function goBackDir()
    {
        if(isset($_SESSION['nextPath']))
        {
            $_SESSSION['prevPath'] = $_SESSION['currPath'];
            $_SESSION['currPath'] = $_SESSION['nextPath'];
        }
        fileBrowserphp(basename($_SESSION['currPath']));
    }

    //Home button
    function homeDir()
    {
        $_SESSSION['prevPath'] = $_SESSION['currPath'];
        $_SESSION['currPath'] = '../*';
        fileBrowserphp(basename($_SESSION['currPath']));
    }
?>

<?php
    //Update secrets.php
    function update_secrets($text, $category)
    {
        //Get the current values out of secrets:
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/php/admin/secrets.php');

        //The text that will be read into the secrets file at the end:
        $newText = '<?php ' . "\n";

        //If the usernames/passwords need to be changed:
        if ($category == 'USERS')
        {
            //Get the current API_KEYS and WEBHOOKS:
            $newText += '$USERS = [' . $text . '];' . "\n\n";
            $newText += '$API_KEYS = [' . $API_KEYS . '];' . "\n\n";
            $newText += '$WEHOOKS = [' . $WEBHOOKS . '];' . "\n";
            
        }
        elseif($category == 'API_KEYS')
        {
            $newText += '$USERS = [' . $USERS . '];' . "\n\n";
            $newText += '$API_KEYS = [' . $text . '];' . "\n\n";
            $newText += '$WEHOOKS = [' . $WEBHOOKS . '];' . "\n";
        }
        elseif($category == 'WEBHOOKS')
        {
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
    function register_user($username, $password) 
    {
        if (isset($_SESSION['USERNAME']))
        {
            require_once ($_SERVER['DOCUMENT_ROOT'] . '/php/admin/secrets.php');
            $hash = password_hash($password, PASSWORD_BCRYPT);
            //Send $username and $hash to the secrets file if that username isn't already taken:
            if(!array_search($username, $USERS))
            {
                $USERS += ["'" . $username . "'" => "'" . $hash . "'"];
                update_secrets($USERS, 'USERS');
            }
            else
            {
                $login_error = 'Please choose a different username';
            }
        }
        
    }

    function listAllPages()
    {
        $PAGES_PATH = $_SERVER['DOCUMENT_ROOT'] . '/pages';
        //Ignore '.', '..', and '.gitkeep' in the returned directory array:
        $files = array_diff(scandir($PAGES_PATH), array('.', '..', '.gitkeep'));

        //ignore if there are no pages
        if ($files)
        {
            foreach($files as $file)
            {
                $pageName = substr($file, 0, strrpos($file, "."));
                echo '<li><a href="/pages/' . $pageName . '.php" style="text-decoration: none; color: #FFFFFF;">' . $pageName . '</a></li>';
            }
        }
    }

    //This function needs to pull from two places: the /php/functions (this file) that gets updated
    //when the editor does, and the /saved directory which contains user-made things.
    function listAllFunctions()
    {
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/saved/functions.php' );

        //Keep track of the names of the functions:
        $FUNCTIONS_ID = [
            0 => 'Simple Div',
            1 => 'Simple Link',
        ];

        //Store the actual functions here.
        $FUNCTIONS_LIST = [];

        foreach($FUNCTIONS_ID as $function_id)
        {
            echo '<li>';
            listFunction($function_id);
            echo '</li>';
        }
    }

    //Prints the name of the function in the admin menu
    $FUNCTIONS_LIST['Simple Div'] = function ($function_id){
        echo '<div class="nested" id="' . 'a' . '">' . 'b' . '</div>';
    };

    function listFunction($function_id)
    {
        echo '<div class="clones" id="' . $function_id . '">' . $function_id . '</div>';
    }


    function createSimpleDiv()
    {
        echo '<div class="nested">Function 1 works</div>';
    }

    function createSimpleLink()
    {
        echo '<a href="index.php">homepage</a>';
    }

?>