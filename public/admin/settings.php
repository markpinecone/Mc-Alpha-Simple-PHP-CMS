<?php

require_once '../../config/config.php';
if (isAdmin() !== true) {
    header('Location: /index.php?error=forbidden');
    exit();
} else {
    require_once FUNCTIONS_DIR . '/Table/table.func.php';
    require_once INCLUDE_DIR . '/settings.inc.php';
    echo '<h2 class="mt-3 mb-3">Settings</h2>';
    $array = array(
        "Option" => "name",
        "Value" => "value",
    );

    echo '<form method="post" action="">';
    showTable($conn, $array, 'Settings');
    echo '</form>';
    if (isset($_GET["edit"])) {
        require_once FORMS_DIR . '/settings.form.php';
    }

}
