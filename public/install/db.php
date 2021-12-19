<?php

$createUsersTable  = "CREATE TABLE Users (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        email VARCHAR(100) NOT NULL UNIQUE,
                        pass VARCHAR(255) NOT NULL,
                        name VARCHAR(30),
                        lastname VARCHAR(30),
                        role VARCHAR(10),
                        registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

$createPagesTable  = "CREATE TABLE Pages (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        title VARCHAR(20) NOT NULL UNIQUE,
                        content VARCHAR(1600) NOT NULL,
                        edited TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";


echo '<h3>Setup User Table</h3>';
require INCLUDE_DIR . '/dbh.inc.php';
try {
    if ($conn->query($createUsersTable) === TRUE) {
        echo "<p>User table has been created.</p>";
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

echo '<h3>Setup Pages Table</h3>';

try {
    if ($conn->query($createPagesTable) === TRUE) {
        echo "<p>Pages table has been created.</p>";
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo '<br><br>';