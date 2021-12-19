<?php
require_once INCLUDE_DIR . '/dbh.inc.php';
if (isset($_POST["add"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $sql = "INSERT INTO pages (title, content) VALUES ('$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        header("Location: /admin/pages.php?action=success");
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}