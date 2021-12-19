<?php
session_start();
require_once '../config/config.php';
require FUNCTIONS_DIR . '/functions.func.php';
if (!isLoggedIn()) {
    header('Location: login.php');
    die();
} else {
    require INCLUDE_DIR . '/logout.inc.php';
}