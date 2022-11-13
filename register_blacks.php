<?php
    session_start();

    if(isset($_POST['email_blacks']))
    {
        $all_good_blacks = true;

        $username_blacks = $_POST['username_blacks'];
        if((strlen($username_blacks) < 4) || (strlen($username_blacks) > 20))
        {
            $all_good_blacks = false;
            $_SESSION['e_username_blacks'] = "Username must not be shorter than 4 and longer than 20 characters.";
        }
        if(ctype_alnum($username_blacks) == false)
        {
            $all_good_blacks = false;
            $_SESSION['e_username_blacks'] = "Username must contain only letters or numbers.";
        }

        $email_blacks = $_POST['email_blacks'];
        $email_blacks_safe = filter_var($email_blacks, FILTER_SANITIZE_EMAIL);
        if((filter_var($email_blacks_safe, FILTER_VALIDATE_EMAIL) == false) || ($email_blacks_safe != $email_blacks))
        {
            $all_good_blacks = false;
            $_SESSION['e_email_blacks'] = "Insert a valid e-mail address.";
        }

        $password1_blacks = $_POST['password1_blacks'];
        $password2_blacks = $_POST['password2_blacks'];
        if((strlen($password1_blacks) < 8) || (strlen($password1_blacks) > 20))
        {
            $all_good_blacks = false;
            $_SESSION['e_password_blacks'] = "Password must not be shorter than 8 and longer than 20 characters.";
        }
        if($password1_blacks != $password2_blacks)
        {
            $all_good_blacks = false;
            $_SESSION['e_password_blacks'] = "Both passwords must be identical.";
        }
        $password_hash_blacks = password_hash($password1_blacks, PASSWORD_DEFAULT);

        $_SESSION['rf_username_blacks'] = $username_blacks;
        $_SESSION['rf_email_blacks'] = $email_blacks;
        $_SESSION['rf_password1_blacks'] = $password1_blacks;
        $_SESSION['rf_password2_blacks'] = $password2_blacks;

        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try
        {
            $connection = new mysqli($host, $db_user, $db_password, $db_name);
            if($connection->connect_errno != 0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $result = $connection->query("SELECT id FROM users WHERE email='$email_blacks'");
                if(!$result)
                {
                    throw new Exception($connection->error);
                }
                $num_emails = $result->num_rows;
                if($num_emails > 0)
                {
                    $all_good_blacks = false;
                    $_SESSION['e_email_blacks'] = "Account linked with this e-mail already exists.";
                }

                $result = $connection->query("SELECT id FROM users WHERE username='$username_blacks'");
                if(!$result)
                {
                    throw new Exception($connection->error);
                }
                $num_usernames = $result->num_rows;
                if($num_usernames > 0)
                {
                    $all_good_blacks = false;
                    $_SESSION['e_username_blacks'] = "This username is already taken.";
                }

                if($all_good_blacks == true)
                {
                    if($connection->query("INSERT INTO users VALUES (NULL, '$username_blacks', '$email_blacks', '$password_hash_blacks')"))
                    {
                        $_SESSION['successful_registration_blacks'] = true;
                        header('Location: hello.php');
                    }
                    else
                    {
                        throw new Exception($connection->error);
                    }
                }

                $connection->close();
            }
        }
        catch(Exception $e)
        {
            echo '<span style="color:red">Server error. Sorry.</span>';
            echo '<br />Dev info:'.$e;
        }
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Chess e-Board</title>
        <link href="start_page.css" type="text/css" rel="stylesheet" />
        <style>
            .error 
            {
                color:red;
                margin-top: 10px;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
    <h2>Registration Page</h2>
    <h4>Black pieces</h4>
        <a href = "index.php">Click here to go back</a><br /><br />
        <div id="form">
            <form method = "post">
                Enter username: <br /><input type = "text" value = "<?php
                if(isset($_SESSION['rf_username_blacks']))
                {
                    echo $_SESSION['rf_username_blacks'];
                    unset($_SESSION['rf_username_blacks']);
                }
                ?>" name = "username_blacks" required = "required"/><br />
                <?php
                    if(isset($_SESSION['e_username_blacks']))
                    {
                        echo '<div class="error">'.$_SESSION['e_username_blacks'].'</div>';
                        unset($_SESSION['e_username_blacks']);
                    }
                ?>

                Enter e-mail: <br /><input type = "text" value = "<?php
                if(isset($_SESSION['rf_email_blacks']))
                {
                    echo $_SESSION['rf_email_blacks'];
                    unset($_SESSION['rf_email_blacks']);
                }
                ?>" name = "email_blacks" required = "required"/><br />
                <?php
                    if(isset($_SESSION['e_email_blacks']))
                    {
                        echo '<div class="error">'.$_SESSION['e_email_blacks'].'</div>';
                        unset($_SESSION['e_email_blacks']);
                    }
                ?>

                Enter password: <br /><input type = "password" value = "<?php
                if(isset($_SESSION['rf_password1_blacks']))
                {
                    echo $_SESSION['rf_password1_blacks'];
                    unset($_SESSION['rf_password1_blacks']);
                }
                ?>" name = "password1_blacks" required = "required"/><br />
                <?php
                    if(isset($_SESSION['e_password_blacks']))
                    {
                        echo '<div class="error">'.$_SESSION['e_password_blacks'].'</div>';
                        unset($_SESSION['e_password_blacks']);
                    }
                ?>

                Repeat password: <br /><input type = "password" value = "<?php
                if(isset($_SESSION['rf_password2_blacks']))
                {
                    echo $_SESSION['rf_password2_blacks'];
                    unset($_SESSION['rf_password2_blacks']);
                }
                ?>" name = "password2_blacks" required = "required"/><br />

                <br /><input type = "submit" value = "Register"/>
            </form>
        </div>
    </body>
</html>