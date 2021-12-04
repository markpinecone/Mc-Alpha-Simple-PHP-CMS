<?php
require INCLUDE_DIR . '/dbh.inc.php';

if (isset($_GET["submit"])) {
    if ($_GET['pass'] != $_GET['repeat-pass']) {
        echo 'Passwords doesn\'t match!';
    } else {

        if (isset($_GET['email'])) {
            $email = $_GET['email'];
        }
        $checkEmail = $conn->query("SELECT email FROM Users WHERE email='{$email}'");
        //    echo var_dump($checkEmail);

        $insertUserQuery = "INSERT INTO Users (email, pass, name, lastname, role)
        VALUES ('" . $_GET["email"] . "', '" . $_GET["pass"] . "', '" . $_GET["name"] . "', '" . $_GET["lastname"] . "', 'user')
        ";
        if ($checkEmail->num_rows == 0) {
            try {
                if ($conn->query($insertUserQuery) === TRUE) {
                    echo "<p>User has been created.</p>";
                }
            } catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
            }
        } else {
            echo 'User with email: ' .  $email . ' already exist!';
        }

    }

    $conn->close();

}


