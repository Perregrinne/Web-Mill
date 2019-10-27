//Returns cookie data
function getCookie(cookie)
{
    //Look for the cookie's name, followed by "=". The line with the cookie will start with "; " (; and a space)
    var str = new RegExp(cookie + "=([^;\s]+)");
    //Search cookies for the specified regular expression
    var value = str.exec(document.cookie);
    //If it's found, return it. Otherwise, return null
    return (typeof value !== 'undefined' && value !== null) ? decodeURI(value[1]) : "";
}

//Writes a new cookie
function setCookie(cookie, value, exp)
{
    //Fetch the current date
    var expireDate = new Date();
    //The cookie will expire in "exp" number of days
    expireDate.setDate(expireDate.getDate() + exp);
    //Write the cookie
    document.cookie = cookie + "=" + encodeURI(value) + ";expires=" + expireDate.toUTCString() + ";path=/;";
}

//Create a new PHP page (this is the javascript portion)
function createPHP(name)
{
    //Strip it of its extension, if it has one.
    name = name.substring(0, lastIndexOf("."));
    //Ajax the server to tell it to create the new php page.
    var request = new XMLHttpRequest();
    //We don't need to check for state changes here because PHP will change the page or handle errors.
    //Make the request to functions.php, which will handle the page creation.
    request.open("GET", "/php/functions.php?q=createPage&name=" + name, true);
    request.send();
}