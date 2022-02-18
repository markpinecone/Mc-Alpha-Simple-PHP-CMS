<?php

require_once '../../config/db_config.php';
require_once 'includes/dbc.inc.php';
echo '<h3>Setup DB</h3>';
echo createDB();

$createUsersTable  = "CREATE TABLE Users (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        email VARCHAR(100) NOT NULL UNIQUE,
                        pass VARCHAR(255) NOT NULL,
                        name VARCHAR(30),
                        lastname VARCHAR(30),
                        role VARCHAR(10),     
                        display_name VARCHAR(30) NOT NULL UNIQUE,
                        avatar VARCHAR(255) NOT NULL DEFAULT 'default.png', 
                        registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

$createPagesTable  = "CREATE TABLE Pages (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        title VARCHAR(20) NOT NULL UNIQUE,
                        content TEXT,
                        `order` INT(1) NOT NULL UNIQUE,
                        edited TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

$createCommentsTable = "CREATE TABLE Comments (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        post_id INT(11) NOT NULL,
                        author_id INT(11) NOT NULL,
                        content TEXT,
                        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        status VARCHAR(10) DEFAULT 'active'
                        )";
$createNewsTable = "CREATE TABLE Posts (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        title VARCHAR(30) NOT NULL UNIQUE,
                        content TEXT,
                        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

$createOptionsTable = "CREATE TABLE Settings (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        name VARCHAR(15) NOT NULL UNIQUE,
                        value INT(11) NOT NULL
)";

$createSettings = "INSERT INTO Settings (name, value)
VALUES ('ID of Blog page', '0'),('ID of Home page', '0');";

require_once '../../config/config.php';
require_once '../../includes/dbh.inc.php';

echo '<h3>Setup Table "Users"</h3>';
require INCLUDE_DIR . '/dbh.inc.php';
try {
    if ($conn->query($createUsersTable) === true) {
        echo '<p class="alert-success">Table "Users" has been created.</p>';
    }
} catch (Exception $e) {
    echo '<p class="alert-warning">Caught exception: ',  $e->getMessage(), "</p>\n";
}

echo '<h3>Setup Table "Pages"</h3>';

try {
    if ($conn->query($createPagesTable) === true) {
        echo '<p  class="alert-success">Table "Pages" has been created.</p>';
    }
} catch (Exception $e) {
    echo '<p class="alert-warning">Caught exception: ',  $e->getMessage(), "\n";
}

echo '<h3>Setup Table "Comments"</h3>';

try {
    if ($conn->query($createCommentsTable) === true) {
        echo '<p  class="alert-success">Table "Comments" has been created.</p>';
    }
} catch (Exception $e) {
    echo '<p class="alert-warning">Caught exception: ',  $e->getMessage(), "</p>\n";
}

echo '<h3>Setup Table "Posts"</h3>';

try {
    if ($conn->query($createNewsTable) === true) {
        echo '<p  class="alert-success">Table "Posts" has been created.</p>';
    }
} catch (Exception $e) {
    echo '<p class="alert-warning">Caught exception: ',  $e->getMessage(), "</p>\n";
}

echo '<h3>Setup Table "Settings"</h3>';

try {
    if ($conn->query($createOptionsTable) === true) {
        echo '<p  class="alert-success">Table "Settings" has been created.</p>';
    }
} catch (Exception $e) {
    echo '<p class="alert-warning">Caught exception: ',  $e->getMessage(), "</p>\n";
}

echo '<h3>Setup "Settings" entries</h3>';

try {
    if ($conn->query($createSettings) === true) {
        echo '<p  class="alert-success">Initial Settings has been created.</p>';
    }
} catch (Exception $e) {
    echo '<p class="alert-warning">Caught exception: ',  $e->getMessage(), "</p>\n";
}

echo '<br><br>';
