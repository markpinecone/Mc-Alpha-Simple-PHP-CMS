<?php

require_once INCLUDE_DIR . '/dbh.inc.php';

if (isset($_POST["addpost"])) {
    $title = test_input($_POST["title"]);
    $content = test_input($_POST["content"]);
    createPost($conn, $title, $content);
}


if (isset($_GET["delete"]) && $_GET["action"] == 'posts') {
    $id = (int)	$_GET["delete"];
    try {
        deleteRow($conn, 'posts', $id, 'posts');
    } catch (Exception $e) {
        echo 'Caught exception: ' . $e->getMessage() . '<br>';
    }
}

if (isset($_POST["updatepost"]) && $_GET["action"] == "posts") {
    $title = test_input($_POST["title"]);
    $content = test_input($_POST["content"]);
    $id = (int) $_GET["edit"];
    try {
        updatePost($conn, $title, $content, $id);
    } catch (Exception $e) {
        echo 'Caught exception: ' . $e->getMessage() . '<br>';
    }
}

if (isset($_POST["addcomment"])) {
    $postID = (int) $_GET["postid"];
    $authorID = (int) $_SESSION["id"];
    $comment = htmlspecialchars($_POST["comment"]);
    createComment($conn, $postID, $authorID, $comment);
}
