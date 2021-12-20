<?php
if ($_SESSION["login-status"]) {
    session_unset();
    session_destroy();
    session_write_close();
    header("Location: /login.php");
    if (isset($_COOKIE["logged-in"])) {
        setcookie("logged-in", "", time() - 3600);
    }
}