<?php
    header("Content-type: text/css"); 
    include ($_SERVER['DOCUMENT_ROOT']."/php/admin/config.php");

    //This file contains the css used by the admin script.
?>

#admin-menu {
    position: fixed;
    top: 0%;
    bottom: 0%;
    left: -250px;
    width: 300px;
    -webkit-animation: appear 1s;
    -moz-animation: appear 1s;
    -ms-animation: appear 1s;
    -o-animation: appear 1s;
    animation: appear 1s;
    z-index: 10000;
}

#admin-control:hover {
    background-color: <?= $CONTAINER_HOVER ?>;
}

#admin-control {
    position: absolute;
    top: 50%;
    right: 0px;
    border-radius: 0 10px 10px 0;
    transform: translate(0%, -50%);
    background-color: <?= $CONTAINER_COLOR ?>;
    text-align: center;
    color: #0F0F0F;
    font-size: 42px;
    overflow: hidden;
}

#admin-control:hover {
    background-color: <?= $CONTAINER_HOVER ?>;
    cursor: pointer;
}

/*appear animation keyframes*/
@keyframes appear {
    from { opacity: 0; }
    to   { opacity: 1; }
}

@-moz-keyframes appear {
    from { opacity: 0; }
    to   { opacity: 1; }
}

@-webkit-keyframes appear {
    from { opacity: 0; }
    to   { opacity: 1; }
}

@-ms-keyframes appear {
    from { opacity: 0; }
    to   { opacity: 1; }
}

@-o-keyframes appear {
    from { opacity: 0; }
    to   { opacity: 1; }
}

.admin-option {
    background-color: <?= $CONTAINER_COLOR ?>;
    color: #FFF;
    text-align: center;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 250px;
}
#admin-r-menu {
    position: fixed;
    top: 0%;
    bottom: 0%;
    right: -250px;
    width: 300px;
    -webkit-animation: appear 1s;
    -moz-animation: appear 1s;
    -ms-animation: appear 1s;
    -o-animation: appear 1s;
    animation: appear 1s;
    z-index: 10000;
}

#admin-r-control {
    position: absolute;
    top: 50%;
    left: 0;
    border-radius: 10px 0 0 10px;
    transform: translate(0%, -50%);
    background-color: <?= $CONTAINER_COLOR ?>;
    text-align: center;
    color: #0F0F0F;
    font-size: 42px;
    overflow: hidden;
}

#admin-r-control:hover {
    background-color: <?= $CONTAINER_HOVER ?>;
    cursor: pointer;
}

.admin-r-option {
    background-color: <?= $CONTAINER_COLOR ?>;
    color: #FFF;
    text-align: center;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    width: 250px;
}

#logout {
    text-decoration: none;
    color: #FFF;
}

#logout:hover {
    text-decoration: none;
    color: #CCCCCC;
    cursor: pointer;
}

.clones {
    position: static;
    cursor: pointer;
}

.nested {
    position: absolute;
    left: 0;
}

.list-menu {
    position: absolute;
    right: 0;
    left: 0;
    margin: 10px 10px 0 10px;
    padding: 10px 0 10px 0;
    border-style: solid;
    border-width: 1px;
    border-color: #DDDDDD;
    border-radius: 5px 5px 5px 5px;
    min-height: 46%;
    max-height: 48%;
    overflow: auto;
}

/*Customizing the scrollbars in the side menus*/

.list-menu::-webkit-scrollbar {
    width: 10px;
    border-radius: 5px 5px 5px 5px;
    background-color: #aaaaaa;
}

.list-menu::-webkit-scrollbar-thumb {
    width: 10px;
    border-radius: 5px 5px 5px 5px;
    background-color: #888888;
}

.list-menu::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.25);
    border-radius: 5px 5px 5px 5px;
    background-color: #DDDDDD;
}

#list-elem-attr {
    bottom: 10px;
    max-height: 48.5%;
}

#list-all-elems {
    max-height: 48.5%;
}

#pages-menu {
    position: absolute;
    top: 100px;
    bottom: 0;
    margin-bottom: 10px;
    max-height: 75%;
    scroll: auto;
}
#functions-menu {
    bottom: 10px;
}

.cms-window {
    background-color: #777777;
    position: absolute;
    top: -100%;
    left: -100%;
    display: inline-block;
    z-index: 3;
    color: #DDDDDD;
    border-radius: 10px 10px 10px 10px;
}

.file-browser {
    background-color: #555555;
    min-width: 500px;
    min-height: 400px;
    max-width: 550px;
    max-height: 800px;
    overflow-x: hidden;
    overflow-y: auto;
    border-radius: 0px 0px 10px 10px;
    margin: 5px 2px 2px 2px;
}

.folder-item {
    background: url("/php/cms-img/directory.png");
    position: relative;
    height: 64px;
    width: 64px;
    display: inline-block;
    margin: 10px 10px 30px 10px;
    border: 1px solid #DDDDDD;
    border-radius: 10px 10px 10px 10px;
}

.folder-item:hover {
    background-color: #AAAAAA;
    cursor: pointer;
}

.file-item {
    background: url("/php/cms-img/file.png");
    position: relative;
    height: 64px;
    width: 64px;
    display: inline-block;
    margin: 10px 10px 30px 10px;
    border: 1px solid #DDDDDD;
    border-radius: 10px 10px 10px 10px;
}

.file-item:hover {
    background-color: #AAAAAA;
    cursor: pointer;
}

.file-name {
    font-size: 12px;
    position: relative;
    text-align: center;
    top: 60px;
    left: 0;
    right: 0;
}

.cms-window-close {
    background-color: red;
    position: absolute;
    height: 20px;
    width: 20px;
    text-align: center;
    line-height: 16px;
    top: 5px;
    right: 5px;
    border-radius: 5px 5px 5px 5px;
    margin-bottom: 15px;
    cursor: pointer;
}

.cms-window-close:hover {
    background-color: #FF7777;
}

.cms-window-title {
    position: relative;
    top: 3px;
    left: 10px;
}

#file-browser-window {
    left: -600px;
}

.file-browser-menu {
    display: inline-block;
    padding: 5px 0 5px 10px;
}

.file-browser-items {
    position: relative;
    display: inline-block;
    border: 1px solid #999999;
    border-radius: 5px 5px 5px 5px;
    text-align: center;
    width: 75px;
    cursor: pointer;
    background: #333333;
    color: #CCCCCC;
}

.file-browser-items:hover {
    background: #AAAAAA;
    border: 1px solid #DDDDDD;
}

.left-menu-item {
    cursor: pointer;
}

.admin-r-list {
    list-style-type: none;
}

.element-list-item {
    list-style-type: none;
    margin-left: 15px;
    text-align: left;
    max-width: 200px;
}

.element-attr-item {
    list-style-type: none;
    margin-left: 15px;
    text-align: left;
    font-size: 14px;
}

.admin-attr-item {
    background-color: #555555;
    color: #EEEEEE;
    border-radius: 5px 5px 5px 5px;
    height: 32px;
    width: 150px;
    z-index: 10000000;
    margin: 1em 1em 1em 1em;
}

.color {
    display: inline-block;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(3, 1, 1, 0.08);
}

#admin-attr-test {
    position: absolute;
    left: -300px;
}