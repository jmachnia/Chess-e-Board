<?php
    session_start();

    if((isset($_SESSION['logged_in_blacks'])) && ($_SESSION['logged_in_blacks'] == true))
    {
        if((isset($_SESSION['logged_in_whites'])) && ($_SESSION['logged_in_whites'] == true))
        {
            header('Location: game.php');
            exit();
        }
    }

    if((isset($_SESSION['logged_in_whites'])) && ($_SESSION['logged_in_whites'] == true))
    {
        header('Location: whites_logged_in.php');
    }

    if((isset($_SESSION['blacks_logged_in'])) && ($_SESSION['blacks_logged_in'] == true))
    {
        header('Location: blacks_logged_in.php');
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Chess e-board</title>
        <meta name="description"
            content="Website for service of an electronic chess board" />
        <meta name="keywords"
            content="chess, electronic chess board, diy" />
        <meta name="robots"
            content="nofollow" />
        <meta http-equiv="author"
            content="Jonasz Machnia" />
        <meta http-equiv="pragma"
            content="no-cache" />
        <link href="start_page.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <h1 class="header">Electronic chess board</h1>
        <h3 class="header">Who's playing?</h3>
        <div id="player">
            <h4 class="header">Player 1 (white pieces)</h4>
            <a href="login_whites.php">Click here to login</a><br />
            <a href="register_whites.php">Click here to register</a><br />
            <?php
                if(isset($_SESSION['error_whites']))
                {
                    echo $_SESSION['error_whites'];
                }
            ?>
        </div>
        <div id="player">
            <h4 class="header">Player 2 (black pieces)</h4>
            <a href="login_blacks.php">Click here to login</a><br />
            <a href="register_blacks.php">Click here to register</a><br />
            <?php
                if(isset($_SESSION['error_blacks']))
                {
                    echo $_SESSION['error_blacks'];
                }
            ?>
        </div>
    </body>
</html>