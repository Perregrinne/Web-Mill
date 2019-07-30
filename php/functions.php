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