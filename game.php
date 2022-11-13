<?php
    session_start();

    if((!isset($_SESSION['logged_in_whites'])) && (!isset($_SESSION['logged_in_blacks'])))
    {
        header('Location: index.php');
        exit();
    }
    if((isset($_SESSION['logged_in_whites'])) && (!isset($_SESSION['logged_in_blacks'])))
    {
        header('Location: whites_logged_in.php');
    }
    if((!isset($_SESSION['logged_in_whites'])) && (isset($_SESSION['logged_in_blacks'])))
    {
        header('Location: blacks_logged_in.php');
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Chess e-Board</title>
        <link href="start_page.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <?php
            echo "<p>hello ".$_SESSION['username_whites']."</p>";
            echo '<p><a href="logout_whites.php">Logout</a></p>';

            echo "<p>hello ".$_SESSION['username_blacks']."</p>";
            echo '<p><a href="logout_blacks.php">Logout</a></p>';

            echo '<p><a href="logout_both_players.php">Logout both</a></p>';
        ?>
    </body>
</html>