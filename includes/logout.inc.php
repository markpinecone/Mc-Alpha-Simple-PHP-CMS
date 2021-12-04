<?php
if ($_SESSION["LoggedIn"]) {
    session_unset();
    session_destroy();
    session_write_close();
    header("Location: /login.php");
}