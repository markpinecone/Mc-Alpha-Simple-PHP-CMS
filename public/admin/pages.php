<?php
require_once '../../config/config.php';
require_once FUNCTIONS_DIR . '/functions.func.php';
if (!isLoggedIn()) {
    header('Location: /login.php');
    die();
} else {
    require_once INCLUDE_DIR . '/pages.inc.php';
    require_once FUNCTIONS_DIR . '/pages.func.php';
}