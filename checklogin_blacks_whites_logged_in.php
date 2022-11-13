<?php

session_start();

if((!isset($_POST['username_blacks'])) || (!isset($_POST['password_blacks'])))
{
    header('Location: whites_logged_in.php');

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
    $username_blacks = $_POST['username_blacks'];
    $password_blacks = $_POST['password_blacks'];

    $username_blacks = htmlentities($username_blacks, ENT_QUOTES, "UTF-8");

    if($username_blacks != $_SESSION['username_whites'])
    {
        if($result = @$connection->query(sprintf("SELECT * FROM users WHERE username='%s'",
            mysqli_real_escape_string($connection, $username_blacks))))
        {
            $num_users = $result->num_rows;
            if($num_users > 0)
            {
                $row = $result->fetch_assoc();

                if(password_verify($password_blacks, $row['password']))
                {
                    $_SESSION['logged_in_blacks'] = true;

                    $_SESSION['id_blacks'] = $row['id'];
                    $_SESSION['username_blacks'] = $row['username'];
                    $_SESSION['email_blacks'] = $row['email'];

                    unset($_SESSION['error_blacks']);

                    $result->free_result();

                    if((isset($_SESSION['logged_in_whites'])) && ($_SESSION['logged_in_whites'] == true))
                    {
                        header("Location: game.php");
                    }
                    else
                    {
                        header('Location: blacks_logged_in.php');
                    }
                }
                else
                {
                    $_SESSION['error_blacks'] = '<span style="color:red">Incorrect username or password</span>';

                    header('Location: whites_logged_in.php');
                }
            }
            else
            {
                $_SESSION['error_blacks'] = '<span style="color:red">Incorrect username or password</span>';

                header('Location: whites_logged_in.php');
            }
        }
    }
    else
    {
        $_SESSION['error_blacks'] = '<span style="color:red">This player is already logged in</span>';

        header('Location: whites_logged_in.php');
    }

    $connection->close();
}

?>