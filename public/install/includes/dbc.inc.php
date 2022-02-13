<?php

function createDB()
{
    include '../../config/db_config.php';
    $dbconn = new mysqli($host, $db_user, $db_pass);
    if ($dbconn->connect_error) {
        return $dbconn->connect_error;
        die();
    }
    $createDatabase = "CREATE DATABASE {$db_name};";
    try {
        if ($dbconn->query($createDatabase) === true) {
            return '<p class="alert-success">Database "'. $db_name . '" has been created.</p>';
        }
    } catch (Exception $e) {
        return '<p class="alert-warning">Caught exception: '.  $e->getMessage(). "</p>\n";
    }
}
