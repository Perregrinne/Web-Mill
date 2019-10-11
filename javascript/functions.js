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