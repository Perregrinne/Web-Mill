<!DOCTYPE html>
<html>
<head>
<?php
session_start();
//Look for banned IP addresses:
@require_once $_SERVER['DOCUMENT_ROOT'] . "/php/admin/deny_ip.php";
if(!empty($BANNED_IPS) && in_array($_SERVER['REMOTE_ADDR'], $BANNED_IPS)) {
    //Redirect banned IP addresses to Error 403 (Forbidden) page:
    header("location: /pages/error/forbidden.php");
    exit();
}
echo $_SESSION['USERNAME'];
//If already logged in, just redirect to the dashboard:
if (!empty($_SESSION['USERNAME'])) {
    header("Location: /php/dashboard.php");
    exit();
} else {
//We don't want the cookie banner showing on this page:
$EXCLUDE_MENU = true;
//TODO: Devices with more than 25 unsuccessful login attempts are banned for 24 hours
?>
<?php @require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php"); ?>
</head>
<body>
    <div class="login-container">
        <img src="/images/webmill_logo.png" width="128px" height="128px" alt="Web Mill logo"><br>
        <button style="display: inline-block; vertical-align: middle;" class="btn btn-secondary" type="button" onclick="location.href='/'">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
        </button>
        <h2 style="padding: 0.5em; display: inline-block; vertical-align: middle;">Admin Login</h2>
        <div class="container form-signin">
            <?php
                //Reset the message for the login error:
                $login_error = '';
            ?>
        </div>
        <?php
            require $_SERVER['DOCUMENT_ROOT'] . '/php/admin/secrets.php';
            //Verifying username/password:
            if(isset($_POST['LOGIN']) && !empty($_POST['USERNAME']) && !empty($_POST['PASSWORD'])) {
                //If a matching username was found:
                if(array_key_exists($_POST['USERNAME'], $USERS)) {
                    //Check the input password against the password with the same index as the username:
                    if(password_verify($_POST['PASSWORD'], $USERS[$_POST['USERNAME']])) {
                        //If the passwords match, begin the session with the input username
                        $_SESSION['VALID'] = true;
                        $_SESSION['LAST_ACTIVITY'] = time();
                        $_SESSION['USERNAME'] = $_POST['USERNAME'];
                        header('Refresh: 0; URL = /php/dashboard.php');
                    }
                    else {
                        //If the input password doesn't match the username's password found at the same index:
                        $login_error = 'Incorrect username or password';
                        //Log the unsuccessful attempt:
                        logMsg("Incorrect login credentials from " . $_SERVER['REMOTE_ADDR']);
                    }
                }
                else {   
                    //If something was empty:
                    $login_error = 'Username or password was not given';
                    //Log the unsuccessful attempt:
                    logMsg("Failed login attempt from " . $_SERVER['REMOTE_ADDR']);
                }
            }
        ?>
        <div class="container login-form">
            <?php $_SESSION['LAST_ACTIVITY'] = time(); ?>
            <form class="form-signin" role="form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                <h4 class="form-signin-heading"><?php echo $login_error; ?></h4>
                <input type="text" class="form-control" name="USERNAME" placeholder="username" required autofocus>
                <br>
                <input type="password" class="form-control" name="PASSWORD" placeholder="password" required>
                <br>
                <button class="btn btn-lg btn-primary" type="submit" name="LOGIN">Login</button>
            </form>
        </div>
    </div>
<?php
@include_once ($_SERVER['DOCUMENT_ROOT'] . '/php/footer.php');
    } //End for redirect block