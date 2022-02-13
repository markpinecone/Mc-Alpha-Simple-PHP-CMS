<?php

if (isset($_POST["submit"])) {
    $email = test_input($_POST['email']);
    $name = test_input($_POST['name']);
    $lastname = test_input($_POST['lastname']);
    $pass = test_input($_POST['pass']);
    $passRepeat = test_input($_POST['repeat-pass']);
    $display_name = test_input($_POST["display_name"]);
    $role = 'user';
    require_once INCLUDE_DIR . '/dbh.inc.php';
    if (emptyInput($email, $name, $lastname, $pass, $passRepeat, $display_name) !== false) {
        header("Location: /signup.php?error=missing-input");
        exit();
    } elseif (invalidEmail($email)) {
        header("Location: /signup.php?error=invalid-email");
        exit();
    } elseif (invalidName($name, $lastname)) {
        header("Location: /signup.php?error=invalid-name");
        exit();
    } elseif (!passwordMatch($pass, $passRepeat)) {
        header("Location: /signup.php?error=pass-match");
        exit();
    } elseif (userExist($conn, $email) !== false) {
        header("Location: /signup.php?error=email-exist");
        exit();
    } elseif (userExist($conn, $display_name) !== false) {
        header("Location: /signup.php?error=display-name-exist");
    } else {
        createUser($conn, $email, $pass, $name, $lastname, $display_name, $role);
        header("Location: /signup.php?notify=user-created");
        exit();
    }
}
