<?php
if (isset($_POST["set"]) && $_GET["action"] == "settings") {
    $value = (int) $_POST["value"];
    $id = (int) $_GET["edit"];
    try {
        updateSettings($conn, $id, $value);
    } catch (Exception $e) {
        echo '<p class="alert alert-danger mb-3">Caught exception: ' . $e->getMessage() . '</p>';
    }
}