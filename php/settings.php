<?php

    //Get access to the header and config files, so we can read settings from them.
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/admin/config.php");
?>
<div class="wm-tab" id="settings-tab">
<?php
    //Draw the settings here:
    echo 'Website title: ' . $WEBSITE_TITLE . '<br>'; //Text input field.
    echo 'Favicon file: ' . $FAVICON_FILE . '<br>'; //File picker field: <input type="file">
    echo 'Copyright holder: ' . $ORGANIZATION . '<br>'; //Another text input field.
    echo 'Theme: ' . $THEME_PRESET . '<br>'; //List all themes in a drop-down list.
?>
</div>