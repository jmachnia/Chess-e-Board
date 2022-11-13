<!DOCTYPE html>

<html>
    <head>
        <title>Chess e-Board</title>
        <link href="login_page.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <h2>Login Page</h2>
        <h4>Black pieces</h4>
        <?php
            if((isset($_SESSION['logged_in_whites'])) && ($_SESSION['logged_in_whites'] == true))
            {
                echo '<a href="whites_logged_in.php>Click here to go back</a><br /><br />"';
            }
            else
            {
                echo '<a href="index.php">Click here to go back</a><br /><br />';
            }
        ?>
        <div id="form">
            <form action="checklogin_blacks_whites_logged_in.php" method="post">
                Enter username: <input type="text" name="username_blacks" required="required"/><br />
                Enter password: <input type="password" name="password_blacks" required="required"/><br />
                <input type="submit" value="Log in">
            </form>
        </div>
    </body>
</html>