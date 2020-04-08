<?php
    header("Content-type: text/css"); 
    include ($_SERVER['DOCUMENT_ROOT']."/php/admin/config.php");

    //This file contains the css used by the admin script.
?>

/* Responsive values are modified here */

/* 0px - 499px */
@media all and (max-width: 499px) {
    #admin-l-menu {
        left: -100px;
        width: 100px;
        position: fixed;
        background-color: <?= $CONTAINER_COLOR ?>;
        color: #CCCCCC;
        top: 0%;
        bottom: 0%;
        -webkit-animation: appear 1s;
        -moz-animation: appear 1s;
        -ms-animation: appear 1s;
        -o-animation: appear 1s;
        animation: appear 1s;
        z-index: 10000;
        padding: 5px 5px 5px 5px;
        overflow: hidden;
    }

    #admin-l-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
    }

    #admin-l-control {
        background: url("/php/cms-img/gt.png");
        background-repeat: no-repeat;
        background-position: center;
        position: fixed;
        top: 50%;
        left: 0;
        width: 50px;
        border-radius: 0 10px 10px 0;
        transform: translate(0%, -50%);
        background-color: <?= $CONTAINER_COLOR ?>;
        text-align: center;
        color: #0F0F0F;
        font-size: 42px;
        z-index: 10000;
        overflow: hidden;
    }

    #admin-l-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
        cursor: pointer;
    }


    #admin-r-menu {
        right: -100px;
        width: 100px;
        position: fixed;
        background-color: <?= $CONTAINER_COLOR ?>;
        color: #CCCCCC;
        top: 0%;
        bottom: 0%;
        -webkit-animation: appear 1s;
        -moz-animation: appear 1s;
        -ms-animation: appear 1s;
        -o-animation: appear 1s;
        animation: appear 1s;
        z-index: 10000;
        overflow: hidden;
    }

    #admin-r-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
    }

    #admin-r-control {
        background: url("/php/cms-img/lt.png");
        background-repeat: no-repeat;
        background-position: center;
        position: fixed;
        top: 50%;
        right: 0;
        width: 50px;
        border-radius: 10px 0 0 10px;
        transform: translate(0%, -50%);
        background-color: <?= $CONTAINER_COLOR ?>;
        text-align: center;
        color: #0F0F0F;
        font-size: 42px;
        z-index: 10000;
        overflow: hidden;
    }

    #admin-r-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
        cursor: pointer;
    }
}

/* 500px - 1079px */
@media all and (min-width: 450px) and (max-width: 1079px) {
    #admin-l-menu {
        left: -200px;
        width: 200px;
        position: fixed;
        background-color: <?= $CONTAINER_COLOR ?>;
        color: #CCCCCC;
        top: 0%;
        bottom: 0%;
        -webkit-animation: appear 1s;
        -moz-animation: appear 1s;
        -ms-animation: appear 1s;
        -o-animation: appear 1s;
        animation: appear 1s;
        z-index: 10000;
        padding: 10px 10px 10px 10px;
        overflow: hidden;
    }

    #admin-l-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
    }

    #admin-l-control {
        background: url("/php/cms-img/gt.png");
        background-repeat: no-repeat;
        background-position: center;
        position: fixed;
        top: 50%;
        left: 0;
        width: 50px;
        border-radius: 0 10px 10px 0;
        transform: translate(0%, -50%);
        background-color: <?= $CONTAINER_COLOR ?>;
        text-align: center;
        color: #0F0F0F;
        font-size: 42px;
        z-index: 10000;
        overflow: hidden;
    }

    #admin-l-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
        cursor: pointer;
    }


    #admin-r-menu {
        right: -200px;
        width: 200px;
        position: fixed;
        background-color: <?= $CONTAINER_COLOR ?>;
        color: #CCCCCC;
        top: 0%;
        bottom: 0%;
        -webkit-animation: appear 1s;
        -moz-animation: appear 1s;
        -ms-animation: appear 1s;
        -o-animation: appear 1s;
        animation: appear 1s;
        z-index: 10000;
        overflow: hidden;
    }

    #admin-r-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
    }

    #admin-r-control {
        background: url("/php/cms-img/lt.png");
        background-repeat: no-repeat;
        background-position: center;
        position: fixed;
        top: 50%;
        right: 0;
        width: 50px;
        border-radius: 10px 0 0 10px;
        transform: translate(0%, -50%);
        background-color: <?= $CONTAINER_COLOR ?>;
        text-align: center;
        color: #0F0F0F;
        font-size: 42px;
        z-index: 10000;
        overflow: hidden;
    }

    #admin-r-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
        cursor: pointer;
    }
}

/* 1080px - ... */
@media all and (min-width: 1080px) {
    #admin-l-menu {
        left: -400px;
        width: 400px;
        position: fixed;
        background-color: <?= $CONTAINER_COLOR ?>;
        color: #CCCCCC;
        top: 0%;
        bottom: 0%;
        -webkit-animation: appear 1s;
        -moz-animation: appear 1s;
        -ms-animation: appear 1s;
        -o-animation: appear 1s;
        animation: appear 1s;
        z-index: 10000;
        padding: 25px 25px 25px 25px;
        overflow: hidden;
    }

    #admin-l-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
    }

    #admin-l-control {
        background: url("/php/cms-img/gt.png");
        background-repeat: no-repeat;
        background-position: center;
        position: fixed;
        top: 50%;
        left: 0;
        width: 50px;
        border-radius: 0 10px 10px 0;
        transform: translate(0%, -50%);
        background-color: <?= $CONTAINER_COLOR ?>;
        text-align: center;
        color: #0F0F0F;
        font-size: 42px;
        z-index: 10000;
        overflow: hidden;
    }

    #admin-l-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
        cursor: pointer;
    }


    #admin-r-menu {
        right: -400px;
        width: 400px;
        position: fixed;
        background-color: <?= $CONTAINER_COLOR ?>;
        color: #CCCCCC;
        top: 0%;
        bottom: 0%;
        -webkit-animation: appear 1s;
        -moz-animation: appear 1s;
        -ms-animation: appear 1s;
        -o-animation: appear 1s;
        animation: appear 1s;
        z-index: 10000;
        overflow: hidden;
    }

    #admin-r-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
    }

    #admin-r-control {
        background: url("/php/cms-img/lt.png");
        background-repeat: no-repeat;
        background-position: center;
        position: fixed;
        top: 50%;
        right: 0;
        width: 50px;
        border-radius: 10px 0 0 10px;
        transform: translate(0%, -50%);
        background-color: <?= $CONTAINER_COLOR ?>;
        text-align: center;
        color: #0F0F0F;
        font-size: 42px;
        z-index: 10000;
        overflow: hidden;
    }

    #admin-r-control:hover {
        background-color: <?= $CONTAINER_HOVER ?>;
        cursor: pointer;
    }

    .pages-ul {
        margin-bottom: 0;
    }

    #admin-pages {
        margin-top: 15px;
        border-radius: 10px;
        border: 1px solid #DDD;
        padding: 10px; 
    }

    #admin-elem {
        margin: 15px;
        border-radius: 10px;
        border: 1px solid #DDD;
        padding: 10px;
    }

    .admin-li {
        list-style-type: none;
    }

    #cookie-privacy {
        position: static;
    }

    #cookie-ok {
        margin-left: 5px;
    }
}


/*
TODO: 
- Organize this mess of a css doc.
    - Get rid of these extra lines and commented out code.
- Ensure that the changed classes and elements by Id are consistently changed at all 3 levels of resolution.
- Actually make use of the fact that this utilizes php.
    - Incorporate light/dark themes.
    - Save theme colors user commonly uses in the website?
*/







/*
#admin-l-menu {
    position: fixed;
    background-color: <?= $CONTAINER_COLOR ?>;
    color: #CCCCCC;
    top: 0%;
    bottom: 0%;
    -webkit-animation: appear 1s;
    -moz-animation: appear 1s;
    -ms-animation: appear 1s;
    -o-animation: appear 1s;
    animation: appear 1s;
    z-index: 10000;
}

#admin-l-control:hover {
    background-color: <?= $CONTAINER_HOVER ?>;
}

#admin-l-control {
    background: url("/php/cms-img/lt.png");
    background-repeat: no-repeat;
    background-position: center;
    position: fixed;
    top: 50%;
    right: -50px;
    width: 50px;
    border-radius: 0 10px 10px 0;
    transform: translate(0%, -50%);
    background-color: <?= $CONTAINER_COLOR ?>;
    text-align: center;
    color: #0F0F0F;
    font-size: 42px;
    overflow: hidden;
}

#admin-l-control:hover {
    background-color: <?= $CONTAINER_HOVER ?>;
    cursor: pointer;
}
*/

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

/*
#admin-r-menu {
    position: fixed;
    top: 0%;
    bottom: 0%;
    right: -200px;
    width: 200px;
    -webkit-animation: appear 1s;
    -moz-animation: appear 1s;
    -ms-animation: appear 1s;
    -o-animation: appear 1s;
    animation: appear 1s;
    z-index: 10000;
}

#admin-r-control {
    position: fixed;
    top: 50%;
    left: 0;
    border-radius: 10px 0 0 10px;
    transform: translate(0%, -50%);
    background-color: <?= $CONTAINER_COLOR ?>;
    text-align: center;
    color: #0F0F0F;
    font-size: 42px;
    overflow: hidden;
    z-index: 10000;
}

#admin-r-control:hover {
    background-color: <?= $CONTAINER_HOVER ?>;
    cursor: pointer;
}
*/

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
.wm-link{
    text-decoration: none;
    color: #FFF;
}
.wm-link:hover {
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
    min-height: 44%;
    max-height: 47%;
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
    width: 175px;
}

.color {
    display: inline-block;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(3, 1, 1, 0.08);
}

#admin-attr-test {
    position: absolute;
    left: -300px;
}

.form-control {
    max-width: 175px;
    background-color: #555555;
    color: #EEEEEE;
    z-index: 10;
}

/*Database.php*/
#database-manager {
    margin-left: 65px;
}
h3, select {
    margin-left: 65px;
    margin-bottom: 25px;
    z-index: -1;
}
select {
    color: #DDDDDD;
    background-color: #333333;
    min-width: 150px;
    z-index: -1;
}
#database-break {
    border-color: #CCCCCC;
    z-index: -1;
}
#table-default {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    margin: 0 65px 0 65px;
    max-width: 100%;
    min-width: 90%;
    z-index: -1;
}
input {
    font-family: arial, sans-serif;
    border: none;
    outline: 1px solid #333333;
    color: #DDDDDD;
    background-color: #555555;
    z-index: -1;
    padding: 5px;
}
td, th {
    border: 2px solid #222222;
    text-align: left;
    padding: 8px;
    min-width: 25px;
    max-width: 100px;
    z-index: -1;
}
#new-col {
    /*background-color: #33AA33;*/
    background-image: linear-gradient(#55EE55, #118811);
    cursor: pointer;
}
#new-col:hover {
    /*background-color: #33CC33;*/
    background-image: linear-gradient(#66FF66, #11AA11);
}
tr:nth-child(even) {
    background-color: #555555;
    z-index: -1;
}
tr:nth-child(odd) {
    background-color: #333333;
    z-index: -1;
}
#new-datatable-bttn {
    position: absolute;
    left: 49%;
    margin-top: 1em;
    background-image: linear-gradient(#55EE55, #118811);
    cursor: pointer;
}
#new-datatable-bttn:hover {
    position: absolute;
    left: 49%;
    margin-top: 1em;
    background-image: linear-gradient(#66FF66, #11AA11);
}

/*texteditor.php*/
#text-page-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #DDD;
}
#menu-bar {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 8%;
    background-color: #AAA;
    z-index: 2;
}
#text-container {
    position: absolute;
    left: 50px;
    right: 50px;
    top: 0;
    bottom: 0;
    overflow: auto;
}
#line-number {
    position: absolute;
    display: inline-block;
    bottom: 16px;
    top: 8%;
    width: 44px;
    margin-left: 4px;
}
#line-border {
    position: fixed;
    width: 1px;
    top: 8%;
    bottom: 8px;
    left: 98px;
    background-color: #000;
    z-index: 3;
}
#text-field {
    margin: 0;
    padding: 0 0.25em 0.25em 0.5em;
    position: absolute;
    left: 48px;
    right: 0;
    top: 8%;
    bottom: 0;
    background-color: #DDD;
    overflow: hidden;
    outline: none;
    font-family: "Lucida Console", serif;
}
body {
    position: absolute;
    top: 0;
}

/*Text Editor*/
.editor-bttn{
    display: inline-block;
    padding: 10px;
    margin: 10px 10px 15px 0;
    min-width: 85px;
    text-align: center;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 5px;
}
.editor-bttn:hover{
    background-color: rgba(255, 255, 255, 0.2);
}