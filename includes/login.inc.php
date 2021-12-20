<?php
if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if (isset($_POST["remember"])) {
        $remember = true;
    } else {
        $remember = false;
    }
    require_once INCLUDE_DIR . '/dbh.inc.php';
    if (emptyLoginInput($email, $pass) !== false) {
        header("Location: /login.php?error=missinginput");
        exit();
    } else {
        userLogin($conn, $email, $pass, $remember);
    }
}