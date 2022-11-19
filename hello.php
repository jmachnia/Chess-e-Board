<?php
    session_start();

    if((!isset($_SESSION['successful_registration_whites'])) && (!isset($_SESSION['successful_registration_blacks'])))
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        if(isset($_SESSION['successful_registration_whites']))
        {
            unset($_SESSION['successful_registration_whites']);
        }
        if(isset($_SESSION['successful_registration_blacks']))
        {
            unset($_SESSION['successful_registration_blacks']);
        }
    }

    if(isset($_SESSION['rf_username_whites']))
    {
        unset($_SESSION['rf_username_whites']);
    }
    if(isset($_SESSION['rf_email_whites']))
    {
        unset($_SESSION['rf_email_whites']);
    }
    if(isset($_SESSION['rf_password1_whites']))
    {
        unset($_SESSION['rf_password1_whites']);
    }
    if(isset($_SESSION['rf_password2_whites']))
    {
        unset($_SESSION['rf_password2_whites']);
    }

    if(isset($_SESSION['e_username_whites']))
    {
        unset($_SESSION['e_username_whites']);
    }
    if(isset($_SESSION['e_email_whites']))
    {
        unset($_SESSION['e_email_whites']);
    }
    if(isset($_SESSION['e_password_whites']))
    {
        unset($_SESSION['e_password_whites']);
    }

    if(isset($_SESSION['rf_username_blacks']))
    {
        unset($_SESSION['rf_username_blacks']);
    }
    if(isset($_SESSION['rf_email_blacks']))
    {
        unset($_SESSION['rf_email_blacks']);
    }
    if(isset($_SESSION['rf_password1_blacks']))
    {
        unset($_SESSION['rf_password1_blacks']);
    }
    if(isset($_SESSION['rf_password2_blacks']))
    {
        unset($_SESSION['rf_password2_blacks']);
    }

    if(isset($_SESSION['e_username_blacks']))
    {
        unset($_SESSION['e_username_blacks']);
    }
    if(isset($_SESSION['e_email_blacks']))
    {
        unset($_SESSION['e_email_blacks']);
    }
    if(isset($_SESSION['e_password_blacks']))
    {
        unset($_SESSION['e_password_blacks']);
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Chess e-Board</title>
        <link href="start_page.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        Thanks for registring! You can now log into your new account. <br /><br />
        <?php
            echo '<a href="login_whites.php">Click here to log in (white pieces)</a><br /><br />';
            echo '<a href="login_blacks.php">Click here to log in (black pieces)</a><br /><br />';
            echo '<a href="index.php">Home page</a>';
        ?>
    </body>
</html>