<?php
require_once '../../config/config.php';
require_once FUNCTIONS_DIR . '/functions.func.php';
if (isAdmin() !== true) {
    header('Location: /index.php?error=bla');
    exit();
} else {
    require_once INCLUDE_DIR . '/pages.inc.php';
    require_once FUNCTIONS_DIR . '/pages.func.php';
}