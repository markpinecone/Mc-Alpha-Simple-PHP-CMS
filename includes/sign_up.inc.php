<?php
require_once '../config/config.php';
require_once INCLUDE_DIR . '/dbh.inc.php';
require FUNCTIONS_DIR . '/sign_up.func.php';

if (isset($_GET["submit"])) {
    if ($_GET['password'] != $_GET['repeat-password']) {
        echo 'Passwords doesn\'t match!';
    } else {
        $stmt = mysqli_stmt_init($conn);
        if (isset($_GET['email'])) {
            $email = $_GET["email"];
            $password = $_GET["password"];
            $name = $_GET["name"];
            $lastname = $_GET["lastname"];
            $role = 'user';
        }
        $findEmail = "SELECT email FROM Users WHERE email=?";
        $insertUserQuery = "INSERT INTO Users (email, pass, name, lastname, role)
            VALUES (?, ?, ?, ?, ?)";

        if (!mysqli_stmt_prepare($stmt, $findEmail)) {
            echo "SQL statement failed";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = $stmt->get_result();
            if ($result->num_rows == 0) {
                if (!mysqli_stmt_prepare($stmt, $insertUserQuery)) {
                    echo "SQL statement failed";
                } else {
                    mysqli_stmt_bind_param($stmt, "sssss", $email, $password, $name, $lastname, $role);
                    mysqli_stmt_execute($stmt);
                    header("Location: /login.php");
                    // echo '<div class="notify-success" User with e-mail ' . $email . ' has been added successfully';

                }
            }else {
                echo '<div class="alert">User with e-mail ' . $email . ' already exist!</div>';
            }

        }

    }
}






