<?php
if(!isset($_GET["postid"])) {
    header('Location: /index.phpg');
    exit();
}
$postid = (int) $_GET["postid"];
getSinglePost($conn, $postid);
getComments($conn, $postid);

if (isLoggedIn()) {
    include FORMS_DIR . '/comments.form.php';
}

