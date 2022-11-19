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
        <p>{blacks_minutes}:{blacks_seconds}</p>
        <p>{whites_minutes}:{whites_seconds}</p>
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

            <div class="piece br square-88" style="background-image:url('images/black_rook.png')"></div>
            <div class="piece bn square-78" style="background-image:url('images/black_knight.png')"></div>
            <div class="piece bb square-68" style="background-image:url('images/black_bishop.png')"></div>
            <div class="piece bk square-58" style="background-image:url('images/black_king.png')"></div>
            <div class="piece bq square-48" style="background-image:url('images/black_queen.png')"></div>
            <div class="piece bb square-38" style="background-image:url('images/black_bishop.png')"></div>
            <div class="piece bn square-28" style="background-image:url('images/black_knight.png')"></div>
            <div class="piece br square-18" style="background-image:url('images/black_rook.png')"></div>
            <div class="piece bp square-87" style="background-image:url('images/black_pawn.png')"></div>
            <div class="piece bp square-77" style="background-image:url('images/black_pawn.png')"></div>
            <div class="piece bp square-67" style="background-image:url('images/black_pawn.png')"></div>
            <div class="piece bp square-57" style="background-image:url('images/black_pawn.png')"></div>
            <div class="piece bp square-47" style="background-image:url('images/black_pawn.png')"></div>
            <div class="piece bp square-37" style="background-image:url('images/black_pawn.png')"></div>
            <div class="piece bp square-27" style="background-image:url('images/black_pawn.png')"></div>
            <div class="piece bp square-17" style="background-image:url('images/black_pawn.png')"></div>
            <div class="piece wp square-82" style="background-image:url('images/white_pawn.png')"></div>
            <div class="piece wp square-72" style="background-image:url('images/white_pawn.png')"></div>
            <div class="piece wp square-62" style="background-image:url('images/white_pawn.png')"></div>
            <div class="piece wp square-52" style="background-image:url('images/white_pawn.png')"></div>
            <div class="piece wp square-42" style="background-image:url('images/white_pawn.png')"></div>
            <div class="piece wp square-32" style="background-image:url('images/white_pawn.png')"></div>
            <div class="piece wp square-22" style="background-image:url('images/white_pawn.png')"></div>
            <div class="piece wp square-12" style="background-image:url('images/white_pawn.png')"></div>
            <div class="piece wr square-81" style="background-image:url('images/white_rook.png')"></div>
            <div class="piece wn square-71" style="background-image:url('images/white_knight.png')"></div>
            <div class="piece wb square-61" style="background-image:url('images/white_bishop.png')"></div>
            <div class="piece wk square-51" style="background-image:url('images/white_queen.png')"></div>
            <div class="piece wq square-41" style="background-image:url('images/white_king.png')"></div>
            <div class="piece wb square-31" style="background-image:url('images/white_bishop.png')"></div>
            <div class="piece wn square-21" style="background-image:url('images/white_knight.png')"></div>
            <div class="piece wr square-11" style="background-image:url('images/white_rook.png')"></div>
        </div>
        <p><a href="logout_both_players.php">Logout both</a></p>
    </body>
</html>