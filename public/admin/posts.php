<?php

require_once '../../config/config.php';
require_once FUNCTIONS_DIR . '/functions.func.php';
if (isAdmin() !== true) {
    header('Location: /index.php?error=forbidden');
    exit();
} else {
    require_once FUNCTIONS_DIR . '/table.func.php';
    require_once INCLUDE_DIR . '/post.inc.php';
    echo '<h2 class="mt-3 mb-3">Posts</h2>';
    $array = array(
        "#" => "id",
        "Title" => "title",
        "Content" => "content",
        "Last Update" => "timestamp",
    );
    echo '<form method="post" action="">';
    showTable($conn, $array, 'Posts');
    echo '</form>';
    if (isset($_POST['delete'])) {
        if (!empty($_POST['row'])) {
            foreach ($_POST['row'] as $checked) {
                try {
                    $row = (int) $checked;
                    $action = test_input($_GET["action"]);
                    deleteRow($conn, $action, $row, 'posts');
                } catch (Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                }
            }
            header("location: /admin/index.php?action=posts&notify=deletesuccess");
        }
    }
    require_once FORMS_DIR . '/posts.form.php';
}
