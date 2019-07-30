<?php 
    header("Content-type: text/css"); 
    include ($_SERVER['DOCUMENT_ROOT']."/php/admin/config.php");
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

#admin-r-control:hover {
    background-color: <?= $CONTAINER_HOVER ?>;
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
}

#mainText {
    position: absolute;
    width: 250px;
    left: 100px;
}

#adminLink {
    left: 100px;
}

#clock {
    left: 100px;
}

.clones {
    position: static;
}

.nested {
    position: absolute;
    left: 0;
}

.list-menu {
    margin: 10px 10px 10px 10px;
    padding: 10px 0 10px 0;
    border-style: solid;
    border-width: 1px;
    border-color: #DDDDDD;
    border-radius: 10px 10px 10px 10px;
}

body {
    width: 100%;
    height: 100%;
}