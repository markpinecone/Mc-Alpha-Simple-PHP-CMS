<?php
if ($_SESSION["login-status"]) {
    session_unset();
    session_destroy();
    session_write_close();
    if (isset($_COOKIE["logged-in"])) {
        setcookie("logged-in", "", time() - 3600);
    }
    header("Location: /index.php?notify=signedout");
    die();    
}
