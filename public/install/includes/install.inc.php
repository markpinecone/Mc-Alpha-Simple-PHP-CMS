<?php
require_once '../../../config/config.php';
require INCLUDE_DIR . '/dbh.inc.php';
$email = $_POST['email'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$pass = $_POST['pass'];
$passRepeat = $_POST['repeat-pass'];
$display_name = 'Admin';
$role = 'admin';
if (emptyInput($email, $name, $lastname, $pass, $passRepeat, $display_name) !== false) {
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
} elseif (userExist($conn, $email) !== false) {
    header("Location: /install/index.php?error=userexist");
    exit();
} else {
    createUser($conn, $email, $pass, $name, $lastname, $display_name, $role);
    header("Location: /install/install.php?notify=success");
    exit();
}
