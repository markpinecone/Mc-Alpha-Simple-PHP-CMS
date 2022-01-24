<?php
require_once '../../config/db_config.php';
require_once './includes/dbc.inc.php';

$createUsersTable  = "CREATE TABLE Users (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        email VARCHAR(100) NOT NULL UNIQUE,
                        pass VARCHAR(255) NOT NULL,
                        name VARCHAR(30),
                        lastname VARCHAR(30),
                        role VARCHAR(10),     
                        display_name VARCHAR(30) NOT NULL UNIQUE,
                        registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

$createPagesTable  = "CREATE TABLE Pages (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        title VARCHAR(20) NOT NULL UNIQUE,
                        content TEXT,
                        `order` INT(1) NOT NULL UNIQUE,
                        edited TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";

$createComentsTable = "CREATE TABLE Coments (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        news_id INT(11) NOT NULL,
                        content TEXT,
                        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        status VARCHAR(10)
                        )";
$createNewsTable = "CREATE TABLE News (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
                        title VARCHAR(30) NOT NULL,
                        content TEXT,
                        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        )";



echo '<h3>Setup DB</h3>';
echo createDB();

require_once '../../includes/dbh.inc.php';

echo '<h3>Setup Table "Users"</h3>';
require INCLUDE_DIR . '/dbh.inc.php';
try {
    if ($conn->query($createUsersTable) === TRUE) {
        echo '<p>Table "Users" has been created.</p>';
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

echo '<h3>Setup Table "Pages"</h3>';

try {
    if ($conn->query($createPagesTable) === TRUE) {
        echo '<p>Table "Pages" has been created.</p>';
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

echo '<h3>Setup Table "Coments"</h3>';

try {
    if ($conn->query($createComentsTable) === TRUE) {
        echo '<p>Table "Coments" has been created.</p>';
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

echo '<h3>Setup Table "News"</h3>';

try {
    if ($conn->query($createNewsTable) === TRUE) {
        echo '<p>Table "News" has been created.</p>';
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


echo '<br><br>';
