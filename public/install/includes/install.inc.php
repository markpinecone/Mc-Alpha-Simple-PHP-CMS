<?php

require FUNCTIONS_DIR . '/functions.func.php';
require INCLUDE_DIR . '/dbh.inc.php';
if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $pass = $_POST['pass'];
    $passRepeat = $_POST['repeat-pass'];
    $display_name = 'Admin';
    $role = 'admin';
    //require_once INCLUDE_DIR . '/dbh.inc.php';
    // require_once FUNCTIONS_DIR . '/functions.func.php';
    if (emptyInput($email, $name, $lastname, $pass, $passRepeat) !== false) {
        header("Location: /install/index.php?error=missinginput");
        exit();
    } elseif (invalidEmail($email)) {
        header("Location: /install/index.php?error=invalidemail");
        exit();
    } elseif (invalidName($name, $lastname)) {
        header("Location: /install/index.php?error=invalidname");
        exit();
    } elseif (!passwordMatch($pass, $passRepeat)) {
        header("Location: /install/index.php?error=passmatch");
        exit();
    } elseif (emailExist($conn, $email) !== false) {
        header("Location: /install/index.php?error=emailexist");
        exit();
    } else {
        createUser($conn, $email, $pass, $name, $lastname, $display_name, $role);
        header("Location: /install/install.php?notify=success");
        exit();
    }
}
