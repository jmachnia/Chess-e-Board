<?php

session_start();

if((!isset($_POST['username_whites'])) || (!isset($_POST['password_whites'])))
{
    header('Location: blacks_logged_in.php');

    exit();
}

require_once "connect.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if($connection->connect_errno != 0)
{
    echo "Error: ".$connection->connect_errno;
}
else
{
    $username_whites = $_POST['username_whites'];
    $password_whites = $_POST['password_whites'];

    $username_whites = htmlentities($username_whites, ENT_QUOTES, "UTF-8");

    if($username_whites != $_SESSION['username_blacks'])
    {
        if($result = @$connection->query(sprintf("SELECT * FROM users WHERE username='%s'",
            mysqli_real_escape_string($connection, $username_whites))))
        {
            $num_users = $result->num_rows;
            if($num_users > 0)
            {
                $row = $result->fetch_assoc();

                if(password_verify($password_whites, $row['password']))
                {
                    $_SESSION['logged_in_whites'] = true;

                    $_SESSION['id_whites'] = $row['id'];
                    $_SESSION['username_whites'] = $row['username'];
                    $_SESSION['email_whites'] = $row['email'];

                    unset($_SESSION['error_whites']);

                    $result->free_result();

                    if((isset($_SESSION['logged_in_blacks'])) && ($_SESSION['logged_in_blacks'] == true))
                    {
                        header("Location: game.php");
                    }
                    else
                    {
                        header('Location: whites_logged_in.php');
                    }
                }
                else
                {
                    $_SESSION['error_whites'] = '<span style="color:red">Incorrect username or password</span>';

                    header('Location: blacks_logged_in.php');
                }
            }
            else
            {
                $_SESSION['error_whites'] = '<span style="color:red">Incorrect username or password</span>';

                header('Location: blacks_logged_in.php');
            }
        }
    }
    else
    {
        $_SESSION['error_whites'] = '<span style="color:red">This username is already logged in</span>';

        header('Location: blacks_logged_in.php');
    }

    $connection->close();
}

?>