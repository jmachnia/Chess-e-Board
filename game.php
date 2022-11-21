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
        <link href="game.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <h1 class="header">Electronic chess board</h1>
        <p><a href="logout_both_players.php">Logout both</a></p>
        <div id="getFEN">
            <p><button type="button">Get FEN code</button></p>
        </div>
        <div id="box">
            <div id="timer">
                <text class="timer-blacks">0:00</text>
                <text class="timer-whites">0:00</text>
            </div>
            <div id="username">
                <?php
                    echo $_SESSION['username_blacks'];
                ?>
            </div>
            <div id="board" style="background-image:url('images/chess_board1.png');">
                <svg viewBox="0 0 100 100" class="coordinates">
                    <text x="0.75" y="3.5" font-size="2.8" class="coordinate-light">8</text>
                    <text x="0.75" y="15.75" font-size="2.8" class="coordinate-dark">7</text>
                    <text x="0.75" y="28.25" font-size="2.8" class="coordinate-light">6</text>
                    <text x="0.75" y="40.75" font-size="2.8" class="coordinate-dark">5</text>
                    <text x="0.75" y="53.25" font-size="2.8" class="coordinate-light">4</text>
                    <text x="0.75" y="65.75" font-size="2.8" class="coordinate-dark">3</text>
                    <text x="0.75" y="78.25" font-size="2.8" class="coordinate-light">2</text>
                    <text x="0.75" y="90.75" font-size="2.8" class="coordinate-dark">1</text>
                    <text x="10" y="99" font-size="2.8" class="coordinate-dark">a</text>
                    <text x="22.5" y="99" font-size="2.8" class="coordinate-light">b</text>
                    <text x="35" y="99" font-size="2.8" class="coordinate-dark">c</text>
                    <text x="47.5" y="99" font-size="2.8" class="coordinate-light">d</text>
                    <text x="60" y="99" font-size="2.8" class="coordinate-dark">e</text>
                    <text x="72.5" y="99" font-size="2.8" class="coordinate-light">f</text>
                    <text x="85" y="99" font-size="2.8" class="coordinate-dark">g</text>
                    <text x="97.5" y="99" font-size="2.8" class="coordinate-light">h</text>
                </svg>

                <img class="piece br square-88" src="images/black_rook.png" />
                <img class="piece bn square-78" src="images/black_knight.png" />
                <img class="piece bb square-68" src="images/black_bishop.png" />
                <img class="piece bq square-58" src="images/black_queen.png" />
                <img class="piece bk square-48" src="images/black_king.png" />
                <img class="piece bb square-38" src="images/black_bishop.png" />
                <img class="piece bn square-28" src="images/black_knight.png" />
                <img class="piece br square-18" src="images/black_rook.png" />
                <img class="piece bp square-87" src="images/black_pawn.png" />
                <img class="piece bp square-77" src="images/black_pawn.png" />
                <img class="piece bp square-67" src="images/black_pawn.png" />
                <img class="piece bp square-57" src="images/black_pawn.png" />
                <img class="piece bp square-47" src="images/black_pawn.png" />
                <img class="piece bp square-37" src="images/black_pawn.png" />
                <img class="piece bp square-27" src="images/black_pawn.png" />
                <img class="piece bp square-17" src="images/black_pawn.png" />
                <img class="piece wr square-82" src="images/white_rook.png" />
                <img class="piece wn square-72" src="images/white_knight.png" />
                <img class="piece wb square-62" src="images/white_bishop.png" />
                <img class="piece wq square-52" src="images/white_queen.png" />
                <img class="piece wk square-42" src="images/white_king.png" />
                <img class="piece wb square-32" src="images/white_bishop.png" />
                <img class="piece wk square-22" src="images/white_knight.png" />
                <img class="piece wr square-12" src="images/white_rook.png" />
                <img class="piece wp square-81" src="images/white_pawn.png" />
                <img class="piece wp square-71" src="images/white_pawn.png" />
                <img class="piece wp square-61" src="images/white_pawn.png" />
                <img class="piece wp square-51" src="images/white_pawn.png" />
                <img class="piece wp square-41" src="images/white_pawn.png" />
                <img class="piece wp square-31" src="images/white_pawn.png" />
                <img class="piece wp square-21" src="images/white_pawn.png" />
                <img class="piece wp square-11" src="images/white_pawn.png" />
            </div>
            <div id="username">
                <?php
                    echo $_SESSION['username_whites'];
                ?>
            </div>
        </div>
    </body>
</html>