<?php
if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $pass = $_POST['pass'];
    $passRepeat = $_POST['repeat-pass'];
    $role = 'user';
    require_once INCLUDE_DIR . '/dbh.inc.php';
    require_once FUNCTIONS_DIR . '/functions.func.php';
    if (emptyInput($email, $name, $lastname, $pass, $passRepeat) !== false) {
        header("Location: /signup.php?error=missinginput");
        exit();
    } elseif (invalidEmail($email)) {
        header("Location: /signup.php?error=invalidemail");
        exit();
    } elseif (invalidName($name, $lastname)) {
        header("Location: /signup.php?error=invalidname");
        exit();
    } elseif (!passwordMatch($pass, $passRepeat)) {
        header("Location: /signup.php?error=passmatch");
        exit();
    } elseif (emailExist($conn, $email) !== false) {
        header("Location: /signup.php?error=emailexist");
        exit();
    } else {
        createUser($conn, $email, $pass, $name, $lastname, $role);
        header("Location: /signup.php?notify=usersuccess");
        exit();
    }
}