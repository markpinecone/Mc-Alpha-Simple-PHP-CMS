<?php
echo '<h3 class="mb-3">Messages</h3>';
echo '<div class="d-inline-flex flex-row mb-3">';
echo '<a class="font-weight-bold text-decoration-none px-2 text-light bg-primary" href="/index.php?action=messages&type=inbox">Inbox</a>';
echo '<a class="font-weight-bold text-decoration-none px-2 text-light bg-dark" href="/index.php?action=messages&type=sent">Sent</a>';
echo '<a class="font-weight-bold text-decoration-none px-2 text-light bg-success" href="/index.php?action=messages&type=new">New Message</a>';
echo '</div>';


if (!isset($_GET["type"])) {
    $_GET["type"] = 'default';
}

$type = test_input($_GET["type"]);
switch($type) {
    case "new":
        include VIEWS_DIR . '/msg/new.php';
        break;
    case "sent":
        include VIEWS_DIR . '/msg/sent.php';
        break;
    case "read":
        include VIEWS_DIR . '/msg/read.message.php';
        break;
    default:
        include VIEWS_DIR . '/msg/inbox.php';
        break;
}