<?php
    //This is the text editor page. It's just a basic text editor, so it should work with any language
?>
<html>
    <head>
        <?php 
            include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");
            include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/functions.php');
            include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin.php');

            //Don't allow visitors to this page, unless logged in
            if(!isset($_SESSION['USERNAME']))
            {
                header('Refresh: 0; URL = /php/login.php');
            }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/codemirror@5.48.2/lib/codemirror.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/codemirror/CodeMirror/master/lib/codemirror.css">

    </head>
    <body>
        <div class="text-editor" id="text-menu">
            Text Editor
            <br>
            <!-- The below functions are stored in /php/functions.php which has already been included by admin.php -->
            <div class="text-editor-ui" id="save-button" onclick="saveText()">Save</div>
            <div class="text-editor-ui">&nbsp|&nbsp</div>
            <div class="text-editor-ui" id="load-button" onclick="loadText()">Load</div>
        </div>
        <div class="text-editor" id="text-box">
            <textarea id="text-area" autofocus="true"></textarea>
            <script>
                var editor = CodeMirror.fromTextArea(document.getElementById("text-area"), {lineNumbers: true,});

                function saveText()
                {
                    alert("SaveText() function works.");
                    //Tell the server to save changes
                    $.ajax({ url: '/php/functions.php',
                        data: {action: 'saveText'},
                        type: 'GET',
                        success: function() {
                            alert('Document saved.');
                            }
                    });
                }

                function loadText()
                {
                    //Bring up the file browser, so that a file can be selected for editing
                    fileBrowser('../*');

                    alert("LoadText() function works.");
                    //Tell the server to load script
                    $.ajax({ url: '/php/functions.php',
                        data: {action: 'loadText'},
                        type: 'GET',
                        success: function(output) {
                            alert('Document loaded.');
                            }
                    });
                }

            </script>
            <style type="text/css">
                .CodeMirror {
                    font-size: 15px;
                    width: 100%;
                    height: 100%;
                    background-color: #111111;
                    color: #AAAAAA;
                }

                .CodeMirror-gutters {
                    background-color: #111111;
                }

                .CodeMirror-cursor {
                    border-left: 1px solid #AAAAAA;
                    border-right: none;
                    width: 0;
                }

                #text-area {
                    margin: 0 55px 0 75px;
                    border: none;
                    background-color: #111111;
                    color: #AAAAAA;
                    overflow: auto;
                    outline: none;
                    box-shadow: none;
                    resize: none;
                }

                #text-box {
                    position: absolute;
                    bottom: 0;
                    width: 100%;
                    left: 0;
                    top: 50px;
                    z-index: 1;
                    padding: 0 50px 0 75px;
                    background-color: #111111;
                    color: #AAAAAA;
                }

                #text-menu {
                    height: 50px;
                    position: absolute;
                    left: 0;
                    right: 0;
                    background-color: #777777;
                    color: #DDDDDD;
                    z-index: 2;
                    padding: 4px 5px 5px 61px;
                }

                .text-editor-ui {
                    display: inline-block;
                }
            </style>
        </div>
    </body>
</html>