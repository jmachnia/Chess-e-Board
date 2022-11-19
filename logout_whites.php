<?php
    session_start();

    $_SESSION['logged_in_whites'] = false;

    unset($_POST['username_whites']);
    unset($_POST['password_whites']);

    unset($_SESSION['id_whites']);
    unset($_SESSION['username_whites']);
    unset($_SESSION['email_whites']);

    header('Location: blacks_logged_in.php');
?>