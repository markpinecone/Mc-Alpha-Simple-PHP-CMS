<?php
function handleLoginRequest($result, $password) {
    $row = $result->fetch_assoc();
    if ($row['pass'] == $password) {
        $_SESSION["LoggedIn"] = true;
        $_SESSION["email"] = $_GET["email"];
        $_SESSION['role'] = $row['role'];
        if (isset($_GET["remember"])) {
            setcookie("logged-in", $_GET["email"], time() + (86400 * 30), "/");
        }
        header("Location: /index.php");
        die();
    } else {
        if (isset($_GET["email"]) && (isset($_GET["password"]))) {
            echo '<div class="alert">Incorrect username or password!</div>';
        }
    }
}






