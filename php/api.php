<?php

/*api.php:
/ The API stores all basic functions needed in a Web Mill website.
/ A function calls to one or more functions in functions.php. This
/ api exists to simplify basic actions into a single function call
*/

//TODO: Many existing Web Mill functions could be moved here.
//TODO: At the start, api.php will be tested by Travis-CI and
//      other files will be added after (functions.php, etc).

//make_div() generates a div element on the current web page.
//It optionally takes in a string for its id. If it is empty,
//the div uses a numbering system: "div" + an unused integer,
//starting with 0. Example: "div0", "div1", "div2", and so on

@include_once $_SERVER['DOCUMENT_ROOT'] . '/php/functions.php';

function make_div()
{
    
}

function create_pg_db()
{
    return true;
}

//Checks if PHP can connect to a PostgreSQL database.
//Input: takes in a server name, database name, user name, and password.
//Outputs: Returns true if connection was successful, false if the connection failed.
function check_pg_connect($server, $dbname, $user, $passwd)
{
    $connect = pg_connect("host=$server dbname=$dbname user=$user password=$passwd");
    if(!$connect) //Connection failure
    {
        return false;
    }
    pg_close($connect);
    return true;
}