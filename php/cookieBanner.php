<script src="/javascript/functions.js"></script>
<div id="cookie-banner">
    <p id="cookie-text">
        This site uses cookies. Check our <a href="/pages/tos.php">privacy policy</a> for more information.
        <button id="cookie-ok" onclick="hideBanner()">OK</button>
    </p>
</div>
<script>
//If the cookie policy has already been accepted, just hide the banner
if(getCookie("cookie_policy_accepted") === "true")
{
    document.getElementById("cookie-banner").style.visibility = "hidden";
}

//When the "OK" button in the cookie banner is clicked:
function hideBanner() {
    //Hide the banner
    document.getElementById("cookie-banner").style.visibility = "hidden";
    //And set a cookie to remember it was already accepted.
    setCookie("cookie_policy_accepted", true, 30);
}
</script>