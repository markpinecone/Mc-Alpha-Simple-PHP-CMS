<?php

session_start();
require_once '../config/config.php';
require VIEWS_DIR . '/header.view.php';
require VIEWS_DIR . '/navbar.view.php';
if (isset($_GET['id'])) {
    $pageIdentifier = (int) $_GET["id"];
    getContent($conn, $pageIdentifier);
}
if (isset($_GET["action"])) {
    $action = $_GET["action"];
    switch ($action) {
        case 'logout':
            require INCLUDE_DIR . '/logout.inc.php';
            break;
        case("signup"):
            require_once INCLUDE_DIR . '/signup.inc.php';
            require_once FORMS_DIR . '/signup.form.php';
            break;
        case("login"):
            require INCLUDE_DIR . '/login.inc.php';
            require_once FORMS_DIR . '/login.form.php';
            break;
        case("post"):
            require INCLUDE_DIR . '/post.inc.php';
            require VIEWS_DIR . '/post.view.php';
            break;
        case("home"):
            getContent($conn, getSetPage($conn, 'ID of Home page'));
            break;
        default:
            break;
    }
}



require VIEWS_DIR . '/footer.view.php';
