<?php
$EXCLUDE_MENU = true; //We don't want the right-side menu or the cookie banner shown on this page
?>
<html>
    <head>
        <?php
            include_once($_SERVER["DOCUMENT_ROOT"] . "/php/header.php");
            
            
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
            //echo '<script src="https://pagecdn.io/lib/ace/1.4.8/ace.min.js" crossorigin="anonymous" integrity="sha256-2vrgUWyhDF1A6gCwYj0YcNWMoEdeJNuj0G3MHPLP9RE="></script>';
            //echo '<script src="https://pagecdn.io/lib/ace/1.4.8/worker-php.js" crossorigin="anonymous"></script>';
            //echo '<script src="https://pagecdn.io/lib/ace/1.4.8/worker-javascript.js" crossorigin="anonymous"></script>';
            //echo '<script src="https://pagecdn.io/lib/ace/1.4.8/snippets/php.min.js" crossorigin="anonymous"></script>';
            //echo '<script src="https://pagecdn.io/lib/ace/1.4.8/snippets/javascript.min.js" crossorigin="anonymous"  ></script>';
            //echo '<script src="https://pagecdn.io/lib/ace/1.4.8/mode-php.min.js" crossorigin="anonymous"></script>';
            //echo '<script src="https://pagecdn.io/lib/ace/1.4.8/mode-javascript.min.js" crossorigin="anonymous"></script>';
            //echo '<script src="https://pagecdn.io/lib/ace/1.4.8/theme-twilight.js" crossorigin="anonymous"></script>';
        ?>
    </head>
    <body style="background: #232323; color: #ccc;">
        <!--
        Ace Code Editor License (BSD) text:

        Copyright (c) 2010, Ajax.org B.V.
        All rights reserved.

        Redistribution and use in source and binary forms, with or without
        modification, are permitted provided that the following conditions are met:
            * Redistributions of source code must retain the above copyright
            notice, this list of conditions and the following disclaimer.
            * Redistributions in binary form must reproduce the above copyright
            notice, this list of conditions and the following disclaimer in the
            documentation and/or other materials provided with the distribution.
            * Neither the name of Ajax.org B.V. nor the
            names of its contributors may be used to endorse or promote products
            derived from this software without specific prior written permission.

        THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
        ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
        WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
        DISCLAIMED. IN NO EVENT SHALL AJAX.ORG B.V. BE LIABLE FOR ANY
        DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
        (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
        LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
        ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
        (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
        SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
        -->
        <div id="menu" style="display: inline-block; padding-left: 5vw;">
            <div id="new-file" class="editor-bttn" onclick="newFile()">New File</div>
            <div id="load-file" class="editor-bttn" onclick="loadFile()">Load</div>
            <div id="save-as-file" class="editor-bttn" onclick="saveAsFile()">Save As</div>
            <div id="save-file" class="editor-bttn" onclick="saveFile()">Save</div>
        </div>
        <div id="ace-editor" oninput="changesMade()" style="position: absolute; bottom: 0; right: 0; width: 95vw; height: 90vh;">alert("Hello World!");</div>
        <!--script src="src/ace.js" type="text/javascript" charset="utf-8"></script-->
        <script src="https://pagecdn.io/lib/ace/1.4.8/ace.js" crossorigin="anonymous" integrity="sha256-+svOVB1WmhKhTy7N21gWvtyXn91qF0r52P2hIArRRug="></script>
        <script src="https://pagecdn.io/lib/ace/1.4.8/theme-twilight.min.js" crossorigin="anonymous"></script>
        <script src="https://pagecdn.io/lib/ace/1.4.8/mode-javascript.min.js" crossorigin="anonymous"></script>
        <script src="/javascript/textEditor.js"></script>
        <script>
            start();
        </script>
    </body>
</html>