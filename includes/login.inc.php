<?php

if (isset($_POST["submit"])) {
    $user = test_input($_POST['user']);
    $pass = test_input($_POST['pass']);
    if (isset($_POST["remember"])) {
        $remember = true;
    } else {
        $remember = false;
    }
    if (emptyLoginInput($user, $pass) !== false) {
        header("Location: /index.php?action=login&error=missing-input");
        exit();
    } else {
        userLogin($conn, $user, $pass, $remember);
    }
}
