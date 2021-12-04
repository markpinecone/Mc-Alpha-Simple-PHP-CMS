<?php
require INCLUDE_DIR . '/dbh.inc.php';

if (isset($_GET['submit'])) {
    $email = $_GET["email"];
    $password = $_GET["password"];
    $userQuery = 'SELECT * FROM Users WHERE email="{$email}"';
    $queryResult = $conn->query($userQuery);
    $row = $queryResult->fetch_assoc();

    if ($queryResult->num_rows > 0) {
        if ($row['pass'] == $password) {
            $_SESSION["LoggedIn"] = true;
            $_SESSION["email"] = $_GET["email"];
            $_SESSION['role'] = $row['role'];
            header("Location: /index.php");
            die();
        } else {
            if (isset($_GET["email"]) && (isset($_GET["password"]))) {
                echo '<div class="alert">
                    Incorrect username or password!
                </div>';
            }
        }
    } else {
        echo '<div class="alert">User does not exist</div>';
    }

    $conn->close();
}

