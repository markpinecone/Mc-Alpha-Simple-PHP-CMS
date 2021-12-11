<?php
if ($_SESSION["LoggedIn"]) {
    session_unset();
    session_destroy();
    session_write_close();
    header("Location: /login.php");
    if ($_COOKIE["logged-in"]) {
        setcookie("logged-in", "", time() - 3600);
        echo 'cookie has been deleted';
    }

}