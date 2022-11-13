<?php
    session_start();

    if(isset($_POST['email_whites']))
    {
        $all_good_whites = true;

        $username_whites = $_POST['username_whites'];
        if((strlen($username_whites) < 4) || (strlen($username_whites) > 20))
        {
            $all_good_whites = false;
            $_SESSION['e_username_whites'] = "Username must not be shorter than 4 and longer than 20 characters.";
        }
        if(ctype_alnum($username_whites) == false)
        {
            $all_good_whites = false;
            $_SESSION['e_username_whites'] = "Username must contain only letters or numbers.";
        }

        $email_whites = $_POST['email_whites'];
        $email_whites_safe = filter_var($email_whites, FILTER_SANITIZE_EMAIL);
        if((filter_var($email_whites_safe, FILTER_VALIDATE_EMAIL) == false) || ($email_whites_safe != $email_whites))
        {
            $all_good_whites = false;
            $_SESSION['e_email_whites'] = "Insert a valid e-mail address.";
        }

        $password1_whites = $_POST['password1_whites'];
        $password2_whites = $_POST['password2_whites'];
        if((strlen($password1_whites) < 8) || (strlen($password1_whites) > 20))
        {
            $all_good_whites = false;
            $_SESSION['e_password_whites'] = "Password must not be shorter than 8 and longer than 20 characters.";
        }
        if($password1_whites != $password2_whites)
        {
            $all_good_whites = false;
            $_SESSION['e_password_whites'] = "Both passwords must be identical.";
        }
        $password_hash_whites = password_hash($password1_whites, PASSWORD_DEFAULT);

        $_SESSION['rf_username_whites'] = $username_whites;
        $_SESSION['rf_email_whites'] = $email_whites;
        $_SESSION['rf_password1_whites'] = $password1_whites;
        $_SESSION['rf_password2_whites'] = $password2_whites;

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
                $result = $connection->query("SELECT id FROM users WHERE email='$email_whites'");
                if(!$result)
                {
                    throw new Exception($connection->error);
                }
                $num_emails = $result->num_rows;
                if($num_emails > 0)
                {
                    $all_good_whites = false;
                    $_SESSION['e_email_whites'] = "Account linked with this e-mail already exists.";
                }

                $result = $connection->query("SELECT id FROM users WHERE username='$username_whites'");
                if(!$result)
                {
                    throw new Exception($connection->error);
                }
                $num_usernames = $result->num_rows;
                if($num_usernames > 0)
                {
                    $all_good_whites = false;
                    $_SESSION['e_username_whites'] = "This username is already taken.";
                }

                if($all_good_whites == true)
                {
                    if($connection->query("INSERT INTO users VALUES (NULL, '$username_whites', '$email_whites', '$password_hash_whites')"))
                    {
                        $_SESSION['successful_registration_whites'] = true;
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
    <h4>White pieces</h4>
        <a href = "index.php">Click here to go back</a><br /><br />
        <div id="form">
            <form method = "post">
                Enter username: <br /><input type = "text" value = "<?php
                if(isset($_SESSION['rf_username_whites']))
                {
                    echo $_SESSION['rf_username_whites'];
                    unset($_SESSION['rf_username_whites']);
                }
                ?>" name = "username_whites" required = "required"/><br />
                <?php
                    if(isset($_SESSION['e_username_whites']))
                    {
                        echo '<div class="error">'.$_SESSION['e_username_whites'].'</div>';
                        unset($_SESSION['e_username_whites']);
                    }
                ?>

                Enter e-mail: <br /><input type = "text" value = "<?php
                if(isset($_SESSION['rf_email_whites']))
                {
                    echo $_SESSION['rf_email_whites'];
                    unset($_SESSION['rf_email_whites']);
                }
                ?>" name = "email_whites" required = "required"/><br />
                <?php
                    if(isset($_SESSION['e_email_whites']))
                    {
                        echo '<div class="error">'.$_SESSION['e_email_whites'].'</div>';
                        unset($_SESSION['e_email_whites']);
                    }
                ?>

                Enter password: <br /><input type = "password" value = "<?php
                if(isset($_SESSION['rf_password1_whites']))
                {
                    echo $_SESSION['rf_password1_whites'];
                    unset($_SESSION['rf_password1_whites']);
                }
                ?>" name = "password1_whites" required = "required"/><br />
                <?php
                    if(isset($_SESSION['e_password_whites']))
                    {
                        echo '<div class="error">'.$_SESSION['e_password_whites'].'</div>';
                        unset($_SESSION['e_password_whites']);
                    }
                ?>

                Repeat password: <br /><input type = "password" value = "<?php
                if(isset($_SESSION['rf_password2_whites']))
                {
                    echo $_SESSION['rf_password2_whites'];
                    unset($_SESSION['rf_password2_whites']);
                }
                ?>" name = "password2_whites" required = "required"/><br />

                <br /><input type = "submit" value = "Register"/>
            </form>
        </div>
    </body>
</html>