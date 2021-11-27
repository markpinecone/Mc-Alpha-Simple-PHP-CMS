<?php

if (($_GET["user"] == "admin") && ($_GET["password"] == "111")) {
    $_SESSION["LoggedIn"] = true;
    $_SESSION["user"] = $_GET["user"];
    header("Location: /admin/index.php");
    die();
} else {
    if (isset($_GET["user"]) && (isset($_GET["password"]))) {
        echo '<div class="alert alert-danger text-center" role="alert">
                Incorrect username or password!
            </div>';
    }
}