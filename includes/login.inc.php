<?php
require INCLUDE_DIR . '/dbh.inc.php';
require FUNCTIONS_DIR . '/login.func.php';

if (isset($_GET['submit'])) {
    $email = $_GET["email"];
    $password = $_GET["password"];
    $emailQuery = "SELECT * FROM Users WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $emailQuery)) {
        echo "SQL statement failed";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            echo '<div class="alert">User does not exist</div>';
            die();
        }else {
            handleLoginRequest($result, $password);
        }
    }
    $stmt->close();
}

