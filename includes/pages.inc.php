<?php
require_once INCLUDE_DIR . '/dbh.inc.php';
if (isset($_POST["add"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $order = $_POST["order"];
    createPage($conn, $title, $content, $order);
}
