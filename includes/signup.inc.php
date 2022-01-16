<?php
if (isset($_POST["submit"])) {
    $email = test_input($_POST['email']);
	$name = test_input($_POST['name']);
    $lastname = test_input($_POST['lastname']);
    $pass = test_input($_POST['pass']);
    $passRepeat = test_input($_POST['repeat-pass']);
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
