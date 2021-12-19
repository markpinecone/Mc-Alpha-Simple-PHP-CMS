<?php
session_start();
require_once '../../config/config.php';
require INCLUDE_DIR . '/header.inc.php';
require FUNCTIONS_DIR . '/functions.func.php';
echo '<h1>Admin Panel</h1>';
require INCLUDE_DIR . '/navbar.inc.php';
require_once FUNCTIONS_DIR . '/functions.func.php';
if (!isLoggedIn()) {
    header('Location: /login.php');
    die();
}
if ($_SESSION['role'] != 'admin') {
    header('Location: /index.php');
    die();
}
//echo $_SERVER['REQUEST_URI'];

if ($_SESSION['role'] != 'admin') {
    header("Location: /index.php");
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "pages") {
        include 'pages.php';
    }
    if ($_GET["action"] == "users") {
        include 'users.php';
    }
    if (!isset($_GET["action"])) {
        echo 'Welcome ' . $_SESSION['name'] . ' ' . $_SESSION['lastname'] . '!';
    }
} else {
    // pass
}

require INCLUDE_DIR . '/footer.inc.php';