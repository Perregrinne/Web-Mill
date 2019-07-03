<?php
    //Update secrets.php
    function update_secrets($text, $category)
    {
        //Get the current values out of secrets:
        @ require_once ($_SERVER['DOCUMENT_ROOT'] . '/php/admin/secrets.php');

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
            @ require_once ($_SERVER['DOCUMENT_ROOT'] . '/php/admin/secrets.php');
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
?>