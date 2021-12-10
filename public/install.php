<?php
session_start();
require_once '../../config/config.php';
require INCLUDE_DIR . '/header.inc.php';
require INCLUDE_DIR . '/dbh.inc.php';
require INCLUDE_DIR . '/navbar.inc.php';
$createDbQuery  = "CREATE TABLE Users (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        email VARCHAR(100) NOT NULL UNIQUE,
                        pass VARCHAR(255) NOT NULL,
                        name VARCHAR(30),
                        lastname VARCHAR(30),
                        role VARCHAR(10),
                        registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

echo '<h1>Setup User Table</h1>';

try {
    if ($conn->query($createDbQuery) === TRUE) {
        echo "<p>User table has been created.</p>";
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

require INCLUDE_DIR . '/footer.inc.php';