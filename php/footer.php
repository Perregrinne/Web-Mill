<?php 
//Show the cookie banner, but not if the user is on an admin page (in which case, $EXCLUDE_MENU is set)
    if(!isset($EXCLUDE_MENU)) {
        include_once ($_SERVER['DOCUMENT_ROOT'] . "/php/cookie_banner_html.php");
    }
    //Honestly, this could have been joined with the cookie_banner_js.php file, but I would prefer to stay
    //consistent and keep the two separate. This way I can better ensure CSS/Head tags go first, then body
    //tags, and lastly, the javascript. This won't matter because these are all on the development side of
    //the website. The production side will render out all the relevant PHP files into a single .php page.
?>
<script>
    //Returns cookie data
    function getCookie(cookie) {
        //Look for the cookie's name, followed by "=". The line with the cookie will start with "; " (; and a space)
        var str = new RegExp(cookie + "=([^;\s]+)");
        //Search cookies for the specified regular expression
        var value = str.exec(document.cookie);
        //If it's found, return it. Otherwise, return null
        return (typeof value !== 'undefined' && value !== null) ? decodeURI(value[1]) : "";
    }

    //Writes a new cookie
    function setCookie(cookie, value, exp) {
        //Fetch the current date
        var expireDate = new Date();
        //The cookie will expire in "exp" number of days
        expireDate.setDate(expireDate.getDate() + exp);
        //Write the cookie
        document.cookie = cookie + "=" + encodeURI(value) + ";expires=" + expireDate.toUTCString() + ";path=/;";
    }
</script>
<script src="/javascript/clock.js" onload="getTime(); setInterval('getTime()', 1000);"></script>
<?php 
//Show the cookie banner, but not if the user is on an admin page (in which case, $EXCLUDE_MENU is set)
    if(!isset($EXCLUDE_MENU)) {
        include_once ($_SERVER['DOCUMENT_ROOT'] . "/php/cookie_banner_js.php");
    }
?>
</body>
</html>
