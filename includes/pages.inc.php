<?php

require_once INCLUDE_DIR . '/dbh.inc.php';

if (isset($_POST["add"])) {
    $title = test_input($_POST["title"]);
    $content = test_input($_POST["content"]);
    $order = (int) $_POST["order"];
    createPage($conn, $title, $content, $order);
}


if (isset($_GET["delete"]) && $_GET["action"] == 'pages') {
    $id = (int)	$_GET["delete"];
    try {
        deleteRow($conn, 'pages', $id, 'Pages');
    } catch (Exception $e) {
        echo 'Caught exception: ' . $e->getMessage() . '<br>';
    }
}

if (isset($_POST["updatepage"]) && $_GET["action"] == "pages") {
    $title = test_input($_POST["title"]);
    $order = (int) $_POST["order"];
    $content = test_input($_POST["content"]);
    $id = (int) $_GET["edit"];
    try {
        updatePage($conn, $title, $order, $content, $id);
    } catch (Exception $e) {
        echo 'Caught exception: ' . $e->getMessage() . '<br>';
    }
}
