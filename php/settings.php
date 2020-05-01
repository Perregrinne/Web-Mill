<?php
    //Get access to the header and config files, so we can read settings from them.
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/admin/config.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/functions.php");

    //TODO: I have tried many things to hide the update button after updating, but nothing works, so come back to it.

    //Check if the user is updating PHP or Web Mill:
    if(isset($_POST['update-wm']) && $_POST['update-wm'] === 'true')
    {
        updateWM(); //Run the update
        unset($_POST['update-wm']);
    }
    if(isset($_POST['update-php']) && $_POST['update-php'] === 'true')
    {
        updatePHP(); //Run the update
        unset($_POST['update-php']);
    }
    if(isset($_POST['update-settings']) && $_POST['update-settings'] === 'true')
    {
        updateSettings(); //Update/Save changes
        unset($_POST['update-settings']);
    }
?>
<div class="wm-tab" id="settings-tab" style="padding: 50px; background-color: #404040; color: #ccc; height: 100vh; width: 100vw;">
    <form name="wm-settings" action="">
        <?php
            //Draw the settings here:
            echo '<label for="site-title" class="wm-label">Website title: </label>';
            echo '<input type="text" id="site-title" name="site-title" value="' . $WEBSITE_TITLE . '"/><br>';
            echo '<label for="site-favicon" class="wm-label">Favicon file: </label>';
            //Get all icon files in the root and in /images:
            $icon_list = array();
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/favicon.ico'))
            {
                $default_ico = $_SERVER['DOCUMENT_ROOT'] . '/favicon.ico';
                array_push($icon_list, $default_ico);
            }
            echo '' . $FAVICON_FILE . '<br>'; //File picker field: <input type="file">
            echo 'Copyright holder: ' . $ORGANIZATION . '<br>'; //Another text input field.
            echo 'Theme: ' . $THEME_PRESET . '<br>'; //List all themes in a drop-down list. By default, it should be "Dark"
            
        ?>
    </form>
    <?php //Now list the updatable things that are submitted in their own forms
        echo 'Web Mill Version: ' . $VERSION; //Print the current version of Web Mill used.
        //Check for updated versions of Web Mill and PHP:
        $latest_versions = checkVersions();
        $latest_php = $latest_versions[0];
        $latest_wm = $latest_versions[1];
        if(version_compare($VERSION, $latest_wm, '<') && !isset($_POST['update-wm']))
        {
            echo 'Web Mill version ' . $latest_wm . ' available!';
            echo '<form action="settings.php" method="post">';
            echo '<input class="wm-bttn" id="wm-update-bttn" type="submit" value="Update!" onlcick="hide_wm_bttn();">';
            echo '<input type="hidden" name="update-wm" id="update-wm" value="true">';
            echo '</form>';
            //TODO: Ensure that the user meets all minimum version requirements
            //of PHP, SQL (throw warning if they later switch to a SQL implementation 
            //version number that is no longer supported), and all installed plugins
            //Warn them if they click "Update Web Mill" but don't meet requirements.
            //Also, compile a list of requirements that need to be met!
            echo '<br>'; 
        }
        else //If no updates are available, move to the next item...
        {
            echo 'Web Mill version: ' . $VERSION . '<br>';
        }
        echo 'PHP Version: ' . $PHP_VER; //Print the user's version of PHP
        if(version_compare($PHP_VER, $latest_php, '<') && !isset($_POST['update-php']))
        {
            echo 'PHP version ' . $latest_php . ' available!';
            echo '<form action="setting.php" method="post">';
            echo '<input class="wm-bttn" id="php-update-bttn" type="submit" value="Update!" onlcick="hide_php_bttn();">';
            echo '<input type="hidden" name="update-php" id="update-php" value="true">';
            echo '</form>';
            //Might need to keep people from spamming the Update button at some point,
            //or refreshing the page during the update and hitting the Update button a second time
            echo '<br>'; 
        }
        else //If no updates are available, move to the next item...
        {
            echo '<br>';
        }
    ?>
</div>
<?php
    //TODO: Move these into functions.php?

    //Run a shell command to update PHP
    //"Update" is technically inaccurate, because the newest version of PHP has to
    //be installed, and then the default version must be switched to the latest.
    //-------------------------------
    //TODO: To finish this properly, it might be best to make a shell script that shell_exec()
    //calls out to, installs the latest PHP, switches the default version (possibly uninstalling
    //the old-- I doubt most hosts would allow that, though). It should fail if permissions are not met
    //and a warning should be echoed on the webpage that directs them to change PHP in their control
    //panel (like cPanel) or ask their web host. If successful, restart the server with the new PHP.
    //I'll keep going with this until I determine that it is absolutely impossible to use a shell script
    //or any other means to update and get the server/website back online automatically.
    function updatePHP()
    {
        //First determine server's OS, then issue appropriate shell command to update PHP
        //---------------------------
        //For the most part, it's either Bash or Command Prompt, but MacOS now has Z Shell.
        //---------------------------
        //"GNU" is the shortest possible value, so we can just compare the first 3 characters of the OS string.
        //  ^ Bash should be the default shell, so I may not need to worry about substr. I'll leave it this way
        //in case something changes at some point. 
        $server_os = strtolower(substr(php_uname(), 0, 3));
        switch ($variable) {
            case 'win': //Command prompt (Windows)
                shell_exec('echo Failed to update PHP. Try updating in your web host control panel or contact your web hosting company.');
                //Also show the error on the page too:
                echo "Failed to update PHP. Try updating in your web host control panel or contact your web hosting company.";    
                break;
            
            case 'dar': //Z Shell (Darwin: MacOS, after 2019)
                shell_exec('echo Failed to update PHP. Try updating in your web host control panel or contact your web hosting company.');
                //Also show the error on the page too:
                echo "Failed to update PHP. Try updating in your web host control panel or contact your web hosting company.";
                break;

            default: //Bash, by default
                shell_exec('echo Failed to update PHP. Try updating in your web host control panel or contact your web hosting company.');
                //Also show the error on the page too:
                echo "Failed to update PHP. Try updating in your web host control panel or contact your web hosting company.";
                break;
        }
        //TODO: The shell_exec() commands should invoke a particular shell script to run the PHP update automatically.
        //Not sure how seamless this can be made to work (if it can even be made to work at all).
    }

    //Call to an external service to download the update files into a /temp directory
    //The /tmp folder will be deleted after the update is complete.
    //TODO: A possible setting could allow for older versions to be kept
    //or managed in case of regressions or incompatibilities following an update.
    //TODO: If the /tmp folder would not be deleted, its folder permissions must be changed
    //to prohibit anyone else from accessing the older versions to potentially exploit
    //patched vulnerabilities.
    function updateWM()
    {
        //The /tmp directory:
        $tmp = $_SERVER['DOCUMENT_ROOT'] . "/tmp";
        //The /tmp/wm.zip file:
        $tmp_zip = $_SERVER['DOCUMENT_ROOT'] . "/tmp/wm.zip";
        //The updates are located in the $tmp directory, and their matching files must be in /php
        $main_dir = $_SERVER['DOCUMENT_ROOT'] . "/php";

        //All of the new files are downloaded here. The /tmp folder will be deleted afterwards (for now).
        if(!file_exists($tmp))
        {
            mkdir($tmp);
        }
        //PHP didn't like it if a file didn't already exist.
        //So, this is the update zip file, and it only contains the letter 'u'
        //It will be overwritten by the actual downloaded zip:
        if(!file_exists($tmp_zip))
        {
            file_put_contents($tmp_zip, "u");
        }

        //Set a 1 hour time limit on updating. If it takes this long, there is a problem!
        set_time_limit(3600); 
        $downloaded_zip = fopen($tmp_zip, 'w+');
        //cURL the update location to download the changes in a .zip:
        $curl_update = curl_init("127.0.0.1:3000/wmupdate");

        //By default the request type is "GET"
        curl_setopt_array($curl_update, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 20, //Must connect within 20 seconds
            CURLOPT_TIMEOUT => 3000, //Must finish downloading updates within 50 minutes
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0, //Falls back to 1.1 if 2.0 won't work
        ));

        //Send the data into the file as it gets downloaded:
        curl_setopt($curl_update, CURLOPT_FILE, $downloaded_zip); 
        curl_setopt($curl_update, CURLOPT_FOLLOWLOCATION, true);

        //Fetch the .zip or return an error (or if it failed to connect)
        $update = curl_exec($curl_update);
        $err = curl_error($curl_update);

        //Close the connection and free up $curl_update's resources:
        curl_close($curl_update);
        fclose($downloaded_zip);

        //Now unzip the update:
        $zip = new ZipArchive;
        //Check that the file exists (it should...):
        if($zip->open($tmp_zip) === TRUE)
        {
            //Extract the zip inside /tmp:
            $zip->extractTo($tmp);
            $zip->close();
        }

        //If this script was in charge of updating everything, then what about
        //if this script was one of the files to be updated? Instead, call out
        //to an update script in the tmp directory that should handle the rest
        //and then delete the tmp folder at the end (using delete_dir('/tmp'))
        system(escapeshellcmd('php ' . $tmp . '/wm/run_update.php ' . $_SERVER['DOCUMENT_ROOT']));
    }

    //If settings have been changed, write the changes into config.php:
    function updateSettings()
    {
        echo 'Not implemented yet!';
    }
?>
<script>
    function hide_wm_bttn()
    {
        document.getElementById("wm-update-bttn").style.visibility = "hidden";
    }
    function hide_php_bttn()
    {
        document.getElementById("php-update-bttn").style.visibility = "hidden";
    }
</script>
