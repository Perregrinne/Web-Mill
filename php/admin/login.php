<?php 
    @ include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");
?>
<head>
</head>
<body>
    <h2>Enter Username and Password</h2> 
        <div class = "container form-signin">
            <?php
                //Reset the message for the login error:
                $login_error = '';
            ?>
        </div>
        <?php
            require ($_SERVER['DOCUMENT_ROOT'] . '/php/admin/secrets.php');

            //Verifying username/password:
            if (isset($_POST['LOGIN']) && !empty($_POST['USERNAME']) && !empty($_POST['PASSWORD'])) 
            {
                //If a matching username was found:
                if(array_key_exists($_POST['USERNAME'], $USERS))
                {
                    //Check the input password against the password with the same index as the username:
                    if(password_verify($_POST['PASSWORD'], $USERS[$_POST['USERNAME']]))
                    {
                        //If the passwords match, begin the session with the input username
                        $_SESSION['VALID'] = true;
                        $_SESSION['LAST_ACTIVITY'] = time();
                        $_SESSION['USERNAME'] = $_POST['USERNAME'];
                        //Redirect back to index.php, where it will now have the admin bar:
                        header('Refresh: 0; URL = /index.php');
                    }
                    else
                    {
                        //If the input password doesn't match the username's password found at the same index:
                        $login_error = 'Incorrect username or password';
                    }
                }
                else 
                {   
                    //If no matching username was found:
                    $login_error = 'Incorrect username or password';
                }
            }
        ?>
        <div class = "container">
            <?php $_SESSION['LAST_ACTIVITY'] = time(); ?>
            <form class = "form-signin" role = "form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                <h4 class = "form-signin-heading"><?php echo $login_error; ?></h4>
                <input type = "text" class = "form-control" name = "USERNAME" placeholder = "username" required autofocus>
                <br>
                <input type = "password" class = "form-control" name = "PASSWORD" placeholder = "password" required>
                <br>
                <button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "LOGIN">Login</button>
            </form>
        </div> 
</body>