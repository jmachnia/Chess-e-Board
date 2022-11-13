<?php
    session_start();

    $_SESSION['logged_in_blacks'] = false;

    unset($_POST['username_blacks']);
    unset($_POST['password_blacks']);

    unset($_SESSION['id_blacks']);
    unset($_SESSION['username_blacks']);
    unset($_SESSION['email_blacks']);

    header('Location: whites_logged_in.php');
?>