<?php
session_start();
require_once '../../config/config.php';
require INCLUDE_DIR . '/header.inc.php';
require INCLUDE_DIR . '/navbar.inc.php';
echo '<h1>Admin</h1>';
include FUNCTIONS_DIR . '/test.php';
//echo $_SERVER['REQUEST_URI'];

if ($_SESSION['role'] != 'admin') {
    header("Location: /index.php");
}

require INCLUDE_DIR . '/footer.inc.php';
